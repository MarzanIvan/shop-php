<?
    global$Server;
    require('header.php');
    if(isset($_GET['Message']) && $_GET['Message']) {
        require_once('Message.php');
       $_GET['Message'] = null; 
    }
?>

<style>

.button[type="submit"] {
	text-align: center;
   	cursor: pointer;
	border: 1px rgb(146, 217, 219) solid;
}

.button[type="submit"]:hover {
	color: #4d90aa;
	background: rgb(255,255,255);
	background: radial-gradient(circle, rgba(255,255,255,0.8715861344537815) 0%, rgba(213,251,255,1) 96%, rgba(250,254,255,1) 100%);
}

input[type="text"]{
	border: 1px rgb(163, 241, 241) solid;
}

input[type="text"]:focus{
	color: #1f4858;
}


.Fields *{
    text-align: center;
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 25%;
}

.Fields *{
    font-size: 20px;
    padding: 10px;
}

label {
	-webkit-touch-callout: none;
	-webkit-user-select: none;   
	-khtml-user-select: none;    
	-moz-user-select: none;      
	-ms-user-select: none;
	user-select: none;
}


</style>

<script type="text/javascript" src="Source/Frameworks/jquery-1.4.2.js"></script>

<script>
    $ReNameSurNameUser = /[А-яA-z]{2,15}/;
    $ReNumberTelephone = /^\+[0-9]{5,15}/;
    $ReEmailUser = /[A-Za-z0-9]{1,8}(@)mail.ru|bk.ru|internet|inbox|list.ru/;
    $ReAddress = /^[A-ZА-я][A-zА-я]{2,20}/;
    $ReNumberHome = /[A-zА-я0-9]{1,10}\s[A-zА-я]{1,5}|[0-9]{1,4}/;
    $RePassword = /[A-zА-я0-9]{5,20}/;

function ShowRedPlaceHolder( $ObjectInputting, Message ) {
    $ObjectInputting.value = '';
    $ObjectInputting.setAttribute( 'placeholder', Message );
    $ObjectInputting.style.backgroundColor = "#f45565";
}

function CkeckObjectByRegular( $ObjectInput, $Regular, Message ) {
    if (!$Regular.test($ObjectInput.value)) {
        ShowRedPlaceHolder( $ObjectInput, Message);
    }
}

</script>
<form method="POST" action="RegisterUser.php">
    <p class="Fields">
        <label>Name of user</label>
        <input type="text" onclick="this.setAttribute('placeholder','Your name')" onchange="CkeckObjectByRegular( this, $ReNameSurNameUser, 'Here you can input only characters');" name="name" placeholder="Your name">
        <label>Surname of user</label>
        <input type="text" onclick="this.setAttribute('placeholder','Your surname')" onchange="CkeckObjectByRegular( this, $ReNameSurNameUser, 'Here you can input only characters');" name="surname" placeholder="Your surname">
        <label>The number telephone of user</label>
        <input type="text" onclick="this.setAttribute('placeholder','Your number telephone')" onchange="CkeckObjectByRegular( this, $ReNumberTelephone, 'There should be only symbol \'+\' and the numbers');" class="NumberTelephoneUser" name="tel" placeholder="Your number telephone">
        <label>Email of user</label>
        <input type="text" onclick="this.setAttribute('placeholder','Your email')" onchange="CkeckObjectByRegular( this, $ReEmailUser, 'Mailbox name + @ + domain');" class="EmailUser" name="email" placeholder="Your email">
        <label>Told about yourself</label>
        <textarea style="resize: none;" name="about"></textarea>
        <label>Your address</label>
        <input type="text" onclick="this.setAttribute('placeholder','Your country')" onchange="CkeckObjectByRegular( this, $ReAddress, 'Here should be only characters');" class="AddressUser" name="country" placeholder="Your country">
        <input type="text" onclick="this.setAttribute('placeholder','Your town')" onchange="CkeckObjectByRegular( this, $ReAddress, 'Here should be only characters');" class="AddressUser" name="town" placeholder="Your town">
        <input type="text" onclick="this.setAttribute('placeholder','Your street')" onchange="CkeckObjectByRegular( this, $ReAddress, 'Here should be only characters');" class="AddressUser" name="street" placeholder="Your street">
        <input type="text" onclick="this.setAttribute('placeholder','Your home')" onchange="CkeckObjectByRegular( this, $ReNumberHome, 'It isn\'t correct number of home');" class="NumberHomeUser" name="home" placeholder="Your home">
        <label>Your gender</label>
        <select name="gender">
            <option value="None">None</option>
            <option value="Men">Men</option>
            <option value="Woman">Women</option>
        </select>
        <br>
        <label>Password of the user</label>
        <input type="password" onclick="this.setAttribute('placeholder','Your password')" onchange="CkeckObjectByRegular( this, $RePassword, 'There should be more 5 symbols');" name="password" type="password" placeholder="Your password">
        <input class="button" type="submit" value="Register">
    </p>
</form>
<script>
    $('input').click( 
        function () {
            $(this).css('background-color','white');
        }
    );
</script>