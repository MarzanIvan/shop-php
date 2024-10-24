<?
global$Server;
	try {
		SESSION_START();
		require_once('ConnectDB.php');
		$DataOrder = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM BasketOrders WHERE id=".$_POST['IdOrder'].";");
		if (!mysqli_fetch_array($DataOrder)) {
			throw new Exception("There isn't such order");
		}
        mysqli_query($Server->get_DB_HANDLE(),"DELETE FROM BasketOrders WHERE id=".$_POST['IdOrder'].";");
		?>
			<script>
				document.location.href='<?= "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/ListOrders.php?Message=Your order has been closed"?>';
			</script>
		<?
	} 
	catch (Exception $ErrorDeletingOrder ) {
		$Message = $ErrorDeletingOrder->getMessage();
		?>
			<script>
				document.location.href='<?= "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/ListOrders.php?Message=<?=$Message;"?>';
			</script>
		<?
	}
?>