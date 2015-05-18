<?php include ("dbconnect.php");
include ("header.php");
$thisPage="Artists";
$userlevel = $_GET['userlevel'];?>
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
<div id='admin'>
    <?php include("sidebar.php");?>
    <div id='main-content'>
    <?php session_start();
$action = $_GET['action'];
$username = $_SESSION['user'];
switch ( $action ) {
    case 'newartist':
        newartist($dbh,$userlevel);
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
        displayPage($dbh,$userlevel);
} ?>
    
  </body>

</html>

    

 
<?php function displayPage($dbh,$userlevel){ 
$results =array();
$sql = "SELECT * FROM artists";
$rows=($dbh->query($sql));
  $results['artists'] = $rows;
  $results['pageTitle'] = "Current Artists";
  
   if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "noticeDeleted" ) $results['statusMessage'] = "Notice has been Deleted.";
  }
  include("artistsPage.php" );
}
  
  function newartist(){
	  echo 'hello';
  }
    
    ?>


    
        


