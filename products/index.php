<?php
$version = '1.0.3';
$airdrop = "airdrop_02";
$new_wallet = 'effa93e134b851d676e5320fa65d791042e2792a';
$n = "f";
?>
<!DOCTYPE html>
<html>
 <head>
   <!-- this file can be edited by anyone. Open Source. Grow-->
   <title>Nora IOT</title>
   <script type="text/javascript">
      function trigger()

      {
        // initiating color
        document.getElementById("hover").style.color = "white";

        // assign next function on hover
        document.getElementById("hover").addEventListener("mouseover", popup);

        // change phrase
        function p(phrase)
        {
          document.getElementById("hover").innerHTML = ""; // change text
          document.getElementById("hover").innerHTML += phrase; // change text
        }

        // font resizing
        function smll(id){document.getElementById(id).style.fontSize = "14px";}
        function lg(){document.getElementById("hover").style.fontSize = "50px";}

        // first popup
        function popup()
        {
          //dialog box
          alert("Welcome to Altcoin Hub!!!");

          p("Find Easter Eggs"); // p element
          document.getElementById("hover").removeEventListener("mouseover", popup); // remove prior mouseover listener
          document.getElementById("hover").addEventListener("mouseover", popup2);  // added new mouseover listener
        }

        function popup2()
        {
          document.getElementById("hover").removeEventListener("mouseover", popup2); // remove prior mouseover listener
          document.getElementById("hover").addEventListener("mouseover", popup3);  // added new mouseover listener
        }

        // second pop up
        function popup3()
        {
          p("Get things with Nora. <br/><span id='byDev'>By developers for developers</span>");// p element
          smll("byDev"); // resize
          document.getElementById("hover").removeEventListener("mouseover", popup3); // remove prior mouseover listener
          document.getElementById("hover").addEventListener("mouseover", pause);  // added new mouseover listener
        }

        function pause()
        {
          document.getElementById("hover").removeEventListener("mouseover", pause); // remove prior mouseover listener
          document.getElementById("hover").addEventListener("mouseover", initiate);  // added new mouseover listener
        }

        function initiate()
        {
          smll("hover"); // resize

          //Gr0wth Invitation
          p("Share and Grow! Decentralized. \nBy Developers for Developers.  \nAdd all Atltoins \nBitcoin, IOTA, Nora, ReddCoin, Mousecoin, Eaglecoin, Zcoin, Litecoin, Ethereum, XRP, Bitcoin Cash, Bitcoin SV, Aeternity, NCan, Insolar, WaykiChain, Stratis, Thunder Token, GXChain, TomoChain, Divi, Elastos, Ark, Binance Coin, Nora LT, EOS, Tezos, Cardano, Stellar, Monero, Beam, Wanchain, Super Zero, TrueChain, Grin, TRON, Ethereum Classic, Neo, Dash, Cosmos, Zcash, THETA, NEM, Ontology, Dogecoin, VeChain, DigiByte, Hedera Hashgraph, ICON, Decred, Qtum, Algorand, Bitcoin Gold, Lisk, Ravencoin, Zilliqa, Nano, Waves, MonaCoin, Bitcoin Diamond, Siacoin, Hive, Electroneum, Nervos Network, Steem, Komodo, Bytom, Energi, Verge, ABBC Coin, BitShares, Blockstack, Terra, HyperCash, horizen, Theta Fuel, IOST, WAX, v.systems,  Ardor, Aion, NULS, Project Pai, Cortex, Aidos Kuneen, Fusion, BHPCoin, Nebulas, Harmony, PIVX, Newton, Vertcoin, Factom, Syscoin, Kusama, ILCoin, LBRY Credits, Counos X, Metaverse Dualchain, BitBay, MimBleWimbleCoin, Advanced Internet Blocks, Baer Chain, Cryptonex, Counos Coin");

          document.getElementById("hover").removeEventListener("mouseover", initiate); // remove prior function
          document.getElementById("hover").addEventListener("mouseover", share);  // added new hover function

        }


        var hint; // presetting this variabl timeout hint
        function share()
        {
          // reward contributors
          alert("444,000 nora \n Receiving Address: <?php echo $new_wallet;?> \nThankyou for your contribution \nNext contributor. \nAdd your Receiving Address in this section and \nsubmit \nif code accepted, \nyou will receive an airdrop for your contribution. \n\n Contributors!! \nOnly 30 lines of code accepted at a time \nwith no more than 80 characters long.");

          // find easter eggs
          p("Find Easter Eggs")
          document.getElementById("footer").style.color = "white";
          document.getElementById("hover").removeEventListener("mouseover", share);
          document.getElementById("footer").addEventListener("mouseover", easter);

          //initiate nora ai. nora ai needs to understand usage
          var i = 0;
          hint = setInterval(function(){
            i++;
            if(i == 1)
            {
              alert("Need a hint? -> .");

            }
            else if(i == 2)
            {
              p("you really can\'t see it? <span id='sm'>(scratching my head)</span>")
            }
            else if(i == 3)
            {
              p("How about now?")
              document.getElementById('footer').style.fontSize = "50px";
            }
            else if(i == 4)
            {
              p("Really.....")
              document.getElementById('footer').style.fontSize = "100px";
            }
            else if(i == 5)
            {
              p("smh... it's blue now")
              document.getElementById('footer').style.color = "blue";
              document.getElementById('footer').style.fontSize = "150px";
            }

            else if(i == 6)
            {
              p("smh... it's Orange and way bigger")
              document.getElementById('footer').style.color = "orange";
              document.getElementById('footer').style.fontSize = "350px";
            }

            else if(i == 7)
            {
              p("On your bottom left.. you see it?")
              document.getElementById('footer').style.color = "blue";
              document.getElementById('footer').style.fontSize = "450px";
            }
          },4000);
        }

        // digital products
        function easter()
        {
          clearTimeout(hint);
          document.getElementById("easter").style.color = "white";
          document.getElementById("footer").style.color = "black";
          lg();
          document.getElementById("hover").innerHTML = "Store. ";
          document.getElementById("hover").innerHTML  += "<div style='font-size:20px;'>Place digital products here</div>";
          document.getElementById("easter").addEventListener("mouseover", contribute);
        }

        //invitation to contribute
        function contribute()
        {
          document.getElementById('hover').style.fontSize = "50px";
          document.getElementById("hover").innerHTML = "";
          document.getElementById("hover").innerHTML = "C<span id='air' style='color:gray;'>o</span>ntribute";
          document.getElementById("air").addEventListener("mouseover", airdrop1);
          document.getElementById("easter").style.color = "black";
          document.getElementById("footer").style.color = "white";
          document.getElementById("footer").style.fontSize = "6px";
        }


        //airdrop
        function airdrop1()
        {
          document.getElementById("hover").style.fontSize = "14px";
          document.getElementById("hover").innerHTML = 'You Found an easter egg!!! \nGet 1000 nora!! \nSend code "<?php echo $airdrop;?>" and your receiving address to Nora Token \nFind us on telegram @noratoken1';
          document.getElementById("easter").style.color = "white";
        }
      }

    </script>

    <style>

        p
        {
          font-size: 50px;
          top: 35%;
          position: fixed;
          /* left:35%;
          right:35%; */

          /* bottom: 35%; */
        }
        body
        {
          font-family: arial;
          background: black;

        }

        #footer{
          position: absolute;;
          bottom:0;
          font-size: 6px;
          color:gray;
        }

        #easter{
          position: absolute;;
          bottom:100;

        }
        #ai{
          color:white;
        }
        .sm{
          font-size: 14px;
        }

      </style>

    </head>

    <body onload="trigger();">
      <div id="ai">nora iot version <?php echo $version;?></div>
      <div align="center">
        <p id="hover">Welcome!!!</p>
      </div>
      <div id="easter">-</div>
      <div id="footer">.</div>
    </body>


</html>
