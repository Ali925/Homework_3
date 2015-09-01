<?php
$name = $_GET["name"];

$address = "./files/$name";

$return = unlink($address);
if($return)
header("refresh: 5; url=index.php");

echo "<h1 style='text-align:center'>Delete Files</h1>";

if($return)
	echo "<h3>File $name successfully deleted! You will be redirected in <span id='seconds'>5</span> seconds...</h3>";
?>

<script>
      var seconds = 5;
      setInterval(
        function(){
        	if(seconds>1)
          document.getElementById('seconds').innerHTML = --seconds;
        }, 1000
      );
</script>