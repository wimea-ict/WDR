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
               Search Archived Scanned Metar Form
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Search Archived Scanned Metar Form</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content report">
            <div id="output"></div>
            <div class="no-print">
                <div class="row">
                    <form action="<?php echo base_url(); ?>index.php/SearchArchivedScannedMetarFormDataCopy/displayarchivedscannedmetarform/" method="post" enctype="multipart/form-data">
                        <?php  if($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForeCaster'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $userstation;?>" placeholder="Please select station" readonly class="form-control"  >
                                    </div>
                                </div>
                            </div>
                        <?php } elseif($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='SeniorDataOfficer'){?>
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

                        <?php }elseif($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='SeniorDataOfficer'){?>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="hidden" name="page" value="" >

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
                            <input type="submit" name="searcharchivedscannedmetarform_button" id="searcharchivedscannedmetarform_button" class="btn btn-primary" value="Generate report" >
                        </div>
                    </form>
                </div>
                <hr>
            </div>


                <br>

                    <?php
                    if(is_array($displayArchivedScannedMetarFormDetails) &&
                    count($displayArchivedScannedMetarFormDetails)&&
                     is_array($archivedscannedmetarformdataforADay) && !empty($archivedscannedmetarformdataforADay)) { ?>

                    <table class="report-table" id="table2excel">

                    <tr>
                        <td class="main">No.</td>
                        <td class="main">Form</td>
                        <td class="main">Station Name</td>
                        <td class="main">Station Number</td>
                        <td class="main">Date</td>
                        <td class="main">Description</td>
                        <td class="main">File Name</td>
                        <td class="main">Submitted By</td>
                        <td class="main">Approved By</td>

                    </tr>

                    <?php

                    $date= $displayArchivedScannedMetarFormDetails['date'];
                    //get the day in words.
                    $dayInWords=date('l', strtotime($date));
                    //Month
                    //$month = date('m', strtotime($loop->date));
                    $stationName=$displayArchivedScannedMetarFormDetails['stationName'];
                    $stationNumber=$displayArchivedScannedMetarFormDetails['stationNumber'];



                    $count = 0;

                        foreach($archivedscannedmetarformdataforADay as $data){
                            $count++;
                            $metarid = $data->id;

                            ?>
                            <tr>


                                <td ><?php echo $count;?></td>
                                <td ><?php echo $data->Form_scanned;?></td>
                                <td ><?php echo $data->StationName;?></td>
                                <td ><?php echo $data->StationNumber;?></td>
                                <td ><?php echo $data->form_date;?></td>
                                <td><?php echo $data->Description;?></td>

                                <td>
                                <td> <a  style="height:30px;" title="click to view file" target="_blank" href="<?php echo base_url(); ?>archive/<?php echo $row->file; ?>"><?php  echo $row->file;?></a></td>
                                <td><?php echo $data->SD_SubmittedBy;?></td>
                                <td><?php echo $data->ApprovedBy;?></td>



                            </tr>
                        <?php
                        }
                    ?>
                </table>
          
                <br><br><br><br>


                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
                <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
                <a href="<?php echo base_url()."index.php/SearchArchivedScannedMetarFormDataCopy/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
                <div class="clearfix"></div>
                <br><br>


            <?php }elseif(is_array($displayArchivedScannedMetarFormDetails) &&
            count($displayArchivedScannedMetarFormDetails)&&
            is_array($archivedscannedmetarformdataforADay) && empty($archivedscannedmetarformdataforADay)) {

            $date= $displayArchivedScannedMetarFormDetails['date'];
            //get the day in words.
            $dayInWords=date('l', strtotime($date));
            //Month
            //$month = date('m', strtotime($loop->date));
            $stationName=$displayArchivedScannedMetarFormDetails['stationName'];
            $stationNumber=$displayArchivedScannedMetarFormDetails['stationNumber'];
            ?>
                        <center>
                            <?php echo "No Archived Scanned Metar Report  for ".$stationName.' '.'Date'.' '.$date. ' '.'From the DB'; ?>
                        </center>

          <?php }  ?>

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
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#searcharchivedscannedmetarform_button').click(function(event) {


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
