<?PHP
include("db.php");

function	insert_product($db, $name, $img, $price, $desc, $cat)
{
	mysqli_query($db, "INSERT INTO `product` (
		`id`,
		`name`,
		`img`,
		`price`,
		`desc`,
		`cat`) VALUES (NULL, '".$name."', '".$img."', '".$price."', '".$desc."', '".$cat."');");
}

session_start();

if (isset($_SESSION["cart"]))
	unset($_SESSION["cart"]);
if (!($db = connect()))
	die('Error : ' . mysql_error());
mysqli_query($db, "DROP DATABASE IF EXISTS dotdrug");
mysqli_query($db, "CREATE DATABASE dotdrug");
mysqli_select_db($db, "dotdrug");

mysqli_query($db, "CREATE TABLE `dotdrug`.`user` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`login` TEXT NOT NULL ,
	`passwd` TEXT NOT NULL ,
	`email` TEXT NOT NULL ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB;");

mysqli_query($db, "CREATE TABLE `dotdrug`.`product` (
	`id` INT AUTO_INCREMENT ,
	`name` TEXT NOT NULL ,
	`img` TEXT NOT NULL ,
	`price` TEXT NOT NULL ,
	`desc` TEXT NOT NULL ,
	`cat` TEXT NOT NULL ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB;");

mysqli_query($db, "CREATE TABLE `dotdrug`.`cart` (
	`id` INT AUTO_INCREMENT ,
	`product` INT NOT NULL ,
	`login` TEXT NOT NULL ,
	PRIMARY KEY (`id`)) ENGINE = InnoDB;");

mysqli_query($db, "INSERT INTO `user` (
	`id`,
	`login`,
	`passwd`,
	`email`) VALUES (
		NULL,
		'root',
		'toor',
		'root@dotdrug.com');");

insert_product($db,
	"Cocaine",
	"https://icedrugaddiction.files.wordpress.com/2015/06/cocaine_2118089b.jpg",
	"800",
	"20Gr of cocaine",
	"stimulant");

insert_product($db,
	"MDMA",
	"http://itcn-snac.org/wp/wp-content/uploads/2015/05/mdma.jpg",
	"160",
	"20 pills of ecstasy",
	"ecstasy");

insert_product($db,
	"Weed",
	"http://media.npr.org/assets/img/2015/05/20/blue-kush-x-4f02aedb046117cb6f5153d3f0807d3fb995e929-s900-c85.jpg",
	"70",
	"10Gr of weed from",
	"cannabis");

insert_product($db,
	"Skunk Weed",
	"img/skunk.jpg",
	"150",
	"15Gr of skunk weed from U.S.A.",
	"cannabis");

insert_product($db,
	"Nazi Cocaine",
	"img/coke_nazi.jpg",
	"800",
	"17Gr of racist nazi cocaine from Germany",
	"stimulant");

mysqli_query($db, "INSERT INTO Users (user_id, login, passwd) VALUES (NULL, 'root', 'toor');");
mysqli_close($db);
$_SESSION["loggued_user_on"] = "";
header("Location: index.php");
?>
