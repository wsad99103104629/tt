<!DOCTYPE html>
<html>
<head>
	<title>Add new product</title>
</head>
<body>
	<?php
	function executeSql($sql){
		$flag = false;
		if($sql == ""){
			echo "Error! Sql content is empty!";
			echo "<br>";
		}else{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "hw";

			// 创建连接
			$conn = new mysqli($servername, $username, $password, $dbname);
			// 检测连接
			if ($conn->connect_error) {
				die("Fail to connect!: " . $conn->connect_error);
			}
			//执行sql语句
			if ($conn->query($sql) === TRUE) {
				$flag = TRUE;
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			$conn->close();
			return $flag;
		}
	}

	$p_name=$_POST["name"];
	$p_brand=$_POST["brand"];
	$p_type=$_POST["type"];
	$p_price=$_POST["price"];
	$p_inventory=$_POST["inventory"];
	$p_descr=$_POST["descr"];
	$p_color=$_POST["color"];
	$p_image_url=$_POST["url"];

	if($p_name ==""||$p_brand ==""||$p_type ==""||$p_price ==""||$p_inventory ==""||$p_descr ==""||$p_color ==""){
		echo "You can not provide empty values!";
	}else{
		$sql = "INSERT INTO product_info(p_name,p_brand,p_type,p_price,p_descr,p_color,p_image_url) VALUES 
		('".$p_name."','".$p_brand."','".$p_type."','".$p_price."','".$p_descr."','".$p_color."','".$p_image_url."');";

		$result = executeSql($sql);
		if($result){
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

			$select_sql = "SELECT * FROM product_info WHERE p_name = '".$p_name."';";
			$result=mysqli_query($conn,$select_sql);//result is a PHP array

			var_dump($result);
			$num_rows=mysqli_num_rows($result);
			//echo $num_rows;

			mysqli_close($conn);

			while ($row = mysqli_fetch_assoc($result)){
			$p_id=$row["p_id"];

			$insert_sql = "INSERT INTO stock_info(p_id,p_inventory) VALUES (".$p_id.",".$p_inventory.");";
			$feedback = executeSql($insert_sql);
			if($feedback){
				header("location:p_manage.php");
			}
		}
	}
}


?>
<br>
</body>
</html>