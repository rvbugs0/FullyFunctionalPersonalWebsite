<?php
require("DatabaseConnection.php");
require("partials/header.php");
?>

<div class="table-responsive" style="padding-top:200px;margin-left:150px;width:70%; ">
<h4>Portfolio</h4>
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
<?php
include("partials/footer.php");
?>