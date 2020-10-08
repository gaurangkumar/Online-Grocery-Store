<?php

session_start();
require '../../dbcon.php';

if (empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i> All fields are required!';
    header('location: ../login.php');
    exit;
}

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM `admin` WHERE `email` = '$email'");

if ($conn->errno) {
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i> Error: '.$conn->error;
    header('location: ../login.php');
    exit;
}

if ($result->num_rows) {
    $row = $result->fetch_array();
    $user_id = $row['aid'];
    if ($row['password'] != $password) {
        //Login Unsuccessful
        $_SESSION['msg']['type'] = 'danger';
        $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i><strong> Wrong Password !</strong>';
        header('Location: ../login.php');
        exit;
    } else {
        //Login Successful
        $_SESSION['ADMIN_ID'] = $user_id;
        $_SESSION['ADMIN_NAME'] = $row['name'];

        header('Location: ../index.php');
        exit;
    }
} else {
    //Login Unsuccessful
    $_SESSION['msg']['type'] = 'danger';
    $_SESSION['msg']['msg'] = '<i class="fa fa-warning-circle"></i><strong> Wrong Email!</strong>';
    header('Location: ../login.php');
    exit;
}
