<?php
	$q = isset($_GET['q'])? htmlspecialchars($_GET['q']) : '';
		if($q == "") {
                echo "You must choose a charactor!";
            }else if($q != ""){
                if($q =='admin') {
                    header('Location: adminSign.php');
                } else if($q =='user') {
                    header('Location: sign.php');
                }
            }
	?>
<html>
<head>
	<meta charset="utf-8">
	<title>Sign in to phone website</title>
</head>	
	<h1>Choose your charactor</h1>
	Please choose which kind of charactor you want to sign in?
	<form action="chooseCharactor.php" method="get">
    	<select name="q">
    	<option value="">Choose charactor</option>
    	<option value="admin">Admin</option>
    	<option value="user">User</option>
    	</select><br>
    	<input type="submit" value="Submit">
	</form>
</html>