 <?php
  //error_reporting(0); 
 // Takes raw data from the request
  $dataf = json_decode(file_get_contents('php://input'), true);

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
//........................................................................


function insertNo($field, $value){
		
		
     $servername = "localhost";
  $username = "nmukwaya";
  $password = "Nmu734y@";
  $dbname = "wdr";
		
		
		 $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
      if (!$conn) {
      echo"connection failed";

     }
		
		
		$select ="SELECT id, station FROM observationslip ORDER BY id DESC LIMIT 1";
 
 
                    $result = mysqli_query($conn, $select);
					

                   if(mysqli_num_rows($result) > 0){ 

                    while($row = mysqli_fetch_assoc($result)){ 

                    $id  = $row['id'];	 $id2  = $row['station'];
                 
                             }
				   }
				   
        
				  // echo $id; echo $id2;
				  
				  $sql = "UPDATE observationslip SET $field= $value WHERE id=$id";

                   if (mysqli_query($conn, $sql)) {
                     return 2;
                       } 
					   else {
                                echo "Error updating record: " . mysqli_error($conn);
					   }
		
	
 }



//no
function insert($field, $value){
		
		
     $servername = "localhost";
  $username = "nmukwaya";
  $password = "Nmu734y@";
  $dbname = "wdr";
		
		
		 $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
      if (!$conn) {
      echo"connection failed";

     }
		
		
		$select ="SELECT id, station FROM observationslip ORDER BY id DESC LIMIT 1";
 
 
                    $result = mysqli_query($conn, $select);
					

                   if(mysqli_num_rows($result) > 0){ 

                    while($row = mysqli_fetch_assoc($result)){ 

                    $id  = $row['id'];	 $id2  = $row['station'];
                 
                             }
				   }
				   
        
				  // echo $id; echo $id2;
				  
				  $sql = "UPDATE observationslip SET $field= '$value' WHERE id=$id";

                   if (mysqli_query($conn, $sql)) {
                    return 2;
                       } 
					   else {
                                echo "Error updating record: " . mysqli_error($conn);
					   }
		
		
 }






