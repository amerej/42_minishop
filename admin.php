<?PHP
include("db.php");
session_start();
if ($_SESSION["loggued_user_on"] != "root")
{
	header("Location: index.php?err=admin");
	exit();
}
if (isset($_GET["remove"]) && $_GET["remove"])
{
	$db = connect();
	mysqli_select_db($db, "dotdrug");
	mysqli_query($db, "DELETE from `user` WHERE login='".$_GET["remove"]."';");
	mysqli_close($db);
}
?>
<html>
	<head>
		<meta charset="UTF-8" >
		<title>drug store</title>
		<link rel="stylesheet" href="style/style.css" type="text/css" >
		<link rel="stylesheet" href="style/header.css" type="text/css" >
		<link rel="stylesheet" href="style/admin.css" type="text/css" >
		<link rel="stylesheet" href="style/footer.css" type="text/css" >
		<script type="text/javascript" >
			function	select_cat(cat, id)
			{
				var	act;
				var	new_back;
				var	val;
				var	new_val;

				val = document.getElementById(cat).value;
				act = document.getElementById(id).style.background;
				if (act === "rgb(255, 255, 255)")
					new_back = "#F0F0F0";
				else
					new_back = "#FFFFFF";
				document.getElementById(id).style.background = new_back;
				if (val === "1")
					new_val = "0";
				else
					new_val = "1";
				document.getElementById(cat).value = new_val;
			}
			function	select_remove()
			{
				var	act;
				var	new_css;
				var	val;
				var	login;

				val = document.getElementById("remove").innerHTML;
				act = document.getElementById("remove").style.background;
				if (act === "rgb(255, 255, 255)")
					new_css = "background: #f82b2b; color: white;";
				else
					new_css = "background: #FFFFFF;";
				document.getElementById("remove").style = new_css;
				if (val === "Remove ?")
				{
					login = document.getElementById("ruser").value;
					document.getElementById("remove").innerHTML = "Remove !";
					if (login)
						window.location.replace("admin.php?remove=" + login);
				}
				else
					document.getElementById("remove").innerHTML = "Remove ?";
			}
			function	edit_cart()
			{
				var	log;

				log = document.getElementById("euser").value;
				window.location.replace("cart.php?login=" + log);
			}
		</script>
	</head>
	<body>

<?PHP include("header.php") ?>

		<div id="canevas" >
			<div id="product" style="margin-left: 0.5%" >
				<h3>Add product :</h3>
				<form action="product.php" method="post" enctype="multipart/form-data">
					<div id="info" >
						<input type="text" name="name" placeholder="name" value="" class="text" >
						<input type="text" name="desc" placeholder="description" value="" class="text" >
						<input type="text" name="img" placeholder="image URL" value="" class="text" >
						<input type="text" name="price" placeholder="price" value="" class="text" >
						<div id="cat" >
							<h4 id="select" >Select categories</h4>
							<div class="check" onclick="select_cat('cannabis', 'c1')"
							id="c1" style="background: #FFFFFF;" >Cannabis</div>
							<div class="check"  onclick="select_cat('dissociative', 'c2')"
							id="c2" style="background: #FFFFFF;">Dissociative</div>
							<div class="check"  onclick="select_cat('ecstasy', 'c3')"
							id="c3" style="background: #FFFFFF;">Ecstasy</div>
							<div class="check"  onclick="select_cat('opioid', 'c4')"
							id="c4" style="background: #FFFFFF;">Opioid</div>
							<div class="check"  onclick="select_cat('precursor', 'c5')"
							id="c5" style="background: #FFFFFF;">Precursor</div>
							<div class="check"  onclick="select_cat('stimulant', 'c6')"
							id="c6" style="background: #FFFFFF;">Stimulant</div>
						</div>
					</div>
					<div id="submit" >
						<input type="submit" name="submit" value="Add" class="btn" />
					</div>
					<input type="hidden" name="cannabis" id="cannabis" value="0" >
					<input type="hidden" name="dissociative" id="dissociative" value="0" >
					<input type="hidden" name="ecstasy" id="ecstasy" value="0" >
					<input type="hidden" name="opioid" id="opioid" value="0" >
					<input type="hidden" name="precursor" id="precursor" value="0" >
					<input type="hidden" name="stimulant" id="stimulant" value="0" >
				</form>
			</div>
			<div id="line" >
			</div>
			<div id="user" style="margin-right: 0.5%" >
				<h3>Remove user :</h3>
				<div>
					<input type="text" placeholder="name" value="" class="text" id="ruser" >
					<div class="check" onclick="select_remove()"
					id="remove" style="background: #FFFFFF;" >Remove !</div>
			</div> </br>
				<h3 style="margin-top: 10vh;"  >Edit cart user :</h3>
				<div>
					<input type="text" placeholder="name" value="" class="text" id="euser" >
					<div class="check" onclick="edit_cart()"
					id="remove2" style="background: #FFFFFF;" >Edit !</div>
			</div>
		</div>

<?PHP include("footer.php") ?>

	</body>
</html>
