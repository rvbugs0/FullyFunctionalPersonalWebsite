<?php
require("DatabaseConnection.php");
function createHomePageCustomizationArea()
{
	try
{
    $c=DatabaseConnection::getConnection();
    $rs=$c->query("select * from tbl_homedata");
    echo '<form  action="" method="GET"  >';
    foreach($rs as $row)
    {
        echo "<label>".$row["propertyLabel"]."</label>";
echo '<input type="text" class="form-control"  name="'.$row["propertyName"].'" value="'.$row["propertyValue"].'" required >';
    echo "<br/>";
    }
    echo '<button type="submit" class="btn btn-success btn-lg myButton pull-right">Save</button>';
    echo "<br/>";
    echo "</form>";
}
catch(Exception $exception)
{
    echo $exception->getMessage();
}
}


?>