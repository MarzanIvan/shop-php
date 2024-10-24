<?global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	if(isset($_POST)) {
		try {
			require_once("../../ConnectDB.php");
            $access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
            if (!$access) die("Access denied");
			$CheckingUsingThisMethod = mysqli_query($Server->get_DB_HANDLE(),"
				SELECT 
				id 
				FROM 
				MethodDeliveryProvider 
				WHERE
				IdDeliveryMethod = ".$_POST['id']."
				;");
			$CheckingUsingThisMethod = mysqli_fetch_array($CheckingUsingThisMethod);
			if ($CheckingUsingThisMethod) {
				throw new Exception("This method is used by some provider");
			}
			mysqli_query($Server->get_DB_HANDLE(),"DELETE FROM DeliveryMethod WHERE id=".$_POST['id'].";");
            ?>
            <script type="text/javascript">
            document.location.href = '<?="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Source/AdminMethods/FormAddingInformation.php"?>';
	        </script><?php
		} catch (Exception $ErrorDeletingMethod) {
			$ButtonToBack = '<br><a href="FormAddingInformation.php">Back</a>';
			die ($ErrorDeletingMethod->getMessage().$ButtonToBack);
		}
		
	}
?>
    <script type="text/javascript">
        document.location.href = '<?="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Source/AdminMethods/FormAddingInformation.php"?>';
    </script>
<?php
?>