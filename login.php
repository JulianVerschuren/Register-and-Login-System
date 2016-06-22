<?php 
#We'll be requirng init.php again to make connection with the database.
#we'll also start_session() because we'll be using sessions.

require 'init.php';
session_start();

#the next if statement checks if the user is not already logedi n ie the session is not set 
if (!isset($_SESSION['email'])) {
    
    #setting the vars again
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
    #protecting the vars with htmlspecialchars again to prevent xss attacks.
$email = htmlspecialchars($email);
$password = htmlspecialchars($password);

    
    #we will se this boolean to true if an error is found in login data from the user
$error=false;
    
#under this comment we will create our first if statement, this if statement will check if the submit button is pressed.
    
    if(isset($_POST['submit'])){
        
        
        
#the second if statement checks if all the details are filled in and nothing is empty
        
    if(!empty($email) && !empty($password)){
        
    #the next sql statement selects the email from users where the user entered the email and the password matches
        
    $sql = "SELECT `email` FROM `users` WHERE `email` = '$email' AND 'password' = '$password';";  
        
        #mysqli_num_rows will return 1 in boolean if user entered data correct if not true the error is set to true
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0){
        $error = false;
        
        
    }else
        $error = true;
        
    }
        
        #if the error exists the following if statement will echo the error
        
    if($error){
        echo "error in email or/and password";
        
    }
        #if there is no error echo logged in and change location to welcome.php
        
     if(!$error){
         $_session['email']=$email;
         echo "logged in!";
         header("location: welcome.php");
     }
             #else fill in all the details
        else{
            
            echo "fill in all the details.";
            
        }
         
         
     }   
        
        
        
  }
        
?>

<b><?php if(isset($_SESSION['email'])){echo 'you are already logged in.';} else{echo'log in'; ?></b>
<br
<br

<form action="login.php" method="post">
Email adress:
<br>
<input type="text" name="email" maxlength="128">
<br>
<br>
    
Password:
<br>
<input type="password" name="password" maxlength="128">
<br>
<br>
    
<input type="submit" name="submit" value="Submit">








</form>
<?php }?>
    
    
    
    


