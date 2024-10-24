<?php
    global$Server;
	require_once("Source/Declarations/Classes.php");
	$Server = new Server("Internet_Shop",'mysql_db',"root","root");
	$Server->ConnectServer();
	$Server->ConnectDB('Internet_Shop');
	$Server->SetCharset("UTF8");
?>