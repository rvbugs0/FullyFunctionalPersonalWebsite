<?php
require_once("DatabaseConnection.php");
require_once("DAOException.php");
require_once("User.php");
class UserDAO
{
public static function validateUser($user)
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$password=md5($user->password);
		$username=$user->username;
		$rs=$c->query("select * from tbl_user where username='$username' and password='$password'");
		$x=0;
		foreach ($rs as $row ) 
		{
			$x++;
		}
		
		
		$rs=null;
		$c=null;	
		if($x>0)
		{
		return true;
		}else
		{
		return false;			
		}

	}
	catch(Exception $exception )
	{
		throw new DAOException("validateUser() -> ".$exception->getMessage());
	}
}

public static function getUser($username)
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$ps=$c->prepare("select name from tbl_user where username=? ");
		$ps->bindParam(1,$username);
		$ps->execute();
		$row=$ps->fetch(PDO::FETCH_ASSOC);
		if($row)
		{
			$user=new User();
			$user->name=$row["name"];
			$user->username=$username;
			return $user;
		}
		$row=null;
		$ps=null;
		$c=null;
		return null;
	}
	catch(Exception $exception )
	{
		throw new DAOException("validateUser() -> ".$exception->getMessage());
	}
}

public static function removeUser($code)
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$ps=$c->prepare("delete from tbl_user where code = $code");
		$ps->execute();
		$ps=null;
		$c=null;
		
	}
	catch(Exception $exception )
	{
		throw new DAOException("removeUser() -> ".$exception->getMessage());
	}
}


public static function changePassword($user)
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$password=md5($user->password);
		$username=$user->username;
		$ps=$c->prepare("update tbl_user set password='$password' where username = '$username'");
		$ps->execute();
		$ps=null;
		$c=null;
		
	}
	catch(Exception $exception )
	{
		throw new DAOException("changePassword() -> ".$exception->getMessage());
	}
}

public static function getAll()
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$rs=$c->query("select code,name,username from tbl_user where username!='admin'");
		$admins=array();
		
		foreach($rs as $row)
		{
			$user=new User();
			$user->name=$row["name"];
			$user->username=$row["username"];
			$user->code=$row["code"];
			array_push($admins, $user);
		}
		return $admins;
	}
	catch(Exception $exception )
	{
		throw new DAOException("getAll() -> ".$exception->getMessage());
	}
}


public static function checkUsernameAvailable($username)
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$rs=$c->query("select username from tbl_user where username='$username'");
		$x=0;
		foreach($rs as $row)
		{
		$x++;
		}
		if($x>0)
		{
			return false;
		}
		return true;
	}
	catch(Exception $exception )
	{
		throw new DAOException("checkUsernameAvailable() -> ".$exception->getMessage());
	}	
}

public static function addUser($user)
{
	try
	{
		$c=DatabaseConnection::getConnection();
		$password=md5($user->password);
		$valid=$c->query("insert into tbl_user (name ,username ,password) values ('$user->name','$user->username','$password')");
		if($valid==false){
			throw new DAOException("cannot add user");
		}
	}
	catch(Exception $exception )
	{
		throw new DAOException("checkUsernameAvailable() -> ".$exception->getMessage());
	}	
}

}

?>