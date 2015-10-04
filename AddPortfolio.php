<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
include_once("PortfolioDAO.php");
include_once("functions.php");

if(isset($_POST["portfolioName"]) && isset($_POST["portfolioDescription"]) && isset($_FILES["portfolioImage"]))
{
	try
	{
		$portfolio=new portfolio();
		$portfolio->name=$_POST["portfolioName"];
		$portfolio->description=$_POST["portfolioDescription"];
		$target_dir = "img/portfolio/";



$target_file = $target_dir .uniqid(rand()) .basename($_FILES["portfolioImage"]["name"]);



$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["portfolioImage"]["tmp_name"]);
    if($check !== false) {

        $uploadOk = 1;
    } else {
	        echo "{\"success\":false}";
        $uploadOk = 0;
    }
}


// Check file size
if ($_FILES["portfolioImage"]["size"] > 500000) {
    echo "{\"success\":false}";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
echo "{\"success\":false}";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
echo "{\"success\":false}";
// if everything is ok, try to upload file
} else {



    if (move_uploaded_file($_FILES["portfolioImage"]["tmp_name"], $target_file)) 
    {
        try {
        		$portfolio->image=$target_file;	
                  PortfolioDAO::addPortfolio($portfolio);  
				  redirect_to("ManagePortfolio.php");
				  //echo "{\"success\":true}";                        

                } catch (Exception $e) {
		           echo "{\"success\":false}";
                }        

		} else {
echo "{\"success\":false}";
    }

}
	}




catch(Exception $exception)
{
	echo "{\"success\":false}";
}
}
?>