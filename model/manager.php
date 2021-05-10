<?php

/**
 * dbConnect
 *
 * @return PDO connection
 */
function dbConnect()
{
    $host = '127.0.0.1';
    $dbName = 'sportsevent';
    $login = 'root';
    $pwd = ''; // MAC USER SHOULD PUT A PWD PROBABLY 'root'

    return new PDO("mysql:host=" . $host . ";dbname=" . $dbName . ";charset=utf8", $login, $pwd);
}
