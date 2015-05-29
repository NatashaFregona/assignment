
      <h1>All Events</h1>  
<p><a href="events.php?action=newevent&userlevel=<?php echo $userlevel?>">Add a New Event</a></p>

<div class='content-box'>
    <div class="content-box-header">
        <h3>Current events</h3>

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
                                    <form id='deleteselected' method='post' action='events.php?action=deleteselected'>
									<td colspan="7">
                                        <input type='submit' class='adminButton' value='Delete Selected' onclick='return confirm("Are you sure want to delete these rows?")'>
									</td>
                                        </form>
								</tr>
							</tfoot>
						 
							<tbody>
<?php foreach ( $results['events'] as $event ) { ?>

        <tr>
            <td><input type="checkbox" name="checkbox[]" form="deleteselected" value='<?php echo $event[id]?>'></td>
            <td><?php echo $event['title']?></td>
            <td><?php $dmy = DateTime::createFromFormat('Y-m-d', $event['date_edited'])->format('Y-m-d'); echo $dmy;?></td>
          <td><?php 
    if(isset($event['date_expired'])){$dmy = DateTime::createFromFormat('Y-m-d', $event['date_expired'])->format('Y-m-d'); echo $dmy;}
              else echo "";?></td>
          <td>
            <?php echo $event['author']?>
          </td>
        <td><input type='submit' name='submit' value='Update' onclick="location='events.php?action=editevent&amp;eventId=<?php echo $event['id']?>&userlevel=<?php echo $userlevel?>'" /></td>
            <form action="events.php?action=deleteevent&amp;eventId=<?php echo $event[id]?>" method="POST">
                <?php echo "<input type='hidden' name='id' value='$event[id]'/>";?>
<td><input type='submit' name='submit' value='Delete' onclick="return confirm('Delete This event?')"></td>
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


