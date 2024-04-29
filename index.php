<?php
session_start();
if (isset($_SESSION['login'])) {
  header("location:index.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("connect.php");
  $email = $_POST['email'];
  $password = $_POST['password'];
  $stmt = $conn->prepare("SELECT *FROM users WHERE email = '$email' ");
  $stmt->execute();
  $count = $stmt->rowCount();

  if ($count == 1) {
    $user = $stmt->fetch();
    if (password_verify($password, $user['password'])) {
      $_SESSION['login'] = $email;
      header("location:users.php");
    } else {
      echo "<div class= 'alert alert-danger '> password not match  </div>";
    }
  } else {
    echo "<div class= 'alert alert-danger '> email not found  </div>";
  }
}

?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container my-5">
        <form method="post" class="col-8 shadow mx-auto p-5">
            <h1 class="text-center mb-3 pb-3">Login</h1>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
                <div class="button text-center mt-4"><input class="btn btn-primary" type="submit" value="Login"></div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>