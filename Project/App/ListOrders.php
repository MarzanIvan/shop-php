<?
    global$Server;
	require_once('header.php');
    if(isset($_GET['Message']) && $_GET['Message']) {
        require_once('Message.php');
       $_GET['Message'] = null; 
    }
?>
<style>

.CenterBlock{
    padding: 25px;
    margin: 5%;
    margin-right: auto;
    margin-left: auto;
    width: 35%;
}

img {
    border: 1px rgb(163, 241, 241) solid;
}

.CenterBlock *{
    margin: 15px;
    text-align: center;
    margin-right: auto;
    margin-left: auto;
    width: 100%;
}

.SizeTextOrder *{
    font-size: 20px;
    width: 100%;
}

.SizeTextOrder input{
    padding: 20px;
}

.frame{
    background-color: white;
}

label {
    display: block;
}

img {
    display: block;
}

table {
    font-size: 20px;
    border: 1px #c1fff4 solid;
    background-color: #fff8f2;
    border-collapse: collapse;
}
table *{
    border: 1px #c1fff4 solid;
    padding: 10px;
}

.SizeInputSubmit[type="submit"]{
    font-size: 25px;
    padding: 20px;
}

</style>
<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">

<div class="CenterBlock frame">
	<h4>
		Your orders
	</h4>
	<?
		$DataOrders = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM BasketOrders WHERE idUser = ".$_SESSION['iduser'].";");
		while($ListOrders = mysqli_fetch_array($DataOrders)) {
            $DataItemProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM ItemProducts WHERE id=".$ListOrders['idItemProduct'].";");
            $DataItemProduct = mysqli_fetch_array($DataItemProduct);
            $DataProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Products WHERE id=".$DataItemProduct['idProduct'].";");
            $DataProduct = mysqli_fetch_array($DataProduct);
    ?>
		<form method="POST" action="TrackOrder.php">
            <img src="Source/<? echo $DataItemProduct['pathimage'];?>">
            <table>
                <tr>
                    <td>
                        Name of product
                    </td>
                    <td>
                        <? echo $DataProduct['name'];?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Method of delivery
                    </td>
                    <td>
                        <?
                            $DataMethodDelivery = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM DeliveryMethod WHERE id=".$DataItemProduct['IdDeliveryMethod'].";");
                            $DataMethodDelivery = mysqli_fetch_array($DataMethodDelivery);
                            echo $DataMethodDelivery['name'];
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Price of product: 
                    </td>
                    <td>
                        <? echo $DataItemProduct['price']." р.";?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Price of delivery
                    </td>
                    <td>
                        + <? echo $DataMethodDelivery['price']." р.";?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Price of your order     
                    </td>
                    <td>
                        <? echo $ListOrders['price']." р.";?>
                    </td>
                </tr>
            </table>
            <label>
                Specifications:
            </label>
           <label style="word-break: break-all;">
                <pre style="font-size: 15px;"><? echo $DataItemProduct['Specifications'];?></pre>
            </label>
            <input type="hidden" name="IdOrder" value="<? echo $ListOrders['id'];?>">
            <input class="button SizeInputSubmit" type="submit" value="Track this order">
		</form>
        <form method="POST" action="CloseOrderUser.php">
            <input type="hidden" name="IdOrder" value="<? echo $ListOrders['id'];?>">
            <input class="button  SizeInputSubmit" type="submit" value="Close this order">
        <form>
	<?
		}	
	?>
</div>