<?php

session_start();
if (!isset($_SESSION['ADMIN_ID']) || empty($_SESSION['ADMIN_ID'])) {
    header('Location: login.php');
    exit;
}
require '../../dbcon.php';

if (empty($_GET['id'])) {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i> Nothing to delete !';
    header('location: ../products.php');
    exit;
}

$pid = $_GET['id'];

$result = $conn->query("DELETE FROM `product` WHERE `pid` = $pid");

if ($result) {
    $_SESSION['msg']['type'] = 'success';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Deleted successfully !';
    header('location: ../products.php');
    exit;
} else {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-info-circle"></i> Error: '.$conn->error;
    header('location: ../products.php');
    exit;
}
