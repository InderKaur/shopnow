
<table width="795" align="center" bgcolor="pink">
<tr align="center">
<td colspan="6"><h2>View All Payments here:</h2></td>
</tr>
<tr align="center" bgcolor="skyblue">
<th>S.No</th>
<th>Customer Email</th>
<th>Product</th>
<th>Paid Amount</th>
<th>Transaction Id</th>
<th>Payment Date</th>
</tr>
<?php
include("includes/db.php");
$get_payment="select * from payments ";
$run_payment=mysql_query($get_payment);
$i=0;
while($row_payment=mysql_fetch_array($run_payment))
{
	$amount=$row_payment['amount'];
	$trx_id=$row_payment['trx_id'];
	$payment_date=$row_payment['payment_date'];
	$pro_id=$row_payment['product_id'];
	$c_id=$row_payment['customer_id'];
	$get_pro="select * from products
	where product_id='$pro_id'";
	$run_pro=mysql_query($get_pro);
	$row_pro=mysql_fetch_array($run_pro);
	$pro_image=$row_pro['product_image'];
	$pro_title=$row_pro['product_title'];
	$get_c="select * from customers where customer_id=
	'$c_id'";
	$run_c=mysql_query($get_c);
	$row_c=mysql_fetch_array($run_c);
	$c_email=$row_c['customer_email'];
	$i++;
?>
<tr align="center">
<td><?php echo $i;?></td>
<td><?php echo $c_email; ?></td>
<td><?php echo $pro_title; ?>
<img src="../admin_area/product_images/<?php echo $pro_image; ?>" 
width="50" height="50" />
</td>
<td><?php echo $amount; ?></td>
<td><?php echo $trx_id; ?></td>
<td><?php echo $payment_date; ?></td>


</tr>
<?php } ?>
</table>
