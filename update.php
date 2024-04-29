<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $content = $_POST['content'];

    if (empty($name)) {
        $errors[] = 'name can not be empty';
    }

    if (isset($errors)) {
        foreach ($errors as $error) {
            echo "<h1 style='color:red'>" .  $error . "</h1>";
        }
    } else {
        include 'connect.php';
        $stmt = $conn->prepare("UPDATE  tasks SET name ='$name' , content = '$content' WHERE id='$id' ");
        $stmt->execute();
        header("location:task.php");
    }
} else {
    header("location:task.php");
}