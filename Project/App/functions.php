<?
    global$Server;
    SESSION_START();
    require_once("ConnectDB.php");

function register( )
{
    global $Server;
    try {
        $DataUserInDB = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE email='".$_POST['email']."' OR numbertelephone='".$_POST['tel']."' ;");
        $DataUserInDB = mysqli_fetch_array($DataUserInDB);
        if ($DataUserInDB['id']) {
            throw new Exception('Such user has been registered in site');
        }
        mysqli_query($Server->get_DB_HANDLE(),"
            INSERT INTO
            Users
            (name, surname, numbertelephone, email, password, InformationMySelf, country, town, street, numberhome, gender)
            VALUES
            ('".$_POST['name']."','".$_POST['surname']."','".$_POST['tel']."',
            '".$_POST['email']."','".md5($_POST['password'])."','".$_POST['about']."',
            '".$_POST['country']."','".$_POST['town']."','".$_POST['street']."',
            '".$_POST['home']."','".$_POST['gender']."');
        ");
        $_SESSION['iduser'] = mysqli_insert_id($Server->get_DB_HANDLE());
        ?>
            <script>
                document.location.href = '<?='http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].'/';?>';
            </script>
        <?
    }
    catch( Exception $ErrorMessage ) {
        ?>
            <script>
                document.location.href = '<?="http://".$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"]."/FormRegister.php?Message="?><?=$ErrorMessage->getMessage();?>';
            </script>
        <?
    }
}

function IsCorrectRegisterData(  ) {
    if ( IsCorrectPersonalDataUser( $_POST ) && isCorrectAddressUser($_POST)) {
        return 1;
    } else {
        return 0;
    }
}

function isCorrectAddressUser(  ) {
    $rNamePlace = "/^[A-Z][A-zА-я]{2,20}/";
    $rNumberHome = "/[A-zА-я0-9]{1,10}\s[A-zА-я]{1,5}|[0-9]{1,4}/";
    if(
        empty($_POST['country']) || preg_match($rNamePlace, $_POST['country']) &&
        empty($_POST['street']) || preg_match($rNamePlace, $_POST['street']) &&
        empty($_POST['town']) || preg_match($rNamePlace, $_POST['town']) &&
        empty($_POST['home']) || preg_match($rNumberHome, $_POST['home'])
    )
    { 
        return 1;
    }
    else { 
        return 0; 
    }
}

function IsCorrectPersonalDataUser(  ) {
    $rNameSurname = "/[А-яA-z]{2,15}/";
    $rtel = "/^\+[0-9]{5,15}/";
    $remail = "/[A-Za-z0-9]{1,8}(@)mail.ru|bk.ru|internet|inbox|list.ru/";
    $rpassword = "/[A-zА-я0-9]{5,20}/";
    if(
        preg_match($rNameSurname, $_POST['name']) &&
        preg_match($rNameSurname, $_POST['surname']) &&
        preg_match($rtel, $_POST['tel']) && 
        preg_match($remail, $_POST['email']) && 
        $_POST['gender'] && 
        preg_match($rpassword, $_POST['password'])
    ) {
        return 1;
    } 
    else {
        return 0;
    }
}


?>

