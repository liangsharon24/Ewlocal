<?php

  $server="mysql4.000webhost.com";
  $user="a9672506_Ew";
  $pass="abcd1234";
  $db="a9672506_Ew";

  $con=mysqli_connect("mysql4.000webhost.com","a9672506_Ew","abcd1234","a9672506_Ew");


  // connect to mysql

  mysqli_connect($server, $user, $pass) or die("Sorry, can't connect to the mysql.");

  // select the db

  mysqli_select_db($con,$db) or die("Sorry, can't select the database.");

?>
