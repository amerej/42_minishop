<?PHP
function	connect()
{
	$db = mysqli_connect("localhost", "root", "toor");
	if (mysqli_connect_errno()) {
		printf("Fail to connect : %s\n", mysqli_connect_error());
		exit();
	}
	return ($db);
}
?>
