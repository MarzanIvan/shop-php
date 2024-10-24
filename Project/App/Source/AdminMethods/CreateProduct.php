<?global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	require_once("../../ConnectDB.php");
$access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
if (!$access) die("Access denied");
	$responcedb = mysqli_query($Server->get_DB_HANDLE(),"
		INSERT INTO
		Products
		(name, description)
		VALUES
		('".$_POST['name']."','".$_POST['description']."');
	");
	$IdAddedProduct = mysqli_insert_id($Server->get_DB_HANDLE());
mysqli_query($Server->get_DB_HANDLE(),"
		INSERT INTO
		ProductsCategories
		(idProduct, idCategories)
		VALUES
		(".$IdAddedProduct.",".$_POST['IdCategory'].");
	");
mysqli_query($Server->get_DB_HANDLE(),"
		INSERT INTO
		ProductsProviders
		(ProductsProviders.idProduct, ProductsProviders.idProvider)
		VALUES
		(".$IdAddedProduct.",".$_POST['IdProvider'].");
	");

?>
<script type="text/javascript">
	document.location.href = '<?="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Source/AdminMethods/FormAddingInformation.php"?>';
</script>

<?php
?>
