<?
    global$Server;
    SESSION_START();
    require('ConnectDB.php');
    try {
        $DataUser = mysqli_query($Server->get_DB_HANDLE(),"SELECT id,email,password FROM Users WHERE email='".$_POST['email']."' AND password='".md5($_POST['password'])."';");
        $DataUser = mysqli_fetch_array($DataUser);
        if (!$DataUser['id']) {
            throw new Exception("There is not such user");
         }
        $_SESSION['iduser'] = $DataUser['id'];
        $_SESSION['email'] = $DataUser['email'];
        $_SESSION['password'] = $DataUser['password'];
        header("Location: http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT']."/index.php");
    } 
    catch ( Exception $ExceptionErrorAccess ) {
        ?>
            <script>
                document.location.href = "<?='http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/FormLog.php?Message=<?=$ExceptionErrorAccess->getMessage();?>/';?>";
            </script>
        <?
    } 
?>