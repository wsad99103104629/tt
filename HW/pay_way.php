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

	$payWay = $_POST['payway'];
	$payUser = $_POST['payuser'];
	$payAccount = $_POST['payaccount'];
	$receiveUser = $_POST['receiveuser'];
	$receiveAccount = $_POST['receiveaccount'];
	$payStatus = false;

	$numbers = range (1,1000000); 
	shuffle ($numbers); 
	$num=1; 
	$result = array_slice($numbers,0,$num); 
	$pay_random = $result[0];

	if($payUser == "" ||$payAccount == "" || $receiveUser == "" || $receiveAccount == ""){
		echo "You must fill the blanks.";
	}else{
		$sql = "INSERT INTO payment_info (pay_user, receive_user, pay_account, receive_account,pay_way,pay_status,pay_random)
		VALUES ('".$payUser."', '".$receiveUser."', ".$payAccount.",".$receiveAccount.",'".$payWay."','".$payStatus."',".$pay_random.");";

		$result = executeSql($sql);

		if($result[0]){
			$select_sql = "SELECT pay_id FROM payment_info WHERE pay_random = ".$pay_random.";";
			$select_result = executeSql($select_sql);
			if($select_result[0]){
				while ($row = mysqli_fetch_assoc($select_result[1])){
					$pay_id=$row["pay_id"];
					setcookie('pay_id',$pay_id);
				}
			}
			setcookie('pay_way',$payWay);
		}
		header("location:pay_money.php");
	}
?>