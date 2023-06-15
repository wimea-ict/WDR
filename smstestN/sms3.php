<?php


/* Getting sender's phone number and message text */
   $senderPhone = $_POST['sender'];
   $messageText = $_POST['text'];
/* Sending a reply SMS. */
/* Setting the HTTP response content type and charset */
  header('Content-Type: text/plain; charset=utf-8');
/* Comment the next line out if you do not want to send a reply */


 
 
 
 
 
 //$senderPhone = "+256758787786";
 
    $phone =substr($senderPhone,4);           
    $userPhone = "0".$phone;
	
	$phoneArray=array();
     
	  include 'phoneDB.php';

 
// $time = "02:41Z";
   
 //$date = date("Y-m-d");

//$date = $Date;

$datetime= new DateTime('now',new DateTimeZone('UTC')); 
  $hour = $datetime->format('H'); 
  if(date('i')>=30){
   $min = "30Z";
  }
  else{
  $min = "00Z";
  }
 
 // $time = "".$hour.":".$min."";
 
  $expectedTime = "".$hour.":".$min."";
  

 
 
 function array_push_assoc($array, $key, $value){
$array[$key] = $value;
return $array;
}


// code errors

$hcc3Error =array();



/* $check= array( 'ddate'=>"",'station'=>"",'userid'=>"", 'ttime'=> "",'device'=>"",'expectedTime' => "" , 'lowCloudType1'=> "", 
            
             'lowCloudType2'=> "", 'windDirection'=>"",'windspeed'=>"",  'recentWeather'=>"", 'trend'=>"" ); 
			 
			 */


 // $sum = count($check);
 
 // ''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''


$check =array( 'windspeed' =>"", 'winddirection' =>"", 'gusting'=>"", 'recentweather'=>"", 'visualrange'=>"", 'pastweather'=>"",'rainrec'=>"", 'presentweather'=>"",
  'pressureChange' =>"", 'otherObservation'=>"", 'vapourPressure'=>"", 'relativeHumidity'=>"", 'heightLowestCloud'=>"", 'Time'=>"",
  'Date' =>"", 'totalAmountClouds'=>"", 'totalAmountLow'=>"", 'alidadeReading'=>"", 'sunDuration'=>"", 'windRun'=>"", 'presentWeatherCode'=>"",
  'pastWeatherCode' =>"", 'isobaricSurface'=>"", 'geoIsobaric'=>"", 'periodPrecipitation'=>"", 'supplementary'=>"", 'maxRead'=>"", 'minRead'=>"",
  'maxReset'=>"", 'minReset'=>"",  'PICHERead'=>"", 'PICHERest'=>"", 'thermo'=>"", 'hygro'=>"", 'rainfall'=>"",  'dryBulb'=>"", 'wetBulb'=>"" ,'attdThermo'=>"",
  'visibility'=>"", 'asRead'=>"", 'correction'=>"", 'clp'=>"", 'mslp'=>"", 'barograph'=>"", 'anemograph'=>"", 'otherMarks'=>"", 'unitWindSpeed'=>"",'grassTemp'=>"",
  'characterIntensit'=>"", 'beginEndPrecipitation'=>"", 'intrumentation'=>"", 'trend'=>"", 'graph'=>"", 'lowCloudType1'=>"", 'lowCloudType2'=>"", 'lowCloudType3'=>"",
  'lowCloudOktas1'=>"", 'lowCloudOktas2'=>"", 'lowCloudOktas3'=>"", 'low_cloudHeight1'=>"", 'low_cloudHeight2'=>"", 'low_cloudHeight3'=>"", 'low_cloudClcode1'=>"",
  'low_cloudClcode2'=>"", 'low_cloudClcode3'=>"", 'mediumCloudType1'=>"", 'mediumCloudType2'=>"", 'mediumCloudType3'=>"", 'highCloudType1'=>"", 'highCloudType2'=>"",
  'highCloudType3'=>"", 'mediumCloudOktas1'=>"", 'mediumCloudOktas2'=>"", 'mediumCloudOktas3'=>"", 'highCloudOktas1'=>"", 'highCloudOktas2'=>"", 'highCloudOktas3'=>"",
  'mediumCloudHeight1'=>"", 'mediumCloudHeight2'=>"", 'mediumCloudHeight3'=>"", 'highCloudHeight1'=>"", 'highCloudHeight2'=>"", 'highCloudHeight3'=>"", 'mediumCloudClcode1'=>"",
  'mediumCloudClcode2'=>"", 'mediumCloudClcode3'=>"", 'highCloudClcode1'=>"", 'highCloudClcode2'=>"", 'highCloudClcode3'=>"",'heightLowestCloud'=>"",
       'device'=>'sms','expectedTime' => $expectedTime);


   $sum = count($check);


