<?php
error_reporting(E_ALL);ini_set("display_errors",1);
class nrt{
  function test(){
    ?>
    <script>


    </script>
    <?php

  }
  function getNrtBal($cidw){
    $q = "SELECT nora FROM Nora WHERE cidw = ? ORDER BY ID DESC LIMIT 1";
    $s = $db->prepare($q);
    $s->bind_param("s", $cidw);
    $s->execute();
    $s->store_result();
    $get_balance = $s->num_rows();
    if($get_balance > 0){
    	$s->bind_result($balance);
    	$s->fetch();
    	$balance = number_format($balance);
    }else{
    	$balance = "error";
    }
    $s->close();
    return $balance;
  }

  function receivingAddress($seed){
    $hash = "machine pays machine nora";
    $hash = sha1($hash);
    $hash .= " ";
    $receivingAddress = hash("sha256",$seed.$hash);
    return $receivingAddress;
  }

  function words(){
    // get contents of a file into a string
    $filename = "../../assetsNora/nrtObject/wordlist.txt";
    $rand = rand(0, 7776);
    $file = new SplFileObject($filename);
    // echo __line__;return;
    $file->seek($rand);
    return $file->current();
    // return $contents;

  }
  function noraHash(){
    $hash = "machine pays machine nora";
    $hash = sha1($hash);
    $hash .= " ";
    return $hash;
  }




