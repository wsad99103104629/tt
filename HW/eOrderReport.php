<!DOCTYPE html>
<html>
<head>
	<title>Export Report</title>
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
			mysqli_close($conn);
		}
	}

	$myfile = fopen("OrderReport.txt", "w")
	or die("Unable to open file!");

	$file_stream = null;

	$sql = "SELECT * FROM order_info;";
	$result = executeSql($sql);
	if($result[0]){
		$i=0;
		while ($row = mysqli_fetch_assoc($result[1])){
			$o_id=$row["o_id"];
			$u_id=$row["u_id"];
			$d_id=$row["d_id"];
			$o_date=$row["o_date"];
			$pay_id=$row["pay_id"];

			$file_stream = $file_stream."Order ID: ".$o_id."\n";
			$file_stream = $file_stream."User ID: ".$u_id."\n";
			$file_stream = $file_stream."Delivery ID: ".$d_id."\n";
			$file_stream = $file_stream."Order Date: ".$o_date."\n";
			$file_stream = $file_stream."Payment ID: ".$pay_id."\n";

			$select_sql = "SELECT * FROM orderDetailRecord_info WHERE o_id = ".$o_id.";";

			$select_result=executeSql($select_sql);
			if($select_result[0]){
				$j = 0;
				while($select_rows = mysqli_fetch_assoc($select_result[1])){
					$r_id=$select_rows["r_id"];
					$p_id=$select_rows["p_id"];
					$p_num=$select_rows["p_num"];

					$file_stream = $file_stream."Product ID: ".$p_id."   \t";
					$file_stream = $file_stream."Product Number: ".$p_num."\n";
					$j++;
				}
			}else{
				echo "not fetch";
			}
			$i++;
			$file_stream = $file_stream."\n\n\n";
		}
	}

	//向文件中写入字符串
	fwrite($myfile, $file_stream);

	//关闭文件句柄
	fclose($myfile);

	header('location:view_order.php');
	?>
</body>
</html>