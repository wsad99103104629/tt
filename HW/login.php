<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login in to phone website</title>
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
		float: left;
	}
	.body{font-family:Arial,Helvetica,sans-serif;font-size:20px;}
	</style>
<h2>User Login</h2>
</head>
	<body class = "body">
        <?php
		if(isset($_COOKIE['login_status'])){
            echo "Login already.";
        
        
        
        ?>
		<br>
		<br>
		<a href='showPhones.php'>Click here to buy phones.</a>
        
        <?php
		}else{
            
		?>
		<form action="process_login.php" method="post">
				<a value="admin">admin</a>
 			User name:<input type="text" name="username"><br>
			User password:<input type="password" name="psw"><br>
			<input type="submit" class = "button" name="submit" value="Choose">
		</form>
		<?php
		}
		?>
	</body>
</html>