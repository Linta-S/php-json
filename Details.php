<!DOCTYPE html>
<html>
    <head>
        <title>Registration Form</title>
    </head>
    <body>

    
    <?php
 
        session_start();
        $var = $_SESSION['user'];
        unset($_SESSION['user']); 



        $log_file = fopen("Registration.txt", "r");
        
        $data = fread($log_file, filesize("Registration.txt"));

        $data_filter = explode("\n", $data);
        
        for($i = 0; $i< count($data_filter)-1; $i++) {
            
            $json_decode = json_decode($data_filter[$i], true);
            

            if($json_decode['username'] == $var) 
            {
                $fnameErr = $json_decode['fname'];
                $lnameErr = $json_decode['lname'];
                $genderErr = $json_decode['gender'];
                $emailErr = $json_decode['email'];
            }

        }
        fclose($log_file);

?>

        <?php
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                    header('Location: file-read.php');
                }
        ?>
        

        <fieldset>
    <legend>Basic information</legend>
  FirstName: <input type="text" name="fname">
  <span class="error">* <?php echo $fnameErr;?></span>
  <br><br>
  LastName: <input type="text"  name="lname">
  <span class="error">* <?php echo $lnameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>

</fieldset>


 

        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
            <input type="submit" value="Logout">
        </form>
        
    </body>
</html>


