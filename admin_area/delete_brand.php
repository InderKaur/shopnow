<?php
include("includes/db.php");
if(isset($_GET['delete_brand']))
{
	$delete_id=$_GET['delete_brand'];
	$delete_brand="delete from brands where
	brand_id='$delete_id'";
	$run_delete=mysql_query($delete_brand);
	if($run_delete)
	{
		echo "<script>alert('Brand has been deleted')</script>";
				echo "<script>
				window.open('index.php?view_brands','_self')</script>";
	}
}

?>