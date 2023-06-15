<?php

  define('HOST','localhost');

  define('USER','nmukwaya');

  define('PASS','Nmu734y@');

  define('DB','wdr');

  $con = mysqli_connect(HOST,USER,PASS,DB);

   if (!$con){

                 die("Error in connection" . mysqli_connect_error()) ;

  }

?>