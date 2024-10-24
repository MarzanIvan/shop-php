<?php
global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	if(isset($_POST)) {
		try {
			require_once("../../ConnectDB.php");
			$access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
			if (!$access) die("Access denied");
			$CheckingHavingCategoryInDB = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Categories WHERE name='".$_POST['name']."';");
            $CheckingHavingCategoryInDB = mysqli_fetch_array($CheckingHavingCategoryInDB);
			if($CheckingHavingCategoryInDB) {
				throw new Exception("The category has already been existed in the database");
			}
			mysqli_query($Server->get_DB_HANDLE(),"
				INSERT INTO 
				Categories(name) 
				VALUES
				('".$_POST['name']."');
			");
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