//.................................................................................................


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
          
      $Name ="Name:"; $number = "phone Number:"; $stationNam="Station Name:"; $stationNo="Station Number:";  $Region="Region:"; $sub ="Subregion:";

     
        $emailDetails =nl2br("\n".$Name.$namme."\n".$number.$phonne."\n".$stationNam.$StationName."\n".$stationNo.$StationNumber."\n".$Region.$StationRegion."\n".$sub.$subregion."\n");
        

                 //$go2 =nl2br("\n".$Name.$namme."\n".$number.$phonne."\n".$StationName."\n");
                 ;


  // $messageText =   "D(2020-08-11)T(06:10z)lct3(6)";


//$messageText ="D(2020-09-11)T(06:01z)RR(1)PRW(fg)PAW(23)RVR(23)si(67)RW(fg)Gus(23)WD(23)WS(23)RO(23)VP(23)RH(23)HLC(4)SPC(23)TAA(6)TAL(4)CSA(23)SD(06)WR(65)PRC(082)PAC(9)SIS(40)GIS(34)DPP(4)MARD(28)MIRD(22)MART(34)MIRT(43)PRD(23)PRT(45)RF(32)DB(2)WB(32)AT(21)VI(30002)PAR(2345)CO(3)TMB(11)TMA(6)OM(4233)GMT(2300)CIP(42)BEP(24)ITI(09)TD(52)THG(4)LCT1(4)LCT2(3)LCT3(5)LCO1(2)LCO2(5)LCO3(2)LCH1(2)LCH2(1)mch3(4)";

//$messageText ="D(2020-10-15)T(00:00z)RR(30)PRW(RA)PAW(95)RVR(2000)RW(TS)Gus(6)WD(3)WS(33)RO(good)VP(3)RH(9)HLC(10)SPC(2)TAA(8)TAL(5)CSA(3)SD(4)WR(67)PRC(9)PAC(55)SIS(2)GIS(3)DPP(3)MARD(29)MIRD(19)MART(23)MIRT(20)PRD(22)PRT(31)TH(22)HY(11)RF(16)DB(30)WB(22)AT(28)VI(2000)PAR(47)CO(2)TMB(9)TMA(11)OM(clear)GMT(25)CIP(7)BEP(300z)ITI(2)TD(has been rainy so expect heavier rain this evening)THG(sharp 3)LCT1(5)LCT2(2)LCT3(3)LCO1(1)LCO2(2)LCO3(3)LCH1(9000)SI(rained all day)";



  //$messageText ="t(00:00Z)d(2020-10-11)mct1(4)";
 // $messageText ="lct1(5)t(03:34)d(2020-06-08)taa(2)tal(6)mct1(4)rw(hz)hct1(6)";
  //$messageText ="sp*lct1(2)t(01:26Z)d(2020-07-10)";
  //$messageText ="ws(30)td(low)rw(0)hcc1(cc)mct2(50)t(06:21Z)d(20-04-10)hhh(l)";
