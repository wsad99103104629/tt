<html>
<head>
	<meta charset="utf-8">
	<title>Shipment</title>
</head>
<?php
if(isset($_COOKIE['shipment_status'])){
?>
<h1>You have already fill the shipment information</h1>
<body><a href='payInfo.php'>Click here to pay</a></body>
<?php
}
else{
?>
<h1>Choose your shipment way</h1>
<body>
	<form action="process_shipment.php" method="post">
		<table>
			<th>Delivery Company</th>
			<th>Orign Location</th>
			<th>Target Location</th>
			<tr>
				<td>
					<select name="company">
						<option value="">Choose Company</option>
						<option value="shun_feng">Shun Feng</option>
						<option value="zhong_tong">Zhong Tong</option>
						<option value="yuan_tong">Yuan Tong</option>
						<option value="yun_da">Yun Da</option>
						<option value="shen_tong">Shen Tong</option>
					</select><br>
				</td>
				<td><input type="text" name="orgn_location"></td>
				<td><input type="text" name="trgt_location"></td>
			</tr>
		</table>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
<?php
}
?>
</html>