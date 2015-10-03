<?php
require("functions.php");
require("UIManager.php");
$message="";
$ar=  array();
array_push($ar, 'siteTitle');
array_push($ar, 'portfolioSectionTitle');
array_push($ar, 'siteHeadingTop');
array_push($ar, 'siteHeading');
array_push($ar, 'siteSubHeading');
array_push($ar, 'copyrightText');
array_push($ar, 'contactSectionTitle');
array_push($ar, 'officeAddressTitle');
array_push($ar, 'officeAddress');
array_push($ar, 'aboutSectionTitle');
array_push($ar, 'aboutColumn1');
array_push($ar, 'aboutColumn2');
array_push($ar, 'socialMediaSectionTitle');
array_push($ar, 'facebookLink');
array_push($ar, 'googlePlusLink');
array_push($ar, 'linkedInLink');
array_push($ar, 'twitterLink');
try
{

$x=0;
$valid=TRUE;
while($x<sizeof($ar))
{
if(!isset($_GET[$ar[$x]]))
{
    $valid=FALSE;
    break;
}
$x++;
}
if($valid)
{
$c=DatabaseConnection::getConnection();
$x=0;
while($x<sizeof($ar))
{
$ps=$c->prepare("update tbl_homedata set propertyValue=? where propertyName=?");
$ps->bindParam(1,$_GET[$ar[$x]]);  
$ps->bindParam(2,$ar[$x]);  
$ps->execute();
$x++;
}
$message="<h3 style='margin-bottom:30px;margin-left:100px;'>Details Updated</h3>";

}


}
catch(Exception $exception)
{
    echo $exception->getMessage();
}
include("partials/header.php");
?>

<div class="container" style="padding-top:200px;padding-bottom:50px;">
<h4 align="center">Customize Home </h4>
<div class="row">

<div class="col-lg-8">
<?php echo $message;?>

<?php
createHomePageCustomizationArea();
?>
</div>

<div class="col-lg-4">
<form action="UploadImage.php" class="pull-right" method="post" enctype="multipart/form-data" style="display:inline">
<b>Logo:</b><br><br/>
    <img src="<?php foreach(glob('img/logo/*.*') as $filename){
     echo $filename; }?>" style="height:64px;">
     &nbsp;<br><br/>

        <input type="file" name="fileToUpload" id="fileToUpload" class="" >
       <br/>
    <button type="submit"  class="btn btn-success btn-sm" name="imageSubmit">Upload</button>
</form>
</div> <!--col-lg-4 -->



</div> <!--row -->
</div> <!--container -->
<?php
include("partials/footer.php");
?>