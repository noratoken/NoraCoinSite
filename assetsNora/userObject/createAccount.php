<?php
require "../dbObject/index.php";
require "../sanitize/index.php";
require "index.php";

$san = new validation;
if(!isset($_POST["user"])){echo "username cannot be empty";exit;}
if(!isset($_POST["email"])){echo "email cannot be empty";exit;}
if(!isset($_POST["pass"])){echo "password cannot be empty";exit;}

$user = $san->sanitize($_POST["user"]);
$email = $san->sanitize($_POST["email"]);
$pass = $san->sanitize($_POST["pass"]);

$create = new user("norastore");
$create = $create->createAccount([$user,$email,$pass]);
// echo $email;
// echo $pass;
?>
