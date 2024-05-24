<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
  <h1>Edit</h1>
  <form action="edit.php" method="post">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your mail address" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>
  <?php   
      $server = "localhost";
      $username = "root";
      $password = "";
      $database = "test";

      $conn = mysqli_connect($server, $username, $password, $database);
      if (!$conn) {
        die("". mysqli_connect_error());
      }; 
      
      if(isset($_POST['update'])){
          $id= $_POST['id'];
          echo $id;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sql = "UPDATE `users` SET `email` = ?, `name` = ? WHERE `users`.`id` = ?;";
        $stmt=mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt,"ssi", $email,$name,$id);
        $result =  mysqli_stmt_execute($stmt);
        if($result){
            echo "Edited Successfully. Want to go back ? 
            <br> click below
            <br> <a href='welcome.php'><button type='button' class='btn btn-light'>Back</button></a>";
        }
      }?>
  </div>

</body>
</html>