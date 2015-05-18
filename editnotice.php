<div class="form-style">
<h1><?php echo $results['pageTitle']?></h1>
  
            <?php if(!empty($errorMessage)) { ?>
        <div class="notification error">
            <div><?php echo $errorMessage; ?></div>
          </div>
<?php } ?>

<form action="notices.php?userlevel=<?php echo $userlevel?>&action=<?php echo $results['formAction']?>" method="post">

    <div class="inner-wrap">
                <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Name of the Notice" required autofocus maxlength="255" value="<?php echo ($results['notice']['title'])?:$_POST['title']?>" />
<label for="details">Notice Details</label>
            <textarea name="details" id="details" placeholder="full description of the notice" required maxlength="10000" style="height: 30em;"><?php echo ($results['notice']['details'])?:$_POST['details']?></textarea>

            <label for="content">Author</label>
            <input type="text" name="author" placeholder="Author" required maxlength="300" value="<?php echo ($results['notice']['author'])?:$_POST['author'];?>"/>
            <label for="date_expires">Date Expired</label>
            <input type="text" name="date_expired" id="date_expired" placeholder="DD-MM-YYYY" maxlength="10" value="<?php if(isset($results['notice']['date_expired'])){$dmy = DateTime::createFromFormat('d-m-Y', $results['notice']['date_expired'])->format('d-m-Y'); echo $dmy;}?>" />
            <input type="hidden" name="noticeId" value="<?php echo $results['notice']['id'] ?>"/>
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
          





<?php if ( $results['notice']['id'] ) { ?>
      <p><a href="notices.php?action=deletenotice&noticeId=<?php echo $results['notice']['id'] ?>" onclick="return confirm('Delete This notice?')">Delete This notice</a></p>
<?php } ?>

