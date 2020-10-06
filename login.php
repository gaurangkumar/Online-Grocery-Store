<?php
include("dbcon.php");
    
if(isset($_POST['submit']))
{	
	$n = $_POST['Name'];
    $m = $_POST['Mobile'];
    $a1 = $_POST['Address'];
	
	$c = $_POST['City'];
	$g = $_POST['Gn'];
	$u = $_POST['Username']; 
	$p = $_POST['Password'];
 
    $sql = "INSERT INTO user(name, mobile, address1, gender, username, password) VALUES ('$n', '$m', '$a1', '$g', '$u', '$p')";

    if ($conn->query($sql) === true) {
        //echo "New record created successfully";
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['login']))
{
    $un = $_POST['User'];
    $pw = $_POST['Pass'];

    $sql = "SELECT username, password FROM user WHERE username='$un' AND password='$pw'" ;
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if($row['username'] == $un && $row['password'] == $pw) {
        //echo "login successful";
        header("Location: index.php");
        exit;
    }
    else {
        echo "Invalid username and password";
    }
}
?>
<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Grocery Store</title>
<body><?php include "header.php"?>


		<div class="w3l_banner_nav_right">
<!-- login -->

		<div class="w3_login">
			<h3>Sign In & Sign Up</h3>
			<div class="w3_login_module">
				<div class="module form-module">
				  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
					<div class="tooltip">Click Me</div>
				  </div>
				  <div class="form">
					<h2>Login to your account</h2>
					<form action="#" method="post">
					  <input type="text" name="User" placeholder="Username" required="">
					  <input type="password" name="Pass" placeholder="Password" required="">
					  <input type="submit" value="Login" name="login">
					</form>
                  	  </div>
				  <div class="form">
					<h2>Create an account</h2>
					<form action="#" method="post">
					  <input type="text" name="Name" placeholder="name" required=" " pattern="[a-zA-Z]"  title="must be enter name">
					  <input type="password" name="Mobile" placeholder="Mobile No" required=" " pattern="[0-9]{10}" title="must be 10 charecter">
					  <input type="text" name="Address" placeholder=" Address" required=" ">
					  
                      <input type="text" name="City" placeholder="City" required=" " value="Visnager" readonly style="text-align:center:">
                      <input type="radio" name="Gn" placeholder="" required=" ">Male
                       <input type="radio" name="Gn" placeholder="" required=" ">Female
                      
                      <input type="text" name="Username" placeholder="Username" required=" ">
                      <input type="password" name="Password" placeholder="Password" required=" " pattern="[a-z0-9]{8}" title="password must be 8 charecter">
					  <input type="submit" value="Register" name="submit">
					</form>
				  </div>
				  <div class="cta"><a href="#">Forgot your password?</a></div>
				</div>
			</div>
                       
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
           
			
		</div>
        
<!-- //login -->
		</div>
		<div class="clearfix"></div>
	</div>
<?php include 'footer.php' ?>
</body>
</html>