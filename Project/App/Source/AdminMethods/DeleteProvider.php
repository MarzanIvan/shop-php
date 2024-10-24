<?global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	require_once("../../ConnectDB.php");
$access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
if (!$access) die("Access denied");
	mysqli_query($Server->get_DB_HANDLE(),"
		DELETE
		FROM
		ProductsProviders
		WHERE
		idProvider = ".$_POST['id'].";
	");
	mysqli_query($Server->get_DB_HANDLE(),"
		DELETE 
		FROM 
		Providers 
		WHERE 
		id=".$_POST['id'].";
	");
?>
    <script type="text/javascript">
        document.location.href = '<?="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Source/AdminMethods/FormAddingInformation.php"?>';
    </script>
<?php
?>