

<?php
#initialising basic database connection on a localhost.

#mysql db constants DB_HOST, DB_USER, DB_PASS, DB_NAME

const DB_HOST = 'localhost';
const DB_USER = 'root'; //julian
const DB_PASS = ''; // 11111
const DB_NAME = 'wall'; //20936_wall




$conn = new mysqli (DB_HOST, DB_USER, DB_PASS, DB_NAME);
#check connection

if ($conn->connect_errno){

echo "<p>MySQL error no {$conn->connect_errno} : {$conn->connect_error}</p>";
exit();

}



