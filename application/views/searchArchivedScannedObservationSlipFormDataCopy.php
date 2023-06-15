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
                Search Archived Scanned Observation Slip Form
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Search Archived Scanned Observation Slip Form</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content report">
            <div id="output"></div>
            <div class="no-print">
                <div class="row">
                    <form action="<?php echo base_url(); ?>index.php/SearchArchivedScannedObservationSlipFormDataCopy/displayarchivedscannedobservationslipform/" method="post" enctype="multipart/form-data">
                        <?php  if($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForeCaster'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>
                        <?php }elseif($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='SeniorDataOfficer'){?>
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

                        <?php }elseif($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='SeniorDataOfficer'){?>
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
                                    <span class="input-group-addon">Select Time</span>
                                    <!-- <input type="text" name="day" id="day" class="form-control sumyear" placeholder="Please select the day" > -->
                                    <select name="ArchivedObservationSlipFormReportTime" id="ArchivedObservationSlipFormReportTime" required class="form-control">
                                        <option value="">--Select TIME Options--</option>
                                <option value="0000Z">0000Z</option>
                <option value="0030Z">0030Z</option>
                                <option value="0100Z">0100Z</option>
                <option value="0130Z">0130Z</option>
                                <option value="0200Z">0200Z</option>
                <option value="0230Z">0230Z</option>
                                <option value="0300Z">0300Z</option>
                <option value="0330Z">0330Z</option>
                                <option value="0400Z">0400Z</option>
                <option value="0430Z">0430Z</option>
                                <option value="0500Z">0500Z</option>
                <option value="0530Z">0530Z</option>
                                <option value="0600Z">0600Z</option>
                <option value="0630Z">0630Z</option>
                                <option value="0700Z">0700Z</option>
                <option value="0730Z">0730Z</option>
                                <option value="0800Z">0800Z</option>
                <option value="0830Z">0830Z</option>
                                <option value="0900Z">0900Z</option>
                <option value="0930Z">0930Z</option>
                                <option value="1000Z">1000Z</option>
                <option value="1030Z">1030Z</option>
                                <option value="1100Z">1100Z</option>
                <option value="1130Z">1130Z</option>
                                <option value="1200Z">1200Z</option>
                <option value="1230Z">1230Z</option>
                                <option value="1300Z">1300Z</option>
                <option value="1330Z">1330Z</option>
                               <option value="1400Z">1400Z</option>
                <option value="1430Z">1430Z</option>
                                <option value="1500Z">1500Z</option>
                <option value="1530Z">1530Z</option>
                                <option value="1600Z">1600Z</option>
                <option value="1630Z">1630Z</option>
                                <option value="1700Z">1700Z</option>
                <option value="1730Z">1730Z</option>
                                <option value="1800Z">1800Z</option>
                <option value="1830Z">1830Z</option>
                                <option value="1900Z">1900Z</option>
                <option value="1930Z">1930Z</option>
                                <option value="2000Z">2000Z</option>
                <option value="2030Z">2030Z</option>
                                <option value="2100Z">2100Z</option>
                <option value="2130Z">2130Z</option>
                                <option value="2200Z">2200Z</option>
                <option value="2230Z">2230Z</option>
                                <option value="2300Z">2300Z</option>
                <option value="2330Z">2330Z</option>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="col-xs-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Select Date</span>
                                    <input type="text" name="date" id="date" class="form-control summonth" placeholder="Please select the date" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-2">
                            <input type="submit" name="searcharchivedscannedobservationslipform_button" id="searcharchivedscannedobservationslipform_button" class="btn btn-primary" value="Generate report" >
                        </div>
                    </form>
                </div>
                <hr>
            </div>

            <?php
            if(is_array($displayArchivedScannedObservationSlipFormDataDetails) &&
            count($displayArchivedScannedObservationSlipFormDataDetails) &&
            is_array($archivedscannedobservationslipformdatacopyforADay) &&
                !empty($archivedscannedobservationslipformdatacopyforADay)) {

                ?>
                <h3>ARCHIVE SCANNED  OBSERVATIONSLIP REPORT</h3>
                <br>
                <table class="report-table" id="table2excel">

                    <tr>
                        <td class="main">No.</td>
                       
                        <td class="main">Station Name</td>
                        <td class="main">Station Number</td>
                        <td class="main">Date</td>
                        <td class="no-print" colspan="2">FileName & Description</td>
                        <td class="main">Submitted By</td>
                        <td class="main">Approved By</td>

                    </tr>

                    <?php


                $date= $displayArchivedScannedObservationSlipFormDataDetails['date'];
                //get the day in words.
                $dayInWords=date('l', strtotime($date));
                //Month
                //$month = date('m', strtotime($loop->date));
            $stationName=$displayArchivedScannedObservationSlipFormDataDetails['stationName'];
        $stationNumber=$displayArchivedScannedObservationSlipFormDataDetails['stationNumber'];

                    $count = 0;

                     foreach($archivedscannedobservationslipformdatacopyforADay as $data){
                            $count++;
                            $observationslipid = $data->id;

                            ?>
                            <tr>


                                <td ><?php echo $count;?></td>
                                
                                <td ><?php echo $data->StationName;?></td>
                                <td ><?php echo $data->StationNumber;?></td>
                                <td ><?php echo $data->form_date;?></td>
                               <td class="no-print" colspan="2" style="padding:0px;">
                                        <table class="table table-striped" style="margin:0px;">
                                       
                                        <?php if($uploaded_files->num_rows()>0){
                                        $no_files=0;
                                         $g=1;
                                        foreach($uploaded_files->result() as $row){ 
                                        if(strcmp($data->record_id,$row->record_id)==0){ ?>
                                       
                                       <tr >
                                       <td> <a  style="height:30px;" title="click to view file" target="_blank" href="<?php echo base_url(); ?>archive/<?php echo $row->file; ?>"><?php  echo $row->file;?></a></td>
                                       <td>
                                        <?php echo $row->description; ?>
                                     
                                       </td>
                                       </tr>

                                      <?php 
                                       $g++;
                                    }
                                     
                                        }
                                        
                                    }   
                                       //echo $no_files;  
                                        ?>
                                       
                                        </table>
                                 
                                        </td>
                                <td><?php echo $data->SD_SubmittedBy;?></td>
                                <td><?php echo $data->ApprovedBy;?></td>



                            </tr>
                        <?php
                        }
                    ?>
                </table>
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <span><strong>WDR System Report Generated By</strong></span> <span class="dotted-line"><?php echo $name;?></span>


                <br><br><br>

                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT</button>
                <button id="export" class="btn btn-primary no-print"><i class="fa fa-download"></i> Export to excel</button>
                <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-download"></i> Export to csv</button>
                <a href="<?php echo base_url()."index.php/SearchArchivedScannedObservationSlipFormDataCopy/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
                <div class="clearfix"></div>
                <br><br>
            <?php }elseif(is_array($displayArchivedScannedObservationSlipFormDataDetails) &&
                                count($displayArchivedScannedObservationSlipFormDataDetails) &&
                               is_array($archivedscannedobservationslipformdatacopyforADay) &&
                                 empty($archivedscannedobservationslipformdatacopyforADay)) {


    $date= $displayArchivedScannedObservationSlipFormDataDetails['date'];
    //get the day in words.
    $dayInWords=date('l', strtotime($date));
    //Month
    //$month = date('m', strtotime($loop->date));
    $stationName=$displayArchivedScannedObservationSlipFormDataDetails['stationName'];
    $stationNumber=$displayArchivedScannedObservationSlipFormDataDetails['stationNumber'];
    $timeInZoo= $displayArchivedScannedObservationSlipFormDataDetails['TimeInZoo'];


    ?>

                <center>
                    <?php echo "No Archived Scanned Observation Slip Report  for ".$stationName.' '.'Date'.' '.$date. ' '.'From the DB'; ?>
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
            $('#generatearchivedobservationslipformreport_button').click(function(event) {


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
                //Check that the DATE is selected from the list of TIME for the METAR
                var time=$('#ArchivedObservationSlipFormReportTime').val();
                if(time==""){  // returns true if the variable does NOT contain a valid number
                    alert("Time not Selected from the List");
                    $('#ArchivedObservationSlipFormReportTime').val("");  //Clear the field.
                    $("#ArchivedObservationSlipFormReportTime").focus();
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

                            //alert(data);
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