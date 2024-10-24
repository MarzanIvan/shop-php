<?
global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	if (isset($_POST)) {
		try {
			require_once('../../ConnectDB.php');
            $access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
            if (!$access) die("Access denied");
			$CheckingHavingMethodInDB = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM DeliveryMethod WHERE name='".$_POST['namedelivery']."' and price=".$_POST['pricedelivery'].";");
            $CheckingHavingMethodInDB = mysqli_fetch_array($CheckingHavingMethodInDB);
            if ($CheckingHavingMethodInDB) {
				throw new Exception("The method has already been existed");
			}
            mysqli_query($Server->get_DB_HANDLE(),"
				INSERT INTO
				DeliveryMethod
				(name, price, SpeedDeliveryInDays)
				VALUES
				('".$_POST['namedelivery']."',".$_POST['pricedelivery'].", ".$_POST['SpeedDelivery'].");
				");
		}
		catch( Exception $Error) {
			$ButtonToBack = '<br><a href="FormAddingInformation.php">Back</a>';
			die ($Error->getMessage().$ButtonToBack);
		}
	}
?>
    <script type="text/javascript">
        document.location.href = '<?="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Source/AdminMethods/FormAddingInformation.php"?>';
    </script>
<?php
?>