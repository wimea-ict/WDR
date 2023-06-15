 <?php
require_once 'include/DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);

function getRealIpAddr()
                    {
                        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
                        {
                        $ip=$_SERVER['HTTP_CLIENT_IP'];
                        }
                        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
                        {
                        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                        }
                        else
                        {
                        $ip=$_SERVER['REMOTE_ADDR'];
                        }
                        return $ip;
                    }
 
 
        // receiving the post params
        $requestdata = json_decode(file_get_contents('php://input'), true);
        $requestdata=$requestdata[0];
        //$form_date = strtotime($requestdata['Date']);
        //$date = date('Y-m-d',$form_date);
        $date=$requestdata['Date'];
        $TIME = $requestdata['TIME'];
        $user= $requestdata['O_SubmittedBy'];
        $id = $requestdata['id'];
    
        $station = $requestdata['station'];
       // $stationNumber = $requestdata['station_number'];
        $totalAmountOfAllClouds = intval($requestdata['TotalAmountOfAllClouds']);
        $totalAmountOfLowClouds = intval($requestdata['TotalAmountOfLowClouds']);

        $TypeOfLowClouds1 = intval($requestdata['TypeOfLowClouds1']);
        $OktasOfLowClouds1= intval($requestdata['OktasOfLowClouds1']);
        $HeightOfLowClouds1 = intval($requestdata['HeightOfLowClouds1']);
        $CLCODEOfLowClouds1 = $requestdata['CLCODEOfLowClouds1'];
        $TypeOfLowClouds2 = intval($requestdata['TypeOfLowClouds2']);
        $OktasOfLowClouds2= intval($requestdata['OktasOfLowClouds2']);
        $HeightOfLowClouds2 = intval($requestdata['HeightOfLowClouds2']);
        $CLCODEOfLowClouds2 = $requestdata['CLCODEOfLowClouds2'];
        $TypeOfLowClouds3 = intval($requestdata['TypeOfLowClouds3']);
        $OktasOfLowClouds3= intval($requestdata['OktasOfLowClouds3']);
        $HeightOfLowClouds3 = intval($requestdata['HeightOfLowClouds3']);
        $CLCODEOfLowClouds3 = $requestdata['CLCODEOfLowClouds3'];

        $TypeOfMediumClouds1 = intval($requestdata['TypeOfMediumClouds1']);
        $OktasOfMediumClouds1= intval($requestdata['OktasOfMediumClouds1']);
        $HeightOfMediumClouds1 = intval($_POST['HeightOfMediumClouds1']);
        $CLCODEOfMediumClouds1 = $requestdata['CLCODEOfMediumClouds1'];
        $TypeOfMediumClouds2 = intval($requestdata['TypeOfMediumClouds2']);
        $OktasOfMediumClouds2= intval($requestdata['OktasOfMediumClouds2']);
        $HeightOfMediumClouds2 = intval($requestdata['HeightOfMediumClouds2']);
        $CLCODEOfMediumClouds2 = $requestdata['CLCODEOfMediumClouds2'];
        $TypeOfMediumClouds3 = intval($requestdata['TypeOfMediumClouds3']);
        $OktasOfMediumClouds3= intval($requestdata['OktasOfMediumClouds3']);
        $HeightOfMediumClouds3 = intval($requestdata['HeightOfMediumClouds3']);
        $CLCODEOfMediumClouds3 = $requestdata['CLCODEOfMediumClouds3'];

        $TypeOfHighClouds1 = intval($requestdata['TypeOfHighClouds1']);
        $OktasOfHighClouds1= intval($requestdata['OktasOfHighClouds1']);
        $HeightOfHighClouds1 = intval($requestdata['HeightOfHighClouds1']);
        $CLCODEOfHighClouds1 = $requestdata['CLCODEOfHighClouds1'];
        $TypeOfHighClouds2 = intval($requestdata['TypeOfHighClouds2']);
        $OktasOfHighClouds2= intval($requestdata['OktasOfHighClouds2']);
        $HeightOfHighClouds2 = intval($requestdata['HeightOfHighClouds2']);
        $CLCODEOfHighClouds2 = $requestdata['CLCODEOfHighClouds2'];
        $TypeOfHighClouds3 = intval($requestdata['TypeOfHighClouds3']);
        $OktasOfHighClouds3= intval($requestdata['OktasOfHighClouds3']);
        $HeightOfHighClouds3 = intval($requestdata['HeightOfHighClouds3']);
        $CLCODEOfHighClouds3 = $requestdata['CLCODEOfHighClouds3'];
        
        $CloudSearchLightReading = intval($requestdata['CloudSearchLightReading']);
        $Rainfall= $requestdata['Rainfall'];
        $Dry_Bulb= floatval($requestdata['Dry_Bulb']);
        $Wet_Bulb = floatval($requestdata['Wet_Bulb']);
        $Present_Weather = $requestdata['Present_Weather'];
        $Present_WeatherCode = $requestdata['Present_WeatherCode'];

        $Past_Weather = $requestdata['Past_Weather'];
        $Past_WeatherCode = $requestdata['Past_Weather_code'];
        $Visibility = floatval($requestdata['Visibility']);
        $Wind_Direction = $requestdata['Wind_Direction'];
        $Wind_Speed = $requestdata['Wind_Speed'];
        $Gusting = floatval($requestdata['Gusting']);
        $AttdThermo = floatval($requestdata['AttdThermo']);
        $PrAsRead = floatval($requestdata['PrAsRead']);
        $Correction = floatval($requestdata['Correction']);
        $CLP = $requestdata['CLP'];
        $MSLPr = floatval($requestdata['MSLPr']);
        $gmt_mff = $requestdata['GrassMinTemp'];
        $Max_temp = $requestdata['Max_temp'];
        $Min_temp = $requestdata['Min_temp'];

        $TimeMarksBarograph = floatval($requestdata['TimeMarksBarograph']);
        $TimeMarksAnemoograph = floatval($requestdata['TimeMarksAnemograph']);
       $OtherTMarks = $requestdata['OtherTMarks'];
        $Remarks = $requestdata['Remarks'];
        $DurationOfSunshine=$requestdata['sunduration'];
        $dopop_mff = $requestdata['DurationOfPeriodOfPrecipitation'];

        $UnitOfWindSpeed_mff = $requestdata['UnitOfWindSpeed'];
        $IndOrOmissionOfPrecipitation_mff = $requestdata['IndOrOmissionOfPrecipitation'];
        $TypeOfStation_Present_Past_Weather_mff = $requestdata['TypeOfStation_Present_Past_Weather'];
        $heightOfLowestCloud_mff = $requestdata['HeightOfLowestCloud'];
        $StandardIsobaricSurface_mff= $requestdata['StandardIsobaricSurface'];
        $CI_OfPrecipitation_mff = $requestdata['CI_OfPrecipitation'];
        $BE_OfPrecipitation_mff = $requestdata['BE_OfPrecipitation'];
        $IndicatorOfTypeOfIntrumentation_mff = $requestdata['IndicatorOfTypeOfIntrumentation'];
        $SignOfPressureChange_mff = $requestdata['SignOfPressureChange'];
        $supplementaryinformation_mff= $requestdata['Supp_Info'];
        $VapourPressure_mff = $requestdata['VapourPressure'];
        $thgraph_mff = $requestdata['T_H_Graph'];
        $approved="FALSE";
        $InputType="desktop";
        $metarOrSpeci=$requestdata['speciormetar'];

        $station_id= $db->identifyStationById($station,$stationNumber);

        $datetime= new DateTime('now',new DateTimeZone('UTC')); 
        $hour = $datetime->format('H'); 
          if(date('i')>=30){
           $min = "30Z";
          }
          else{
          $min = "00Z";
          }
        $expected_time = "".$hour.":".$min."";

        $insertObservationSlipFormData=array(
            'Date'=>$date,'station'=>$station,'Userid'=>$id,
            'TotalAmountOfAllClouds'=>$totalAmountOfAllClouds,
            'TotalAmountOfLowClouds'=>$totalAmountOfLowClouds,
            'TIME'=> $TIME,'DeviceType '=> 'desktop',
             'TotalAmountOfAllClouds'=>$totalAmountOfAllClouds,  'TotalAmountOfLowClouds'=> $totalAmountOfLowClouds,
            'TypeOfLowClouds1'=> $TypeOfLowClouds1, 'OktasOfLowClouds1'=> $OktasOfLowClouds1,
            'HeightOfLowClouds1'=>$HeightOfLowClouds1, 'CLCODEOfLowClouds1'=> $CLCODEOfLowClouds1,
            'TypeOfLowClouds2'=> $TypeOfLowClouds2, 'OktasOfLowClouds2'=> $OktasOfLowClouds2,
            'HeightOfLowClouds2'=>$HeightOfLowClouds2, 'CLCODEOfLowClouds2'=> $CLCODEOfLowClouds2,
            'TypeOfLowClouds3'=> $TypeOfLowClouds3, 'OktasOfLowClouds3'=> $OktasOfLowClouds3,
            'HeightOfLowClouds3'=>$HeightOfLowClouds3, 'CLCODEOfLowClouds3'=> $CLCODEOfLowClouds3,
            'TypeOfMediumClouds1'=> $TypeOfMediumClouds1, 'OktasOfMediumClouds1'=> $OktasOfMediumClouds1,
            'HeightOfMediumClouds1'=>$HeightOfMediumClouds1, 'CLCODEOfMediumClouds1'=> $CLCODEOfMediumClouds1,
            'TypeOfMediumClouds2'=> $TypeOfMediumClouds2, 'OktasOfMediumClouds2'=> $OktasOfMediumClouds2,
            'HeightOfMediumClouds2'=>$HeightOfMediumClouds2, 'CLCODEOfMediumClouds2'=> $CLCODEOfMediumClouds2,

            'TypeOfMediumClouds3'=> $TypeOfMediumClouds3, 'OktasOfMediumClouds3'=> $OktasOfMediumClouds3,
            'HeightOfMediumClouds3'=>$HeightOfMediumClouds3, 'CLCODEOfMediumClouds3'=> $CLCODEOfMediumClouds3,

            'TypeOfHighClouds1'=> $TypeOfHighClouds1, 'OktasOfHighClouds1'=> $OktasOfHighClouds1,
            'HeightOfHighClouds1'=>$HeightOfHighClouds1, 'CLCODEOfHighClouds1'=> $CLCODEOfHighClouds1,

            'TypeOfHighClouds2'=> $TypeOfHighClouds2, 'OktasOfHighClouds2'=> $OktasOfHighClouds2,
            'HeightOfHighClouds2'=>$HeightOfHighClouds2, 'CLCODEOfHighClouds2'=> $CLCODEOfHighClouds2,

            'TypeOfHighClouds3'=> $TypeOfHighClouds3, 'OktasOfHighClouds3'=> $OktasOfHighClouds3,
            'HeightOfHighClouds3'=>$HeightOfHighClouds3, 'CLCODEOfHighClouds3'=> $CLCODEOfHighClouds3,

            'CloudSearchLightReading'=> $CloudSearchLightReading,
            'Rainfall'=> $Rainfall, 'Dry_Bulb'=>$Dry_Bulb,'Wet_bulb'=> $Wet_Bulb,
            'Present_Weather'=>$Present_Weather,'Present_WeatherCode'=>$Present_WeatherCode,
            'Past_Weather'=>$Past_Weather,'Past_WeatherCode'=>$Past_WeatherCode,
            'Visibility'=>$Visibility,


            
             'SignOfPressureChange'=>$SignOfPressureChange_mff,
            'Supp_Info'=>$supplementaryinformation_mff, 'VapourPressure'=>$VapourPressure_mff,
             'T_H_Graph'=>$thgraph_mff,

            'SyncStatus'=>'0','EndorsedBy'=>'0','Approved'=>'0','ApprovedBy'=>'0');

            $checkduplicateform = $db->checkforduplicate($date,$station,$TIME,$metarOrSpeci);
             
            if($checkduplicateform != true){
                $fieldsarr=array_keys($insertObservationSlipFormData);
                $fields = implode(",",$fieldsarr);
                $values = "'".implode("','",$insertObservationSlipFormData)."'";
                 

              if(($date!=NULL)|| ($date!='')){
                $insertsuccess= $db->insertData($fields,$values);
                

                if ($insertsuccess){

                    $ip = getRealIpAddr();
                    $data_id = $db->getdataid($date,$station_id,$TIME,$metarOrSpeci);

                    $userlogs = array('Userid' => $id,'Action' => 'Added Observation Slip',
                        'Details' => $user .' added an Observation Slip via Desktop App','data_id'=>$data_id,
                        'IP' =>$ip);
                        $logsarr=array_keys($userlogs);
                        $log_fields = implode(",",$logsarr);
                        $log_values = "'".implode("','",$userlogs)."'";
                        $log = $db->insertUserLogs($log_fields,$log_values);
                    $response["status"]="added";
                    $response["error"] = false;
                    $response["dup_code"] = false;
                    $response["server_msg"] = "New Observation Slip Info added successfully!";
                    echo json_encode($response);
                  }
                }
                else{
                	 $response["status"]="failed";
                    $response["error"] = true;
                    $response["dup_code"] = false;
                    $response["server_msg"] ="Server Error Occurred at WIMEA SERVER";
                    echo json_encode($response);
                }
            }else{
            	 $response["status"]="exists";
                $response["error"] = true;
                $response["dup_code"] = true;
                $response["server_msg"] ="A Record for this time has Already Been Submitted";
                echo json_encode($response);
            }

        
    
    
     /**/


    
    
?>