//............................................................................................
  if($dataf){
    
                    require_once 'DB_Functions.php';
                    $db = new DB_Functions();

 
               
			   
			   
	           $users = file_get_contents('user.json');
                    $user = json_decode($users, true); 


           $reggion = $user[region];
           $emmail = $user[email]; 
          $phonne= $user[phone];
          $namme= $user[name];
          
          $StationName= $user[StationName];
         
          $StationRegion= $user[StationRegion];
          $StationNumber= $user[StationNumber];
          $subregion= $user[subregion];

       

           // echo $emmail;    
   


                    $dataU = file_get_contents('results.json');
                    $data = json_decode($dataU, true);                 
					
                   $sp2 = file_get_contents('sp.json');
                    $sp = json_decode($sp2, true);  					
 /*
  $sql = "INSERT INTO observationslip (Date, id, Userid, station, TIME, TotalAmountOfAllClouds, TotalAmountOfLowClouds,
 TypeOfLowClouds1,OktasOfLowClouds1, HeightOfLowClouds1, CLCODEOfLowClouds1, TypeOfLowClouds2, OktasOfLowClouds2,
 HeightOfLowClouds2, CLCODEOfLowClouds2, TypeOfLowClouds3, OktasOfLowClouds3, HeightOfLowClouds3, CLCODEOfLowClouds3,
 TypeOfMediumClouds1, OktasOfMediumClouds1, HeightOfMediumClouds1, CLCODEOfMediumClouds1, TypeOfMediumClouds2,
 OktasOfMediumClouds2, HeightOfMediumClouds2, CLCODEOfMediumClouds2, TypeOfMediumClouds3, OktasOfMediumClouds3,
 HeightOfMediumClouds3, CLCODEOfMediumClouds3, TypeOfHighClouds1, OktasOfHighClouds1, HeightOfHighClouds1,
 CLCODEOfHighClouds1, TypeOfHighClouds2, OktasOfHighClouds2, HeightOfHighClouds2, CLCODEOfHighClouds2, 
 TypeOfHighClouds3, OktasOfHighClouds3, HeightOfHighClouds3, CLCODEOfHighClouds3, CloudSearchLightReading, Rainfall, Dry_Bulb,
 Wet_Bulb, Max_Read, Max_Reset, Min_Read, Min_Reset, Piche_Read, Piche_Reset, TimeMarksThermo, TimeMarksHygro, TimeMarksRainRec,
 Present_Weather, Present_WeatherCode, Past_Weather, Past_WeatherCode, UnitOfWindSpeed, Visibility, Wind_Direction, 
 Wind_Speed, Gusting, AttdThermo, PrAsRead, Correction, CLP, MSLPr, TimeMarksBarograph, TimeMarksAnemograph, OtherTMarks,
 sunduration, trend, windrun, HeightOfLowestCloud, StandardIsobaricSurface,  DurationOfPeriodOfPrecipitation, GrassMinTemp,
 CI_OfPrecipitation, BE_OfPrecipitation, IndicatorOfTypeOfIntrumentation, SignOfPressureChange, Supp_Info, VapourPressure,
 T_H_Graph, DeviceType, recent_weather, runwayVisualRange, relative_humidity, ExpectedTime
   ) 

VALUES ('$date',  '$id', '$Userid', '$station', '$time', '$totalAmountClouds', '$totalAmountLow', '$lowCloudType1','$lowCloudOktas1',
'$low_cloudHeight1', '$low_cloudClcode1', '$lowCloudType2','$lowCloudOktas2','$low_cloudHeight2', '$low_cloudClcode2','$lowCloudType3',
  '$lowCloudOktas3', '$low_cloudHeight3', '$low_cloudClcode3', '$mediumCloudType1', '$mediumCloudOktas1', '$mediumCloudHeight1','$mediumCloudClcode1',
  '$mediumCloudType2', '$mediumCloudOktas2', '$mediumCloudHeight2','$mediumCloudClcode2', '$mediumCloudType3', '$mediumCloudOktas3',
  '$mediumCloudHeight3','$mediumCloudClcode3', '$highCloudType1', '$highCloudOktas1', '$highCloudHeight1', '$highCloudClcode1',
  '$highCloudType2', '$highCloudOktas2', '$highCloudHeight2', '$highCloudClcode2', '$highCloudType3', '$highCloudOktas3', '$highCloudHeight3', 
  '$highCloudClcode3', '$alidadeReading', '$rainfall', '$dryBulb', '$wetBulb', '$maxRead', '$maxReset', '$minRead', '$minReset', '$PICHERead',
  '$PICHERest','$thermo', '$hygro', '$rainrec', '$presentweather', '$presentWeatherCode', '$pastweather', '$pastWeatherCode', '$unitWindSpeed',
  '$visibility', '$winddirection', '$windspeed','$gusting', '$attdThermo','$asRead','$correction', '$clp', '$mslp','$barograph','$anemograph',
   '$otherMarks', '$sunDuration', '$trend', '$windRun', '$heightLowestCloud', '$isobaricSurface', '$periodPrecipitation', '$grassTemp',
  '$characterIntensit', '$beginEndPrecipitation', '$intrumentation', '$pressureChange','$supplementary', '$vapourPressure', '$graph', '$device',
   '$recentweather', '$visualrange', '$relativeHumidity', '$expectedTime' )";

		   
*/
 
   
    //echo $data['lowCloudType1'];
	 
    //'speciormetar' =>$speci 
	   if($sp){
      $speci ="speci";
	  echo $speci;
	   }

        else{  $speci ="normal"; }
		
     $name=$user['name'];
	 $station= $user['station'];  $Userid=$user['userid'];  $device =$data['device'];  $expectedTime=$data['expectedTime'];  
	 $time=$data['Time'];  $date=$data['Date'];  //$windspeed=$data['windspeed'];  $winddirection=$data['windDirection'];
	 $trend=$data['trend']; $recentweather=$data['recentweather'];  $lowCloudType1=$data['lowCloudType1'];  $lowCloudType2= $data['lowCloudType2'];
 
	//.............  
     $totalAmountClouds = $data['totalAmountClouds']; $totalAmountLow = $data['totalAmountLow']; $lowCloudOktas1 = $data['lowCloudOktas1'];
    $low_cloudHeight1 = $data['low_cloudHeight1']; $low_cloudClcode1 = $data['low_cloudClcode1']; $lowCloudOktas2 = $data['lowCloudOktas2'];
    $low_cloudHeight2=$data['low_cloudHeight2']; $low_cloudClcode2=$data['low_cloudClcode2']; $lowCloudType3=$data['lowCloudType3'];
	$lowCloudOktas3=$data['lowCloudOktas3']; $low_cloudHeight3=$data['low_cloudHeight3']; $low_cloudClcode3=$data['low_cloudClcode3'];
	$mediumCloudType1=$data['mediumCloudType1']; $mediumCloudType2=$data['mediumCloudType2']; $mediumCloudType3=$data['mediumCloudType3']; 
	$mediumCloudOktas1=$data['mediumCloudOktas1']; $mediumCloudOktas2=$data['mediumCloudOktas2']; $mediumCloudOktas3=$data['mediumCloudOktas3'];
  $mediumCloudHeight1=$data['mediumCloudHeight1']; $mediumCloudHeight2=$data['mediumCloudHeight2']; $mediumCloudHeight3=$data['mediumCloudHeight3'];
  $mediumCloudClcode1=$data['mediumCloudClcode1']; $mediumCloudClcode2=$data['mediumCloudClcode2']; $mediumCloudClcode3=$data['mediumCloudClcode3']; 
	$highCloudType1=$data['highCloudType1']; $highCloudType2=$data['highCloudType2']; $highCloudType3=$data['highCloudType3'];
	$highCloudOktas1=$data['highCloudOktas1']; $highCloudOktas2=$data['highCloudOktas2']; $highCloudOktas3=$data['highCloudOktas3'];
  $highCloudHeight1=$data['highCloudHeight1'];  $highCloudHeight2=$data['highCloudHeight2'];  $highCloudHeight3=$data['highCloudHeight3'];
	$highCloudClcode1=$data['highCloudClcode1']; $highCloudClcode2=$data['highCloudClcode2']; $highCloudClcode3=$data['highCloudClcode3']; 
	$alidadeReading=$data['alidadeReading']; $rainfall=$data['rainfall']; $dryBulb=$data['dryBulb'];  $wetBulb=$data['wetBulb']; 
   $maxRead=$data['maxRead']; $maxReset=$data['maxReset']; $minRead=$data['minRead']; $minReset=$data['minReset']; $PICHERead=$data['PICHERead'];
   $PICHERest=$data['PICHERest']; $thermo=$data['thermo']; $hygro=$data['hygro']; $rainrec=$data['rainrec']; $presentweather=$data['presentweather']; 
   $presentWeatherCode=$data['presentWeatherCode']; $pastweather=$data['pastweather']; $pastWeatherCode=$data['pastWeatherCode'];
   $unitWindSpeed=$data['unitWindSpeed']; $visibility=$data['visibility']; $winddirection=$data['winddirection']; $windspeed=$data['windspeed']; 
   $gusting=$data['gusting']; $attdThermo=$data['attdThermo']; $asRead=$data['asRead']; $correction=$data['correction']; $clp=$data['clp'];
   $mslp=$data['mslp']; $barograph=$data['barograph']; $anemograph=$data['anemograph']; $otherMarks=$data['otherMarks'];
  $sunDuration=$data['sunDuration']; $windRun=$data['windRun']; $heightLowestCloud=$data['heightLowestCloud']; $isobaricSurface=$data['isobaricSurface']; 
   $periodPrecipitation=$data['periodPrecipitation']; $grassTemp=$data['grassTemp']; $characterIntensit=$data['characterIntensit']; 
   $beginEndPrecipitation=$data['beginEndPrecipitation'];  $intrumentation=$data['intrumentation']; $pressureChange=$data['pressureChange'];
  $supplementary=$data['supplementary']; $vapourPressure=$data['vapourPressure']; $graph=$data['graph'];  $visualrange=$data['visualrange'];
   $relativeHumidity=$data['relativeHumidity'];
   
   
 //...  



   $Name ="Name:"; $number = "phone Number:"; $stationNam="Station Name:"; $stationNo="Station Number:";  $Region="Region:"; $sub ="Subregion:"; $mDate ="Date:"; $mTime ="Time:";

     
        $emailDetails =nl2br("\n".$Name.$namme."\n".$number.$phonne."\n".$stationNam.$StationName."\n"
          .$stationNo.$StationNumber."\n".$Region.$StationRegion."\n".$sub.$subregion."\n".$mDate.$date."\n".$mTime.$time);
        
           
   
   $feedback =array();
// Insert into database

            $insertObservationSlipFormData= array( 'Date'=>$date,'station'=>$station,'Userid'=>$Userid,
            'TIME'=> $time,'DeviceType '=> $device,'ExpectedTime' => $expectedTime , 'O_SubmittedBy' => $name,'speciormetar' =>$speci, 'Approved'=>"FALSE");
			
          
            $fieldsarr=array_keys($insertObservationSlipFormData);
                $fields = implode(",",$fieldsarr);
                $values = "'".implode("','",$insertObservationSlipFormData)."'";

                $insertsuccess= $db->insertData($fields,$values);
				
				 if($insertsuccess){  
					//echo "record inserted";
				
					}
									
				  else{ echo "failed";}
				  
				  
			 // other codes...................................................................
			
			
			/*
			
			
			
			$sql = "INSERT INTO observationslip (Date, id, Userid, station, TIME, TotalAmountOfAllClouds, TotalAmountOfLowClouds,
 TypeOfLowClouds1,OktasOfLowClouds1, HeightOfLowClouds1, CLCODEOfLowClouds1, TypeOfLowClouds2, OktasOfLowClouds2,
 HeightOfLowClouds2, CLCODEOfLowClouds2, TypeOfLowClouds3, OktasOfLowClouds3, HeightOfLowClouds3, CLCODEOfLowClouds3,
 TypeOfMediumClouds1, OktasOfMediumClouds1, HeightOfMediumClouds1, CLCODEOfMediumClouds1, TypeOfMediumClouds2,
 OktasOfMediumClouds2, HeightOfMediumClouds2, CLCODEOfMediumClouds2, TypeOfMediumClouds3, OktasOfMediumClouds3,
  HeightOfMediumClouds3, CLCODEOfMediumClouds3, TypeOfHighClouds1, OktasOfHighClouds1, HeightOfHighClouds1,
 CLCODEOfHighClouds1, TypeOfHighClouds2, OktasOfHighClouds2, HeightOfHighClouds2, CLCODEOfHighClouds2, 
 TypeOfHighClouds3, OktasOfHighClouds3, HeightOfHighClouds3, CLCODEOfHighClouds3, CloudSearchLightReading, Rainfall, Dry_Bulb,
 Wet_Bulb, Max_Read, Max_Reset, Min_Read, Min_Reset, Piche_Read, Piche_Reset, TimeMarksThermo, TimeMarksHygro, TimeMarksRainRec,
 Present_Weather, Present_WeatherCode, Past_Weather, Past_WeatherCode, UnitOfWindSpeed, Visibility, Wind_Direction, 
Wind_Speed, Gusting, AttdThermo, PrAsRead, Correction, CLP, MSLPr, TimeMarksBarograph, TimeMarksAnemograph, OtherTMarks,
 sunduration, trend, windrun, HeightOfLowestCloud, StandardIsobaricSurface,  DurationOfPeriodOfPrecipitation, GrassMinTemp,
 CI_OfPrecipitation, BE_OfPrecipitation, IndicatorOfTypeOfIntrumentation, SignOfPressureChange, Supp_Info, VapourPressure,
 T_H_Graph, DeviceType, recent_weather, runwayVisualRange, relative_humidity, ExpectedTime
			
			*/
			
			
			if(  $totalAmountClouds!=""){insertNo('TotalAmountOfAllClouds', $totalAmountClouds);   
 
              if(insertNo('TotalAmountOfAllClouds', $totalAmountClouds)==2){  array_push($feedback, "ok");}
			}  
			
			if(  $totalAmountLow!=""){insertNo('TotalAmountOfLowClouds', $totalAmountLow);   
 
              if(insertNo('TotalAmountOfLowClouds', $totalAmountLow)==2){  array_push($feedback, "ok");}
			}  
			
			
			
			
			
			
			if(  $lowCloudType1!=""){insertNo('TypeOfLowClouds1', $lowCloudType1);   
 
              if(insertNo('TypeOfLowClouds1', $lowCloudType1)==2){  array_push($feedback, "ok");}
			}  
			//..............................................................................................	
				
				if( $lowCloudType2!=""){insertNo('TypeOfLowClouds2', $lowCloudType2);	

                  if(insertNo('TypeOfLowClouds2', $lowCloudType2)==2){  array_push($feedback, "ok");}
				}

                  if( $lowCloudType3!=""){insertNo('TypeOfLowClouds3', $lowCloudType3);	  

                     if(insertNo('TypeOfLowClouds3', $lowCloudType3)==2){  array_push($feedback, "ok");}
				  }

               if($winddirection !=""){insertNo('Wind_Direction', $winddirection);	

                   if(insertNo('Wind_Direction', $winddirection)==2){  array_push($feedback, "ok");}
			   }

              if($windspeed !=""){  insertNo('Wind_Speed', $windspeed);
			  
			  if(insertNo('Wind_Speed', $windspeed)==2){  array_push($feedback, "ok");}
			  }

            if($recentweather !=""){ insert('recent_weather', $recentweather); 
			
			if(insert('recent_weather', $recentweather)==2){  array_push($feedback, "ok");}
			}

			if($trend !=""){ insert('trend', $trend);
			
			 if(insert('trend', $trend)==2){  array_push($feedback, "ok");}
			}

		    if($alidadeReading !=""){ insertNo('CloudSearchLightReading', $alidadeReading); 
			
			if(insertNo('CloudSearchLightReading', $alidadeReading)==2){  array_push($feedback, "ok");}
			}

           if($rainfall !=""){ insert('Rainfall', $rainfall); 
		   
		     if(insert('Rainfall', $rainfall)==2){  array_push($feedback, "ok");}
		   }
				
				if($dryBulb !=""){insert('Dry_Bulb', $dryBulb);
    
               if(insert('Dry_Bulb', $dryBulb)==2){  array_push($feedback, "ok");}
				}
				
				if($wetBulb !=""){ insert('Wet_Bulb', $wetBulb); 
				
				  if(insert('Wet_Bulb', $wetBulb)==2){  array_push($feedback, "ok");}
				}
				
				if($maxRead !=""){ insertNo('Max_Read', $maxRead); 
				
				if(insert('Max_Read', $maxRead)==2){  array_push($feedback, "ok");}
				}
				
				if($maxReset !=""){ insertNo('Max_Reset', $maxReset);

                if(insertNo('Max_Reset', $maxReset)==2){  array_push($feedback, "ok");}
				}
				
				if($minRead !=""){ insertNo('Min_Read', $minRead);

                if(insertNo('Min_Read', $minRead)==2){  array_push($feedback, "ok");}
				}
				
				if($minReset !=""){ insertNo('Min_Reset', $minReset);

                 if(insertNo('Min_Reset', $minReset)==2){  array_push($feedback, "ok");}
				}
				
				if($PICHERead !=""){ insertNo('Piche_Read', $PICHERead);

                 if(insertNo('Piche_Read', $PICHERead)==2){  array_push($feedback, "ok");}
				}
		     
			 if($PICHERest !=""){ insertNo('Piche_Reset', $PICHERest); 
			 
			   if(insertNo('Piche_Reset', $PICHERest)==2){  array_push($feedback, "ok");} 
			 }
			 
			 if($thermo !=""){ insertNo('TimeMarksThermo', $thermo); 
			 
			  if(insertNo('TimeMarksThermo', $thermo)==2){  array_push($feedback, "ok");}  
			 }
			 
			 if($hygro !=""){ insertNo('TimeMarksHygro', $hygro); 
			 
			 if(insertNo('TimeMarksHygro', $hygro)==2){  array_push($feedback, "ok");}  
			 }
			 
			 if($rainrec !=""){ insertNo('TimeMarksRainRec', $rainrec); 
			 
			  if(insertNo('TimeMarksRainRec',$rainrec)==2){  array_push($feedback, "ok");} 
			 }
			 
			 if($presentweather !=""){ insert('Present_Weather', $presentweather); 
			 
			     if(insert('Present_Weather',$presentweather)==2){  array_push($feedback, "ok");}
			 }
			 
			  if($presentWeatherCode !=""){ insert('Present_WeatherCode', $presentWeatherCode); 
			  
			    if(insert('Present_WeatherCode',$presentWeatherCode)==2){  array_push($feedback, "ok");}
			  }
			   
			   if($pastweather !=""){ insert('Past_Weather', $pastweather);

                if(insert('Past_Weather',$pastweather)==2){  array_push($feedback, "ok");}
			   }
			   
			   if($pastWeatherCode !=""){ insert('Past_WeatherCode', $pastWeatherCode);

                  if(insert('Past_WeatherCode',$pastWeatherCode)==2){  array_push($feedback, "ok");}
			   }
			   
			   if($unitWindSpeed !=""){ insert('UnitOfWindSpeed', $unitWindSpeed); 
			   
			    if(insert('UnitOfWindSpeed',$unitWindSpeed)==2){  array_push($feedback, "ok");}
			   }
			   
			   if($visibility !=""){ insertNo('Visibility', $visibility);

                if(insertNo('Visibility',$visibility)==2){  array_push($feedback, "ok");}
			   }
			   
			   if($gusting !=""){ insertNo('Gusting', $gusting); 
			   
			     if(insertNo('Gusting',$gusting)==2){  array_push($feedback, "ok");}
			   }
			   
			   if($attdThermo !=""){ insertNo('AttdThermo', $attdThermo);

                if(insertNo('AttdThermo',$attdThermo)==2){  array_push($feedback, "ok");}
			   }
			   
			   if($asRead !=""){ insertNo('PrAsRead', $asRead);

                if(insertNo('PrAsRead',$asRead)==2){  array_push($feedback, "ok");}
			   }
			   
			   if( $correction !=""){ insertNo('Correction',  $correction); 
			   
			    if(insertNo('Correction',$correction)==2){  array_push($feedback, "ok");}
			   }
			   
			   if($clp !=""){ insert('CLP', $clp);

                 if(insert('CLP',$clp)==2){  array_push($feedback, "ok");}
			   }
			   
			    if($mslp !=""){ insertNo('MSLPr', $mslp); 
				
				 if(insertNo('MSLPr',$mslp)==2){  array_push($feedback, "ok");}
				}
				
				 if($barograph !=""){ insertNo('TimeMarksBarograph', $barograph); 
				 
				   if(insertNo('TimeMarksBarograph',$barograph)==2){  array_push($feedback, "ok");}
				 }
				 
				  if($anemograph !=""){ insertNo('TimeMarksAnemograph', $anemograph); 
				  
				    if(insertNo('TimeMarksAnemograph',$anemograph)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($otherMarks !=""){ insert('OtherTMarks', $otherMarks);

                     if(insert('OtherTMarks',$otherMarks)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($sunDuration !=""){ insert('sunduration', $sunDuration); 
				  
				     if(insert('sunduration',$sunDuration)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($windRun !=""){ insert('windrun', $windRun); 
				  
				    if(insert('windrun',$windRun)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($heightLowestCloud !=""){ insertNo('HeightOfLowestCloud', $heightLowestCloud); 
				  
				    if(insertNo('HeightOfLowestCloud',$heightLowestCloud)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($isobaricSurface !=""){ insert('StandardIsobaricSurface', $isobaricSurface);

                     if(insert('StandardIsobaricSurface',$isobaricSurface)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($periodPrecipitation !=""){ insert('DurationOfPeriodOfPrecipitation', $periodPrecipitation);

                    if(insert('DurationOfPeriodOfPrecipitation',$heightLowestCloud)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($grassTemp !=""){ insert('GrassMinTemp', $grassTemp); 
				  
				     if(insert('GrassMinTemp',$grassTemp)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($characterIntensit !=""){ insert('CI_OfPrecipitation', $characterIntensit);

                    if(insert('CI_OfPrecipitation',$characterIntensit)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($beginEndPrecipitation !=""){ insert('BE_OfPrecipitation', $beginEndPrecipitation);

                     if(insert('BE_OfPrecipitation',$beginEndPrecipitation)==2){  array_push($feedback, "ok");} 
				  }
				  
				  if($intrumentation !=""){ insert('IndicatorOfTypeOfIntrumentation', $intrumentation);

                     if(insert('IndicatorOfTypeOfIntrumentation',$intrumentation)==2){  array_push($feedback, "ok");} 
				  }
				  
				  if($pressureChange !=""){ insert('SignOfPressureChange', $pressureChange); 
				  
				  if(insert('SignOfPressureChange',$pressureChange)==2){  array_push($feedback, "ok");} 
				  }
				  
				  if($supplementary !=""){ insert('Supp_Info', $supplementary);

                    if(insert('Supp_Info',$supplementary)==2){  array_push($feedback, "ok");} 
				  }
				  
				  if($vapourPressure !=""){ insert('VapourPressure', $vapourPressure); 
				  
				   if(insert('VapourPressure',$vapourPressure)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($graph !=""){ insert('T_H_Graph', $graph);

                    if(insert('T_H_Graph',$graph)==2){  array_push($feedback, "ok");}
				  }
				  
				  if($visualrange !=""){ insert('runwayVisualRange', $visualrange); 
				  
				    if(insert('runwayVisualRange',$visualrange)==2){  array_push($feedback, "ok");}
				  }
		   
		         if($relativeHumidity !=""){ insert('relative_humidity', $relativeHumidity);

                    if(insert('relative_humidity', $relativeHumidity)==2){  array_push($feedback, "ok");}
				 }
				 
				 if($lowCloudOktas1 !=""){ insertNo('OktasOfLowClouds1', $lowCloudOktas1); 
				 
				 if(insertNo('OktasOfLowClouds1', $lowCloudOktas1)==2){  array_push($feedback, "ok");}
				 }
				 if($lowCloudOktas2 !=""){ insertNo('OktasOfLowClouds2', $lowCloudOktas2); 
				 
				  if(insertNo('OktasOfLowClouds2', $lowCloudOktas2)==2){  array_push($feedback, "ok");}
				 }
				 if($lowCloudOktas3 !=""){ insertNo('OktasOfLowClouds3', $lowCloudOktas3);

                  if(insertNo('OktasOfLowClouds3', $lowCloudOktas3)==2){  array_push($feedback, "ok");}
				 }
				 
				 
				 if($low_cloudHeight1 !=""){ insertNo('HeightOfLowClouds1', $low_cloudHeight1); 
				 
				   if(insertNo('HeightOfLowClouds1', $low_cloudHeight1)==2){  array_push($feedback, "ok");}
				 }
				 if($low_cloudHeight2 !=""){ insertNo('HeightOfLowClouds2', $low_cloudHeight2); 
				 
				    if(insertNo('HeightOfLowClouds2', $low_cloudHeight2)==2){  array_push($feedback, "ok");}
				 }
				 if($low_cloudHeight3 !=""){ insertNo('HeightOfLowClouds3', $low_cloudHeight3); 
				 
				  if(insertNo('HeightOfLowClouds3', $low_cloudHeight3)==2){  array_push($feedback, "ok");}
				 }
				 
				 if($low_cloudClcode1 !=""){ insert('CLCODEOfLowClouds1', $low_cloudClcode1); 
				 
				    if(insert('CLCODEOfLowClouds1', $low_cloudClcode1)==2){ array_push($feedback, "ok");}
				 }
				  if($low_cloudClcode2 !=""){ insert('CLCODEOfLowClouds2', $low_cloudClcode2); 
				  
				    if(insert('CLCODEOfLowClouds2', $low_cloudClcode2)==2){ array_push($feedback, "ok");}
				  }
				   if($low_cloudClcode3 !=""){ insert('CLCODEOfLowClouds3', $low_cloudClcode3); 
				   
				    if(insert('CLCODEOfLowClouds3', $low_cloudClcode3)==2){ array_push($feedback, "ok");}
				   }
				 
				 if($mediumCloudType1 !=""){ insertNo('TypeOfMediumClouds1', $mediumCloudType1); 
				 
				 if(insertNo('TypeOfMediumClouds1', $mediumCloudType1)==2){ array_push($feedback, "ok");}
				 }
				 if($mediumCloudType2 !=""){ insertNo('TypeOfMediumClouds2', $mediumCloudType2);

                    if(insertNo('TypeOfMediumClouds2', $mediumCloudType2)==2){ array_push($feedback, "ok");}
				 }
				 if($mediumCloudType3 !=""){ insertNo('TypeOfMediumClouds3', $mediumCloudType3);

                  if(insertNo('TypeOfMediumClouds3', $mediumCloudType3)==2){ array_push($feedback, "ok");}
				 }
				 
				 if($mediumCloudOktas1 !=""){ insertNo('OktasOfMediumClouds1', $mediumCloudOktas1); 
				 
				    if(insertNo('OktasOfMediumClouds1', $mediumCloudOktas1)==2){ array_push($feedback, "ok");}
				 }
				 if($mediumCloudOktas2 !=""){ insertNo('OktasOfMediumClouds2', $mediumCloudOktas2); 
				 
				    if(insertNo('OktasOfMediumClouds2', $mediumCloudOktas2)==2){ array_push($feedback, "ok");}
				 }
				 if($mediumCloudOktas3 !=""){ insertNo('OktasOfMediumClouds3', $mediumCloudOktas3); 
				 
				    if(insertNo('OktasOfMediumClouds3', $mediumCloudOktas3)==2){ array_push($feedback, "ok");}
				 }

                 if($mediumCloudHeight1 !=""){ insertNo(' HeightOfMediumClouds1', $mediumCloudHeight1); 
				 
				    if(insertNo('HeightOfMediumClouds1', $mediumCloudHeight1)==2){ array_push($feedback, "ok");}
				 }
				  if($mediumCloudHeight2 !=""){ insertNo(' HeightOfMediumClouds2', $mediumCloudHeight2); 
				  
				    if(insertNo('HeightOfMediumClouds2', $mediumCloudHeight2)==2){ array_push($feedback, "ok");}
				  }
				   if($mediumCloudHeight3 !=""){ insertNo(' HeightOfMediumClouds3', $mediumCloudHeight3);

                    if(insertNo('HeightOfMediumClouds3', $mediumCloudHeight3)==2){ array_push($feedback, "ok");}
				   }
				 
				 if($mediumCloudClcode1 !=""){ insert('CLCODEOfMediumClouds1', $mediumCloudClcode1); 
				 
				    if(insert('CLCODEOfMediumClouds1', $mediumCloudClcode1)==2){ array_push($feedback, "ok");}
				 }
				  if($mediumCloudClcode2 !=""){ insert('CLCODEOfMediumClouds2', $mediumCloudClcode2); 
				  
				     if(insert('CLCODEOfMediumClouds2', $mediumCloudClcode2)==2){ array_push($feedback, "ok");}
				  }
				   if($mediumCloudClcode3 !=""){ insert('CLCODEOfMediumClouds3', $mediumCloudClcode3); 
				   
				     if(insert('CLCODEOfMediumClouds3', $mediumCloudClcode3)==2){ array_push($feedback, "ok");}
				   }
				 
				 if($highCloudType1 !=""){ insertNo('TypeOfHighClouds1', $highCloudType1); 
				 
				    if(insertNo('TypeOfHighClouds1', $highCloudType1)==2){ array_push($feedback, "ok");}
				 }
				 if($highCloudType2 !=""){ insertNo('TypeOfHighClouds2', $highCloudType2); 
				 
				    if(insertNo('TypeOfHighClouds2', $highCloudType2)==2){ array_push($feedback, "ok");}
				 }
				 if($highCloudType3 !=""){ insertNo('TypeOfHighClouds3', $highCloudType3); 
				 
				   if(insertNo('TypeOfHighClouds3', $highCloudType3)==2){ array_push($feedback, "ok");}
				 }
				 
				 if($highCloudOktas1 !=""){ insertNo('OktasOfHighClouds1', $highCloudOktas1); 
				 
				   if(insertNo('OktasOfHighClouds1', $highCloudOktas1)==2){ array_push($feedback, "ok");}
				 }
				  if($highCloudOktas2 !=""){ insertNo('OktasOfHighClouds2', $highCloudOktas2);

                    if(insertNo('OktasOfHighClouds2', $highCloudOktas2)==2){ array_push($feedback, "ok");}
				  }
				   if($highCloudOktas3 !=""){ insertNo('OktasOfHighClouds3', $highCloudOktas3); 
				   
				    if(insertNo('OktasOfHighClouds2', $highCloudOktas2)==2){ array_push($feedback, "ok");}
				   }
				 
				 if($highCloudHeight1 !=""){ insertNo('HeightOfHighClouds1', $highCloudHeight1); 
				 
				   if(insertNo('HeightOfHighClouds1', $highCloudHeight1)==2){ array_push($feedback, "ok");}
				 }
				 if($highCloudHeight2 !=""){ insertNo('HeightOfHighClouds2', $highCloudHeight2); 
				 
				   if(insertNo('HeightOfHighClouds2', $highCloudHeight2)==2){ array_push($feedback, "ok");} 
				 }
				 if($highCloudHeight3 !=""){ insertNo('HeightOfHighClouds3', $highCloudHeight3);

                  if(insertNo('HeightOfHighClouds3', $highCloudHeight3)==2){ array_push($feedback, "ok");}
				 }
				 
				 if($highCloudClcode1 !=""){ insert('CLCODEOfHighClouds1', $highCloudClcode1); 
				 
				  if(insert('CLCODEOfHighClouds1', $highCloudClcode1)==2){ array_push($feedback, "ok");}
				 }
				 if($highCloudClcode2 !=""){ insert('CLCODEOfHighClouds2', $highCloudClcode2); 
				 
				   if(insert('CLCODEOfHighClouds2', $highCloudClcode2)==2){ array_push($feedback, "ok");}
				 }
				 if($highCloudClcode3 !=""){ insert('CLCODEOfHighClouds3', $highCloudClcode3); 
				 
				   if(insert('CLCODEOfHighClouds3', $highCloudClcode3)==2){ array_push($feedback, "ok");}
				 }



                if($feedback){echo "UNMA has received the data";
          
              mail($emmail,"weatherSMS","UNMA has received the data".$emailDetails);

   
   }
		   
 }

    mysqli_close($conn);	
	
	
	
	
	$spp = file_get_contents('sp.json');
                    $ssp = json_decode($spp, true);
					
 					$arr_index = array();
           
		           foreach ($ssp as $key => $value)
              {
                  $arr_index[] = $key;
    
                     }

                 foreach ($arr_index as $i)
             {
                unset($ssp[$i]);
                  }
                
				file_put_contents('sp.json', json_encode($ssp));
	
	

?> 