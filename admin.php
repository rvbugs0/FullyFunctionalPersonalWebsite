<?php
require_once("functions.php");
require_once("UserDAO.php");
if(!checkSession())
{
redirect_to("index.php");
}
$user=UserDAO::getUser($_SESSION["username"]);
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
<div class="col col-lg-8">
</div>

</div>

<?php

include("partials/footer.php");
?>