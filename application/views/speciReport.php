<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//$userstationNo=$session_data['StationNumber'];
$userregion=$session_data['UserRegion'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Speci Report
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Speci  Report</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content report">
            <div id="output"></div>
            <div class="no-print">
                <div class="row">
                <?php if(!isset($reportonly)){ ?>
                    <form autocomplete="off" action="<?= site_url('generate-speci-report')?>" method="post" enctype="multipart/form-data">

                        <?php  if($userrole=='Senior Weather Observer' || $userrole=="WeatherForecaster"  ){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">
                                         <input type="hidden" name="RegionName" value="<?php echo $userregion ?>">
                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>

                        <?php }

                        elseif($userrole=='ManagerData' || $userrole=="ManagerStationNetworks" || $userrole=="Director"|| $userrole=='WeatherAnalyst' || $userrole == 'Communications'){
                            ?>
                                   <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Region</span>
                                <select name="RegionName" id="regions"  required class="form-control" placeholder="Select Region">
                                    <option value="">Select Region</option>
                                    <?php
                                    if (is_array($regions) && count($regions)) {
                                        foreach($regions as $region){?>
                                            <option value="<?php echo $region->StationRegion ?> "
                                                <?php echo set_select('region', $region->StationRegion)?>
                                                >
                                                <?php echo $region->StationRegion;?></option>

                                            <?php }
                                        } ?>  

                                    </select> 
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3 no-print">
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
<div class="col-xs-3 no-print">
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

                        <?php if($userrole=='Senior Weather Observer'|| $userrole=="WeatherForecaster" ){ ?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="page" value="monthly_rainfall_report" >

                                        <span class="input-group-addon">Station Number</span>
                                        <input type="text" name="stationNoOC" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>

                        <?php }elseif($userrole=='ManagerData' || $userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer" || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole=="WeatherForecaster" || $userrole=='WeatherAnalyst' || $userrole == 'Communications'){?>
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
                                    <span class="input-group-addon">Start Date</span>
                                    <input type="date" name="Start-Date"  class="form-control summonth" placeholder="select the date" autocomplete="off" required >
                                </div>
                            </div>
                        </div>


                          <div class="col-xs-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">End Date</span>
                                    <input type="date" name="End-Date" class="form-control summonth" placeholder="select the date" autocomplete="off" required >
                                </div>
                            </div>
                        </div>


                         <div class="col-xs-3 form-group">
            <div class="input-group">
            <span class="input-group-addon" >Start Time</span>
            <div class="input-group timepicker">
             <input id="timepicker1" type="text" name="StartTime"  class="form-control" autocomplete="off" >

           </div>
           <script type="text/javascript">
                       $('#timepicker1').timepicker();
            </script>
           <span class="input-group-addon clock-rm1"><i class="glyphicon glyphicon-time"></i></span>
         </div>
     </div>


 <div class="col-xs-3 form-group">
            <div class="input-group">
            <span class="input-group-addon" >End Time</span>
            <div class="input-group timepicker">
             <input id="timepicker2" type="text" name="EndTime"  class="form-control" autocomplete="off" >

           </div>
           <script type="text/javascript">
                       $('#timepicker2').timepicker();
            </script>
           <span class="input-group-addon clock-rm2"><i class="glyphicon glyphicon-time"></i></span>
         </div>
     </div>




                        <div class="col-xs-2">
                            <input type="submit" name="generatemetarReport_button" id="generatemetarReport_button" class="btn btn-primary" value="Generate report" >
                        </div>
                    </form>
                <?php } ?>
                </div>
                <hr>
            </div>

            <?php
            $data = $this->session->flashdata();
            $displayspeciReportHeaderFields = $data['displayspeciReportHeaderFields'];
            $stationIndicatorData = $data['stationIndicatorData'];
            $specireportdataforADayFromObservationSlipTable = $data['specireportdataforADayFromObservationSlipTable'];
            if(is_array($displayspeciReportHeaderFields) &&
               count($displayspeciReportHeaderFields) &&
              is_array($specireportdataforADayFromObservationSlipTable) &&
                  !empty($specireportdataforADayFromObservationSlipTable)
            ){

                $date= $displayspeciReportHeaderFields['date'];
                $monthDay =date('d',strtotime($date)); //get the day num from the date.e.g 6th
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
                $stationName=$displayspeciReportHeaderFields['stationName'];
                $stationIndicator=$displayspeciReportHeaderFields['Indicator'];
                $region = $displayspeciReportHeaderFields['region'];
                $stationNumber=$displayspeciReportHeaderFields['stationNumber'];
                $date1 = $displayspeciReportHeaderFields['date1'];

                $blocknumber = $displayspeciReportHeaderFields['blocknumber'];
              $date2=$displayspeciReportHeaderFields['date2'];
              $timeX = $displayspeciReportHeaderFields['time1'];

              $timeY =$displayspeciReportHeaderFields['time2'];

               
               $stationIndicator;
            //echo $stationName;


              if (is_array($stationIndicatorData) && count($stationIndicatorData)) {
                 foreach($stationIndicatorData as $station){
                   
                         $stationIndicator=$station->Indicator;
            
                     }
                     }



                ?>

                <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
                <h3>speci REPORT</h3> <br>

                <div class="col-lg-2"  style="float: right; margin-top: -10%; width: 140px;">
                     <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
                     <?php if(strcmp('Senior Weather Observer',$userrole)==0){ if($exists!=1){ ?>
                    <form style="margin-right:140px;" action="<?= site_url('generate-speci-report')?>" method="post">
                    <input type="hidden" name="RegionName" value="<?php echo $region;?>">
                    <input type="hidden"  name="Start-Date" value="<?php echo $date1;?>"/>
                    <input type="hidden"  name="End-Date" value="<?php echo $date2;?>"/>

                    <input type="hidden"  name="StartTime" value="<?php echo $timeX;?>"/>
                    <input type="hidden"  name="EndTime" value="<?php echo $timeY;?>"/>
                    <input type="hidden"  name="month" value=""/>
                    <input type="hidden"  name="year" value=""/>
                    <input type="hidden"  name="stationOC" value="<?php echo $stationName;?>"/>
                    <input type="hidden"  name="stationNoOC" value="<?php echo $stationNumber;?>"/>
                    <input type="hidden"  name="reporttype" value="speci"/>
                    <button  type="submit" name="sendreporttozone" class="btn btn-info btn-xs no-print"  data-export="export"><i class="fa fa-print"></i> Send Report to Region</button>
                </form>
                <?php }else{ ?>
                <p style="color:green;"><i class="fa fa-check"> </i>Report sent</p>
                <?php } }if(strcmp('SeniorZonalOfficer',$userrole)==0||strcmp('ZonalOfficer',$userrole)==0){ 
                if(isset($reportonly)){ 
                    if(isset($reportrecord)){
                foreach($reportrecord->result() as $reportrecod)  {
                 if(strcmp($reportrecod->forwardtomanager,"False")==0){
                ?>
                <form style="margin-right:140px;" action="<?= site_url('generate-speci-report')?>" method="post">
                    <input type="hidden"  name="forward" value="True"/>
                    <input type="hidden"  name="RegionName" value="<?php echo $region;?>"/>
                    <input type="hidden"  name="station" value="<?php echo $stationName;?>"/>
                    <input type="hidden"  name="stationNoManager" value="<?php echo $stationNumber;?>"/>
                    <input type="hidden"  name="Start-Date" value="<?php echo $date1;?>"/>
                    <input type="hidden"  name="End-Date" value="<?php echo $date2;?>"/>
                    <input type="hidden"  name="StartTime" value="<?php echo $timeX;?>"/>
                    <input type="hidden"  name="EndTime" value="<?php echo $timeY;?>"/>
                    <input type="hidden"  name="record_id" value="<?php echo $reportrecod->id; ?>"/>
                    <button  type="submit" name="sendreporttomanager" class="btn btn-info btn-xs no-print"  data-export="export"><i class="fa fa-print"></i> Send Report to manager</button>
                </form>
                <?php }else{ ?>
                    <p style="color:green;"><i class="fa fa-check"> </i>Report sent</p>
                <?php } } } } }?>
                </div> <br>
                <form action="<?php echo base_url(); ?>index.php/ReportOCIssues/sendData/" method="post" >
                <span><strong>STATION</strong></span> <span class="dotted-line"><?php echo $stationName;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>STATION NUMBER</strong></span>
                <span class="dotted-line"><?php echo "".$blocknumber."".$stationNumber."";?></span>


                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>Start DATE</strong></span>
                <span class="dotted-line"><?php echo $date1;?></span>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>End DATE</strong></span>
                <span class="dotted-line"><?php echo $date2;?></span>
                 <?php
                  if(($timeX !="" && $timeY !="") && $timeX != $time2){
                    ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>Start Time</strong></span>
                <span class="dotted-line"><?php echo $timeX;?></span>
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>End Time</strong></span>
                <span class="dotted-line"><?php echo $timeY;?></span>

                  <?php } ?>



                <div class="clearfix"></div>
                <br>
                <table class="report-table" id="table2excel">
                  
                    <tr>
                        <td class="main">speci</td>
                        <td class="main">CCCC</td>
                        <td class="main">YYGGgg</td>
                        <td class="main">Dddff/<br> f<sub>m</sub>f<sub>m</sub></td>
                        <td class="main">VVVV or <br> CAVOK</td>
                        <td class="main">RV V<sub>R</sub>V<sub>R</sub>V<sub>R</sub>V<sub>R</sub></td>
                        <td class="main">W<sup>1</sup>W<sup>1</sup></td>
                        <td class="main">NCCh<sub>s</sub>h<sub>s</sub>h<sub>s</sub></td>
                        <td class="main">NCCh<sub>s</sub>h<sub>s</sub>h<sub>s</sub></td>
                        <td class="main">NCCh<sub>s</sub>h<sub>s</sub>h<sub>s</sub></td>
                        <td class="main">NCCh<sub>s</sub>h<sub>s</sub>h<sub>s</sub></td>
                        <td class="main">TT/ <br> T<sub>d</sub>T<sub>d</sub></td>
                        <td class="main">QNH <br>(hpa)</td>
                        <td class="main">QNH <br>(in)</td>
                        <td class="main">QFE<br> (hpa)</td>
                        <td class="main">QFE<br> (in)</td>
                        <td class="main">RE <br> W1W1</td>
                    </tr>


                    <?php
                    $count = 0;
                    $array_speciReportDataForADayFromObservationSlipTable=array();

                        foreach($specireportdataforADayFromObservationSlipTable as $data){
                           // $count++;
                           // $speciid = $data->id;
                           $array_speciReportDataForADayFromObservationSlipTable[$count]["recent_weather"]=$data->recent_weather;
                           $array_speciReportDataForADayFromObservationSlipTable[$count]["TIME"]=$data->TIME;
                           $array_speciReportDataForADayFromObservationSlipTable[$count]["oblique"]=$data->oblique;
                           $array_speciReportDataForADayFromObservationSlipTable[$count]["runwayVisualRange"]=$data->runwayVisualRange;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["Wind_Direction"]=$data->Wind_Direction;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["Wind_Speed"]=$data->Wind_Speed;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["Visibility"]=$data->Visibility;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["Present_Weather"]=$data->Present_Weather;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfLowClouds1"]=$data->OktasOfLowClouds1;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfLowClouds1"]=$data->HeightOfLowClouds1;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfLowClouds2"]=$data->OktasOfLowClouds2;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfLowClouds2"]=$data->HeightOfLowClouds2;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfLowClouds3"]=$data->OktasOfLowClouds3;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfLowClouds3"]=$data->HeightOfLowClouds3;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfMediumClouds1"]=$data->OktasOfMediumClouds1;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfMediumClouds1"]=$data->HeightOfMediumClouds1;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfMediumClouds2"]=$data->OktasOfMediumClouds2;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfMediumClouds2"]=$data->HeightOfMediumClouds2;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfMediumClouds3"]=$data->OktasOfMediumClouds3;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfMediumClouds3"]=$data->HeightOfMediumClouds3;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfHighClouds1"]=$data->OktasOfHighClouds1;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfHighClouds1"]=$data->HeightOfHighClouds1;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfHighClouds2"]=$data->OktasOfHighClouds2;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfHighClouds2"]=$data->HeightOfHighClouds2;

                            $array_speciReportDataForADayFromObservationSlipTable[$count]["OktasOfHighClouds3"]=$data->OktasOfHighClouds3;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["HeightOfHighClouds3"]=$data->HeightOfHighClouds3;



                            $array_speciReportDataForADayFromObservationSlipTable[$count]["Dry_Bulb"]=$data->Dry_Bulb;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["Wet_Bulb"]=$data->Wet_Bulb;


                            $array_speciReportDataForADayFromObservationSlipTable[$count]["MSLPr"]=$data->MSLPr;
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["CLP"]=$data->CLP;


                            if($count==0){
                            $array_speciReportDataForADayFromObservationSlipTable[$count]["REW1W1"]='';
                            }elseif($count!=0){
                            $array_speciReportDataForADayFromObservationSlipTable[$count-1]["REW1W1"]=$data->Present_Weather; //get the present weather for previous Hour

                            }
                            $count++;  //move to the next Hour
                        }
                            ?>
                 <?php   foreach($array_speciReportDataForADayFromObservationSlipTable as $data){

                     ?>



                     <tr>
                            <?php
                            if(($data['TIME']=='00:00Z') || ($data['TIME']=='00:30Z')||
                             ($data['TIME']=='01:00Z')   || ($data['TIME']=='01:30Z') ||
                            ($data['TIME']=='02:00Z')      || ($data['TIME']=='02:30Z') ||
                            ($data['TIME']=='03:00Z')      || ($data['TIME']=='03:30Z') ||
                            ($data['TIME']=='04:00Z')      || ($data['TIME']=='04:30Z') ||
                            ($data['TIME']=='05:00Z')      || ($data['TIME']=='05:30Z') ||
                            ($data['TIME']=='06:00Z')   || ($data['TIME']=='06:30Z') ||
                            ($data['TIME']=='07:00Z')   || ($data['TIME']=='07:30Z') ||
                            ($data['TIME']=='08:00Z')   || ($data['TIME']=='08:30Z') ||
                            ($data['TIME']=='09:00Z')   || ($data['TIME']=='09:30Z') ||
                            ($data['TIME']=='10:00Z')   || ($data['TIME']=='10:30Z') ||
                            ($data['TIME']=='11:00Z')   || ($data['TIME']=='11:30Z') ||
                            ($data['TIME']=='12:00Z')   || ($data['TIME']=='12:30Z') ||
                            ($data['TIME']=='13:00Z')   || ($data['TIME']=='13:30Z') ||
                            ($data['TIME']=='14:00Z')   || ($data['TIME']=='14:30Z') ||
                            ($data['TIME']=='15:00Z')   || ($data['TIME']=='15:30Z') ||
                            ($data['TIME']=='16:00Z')   || ($data['TIME']=='16:30Z') ||
                            ($data['TIME']=='17:00Z')   || ($data['TIME']=='17:30Z') ||
                            ($data['TIME']=='18:00Z')   || ($data['TIME']=='18:30Z') ||
                            ($data['TIME']=='19:00Z')   || ($data['TIME']=='19:30Z') ||
                            ($data['TIME']=='20:00Z')   || ($data['TIME']=='20:30Z') ||
                            ($data['TIME']=='21:00Z')   || ($data['TIME']=='21:30Z') ||
                            ($data['TIME']=='22:00Z')   || ($data['TIME']=='22:30Z') ||
                            ($data['TIME']=='23:00Z')   || ($data['TIME']=='23:30Z')){ ?>

                            <td ><?php echo 'SPECI';?></td>
                             <?php
                              }
                            else{ ?>

                            <td ><small>SPECI</small></td>  
                          <?php  }
                            ?>


                                <td ><?php echo  $stationIndicator;?></td> <!-- CCCC -->
                                
                                <?php  
                                $date="";
                                $datearray= explode(':',$data['TIME']);
                                    for($i=0;$i<count($datearray);$i++){   
                       
                                    $date=$date.$datearray[$i];
                                } ?>
                                <td ><?php echo $monthDay . $date;?></td>  <!-- YYGGgg -->
                                <td ><?php echo (($data['Wind_Direction']!=0)&&($data['Wind_Direction']!=0))?$data['Wind_Direction'] . $data['Wind_Speed'] . 'KT':"";?></td> <!-- Dddfffmfm -->
                                

                                <?php
                                $OktasOfLowCloud1='';
                                $HeightOfLowCloud1='';
                                $OktasAndHeightOfLowCloud1='';

                                $OktasOfLowCloud2='';
                                $HeightOfLowCloud2='';
                                $OktasAndHeightOfLowCloud2='';

                                $OktasOfLowCloud3='';
                                $HeightOfLowCloud3='';
                                $OktasAndHeightOfLowCloud3='';




                                $OktasOfMediumCloud1='';
                                $HeightOfMediumCloud1='';
                                $OktasAndHeightOfMediumCloud1='';

                                $OktasOfMediumCloud2='';
                                $HeightOfMediumCloud2='';
                                $OktasAndHeightOfMediumCloud2='';

                                $OktasOfMediumCloud3='';
                                $HeightOfMediumCloud3='';
                                $OktasAndHeightOfMediumCloud3='';


                                $OktasOfHighCloud1='';
                                $HeightOfHighCloud1='';
                                $OktasAndHeightOfHighCloud1='';

                                $OktasOfHighCloud2='';
                                $HeightOfHighCloud2='';
                                $OktasAndHeightOfHighCloud2='';

                                $OktasOfHighCloud3='';
                                $HeightOfHighCloud3='';
                                $OktasAndHeightOfHighCloud3='';
                                
                                ?>

                               <?php // BEGIN FIRST LINE OF LOW CLOUDS ?>
                                <?php if(($data['OktasOfLowClouds1']==1) ||($data['OktasOfLowClouds1']==2) ){
                                    $OktasOfLowCloud1='FEW';
                                    $HeightOfLowCloud1= substr($data['HeightOfLowClouds1'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud1=$OktasOfLowCloud1.'0'.$HeightOfLowCloud1;  //GET FEW.0.TWO DIGITS FROM STRING

                                }elseif(($data['OktasOfLowClouds1']==3) ||($data['OktasOfLowClouds1']==4) ){
                                    $OktasOfLowCloud1='SCT';
                                    $HeightOfLowCloud1= substr($data['HeightOfLowClouds1'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud1=$OktasOfLowCloud1.'0'.$HeightOfLowCloud1;  //GET FEW.0.TWO DIGITS FROM STRING


                                }elseif(($data['OktasOfLowClouds1']==5) ||($data['OktasOfLowClouds1']==6)||($data['OktasOfLowClouds1']==7) ){
                                    $OktasOfLowCloud1='BKN';
                                    $HeightOfLowCloud1= substr($data['HeightOfLowClouds1'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud1=$OktasOfLowCloud1.'0'.$HeightOfLowCloud1;  //GET FEW.0.TWO DIGITS FROM STRING



                                }elseif(($data['OktasOfLowClouds1']==8)  ){
                                    $OktasOfLowCloud1='OVC';
                                    $HeightOfLowCloud1= substr($data['HeightOfLowClouds1'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud1=$OktasOfLowCloud1.'0'.$HeightOfLowCloud1;  //GET FEW.0.TWO DIGITS FROM STRING

                                } ?>
                                <?php//END OF FIRST LINE OF LOW CLOUDS ?>

                                <?php // BEGIN SECOND LINE OF LOW CLOUDS ?>
                                <?php if(($data['OktasOfLowClouds2']==1) ||($data['OktasOfLowClouds2']==2) ){
                                    $OktasOfLowCloud2='FEW';
                                    $HeightOfLowCloud2= substr($data['HeightOfLowClouds2'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud2=$OktasOfLowCloud2.'0'.$HeightOfLowCloud2.'CB';  //GET FEW.0.TWO DIGITS FROM STRING

                                }elseif(($data['OktasOfLowClouds2']==3) ||($data['OktasOfLowClouds2']==4) ){
                                    $OktasOfLowCloud2='SCT';
                                    $HeightOfLowCloud2= substr($data['HeightOfLowClouds2'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud2=$OktasOfLowCloud2.'0'.$HeightOfLowCloud2.'CB';  //GET FEW.0.TWO DIGITS FROM STRING


                                }elseif(($data['OktasOfLowClouds2']==5) ||($data['OktasOfLowClouds2']==6)||($data['OktasOfLowClouds2']==7) ){
                                    $OktasOfLowCloud2='BKN';
                                    $HeightOfLowCloud2= substr($data['HeightOfLowClouds2'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud2=$OktasOfLowCloud2.'0'.$HeightOfLowCloud2.'CB';  //GET FEW.0.TWO DIGITS FROM STRING



                                }elseif(($data['OktasOfLowClouds2']==8)  ){
                                    $OktasOfLowCloud2='OVC';
                                    $HeightOfLowCloud2= substr($data['HeightOfLowClouds2'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud2=$OktasOfLowCloud2.'0'.$HeightOfLowCloud2.'CB';  //GET FEW.0.TWO DIGITS FROM STRING

                                } ?>
                                <?php//END OF SECOND LINE OF LOW CLOUDS ?>

                                <?php // BEGIN THIRD LINE OF LOW CLOUDS ?>
                                <?php if(($data['OktasOfLowClouds3']==1) ||($data['OktasOfLowClouds3']==2) ){
                                    $OktasOfLowCloud3='FEW';
                                    $HeightOfLowCloud3= substr($data['HeightOfLowClouds3'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud3=$OktasOfLowCloud3.'0'.$HeightOfLowCloud3;  //GET FEW.0.TWO DIGITS FROM STRING

                                }elseif(($data['OktasOfLowClouds3']==3) ||($data['OktasOfLowClouds3']==4) ){
                                    $OktasOfLowCloud3='SCT';
                                    $HeightOfLowCloud3= substr($data['HeightOfLowClouds3'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud3=$OktasOfLowCloud3.'0'.$HeightOfLowCloud3;  //GET FEW.0.TWO DIGITS FROM STRING


                                }elseif(($data['OktasOfLowClouds3']==5) ||($data['OktasOfLowClouds3']==6)||($data['OktasOfLowClouds3']==7) ){
                                    $OktasOfLowCloud3='BKN';
                                    $HeightOfLowCloud3= substr($data['HeightOfLowClouds3'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud3=$OktasOfLowCloud3.'0'.$HeightOfLowCloud3;  //GET FEW.0.TWO DIGITS FROM STRING



                                }elseif(($data['OktasOfLowClouds3']==8)  ){
                                    $OktasOfLowCloud3='OVC';
                                    $HeightOfLowCloud3= substr($data['HeightOfLowClouds3'],0,2); //GET FIRST TWO DIGITS OF THE STRING
                                    $OktasAndHeightOfLowCloud3=$OktasOfLowCloud3.'0'.$HeightOfLowCloud3;  //GET FEW.0.TWO DIGITS FROM STRING

                                } ?>
                                <?php//END OF THIRD LINE OF LOW CLOUDS ?>
                                <?php
                                $cloudsheights= array();
                                ($data['HeightOfLowClouds1']!=0)?array_push($cloudsheights, $data['HeightOfLowClouds1']):'';
                                ($data['HeightOfLowClouds2']!=0)?array_push($cloudsheights, $data['HeightOfLowClouds2']):'';
                                ($data['HeightOfLowClouds3']!=0)?array_push($cloudsheights, $data['HeightOfLowClouds3']):'';
                                sort($cloudsheights);
                                $no_ofclouds=count($cloudsheights);
                                if($no_ofclouds>=2){
                                    if(($cloudsheights[0]==$data['HeightOfLowClouds1'])){$mslc=$OktasAndHeightOfLowCloud1;}
                                    if(($cloudsheights[0]==$data['HeightOfLowClouds2'])){$mslc=$OktasAndHeightOfLowCloud2;}
                                    if(($cloudsheights[0]==$data['HeightOfLowClouds3'])){$mslc=$OktasAndHeightOfLowCloud3;}

                                    if(($cloudsheights[1]==$data['HeightOfLowClouds1'])){$mslc2=$OktasAndHeightOfLowCloud1;}
                                    if(($cloudsheights[1]==$data['HeightOfLowClouds2'])){$mslc2=$OktasAndHeightOfLowCloud2;}
                                    if(($cloudsheights[1]==$data['HeightOfLowClouds3'])){$mslc2=$OktasAndHeightOfLowCloud3;}
                                  }else if($no_ofclouds>=1){
                                    if(($cloudsheights[0]==$data['HeightOfLowClouds1'])){$mslc=$OktasAndHeightOfLowCloud1;}
                                    if(($cloudsheights[0]==$data['HeightOfLowClouds2'])){$mslc=$OktasAndHeightOfLowCloud2;}
                                    if(($cloudsheights[0]==$data['HeightOfLowClouds3'])){$mslc=$OktasAndHeightOfLowCloud3;}
                                    $mslc2="";
                                  }else{
                                    $mslc ="";
                                    $mslc2="";
                                  }
                        
                                 ?>
                               
                                  

                                <?php // BEGIN FIRST LINE OF MEDIUM CLOUDS ?>
                                <?php if(($data['OktasOfMediumClouds1']==1) ||($data['OktasOfMediumClouds1']==2) ){
                                    $OktasOfMediumCloud1='FEW';
                                    $HeightOfMediumCloud1= substr($data['HeightOfMediumClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud1=$OktasOfMediumCloud1.''.$HeightOfMediumCloud1;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfMediumClouds1']==3) ||($data['OktasOfMediumClouds1']==4) ){
                                    $OktasOfMediumCloud1='SCT';
                                    $HeightOfMediumCloud1= substr($data['HeightOfMediumClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud1=$OktasOfMediumCloud1.''.$HeightOfMediumCloud1;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfMediumClouds1']==5) ||($data['OktasOfMediumClouds1']==6)||($data['OktasOfMediumClouds1']==7) ){
                                    $OktasOfMediumCloud1='BKN';
                                    $HeightOfMediumCloud1= substr($data['HeightOfMediumClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud1=$OktasOfMediumCloud1.''.$HeightOfMediumCloud1;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfMediumClouds1']==8)  ){
                                    $OktasOfMediumCloud1='OVC';
                                    $HeightOfMediumCloud1= substr($data['HeightOfMediumClouds1'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud1=$OktasOfMediumCloud1.''.$HeightOfMediumCloud1;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php
                                //END OF FIRST LINE OF MEDIUM CLOUDS 
                               
                                ?>




                                <?php // BEGIN SECOND LINE OF MEDIUM CLOUDS ?>
                                <?php if(($data['OktasOfMediumClouds2']==1) ||($data['OktasOfMediumClouds2']==2) ){
                                    $OktasOfMediumCloud2='FEW';
                                    $HeightOfMediumCloud2= substr($data['HeightOfMediumClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud2=$OktasOfMediumCloud2.''.$HeightOfMediumCloud2;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfMediumClouds2']==3) ||($data['OktasOfMediumClouds2']==4) ){
                                    $OktasOfMediumCloud2='SCT';
                                    $HeightOfMediumCloud2= substr($data['HeightOfMediumClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud2=$OktasOfMediumCloud2.''.$HeightOfMediumCloud2;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfMediumClouds2']==5) ||($data['OktasOfMediumClouds2']==6) ||($data['OktasOfMediumClouds2']==7) ){
                                    $OktasOfMediumCloud2='BKN';
                                    $HeightOfMediumCloud2= substr($data['HeightOfMediumClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud2=$OktasOfMediumCloud2.''.$HeightOfMediumCloud2;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfMediumClouds2']==8)  ){
                                    $OktasOfMediumCloud2='OVC';
                                    $HeightOfMediumCloud2= substr($data['HeightOfMediumClouds2'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud2=$OktasOfMediumCloud2.''.$HeightOfMediumCloud2;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF SECOND LINE OF LOW CLOUDS ?>

                                <?php // BEGIN THIRD LINE OF MEDIUM CLOUDS ?>
                                <?php if(($data['OktasOfMediumClouds3']==1) ||($data['OktasOfMediumClouds3']==2) ){
                                    $OktasOfMediumCloud3='FEW';
                                    $HeightOfMediumCloud3= substr($data['HeightOfMediumClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud3=$OktasOfMediumCloud3.''.$HeightOfMediumCloud3;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfMediumClouds3']==3) ||($data['OktasOfMediumClouds3']==4) ){
                                    $OktasOfMediumCloud3='SCT';
                                    $HeightOfMediumCloud3= substr($data['HeightOfMediumClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud3=$OktasOfMediumCloud3.''.$HeightOfMediumCloud3;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfMediumClouds3']==5) ||($data['OktasOfMediumClouds3']==6) ||($data['OktasOfMediumClouds3']==7) ){
                                    $OktasOfMediumCloud3='BKN';
                                    $HeightOfMediumCloud3= substr($data['HeightOfMediumClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    $OktasAndHeightOfMediumCloud3=$OktasOfMediumCloud3.''.$HeightOfMediumCloud3;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfMediumClouds3']==8)  ){
                                    $OktasOfMediumCloud3='OVC';
                                    $HeightOfMediumCloud3= substr($data['HeightOfMediumClouds3'],0,3); //GET FIRST THREE DIGITS OF THE STRING
                                    
                                    $OktasAndHeightOfMediumCloud3=$OktasOfMediumCloud3.''.$HeightOfMediumCloud3;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php
                                //END OF THIRD LINE OF MEDIUM CLOUDS 
                                
                                ?>

                                <?php
                                $cloudsheights2= array();
                                ($data['HeightOfMediumClouds1']!=0)?array_push($cloudsheights2, $data['HeightOfMediumClouds1']):'';
                                ($data['HeightOfMediumClouds2']!=0)?array_push($cloudsheights2, $data['HeightOfMediumClouds2']):'';
                                ($data['HeightOfMediumClouds3']!=0)?array_push($cloudsheights2, $data['HeightOfMediumClouds3']):'';
                                sort($cloudsheights2);
                                $no_ofclouds=count($cloudsheights2);
                                if($no_ofclouds>=1){
                                    if(($cloudsheights2[0]==$data['HeightOfMediumClouds1'])){$msmc=$OktasAndHeightOfMediumCloud1;}
                                    if(($cloudsheights2[0]==$data['HeightOfMediumClouds2'])){$msmc=$OktasAndHeightOfMediumCloud2;}
                                    if(($cloudsheights2[0]==$data['HeightOfMediumClouds3'])){$msmc=$OktasAndHeightOfMediumCloud3;}
                                    
                                  }else{
                                    $msmc ="";
                                  }
                               
                                ?>

                                <?php // BEGIN FIRST LINE OF HIGH CLOUDS ?>
                                <?php if(($data['OktasOfHighClouds1']==1) ||($data['OktasOfHighClouds1']==2) ){
                                    $OktasOfHighCloud1='FEW';
                                    $HeightOfHighCloud1=($data['HeightOfHighClouds1']<10000)?'0'.substr($data['HeightOfHighClouds1'],0,2):substr($data['HeightOfHighClouds1'],0,3);
                                    $OktasAndHeightOfHighCloud1=$OktasOfHighCloud1.''.$HeightOfHighCloud1;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfHighClouds1']==3) ||($data['OktasOfHighClouds1']==4) ){
                                    $OktasOfHighCloud1='SCT';
                                    $HeightOfHighCloud1=($data['HeightOfHighClouds1']<10000)?'0'.substr($data['HeightOfHighClouds1'],0,2):substr($data['HeightOfHighClouds1'],0,3);
                                    $OktasAndHeightOfHighCloud1=$OktasOfHighCloud1.''.$HeightOfHighCloud1;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfHighClouds1']==5) ||($data['OktasOfHighClouds1']==7) ){
                                    $OktasOfHighCloud1='BKN';
                                    $HeightOfHighCloud1=($data['HeightOfHighClouds1']<10000)?'0'.substr($data['HeightOfHighClouds1'],0,2):substr($data['HeightOfHighClouds1'],0,3);
                                    $OktasAndHeightOfHighCloud1=$OktasOfHighCloud1.''.$HeightOfHighCloud1;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfHighClouds1']==8)  ){
                                    $OktasOfHighCloud1='OVC';
                                    $HeightOfHighCloud1=($data['HeightOfHighClouds1']<10000)?'0'.substr($data['HeightOfHighClouds1'],0,2):substr($data['HeightOfHighClouds1'],0,3);
                                    $OktasAndHeightOfHighCloud1=$OktasOfHighCloud1.''.$HeightOfHighCloud1;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF FIRST LINE OF HIGH CLOUDS ?>

                                <?php // BEGIN SECOND LINE OF HIGH CLOUDS ?>
                                <?php if(($data['OktasOfHighClouds2']==1) ||($data['OktasOfHighClouds2']==2) ){
                                    $OktasOfHighCloud2='FEW';
                                    $HeightOfHighCloud2=($data['HeightOfHighClouds2']<10000)?'0'.substr($data['HeightOfHighClouds2'],0,2):substr($data['HeightOfHighClouds2'],0,3);
                                    $OktasAndHeightOfHighCloud2=$OktasOfHighCloud2.''.$HeightOfHighCloud2;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfHighClouds2']==3) ||($data['OktasOfHighClouds2']==4) ){
                                    $OktasOfHighCloud2='SCT';
                                    $HeightOfHighCloud2=($data['HeightOfHighClouds2']<10000)?'0'.substr($data['HeightOfHighClouds2'],0,2):substr($data['HeightOfHighClouds2'],0,3);
                                    $OktasAndHeightOfHighCloud2=$OktasOfHighCloud2.''.$HeightOfHighCloud2;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfHighClouds2']==5) ||($data['OktasOfHighClouds2']==6) ||($data['OktasOfHighClouds2']==7) ){
                                    $OktasOfHighCloud2='BKN';
                                    $HeightOfHighCloud2=($data['HeightOfHighClouds2']<10000)?'0'.substr($data['HeightOfHighClouds2'],0,2):substr($data['HeightOfHighClouds2'],0,3);
                                    $OktasAndHeightOfHighCloud2=$OktasOfHighCloud2.''.$HeightOfHighCloud2;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfHighClouds2']==8)  ){
                                    $OktasOfHighCloud2='OVC';
                                    $HeightOfHighCloud2=($data['HeightOfHighClouds2']<10000)?'0'.substr($data['HeightOfHighClouds2'],0,2):substr($data['HeightOfHighClouds2'],0,3);
                                    $OktasAndHeightOfHighCloud2=$OktasOfHighCloud2.''.$HeightOfHighCloud2;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php//END OF SECOND LINE OF HIGH CLOUDS ?>

                                <?php // BEGIN THIRD LINE OF HIGH CLOUDS ?>
                                <?php if(($data['OktasOfHighClouds3']==1) ||($data['OktasOfHighClouds3']==2) ){
                                    $OktasOfHighCloud3='FEW';
                                    $HeightOfHighCloud3=($data['HeightOfHighClouds3']<10000)?'0'.substr($data['HeightOfHighClouds3'],0,2):substr($data['HeightOfHighClouds3'],0,3);
                                    $OktasAndHeightOfHighCloud3=$OktasOfHighCloud3.''.$HeightOfHighCloud3;  //GET FEW.0.THREE DIGITS FROM STRING

                                }elseif(($data['OktasOfHighClouds3']==3) ||($data['OktasOfHighClouds3']==4) ){
                                    $OktasOfHighCloud3='SCT';
                                    $HeightOfHighCloud3=($data['HeightOfHighClouds3']<10000)?'0'.substr($data['HeightOfHighClouds3'],0,2):substr($data['HeightOfHighClouds3'],0,3);
                                    $OktasAndHeightOfHighCloud3=$OktasOfHighCloud3.''.$HeightOfHighCloud3;  //GET FEW.0.THREE DIGITS FROM STRING


                                }elseif(($data['OktasOfHighClouds3']==5) ||($data['OktasOfHighClouds3']==6) || ($data['OktasOfHighClouds3']==7) ){
                                    $OktasOfHighCloud3='BKN';
                                    $HeightOfHighCloud3=($data['HeightOfHighClouds3']<10000)?'0'.substr($data['HeightOfHighClouds3'],0,2):substr($data['HeightOfHighClouds3'],0,3);
                                    $OktasAndHeightOfHighCloud3=$OktasOfHighCloud3.''.$HeightOfHighCloud3;  //GET FEW.0.THREE DIGITS FROM STRING



                                }elseif(($data['OktasOfHighClouds3']==8)  ){
                                    $OktasOfHighCloud3='OVC';
                                    $HeightOfHighCloud3=($data['HeightOfHighClouds3']<10000)?'0'.substr($data['HeightOfHighClouds3'],0,2):substr($data['HeightOfHighClouds3'],0,3);
                                    $OktasAndHeightOfHighCloud3=$OktasOfHighCloud3.''.$HeightOfHighCloud3;  //GET FEW.0.THREE DIGITS FROM STRING

                                } ?>
                                <?php
                                //END OF THIRD LINE OF HIGH CLOUDS 
                                
                                ?>

                                <?php
                                 $cloudsheights3= array();
                                 ($data['HeightOfHighClouds1']!=0)?array_push($cloudsheights3, $data['HeightOfHighClouds1']):'';
                                 ($data['HeightOfHighClouds2']!=0)?array_push($cloudsheights3, $data['HeightOfHighClouds2']):'';
                                 ($data['HeightOfHighClouds3']!=0)?array_push($cloudsheights3, $data['HeightOfHighClouds3']):'';
                                 sort($cloudsheights3);
                                 $no_ofclouds=count($cloudsheights3);
                                 if($no_ofclouds>=1){
                                     if(($cloudsheights3[0]==$data['HeightOfHighClouds1'])){$mshc=$OktasAndHeightOfHighCloud1;}
                                     if(($cloudsheights3[0]==$data['HeightOfHighClouds2'])){$mshc=$OktasAndHeightOfHighCloud2;}
                                     if(($cloudsheights3[0]==$data['HeightOfHighClouds3'])){$mshc=$OktasAndHeightOfHighCloud3;}
                                     
                                   }else{
                                     $mshc ="";
                                   }
                                
                                ?> 
                                

                               <?php //air Temp is Dry Bulb ?>

                                <?php
                                $DryBulb=round($data['Dry_Bulb']);
                                $WetBulb=$data['Wet_Bulb'];

                                $Dew_PointTemperature=((3 * $WetBulb ) - ($DryBulb) )/ 2;

                                //TTTdTd is DryBulb|DewPointTemperature
                                ?>
                                <?php if(($data['Visibility']==9999)&&
                                (($data['HeightOfLowClouds1']==0)&&($data['HeightOfLowClouds2']==0)&&($data['HeightOfLowClouds2']==0))
                                && ((($data['HeightOfMediumClouds1']>10000)||($data['HeightOfMediumClouds2']>10000)||($data['HeightOfMediumClouds3']>10000))
                                || (($data['HeightOfHighClouds1']>10000)||($data['HeightOfHighClouds2']>10000)||($data['HeightOfHighClouds3']>10000)))
                                ){ ?>
                                
                                <td colspan="7"><h6 style="letter-spacing:40px;font-size:16px;font-weight:bold;" class="text-center">C A V O K</h6></td>  <!-- Qfehpa -->
                                <?php }else if(
                                    ($data['Visibility']!=9999)&&
                                    (($data['HeightOfLowClouds1']==0)&&($data['HeightOfLowClouds2']==0)&&($data['HeightOfLowClouds2']==0))
                                    && ((($data['HeightOfMediumClouds1']>10000)||($data['HeightOfMediumClouds2']>10000)||($data['HeightOfMediumClouds3']>10000))
                                    || (($data['HeightOfHighClouds1']>10000)||($data['HeightOfHighClouds2']>10000)||($data['HeightOfHighClouds3']>10000)))
                                ){ ?>
                                <td >
                                <?php
                                  if($data['Visibility'] > 3000){
                                 echo $data[''];
                                   } elseif((strcmp($data['Visibility'],"oblique")==0)){
                                    echo "VV///";
                                    }else{
                                    echo ($data['Visibility']==0)?" ":$data['Visibility'];
                                   }
                                ?>
                                 </td>   <!-- WWorCOVAK -->
                                <td><?php echo ($data['runwayVisualRange']==0)?" ":$data['runwayVisualRange'];?></td>  <!-- RV VRVRVRVR -->
                                <td><?php echo $data['recent_weather'];?></td>
                                <td colspan="4"><h6 style="letter-spacing:50px;font-size:16px;font-weight:bold;text-align:center;" class="text-center"> N S C</h6></td>  <!-- Qfehpa -->
                                <style>
                                </style>
                                <?php }else{ ?>
                                <td >
                                <?php
                                  if($data['Visibility'] > 3000){
                                 echo $data[''];
                                   } elseif((strcmp($data['Visibility'],"oblique")==0)){
                                    echo "VV///";
                                    }else{
                                    echo ($data['Visibility']==0)?" ":$data['Visibility'];
                                   }
                                ?>
                                </td>  <!-- WWorCOVAK -->
                                <td><?php echo ($data['runwayVisualRange']==0)?" ":$data['runwayVisualRange'];?></td>  <!-- RV VRVRVRVR -->
                                <td><?php echo $data['recent_weather'];?></td>
                                <?php 
                                   if((($mshl!=0)||($mshl2!=0))&&($mshm>10000))$msmc="";
                                   if((($mshl!=0)||($mshl2!=0))&&($mshh>10000))$mshc="";
                                   $clouds= array();
                                   ($mslc!="")?array_push($clouds, $mslc):'';
                                   ($mslc2!="")?array_push($clouds, $mslc2):'';
                                   ($msmc!="")?array_push($clouds, $msmc):'';
                                   ($mshc!="")?array_push($clouds, $mshc):'';
                                   $no_ofclouds=count($clouds);
                                   if($no_ofclouds==1){
                                       echo '<td>'.$clouds[0].'</td><td></td><td></td><td></td>';
                                   }
                                   if($no_ofclouds==2){
                                    echo '<td>'.$clouds[0].'</td><td>'.$clouds[1].'</td><td></td><td></td>';
                                  }
                                  if($no_ofclouds==3){
                                    echo '<td>'.$clouds[0].'</td><td>'.$clouds[1].'</td><td>'.$clouds[2].'</td><td></td>';
                                  }
                                  if($no_ofclouds==4){
                                    echo '<td>'.$clouds[0].'</td><td>'.$clouds[1].'</td><td>'.$clouds[2].'</td><td>'.$clouds[3].'</td>';
                                  }
                                  if($no_ofclouds==0){
                                    echo '<td></td><td></td><td></td><td></td>';
                                  }
                                 
                                ?>
                                <?php } ?>
                                <?php
                                $DryBulb=round($data['Dry_Bulb']);
                                $WetBulb=$data['Wet_Bulb'];

                                $Dew_PointTemperature=((3 * $WetBulb ) - ($DryBulb) )/ 2;

                                //TTTdTd is DryBulb|DewPointTemperature
                                ?>

                                
                               <?php if((strcmp($data['MSLPr'],'oblique')==0)){
                                     $mslpr_oblique= "Q<i  style='text-decoration:line-through'>/////</i> ";
                                } elseif(($data['MSLPr']!=0)){
                                     $mslpr_oblique=round((0.02952998751 * $data['MSLPr']),3) ;
                                }else{
                                     $mslpr_oblique="";  
                                }
                                ?>
                                
                                

                                 <td ><?php echo ($Dew_PointTemperature==0)?" ": $DryBulb.'|'.round($Dew_PointTemperature);?></td> <!-- TTTdTd -->
                                <td><?php echo ( $data['MSLPr']!=0)?'Q'.$data['MSLPr']:"";?></td>
                                <td><?php echo  $mslpr_oblique;?></td>
                                <td><?php echo ( $data['CLP']!=0)?'A'.$data['CLP']:"";?></td>
                                 <td><?php echo ($data['CLP']==0)?" ":round((0.02952998751 * $data['CLP']),3) ;?></td>
                                <td><?php echo ($data['recent_weather']!=' ')?'RE'.$data['recent_weather']:"";?></td>



                            </tr>
                        <?php
                        }
                    ?>
                </table>
                <input type="hidden"  name="date" value="<?php echo $date;?>"/>
                <input type="hidden"  name="stationName" value="<?php echo $stationName;?>"/>
                <input type="hidden"  name="stationNumber" value="<?php echo $stationNumber;?>"/>
                <input type="hidden"  name="reporttype" value="specieport"/>
                <br><br>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
                <span><strong>WDR Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
                 <br><br><br><br>
                <button onClick="print(); return false;" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
                <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
                  <?php if ($userrole=='Senior Weather Observer'){

                } else{ ?>
                <button  id="reportIssue" type="submit" class="btn btn-primary no-print" style="margin-left:150px;"  ><i class="fa fa-envelope-o"></i> Report Issues to OC</button>

                <?php  } ?> 
                <a href="<?php echo base_url()."index.php/speciReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
                <div class="clearfix"></div>
                <br><br>
             <?php  }
            else if(is_array($specireportdataforADayFromObservationSlipTable)
                && count($specireportdataforADayFromObservationSlipTable) <= 0)
                            {

     $date= $displayspeciReportHeaderFields['date'];
     //get the day in words.
     $dayInWords=date('l', strtotime($date));
     //Month
     //$month = date('m', strtotime($loop->date));
     $region =$displayspeciReportHeaderFields['region'];
     $stationName=$displayspeciReportHeaderFields['station'];
     $stationNumber=$displayspeciReportHeaderFields['stationNumber'];
     $date1 =$displayspeciReportHeaderFields['date1'];
     $date2 =$displayspeciReportHeaderFields['date2'];

     ?>

     <center>
         <?php echo "
         <span class='text-dangered'>No speci Report Data Yet for ".$stationName.', '.$region.' region from  '.$date1. ' to '.$date2.' at '.$time.' from our records</span>'; ?>
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
    $('.clock-rm1').click(function(){
      $('#timepicker1').val('');
    });
     $('.clock-rm2').click(function(){
      $('#timepicker2').val('');
    });

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
            //Post speci form data into the DB
            //Validate each field before inserting into the DB
            $('#generatespeciReport_button').click(function(event) {


                // ManagerCheck that Manager station isManagercted from Managerist of stations(Admin)
                var stationManager=$('#stationManager').val();
                if(stationManager==""){  // returns Managerif the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#stationManager').val("");  //Clear the field.
                   // $("#stationManager").focus();
                    $("#stationManager").focus();
                    return false;
                }
                //Manager that the a stationManagerer is selectManagerom the list of stations(Admin)
                var stationNoManager=$('#stationNoManager').val();
                if (stationNoManager==""){  // returns true if the variable does NOT contManager valid number
                    alert("Station Number not picked");
                    $('#stationNoManager').val("");  //Clear the field.
                    $("#stationNoManager").focus();
                    return false;

                }

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
                //Check that the TIME is selected from the list of TIME for the METAR
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
