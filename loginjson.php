<!DOCTYPE html>
<html>
    <head>
        <title>Login Form</title>
    </head>
    <body>
        <?php

            $username = $psw ="";
            $usernameErr = $pswErr ="";

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                if(empty($_POST['username'])) {                    
                    $usernameerr = "Please Fill up the Username!";
                }

                else if(empty($_POST['pass'])) {                    
                    $passworderr = "Please Fill up the password!";
                }

                else {
                    $username = $_POST['username'];
                    $psw  = $_POST['psw'];

                    $log_file = fopen("login.txt", "r");
                    
                    $data = fread($log_file, filesize("login.txt"));
                    
                    fclose($log_file);
                    
                    $data_filter = explode("\n", $data);
                    
                    for($i = 0; $i< count($data_filter)-1; $i++) {

                        $json_decode = json_decode($data_filter[$i], true);
                        if($json_decode['username'] == $username && $json_decode['password'] == $psw) 
                        {
                            session_start();
                            $_SESSION['user'] = $username;
                            header("Location: Details.php");
                        }
                    }
                    echo "Wrong Password! Please Try Again.";
                }
            }
        ?>
        
        <h1>Login Form</h1>
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">

            <fieldset>
                <legend><b>Login</b></legend>
            
                <label for="username">Username:</label>
                <input type="text" name="uname" id="username">
                <?php echo $usernameErr; ?>

                <br>
                 <br>
                <label for="Password">Password:</label>
                <input type="password" name="pass" id="password">
                <?php echo $pswErr; ?>
                
                </fieldset>

            <input type="submit" value="Login"> 
        </form>
        
    </body>
</html> 