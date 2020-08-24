<!DOCTYPE html>
<html>
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


	$userName = $_POST["username"];
	$pwd = $_POST["psw"];

	if(isset($_POST["submit"])){
		$Charactor = $_POST["character"];	
	}else{
		echo "You have choose the wrong charactor!";
		echo "<br>";
	}

	if($userName == ""||$pwd == ""){
		echo "None of the value can be empty!";
		echo "<br>";
	}

	//declare the sql var and decides the value
	//$sql;
	if($Charactor == "admin"){
		$sql = "SELECT admin_id FROM admin_info WHERE admin_name = '" . $userName . "' and admin_pwd = '". $pwd ." ' ;" ;
		$result = executeSql($sql);
		if ($result[0]) {
			header('Location: p_manage.php');
		} else {
			echo "Error! Something wrong in your username or password!";
			echo "<br>";
		}
	}else if($Charactor == "user"){
		$sql = "SELECT u_id FROM user_info WHERE u_name = '" . $userName ."' and u_pwd = '".$pwd."' ;" ;
		$result = executeSql($sql);

		if($result[0]){
			setcookie('login_status',true);
			while ($row = mysqli_fetch_assoc($result[1])){
					$u_id=$row["u_id"];
					setcookie('u_id',$u_id);
			}
			header('Location: showPhones.php');
		}else{
			echo "Error! Something wrong in your username or password!";
			echo "<br>";
		}
	}
	?>
</body>
</html>