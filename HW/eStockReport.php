<!DOCTYPE html>
<html>
<head>
	<title>Export Report</title>
</head>
<body>
	<?php
	$file_stream = null;
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

	$myfile = fopen("StockReport.txt", "w")
	or die("Unable to open file!");

	

	$sql = "SELECT * FROM product_info;";
	$result = executeSql($sql);
	if($result[0]){
		$i=0;
		while ($row = mysqli_fetch_assoc($result[1])){
			$p_id=$row["p_id"];
			$p_name=$row["p_name"];
			$p_brand=$row["p_brand"];
			$p_type=$row["p_type"];
			$p_price=$row["p_price"];

			$p_inventory=0;
			$select_sql = "SELECT p_inventory FROM stock_info WHERE p_id = ".$p_id.";";

			$select_result=executeSql($select_sql);
			if($select_result[0]){
				while($select_rows = mysqli_fetch_assoc($select_result[1])){
					$p_inventory=$select_rows["p_inventory"];
				}
			}else{
				echo "not fetch";
			}

			$p_descr=$row["p_descr"];
			$p_color=$row["p_color"];
			$p_image_url = $row["p_image_url"];
			//$imageData = base64_encode(file_get_contents($p_image_url));

			$file_stream = $file_stream."Product ID: ".$p_id."\n";
			$file_stream = $file_stream."Product Name: ".$p_name."\n";
			$file_stream = $file_stream."Product Brand: ".$p_brand."\n";
			$file_stream = $file_stream."Product Type: ".$p_type."\n";
			$file_stream = $file_stream."Product Price: ".$p_price."\n";
			$file_stream = $file_stream."Product Inventory: ".$p_inventory."\n";
			$file_stream = $file_stream."Product Description: ".$p_descr."\n";
			$file_stream = $file_stream."Product Color: ".$p_color."\n";
			$file_stream = $file_stream."Product Image URL: ".$p_image_url."\n\n\n";
			$i++;
		}
	}

	//向文件中写入字符串
	fwrite($myfile, $file_stream);

	//关闭文件句柄
	fclose($myfile);

	function php_sendmail($stream){
		require('class.phpmailer.php');  

//$mail->Host = "ssl://smtp.gmail.com"; 
$mail = new PHPMailer(); //实例化  

$mail->IsSMTP(); // 启用SMTP  

//$mail->Host = "smtp.163.com"; //SMTP服务器 163邮箱例子  
$mail->Host = "smtp.126.com"; //SMTP服务器 126邮箱例子  
//$mail->Host = "smtp.qq.com"; //SMTP服务器 qq邮箱例子  

$mail->Port = 25;  //邮件发送端口  
$mail->SMTPAuth   = true;  //启用SMTP认证  

$mail->CharSet  = "UTF-8"; //字符集  
$mail->Encoding = "base64"; //编码方式  

$mail->Username = "";  //你的邮箱  
$mail->Password = "";  //你的密码  
$mail->Subject = "Product information updating"; //邮件标题  

$mail->From = "";  //发件人地址（也就是你的邮箱）  
$mail->FromName = "";   //发件人姓名  

$address = "";//收件人email  
$mail->AddAddress($address, "");    //添加收件人1（地址，昵称）    

//$mail->AddAttachment('xx.xls','我的附件.xls'); // 添加附件,并指定名称  

$mail->IsHTML(true); //支持html格式内容  
//$mail->AddEmbeddedImage("logo.jpg", "my-attach", "logo.jpg"); //设置邮件中的图片  
$mail->Body = $file_stream; //邮件主体内容  

//发送
if(!$mail->Send()){ 
	echo "Fialed to send " . $mail->ErrorInfo;  
} else {  
	echo "Successfully send the email!";  
}  
}

php_sendmail($file_stream);
header('location:view_order.php');
?>
</body>
</html>