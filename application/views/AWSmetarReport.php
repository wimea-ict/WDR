<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
$userregion=$session_data['UserRegion'];
//$userstationNo=$session_data['StationNumber'];
?>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         AWS Metar Report
         <small> Page</small>
     </h1>
     <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">AWS Metar  Report</li>

    </ol>
</section>

<!-- Main content -->
<section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form autocomplete="off" action="<?php echo base_url(); ?>index.php/AWSMetarReport/displaymetarreport/" method="post" enctype="multipart/form-data">
                <?php  if($userrole=='Senior Weather Observer'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }elseif($userrole=='ManagerData' || $userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer" || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole=="WeatherAnalyst" || $userrole=="WeatherForecaster"){?>
                    <!-- <div class="col-xs-3">
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
                        </div> -->
                       <!--  <div class="col-xs-3">
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
                    </div> -->

                          <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <select name="stationManager" id="stationManager" required  class="form-control" placeholder="Select Station">
                                            <option value="">Select Stations</option>
                                            <?php
                                            if (is_array($stationsdata) && count($stationsdata)) {
                                                foreach($stationsdata as $station){?>
                                                    <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div> 
                        <?php } ?>

                        <?php if($userrole=='Senior Weather Observer'){ ?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="page" value="monthly_rainfall_report" >

                                        <span class="input-group-addon">Station Number</span>
                                        <input type="text" name="stationNoOC" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>

                        <?php }elseif($userrole=='ManagerData' || $userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer" || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole=="WeatherAnalyst" || $userrole=="WeatherForecaster"){?>
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
                                    <input type="text" name="date" id="date" class="form-control summonth" placeholder="Please select the date" autocomplete="off" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-2">
                            <input type="submit" name="generatemetarReport_button" id="generatemetarReport_button" class="btn btn-primary" value="Generate report" >
                        </div>
                    </form>
                </div>
                <hr>
            </div>

            <?php
           /* if(is_array($displayMetarReportHeaderFields) &&
               count($displayMetarReportHeaderFields) &&
              is_array($metarreportdataforADayFromObservationSlipTable) &&
                  !empty($metarreportdataforADayFromObservationSlipTable)
              )*/

              if(!empty($metarreportdataforADayFromObservationSlipTable)){

                $date= $displayMetarReportHeaderFields['date'];
                $monthDay =date('d',strtotime($date)); //get the day num from the date.e.g 6th
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
                $stationName=$displayMetarReportHeaderFields['stationName'];
                $stationNumber=$displayMetarReportHeaderFields['stationNumber'];


                $stationIndicator;
            //echo $stationName;


                if (is_array($stationIndicatorData) && count($stationIndicatorData)) {
                   foreach($stationIndicatorData as $station){
                    // echo strtolower($station->LocationStationName);
                     if(strcasecmp($stationName, $station->LocationStationName) == 0){  //strcasecmp returns 0 if the strings are the same
                       $stationIndicator=$station->Indicator;
                        // echo $station->Indicator;
                       //  echo $stationIndicator;
                       break;
                   }
               }
           }



           ?>

           <span><strong>STATION</strong></span> <span class="dotted-line"><?php echo $stationName;?>
       </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <span><strong>STATION NUMBER</strong></span>
       <span class="dotted-line"><?php echo $stationNumber;?></span>


       <span><strong>DAY</strong></span> <span class="dotted-line"><?php echo $dayInWords;?>
   </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <span><strong>DATE</strong></span>
   <span class="dotted-line"><?php echo $date;?></span>

   <div class="clearfix"></div>
   <br>
   <table class="report-table" id="table2excel">

    <tr>
        <td class="main">METAR <br> SPECI</td>
        <td class="main">CCCC(synoptic stations indicators)</td>
        <td class="main">YYGGgg(date time)</td>
        <td class="main">Dddff/<br> f/f(wind direction and speed)</td>
        <td class="main">VVVV or <br> CAVOK(visibility)</td>
        <td class="main">RVVVV (Run way visual range)</td>
        <td class="main">WW(present weather)</td>
        <td class="main">NCChhhNCChhh N CChhh (clouds)</td>
                        <!-- <td class="main">A/Temperature</td>
                         <td class="main">Dew Point</td>
                         <td class="main">Wet Bulb</td> -->
                         <td class="main">TT/ <br> TT(temp and dewpoint temp)</td>
                         <td class="main">QNH <br>(hpa)(pressure)</td>
                         <td class="main">QNH <br>(in)(pressure)</td>
                         <td class="main">QFE<br> (hpa)(pressure)</td>
                         <td class="main">QFE<br> (in)(pressure)</td>
                         <td class="main">RE <br> W1W1(recent weather)</td>
                     </tr>

                     <?php

                     /*SELECT TIME(STR_TO_DATE(RTC_T,'%Y-%m-%d,%h:%i')),RTC_T,DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%h:%i')),DATE_SUB(STR_TO_DATE(RTC_T,'%Y-%m-%d,%h:%i'),INTERVAL 3 HOUR),MONTH(STR_TO_DATE(RTC_T,'%Y-%m-%d,%h:%i')) FROM `groundnode` WHERE MINUTE(DATE_SUB(STR_TO_DATE(RTC_T,'%Y-%m-%d,%h:%i'),INTERVAL 3 HOUR)) BETWEEN 30 and 35 or MINUTE(DATE_SUB(STR_TO_DATE(RTC_T,'%Y-%m-%d,%h:%i'),INTERVAL 3 HOUR)) BETWEEN 00 and 05 order by RTC_T desc */

                     ?>
                     <?php   
				 //print_r($metarreportdataforADayFromObservationSlipTable);
                     $count = 0;
				 //echo count($metarreportdataforADayFromObservationSlipTable);
                     foreach($metarreportdataforADayFromObservationSlipTable as $data){

					 //print_r($data);

                       ?>



                       <tr>


                        <td ><?php echo 'METAR';?></td>
                        <td ><?php echo "";?></td>   <!-- station indicators -->
                        <td ><?php echo date("md",strtotime($data['Date'])).date("Hi",strtotime($data['DTIME']))."Z";?></td>  <!-- YYGGgg -->
                        <td ><?php
                        if($data['V_A2'] && $data['V_A2'] != 0 ){
                           $winddirection = ((($data['V_A1']/$data['V_A2'])-0.05)*400); 
                       }else{
                           $winddirection = 0; 
                       }								echo $winddirection . $data['P0_LST60']. 'KT';?></td> <!-- Dddfffmfm -->
                       <td ><?php echo "";?></td>   <!-- visibility -->
                       <td><?php echo "";?></td>  <!-- present weather -->
                       <td><?php echo "";?></td> 

                       <td><?php echo "";?></td>  

                       <td ><?php echo $data['T_SHT2X'].'|'.($data['T_SHT2X']-(100-($data['RH_SHT2X'])/5));?></td> <!-- TTTdTd -->



                       <td ><?php echo $data['Pressure'];?></td>  <!--Qnhhpa -->


                       <td><?php echo "";?></td> <!-- Qnhin -->
                       <td><?php echo "";?></td>  <!-- Qfehpa -->
                       <td><?php echo '';?></td>
                       <td><?php echo "";?></td>
                       <td><?php echo "";?></td>


                   </tr>
                   <?php
                   $count++;
               }
						//echo $count;
               ?>
           </table>
           <br><br>
       </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
        <span><strong>AWS Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
        <br><br><br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/MetarReport/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>
    <?php  }elseif( empty($metarreportdataforADayFromObservationSlipTable))
    {

       $date= $displayMetarReportHeaderFields['date'];
     //get the day in words.
       $dayInWords=date('l', strtotime($date));
     //Month
     //$month = date('m', strtotime($loop->date));
       $stationName=$displayMetarReportHeaderFields['stationName'];
       $stationNumber=$displayMetarReportHeaderFields['stationNumber'];
       ?>

       <center>
           <?php echo "No Metar Report Data Yet for ".$stationName.' '.'Date'.' '.$date. ' '.'From the DB'; ?>
       </center>
   <?php } 
   ?>


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
    $('.clock-rm').val('');
     getStationID();

    
   
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

              var o = new Option("option text", "value");
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

              var o = new Option("option text", "value");
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




     $('#stations-list').change(function(){
        var selected_station = $('#stations-list').find(":selected").text();

        $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxStationIdRequest",
            data:{ 
                station:selected_station 
            },

            success:function(data){
                var id = JSON.parse(data);
                $('#station-id').val(id.toString());
                 $('#stationNoManager').val(id.toString());
                  $('#stationNoOC').val(id.toString());
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

        success:function(data){
            var id = JSON.parse(data);
            if(id){
               $('#station-id').val(id.toString()); 
                $('#stationNoManager').val(id.toString());
                  $('#stationNoOC').val(id.toString());
            }
            
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
            $('#generatemetarReport_button').click(function(event) {


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
                    url: "<?php echo base_url(); ?>"+"index.php/Stations/getStationNumber2",
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
