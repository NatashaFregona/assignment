<?php 
include "dbconnect.php";
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <link href="styles.css" rel="stylesheet" type="text/css">
<title>Artists Records</title>
</head>

<body>
<?php
// display full details of artist selected
$sql = "SELECT name,shortBio,fullBio,filename FROM artists WHERE id=$_GET[id]";

$result = $dbh->query($sql);
while ($row=$result->fetch()){
    echo"<div id='artist'>";
    echo "<div><h1>".$row['name']."</h1>";
        if($row['filename']){
    echo "<img id='fullimage' src=\"uploads/$row[filename]\">";
    }
    echo "<p>$row[shortBio]</p>
    <p>$row[fullBio]</p></div></div>";
    
}

$dbh = null;
?>

<p><a href="processartists.php">Return to full artist list</a></p>

</body>
</html>