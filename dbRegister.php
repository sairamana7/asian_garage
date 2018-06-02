<?php
  //print_r($_POST);
  session_start();
    //not empty
    //atleast 6 characters
    //Start the session
//session_start();

//Dump your POST variables
//$_SESSION['POST'] = $_POST;

    //all the values which are entered are stored in array

  //start validation
  $_SESSION['error']=false;

    if(empty($_POST['Rname']))
    {
      $_SESSION['Rname']="name cannot be empty";
      $_SESSION['error']=true;
    }
    if(empty($_POST['Rpassword']))
    {
      $_SESSION['Rpassword']="password cannot be empty";
      $_SESSION['error']=true;
    }
    if(empty($_POST['email']))
    {
      $_SESSION['email']="email cannot be empty";
      $_SESSION['error']=true;
    }
    if(empty($_POST['phone']))
    {
      $_SESSION['phone']="phone cannot be empty";
      $_SESSION['error']=true;
    }




    if(!empty($_POST['Rname'])&&!empty($_POST['Rpassword'])&&!empty($_POST['email'])&&!empty($_POST['phone']))
      {
          require_once "pdo.php";
        $sql="INSERT INTO users (name,email,phone,password) VALUES (:name,:email,:phone,:password)";

        //echo("<pre>\n".$sql."\n</pre>\n");
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array(
          ':name'=>$_POST['Rname'],
          ':email'=>$_POST['email'],
          ':phone'=>$_POST['phone'],
          ':password'=>$_POST['Rpassword']  ));


      }

      //reloading the entered values
      if(!$_POST)
      {
        $name = "";
        $phone = "";
        $pwd = "";
        $email = "";
      }
      else {
        $name = $_POST['Rname'];
        $phone = $_POST['phone'];
        $pwd = $_POST['Rpassword'];
        $email = $_POST['email'];
      }

 ?>
 //---------------------------------------------------------------------------------------------
 <html>
 <body>
<!--start fb login  -->
 <form method="post" target="">
   <h2>Old Customer Please LOGIN:</h2>
   <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=610323635983606&autoLogAppEvents=1';

  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="true" data-auto-logout-link="true" data-use-continue-as="true"></div>


<!-- botton end -->
<!-- linking code -->
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '610323635983606',
      cookie     : true,  // enable cookies to allow the server to access
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
<!--end  -->
   <input type="button"
   onclick="location.href='dbAutomobileLogin.php';return true;" value="Log In">
   <?php
   if($_SESSION['error']==false)
     {
       $_SESSION['Rsuccess']='SUCCESSFULLY REGISTERED';


       $name = "";
       $phone = "";
       $pwd = "";
       $email = "";

       $pdo=new PDO('mysql:host=localhost;port=3306;dbname=transaction','root','');
       $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       $table_name=$_POST['email'];
       //str_replace("@","",$table_name);
       //str_replace(".","",$table_name);

       $table_name=str_replace("@","",$table_name);   //removing predefined characters
       $table_name=chop($table_name,".com");
       //echo ($table_name);

     $create="CREATE TABLE $table_name(tran_id INT AUTO_INCREMENT PRIMARY KEY,
                                             time_of_order VARCHAR(30),
                                             manufacturer VARCHAR(30),
                                             model VARCHAR(30),
                                             cost VARCHAR(30),
                                             pay_mode VARCHAR(30),
                                             service_centre VARCHAR(30),
                                             parts_replaced VARCHAR(100),
                                             location_picked VARCHAR(30),
                                             location_droped VARCHAR(30),
                                             time_picked VARCHAR(30),
                                             time_droped VARCHAR(30));";
      $pdo->exec($create);

      //$_SESSION['error']==true;
      header('Location:dbAutomobileLogin.php');

     }
    ?>
   <h2>New to AUTOS  Please REGISTER:</h2>
   <p>User Name:
     <input type="text" name="Rname" size="40" value="<?= htmlentities($name)  ?>">  <p style="color:red"><?php if(isset($_SESSION['Rname']) && $_POST) { echo $_SESSION['Rname']; }  unset($_SESSION['Rname']); ?></p>
   </p>
   <p>Email:
     <input type="text" name="email" size="40" value="<?= htmlentities($email)?>">   <p style="color:red"><?php if(isset($_SESSION['email']) && $_POST) {echo $_SESSION['email']; } unset($_SESSION['email']); ?></p>
   </p>
   <p>Phone:
     <input type="text" name="phone" size="40" value="<?= htmlentities($phone)?>">    <p style="color:red"><?php if(isset($_SESSION['phone']) && $_POST) { echo $_SESSION['phone']; } unset($_SESSION['phone']); ?></p>
   </p>
   <p>Password:
     <input type="password" name="Rpassword" size="40" value="<?= htmlentities($pwd)?>"> <p style="color:red"> <?php if(isset($_SESSION['Rpassword']) && $_POST) {echo $_SESSION['Rpassword']; } unset($_SESSION['Rpassword']); ?></p>
   </p>
   <input type="submit" value="Register" size="40">
 </form>
</body>

</html>
