<?php
// Search suggestion Loader model
// by janith nirmal
// version - 1.0.0
// 03-09-2023

require_once("AdvancedSearchEngine.php");

class SuggestionLoader
{

    private $keyWords = [];

    private function prepareWords($searchTerms)
    {
        // validate
        $stringPartsToRemove = [
            ",", ".", "=", "<", ">", "*", "-", "+", "(", ")", "[", "]", "{", "}", ";",
            "!", "@", "#", "$", "%", "^", "&", "_", "|", "\\", ":", "'", "\"", "?", "/", "~",
            "`", "\t", "\n", "\r", "\f", "\v", "SELECT", "INSERT", "UPDATE", "DELETE", "FROM", "WHERE", "AND", "OR",
            "LIMIT", "ORDER BY", "GROUP BY", "JOIN", "LEFT JOIN", "RIGHT JOIN",
            "INNER JOIN", "OUTER JOIN", "ON", "AS", "DISTINCT", "COUNT", "SUM",
            "AVG", "MAX", "MIN", "IN", "NOT", "BETWEEN", "LIKE", "DESC", "ASC",
            "select", "insert", "update", "delete", "from", "where", "and", "or",
            "limit", "order by", "group by", "join", "left join", "right join",
            "inner join", "outer join", "on", "as", "distinct", "count", "sum",
            "avg", "max", "min", "in", "not", "between", "like", "desc", "asc"
        ];

        for ($i = 0; $i < count($stringPartsToRemove); $i++) {
            $searchTerms = str_replace($stringPartsToRemove[$i], "", $searchTerms);
        }

        $searchTerms = preg_replace('/\s+/', ' ', $searchTerms);
        $this->keyWords = explode(" ", $searchTerms);
    }

    // get keywords
    public function getSuggestions($searchTerms,  $count = 2)
    {
        $this->prepareWords($searchTerms);

        $searchEngine = new AdvancedSearchEngine();
        $suggestions = [];
        foreach ($this->keyWords as $value) {
            // seach results
            $suggestions = array_merge($suggestions, $searchEngine->searchProducts($value, "", "", ""));
        }
        shuffle($suggestions);
        return array_slice($suggestions, 0, $count);
    }
}



// test
// $suggestionLoader  = new SuggestionLoader();
// $resutls = $suggestionLoader->getSuggestions("pudin is something very good hey");
// foreach ($resutls as  $value) {
//     print_r($value);
// }


// $suggestionLoader = new SuggestionLoader();
// $suggestionResults = $suggestionLoader->getSuggestions("pudin is here Jelly");
// print_r($suggestionResults);
