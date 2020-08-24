<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Product information</title>
	<style>
	.button {
		background-color: #4CAF50;
		border: none;
		color: white;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;
		margin: 4px 2px;
		cursor: pointer;
		align-self:right;
		float: right;
	}
	.table{
	border-style:solid;
	border-color:#98bf21;
	align-self: center;
	align-items: center;
	width: "10%";
	}
	.body{font-family:Arial,Helvetica,sans-serif;font-size:20px;}
	a:link {color:#000000;}      /* 未访问链接*/
	a:visited {color:#4CAF50;}  /* 已访问链接 */
	a:hover {color:#4CAF50;}  /* 鼠标移动到链接上 */
	a:active {color:#0000FF;}  /* 鼠标点击时 */

	</style>
</head>
	<h2 align='center'>Welcome! You can buy your own phone here.</h2>
<body class="body">
	<table border="1" class="table"  align='center'>
    	<tr>
        	<th align='center' width="10%">Product Name</th>
        	<th align='center' width="10%">Product Brand</th>
        	<th align='center' width="10%">Product Type</th>
        	<th align='center' width="10%">Product Price</th>
        	<th align='center' width="10%">Product Inventory</th>
        	<th align='center' width="10%">Product Description</th>
        	<th align='center' width="10%">Product Color</th>
        	<th align='center' width="10%">Product Image</th>
        	<th align='center' width="10%">Add to Cart</th>
    	</tr>
	
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "hw";

		// 创建连接
		$conn = mysqli_connect($servername, $username, $password, $dbname);

		// Check connection
		if (mysqli_connect_errno()){
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  		}

		$sql = "SELECT * FROM product_info;";
		$result=mysqli_query($conn,$sql);//result is a PHP array

		$num_rows=mysqli_num_rows($result);
		//echo $num_rows;

		$i=0;
		while ($row = mysqli_fetch_assoc($result)){
			$p_id=$row["p_id"];
			$p_name=$row["p_name"];
			$p_brand=$row["p_brand"];
			$p_type=$row["p_type"];
			$p_price=$row["p_price"];

			$p_inventory=0;
			$select_sql = "SELECT p_inventory FROM stock_info WHERE p_id = ".$p_id.";";

			$select_result=mysqli_query($conn,$select_sql);
			$select_num_rows=mysqli_num_rows($result);
			if($select_num_rows){
				while($select_rows = mysqli_fetch_assoc($select_result)){
					$p_inventory=$select_rows["p_inventory"];
				}
			}else{
				echo "not fetch";
			}

			$p_descr=$row["p_descr"];
			$p_color=$row["p_color"];
			$p_image_url = $row["p_image_url"];
			
			echo "<tr>";
			echo "<td align='center'>".$p_name."</td>";
			echo "<td align='center'>".$p_brand."</td>";
			echo "<td align='center'>".$p_type."</td>";
			echo "<td align='center'>".$p_price."</td>";
			echo "<td align='center'>".$p_inventory."</td>";
			echo "<td align='center'>".$p_descr."</td>";
			echo "<td align='center'>".$p_color."</td>";

			//$image = 'https://cdn2.gsmarena.com/vv/pics/apple/apple-iphone-x-new-1.jpg';
			$imageData = base64_encode(file_get_contents($p_image_url));
			//var_dump($imageData);
			echo '<td align="center">[外链图片转存失败(img-ePhuvnsp-1562059529496)(data:image/jpeg;base64,'.$imageData.')]</td>';
?>

			<td><a  align='center' href='process_shopCart.php?goods_id=<?php echo $p_id; ?>&goods_name=<?php echo $p_name; ?>'>addCart</a></td>
<?php

			echo "</tr>";
			$i++;
		}
		mysqli_close($conn);
?>
	</table>
	<br><br>
	<a  align='right' href='view_shopCart.php'>Enough adding, click here to shopcart.</a>
	<br><br><br>
</body>
</html>