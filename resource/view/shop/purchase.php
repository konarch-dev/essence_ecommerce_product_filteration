<?php

session_start();
//echo json_encode($_SESSION['cart']);

if($_POST["id"]!=0)
{


$_SESSION['cart'][]=array("id"=>$_POST['id'],"name"=>$_POST["name"]
,"category"=>$_POST['category'],"price"=>$_POST['price'],
"img"=>$_POST['img']);

}

//echo count($_SESSION['cart']);
//$_SESSION['cart']=[];

?>