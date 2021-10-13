<?php
class walletconnect{
  function __construct(){
    $db = new db("nora");
    $db = $db->db();
    $this->db = $db;

  }
  function duplicate($receiving){

    $q = "SELECT receiving FROM norastore_wallet";
    $s = $this->db->prepare($q);
    $s->execute();
    $s->store_result();
    $c = $s->num_rows();
    $s->close();
    return $c;

  }


  function register($status){

    switch ($status) {
      case '0':

        $q = "INSERT INTO norastore_wallet (ui, receiving, date) VALUES(?,?,?)";
        $s = $this->db->prepare($q);
        $s->bind_param("sss", $ui, $receiving, $reg);
        $s->execute();
        $s->close();

        // lets register it

        break;

      default:
        // code...
        break;
    }

    if($c == 1){
      $_SESSION["walletconnect"] = "error";
      return "error";
    }else{


      $q = "SELECT ui FROM norastore_wallet WHERE receiving = ?";
      $s = $this->db->prepare($q);
      $s->bind_param("s", $receiving);
      $s->execute();
      $s->store_result();
      $c = $s->num_rows();
      echo "found: $c<br/>";
      $s->close();
    }
  }

  function createdWallet(){
    if(isset($_SESSION["walletconnect"])){
      $status = $_SESSION["walletconnect"];
      return $status;
    }else{

      $status = 0;


      return $status;
    }
  }
}

?>
