<?php

session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require '../../dbcon.php';

if (empty($_POST['pid']) ||
   empty($_POST['name']) ||
   empty($_POST['price']) ||
   $_POST['discount'] == '' ||
   empty($_POST['weight']) ||
   empty($_POST['cid'])
  ) {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i> Please Fill Up All Info !';
    header('location: ../product-edit.php');
    exit;
}

$pid = $_POST['pid'];
$name = $_POST['name'];
$price = $_POST['price'];
$discount = $_POST['discount'];
$weight = trim($_POST['weight'], ' ()');
$cid = $_POST['cid'];

$pic = $_FILES['pic'];
$file_path = null;

if (!empty($pic['name'])) {
    if ($pic['error']) {
        $_SESSION['msg']['type'] = 'danger';
        $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i> Please select valid file !';
        header('location: ../project-edit.php');
        exit;
    }

    if (!(file_exists('../images') && is_dir('../images'))) {
        mkdir('../images');
    }

    $file_path = 'images/'.time().'-'.$pic['name'];

    $f = move_uploaded_file($pic['tmp_name'], '../../'.$file_path);

    if (!$f) {
        $_SESSION['msg']['type'] = 'danger';
        $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i> File is not saved !';
        header('location: ../product-edit.php');
        exit;
    }
}
if ($file_path) {
    $query = "UPDATE `product` SET 
	`name` = '$name',
	`price` = $price,
	`discount` = $discount,
	`weight` = '$weight',
	`pic` = $file_path,
	`cid` = $cid
	WHERE `pid`= $pid";
} else {
    $query = "UPDATE `product` SET 
	`name` = '$name',
	`price` = $price,
	`discount` = $discount,
	`weight` = '$weight',
	`cid` = $cid
	WHERE `pid`= $pid";
}

$result = $conn->query($query);

if ($result) {
    $_SESSION['msg']['type'] = 'success';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Product updated successfully !';
    header('location: ../products.php');
    exit;
} else {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Error: '.$conn->error;
    header('location: ../product-edit.php');
    exit;
}
