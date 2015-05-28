<?php include ('dbconnect.php');


/*    
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$bool=true;
    
$sq="SELECT * FROM current_users";
$result=($dbh->query($sq));


    while ($row=$result->fetch()){
        $user=$row['username'];
        if($username==$user)
        {
            $bool=false;
            Print'<script>alert("Username has been taken!");</script>';
            //Print'<script>window.location.assign("register.php");</script>';
        } 
    }

		if($bool){
			$sq=("INSERT INTO current_users (username, password, first name, last name, date of birth, phone, address, city/town, state, postcode) VALUES ('$username','$password', '$firstname', '$lastname','$date_of_birth',$phone','$address','$city','$state','$postcode')");
            $dbh->exec($sq);
    		Print'<script>alert("You have successfully registered!");</script>';
            Print'<script>window.location.assign("register.php");</script>';

 */   
    
//echo 'cat';



 
 /*   if ($_SERVER["REQUEST_METHOD"]=="POST"){
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$bool=true;

$sq="SELECT * FROM current_users";
$result=($dbh->query($sq));


    while ($row=$result->fetch()){
        $user=$row['username'];
        if($username==$user)
        {
            $bool=false;
            Print'<script>alert("Username has been taken!");</script>';
            //Print'<script>window.location.assign("register.php");</script>';
        } 
    }

		if($bool){
			$sq=
    		$dbh->exec("INSERT INTO current_users (username, password, first name, last name, date of birth, phone, address, city/town, state, postcode) VALUES ('$username','$password', '$firstname', '$lastname', 		'$date_of_birth',$phone','$address','$city','$state','$postcode')");
    		Print'<script>alert("You have successfully registered!");</script>';
            Print'<script>window.location.assign("register.php");</script>';
}
}
*/
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

<title>Register</title>
<meta name="" content="">
</head>
<body>

    <?php include("header.php"); ?>
    
       <div id="content">
    <div id="content_home">

        <h1>Membership Application</h1>
        <div id="divider"></div>
        
        <div id="register_info">
            You can support the Townsville Community Music Centre by becoming either a registered user or a paid member and derive some benefits for yourself at the same time.<br>
<u><strong>Registered Users</strong></u> - no registration fee! can submit and edit notices.
<br><u><strong>Paid Members</strong></u> - membership subscription is only $25.00 per year; members can submit and edit notices aswell as with artists.<br>

       
        </div>
        
    <form method="POST" action="register.php" >
   
        <fieldset id='register'>
    	<legend>Main Details</legend>
    <p>
    	
        <label for="firstname">First Name: <span class='required'>*</span></label>
        <input type="text" name="firstname" required="required"/>
    </p>
        
            <p>
        <label for="lastname">Last Name: <span class='required'>*</span></label>
        <input type="text" name="lastname" required="required"/>
    </p>
    
    		<p>
         <label for="date_of_birth">Date Of Birth: </label>
         <input type="text" name="date_of_birth"/>
         </p>
        
            <p>
        <label for="phone">Phone: <span class='required'>*</span></label>
        <input type="text" name="phone" required="required"/>
    </p>
        <p>
        <label for="address">Postal Address: </label>
        <input type="text" name="address" required="required"/>
            </p>
        <p>
        <label for="city">City/Town: </label>
        <input type="text" name="city" required="required"/>
            </p>
        <p>
        <label for="state">State: </label>
        <input type="text" name="state" required="required"/>
            </p>
        <p>
        <label for="postcode">Postcode: </label>
        <input type="text" name="postcode" required="required"/>
        </p>
            
        <br>
        <br>    
        <input type="checkbox" name="newsletter" value="yes">I wish to receive news and special offers from Townsville Community Music Centre<br>
            
    </fieldset>
  
        
    <fieldset id='register'>
        <legend>Log In Details</legend>
    <p>
        <label for="username">Enter Email: <span class='required'>*</span></label>
        <input type="text" name="username" required="required">
    </p>
    <p>
        <label for="password">Enter Password: <span class='required'>*</span></label>
        <input type="password" name="password" required="required"/>
    </p>
    <p>
        <label for="password">Confirm Password: <span class='required'>*</span></label>
        <input type="password" name="password" required="required"/>
    </p>
    </fieldset>
    
    <fieldset id='register'>
        <legend>Payment Details</legend>
        
        <p>Payment can either be made via cheque, direct deposit or by paying online with PayPal, Visa or Mastercard. <br>
        
        <br><strong>Cheques can be made payable to:</strong><br>
        Townsville Community Music Centre Inc <br>and mailed to PO Box 1006, Townsville  QLD  4810<br>

