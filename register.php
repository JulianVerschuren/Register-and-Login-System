<?php 
#this file will save the user data into the mysql database.

#I need to require the file "init.php" in to this file first. init.php has the database connection. by requiring that file we make the connecting with the database for this file as well, since require sends code in to this file. making seperate files for different functions or blocks of code is not necessary BUT, No one in the world would like to read through 2000 lines of code just to search for that one single error you made. by having seperate locations. it makes it much easier to detect mistakes in written code.

require 'init.php';



#We don't want to show our user the registration form once they're logged in, so to check if the user is logged in we need to include ''session_start()"
session_start();



#under this comment ill create a function called findDuplicates to make sure there are no duplicate accounts possible in the database. 
//either returns true or false. if a the result is higher than 0 which makes 1 in boolean it will return true. otherwise it will return false.
function findDuplicates($str, $what){//returns true if duplicate/s is found  
global $conn;  
$sql = "SELECT `$what` FROM `users` WHERE `$what` = '$str';";  
$result = mysqli_query($conn, $sql);  
if(mysqli_num_rows($result)>0){  
return true;  
}else{  
return false;  
}  

   
    
    
    
    
}






#under this comment we will check if the session is NOT set, which means that the user is not logged in and can register.  the exclamation mark: '!' turns isset into the opposite. 

#also we will be getting the user submitted data in the form of a POST request and storing it in the respectable variables. we'll set the vars to empty strings if the var is not set, the input is left blank by the user

if(!isset($_SESSION['email'])){
    
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $passwordAgain = isset($_POST['passwordAgain']) ? $_POST['passwordAgain'] : '';
    
    
    #htmlspecialchars Convert special characters to HTML entities which will help in preventing xss attacks - cross site scripting attacks.
    #XSS enables attackers to inject client-side scripts into webpages viewed by other users. a cross-site scirpting vulnerability may be used by attackers to bypass acces controls such as the same-origin-policy. the effect may range from a petty nuisance to a significant security risk.
    
    $username = htmlspecialchars($username);
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);
    $passwordAgain = htmlspecialchars($passwordAgain);
    
    
    $error_username=false;
    $error_email=false;
    $error_password=false;
    
    #under this comment we will set bools to true if the error exists 
    
    
    #the first if statement will check if the submit button is pressed
    
    if(isset($_POST['submit'])){
    
        
    #in the second if statement ill check if all the variables are set ie the user has filled in all the information
    
    if (!empty($username) && !empty($name) && !empty($email) && !empty($password)&& !empty($passwordAgain)){
        
        
        
           #in the third if statement ill check if password equals passwordAgain if that is the case then error_password is set to false. if it is not the case the boolean will be set to true and an error will occur. this error message will be printed out, ill create it later.
        
        
        if($password==$passwordAgain){
            
            $error_password=false;
            
            
            }else{
            $error_password = true;
            
            }
        
        
            #the forth and fifth if block checks if the username and email do not already exist, if the username and/or email aldready exist, then the error_username and/or error_email are set to true.
        
        #so if find duplicates $email is not equal to email in the database so to say it will make the error false. and no error will occur.
         if(!findDuplicates($email, 'email')){
            
            $error_email=false;
            
            
        } else{
            $error_email=true;
        }
        
        if(!findDuplicates($username, 'username')){
            
            $error_username=false;
            
            
        } else{
            $error_username=true;
        }
        
        #the default value of error_username,password and email were set to false somewhere above. if the blocks of code above this comment change the value from false to true then in the next blocks of code underneath this comment it will print a string giving an eror message
        
        
        if($error_username){
            
            echo"error in username";
            
        }
        
        
        if($error_email){
            
            echo"error in mail";
            
        }
        
        
        if($error_password){
            
            echo"error in password";
            
        }
        
        #underneath this comment we'll check if error username, mail and password are false. which means everything has been filled in and no errors will occur, if this is the case, we will insert our variables values from the form in to our database. and connect with it. if everything goes in order it will echo succes.
        
if(!$error_username && !$error_email && !$error_password){ 
$sql = "INSERT INTO `users` (`username`, `name`, `email`, `password`) VALUES ('$username', '$name', '$email', '$password');"; 
mysqli_query($conn, $sql); 
echo "Success."; 
} 

}else{ 
			echo "Fill in all the details."; 
		} 

     
        
        
        
    
        
        
        }
        
        
        
    
    
    

    
    



#in the next php script we'll create a register form that will be hidden if the user is already logged in
?>


    <? php if (!isset($_SESSION['email'])){?>

        <b>Register</b>
        <br>
        <br>

        <form action="register.php" method="post">
            Username:
            <br>
            <input type="text" name="username" maxlength="128">
            <br>
            <br> Name:
            <br>
            <input type="text" name="name" maxlength="128">
            <br>
            <br> Email adress:
            <br>
            <input type="text" name="email" maxlength="128">
            <br>
            <br> Password:
            <br>
            <input type="text" name="password" maxlength="128">
            <br>
            <br> Pasword again:
            <br>
            <input type="text" name="passwordAgain" maxlength="128">
            <br>
            <br>

            <input type="submit" name="submit" value="Submit">


        </form>

        <?php }else{echo "you are already logged in.";}?>