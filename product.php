<?PHP
include("db.php");

$p = $_POST;
if (!isset($p["name"]) || !isset($p["desc"]) || !isset($p["img"]) || !isset($p["price"])
|| !$p["name"] || !$p["desc"] || !$p["img"] || !$p["price"])
{
	header("Location: admin.php?err=too_few");
	exit();
}

$cat = "0";
if ($p["cannabis"])
	$cat = $cat."cannabis/";
if ($p["dissociative"])
	$cat = $cat."dissociative/";
if ($p["ecstasy"])
	$cat = $cat."ecstasy/";
if ($p["opioid"])
	$cat = $cat."opioid/";
if ($p["precursor"])
	$cat = $cat."precursor/";
if ($p["stimulant"])
	$cat = $cat."stimulant/";
$cat = !$cat ? "other" : substr($cat, 1, strlen($cat) - 2);

$db = connect();
mysqli_select_db($db, "dotdrug");

$query = "INSERT INTO `product` (
	`id`,
	`name`,
	`img`,
	`price`,
	`desc`,
	`cat`) VALUES (NULL, '".$p['name']."', '".$p['img']."', '".$p['price']."', '".$p['desc']."', '".$cat."');";
mysqli_query($db, $query);

mysqli_close($db);
header("Location: admin.php");
?>
