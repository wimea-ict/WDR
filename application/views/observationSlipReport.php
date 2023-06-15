<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userregion= $session_data['UserRegion'];
$usersubregion= $session_data['UserSubRegion'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
// $datename = cal_days_in_month ( int $calendar , int $month , int $year ) ;
?>
    <aside class="right-side" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1>
                Observation Slip Report
                <small> Page</small>
            </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Observation Slip Report</li>

        </ol>
    </section>
    

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
        <?php if(!isset($reportonly)){ ?>
            <form autocomplete="off" action="<?php echo base_url(); ?>index.php/ReportsController/displayobservationslipreport/" method="post" enctype="multipart/form-data">
                 
                <?php  if($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){?>

                   

                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php 
            }
                elseif($userrole=='Manager' || $userrole=='ManagerData' || $userrole=="ManagerStationNetworks" || $userrole=='WeatherAnalyst'){
                    ?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Region</span>
                                <select name="RegionName" id="regions"  required class="form-control" placeholder="Select Region">
                                <option value="">--Select REGION--</option>
                                    <?php
                                    if($regions->num_rows()>0){
                                        foreach($regions->result() as $row){
                                    ?>
                                     <option value="<?php echo $row->region; ?>"><?php echo $row->region; ?></option>
                                    <?php 
                                            }
                                        }
                                    ?> 
                                 </select> 
                                </div>
                            </div>
                        </div>
                    <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Sub region</span>
                            <select  name="subregion" class="form-control"  id="subregions-list"
                              required selected="selected" required>
                              <option value="">-- Select Sub region--</option>
                                <option id="subregions-list" > </option>
                                
                            </select>
                        </div>
                    </div>
                  </div>
                  <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">

                            <span class="input-group-addon">Station</span>
                            <select  name="station" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select>
                        </div>
                    </div>
                </div>

        
                 <?php
                         }
                         elseif($userrole== "ZonalOfficer"){

                            ?>
                       <div class="col-xs-3">
                           <div class="form-group">
                               <div class="input-group">
                                   <span class="input-group-addon">Region</span>
                                   <input type="text" name="RegionName" class="form-control" value="<?php echo $userregion;?>" readonly id="zonalRegion">
                                   </div>
                               </div>
                           </div>
                           <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Sub region</span>
                           
                            
                               <?php if($usersubregion==NULL){?>
                                <select  name="subregion" class="form-control"  id="subregions-list"
                               selected="selected" required>
                                <option value="">-- Select Sub region--</option>
                                <?php
                                    if($subregions->num_rows()>0){
                                        foreach($subregions->result() as $row){
                                      if($row->region==$userregion){
                                    ?>
                                     <option value="<?php echo $row->subregion; ?>"><?php echo $row->subregion; ?></option>
                                    <?php 
                                     } }
                                        }
                                ?> 
                                
                               <?php }else{?> 
                                <select  name="subregion" class="form-control"  id="subregions-list"
                                 selected="selected" required disabled>
                                <option value="" ><?php echo $usersubregion ?> </option>
                               <?php } ?>
                            </select>
                          
                        </div>
                    </div>
                  </div>
                       <div class="col-xs-3">
                       <div class="form-group">
                           <div class="input-group">
   
                               <span class="input-group-addon">Station</span>
                               <select  name="station" class="form-control"  id="stations-list"
                                 required selected="selected">
                                 <option value="">-- Select Station--</option>
                                   <option id="stations-list" > </option>
                                   
                               </select>
                           </div>
                       </div>
                   </div>
   
                <?php } elseif($userrole== "SeniorZonalOfficer"){
   
                  ?>
           <div class="col-xs-3">
           <div class="form-group">
           <div class="input-group">
               <span class="input-group-addon">Region</span>
               <select name="RegionName" id="regions"  required class="form-control" placeholder="Select Region">
               <option value="">--Select REGION--</option>
                       <?php  $regions= explode(',',$userregion);
                       for($i=0;$i<count($regions);$i++){   
                       
                   ?>
                <option value="<?php echo $regions[$i]; ?>"><?php echo $regions[$i]; ?></option>
              <?php  
              } ?>
       </select>
          </div>
      </div>
   </div>
   <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Sub region</span>
                            <select  name="subregion" class="form-control"  id="subregions-list"
                              required selected="selected" required>
                              <option value="">-- Select Sub region--</option>
                                <option id="subregions-list" > </option>
                                
                            </select>
                        </div>
                    </div>
                  </div>
   <div class="col-xs-3">
   <div class="form-group">
   <div class="input-group">
   
      <span class="input-group-addon">Station</span>
      <select  name="station" class="form-control"  id="stations-list"
        required selected="selected">
        <option value="">-- Select Station--</option>
          <option id="stations-list" > </option>
          
      </select>
   </div>
   </div>
   </div>
   
   <?php } ?>
   
                <?php if($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){ ?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value="monthly_rainfall_report" >

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNoOC" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php }elseif($userrole=='Manager' || $userrole=='ManagerData' || $userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer" || $userrole=="ManagerStationNetworks" ||  $userrole=="WeatherAnalyst" ){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value="monthly_rainfall_report" >

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNoManager"  id="stationNoManager" required class="form-control" value=""  readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }?>
                 <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Select Date</span>
                            <input type="text" name="date" id="date" class="form-control summonth" placeholder="select the date" autocomplete="off" >
                        </div>
                    </div>
                </div>
 <!--                  <div class="col-xs-6">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Date</span>
                            <input value="" autocomplete="false" type="text" name="date" id="reportrange" class="form-control metaryear" >
                            <input type="hidden" name="startdate" id="startdate">
                            <input type="hidden" name="enddate" id="enddate" >
                            <!--<input type="text" value="hello"name="birthday" class="form-control metaryear">
                           
                            
                        </div>
                        
                    </div>
                </div> --> 

                <div class="col-xs-3">
                    <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" >Select Time</span>
            <div class="input-group timepicker">
             <input id="timepicker2" type="text" name="ObservationSlipTime" id="time_observationslipform"  class="form-control" autocomplete="off">

           </div>
           <script>
            $(document).ready(function(){
                      $('#timepicker2').timepicker({
                           format:"HH:mm"
                       });
                       $('.clock-rm').click(function(){
                           $('#timepicker2').val('');
                       });

            });

            
      </script>
           <span class="input-group-addon clock-rm"><i class="glyphicon glyphicon-time"></i></span>
         </div>
              </div>
                </div>

               
                <div class="col-xs-2">
                    <input type="submit" name="generateobservationslipreport_button" id="generateobservationslipreport_button" class="btn btn-primary" value="Generate report" >
                </div>

            </form>

    <?php } ?>

    </div>
    </div>











    <?php require(APPPATH . 'views/error.php'); ?>  

<?php
if(is_array($displayObservationSlipReportHeaderFields) &&
    
    is_array($observationslipdataforspecifictimeofaday) &&
    !empty($observationslipdataforspecifictimeofaday)){

   $numbers="1234";
    $resi=str_split($numbers);
    //$ff=rsort($resi);
   //echo $ff;
// $day= $displayObservationSlipReportHeaderFields['day'];
    $timeInZoo= $displayObservationSlipReportHeaderFields['TimeInZoo'];
    $date= $displayObservationSlipReportHeaderFields['date'];
    $stationName=$displayObservationSlipReportHeaderFields['stationName'];
    $stationNumber=$displayObservationSlipReportHeaderFields['stationNumber'];
    $blocknumber=$displayObservationSlipReportHeaderFields['blocknumber'];
    $region=$displayObservationSlipReportHeaderFields['StationRegion'];

    ?>
    <h3>Form No.393(Rev.9/2015)</h3>
    <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
    <span><strong><h3>FORM OBS001 OBSERVATION SLIP</h3></strong></span>&nbsp;&nbsp;
    <br>
    <span><strong>Station</strong></span><span class="dotted-line"><?php echo $stationName;?></span>
    <span> &nbsp;&nbsp;&nbsp; </span>
    <span><strong>Station Number</strong></span><span class="dotted-line"><?php echo "".$blocknumber."".$stationNumber."";?></span>
    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
    <span><strong>TIME</strong></span><span class="dotted-line"><?php echo $timeInZoo;?></span>
    <span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><strong>DATE</strong></span> <span class="dotted-line"><?php echo $date;?></span>

     <div class="col-lg-2"  style="float: right; margin-top: -14%; width: 200px;">
                <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
        <?php if(strcmp('Senior Weather Observer',$userrole)==0){ if($exists!=1){ ?>
            <form style="margin-right:140px;" action="<?php echo base_url(); ?>index.php/ReportsController/displayobservationslipreport/" method="post">
            <input type="hidden"  name="date" value="<?php echo $date;?>"/>
            <input type="hidden"  name="ObservationSlipTime" value="<?php echo $timeInZoo;?>"/>
            <input type="hidden"  name="month" value=""/>
            <input type="hidden"  name="year" value=""/>
            <input type="hidden"  name="stationOC" value="<?php echo $stationName;?>"/>
            <input type="hidden"  name="stationNoOC" value="<?php echo $stationNumber;?>"/>
            <input type="hidden"  name="reporttype" value="observationslip"/>
            <button  type="submit" name="sendreporttozone" class="btn btn-info btn-xs no-print"  data-export="export"><i class="fa fa-print"></i> Send Report to Region</button>
          </form>
        <?php }else{ ?>
          <p style="color:green;"><i class="fa fa-check"> </i>Report sent</p>
        <?php } }if(strcmp('SeniorZonalOfficer',$userrole)==0||strcmp('ZonalOfficer',$userrole)==0){ 
            if(isset($reportonly)){ 
          foreach($reportrecord->result() as $reportrecod)  {
              
              if(strcmp($reportrecod->forwardtomanager,"False")==0){
        ?>
           <form style="margin-right:140px;" action="<?php echo base_url(); ?>index.php/ReportsController/displayobservationslipreport/" method="post">
            <input type="hidden"  name="forward" value="True"/>
            
            <!-- <input type="hidden"  name="RegionName" value="Central"/> -->
            <input type="hidden"  name="station" value="<?php echo $stationName;?>"/>
            <input type="hidden"  name="stationNoManager" value="<?php echo $stationNumber;?>"/>
            <input type="hidden"  name="date" value="<?php echo $reportrecod->date;?>"/>
            <input type="hidden"  name="ObservationSlipTime" value="<?php echo $reportrecod->time;?>"/>
            <input type="hidden"  name="record_id" value="<?php echo $reportrecod->id; ?>"/>
            <button  type="submit" name="sendreporttomanager" class="btn btn-info btn-xs no-print"  data-export="export"><i class="fa fa-print"></i> Send Report to manager</button>
           </form>
        <?php }else{ ?>
            <p style="color:green;"><i class="fa fa-check"> </i>Report sent</p>
        <?php } } } }?>
        </div>

    <div class="clearfix"></div>


    <br>
    <?php
    $count = 0;

    foreach($observationslipdataforspecifictimeofaday as $data){
        $count++;
        $observationslipid = $data->id;

        ?>
        <form action="<?php echo base_url(); ?>index.php/ReportOCIssues/sendData/" method="post" >

        <table class="report-table" id="table2excel">

            <table class="report-table">

                <tr>
                    <td class="main" colspan="12">
                        Total amount of all clouds <span class="dotted-line"><?php echo $data->TotalAmountOfAllClouds;?> Oktas </span>
                    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

                    Total amount of low clouds <span class="dotted-line"><?php echo $data->TotalAmountOfLowClouds;?>  Oktas</span>
                    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>

                     </td>
                </tr>

                <tr>

                    <td class="main" colspan="4">LOW</td>

                    <td class="main" colspan="4">MEDIUM</td>

                    <td class="main" colspan="4">HIGH</td>


                </tr>

                <tr>
                    <td class="main">Type</td>
                    <td class="main">Oktas</td>
                    <td class="main">Height</td>
                    <td class="main">CL CODE</td>


                    <td class="main">Type</td>
                    <td class="main">Oktas</td>
                    <td class="main">Height</td>
                    <td class="main">CL CODE</td>


                    <td class="main">Type</td>
                    <td class="main">Oktas</td>
                    <td class="main">Height</td>
                    <td class="main">CL CODE</td>

                </tr>

                <tr>
                    <td class="main"><?php echo $data->TypeOfLowClouds1;?></td>
                    <td class="main"><?php echo $data->OktasOfLowClouds1;?></td>
                    <td class="main"><?php echo $data->HeightOfLowClouds1;?></td>
                    <td class="main"><?php echo $data->CLCODEOfLowClouds1;?></td>


                    <td class="main"><?php echo $data->TypeOfMediumClouds1;?></td>
                    <td class="main"><?php echo $data->OktasOfMediumClouds1;?></td>
                    <td class="main"><?php echo $data->HeightOfMediumClouds1;?></td>
                    <td class="main"><?php echo $data->CLCODEOfMediumClouds1;?></td>

                    <td class="main"><?php echo $data->TypeOfHighClouds1;?></td>
                    <td class="main"><?php echo $data->OktasOfHighClouds1;?></td>
                    <td class="main"><?php echo $data->HeightOfHighClouds1;?></td>
                    <td class="main"><?php echo $data->CLCODEOfHighClouds1;?></td>

                </tr>

               <tr>
                   <td class="main"><?php echo $data->TypeOfLowClouds2;?></td>
                   <td class="main"><?php echo $data->OktasOfLowClouds2;?></td>
                   <td class="main"><?php echo $data->HeightOfLowClouds2;?></td>
                   <td class="main"><?php echo $data->CLCODEOfLowClouds2;?></td>


                   <td class="main"><?php echo $data->TypeOfMediumClouds2;?></td>
                   <td class="main"><?php echo $data->OktasOfMediumClouds2;?></td>
                   <td class="main"><?php echo $data->HeightOfMediumClouds2;?></td>
                   <td class="main"><?php echo $data->CLCODEOfMediumClouds2;?></td>

                   <td class="main"><?php echo $data->TypeOfHighClouds2;?></td>
                   <td class="main"><?php echo $data->OktasOfHighClouds2;?></td>
                   <td class="main"><?php echo $data->HeightOfHighClouds2;?></td>
                   <td class="main"><?php echo $data->CLCODEOfHighClouds2;?></td>

               </tr>

            <tr>
                <td class="main"><?php echo $data->TypeOfLowClouds3;?></td>
                <td class="main"><?php echo $data->OktasOfLowClouds3;?></td>
                <td class="main"><?php echo $data->HeightOfLowClouds3;?></td>
                <td class="main"><?php echo $data->CLCODEOfLowClouds3;?></td>


                <td class="main"><?php echo $data->TypeOfMediumClouds3;?></td>
                <td class="main"><?php echo $data->OktasOfMediumClouds3;?></td>
                <td class="main"><?php echo $data->HeightOfMediumClouds3;?></td>
                <td class="main"><?php echo $data->CLCODEOfMediumClouds3;?></td>

                <td class="main"><?php echo $data->TypeOfHighClouds3;?></td>
                <td class="main"><?php echo $data->OktasOfHighClouds3;?></td>
                <td class="main"><?php echo $data->HeightOfHighClouds3;?></td>
                <td class="main"><?php echo $data->CLCODEOfHighClouds3;?></td>

            </tr>

                <tr>

                    <td class="main" colspan="6">Cloud Searchlight Alidade Reading
                        <span class="dotted-line"><?php echo $data->CloudSearchLightReading;?> </span>
                    </td>

                    <td class="main" colspan="6">Rainfall(mm)
                        <span class="dotted-line"><?php echo $data->Rainfall;?> </span>
                    </td>
                </tr>

              </table>
                <br><br>

        <table class="report-table">

            <tr>
                <td class="main" rowspan="2">Dry Bulb</td>
                <td class="main" rowspan="2">Wet Bulb</td>

                <td class="main" colspan="2">Max</td>

                <td class="main" colspan="2">Min</td>

                <td class="main" colspan="2">Piche</td>

                <td class="main" colspan="3">Time Marks</td>

            </tr>

            <tr>

                <td class="main">Read</td>
                <td class="main">Reset</td>


                <td class="main">Read</td>
                <td class="main">Reset</td>


                <td class="main">Read</td>
                <td class="main">Reset</td>


                <td class="main">Thermo</td>
                <td class="main">Hygro</td>
                <td class="main">Rain Rec.</td>

            </tr>

            <tr>

                <td class="main"><?php echo $data->Dry_Bulb;?></td>
                <td class="main"><?php echo $data->Wet_Bulb;?></td>

                <td class="main"><?php echo $data->Max_Read;?></td>
                <td class="main"><?php echo $data->Max_Reset;?></td>


                <td class="main"><?php echo $data->Min_Read;?></td>
                <td class="main"><?php echo $data->Min_Reset;?></td>

                <td class="main"><?php echo $data->Piche_Read;?></td>
                <td class="main"><?php echo $data->Piche_Reset;?></td>


                <td class="main"><?php echo $data->TimeMarksThermo;?></td>
                <td class="main"><?php echo $data->TimeMarksHygro;?></td>
                <td class="main"><?php echo $data->TimeMarksRainRec;?></td>

            </tr>
        </table>
                <br><br>

            <table class="report-table">

                <tr>
                    <td class="main" rowspan="2">Present Weather</td>
                    <td class="main" rowspan="2">Visibility</td>



                    <td class="main" colspan="2">Wind</td>

                    <td class="main" rowspan="2">Gusting(Kts)</td>
					<!-- <td class="main" colspan="2">Temperature(°C)</td> -->
					
                </tr>


                <tr>
                    <td class="main">Direction</td>
                    <td class="main">Speed (Kts)</td>
					 <!-- <td class="main">Max</td> -->
                    <!-- <td class="main">Min</td> -->

                </tr>

                <tr>

                    <td class="main"><?php echo $data->Present_Weather;?></td>

                    <td class="main"><?php echo $data->Visibility;?></td>

                    <td class="main"><?php echo $data->Wind_Direction;?></td>
                    <td class="main"><?php echo $data->Wind_Speed;?></td>

                    <td class="main"><?php echo $data->Gusting;?></td>
					<!-- <td class="main"><?php echo $data->Max_temp;?></td> -->

                    <!-- <td class="main"><?php echo $data->Min_temp;?></td> -->

                </tr>
            </table>

            <br>
                <br>

            <table class="report-table">
                <tr>
                    <td class="main">Attd.Thermo.(&deg;C)</td>
                    <td class="main"><?php echo $data->AttdThermo;?></td>


                    <td class="main" colspan="2">Time Marks</td>

                    <td class="main" colspan="2">Other T/Marks</td>
                </tr>


                <tr>
                    <td class="main">Pr.As Read(mbs)</td>
                    <td class="main"><?php echo $data->PrAsRead;?></td>


                    <td class="main">Barograph</td>

                    <td class="main">Anemograph</td>

                    <td class="main" rowspan="2"><?php echo $data->OtherTMarks;?></td>
                </tr>


                <tr>
                    <td class="main">Correction(mb)</td>
                    <td class="main"><?php echo $data->Correction;?></td>


                    <td class="main"><?php echo $data->TimeMarksBarograph;?></td>

                    <td class="main"><?php echo $data->TimeMarksAnemograph;?></td>

                    <!-- <td class="main" rowspan="3"><?php echo $data->OtherTMarks;?></td> -->
                </tr>


                <tr>
                    <td class="main">C.L.P(mb)</td>
                    <td class="main"><?php echo $data->CLP;?></td>
                    <td class="main" colspan="3">Remarks or any other Observations</td>


                </tr>

                <tr>
                    <td class="main">M.S.L.Pr(mb)</td>
                    <td class="main"><?php echo $data->MSLPr;?></td>


                    <td class="main " colspan="3"><?php echo $data->Remarks;?></td>


                </tr>
            </table>
        </table>
         <?php
                }
    ?>

    <br><br><br>
    <span><strong>Data Status</strong></span><span class="dotted-line"><?php  if ($data->Approved=="FALSE"){echo "Not Approved";}else{echo "Approved "."&nbsp;"."By"."&nbsp;".$data->ApprovedBy;}?></span>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>Observer's Name</strong></span> <span class="dotted-line"><?php echo $data->O_SubmittedBy;?></span>
	<?php if($data->Endorsed == "ENDORSE"){?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>Endorsement Status</strong></span> <span class="dotted-line"><?php echo "Endorsed by"."&nbsp;".$data->EndorsedBy;?></span></br></br>	
	<?php } ?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>WDR  Report Generated By</strong></span> <span class="dotted-line"><?php echo $name;?></span>
   <input type="hidden"  name="date" value="<?php echo $data->Date;?>"/>
   <input type="hidden"  name="time" value="<?php echo $data->TIME;?>"/>
   <input type="hidden"  name="stationName" value="<?php echo $data->StationName;?>"/>
   <input type="hidden"  name="stationNumber" value="<?php echo $data->StationNumber;?>"/>
   <input type="hidden"  name="reporttype" value="observationslip"/>

    <br><br><br>
    <button onClick="print();return false;" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print Report</button>
    <button onClick="return false;" id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
    <button onClick=return false;" id="exportcsv" class="btn btn-primary no-print"  data-export="export"><i class="fa fa-print"></i> Export to csv</button>
    <?php if ($userrole=='Senior Weather Observer'){ ?>
         
    <?php } else{ ?>
    <button  id="reportIssue" type="submit" class="btn btn-primary no-print" style="margin-left:150px;"  ><i class="fa fa-envelope-o"></i> Report Issues to OC</button>
     
<?php  } ?>
    <a href="<?php echo base_url()."index.php/ObservationSlipReport/"; ?>" class="btn btn-danger pull-right no-print"><i class="fa fa-times"></i> Close report</a>
    <div class="clearfix"></div>
    <br><br></form>

          

<?php }elseif(is_array($displayObservationSlipReportHeaderFields) &&
    count($displayObservationSlipReportHeaderFields) &&
    is_array($observationslipdataforspecifictimeofaday) &&
    empty($observationslipdataforspecifictimeofaday)){


    // $day= $displayObservationSlipReportHeaderFields['day'];
    $timeInZoo= $displayObservationSlipReportHeaderFields['TimeInZoo'];
    $date= $displayObservationSlipReportHeaderFields['date'];
    $stationName=$displayObservationSlipReportHeaderFields['stationName'];
    $stationNumber=$displayObservationSlipReportHeaderFields['stationNumber'];



    ?>


    <center>
        <?php echo "No Observation Slip Report Data Yet for ".$stationName.' '.'Date'.' '.$date. ' '.'And Time   '.$timeInZoo.' '.'From the DB'; ?>
    </center>


<?php } ?>


    </section><!-- /.content -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    <!-- jQuery 2.0.2
     <script src="js/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>


    <script> 
    $(document).ready(function() {
     getStationID();
     
     var zonalRegion = $('#zonalRegion').val();
       if(zonalRegion != ""){
          $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxRegionRequest",
            data:{ 
                region:zonalRegion
            },

            success:function(response){
             console.log(response);
             var jsondata = JSON.stringify(response);
             console.log(jsondata);

            //$array = json_decode($_POST['jsondata']);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;
             $('#stations-list').empty();
             for (var i = 0; i < arrayLength; i++) {
              var station = stations[i]['StationName'];
              console.log(station);

              var o = new Option("option text", station);
              $(o).html(station);
              $('#stations-list').append(o);
              getStationID();
          }

      },
      error: function() {
        alert("Invalide query");
    },
    dataType: 'text'
});


}

     $('#regions').change(function(){
        var selected_region = $('#regions').val();

        $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxRegionRequest",
            data:{ 
                region:selected_region 
            },

            success:function(response){
             console.log(response);
             var jsondata = JSON.stringify(response);
             console.log(jsondata);

            //$array = json_decode($_POST['jsondata']);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;
             $('#stations-list').empty();
             for (var i = 0; i < arrayLength; i++) {
              var station = stations[i]['StationName'];
              console.log(station);

              var o = new Option("option text", station);
              $(o).html(station);
              $('#stations-list').append(o);
              getStationID();
              }


      },
      error: function() {
        alert("Invalide query");
    },
    dataType: 'text'
     });
     $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxSubRegionRequest",
            data:{ 
                region:selected_region 
            },

            success:function(response){
             console.log(response);
             var jsondata = JSON.stringify(response);
             console.log(jsondata);

            //$array = json_decode($_POST['jsondata']);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;
              $('#subregions-list').empty();
             for (var i = 0; i < arrayLength; i++) {
              var subregion = stations[i]['subregion'];
              console.log(subregion);

              var o = new Option("option text", subregion);
              $(o).html(subregion);
              $('#subregions-list').append(o);
              getStationID();
              }


      },
      error: function() {
        alert("Invalide query");
    },
    dataType: 'text'
     });
    });



    $('#subregions-list').change(function(){
        var selected_region = $('#regions').val();
        var selected_subregion = $('#subregions-list').val();

        $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxStationRequest",
            data:{ 
                region:selected_region , subregion:selected_subregion
            },

            success:function(response){
             console.log(response);
             var jsondata = JSON.stringify(response);
             console.log(jsondata);

            //$array = json_decode($_POST['jsondata']);
             var stationz = $.parseJSON(response);
             var arrayLength = stationz.length;
            
             $('#stations-list').empty();
             for (var i = 0; i < arrayLength; i++) {
              var stn = stationz[i]['StationName'];
              console.log(stn);

              var o = new Option("option text", stn);
              $(o).html(stn);
              $('#stations-list').append(o);
              getStationID();
              }


      },
      error: function() {
        alert("Invalide query");
    },
    dataType: 'text'
     });
     
    });

    $('#stations-list').change(function(){
        var selected_station = $('#stations-list').find(":selected").text();

        $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxStationIdRequest",
            data:{ 
                station:selected_station 
            },

            success:function(response){
                // var id = JSON.parse(data);
                // $('#station-id').val(id.toString());
                //  $('#stationNoManager').val(id.toString());
                //   $('#stationNoOC').val(id.toString());



			var jsondata = JSON.stringify(response);
             console.log(jsondata);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;

			  $('#station-id').val(stations[0]['stationNumber']);
              $('#stationNoManager').val(stations[0]['stationNumber']);
              $('#stationNoOC').val(stations[0].stationNumber);

			  window.max_windspeed=stations[0]['max_expectedwindspeed'];
			  window.min_windspeed=stations[0]['min_expectedwindspeed'];

			  window.max_rain=stations[0]['max_expectedrain'];
			  window.min_rain=stations[0]['min_expectedrain'];

			  window.max_temp=stations[0]['max_expectedtemp'];
			  window.min_temp=stations[0]['min_expectedtemp'];
              
            //}
            },

            error: function() {
                alert("Invalide query");
            },
            dataType: 'text'
        });

    });

     function getStationID(){
        var selected_station = $('#stations-list').find(":selected").text();

        if(selected_station != "" && selected_station != "Select station"){
       // alert(selected_station);
       $.ajax({
        type:"post",
        url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxStationIdRequest",
        data:{ 
            station:selected_station 
        },

        success:function(response){
            // var id = JSON.parse(data);
            // if(id){
            //    $('#station-id').val(id.toString()); 
            //    $('#stationNoManager').val(id.toString());
            //    $('#stationNoOC').val(id.toString());
            // }
			var jsondata = JSON.stringify(response);
             console.log(jsondata);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;

			  $('#station-id').val(stations[0]['stationNumber']);
              $('#stationNoManager').val(stations[0]['stationNumber']);
              $('#stationNoOC').val(stations[0].stationNumber);

			  window.max_windspeed=stations[0]['max_expectedwindspeed'];
			  window.min_windspeed=stations[0]['min_expectedwindspeed'];

			  window.max_rain=stations[0]['max_expectedrain'];
			  window.min_rain=stations[0]['min_expectedrain'];

			  window.max_temp=stations[0]['max_expectedtemp'];
			  window.min_temp=stations[0]['min_expectedtemp'];
			  
            
        },

        error: function() {
            alert("Invalide query");
        },
        dataType: 'text'
    });
   }


}



     });
    </script>


    <script>
        $(document).ready(function() {
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#generateobservationslipreport_button').click(function(event) {


                //Check that the a station is selected from the list Managerations(Admin)
             var stationManager=$('#stationManager').val();
           if(stationManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
               $('#stationManager').val("");  //Clear the field.
               $("#stationManager").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoManager=$('#stationNoManager').val();
                if(stationNoManager==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoManager').val("");  //Clear the field.
                    $("#stationNoManager").focus();
                    return false;

                }
/////////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the a station is selected from the list of stations(Manager)
                var stationOC=$('#stationOC').val();
                if(stationOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#stationOC').val("");  //Clear the field.
                    $("#stationOC").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNoOC=$('#stationNoOC').val();
                if(stationNoOC==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNoOC').val("");  //Clear the field.
                    $("#stationNoOC").focus();
                    return false;

                }

///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the DATE is selected from the list of TIME for the METAR
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Date not Selected");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }


            });
        });
    </script>
    <script type="text/javascript">
        //Once the Admin selects the Station the Station Number should be picked from the DB.
        // For Add Update Daily
        $(document).on('change','#stationManager',function(){
            $('#stationNoManager').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoManager').val("");
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Stations/getStationNumber",
                    type: "POST",
                    data: {'stationName': stationName},
                    cache: false,
                    //dataType: "JSON",
                    success: function(data){
                        if (data)
                        {
                            var json = JSON.parse(data);

                            $('#stationNoManager').empty();

                            // alert(data);
                            $("#stationNoManager").val(json[0].StationNumber);

                        }
                        else{

                            $('#stationNoManager').empty();
                            $('#stationNoManager').val("");

                        }
                    }

                });



            }
            else {

                $('#stationNoManager').empty();
                $('#stationNoManager').val("");
            }

        })
    </script>






<?php require_once(APPPATH . 'views/footer.php'); ?>
<script src="<?php echo base_url(); ?>js/form.js"></script>
