<?php 
#this file will save the user data into the mysql database.

#I need to require the file "init.php" in to this file first. init.php has the database connection. by requiring that file we make the connecting with the database for this file as well, since require sends code in to this file. making seperate files for different functions or blocks of code is not necessary BUT, No one in the world would like to read through 2000 lines of code just to search for that one single error you made. by having seperate locations. it makes it much easier to detect mistakes in written code.

require 'init.php';



#We don't want to show our user the registration form once they're logged in, so to check if the user is logged in we need to include ''session_start()"
session_start();



#under this comment ill create a function called findDuplicates to make sure there are no duplicate accounts possible in the database. 
//either returns true or false. if a the result is higher than 0 which makes 1 in boolean it will return true. otherwise it will return false.
function findDuplicates($str, $what) {
    global $conn;
    $sql = "SELECT '$what' FROM 'users' WHERE  '$what' = '$str';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0){
        
        return true;
        
    }else{
        
        return false;
    }
   
    
    
    
    
}






#under this comment we will check if the session is NOT set, which means that the user is not logged in and can register. 



?>