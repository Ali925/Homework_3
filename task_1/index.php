<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library</title>
</head>
<body>
	<h1 style="text-align:center">Online Library</h1>
	<a href="add_file.php" style="position:absolute;margin-top:-50px;margin-left:35px;font-size:22px">Add file</a>
	<ul style="list-style:none;margin-top:100px;">
	    <?php

           $files = scandir('./files');
     $files = array_diff($files, array('.', '..', '.DS_Store'));

      foreach ($files as $key) {
      	 echo "<li style='padding:10px;font-size:25px'><a href='view.php?name=$key'>$key</a><a href='edit.php?name=$key' style='margin-left:30px;'>Edit file</a><a href='delete.php?name=$key' style='margin-left:30px;'>Delete file</a><li>";
      }
	    ?>
	</ul>
</body>
</html>