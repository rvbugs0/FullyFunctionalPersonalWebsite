<?php
require_once("functions.php");
require_once("UserDAO.php");
$message="";
try
{

if(isset($_GET["status"]))
{
	$status=$_GET["status"];
	if($status==0)
	{
		$message="password changed successfully";
	}else if($status==1)
	{
		$message="password updation failed";
	}
	else
	{
		$message="password cannot be more than 15char(s).";
	}

}
if(!checkSession())
{
redirect_to("index.php");
}
$user=UserDAO::getUser($_SESSION["username"]);
if(isset($_POST["newPassword"]))
{
if(strlen($newPassword)>15)
{
redirect_to("admin.php?status=2");
}
else
{
	$user->password=$_POST["newPassword"];
	UserDAO::changePassword($user);
	redirect_to("admin.php?status=0");
}
}
}
catch(Exception $exception)
{
	echo $exception->getMessage();
	die();
}

include("partials/header.php");

?>
<div class="container" style="padding-top:200px;">
<H1> Hello ,
	

<?php
echo $user->name;
?>
</h1>
<br/>
<div class="row">

<div class="col col-lg-4">
<a href="ManagePortfolio.php" class="btn btn-danger btn-lg">Manage Portfolio </a>
<br/>
<br/>
<a href="CustomizeHome.php" class="btn btn-success btn-lg">Customize Home</a>
<br/>
<br/>
<?php 

if($_SESSION["username"]==='admin')
{
	echo '<a href="ManageAdmins.php" class="btn btn-warning btn-lg">Manage Administrators </a>';
}
?>

</div>
<div class="col-lg-offset-1 col-lg-6">
<h4>
<?php
echo $message;
?>
</h4>
<form action="" method="post">
<label>Change Password</label>
<input type="password" class="form-control"  name="newPassword" required maxlength="15">
<br/>
<button type="submit" class="btn btn-success btn-md myButton" >change Password</button>
</form>
</div>

</div>

<?php

include("partials/footer.php");
?>