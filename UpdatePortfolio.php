<?php
require_once("PortfolioDAO.php");
require_once("functions.php");
if(isset($_GET["code"]) && isset($_GET["description"]) && isset($_GET["name"]))
{
	$portfolio=new Portfolio();
	$portfolio->code=$_GET["code"];
	$portfolio->name=$_GET["name"];
	$portfolio->description=$_GET["description"];
	try
	{
		PortfolioDAO::updatePortfolio($portfolio);		
		redirect_to("ManagePortfolio.php");
	}
	catch(Exception $exception)
	{
		echo $exception->getMessage();
	}

	
}


?>