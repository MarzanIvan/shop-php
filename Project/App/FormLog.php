<?
    global$Server;
    require('ConnectDB.php');
    if(isset($_GET['Message']) && $_GET['Message']) {
        require_once('Message.php');
       $_GET['Message'] = null; 
    }
?>
<style>
p{
	margin-top: 15%;
}
input{
    font-size:25px;
    display: block;
    padding: 10px; 
    text-align:center;
    margin: 15px;
}

a {
    font-size: 25px;
    padding: 30px;
}

label{
    font-size: 20px; 
}

.CenterBlock{
    position: absolute;
    top: 50%;
    left: 50%;
    margin-right: -50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 25%;
}

.CenterBlock *{
    margin-right: auto;
    margin-left: auto;
    width: 100%;
}

</style>
<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">
<form method="POST" action="GetAccess.php">
    <div align="center" class="CenterBlock">
        <label>Login of user</label>	
        <input type="text" name="email" placeholder="Your login">
        <label>Password of user</label>
        <input type="password" name="password" placeholder="Your password">
        <input class="button" type="submit" value="Log">
        <a href="index.php">Cancel</a>
    </div>
</form>