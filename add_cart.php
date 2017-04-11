<?PHP
session_start();
include("db.php");
$g = $_GET;
if (!isset($g["pid"]) || !$g["pid"])
{
	header("Location: index.php");
	exit();
}
if (!$_SESSION["loggued_user_on"])
{
	$i = 0;
	if ($_SESSION["cart"])
		foreach($_SESSION["cart"] as $e)
			$i++;
	$_SESSION["cart"][$i]["id"] = $i;
	$_SESSION["cart"][$i]["product"] = $g['pid'];
}
else
{
	$db = connect();
	mysqli_select_db($db, "dotdrug");
	mysqli_query($db, "INSERT INTO `cart` (
		`id`,
		`product`,
		`login`) VALUES (NULL, '".$g["pid"]."', '".$_SESSION['loggued_user_on']."');");
	mysqli_close($db);
}
if ($g["filter"] == "Undefined")
	$address = "Location: shop.php";
else
	$address = "Location: shop.php?filter=".$g['filter'];
header($address);
?>
