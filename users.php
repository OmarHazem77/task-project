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




    <?php

  session_start();
  if (!isset($_SESSION['login'])) {
    header("location:index.php");
  }
  include 'model.php';
  if (isset($_GET['do'])) {
    $do = $_GET['do'];
  } else {
    $do  = 'select';
  }

  if ($do == 'select') {
    $users = all('users');

  ?>
    <div class="container my-5">
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <a href=" users.php?do=add " class="btn btn-primary">Create User</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                <tr>
                    <th scope="row"><?= $user['id']; ?></th>
                    <td><?= $user['email']; ?></td>
                    <td><?= $user['role']; ?></td>
                    <td>
                        <a href="users.php?do=edit&id= <?= $user['id']; ?>" class="btn btn-primary ">Edit</a>
                        <a href="users.php?do=delete&id= <?= $user['id']; ?>" class="btn btn-danger ">Delete</a>

                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php
  } elseif ($do == 'single') {
    echo 'single';
  } elseif ($do == 'add') {
  ?>
    <div class="container my-5">

        <form action="users.php?do=insert" method="post" class="col-8 shadow mx-auto p-5">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
                <div class="button text-center mt-4"><input class="btn btn-primary" type="submit" value="Submit"></div>
            </div>
        </form>

    </div>

    <?php

  } elseif ($do == 'insert') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passhash = password_hash($password, PASSWORD_BCRYPT);
    if (empty($email)) {
      $errors[] = 'email can not be empty';
    }
    if (empty($password)) {
      $errors[] = 'password can not be empty';
    }
    if (strlen($email) < 3) {
      $errors[] = 'name can be more than 3';
    }

    if (isset($errors)) {
      echo "<div class='container my-5'>";
      foreach ($errors as $error) {
        echo "<div class= 'alert alert-danger'>" .  $error . "</div>";
      }
      header("Refresh:3;url=task.php");

      echo "</div>";
    } else {
      insert("users", "email = '$email' , password = '$passhash'");
       header("location:users.php");
    }
  } elseif ($do == 'delete') {
    $id = $_GET['id'];
    delete("users", $id);
    header("location:users.php");
  } elseif ($do == 'edit') {

    $id = $_GET['id'];
    $user = single("users", $id);
    // print_r($user);

  ?>

    <div class="container my-5">

        <form action="users.php?do=update" method="post" class="col-8 shadow mx-auto p-5">
            <div class="form-floating mb-3">
                <input type="hidden" name="id" value="<?= $id ?>">
                <input type="email" class="form-control" id="floatingInput" value=" <?= $user['email'] ?>" name="email"
                    placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" name="password"
                    placeholder="Password">
                <label for="floatingPassword">Password</label>
                <div class="button text-center mt-4"><input class="btn btn-primary" type="submit" value="Submit"></div>
            </div>
        </form>

    </div>

    <?php
  } elseif ($do == 'update') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'];
      $email = $_POST['email'];
    }
    if (empty($email)) {
      $errors[] = 'email can not be empty';
    }
    if (isset($errors)) {
      echo "<div class='container my-5'>";
      foreach ($errors as $error) {
        echo "<div class= 'alert alert-danger'>" .  $error . "</div>";
      }
      header("Refresh:3;url=task.php");

      echo "</div>";
    } else {
      if (empty($_GET['password'])) {
        update("users", "email = '$email'", $id);
      } else {
        $password = $_GET['password'];
        $passhash = password_hash($password, PASSWORD_BCRYPT);
        update("users", "email = '$email' ,password ='$passhash'", $id);
      }
    }
  }
  ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>