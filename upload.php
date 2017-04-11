<?php
$target_dir = "img/uploads/";
$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
$flag = true;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if (isset($_POST['submit'])) {
	$check = getimagesize($_FILES['fileToUpload']['tmp_name']);
	if ($check !== false) {
		echo "File is an image - " . $check['mime'] . ".";
		$flag = true;
	}
	else {
		echo "File is not an image.";
		$flag = false;
	}
}

// Check if file already exists
if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$flag = false;
}

// Check file size
if ($_FILES['fileToUpload']['size'] > 500000) {
	echo "Sorry, your file is too large.";
	$flag = false;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
	echo "Sorry, only JPG, JPEG and PNG files are allowed.";
	$flag = false;
}

// Check if $flag is set to false by an error
if ($flag == false) {
	echo "Sorry, your file was not uploaded.";
}
else {
	if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
		echo "The file ". basename($_FILES['fileToUpload']['name']). " has been uploaded.";
	}
	else {
		echo "Sorry, there was an error uploading your file.";
	}
header("Location: admin.php");
}
?>
