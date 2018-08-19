<?php
include("includes/db.php");
if(isset($_GET['delete_c']))
{
	$delete_id=$_GET['delete_c'];
	$delete_cust="delete from customers where
	customer_id='$delete_id'";
	$run_delete=mysql_query($delete_cust);
	if($run_delete)
	{
		echo "<script>alert('customer has been deleted')</script>";
				echo "<script>
				window.open('index.php?view_customers','_self')</script>";
	}
}

?>