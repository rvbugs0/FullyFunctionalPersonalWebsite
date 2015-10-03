<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
include_once("functions.php");
include_once("PortfolioDAO.php");
$message="";
if(isset($_GET["code"]))
{
$code=$_GET["code"];
try
{
$portfolio=PortfolioDAO::getPortfolioByCode($code);	
}
catch(Exception $exception)
{
	echo $exception->getMessage();
	die();
}
}
else
{
	redirect_to("ManagePortfolio.php");
}
include_once("partials/header.php");
?>

<div class="container" style="padding-top:150px;">
<?php echo $message; ?>
<div class="row">
	
<div class="col-lg-4">
<form action="UploadPortfolioImage.php" class="pull-right" method="post" enctype="multipart/form-data" style="display:inline">
<b>Logo:</b><br><br/>
    <img src="<?php echo $portfolio->image;?>" style="height:64px;">
     &nbsp;<br><br/>
		<input type="hidden" value="<?php echo $portfolio->code; ?>" name="code">
        <input type="hidden" name="oldImage" value="<?php echo $portfolio->image;?>" >
        <input type="file" name="fileToUpload" id="fileToUpload" class="" >
       <br/>
    <button type="submit"  class="btn btn-success btn-sm" name="imageSubmit">Upload</button>
</form>
</div> <!--col-lg-4 -->
<div class="col-lg-8">



<form action="UpdatePortfolio.php" method="GET">
<label>Title</label>
<input type="hidden" value="<?php echo $portfolio->code ?>" name="code">
<input type="text" class="form-control" value="<?php echo $portfolio->name; ?>" name="name" required >
<br/>
<label>Description</label>
<textarea rows="5" class="form-control"  name="description" required ><?php echo $portfolio->description; ?></textarea>
<br/>
<button type="submit" class="btn btn-success btn-md myButton">Save</button>
</form>



</div>

</div> <!-- row-->
</div> <!-- container-->


<?php
require("partials/footer.php");
?>

