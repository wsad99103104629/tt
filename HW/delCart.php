<?php
session_start();

//$p_name = $_GET["goods_name"];
$p_id = $_GET["goods_id"];
$goods_num = 1;


function id_inarray($findID, $cart_array)
{
    $flag = false;
    $counter = 0;
    foreach ($cart_array as $itemList) {
        if (strcmp($itemList[0], $findID) == 0) {
            $flag = true;
            break;
        }
        $counter++;
    }
    return array($flag, $counter);
}



$result = id_inarray($p_id,$_SESSION['shop-cart']);

if($result[0]){
	//如果存在该项,从session中删除
	if(isset($result[1])){
		unset($_SESSION['shop-cart'][$result[1]]);
		$_SESSION['shop-cart'] = array_values($_SESSION['shop-cart']);
	}
}else{
	echo "Cannot delete non-existent items!";
}

header("location:view_shopCart.php");
?>