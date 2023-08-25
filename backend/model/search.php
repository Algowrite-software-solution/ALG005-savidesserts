<?php
require_once("database_driver.php");

class AdvancedSearchEngine
{
    private $database;

    public function __construct()
    {
        $this->database = new database_driver();
    }

    public function searchProducts($columns, $searchTerms, $orderBy = 'DAFAULT', $orderDirection = 'ASC')
    {
        $query = "SELECT * FROM `product_item` 
        INNER JOIN `product` ON `product_item`.`product_product_id`=`product`.`product_id` 
        INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
        INNER JOIN `weight` ON `product_item`.`weight_id`=`weight`.`id` 
        INNER JOIN `product_status` ON `product_item`.`product_status_id` = `product_status`.`id`  
        WHERE ";


        for ($i = 0; $i < count($columns); $i++) {
            // Construct the search query based on search fieldss
            $searchConditions = [];
            foreach ($searchTerms as $fields) {
                $searchConditions[] = " `$columns[$i]` LIKE ? ";
            }
            $query .= implode(" OR ", $searchConditions);

            if ($i + 1 !== count($columns)) {
                $query .= " OR ";
            }
        }


        // Add ordering based on hierarchical parameters
        $orderByClauses = [];
        switch ($orderBy) {
            case 'product':
                $orderByClauses[] = "`product_name`";
                break;
            case 'date':
                $orderByClauses[] = "`add_date`";
                break;
                // Add more cases for other parameters
            default:
                // Default ordering logic
                $orderByClauses[] = "`product_id`";
                break;
        }


        $query .= " ORDER BY " . implode(", ", $orderByClauses) . " $orderDirection";

        // Execute the query using the DatabaseDriver
        $dataTypes = str_repeat("s", count($searchTerms) * count($columns)); // Assuming all fieldss are strings
        $dataValues = [];
        foreach ($columns as $value) {
            $dataValues = array_merge($dataValues, array_map(function ($fields) {
                return "%" . $fields . "%";
            }, $searchTerms));
        }

        print_r($dataValues);
        return $this->database->execute_query($query, $dataTypes, $dataValues);
    }
}


$searchEngine = new AdvancedSearchEngine();

$columns = ['product_name', 'product_description', 'category_type', 'price', 'weight'];
$searchTerms = ['Cake with Pudin', '1kg'];

$orderBy = 'date';
$orderDirection = 'DESC';

$foundProducts = $searchEngine->searchProducts($columns, $searchTerms, $orderBy, $orderDirection);
print_r($foundProducts);
