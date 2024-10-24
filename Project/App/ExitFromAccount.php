<?
    global$Server;
	session_start();
	$_SESSION['iduser'] = null;
	header("Location: http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/");
?>