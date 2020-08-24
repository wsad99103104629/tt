<!DOCTYPE html>
<html>
<head>
	<title>Order information</title>
</head>
<body>
	<?php
	function executeSql($sql){
		$flag = false;
		$feedback = array();
		if($sql == ""){
			echo "Error! Sql content is empty!";
		}else{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "hw";

			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$query_result=mysqli_query($conn,$sql);//query_result is a PHP array
			if($query_result){
				$flag = true;
				$feedback = $query_result;
				//$num_rows=mysqli_num_rows($query_result);
			}
			return array($flag,$feedback);
		}
	}

	function infoSplit($p_info){
		$result = array();
		$single_info = explode("/", $p_info);
		foreach($single_info as $val){
			$single_result = array();
			$details = explode(",",$val);
			foreach ($details as $value){
				array_push($single_result, $value);	
			}
			array_push($result, $single_result);
		}
		array_pop($result);
		return $result;
	}

	$u_id = $_COOKIE['u_id'];
	$d_id = $_COOKIE['d_id'];
	$pay_id = $_COOKIE['pay_id'];
	$p_info = $_COOKIE['p_info'];
	echo $p_info;
	$o_date = date("Y-m-d H:i:s");
	$o_id = 0;
	//echo gettype($o_date);

	$sql = "INSERT INTO order_info (u_id,d_id,o_date,pay_id) VALUES(".$u_id.",".$d_id.",'".$o_date."',".$pay_id.");";
	$insert_result = executeSql($sql);

	if($insert_result[0]){
		$select_sql = "SELECT o_id FROM order_info WHERE pay_id = ".$pay_id.";";
		$select_result = executeSql($select_sql);
		if($select_result[0]){
			while($row = mysqli_fetch_assoc($select_result[1])){
				$o_id=$row["o_id"];
				setcookie('o_id',$o_id);
			}
		}
	}

	$split_result = infoSplit($p_info);
	//var_dump($split_result);
	for($i = 0; $i < count($split_result);$i++){
		$p_id = $split_result[$i][0];
		$p_num = $split_result[$i][1];
		$p_inventory = 0;

		$insert_order_sql = "INSERT INTO orderDetailRecord_info (o_id,p_id,p_num) VALUES(".$o_id.",".$p_id.",".$p_num.");";
		$insert_order_result = executeSql($insert_order_sql);
		if($insert_order_result[0]){
    		//select product num from stock_info and update
			$select_stock_num_sql = "SELECT p_inventory FROM stock_info WHERE p_id = ".$p_id.";";
			$select_stock_num_result = executeSql($select_stock_num_sql);
			if($select_stock_num_result[0]){
				while($row = mysqli_fetch_assoc($select_stock_num_result[1])){
					$p_inventory = $row['p_inventory'];
				}
			}
			//update p_inventory
			$p_inventory = $p_inventory - $p_num;
			$update_sql = "UPDATE stock_info SET p_inventory = '".$p_inventory."' WHERE p_id = '".$p_id."';";
			$update_result = executeSql($update_sql);
			if($update_result[0]){
				header('location:view_order.php');
			}
		}
	}
		?>
	</body>
	</html>