<?
    global$Server;
    require_once("functions.php");
    try {
        if  (($_POST['email'] == 'admin@mail.ru')) {
            die("User with mail admin cannot be created!!!");
        }
		if (!IsCorrectRegisterData($_POST)) {
			throw new Exception('You have entered an invalid personal data');
		}
		register($_POST);	
	} 
	catch ( Exception $ErrorRegister ) {
?>
	<script type="text/javascript">
		document.location.href = '<?="http://".$_SERVER['SERVER_NAME']."/FormRegister.php?Message=".$ErrorRegister->getMessage();?>';
	</script>
<?
	}	
?>