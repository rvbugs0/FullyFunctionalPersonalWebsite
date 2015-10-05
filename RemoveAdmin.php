<?php

require_once("UserDAO.php");
require_once("functions.php");
beginSession();
if(!checkSession())
{
redirect_to("index.php");
}
if($_SESSION["username"]==='admin')
{
	if(isset($_GET["code"]))
	{
		UserDAO::removeUser($_GET["code"]);
		redirect_to("ManageAdmins.php");
	}
}
?>