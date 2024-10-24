<?
    global$Server;
    require_once('ConnectDB.php');
    $r=mysqli_query($Server->get_DB_HANDLE(),"
        INSERT INTO 
        CommentsProducts
        (idUser, idProduct, content)
        VALUES
        (".$_POST['IdUser'].",".$_POST['IdProduct'].",'".$_POST['content']."');
    ");
echo mysqli_insert_id($r);
?>

