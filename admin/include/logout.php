<?php

session_start();

unset($_SESSION['ADMIN_ID']);
unset($_SESSION['ADMIN_NAME']);

session_destroy();

header('Location: ../index.php');
exit;
