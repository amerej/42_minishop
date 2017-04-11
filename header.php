<script type="text/javascript" >
function	delete_mode()
{
	var	act;
	var	new_css;
	var	val;
	var	login;
	var	mar;

	val = document.getElementById("delete_btn").innerHTML;
	act = document.getElementById("delete_btn").style.background;
	mar = document.getElementById("delete_btn").style.marginRight;
	if (act === "rgb(255, 255, 255)")
		new_css = "background: #f82b2b; color: white; margin-right: " + mar + ";";
	else
		new_css = "background: #FFFFFF; margin-right: " + mar + ";";
	document.getElementById("delete_btn").style = new_css;
}
function	proceed()
{
	window.location.replace("clear_cart.php");
}
</script>
<?PHP
	function	get_price()
	{
			$db = connect();
			mysqli_select_db($db, "dotdrug");
		if ($_SESSION["loggued_user_on"])
		{
			$i = 0;
			$n = 0;
			$res = mysqli_query($db, "SELECT * FROM `cart` WHERE login='".$_SESSION["loggued_user_on"]."'");
			while ($e = mysqli_fetch_array($res))
			{
				$res2 = mysqli_query($db, "SELECT * FROM `product` WHERE id='".$e["product"]."';");
				$e2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);
				$n += $e2["price"];
				$i++;
			}
			return ($n);
		}
		else
		{
			$n = 0;
			$i = 0;
			if (!isset($_SESSION["cart"]))
				return (0);
			while ($_SESSION["cart"][$i])
			{
				if ($_SESSION["cart"][$i]["id"] >= 0)
				{
					$res2 = mysqli_query($db, "SELECT * FROM `product` WHERE id='".$_SESSION['cart'][$i]['product']."';");
					$e2 = mysqli_fetch_array($res2, MYSQLI_ASSOC);
					$n += intval($e2["price"]);
				}
				$i++;
			}
			return ($n);
		}
	}
	function	get_articles()
	{
		if ($_SESSION["loggued_user_on"])
		{
			$i = 0;
			$db = connect();
			mysqli_select_db($db, "dotdrug");
			$res = mysqli_query($db, "SELECT * FROM `cart` WHERE login='".$_SESSION["loggued_user_on"]."'");
			while ($e = mysqli_fetch_array($res))
				$i++;
			return ($i);
		}
		else
		{
			$n = 0;
			$i = 0;
			if (!isset($_SESSION["cart"]))
				return (0);
			while ($_SESSION["cart"][$i])
			{
				if ($_SESSION["cart"][$i]["id"] >= 0)
					$n++;
				$i++;
			}
			return ($n);
		}
	}
?>
<header>
	<h1 onclick="window.location.replace('index.php');" ><span style="color: #707070; margin-right: 1vw;" id="htitle" >Dot</span> Drug</h1>
	<a href="cart.php" title="Cart" id="cart_btn" >
		<img src="http://www.inmotionhosting.com/support/images/stories/icons/ecommerce/empty-cart-dark.png" id="cart_link" >
		<div id="count" ><?PHP echo get_articles(); ?> articles <?PHP echo get_price(); ?> $</div>
	</a>
	<form method="post" action="user.php" id="log_form" >

<?PHP if (!$_SESSION["loggued_user_on"]) { ?>

	<input type="text" name="login" value="" placeholder="login" class="htext" >
	<input type="password" name="passwd" value="" placeholder="password" class="htext" style="margin-right: 1vw;" >
	<input type="submit" name="submit" value="Log in" class="hbtn" >
	<input type="submit" name="submit" value="Sign in" class="hbtn" >

<?PHP } else { ?>

<?PHP if ($_SESSION["loggued_user_on"] == "root") { ?>

	<input type="submit" name="submit" value="Admin" class="hbtn" ></input>

<?PHP } else { ?>

	<input type="submit" name="submit" value="Profile" class="hbtn" ></input>

<?PHP } ?>

	<input type="submit" name="submit" value="Log out" class="hbtn" ></input>

<?PHP } ?>

	</form>

<?PHP
$style = "background: ";
if (!isset($_GET["remove"]))
	$style = $style."#FFFFFF;";
else
	$style = $style."rgb(248, 43, 43); color: white;";
if (!$_SESSION["loggued_user_on"])
	$style = $style." margin-right: 7.5vw;";
else
	$style = $style." margin-right: 15vw;";
$file = $_SERVER["REQUEST_URI"];
$file = strrchr($file, "/");
$file = substr($file, 1, strlen($file) - 1);
if (!strncmp($file, "cart.php", 8) && $_SESSION["loggued_user_on"])
{
?>
	<div id="proceed_box" >
		<input type="submit" id="proceed" value="Proceed" class="hbtn" onclick="proceed();" ></input>
	</div>
<?PHP
}
if ((isset($_SESSION["loggued_user_on"]) && $_SESSION["loggued_user_on"] == "root"
&& !strncmp($file, "shop.php", 8)) || !strncmp($file, "cart.php", 8))
{
?>

	<input type="submit" value="Delete mode" id="delete_btn" onclick="delete_mode();"
	<?PHP echo 'style="'.$style.'"' ?> ></input>

<?PHP } else { ?>

	<div style="display: none;" id="delete_btn" ></div>

<?PHP } ?>

</header>
