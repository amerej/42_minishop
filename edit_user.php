<?php
include("db.php");
session_start();
$p = $_POST;

if (!$_SESSION["loggued_user_on"]) {
	header("Location: index.php?err=ntm");
	exit();
}
$db = connect();
mysqli_select_db($db, "dotdrug");

if ($p['submit'] == "Edit Pass") {
	$log = $_SESSION["loggued_user_on"];
	$res = mysqli_query($db, "SELECT * from user WHERE login = '$log';");
	$e = mysqli_fetch_array($res, MYSQLI_ASSOC);

	if ($p['pass'] != '' && $p['newPass'] != '' && $e["passwd"] == $p['pass'])
	{
		$newPasswd = mysqli_real_escape_string($db, $p['newPass']);
		$sql = "UPDATE user SET passwd='$newPasswd' WHERE login='$log'";
		mysqli_query($db, $sql);
	}
	else {
		header("Location: profile.php?err=editlogin");
		exit();
	}
	header("Location: profile.php");
	mysqli_close($db);
	exit();
}

if ($p["submit"] == "Delete") {
	$tmp_user = $_SESSION["loggued_user_on"];
	if ($tmp_user == 'root') {
		header("Location: profile.php?err=delroot");
		exit();
	}
	$_SESSION["loggued_user_on"] = "";
	$sql = "DELETE FROM user WHERE login='".$tmp_user."';";
	mysqli_query($db, $sql);
	header("Location: index.php");
	mysqli_close($db);
	exit();
}
?>
