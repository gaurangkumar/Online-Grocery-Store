<?php

session_start();

unset($_SESSION['USER_ID']);
unset($_SESSION['USER_NAME']);

session_destroy();

header('Location: index.php');
exit;
