<!DOCTYPE>
<?php 
session_start();
include("functions/functions.php");
include("admin_area/includes/db.php");
?>
<html>
<head>
<title>My online shop</title>
<link rel="stylesheet" href="styles/style.css" media="all" />
</head>
<body>
<div class="main_wrapper">
<div class="header_wrapper">
<a href="index.php"><img id="logo" src="images/logo1.jpg" "/></a>
<img id="banner" src="images/giphy.gif" width="70%" height="100px"/>
</div>
<div class="menubar">
<ul id="menu"><li> <a href="index.php">Home</a></li>
<li> <a href="all_products.php">All products</a></li>
<li> <a href="customer/my_account.php">My Account</a></li>
<li> <a href="#">Sign up</a></li>
<li> <a href="cart.php">Shopping cart</a></li>
<li> <a href="#">Contact Us</a></li>
</ul>
<div id="form">
<form method="get" action="results.php" enctype="multipart/form-data">
<input type="text" name="user_query" placeholder="search a product"/>
<input type="submit"name="search" value="search" />
</form>
</div>
</div>
<div class="content_wrapper">
<div id="sidebar">
<div id="sidebar_title">Categories</div>
<ul id="cats">
<?php getCats();?>
</ul>
<div id="sidebar_title">Brands</div>
<ul id="cats">
<?php getBrands();?>
</ul>
</div>
<div id="content_area">
<?php cart(); ?>
<div id="shopping_cart">
<span style="float:right; font-size:17px; padding:5px; line-height:40px;">
<?php 
if(isset($_SESSION['customer_email']))
{
	echo "<b>Welcome:</b>".$_SESSION['customer_email']."<b style='color:yellow;'>Your</b>";
}
else
	echo "<b>Welcome Guest:</b>";
?>
<b style="color:yellow;">Shopping Cart -</b>Total Items: <?php total_items(); ?> Total Price:<?php total_price(); ?> <a href="index.php" style="color:yellow">Back to shopping</a>
</span>
</div>
<div id="product_box">
<br />
<form action="" method="POST" enctype="multipart/form-data">
<table align="center" width="700px" bgcolor="skyblue">
<tr align="center">
<th>Remove</th>
<th>Product(S)</th>
<th>Quantity</th>
<th>Total Price</th>
</tr>
<?php
$total = 0;
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysql_query($sel_price); 
		
		while($p_price=mysql_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysql_query($pro_price); 
			
			while ($pp_price = mysql_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			$product_title=$pp_price['product_title'];
			$values = array_sum($product_price);
			$product_image=$pp_price['product_image'];
			$single_price=$pp_price['product_price'];
			$total+=$values;
?>
<tr align="center">
<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>" /></td>
<td><?php echo $product_title ;?><br>
<img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60" /></td>
<td><input type="text" size="4" name="qty" value="<?php echo $_SESSION["qty"] ;?>" /></td>
<?php 
$con=mysql_connect("localhost","root","") or die("Failed to Connect to Mysql");
//mysql_connect_errno() to find out error number
mysql_select_db("ecommerce");
if(isset($_POST['update_cart']))
{
	$qty=$_POST['qty'];
	$update_qty="update cart set qty='$qty' where
	p_id='$pro_id'";
	$run_qty=mysql_query($update_qty);
	//to pass the quantities entered to nxt page
	$_SESSION['qty']=$qty;
	$total=$total*$qty;
}
?>
<td><?php echo "Rs".$single_price; ?></td>
</tr>
		<?php }}?>
<tr align="right">
<td align="right" colspan="4"><b>SubTotal:  </b></td>
<td colspan="4"><?php echo $total; ?></td>
</tr>
<tr align="center">
<td colspan="2"><input type="submit" name="update_cart" value="Update Cart" /></td>
<td><input type="submit" name="continue" value="Continue Shopping" /></td>
<td><button> <a href="checkout.php" style="text-decoration:none; color:black; ">Checkout</a></button></td>
</tr>
</table>
</form>
<?php
function updatecart()
{
$ip=getIp();
if(isset($_POST['update_cart']))
{
	foreach($_POST['remove'] as $remove_id)
	{
		$delete_product="delete from cart where p_id='$remove_id' AND
		ip_add='$ip'";
		$run_delete=mysql_query($delete_product);
		if($run_delete)
		{echo "<script>window.open('cart.php','_self')</script>";}
	}
}
if(isset($_POST['continue']))
		{echo "<script>window.open('index.php','_self')</script>";}

	echo @$up_cart=updatecart();
}
?>
</div>

</div>
</div>
<div id="footer">
<h2 style="text-align:center;padding-top:30px;">&copy; 2018 by Jyotsna Munjal</h2>
</div>
</div>
</body>
</html>