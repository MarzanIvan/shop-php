<?
    global$Server;
	require_once('header.php');
	require_once('GenerateListCategories.php');
    if(isset($_GET['Message']) && $_GET['Message']) {
        require_once('Message.php');
        $_GET['Message'] = null;
    }
?>


  