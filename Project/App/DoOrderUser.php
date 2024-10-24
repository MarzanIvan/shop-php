<?
    SESSION_START();
    global$Server;
    if (!isset($_SESSION['iduser']) || !$_SESSION['iduser']) {
        header("Location: http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/FormLog.php");
    }
    require_once('ConnectDB.php');
    mysqli_query($Server->get_DB_HANDLE(),"
        INSERT INTO
        BasketOrders
        ( idUser, idItemProduct, dateorder, price)
        VALUES
        (".$_SESSION['iduser'].",".$_POST['IdItemProduct'].",'".date('o-m-d')."',".$_POST['Price'].");
    ");
    $_GET['IdProduct'] = $_POST['IdProduct'];
?>
<script>
    document.location.href = '<?="http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/Product.php?IdProduct=".$_GET['IdProduct'];?>';
</script>    

    