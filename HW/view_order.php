<!DOCTYPE html>
<html>
<head>
	<title>Order Information</title>
</head>
<body>
	<?php
	if($_COOKIE['pay_status']){
		$o_id = $_COOKIE['o_id'];
		$u_id = $_COOKIE['u_id'];
		$tracking_num = $_COOKIE['d_id'];
		$pay_id = $_COOKIE['pay_id'];
		$total_item = $_COOKIE['total_item'];
		$phones_price = $_COOKIE['phones_price'];
		$shipment_price = $_COOKIE['shipment_price'];
		$total_price = $phones_price + $shipment_price;
		$pay_status = $_COOKIE['pay_status'];
		?>
		<table border="1">
			<caption><h2>Order information</h2></caption>
			<tr>
				<th>Order id</th>
				<th>User</th>
				<th>Tracking Number</th>
				<th>Product Price</th>
				<th>Delivery Price</th>
				<th>Total Items</th>
				<th>Total Price</th>
				<th>Payment ID</th>
				<th>Pay Status</th>
			</tr>
	<?php
			echo "<tr>";
			echo "<td>".$o_id."</td>";
			echo "<td>".$u_id."</td>";
			echo "<td>".$tracking_num."</td>";
			echo "<td>".$phones_price."HKD</td>";
			echo "<td>".$shipment_price."HKD</td>";
			echo "<td>".$total_item."</td>";
			echo "<td>".$total_price."HKD</td>";
			echo "<td>".$pay_id."</td>";
			if($pay_status){
				echo "<td>Paid</td>";
			}else{
				echo "<td>Not Paid</td>";
			}
			echo "</tr>";
			echo "</table>";
			echo "<br>";
			echo "<a href='eStockReport.php'>Export Product Report</a>";
			echo "<br>";
			echo "<br>";
			echo "<a href='eOrderReport.php'>Export Order Report</a>";
			echo "<br>";
			echo "<br>";
			echo "<a href='eDeliveryReport.php'>Export Delivery Report</a>";

		}else{
			header('location:payInfo.php');
		}
	?>
	</body>
	</html>