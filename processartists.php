<?php include("dbconnect.php");
$debugOn = true;
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

function upload_photo($ext,$filename){
$allowed_filetypes = array('.jpg','.jpeg','.png','.gif');
$max_filesize = 10000000;
$upload_path = __DIR__.'/uploads/';

if(!in_array($ext,$allowed_filetypes) AND $ext!="")
  echo('<p>The file you attempted to upload is not allowed.</p>');
if(filesize($_FILES['photo']['tmp_name']) > $max_filesize)
  echo('<p>The file you attempted to upload is too large.</p>');

if(!is_writable($upload_path))
  echo('<p>You cannot upload to the specified directory</p>');

if(move_uploaded_file($_FILES['photo']['tmp_name'],$upload_path . $filename)) {

echo "<p>Your image upload was successful!\n</p>";
    }
    else if (!is_uploaded_file($_FILES['photo']['tmp name'])){
    echo "<p>You did not select a photo to upload.</p>";
    $filename=NULL;
}
             else {
     echo "<p>There was an error during the file upload.\n</p>";
}
}

// execute the appropriate query based on which submit button (insert, delete or update) was clicked
if ($_POST['submit'])
{
	$errorMessage="";
    if(empty($_POST['name']))
    {
        $errorMessage.="Please enter the artist's name";
    }
    else{
            //check if artist already in database
    $result = $dbh->query("SELECT name from artists where shortBio = '$_REQUEST[shortBio]'");
    $rows = $result->fetchall(PDO::FETCH_ASSOC);
	foreach ($rows as $row){
    if ($row[name]==$_REQUEST[name] AND $_REQUEST['submit']=="Add Entry"){
            $errorMessage.="Artist already exists, please edit details below";
        }
     }
    }

    if(!empty($errorMessage))
    {
        include "artists.php";
		
	 }
else{
if ($_REQUEST['submit'] == "Add Entry")
{
$ext = substr($_FILES['photo']['name'], strpos($_FILES['photo']['name'],'.'), strlen($_FILES['photo']['name'])-1);
$filename = $_FILES['photo']['name'];
upload_photo($ext, $filename);

    
	$sql = "INSERT INTO artists (name, shortBio, fullBio,filename) VALUES ('$_REQUEST[name]', '$_REQUEST[shortBio]', '$_REQUEST[fullBio]', '$filename')";
	if ($dbh->exec($sql)){
		echo "$_REQUEST[name] has been added.";
		}
	else{
		echo "Not inserted"; // in case it didn't work - e.g. if database is not writeable
    }
	
	foreach ($_POST['category'] as $val){
        $sq="SELECT id FROM artists WHERE name='$_REQUEST[name]'";
        $result=($dbh->query($sq));
        $id=$result->fetch();


		$sq="INSERT INTO Genre (id,category) VALUES($id[id],'$val')";
	   $dbh->exec($sq);
	}
}


else if ($_REQUEST['submit'] == "Delete")
{
    unlink(__DIR__.'/uploads/'.$_REQUEST[filename]);

    $sql="DELETE FROM Genre WHERE id ='$_REQUEST[id]'";
    $dbh->exec($sql);
    
	$sql = "DELETE FROM artists WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sql))
		echo "Deleted $_REQUEST[name]";
	else
        echo "Not deleted";
    
}

else if ($_REQUEST['submit'] == "Update")
{
if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
$filepath = __DIR__.'/uploads/'.$_REQUEST[filename];
unlink($filepath);
$ext = substr($_FILES['photo']['name'], strpos($_FILES['photo']['name'],'.'), strlen($_FILES['photo']['name'])-1);
$filename = $_FILES['photo']['name'];
upload_photo($ext, $filename);
}
else {$filename= $_REQUEST['filename'];}

	$sql = "UPDATE artists SET name = '$_REQUEST[name]', shortBio = '$_REQUEST[shortBio]', fullBio = '$_REQUEST[fullBio]', filename='$filename' WHERE id = '$_REQUEST[id]'";
	//echo "<p>Query: " . $sql . "</p>\n<p><strong>";
	if ($dbh->exec($sql))
		echo "Updated $_REQUEST[name]";
	else
		echo "Not updated";

	$sq = "DELETE FROM Genre WHERE id = '$_REQUEST[id]'";
	$dbh->exec($sq);
	foreach ($_POST['category'] as $val){
          $sq="SELECT id FROM artists WHERE name='$_REQUEST[name]'";
          $result=($dbh->query($sq));
          $id=$result->fetch();

  	$sql="INSERT INTO Genre (id,category) VALUES($id[id],'$val')";
  	 }
    	$dbh->exec($sql);
}

else {
	echo "This page did not come from a valid form submission.<br />\n";
    }
}
}
    
// Basic select and display all contents from table 
$sql = "SELECT id,name,shortBio,filename FROM artists";
$result = $dbh->query($sql);

while ($row=$result->fetch()){
    echo"<a href='artistpage.php?id=$row[id]'><div id='artist'>";
    if($row['filename']){
    echo "<img id='smallimage' src=\"uploads/$row[filename]\">";
    }
    echo "<div><h1>".$row['name']."</h1>";
    echo "<p>".$row['shortBio']."</p><br></div></div></a>";
    
}
    


// close the database connection 
$dbh = null;
?>

<p><a href="artist.php">Return to database test page</a></p>

</body>
</html>