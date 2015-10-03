<?php
require_once("PortfolioDAO.php");
require_once("functions.php");
try
{
	$code=$_GET['code'];
	PortfolioDAO::deletePortfolio($code);
	redirect_to("ManagePortfolio.php");

}
catch(Exception $exception)
{
	echo $exception->getMessage();
}

?>