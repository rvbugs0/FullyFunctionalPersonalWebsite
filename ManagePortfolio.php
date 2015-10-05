<?php
require_once("DatabaseConnection.php");
require_once("functions.php");
if(!checkSession())
{
redirect_to("index.php");
}
require("partials/header.php");

?>

<div class="table-responsive" style="padding-top:200px;margin-left:150px;width:70%; ">
<h4>Portfolio</h4>
<button class="btn btn-success btn-sm pull-right" data-target="#AddPortfolioModal" data-toggle="modal">Add Item </button>
<br><br/>
<table class="table table-striped table-bordered">
	<thead>
	<tr>
	<td>S.No.</td>
	<td>Image</td>
	<td>Title</td>
	<td>Options</td>
	</tr>
	</thead>
<tbody>
<?php
try
{
$c=DatabaseConnection::getConnection();
$rs=$c->query("select * from tbl_portfolio");
$x=1;
foreach ($rs as $row) {
	echo "<tr>";
	echo "<td>".$x."</td>";
	echo "<td><img src='".$row["image"]."' style='width:64px' ></td>";
	echo "<td>".$row["name"]."</td>";
	echo "<td><a href='DeletePortfolio.php?code=".$row["code"]."'>Delete</a> &nbsp;";
	echo "<a href='EditPortfolio.php?code=".$row["code"]."'>Edit</a> &nbsp;</td>";
	echo "</tr>";
	$x++;
}
}
catch(Exception $exception)
{
	echo $exception->getMessage();
}
?>
</tbody>
</table>
</div>

<div class="portfolio-modal modal fade" id="AddPortfolioModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <form action="AddPortfolio.php" method="post" enctype="multipart/form-data" id="AddPortfolioForm">
                            <label>Title</label>	
                            <input class="form-control" type="text" name="portfolioName"  id="portfolioName" required>
                            <label>Description</label>	
                            <textarea rows=5 class="form-control" id="portfolioDescription" name="portfolioDescription" required></textarea>
                            <hr class="star-primary">
                            <label>Image</label>	
                            <input type="file"  id="portfolioImage" name="portfolioImage" class="form-control" >	
                            <br/>
                            <button type="submit" id="AddPortfolioButton" class="btn btn-default" ><i class="fa fa-plus"></i> Add</button>
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