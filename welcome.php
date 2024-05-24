<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
    <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script>$(document).ready( function () {
    $('#myTable').DataTable();
    } );</script>
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
      if (isset($_POST['submit'])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
    
        // Use prepared statement to safely insert values into the SQL query
        $sql = "INSERT INTO `users` (`id`, `email`, `name`) VALUES (NULL, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $name);
        $result =  mysqli_stmt_execute($stmt);
          if ($result){
            echo "Data added successfully.";
          } else {
            echo "Failed to insert data: " . mysqli_stmt_error($stmt);
          }
        mysqli_stmt_close($stmt);
      }
  ?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MailListing</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Signup.php">Signup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
      <form class="d-flex me-auto" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
      </form>
    </div>
  </div>
</nav>  
<div class="container">
  <h1>welcome to <b><i>MailListing</i></b></h1>
  <form action="welcome.php" method="post">
  <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your mail address" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
  </div>

  <div class="container">
  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Sr.no</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $sql = "SELECT * from `users`";
  $result = mysqli_query($conn, $sql);
  $srno=0;
  while ($row = mysqli_fetch_assoc($result)) {
    $srno=$srno + 1;
    $id = $row["id"];
    echo"<tr> <th scope='row'>" .$srno. "</th><td>" .$row["name"]."</td><td>".$row["email"]."
    </td><td><a class='edit' href= 'edit.php?editid=$id'><button type='button' class='btn btn-warning'>Edit</button></a> 
    <a class='delete' href= 'delete.php?deleteid=$id'><button type='button' class='btn btn-danger'>Delete</button></a> </td></tr>";
  };
  ?>
</table>
  </div>
</body>
</html>