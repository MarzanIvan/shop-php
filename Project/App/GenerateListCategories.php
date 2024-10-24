<?global$Server;?>
<link rel="stylesheet" type="text/css" href="Source/CSS/CSSText.css">
<script type="text/javascript" src="Source/Frameworks/jquery-1.4.2.js"></script>
<style type="text/css">
	
.panel{
	display: inline-block;
	margin: 0px;
	text-align: center;
	padding: 20px;
	font-size: 25px;
	border: 1px solid black;
    height: 100%;
}	

</style>
<div class="panel unselect">
	Категории
	<hr>
<?
    $Categories = mysqli_query($Server->get_DB_HANDLE(),"SELECT * FROM Categories;");
    while($ListCategories = mysqli_fetch_array($Categories)) {
?>
    <form class="Form_Selection_Product" method="GET" action="GenerateListProducts.php">
        <input type="hidden" name="idCategory" value="<? echo $ListCategories['id'];?>">
        <a href="#" onclick="this.parentNode.submit();">
            <?
                echo $ListCategories['name'];
            ?>
        </a>
    </form>  
    <?
    	}
    	mysqli_free_result($Categories);
    ?>
 </div>
 <script>
$('#Form_Selection_Product').submit(function( Event ) {
	$Form = $(this);
	$.ajax()
});
 </script>