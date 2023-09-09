<?php

class SecurePasswordHandler
{
    // Encryption method using SHA-512
    public static function encryptPassword($password)
    {
        $salt = bin2hex(random_bytes(16));
        $hash = hash('sha512', $password . $salt);
        return compact('hash', 'salt');
    }

    // Verifier using SHA-512
    public static function isValid($password, $salt, $hash)
    {
        return hash_equals(hash('sha512', $password . $salt), $hash);
    }
}

