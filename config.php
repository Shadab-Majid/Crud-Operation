<?php

$servername="localhost";
$username="root";
$password="";
$databasename="myshop";
// CREATE A CONNECTION 
$connection = new mysqli($servername, $username, $password, $databasename);

$name = "";
$email = "";
$phone = "";
$address = "";
$errorMessage = "";
$successMessage = "";
