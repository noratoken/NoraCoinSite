<?php
//TEST COMMENT DELETE AFTER COMMIT
error_reporting(E_ALL);ini_set("display_errors",1);

session_start();
//assets
$directory    = 'assetsNora';
$folder = array_slice(scandir($directory), 2);
foreach($folder as $fname) {
    require_once("$directory/$fname/index.php");
}
//css
startBootstrap();
if(isset($_GET["logout"])){
  session_destroy();
  header("location:index.php");
}
//navbar
$navbar = new noraNavbar;
$navbar->navbar(0);
// set order id
$orderId = new orderId;
$orderId = $orderId->id();
$db = new db("nora");
$db = $db->db();

//connect
$user = new user("norastore");
$loggedIn = $user->status($orderId);
switch ($loggedIn[0]) {
  case 0:
    $user->loginDiv();
    break;

  default:
    $user->logoutDiv();
    $wallet = new walletconnect;
    //get new wallet session variable
    $createdWallet = $wallet->createdWallet();
    //prepare | check if there is any session varible wallet duplicates
    $duplicate = $wallet->duplicate($createdWallet);

    break;
}
//adbox

$carousel = new carousel;
$carousel->carousel1();

?>

<div class="container-fluid">

<?php
if($loggedIn[0] != 0){

  if($loggedIn[2] == "no wallet"){
    ?>
    <?php
  }
}
$products = new products;
$ethPrice = $products->ethPriceFetch();
$btcPrice = $products->btcPriceFetch();
$products->store();
?>
</div>
<?php
$nrt = new nrt;
$nrt->walletReady();


?>
<script>
$(".loginLink1").click(function(){
  $(this).html("must login");
  $(this).css("background","gray");
  $(this).css("border","1px solid gray");
})
$(".productAd").click(function(){
  $(".adBox").hide();

  //get this id property
  var id = $(this).attr("id");
  // prepare id property
  id  = id.replace("productAd_", "");

  // undisplay elements
  $("#totalProductsAvail").hide();
  $(".productAd").hide();
  $(".productAdCloseBtn").hide();

  //display elements
  $("#productAdCloseBtn_"+id).show();
  $(".productDetailsDiv_"+id).show(300);


})
$(".productAdCloseBtn").click(function(){
  $(".adBox").show(300);
  // undisplay elements
  $(this).hide();
  $(".productDetailsDiv").hide(300);
  // display elements
  $("#totalProductsAvail").show(300);
  $(".productAd").show(300);

})

$(".buyProduct").click(function(){

  var id = $(this).attr("id");
  id = id.replace("buyProduct_", "");
  //undisplay and display next
  $("#productDetailsDiv_"+id).hide();
  $("#payProduct_"+id).show(300);

})
$(".payProductBtn").click(function(){
  $(".productDetailsDiv").hide();

  var id = $(this).attr("id");
  id = id.replace("payProductBtn_", "");
  console.log("id: "+id)

  $.ajax({
    url: "market/pR44.php",
    method: "post",
    dataType: "text",
    data:{id:id},
    success:function(e){
      $("#pR44").html(e);
    }
  })
})
</script>
