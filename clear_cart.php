<?PHP
include("db.php");
session_start();
if (!$_SESSION["loggued_user_on"])
{
	$i = 0;
	while ($_SESSION["cart"][$i])
	{
		if ($_SESSION["cart"][$i]["id"])
			$_SESSION["cart"][$i]["id"] = -1;
		$i++;
	}
}
else
{
	$db = connect();
	mysqli_select_db($db, "dotdrug");
	$query = "DELETE from `cart`;";
	mysqli_query($db, $query);
	mysqli_close($db);
}
header("Location: cart.php");
?>
