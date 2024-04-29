<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include 'connect.php';
    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id = '$id'");
    $stmt->execute();
    $task = $stmt->Fetch();
?>
<div class="row">
    <form action="update.php" method="post" class="col-6 shadow mx-auto my-5 p-5 rounded-5 ">
        <input type="hidden" name="id" value="<?= $id ?>">
        <label for="">Name</label>
        <input class="form-control" name="name" value="<?= $task['name'] ?>" type="text" required>
        <label for="">Content</label>
        <input class="form-control" name="content" value="<?= $task['content'] ?>" type="text" required>
        <div class="button  text-center">
            <button type="submit" class="my-3 btn btn-primary ">create</button>
        </div>
    </form>
</div>
<?php
    echo $id;
} else {
    header("location:task.php");
}
?>