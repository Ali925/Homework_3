<?php

require_once 'connection.php';
$query = "SHOW TABLES";
$result = $mysqli->query($query);

for ($i=0; $i <$result->num_rows ; $i++) { 
	$row[$i] = $result->fetch_array(MYSQLI_NUM);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Database</title>
</head>
<body>
	<h1 style="text-align:center">Export table to csv/json/xml</h1>
	<form method="post" action="export.php" style="margin-left:80px;margin-top:100px;font-size:25px">
		<div style="margin-bottom:30px;">
		    <label for="table">Select table:</label>
			<select name="table" id="table">
				<?php
					for($i=0;$i<$result->num_rows;$i++){
						echo "<option value='".strtolower($row[$i][0])."'>".ucfirst($row[$i][0])."</option>";
					}
				?>
			</select>
		</div>
		<div style="margin-bottom:20px;">
		    <label for="format">Select format:</label>
			<select name="format" id="format" style="margin-left:35px">
				<option value="csv">CSV</option>
				<option value="xml">XML</option>
				<option value="json">JSON</option>
			</select>
		</div>
		<div>
			<input type="submit" value="Export" style="font-size:25px;margin-left:180px;">
		</div>
	</form>
</body>
</html>