// Example 1
  
   //mail($emmail,"weatherSMS",$messageText);

	     
  $me2=array();
  $me3=array();
  $message2 = strtolower($messageText);
  
   if(stristr($message2, "sp*")){
	   
	   $me =substr($message2,3);  
	   array_push($me2, $me);
	   $mej = array("Sp"=>"sp");
	   
	   file_put_contents('sp.json', json_encode($mej));
	   
   }
   
   else{
	   
	   array_push($me3, $message2);
   }
   
    if($me2){$message=$me2[0];}
     else { $message = $me3[0]; }
   
  $clcode=array("sc"=>"Sc","st"=>"St","cu"=>"Cu","cb"=>"Cb");
  $clcodeM=array("ac"=>"Ac","as"=>"As","ns"=>"Ns");
  $clcodeH=array("cl"=>"Cl","cc"=>"Cc","cs"=>"Cs");
  $present = array("fg"=>"FG","hz"=>"HZ","ts"=>"TS","ll"=>"LL","br"=>"BR","gr"=>"GR","dz"=>"DZ" ,"ra"=>"RA");
  
  $windspeed =""; $winddirection =""; $gusting=""; $recentweather=""; $visualrange=""; $pastweather="";$rainrec=""; $presentweather="";
  $pressureChange =""; $otherObservation=""; $vapourPressure=""; $relativeHumidity=""; $heightLowestCloud=""; $Time="";
  $Date =""; $totalAmountClouds=""; $totalAmountLow=""; $alidadeReading=""; $sunDuration=""; $windRun=""; $presentWeatherCode="";
  $pastWeatherCode =""; $isobaricSurface=""; $geoIsobaric=""; $periodPrecipitation=""; $supplementary=""; $maxRead=""; $minRead="";
  $maxReset=""; $minReset="";  $PICHERead=""; $PICHERest=""; $thermo=""; $hygro=""; $rainfall="";  $dryBulb=""; $wetBulb=""; $attdThermo="";
  $visibility=""; $asRead=""; $correction=""; $clp=""; $mslp=""; $barograph=""; $anemograph=""; $otherMarks=""; $unitWindSpeed="";$grassTemp="";
  $characterIntensit=""; $beginEndPrecipitation=""; $intrumentation=""; $trend=""; $graph=""; $lowCloudType1=""; $lowCloudType2=""; $lowCloudType3="";
  $lowCloudOktas1=""; $lowCloudOktas2=NULL; $lowCloudOktas3=""; $low_cloudHeight1=""; $low_cloudHeight2=""; $low_cloudHeight3=""; $low_cloudClcode1="";
  $low_cloudClcode2=""; $low_cloudClcode3=""; $mediumCloudType1=""; $mediumCloudType2=""; $mediumCloudType3=""; $highCloudType1=""; $highCloudType2="";
  $highCloudType3=""; $mediumCloudOktas1=""; $mediumCloudOktas2=""; $mediumCloudOktas3=""; $highCloudOktas1=""; $highCloudOktas2=""; $highCloudOktas3="";
  $mediumCloudHeight1=""; $mediumCloudHeight2=""; $mediumCloudHeight3=""; $highCloudHeight1=""; $highCloudHeight2=""; $highCloudHeight3=""; $mediumCloudClcode1="";
  $mediumCloudClcode2=""; $mediumCloudClcode3=""; $highCloudClcode1=""; $highCloudClcode2=""; $highCloudClcode3="";
  $heightLowestCloud="";




$data = array( 'device'=>'sms','expectedTime' => $expectedTime);


 //$sum =0;
 
  $len = count($clcode);
 //file
  $filename = "sms.txt";
   $file = fopen( $filename, "a+" );
    if( $file == false ) {
      //echo ( "Error in opening new file" );
      exit();
   }
   
  $a=array(); 
  $codeError = array();
  $dateError = array();
  $timeError = array();
  $integerError = array();
  $characterError = array();
  $rangeError = array();
  $iddArray = array();
  $webArray =array();
   
   $dateTrue = array();
   $timeTrue = array();
   
    $futureDateError = array();
       
	  
	   
	   
 
  if($phoneArray){
 
    if( substr($message, -1) ==")"){
	 
	 if(strchr( $message,"(")){
   $pieces = explode(")", $message);


   $co =0;


/*$count = count($pieces);
  $sum =$count+5;
*/


$length = count($pieces);
for ($x = 0; $x <$length-1; $x++) {
	
  $sms = explode("(", $pieces[$x] );
  
  
  include 'code.php';
	
	//store unknown values in an array
 

  }
   
	  
	  }
	  else{ echo"you are missing an opening bracket or wrong format ";

        mail($emmail,"weatherSMS","you are missing an opening bracket or wrong format".$emailDetails);



}
   }	
 

  else{ echo " your missing a closing bracket or wrong format ";

 mail($emmail,"weatherSMS","you are missing an closing bracket or wrong format".$emailDetails);

   //echo $emmail;
}
 
  }
  
  
  else{ echo "This number is not registered at the station";

// mail($emmail,"weatherSMS", "This number is not registered at the station");


}
 
 
 
 
 
   fclose( $file );


 
//.......................................station time and date validating file...................................................................................






include 'single.php';

//echo $iddArray[0];
//'''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''






