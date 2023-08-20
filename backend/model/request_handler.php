<?php

class request_handler
{
    // validate the request methods
    // post
    private static function isPostMethod()
    {
        return ($_SERVER["REQUEST_METHOD"] === "POST") ? true : false;
    }

    // get
    private static function isGetMethod()
    {
        return ($_SERVER["REQUEST_METHOD"] === "GET") ? true : false;
    }

    // check for the existant of the given request method parameters
    public static function postMethodHasError(...$variables)
    {
        if (self::isPostMethod()) {
            foreach ($variables as $value) {
                if (!isset($_POST[$value]) || empty(trim($_POST[$value]))) {
                    return "invalid request method parameters";
                }
            }
        } else {
            return "invalid method";
        }
    }

    public static function getMethodHasError(...$variables)
    {
        if (self::isGetMethod()) {
            foreach ($variables as $value) {
                if (!isset($_GET[$value]) || empty(trim($_GET[$value]))) {
                    return "invalid request method parameters";
                }
            }
        } else {
            return "invalid method";
        }
    }
}
