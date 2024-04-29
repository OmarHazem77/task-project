<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include 'connect.php';
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = '$id'");
    $stmt->execute();
    header("location:task.php");
} else {
    header("location:task.php");
}
