<?php include ("dbconnect.php")?>
<doctype !html>
<html>
<head>
<meta charset="UTF-8">
<link href="styles.css" rel="stylesheet" type="text/css">
<title>Artist Database</title>
<script>
function textAreaAdjust(text) {
    text.style.height = "1px";
    text.style.height = (25+text.scrollHeight)+"px";
}
</script>
</head>
    
<body>
    
    <h1>Artist Database</h1>
    <form id="insert" name="insert" method="post" enctype="multipart/form-data" action="processartists.php">
        <fieldset>
            <h2>Insert new artist record:</h2>
            <p>
                <label for="name">Name: </label>
                <input type="text" name="name" value="<?=$_POST['name'];?>">
            </p>
            <p>
                <label for="shortBio">shortBio: </label>
                <input type="text" name="shortBio" value="<?=$_POST['shortBio'];?>">
            </p>
            <p>
                <label for="fullBio">fullBio: </label>
                <input type="text" name="fullBio" value="<?=$_POST['fullBio'];?>">
            </p>
            <label for="category">Category (select all that apply): </label>
            
    <select name="category[]" size="4" multiple>
        <?php 
        $genres=['Country', 'Rock', 'Pop', 'Blues', 'Jazz', 'RnB', 'Rap','Indy','Reggae'];
        foreach($genres as $genre){
            echo "<option value=$genre>$genre</option>";
            }?>
    </select>
            <p>
                <label for="photo">Photo: </label>
                <input type="file" name="photo" id="photo" value="<?=$_POST['photo'];?>">
            </p>
            <p>
                
                <input type="submit" name="submit" id="submit" value="Add Entry">
            </p>
        </fieldset>
    </form>
    
    
    

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
<th>Id</th>
<th>Name</th>
<th>shortBio</th>
<th>fullBio</th>
<th>Categories</th>
<th>Image</th>
</tr>';
foreach ($dbh->query($sql) as $row)
{
?>
<form id="deleteForm" name="deleteForm" method="post" enctype="multipart/form-data" action="processartists.php">
<tr>
<?php
		echo "<td><input type='text' name='id' value='$row[id]' readonly></td>
    <td><input type='text' name='name' value='$row[name]' /></td>
    <td><textarea onkeyup='textAreaAdjust(this)'name='shortBio' value='$row[shortBio]'>$row[shortBio]</textarea></td>
    <td><input type='text' name='fullBio' value='$row[fullBio]' /></td>
    <td><select name='category[]' size='4' multiple>";
        foreach($genres as $genre){
            echo "<option value=$genre>$genre</option>";
            }
    echo "</select></td>
	<td>"; if ($row[filename]==""){echo 'no image uploaded';} else {echo"<img class='thumbnail' src=\"uploads/$row[filename]\">";} echo "<input type='file' name='photo' value='Change Photo' /></td>
    <input type='hidden' name='filename' value='$row[filename]' />";
?>

<td><input type="submit" name="submit" value="Update Entry" /></td>
<td><input type="submit" name="submit" value="Delete Entry" class="deleteButton"></td>
</tr>
</form>

<?php
}
//<form action="processartists.php" method="post">
//<tr>
// <td colspan='9'>
// <input name='delete' value='Delete Selected Artists' type='submit'>
// </td>
// </tr>
echo "

 </table>
</fieldset>";
}

// close the database connection
$dbh = null;
?>

</body>
</html>



