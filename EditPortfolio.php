<?php
require("DatabaseConnection.php");
require("functions.php");
try
{

if(isset($_GET["code"]))
{
$code=$_GET["code"];
$c=DatabaseConnection::getConnection();
$rs=$c->query("select * from tbl_portfolio where code=$code");

$name="";
$description="";
$image="";
foreach($rs as $row)
{
$name=$row["name"];
$image=$row["image"];
$description=$row["description"];
}

}
else
{
	redirect_to("ManagePortfolio.php");
}
}
catch(Exception $exception)
{
	echo $exception->getMessage();
}
require("partials/header.php");
?>

<div class="container" style="padding-top:150px;">
<div class="row">
	
<div class="col-lg-4">
<form action="UploadImage.php" class="pull-right" method="post" enctype="multipart/form-data" style="display:inline">
<b>Logo:</b><br><br/>
    <img src="<?php echo $image;?>" style="height:64px;">
     &nbsp;<br><br/>

        <input type="file" name="fileToUpload" id="fileToUpload" class="" >
       <br/>
    <button type="submit"  class="btn btn-success btn-sm" name="imageSubmit">Upload</button>
</form>
</div> <!--col-lg-4 -->
<div class="col-lg-8">



<form>
<label>Title</label>
<input type="text" class="form-control" value="<?php echo $name; ?>" name="name" required >
<br/>
<label>Description</label>
<textarea rows="5" class="form-control"  name="name" required ><?php echo $description; ?></textarea>
<br/>
<button type="submit" class="btn btn-success btn-md myButton">Save</button>
</form>



</div>

</div> <!-- row-->
</div> <!-- container-->


<?php
require("partials/footer.php");
?>

