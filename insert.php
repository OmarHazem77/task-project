<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $content = $_POST['content'];
    // VALIDATION 
    if (empty($name)) {
        $errors[] = 'name can not be empty';
    }
    if (isset($errors)) {
        echo 'there is errors';
    }
    if (strlen($name) < 3) {
        $errors[] = 'name can be more than 3';
    }
    if (isset($errors)) {
        foreach ($errors as $error) {
            echo "<h1 style='color:red'>" .  $error . "</h1>";
        }
        header("Refresh:3;url=task.php");
    } else {
        include 'connect.php';
        $stmt = $conn->prepare("INSERT INTO tasks set  name='$name' , content = '$content' ");
        $stmt->execute();
        header("location:task.php");
    }
} else {
    header("location:task.php");
}