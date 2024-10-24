<?
    global$Server;
	require_once('header.php');
?>
<link rel="stylesheet" type="text/css" href="Source/CSS/ListElements.css">
<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">
<style>
	img {
		border: 2px black solid;
		border-radius: 30px;
		max-width: 300px;
		max-height: 200px;
		cursor: pointer;
	}	
	
	label {
		font-size: 25px;
		word-wrap: break-word;
	}

	.frame {
		padding: 10px;
		border-radius: 50px;
		background-color: white;
	}

</style>
<div style="display: flex;">
	<? 
		require_once('GenerateListCategories.php');
	?>
	
	<div class="List" style="padding: 30px;">
	<?
    $DataProducts = $Server->SendQuery("
		SELECT 
		* 
		FROM 
		Products 
		INNER JOIN 
		ProductsCategories 
		ON 
		Products.id = ProductsCategories.idProduct
		WHERE 
		ProductsCategories.idCategories = ".$_GET['idCategory'].";
	");
	while( $ListProduct = mysqli_fetch_array($DataProducts) ) {
		$DataItemProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM ItemProducts WHERE idProduct = ".$ListProduct['idProduct'].";");
		$ItemProduct = mysqli_fetch_array($DataItemProduct);
	?>
	<form method="GET" action="Product.php">
		<input type="hidden" name="IdProduct" value="<? echo $ListProduct['idProduct'];?>">
		<div onclick="this.parentNode.submit();" style="display: flex;">
			<div>
				<img src="Source/<?=$ItemProduct['pathimage'];?>">		
			</div>
			<div style="margin-left: 30px; padding: 10px; width: 50%;">
				<a href="#" style="font-size: 35px;">
					<? echo $ListProduct['name'];?>
				</a>
				<label class="frame" style="text-align: center;">
					<?= $ItemProduct['price'];?> р.
				</label>
				<label>
					<? echo $ListProduct['description'];?>
				</label>
			</div>
		</div>
	</form>
	<?
		}
	?>
	</div>
</div>
