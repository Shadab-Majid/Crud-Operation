<?php
if(isset($_GET["id"])){
$id=$_GET["id"];

$servername="localhost";
$username="root";
$password="";
$databasename="myshop";

// CREATE A CONNECTION 
$connection = new mysqli($servername, $username, $password, $databasename);
$sql = "DELETE FROM clients WHERE id=$id";
$connection->query($sql);


}
header("location:/crud_operation/index.php");
exit;
?>