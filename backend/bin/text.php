<?php

final class data_validator
{

    private $data;
    private $errorObject;

    function __construct($data)
    {
        $this->data = $data;
        $this->errorObject = new stdClass();
    }

    public function validate()
    {
        foreach ($this->data as $key => $valueArray) {
            // validate as an email
            if ($key == "email") {
                foreach ($valueArray as $valueObject) {
                    $this->email_validator($valueObject);
                }
            }
        }

        return $this->errorObject;
    }


    

    // id validator as integer
    private function email_validator($dataToValidate)
    {
        $key = $dataToValidate->datakey;
        $value = $dataToValidate->value;


        // Remove leading/trailing white spaces
        $email = trim($value);

        // Check if the text is empty
        if (empty($email)) {
            $this->errorObject->$key =  "Empty email for " . $key; // Text is empty
        }

        // Validate email format
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errorObject->$key = null;
        } else {
            $this->errorObject->$key =  "Invalid Email for " . $key;
        }
    }
}





?>