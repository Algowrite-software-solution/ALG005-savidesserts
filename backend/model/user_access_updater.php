<?php

class UseerAccess
{
    private $sessionVariable = "alg001_user";
    
    public function isLoggedIn()
    {
        return isset($_SESSION[$this->sessionVariable]);
    }

    public function login($userId)
    {
        $_SESSION[$this->sessionVariable] = $userId;
    }

    public function logout()
    {
        unset($_SESSION[$this->sessionVariable]);
    }

    public function getUserId()
    {
        if ($this->isLoggedIn()) {
            return $_SESSION[$this->sessionVariable];
        }
        return null;
    }
}
