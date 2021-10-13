<?php
class products{

  function ethPriceFetch(){
    $site = $_SERVER["SERVER_NAME"];
    if($site != "localhost"){

      $str = file_get_contents('https://api.coinbase.com/v2/prices/ETH-USD/sell/');
      $str = json_decode($str,true);
      $str = $str["data"];
      $str = $str["amount"];
    }else{
      $str = "1";
    }
    return $str;

  }

  function btcPriceFetch(){
    $site = $_SERVER["SERVER_NAME"];
    if($site != "localhost"){
      $str = file_get_contents('https://api.coinbase.com/v2/prices/BTC-USD/sell/');
      $str = json_decode($str,true);
      $str = $str["data"];
      $str = $str["amount"];
    }else{
      $str = "1";
    }
      return $str;
  }

  function store(){
    $db = new db("nora");
    $db = $db->db();
    $q = "SELECT ui, name, image, short_desc, long_desc, nrtz, tsid FROM nora_product";
    $s = $db->prepare($q);
    $s->execute();
    $s->store_result();
    $available = $s->num_rows();
    echo "<div id='totalProductsAvail' class='' align='right'>
    Displaying $available products
    </div> ";
    if($s->num_rows() > 0){
      $s->bind_result($pUi, $pName, $pImage, $pShortDesc, $pLongDesc, $pNrtz, $pTsid);
      while($s->fetch()){


        $buyable = 1;
        // echo $pNrtz;
        ### create form to upload these products
        $this->addStoreProduct($pUi,$pImage, $pName, $pShortDesc, $pLongDesc, $pNrtz, $buyable);
      }

    }else{
      echo "Beta";
    }
    $s->close();

  }

