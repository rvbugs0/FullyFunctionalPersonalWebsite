<?php
require('DatabaseConnection.php');
require("functions.php");
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

?>
<!DOCTYPE html>
<html lang="en" ng-app="magnoApp" ng-controller="SiteDataController">

<head >

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{homeData.siteTitle}}</title>


    
    <link href="css/bootstrap.min.css" rel="stylesheet">

  
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index"> 

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">{{homeData.siteHeadingTop}}</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">{{homeData.portfolioSectionTitle}}</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">{{homeData.aboutSectionTitle}}</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">{{homeData.contactSectionTitle}}</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<div class="container" style="padding-top:200px;padding-bottom:50px;">

<h4 align="center">Customize Home </h4>
<form action="UploadImage.php" class="pull-right" method="post" enctype="multipart/form-data" style="display:inline">
<b>Logo:</b><br><br/>
    <img src="<?php foreach(glob('img/logo/*.*') as $filename){
     echo $filename; }?>" style="height:64px;">
     &nbsp;<br><br/>

        <input type="file" name="fileToUpload" id="fileToUpload" class="" >
       <br/>
    <button type="submit"  class="btn btn-success btn-sm" name="imageSubmit">Upload</button>
</form>


<?php echo $message;?>
<form  action="" method="GET"  style="width:50%;margin-left:150px;">

<br/>
<?php
try
{
    $c=DatabaseConnection::getConnection();
    $rs=$c->query("select * from tbl_homedata");
    foreach($rs as $row)
    {
        echo "<label>".$row["propertyLabel"]."</label>";
echo '<input type="text" class="form-control"  name="'.$row["propertyName"].'" value="'.$row["propertyValue"].'" required >';
    echo "<br/>";
    }
    echo '<button type="submit" class="btn btn-success btn-lg myButton pull-right">Save</button>';
    echo "<br/>";
}
catch(Exception $exception)
{
    echo $exception->getMessage();
}

?>

</form>

</div>
    <script src="lib/angular/angular.min.js" type="text/javascript"></script>
    <script src="site-js/app.js" type="text/javascript"></script>
    <script src="site-js/controllers.js" type="text/javascript"></script>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>
