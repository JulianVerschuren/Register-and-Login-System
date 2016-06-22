<?php
#here we are simply checking if the user is logged in and printing out the user name with the help of the user's email which is in the session with the help of the sql query.

#first we require init.php to establish the connection with the database.
require 'init.php';

#secondly we start the session again.




session_start();

#so in other words. 
#we select the row name from the table called users where email in the database is equal to the variable email, the result will then be either true or false, a boolean. if everything is right and it matches the database giving a boolean of 1  we'll execute a while loop which fetches the associative array from the database and places it in the variable row
#then we create a variable called $name and place the value of name in the database in it. then its just a matter of echoíng it out. if everything is false and the boolean returns 0 because of no match in the database a string will be echod that says please log in


if(isset($_SESSION['email'])){
$name;
$email=isset($_SESSION['email']) ? $_SESSION['email'] : '';
$sql = "SELECT `name` FROM `users` WHERE `email` = '$email';";  
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $name = $row['name'];
    }
    
}
echo "welcome $name";
}else{
    
    echo "please log in.";
}

?>