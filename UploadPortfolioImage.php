<?php
require_once("functions.php");
require_once("PortfolioDAO.php");
$code=$_POST["code"];
$oldImage=$_POST["oldImage"];
$target_dir = "img/portfolio/";


$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}


// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

echo $oldImage;
if(file_exists($oldImage))
{
    unlink($oldImage);
 
}

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        try {
                  PortfolioDAO::updatePhoto($code,$target_file);  
                          redirect_to("EditPortfolio.php?code=".$code);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }        

//        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

    } else {
        echo "Sorry, there was an error uploading your file.";
    }

}
?>