  function addStoreProduct($pId,$image, $name, $desc, $long, $amt, $buyable){

    $long = nl2br($long);
    $desc = nl2br($desc);

   if($buyable == 0){
       $buyBtn = "You do not have enough nrtz for this transaction";
   }else{
     $buyBtn = "<div class='roundBtnsSm roundBtns wordBtn buyProduct' id='buyProduct_$pId'>buy </div>";

   }
   $buyBtn = "<div class='roundBtnsSm roundBtns wordBtn buyProduct' id='buyProduct_$pId'>here  </div>";
   $ui = rand(100, 31111);
  ?>
  <div align="right" class=" productAdCloseBtn  d" id="productAdCloseBtn_<?php echo $pId;?>"><img src='img/close_x.png' width="25px"  alt="close button"></div>

  <div class="row productAd  initialElement " id="productAd_<?php echo $pId; ?>">
    <div class="col-md-3" align="center">
      <div class="productImage" id="">
        <img src="products/<?php echo $image;?>" class="productImg img img-fluid" id="productImg_<?php echo $pId; ?>">
      </div>
    </div>
    <div class="col-md-6 productDescription" id="productDescription_<?php echo $ui;?>" align="center">
      <?php echo $desc;?>
    </div>
    <!-- left off here organizing the center of the div in order to center it -->
    <div class="col-md-3 productVal" id="productVal_<?php echo $ui;?>" align="center">
      <div class="resizePrice" id="resizePrice_<?php echo $ui;?>">
        <?php echo $amt;?>
        <img src="img/noraSmLogoWhiteStroke.png" class="img img-fluid" id="walletNrtzIcon_<?php echo $ui;?>" width="64px">
      </div>
      <script>
      var div = 'productVal_';
      var key = '#productVal_<?php echo $ui;?>';
      var height = $(key).height();
      var word = "word: " + height;
      setTimeout(function(){
        var descDiv="#productDescription_<?php echo $ui;?>";

        var divSel = "#"+div+"<?php echo $ui;?>";
        var h = $(divSel).height();
        var logo = $("#resizePrice_<?php echo $ui;?>").height();
        h = h + 64;
        h = h/3.5;
        // console.log(h)
        var padding = $(divSel).css("padding-top",h);
        var padding2 = $(descDiv).css("padding-top",h);

      }, 1);




      </script>
    </div>
  </div>
  <div class=" secondaryElement d productDetailsDiv productDetailsDiv_<?php echo $pId;?>" id="productDetailsDiv_<?php echo $pId;?>">

      <div class="row">
        <div class="col-md-12 longDescHead"  align="center">
          <img src="products/<?php echo $image;?>" class="productImg img img-fluid" id="productImgDetails_<?php echo $pId; ?>">
          <h3><?php echo $name;?></h3>



        </div>
        <div class="col-md-3"></div>
      </div>
    <div class="row">
      <div class="col-12 longDescDiv" align="center">
          <h3>Description</h3>
          <p class="descriptionBox">
          <?php echo $long;?>
          <br/>
          <br/>
          </p>
      </div>
      <div class="col-12 longDescHead" align="center">
          <h3>Price approx ($<?php echo $amt;?>)<h3>
          <?php
          if(isset($_SESSION["loggedIn"])){
            $loggedIn = 1;
          }else{
            $loggedIn = 0;
          }
          switch ($loggedIn) {
            case 0:
              // code...
            echo  "
            <script>
            $('.loginLink').click(function(){
              // undisplay elements
              $('.main').hide();
              $('.adBox').hide();
              $('.productAd').hide();
              $('.productAdCloseBtn').hide();
              $('.productDetailsDiv').hide(300);
              //display
              $('#loginForm').show(300)
            })
            </script>
            ";
              break;


          }

          $logo = new logo;


          ?>
          <div class="buyPriceSpan">
            <input id="nrt" class="d">
            <input id="nrtTo" class="d">
            <button class="btn btn-primary d">send Nora</button>
            <?php
            // getting nrt balance


            $nrtzWallet = "9b7a57f26162f373b96bb7eacc3fa21e30a6cf21";


            $tNe = rand(1,12);
            $tNe = $tNe % 6;
            $tNe = $tNe + $amt;
            $nrtzPay = $tNe;
            echo $nrtzPay;
            $logo->nrt("30", "White");
            echo "nrt";
            switch ($loggedIn) {
              case 1:
                echo " | <button class='btn btn-primary purchaseProduct_$pId' id='purchaseProduct_$pId'>send</button>";
                break;
              default:
              echo "  <button class='btn btn-primary loginLink1'>send</button>";
              break;
            }

            ?>
            <script>
              $(".purchaseProduct_<?php echo $pId;?>").click(function(){
                var id = $(this).attr("id");
                id = id.replace("purchaseProduct_", "");

                alert("under development");
              })
            </script>
          </div>
          <div class="buyPriceSpan d">
          <?php
          $tNe = rand(1,12);
          $tNe = $tNe % 7;
          $tNe = $tNe + $amt;
          $nrtPay = $tNe;
          echo $nrtPay;
          $logo->nrt("30");
          $nrtzWallet = sha1($nrtzWallet);
          echo "nrtz";
          switch ($loggedIn) {
            case 1:
              echo " | <button class='btn btn-primary'>send</button>";
              break;
            default:
            echo "  <button class='btn btn-primary loginLink1'>send</button>";
            break;
          }
           ?>
         </div>
          <div class="buyPriceSpan d">
            <?php
            $price = $this->ethPriceFetch();
            $ethPay = $amt/$price;
            echo $ethPay;
            $logo->eth("25");
            echo "eth";
            switch ($loggedIn) {
              case 1:
                echo " | <button class='btn btn-primary'>Ether-NRT SmartChain</button>";
                break;
              default:
              echo "  <button class='btn btn-primary loginLink1'>Ether-NRT SmartChain</button>";
              break;
            }
            ?>
          </div>
          <div class="buyPriceSpan d">
            <?php
            $price = $this->btcPriceFetch();
            $btcPay = $amt/$price;
            echo $btcPay;
            $logo->btc("25");
            echo "btc";
            switch ($loggedIn) {
              case 1:
                echo " | <button class='btn btn-primary'>BTC-NRT SmartChain</button>";
                break;
              default:
              echo "  <button class='btn btn-primary loginLink1'>BTC-NRT SmartChain</button>";
              break;
            }
            ?>
          </div><br/>
          <button class="btn btn-primary d">
            Don't have Nora. Use NRT SmartChain
          </button>
          <span class="d"><br/>
            Map <?php
            $tNe = rand(1,12);
            $tNe = $tNe % 7;
            $tNe = $tNe + 1000;
            echo $tNe;
            $logo->nrt("30");

            ?>
            tokens with Ethereum. <br/>
            Total:
            <?php
            $price = $this->ethPriceFetch();
            $price = $tNe/$price;
            echo $price;
            $logo->eth("20");
            ?>
            <br/>
            send eth liquidity to:<br/>
             0xCBc98644bA0ed02CC7aa59f7e7FC63C1F7F8e818 <br/>
          </span>


      </div>
    </div>

  </div>



  <div id="pR44"></div>


  <?php
  }

}



 ?>
