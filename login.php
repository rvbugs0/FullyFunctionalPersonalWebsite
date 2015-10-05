<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
require_once("UserDAO.php");
require_once("User.php");
require_once("functions.php");
$message="";
if(isset($_POST["username"]) && isset($_POST["password"]))
{
	try
	{
		$user=new User();
		$user->username=$_POST["username"];
		$user->password=$_POST["password"];
		if(UserDAO::validateUser($user))
		{
			createSession($user->username);
		}
		else
		{
			$message="invalid username / password";
		}
	}
	catch(Exception $exception)
	{
		echo $exception;
		die();
	}
}
include("partials/header.php");
?>

<div class="container" style="padding-top:200px;">
<div class="row">
<h2 align="center">Login</h2>
<div class="col col-lg-offset-3 col-lg-6">
<form action="" method="POST">
<label>Username</label>
<input type="text" class="form-control"  name="username" required >
<br/>
<label>Password</label>
<input type="password" class="form-control"  name="password" required >
<br/>
<button type="submit" class="btn btn-success btn-md myButton">Save</button>
</form>

</div>
</div>
</div>

<?php
include("partials/footer.php");
?>
