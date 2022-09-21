<?php
// DB credentials.
//constant variable -->1.defined using define function , 2. can be use without $, 3.cannot be changed ,4. accessed regardless of scope, 5.only be strings and numbers

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','curd');

// Establish database connection using pdo.
try
{
$connectDB = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS);
// ECHO "CONNECT SUCCESSFULLY" ;
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

$connectDB->query("CREATE TABLE IF NOT EXISTS Cars (
    CarID int AUTO_INCREMENT NOT NULL PRIMARY KEY ,
    `Image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    Model VARCHAR(30) NOT NULL,
    Price DECIMAL NOT NULL,
    color VARCHAR(30) NOT NULL)");


?>