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



  //''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''

function update($code, $field, $value,$cid){
	$servername = "localhost";
    $username = "nmukwaya";
    $password = "Nmu734y@";
    $dbname = "wdr";
  
  
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    echo"connection failed";
     }
	
	
	if( $code ==""){
				    
        
				  // echo $id; echo $id2;
				  
				  $sql = "update observationslip SET $field= '$value' WHERE id = $cid";

                   if (mysqli_query($conn, $sql)) {
                    return 2; 
				  // echo"Data received";
                       } 
					   else {
                                echo "Error updating record: " . mysqli_error($conn);
					   }
			    
				}
			
			 else { return 1;}
				
	
	
}


//

function updateNo($code, $field, $value,$cid){
	$servername = "localhost";
    $username = "nmukwaya";
    $password = "Nmu734y@";
    $dbname = "wdr";
  
  
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
    echo"connection failed";
     }
	
	
	if( $code ==""){
				    
        
				  // echo $id; echo $id2;
				  
				  $sql = "update observationslip SET $field= $value WHERE id = $cid";

                   if (mysqli_query($conn, $sql)) {
                    return 2;
					//echo"data received";
                       } 
					   else {
                                echo "Error updating record: " . mysqli_error($conn);
					   }
			    
				}
			
			  else { return 1; } 
				
	
	
}
//........................................................................................................
      
	  
	  
 if($dataf){

  
               
			   
			   
			        $id2 = file_get_contents('id.json');
                    $id3 = json_decode($id2, true);    


                    $dataU = file_get_contents('results.json');
                    $data = json_decode($dataU, true);                 
						   

   
    //echo $data['lowCloudType1'];
	 
    
	
	 $cid =$id3['id'];
	 
	    $lct1 ="";
	     $lct2 ="";
		 $wd ="";
	      $ws ="";
		  $rw ="";
		  $tr ="";
		  
		  $rr =""; $prw =""; $paw =""; $rvr ="";  $gus =""; $ro =""; $vp =""; $rh =""; $hlc =""; $spc =""; $taa =""; $tal =""; $csa =""; $sd ="";
		  $wr =""; $prc =""; $pac =""; $sis =""; $gis =""; $dpp =""; $si =""; $mard =""; $mird =""; $mart =""; $mirt =""; $prd =""; $prt =""; $at =""; $rf ="";
          $db =""; $at =""; $vi =""; $par =""; $co =""; $tmb =""; $tma =""; $om =""; $gmt =""; $iti =""; $thg =""; $lct3 =""; $cip =""; $bep ="";
         $lco1 =""; $lco2 =""; $lco3 ="";   $lch1 ="";  $lch2 =""; $lch3 ="";   $lcc1 =""; $lcc2 =""; $lcc3 =""; $mct1 =""; $mct2 =""; $mct3 ="";  
		 $hct1 =""; $hct2 =""; $hct3 =""; $mco1 =""; $mco2 =""; $mco3 =""; $hco1 =""; $hco2 =""; $hco3 =""; $mch1 =""; $mch2 =""; $mch3 ="";
         $hch1 =""; $hch2 =""; $hch3 =""; $mcc1 =""; $mcc2 =""; $mcc3 =""; $hcc1 =""; $hcc2 =""; $hcc3 =""; 	 $wb ="";	 
		  
		  
		  $uws =""; $cp =""; $mp =""; $si ="";  $th =""; $hy="";
		  /*
  $sql = "update INTO observationslip (Date, id, Userid, station, TIME, TotalAmountOfAllClouds, TotalAmountOfLowClouds,
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
*/
		  
		  
		  
	     $select ="SELECT * FROM observationslip where '$cid'";
 
		       $result = mysqli_query($conn, $select);
                  
				  if($result){
                   if(mysqli_num_rows($result) > 0){ 

                     while($row = mysqli_fetch_assoc($result)){ 

                    $lct1  = $row['TypeOfLowClouds1'];	
					
					$lct2  = $row['TypeOfLowClouds2'];
                     $wd  = $row['Wind_Direction'];
					 $ws  = $row['Wind_Speed']; 
					 $rw  = $row['recent_weather'];	
                    $tr  = $row['trend'];
     
	           $rr = $row['TimeMarksRainRec']; $prw  = $row['Present_Weather']; $paw  = $row['Past_Weather']; $rvr  = $row['runwayVisualRange'];
			   $gus = $row['Gusting'];  $vp = $row['VapourPressure']; $rh  = $row['relative_humidity']; $hlc  = $row['HeightOfLowestCloud'];
			   $spc= $row['SignOfPressureChange']; $taa  = $row['TotalAmountOfAllClouds']; $tal  = $row['TotalAmountOfLowClouds']; 
			   $csa  = $row['CloudSearchLightReading']; $sd  = $row['sunduration']; $wr  = $row['windrun']; $prc  = $row['Present_WeatherCode'];
			   $pac  = $row['Past_WeatherCode']; $sis = $row['StandardIsobaricSurface']; $gis = $row['trend']; $dpp = $row['DurationOfPeriodOfPrecipitation']; 
			   $mard = $row['Max_Read']; $mird = $row['Min_Read']; $mart = $row['Max_Reset']; $mirt = $row['Min_Reset']; $prd = $row['Piche_Read'];
			   $prt = $row['Piche_Reset']; $at = $row['AttdThermo']; $rf = $row['Rainfall']; $db = $row['Dry_Bulb']; $wb  = $row['Wet_Bulb'];
			   $vi  = $row['Visibility']; $par  = $row['PrAsRead']; $co  = $row['Correction']; $tmb  = $row['TimeMarksBarograph']; 
			   $tma  = $row['TimeMarksAnemograph']; $gmt = $row['GrassMinTemp']; $iti  = $row['IndicatorOfTypeOfIntrumentation'];
			   $thg  = $row['T_H_Graph']; $om  = $row['OtherTMarks']; $lct3  = $row['TypeOfLowClouds3']; $cip  = $row['CI_OfPrecipitation']; 
			   $bep  = $row['BE_OfPrecipitation']; $lco1 = $row['OktasOfLowClouds1']; $lco2 = $row['OktasOfLowClouds2']; $lco3 = $row['OktasOfLowClouds3']; 
			   $lch1  = $row['HeightOfLowClouds1'];  $lch2  = $row['HeightOfLowClouds2'];  $lch3  = $row['HeightOfLowClouds3'];
			   $lcc1  = $row['CLCODEOfLowClouds1']; $lcc2  = $row['CLCODEOfLowClouds2']; $lcc3  = $row['CLCODEOfLowClouds3'];
               $mct1  = $row['TypeOfMediumClouds1']; $mct2  = $row['TypeOfMediumClouds2']; $mct3  = $row['TypeOfMediumClouds3'];
			   $mco1  = $row['OktasOfMediumClouds1']; $mco2  = $row['OktasOfMediumClouds2']; $mco3  = $row['OktasOfMediumClouds3'];  
			   $mch1  = $row['HeightOfMediumClouds1'];  $mch2  = $row['HeightOfMediumClouds2']; $mch3  = $row['HeightOfMediumClouds3'];
			   $mcc1  = $row['CLCODEOfMediumClouds1']; $mcc2  = $row['CLCODEOfMediumClouds2']; $mcc3  = $row['CLCODEOfMediumClouds3']; 
			   $hct1  = $row['TypeOfHighClouds1']; $hct2  = $row['TypeOfHighClouds2']; $hct3  = $row['TypeOfHighClouds3'];
			   $hco1  = $row['OktasOfHighClouds1']; $hco2  = $row['OktasOfHighClouds2']; $hco3  = $row['OktasOfHighClouds3'];
			   $hch1  = $row['HeightOfHighClouds1']; $hch2  = $row['HeightOfHighClouds2']; $hch3  = $row['HeightOfHighClouds3'];
			   $hcc1  = $row['CLCODEOfHighClouds1']; $hcc2  = $row['CLCODEOfHighClouds2']; $hcc3  = $row['CLCODEOfHighClouds3'];
			   
			   $uws = $row['UnitOfWindSpeed'];  $cp  = $row['CLP']; $mp  = $row['MSLPr']; $si  = $row['Supp_Info']; 
			      $th  = $row['TimeMarksThermo']; $hy  = $row['TimeMarksHygro'];
					
                 
                             }
                   
                             }
	 
				  }
	
	
	$id4 = $id3['id'];
	   
   //////////////////////////////////////////////////////////////////////////////////
	 //$windspeed=$data['windspeed'];  $winddirection=$data['windDirection'];
	 $trend=$data['trend']; $recentweather=$data['recentweather'];  $lowCloudType1=$data['lowCloudType1'];  $lowCloudType2= $data['lowCloudType2'];
 
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

     $feedback =array();

// update into database
             
			 
			 
			 $submitted=array();
			 
			 
           
		   if(  $totalAmountClouds!=""){updateNo($taa,'TotalAmountOfAllClouds', $totalAmountClouds, $id4);  

              if(updateNo($taa,'TotalAmountOfAllClouds', $totalAmountClouds, $id4)==1){
				  
				  array_push($submitted, "taa");
			  }


             if(updateNo($taa,'TotalAmountOfAllClouds', $totalAmountClouds, $id4)==2){
				  
				  array_push($feedback, "taa");
			  }

			}  
			
			
			
			
			if(  $totalAmountLow!=""){updateNo($tal,'TotalAmountOfLowClouds', $totalAmountLow, $id4);  

              if(updateNo($tal,'TotalAmountOfLowClouds', $totalAmountLow, $id4)==1){
				  
				  array_push($submitted, "tal");
			  }


            if(updateNo($tal,'TotalAmountOfLowClouds', $totalAmountLow, $id4)==2){
				  
				  array_push($feedback, "tal");

			}  
		   
			}
		   
				  
			 // other codes...................................................................
			
			if(  $lowCloudType1!=""){updateNo($lct1,'TypeOfLowClouds1', $lowCloudType1, $id4);  

              if(updateNo($lct1,'TypeOfLowClouds1', $lowCloudType1, $id4)==1){
				  
				  array_push($submitted, "lct1");
			  }

            if(updateNo($lct1,'TypeOfLowClouds1', $lowCloudType1,$id4)==2){  array_push($feedback, "ok");}

			}  
			//..............................................................................................	
				
				if( $lowCloudType2!=""){updateNo($lct2, 'TypeOfLowClouds2', $lowCloudType2 ,$id4);

                  if(updateNo($lct2,'TypeOfLowClouds2', $lowCloudType2, $id4)==1){
				  
				  array_push($submitted, "lct2");
			  }
			  
			  if(updateNo($lct2,'TypeOfLowClouds2', $lowCloudType2,$id4)==2){  array_push($feedback, "ok");}

				}

                  if( $lowCloudType3!=""){updateNo($lct3,'TypeOfLowClouds3', $lowCloudType3, $id4);	 

                     if(updateNo($lct3,'TypeOfLowClouds3', $lowCloudType3, $id4)==1){array_push($submitted, "lct3");}
					 
					 if(updateNo($lct3,'TypeOfLowClouds3', $lowCloudType3,$id4)==2){  array_push($feedback, "ok");}
				  }
				  
				  
               if($winddirection !=""){updateNo($wd,'Wind_Direction', $winddirection,$id4);	 

                   if(updateNo($wd,'Wind_Direction', $winddirection,$id4==1)){array_push($submitted, "wd");}
				   
				   if(updateNo($wd,'Wind_Direction', $winddirection,$id4)==2){  array_push($feedback, "ok");}

			   }

              if($windspeed !=""){  updateNo($ws,'Wind_Speed', $windspeed,$id4);
			  
			     if(updateNo($ws,'Wind_Speed', $windspeed,$id4)==1){array_push($submitted, "ws");}
				 
				  if(updateNo($ws,'Wind_Speed', $windspeed,$id4)==2){  array_push($feedback, "ok");}
			  }

            if($recentweather !=""){ update($rw,'recent_weather', $recentweather,$id4);


               if(update($rw,'recent_weather', $recentweather,$id4)==1){array_push($submitted, "rw");}
			   
			  if(update($rw,'recent_weather', $recentweather,$id4)==2){  array_push($feedback, "ok");}  
			}

			if($trend !=""){ update($tr,'trend', $trend,$id4);
			
			      if(update($tr,'trend', $trend,$id4)==1){array_push($submitted, "tr");}
				  
				  if(updateNo($tr,'trend', $trend,$id4)==2){  array_push($feedback, "ok");} 
			
			    }

		    if($alidadeReading !=""){ updateNo($csa,'CloudSearchLightReading', $alidadeReading,$id4);

                    if(updateNo($csa,'CloudSearchLightReading', $alidadeReading,$id4)==1){array_push($submitted, "csa");}
					
					if(updateNo($csa,'CloudSearchLightReading', $alidadeReading,$id4)==2){  array_push($feedback, "ok");} 

			       }

           if($rainfall !=""){ update($rf,'Rainfall', $rainfall,$id4);

                   if(update($rf,'Rainfall', $rainfall,$id4)==1){array_push($submitted, "rf");}
				   
				   if(update($rf,'Rainfall', $rainfall,$id4)==2){  array_push($feedback, "ok");}

         		   }
				
				if($dryBulb !=""){update($db,'Dry_Bulb', $dryBulb ,$id4);

  
                 if(update($db,'Dry_Bulb', $dryBulb ,$id4)==1){array_push($submitted, "db");}
				 
				 if(update($db,'Dry_Bulb', $dryBulb,$id4)==2){  array_push($feedback, "ok");}

                  }
				
				if($wetBulb !=""){ update($wb,'Wet_Bulb', $wetBulb ,$id4); 
				
				if(update($wb,'Wet_Bulb', $wetBulb ,$id4)==1){array_push($submitted, "wb");}
				
				 if(update($wb,'Wet_Bulb', $wetBulb,$id4)==2){  array_push($feedback, "ok");}
				}
				
				if($maxRead !=""){ updateNo($mard,'Max_Read', $maxRead ,$id4); 
				
				  if(updateNo($mard,'Max_Read', $maxRead ,$id4==1)){array_push($submitted, "mard");}
				  
				  if(updateNo($mard,'Max_Read', $maxRead,$id4)==2){  array_push($feedback, "ok");}
				
				}
				
				if($maxReset !=""){ updateNo($mart,'Max_Reset', $maxReset ,$id4); 
				
				   if(updateNo($mart,'Max_Reset', $maxReset ,$id4)==1){array_push($submitted, "mart");}
				   
				   if(updateNo($mart,'Max_Reset', $maxReset,$id4)==2){  array_push($feedback, "ok");}
				   }
				
				if($minRead !=""){ updateNo($mird,'Min_Read', $minRead ,$id4);

                  if(updateNo($mird,'Min_Read', $minRead ,$id4)==1){array_push($submitted, "mird");}

                  if(updateNo($mird,'Min_Read', $minRead ,$id4)==2){array_push($feedback, "ok");}
				}
				
				if($minReset !=""){ updateNo($mirt,'Min_Reset', $minReset ,$id4);

                  if(updateNo($mirt,'Min_Reset', $minReset ,$id4)==1){array_push($submitted, "mirt");}
				  
				   if(updateNo($mirt,'Min_Reset', $minReset ,$id4)==2){array_push($feedback, "ok");}

				}
				
				if($PICHERead !=""){ updateNo($prd,'Piche_Read', $PICHERead ,$id4);


                 if(updateNo($prd,'Piche_Read', $PICHERead ,$id4)==1){array_push($submitted, "prd");}
				 
				 if(updateNo($prd,'Piche_Read', $PICHERead ,$id4)==2){array_push($feedback, "ok");}

				}
		     
			 if($PICHERest !=""){ updateNo($prt, 'Piche_Reset', $PICHERest ,$id4);

                if(updateNo($prt, 'Piche_Reset', $PICHERest ,$id4)==1){array_push($submitted, "prt");}
				
				if(updateNo($prt, 'Piche_Reset', $PICHERest ,$id4)==2){array_push($feedback, "ok");}

			 }
			 
			 if($thermo !=""){ updateNo($th,'TimeMarksThermo', $thermo ,$id4); 
			 
			 if(updateNo($th, 'TimeMarksThermo', $thermo ,$id4)==1){array_push($submitted, "th");}
			 
			  if(updateNo($th, 'TimeMarksThermo', $thermo ,$id4)==2){array_push($feedback, "ok");}
			 }
			 
			 if($hygro !=""){ updateNo($hy,'TimeMarksHygro', $hygro ,$id4); 
			
			  if(updateNo($hy, 'TimeMarksHygro', $hygro ,$id4)==1){array_push($submitted, "hy");}
			  
			  if(updateNo($hy, 'TimeMarksHygro', $hygro ,$id4)==2){array_push($feedback, "hy");}
			}
			 
			 if($rainrec !=""){ updateNo($rr, 'TimeMarksRainRec', $rainrec ,$id4);

                 if(updateNo($rr, 'TimeMarksRainRec', $rainrec ,$id4)==1){array_push($submitted, "rr");}
				 
				 if(updateNo($rr, 'TimeMarksRainRec', $rainrec ,$id4)==2){array_push($feedback, "rr");}

 			 }
			 
			 if($presentweather !=""){ update($prw ,'Present_Weather', $presentweather ,$id4); 
			 
			  if(update($prw ,'Present_Weather', $presentweather ,$id4)==1){array_push($submitted, "prw"); }
			  
			  if(update($prw ,'Present_Weather', $presentweather ,$id4)==2){array_push($feedback, "prw"); }
			 
			 }
			 
			  if($presentWeatherCode !=""){ update($prc,'Present_WeatherCode', $presentWeatherCode ,$id4);

               if(update($prc,'Present_WeatherCode', $presentWeatherCode ,$id4)==1){array_push($submitted, "prc");}
			  
			  if(update($prc,'Present_WeatherCode', $presentWeatherCode ,$id4)==2){array_push($feedback, "prc");}

			  }
			   
			   if($pastweather !=""){ update($paw,'Past_Weather', $pastweather ,$id4);

                 if(update($paw,'Past_Weather', $pastweather ,$id4)==1){array_push($submitted, "paw");}
				 
				   if(update($paw,'Past_Weather', $pastweather ,$id4)==2){array_push($feedback, "paw");}


			   }
			   
			   if($pastWeatherCode !=""){ update($pac,'Past_WeatherCode', $pastWeatherCode ,$id4); 
			   
			   
			     if(update($pac,'Past_WeatherCode', $pastWeatherCode ,$id4)==1){array_push($submitted, "pac");}
				 
				 if(update($pac,'Past_WeatherCode', $pastWeatherCode ,$id4)==2){array_push($feedback, "pac");}
			   
			   }
			   
			   if($unitWindSpeed !=""){ update($uws,'UnitOfWindSpeed', $unitWindSpeed ,$id4);

                 if(update($uws,'UnitOfWindSpeed', $unitWindSpeed ,$id4)==1){array_push($submitted, "uws");}
				 
				 if(update($uws,'UnitOfWindSpeed', $unitWindSpeed ,$id4)==2){array_push($feedback, "uws");}

			   }
			   
			   if($visibility !=""){ updateNo($vi,'Visibility', $visibility ,$id4);

                  if(updateNo($vi,'Visibility', $visibility ,$id4)==1){array_push($submitted, "vi"); }
				  
				  if(updateNo($vi,'Visibility', $visibility ,$id4)==2){array_push($feedback, "vi"); }

			   }
			   
			   if($gusting !=""){ updateNo($gus,'Gusting', $gusting ,$id4); 
			   
			     if(updateNo($gus,'Gusting', $gusting ,$id4)==1){array_push($submitted, "gus"); }
				 
				  if(updateNo($gus,'Gusting', $gusting ,$id4)==2){array_push($feedback, "gus"); }
			   
			   }
			   
			   if($attdThermo !=""){ updateNo($at,'AttdThermo', $attdThermo ,$id4); 
			   
			     if(updateNo($at,'AttdThermo', $attdThermo ,$id4)==1){array_push($submitted, "at"); }
				 
				 if(updateNo($at,'AttdThermo', $attdThermo ,$id4)==2){array_push($feedback, "at"); }
			   
			   }
			   
			   if($asRead !=""){ updateNo($par,'PrAsRead', $asRead ,$id4); 
			   
			      if(updateNo($par,'PrAsRead', $asRead ,$id4)==1){array_push($submitted, "par"); }
			    
				 if(updateNo($par,'PrAsRead', $asRead ,$id4)==2){array_push($feedback, "par"); }
			   
			   }
			   
			   if( $correction !=""){ updateNo($co,'Correction',  $correction ,$id4);

                 if(updateNo($co,'Correction',  $correction ,$id4)==1){array_push($submitted, "co"); }

                 if(updateNo($co,'Correction',  $correction ,$id4)==2){array_push($feedback, "co"); }
			   }
			   
			   if($clp !=""){ update($cp,'CLP', $clp ,$id4);


                if(update($cp,'CLP', $clp ,$id4)==1){array_push($submitted, "cp"); }
				
				if(update($cp,'CLP', $clp ,$id4)==2){array_push($feedback, "cp"); }

			   }
			   
			    if($mslp !=""){ updateNo($mp,'MSLPr', $mslp ,$id4); 
				
				if(updateNo($mp,'MSLPr', $mslp ,$id4)==1){array_push($submitted, "mp");}
				
				if(updateNo($mp,'MSLPr', $mslp ,$id4)==2){array_push($feedback, "mp");}
				
				}
				
				 if($barograph !=""){ updateNo($tmb,'TimeMarksBarograph', $barograph ,$id4);

                 if(updateNo($tmb,'TimeMarksBarograph', $barograph ,$id4)==1){array_push($submitted, "tmb");}
				 
				 if(updateNo($tmb,'TimeMarksBarograph', $barograph ,$id4)==2){array_push($feedback, "tmb");}
				 
				 
				 }
				 
				  if($anemograph !=""){ updateNo( $tma,'TimeMarksAnemograph', $anemograph ,$id4);

                   if(updateNo( $tma,'TimeMarksAnemograph', $anemograph ,$id4)==1){array_push($submitted, "tma");}
				   
				   if(updateNo( $tma,'TimeMarksAnemograph', $anemograph ,$id4)==2){array_push($feedback, "tma");}

				  }
				  
				  if($otherMarks !=""){ update($om ,'OtherTMarks,', $otherMarks ,$id4);

                    if(update($om ,'OtherTMarks,', $otherMarks ,$id4)==1){array_push($submitted, "om");}
					
					if(update($om ,'OtherTMarks,', $otherMarks ,$id4)==2){array_push($feedback, "om");}



				  }
				  
				  if($sunDuration !=""){ update($sd,'sunduration', $sunDuration ,$id4); 
				  
				    if(update($sd,'sunduration', $sunDuration ,$id4)==1){array_push($submitted, "sd");}
					
					if(update($sd,'sunduration', $sunDuration ,$id4)==2){array_push($feedback, "sd");}
				  
				  }
				  
				  if($windRun !=""){ update($wr,'windrun', $windRun ,$id4);

                    if(update($wr,'windrun', $windRun ,$id4)==1){array_push($submitted, "wr");}
					
					 if(update($wr,'windrun', $windRun ,$id4)==2){array_push($feedback, "wr");}
 
                 }
				  
				  if($heightLowestCloud !=""){ update($hlc ,'HeightOfLowestCloud', $heightLowestCloud ,$id4);


                            if(update($hlc ,'HeightOfLowestCloud', $heightLowestCloud ,$id4)==1){array_push($submitted, "hlc");}
							
							if(update($hlc ,'HeightOfLowestCloud', $heightLowestCloud ,$id4)==2){array_push($feedback, "hlc");}

                   	 }
				  
				  if($isobaricSurface !=""){ update($sis,'StandardIsobaricSurface', $isobaricSurface ,$id4);


                            if(update($sis,'StandardIsobaricSurface', $isobaricSurface ,$id4)==1){array_push($submitted, "sis");}
							
							if(update($sis,'StandardIsobaricSurface', $isobaricSurface ,$id4)==2){array_push($feedback, "sis");}

                  				  }
				  
				  if($periodPrecipitation !=""){ update($dpp,'DurationOfPeriodOfPrecipitation', $periodPrecipitation ,$id4);


                   if(update($dpp,'DurationOfPeriodOfPrecipitation', $periodPrecipitation ,$id4)==1){array_push($submitted, "dpp");}
				   
				    if(update($dpp,'DurationOfPeriodOfPrecipitation', $periodPrecipitation ,$id4)==2){array_push($feedback, "dpp");}


           				  }
				  
				  if($grassTemp !=""){ update($gmt,'GrassMinTemp', $grassTemp, $id4);


                    if(update($gmt,'GrassMinTemp', $grassTemp, $id4)==1){array_push($submitted, "gmt");}
					
					 if(update($gmt,'GrassMinTemp', $grassTemp, $id4)==2){array_push($feedback, "gmt");}

      				  }
				  
				  if($characterIntensit !=""){ update($cip,'CI_OfPrecipitation', $characterIntensit ,$id4);
        
                   if(update($cip,'CI_OfPrecipitation', $characterIntensit ,$id4)==1){array_push($submitted, "cip");}
				   
				   if(update($cip,'CI_OfPrecipitation', $characterIntensit ,$id4)==2){array_push($feedback, "cip");}
             
     			 }
				  
				  if($beginEndPrecipitation !=""){ update($bep,'BE_OfPrecipitation', $beginEndPrecipitation ,$id4);


                    if(update($bep,'BE_OfPrecipitation', $beginEndPrecipitation ,$id4)==1){array_push($submitted, "bep");}
        				
					if(update($bep,'BE_OfPrecipitation', $beginEndPrecipitation ,$id4)==2){array_push($feedback, "bep");}
						 }
				  
				  if($intrumentation !=""){ update($iti,'IndicatorOfTypeOfIntrumentation', $intrumentation ,$id4);


                   if(update($iti,'IndicatorOfTypeOfIntrumentation', $intrumentation ,$id4)==1){array_push($submitted, "iti");}
				   
				   if(update($iti,'IndicatorOfTypeOfIntrumentation', $intrumentation ,$id4)==2){array_push($feedback, "iti");}

				  }
				  
				  if($pressureChange !=""){ update($spc,'SignOfPressureChange', $pressureChange ,$id4);

                    if(update($spc,'SignOfPressureChange', $pressureChange ,$id4)==1){array_push($submitted, "spc");}

                    if(update($spc,'SignOfPressureChange', $pressureChange ,$id4)==2){array_push($feedback, "spc");}
				  }
				  
				  if($supplementary !=""){ update($si,'Supp_Info', $supplementary ,$id4); 
				  
				 if(update($si,'Supp_Info', $supplementary ,$id4)==1){array_push($submitted, "si"); }  
				 
				 if(update($si,'Supp_Info', $supplementary ,$id4)==2){array_push($feedback, "si"); } 
				  
				  }
				  
				  if($vapourPressure !=""){ update($vp, 'VapourPressure', $vapourPressure ,$id4);

                    if(update($vp, 'VapourPressure', $vapourPressure ,$id4)==1){array_push($submitted, "vp"); }
					
					if(update($vp, 'VapourPressure', $vapourPressure ,$id4)==2){array_push($feedback, "vp"); }
					
				  }
				  
				  if($graph !=""){ update($thg,'T_H_Graph', $graph ,$id4);

                    if(update($thg,'T_H_Graph', $graph ,$id4)==1){array_push($submitted, "thg"); }
					
					if(update($thg,'T_H_Graph', $graph ,$id4)==2){array_push($feedback, "thg"); }


				  }
				  
				  if($visualrange !=""){ update($rvr,'runwayVisualRange', $visualrange ,$id4);

                  if(update($rvr,'runwayVisualRange', $visualrange ,$id4)==1){array_push($submitted, "rvr");}
				  
				  if(update($rvr,'runwayVisualRange', $visualrange ,$id4)==2){array_push($feedback, "rvr");}
				  
				  }
		   
		         if($relativeHumidity !=""){ update($rh,'relative_humidity', $relativeHumidity ,$id4);

                    if(update($rh,'relative_humidity', $relativeHumidity ,$id4)==1){array_push($submitted, "rh");}
					
					if(update($rh,'relative_humidity', $relativeHumidity ,$id4)==2){array_push($feedback, "rh");}

				 }
				 
				 if($lowCloudOktas1 !=""){ updateNo($lco1,'OktasOfLowClouds1', $lowCloudOktas1 ,$id4); 
				 
				   if(updateNo($lco1,'OktasOfLowClouds1', $lowCloudOktas1 ,$id4)==1){array_push($submitted, "loc1");}
				   
				    if(updateNo($lco1,'OktasOfLowClouds1', $lowCloudOktas1 ,$id4)==2){array_push($feedback, "loc1");}
				 
				 }
				 if($lowCloudOktas2 !=""){ updateNo($lco2,'OktasOfLowClouds2', $lowCloudOktas2 ,$id4);

                   if(updateNo($lco2,'OktasOfLowClouds2', $lowCloudOktas2 ,$id4)==1){array_push($submitted, "loc2");}
				   
				   if(updateNo($lco2,'OktasOfLowClouds2', $lowCloudOktas2 ,$id4)==2){array_push($feedback, "loc2");}
				     
				 
				 }
				 if($lowCloudOktas3 !=""){ updateNo($lco3,'OktasOfLowClouds3', $lowCloudOktas3 ,$id4);

                   if(updateNo($lco3,'OktasOfLowClouds3', $lowCloudOktas3 ,$id4)==1){array_push($submitted, "loc3");}
				   
				   if(updateNo($lco3,'OktasOfLowClouds3', $lowCloudOktas3 ,$id4)==2){array_push($feedback, "loc3");}
				 
				 }
				 
				 
				 if($low_cloudHeight1 !=""){ updateNo($lch1,'HeightOfLowClouds1', $low_cloudHeight1 ,$id4);

                     if(updateNo($lch1,'HeightOfLowClouds1', $low_cloudHeight1 ,$id4)==1){array_push($submitted, "lch1");}
					 
					 if(updateNo($lch1,'HeightOfLowClouds1', $low_cloudHeight1 ,$id4)==2){array_push($feedback, "lch1");}
					 
					 
     				 }
				 if($low_cloudHeight2 !=""){ updateNo($lch2,'HeightOfLowClouds2', $low_cloudHeight2 ,$id4); 
				 
				   if(updateNo($lch2,'HeightOfLowClouds2', $low_cloudHeight2 ,$id4)==1){array_push($submitted, "lch2");}
				   
				   if(updateNo($lch2,'HeightOfLowClouds2', $low_cloudHeight2 ,$id4)==2){array_push($feedback, "lch2");}
				 
				 }
				 if($low_cloudHeight3 !=""){ updateNo($lch3,'HeightOfLowClouds3', $low_cloudHeight3 ,$id4);

                    if(updateNo($lch3,'HeightOfLowClouds3', $low_cloudHeight3 ,$id4)==1){array_push($submitted, "lch3");}
					
					if(updateNo($lch3,'HeightOfLowClouds3', $low_cloudHeight3 ,$id4)==2){array_push($feedback, "lch3");}

				 }
				 
				 if($low_cloudClcode1 !=""){ update($lcc1,'CLCODEOfLowClouds1', $low_cloudClcode1 ,$id4);

                    if(update($lcc1,'CLCODEOfLowClouds1', $low_cloudClcode1 ,$id4)==1){array_push($submitted, "lcc1");}
					
					if(update($lcc1,'CLCODEOfLowClouds1', $low_cloudClcode1 ,$id4)==2){array_push($feedback, "lcc1");}

				 }
				  if($low_cloudClcode2 !=""){ update($lcc2,'CLCODEOfLowClouds2', $low_cloudClcode2 ,$id4);

                     if(update($lcc2,'CLCODEOfLowClouds2', $low_cloudClcode2 ,$id4)==1){array_push($submitted, "lcc2");}
					 
					 if(update($lcc2,'CLCODEOfLowClouds2', $low_cloudClcode2 ,$id4)==2){array_push($feedback, "lcc2");}

				  }
				   if($low_cloudClcode3 !=""){ update($lcc3,'CLCODEOfLowClouds3', $low_cloudClcode3 ,$id4); 
				   
			         if(update($lcc3,'CLCODEOfLowClouds3', $low_cloudClcode3 ,$id4)==1){array_push($submitted, "lcc3");}   
					 
					 if(update($lcc3,'CLCODEOfLowClouds3', $low_cloudClcode3 ,$id4)==2){array_push($feedback, "lcc3");} 
				   
				   }
				 
				 if($mediumCloudType1 !=""){ updateNo($mct1,'TypeOfMediumClouds1', $mediumCloudType1 ,$id4); 
				 
				 if(updateNo($mct1,'TypeOfMediumClouds1', $mediumCloudType1 ,$id4)==1){array_push($submitted, "mct1");}
				
				if(updateNo($mct1,'TypeOfMediumClouds1', $mediumCloudType1 ,$id4)==2){array_push($feedback, "mct1");}
				 
				 }
				 if($mediumCloudType2 !=""){ updateNo($mct2,'TypeOfMediumClouds2', $mediumCloudType2 ,$id4);

                    if(updateNo($mct2,'TypeOfMediumClouds2', $mediumCloudType2 ,$id4)==1){array_push($submitted, "mct2");}
					  
					  if(updateNo($mct2,'TypeOfMediumClouds2', $mediumCloudType2 ,$id4)==2){array_push($feedback, "mct2");}
					
				 }
				 if($mediumCloudType3 !=""){ updateNo($mct3,'TypeOfMediumClouds3', $mediumCloudType3 ,$id4); 
				 
				  if(updateNo($mct3,'TypeOfMediumClouds3', $mediumCloudType3 ,$id4)==1){array_push($submitted, "mct3");} 
				  
				  if(updateNo($mct3,'TypeOfMediumClouds3', $mediumCloudType3 ,$id4)==2){array_push($feedback, "mct3");} 
				  
				 }
				 
				 if($mediumCloudOktas1 !=""){ updateNo($mco1,'OktasOfMediumClouds1', $mediumCloudOktas1 ,$id4);

                   if(updateNo($mco1,'OktasOfMediumClouds1', $mediumCloudOktas1 ,$id4)==1){array_push($submitted, "mco1");}
				   
				   if(updateNo($mco1,'OktasOfMediumClouds1', $mediumCloudOktas1 ,$id4)==2){array_push($feedback, "mco1");}
				   
				   
				 }
				 if($mediumCloudOktas2 !=""){ updateNo($mco2,'OktasOfMediumClouds2', $mediumCloudOktas2 ,$id4);

                 if(updateNo($mco2,'OktasOfMediumClouds2', $mediumCloudOktas2 ,$id4)==1){array_push($submitted, "mco2");}
				 
				  if(updateNo($mco2,'OktasOfMediumClouds2', $mediumCloudOktas2 ,$id4)==2){array_push($feedback, "mco2");}
				 				 
				 }
				 if($mediumCloudOktas3 !=""){ updateNo($mco3,'OktasOfMediumClouds3', $mediumCloudOktas3 ,$id4); 
				 
                     if(updateNo($mco1,'OktasOfMediumClouds3', $mediumCloudOktas3 ,$id4)==1){array_push($submitted, "mco3");}
					 
					 if(updateNo($mco1,'OktasOfMediumClouds3', $mediumCloudOktas3 ,$id4)==2){array_push($feedback, "mco3");}
				 
				 }

                 if($mediumCloudHeight1 !=""){ updateNo($mch1,'HeightOfMediumClouds1', $mediumCloudHeight1 ,$id4);
                  if(updateNo($mch1,'HeightOfMediumClouds1', $mediumCloudHeight1 ,$id4)==1){array_push($submitted, "mch1");}
				  
				  if(updateNo($mch1,'HeightOfMediumClouds1', $mediumCloudHeight1 ,$id4)==2){array_push($feedback, "mch1");}

				 }
				  if($mediumCloudHeight2 !=""){ updateNo($mch2,'HeightOfMediumClouds2', $mediumCloudHeight2 ,$id4);

                    if(updateNo($mch2,'HeightOfMediumClouds2', $mediumCloudHeight2 ,$id4)==1){array_push($submitted, "mch2");}
					
					if(updateNo($mch2,'HeightOfMediumClouds2', $mediumCloudHeight2 ,$id4)==2){array_push($feedback, "mch2");}

				  }
				   if($mediumCloudHeight3 !=""){ updateNo($mch3,'HeightOfMediumClouds3', $mediumCloudHeight3 ,$id4); 
				   
				    if(updateNo($mch3,'HeightOfMediumClouds3', $mediumCloudHeight3 ,$id4)==1){array_push($submitted, "mch3");}
					
					if(updateNo($mch3,'HeightOfMediumClouds3', $mediumCloudHeight3 ,$id4)==2){array_push($feedback, "mch3");}

				   }
				 
				 if($mediumCloudClcode1 !=""){ update($mcc1,'CLCODEOfMediumClouds1', $mediumCloudClcode1 ,$id4); 
				 
				    if(update($mcc1,'CLCODEOfMediumClouds1', $mediumCloudClcode1 ,$id4)==1){array_push($submitted, "mcc1");}
					
					if(update($mcc1,'CLCODEOfMediumClouds1', $mediumCloudClcode1 ,$id4)==2){array_push($feedback, "mcc1");}
				 }
				  if($mediumCloudClcode2 !=""){ update($mcc2,'CLCODEOfMediumClouds2', $mediumCloudClcode2 ,$id4);

                    if(update($mcc2,'CLCODEOfMediumClouds2', $mediumCloudClcode2 ,$id4)==1){array_push($submitted, "mcc2");}
					
					 if(update($mcc2,'CLCODEOfMediumClouds2', $mediumCloudClcode2 ,$id4)==2){array_push($feedback, "mcc2");}
					
				  }
				   if($mediumCloudClcode3 !=""){ update($mcc3,'CLCODEOfMediumClouds3', $mediumCloudClcode3 ,$id4);

                    if(update($mcc3,'CLCODEOfMediumClouds3', $mediumCloudClcode3 ,$id4)==1){array_push($submitted, "mcc3");}
					
					if(update($mcc3,'CLCODEOfMediumClouds3', $mediumCloudClcode3 ,$id4)==2){array_push($feedback, "mcc3");}
				   }
				 
				 if($highCloudType1 !=""){ updateNo($hct1,'TypeOfHighClouds1', $highCloudType1 ,$id4);

                    if(updateNo($hct1,'TypeOfHighClouds1', $highCloudType1 ,$id4)==1){array_push($submitted, "hct1");}
					
					if(updateNo($hct1,'TypeOfHighClouds1', $highCloudType1 ,$id4)==2){array_push($feedback, "hct1");}
				 }
				 if($highCloudType2 !=""){ updateNo($hct2,'TypeOfHighClouds2', $highCloudType2 ,$id4);

                     if(updateNo($hct2,'TypeOfHighClouds2', $highCloudType2 ,$id4)==1){array_push($submitted, "hct2");}
					
                        if(updateNo($hct2,'TypeOfHighClouds2', $highCloudType2 ,$id4)==2){array_push($feedback, "hct2");}					
					 
				 }
				 if($highCloudType3 !=""){ updateNo($hct3,'TypeOfHighClouds3', $highCloudType3 ,$id4); 
				 
				  if(updateNo($hct3,'TypeOfHighClouds3', $highCloudType3 ,$id4)==1){array_push($submitted, "hct3");}
				  
				  if(updateNo($hct3,'TypeOfHighClouds3', $highCloudType3 ,$id4)==2){array_push($feedback, "hct3");}
				  
				 }
				 
				 if($highCloudOktas1 !=""){ updateNo($hco1,'OktasOfHighClouds1', $highCloudOktas1 ,$id4);

                    if(updateNo($hco1,'OktasOfHighClouds1', $highCloudOktas1 ,$id4)==1){array_push($submitted, "hco1");}
					
					 if(updateNo($hco1,'OktasOfHighClouds1', $highCloudOktas1 ,$id4)==2){array_push($feedback, "hco1");}
				 }
				  if($highCloudOktas2 !=""){ updateNo($hco2,'OktasOfHighClouds2', $highCloudOktas2 ,$id4); 
				  
				     if(updateNo($hco2,'OktasOfHighClouds2', $highCloudOktas2 ,$id4)==1){array_push($submitted, "hco2");}
					 
					if(updateNo($hco2,'OktasOfHighClouds2', $highCloudOktas2 ,$id4)==2){array_push($feedback, "hco2");} 
				  }
				   if($highCloudOktas3 !=""){ updateNo($hco3,'OktasOfHighClouds3', $highCloudOktas3 ,$id4); 
				   
				     if(updateNo($hco3,'OktasOfHighClouds3', $highCloudOktas3 ,$id4)==1){array_push($submitted, "hco3");}
					 
					 if(updateNo($hco3,'OktasOfHighClouds3', $highCloudOktas3 ,$id4)==2){array_push($feedback, "hco3");}
				   }
				 
				 if($highCloudHeight1 !=""){ updateNo($hch1,'HeightOfHighClouds1', $highCloudHeight1 ,$id4);

                    if(updateNo($hch1,'HeightOfHighClouds1', $highCloudHeight1 ,$id4)==1){array_push($submitted, "hch1");}
					
					 if(updateNo($hch1,'HeightOfHighClouds1', $highCloudHeight1 ,$id4)==2){array_push($feedback, "hch1");}
				 }
				 if($highCloudHeight2 !=""){ updateNo($hch2,'HeightOfHighClouds2', $highCloudHeight2 ,$id4); 
				 
				    if(updateNo($hch2,'HeightOfHighClouds2', $highCloudHeight2 ,$id4)==1){array_push($submitted, "hch2");}
					
					 if(updateNo($hch2,'HeightOfHighClouds2', $highCloudHeight2 ,$id4)==2){array_push($feedback, "hch2");}
				 }
				 if($highCloudHeight3 !=""){ updateNo($hch3,'HeightOfHighClouds3', $highCloudHeight3 ,$id4);

                    if(updateNo($hch3,'HeightOfHighClouds3', $highCloudHeight3 ,$id4)==1){array_push($submitted, "hch3");}
					
					 if(updateNo($hch3,'HeightOfHighClouds3', $highCloudHeight3 ,$id4)==2){array_push($feedback, "hch3");}
				 }
				 
				 if($highCloudClcode1 !=""){ update($hcc1,'CLCODEOfHighClouds1', $highCloudClcode1 ,$id4);
				 
				    if(update($hcc1,'CLCODEOfHighClouds1', $highCloudClcode1 ,$id4)==1){array_push($submitted, "hcc1"); }
					
					if(update($hcc1,'CLCODEOfHighClouds1', $highCloudClcode1 ,$id4)==2){array_push($feedback, "hcc1"); }
					
				 }
				 if($highCloudClcode2 !=""){ update($hcc2,'CLCODEOfHighClouds2', $highCloudClcode2 ,$id4);

                    if(update($hcc2,'CLCODEOfHighClouds2', $highCloudClcode2 ,$id4)==1){array_push($submitted, "hcc2"); }
					
					 if(update($hcc2,'CLCODEOfHighClouds2', $highCloudClcode2 ,$id4)==2){array_push($feedback, "hcc2"); }
				 }
				 if($highCloudClcode3 !=""){ update($hcc3,'CLCODEOfHighClouds3', $highCloudClcode3 ,$id4); 
				 
				    if(update($hcc3,'CLCODEOfHighClouds3', $highCloudClcode3 ,$id4)==1){array_push($submitted, "hcc3"); }
					
					 if(update($hcc3,'CLCODEOfHighClouds3', $highCloudClcode3 ,$id4)==2){array_push($feedback, "hcc3"); }
				 }
				 
				 
				 if($feedback){echo "UNMA has received the data again";}
				 

		   
		   
 }
 
 
  mysqli_close($conn);	
 
     
	 
	 if($submitted){
	 
	    $long = count($submitted);
	 
	   echo"value already submitted(";
	
       for ($s = 0; $s <$long; $s++) {
     echo $submitted[$s].","."  ";
  
        }
       echo")";
	 
	 
	 
	 }
	 
	 // delete speci json
	 
	 
	 
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