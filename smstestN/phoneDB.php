 <?php
  //error_reporting(0); 
 // Takes raw data from the request
 

 // Converts it into a PHP object

     $servername = "localhost";
  $username = "nmukwaya";
  $password = "Nmu734y@";
  $dbname = "wdr";
  
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    echo"connection failed";
     }
    
	

      $fname="";
 
     
    $Mselect ="SELECT * FROM systemusers where UserRole ='ManagerData'";


     $manresult = mysqli_query($conn, $Mselect);

                   if(mysqli_num_rows($manresult) > 0){ 

                    while($row = mysqli_fetch_assoc($manresult)){ 

                    
                          $memail = $row['UserEmail'];
                           
                          

                 
                             }
				   }
    





     
   
 
    $select ="SELECT * FROM  systemusers where UserPhone =$userPhone AND (UserRole='Senior Weather Observer' OR UserRole='Observer')";
 
 
 
 
                    $result = mysqli_query($conn, $select);

                   if(mysqli_num_rows($result) > 0){ 

                    while($row = mysqli_fetch_assoc($result)){ 

                    $userid  = $row['Userid'];	 $station  = $row['station'];
					
					$fname  = $row['FirstName'];  $sname  = $row['SurName'];
					
					$phon = $row['UserPhone'];
                                        
                                        $email = $row['UserEmail'];
                                         
                                        $region = $row['region_zone'];


                 
                             }
				   }


// staton

     $select_station ="SELECT * FROM  stations where station_id ='$station'";  

     $Sresult = mysqli_query($conn, $select_station);

                   if(mysqli_num_rows($Sresult) > 0){ 

                    while($row = mysqli_fetch_assoc($Sresult)){ 

                    
                          $StationName = $row['StationName'];
                           
                          $StationRegion = $row['StationRegion'];
 
                          $StationNumber = $row['StationNumber'];
                                          
                          $subregion = $row['subregion'];


                          //echo $subregion;

                 
                             }
				   }


                        

				   
                  
                             
                 if (mysqli_query($conn, $select)) {
          // echo " selected";
		   
		   //echo $sname; echo $phon; 
		    // echo $userid;   echo $station;   echo $fname;  
		   
            } 
			else {
            //echo "did no select " . mysqli_error($conn);
			
               }
			   
			   if($fname!=""){ 
			   
			   
			   array_push($phoneArray, $phon);
			   
			   
			   $name =$fname." ".$sname;
			   
 $user = array('station'=>$station, 'userid'=>$userid, 'name'=>$name, 'StationName'=>$StationName, 'StationRegion'=>$StationRegion,
'phone'=>"$phon", "email"=>$email, 'region'=>$region,'memail'=>$memail,'StationName'=>$StationName,'StationNumber'=>$StationNumber,
 'subregion'=>$subregion);

			   
			   
			  
	   $dataj = file_get_contents('work.json');
       $json_arr = json_decode($dataj, true);

        $json_arr = $user;
		
		
		//echo $total;
		//echo $sum;
        
		 file_put_contents('user.json', json_encode($json_arr));
	   
			   
			   
			   
			   
			   
			   
			   
			   }
			  
   

/*
 $create =      "CREATE TABLE `systemusers` (
  `Userid` bigint(255) NOT NULL,
  `station` int(11) NOT NULL DEFAULT '1',
  `region_zone` varchar(30) DEFAULT NULL COMMENT 'region or zone of the the user in charge of',
  `FirstName` varchar(100) NOT NULL,
  `SurName` varchar(100) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  `UserRole` varchar(50) NOT NULL,
  `UserEmail` varchar(50) NOT NULL,
  `UserPhone` varchar(50) NOT NULL,
  `Active` bit(1) NOT NULL,
  `LoggedOn` bit(1) DEFAULT NULL,
  `Reset` bit(1) NOT NULL,
  `LastPasswdChange` datetime NOT NULL,
  `LastLoggedIn` datetime NOT NULL,
  `CreatedBy` varchar(100) NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_mail` enum('True','False') DEFAULT 'True',
  `note_id` varchar(100) DEFAULT NULL
)"; 

*/

/*
 $insert  =   "INSERT INTO `systemusers` (`Userid`, `station`, `region_zone`, `FirstName`, `SurName`, `UserName`, `UserPassword`, `UserRole`, `UserEmail`, `UserPhone`, `Active`, `LoggedOn`, `Reset`, `LastPasswdChange`, `LastLoggedIn`, `CreatedBy`, `CreationDate`, `send_mail`, `note_id`) VALUES
(1, 0, NULL, 'Admin', 'manager', 'manager', 'e10adc3949ba59abbe56e057f20f883e', 'ManagerData', 'mukwayanicholas.mn@gmail.com', '0783604580', b'1', NULL, b'0', '2018-09-13 00:00:00', '2018-09-14 00:00:00', 'manager', '2018-09-14 00:00:00', 'True', NULL),
(59, 0, '', 'Godfrey', 'Ntabazi', 'g.ntabazi', 'd1b6f409f535c9ea7eeb1cfd1fa0aa57', 'ManagerStationNetworks', 'ngdfrey@gmail.com', '0785294190', b'1', NULL, b'0', '2020-02-14 08:41:25', '2020-02-14 08:41:25', 'ManagerData', '2020-02-14 09:34:04', 'True', '200214083404AM01'),
(60, 0, '', 'Michael', 'Lubega', 'm.lubega', 'f1110e297bdffd3d1a2ac0b4e8205cde', 'ManagerData', 'lubmick16@gmail.com', '0772594891', b'1', NULL, b'0', '2020-02-14 08:42:43', '2020-02-14 08:42:43', 'ManagerData', '2020-02-14 09:35:19', 'True', '200214083519AM01'),
(62, 4, 'Central ', 'Godfrey', 'Ntabazi', 'a.ntabazi', 'd1b6f409f535c9ea7eeb1cfd1fa0aa57', 'Observer', 'ngdfrey@gmail.com', '0785294190', b'1', NULL, b'0', '2020-02-14 09:05:29', '2020-02-14 09:05:29', 'Manager', '2020-02-14 09:51:47', 'True', '200214085147AM461'),
(63, 4, 'Central ', 'Agnes', 'Nalukwago', 'a.nalukwago', '1c6cf6ed0473f36bcbb736dfefe4722d', 'OC', 'nakagie12@gmail.com', '0781157149', b'1', NULL, b'0', '2020-02-14 08:54:51', '2020-02-14 08:54:51', 'ManagerData', '2020-02-14 09:53:30', 'True', '200214085330AM41'),
(64, 4, 'Central ', 'Edgar', 'Wamala', 'a.lubega', '97342cca557f359789f9003fc556c9b2', 'Observer', 'lubmick16@gmail.com', '0758787786', b'1', NULL, b'1', '2020-02-14 08:54:12', '2020-02-14 08:54:12', 'ManagerData', '2020-02-14 09:54:12', 'True', '200214085412AM460')
     ";      
			
	

 if (mysqli_query($conn, $insert)) {
     echo "inserted successfully";
  } else {
  echo "Error creating table: " . mysqli_error($conn);
  }


*/


   mysqli_close($conn);	
//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''


//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''				



						

?> 