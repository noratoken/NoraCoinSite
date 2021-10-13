<?php
  class orderId{

    function id(){
      #orderId
      if(isset($_SESSION["orderId"])){
        $orderId = $_SESSION["orderId"];
      }else {
        $date = date("l, M d Y h:i:s a");
        $orderId = sha1($date.rand(1000,10000));
        $_SESSION["orderId"] = $orderId;
        $db = new db("nora");
        $db = $db->db();
        $q = "INSERT INTO norastore_sess (orderid, date) values (?,?)";
        $s = $db->prepare($q);
        $s->bind_param("ss",$orderId, $date);
        $s->execute();
        $s->close();

      }
      return $_SESSION["orderId"];
    }
    
  }

?>
