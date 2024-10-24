<?global$Server;?>
<?
    require_once('ConnectDB.php');
    mysqli_query($Server->get_DB_HANDLE(),"DELETE FROM CommentsProducts WHERE id=".$_GET['IdComment'].";");
?>