<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("location:index.php");
}
include 'connect.php';
$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt->execute();
$tasks = $stmt->Fetchall();
// echo '<pre>';
// print_r($tasks);
// echo '</pre>';


?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
    .task {
        border-left: 5px solid gray;
        border-right: 5px solid gray;

    }

    .completed {
        border-color: green;

    }

    a {
        text-decoration: none;
        color: #333;
    }
    </style>
</head>

<body>
    <div class="container my-5 ">
        <?php foreach ($tasks as $task) {  ?>
        <div class="task shadow p-3 rounded-5 position-relative my-3
       <?php if ($task['state'] == 1) {
                echo 'completed';
            } ?>">
            <h1>
                <?= $task['name']; ?>
            </h1>
            <p>
                <?= $task['content']; ?>
            </p>
            <div class="icons position-absolute end-0 top-50 translate-middle ">
                <a href="state.php?id=<?= $task['id'] ?>&state=<?= $task['state'] ?>">
                    <i class="fa-solid fa-check me-2 fa-2x "></i>
                </a>
                <a href="edit.php?id=<?= $task['id'] ?>">
                    <i class="fa-solid fa-pen-to-square me-2 fa-2x"></i>
                </a>
                <a href="delete.php?id=<?= $task['id'] ?>">
                    <i class="fa-solid fa-trash me-2 fa-2x"></i>
                </a>
            </div>
        </div>
        <?php } ?>

        <div class="row">
            <form action="insert.php" method="post" class="col-6 shadow mx-auto my-5 p-5 rounded-5 ">
                <label for="">Name</label>
                <input class="form-control" name="name" type="text" required>
                <label for="">Content</label>
                <input class="form-control" name="content" type="text" required>
                <div class="button  text-center">
                    <button type="submit" class="my-3 btn btn-primary ">create</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>