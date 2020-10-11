<?php

session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require '../../dbcon.php';

if (empty($_POST['name']) ||
   empty($_POST['parent_id'])

  ) {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i> Please Fill Up All Info !';
    header('location: ../category-add.php');
    exit;
}

$name = $_POST['name'];

$cid = $_POST['parent_id'];

$query = "INSERT INTO `category`(`name`,`parent_id`) VALUES ('$name','$cid')";
$result = $conn->query($query);

if ($result) {
    $_SESSION['msg']['type'] = 'success';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Category posted successfully !';
    header('location: ../category.php');
    exit;
} else {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Error: '.$conn->error;
    header('location: ../category-add.php');
    exit;
}
