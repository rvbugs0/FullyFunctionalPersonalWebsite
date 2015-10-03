<?php
include("DatabaseConnection.php");
try
{
	$c=DatabaseConnection::getConnection();
	$rs=$c->query("select * from tbl_portfolio");
	$x=0;
	echo "[";
	foreach($rs as $row)
	{

		if($x>0)
		{
			echo ",";
		}


		echo "{\"code\":\"".$row['code']."\",";
		echo "\"image\":\"".$row['image']."\",";
		echo "\"name\":\"".$row['name']."\",";
		echo "\"description\":\"".$row['description']."\"}";		
		$x++;
	}
	echo "]";				
}
catch(Exception $exception)
{
	echo $exception->getMessage();
}

?>