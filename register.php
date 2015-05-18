<?php include ("dbconnect.php")

?>
<doctype !html>
<html>
<head>
<meta charset="UTF-8">
<link href="styles.css" rel="stylesheet" type="text/css">
<title>Register</title>
</head>
    
<body>
    
    <h1>Membership Application</h1>
    <form action="register.php" method="POST">
    <fieldset id='register'>
        <legend>Log In Details</legend>
    <p>
        <label for="username">Enter Username: <span class='required'>*</span></label>
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
    <p>
        <label for="firstname">First Name: <span class='required'>*</span></label>
        <input type="text" name="firstname" required="required"/>
    </p>
        
            <p>
        <label for="lastname">Last Name: <span class='required'>*</span></label>
        <input type="text" name="lastname" required="required"/>
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
    </fieldset>
    <input type="submit" value="Register"/>
    
    </form>
    <a href='home.php'>Return to Log In Page</a>
</body>
</html>
    
<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$bool=true;

$sq="SELECT * FROM users";
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

if($bool)
{
    $dbh->exec("INSERT INTO users (username, password) VALUES ('$username','$password')");
    Print'<script>alert("You have successfully registered!");</script>';
            Print'<script>window.location.assign("register.php");</script>';
}
}
    ?>