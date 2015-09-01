<?php
if ($_POST["file-name"]) {

$filename = trim($_POST["file-name"]);
$content = trim($_POST["file-content"]);

$address = "./files/$filename";


if($filename!=''){
$handle = fopen($address, 'w');
$write = fwrite($handle, $content);
$result = 1;
fclose($handle);
}
else {
$result = 0; }
}
header('refresh: 5; url=index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Add file</title>
</head>
<body>
	<h1 style="text-align:center">Add Files</h1>
<script>
      var seconds = 5;
      setInterval(
        function(){
        	if(seconds>1)
          document.getElementById('seconds').innerHTML = --seconds;
        }, 1000
      );
</script>
<?php

if ($write && $result==1){
	echo "<h3>File successfully added! You will be redirected in <span id='seconds'>5</span> seconds...</h3></body></html><!--";
}

elseif (isset($result) && $result==0) {
	 echo "<h3>Fill all fields</h3>";
}
?>
	<form method="post" action="add_file.php">
		<div style="margin:30px;"><label for="file-name">File name:</label>
		<input type="text" name="file-name" id="file-name" style="margin-left:15px;font-size:15px;"></div>
		<div style="margin:30px;"><label for="file-content">File content:</label>
		<textarea name="file-content" id="file-content" cols="65" rows="10" style="font-size:15px;"></textarea></div>
		<div style="margin:30px;margin-left:620px;"><input type="submit" value="Add file" style="font-size:30px;"></div>
	</form>
</body>
</html>