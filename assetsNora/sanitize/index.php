<?php
error_reporting(E_ALL);ini_set("display_errors",1);
class validation{



  function sanitize($var){
    $var = trim(htmlentities(strip_tags($var)));
    return $var;
  }
  // working progess does not work
  function validate($var){
    if(!isset($_POST[$var])){
      return "$var cannot be empty";
    }
  }
}



?>
