<?php include ("dbconnect.php")?>
<doctype !html>
<html>
<head>
<meta charset="UTF-8">
<link href="styles.css" rel="stylesheet" type="text/css">
<title>Users</title>
<script>
function textAreaAdjust(text) {
    text.style.height = "1px";
    text.style.height = (25+text.scrollHeight)+"px";
}
</script>
</head>
    
<body>
    
         
    <fieldset>
    <h2>Current data:</h2>
    
    <?php
// Display what's in the database at the moment.
$sql = "SELECT * FROM artists";
$rows=($dbh->query($sql));
$row=$rows->fetchAll();

if (count($row)==0) 
{echo "There are currently no artists in the database";
}
else
{
echo
'<table>
<tr>
<th>Name</th>
<th>shortBio</th>
<th>fullBio</th>
<th>Categories</th>
<th>Image</th>
<th></th>
<th></th>
</tr>';
foreach ($dbh->query($sql) as $row)
{
?>
<form id="deleteForm" name="deleteForm" method="post" enctype="multipart/form-data" action="processartists.php">
<tr>
<?php
		echo "<input type='hidden' name='id' value='$row[id]'>
    <td><input id='medium' type='text' name='name' value='$row[name]' /></td>
    <td><textarea id='long' onkeyup='textAreaAdjust(this)'name='shortBio' value='$row[shortBio]'>$row[shortBio]</textarea></td>
    <td><textarea id='long' onkeyup='textAreaAdjust(this)'name='fullBio' value='$row[fullBio]'>$row[fullBio]</textarea></td>
    <td><select id='medium' name='category[]' size='4' multiple>";
        foreach($genres as $genre){
            echo "<option value=$genre>$genre</option>";
            }
    echo "</select></td>
	<td>"; if ($row[filename]==""){echo 'no image uploaded';} else {echo"<img class='thumbnail' src=\"uploads/$row[filename]\">";} echo "<input type='file' id='long' name='photo' /></td>
    <input type='hidden' name='filename' value='$row[filename]' />";
?>

<td><input type="submit" name="submit" value="Update" /></td>
<td><input type="submit" name="submit" value="Delete" class="deleteButton"></td>
</tr>
</form>

<?php
}
echo " </table>
</fieldset>";
}

// close the database connection
$dbh = null;
?>

</body>
</html>

