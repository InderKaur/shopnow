<?php
include("includes/db.php");
if(isset($_GET['delete_cat']))
{
	$delete_id=$_GET['delete_cat'];
	$delete_cat="delete from categories where
	cat_id='$delete_id'";
	$run_delete=mysql_query($delete_cat);
	if($run_delete)
	{
		echo "<script>alert('Category deleted')</script>";
				echo "<script>
				window.open('index.php?view_cats','_self')</script>";
	}
}

?>