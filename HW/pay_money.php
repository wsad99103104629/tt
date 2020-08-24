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

if(isset($_COOKIE['pay_way'])){
	$payWay = $_COOKIE['pay_way'];
}else{
	echo "Error!";
}

if($payWay == "Alipay"){
	echo "<script>window.open('https://auth.alipay.com/login/index.htm?goto=https%3A%2F%2Fmy.alipay.com%2Fportal%2Fi.htm')</script>";
	//$image_url = "https://www.hkelectric.com/zh/CustomerServices/PublishingImages/Alipay_Download_QR.jpg";
	//$imageData = base64_encode(file_get_contents($image_url));
	//echo '[外链图片转存失败(img-0UVbanjU-1562059529497)(data:image/jpeg;base64,'.$imageData.')]';
}else if($payWay == "WeChatPay"){
	//$image_url = "https://3.bp.blogspot.com/-ymZs4Aij_f8/WnXUq9v5Z9I/AAAAAAAAFeA/Zrnru65sDLEgGbVbJ_KevD9_izoL3YO5wCLcBGAs/s1600/wechat.jpg";
	//$imageData = base64_encode(file_get_contents($image_url));
	//var_dump($imageData);
	//echo '[外链图片转存失败(img-Ji9HZKJS-1562059529497)(data:image/jpeg;base64,'.$imageData.')]';
	echo "<script>window.open('https://pay.weixin.qq.com/index.php/public/wechatpay')</script>";
}else if($payWay == "Credit"){
	echo "<script>window.open('https://bank.hangseng.com/1/2/chi/e-services/personal-ebanking/hk-personal-ebanking')</script>";
}else if($payWay == "UnionPay"){
	echo "<script>window.open('https://cn.unionpay.com/front.do')</script>";
}

setcookie('pay_status',true);

$sql = "UPDATE payment_info SET pay_status=1 WHERE pay_id = ".$_COOKIE['pay_id'].";";
$result = executeSql($sql);
if($result[0]){
	echo "<br>";
	echo "<br>";
	echo "<a href='process_order.php'>Click here to see order information.</a>";
}else{
	echo "You have to pay first!";
}


?>