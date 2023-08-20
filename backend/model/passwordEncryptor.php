<?php

class StrongPasswordEncryptor
{
    // Encryption method using SHA-256
    public static function encryptPassword($password)
    {
        $salt = bin2hex(random_bytes(16));
        $hash = hash('sha256', $password . $salt);
        return compact('hash', 'salt');
    }
}

class PasswordHashVerifier
{
    // Verifier using SHA-256
    public static function isValid($password, $salt, $hash)
    {
        return hash_equals(hash('sha256', $password . $salt), $hash);
    }
}

