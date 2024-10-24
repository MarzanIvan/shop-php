<?
    global$Server;
    require('header.php');
?>
<style>

.CenterBlock{
    padding: 25px;
    margin: 5%;
    margin-right: auto;
    margin-left: auto;
    width: 35%;
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

table *{
    padding: 20px;
    border: 1px rgb(163, 241, 241) solid;
}

table td{
    color: #1f4858;
}


</style>
<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">
<div class="CenterBlock frame">
    <p align="center">
    <?
        $DataItemProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM ItemProducts WHERE id = ".$_GET['IdItemProduct'].";");
        $DataItemProduct = mysqli_fetch_array($DataItemProduct);
        $DataProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT name FROM Products WHERE id=".$DataItemProduct['idProduct'].";");
        $DataProduct = mysqli_fetch_array($DataProduct);
        $DataMethodDelivery = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM DeliveryMethod WHERE id=".$DataItemProduct['IdDeliveryMethod'].";");
        $DataMethodDelivery = mysqli_fetch_array($DataMethodDelivery);
        $PriceProduct = $DataMethodDelivery['price'] + $DataItemProduct['price'];
    ?>
    <form class="SizeTextOrder" method="POST" action="DoOrderUser.php">
        <label>
            Your order
        </label>
            <img style="border: 1px rgb(163, 241, 241) solid;" src="Source/<?echo $DataItemProduct['pathimage'];?>">
            <label><? echo $DataProduct['name'];?> X 1</label>
            <table>
                <tr>
                    <td>
                        Price of product: 
                    </td>
                    <td>
                        <? echo $DataItemProduct['price'];?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Price of delivery
                    </td>
                    <td>
                        + <? echo $DataMethodDelivery['price'];?>
                    </td>
                </tr>
                <tr>
                    <td>
                        Total     
                    </td>
                    <td>
                        <? echo $PriceProduct;?>
                    </td>
                </tr>
            </table>
            <label>
                Specifications:
            </label>
           <label style="word-break: break-all;">
                <pre style="font-size: 15px;"><? echo $DataItemProduct['Specifications'];?></pre>
            </label>
            <input type="hidden" name="IdProduct" value="<? echo $DataItemProduct['idProduct'];?>">
            <input type="hidden" name="Price" value="<? echo $PriceProduct;?>">
            <input type="hidden" name="IdItemProduct" value="<? echo $DataItemProduct['id'];?>">
            <input class="button" type="submit" value="Buy">
    </form> 
    <form class="SizeTextOrder"  method="GET" action="Product.php">
        <input type="hidden" name="IdProduct" value="<? echo $DataItemProduct['idProduct'];?>">
        <input class="button" type="submit" value="Back">
    </form>
<?
    $DataItemProduct = null;
    $DataProduct = null;
?>
    </p>
</div>