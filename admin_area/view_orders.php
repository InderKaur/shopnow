<table width="780" align="center" bgcolor="pink">
<tr align="center">
<td colspan="6"><h2>View Your Orders details here:</h2></td>
</tr>
<tr align="center" bgcolor="skyblue">
<th>S.No</th>
<th>Email Id</th>
<th>Product(S)</th>
<th>Quantity</th>
<th>Invoice No</th>
<th>OrderDate</th>
<th>Actions</th>
</tr>
<?php
include("includes/db.php");
$get_order="select * from orders ";
$run_order=mysql_query($get_order);
$i=0;
while($row_order=mysql_fetch_array($run_order))
{
	$order_id=$row_order['order_id'];
	$qty=$row_order['qty'];
	$pro_id=$row_order['p_id'];
	$c_id=$row_order['c_id'];
	$invoice_no=$row_order['invoice_no'];
	$order_date=$row_order['order_date'];
	$status=$row_order['status'];
	$i++;
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
?>
<tr align="center">
<td><?php echo $i;?></td>
<td><?php echo $c_email; ?></td>
<td><?php echo $pro_title; ?>
<img src="../admin_area/product_images/<?php echo $pro_image; ?>" 
width="50" height="50" />
</td>
<td><?php echo $qty; ?></td>
<td><?php echo $invoice_no; ?></td>
<td><?php echo $order_date; ?></td>
<td><a href="index.php?confirm_order=<?php 
echo $order_id; ?>">Complete Order</a></td>

</tr>
<?php } ?>
</table>
