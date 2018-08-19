<form action="" method="post" style="padding:80px;">
<b>Insert new Category</b>
<input type="text" name="new_cat" required/>
<input type="submit" name="add_cat" value="Add Category" required/>
</form>
<?php 
include("includes/db.php");
if(isset($_POST['add_cat']))
{
$new_cat=$_POST['new_cat'];
$insert_cat="insert into categories(cat_title) values('$new_cat')";
$run_cat=mysql_query($insert_cat);
if($run_cat)
{
	echo "<script> alert('New Category has been inserted')</script>";
	echo "<script>window.open('index.php?view_cats','_self')</script>";
}
}


?>