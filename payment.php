<div>
<?php		
include("includes/db.php");
$total = 0;
		
		//global $con; 
		
		$ip = getIp(); 
		
		$sel_price = "select * from cart where ip_add='$ip'";
		
		$run_price = mysql_query($sel_price); 
		
		while($p_price=mysql_fetch_array($run_price))
		{
			
			$pro_id = $p_price['p_id']; 
			
			$pro_price = "select * from products where product_id='$pro_id'";
			
			$run_pro_price = mysql_query($pro_price); 
			
			while ($pp_price = mysql_fetch_array($run_pro_price)){
			
			$product_price = array($pp_price['product_price']);
			$product_name=$pp_price['product_title'];
			$values = array_sum($product_price);
			
			$total +=$values;
			
			
			}
		}
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
	}
		?>
<h2 align="center" style="padding:2px; ">Pay Now with Paypal</h2>
<p style="text-align:center;">
<center>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="munjaljyotsna1997@gmail.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
  <input type="hidden" name="item_number" value="<?php echo $pro_id?>">
  <input type="hidden" name="amount" value="<?php echo $total; ?>">
  <input type="hidden" name="quantity" value="<?php echo $qty; ?>">
  <input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="return" value="localhost/ecommerce/paypal_success.php" />
	<input type="hidden" name="cancel_return" value="localhost/ecommerce/paypal_cancel.php" />
  <!-- Display the payment button. -->
  <input type="image" name="submit" border="0"
  src="https://i0.wp.com/vhconvention.com/wp-content/uploads/2017/10/paypal-checkout-button.png"
  width="250" height="150" alt="Buy Now">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form></center></p>
</div>