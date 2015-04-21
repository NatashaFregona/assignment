<?php include("dbconnect.php");
$debugOn = true;
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Artists Records</title>
</head>

<body>
<h1>Results</h1>
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

//echo "<h2>Form Data</h2>";
//echo "<pre>";
//print_r($_REQUEST); // a useful debugging function to see everything in an array, best inside a <pre> element
//echo "</pre>";

// execute the appropriate query based on which submit button (insert, delete or update) was clicked
if (isset($_POST))
{
	$errorMessage="";
    if(empty($_POST['name']))
    {
        $errorMessage.="<li>Please enter the artists name</li>";
    }
    else{
            //check if artist already in database
    $result = $dbh->query("SELECT name from artists where shortBio = '$_REQUEST[shortBio]'");
    $rows = $result->fetchall(PDO::FETCH_ASSOC);
	foreach ($rows as $row){
    if ($row[name]==$_REQUEST[name] AND $_REQUEST['submit']=="Add Entry"){
            $errorMessage.="<li>Artist already exists, please edit details below</li>";
        }
     }
    }

    if(!empty($errorMessage))
    {
        echo("<p>There was an error with your form:
        <ul>" . $errorMessage . "</ul>\n</p>");
		include "artists.php";
	 }
else{
if ($_REQUEST['submit'] == "Add Entry")
{
$ext = substr($_FILES['photo']['name'], strpos($_FILES['photo']['name'],'.'), strlen($_FILES['photo']['name'])-1);
$filename = $_FILES['photo']['name'];
upload_photo($ext, $filename);

    
	$sql = "INSERT INTO artists (name, shortBio, fullBio,filename) VALUES ('$_REQUEST[name]', '$_REQUEST[shortBio]', '$_REQUEST[fullBio]', '$filename')";
	//echo "<p>Query: " . $sql . "</p>\n";
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
		//echo "<p>Query: " . $sq . "</p>\n";
	if ($dbh->exec($sq)){
		echo "<p><strong>Inserted $_REQUEST[name]"."\n</strong></p>";
		}
	else{
		echo "<p>Not inserted\n</p>"; // in case it didn't work - e.g. if database is not writeable	
	}
	}
}


else if ($_REQUEST['submit'] == "Delete Entry")
{
    if(unlink(__DIR__.'/uploads/'.$_REQUEST[filename]))
        echo "image deleted";

    
	$sql = "DELETE FROM artists WHERE id = '$_REQUEST[id]'";
	echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
	if ($dbh->exec($sql) AND $dbh->exec($sq))
		echo "Deleted $_REQUEST[name]";
	else
        echo "Not deleted";
    
}

else if ($_REQUEST['submit'] == "Update Entry")
{
$filepath = __DIR__.'/uploads/'.$_REQUEST[filename];
unlink($filepath);

    $ext = substr($_FILES['photo']['name'], strpos($_FILES['photo']['name'],'.'), strlen($_FILES['photo']['name'])-1);
    $filename = $_FILES['photo']['name'];
    upload_photo($ext, $filename);


	$sql = "UPDATE artists SET name = '$_REQUEST[name]', shortBio = '$_REQUEST[shortBio]', fullBio = '$_REQUEST[fullBio]', filename='$filename' WHERE id = '$_REQUEST[id]'";
	//echo "<p>Query: " . $sql . "</p>\n<p><strong>";
	if ($dbh->exec($sql))
		echo "Updated $_REQUEST[name]";
	else
		echo "Not updated";

	$sq = "DELETE FROM Genre WHERE id = '$_REQUEST[id]'";
	if ($dbh->exec($sq)){
	//echo "<p>Query: " . $sq . "</p>\n<p><strong>";
	}
	foreach ($_POST['category'] as $val){
          $sq="SELECT id FROM artists WHERE name='$_REQUEST[name]'";
          $result=($dbh->query($sq));
          $id=$result->fetch();

  	$sql="INSERT INTO Genre (id,category) VALUES($id[id],'$val')";
  	echo "<p>Query: " . $sql . "</p>\n<p><strong>";}

    	if ($dbh->exec($sql))
    		echo "Updated $_REQUEST[name]";
    	else
    		echo "Not updated";

}

else {
	echo "This page did not come from a valid form submission.<br />\n";
}

// Basic select and display all contents from table 
echo "<h2>Artists</h2>\n";
$sql = "SELECT name,shortBio FROM artists";
$result = $dbh->query($sql);

if ($debugOn) {
	echo "<pre>";
	$rows = $result->fetchall(PDO::FETCH_ASSOC);
    echo "$rows[name]=".$rows[name];
    echo "$rows[1][name]".$rows[1][name];
	echo count($rows) . " records in table<br />\n";
	print_r($rows);
    $img="uploads/".$filename;
    echo '<img src="'.$img.'">';
	echo "</pre>";
//	echo "<br />\n";
}
}
}

// close the database connection 
$dbh = null;
?>

<p><a href="artists.php">Return to database test page</a></p>

</body>
</html>