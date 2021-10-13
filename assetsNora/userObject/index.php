<?php
class user{
  function __construct($userTable){
    $db = new db("nora");
    $db = $db->db();
    $this->db = $db;


    // Check connection
    if (mysqli_connect_errno()){
      echo "Failed to connect to db: " . mysqli_connect_error();
    }

    // Create session table
    $create_table = "CREATE TABLE IF NOT EXISTS `$userTable"."_sess` (
     `id` int(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `orderid` varchar(200) NOT NULL,
     `date` varchar(200) NOT NULL
    )";
    // Execute query
    if(mysqli_query($db, $create_table)){

    }else{
      echo "Error creating table: " . mysqli_error($db);
    }



    // Create confirm email table
    $create_table = "CREATE TABLE IF NOT EXISTS `$userTable"."_econfirm` (
     `id` int(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `email` varchar(200) NOT NULL,
     `comfirmed` varchar(200) NOT NULL,
     `date` varchar(200) NOT NULL
    )";
    // Execute query
    if(mysqli_query($db, $create_table)){

    }else{
      echo "Error creating table: " . mysqli_error($db);
    }



    // Create table
    $create_table = "CREATE TABLE IF NOT EXISTS `$userTable"."_login` (
     `id` int(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `ui` varchar(200) NOT NULL,
     `orderid` varchar(200) NOT NULL,
     `date` varchar(200) NOT NULL
    )";
    // Execute query
    if(mysqli_query($db, $create_table)){

    }else{
      echo "Error creating table: " . mysqli_error($db);
    }



    // Create table
    $create_table = "CREATE TABLE IF NOT EXISTS `$userTable"."_username` (
     `id` int(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `ui` varchar(200) NOT NULL,
     `username` varchar(200) NOT NULL,
     `date` varchar(200) NOT NULL
    )";
    // Execute query
    if(mysqli_query($db, $create_table)){

    }else{
      echo "Error creating table: " . mysqli_error($db);
    }



    // Create email table
    $create_table = "CREATE TABLE IF NOT EXISTS `$userTable"."_email` (
     `id` int(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `ui` varchar(200) NOT NULL,
     `email` varchar(200) NOT NULL,
     `date` varchar(200) NOT NULL
    )";
    // Execute query
    if(mysqli_query($db, $create_table)){

    }else{
      echo "Error creating table: " . mysqli_error($db);
    }



    // Create table
    $create_table = "CREATE TABLE IF NOT EXISTS `$userTable"."_p` (
     `id` int(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `ui` varchar(200) NOT NULL,
     `pass` varchar(200) NOT NULL,
     `date` varchar(200) NOT NULL
    )";
    // Execute query
    if(mysqli_query($db, $create_table)){

    }else{
      echo "Error creating table: " . mysqli_error($db);
    }

    // Create table
    $create_table = "CREATE TABLE IF NOT EXISTS `$userTable"."_wallet` (
     `id` int(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
     `ui` varchar(200) NOT NULL,
     `receiving` varchar(200) NOT NULL,
     `date` varchar(200) NOT NULL
    )";
    // Execute query
    if(mysqli_query($db, $create_table)){

    }else{
      echo "Error creating table: " . mysqli_error($db);
    }

  }


  function salt($data){
    $return = hash("sha256",$data[0]."norastoresalt".$data[1]);
    return $return;
  }

  function createUi($data){
    $return = hash("sha256",$data[0].$data[1].$data[2]);
    return $return;
  }

