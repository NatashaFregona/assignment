<?php $thisPage = isset( $_GET['action'] ) ? $_GET['action'] : "events"; ?>
<doctype !html>
<html>
<head>
<meta charset="UTF-8">
<link href="styles.css" rel="stylesheet" type="text/css">
<title>events</title>
</head>
    <body>
<?php
include("header.php");
$userlevel = $_GET['userlevel']; ?>
    <div id='admin'>
        <?php
include("dbconnect.php");
include("sidebar.php");?>

<div id='main-content'>
<?php session_start();
$action = $_GET['action'];
$username = $_SESSION['user'];
switch ( $action ) {
    case 'newevent':
        newevent($dbh,$userlevel);
        break;
    case 'deleteevent':
        deleteevent($dbh,$userlevel);
        break;
    case 'deleteselected':
        deleteselected($dbh,$userlevel);
        break;

    case 'editevent':
        editevent($dbh,$userlevel);
        break;
    default:
        listevents($dbh,$userlevel);
}

function newevent($dbh,$userlevel) {
    $thisPage='New event';
  $results = array();
  $results['pageTitle'] = "New event";
  $results['formAction'] = "newevent";

  if ( isset( $_POST['saveChanges'] ) ) {
      // User has posted the event edit form: save the new event
      if (empty($_POST['date_expired'])){
    insertevent($dbh);
     header( "Location: events.php?status=changesSaved&userlevel=$userlevel" );
      }
    else{
    $date=DateTime::createFromFormat('Y-m-j', $_POST['date_expired']);

    if ($date==true){
    $dmy=$date->format('Y-m-j');
        
if($dmy == $_POST['date_expired']) {
	insertevent($dbh);
     header( "Location: events.php?status=changesSaved&userlevel=$userlevel" );
}
      
    else{
          $results['errorMessage'] = "The date you have entered is not valid";
     include("editevent.php");
      }
}
      else{
          $results['errorMessage'] = "The date you have entered is not valid";
     include("editevent.php");
      } 
  }
  }

    else if ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the event list
    header( "Location: events.php" );
  } else {
    // User has not posted the event edit form yet: display the form
    include("editevent.php" );
  }
}
    
function editevent($dbh,$userlevel) {
  $results = array();
  $results['pageTitle'] = "Edit event";
  $results['formAction'] = "editevent";

  if ( isset( $_POST['saveChanges'] ) ) {
      // User has posted the event edit form: save the event changes
      updateevent( $dbh );
 header( "Location: events.php?status=changesSaved&userlevel=$userlevel" );

  } elseif ( isset( $_POST['cancel'] ) ) {

    // User has cancelled their edits: return to the event list
    header( "Location: events.php?userlevel=$userlevel" );
  } else {
    // User has not posted the event edit form yet: display the form
    $sql = "SELECT * FROM events WHERE id=$_GET[eventId]";
    $rows=$dbh->query($sql);
    $results['event'] = $rows->fetch();
    include( "editevent.php" );
  }

}

function deleteevent($dbh, $userlevel) {
    // Delete the event
    $sql = "DELETE FROM events WHERE id=$_POST[id]";
    $dbh->exec($sql);
  header( "Location: events.php?status=eventDeleted&userlevel=$userlevel" );
}

function deleteselected($dbh, $userlevel){
    $checkbox = $_POST['checkbox'];
  foreach ($_POST['checkbox'] as $id => $val) {
      $sql="DELETE FROM events WHERE id=$val";
      $dbh->exec($sql);
      header( "Location: events.php?status=eventDeleted&userlevel=$userlevel" );
  }
}

function listevents($dbh,$userlevel) {
  $results = array();
    $date = date('Y-m-d');
    $sql= "UPDATE events SET expired=1 WHERE date_expired < $date";
    $dbh->exec($sql);
    
    $sql = "SELECT * FROM events WHERE expired !=1 ORDER BY CASE WHEN date_expired is NULL THEN 1 ELSE 0 END, 
  date_expired ASC";
$rows=($dbh->query($sql));
  $results['events'] = $rows;
  $results['pageTitle'] = "All events";

  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "eventDeleted" ) $results['statusMessage'] = "event has been Deleted.";
  }
  include("listevents.php" );
}

function updateevent($dbh){
    $date = date('Y-m-d');
    if($_POST[date_expired]){ $date_expired= $_POST[date_expired];} else $date_expired=null;
	$sql = "UPDATE events SET title = \"$_POST[title]\" , details = \"$_POST[details]\", date_edited = '$date', date_expired= ".(($_POST[date_expired]=='')?"NULL":("'".$_POST[date_expired]."'")) .", author = '$_POST[author]', weblink=\"$_POST[weblink]\", social_media=\"$_POST[social_media]\", contact_email=\"$_POST[contact_email]\", artist_name=\"$_POST[artist_name]\" WHERE id = $_POST[eventId]";
$dbh->query($sql);
 }

function insertevent($dbh){
    $date = date('Y-m-d');
    $sql = "INSERT INTO events (title, details, date_edited, date_expired, author, weblink, social_media, contact_email, artist_name) VALUES (\"$_POST[title]\", \"$_POST[details]\", '$date',".(($_POST[date_expired]=='')?"NULL":("'".$_POST[date_expired]."'")) . ",'$_POST[author]', '$_POST[weblink]', '$_POST[social_media]', '$_POST[contact_email]','$_POST[artist_name]')";
	$dbh->exec($sql);
}  
?>
        </div>
        </div>
        <?php include("footer.php"); ?>
