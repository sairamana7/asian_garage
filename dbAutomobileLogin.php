<?php
  //print_r($_POST);
  require_once "pdo.php";
    //not empty
    //atleast 6 characters
    //Start the session
session_start();

//Dump your POST variables
if($_SESSION['Rsuccess'])
{
  echo("<h3 style='color:green' style='text-align:center'>".$_SESSION['Rsuccess'] ."</h3>");
  $_SESSION['Rsuccess']="";
}
$_SESSION['POST'] = $_POST;

  $errors=array();    //all the values which are entered are stored in array

  //start validation
    if(empty($_POST['name']))
    {
      $errors['name']="Invalid User Name";
    }
    if(empty($_POST['password']))
    {
      $errors['password']="Invalid Password";
    }

  //check $errors
      if(isset($_POST['name'])&&isset($_POST['password']))
        {

          $sql="SELECT  user_id from users
          WHERE name=:name AND password=:password";
          //echo("<pre>\n".$sql."\n</pre>\n");
          $stmt=$pdo->prepare($sql);
          $stmt->execute(array(
            ':name'=>$_POST['name'],
            ':password'=>$_POST['password']  ));
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $_POST['id']=$row;
              if($row==TRUE)
              {
                $_SESSION['Lsuccess']="Logged In";
                header("Location:bike_details.php");
                exit();
              }
              else{

                echo("<h3 style='color:red'>Login FAILED</h3>");

              }
        }


 ?>


<!-- -------------------------------------------------------------------->
<html>
<body>
  <h1>Welcome to Asian Garage</h1>
  <h2>Please Log In</h2>
  <form method="post" target="">
    <p>User Name:
      <input type="text" name="name" size="40"><p style="color:red"><?php if($_POST){if(isset($errors['name'])) echo $errors['name']; } ?></p>
    </p>
    <p>Password:
      <input type="password" name="password" size="40"><p style="color:red"><?php if($_POST){ if(isset($errors['password'])) echo $errors['password']; }?></p>
    </p>

      <input type="hidden" name="id" size="40">

    <p>
      <input type="submit" value="Log In" size="40">
      <input type="button"
      onclick="location.href='http://localhost/db/dbRegister.php';return false;" value="Cancel">
    </p>
  </form>

</body>
</html>
