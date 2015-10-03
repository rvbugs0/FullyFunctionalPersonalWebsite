<?php
require("DatabaseConnection.php");
require("functions.php");
try
{
	$code=$_GET['code'];
	$c=DatabaseConnection::getConnection();
	$ps=$c->prepare("delete from tbl_portfolio where code =?");
	$ps->bindParam(1,$code);
	$ps->execute();
	redirect_to("ManagePortfolio.php");

}
catch(Exception $exception)
{
	echo $exception->getMessage();
}

?>