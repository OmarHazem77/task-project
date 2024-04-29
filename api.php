<?php
include 'model.php';
$tasks = all('tasks');
echo json_encode('tasks');