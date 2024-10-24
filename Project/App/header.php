<?
	SESSION_START();
    global$Server;
	require_once('ConnectDB.php');
?>
<header>

<style>

header{
	font-size: 25px;
	border-bottom: 1px black solid;
}

.list{
    font-size: 15px;
    overflow: auto;
}

.list .item{
    font-size: 15px;
    margin-left: 20px;
    margin-top: -10px;
}

.profile{
	padding: 10px;
	position: absolute;
	right: 0;
	padding-right: 10px;
}

.ShowList{
	background-color: #ebf6f6;
	font-size: 25px;
	z-index: 1;	
	cursor: pointer;
}

.ShowList *{
	display: none;
}

.ShowList:hover *{
	display: block;  
}

.seach{
	width: 100%;
	display: inline-block;
	font-size: 20px;
	text-align: center;
}
.seachfield{
	padding-left: 15px;
	width: 50%;
}

a{
	font-size: 25px;
	color: black;
	text-decoration: none;
}

a:hover{
	color: #b9ffc9;
}

</style>
<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">
	<a style="padding: 50px;" href="index.php">
		KONTAKT
	</a>
	<span class="ShowList profile">
		Меню
		<?
			if (!isset($_SESSION['iduser']) || !$_SESSION['iduser']) {
		?>
			<a href="FormRegister.php">Регистрация</a>
			<a href="FormLog.php">Авторизация</a>
		<?
			}
		?>
		<a href="Reference.php">Помощь</a>
		<?
			if (isset($_SESSION['iduser'])) {
		?>
			<a href="ListOrders.php">Заказы</a>
			<a href="ExitFromAccount.php">Выйти</a>
		<?
                if(isset($_SESSION['iduser']) and $_SESSION['iduser']=="1" and $_SESSION['email']=="admin@mail.ru"){
                   ?>
                    <a href="Source/AdminMethods/FormAddingInformation.php">ADMIN FORM</a>
                    <?
                }
			}
		?>
	</span>	
		<form class="seach SizeText" method="GET" action="FindProductsByName.php">
			<input class="button seachfield" type="text" name="SeachData" placeholder="Найдём товар по наименованию...">
			<input class="button" type="submit" value="Поиск">
		</form>	
</header>
