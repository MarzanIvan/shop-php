<?
global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	try {
		require_once('../../ConnectDB.php');
        $access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
        if (!$access) die("Access denied");
		$CheckingProviderHavingMethod = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM MethodDeliveryProvider WHERE idProvider = ".$_POST['IdProvider']." and IdDeliveryMethod = ".$_POST['IdMethodDelivery']."; ");
        $CheckingProviderHavingMethod = mysqli_fetch_array($CheckingProviderHavingMethod);
		if ($CheckingProviderHavingMethod) {
			throw new Exception("The provider has already been had this method");
		}
		mysqli_query($Server->get_DB_HANDLE(),"
			INSERT INTO
			MethodDeliveryProvider
			(idProvider, IdDeliveryMethod)
			VALUES
			(".$_POST['IdProvider'].",".$_POST['IdMethodDelivery'].")
		");
	}
	catch( Exception $Error) {
		$ButtonToBack = '<br><a href="FormAddingInformation.php">Back</a>';
		die ($Error->getMessage().$ButtonToBack);
	}
?>
    <script type="text/javascript">
        document.location.href = '<?="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Source/AdminMethods/FormAddingInformation.php"?>';
    </script>
<?php
?>