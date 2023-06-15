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
            <h1>
            Archived Weather Summary Report
            <small> Page</small>
        </h1>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archived Weather Summary Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div class="no-print">
        <div id="output"></div>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/DisplayArchivedWeatherSummaryFormReportData/displayarchivedweathersummaryformreport/" method="post" enctype="multipart/form-data">
                <?php  if($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForeCaster'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }elseif($userrole=='ManagerData' || $userrole=="SeniorDataOfficer" || $userrole=='DataOfficer'){?>
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

                <?php }elseif($userrole=='ManagerData' || $userrole=='DataOfficer' || $userrole=='SeniorDataOfficer'){?>
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
                            <input type="text" name="month" id="month" required class="form-control summonth" required placeholder="Please select month" >
                        </div>
                    </div>
                </div>

                <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Select Year</span>
                            <input type="text" name="year" id="year" required class="form-control sumyear" required placeholder="Please select year" >
                        </div>
                    </div>
                </div>

                <div class="col-xs-2">
                    <input type="submit" name="archivedWeatherSummaryFormReport_button" id="archivedWeatherSummaryFormReport_button" class="btn btn-primary" value="Generate report" >
                </div>
            </form>
        </div>
        <hr>
    </div>


    <?php
    if(is_array($displayArchivedWeatherSummaryFormReportHeaderFields)
        && count($displayArchivedWeatherSummaryFormReportHeaderFields)){

        $monthAsANumber=0;
        $year=0;

        $monthInWords= $displayArchivedWeatherSummaryFormReportHeaderFields['monthInWords'];
        $monthAsANumber= $displayArchivedWeatherSummaryFormReportHeaderFields['monthAsANumberselected'];

        $year= $displayArchivedWeatherSummaryFormReportHeaderFields['year'];

        $getNumberOfdaysInAMonth=daysInAMonth($monthAsANumber,$year);
        //$getNumberOfdaysInAMonth=cal_days_in_month(CAL_GREGORIAN,$monthAsANumber,$year);

         $blocknumber = $displayArchivedWeatherSummaryFormReportHeaderFields['blocknumber'];

        $stationName=$displayArchivedWeatherSummaryFormReportHeaderFields['stationName'];
        $stationNumber=$displayArchivedWeatherSummaryFormReportHeaderFields['stationNumber'];
        $stationregnumber= $displayArchivedWeatherSummaryFormReportHeaderFields['stationregnumber'];
        ?>

        <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
        <span><strong><h4>FORM 10 (REV 2003)</h4></strong></span>
        <span><strong>(WEATHER SUMMARY FORM)</strong></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br>
        <span><strong>STATION</strong></span>
         <span class="dotted-line"><?php echo $stationName;?>
        </span> &nbsp;&nbsp;&nbsp;&nbsp;
         <span><strong>Station Number</strong></span>
         <span class="dotted-line"><?php echo "".$blocknumber."".$stationNumber."";?></span>
        &nbsp;&nbsp;&nbsp;&nbsp;
         <br>
         <span><strong>MONTH</strong></span> 
        <span class="dotted-line"><?php echo $monthInWords;?>
         </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>YEAR</strong> </span>
        <span class="dotted-line"><?php echo $year;?></span>
         </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>REG NO.</strong></span>
        <span class="dotted-line"> <?php echo $stationregnumber;   ?></span>
        <div class="clearfix"></div>
        <br>
        <div class="col-lg-2"  style="float: right; margin-top: -15%; width: 150px;">
                <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
        </div>
        <p>Reading of selected parameters</p>
        <table class="report-table" id="table2excel">
        <tr>
            <td></td>
            <td colspan="3"></td>
            <td class="main" colspan="9"> <center>0600Z</center></td>
            <td class="main" colspan="9">  <center>1200Z</center></td>
            <td class="main" colspan="8">  <center>DAYS WITH</center></td>
        </tr>

        <tr>
            <td class="main">Date</td>

            <td class="main">MAX &deg;C</td>
            <td class="main">MIN &deg;C</td>
            <td class="main">SUNSHINE</td>

            <td class="main">DB</td>
            <td class="main">WB</td>
            <td class="main">DP</td>
            <td class="main">VP</td>
            <td class="main">RH</td>
            <td class="main">CLP</td>
            <td class="main">GPM</td>
            <td class="main">WIND DIR</td>
            <td class="main">FF</td>


            <td class="main">DB</td>
            <td class="main">WB</td>
            <td class="main">DP</td>
            <td class="main">VP</td>
            <td class="main">RH</td>
            <td class="main">CLP</td>
            <td class="main">GPM</td>
            <td class="main">WIND DIR</td>
            <td class="main">FF</td>


            <td class="main">WIND RUN</td>
            <td class="main">R/F(mm)</td>
            <!-- <td class="main">R/DAY</td> -->
            <td class="main">Ts</td>
            <td class="main">Fg</td>
            <td class="main">HZ</td>
            <td class="main">HAIL</td>
            <td class="main">EARTHQ</td>
        </tr>

         <?php
                    $count = 0;

                        foreach($archivedweathersummaryformreportdataforAMonth as $data){
                            $count++;
                            $id = $data->id;
                            $qaby=$data->qaBy;
                            ?>
                            <tr>


                                <td ><?php echo $data->DayOfTheMonth;?></td>
                                <td ><?php echo $data->TEMP_MAX;?></td>
                                <td ><?php echo $data->TEMP_MIN;?></td>
                                <td ><?php echo $data->SUNSHINE;?></td>
                                <td ><?php echo $data->DB_0600Z;?></td>
                                <td><?php echo $data->WB_0600Z;?></td>
                                <td><?php echo $data->DP_0600Z;?></td>
                                <td ><?php echo $data->VP_0600Z;?></td>
                                <td ><?php echo $data->RH_0600Z;?></td>
                                <td><?php echo $data->CLP_0600Z;?></td>
                                <td><?php echo $data->GPM_0600Z;?></td>
                                <td><?php echo $data->WIND_DIR_0600Z;?></td>
                                <td><?php echo $data->FF_0600Z;?></td>

                                <td ><?php echo $data->DB_1200Z;?></td>
                                <td><?php echo $data->WB_1200Z;?></td>
                                <td><?php echo $data->DP_1200Z;?></td>
                                <td ><?php echo $data->VP_1200Z;?></td>
                                <td ><?php echo $data->RH_1200Z;?></td>
                                <td><?php echo $data->CLP_1200Z;?></td>
                                <td><?php echo $data->GPM_1200Z;?></td>
                                <td><?php echo $data->WIND_DIR_1200Z;?></td>
                                <td><?php echo $data->FF_1200Z;?></td>

                                <td><?php echo $data->WIND_RUN;?></td>
                                <td><?php echo $data->R_F;?></td>
                                <td><?php echo ($data->ThunderStorm=='true')?"<i class='fa fa-check'></i>":" - ";?></td>
                                <td><?php echo ($data->Fog=='true')?"<i class='fa fa-check'></i>":" - ";?></td>
                                <td><?php echo ($data->Haze=='true')?"<i class='fa fa-check'></i>":" - ";?></td>
                                <td><?php echo ($data->HailStorm=='true')?"<i class='fa fa-check'></i>":" - ";?></td>
                                <td><?php echo ($data->EarthQuake=='true')?"<i class='fa fa-check'></i>":" - ";?></td>


                            </tr>
                        <?php
                        }
                    ?>
     </table>
               <br><br><br>
    <!-- <span><strong>Data Status</strong></span><span class="dotted-line"><?php  if ($data->Approved=="FALSE"){echo "Not Approved";}
    else{echo "Approved "."&nbsp;"."By"."&nbsp;".$data->ApprovedBy;}?></span>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>Submitted By:</strong></span> <span class="dotted-line"><?php echo $data->AW_SubmittedBy;?></span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
    <span><strong>WDR System Report Generated By</strong></span> <span class="dotted-line"><?php echo $name;?></span>
    

    <br><br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print"  data-export="export"><i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/DisplayArchivedWeatherSummaryFormReportData/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>
 <?php }   ?>
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
            $('#generateweathersummaryreport_button').click(function(event) {


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
                //////////////////////////////////////////////////////////////////////////////////////////////               //////////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the MONTH is selected from the list of MONTHS
                var month=$('#month').val();
                if(month==""){  // returns true if the variable does NOT contain a valid number
                    alert("Month not Selected from the List");
                    $('#month').val("");  //Clear the field.
                    $("#month").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the YEAR is selected from the list of Year
                var year=$('#year').val();
                if(year==""){  // returns true if the variable does NOT contain a valid number
                    alert("Year not Selected");
                    $('#year').val("");  //Clear the field.
                    $("#year").focus();
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