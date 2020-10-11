<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php require 'dbcon.php';
require 'header.php'; ?>


		<div class="w3l_banner_nav_right">
<!-- login -->

		<div class="w3_login">
			<h3>Forgot Password</h3>
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle">
					
				  </div>
				  <div class="form">
                   
						<?php

                        if (isset($_POST['login'])) {
                            $un = $_POST['User'];
                            $pw = $_POST['Pass'];

                            $sql = "UPDATE user SET password='$pw' WHERE  username='$un' ";
                            if ($conn->query($sql) === true) {
                                echo 'your password is forgot ';
                                header('Location: login.php');
                                exit;
                            } else {
                                echo 'Error updating record: '.$conn->error;
                            }
                        }
                        ?>
	
            
			<h2>Forgot to your Password</h2>
					<form action="login.php" method="post">
					  <input type="text" name="User" placeholder="Username" required=" ">
					  <input type="password" name="Pass" placeholder="Password" required=" ">
					  <input type="submit" value="Forgot Password" name="login">
					</form>
                  	  </div>
                      </div>
                      </div>
                      </div>
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	</div>
<?php include 'footer.php' ?>
</body>
</html>