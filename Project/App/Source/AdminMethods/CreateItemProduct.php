<?global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	header('Content-Type: text/html; charset=utf-8');
	require_once("../../ConnectDB.php");
	require_once("../Declarations/Classes.php");
$access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
	if (!$access) die("Access denied");
	$NewPathFile = "Photoes/".time().$_FILES['File']['name'];
	$NewPathFile = iconv("utf-8","cp1251",  $NewPathFile);
	$SaveFile = new File( $_FILES['File']['tmp_name'] );
	$SaveFile->SaveFileToPath($NewPathFile);
	$PathLoadingFile = $_FILES['File']['tmp_name'];
	$NewPathFile = iconv("cp1251","utf-8",  $NewPathFile);
mysqli_query($Server->get_DB_HANDLE(),"
		INSERT INTO 
		ItemProducts
		( price, pathimage, amount, Specifications, idProduct, IdDeliveryMethod )
		VALUES
		(
			".$_POST['Price'].",
			'".$NewPathFile."',
			".$_POST['AmountProduct'].",
			'".$_POST['Specifications']."',
			".$_POST['IdProduct'].",
			".$_POST['IdMethodDelivery'].");
		");
?>
<script type="text/javascript">
	document.location.href = '<?="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Source/AdminMethods/FormAddingInformation.php"?>';
</script>
<?php
?>
