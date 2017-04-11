<?PHP
include("db.php");
session_start();
if (isset($_GET["remove"]) && $_GET["remove"]
&& $_SESSION["loggued_user_on"] == "root")
{
	$db = connect();
	mysqli_select_db($db, "dotdrug");
	$query = "DELETE from `product` WHERE id='".$_GET['remove']."';";
	mysqli_query($db, $query);
		$query = "DELETE from `cart` WHERE product='".$_GET['remove']."';";
		mysqli_query($db, $query);
	if (isset($_SESSION["cart"]))
	{
		$i = 0;
		while ($_SESSION["cart"][$i])
		{
			if ($_SESSION["cart"][$i]["product"] == $_GET["remove"])
				$_SESSION["cart"][$i]["id"] = -1;
			$i++;
		}
	}
	mysqli_close($db);
}
?>
<HTML>
	<HEAD>
		<meta charset="UTF-8" >
		<title>drug store</title>
		<link rel="stylesheet" href="style/style.css" type="text/css" >
		<link rel="stylesheet" href="style/header.css" type="text/css" >
		<link rel="stylesheet" href="style/menu.css" type="text/css" >
		<link rel="stylesheet" href="style/shop.css" type="text/css" >
		<link rel="stylesheet" href="style/footer.css" type="text/css" >
		<script>
			function	product_interaction(pid)
			{
				var	filter;
				var	act;
				var	dis;

				dis = document.getElementById("delete_btn").style.display;
				act = document.getElementById("delete_btn").style.background;
				if (act !== "rgb(255, 255, 255)" && dis !== "none")
					window.location.replace('shop.php?remove=' + pid);
				else
				{
					filter = document.getElementById('filter').innerHTML;
					console.log(filter);
					window.location.replace("add_cart.php?filter=" + filter + "&pid=" + pid);
				}
			}
		</script>
	</HEAD>
	<BODY>

<?PHP include("header.php") ?>

		<section>

<?PHP
$db = connect();
mysqli_select_db($db, "dotdrug");
if (!$db)
{
	echo "</section>";
	include("footer.php");
	exit();
}
$res = mysqli_query($db, "SELECT * FROM product");
while ($e = mysqli_fetch_array($res, MYSQLI_ASSOC))
{
	if (!isset($_GET["filter"]) || !$_GET["filter"] || strstr($e["cat"], $_GET["filter"]))
	{
		echo '<article>';
			echo'<div class="img"';
			echo 'style="background-image: url('.$e["img"].');" >';
				echo '<div class="desc_box" onclick="product_interaction(\''.$e["id"].'\')" >';
					echo '<span class="price" >'.$e["price"].' $</span><br />';
					echo '<span class="desc" >'.$e["desc"].'</span><br />';
				echo '</div>';
			echo '</div>';
		echo '<p>'.$e["name"].'</p>';
		echo '</article>';
	}
}
?>

		</section>
		<div id="contain_menu" >

<?PHP include("menu.php") ?>

		</div>

<?PHP include("footer.php") ?>

		<div id="filter" ><?PHP echo $_GET["filter"] ?></div>
	</BODY>
</HTML>
