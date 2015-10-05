<?php
require_once("DatabaseConnection.php");
require_once("DAOException.php");
class UserDAO
{
public static function validateUser($user)
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$ps=$c->prepare("select * from tbl_user where username=? and password=?");
		$ps->bindParam(1,$user->username);
		$ps->bindParam(2,md5($user->password));
		$ps->execute();
		$row=$ps->fetch(PDO::FETCH_ASSOC);
		if($row)
		{
			return true;
		}
		return false;
	}
	catch(Exception $exception )
	{
		throw new DAOException("validateUser() -> ".$exception->getMessage());
	}
}




}

?>