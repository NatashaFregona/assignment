<?php include("dbconnect.php"); 
include("header.php");?>

<!doctype html>
<html>
<head>
    <title>User Section</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
    <body>
<?php
session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['user'] ) ? $_SESSION['user'] : "";
if ($_SESSION['userlevel']==1) $userlevel="REGISTERED USER";
else if ($_SESSION['userlevel']==2) $userlevel="PAID USER";
else $userlevel="ADMIN";
if (!$username) $action="login";

echo "<div id='admin'>";
switch ( $action ) {
  case 'login':
    login($dbh);
    break;
  case 'logout':
    logout();
    break;
  default:
    displayhome($username,$userlevel);
	break;
}

function login($dbh) {
  if ( isset( $_POST['login'] ) ) {
    $username = $_POST['username'];
    $pword = $_POST['password'];
 $query = "SELECT * FROM users WHERE username='$username'";
$result=$dbh->query($query);

    $password = "";
   if($row = $result->fetch())
      {
       $password=$row['password'];
          if($pword == $password)
          {
             $_SESSION['user'] = $username;
             $_SESSION['userlevel']=$userlevel;
 
             header("location:admin.php");
          }
    else
       {
        echo '<script>alert("Incorrect Password!");</script>';
        Print '<script> window.location.assign("admin.php"); </script>';
       }
   }
    else
    {
        Print '<script>alert("Incorrect username!");</script>'; // Prompts the user
        Print '<script>window.location.assign("admin.php");</script>'; // redirects to login.php
       
    }

    } 
 else {

    // User has not posted the login form yet: display the form
    require("login.php");
  }

}
function logout(){
//session_start();  
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['userlevel']);
    header("location:admin.php");

    }
        
function displayhome($username,$userlevel){ 
 $thisPage='Home';
$level=$userlevel;
include("sidebar.php"); ?>
<div id='main-content'>
    <h1>Welcome <?php echo $username?>!</h1>
    <div id='userHome'>
    <a href="admin.php?action=logout">Logout</a><br><br>
    <?php
    switch($level){ 
    case "ADMIN": 
    echo"<a href='users.php?userlevel=$level'><div class='adminButton users'>
    <h1>Edit Users</h1>
    <p>Remove Users, Manage Access Levels</p></div>
    </a>";
    case "PAID_USER":
    echo "<a href='events.php?userlevel=$level'><div class='adminButton events'>
    <h1>Edit Events</h1>
    <p>Create New Event, Edit Events</p></div>
    </a>
    <a href='artists.php?userlevel=$level'><div class='adminButton artists'>
    <h1>Edit Artists</h1>
    <p>New Artist, Manage & Feature Artist</p></div>
    </a>";
    default:
    echo"<a href='notices.php?userlevel=$level'><div class='adminButton notices'>
    <h1>Edit Notices</h1>
    <p>Add, Delete, & Edit Notices</p></div>
    </a>
    <a href='account.php?userlevel=$level'><div class='adminButton account'>
    <h1>Edit Account</h1>
    <p>Upgrade Access Level, Edit Details</p></div>
    </a>";
    break;
    } 
    ?>

    </div>
    </div>
    <?php } ?>
    
    </div>
    </body>
</html>


