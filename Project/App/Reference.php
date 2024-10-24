<?
    global$Server;
    require_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style>

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

.BlockChilds *{
    display: block;
}

img {
    max-width: 70%;
    max-height: 70%;
    border: 1px black solid;
}

label{
    margin: 10px;
}

    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p class="BlockChilds" align="center">
        <label style="font-weight: 600;">
            This is reference for the users
        </label>
        <label style="display: flex; margin: 50px;">
        <span>
        <label style="margin-top: 5%;font-weight: 600;">
            The instructions to register
        </label>
        <label>
            1. Go to form of register
        </label>
        <img src="Source/PhotoesInstructions/Register1.jpg">
        <label>
            2. Input your personal data in the fields using the following samples 
        </label>
        <span style="width: 50%;">
            <img src="Source/PhotoesInstructions/Register2.jpg">
            <img src="Source/PhotoesInstructions/Register3.jpg">
        </span>
        <label>
            3. Click button register 
        </label>
        </span>
        <span>
        <label style="margin-top: 5%;font-weight: 600;">
            The instructions for logging into your account
        </label>
        <label>
            1. Go to form of logging
        </label>
        <img src="Source/PhotoesInstructions/Logging1.jpg">
        <label>
            2. Input your login and password 
        </label>
        <img src="Source/PhotoesInstructions/Logging2.jpg">
        <label>
            3. Click button join 
        </label>
        </span>
        </label>
        <label style="display: flex; margin: 50px;">
            <span>
                <label style="margin-top: 5%;font-weight: 600;">
                    The instruction to but some product
                </label>
                <label>
                    1. Choose category from list
                </label>
                <img src="Source/PhotoesInstructions/Buy1.jpg">
                <label>
                    2. Choose product from the showed list
                </label>
                <img src="Source/PhotoesInstructions/Buy2.jpg">
                <label>
                    3. Choose the product to buy
                </label>
                <img src="Source/PhotoesInstructions/Buy3.jpg">
                <label>
                    4. Click the button
                </label>
                <img src="Source/PhotoesInstructions/Buy4.jpg">
                <label>
                    5. Click the button 
                </label>
                <img src="Source/PhotoesInstructions/Buy5.jpg">
            </span>
            <span>
                <label style="margin-top: 5%;font-weight: 600;">
                    Options
                </label>
                <label>
                    1. Show your list orders
                </label>
                <img src="Source/PhotoesInstructions/Options1.jpg">
                <label>
                    2. Track your order.
                </label>
                <img src="Source/PhotoesInstructions/Options2.jpg">
                <img src="Source/PhotoesInstructions/Options3.jpg">
                <label>
                    3. Close your order.
                </label>
                <img src="Source/PhotoesInstructions/Options4.jpg">
                <label>
                    To close your order click the button.
                </label>
                <img src="Source/PhotoesInstructions/Options5.jpg">
            </span>
            <span>
                <label style="margin-top: 5%;font-weight: 600;">

                </label>
            </span>
        </label>
    </p>
</body>
</html>