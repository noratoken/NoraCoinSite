<?php
class logo{
  function circle(){
    ?>
    <img src="assetsNora/logoObject/noraSmLogo.png" class="ing-fluid">
    <?php
  }
  function main(){
    ?>
    <img src="assetsNora/logoObject/noraLogoBlack.png" class="ing-fluid">
    <?php
  }
  function eth($size){
    ?>
    <img src="assetsNora/logoObject/eth.png" class="ing-fluid" style="width:<?php echo $size;?>px">
    <?php
  }
  function btc($size){
    ?>
    <img src="assetsNora/logoObject/btc.png" class="ing-fluid" style="width:<?php echo $size;?>px">
    <?php
  }
  function nrt($size){
    ?>
    <img src="assetsNora/logoObject/noraSmLogo.png" class="ing-fluid" style="width:<?php echo $size;?>px">
    <?php
  }
  function nrtz($size, $color){
    ?>
    <img src="assetsNora/logoObject/nrtz<?php echo $color;?>.png" class="ing-fluid" style="width:<?php echo $size;?>px">
    <?php
  }
}


?>