//foreach($data as $x => $val){    echo "Key=" . $x . ", Value=" . $val;}
     
 //general error
 
 
 // input for same rows
 
 
 
 if ($iddArray) { 
 
 
 
 if( substr($message, -1) ==")"){
	 
	 if(strchr( $message,"(")){
   
     
	   if($a|| $codeError||$dateError||$timeError||$integerError||$characterError||$rangeError||!$dateTrue||!$timeTrue||$futureDateError ){

     // echo "Value input error, please type message again!";
       }
	    
		
	else{
	   $dataj = file_get_contents('work.json');
       $json_arr = json_decode($dataj, true);

        $json_arr = $data;
		
		$total = count($json_arr);
		//echo $total;
		//echo $sum;
       
	   if($total==$sum){
        
		$success = file_put_contents('results.json', json_encode($json_arr));
	   
        }
 
        if($phoneArray){
        if( $success){
	

	  // echo "success json";
	   
	   
	   
	   
	     $url = 'http://wimea.mak.ac.ug/wdr/smstestN/update.php';


           $postdata = json_encode($json_arr);

          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
          $result = curl_exec($ch);
          curl_close($ch);
          print_r ($result); 
 
 
	   
	 
        }
    else{ echo "failed results";}
	
	}
   
	
	
	}
	
	
	
	 }
 
   }
 
 
 
    }
 
 
 
  
  if($webArray){
	 
	 echo "already submitted the record with another device";
   

  mail($emmail,"weatherSMS","already submitted the record by another device".$emailDetails);
 } 


 
 
 // input for new rows
 if(!$webArray && !$iddArray){
 
   if( substr($message, -1) ==")"){
	 
	 if(strchr( $message,"(")){
   
      
	   if($a|| $codeError||$dateError||$timeError||$integerError||$characterError||$rangeError ||!$dateTrue||!$timeTrue||$futureDateError){
        
      //echo "Value input error, please type message again!";
       }
	    
		
	else{
	   $dataj = file_get_contents('work.json');
       $json_arr = json_decode($dataj, true);

        $json_arr = $data;
		
		$total = count($json_arr);
		//echo $total;
		//echo $sum;
       
	   if($total==$sum){
        
		$success = file_put_contents('results.json', json_encode($json_arr));
	   
        }
 
        if($phoneArray){
        if( $success){
	

	   //echo "success json";
	   
	   
	   
	   
	     $url = 'http://wimea.mak.ac.ug/wdr/smstestN/jDatabase.php';


           $postdata = json_encode($json_arr);

          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
          $result = curl_exec($ch);
          curl_close($ch);
          print_r ($result); 
 
 
	   
	 
        }
    else{ echo "failed results";}
	
	}
   
	
	
	}
	
	
	
	 }
    }
  

   }
// Example 2
 /*$data = "foo:*:1023:1000::/home/foo:/bin/sh";
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
echo $user; // foo
echo $pass; // *
*/
$long = count($codeError);

$long2 = count($integerError);

$long3 = count($characterError);

$long4 = count($rangeError);

$long5 = count($a);


if($a){echo"invalid code ("; //(".$a[0].")";

for ($s = 0; $s <$long5; $s++) {
  echo $a[$s].","."  ";
  
}
echo")";


   
    }
  
if( $codeError){
	
	
	//echo"wrong value"."(".$codeError[0].",".$codeError[1].")";
	echo"invalid input(";
	
for ($s = 0; $s <$long; $s++) {
  echo $codeError[$s].","."  ";
  
}
echo")";

}
//......................................
if($integerError){
	
	echo"Integer error(";
	
for ($s = 0; $s <$long2; $s++) {
  echo $integerError[$s].","."  ";
  
}
echo")";
	
	
}

//...........................................


if($characterError){
	
	
	
	echo"digit error(";
	
    for ($s = 0; $s <$long3; $s++) {
    echo $characterError[$s].","."  ";

mail($emmail,"digit error",$characterError[$s].$emailDetails);
  
}
echo")";

  



	
	
}

if($rangeError){
	
echo"Value out of range(";
	
    for ($s = 0; $s <$long4; $s++) {
    echo $rangeError[$s].","."  ";
    
   mail($emmail,"Value out of range",$rangeError[$s].$emailDetails);

  
}
echo")";
	
		
	
	
}



if($dateError || !$dateTrue)
{ 

if( substr($message, -1) ==")"){
	 
	 if(strchr( $message,"(")){

 if($phoneArray){
	 
	 if(!$futureDateError){echo"missing or invalide date formate (d)";


   mail($emmail,"futureDateError","missing or invalide date formate (d)".$emailDetails);


}
	 
 }
 
 
	 }
}
 
}

if($timeError || !$timeTrue) { 

 if( substr($message, -1) ==")"){
	 
	 if(strchr( $message,"(")){



if($phoneArray){
	
	if(!$futureDateError){ 
	
	echo"missing or invalide time formate (T)";


   mail($emmail,"futureDateError","missing or invalide time formate (d)".$emailDetails);


}
}

	 }
 }


 }



if($futureDateError){ 

if( substr($message, -1) ==")"){
	 
	 if(strchr( $message,"(")){
		 
		 

echo "Unable to Accept future time";

     mail($emmail,"futureDateError","Unable to Accept future time".$emailDetails);


	 }
	 
  }

}




 ?>
