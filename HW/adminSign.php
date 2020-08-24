<?php
	include 'executeSql.php';
	$userName = $_POST["username"];
	$pwd = $_POST["psw"];
	$cofPsw = $_POST["cofpsw"];
	$invtNum = $_POST["invtnum"];

	if($userName == ""||$pwd == ""||$cofPsw == ""|| $invtNum == ""){
		echo "None of the value can be empty!";
	}else if($pwd != $cofPsw){
		echo "The password entered for two time is not same!";
	}else if($invtNum != "SN90IE58KP"){//邀請碼
		echo "The invitation number is wrong!";	
	}else{
		echo "All values are right, your have sucessfully sign in as admin user!";
		$sql = "INSERT INTO admin_info (admin_name,admin_pwd) VALUES('" . $userName . "','" . $pwd . "');";
		//$sql = "INSERT INTO admin_info (admin_name,admin_pwd) VALUES('superadmin','admin123');";
		//echo $sql;
		executeSql($sql);
	}
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign in to phone website as admin user</title>
</head>	
	<h1>Sign in</h1>
	<form action="adminSign.php" method="post">
 		User name:<input type="text" name="username"><br>
 		User password:<input type="password" name="psw"><br>
 		Confirm user password:<input type="password" name="cofpsw"><br>
 		Invitation number:<input type="text" name="invtnum"><br>
 		<input type="submit" name="submit">
	</form>
	If you have already signed in, please click here to login.<br>
	<a href="login.php" target="_blank">Login into the website.</a>
</html>