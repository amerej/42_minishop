<?PHP
include("db.php");
session_start();
?>
<HTML>
	<HEAD>
		<meta charset="UTF-8" >
		<title>drug store</title>
		<link rel="stylesheet" href="style/style.css" type="text/css" >
		<link rel="stylesheet" href="style/header.css" type="text/css" >
		<link rel="stylesheet" href="style/profile.css" type="text/css" >
		<link rel="stylesheet" href="style/footer.css" type="text/css" >
	</HEAD>
	<BODY>

<?PHP include("header.php") ?>

		<article>
			<form id="pass" method="post" action="edit_user.php" >
				<input type="password" name="pass" value="" placeholder="Password" class="htext" >
				<input type="password" name="newPass" value="" placeholder="New password" class="htext" style="margin-right: 1vw;" >
				<input type="submit" name="submit" value="Edit Pass" class="hbtn" >
			</form> <br />
			<form id="delete" method="post" action="edit_user.php">
				<input type="submit" name="submit" value="Delete" class="hbtn" >
			</form>
		</article>

<?PHP include("footer.php"); ?>

	</BODY>
</HTML>
