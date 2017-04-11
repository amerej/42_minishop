<?PHP
include("db.php");
session_start();
if ($_SESSION["loggued_user_on"] != "root" || 
!isset($_GET["login"]) || (!$_GET["login"] && $_GET["login"] != "0"))
	$log = $_SESSION["loggued_user_on"];
else
	$log = $_GET["login"];
if (isset($_GET["remove"]) && ($_GET["remove"] || $_GET["remove"] == "0"))
{
	if (!$_SESSION["loggued_user_on"])
	{
		$i = 0;
		while ($_SESSION["cart"][$i])
		{
			if ($_SESSION["cart"][$i]["id"] == intval($_GET["remove"]))
				$_SESSION["cart"][$i]["id"] = -1;
			$i++;
		}
	}
	else
	{
		$db = connect();
		mysqli_select_db($db, "dotdrug");
		$query = "DELETE from `cart` WHERE login='".$log."' and id='".$_GET['remove']."';";
		mysqli_query($db, $query);
		mysqli_close($db);
	}
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
		<script type="text/javascript" >
			function	may_delete(id, log)
			{
				var	act;

				act = document.getElementById("delete_btn").style.background;
				if (act !== "rgb(255, 255, 255)")
					window.location.replace('cart.php?login=' + log + '&remove=' + id);
			}
		</script>
	</HEAD>
	<BODY>

<?PHP include("header.php") ?>

		<section style="margin-left: 13vw;" >

<?PHP
$db = connect();
mysqli_select_db($db, "dotdrug");
if (!$db)
{
	echo "</section>";
	include("footer.php");
	exit();
}
if ($_SESSION["loggued_user_on"])
{
	$cart_res = mysqli_query($db, "SELECT * FROM cart WHERE login='".$log."';");
	if (!$cart_res)
	{
		echo "</section>";
		include("footer.php");
	exit();
	}
}
$i = 0;
while ((!$_SESSION["loggued_user_on"] && $_SESSION["cart"][$i])
|| ($_SESSION["loggued_user_on"] && $prod = mysqli_fetch_array($cart_res, MYSQLI_ASSOC)))
{
	if ($_SESSION["loggued_user_on"])
		$res = mysqli_query($db, "SELECT * FROM product WHERE id='".$prod["product"]."';");
	else
		$res = mysqli_query($db, "SELECT * FROM product WHERE id='".$_SESSION["cart"][$i]["product"]."';");
	$e = mysqli_fetch_array($res, MYSQLI_ASSOC);
	if ($_SESSION["loggued_user_on"] || (!$_SESSION["loggued_user_on"] && $_SESSION["cart"][$i]["id"] >= 0))
	{
		if (!$_SESSION["loggued_user_on"])
			$prod["id"] = $_SESSION["cart"][$i]["id"];
		echo '<article>';
			echo'<div class="img"';
			echo 'style="background-image: url('.$e["img"].');" >';
				echo '<div class="desc_box" onclick="may_delete(\''.$prod["id"].'\', \''.$log.'\');" >';
					echo '<span class="price" >'.$e["price"].' $</span><br />';
					echo '<span class="desc" >'.$e["desc"].'</span><br />';
				echo '</div>';
			echo '</div>';
			echo '<p>'.$e["name"].'</p>';
		echo '</article>';
	}
	$i++;
}
?>

		</section>

<?PHP include("footer.php") ?>

	</BODY>
</HTML>
