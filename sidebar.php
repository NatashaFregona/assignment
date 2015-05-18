<?php session_start();
$username=$_SESSION['user'];?>
<div id="sidebar"> <!-- Sidebar with logo and menu -->
			
			<h1>Members Section</h1>
			<div id="links">
				<p>Hello <?php echo $username?>!</p>
				<a href="account.php">Edit Account</a> | <a href="home.php?action=logout">Log Out</a>
			</div>        
			
			<ul id="main-nav">
            <li <?php if ($thisPage=="Home")echo "id=\"currentpage\"";?>>
					<a class='top' href="home.php">
						Home
					</a>       
			</li>
            
 <?php 
 switch ($userlevel){
	 case "ADMIN": ?>
     <li <?php if ($thisPage=="Users")echo "id=\"currentpage\"";?>>
     <a class='top' href="users.php?userlevel=<?php echo $level?>">
		Users
	</a> 
    <ul>
		<li><a href="notices.php?action=newNotice&userlevel=<?php echo $level?>">Manage Users</a></li>
	</ul>
    </li>
     <?php
	 case "PAID USER": ?>
	 <li <?php if ($thisPage=="Artists")echo "id=\"currentpage\"";?>>
					<a class='top' href="artists.php?userlevel=<?php echo $userlevel?>">
						Artists
					</a> 
                    <ul>
						<li><a href="artists.php?userlevel=<?php echo $level?>">New Artist</a></li>
						<li><a class="current" href="#">Manage Artists</a></li>
                        <li><a href="#">Feature Artist</a></li>
					</ul>
				</li>
                
                <li <?php if ($thisPage=="Events")echo "id=\"currentpage\"";?>>
					<a class='top' href="events.php?userlevel=<?php echo $level?>">
						Events
					</a> 
                    <ul>
						<li><a href="notices.php?action=newNotice&userlevel=<?php echo $level?>">New Event</a></li>
						<li><a class="current" href="#">Manage Events</a></li>
					</ul>
				</li>
                
    <?php 
	default: ?>
    <li <?php if ($thisPage=="Notices")echo "id=\"currentpage\"";?>> 
					<a  class='top' href="notices.php?userlevel=<?php echo $userlevel?>">
					Notices
					</a>
					<ul>
						<li><a href="notices.php?action=newnotice&userlevel=<?php echo $userlevel?>">New Notice</a></li>
						<li><a class="current" href="#">Manage Notices</a></li>
					</ul>
	</li>
    
<?php break;

}?>           
            </ul>
            </div>
