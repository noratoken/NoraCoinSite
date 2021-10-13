<?php
if(isset($_GET["errors"])){
  error_reporting(E_ALL);ini_set("display_errors",1);
}else{
  error_reporting(0);ini_set("display_errors",0);
}
class noraNavbar{

  function navbar($volume){

    $validateServer = $_SERVER["SERVER_NAME"];

    switch ($validateServer) {
      case 'localhost':
        $sushi = "";
        $roadmap = "roadmap.php";
        $powerUpLink = "../power-up";
        $more = "more.php";
        $home = "index.php";
        $explorer = '../noracoin.info';
        $classicWallet = '../oldFiles/noracoin.site/pipeline.php';
        break;

      default:
        $sushi = "https://app.sushi.com/swap?inputCurrency=0x87d96bB73be64457d06a6cE455742B1CD6FD5eE8";
        $roadmap = "https://noracoin.site/launch/roadmap.php";
        $powerUpLink = "https://noracoin.site/power-up";
        $more = "https://noracoin.site/launch/more.php";
        $home = "https://noracoin.site/launch";
        $explorer = 'https://noracoin.info';
        $classicWallet = "https://noracoin.site/pipeline.php";

        break;
    }

    switch ($volume) {
      case '1':
        // hide volume tab
        $moreTab = "";
        break;

      default:
        // show volume tab
        $moreTab = '<li class="nav-item">
          <a class="nav-link" href="'.$more.'">more</a>
        </li>';
        break;
    }
?>
    <nav class="navbar navbar-expand-md navbarColor container-fluid">
     <!-- Brand -->
     <a class="navbar-brand" href="<?php echo $home;?>"><div style="width:80px"><img src="assetsNora/logoObject/noraLogoBlack.png" class="img-fluid"> <?php if(isset($_SESSION["username"])){echo "Welcome " .$_SESSION["username"];}?></div></a>

     <!-- Toggler/collapsibe Button -->
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
       <style>



       </style>
       <span class="navbar-toggler-icon"></span>
     </button>

     <!-- Navbar links -->
     <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
       <ul class="navbar-nav">

         <!--
         <li class="nav-item">
           <a class="nav-link" href="<?php echo $powerUpLink;?>">power-up</a>
         </li> -->

         <!-- <li class="nav-item">
           <a class="nav-link" href="<?php echo $classicWallet;?>">classic wallet</a>
         </li> -->
         <li class="nav-item d">
           <a class="nav-link" href="https://t.me/noratoken1">telegram</a>
         </li>
         <li class="nav-item d">
           <a class="nav-link" href="https://twitter.com/tokennora">twitter</a>
         </li>
         <li class="nav-item d">
           <a class="nav-link" href="#" id="navbarAddProduct"><button class="btn btn-primary">sell things</button></a>
         </li>
         <li class="nav-item d  ">
           <a class="nav-link navbarWallet" href="#" id="navbarWallet"><button class="btn btn-primary" id="navbarWalletBtn">create wallet</button></a>
         </li>
         <li class="nav-item d">
           <a class="nav-link navbarSmartChain " href="#" id="navbarSmartChain"><button class="btn btn-primary">Ethereum-NRT Smart Chain</button></a>
         </li>
         <li class="nav-item">
           <a class="nav-link" id="loginNavbar">login/logout</a>
         </li>
         <!-- <li class="nav-item">
           <a class="nav-link" href="<?php echo $explorer;?>">explorer</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="https://github.com/noratoken">github</a>
         </li> -->
         <!-- <li class="nav-item">
           <a class="nav-link" href="https://t.me/NoraAirdrop">airdrop</a>
         </li> -->
         <!-- <li class="nav-item">
           <a class="nav-link" href="<?php echo $sushi;?>">buy Nora Fuel</a>
         </li> -->
        <?php // echo $moreTab;?>

       </ul>
     </div>
    </nav>
<?php


  }
}


 ?>
