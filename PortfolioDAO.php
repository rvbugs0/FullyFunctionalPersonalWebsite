<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

include_once("Portfolio.php");
include_once("DatabaseConnection.php");
include_once("DAOException.php");

class PortfolioDAO
 {

public static function addPortfolio($portfolio) 
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$ps=$c->prepare("insert into tbl_portfolio (name,description ,image) values (?,?,?)");
		$ps->bindParam(1,$portfolio->name);
		$ps->bindParam(2,$portfolio->description);
		$ps->bindParam(3,$portfolio->image);
		$ps->execute();
		$ps=null;
		$c=null;
		return true;
	}catch(Exception $exception)
	{
		throw new DAOException("addPortfolio() ".$exception->getMessage());
	}

 }


public static function updatePortfolio($portfolio) 
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$ps=$c->prepare("update tbl_portfolio set name=?, description=? where code=?");
		$ps->bindParam(1,$portfolio->name);
		$ps->bindParam(2,$portfolio->description);
		$ps->bindParam(3,$portfolio->code);
		$ps->execute();
		$ps=null;
		$c=null;
		return true;
	}catch(Exception $exception)
	{
		throw new DAOException("updatePortfolio() ".$exception->getMessage());
	}

 }

 public static function getPortfolioByCode($code)
 {
	try
	{
		$c=DatabaseConnection::getConnection();
		$rs=$c->query("select * from tbl_portfolio where code=$code");
		$portfolio=new Portfolio();
		$portfolio->code=$code;
		foreach($rs as $row)
		{
		$portfolio->name=$row["name"];
		$portfolio->image=$row["image"];
		$portfolio->description=$row["description"];
		
		}	
		$rs=null;
		$c=null;
		return $portfolio;
	}
catch(Exception $exception)
{
		throw new DAOException("getPortfolioByCode() ".$exception->getMessage());
}
}

 public static function deletePortfolio($code)
 {
	try
	{
		$c=DatabaseConnection::getConnection();
		$portfolio=self::getPortfolioByCode($code);
		$c->query("delete from tbl_portfolio where code=$code");
		if(file_exists($portfolio->image))
		{
			unlink($portfolio->image);
		}
		$c=null;
	}
catch(Exception $exception)
{
		throw new DAOException("getPortfolioByCode() ".$exception->getMessage());
}
}


public static function updatePhoto($code,$name)
 {
	try
	{
		$c=DatabaseConnection::getConnection();
		$c->query("update tbl_portfolio set image='$name' where code=$code");
		$c=null;
	}
catch(Exception $exception)
{
		throw new DAOException("getPortfolioByCode() ".$exception->getMessage());
}
}

}

?>