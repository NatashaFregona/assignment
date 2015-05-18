<?php $thisPage='Notices';
include("header.php");
$userlevel = $_GET['userlevel']; ?>
<doctype !html>
<html>
<head>
<meta charset="UTF-8">
<link href="styles.css" rel="stylesheet" type="text/css">
<title>Notices</title>
</head>
    <body>
    <div id='admin'>
        <?php
include("dbconnect.php");
include("Notice.php");
include("sidebar.php");?>

<div id='main-content'>
<?php session_start();
$action = $_GET['action'];
$username = $_SESSION['user'];
switch ( $action ) {
    case 'newnotice':
        newnotice($dbh,$userlevel);
        break;
    case 'deletenotice':
        deletenotice($dbh);
        break;
    case 'deleteselected':
        deleteselected($dbh);
        break;

    case 'editnotice':
        editnotice($dbh,$userlevel);
        break;
    default:
        listnotices($dbh,$userlevel);
}

function newnotice($dbh,$userlevel) {
  $results = array();
  $results['pageTitle'] = "New Notice";
  $results['formAction'] = "newnotice";

  if ( isset( $_POST['saveChanges'] ) ) {

    // User has posted the notice edit form: save the new notice

    $date=DateTime::createFromFormat('j-n-Y', $_POST['date_expired']);
if ($date==true){
    $dmy=$date->format('j-n-Y');
      
if($dmy == $_POST['date_expired']) {
    insertnotice($dbh);
      header( "Location: notices.php?status=changesSaved&userlevel=$userlevel" );}
      
    else{
          $results['errorMessage'] = "The date you have entered is not valid";
     include("editnotice.php");
      }
}
      else{
          $results['errorMessage'] = "The date you have entered is not valid";
     include("editnotice.php");
      }
    
  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the notice list
    header( "Location: notices.php" );
  } else {
    // User has not posted the notice edit form yet: display the form
    
    include("editnotice.php" );
  }

}


function editnotice($dbh,$userlevel) {
  $results = array();
  $results['pageTitle'] = "Edit notice";
  $results['formAction'] = "editnotice";

  if ( isset( $_POST['saveChanges'] ) ) {
      // User has posted the notice edit form: save the notice changes
      updatenotice( $dbh );
 header( "Location: notices.php?status=changesSaved&userlevel=$userlevel" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the notice list
    header( "Location: notices.php?userlevel=$userlevel" );
  } else {
    // User has not posted the notice edit form yet: display the form
    $sql = "SELECT * FROM notices WHERE id=$_GET[noticeId]";
    $rows=$dbh->query($sql);
    $results['notice'] = $rows->fetch();
    include( "editnotice.php" );
  }

}

function deletenotice($dbh) {
    // Delete the notice
    $sql = "DELETE FROM notices WHERE id=$_POST[id]";
    $dbh->exec($sql);
  header( "Location: notices.php?status=noticeDeleted" );
}

function deleteselected($dbh){
    $checkbox = $_POST['checkbox'];
  foreach ($_POST['checkbox'] as $id => $val) {
      $sql="DELETE FROM notices WHERE id=$val";
      $dbh->exec($sql);
      header( "Location: notices.php?status=noticeDeleted" );
  }
}

function listnotices($dbh,$userlevel) {
  $results = array();
    $sql = "SELECT * FROM notices ORDER BY CASE WHEN date_expired is NULL THEN 1 ELSE 0 END, 
  date_expired ASC";
$rows=($dbh->query($sql));
  $results['notices'] = $rows;
  $results['pageTitle'] = "All notices";

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "noticeDeleted" ) $results['statusMessage'] = "Notice has been Deleted.";
  }
  include("listnotices.php" );
}

function updatenotice($dbh){
    $date = date('d-m-Y');
    if($_POST[date_expired]){ $date_expired= $_POST[date_expired];} else $date_expired=null;
	$sql = "UPDATE notices SET title = \"$_POST[title]\" , details = \"$_POST[details]\", date_edited = '$date', date_expired= '$date_expired', author = '$_POST[author]'WHERE id = $_POST[noticeId]";

$dbh->query($sql);
}

function insertnotice($dbh){
    $date = date('d-m-Y');
    $sql = "INSERT INTO notices (title, details, date_edited, date_expired, author) VALUES (\"$_POST[title]\", \"$_POST[details]\", '$date',".(($_POST[date_expired]=='')?"NULL":("'".$_POST[date_expired]."'")) . ",'$_POST[author]')";
    echo $sql;
	$dbh->exec($sql);
}  
?>
        </div>
        </div>
        <?php include("footer.php"); ?>
