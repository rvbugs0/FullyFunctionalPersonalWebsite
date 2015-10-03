<?php
include("DatabaseConnection.php");
try
{
	$c=DatabaseConnection::getConnection();
	$rs=$c->query("select * from tbl_homedata");
	$x=0;
	echo "{";
	foreach($rs as $row)
	{
		if($x>0)
		{
			echo ",";
		}
		echo "\"".$row['propertyName']."\":\"".$row['propertyValue']."\"";
		$x++;
	}
	echo "}";				
}
catch(Exception $exception)
{
	echo $exception->getMessage();
}

?>