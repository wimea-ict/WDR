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
                Archived Metar Form Data
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Archived Metar Form Data  Report</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content report">
            <div id="output"></div>
            <div class="no-print">
                <div class="row">
                    <form action="<?php echo base_url(); ?>index.php/DisplayArchivedMetarFormData/displayachivedmetarFormreport/" method="post" enctype="multipart/form-data">
                        <?php  if($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForeCaster'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>
                        <?php }elseif($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='DataOfficer' || $userrole=='SeniorDataOfficer'){?>
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
                                    <span class="input-group-addon">Select Date</span>
                                    <input type="text" name="date" id="date" class="form-control summonth" placeholder="Please select the date" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-2">
                            <input type="submit" name="generatearchivedmetarFormReport_button" id="generatearchivedmetarFormReport_button" class="btn btn-primary" value="Generate report" >
                        </div>
                    </form>
                </div>
                <hr>
            </div>

            <?php
            if(is_array($displayArchivedMetarFormReportHeaderFields) &&
                count($displayArchivedMetarFormReportHeaderFields) &&
                 is_array($archivedmetarformreportdataforADay) &&
             !empty($archivedmetarformreportdataforADay)) {

                $date= $displayArchivedMetarFormReportHeaderFields['date'];
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
                $stationName=$displayArchivedMetarFormReportHeaderFields['stationName'];
                $stationNumber=$displayArchivedMetarFormReportHeaderFields['stationNumber'];
                 $blocknumber = $displayArchivedMetarFormReportHeaderFields['blocknumber'];

                ?>

                <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
                <h3>METAR REPORT</h3> <br>

                <div class="col-lg-2"  style="float: right; margin-top: -10%; width: 140px;">
                     <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
                </div> <br>


                <span><strong>STATION</strong></span> <span class="dotted-line"><?php echo $stationName;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>STATION NUMBER</strong></span>
                <span class="dotted-line"><?php echo "".$blocknumber."".$stationNumber."";?></span>


                <span><strong>DAY</strong></span> <span class="dotted-line"><?php echo $dayInWords;?>
                </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>DATE</strong></span>
                <span class="dotted-line"><?php echo $date;?></span>

                <div class="clearfix"></div>
                <br>
                <table class="report-table" id="table2excel">

                    <!-- <tr>
                        <td class="main">METAR <br> SPECI</td>
                        <td class="main">CCCC</td>
                        <td class="main">YYGGgg<sup>z</sup></td>
                        <td class="main">Dddff/<br> f<sub>m</sub>/f<sub>m</sub></td>
                        <td class="main">WW or <br> CAVOK</td>
                        <td class="main">W<sup>1</sup>W<sup>1</sup></td>
                        <td class="main">NCChhhNCChhh N CChhh</td>
                        <td class="main">A/Temperature</td>
                         <td class="main">Dew Point</td>
                         <td class="main">Wet Bulb</td>
                        <td class="main">TT/ <br> T<sub>d</sub>T<sub>d</sub></td>
                        <td class="main">QNH <br>(hpa)</td>
                        <td class="main">QNH <br>(in)</td>
                        <td class="main">QFE<br> (hpa)</td>
                        <td class="main">QFE<br> (in)</td>
                        <td class="main">RE <br> W<sup>1</sup>W<sup>1</sup></td>
                    </tr> -->
                     <tr>
                         <td class="main">METAR <br> SPECI</td>
                        <td class="main">CCCC</td>
                        <td class="main">YYGGgg</td>
                        <td class="main">Dddff/<br> f<sub>m</sub>f<sub>m</sub></td>
                        <td class="main">VVVV or <br> CAVOK</td>
                        <!-- <td class="main">RV V<sub>R</sub>V<sub>R</sub>V<sub>R</sub>V<sub>R</sub></td> -->
                        <td class="main">W<sup>1</sup>W<sup>1</sup></td>
                       <!--  <td class="main">NCCh<sub>s</sub>h<sub>s</sub>h<sub>s</sub></td>
                        <td class="main">NCCh<sub>s</sub>h<sub>s</sub>h<sub>s</sub></td>
                        <td class="main">NCCh<sub>s</sub>h<sub>s</sub>h<sub>s</sub></td> -->
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

                        foreach($archivedmetarformreportdataforADay as $metardata){
                            $count++;
                            $metarid = $metardata->id;
                            $qaby=$metardata->qaBy;
                            ?>
                            <tr>


                                <td ><?php echo $metardata->METARSPECI;?></td>
                                <td ><?php echo $metardata->CCCC;?></td>
                                <td ><?php echo $metardata->YYGGgg;?></td>
                                <td ><?php echo $metardata->Dddfffmfm;?></td>
                                <td ><?php echo $metardata->WWorCAVOK;?></td>
                                <td><?php echo $metardata->W1W1;?></td>
                                <td><?php echo $metardata->NlCCNmCCNhCC;?></td>
                                <td ><?php echo $metardata->TTTdTd;?></td>
                                <td ><?php echo $metardata->Qnhhpa;?></td>
                                <td><?php echo $metardata->Qnhin;?></td>
                                <td><?php echo $metardata->Qfehpa;?></td>
                                <td><?php echo $metardata->Qfein;?></td>
                                <td><?php echo $metardata->REW1W1;?></td>


                            </tr>
                        <?php
                        }
                    ?>
                </table>
                           <br><br><br>
    <span><strong>Data Status</strong></span><span class="dotted-line"><?php  if ($metardata->Approved=="FALSE"){echo "Not Approved";}
    else{echo "Approved "."&nbsp;"."By"."&nbsp;".$metardata->ApprovedBy;}?></span>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>Submitted By:</strong></span> <span class="dotted-line"><?php echo $metardata->AM_SubmittedBy;?></span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><strong>WDR System Report Generated By</strong></span> <span class="dotted-line"><?php echo $name;?></span>
     <?php
    if(($userrole=="ManagerData")||($userrole=="Manager")||($userrole=="SeniorDataOfficer")){ ?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br><br>
    <span><strong>Quality Controlled By</strong></span> <span class="dotted-line"><?php echo $metardata->qaBy;?></span>
    <?php } ?>

    <br><br><br>
                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
                <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
                <a href="<?php echo base_url()."index.php/DisplayArchivedMetarFormData/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
                <div class="clearfix"></div>
                <br><br>
            <?php }elseif(is_array($displayArchivedMetarFormReportHeaderFields) &&
    count($displayArchivedMetarFormReportHeaderFields) &&
    is_array($archivedmetarformreportdataforADay) &&
    empty($archivedmetarformreportdataforADay)) {

                $date= $displayArchivedMetarFormReportHeaderFields['date'];
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
                $stationName=$displayArchivedMetarFormReportHeaderFields['stationName'];
                $stationNumber=$displayArchivedMetarFormReportHeaderFields['stationNumber'];


                ?>

                <center>
                    <?php echo "No Archived Metar Report Data Yet for ".$stationName.' '.'Date'.' '.$date. ' '.'From the DB'; ?>
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
