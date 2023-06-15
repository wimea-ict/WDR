<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Archived Dekadal Form Report
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archived Dekadal Form Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/DisplayArchivedDekadalFormReportData/displayArchivedDekadalFormReport/" method="post" enctype="multipart/form-data">
                <?php  if($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForeCaster'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }elseif($userrole=='ManagerData' ||$userrole=='Manager' || $userrole=='DataOfficer' || $userrole=='SeniorDataOfficer'){?>
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
                            <select  name="stationManager" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <?php if($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForeCaster'){ ?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value="monthly_rainfall_report" >

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNoOC" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php }elseif($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='DataOfficer' || $userrole=='SeniorDataOfficer'){?>
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
                                <span class="input-group-addon">Select Month</span>
                                <input type="text" name="month" id="month" class="form-control rainmonth" placeholder="Select month" >
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Select Year</span>
                                <input type="text" name="year" id="year" class="form-control rainyear" placeholder="Select year" >
                            </div>
                        </div>
                    </div>
                <div class="col-xs-3">
                 <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Dekadal Number</span>
                                <select name="dekadalnumber" id="dekadalnumber"  class="form-control"   placeholder="Enter Dekadal Number" >
                                        <option value="">--Select dekadal number</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                            </div>
                        </div>
                    </div>

                <div class="col-xs-2">
                    <input type="submit" name="generateArchivedDekadalFormReport_button" id="generateArchivedDekadalFormReport_button" class="btn btn-primary" value="Generate report" >
                </div>
            </form>
        </div>
        <hr>
    </div>
    <?php

    if(is_array($displayArchivedDekadalFormReportHeaderFields) && count($displayArchivedDekadalFormReportHeaderFields)){

        $monthAsANumber=0;
        $year=0;

        //$range= $displayDekadalReportHeaderFields['range'];
        $stationName=$displayArchivedDekadalFormReportHeaderFields['stationName'];
        $stationNumber=$displayArchivedDekadalFormReportHeaderFields['stationNumber'];

        //$monthAsANumber=0;
        $dekadalnumber= $displayArchivedDekadalFormReportHeaderFields['dekadalnumber'];
        
         $regnumber =$displayArchivedDekadalFormReportHeaderFields['regnumber'];

        //$monthInWords= $displayDekadalReportHeaderFields['monthInWords'];
         $monthInWords= $displayArchivedDekadalFormReportHeaderFields['monthInWords'];
         $monthAsANumber= $displayArchivedDekadalFormReportHeaderFields['monthAsANumberselected'];

        $year= $displayArchivedDekadalFormReportHeaderFields['year'];


        
        ?>

       
        <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
        <h3>TEN DAY (DEKADAL) FORM</h3>
         <div class="col-lg-2"  style="float: right; margin-top: -10%; width: 140px;">
                     <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
                </div> <br>
        <span><strong>Weather Station</strong></span>
        <span class="dotted-line"><?php echo $stationName;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Registration Number</strong></span> <span class="dotted-line"><?php echo $regnumber;?></span> &nbsp;&nbsp;&nbsp;
        <span><strong>Dekad</strong></span><span class="dotted-line"><?php echo $dekadalnumber;?></span>
        <span class="dotted-line"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Month/Year</strong></span> <span class="dotted-line"><?php echo $monthInWords. '/'.$year;?></span>


        <div class="clearfix"></div>
        <br>
        <!-- <p><strong>Reading of selected parameters</strong></p> -->
        <table class="report-table" id="table2excel">
        <tr>
            <td class="main" colspan="10">  <center>TIME OF OBSERVATION 9:00 AM </center>  </td>
            <td class="main" colspan="7"> <center> TIME OF OBSERVATION 3:00 PM </center>    </td>
        </tr>

        <tr>
            <td class="main" rowspan="2">DATE </br> OF THE </br> MONTH</td>
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
<tbody>
<?php 
 $totalmax=0.0;
        $totalmin=0.0;
        $totaldry=0.0;
        $totalwet=0.0;
        $totaldew=0.0;
        $totalrelative=0.0;
        $totalwinddirection=0.0;
        $totalwindspeed=0.0;
        $totalrain=0.0;
        $totaldry2=0.0;
        $totalwet2=0.0;
        $totaldew2=0.0;
        $totalrelative2=0.0;
        $totalwinddirection2=0.0;
        $totalwindspeed2=0.0;
                
                foreach ($archivedDekadalFormReportdataforAnyTenDaysOfAMonth as $data){
                      ?>
                      <tr>
                        <td><?php echo $data->DayOfTheMonth;?></td>
                        <td><?php echo $data->MAX_TEMP;?></td>
                        <td><?php echo $data->MIN_TEMP;?></td>
                        <td><?php echo $data->DRY_BULB_0600Z;?></td>
                        <td><?php echo $data->WET_BULB_0600Z;?></td>
                        <td><?php echo $data->DEW_POINT_0600Z;?></td>
                        <td><?php echo $data->RELATIVE_HUMIDITY_0600Z;?></td>
                        <td><?php echo $data->WIND_DIRECTION_0600Z;?></td>
                        <td><?php echo $data->WIND_SPEED_0600Z;?></td>
                        <td><?php echo $data->RAINFALL_0600Z;?></td>
                        <td><?php echo $data->DRY_BULB_1200Z;?></td>
                        <td><?php echo $data->WET_BULB_1200Z;?></td>
                        <td><?php echo $data->DEW_POINT_1200Z;?></td>
                        <td><?php echo $data->RELATIVE_HUMIDITY_1200Z;?></td>
                        <td><?php echo $data->WIND_DIRECTION_1200Z;?></td>
                        <td><?php echo $data->WIND_SPEED_1200Z;?></td>
                   
                        <!-- $print=1; -->
                    </tr>
                <?php
                }

                ?>  


                
               
    <tr>
<!-- <td class="main">TOTAL</td>
 <td>
   
 </td>
 <td></td>
<td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>
 <td></td>

    </tr> -->
        </table>

    <?php }?>
        <br><br><br>
       <!-- <span><strong>Data Status</strong></span><span class="dotted-line"><?php  if ( $data->Approved=="FALSE"){echo "Not Approved";}
    else{echo "Approved "."&nbsp;"."By"."&nbsp;".$data->ApprovedBy;}?></span>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>Submitted By:</strong></span> <span class="dotted-line"><?php echo $data->AD_SubmittedBy;?></span> -->
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>WDR System Report Generated By</strong></span> <span class="dotted-line"><?php echo $name;?></span>
    <?php 
    if(($userrole=="ManagerData")||($userrole=="Manager")||($userrole=="SeniorDataOfficer")){ ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br><br>
    <span><strong>Quality Controlled By</strong></span> <span class="dotted-line"><?php echo $data->qaBy;?></span>
    <?php } ?>

    <br><br><br>
        <button type="button" onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button type="button" button id="export"   class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button type="button" button id="exportcsv" class="btn btn-primary no-print" data-export="export"><i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/DisplayArchivedDekadalFormReportData/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>
<!--     <?php ?> -->
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
