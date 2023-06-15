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
								$form_date = strtotime($request->ObservationDate);
                                   $date = date('Y-m-d',$form_date);			
                                $id = intval( $request->userid);
                                $station = intval($request->station_id);
								$timeCategory = $request->timeCategory;
								if($timeCategory == "normal"){
                                $normalTime = $request->normalTime;
								}else{
                                $normalTime = $request->speciTime."Z";
								}
			
                               $totalAmountClounds = ($request->totalAmountClounds) ?  intval($request->totalAmountClounds):0 ;
                                $totalLowClounds = ( $request->totalLowClounds) ? intval($request->totalLowClounds):0;
                                 $typeOfLowCloud1 = ( $request->typeOfLowCloud1)? intval($request->typeOfLowCloud1):0;
                                $oktasOfLowCloud1 = ( $request->oktasOfLowCloud1) ? intval($request->oktasOfLowCloud1):0;
                                $heightOflowCloud1 = ( $request->heightOflowCloud1)?intval($request->heightOflowCloud1):0;
								
                                $lowCloudClcode1 = ($request->lowCloudClcode1) ? $request->lowCloudClcode1 : NULL;
				$typeOfLowCloud2 = ($request->typeOfLowCloud2)?intval($request->typeOfLowCloud2):0;
				$oktasOfLowCloud2 = ( $request->oktasOfLowCloud2)?intval($request->oktasOfLowCloud2):0;
                                $heightOflowCloud2 = ( $request->heightOflowCloud2)?intval($request->heightOflowCloud2):0;
                                $lowCloudClcode2 = ( $request->lowCloudClcode2) ? $request->lowCloudClcode2 : NULL;
								$typeOfLowCloud3 = ( $request->typeOfLowCloud3)?intval($request->typeOfLowCloud3):0;
                                 $oktasOfLowCloud3 = ( $request->oktasOfLowCloud3)?intval($request->oktasOfLowCloud3):0;
                                 $heightOflowCloud3 = ( $request->heightOflowCloud3)?intval($request->heightOflowCloud3):0;
								 
                                 $lowCloudClcode3 = ( $request->lowCloudClcode3) ? $request->lowCloudClcode3 : NULL;
                                 $typeOfMediumCloud1 = ($request->typeOfMediumCloud1)?intval($request->typeOfMediumCloud1):0;
                                $oktasOfMediumCloud1 =  ($request->oktasOfMediumCloud1)?intval($request->oktasOfMediumCloud1):0;
                                $heightOfMediumCloud1 = ( $request->heightOfMediumCloud1)?intval($request->heightOfMediumCloud1):0;
                                $MediumCloudClcode1 = ($request->MediumCloudClcode1) ? $request->MediumCloudClcode1 : NULL;
                                 $typeOfMediumCloud2 = ( $request->typeOfMediumCloud2)?intval($request->typeOfMediumCloud2):0;
								 
                                $oktasOfMediumCloud2 = ( $request->oktasOfMediumCloud2)?intval($request->oktasOfMediumCloud2):0;
                                 $heightOfMediumCloud2 = ( $request->heightOfMediumCloud2)?intval($request->heightOfMediumCloud2):0;
                                 $MediumCloudClcode2 =  ( $request->MediumCloudClcode2) ? $request->MediumCloudClcode2 : NULL;
                                  $typeOfMediumCloud3 = ( $request->typeOfMediumCloud3)?intval($request->typeOfMediumCloud3):0;
                                 $oktasOfMediumCloud3 = ( $request->oktasOfMediumCloud3)?intval($request->oktasOfMediumCloud3):0;
                                 $heightOfMediumCloud3 = ( $request->heightOfMediumCloud3)?intval($request->heightOfMediumCloud3):0;
								 
                                $MediumCloudClcode3 = ( $request->MediumCloudClcode3) ? $request->MediumCloudClcode3 : NULL;
                                 $typeOfHighCloud1 = ( $request->typeOfHighCloud1)?intval($request->typeOfHighCloud1):0;
                               $oktasOfHighCloud1 = ( $request->oktasOfHighCloud1)?intval($request->oktasOfHighCloud1):0;
                                $heightOfHighCloud1 = ( $request->heightOfHighCloud1)?intval($request->heightOfHighCloud1):0;
                                $HighCloudClcode1 =  ( $request->HighCloudClcode1) ? $request->HighCloudClcode1 : NULL;
                                 $typeOfHighCloud2 = ( $request->typeOfHighCloud2)?intval($request->typeOfHighCloud2):0;
                                 $oktasOfHighCloud2 = ( $request->oktasOfHighCloud2)?intval($request->oktasOfHighCloud2):0;
								 
                                 $heightOfHighCloud2 = ( $request->heightOfHighCloud2)?intval($request->heightOfHighCloud2):0;
                                 $HighCloudClcode2 = ( $request->HighCloudClcode2) ? $request->HighCloudClcode2 : NULL;
                                  $typeOfHighCloud3 = ( $request->typeOfHighCloud3)?intval($request->typeOfHighCloud3):0;
                                 $oktasOfHighCloud3 = ( $request->oktasOfHighCloud3)?intval($request->oktasOfHighCloud3):0;
                                 $heightOfHighCloud3 = ( $request->heightOfHighCloud3)?intval($request->heightOfHighCloud3):0;
                                 $HighCloudClcode3 =  ($request->HighCloudClcode3) ? $request->HighCloudClcode3 : NULL;
                                 $cloudsearchlight = (( $request->cloudsearchlight)?$request->cloudsearchlight:0);
                                $rainfall = ( $request->rainfall)?$request->rainfall:NULL;
                                $presentweatherCode = ( $request->presentweatherCode)?$request->presentweatherCode:NULL;
                                $presentWeather = ( $request->presentWeather)?$request->presentWeather:NULL;
								$pastWeather =($request->pastWeather)?$request->pastWeather:NULL;
                                $visibility = ( $request->visibility)?$request->visibility:0;
                                $gusting = ( $request->gusting)?$request->gusting:0;
                                $winddirection = ( $request->winddirection)?$request->winddirection:NULL;
                               $windspeed = ( $request->windspeed)?$request->windspeed:NULL;
                               
							    $drybulb = floatval( $request->drybulb)?$request->drybulb:0;
                                $wetbulb = floatval( $request->wetbulb)?$request->wetbulb:0;
                                $attdThermo = ( $request->attdThermo)?$request->attdThermo:0;
                                $correction= ( $request->correction)?$request->correction:0;
                                $prAsRead = ( $request->prAsRead)?$request->prAsRead:0;
                               $clp = ( $request->clp)?$request->clp:NULL;
                                $mslp = ( $request->mslp)?$request->mslp:0;
				$timemarksbarograpgh = ( $request->timemarksbarograpgh)?$request->timemarksbarograpgh:0;
				$timemarksanemograph = ( $request->timemarksanemograph)?$request->timemarksanemograph:0;
								
								$otherTmarks = ( $request->otherTmarks)?$request->otherTmarks:NULL;
								$remarks= ( $request->remarks)?$request->remarks:NULL;
                                $UnitOfWindSpeed = ( $request->UnitOfWindSpeed)?$request->UnitOfWindSpeed:NULL;
                                
								
                                $IndorOmissionOfprecipitation = ( $request->IndorOmissionOfprecipitation)?$request->IndorOmissionOfprecipitation:NULL;
                                $typeOfstationPresentPastWeather = ( $request->typeOfstationPresentPastWeather)?$request->typeOfstationPresentPastWeather:NULL;
                                $heightOfLowestCloud =($request->heightOfLowestCloud)?$request->heightOfLowestCloud:NULL;
                                $isobaricsurface =( $request->isobaricsurface)?$request->isobaricsurface:NULL;
                                $GeopotentialOfStandardisobaricsurface =( $request->GeopotentialOfStandardisobaricsurface)?$request->GeopotentialOfStandardisobaricsurface:NULL;
                                $durationOfPrecipitation =($request->durationOfPrecipitation)?$request->durationOfPrecipitation:NULL;
                                $grassMinimumtemperature = ( $request->grassMinimumtemperature)?$request->grassMinimumtemperature:NULL;
                                $characterAndIntensityOfPrecipitation = ( $request->characterAndIntensityOfPrecipitation)?$request->characterAndIntensityOfPrecipitation:NULL;
                                $beginningorEndOfPrecipitation = ( $request->beginningorEndOfPrecipitation)?$request->beginningorEndOfPrecipitation:NULL;
                                $IndicatorOfTypeOfIntrumentation = ( $request->IndicatorOfTypeOfIntrumentation)?$request->IndicatorOfTypeOfIntrumentation:NULL;
                                $signOfPressureChange = ( $request->signOfPressureChange)?$request->signOfPressureChange:NULL;
                                $SupplementaryInformation = ( $request->SupplementaryInformation)?$request->SupplementaryInformation:NULL;
                                $vapourPressure = ( $request->vapourPressure)?$request->vapourPressure:NULL;
								
								$sunshine = ( $request->sunshine)?$request->sunshine:NULL;
								$max_temp = ( $request->max_temp)?$request->max_temp:0;
								$min_temp = ( $request->min_temp)?$request->min_temp:0;
								 $submittedBy = $request->fname . " " . $request->lname;  
								
     
								}
								$sql = "INSERT INTO `observationslip` (`id`, `Date`, `Userid`, `station`,`TIME`,`TotalAmountOfAllClouds`,`TotalAmountOfLowClouds`,`TypeOfLowClouds1`, `OktasOfLowClouds1`,`HeightOfLowClouds1`,`CLCODEOfLowClouds1`
                                                                 , `TypeOfLowClouds2`, `OktasOfLowClouds2`, `HeightOfLowClouds2`,`CLCODEOfLowClouds2`,`TypeOfLowClouds3`, `OktasOfLowClouds3`, `HeightOfLowClouds3`,
								`CLCODEOfLowClouds3`, `TypeOfMediumClouds1`,`OktasOfMediumClouds1`, `HeightOfMediumClouds1`, 
								`CLCODEOfMediumClouds1`, `TypeOfMediumClouds2`, `OktasOfMediumClouds2`,  `HeightOfMediumClouds2`, 
								 `CLCODEOfMediumClouds2`, `TypeOfMediumClouds3`, `OktasOfMediumClouds3`, `HeightOfMediumClouds3`,
								 `CLCODEOfMediumClouds3`, `TypeOfHighClouds1`, `OktasOfHighClouds1`, `HeightOfHighClouds1`,
								 `CLCODEOfHighClouds1`, `TypeOfHighClouds2`,`OktasOfHighClouds2`, `HeightOfHighClouds2`, 
								 `CLCODEOfHighClouds2`, `TypeOfHighClouds3`, `OktasOfHighClouds3`, `HeightOfHighClouds3`,
								`CLCODEOfHighClouds3`,`CloudSearchLightReading`, `Rainfall`, `Dry_Bulb`, `Wet_Bulb`, `Present_Weather`, 
													`Present_WeatherCode`, `Past_Weather`,`Visibility`, `Wind_Direction`, `Wind_Speed`, `Gusting`,
													`AttdThermo`, `PrAsRead`,`Correction`, `CLP`, `MSLPr`, `TimeMarksBarograph`,`TimeMarksAnemograph`, 
								 `OtherTMarks`, `Remarks`,`UnitOfWindSpeed`, `IndOrOmissionOfPrecipitation`, `TypeOfStation_Present_Past_Weather`, 								 
								 `HeightOfLowestCloud`, `StandardIsobaricSurface`, `GPM`, `DurationOfPeriodOfPrecipitation`, `GrassMinTemp`, 
								 `CI_OfPrecipitation`, `BE_OfPrecipitation`,`IndicatorOfTypeOfIntrumentation`, `SignOfPressureChange`, `Supp_Info`, `VapourPressure`,`DeviceType`, `sunduration`, `Min_temp`, `Max_temp`,`speciormetar`, `O_SubmittedBy`)
								VALUES (NULL, '".$date."', '".$id."', '".$station."', '".$normalTime."', '".$totalAmountClounds."','".$totalLowClounds."', '".$typeOfLowCloud1."', '".$oktasOfLowCloud1."', '".$heightOflowCloud1."', '".$lowCloudClcode1 ."'
                                                                 ,'".$typeOfLowCloud2."','".$oktasOfLowCloud2."','".$heightOflowCloud2."', '".$lowCloudClcode2."' ,'".$typeOfLowCloud3."', '".$oktasOfLowCloud3."','".$heightOflowCloud3."','".$lowCloudClcode3."', 
								'".$typeOfMediumCloud1."', '".$oktasOfMediumCloud1."', '".$heightOfMediumCloud1."', '".$MediumCloudClcode1."', '".$typeOfMediumCloud2."','".$oktasOfMediumCloud2."','".$heightOfMediumCloud2."',
								 '".$MediumCloudClcode2."','".$typeOfMediumCloud3."', '".$oktasOfMediumCloud3."','".$heightOfMediumCloud3."', '".$MediumCloudClcode3."',  '".$typeOfHighCloud1."', '".$oktasOfHighCloud1."', '".$heightOfHighCloud1."',
								 '".$HighCloudClcode1."', '".$typeOfHighCloud2."','".$oktasOfHighCloud2."','".$heightOfHighCloud2."', '".$HighCloudClcode2."','".$typeOfHighCloud3."', '".$oktasOfHighCloud3."','".$heightOfHighCloud3."',
										 '".$HighCloudClcode3."', '".$cloudsearchlight."', '".$rainfall."', '".$drybulb."', '".$wetbulb."',
										 '".$presentWeather."', '".$presentweatherCode."','".$pastWeather."','".$visibility."',
										 '".$winddirection."', '".$windspeed."','".$gusting."', '".$attdThermo."','".$prAsRead."','".$correction."','".$clp."','".$mslp."',
										 '".$timemarksbarograpgh."','".$timemarksanemograph."','".$otherTmarks."','".$remarks."', '".$UnitOfWindSpeed."',
										 '".$IndorOmissionOfprecipitation ."', '".$typeOfstationPresentPastWeather."', '".$heightOfLowestCloud."',
										 '".$isobaricsurface."','".$GeopotentialOfStandardisobaricsurface."', '".$durationOfPrecipitation."','".$grassMinimumtemperature."',
										 '".$characterAndIntensityOfPrecipitation."','".$beginningorEndOfPrecipitation."',
										 '".$IndicatorOfTypeOfIntrumentation."','".$signOfPressureChange."','".$SupplementaryInformation."','".$vapourPressure."','mobile'
                                                                                   ,'".$sunshine."','".$min_temp."','".$max_temp."','".$timeCategory."',  '".$submittedBy."' )";
							
								if(mysqli_query($con, $sql)){

												$response= "Data inserted successfully";

								} else {

								   $response= "Error: " . $sql  ;

								}

								 echo json_encode($response);

?>