<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];

?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dekadal Report
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dekadal Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
        <?php if(!isset($reportonly)){ ?>
            <form autocomplete="off" action="<?php echo base_url(); ?>index.php/ReportsController/displaydekadalreport/" method="post" enctype="multipart/form-data">
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
                elseif($userrole=='ManagerData' ||  $userrole=='ManagerStationNetworks' || $userrole=='Director'  || $userrole == 'WeatherAnalyst'){?>


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
                    }elseif($userrole== "ZonalOfficer"){

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
                                <input type="hidden" name="page" value="monthly_rainfall_report">

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNoOC" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php }elseif($userrole=='ManagerData' || $userrole== 'ZonalOfficer' || $userrole== 'SeniorZonalOfficer' || $userrole=='ManagerStationNetworks' || $userrole=='Director' || $userrole == 'WeatherAnalyst'){?>
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
                            <span class="input-group-addon">From Date</span>
                            <input type="text" name="fromdate" id="date" class="form-control summonth" placeholder="Please select the date" autocomplete='off'>
                        </div>
                    </div>
                </div>

                <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> ToDate</span>
                            <input type="text" name="todate" id="expdate" class="form-control summonth" placeholder="Please select the date" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="col-xs-2">
                    <input type="submit" name="generateDekadalReport_button" id="generateDekadalReport_button" class="btn btn-primary" value="Generate report" >
                </div>
            </form>
            <?php } ?>
        </div>
        <hr>
    </div>
    <?php
    if(is_array($displayDekadalReportHeaderFields) && count($displayDekadalReportHeaderFields)){

        //$range= $displayDekadalReportHeaderFields['range'];
        $stationName=$displayDekadalReportHeaderFields['stationName'];
        $stationNumber=$displayDekadalReportHeaderFields['stationNumber'];

        //$monthAsANumber=0;
        $FromDate= $displayDekadalReportHeaderFields['FromDate'];
        $ToDate= $displayDekadalReportHeaderFields['ToDate'];
        $blocknumber=$displayDekadalReportHeaderFields['blocknumber'];
         $regnumber=$displayDekadalReportHeaderFields['regnumber'];
        //$monthInWords= $displayDekadalReportHeaderFields['monthInWords'];
        $monthAsANumber= $displayDekadalReportHeaderFields['monthAsANumberselected'];

        $year= $displayDekadalReportHeaderFields['year'];


        ///php
        // $dateValue = strtotime('2012-06-05');
        // $year = date('Y',$dateValue);
        // $monthName = date('F',$dateValue);
        //date('m', strtotime($fromdate));
        //date('d', strtotime($fromdate));


        $FromDatemonthDay =date('j',strtotime($FromDate)); //get the day num from the date.e.g 6th
        $ToDatemonthDay = date('j',strtotime($ToDate));


        // $splt_range = split("-",$range);
        // $splt_frst = split("/",$splt_range[0]);
        // $mnth_yr = $splt_frst[0].'/'.$splt_frst[2];

        //$range = $_GET['range'];
        // $splt = split("-",$range);
        // $first = split("/",$splt[0]);
        // $last = split("/",$splt[1]);

        // $start = $first[2].'-'.$first[0].'-'.$first[1];
        // $end = $last[2].'-'.$last[0].'-'.$last[1];
        //}
        ?>

    
            <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
            <h3>TEN DAY (DEKADAL) REPORT</h3>
        
         <div class="col-lg-2"  style="float: right; margin-top: -10%; width: 145px;">
                <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
                <?php if(strcmp('Senior Weather Observer',$userrole)==0){ if($exists!=1){ ?>
            <form style="margin-right:140px;" action="<?php echo base_url(); ?>index.php/ReportsController/displaydekadalreport/" method="post">
            <input type="hidden"  name="fromdate" value="<?php echo $FromDate;?>"/>
            <input type="hidden"  name="todate" value="<?php echo $ToDate;?>"/>
            <input type="hidden"  name="stationOC" value="<?php echo $stationName;?>"/>
            <input type="hidden"  name="stationNoOC" value="<?php echo $stationNumber;?>"/>
            <input type="hidden"  name="reporttype" value="dekadal"/>
            <button  type="submit" name="sendreporttozone" class="btn btn-info btn-xs no-print"  data-export="export"><i class="fa fa-print"></i> Send Report to Region</button>
          </form>
        <?php }else{ ?>
          <p style="color:green;"><i class="fa fa-check"> </i>Report sent</p>
        <?php } }if(strcmp('SeniorZonalOfficer',$userrole)==0||strcmp('ZonalOfficer',$userrole)==0){ 
            if(isset($reportonly)){ 
          foreach($reportrecord->result() as $reportrecod)  {
              
              if(strcmp($reportrecod->forwardtomanager,"False")==0){
             ?>
           <form style="margin-right:140px;" action="<?php echo base_url(); ?>index.php/ReportsController/displaydekadalreport/" method="post">
            <input type="hidden"  name="forward" value="True"/>
            
            <!-- <input type="hidden"  name="RegionName" value="Central"/> -->
            <input type="hidden"  name="station" value="<?php echo $stationName;?>"/>
            <input type="hidden"  name="stationNoManager" value="<?php echo $stationNumber;?>"/>
            <input type="hidden"  name="fromdate" value="<?php echo $reportrecod->startdate;?>"/>
            <input type="hidden"  name="todate" value="<?php echo $reportrecod->enddate;?>"/>
            <input type="hidden"  name="record_id" value="<?php echo $reportrecod->id; ?>"/>
            <button  type="submit" name="sendreporttomanager" class="btn btn-info btn-xs no-print"  data-export="export"><i class="fa fa-print"></i> Send Report to manager</button>
           </form>
        <?php }else{ ?>
            <p style="color:green;"><i class="fa fa-check"> </i>Report sent</p>
        <?php } } } }?>
        </div>

        <span><strong>Weather Station</strong></span>
        <span class="dotted-line"><?php echo $stationName;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Registration Number</strong></span> <span class="dotted-line"><?php echo $regnumber;?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Dekad</strong></span><span class="dotted-line">
            <?php  
            if($FromDatemonthDay==1 && $ToDatemonthDay == 10) 
            echo 1;
             elseif($FromDatemonthDay == 11 && $ToDatemonthDay == 20) 
                echo 2;
             elseif($FromDatemonthDay >=21)
            echo 3;
        ?>
        </span>
        <span class="dotted-line"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Month/Year</strong></span> <span class="dotted-line"><?php echo $monthAsANumber. '/'.$year;?></span>


        <div class="clearfix"></div>
        <br>
        <!-- <p><strong>Reading of selected parameters</strong></p> -->
        <table class="report-table" id="table2excel">
        <tr>
            <td class="main" colspan="10">  <center>TIME OF OBSERVATION 9:00 AM </center>  </td>
            <td class="main" colspan="7"> <center> TIME OF OBSERVATION 3:00 PM </center>    </td>
        </tr>

        <tr>
            <td class="main" rowspan="2">DATE </br> OF </br> MONTH</td>
            <td class="main" colspan="5"><center>TEMPERATURES</center></td>

            <td class="main" rowspan="2">RELATIVE </br> HUMIDITY</td>
            <td class="main" colspan="2"> <center>WIND</center></td>
            <td class="main" rowspan="2">RAIN </br> FALL</td>
            <td class="main" colspan="3"> <center>TEMPERATURES</center>   </td>

            <td class="main" rowspan="2">RELATIVE </br> HUMIDITY</td>
            <td class="main" colspan="2"> <center>WIND</center></td>


        </tr>

        <tr>
            <td class="main">MAX </td>
            <td class="main">MIN</td>
            <td class="main">DRY </br> BULB</td>
            <td class="main">WET </br> BULB</td>
            <td class="main">DEW </br> POINT</td>
            <td class="main">DIRECTION</td>
            <td class="main">SPEED</td>
            <td class="main">DRY </br> BULB</td>
            <td class="main">WET </br> BULB</td>
            <td class="main">DEW </br> POINT</td>
            <td class="main">DIRECTION</td>
            <td class="main">SPEED</td>
        </tr>

        <?php
        $count = 0;
        if (is_array($DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z) ||
            is_array($DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z)) {

            //Create Arrays to store data to be formated e.g if data for a day is missing we insert it
            $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z=array();
            $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z=array();


            //First loop thru  the array for observationslip with TIME 0600Z and then  insert it into the different array we have created
            //format if day not there.
            //the days of the Month
            $printTime0600Z=0;
            $indexTime0600Z=0;
            for($daynum = $FromDatemonthDay; $daynum<=$ToDatemonthDay; $daynum++ ){

                foreach($DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600ZMonthDayNo"]=$data->DayOfTheMonth;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Max_Read"]=$data->Max_Read;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Min_Read"]=$data->Min_Read;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Dry_Bulb"]=$data->Dry_Bulb;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Wet_Bulb"]=$data->Wet_Bulb;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Wind_Direction"]=$data->Wind_Direction;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Wind_Speed"]=$data->Wind_Speed;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Rainfall"]=$data->Rainfall;

                        $printTime0600Z=1;
                        $indexTime0600Z++;

                        break;
                    }//end of if
                    else{

                        $printTime0600Z=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($printTime0600Z==0){

                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600ZMonthDayNo"]=$daynum;
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Max_Read"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Min_Read"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Dry_Bulb"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Wet_Bulb"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Wind_Direction"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Wind_Speed"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$indexTime0600Z]["DekadalTime0600Z_Rainfall"]='';

                    $indexTime0600Z++;
                }//end of if
            }//end of for loop for OS TIME 0600Z
            ///////////////////////////////////////
            //First loop thru  the array for observationslip with TIME 1200Z and then format if day not there.
            //the days of the Month
            $printTime1200Z=0;
            $indexTime1200Z=0;
            for($daynum = $FromDatemonthDay; $daynum<=$ToDatemonthDay; $daynum++ ){

                foreach($DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z as $data){
                    // if the day exists in the array we populate it into another array else we
                    if ($daynum==$data->DayOfTheMonth) {

                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200ZMonthDayNo"]=$data->DayOfTheMonth;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200Z_Dry_Bulb"]=$data->Dry_Bulb;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200Z_Wet_Bulb"]=$data->Wet_Bulb;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200Z_Wind_Direction"]=$data->Wind_Direction;
                        $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200Z_Wind_Speed"]=$data->Wind_Speed;

                        $printTime1200Z=1;
                        $indexTime1200Z++;

                        break;
                    }//end of if
                    else{

                        $printTime1200Z=0;
                    }

                } //end of foreach to print all values that are in the report array
                //if the day does not exist we populate it into array but in right order
                if($printTime1200Z==0){

                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200ZMonthDayNo"]=$daynum;
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200Z_Dry_Bulb"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200Z_Wet_Bulb"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200Z_Wind_Direction"]='';
                    $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$indexTime1200Z]["DekadalTime1200Z_Wind_Speed"]='';

                    $indexTime1200Z++;
                }//end of if
            }//end of for loop for OS TIME 1200Z
            ?>
            <?php
            //nid to create an array with row contain each (corresponding e.g first of each row) row of each array
            $finalarraymerge=array();
            $i = 0;

            for($daynum = $FromDatemonthDay; $daynum<=$ToDatemonthDay; $daynum++ ){
                //FOR 0600Z
                $finalarraymerge [$i]["DekadalTime0600Z_MonthDayNo"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600ZMonthDayNo'];
                $finalarraymerge [$i]["DekadalTime0600Z_Max_Read"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Max_Read'];
                $finalarraymerge [$i]["DekadalTime0600Z_Min_Read"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Min_Read'];
                $finalarraymerge [$i]["DekadalTime0600Z_Dry_Bulb"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Dry_Bulb'];
                $finalarraymerge [$i]["DekadalTime0600Z_Wet_Bulb"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Wet_Bulb'];
                //CAL THE DEW POINT
                $DP_0600Z=(((3 * $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Wet_Bulb']) - $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Dry_Bulb']) / 2);
                $finalarraymerge [$i]["DekadalTime0600Z_Dew_Point"]= round($DP_0600Z,2);
                //Cal the Relative Humidity
                $RH_0600Z=(100 * $finalarraymerge [$i]["DekadalTime0600Z_Dew_Point"])/$array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Dry_Bulb'];
                if(empty($finalarraymerge [$i]["DekadalTime0600Z_Dew_Point"]) || empty($array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Dry_Bulb'])){
                    $finalarraymerge [$i]["DekadalTime0600Z_Relative_Humidity"]='';
                } elseif (isset($finalarraymerge [$i]["DekadalTime0600Z_Dew_Point"])|| isset($array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Dry_Bulb'])) {
                    $finalarraymerge [$i]["DekadalTime0600Z_Relative_Humidity"]= round($RH_0600Z,0);
                }
                
                $finalarraymerge [$i]["DekadalTime0600Z_Wind_Direction"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Wind_Direction'];
                $finalarraymerge [$i]["DekadalTime0600Z_Wind_Speed"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Wind_Speed'];
                $finalarraymerge [$i]["DekadalTime0600Z_Rainfall"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime0600Z[$i]['DekadalTime0600Z_Rainfall'];


                ///FOR 1200Z
                $finalarraymerge [$i]["DekadalTime1200Z_MonthDayNo"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200ZMonthDayNo'];

                $finalarraymerge [$i]["DekadalTime1200Z_Dry_Bulb"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Dry_Bulb'];
                $finalarraymerge [$i]["DekadalTime1200Z_Wet_Bulb"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Wet_Bulb'];
                //CAL THE DEW POINT
                $DP_1200Z=(((3 * $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Wet_Bulb']) - $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Dry_Bulb']) / 2);
                $finalarraymerge [$i]["DekadalTime1200Z_Dew_Point"]= round($DP_1200Z,2);
                //Cal the Relative Humidity
                $RH_1200Z=(100 * $finalarraymerge [$i]["DekadalTime1200Z_Dew_Point"])/$array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Dry_Bulb'];

                 if(empty($finalarraymerge [$i]["DekadalTime1200Z_Dew_Point"]) || empty($array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Dry_Bulb'])){
                    $finalarraymerge [$i]["DekadalTime1200Z_Relative_Humidity"]='';
                } elseif (isset($finalarraymerge [$i]["DekadalTime1200Z_Dew_Point"])|| isset($array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Dry_Bulb'])) {
                    $finalarraymerge [$i]["DekadalTime1200Z_Relative_Humidity"]= round( $RH_1200Z,0);
                }
               // $finalarraymerge [$i]["DekadalTime1200Z_Relative_Humidity"]= round($RH_1200Z,0);
                $finalarraymerge [$i]["DekadalTime1200Z_Wind_Direction"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Wind_Direction'];
                $finalarraymerge [$i]["DekadalTime1200Z_Wind_Speed"]= $array_DekadalReportForGivenRangeOfDaysInAMonthTime1200Z[$i]['DekadalTime1200Z_Wind_Speed'];


                $i++;
            }  //end of for loop.

             $TotalMax=0.0;
             $TotalRowswithDataCountForMaxTemp=0;

            $TotalMin=0.0;
            $TotalRowswithDataCountForMinTemp=0;

            $TotalDB_0600Z=0.0;
            $TotalRowswithDataCountForDB_0600Z=0;

             $TotalWB_0600Z=0.0;
            $TotalRowswithDataCountForWB_0600Z=0;

             $TotalDP_0600Z=0.0;
            $TotalRowswithDataCountForDP_0600Z=0;

             $TotalRH_0600Z=0.0;
            $TotalRowswithDataCountForRH_0600Z=0;

             $TotalWIND_DIR_0600Z=0.0;
            $TotalRowswithDataCountForWIND_DIR_0600Z=0;

             $TotalFF_0600Z=0.0;
            $TotalRowswithDataCountForFF_0600Z=0;

            $TotalRainfall+=0.0;
            $TotalRowswithDataCountForRainfall=0;

            /////////////////////////////////////////////////////////////

            $TotalDB_1200Z=0.0;
            $TotalRowswithDataCountForDB_1200Z=0;

             $TotalWB_1200Z=0.0;
            $TotalRowswithDataCountForWB_1200Z=0;

            $TotalDP_1200Z=0.0;
            $TotalRowswithDataCountForDP_1200Z=0;

             $TotalRH_1200Z=0.0;
            $TotalRowswithDataCountForRH_1200Z=0;

             $TotalWIND_DIR_1200Z=0.0;
            $TotalRowswithDataCountForWIND_DIR_1200Z=0;

            $TotalFF_1200Z=0.0;
            $TotalRowswithDataCountForFF_1200Z=0;

            ?>
            <?php

             foreach($finalarraymerge as $data){

                //TOTAL MAX TEMPERATURE
                if($data['DekadalTime_Max_Read']!='' && $data['DekadalTime1200Z_Max_Read'] !='' ){
                   //not null ,not null for both times.We tek data for 0600Z time

                    $TotalMax+=$data['DekadalTime_Max_Read'];
                    $TotalRowswithDataCountForMaxTemp+=1;

                }elseif($data['DekadalTime0600Z_Max_Read'] =='' && $data['DekadalTime1200Z_Max_Read'] !=''){
                         //null , not null

                    $TotalMax+=$data['DekadalTime1200Z_Max_Read'];
                    $TotalRowswithDataCountForMaxTemp+=1;

                }elseif($data['DekadalTime0600Z_Max_Read'] !='' && $data['DekadalTime1200Z_Max_Read'] ==''){  //not null, null
                    $TotalMax+=$data['DekadalTime0600Z_Max_Read'];
                    $TotalRowswithDataCountForMaxTemp+=1;

                }
                elseif($data['DekadalTime0600Z_Max_Read'] =='' && $data['DekadalTime1200Z_Max_Read'] ==''){  //null,null
                    $TotalMax+=0.0;
                    $TotalRowswithDataCountForMaxTemp+=0;

                }
                ////////////////////////////////// TOTAL MIN TEMPERATURE
                if($data['DekadalTime0600Z_Min_Read']!='' && $data['DekadalTime1200Z_Min_Read'] !='' ){  //not null ,not null

                    $TotalMin+=$data['DekadalTime0600Z_Min_Read'];
                    $TotalRowswithDataCountForMinTemp+=1;

                }elseif($data['DekadalTime0600Z_Min_Read'] =='' && $data['DekadalTime1200Z_Min_Read'] !=''){ //null , not null

                    $TotalMin+=$data['DekadalTime1200Z_Min_Read'];
                    $TotalRowswithDataCountForMinTemp+=1;

                }elseif($data['DekadalTime0600Z_Min_Read'] !='' && $data['DekadalTime1200Z_Min_Read'] ==''){  //not null, null
                    $TotalMin+=$data['DekadalTime0600Z_Min_Read'];
                    $TotalRowswithDataCountForMinTemp+=1;

                }
                elseif($data['DekadalTime0600Z_Min_Read'] =='' && $data['DekadalTime1200Z_Min_Read'] ==''){  //null,null
                    $TotalMin+=0;
                    $TotalRowswithDataCountForMinTemp+=0;

                }
                //////////////TOTAL SUNSHINE

                /////TOTAL DB FOR 0600Z
                if($data['DekadalTime0600Z_Dry_Bulb']!=''){

                    $TotalDB_0600Z+=$data['DekadalTime0600Z_Dry_Bulb'];
                    $TotalRowswithDataCountForDB_0600Z+=1;
                }
                elseif($data['DekadalTime0600Z_Dry_Bulb']==''){

                    $TotalDB_0600Z+=0.0;
                    $TotalRowswithDataCountForDB_0600Z+=0;
                }

                /////TOTAL WB FOR 0600Z
                if($data['DekadalTime0600Z_Wet_Bulb']!=''){

                    $TotalWB_0600Z+=$data['DekadalTime0600Z_Wet_Bulb'];
                    $TotalRowswithDataCountForWB_0600Z+=1;
                }
                elseif($data['DekadalTime0600Z_Wet_Bulb']==''){

                    $TotalWB_0600Z+=0.0;
                    $TotalRowswithDataCountForWB_0600Z+=0;
                }

                /////TOTAL DP FOR 0600Z
                if($data['DekadalTime0600Z_Dew_Point']!=''){

                    $TotalDP_0600Z+=$data['DekadalTime0600Z_Dew_Point'];
                    $TotalRowswithDataCountForDP_0600Z+=1;
                }
                elseif($data['DekadalTime0600Z_Dew_Point']==''){

                    $TotalDP_0600Z+=0.0;
                    $TotalRowswithDataCountForDP_0600Z+=0;
                }

                /////TOTAL VP FOR 0600Z
                // if($data['VapourPressure_0600Z']!=''){

                //     $TotalVP_0600Z+=$data['VapourPressure_0600Z'];
                //     $TotalRowswithDataCountForVP_0600Z+=1;
                // }
                // elseif($data['VapourPressure_0600Z']==''){

                //     $TotalVP_0600Z+=0.0;
                //     $TotalRowswithDataCountForVP_0600Z+=0;
                // }

                /////TOTAL RH FOR 0600Z
                if($data['DekadalTime0600Z_Relative_Humidity']!=0){

                    $TotalRH_0600Z+=$data['DekadalTime0600Z_Relative_Humidity'];
                    $TotalRowswithDataCountForRH_0600Z+=1;
                }
                elseif($data['DekadalTime0600Z_Relative_Humidity']==0 ||  $data['DekadalTime0600Z_Relative_Humidity']=='' || is_nan($data['DekadalTime0600Z_Relative_Humidity'])){

                    $TotalRH_0600Z+=0.0;
                    $TotalRowswithDataCountForRH_0600Z+=0;
                }

                // /////TOTAL CLP FOR 0600Z
                // if($data['OSTime0600Z_CLP']!=''){

                //     $TotalCLP_0600Z+=$data['OSTime0600Z_CLP'];
                //     $TotalRowswithDataCountForCLP_0600Z+=1;
                // }
                // elseif($data['OSTime0600Z_CLP']==''){

                //     $TotalCLP_0600Z+=0.0;
                //     $TotalRowswithDataCountForCLP_0600Z+=0;
                // }

                // /////TOTAL GPM FOR 0600Z
                // if($data['GPM_0600Z']!=''){

                //     $TotalGPM_0600Z+=$data['GPM_0600Z'];
                //     $TotalRowswithDataCountForGPM_0600Z+=1;
                // }
                // elseif($data['GPM_0600Z']==''){

                //     $TotalGPM_0600Z+=0.0;
                //     $TotalRowswithDataCountForGPM_0600Z+=0;
                // }

                /////TOTAL WIND DIR FOR 0600Z
                if($data['DekadalTime0600Z_Wind_Direction']!=''){

                    $TotalWIND_DIR_0600Z+=$data['DekadalTime0600Z_Wind_Direction'];
                    $TotalRowswithDataCountForWIND_DIR_0600Z+=1;
                }
                elseif($data['DekadalTime0600Z_Wind_Direction']==''){

                    $TotalWIND_DIR_0600Z+=0.0;
                    $TotalRowswithDataCountForWIND_DIR_0600Z+=0;
                }

                /////TOTAL FF FOR 0600Z
                if($data['DekadalTime0600Z_Wind_Speed']!=''){

                    $TotalFF_0600Z+=$data['DekadalTime0600Z_Wind_Speed'];
                    $TotalRowswithDataCountForFF_0600Z+=1;
                }
                elseif($data['DekadalTime0600Z_Wind_Speed']==''){

                    $TotalFF_0600Z+=0.0;
                    $TotalRowswithDataCountForFF_0600Z+=0;
                }

                /////TOTAL WIND RUN FOR 0600Z
                // if($data['OSTime0600Z_Wind_Run']!=''){

                //     $TotalWind_Run_0600Z+=$data['OSTime0600Z_Wind_Run'];
                //     $TotalRowswithDataCountForWind_Run_0600Z+=1;
                // }
                // elseif($data['OSTime0600Z_Wind_Run']==''){

                //     $TotalWind_Run_0600Z+=0.0;
                //     $TotalRowswithDataCountForWind_Run_0600Z+=0;
                // }

                ///////////////////////////////////TOTALS FOR 1200Z.
                /////TOTAL DB FOR 1200Z
                if($data['DekadalTime1200Z_Dry_Bulb']!=''){

                    $TotalDB_1200Z+=$data['DekadalTime1200Z_Dry_Bulb'];
                    $TotalRowswithDataCountForDB_1200Z+=1;
                }
                elseif($data['DekadalTime1200Z_Dry_Bulb']==''){

                    $TotalDB_1200Z+=0.0;
                    $TotalRowswithDataCountForDB_1200Z+=0;
                }

                /////TOTAL WB FOR 1200Z
                if($data['DekadalTime1200Z_Wet_Bulb']!=''){

                    $TotalWB_1200Z+=$data['DekadalTime1200Z_Wet_Bulb'];
                    $TotalRowswithDataCountForWB_1200Z+=1;
                }
                elseif($data['DekadalTime1200Z_Wet_Bulb']==''){

                    $TotalWB_1200Z+=0.0;
                    $TotalRowswithDataCountForWB_1200Z+=0;
                }

                /////TOTAL DP FOR 1200Z
                if($data['DekadalTime1200Z_Dew_Point']!=''){

                    $TotalDP_1200Z+=$data['DekadalTime1200Z_Dew_Point'];
                    $TotalRowswithDataCountForDP_1200Z+=1;
                }
                elseif($data['DekadalTime1200Z_Dew_Point']==''){

                    $TotalDP_1200Z+=0.0;
                    $TotalRowswithDataCountForDP_1200Z+=0;
                }

                /////TOTAL VP FOR 1200Z
                if($data['VapourPressure_1200Z']!=''){

                    $TotalVP_1200Z+=$data['VapourPressure_1200Z'];
                    $TotalRowswithDataCountForVP_1200Z+=1;
                }
                elseif($data['VapourPressure_1200Z']==''){

                    $TotalVP_1200Z+=0.0;
                    $TotalRowswithDataCountForVP_1200Z+=0;
                }

                /////TOTAL RH FOR 1200Z
                if($data['DekadalTime1200Z_Relative_Humidity']!=0){

                    $TotalRH_1200Z+=$data['DekadalTime1200Z_Relative_Humidity'];
                    $TotalRowswithDataCountForRH_1200Z+=1;
                }
                elseif($data['DekadalTime1200Z_Relative_Humidity']==0 || $data['DekadalTime1200Z_Relative_Humidity']=='' ){

                    $TotalRH_1200Z+=0.0;
                    $TotalRowswithDataCountForRH_1200Z+=0;
                }

                /////TOTAL CLP FOR 1200Z
                // if($data['OSTime1200Z_CLP']!=''){

                //     $TotalCLP_1200Z+=$data['OSTime1200Z_CLP'];
                //     $TotalRowswithDataCountForCLP_1200Z+=1;
                // }
                // elseif($data['OSTime1200Z_CLP']==''){

                //     $TotalCLP_1200Z+=0.0;
                //     $TotalRowswithDataCountForCLP_1200Z+=0;
                // }

                /////TOTAL GPM FOR 1200Z
                // if($data['GPM_1200Z']!=''){

                //     $TotalGPM_1200Z+=$data['GPM_1200Z'];
                //     $TotalRowswithDataCountForGPM_1200Z+=1;
                // }
                // elseif($data['GPM_1200Z']==''){

                //     $TotalGPM_1200Z+=0.0;
                //     $TotalRowswithDataCountForGPM_1200Z+=0;
                // }

                /////TOTAL WIND DIR FOR 1200Z
                if($data['DekadalTime1200Z_Wind_Direction']!=''){

                    $TotalWIND_DIR_1200Z+=$data['DekadalTime1200Z_Wind_Direction'];
                    $TotalRowswithDataCountForWIND_DIR_1200Z+=1;
                }
                elseif($data['DekadalTime1200Z_Wind_Direction']==''){

                    $TotalWIND_DIR_1200Z+=0.0;
                    $TotalRowswithDataCountForWIND_DIR_1200Z+=0;
                }

                /////TOTAL FF FOR 1200Z
                if($data['DekadalTime1200Z_Wind_Speed']!=''){

                    $TotalFF_1200Z+=$data['DekadalTime1200Z_Wind_Speed'];
                    $TotalRowswithDataCountForFF_1200Z+=1;
                }
                elseif($data['DekadalTime1200Z_Wind_Speed']==''){

                    $TotalFF_1200Z+=0.0;
                    $TotalRowswithDataCountForFF_1200Z+=0;
                }
///////////////////////////////////////////////////////////////////////////////////////////////////////////
                /////TOTAL WIND RUN
               




            }//END OF FOREACH
            //FIRST LOOP THR THE ARRAY
            foreach($finalarraymerge as $data){ ?>

                <tr>
                    <td class="main"><?php echo $data['DekadalTime0600Z_MonthDayNo'];?></td>

                    <td class="main"><?php echo $data['DekadalTime0600Z_Max_Read'];?></td>
                    <td class="main"><?php echo $data['DekadalTime0600Z_Min_Read'];?></td>
                    <td class="main"><?php echo $data['DekadalTime0600Z_Dry_Bulb'];?></td>
                    <td class="main"><?php echo $data['DekadalTime0600Z_Wet_Bulb'];?></td>

                    <?php
                    if($data['DekadalTime0600Z_Dew_Point']==0 ) {
                        ?>
                        <td class="main"></td>
                    <?php
                    }else{  ?>

                        <td class="main"><?php echo $data['DekadalTime0600Z_Dew_Point'];?></td>
                    <?php
                    }
                    ?>

                    <?php
                    if($data['DekadalTime0600Z_Relative_Humidity']==0 ) {
                        ?>
                        <td class="main"></td>
                    <?php
                    }else{  ?>

                        <td class="main"><?php echo $data['DekadalTime0600Z_Relative_Humidity'];?></td>

                    <?php
                    }
                    ?>

                    <td class="main"><?php echo $data['DekadalTime0600Z_Wind_Direction'];?></td>
                    <td class="main"><?php echo $data['DekadalTime0600Z_Wind_Speed'];?></td>

                    <?php
                    if(($data['DekadalTime0600Z_Rainfall']==0) || ($data['DekadalTime0600Z_Rainfall']=='NIL') || empty($data['DekadalTime0600Z_Rainfall']) ) {
                        ?>
                        <td class="main"><?php echo 'NIL';?></td>

                    <?php  $TotalRowswithDataCountForRainfall+=0;
                    }else if(($data['DekadalTime0600Z_Rainfall'] < 0.1) || ($data['DekadalTime0600Z_Rainfall']=="TR")){
                        ?>
                        <td class="main"><?php echo 'TR';?></td>

                    <?php  $TotalRowswithDataCountForRainfall+=0;
                    }else if(($data['DekadalTime0600Z_Rainfall'] >= 0.1) && ($data['DekadalTime0600Z_Rainfall'] <= 0.9)){
                        ?>
                        <td class="main"><?php echo $data['DekadalTime0600Z_Rainfall'];?></td>

                    <?php  $TotalRainfall+=$data['DekadalTime0600Z_Rainfall'];
                                $TotalRowswithDataCountForRainfall+=0;
                    }else if($data['DekadalTime0600Z_Rainfall'] >=1.0 ) {
                        ?>
                        <td class="main"><?php echo $data['DekadalTime0600Z_Rainfall'];?></td>

                    <?php $TotalRowswithDataCountForR_DAY+=1;
                                 $TotalRainfall+=$data['DekadalTime0600Z_Rainfall'];
                                  $TotalRowswithDataCountForRainfall+=1;
                    }else {
                        ?>
                        <td class="main"><?php echo $data['DekadalTime0600Z_Rainfall'];?></td>

                    <?php }
                    ?>



                    <td class="main"><?php echo $data['DekadalTime1200Z_Dry_Bulb'];?></td>
                    <td class="main"><?php echo $data['DekadalTime1200Z_Wet_Bulb'];?></td>
                    <?php
                    if($data['DekadalTime1200Z_Dew_Point']==0 ) {
                        ?>
                        <td class="main"></td>
                    <?php
                    }else{  ?>

                        <td class="main"><?php echo $data['DekadalTime1200Z_Dew_Point'];?></td>
                    <?php
                    }
                    ?>

                    <?php
                    if($data['DekadalTime1200Z_Relative_Humidity']==0 ) {
                        ?>
                        <td class="main"></td>
                    <?php
                    }else{  ?>

                        <td class="main"><?php echo $data['DekadalTime1200Z_Relative_Humidity'];?></td>

                    <?php
                    }
                    ?>

                    <td class="main"><?php echo $data['DekadalTime1200Z_Wind_Direction'];?></td>
                    <td class="main"><?php echo $data['DekadalTime1200Z_Wind_Speed'];?></td>

                </tr>
                 


            <?php    }


            ?>

        <?php
        } //end of beginning if statement
        ?>
        <tr>
            
             <td class="main"> TOTAL</td>
             <td class="main"><?php echo round($TotalMax,2);?> </td>
            <td class="main"><?php echo round($TotalMin,2);?> </td>
            <td class="main"><?php echo round($TotalDB_0600Z,2) ;?> </td>
            <td class="main"> <?php echo round($TotalWB_0600Z,2 );?></td>
            <td class="main"><?php echo round($TotalDP_0600Z,2) ;?> </td>
             <td class="main"><?php echo round($TotalRH_0600Z,0);?> </td>
            <td class="main"><?php echo round($TotalWIND_DIR_0600Z,2) ;?> </td>
            <td class="main"> <?php echo round($TotalFF_0600Z,2) ;?></td>
            <td class="main"><?php echo round($TotalRainfall,2) ;?> </td>
            <td class="main"> <?php echo round($TotalDB_1200Z,2) ;?></td>
             <td class="main"> <?php echo round($TotalWB_1200Z,2) ;?></td>
            <td class="main"> <?php echo round($TotalDP_1200Z,2) ;?></td>
            <td class="main"><?php echo round($TotalRH_1200Z,0);?> </td>
            <td class="main"><?php echo round($TotalWIND_DIR_1200Z,2) ;?>  </td>
            <td class="main"><?php echo round($TotalFF_1200Z,2) ;?> </td>
        </tr>

        <tr>
              <td class="main"> MEAN</td>
              <td class="main"><?php echo round(($TotalMax/$TotalRowswithDataCountForMaxTemp),2) ;?> </td>
            <td class="main"><?php echo round(($TotalMin/$TotalRowswithDataCountForMinTemp),2) ;?> </td>
            <td class="main"><?php echo round(($TotalDB_0600Z/$TotalRowswithDataCountForDB_0600Z),2) ;?> </td>
            <td class="main"><?php echo round(($TotalWB_0600Z/$TotalRowswithDataCountForWB_0600Z),2) ;?> </td>
            <td class="main"> <?php echo round(($TotalDP_0600Z/$TotalRowswithDataCountForDP_0600Z),2) ;?></td>
             <td class="main"><?php echo round(($TotalRH_0600Z/$TotalRowswithDataCountForRH_0600Z),0) ;?> </td>
            <td class="main"><?php echo round($TotalWIND_DIR_0600Z/$TotalRowswithDataCountForWIND_DIR_0600Z,2) ;?> </td>
            <td class="main"> <?php echo round(($TotalFF_0600Z/$TotalRowswithDataCountForFF_0600Z),2) ;?></td>
            <td class="main"> <?php echo round(($TotalRainfall/$TotalRowswithDataCountForRainfall),2) ;?></td>
            <td class="main"><?php echo round(($TotalDB_1200Z/$TotalRowswithDataCountForDB_1200Z),2) ;?>  </td>
             <td class="main"><?php echo round(($TotalWB_1200Z/$TotalRowswithDataCountForWB_1200Z),2) ;?> </td>
            <td class="main"> <?php echo round(($TotalDP_1200Z/$TotalRowswithDataCountForDP_1200Z),2) ;?></td>
            <td class="main"> <?php echo round(($TotalRH_1200Z/$TotalRowswithDataCountForRH_1200Z),0) ;?></td>
            <td class="main"><?php echo round($TotalWIND_DIR_1200Z/$TotalRowswithDataCountForWIND_DIR_1200Z,2) ;?> </td>
            <td class="main"><?php echo round(($TotalFF_1200Z/$TotalRowswithDataCountForFF_1200Z),2) ;?>  </td> 
        </tr>
        </table>
        <br><br>


    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
    <span><strong>WDR Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>

        <br><br><br>
         <form action="<?php echo base_url(); ?>index.php/ReportOCIssues/sendData/" method="post" >
                <input type="hidden"  name="datefrom" value="<?php echo $FromDate;?>"/>
                <input type="hidden"  name="dateto" value="<?php echo $ToDate;?>"/>
                <input type="hidden"  name="stationName" value="<?php echo $stationName;?>"/>
                <input type="hidden"  name="stationNumber" value="<?php echo $stationNumber;?>"/>
                <input type="hidden"  name="reporttype" value="dekadalReport"/>
        <button type="button" onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button type="button" button id="export"   class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button type="button" button id="exportcsv" class="btn btn-primary no-print" data-export="export"><i class="fa fa-print"></i> Export to csv</button>
          <?php if ($userrole=='Senior Weather Observer'){

                } else{ ?>
                <button  id="reportIssue" type="submit" class="btn btn-primary no-print" style="margin-left:150px;"  ><i class="fa fa-envelope-o"></i> Report Issues to OC</button>

                <?php  } ?> 
        <a href="<?php echo base_url()."index.php/DekadalReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>
    <?php }?>
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
            $('#generateDekadalReport_button').click(function(event) {


                // ManagerCheck that Manager station isManagercted from Managerist of stations(Admin)
                var stationManager=$('#stationManager').val();
                if(stationManager==""){  // returns Managerif the variable does NOT contain a valid number
                    alert("Please Select A Station from the list");
                    $('#stationManager').val("");  //Clear the field.

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
                //////////////////////////////////////////////////////////////////////////////////////////////               //////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the MONTH is selected from the list of MONTHS
                var fromdate=$('#date').val();
                if(fromdate==""){  // returns true if the variable does NOT contain a valid number
                    alert("From Date Not Selected");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the YEAR is selected from the list of Year
                var todate=$('#expdate').val();
                if(todate==""){  // returns true if the variable does NOT contain a valid number
                    alert("To Date not Selected");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;

                }
/////////////////////////////////////////////////////////////////////

                var fromdate_forDekadalreport=new Date($('#date').val());
                var todate_forDekadalreport=new Date($('#expdate').val());

                //NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME YEAR
                var getyearFromThe_fromDate=fromdate_forDekadalreport.getFullYear();
                var getyearFromThe_toDate=todate_forDekadalreport.getFullYear();

                if(getyearFromThe_fromDate!=getyearFromThe_toDate){
                    //var getmonthFromThe_fromDate=fromdate_forDekadalreport.getMonth() + 1;
                    //var getmonthFromThe_toDate=todate_forDekadalreport.getMonth() + 1;
                    alert("Please Select A range within the same year");
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    return false;
                }

////////////////////////////////////////////////////////////////////////////////////////////
                ////NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME MONTH
                var getmonthFromThe_fromDate=fromdate_forDekadalreport.getMonth() + 1;
                var getmonthFromThe_toDate=todate_forDekadalreport.getMonth() + 1;


                if(getmonthFromThe_fromDate!=getmonthFromThe_toDate){
                   // alert(getmonthFromThe_toDate+"|"+getmonthFromThe_fromDate);
                    alert("Please Select A range within the same month");
                    //AirTemporDryBulbTemp+"|"+DewPoint
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    return false;
                }
//////////////////////////////////////////////////////////////////////////////////////////////////
                ///NID TO GET THE TEN DAY COUNT OF A MONTH.
                var getdayFrom_ThefromDate=parseInt(fromdate_forDekadalreport.getDate());  //get the date like 12 of the month
                var getdayFrom_ThetoDate=parseInt(todate_forDekadalreport.getDate());


                //FROM DATE RANGE(1,11,21)
                if(((getdayFrom_ThefromDate!=1)  &&  (getdayFrom_ThetoDate!=10))
                    &&
                    ((getdayFrom_ThefromDate!=11) && (getdayFrom_ThetoDate!=20))

                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=28))

                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=29))


                    &&
                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=30))

                    &&

                    ((getdayFrom_ThefromDate!=21) &&(getdayFrom_ThetoDate!=31))
                    ){
                    alert("Please Select a Range of 10 days");
                    $('#date').val("");  //Clear the field.
                    $('#expdate').val("");  //Clear the field.
                    //$("#date").focus();
                    return false;
                }
////////////////////////////////////////////////////////////////////////////////////////////////
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
