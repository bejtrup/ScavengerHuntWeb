<?php 
$max = 500 * 1024;
$message = '';
if (isset($_POST['upload'])) {
	$destination = __DIR__ . '/uploaded/';
	if ($_FILES['filename']['error'] == 0) {
		$result = move_uploaded_file($_FILES['filename']['tmp_name'], $destination . $_FILES['filename']['name']);
		if ($result) {
			$message = $_FILES['filename']['name'] . ' was uploaded successfully.';
		} else {
			$message = 'Sorry, there was a problem uploading ' .$_FILES['filename']['name'];
		}
	} else {
		switch ($_FILES['filename']['error']) {
			case 2:
				$message = $_FILES['filename']['name'] . ' is too big to upload.';
				break;
			case 4:
				$message = 'No file selected.';
				break;
			default:
				$message = 'Sorry, there was a problem uploading ' .$_FILES['filename']['name'];
				break;
		}
	}
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Uploads</title>
    <link href="styles/form.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>Uploading Files</h1>
<?php 
if ($message) {
    echo "<p>$message</p>";
}
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
<p>
<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max;?>">
<label for="filename">Select File:</label>
<input type="file" name="filename" id="filename">
</p>
<p>
<input type="submit" name="upload" value="Upload File">
</p>
</form>
</body>
</html>