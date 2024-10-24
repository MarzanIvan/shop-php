<?global$Server;?>
<?
	if (!isset($_GET['SeachData']) || $_GET['SeachData'] == '') {
		header("Location: http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_NAME']."/");
	}
	require_once('header.php');
?>

<link rel="stylesheet" type="text/css" href="Source/CSS/ListElements.css">
<style>
	img {
		border: 2px black solid;
		border-radius: 30px;
		max-width: 300px;
		max-height: 200px;
		cursor: pointer;
	}	

	a {
		text-decoration: none;
		color: black;
		font-size: 25px;
	}
	

	label {
		font-size: 25px;
		word-wrap: break-word;
	}

	.frame {
		padding: 10px;
		border-radius: 50px;
		background-color: #ffedcd;
	}

</style>
<div style="display: flex;">
	<div>
		<?
			require_once('GenerateListCategories.php');
		?>
	</div>
	<div class="List" style="padding: 30px;">
	<? 
		
		$FoundProducts = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Products WHERE name LIKE '%".$_GET['SeachData']."%';");
		while( $ListFoundProducts = mysqli_fetch_array($FoundProducts)) {
			$FirstItemProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM ItemProducts WHERE idProduct = ".$ListFoundProducts['id'].";");
			$FirstItemProduct = mysqli_fetch_array($FirstItemProduct);
	?>
	<form method="GET" action="Product.php">
		<input type="hidden" name="IdProduct" value="<? echo $ListFoundProducts['id'];?>">
		<div onclick="this.parentNode.submit();" style="display: flex;">
			<div>
				<img src="Source/<?=$FirstItemProduct['pathimage'];?>">		
			</div>
			<div style="margin-left: 30px; padding: 10px; width: 50%;">
				<a href="#" style="font-size: 35px;">
					<?=$ListFoundProducts['name'];?>
				</a>
				<label class="frame" style="text-align: center;">
					<?=$FirstItemProduct['price'];?> р.	
				</label>
				<label>
					<?= $ListFoundProducts['description'];?>
				</label>
			</div>
		</div>
	</form>
	<?
		}
	?>
	</div>
</div>
