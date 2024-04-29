<?php

include 'connect.php';


function all($tabble)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $tabble");
    $stmt->execute();
    return $stmt->Fetchall();
}
// echo '<pre>';
// print_r(all('tasks'));
function single($tabble, $id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM $tabble WHERE id = '$id'");
    $stmt->execute();
    return $stmt->Fetch();
}
//print_r(single('tasks',1));


function insert($table, $set)
{
    global $conn;
    $stmt = $conn->prepare("INSERT INTO $table set $set");
    $stmt->execute();
}
//insert('users',"email = 'insefvfvfdvfvfrvfrrted model' , password = 'this contentfvfvbfdbvfdb inserted from model'");


function update($table, $set, $id)
{
    global $conn;
    $stmt = $conn->prepare("UPDATE $table SET $set WHERE id='$id' ");
    $stmt->execute();
}

//update('tasks',"name = 'insefvfvfdvfvfrvfrrted model' , content = 'this contentfvfvbfdbvfdb inserted from model'",9);

function delete($table, $id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM $table WHERE id = '$id'");
    $stmt->execute();
}

//delete('tasks',9);