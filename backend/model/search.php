<?php
require_once("database_driver.php");

class AdvancedSearchEngine
{
    private $database;

    public function __construct()
    {
        $this->database = new database_driver();
    }

    public function searchProducts($searchTerm = null, $category = null, $orderBy = null, $orderDirection = null)
    {
        // validate data

        // generate query
        $baseQuery = "SELECT * FROM `product_item` 
        INNER JOIN `product` ON `product_item`.`product_product_id`=`product`.`product_id` 
        INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
        INNER JOIN `weight` ON `product_item`.`weight_id`=`weight`.`id` 
        INNER JOIN `product_status` ON `product_item`.`product_status_id` = `product_status`.`id`  
        WHERE ";

        // chech for search term
        $searchTermQuerySection = "";
        $searchTermExists = false;
        if ($searchTerm) {
            $searchTermExists = true;
            // add term to query
            $searchTermQuerySection .= " `product`.`product_name` LIKE '%" . $searchTerm . "% '"
                . " OR `category`.`category_type` LIKE '%" . $searchTerm . "%' "
                . " OR `product`.`product_description` LIKE '%" . $searchTerm . "%' "
                . " OR `weight`.`weight` LIKE '%" . $searchTerm . "%' "
                . " OR `product_item`.`price` LIKE '%" . $searchTerm . "%' ";
        }

        // check for category
        $categoryQuerySection = "";
        if ($category) {
            if ($searchTermExists) {
                $categoryQuerySection .= " OR ";
            }
            // add category to query
            $categoryQuerySection .= " `category`.`category_type` LIKE '%" . $searchTerm . "%' ";
        }

        // check for order
        $orderQuerySection = "";
        $orderStatus = false;
        // add order to query
        if ($orderBy) {
            $orderQuerySection .= " ORDER BY `product_item`.`price` ";
            $orderStatus = true;
        } else {
            $orderQuerySection .= " ORDER BY DEFAULT ";
        }

        // check for direction
        $orderDirectionQuerySection = "";
        if ($orderDirection && $orderStatus) {
            if ($searchTermExists) {
                $orderDirectionQuerySection .= " ASC ";
            } else {
                // add direction to query
                $orderDirectionQuerySection .= " " . $orderDirection . " ";
            }
        }

        $finalizedQuery = $baseQuery . $searchTermQuerySection . $categoryQuerySection . $orderQuerySection . $orderDirectionQuerySection;
        return $finalizedQuery;




        // get item from db
        // validate
        // generate output
        // output




        // $query = "SELECT * FROM `product_item` 
        // INNER JOIN `product` ON `product_item`.`product_product_id`=`product`.`product_id` 
        // INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
        // INNER JOIN `weight` ON `product_item`.`weight_id`=`weight`.`id` 
        // INNER JOIN `product_status` ON `product_item`.`product_status_id` = `product_status`.`id`  
        // WHERE ";


        // for ($i = 0; $i < count($columns); $i++) {
        //     // Construct the search query based on search fieldss
        //     $searchConditions = [];
        //     foreach ($searchTerms as $fields) {
        //         $searchConditions[] = " `$columns[$i]` LIKE ? ";
        //     }
        //     $query .= implode(" OR ", $searchConditions);

        //     if ($i + 1 !== count($columns)) {
        //         $query .= " OR ";
        //     }
        // }


        // Add ordering based on hierarchical parameters
        // $orderByClauses = [];
        // switch ($orderBy) {
        //     case 'product':
        //         $orderByClauses[] = "`product_name`";
        //         break;
        //     case 'date':
        //         $orderByClauses[] = "`add_date`";
        //         break;
        //         // Add more cases for other parameters
        //     default:
        //         // Default ordering logic
        //         $orderByClauses[] = "`product_id`";
        //         break;
        // }


        // $query .= " ORDER BY " . implode(", ", $orderByClauses) . " $orderDirection";

        // // Execute the query using the DatabaseDriver
        // $dataTypes = str_repeat("s", count($searchTerms) * count($columns)); // Assuming all fieldss are strings
        // $dataValues = [];
        // foreach ($columns as $value) {
        //     $dataValues = array_merge($dataValues, array_map(function ($fields) {
        //         return "%" . $fields . "%";
        //     }, $searchTerms));
        // }

        // print_r($dataValues);
        // return $this->database->execute_query($query, $dataTypes, $dataValues);
    }
}


$searchEngine = new AdvancedSearchEngine();
$searchTerms = 'C';

$orderBy = 'price';
$orderDirection = 'DESC';

$foundProducts = $searchEngine->searchProducts($searchTerms, null, null, $orderDirection);
print_r($foundProducts);
