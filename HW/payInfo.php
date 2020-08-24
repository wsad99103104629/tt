<html>
<head>
	<meta charset="utf-8">
	<title>Shop cart</title>
</head>
<h1>Total money here, please fill your payment information.</h1>
<body>
	
	<?php
	if(isset($_COOKIE['pay_way'])){
		echo "You have fill the payment information.";
	?>
	<br>
		<a href='pay_money.php'>Click here to continue</a>
	<?php
	}
	else{
	?>
	<table border="1">
		<tr>
			<th>Total Item</th>
			<th>Phones Price</th>
			<th>Shipment Way</th>
			<th>Shipment Price</th>
			<th>Total Price</th>
		</tr>
		<?php
		$total_item = $_COOKIE['total_item'];
		$shipment_price = $_COOKIE['shipment_price'];
		$shipment_way = $_COOKIE['shipment_way'];
		$phonesPrice = $_COOKIE['phones_price'];
		$totalPrice = $shipment_price + $phonesPrice;
		echo "<tr>";
		echo "<td>".$total_item."</td>";
		echo "<td>".$phonesPrice."</td>";
		echo "<td>".$shipment_way."</td>";
		echo "<td>".$shipment_price."</td>";
		echo "<td>".$totalPrice."</td>";
		echo "</tr>";
		?>
	</table>
	<br>
	<form action="payway.php" method="post">
		<input type="radio" name="payway" value="Alipay" checked="">Alipay
		<input type="radio" name="payway" value="WeChatPay">WeChatPay
		<input type="radio" name="payway" value="Credit">Credit card
		<input type="radio" name="payway" value="UnionPay">UnionPay<br>
		<table border = '1'>
			<tr>
				<th>Pay user</th>
				<th>Pay account</th>
				<th>Receive user</th>
				<th>Receive account</th>
			</tr>
			<tr>
				<th><input type="text" name="payuser"></th>
				<th><input type="text" name="payaccount"></th>
				<th><input type="text" name="receiveuser"></th>
				<th><input type="text" name="receiveaccount"></th>
			</tr>
		</table>		
		<input type="submit" value="Submit">
	</form>
<?php
}
?>

</body>
</html>