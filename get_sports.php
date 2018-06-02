<html>
<head>
  <?php
  $pdo=new PDO("mysql:host=localhost;port=3306;dbname=garage",'root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   ?>
</head>
<?php



  print_r($_POST);

  $stmt=$pdo->query("SELECT * FROM ".$_POST["bike_id"]);
   ?>
   <option>--Please Select --</option>
   <?php
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
           ?>
           <option value="<?php echo $row["name"]; ?>"><?php echo $row["name"]; ?></option>
      <?php
    }
      ?>

</html>
