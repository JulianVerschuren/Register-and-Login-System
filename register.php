<?php 
#this file will save the user data into the mysql database.

#I need to require the file "init.php" in to this file first. init.php has the database connection. by requiring that file we make the connecting with the database for this file as well, since require sends code in to this file. making seperate files for different functions or blocks of code is not necessary BUT, No one in the world would like to read through 2000 lines of code just to search for that one single error you made. by having seperate locations. it makes it much easier to detect mistakes in written code.

require 'init.php';



#We don't want to show our user the registration form once they're logged in, so to check if the user is logged in we need to include ''session_start()"
session_start();



#under this comment we will check if the session is NOT set, which means that the user is not logged in and can register. 



?>