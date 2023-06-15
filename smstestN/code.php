<?php
	
	
	
	//wind speed
	
	 if( $sms[0]=="ws"){
	
		 $windspeed = $sms[1];
		
		fwrite( $file, $windspeed.PHP_EOL ); 

        $data = array_push_assoc($data, 'windspeed', $windspeed);		
  }
	
	//wind direction
	
	else if(  $sms[0]=="wd"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	       $winddirection = (int) $sms[1];
		    
		  
           fwrite( $file,  $winddirection.PHP_EOL );
		   
		   $data = array_push_assoc($data, 'winddirection', $winddirection);
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	

	
	
	//gusting
	
	else if(  $sms[0]=="gus"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	      $gusting = $sms[1];
		  
		  $data = array_push_assoc($data, 'gusting', $gusting );
		  
           fwrite( $file,  $gusting.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	

	  
	//recent weather
			
	 else if( $sms[0]=="rw"){
 
         if (array_key_exists( $sms[1] ,$present)){
			
			$recentweather = $present[$sms[1]];
			
		   fwrite( $file, $recentweather.PHP_EOL ); 
		   
		    $data = array_push_assoc($data, 'recentweather', $recentweather);
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 		  
	  }
	
	//run way visual range

   else if(  $sms[0]=="rvr"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	     $visualrange = $sms[1];
		  
		  $data = array_push_assoc($data, 'visualrange', $visualrange );
		  
           fwrite( $file, $visualrange.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	
	
	//past weather
	
	else if( $sms[0]=="paw"){
		 
		 $pastweather = $sms[1];
		 
		 $data = array_push_assoc($data, 'pastweather', $pastweather );
		 fwrite( $file, $pastweather.PHP_EOL );
		  
	  
  }
	
	//present weather

      else if( $sms[0]=="prw"){

		 
		  	 
         if (array_key_exists( $sms[1] ,$present)){
			
			$presentweather = $present[$sms[1]];
			
			$data = array_push_assoc($data, 'presentweather', $presentweather );
			
		   fwrite( $file, $presentweather.PHP_EOL ); 
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 		  
	  }

	
	//rain rec 
  
	else if(  $sms[0]=="rr"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $rainrec = $sms[1];
		 
		 $data = array_push_assoc($data, 'rainrec', $rainrec );
			
		  
          fwrite( $file, $rainrec.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	
	
	
	//sign of pressure change
	
	
	else if( $sms[0]=="spc"){

		 $pressureChange = $sms[1];
		 
		 $data = array_push_assoc($data, 'pressureChange', $pressureChange );
		 
		 fwrite( $file, $pressureChange.PHP_EOL );
		  
	  }	
  
	
	//remarks of any other observations
	
	
	else if( $sms[0]=="ro"){
		 
		 $otherObservation = $sms[1];
		 
		 $data = array_push_assoc($data, 'otherObservation', $otherObservation );
		 
		 fwrite( $file, $otherObservation.PHP_EOL );
		  
	  }	
  
	
	//vapour pressure
	
    else if(  $sms[0]=="vp"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	     $vapourPressure = $sms[1];
		  
		  $data = array_push_assoc($data, 'vapourPressure', $vapourPressure );
		  
         fwrite( $file, $vapourPressure.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	
	
//relative humidity

    else if( $sms[0]=="rh"){
		 
		 $relativeHumidity = $sms[1];
		 
		 $data = array_push_assoc($data, 'relativeHumidity', $relativeHumidity );
		 
		 fwrite( $file, $relativeHumidity.PHP_EOL );
		  
	  }	
  
	//height of lowest cloud
	
	else if( $sms[0]=="hlc"){
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=10&& $sms1>=0){
	  
	             $heightLowestCloud = $sms1;
				 
				 $data = array_push_assoc($data, 'heightLowestCloud', $heightLowestCloud );
			
	  
		      fwrite( $file, $heightLowestCloud.PHP_EOL );
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	 }
     else {array_push($characterError, $sms[0]);}
	  }
	
	
	//date
	
	
	
	else if( $sms[0]=="d"){
	
	if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$sms[1])) {
           
		   $Date = $sms[1];
		   
		  // fwrite( $file, $Date.PHP_EOL );
                  
                   //  $data = array_push_assoc($data, 'Date', $Date);
					 
					// array_push($dateTrue, "d");

      }    
 
 
    else {
        
		array_push($dateError, $sms[0]);
		
        }
	
	}
	
	
	// time
	
	else if( $sms[0]=="t"){

	 
	   $time= rtrim($sms[1],'z');
	   
	   //echo $time; 
	  // echo $sms[1];
	
	if(preg_match("/^(?:2[0-4]|[01][1-9]|10):([0-5][0-9])$/", $time)){
		 
		$Time =  $time."Z";
	   // $Time = strtoupper($sms[1]);
		//echo $Time;
		 //fwrite( $file, $Time.PHP_EOL );
               
             // $data = array_push_assoc($data, 'Time', $Time);
			  
			  //array_push($timeTrue, "t");
	 }
	 
	 
	  else if(preg_match('#^([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$#', $time)){
		   
		   //echo "$time"
		   $Time =  $time."Z";
		   
		  // $data = array_push_assoc($data, 'Time', $Time);
			  
		  //array_push($timeTrue, "t");
	  }
	   
	   
	   
	   else {
        
		array_push($timeError, $sms[0]);
		
        }
	    
	   
	}
	
	
	//Total amount of all clouds
	
     else if( $sms[0]=="taa"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		        $sms1 = (int)$sms[1];
		
              if($sms1<=8&& $sms1>=0){
				  
				  $totalAmountClouds = $sms1;
				  
				  $data = array_push_assoc($data, 'totalAmountClouds', $totalAmountClouds );
	  
		      fwrite( $file, $totalAmountClouds.PHP_EOL );
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	 }
     else {array_push($characterError, $sms[0]);}
	  }
	
//Total amount of all low clouds	
	
	  else if( $sms[0]=="tal"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		       $sms1 = (int)$sms[1];
		
              if($sms1<=8&& $sms1>=0){
				  
				  $totalAmountLow = $sms1;
				  
				   $data = array_push_assoc($data, 'totalAmountLow', $totalAmountLow );
	  
		      fwrite( $file, $totalAmountLow.PHP_EOL );
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	 }
     else {array_push($characterError, $sms[0]);}
	  }
	
//Cloud Searchlight Alidade Reading	
	
  else if(  $sms[0]=="csa"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $alidadeReading = $sms[1];
		  
		  $data = array_push_assoc($data, 'alidadeReading', $alidadeReading );
		  
		  fwrite( $file, $alidadeReading.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 
	
	
	//SUNSHINE DURATION
	
	
	else if( $sms[0]=="sd"){

		 $sunDuration= $sms[1];
		 
		 $data = array_push_assoc($data, 'sunDuration', $sunDuration );
		 
		 fwrite( $file, $sunDuration.PHP_EOL );
		  
	  }	
  
	
// wind run

	else if( $sms[0]=="wr"){
	
		 
		 $windRun = $sms[1];
		 
		 $data = array_push_assoc($data, 'windRun', $windRun );
		 
		 fwrite( $file, $windRun.PHP_EOL );
		  
	  }	
  
	
	//PRESENT WEATHER CODE

   else if(  $sms[0]=="prc"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	     $presentWeatherCode = $sms[1];
		 
		 $data = array_push_assoc($data, 'presentWeatherCode', $presentWeatherCode );
		  
           fwrite( $file, $presentWeatherCode.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	
   
  
  
  //PAST WEATHER CODE
	
    else if(  $sms[0]=="pac"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	     $pastWeatherCode = $sms[1];
		 
		 $data = array_push_assoc($data, 'pastWeatherCode', $pastWeatherCode );
		  
           fwrite( $file, $pastWeatherCode.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	
  
  //STANDARD ISOBARIC SURFACE
  
     else if(  $sms[0]=="sis"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	      $isobaricSurface = $sms[1];
		  
		   $data = array_push_assoc($data, 'isobaricSurface', $isobaricSurface );
		  
          fwrite( $file, $isobaricSurface.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		

//GEOPOTENTIAL OF STANDARD ISOBARIC SURFACE


   else if( $sms[0]=="gis"){

		 $geoIsobaric = $sms[1];
		 
		 $data = array_push_assoc($data, 'geoIsobaric', $geoIsobaric );
		 
		 fwrite( $file, $geoIsobaric.PHP_EOL );
		  
	  }	
  

//DURATION OF PERIOD OF PRECIPITATION

   else if( $sms[0]=="dpp"){
		 
		 $periodPrecipitation = $sms[1];
		 
		 $data = array_push_assoc($data, 'periodPrecipitation', $periodPrecipitation );
		 
		 fwrite( $file, $periodPrecipitation.PHP_EOL );
		  
	  }	
  


//SUPPLEMENTARY INFORMATION

	else if(  $sms[0]=="si"){
	
	   if (!is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	      $supplementary = $sms[1];
		  
		   $data = array_push_assoc($data, 'supplementary', $supplementary );
		  
          fwrite( $file, $supplementary.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	
	  
	//MAX READ
	
	  else if(  $sms[0]=="mard"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $maxRead = $sms[1];
		  
		  $data = array_push_assoc($data, 'maxRead', $maxRead );
		  
		   fwrite( $file, $maxRead.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 
  	
	
	//MIN Read 
  
	else if(  $sms[0]=="mird"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $minRead = $sms[1];
		  
		  $data = array_push_assoc($data, 'minRead', $minRead );
		  
           fwrite( $file, $minRead.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
	
//MAX Reset	
	  
   else if(  $sms[0]=="mart"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $maxReset = $sms[1];
		  
		  $data = array_push_assoc($data, 'maxReset', $maxReset );
		  
           fwrite( $file, $maxReset.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
  
	
//MIN Reset	  
  	
	else if(  $sms[0]=="mirt"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $minReset = $sms[1];
		  
		  $data = array_push_assoc($data, 'minReset', $minReset );
		  
         fwrite( $file, $minReset.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
  
	
//PICHE Read	  
  		
  else if(  $sms[0]=="prd"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $PICHERead	 = $sms[1];
		  
		  $data = array_push_assoc($data, 'PICHERead', $PICHERead );
		  
          fwrite( $file, $PICHERead.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }


//PICHE Rest	
	
     else if(  $sms[0]=="prt"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $PICHERest	 = $sms[1];
		 
		 $data = array_push_assoc($data, 'PICHERest', $PICHERest );
		  
         fwrite( $file, $PICHERest.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	
	
	
//TimeMarksThermo	

  else if(  $sms[0]=="th"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $thermo = $sms[1];
		  
         fwrite( $file, $thermo.PHP_EOL );
		 
		  $data = array_push_assoc($data, 'thermo', $thermo );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	
	  
		
		
	
	
//TimeMarksHygro
  		
	else if(  $sms[0]=="hy"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $hygro	 = $sms[1];
		  
         fwrite( $file, $hygro.PHP_EOL );
		 
		  $data = array_push_assoc($data, 'hygro', $hygro );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		
	

//Rainfall(mm)

 
 else if( $sms[0]=="rf"){
		 
		 $rainfall	 = $sms[1];
		 
		 fwrite( $file, $rainfall.PHP_EOL );
		 
		 $data = array_push_assoc($data, 'rainfall', $rainfall );
		  
	  }	
  		
		

//Dry Bulb		

   else if(  $sms[0]=="db"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	       $dryBulb	 = $sms[1];
		   
		    $data = array_push_assoc($data, 'dryBulb', $dryBulb );
		  
           fwrite( $file, $dryBulb.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	

//Wet Bulb	  
  	
   else if(  $sms[0]=="wb"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	       $wetBulb	 = $sms[1];
		   
		   $data = array_push_assoc($data, 'wetBulb', $wetBulb );
		  
           fwrite( $file, $wetBulb.PHP_EOL );
		  
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		


//Attd.Thermo.(C)  
  		
	 else if(  $sms[0]=="at"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	       $attdThermo	 = $sms[1];
		   
		   $data = array_push_assoc($data, 'attdThermo', $attdThermo );
		  
           fwrite( $file, $attdThermo.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		



 //VISIBILITY
 	
     else if(  $sms[0]=="vi"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	      $visibility	 = $sms[1];
		  
		  $data = array_push_assoc($data, 'visibility', $visibility );
		  
           fwrite( $file,  $visibility.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }	

//Pr.As Read(C)

    else if(  $sms[0]=="par"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	       $asRead	 = $sms[1];
		   
		   $data = array_push_assoc($data, 'asRead', $asRead );
		  
           fwrite( $file,  $asRead.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		



//Correction

   else if(  $sms[0]=="co"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	       $correction	 = $sms[1];
		   
		   $data = array_push_assoc($data, 'correction', $correction );
		  
           fwrite( $file,  $correction.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		

    
//C.L.P(mb)
   
	else if(  $sms[0]=="cp"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	      $clp = $sms[1];
		  
		  $data = array_push_assoc($data, 'clp', $clp );
		  
           fwrite( $file,  $clp.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		
  
  
  
  //M.S.L.Pr(mb) or 850mb. Ht.(gpm)  
  
  else if(  $sms[0]=="mp"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	      $mslp	 = $sms[1];
		  
		  $data = array_push_assoc($data, 'mslp', $mslp );
		  
           fwrite( $file,  $mslp.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		
  
  
  
 //TIME MARKS BAROGRAPH 
   
	else if(  $sms[0]=="tmb"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	      $barograph	 = $sms[1];
		  
		  $data = array_push_assoc($data, 'barograph', $barograph );
		  
           fwrite( $file,  $barograph.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		
	
	//TIME MARKS ANEMOGRAPH
	 
    else if(  $sms[0]=="tma"){
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
	      $anemograph	 = $sms[1];
		  
		  $data = array_push_assoc($data, 'barograph', $barograph );
		  
           fwrite( $file,  $anemograph.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }		
	
  
	
  //Other T/MARKS
  
    else if( $sms[0]=="om"){
	
		 
		 $otherMarks	 = $sms[1];
		 
		 $data = array_push_assoc($data, 'otherMarks', $otherMarks );
		 
		 fwrite( $file,  $otherMarks.PHP_EOL );
		  
	  }	
    
  
  

//Unit of Wind Speed
  
  else if( $sms[0]=="uws"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=6&& $sms1>=0){
	  
	             $unitWindSpeed= $sms1;
	  
	            $data = array_push_assoc($data, 'unitWindSpeed', $unitWindSpeed );
	  
		      fwrite( $file, $unitWindSpeed.PHP_EOL );
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	   }
         else {array_push($characterError, $sms[0]);}
	  }

//Grass Mininum temperature

   else if( $sms[0]=="gmt"){
		 
		 $grassTemp	 = $sms[1];
		 
		  $data = array_push_assoc($data, 'grassTemp', $grassTemp );
		 
		 fwrite( $file,  $grassTemp.PHP_EOL );
		  
	  }	
    
 
  
  //Character and Intensity of Precipitation
  
  else if( $sms[0]=="cip"){
		 
		 $characterIntensit = $sms[1];
		 
		 $data = array_push_assoc($data, 'characterIntensit', $characterIntensit );
		 
		 fwrite( $file,  $characterIntensit.PHP_EOL );
		  
	  }	
  


  //Beginning or End of Precipitation  

   else if( $sms[0]=="bep"){
	
		 $beginEndPrecipitation	 = $sms[1];
		 
		 $data = array_push_assoc($data, 'beginEndPrecipitation', $beginEndPrecipitation );
		 
		 fwrite( $file,  $beginEndPrecipitation.PHP_EOL );
		  
	  }	
   
   //Indicator of type of intrumentation
   
    else if( $sms[0]=="iti"){
	
		 $intrumentation = $sms[1];
		 
		  $data = array_push_assoc($data, 'intrumentation', $intrumentation );
		 
		 fwrite( $file,  $intrumentation.PHP_EOL );
		  
	  }	
  
  
  
   //TREND
   
    else if( $sms[0]=="td"){
		 
		 $trend	 = $sms[1];
		 
		 fwrite( $file,  $trend.PHP_EOL );
		 
		 $data = array_push_assoc($data, 'trend', $trend);
		  
	  }	
     	

    //TH GRAPH

  	 else if( $sms[0]=="thg"){
	
		 $graph	 = $sms[1];
		 
		 $data = array_push_assoc($data, 'graph', $graph);
		 
		 fwrite( $file,   $graph.PHP_EOL );
		  
	  }	
     	
  
//clouds	
	
		
	// low cloud type1
	else if( $sms[0]=="lct1"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=9&& $sms1>=0){
				  
				  $lowCloudType1 = $sms1;
	  
		      fwrite( $file, $lowCloudType1.PHP_EOL );
			  
			   $data = array_push_assoc($data, 'lowCloudType1', $lowCloudType1);
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	 }
     else {array_push($characterError, $sms[0]);}
	  }
	  
	  
	  
// low cloud type2
	else if( $sms[0]=="lct2"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=9&& $sms1>=0){
				  
				$lowCloudType2 = $sms1;
	  
		      fwrite( $file, $lowCloudType2.PHP_EOL );
			  
			   $data = array_push_assoc($data, 'lowCloudType2', $lowCloudType2);
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	 }
     else {array_push($characterError, $sms[0]);}
	  }



// low cloud type3
	else if( $sms[0]=="lct3"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=9&& $sms1>=0){
				  
				  $lowCloudType3 = $sms1;
	  
		      fwrite( $file, $lowCloudType3.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'lowCloudType3', $lowCloudType3);
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	 }
     else {array_push($characterError, $sms[0]);}
	  }
 
 
 // low cloud oktas1
	else if( $sms[0]=="lco1"){
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		        $sms1 = (int)$sms[1];
		
              if($sms1<=8&& $sms1>=0){
	  
	            $lowCloudOktas1 = $sms1;
	  
		      fwrite( $file, $lowCloudOktas1.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'lowCloudOktas1', $lowCloudOktas1);
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	 }
     else {array_push($characterError, $sms[0]);}
	  }

// low cloud oktas2
	
	else if( $sms[0]=="lco2"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		       $sms1 = (int)$sms[1];
		
               if($sms1<=8&& $sms1>=0){
				  
				  $lowCloudOktas2 = $sms1;
	  
		      fwrite( $file, $lowCloudOktas2.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'lowCloudOktas2', $lowCloudOktas2);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	 }
     else {array_push($characterError, $sms[0]);}
	  }
	  

// low cloud oktas3
	
          else if( $sms[0]=="lco3"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		        $sms1 = (int)$sms[1];
		
              if($sms1<=8&& $sms1>=0){
				  
				  $lowCloudOktas3 = $sms1;
	  
		      fwrite( $file, $lowCloudOktas3.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'lowCloudOktas3', $lowCloudOktas3);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	   }
         else {array_push($characterError, $sms[0]);}
	  }
		  
		  
 // low cloud height1
	else if( $sms[0]=="lch1"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $low_cloudHeight1 = $sms[1];
		 
		 
		  $data = array_push_assoc($data, 'low_cloudHeight1', $low_cloudHeight1);
		  
		  fwrite( $file, $low_cloudHeight1.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
	  

 
 // low cloud height2
 
		else if( $sms[0]=="lch2"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $low_cloudHeight2 = $sms[1];
		 
		 $data = array_push_assoc($data, 'low_cloudHeight2', $low_cloudHeight2);
		  
		  fwrite( $file, $low_cloudHeight2.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
	 
 
 

// low cloud height3
		else if( $sms[0]=="lch3"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $low_cloudHeight3 = $sms[1];
		 
		 $data = array_push_assoc($data, 'low_cloudHeight3', $low_cloudHeight3);
		  
		  fwrite( $file, $low_cloudHeight3.PHP_EOL );
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 

// low cloud clcode1
	else if( $sms[0]=="lcc1"){
	
         if (array_key_exists( $sms[1] ,$clcode)){
			 
			 $low_cloudClcode1 = $clcode[$sms[1]];
				 
		$data = array_push_assoc($data, 'low_cloudClcode1', $low_cloudClcode1);
		
		   fwrite( $file, $low_cloudClcode1.PHP_EOL );
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 
		   	  
	  }



// low cloud clcode2
	
	else if( $sms[0]=="lcc2"){
		  	 
         if (array_key_exists( $sms[1] ,$clcode)){
			 
			 $low_cloudClcode2 = $clcode[$sms[1]];
			 
			 $data = array_push_assoc($data, 'low_cloudClcode2', $low_cloudClcode2);
				 
		   fwrite( $file, $low_cloudClcode2.PHP_EOL );
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 
		    
		  
	  }

	  
	

// low cloud clcode3
	
	else if( $sms[0]=="lcc3"){
	
		  	 
         if (array_key_exists( $sms[1] ,$clcode)){
			 
			 $low_cloudClcode3 = $clcode[$sms[1]];
				 
		  $data = array_push_assoc($data, 'low_cloudClcode3', $low_cloudClcode3);
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 
		    
		  
	  }

	  
	
	
	
// medium cloud type1
	  
	  
	  else if( $sms[0]=="mct1"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		       $sms1 = (int)$sms[1];
		
                if($sms1<=9&& $sms1>=0){
				  
				$mediumCloudType1 = $sms1;  
	  
		      fwrite( $file, $mediumCloudType1.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'mediumCloudType1', $mediumCloudType1);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	      else{ array_push($integerError, $sms[0]);}
	  
	   }
       else {array_push($characterError, $sms[0]);}
	  }
	  

// medium cloud type2
	
	else if( $sms[0]=="mct2"){
	
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=9&& $sms1>=0){
				  
				$mediumCloudType2 = $sms1; 
				
				$data = array_push_assoc($data, 'mediumCloudType2', $mediumCloudType2);
	  
		      fwrite( $file, $mediumCloudType2.PHP_EOL );
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	      else{ array_push($integerError, $sms[0]);}
	  
	   }
       else {array_push($characterError, $sms[0]);}
	  }
	
// medium cloud type3
	
		else if( $sms[0]=="mct3"){
	
	     if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
		
		       $sms1 = (int)$sms[1];
		
              if($sms1<=9&& $sms1>=0){
				  
				$mediumCloudType3 = $sms1;  
				
				$data = array_push_assoc($data, 'mediumCloudType3', $mediumCloudType3);
	  
		      fwrite( $file, $mediumCloudType3.PHP_EOL );
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	      else{ array_push($integerError, $sms[0]);}
	  
	   }
       else {array_push($characterError, $sms[0]);}
	  }
	

// high cloud type1
	
	  else if( $sms[0]=="hct1"){
	
	     if (is_numeric($sms[1])){
		 
		  if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=9&& $sms1>=0){
				  
			  $highCloudType1 = $sms1;
			  
			  $data = array_push_assoc($data, 'highCloudType1', $highCloudType1);
	  
		      fwrite( $file, $highCloudType1.PHP_EOL );
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	      else{ array_push($integerError, $sms[0]);}
	  
	   }
       else {array_push($characterError, $sms[0]);}
	  }
	
	  



// high cloud type2
	
	else if( $sms[0]=="hct2"){
	
	     if (is_numeric($sms[1])){
		 
		  if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=9&& $sms1>=0){
				  
				$highCloudType2 = $sms1; 
				
				$data = array_push_assoc($data, 'highCloudType2', $highCloudType2);
	  
		      fwrite( $file, $highCloudType2.PHP_EOL );
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	      else{ array_push($integerError, $sms[0]);}
	  
	   }
       else {array_push($characterError, $sms[0]);}
	  }


// high cloud type3
	
	else if( $sms[0]=="hct3"){
	
	     if (is_numeric($sms[1])){
		 
		  if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=9&& $sms1>=0){
				  
				$highCloudType3 = $sms1;  
	  
		      fwrite( $file, $highCloudType3.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'highCloudType3', $highCloudType3);
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	      else{ array_push($integerError, $sms[0]);}
	  
	   }
       else {array_push($characterError, $sms[0]);}
	  }
	
// medium cloud oktas1
	
	else if( $sms[0]=="mco1"){
	
	
	     if (is_numeric($sms[1])){
		 
		    if(strchr( $sms[1],".") ==false){
		
		       $sms1 = (int)$sms[1];
		
                if($sms1<=8&& $sms1>=0){
				  
				$mediumCloudOktas1 = $sms1;
	  
		      fwrite( $file, $mediumCloudOktas1.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'mediumCloudOktas1', $mediumCloudOktas1);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	   }
         else {array_push($characterError, $sms[0]);}
	  }
		  


// medium cloud oktas2
	
	else if( $sms[0]=="mco2"){
	
	
	     if (is_numeric($sms[1])){
		 
		    if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
               if($sms1<=8&& $sms1>=0){
				  
				  $mediumCloudOktas2 = $sms1;
	  
		      fwrite( $file, $mediumCloudOktas2.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'mediumCloudOktas2', $mediumCloudOktas2);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	   }
         else {array_push($characterError, $sms[0]);}
	  }
		  


// medium cloud oktas3
	
	
	else if( $sms[0]=="mco3"){
	
	
	     if (is_numeric($sms[1])){
		 
		    if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=8&& $sms1>=0){
				  
				$mediumCloudOktas3 = $sms1;  
	  
		      fwrite( $file, $mediumCloudOktas3.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'mediumCloudOktas3', $mediumCloudOktas3);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	   }
         else {array_push($characterError, $sms[0]);}
	  }
		  


 
// high cloud oktas1
	else if( $sms[0]=="hco1"){
	
	
	     if (is_numeric($sms[1])){
		 
		      if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=8&& $sms1>=0){
				  
				$highCloudOktas1 = $sms1;
	  
		      fwrite( $file,$highCloudOktas1.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'highCloudOktas1', $highCloudOktas1);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	   }
         else {array_push($characterError, $sms[0]);}
	  }
		  


// high cloud oktas2
	
	else if( $sms[0]=="hco2"){
	
	
	     if (is_numeric($sms[1])){
		 
		   if(strchr( $sms[1],".") ==false){
		
		       $sms1 = (int)$sms[1];
		
              if($sms1<=8&& $sms1>=0){
				  
				$highCloudOktas2 = $sms1;
	  
		      fwrite( $file,$highCloudOktas2.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'highCloudOktas2', $highCloudOktas2);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	   }
         else {array_push($characterError, $sms[0]);}
	  }
	

// high cloud oktas3
	
	else if( $sms[0]=="hco3"){
	
	
	     if (is_numeric($sms[1])){
		 
		   if(strchr( $sms[1],".") ==false){
		
		      $sms1 = (int)$sms[1];
		
              if($sms1<=8&& $sms1>=0){
				  
				 $highCloudOktas3 = $sms1;
	  
		      fwrite( $file,$highCloudOktas3.PHP_EOL );
			  
			  $data = array_push_assoc($data, 'highCloudOktas3', $highCloudOktas3);
			  
			  }
			  else{array_push($rangeError, $sms[0]);}
		    }
	     else{ array_push($integerError, $sms[0]);}
	  
	   }
         else {array_push($characterError, $sms[0]);}
	  }
 
 
  // medium cloud height1
	
	 else if( $sms[0]=="mch1"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $mediumCloudHeight1 = $sms[1];
		  
		  fwrite( $file, $mediumCloudHeight1.PHP_EOL );
		  
		  $data = array_push_assoc($data, 'mediumCloudHeight1', $mediumCloudHeight1);
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 
 
 // medium cloud height2
	
	else if( $sms[0]=="mch2"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $mediumCloudHeight2 = $sms[1];
		  
		  fwrite( $file, $mediumCloudHeight2.PHP_EOL );
		  
		$data = array_push_assoc($data, 'mediumCloudHeight2', $mediumCloudHeight2);
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 
 

// medium cloud height3
	else if( $sms[0]=="mch3"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		 $mediumCloudHeight3 = $sms[1];
		  
		  fwrite( $file, $mediumCloudHeight3.PHP_EOL );
		  
		$data = array_push_assoc($data, 'mediumCloudHeight3', $mediumCloudHeight3);
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 

 // high cloud height1
	
	else if( $sms[0]=="hch1"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $highCloudHeight1 = $sms[1];
		  
		  fwrite( $file, $highCloudHeight1.PHP_EOL );
		  
		  $data = array_push_assoc($data, 'highCloudHeight1', $highCloudHeight1);
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 
 
 // high cloud height2
	
	else if( $sms[0]=="hch2"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $highCloudHeight2 = $sms[1];
		  
		  fwrite( $file, $highCloudHeight2.PHP_EOL );
		  
		  $data = array_push_assoc($data, 'highCloudHeight2', $highCloudHeight2);
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 
 
// high cloud height3
	else if( $sms[0]=="hch3"){
	
	
	   if (is_numeric($sms[1])){
		 
		if(strchr( $sms[1],".") ==false){
	
		  $highCloudHeight3 = $sms[1];
		  
		  fwrite( $file, $highCloudHeight3.PHP_EOL );
		  
		  $data = array_push_assoc($data, 'highCloudHeight3', $highCloudHeight3);
		 
		}
		 else{ array_push($integerError, $sms[0]);}
	   }
		
         else {array_push($characterError, $sms[0]);}		
	  }
 
 
	

  // medium cloud clcode1
	else if( $sms[0]=="mcc1"){

	 
         if (array_key_exists( $sms[1] ,$clcodeM)){
			
                 $mediumCloudClcode1 = $clcodeM[$sms[1]];			
				 
		   fwrite( $file, $mediumCloudClcode1.PHP_EOL );
		   
		   $data = array_push_assoc($data, 'mediumCloudClcode1', $mediumCloudClcode1);
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 		  
	  }

 



// medium cloud clcode2
	else if( $sms[0]=="mcc2"){
 
		  	 
         if (array_key_exists( $sms[1] ,$clcodeM)){
			 
			 $mediumCloudClcode2 = $clcodeM[$sms[1]];
				 
		   fwrite( $file, $mediumCloudClcode2.PHP_EOL );
		   
		 $data = array_push_assoc($data, 'mediumCloudClcode2', $mediumCloudClcode2);
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 		  
	  }

// medium cloud clcode3
	else if( $sms[0]=="mcc3"){
 
         if (array_key_exists( $sms[1] ,$clcodeM)){
			 
			$mediumCloudClcode3 = $clcodeM[$sms[1]];
				 
		   fwrite( $file, $mediumCloudClcode3.PHP_EOL );
		   
		$data = array_push_assoc($data, 'mediumCloudClcode3', $mediumCloudClcode3);
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 		  
	  }
	  
 
	
	
	
 // high cloud clcode1
	else if( $sms[0]=="hcc1"){

		 
		  	 
         if (array_key_exists( $sms[1] ,$clcodeH)){
			 
			$highCloudClcode1 = $clcodeH[$sms[1]];
				 
		   fwrite( $file, $highCloudClcode1.PHP_EOL );
		   
		  $data = array_push_assoc($data, 'highCloudClcode1', $highCloudClcode1);
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		 		  
	  }
 



// high cloud clcode2
	else if( $sms[0]=="hcc2"){

		  	 
         if (array_key_exists( $sms[1] ,$clcodeH)){
			 
			  $highCloudClcode2 = $clcodeH[$sms[1]];
				 
		   fwrite( $file, $highCloudClcode2.PHP_EOL );
		   
		$data = array_push_assoc($data, 'highCloudClcode2', $highCloudClcode2);
		 }
		  
		  else{ array_push($codeError, $sms[0]);}
		  
		 		  
	  }
 
	  
	  

// high cloud clcode3
	else if( $sms[0]=="hcc3"){

		  
         if (array_key_exists( $sms[1] ,$clcodeH)){
			 
			 $highCloudClcode3 = $clcodeH[$sms[1]];
				 
		   fwrite( $file, $highCloudClcode3.PHP_EOL );
		   
		   $data = array_push_assoc($data, 'highCloudClcode3', $highCloudClcode3);
		 }
		  
		  else{ array_push($codeError, $sms[0]);
		  
		 //  array_push($hcc3Error, "wrong value(hcc3)");
		  }
		 		  
	  }
 
	
	

 
  else{ 
	$co++;
	array_push($a, $sms[0]);
	
	}
	

 	// array validation
	 
	
      foreach($check as $key => $value) {
 

	   if (array_key_exists( $key ,$data)){
		
		//echo "Key=" . $key . ", Value=" . $value;
	  }
     else{   $data = array_push_assoc($data, $key , $value); }
     
	   }
	   
	   
	   
	     
	   // date and time ...................
	   
if($Time&&$Date){   
 $date = date("Y-m-d");

$nowDate= date("Y-m-d H:i", time() - date("Z"));


//echo $time;

//echo $date;

$cutTime= rtrim($Time,'Z');

$sentDate = $Date." ".$cutTime;

//echo $timeDate;

$dateTime = strtotime($sentDate)-strtotime($nowDate);

//echo $dateTime;
if($dateTime <=900){
//echo "correct Time";

$data = array_push_assoc($data, 'Time', $Time);

 $data = array_push_assoc($data, 'Date', $Date);
 
  array_push($timeTrue, "t");
  
  array_push($dateTrue, "d");
}
 else{
	 
	 array_push($futureDateError, $dateTime);
	 
 }
	   
}	   
	   
	   
	   
	//echo $co;
	 //if($go){echo $go;}	
	//if($low_cloud){echo "its"+$low_cloud;}	
	//if($high_cloud){echo "to"+ $high_cloud;}	
    // if($a){print_r($a);}

?>
