<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Read product information from database</title>
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
	a:link {color:#000000;}      /* 未访问链接*/
	a:visited {color:#4CAF50;}  /* 已访问链接 */
	a:hover {color:#4CAF50;}  /* 鼠标移动到链接上 */
	a:active {color:#0000FF;}  /* 鼠标点击时 */
	</style>
</head>
	<h1 align="center">Welcome! Admin user. This is the page of Product Management.</h1>
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
	<script>
		function newPage(){
			window.location.assign("add_product.html")
		}
		function deleteProduct(p_id){
			$.ajax({
				type: "POST",
				url: "deleteProduct.php",
				data: "pid="+p_id,
				success: function(msg){
					window.location.reload();
				}
			});
		}
	</script>
<body>
	<table border="1" align="center" class = "table">
    	<tr>
        	<th align="center" width="10%">Product ID</th>
        	<th align="center" width="10%">Product Name</th>
        	<th align="center" width="10%">Product Brand</th>
        	<th align="center" width="10%">Product Type</th>
        	<th align="center" width="10%">Product Price</th>
        	<th align="center" width="10%">Product Inventory</th>
        	<th align="center" width="10%">Product Description</th>
        	<th align="center" width="10%">Product Color</th>
        	<th align="center" width="10%">Product Image</th>
        	<th align="center" width="10%">Delete Product</th>
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
			echo "<td align='center'>".$p_id."</td>";
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
			//echo '<div class="img">';
			echo '<td align="center">[外链图片转存失败(img-WDPS9q7a-1562059529495)(data:image/jpeg;base64,'.$imageData.')]</td>';
			//echo '</div>';
			//echo "<td><input type='button' value='Delete' onclick='deleteProduct(".$p_id.")'></td>";
			?>
			<td align="center"><a href='deleteProduct.php?goods_id=<?php echo $p_id; ?>'>Delete</a></td>
			<?php
			echo "</tr>";
			$i++;
		}
		mysqli_close($conn);
	?>
	</table>
	<br><br>
	<div class="divcss5-right">
	<input type="button" class = "button" value="Add new product" onclick="newPage()">
	</div>
</body>
</html>