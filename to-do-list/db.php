<?php
// Load .env variables
require __DIR__.'/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$servername = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//check connection OO

if ($conn->connect_error) {
    die ("Connection failed: ".$conn->connect_error);
}; 

/*else {
echo "Connected succesfully.";
};*/

?>