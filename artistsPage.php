<link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>

<h1>All Artists</h1>
  <label class="collapse" for="newArtist">Add a New Artist</label>
  <input id="newArtist" type="checkbox">

<div class="form-style">
<h1>Enter New Artist's Details</h1>
  
            <?php if(!empty($errorMessage)) { ?>
        <div class="notification error">
            <div><?php echo $errorMessage; ?></div>
          </div>
<?php } ?>
<form>
    <div class="section"><span>1</span>Artist Details</div>
    <div class="inner-wrap">
        <input type="text" placeholder="Name" name="name" value="<?=$_POST['name'];?>"/>
                <label for="genre">Genres:(select all that apply):</label>
        <select id="genre" name="field4" size="4" multiple>
<?php 
        $genres=['Country', 'Rock', 'Pop', 'Blues', 'Jazz', 'RnB', 'Rap','Indy','Reggae'];
        foreach($genres as $genre){
            echo "<option value=$genre>$genre</option>";
            }?>
</select> 
    </div>

    <div class="section"><span>2</span>Artist Biography</div>
    <div class="inner-wrap">
                <textarea name="shortBio" placeholder="Short Biography" rows="3"><?=$_POST['shortBio'];?></textarea>
                <textarea name="fullBio" placeholder="Full Biography" rows="6"><?=$_POST['fullBio'];?></textarea>
    </div>

    <div class="section"><span>3</span>Artist Image</div>
        <div class="inner-wrap">
<label for="photo">Photo: </label>
                <input type="file" name="photo" id="photo" value="<?=$_POST['photo'];?>" accept="image/gif, image/jpeg, image/png">
        
    </div>
    <div class="button-section">
     <input type="submit" name="Sign Up" value="Add Artist" />
    </div>
</form>
</div>
  
  
  
<div class='content-box'>
<div class="content-box-header">
 <h3>Current Artists</h3>
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
<input type='submit' class='adminButton' value='Delete Selected' onclick='return confirm("Are you sure want to delete these rows?")'>
</td>
</form>
								</tr>
							</tfoot>
                            <tbody>
                                                    <?php foreach ($dbh->query($sql) as $row) { ?>
                        <tr>
                            <td><?php echo $row['name']?></td>
            <td><?php echo $row[shortBio]?></td>
          <td><div id='tableImage'><?php if($row[filename]==""){echo 'no image uploaded';} else {echo "<img class='thumbnail' src=\"uploads/$row[filename]\">";} echo "<br><input type='file' name='photo' />" ?></div></td>
                            <input type='hidden' name='filename' value='$row[filename]' />

              <td><input type="submit" name="submit" value="Update" /></td>
              <td><input type="submit" name="submit" value="Delete" class="deleteButton"></td>    

        </tr>

<?php } ?>	
                            
                            
                            </tbody>
                            </table>          
                 
                </div>






</div>
<?php
}
?>

    </div>
