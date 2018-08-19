<!DOCTYPE>
<html>
<head>
<title>Login form</title>
<link rel="stylesheet" href="styles/login_style.css" media="all">
</head>
<body>
<div class="login">
<h2 style="color:red; text-align:center;"><?php echo @$_GET['logged_in']; ?></h2>
<h2 style="color:red; text-align:center;"><?php echo @$_GET['logged_out']; ?></h2>

<h2 style="color:white; text-align:center;"><?php echo @$_GET['not_admin']; ?></h2>
	<h1>Admin Login</h1>
    <form method="post">
    	<input type="text" name="email" placeholder="Email" required="required" />
        <input type="password" name="p" placeholder="Password" required="required" />
        <button type="submit" name="login" class="btn btn-primary btn-block btn-large">Login</button>
    </form>
</div>
</body>
</html>

<?php  
session_start();
//verifying the admin
include("includes/db.php");
if(isset($_POST['login']))
{
	$email=mysql_real_escape_string($_POST['email']);
	$pass=mysql_real_escape_string($_POST['p']);
	//To prevent project from Hackin
	$sel_user="select * from admins where user_email
	='$email' AND user_pass='$pass'";
	$run_user=mysql_query($sel_user);
	$check_user=mysql_num_rows($run_user);
	if($check_user==0)
	{
		echo "<script>alert('Password or Email is wrong,try again!')</script>";
		
	}
	else
	{
		$_SESSION['user_email']=$email;
		echo "<script>window.open('index.php?logged_in=You have successfully logged in','_self')</script>";
	}
	
	
}



?>