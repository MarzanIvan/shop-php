<?
global$Server;
SESSION_START();
if (!isset($_SESSION['iduser'])) die("Access denied");
	require_once("../../ConnectDB.php");
$access = mysqli_query($Server->get_DB_HANDLE(),"SELECT id FROM Users WHERE Users.id = '".$_SESSION['iduser']."' AND email = '".$_SESSION['email']."' AND password = '".$_SESSION['password']."';");
if (!$access) die("Access denied");
?>

<style>

	body{
		background: radial-gradient(circle farthest-corner at 150px 100px, #738388, #394244);
		font-size: 25px;
		color: white; 
	}

	form *{
		display: block;
		font-size: 25px;
	}

	.ShowBlock{
		padding-left: 30px;
		cursor: pointer;
	}

	.ShowBlock *{
		display: none;
		padding: 20px;
	}

	.ShowInformation span{
		display: none;
	}
	
	.ListProviders {
		border-style: solid;
		padding: 20px;
	}

	.ListProviders:hover {
		border: 2px green solid;
	}

	.ListProviders form{
		display: inline-block;
		margin: 20px;
	}

	#ShowListMethodDelivery {
		padding: 20px;
		font-size: 25px;
		cursor: pointer;
		display: block;
		border: 1px black solid;
	}

	#ShowListMethodDelivery form{
		display: none;
	}

	#ShowListMethodDelivery:hover{
		border: 2px green solid;
	}

	textarea{
		resize: none;
		width: 30%;
		height: 30%;
		background-color: #8c9c9f;
	}
	input[type="submit"] {
		cursor: pointer;
	}

	input[type="submit"]:hover{
		background: radial-gradient(40% 50%, #a4afc1, #28303c);
		color: white;
	}

	input{
		width: 30%;
		text-align: center;
		background-color: #8c9c9f;
	} 

	select {
		width: 30%;
	}

	img {
		max-width: 400px;
		max-height: 300px;
		display: block;
	}

	.BlockData{
		border: 1px black solid;
		border-radius: 30px;
		margin-left: auto;
		margin-right: auto;
		width: 50%;
	}

	.BlockData *{
		margin: 10px;
		font-size: 25px;
		display: block;
		text-align: center;
		margin-left: auto;
		margin-right: auto;
	}

</style>

<script type="text/javascript" src="../Frameworks/jquery-1.4.2.js">
</script>
<div>
	<span class="ShowBlock">
		Providers
		<span id="FormAddingProviders">
		</span>
	</span>
	<span class="ShowBlock">
		Categories
		<span id="FormAddingCategories">
		</span>
	</span>
	<span class="ShowBlock">
		Products
		<span id="FormAddingProducts">
		</span>
	</span>
	<span class="ShowBlock">
		Delivery methods
		<span id="FormAddingDeliveryMethods">
		</span>
	</span>
	<span class="ShowBlock">
		Users
		<span id="FormModifyUsers">
		</span>
	</span>
    <span style="color: white;">
        <a style="color: white;" href="../../index.php"><span>Start Page</span></a>
	</span>
</div>
<hr>
<div class="ShowInformation">
	<span id="FormAddingProviders">
		<form method="POST" action="WriteProviderToDB.php">
		    <label>
			    Name of provider
		    </label>
	        <input type="text" name="name">
	        <label>
		        Address of provider
	        </label>
	        <input type="text" name="address">
	        <label>
		        The number telephone of provider
	        </label>
	        <input type="text" name="tel">
	        <label>
		        The mail of the provider
	        </label>
	        <input type="text" name="email">
	        <input type="submit" value="Add">
	    </form>
	    <?
	    	$DataProviders = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Providers");
	    	while($ListProviders = mysqli_fetch_array($DataProviders)) {
	    		?>
	    			<div class="ListProviders">
		            <form action="DeleteProvider.php" method="POST">
	    	            <input type="hidden" name="id" value="<? echo $ListProviders['id'];?>">
	    	            <label>
			                <? echo "[Name]: ".$ListProviders['name']; ?>
		                </label>
	                    <label>
		                    <? echo "[address]: ".$ListProviders['address']; ?>
	                    </label>
	                    <label> 
		                    <? echo "[number telephone]: ".$ListProviders['numbertelephone']; ?>
	                    </label>
	                    <label>
		                    <? echo "[mail]: ".$ListProviders['email']; ?>
	                    </label>
	                    <input type="submit" value="Delete">
	                </form>
	                <form style="display: block;" method="POST" action="AddMethodDeliveryProvider.php">
	                	<input type="hidden" name="IdProvider" value="<? echo $ListProviders['id'];?>">
	                	<label>
	                		Choose a method of the delivery:
	                	</label>
	                	<select name="IdMethodDelivery">
	                		<? $NamesMethodsDelivery = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM DeliveryMethod;");
	                			while($ListMethodsDelivery = mysqli_fetch_array($NamesMethodsDelivery)) { 
	                		?>	
	                			<option value="<? echo $ListMethodsDelivery['id'];?>">
	                		<? 
	                			echo "Name: ".$ListMethodsDelivery['name']." Price: ".$ListMethodsDelivery['price']; 
	                		?>
	                			</option>	
	                		<? 
	                			} 

	                		?>
	                	</select>
	                	<input type="submit" value="Choose">
	                	</form>          	
	                	<div id="ShowListMethodDelivery">
	                		List of the methods of delivery
	                		<?
	                			$DataMethodsProvider = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM DeliveryMethod JOIN MethodDeliveryProvider ON DeliveryMethod.id = MethodDeliveryProvider.IdDeliveryMethod WHERE MethodDeliveryProvider.idProvider = ".$ListProviders['id'].";");
	                			while ($ListMethodDelivery = mysqli_fetch_array($DataMethodsProvider)) { 
	                		?>
	                		<form method="POST" action="DeleteMethodDeliveryProvider.php">
	                		<input type="hidden" name="IdProvider" value="<? echo $ListProviders['id'];?>">
	                		<input type="hidden" name="IdMethodDelivery" value="<? echo $ListMethodDelivery['IdDeliveryMethod'];?>">
	                		<label>
	                			"Name of the method delivery": <? echo $ListMethodDelivery['name'];?>
	                		</label>
	                		<label>
	                			"Price of the method delivery": <? echo $ListMethodDelivery['price'];?>
	                		</label>
	                		<input type="submit" value="Delete">
	                		</form>

	                	<?
	                		}

	                	?>
	                	</div>
	                </div>
	    		<? 
	            	}

	           	?>
	</span>
	<span id="FormAddingCategories">
		<form action="WriteCategoryDB.php" method="POST">
			<label>
				Name of a category
			</label>
			<input type="text" name="name">
			<input type="submit" value="Add">
		</form>
		<?
	    	$DataCategories = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Categories");
	    	while($ListCategories = mysqli_fetch_array($DataCategories)) {
	    ?>
		<form action="DeleteCategory.php" method="POST">
	    	<input type="hidden" name="id" value="<? echo $ListCategories['id'];?>">
	    	<label>
			    <? echo "[Name]: ".$ListCategories['name']; ?>
		    </label>
	        <input type="submit" value="Delete">
	    </form>
	    <?
			}

		?>
	</span>
	<span id="FormAddingProducts">
		<form method="POST" action="CreateProduct.php">
			<label>
				Name of the product
			</label>
			<input type="text" name="name">
			<label>
				Description of the product
			</label>
			<textarea name="description"></textarea>
			<label>
				Choose a category:
			</label>
			<select name="IdCategory">
				<?
					$DataCategories = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Categories");
					while($ListCategories = mysqli_fetch_array($DataCategories)) { ?>
						<option value="<? echo $ListCategories['id'];?>">
							<? echo $ListCategories['name'];?>
						</option>
	    			<? 
	    				}

	    			?>
			</select>
			<label>
				Choose a provider:
			</label>
			<select name="IdProvider">
				<?
					$DataProviders = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Providers");
					while($ListProviders = mysqli_fetch_array($DataProviders)) { ?>
						<option value="<? echo $ListProviders['id'];?>">
							<? echo $ListProviders['name'];?>
						</option>
	    			<?
	    				}

	    			?>
			</select>
			<input type="submit" value="Add">
		</form>
		<?
			$DataProducts = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Products;");
            $ListProducts = mysqli_fetch_array($DataProducts);
			while($ListProducts = mysqli_fetch_array($DataProducts)) {
		?>
			<div style="border: 2px black solid;">
			<form method="POST" action="DeleteProduct.php">
				<input type="hidden" name="id" value="<? echo $ListProducts['id'];?>">
				<label>
					<h4 style="color: black;">
						Name of product:
					</h4> 
					<? echo $ListProducts['name'];?>
				</label>
				<label style="width: 40%; overflow-wrap: break-word;"> 
					<h4 style="color: black;">
						Description of product:
					</h4>
					<? echo $ListProducts['description'];?>
				</label>	
				<input type="submit" value="Delete">
			</form>
			<div style="width: 50%;">
				<form enctype="multipart/form-data" method="POST" action="CreateItemProduct.php">
					<input type="hidden" name="IdProduct" value="<? echo $ListProducts['id'];?>">
					<div>
						<label>
							Specification:
						</label>
						<textarea style="padding-left: 20px;padding-right: 20px;width: 100%;" name="Specifications"></textarea>
						<label>
							Price of the product:
						</label>
						<input type="text" name="Price">
						<label>
							Amount of the product:
						</label>
						<input type="text" name="AmountProduct">
						<label>
							Choose method of delivery
						</label>
						<select style="width: 70%;" name="IdMethodDelivery">
							<?
								$IdProvider = mysqli_query($Server->get_DB_HANDLE(),"
									SELECT 
									ProductsProviders.idProvider 
									FROM 
									ProductsProviders
									WHERE
									idProduct = ".$ListProducts['id'].";
								");

                            $IdProvider = mysqli_fetch_array($IdProvider);
                            echo $IdProvider['idProvider'];
								$DataMethodsDelivery = mysqli_query($Server->get_DB_HANDLE(),"
									SELECT
									*
									FROM
									DeliveryMethod
									INNER JOIN
									MethodDeliveryProvider
									ON
									DeliveryMethod.id = MethodDeliveryProvider.IdDeliveryMethod
									WHERE 
									MethodDeliveryProvider.idProvider = ".$IdProvider['idProvider'].";");

								while($ListMethodsDelivery = mysqli_fetch_array($DataMethodsDelivery)) {
							?>
							<option value="<? echo $ListMethodsDelivery['id'];?>">
								"Name": <? echo $ListMethodsDelivery['name'];?>
								"Price": <? echo $ListMethodsDelivery['price'];?>
							</option>

							<?
								}
							?>
						</select>
						<label>
							Load a photo of the product
						</label>
						<input type="file" name="File">
					</div>
					<input type="submit" value="Add">
				</form>	
			</div>
			
			<div>
			<?
				$DataItemsProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM ItemProducts WHERE idProduct = ".$ListProducts['id'].";");
				while($ItemsProduct = mysqli_fetch_array($DataItemsProduct)) {
			?>
				<form method="POST" action="DeleteItemProduct.php">
					<input type="hidden" name="IdItemProduct" value="<? echo $ItemsProduct['id'];?>">
					<input type="hidden" name="PathImage" value="<? echo  $ItemsProduct['pathimage'];?>">
					<label>
						<?=$ItemsProduct['Specifications'];?>
					</label>
					<img src="../<? echo $ItemsProduct['pathimage'];?>">
					</label>
					<label>
						"Amount of item of the product": <? echo $ItemsProduct['amount'];?>
					</label>
					<input type="submit" value="Delete">
				</form>
			<?
				}

			?>
			</div>
			</div>
		<? 
			}

		?>
	</span>
	<span id="FormAddingDeliveryMethods">
		<form method="POST" action="WriteMethodDelivery.php">
	        <label>
	        	This form of the adding method of a delivery:
	        	<br>
	        	Name of delivery:
	        </label>
	        <input type="text" name="namedelivery">
	        <label>
	        	Price of a delivery:
	        </label>
	        <input type="text" name="pricedelivery">
	        <label>
	        	Speed of delivery
	        </label>
	        <input type="text" name="SpeedDelivery" placeholder="Amount days">
	        <input type="submit" value="Add">
	    </form>
	    
	    <?
	    	$DataMethodsDelivery = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM DeliveryMethod;");
	    	while($ListMethodsDelivery = mysqli_fetch_array($DataMethodsDelivery)) {
	    ?>
	   		<form method="POST" action="DeleteMethodDelivery.php">
	    	<input type="hidden" name="id" value="<? echo $ListMethodsDelivery['id'];?>">
	    	<label>
	    		Name of method: <? echo $ListMethodsDelivery['name'];?> 
	    	</label>
	    	<label>
	    		Price of method: <? echo $ListMethodsDelivery['price'];?> 
	    	</label>
	    	<input type="submit" value="Delete">
	    	</form>
	    <?
	    	}

	    ?>
	    
	</span>
	<span id="FormModifyUsers">
		<?
			$DataUser = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Users;");
			while($ListUsers = mysqli_fetch_array($DataUser)) {
		?>
			<div class="BlockData">
				<form method="POST" action="DeleteUser.php">
					<input type="hidden" name="IdUser" value="<? echo $ListUsers['id'];?>">
					<label>
						The <? echo $ListUsers['id'];?>th user
					</label>
					<label>
						"Email": <? echo $ListUsers['email'];?>
					</label>
					<label>
						"Number telephone": <? echo $ListUsers['numbertelephone'];?>
					</label>
					<label>
						"Name": <? echo $ListUsers['name'];?>
					</label>
					<label>
						"Surname": <? echo $ListUsers['surname'];?>
					</label>
					<input type="submit" value="Delete this user">
				</form>
			</div>
		<?
			}

		?>	
	</span>
    <span id="StartPage">

    </span>
</div>

<script>
    $('.ShowBlock').click(function(){
    	$IdObject = $(this).find('span').attr('id');
    	$('.ShowInformation').find('*').closest('span').hide();
    	$('.ShowInformation').find( '#' + $IdObject ).show();
    });
    $('#ShowListMethodDelivery').click(function(){
    	$(this).find('*').toggle();
    	$(this).find('*').find('*').toggle();
    });  
</script>