<?php
//getting the categories
$con=mysql_connect("localhost","root","");
mysql_select_db("ecommerce");
//getting user IP address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}
//creating the cart
function cart()
{
	if(isset($_GET['addcart']))
	{
		$ip=getIp();
		$pro_id=$_GET['addcart'];
		$check_pro="select * from cart where ip_add='$ip' AND p_id='$pro_id'";
		$run_check=mysql_query($check_pro);
		if(mysql_num_rows($run_check)>0)
			echo "";
		else
		{
			$insert_pro="insert into cart (p_id,ip_add) values('$pro_id','$ip')";
			$run_pro=mysql_query($insert_pro);
			echo "<script>window.open('','_self')</script>";
		}
	}
}
//getting the total added items
function total_items()
{
	if(isset($_GET['addcart']))
	{
		$ip=getIp();
		$get_items="select * from cart where ip_add='$ip'";
		$run_items=mysql_query($get_items);
		$count_items=mysql_num_rows($run_items);	
	}
	else{
		$ip=getIp();
		$get_items="select * from cart where ip_add='$ip'";
		$run_items=mysql_query($get_items);
		$count_items=mysql_num_rows($run_items);	
	}
	echo $count_items;	
}
function total_price(){
	
		$total = 0;
		
		//global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysql_query($sel_price); 
		
		while($p_price=mysql_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysql_query($pro_price); 
			
			while ($pp_price = mysql_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			
			$values = array_sum($product_price);
			
			$total +=$values;
			
			}
		
		
		}
		
		echo "Rs" . $total;
		
	
	}
function getCats()
{
	global $con;
	$get_cats="select * from categories";
	$run_cats=mysql_query($get_cats);
	while($row_cats=mysql_fetch_array($run_cats))
	{
		$cat_id=$row_cats['cat_id'];
		$cat_title=$row_cats['cat_title'];
		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}

//getting brands
function getBrands()
{
	global $con;
	$get_brands="select * from brands";
	$run_brands=mysql_query($get_brands);
	while($row_brands=mysql_fetch_array($run_brands))
	{
		$brand_id=$row_brands['brand_id'];
		$brand_title=$row_brands['brand_title'];
		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}
function getPro()
{
if(!isset($_GET['cat']))
{
	if(!isset($_GET['brand']))
	{
	$get_pro="select * from products order by RAND() LIMIT 0,6";
	$run_pro=mysql_query($get_pro);
	while($row_pro=mysql_fetch_array($run_pro))
	{
		$pro_id=$row_pro['product_id'];
		$pro_cat=$row_pro['product_cat'];
		$pro_brand=$row_pro['product_brand'];
		$pro_title=$row_pro['product_title'];
		$pro_price=$row_pro['product_price'];
		$pro_image=$row_pro['product_image'];
		echo "
		<div id='single_product'>
		<h3>$pro_title</h3>
		<img src='admin_area/product_images/$pro_image' width='180' height='180'>
		<p><b><center>Price: Rs$pro_price</center></b></p>
		<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
		<a href='index.php?addcart=$pro_id'><button style='float:right'>Add to Cart</button></a>
		</div>
		";
	}
	}
}
}

function getCatPro()
{
if(isset($_GET['cat']))
{
	$cat_id=$_GET['cat'];
	$get_pro="select * from products where product_cat='$cat_id'";
	$run_pro=mysql_query($get_pro);
	$count_cats=mysql_num_rows($run_pro);
	if($count_cats==0)
	{
		echo "<h2 style='padding:20px'>There is no product in this category</h2>";
	}
	else
	{
	while($row_pro=mysql_fetch_array($run_pro))
	{
		$pro_id=$row_pro['product_id'];
		$pro_cat=$row_pro['product_cat'];
		$pro_brand=$row_pro['product_brand'];
		$pro_title=$row_pro['product_title'];
		$pro_price=$row_pro['product_price'];
		$pro_image=$row_pro['product_image'];
		echo "
		<div id='single_product'>
		<h3>$pro_title</h3>
		<img src='admin_area/product_images/$pro_image' width='180' height='180'>
		<p><b><center>Price: Rs$pro_price</center></b></p>
		<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
		<a href='index.php?addcart=$pro_id'><button style='float:right'>Add to Cart</button></a>
		</div>
		";
	}
}}
}
function getBrandPro()
{
if(isset($_GET['brand']))
{
	$brand_id=$_GET['brand'];
	$get_pro="select * from products where product_brand='$brand_id'";
	$run_pro=mysql_query($get_pro);
	$count_cats=mysql_num_rows($run_pro);
	if($count_cats==0)
	{
		echo "<h2 style='padding:20px'>There is no product in this category</h2>";
	}
	else
	{
	while($row_pro=mysql_fetch_array($run_pro))
	{
		$pro_id=$row_pro['product_id'];
		$pro_cat=$row_pro['product_cat'];
		$pro_brand=$row_pro['product_brand'];
		$pro_title=$row_pro['product_title'];
		$pro_price=$row_pro['product_price'];
		$pro_image=$row_pro['product_image'];
		echo "
		<div id='single_product'>
		<h3>$pro_title</h3>
		<img src='admin_area/product_images/$pro_image' width='180' height='180'>
		<p><b><center>Price: Rs$pro_price</center></b></p>
		<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
		<a href='index.php?addcart=$pro_id'><button style='float:right'>Add to Cart</button></a>
		</div>
		";
	}
}}
}
?>