<?php
session_start();
require "../dbObject/index.php";
require "../sanitize/index.php";
require "index.php";

$san = new validation;
if(!isset($_POST["email"])){echo "email cannot be empty";exit;}
if(!isset($_POST["pass"])){echo "password cannot be empty";exit;}

$email = $san->sanitize($_POST["email"]);
$pass = $san->sanitize($_POST["pass"]);

$login = new user("norastore");
$login = $login->login([$email,$pass]);
?>