  function status($orderId){
    // check if the orderid has been logged in.
    // if order id is not in database, then not logged in
    $q = "SELECT ui FROM norastore_login WHERE orderid = ?  ";
    $s = $this->db->prepare($q);
    $s->bind_param("s", $orderId);
    $s->execute();
    $s->store_result();
    $n = $s->num_rows();
    if($n > 0){
      $s->bind_result($ui);
      $s->fetch();
      $loggedIn[] = $ui;
      // $loggedIn[] = "133";
      // get username
      $q1 = "SELECT username FROM norastore_username WHERE ui = ?";
      $s1 = $this->db->prepare($q1);
      $s1->bind_param("s", $ui);
      $s1->execute();
      $s1->store_result();
      if($s1->num_rows()){
        $s1->bind_result($username);
        $s1->fetch();
        $loggedIn[] = ucwords($username);
      }else{
        $loggedIn[] = "no name";
      }


      // get wallet Balance
      $q1 = "SELECT receiving FROM norastore_wallet WHERE ui = ?";
      $s1 = $this->db->prepare($q1);
      $s1->bind_param("s", $ui);
      $s1->execute();
      $s1->store_result();
      if($s1->num_rows()){
        $s1->bind_result($cidw);
        $s1->fetch();
        $loggedIn[] = $cidw;
      }else{
        $loggedIn[] = "no wallet";
      }
      $s1->close();

      return $loggedIn;
    }else{
      $loggedIn[] = 0;
      return $loggedIn;
    }
  }
  function loginDiv(){
    ?>
    <div class="container-fluid row" >
      <div class="col-md-4"></div>
      <div class="col-md-4 d" id="loginForm" style="padding:25px;">
        <div align="right" class="closeLoginForm"><img src="img/close_x.png" width="40px;"></div>
        <h3>Login</h3>
        <div class="result"></div>
        <input name="email" class="form-control" id="emailLogin" placeholder="enter email">
        <input type="password" name="password" class="form-control" id="passwordLogin" placeholder="enter password">
        <button class="form-control btn btn-primary" id="loginBtn">login</button>
        <div align="right" style="color:royalblue;padding:12px;" class="createAccount">create an account</div>
      </div>
      <div class="col-md-4 d" id="createForm" style="padding:25px;">
        <div align="right" class="closeLoginForm"><img src="img/close_x.png" width="40px;"></div>
        <h3>Create Account</h3>
        <div class="result"></div>
        <input name="user" class="form-control" id="userCreate" placeholder="enterusername">
        <input name="email" class="form-control" id="emailCreate" placeholder="enter email">
        <input type="password" name="password" class="form-control" id="passwordCreate" placeholder="enter password">
        <button class="form-control btn btn-primary" id="createBtn">create account</button>
        <div align="right" style="color:royalblue;padding:12px;" class="alreadyAccount">already have an account?</div>
      </div>
    </div>
    <script>
      var loginLink = $("#loginNavbar").html('<span id="loginLink" class="loginLink"><button class="btn btn-primary">login</button></span>');
      $(".loginLink").click(function(){
        // undisplay elements
        $("#createForm").hide()
        $("#totalProductsAvail").hide();
        $(".productAd").hide();
        $(".secondary").hide();
        $(".productAdCloseBtn").hide();
        $(".productDetailsDiv").hide(300);
        //display
        $("#loginForm").show(300)
      })


      $(".createAccount").click(function(){
        $(".result").text("");
        $("#loginForm").hide();
        $("#createForm").show(300);
      })
      $(".alreadyAccount").click(function(){
        $(".result").text("");
        $("#createForm").hide();
        $("#loginForm").show(300);
      })

      $(".closeLoginForm").click(function(){
        $(".adBox").show(300)
        $(".secondary").hide();
        $("#loginForm").hide();
        $("#createForm").hide();
        $("#totalProductsAvail").show(300);
        $(".productAd").show(300);
        $(".buysellh3").show(300);
      })
      $("#loginBtn").click(function(){
        var email = $("#emailLogin").val();
        var pass = $("#passwordLogin").val();
        var parent = "loginForm";
        // var validate = new validation;
        // validate = validate->validateInput(loginForm);
        let inputsFound = $('#'+parent).find('input').length;
        if(inputsFound > 0){
          let parent1 = $('#'+parent).find('input').each(function(){

            if ($(this).val() == ''){
              $(this).css({'background':'yellow', 'border': '1px solid red'})
            }else{
              $(this).css({'background':'white', 'border': '1px solid #d2d2d2'})
              inputsFound--;

            }
          });

        }

        if(inputsFound == 0){
          $.ajax({
            url: "assetsNora/userObject/login.php",
            method: "post",
            dataType: "text",
            data:{email:email, pass:pass},
            success: function(e){
              $(".result").html(e);
            }
          })

        }
      })
      $("#createBtn").click(function(){
        var user = $("#userCreate").val();
        var email = $("#emailCreate").val();
        var pass = $("#passwordCreate").val();
        var parent = "createForm";
        // var validate = new validation;
        // validate = validate->validateInput(loginForm);
        let inputsFound = $('#'+parent).find('input').length;
        if(inputsFound > 0){
          let parent1 = $('#'+parent).find('input').each(function(){

            if ($(this).val() == ''){
              $(this).css({'background':'yellow', 'border': '1px solid red'})
            }else{
              $(this).css({'background':'white', 'border': '1px solid #d2d2d2'})
              inputsFound--;

            }
          });

        }

        if(inputsFound == 0){
          $.ajax({
            url: "assetsNora/userObject/createAccount.php",
            method: "post",
            dataType: "text",
            data:{user:user,email:email, pass:pass},
            success: function(e){
              $(".result").html(e);
            }
          })

        }
      })
    </script>
    <?php
  }
  function login($data){
    $db = $this->db;
    // check email
    $q = "SELECT ui from norastore_email WHERE email = ?";
    $s = $db->prepare($q);
    $s->bind_param("s", $data[0]);
    $s->execute();
    $s->store_result();
    $c = $s->num_rows();
    if($c > 0){
      $e = "email found";
      $s->bind_result($ui);
      $s->fetch();
    }else{
      $e = "email is not registered<br/> Please create an account";
      echo $e;
    }
    $s->close();

    // validated email next validate pass
    if($e == "email found"){
      $pass = [$data[0],$data[1]];
      $pass = $this->salt($pass);
      $q = "SELECT * from norastore_p WHERE ui = ? AND pass = ?";
      $s = $this->db->prepare($q);
      $s->bind_param("ss", $ui, $pass);
      $s->execute();
      $s->store_result();
      $c = $s->num_rows();
      if($c > 0){
        $q1 = "SELECT username FROM norastore_username WHERE ui = ?";
        $s1 = $this->db->prepare($q1);
        $s1->bind_param("s",$ui);
        $s1->execute();
        $s1->bind_result($username);
        $s1->fetch();
        $s1->close();

        //create login entry
        $date = date("l, M d Y h:i:s a");
        $q1 = "INSERT into norastore_login (ui, orderid, date) VALUES (?,?,?)";
        $s1 = $this->db->prepare($q1);
        $s1->bind_param("sss", $ui, $_SESSION["orderId"], $date);
        $s1->execute();
        $s1->close();

        $_SESSION["loggedIn"] = 1;
        $_SESSION["username"] = ucwords($username);

        ?>

        <script>
        var loginLink = $("#loginNavbar").html('<a href="logout.php"><span id="logoutLink">logout</span></a>');
        $("#loginForm").hide();
        $("#createForm").hide();
        $("#totalProductsAvail").show(300);
        $(".productAd").show(300);
        location.reload()
        </script>
        <?php
      }else{
        $e = "wrong email/password<br/>";
        echo $e;
      }
      $s->close();
    }
  }
  function createAccount($data){
    // set varables
    $ui = $this->createUi([$data[0],$data[1],$data[2]]);
    $pass = [$data[1],$data[2]];
    $pass = $this->salt($pass);

    $q = "INSERT INTO norastore_email (ui,email,date) VALUES (?,?,?)";
    // validate email is not in user
    $q = "SELECT * from norastore_email WHERE email = ?";
    $s = $this->db->prepare($q);
    $s->bind_param("s", $data[1]);
    $s->execute();
    $s->store_result();
    $c = $s->num_rows();
    if($c > 0){
      $e = "this email is registered<br/>Please login";
      echo $e;
    }else{
      $e = "email not found";
    }
    $s->close();

    //proceed to create account
    if($e == "email not found"){
      $date = date("l, M d Y h:i:s a");
      $data[0] = strtolower($data[0]);
      $q = "INSERT INTO norastore_username (ui, username, date) VALUES (?,?,?)";
      $s = $this->db->prepare($q);
      $s->bind_param("sss",$ui, $data[0], $date);
      $s->execute();
      $s->close();

      $q = "INSERT INTO norastore_email (ui, email, date) VALUES (?,?,?)";
      $s = $this->db->prepare($q);
      $s->bind_param("sss",$ui, $data[1], $date);
      $s->execute();
      $s->close();

      $q = "INSERT INTO norastore_p (ui, pass, date) VALUES (?,?,?)";
      $s = $this->db->prepare($q);
      $s->bind_param("sss",$ui, $pass, $date);
      $s->execute();
      $s->close();




      echo "account successfully created";

      // $q = "SELECT * from norastore_pass WHERE ui = ? AND pass = ?";
      // $s = $this->db->prepare($q);
      // $s->bind_param("ss", $ui, $pass);
      // $s->execute();
      // $s->store_result();
      // $c = $s->num_rows();
      // if($c > 0){
      //   $e = "login";
      // }else{
      //   $e = "wrong email/password<br/>";
      //   echo $e;
      // }
      // $s->close();
    }
  }
  function logoutDiv(){
    ?>

    <script>
      var loginLink = $("#loginNavbar").html('<a href="logout.php"><button class="btn btn-primary"><span id="logoutLink">logout</span></button></a>');
      $("#loginLink").click(function(){
        // undisplay elements
        $("#totalProductsAvail").hide();
        $(".productAd").hide();
        $(".productAdCloseBtn").hide();
        //display
        $("#loginForm").show(300)
      })
    </script>
    <?php
  }
}

?>
