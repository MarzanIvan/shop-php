<?
    global$Server;
	if (isset($_GET['Message'])) {

?>
	<style>
		.frame{
			background-color: white;
			padding: 20px;
		}

		.CenterBlockMessage{
			position: absolute;
    		top: 50%;
    		left: 50%;
    		margin-right: -50%;
    		transform: translate(-50%, -50%);
			text-align: center;
		}

		.MaxWidthChildElements *{
			width: 100%;
		}

		.BlockChilds *{
			display: block;
		}

		.button[type="button"] {
			text-align: center;
   			cursor: pointer;
			border: 1px rgb(146, 217, 219) solid;
		}

		.button[type="button"]:hover {
			color: #4d90aa;
			background: rgb(255,255,255);
			background: radial-gradient(circle, rgba(255,255,255,0.8715861344537815) 0%, rgba(213,251,255,1) 96%, rgba(250,254,255,1) 100%);
		}

		.FontChilds *{
			font-size: 25px;
		}
		#BlackBackground{
			position: fixed;
			left:0;
			top:0;
			background-size: 100%;
			z-index: 3;
			opacity: 0.8;
			width: 100%;
			height: 100%;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">
	<script type="text/javascript" src="Source/Frameworks/jquery-1.4.2.js"></script>
	<img id="BlackBackground" src="Source/Photoes/BlackImage.jpg">
	<div id="Message" style="display: inline-block; width: 30%; z-index: 4;" class="CenterBlockMessage">
		<p class="FontChilds frame BlockChilds MaxWidthChildElements">
			<label>
				<? echo $_GET['Message'];?>	
			</label>
			<input id="ButtonCloseMessage" style="padding: 2%; margin-top: 10%;" class="button" type="button" value="Cancel">	
		</p>
	</div>	
	<script>
		$('#ButtonCloseMessage').click(function() {
			$('#Message').remove();
			$('#BlackBackground').remove();
		});
	</script>
<?
	}
?>

