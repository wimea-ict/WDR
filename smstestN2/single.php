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
                  
				  $users = file_get_contents('user.json');
                    $user = json_decode($users, true);   
	             
				 

  
  
      $station= $user['station'];  

	  
	 
  //echo $date; // echo $time;  echo $station; 
  //echo $time;
    $select ="SELECT * FROM observationslip WHERE  TIME= '$Time' AND station = '$station' AND Date ='$Date' ";
	//AND station =$station AND Date =$date ";
 
 
                    $result = mysqli_query($conn, $select);
                  
				  if($result){
                   if(mysqli_num_rows($result) > 0){ 

                    while($row = mysqli_fetch_assoc($result)){ 

                           $Id = $row['id'];
                   
                             }
							 
							  // echo $Id;
							   
						$aid =array("id" => "$Id");	   
							   
				  $ID = file_get_contents('work.json');
                  $id2 = json_decode($ID, true);
	
	              $id2 = $aid;
	
		          file_put_contents('id.json', json_encode($id2));
	   
                  array_push($iddArray, $Id);
							  		   
							   
							   
				   }
				   
				   
				   else{    //echo "noo...";
				   }
				   }
 
                        
                
			   
			   
			   
			   
	

   mysqli_close($conn);	
//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''


//''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''				



						

?> 