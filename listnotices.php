
      <h1>All Notices</h1>  
<p><a href="notices.php?action=newnotice&userlevel=<?php echo $userlevel?>">Add a New Notice</a></p>

<div class='content-box'>
    <div class="content-box-header">
        <h3>Current Notices</h3>

    </div>
    <div class="content-box-content">
					
					<div style="display: block;" class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->
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

						<table>
							
							<thead>
								<tr>
								   <th><input class="check-all" type="checkbox"></th>
								   <th>Title</th> 
                                    <th>Last Edited</th> 
                                    <th>Date Expired</th> 
                                    <th>Author</th> 
                                    <th>Edit</th> 
                                    <th>Delete</th>
								</tr>
								
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
<?php foreach ( $results['notices'] as $notice ) { ?>

        <tr>
            <td><input type="checkbox" name="checkbox[]" form="deleteselected" value='<?php echo $notice[id]?>'></td>
            <td><?php echo $notice['title']?></td>
            <td><?php $dmy = DateTime::createFromFormat('d-m-Y', $notice['date_edited'])->format('d-m-Y'); echo $dmy;?></td>
          <td><?php 
    if(isset($notice['date_expired'])){$dmy = DateTime::createFromFormat('d-m-Y', $notice['date_expired'])->format('d-m-Y'); echo $dmy;}
              else echo "";?></td>
          <td>
            <?php echo $notice['author']?>
          </td>
        <td><input type='submit' name='submit' value='Update' onclick="location='notices.php?action=editnotice&amp;noticeId=<?php echo $notice['id']?>&userlevel=<?php echo $userlevel?>'" /></td>
            <form action="notices.php?action=deletenotice&amp;noticeId=<?php echo $notice[id]?>" method="POST">
                <?php echo "<input type='hidden' name='id' value='$notice[id]'/>";?>
<td><input type='submit' name='submit' value='Delete' onclick="return confirm('Delete This notice?')"></td>
            </form>
        </tr>

<?php } ?>

							</tbody>
							
						</table>
						
					</div> <!-- End #tab1 -->      
					
				</div>

					
				
      <table>
<tr>
                 
            </tr>



      </table>
</div>


