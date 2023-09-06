<?php
// Advanced Search Engine model
// by janith nirmal
// version - 1.0.3 (06-09-2023 - updated)
// developed - 03-09-2023


require_once("database_driver.php");

class AdvancedSearchEngine
{
    private $database;

    public function __construct()
    {
        $this->database = new database_driver();
    }

    public function searchProducts($searchTerm = "", $category = "", $orderBy = "", $orderDirection = "", $limit = 10)
    {
        // validate data
        $searchTermArray = explode(" ", $searchTerm);

        // generate query
        $baseQuery = "SELECT `product_id`, `product_name`, `product_description`, `category_id`, `add_date`, `category_type`, `type` as `product_status`, `qty`, `price` as `item_price`, `weight` 
        FROM `product_item` 
        INNER JOIN `product` ON `product_item`.`product_product_id`=`product`.`product_id` 
        INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
        INNER JOIN `weight` ON `product_item`.`weight_id`=`weight`.`id` 
        INNER JOIN `product_status` ON `product_item`.`product_status_id` = `product_status`.`id`  
        WHERE `product_status`.`type` = 'active' ";


        // chech for search term
        $searchTermQuerySection = "";
        if (isset($searchTerm) && count($searchTermArray)) {
            $count = 0;
            foreach ($searchTermArray as $value) {
                // add term to query

                if ($count == 0) {
                    $searchTermQuerySection = " AND ";
                } else {
                    $searchTermQuerySection = " OR ";
                }


                $searchTermQuerySection .= " ( `product`.`product_name` LIKE '%" . $value . "%' "
                    . " OR `category`.`category_type` LIKE '%" . $value . "%' "
                    . " OR `product`.`product_description` LIKE '%" . $value . "%' "
                    . " OR `weight`.`weight` LIKE '%" . $value . "%' "
                    . " OR `product_item`.`price` LIKE '%" . $value . "%' ) ";
                $count++;
            }
        }

        // check for category
        $categoryQuerySection = " AND ";
        if (isset($category)) {
            // add category to query
            $categoryQuerySection .= "  ( `category`.`category_type` LIKE '%" . $category . "%' ) ";
        }



        // check for order
        $orderQuerySection = "";
        // add order to query
        if ($orderBy) {
            switch ($orderBy) {
                case 'price':
                    $orderQuerySection .= " ORDER BY `product_item`.`price` ";
                    break;
                default:
                    $orderQuerySection .= " ORDER BY `product`.`product_id` ";
                    break;
            }
        } else {
            $orderQuerySection .= " ORDER BY `product`.`product_id` ";
        }

        // check for direction
        $orderDirectionQuerySection = "";
        if ($orderDirection) {
            // add direction to query
            switch ($orderDirection) {
                case 'low to high':
                    $orderDirectionQuerySection .= " ASC ";
                    break;
                case 'high to low':
                    $orderDirectionQuerySection .= " DESC ";
                    break;
                default:
                    $orderDirectionQuerySection .= " ASC ";
                    break;
            }
        } else {
            $orderDirectionQuerySection .= " ASC ";
        }

        $limitQuerySection = " LIMIT " . $limit;
        $finalizedQuery = $baseQuery . $searchTermQuerySection . $categoryQuerySection  . $orderQuerySection . $orderDirectionQuerySection . $limitQuerySection;

        // get item from db
        $searchResultArray = [];
        $resultSet =  $this->database->query($finalizedQuery);
        for ($i = 0; $i < $resultSet->num_rows; $i++) {
            // generate output
            $result = $resultSet->fetch_assoc();
            array_push($searchResultArray, $result);
        }

        // output
        return $searchResultArray;
    }

    public function searchSingleProduct($id)
    {
        $query = "SELECT `product_id`, `product_name`, `product_description`, `category_id`, `add_date`, `category_type`, `type` as `product_status`, `qty`, `price` as `item_price`, `weight` 
        FROM `product_item` 
        INNER JOIN `product` ON `product_item`.`product_product_id`=`product`.`product_id` 
        INNER JOIN `category` ON `product`.`category_id`=`category`.`id` 
        INNER JOIN `weight` ON `product_item`.`weight_id`=`weight`.`id` 
        INNER JOIN `product_status` ON `product_item`.`product_status_id` = `product_status`.`id`  
        WHERE `product_status`.`type` = 'active' AND `product`.`product_id` = ?";
        $resultResponse = $this->database->execute_query($query, "i", [$id]);
        $resultSet = $resultResponse["result"];

        // generate output
        $result = $resultSet->fetch_assoc();
        return $result;
    }
}

// 
// 
// 
// 
// 
// // test
// $searchEngine = new AdvancedSearchEngine();
// $searchTerms = '';

// $orderBy = 'price';
// $orderDirection = 'high to low';

// $foundProducts = $searchEngine->searchProducts($searchTerms, "", 'price', $orderDirection);
// print_r($foundProducts);
