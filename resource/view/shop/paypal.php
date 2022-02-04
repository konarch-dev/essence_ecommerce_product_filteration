
<?php
session_start();
    header("Pragma: no-cache");
    header("Cache-Control: no-cache");
    header("Expires: 0");
?>

<html>
<body>

    <form method="POST" name="myform" action="pgRedirect.php">
	 <input id="ORDER_ID"  name="ORDER_ID" value="<?php echo "OD".rand(10000,500000) ?>" type="hidden"/>

    <input type="text" id="CUST_ID" name="CUST_ID" value="CUST001"/>
<input id="INDUSTRY_TYPE_ID" name="INDUSTRY_TYPE_ID" type="hidden" value="Film" />

    <input id="CHANNEL_ID" name="CHANNEL_ID" type="hidden" value="WEB"/>
    <input type="hidden" id="TXN_AMOUNT" name="TXN_AMOUNT" value="<?php echo array_sum(array_column($_SESSION['cart'], 'price')); ?>" />
</form>

  <script>document.myform.submit();</script>
</body>



</html>