  function newBlockchain($transid){
    $db = new db("nora");
    $db = $db->db();
    $token_name = "Nora";
  }
  function createSeed(){


    $phrase[] = $this->words(); //1
    $phrase[] = $this->words(); //2
    $phrase[] = $this->words(); //3
    $phrase[] = $this->words(); //4
    $phrase[] = $this->words(); //5
    $phrase[] = $this->words(); //6
    $phrase[] = $this->words(); //7
    $phrase[] = $this->words(); //8
    $phrase[] = $this->words(); //9
    $phrase[] = $this->words(); //10
    $phrase[] = $this->words(); //11
    $phrase[] = $this->words(); //12
    // echo __line__;return;
    $recoveryPhrase = "
    <div class='container-fluid'>
    <div class='row'>
      <div class='col-md-12'>
        <img src='img/created.png' class='img-fluid'>
      </div>

    </div>
    </div>
    ".
    "<div class='' style='background:'>
    <br/><br/>
    <div class='phraseTable'>".

    "
    ".
      "<h3 align='center'>12 Word Recovery Phrase</h3>".
        "<div class='row' style='background:'>".
          "<div class='col-3 phraseBox'>#1<br/>$phrase[0]</div>
          <div class='col-3 phraseBox'>#2<br/>$phrase[1]</div>
          <div class='col-3 phraseBox'>#3<br/>$phrase[2]</div>
          <div class='col-3 phraseBox'>#4<br/>$phrase[3]</div>" .
        "</div>".
        "<div class='row'>".
          "<div class='col-3 phraseBox'>#5<br/>$phrase[4]</div> <div class='col-3 phraseBox'>#6<br/>$phrase[5]</div> <div class='col-3 phraseBox'>#7<br/>$phrase[6]</div> <div class='col-3 phraseBox'>#8<br/>$phrase[7]</div>" .
        "</div>".
        "<div class='row'>".
          "<div class='col-3 phraseBox'>#9<br/>$phrase[8]</div> <div class='col-3 phraseBox'>#10<br/>$phrase[9]</div> <div class='col-3 phraseBox'>#11<br/>$phrase[10]</div> <div class='col-3 phraseBox'>#12<br/>$phrase[11]</div>" .
        "</div>
        <div class='row' align='center'>
          <div  class='col-md-2'></div>
          <div  class='col-md-8'>
          <br/><br/>
            <img class='img-fluid' src='img/12phrase1.jpg' >
            <div class='y'>NOTE: WRITE THIS 12 WORD PHRASE SOMEWHERE SAFE. YOU CANNOT GET IT BACK IF YOU LOSE IT.</div>
          </div>
        </div>
      </div>
    </div>
    ";

    $c = count($phrase);
    $key = null;
    for($x = 0; $x < $c;$x++){
      $key .= $phrase[$x];
    }

    $seed = hash("sha256", $key);
    $new[] = $recoveryPhrase;
    $new[] = $key;
    $new[] = $seed;
    return $new;
  }
  function createWallet(){
    $db = new db("nora");
    $db = $db->db();
    $token_name = "Nora";


    $newSeed = $this->createSeed();
    // echo __line__;return;
    $q = "SELECT * FROM " . $token_name . " WHERE cidw = ?";
    $s = $db->prepare($q);
    $s->bind_param("s", $newSeed[2]);
    $s->execute();
    $s->store_result();
    $check = $s->num_rows();
    $s->close();

    // if key is already taken redo
    if($check > 0){
      $newSeed = $this->createSeed();
      $q = "SELECT * FROM " . $token_name . " WHERE cidw = ?";
      $s = $db->prepare($q);
      $s->bind_param("s", $newSeed[2]);
      $s->execute();
      $s->store_result();
      $check = $s->num_rows();
      $s->close();
    }

    // if key is already taken redo
    if($check > 0){
      $newSeed = $this->createSeed();
      $q = "SELECT * FROM " . $token_name . " WHERE cidw = ?";
      $s = $db->prepare($q);
      $s->bind_param("s", $newSeed[2]);
      $s->execute();
      $s->store_result();
      $check = $s->num_rows();
      $s->close();
    }


    // if it found key 3 times start again. show message
    if($check > 0){
      echo "please try again";

    }
    if($check == 0){

      // create new blockchain
      $q = "SELECT id, cidw, transid, nora, tsid FROM Nora ORDER BY ID DESC LIMIT 1";
      $s = $db->prepare($q);
      $s->execute();
      $s->store_result();
      $get = $s->num_rows();
      if($get > 0){

        $s->bind_result($id, $cidw, $transid, $nora, $tsid);
        $s->fetch();
        // create block chain
        $newBlockchain = hash("sha256", $id.$cidw.$transid.$nora.$tsid);
      }
      $s->close();

      ## new wallet has zero token
      $createNewWalletBal = 0;

      ### create new wallet
      $tsid = date("M d Y h:i:s a");
      $tsid = strtotime($tsid);

      ##process cidw
      $cidw = hash("sha256", $newSeed[2]);

      //blockchain has to include new entties

      $q1 = "INSERT INTO Nora (cidw, transid, nora, tsid) VALUES (?,?,?,?)";
      $s = $db->prepare($q1);
      $s->bind_param("ssss", $cidw, $newBlockchain, $createNewWalletBal, $tsid);
      if($s->execute()){
        // echo "success";
      }else{
        // echo "error";
      }
      $s->close();

      // nora hash


      $key = $newSeed[2];
      $count = strlen($key);
      $key = "
      <div class='row' align='center'>
          <div  class='col-md-2'></div>
          <div  class='col-md-8'>
          <h3>Your SEED</h3>
          <code style='background:var(--color1)'>$key</code>
          <br/><br/>
            <img class='img-fluid' src='img/12phrase.jpg' >
            <div class='y'>
              NOTE: WRITE/SAVE THIS SEED SOMEWHERE SAFE. YOU CANNOT GET IT BACK IF YOU LOSE IT.
            </div>
          </div>
      </div>
      ";
      $keyD1 = "<div class='topBlock'><div class=' phraseTable'>";
      $keyD2 = "</div></div>";

      $seedBox = $keyD1.$key.$keyD2;


      $receivingAddress = $this->receivingAddress($newSeed[2]);
      $blockchainAddress = hash("sha256", $receivingAddress);
      $bin2hex = bin2hex($receivingAddress);
      $hex2bin = hex2bin($receivingAddress);
      $str2bin = hex2bin("aea19e");


      $_SESSION["walletconnect"] = $receivingAddress;
      $return[] = $newSeed[0];
      $return[] = $newSeed[1];
      $return[] = $seedBox;
      $return[] = $newSeed[2]; //seed
      $return[] = $receivingAddress; //walletAddress
      $return[] = $bin2hex; //binary
      $return[] = $hex2bin; //binary
      $return[] = $str2bin; //binary
      $return[] = $blockchainAddress; //binary
      // $return[] = $base_convert; //binary

      return $return;
    }
  }


  #### random string script =========================================================
  function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'){
    $pieces = [];
    $max = strlen($keyspace) - 1;
    for ($i = 0; $i < $length; ++$i) {
      $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
  }

  function walletReady(){
    ?>
    <div id="walletReadyDiv"></div>
    <script>

    $(".navbarWallet").click(function(){
      $.ajax({
        url: "assetsNora/nrtObject/createWallet.php",
        success:function(e){
          $(".adBox").hide();
          $(".productDetailsDiv").hide()
          $("#totalProductsAvail").hide();
          $(".productAd").hide();
          $(".productAdCloseBtn").hide();
          $("#loginForm").hide()
          $("#createForm").hide();
          $("#walletReadyDiv").hide();
          $("#walletReadyDiv").html(e);
          $("#walletReadyDiv").show(300);
        }
      })
    })
    </script>
    <?php
  }

}

?>
