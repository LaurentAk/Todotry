<?php
// connection.php
//$host = "localhost";
//$user = "root";
//$password = "";
//$dbname = "database db_enquiries";

$host = getenv('db_host');
$user = getenv('db_user');
$password = getenv('db_Pass');
$dbname = getenv('db_name');
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
