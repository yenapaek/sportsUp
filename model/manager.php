<?php

function dbConnect()
{
    $host = 'localhost';
    $dbName = 'sportsevent';
    $login = 'root';
    $pwd = ''; // MAC USER SHOULD PUT A PWD PROBABLY 'root'
    
    return new PDO("mysql:host=" . $host . ";dbname=" . $dbName . ";charset=utf8", $login, $pwd);
}
