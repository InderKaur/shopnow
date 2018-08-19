<?php 
include("includes/db.php");
if(isset($_GET['edit_brand']))
{
	$brand_id=$_GET['edit_brand'];
	$get_brand="select * from brands where brand_id='$brand_id'";
	$run_brand=mysql_query($get_brand);
	$row_brand=mysql_fetch_array($run_brand);
	$brand_id=$row_brand['brand_id'];
	$brand_title=$row_brand['brand_title'];

}
?>


<form action="" method="post" style="padding:80px;">
<b>Update Brand</b>
<input type="text" name="new_brand" value="<?php echo $brand_title; ?>"/>
<input type="submit" name="update_brand" value="Update Brand" required/>
</form>
<?php 
include("includes/db.php");
if(isset($_POST['update_brand']))
{
$new_brand=$_POST['new_brand'];
$insert_brand="update brands set brand_title='$new_brand' where
brand_id='$brand_id'";
$run_brand=mysql_query($insert_brand);
if($run_brand)
{
	echo "<script> alert('Brand has been updated')</script>";
	echo "<script>window.open('index.php?view_brands','_self')</script>";
}
}


?>