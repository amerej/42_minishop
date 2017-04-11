<?PHP
include("db.php");
include("import_cart.php");
session_start();
$p = $_POST;
if ($p["submit"] == "Profile")
{
	header("Location: profile.php");
	exit();
}
if ($p["submit"] == "Admin")
{
	header("Location: admin.php");
	exit();
}
if ($p["submit"] == "Log out")
{
	$_SESSION["loggued_user_on"] = "";
	header("Location: index.php");
	exit();
}
if (!isset($p["login"]) || !isset($p["passwd"])
|| !$p["login"] || !$p["passwd"])
{
	header("Location: index.php?err=few_info");
	exit();
}
$db = connect();
mysqli_select_db($db, "dotdrug");
if ($p["submit"] == "Log in")
{
	$log = mysqli_real_escape_string($db, $p["login"]);
	$pass = mysqli_real_escape_string($db, $p["passwd"]);
	$res = mysqli_query($db, "SELECT * from `user` WHERE login = '".$log."' and passwd = '".$pass."';");
	if ($res && mysqli_fetch_array($res))
		$_SESSION["loggued_user_on"] = $p["login"];
	else
	{
		$_SESSION["loggued_user_on"] = "";
		header("Location: index.php?err=passwd");
		exit();
	}
	header("Location: index.php");
	exit();
}
else
{
	$res = mysqli_query($db, "SELECT * from user WHERE login = '".$p['login']."';");
	if ($res && mysqli_fetch_array($res))
	{
		$_SESSION["loggued_user_on"] = "";
		header("Location: index.php?err=login");
		exit();
	}
	else
	{
		$_SESSION["loggued_user_on"] = $p["login"];
		mysqli_query($db, "INSERT INTO `user` (
			`id`,
			`login`,
			`passwd`,
			`email`) VALUES (NULL,
			'".$p["login"]."',
			'".$p["passwd"]."',
			'default');");
		import_cart();
	}
	header("Location: index.php");
	exit();
}
?>
