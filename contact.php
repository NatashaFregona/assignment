<?php

if($_POST['submit']){
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$message = $_POST['message'];
$myemail = 'karinaa.94@hotmail.com';
$subject = "New Message";

mail($myemail, $subject, $message, "From: ".$name);
$submitMessage = "Thank-you your message has been sent!";
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" />
<link href="css/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/fonts.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Patrick+Hand' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Handlee' rel='stylesheet' type='text/css'>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="styles.css" rel="stylesheet" type="text/css">
<link href="contact_from.css" rel="stylesheet" type="text/css">

<title>Contact Us</title>
<meta name="" content="">
</head>
<body>

    <div id="header" class="header">
        <div id="logobar">
    <img id="logo" src="TCMC98Neg.gif">
<h1>Townsville Community <br> Music Centre</h1>
</div>
    <div id="navbar">
<ul id="topnavbar">
<li id="menu-item" class="selected"><i class="fa fa-music"></i><a href="index.html">Home</a></li>
<li id="menu-item"><i class="fa fa-music"></i><a href="about.html">About</a></li>
<li id="menu-item"><i class="fa fa-music"></i><a href="tcmcartists.php">Artists</a></li>
<li id="menu-item"><i class="fa fa-music"></i><a href="tcmcnotices.php">Notices</a></li>
<li id="menu-item"><i class="fa fa-music"></i><a href="admin.php">Members</a></li>

</ul>
    </div>
    </div>
    
       <div id="content">
    <div id="content_home">
    <div id="content_main">
    <div class="wrapper wrap1">
	<i class="fa fa-envelope-o"></i>
	
        <h1>Contact Us</h1>
        </div>
        <h5>We'd love to hear from you. Just send us a message with the form below and we will reply as soon as we can to any questions or queries you may have.</h5>

<div id="contactus">
<form action="contact.php" method="post" name="contact_form">

	<?php if(!empty($submitMessage)) { ?>
    <div class="notification success">
    <div> <?php echo $submitMessage; ?> </div> 
    </div>
    <?php } ?>

	<p><strong>Name:</strong><span class="required">*</span> 
	<br><input name="name" placeholder="your name" type="text" required/>
	</p>

	<p><strong>E-mail:<span class="required">*</span>
	<br><input name="email" placeholder="example@domain.com" type="text" required/>
	</strong></p>

	<p><strong>Phone Number: 
	</strong><br><input name="number" type="text"/>
	</p>

	<p><strong>Your Message: <span class="required">*</span></strong> <br><textarea name="message" placeholder="place your message here" rows="10" required></textarea></p>

	<p>
    
	<input type="submit" name="submit" id="subimt" value="Submit" style="width:130px;">
	</p>
</form>
</div>
</div>
<div id="content_sidebar">

<div id=contact>
<h1>Get In Touch</h1>
<div class="wrapper"><i class="fa fa-phone"></i><p>07 4742 2086</p></div>
    <div class="wrapper"><i class="fa fa-mobile"></i><p>0402 255 182</p></div>
<div class="wrapper"><i class="fa fa-envelope"></i><a href="mailto:admin@townsvillemusic.org.au">admin@townsvillemusic.org.au</a></div>
<div class="wrapper"><i class="fa fa-home"></i><p>Townsville Civic Theatre<br>
41 Boundary Street<br>
Townsville, QLD 4810</p></div>
    <div class="wrapper"><i class="fa fa-envelope-o"></i><p>PO Box 1006<br>Townsville, QLD 4810</p>
</div>
</div>

</div>
</div>

</body>
</html>