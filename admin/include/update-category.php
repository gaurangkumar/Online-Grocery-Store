<?php

session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require '../../dbcon.php';

if (empty($_POST['cid']) || empty($_POST['name']) || empty($_POST['parent_id'])
  ) {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i> Please Fill Up All Info !';
    header('location: ../category-edit.php');
    exit;
}

$cid = $_POST['cid'];
$name = $_POST['name'];
$parent_id = $_POST['parent_id'];

$query = "UPDATE `category` SET  `name` = '$name', `parent_id` = $parent_id WHERE `cid`= $cid";

$result = $conn->query($query);

if ($result) {
    $_SESSION['msg']['type'] = 'success';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Category updated successfully !';
    header('location: ../category.php');
    exit;
} else {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Error: '.$conn->error;
    header('location: ../category-edit.php');
    exit;
}
