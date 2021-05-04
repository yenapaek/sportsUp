<?php

function dbConnect()
{
    $host = 'localhost';
    $dbName = 'sportsevent';
    $login = 'root';
    $pwd = ''; // MAC USER SHOULD PUT A PWD PROBABLY 'root'
    try {
        return new PDO("mysql:host=" . $host . ";dbname=" . $dbName . ";charset=utf8", $login, $pwd);
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
}
