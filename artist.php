<?php $thisPage='Artists';
$userlevel = $_GET['userlevel'];?>
<doctype !html>
<html>
<head>
<meta charset="UTF-8">
<link href="styles.css" rel="stylesheet" type="text/css">
<title>Artists</title>
</head>
    <body>
        <?php
include("dbconnect.php");
include("sidebar.php");
        ?>

<div id='main-content'>
<?php session_start();
$action = $_GET['action'];

switch ( $action ) {
    case 'newartist':
        artist($dbh,$userlevel);
        break;
    case 'deletenotice':
        deletenotice($dbh);
        break;
    case 'deleteselected':
        deleteselected($dbh);
        break;
      //$sql = "DELETE FROM artists WHERE id='$val'";
     // echo "<p>Query: " . $sql . "</p>\n<p><strong>"; 
  //if ($dbh->exec($sql))
    case 'editnotice':
        editnotice($dbh,$userlevel);
        break;
    default:
    echo 'boo';
        listartists($dbh,$userlevel);
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

function listartists($dbh,$userlevel) { ?>
    <fieldset>
    <h2>Current data:</h2>
        <div class='content-box'>
            <div class="content-box-header">
                <h3>Current Notices</h3>
            </div>
            <div class="content-box-content">
                <div style="display: block;" class="tab-content default-tab" id="tab1">
                    <?php if ( isset( $results['errorMessage'] ) ) { ?>
                    <div class="notification error">
                        <div><?php echo $results['errorMessage'] ?></div>
                    </div>
                    <?php } ?>
                    <?php if ( isset( $results['statusMessage'] ) ) { ?>
        						<div class="notification success">
							<div>
								<?php echo $results['statusMessage'] ?>
							</div>
						</div>
<?php } ?>
                </div> 
                
                
                 <?php $sql = "SELECT * FROM artists";
$rows=($dbh->query($sql));
$row=$rows->fetchAll();
if (count($row)==0) 
{echo "There are currently no artists in the database";
}
else { ?>
                <table>
                    <thead>
                        <th>Name</th> <th>shortBio</th> <th>Image</th> <th></th> <th></th>
                    </thead>
                <tfoot>
								<tr>
                                    <form id='deleteselected' method='post' action='notices.php?action=deleteselected'>
									<td colspan="7">
                                        <input type='submit' class='button' value='Delete Selected' onclick='return confirm("Are you sure want to delete these rows?")'>
                                    </td>
                                        </form>
								</tr>
							</tfoot>
                    <tbody>
                        <?php foreach ($dbh->query($sql) as $row) { ?>
                        <tr>
                            <td><input type="checkbox" name="checkbox[]" form="deleteselected" value='<?php echo $row[id]?>'></td>
                            <td><?php echo $row['name']?></td>
            <td><?php echo $row[shortBio]?></td>
          <td><?php if($row[filename]==""){echo 'no image uploaded';} else {echo "<img class='thumbnail' src=\"uploads/$row[filename]\">";} echo "<input type='file' name='photo' />" ?></td>
                            <input type='hidden' name='filename' value='$row[filename]' />

              <td><input type="submit" name="submit" value="Update" /></td>
              <td><input type="submit" name="submit" value="Delete" class="deleteButton"></td>    

        </tr>

<?php } ?>	
                </tbody>
                </table>
                <?php } ?>
            </div>
            </div>
    

      <?php } ?>
        </div>
    </body>
    </html>

