<?php $thisPage=$results['pageTitle']; ?>
<div class="form-style">
<h1><?php echo $results['pageTitle']?></h1>
  
            <?php if(!empty($errorMessage)) { ?>
        <div class="notification error">
            <div><?php echo $errorMessage; ?></div>
          </div>
<?php } ?>

<form action="events.php?userlevel=<?php echo $userlevel?>&action=<?php echo $results['formAction']?>" method="post">

    <div class="inner-wrap">
                <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Name of the event" required autofocus maxlength="255" value="<?php echo ($results['event']['title'])?:$_POST['title']?>" />

<label for="details">Event Details</label>
            <textarea name="details" id="details" placeholder="full description of the event" required maxlength="10000" rows="10"><?php echo ($results['event']['details'])?:$_POST['details']?></textarea>
            
            <label for="artist_name">Artist</label>
            <input type = "text" name"artist_name" id="artist_name" placeholder="artist name" value="<?php echo ($results['event']['artist'])?:$_POST['artist']?>"/> 
            
            <label for="weblink">Web/Link</label>
            <input type="text" name="weblink" id="weblink" placeholder="website link" value="<?php echo ($results['event']['weblink'])?:$_POST['weblink']?>" />
            
            <label for="social_media">Social Media Link</label>
            <input type="text" name="social_media" id="social_media" placeholder="social media link" value="<?php echo ($results['event']['social_media'])?:$_POST['social_media']?>"/> 
            
            <label for="contact_email">Email</label>
            <input type="text" name="contact_email" id="contact_email" placeholder="contact email example@domain.com" value="<?php echo ($results['event']['contact_email'])?:$_POST['contact _email']?>"/>

            <label for="content">Author</label>
            <input type="text" name="author" placeholder="Author" required maxlength="300" value="<?php echo ($results['event']['author'])?:$_POST['author'];?>"/>
            
            <label for="date_expired">Date Expired</label>
            <input type="text" name="date_expired" id="date_expired" placeholder="YYYY-MM-DD" maxlength="10" value="<?php if(isset($results['event']['date_expired'])){$dmy = DateTime::createFromFormat('Y-m-d', $results['event']['date_expired'])->format('Y-m-d'); echo $dmy;}?>" />
            <input type="hidden" name="eventId" value="<?php echo $results['event']['id'] ?>"/>
           <div class="button-section">
                     <input id='smallButton' type="submit" name="saveChanges" value="Save Changes" /></div></form>
                     
                     
          <input id='smallButton' type="submit" onclick="window.location='admin.php' "name="cancel" value="Cancel" />
    </div>

</div>


      
        
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="notification error">
            <div><?php echo $results['errorMessage'] ?></div>
          </div>
<?php } ?>
          





<?php if ( $results['event']['id'] ) { ?>
      <p><a href="events.php?action=deleteevent&eventId=<?php echo $results['event']['id'] ?>" onclick="return confirm('Delete This event?')">Delete This event</a></p>
<?php } ?>

