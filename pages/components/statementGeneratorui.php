<?php


class GenerateStatementUi
{

    private $dataObject;

    public function __construct($fileName)
    {
        $policyContentJson = file_get_contents($fileName);
        $this->dataObject = json_decode($policyContentJson);
    }

    public function generate()
    {

        echo "<h3 class='fw-bold py-0 my-0 alg-text-dark text-center'>" . $this->dataObject->title . "</h3> <br><br>";

        echo "<p>" . $this->dataObject->description . "<p/>";
        echo "<hr class='py-0 my-4'>";

        foreach ($this->dataObject->sections as $value) {
            echo "<h5 class='fw-bold py-2'>" . $value->sectionTitle . "<h5 />";
            echo "<p class='fs-6'>" . $value->sectionDescription . "</p>";

            echo "<ul class='fs-6 ps-5'>";
            foreach ($value->list as $listItem) {
                echo "<li class='pt-3'>" . $listItem->content . "</li>";
                echo "<ol class='fs-6 py-1 ps-5'>";
                foreach ($listItem->sublist as $sublist) {
                    echo "<li class='py-1'>" . $sublist . "</li>";
                }
                echo "</ol>";
            }
            echo "</ul>";
        }
    }
}
