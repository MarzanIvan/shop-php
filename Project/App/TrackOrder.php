<?
    global$Server;
    require_once("header.php");
?>

<style>

p{
	margin-top: 15%;
}

label{
    font-size: 25px;
    display: block;
    background-color: #fadecb; 
}

.CenterBlock{
    margin-right: auto;
    margin-left: auto;
    width: 50%;
}

.CenterBlock *{
    margin-right: auto;
    margin-left: auto;
    width: 100%;
}

</style>
<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">
    <p align="center" class="CenterBlock">
    	<?
            $DataOrder = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM BasketOrders WHERE id=".$_POST['IdOrder'].";");
    		$DataOrder = mysqli_fetch_array($DataOrder);

            $DataItemProduct = $Server->SendQuery("SELECT * FROM ItemProducts WHERE id=".$DataOrder['idItemProduct'].";");
            $DataItemProduct = mysqli_fetch_array($DataItemProduct);
            $DataMethodDelivery = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM DeliveryMethod WHERE id=".$DataItemProduct['IdDeliveryMethod'].";");
            $DataMethodDelivery = mysqli_fetch_array($DataMethodDelivery);
            $DataArravil = mysqli_query($Server->get_DB_HANDLE(),"
                SELECT 
                DATE_ADD(dateorder, interval ".$DataMethodDelivery['SpeedDeliveryInDays']." day)
                FROM 
                BasketOrders 
                WHERE 
                id = ".$DataOrder['id'].";
            ");
            $DataArravil = mysqli_fetch_array($DataArravil);
    	?>
    	<label style="font-weight:bold;">
    		Date of order: 
    		<span style="color: red; padding: 10px;">
    			<? echo $DataOrder['dateorder'];?>
    		</span>
    		- arravil date: 
    		<span style="color: red; padding: 10px;">
    			<? 
                    $IndexDateArrival = "DATE_ADD(dateorder, interval ".$DataMethodDelivery['SpeedDeliveryInDays']." day)";
                    echo $DataArravil[$IndexDateArrival];
                ?>
    		</span>		
    	</label>
        <a href="ListOrders.php">Cancel</a>
    </p>