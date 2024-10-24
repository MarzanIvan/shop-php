<?
    global$Server;
	require_once('header.php');
?>
<style>

	a{
		text-decoration: none;
		color: black;
	}

	img{
		border: 1px black solid;
	}

	.bounds{
		border: 3px black solid;
		width: 100%;
	}

	.description{
		display: inline-block;
	}

	.PhotosProduct{
		padding: 20px;
	}

	.PhotosProduct img{
		cursor: pointer;
		display: inline-block;
		max-height: 10%;
		max-width: 10%;
	}

	.ShowBlock{
		padding-left: 30px;
		cursor: pointer;
	}

	.ShowBlock *{
		display: none;
		padding: 20px;
	}

	.ShowInformation div{

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

	table {
		font-size: 20px;
		border: 1px #c1fff4 solid;
		background-color: #fff8f2;
		border-collapse: collapse;
	}
	table *{
		padding: 30px;
	}

	textarea{
		font-size: 20px; 
		padding: 15px; 
		resize:none; 
		overflow-x: hidden; 
		width: 100%; 
		padding-left: 20px; 
		padding-right: 20px;
	}

	.BlockComment {
		background-color: white;
		margin: 20px;
		padding: 20px;
	}
	.BlockComment label{
		display: block;
	}

	.Comments{
		padding: 20px;
		margin: 10%;
		width: 100px;
	}

	.block_photo{
		width: 50%;
	}

	.block_photo *{
		width: 100%;
	}

	input{
		font-size: 25px;
	}

	.button[type="button"]{
   		cursor: pointer;
   		text-align: center;
		border: 1px rgb(146, 217, 219) solid;
	}


	.button[type="button"]:hover {
		color: #4d90aa;
		background: rgb(255,255,255);
		background: radial-gradient(circle, rgba(255,255,255,0.8715861344537815) 0%, rgba(213,251,255,1) 96%, rgba(250,254,255,1) 100%);
	}

</style>
<head>
	<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">
	<script type="text/javascript" src="Source/Frameworks/jquery-1.4.2.js">
	</script>

	<script>

function IsAccessUser() {
	<?
		if (isset($_SESSION['iduser']) && $_SESSION['iduser']) {
	?>
		return 1;
	<?
		}
		else {
	?>
		return 0;
	<?
		}
	?>
}

function GenerateAjaxHandlingFormDeleting() {
	$('.Form_Comment').submit( function(Event) {
		Event.preventDefault();
		$Form = $(this);
		$.ajax({
			url: 'DeleteCommentProduct.php',
			type: 'GET',
			data: $Form.serialize(),
			success: function() {
				$Form.parent().css('display', 'none');
				$Form.css('display', 'none');
			}
		});
	});
}

function AddCommentAfterTag( $Object, $Comment, $IdInputtingComment ) {
	<?
		if (isset($_SESSION['iduser']) || $_SESSION['iduser']) {
			$DataUser = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Users WHERE id = ".$_SESSION['iduser'].";");
			$DataUser = mysqli_fetch_array($DataUser);
	?>
	$Object.after('<h4 class="BlockComment"><form class="Form_Comment" method="GET" action="DeleteCommentProduct.php"><input type="hidden" name="IdComment" value="' + $IdInputtingComment + '"><label><? echo $DataUser['surname']." ".$DataUser['name'];?></label><label>[Email]: <a href="http://<? echo $DataUser['email'];?>"><? echo $DataUser['email'];?></a></label><span style="display: block; word-wrap: break-word;">- ' + $Comment + '</span><?if ( $_SESSION['iduser'] == $DataUser['id']) {?><input class="button" type="submit" value="Delete"><?}?></form></h4>');
	GenerateAjaxHandlingFormDeleting();
	<?
		}
	?>
}



	</script>
	
</head>


<div style="display: flex;">
<?
	require_once('GenerateListCategories.php');
	$DataProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Products WHERE id = ".$_GET['IdProduct'].";");
	$DataProduct = mysqli_fetch_array($DataProduct);
	$DataItemsProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM ItemProducts WHERE idProduct = ".$_GET['IdProduct'].";");
	$DataItemProduct = mysqli_fetch_array($DataItemsProduct);
?>

<div style="display: inline-block;" class="bounds">
	<span style="display: flex;">
	<div style="padding: 20px;" class="block_photo">
		<form method="GET" action="FormOrder.php">
			<input id="IdSelectedItemProduct" type="hidden" name="IdItemProduct" value="<? echo $DataItemProduct['id']?>">
			<img id="MainImg" src="Source/<? echo $DataItemProduct['pathimage'];?>">
			<input class="TextAlign button button_event" type="submit" value="Order">
		</form>
	</div>
	<div class="description">
		<p>
			<? echo $DataProduct['name'];?>
		</p>
		<p>
			<? echo $DataProduct['description'];?>
		</p>
	</div>
	</span>
	<div class="ShowTables" style="padding: 20px;">
		<?
			$DataItemsProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM ItemProducts WHERE idProduct = ".$_GET['IdProduct'].";");
			while($ListItemsProduct = mysqli_fetch_array($DataItemsProduct)) {
		?>
		<span style="display: none;" class="TableItem<? echo $ListItemsProduct['id'];?>">
			<div>
				<table style="border: 1px rgb(146, 217, 219) solid;">
				<tr>
				<td>
					Price: 
				</td> 
				<td>
					<? echo $ListItemsProduct['price'];?> р.
				</td>
				<td>
					Amount: 
				</td> 
				<td>
					<?
						echo $ListItemsProduct['amount'];
					?>
				</td>
				</tr>
				</table>
			</div>
			<div>
				<p>
				<label style="display: block">
					Specifications:
				</label>
				<div style="background-color: white;">
					<pre><? echo $ListItemsProduct['Specifications'];?></pre>
				</div>
				</p>
			</div>
		</span>
		
		
		<?
			}
		?>
		
	</div>
	<div class="PhotosProduct">
	<?
		$DataItemsProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM ItemProducts WHERE idProduct = ".$_GET['IdProduct'].";");
		while($ListItemsProduct = mysqli_fetch_array($DataItemsProduct)) {
	?>
		<span>
			<span id="IdItemProduct" style="display: none;"><? echo $ListItemsProduct['id'];?></span>
			<img class="ImageItemProduct" src="Source/<? echo $ListItemsProduct['pathimage'];?>">
		</span>
	<?
		}
	?>
	</div>
	<hr>
	<span class="ShowBlock" style="display: block;">
		Comments
		<span id="Comments">
		</span>
	</span>
	<div class="ShowInformation" style="display: block;">
		<div id="Comments">
			<form id="Form_Send_Comment" style="display: flex; padding: 20px;" method="POST" action="SendCommentProduct.php">
				<input type="hidden" name="IdUser" value="<? echo $_SESSION['iduser'];?>">
				<input type="hidden" name="IdProduct" value="<? echo $_GET['IdProduct'];?>">
				<textarea id="textarea" name="content"></textarea>
				<input class="TextAlign button" type="submit" value="Send your comment">
			</form>
			<?
				$DataCommentsProduct = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM CommentsProducts WHERE idProduct = ".$_GET['IdProduct']." ORDER BY id DESC ;");
				while( $ListCommentsProduct = mysqli_fetch_array($DataCommentsProduct) ) {
					$DataUser = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Users WHERE id = ".$ListCommentsProduct['idUser'].";");
					$DataUser = mysqli_fetch_array($DataUser);
			?>
				<h4 class="BlockComment">
					<form class="Form_Comment" method="GET" action="DeleteCommentProduct.php">
						<input type="hidden" name="IdComment" value="<? echo $ListCommentsProduct['id'];?>">
						<label>
							<? echo $DataUser['surname']." ".$DataUser['name'];?>
						</label>
						<label>
							[Email]: 
							<a href="http://<? echo $DataUser['email'];?>">
								<? echo $DataUser['email'];?>
							</a>
						</label>
						<span style="display: block; word-wrap: break-word;">
							- <? echo $ListCommentsProduct['content'];?>
						</span>
						<?
							if ( $_SESSION['iduser'] == $DataUser['id']) {
						?>
							<input class="button" type="submit" value="Delete">
						<?
							}
						?>
					</form>
				</h4>
			<?
				}

			?>
		</div>
	</div>
</div>
</div>

<script>


$('.button_event').click( function () {
	<?
		if (isset($_SESSION['iduser']) && $_SESSION['iduser']) {
		
	?>
		this.parentNode.submit();
	<?
		}
		else {
	?>
		document.location.href = "<?="http://".$_SERVER['SERVER_NAME']."/FormLog.php?Message=First you should log";?>";
	<?
		}
	?>
}
);

$('#Form_Send_Comment').submit(function( Event ) {
	Event.preventDefault();
	$Form = $(this);
	$.ajax({
		url: 'SendCommentProduct.php',
		type: 'POST',
		data: $Form.serialize(),
		success: function(Return) {
			try {
				if (!IsAccessUser()) {
				throw 'First you should log';
				}
				$ContentComment = $Form.find('textarea').val();
				AddCommentAfterTag( $Form, $ContentComment, Return );
				$('#Form_Send_Comment').find('textarea').val('');
			}
			catch ( Message ) {
                document.location.href = "<?="http://".$_SERVER['SERVER_NAME']."/FormLog.php?Message=";?>" + Message;
			}
		}
	});
});

$('.Form_Comment').submit(function( Event ) {
	Event.preventDefault();
	$Form = $(this);
	$.ajax({
		url: 'DeleteCommentProduct.php',
		type: 'GET',
		data: $Form.serialize(),
		success: function() {
			$Form.parent().css('display', 'none');
			$Form.css('display', 'none');
		}
	});
});

$('.ShowBlock').click(
    function () {
        $ShowObject = $(this).find('span').attr('id');
        $('.ShowInformation').find('div').hide();
        $('.ShowInformation').find('#' + $ShowObject).toggle();
    }
);

	$('.ImageItemProduct').click(
		function () {
			$IdItemProduct =  $(this).siblings('#IdItemProduct').html();
			$('#MainImg').attr('src',$(this).attr('src'));
			$('#IdSelectedItemProduct').attr( 'value', $IdItemProduct );
			$('.ShowTables').find('span').hide();
			$('.ShowTables').find('.TableItem' + $IdItemProduct).toggle();
		}
	);

</script>