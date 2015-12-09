<?php

  $server="localhost";
  $user="Ew";
  $pass="0000";
  $db="Ew";

  $con=mysqli_connect("localhost","Ew","0000","Ew");


  // connect to mysql

  mysqli_connect($server, $user, $pass) or die("Sorry, can't connect to the mysql.");

  // select the db

  mysqli_select_db($con,$db) or die("Sorry, can't select the database.");

?>
