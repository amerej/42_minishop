<?PHP
function	import_cart()
{
	$i= 0;
	$db = connect();
	mysqli_select_db($db, "dotdrug");
	while ($_SESSION["cart"][$i])
	{
		mysqli_query($db, "INSERT INTO `cart` (
			`id`,
			`product`,
			`login`) VALUES (NULL, '".$_SESSION["cart"][$i]["product"]."', '".$_SESSION['loggued_user_on']."');");
		$i++;
	}
	unset($_SESSION["cart"]);
	mysqli_close($db);
}
?>
