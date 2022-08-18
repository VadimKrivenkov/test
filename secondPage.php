<?php 
require 'config.php';
#upload файла 
$name = "upload/" . $_FILES["userfile"]["name"];
move_uploaded_file($_FILES["userfile"]["tmp_name"], $name);

if (empty($_FILES["userfile"]["name"])) {
	
}
else {
	rename("upload/" . $_FILES["userfile"]["name"], "upload/table.csv");
}
$uploadFileName = $_FILES["userfile"]["name"];


#конфиг бд
$link = new mysqli("localhost", "root", "", "test");


#удаление прошлой таблицы
if ($_POST['checkForm'] == 1) {
	$sqlDeleteTable = "DROP TABLE uploadfile";
	$resultDeleteTable = mysqli_query($link, $sqlDeleteTable);

	#созд таблицу с именем файла
	$sqlCreateTable = "CREATE TABLE uploadfile (
	        uid INT AUTO_INCREMENT PRIMARY KEY,
	        name VARCHAR(255) NOT NULL,
	        age INT NOT NULL,
	        email VARCHAR(255) NOT NULL,
	        phone VARCHAR(255) NOT NULL,
	        gender VARCHAR(255) NOT NULL)";
	$resultCreateTable = mysqli_query($link, $sqlCreateTable);
	
	
	#добавляем данные в бд 
	$tempFile = "upload/table.csv";
	$subValue = "";
	
	if (file_exists($tempFile)) {
		$content = file_get_contents('upload/table.csv');
    	for ($j=1; $j < 11; $j++) { 
    	    $lines = explode("\n", $content);
    	    for ($i=0; $i < 6; $i++) { 
    	        $array = explode(",", $lines[$j]);
    	        $value = $value . "'" . $array[$i] . "', ";
    	        $subValue = substr($value,0,-2);
    	    }
    	    $sql = "INSERT INTO uploadfile (uid, name, age, email, phone, gender) VALUES ($subValue)";
    	    $result = mysqli_query($link, $sql);
    	    $value = "";
    	}
	}
}


#вывод таблицы в body
function sqlToHtml(){
	global $link;
	$tempFile = "upload/table.csv";
	if (file_exists($tempFile)) {
		$sqlView = "SELECT * FROM uploadfile";
		$resultView = mysqli_query($link, $sqlView);
    	while ($array = mysqli_fetch_array($resultView)) {
    		echo "<tr>";
    	       	echo "<td>" . $array["uid"] . "</td>";
    	       	echo "<td>" . $array["name"] . "</td>";
    	       	echo "<td>" . $array["age"] . "</td>";
    	       	echo "<td>" . $array["email"] . "</td>";
    	       	echo "<td>" . $array["phone"] . "</td>";
    	       	echo "<td>" . $array["gender"] . "</td>";
    	    echo "</tr>";
		}
	}
	else {
		echo "<br>Нету данных";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Second Page</title>
</head>
<body>
	<a href="firstPage.php">Import Data</a>
	<table border="1">
		<?php sqlToHtml(); ?>
	</table>
</body>
</html>