<?php 
session_start();
?>
<html>
<head>
<title>Payment Successful!</title>
</head>
<body>
<?php
include("includes/db.php");
//this is all for product details
$total = 0;
		
		//global $con; 
		include("functions/functions.php");
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysql_query($sel_price); 
		
		while($p_price=mysql_fetch_array($run_price)){
			
			$pro_id = $p_price['p_id']; 
			$pro_name=$pp_price['pro_name'];
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysql_query($pro_price); 
			
			while ($pp_price = mysql_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			$product_id=$pp_price['product_id'];
			$values = array_sum($product_price);
			
			$total +=$values;
			
			}
		}
	//getting quantity of product
	$get_qty="select * from cart
	where p_id='$pro_id'";
	$run_qty=mysql_query($get_qty);
	$row_qty=mysql_fetch_array($run_qty);
	$qty=$row_qty['qty'];
	if($qty==0)
	{
		$qty=1;
	}
	else
	{
		$qty=$qty;
		$total=$total*$qty;
	}
		//this is about customer
$user=$_SESSION['customer_email'];
$get_c="select * from customers where
customer_email='$user'";
$run_c=mysql_query($get_c);
$row_c=mysql_fetch_array($run_c);
$c_id=$row_c['customer_id'];
$c_email=$row_c['customer_email'];
$c_name=$row_c['customer_name'];
//payment details from paypal
$amount=$_GET['amt'];
$currency=$_GET['cc'];
$trx_id=$_GET['tx'];
$invoice=mt_rand();
//inserting paymnts to table
$insert_payments="insert into payments
(amount,customer_id,product_id,trx_id,currency,payment_date)
 values('$amount','$c_id','$pro_id','$trx_id','$currency',NOW())";
 $run_payments=mysql_query($insert_payments);
 $insert_order="insert into orders
 (p_id,c_id,qty,invoice_no,order_date,status) values('$pro_id','$c_id','$qty','$invoice',NOW(),'in Progress')";
 $run_order=mysql_query($insert_order);
 //refreshing cart when all products are urchased
 $empty_cart="delete from cart";
 $run_cart=mysql_query($empty_cart);
if($amount==$total)
{
	echo "<h2>Welcome:".$_SESSION['customer_email']."<br>"."Your Payment was successful!
	</h2>";
	echo "<a href='localhost/customer/my_account.php'>
	Go to your Account</a>";
}
else
{
	echo "<h2>Welcome Guest, Payment was failed</h2><br>";
	echo "<a href='http://www.jyotsnamunjal.com/myshop'>Go Back to shop</a>";
}	
$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: <jyotsnamunjal9@gmail.com>' . "\r\n";
			
			$subject = "Order Details";
			
			$message = "<html> 
			<p>
			
			Hello dear <b style='color:blue;'>$c_name</b> you have ordered some products on our website onlinetuting.com, please find your order details, your order will be processed shortly. Thank you!</p>
			
				<table width='600' align='center' bgcolor='#FFCC99' border='2'>
			
					<tr align='center'><td colspan='6'><h2>Your Order Details from onlinetuting.com</h2></td></tr>
					
					<tr align='center'>
						<th><b>S.N</b></th>
						<th><b>Product Name</b></th>
						<th><b>Quantity</b></th>
						<th><b>Paid Amount</th></th>
						<th>Invoice No</th>
					</tr>
					
					<tr align='center'>
						<td>1</td>
						<td>$pro_name</td>
						<td>$qty</td>
						<td>$amount</td>
						<td>$invoice</td>
					</tr>
			
				</table>
				
				<h3>Please go to your account and see your order details!</h3>
				
				<h2> <a href='http://www.onlinetuting.com/myshop'>Click here</a> to login to your account</h2>
				
				<h3> Thank you for your order @ - www.onlinetuting.com</h3>
				
			</html>
			
			";
			
			mail('jyotsnamunjal2209@gmail.com',$subject,$message,$headers);
			?>
			</body>
			</html>







