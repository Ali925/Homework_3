<?php
if ($_POST["file-name"]) {

$name = $_GET["name"];
$filename = trim($_POST["file-name"]);
$content = trim($_POST["file-content"]);
$address = "./files/$name";
$rename = TRUE;

$handle = fopen($address, 'w');

$write = fwrite($handle, $content);
fclose($handle);
if($name!=$filename){
   $rename = rename("./files/$name", "./files/$filename");
}
}
header("refresh: 5; url=index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit file</title>
</head>
<body>
<h1 style="text-align:center">Edit Files</h1>
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

if ($write && $rename){
	echo "<h3>File successfully edited! You will be redirected in <span id='seconds'>5</span> seconds...</h3></body></html><!--";
}

else {

	$name = $_GET["name"];

    $address = "./files/$name";
}

?>
<form method="POST" action="edit.php?name=$name">
	<div style="margin:30px;"><label for="file-name">File name:</label>
	<input type="text" name="file-name" id="file-name" style="margin-left:15px;font-size:15px;" value="<?php echo $name; ?>"></div>
	<div style="margin:30px;"><label for="file-content">File content:</label>
	<textarea name="file-content" id="file-content" cols="65" rows="10" style="font-size:15px;"><?php echo file_get_contents($address) ?></textarea></div>
	<div style="margin:30px;margin-left:620px;"><input type="submit" value="Save changes" style="font-size:30px;"></div>
</form>	
</body>
</html>
<?php
if(isset($filename) && $name!=$filename){
unlink($address);
}
?>
