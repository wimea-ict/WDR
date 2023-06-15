<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {

        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");

        header('Access-Control-Allow-Credentials: true');

        header('Access-Control-Max-Age: 86400');    // cache for 1 day

    }

    // Access-Control headers are received during OPTIONS requests

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))

            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");        

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))

            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);

    }

  require "dbconnect.php";

    $data = file_get_contents("php://input");

    if (isset($data)) {

        $request = json_decode($data);

        $username = $request->username;

        $password = $request->password;

                }

      $username= mysqli_real_escape_string($con,$username);

      $password = mysqli_real_escape_string($con,$password);

       $username = stripslashes($username);

      $password = md5(stripslashes($password));

    $sql = "SELECT * FROM systemusers JOIN stations ON systemusers.station = stations.station_id WHERE systemusers.UserName = '".$username."' AND systemusers.UserPassword = '".$password."' " ;

      $result = mysqli_query($con,$sql);

      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $active = $row['Userid'];

      $count = mysqli_num_rows($result);

     //echo $count;

      // If result matched myusername and mypassword, table row must be 1 row                    

      if($count >0) {
      
   $response = array('userid' => $row['Userid'],'username' => $row['UserName'],'success'=> "Logged in Successfully",
                     'station' => $row['StationName'],'firstname' => $row['FirstName'],'surname' => $row['SurName'],'userrole' => $row['UserRole'],
					 'latitude' => $row['Latitude'],'longitude' => $row['Longitude'],'active' => $row['Active'],'stationstatus' => $row['StationStatus'],'stationnumber' => $row['StationNumber'],
					 'station_id'=>$row['station_id']);
	

      }else {

    $response= "Your Login Email or Password is invalid";         

      }

 echo json_encode($response);

?>