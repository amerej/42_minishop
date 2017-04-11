<?PHP
include("db.php");
session_start();
?>
<HTML>
	<HEAD>
		<meta charset="UTF-8" >
		<title>drug store</title>
		<link rel="stylesheet" href="style/style.css" type="text/css" >
		<link rel="stylesheet" href="style/header.css" type="text/css" >
		<link rel="stylesheet" href="style/index.css" type="text/css" >
		<link rel="stylesheet" href="style/footer.css" type="text/css" >
	</HEAD>
	<BODY>

<?PHP include("header.php") ?>

		<article>
			<div id="image_canevas" >
				<h2>Une soirée ? Un evenement ? Passez commande sur
					<span id="dotdrug" ><span style="color: #707070;" >Dot </span>Drug</span>
				</h2>
				<div id="image" >
				</div>
			</div>

<?PHP include("menu.php") ?>

		</article>

<?PHP include("footer.php"); ?>

	</BODY>
</HTML>
