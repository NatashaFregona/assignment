<body id='home'>
    <div id='loginbox'>
    <h1>Members Area Log In</h1>
    <p>Welcome to the Townsville Community Music Centre Members Area.</p>
    <p>Please log in with your username and password. <a href="register.php">Register Here </a> if you do not have an account.</p>
    <form id="login" action="admin.php?action=login" method="POST">
    

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>

    <p>
        <label for="username">Username: </label>
        <input type="text" name="username" required="required" value="<?=$_POST['username'];?>">
    </p>
    <p>
        <label for="password">Password: </label>
        <input type="password" name="password" required="required"/>
    </p>
    <input type="submit" name="login" value="login"/>
        
    
    </form>
    </div>





    
</body>
</html>