<br><strong>Our Direct Deposit info is:</strong><br>
<u>Account Name</u> - Townsville Community Music Centre Inc.<br>
<u>Account Number</u> - 141 475 053 <br>
<u>BSB Number</u> - 633 000    <u>Bank</u> - Bendigo Bank<br>

 

<br>If you wish to pay online via PayPal, Visa or Mastercard please click on the "Pay Now" button below.
<br>
            

            <!--
<form method="post" action="https://www.paypal.com/cgi-bin/webscr">

    <input type="hidden" value="_s-xclick" name="cmd"></input>
    <input type="hidden" value="GCRJ28AFLXURQ" name="hosted_button_id"></input>
    <input type="image" alt="PayPal � The safer, easier way to pay online." name="submit" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynow_LG.gif"></input>
    <img width="1" height="1" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" alt=""></img>

</form>
-->

<!--
<form method="post" action="https://www.paypal.com/cgi-bin/webscr">

    <input type="hidden" value="_s-xclick" name="cmd"></input>
    <input type="hidden" value="67K2M93WVJM2L" name="hosted_button_id"></input>
    <input type="image" alt="PayPal � The safer, easier way to pay online." name="submit" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donate_LG.gif"></input>
    <img width="1" height="1" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" alt=""></img>

</form>
-->

 </p>
   
    
    
    <input type="submit" value="Register" style="width:130px;height:40px;"/>
    
    </form>
</fieldset>


<div id="paypal_img">
<img style="float: right" width="130px" height="80px" src="LogoPaypal.jpg" >

    

<form method="post" action="https://www.paypal.com/cgi-bin/webscr">

    <input type="hidden" value="_s-xclick" name="cmd"></input>
    <input type="hidden" value="GCRJ28AFLXURQ" name="hosted_button_id"></input>
    <input type="image" alt="PayPal � The safer, easier way to pay online." name="submit" src="https://www.paypalobjects.com/en_AU/i/btn/btn_paynow_LG.gif"></input>
    <img width="1" height="1" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" alt=""></img>

</form>
    
</div>
    
    <a href='admin.php'>Already a Member? Return to Log In Page</a>
  <br>
  <br>
  <br>
  
  <?php
//echo 'rat';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_REQUEST['username'];
    $password=$_REQUEST['password'];
    $firstname=$_REQUEST['firstname'];
    $lastname=$_REQUEST['lastname'];
    $date_of_birth=$_REQUEST['date_of_birth'];
    $phone=$_REQUEST['phone'];
    $address=$_REQUEST['address'];
    $city=$_REQUEST['city'];
    $state=$_REQUEST['state'];
    $postcode=$_REQUEST['postcode'];
    
    $sql="INSERT INTO current_users (username, password, firstname, lastname, date_of_birth, phone, address, city, state, postcode) VALUES ('$username','$password', '$firstname', '$lastname','$date_of_birth','$phone','$address','$city','$state','$postcode')";
    $dbh->exec($sql);
    echo($sql);

    
/*
    $username=$_REQUEST['username'];
$password=$_REQUEST['password'];
    echo ($username);
    echo ($password);
    $bool=true;
    
$sq="SELECT * FROM current_users";
$result=($dbh->query($sq));


    while ($row=$result->fetch()){
        $user=$row['username'];
        if($username==$user) {
            
            $bool=false;
            Print'<script>alert("Username has been taken!");</script>';
            //Print'<script>window.location.assign("register.php");</script>';
        } 
    }

		if($bool){
            $sql="INSERT INTO current_users (username, password, firstname, lastname, date_of_birth, phone, address, city, state, postcode) VALUES ('$_REQUEST[$username]','$_REQUEST[$password]', '$_REQUEST[$firstname]', '$_REQUEST[$lastname]','$_REQUEST[$date_of_birth]','$_REQUEST[$phone]','$_REQUEST[$address]','$_REQUEST[$city]','$_REQUEST[$state]','$_REQUEST[$postcode]')";
            $dbh->exec($sql);
            echo($sql);
    		//Print'<script>alert("You have successfully registered!");</script>';
            //Print'<script>window.location.assign("register.php");</script>';
//$firstname =$_POST['firstname'];
    //echo ($firstname);
   
        //}
}*/
}
?>
</body>
</html>
