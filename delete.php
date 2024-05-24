<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php   
      $server = "localhost";
      $username = "root";
      $password = "";
      $database = "test";

      $conn = mysqli_connect($server, $username, $password, $database);
      if (!$conn) {
        die("". mysqli_connect_error());
      }; 
      if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $sql = "DELETE FROM `users` WHERE `id` = ?";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt,"i", $id);
        $result =  mysqli_stmt_execute($stmt);
        if($result){
            echo "Deleted Successfully. Want to go back ? 
            <br> click below
            <br> <a href='welcome.php'><button type='button' class='btn btn-light'>Back</button></a>";
        }
      }
      ?>
</body>
</html>