<?php
global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	if(isset($_POST)){
		try {
			require_once("../../ConnectDB.php");
            $access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
            if (!$access) die("Access denied");
			$CheckingHavingProviderInDB = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Providers WHERE name='".$_POST['name']."';");
			$CheckingHavingProviderInDB = mysqli_fetch_array($CheckingHavingProviderInDB);
			if($CheckingHavingProviderInDB) {
				throw new Exception("The provider has already been existed in the database");
			}
            mysqli_query($Server->get_DB_HANDLE(),"
				INSERT INTO 
				Providers
				(name, address, numbertelephone, email)
				VALUES
				('".$_POST['name']."','".$_POST['address']."','".$_POST['tel']."','".$_POST['email']."')"
			);
		}catch( Exception $Error) {
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