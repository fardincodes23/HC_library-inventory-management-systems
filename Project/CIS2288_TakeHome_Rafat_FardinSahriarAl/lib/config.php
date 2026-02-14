<?php
/**
 * Filename: lib/config.php
 * @author:   Fardin
 * @since:    Dec 10, 2025
 * Purpose:  Database connection configuration.
 */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'books');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>