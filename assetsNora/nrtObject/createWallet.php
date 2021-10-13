<?php
session_start();
// require "../../t.php";
//dependencies
require "../../assetsNora/dbObject/index.php";
require "../../assetsNora/nrtObject/index.php";


$nrt = new nrt;
$phrase = $nrt->createWallet();
$hash = $nrt->noraHash();
// $studyReceivingHash = $nrt->studyReceivingHash();

// exit;
?>

<div class="main">
<?php
echo $phrase[0];
// echo $phrase[1];
echo $phrase[2];

$_SESSION["walletconnect"] = $phrase[4];
?>
  <div class="walletPanel topBlock" align="center">

<?php
  $var = "loggedIn";
  if(isset($_SESSION[$var])){
    echo "loggedIn: ". $_SESSION[$var];
  }else{
?>
    <h3>What do do next</h3>
      <br/>
      <table class="table table-striped d">
        <tr>
            <td>phrase[3] seed</td>
            <td><?php echo $phrase[3];?></td>
        </tr>
        <tr>
            <td>phrase[4] receivingAddress [upgraded to sha256]</td>
            <td><?php echo $_SESSION["walletconnect"];?></td>
        </tr>
        <tr class="d review">
            <td>phrase[8]
              blockchainReceiving Adrees
              <br/>
            </td>
            <td><?php echo $phrase[8];?></td>
        </tr>


      </table>
      <button class='btn btn-primary addWalletNew'>create an account and add this wallet</button>
      <br/><br/>
      <button class='btn btn-primary addWallet'>login and add this wallet to my account</button>

<script>
  $(".addWallet").click(function(){
    $(".main").hide();
    $("#loginForm").show(300);
  })
  $(".addWalletNew").click(function(){
    $(".main").hide();
    $("#createForm").show(300);
  })
</script>
<?php
  }
?>
  </div>
</div>
