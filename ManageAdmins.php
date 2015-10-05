<?php

require_once("UserDAO.php");
require_once("functions.php");
if(!checkSession() || $_SESSION["username"]!='admin')
{
redirect_to("index.php");
}

$message="";
if(isset($_POST["adminName"]) && isset($_POST["adminUsername"]) && isset($_POST["adminPassword"]))
{

 $name=$_POST["adminName"];
 $username=$_POST["adminUsername"];
 $password=$_POST["adminPassword"];   
    try
    {
        $user=new User();
        $user->name=$name;
        $user->password=$password;
        $user->username=$username;
        $valid=true;
        if(strlen($username)>15)
        {
            $message="username allowed <= 15 char";
            $valid=false;
        }
        if(strlen($password)>20)
        {
            $message=$message."<br/> "."password allowed <= 15 char";
            $valid=false;
        }
        if($valid==true)
        {
            if(UserDAO::checkUsernameAvailable($user->username))
            {
                        UserDAO::addUser($user); 
                        redirect_to("ManageAdmins.php");
            }else
            {
                $message = "Username not available";
            }

        }

    }

catch(Exception $exception)
{
    echo "{\"success\":false}";
}
}
require("partials/header.php");
$admins=UserDAO::getAll();
?>

<div class="table-responsive" style="padding-top:200px;margin-left:150px;width:70%; ">
<h4>Manage admins</h4>
<h5 style="color:red">
<?php
echo $message;
?>
</h5>
<button class="btn btn-success btn-sm pull-right" data-target="#AddAdminModal" data-toggle="modal">Add Admin </button>
<br><br/>
<table class="table table-striped table-bordered">
	<thead>
	<tr>
	<td>S.No.</td>
	<td>Name</td>
	<td>Username</td>
	<td>Options</td>
	</tr>
	</thead>
<tbody>
<?php
$x=1;
foreach ($admins as $row) {
	echo "<tr>";
	echo "<td>".$x."</td>";
	echo "<td>".$row->name."</td>";
	echo "<td>".$row->username."</td>";
	echo "<td><a href='RemoveAdmin.php?code=".$row->code."'>Delete</a> &nbsp;";
	echo "</tr>";
	$x++;
}


?>
</tbody>
</table>
</div>

<div class="portfolio-modal modal fade" id="AddAdminModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-offset-3 col-lg-6">
                        <div class="modal-body">
                            <form action="" method="post"  id="AddAdminForm">
                            <label>Name</label>	
                            <input class="form-control" type="text" name="adminName"  id="adminName" required>
                            <label>Username</label> 
                            <input class="form-control" type="text" name="adminUsername"  id="adminUsername" required maxlength="15">
                            <label>Password</label> 
                            <input class="form-control" type="password" name="adminPassword"  id="adminPassword" required maxlength="20">
                            <hr class="star-primary">
                            
                            <button type="submit" id="AddAdminButton" class="btn btn-default" ><i class="fa fa-plus"></i> Add</button>
                            </form>		



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include("partials/footer.php");
?>