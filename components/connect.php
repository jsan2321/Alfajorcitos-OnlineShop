<?php
    $dsn = 'mysql:host=localhost;dbname=alfashop_db';
    $username = 'root';
    $password='abc123';

    $conn = new PDO($dsn, $username, $password);

    try {
        // Establishing a PDO connection
        $conn = new PDO($dsn, $username, $password);
        // Set PDO to throw exceptions on errors
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Error handling in case of connection failure
        echo "Connection failed: " . $e->getMessage();
        // Stop further execution if connection fails
        die();
    }

    function unique_id() {
        $chars='0123456789abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ';
        $charLength=strLen($chars);
        $randomString='';

        for ($i=0; $i<20; $i++) {
            $randomString.=$chars[mt_rand(0, $charLength - 1)];
        }
    
        return $randomString;
    }