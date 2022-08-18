<?php 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>First Page</title>
</head>
<body>
	<form enctype="multipart/form-data" method="POST" action="secondPage.php">
		<input name="userfile" type="file" required><br>
		<input name="submit" type="submit" value="Import"><br>
		<input name="checkForm" type="hidden" value="1"><br>
	</form>
	<form method="POST" action="clearTable.php">
		<input name="submitClear" type="submit" value="Clear all records"><br>
	</form>
	<a href="secondPage.php">View results</a>
</body>
</html>