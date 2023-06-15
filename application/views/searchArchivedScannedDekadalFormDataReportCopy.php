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
            Search Archived Dekadal Form Report
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Search Archived Dekadal Form Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/SearchArchivedScannedDekadalFormDataReportCopy/displayarchivedscanneddekadalformreport/" method="post" enctype="multipart/form-data">
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
                                    <span class="input-group-addon">Select Month</span>
                                    <input type="text" name="month" id="month" class="form-control summonth" placeholder="Please select month" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Select Year</span>
                                    <input type="text" name="year" id="year" class="form-control sumyear" placeholder="Please select year" >
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
                            <input type="submit" name="searchArchivedScannedDekadalFormReport_button" id="searchArchivedScannedDekadalFormReport_button" class="btn btn-primary" value="Search " >
                        </div>


                <!-- <div class="col-xs-3">
                   <div class="form-group">
                    <input type="submit" name="searchArchivedScannedDekadalFormReport_button" id="searchArchivedScannedDekadalFormReport_button" class="btn btn-primary" value="Search" >
                  </div> -->
            </form>
        </div>
        <hr>
    </div>
    <?php
    if(is_array($displayArchivedScannedDekadalFormReportDetails) &&
        count($displayArchivedScannedDekadalFormReportDetails) &&
       is_array($archivedscanneddekadalformreportdataForAGivenRangeInAMonth) &&
        !empty($archivedscanneddekadalformreportdataForAGivenRangeInAMonth)
     ){

       $month=0;
    $year=0;

        //$range= $displayDekadalReportHeaderFields['range'];
        $stationName=$displayArchivedScannedDekadalFormReportDetails['stationName'];
        $stationNumber=$displayArchivedScannedDekadalFormReportDetails['stationNumber'];

        //$monthAsANumber=0;
        $month= $displayArchivedScannedDekadalFormReportDetails['month'];
        $year= $displayArchivedScannedDekadalFormReportDetails['year'];
        $dekadalnumber= $displayArchivedScannedDekadalFormReportDetails['dekadalnumber'];


        //$monthInWords= $displayDekadalReportHeaderFields['monthInWords'];
        //$monthAsANumber= $displayArchivedScannedDekadalFormReportDetails['monthAsANumberselected'];

       // $year= $displayArchivedScannedDekadalFormReportDetails['year'];

        ?>


        <!-- <p><strong>Reading of selected parameters</strong></p> -->
        <h3>ARCHIVE SCANNED DEKADAL REPORT</h3>
                <br>
        <table class="report-table" id="table2excel">


        <tr>
            <td class="main">No. </td>
            <td class="main">Form</td>
            <td class="main">Station Name</td>
            <td class="main">Station Number</td>
            <td class="main">Dekadal Number</td>
            <td class="main">Month</td>
            <td class="main">Year</td>
            <td class="no-print" colspan="2">FileName & Description</td>
            <td class="main">Submitted By</td>
           <td class="main">Approved By</td>

        </tr>

            <?php
            $count = 0;

                foreach($archivedscanneddekadalformreportdataForAGivenRangeInAMonth as $data){
                    $count++;
                    $mid = $data->id;

                    ?>
                    <tr>
                        <td ><?php echo $count;?></td>
                        <td ><?php echo 'dekadal form';?></td>
                        <td ><?php echo $data->StationName;?></td>
                        <td ><?php echo $data->StationNumber;?></td>
                        <td ><?php echo $data->Dekadalnumber;?></td>
                        <td ><?php echo $data->month;?></td>
                        <td ><?php echo $data->year;?></td>
                        
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
                         <td><?php echo $data->SDE_SubmittedBy;?></td>
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
         <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT </button>
        <button type="button" button id="export"   class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button type="button" button id="exportcsv" class="btn btn-primary no-print" data-export="export"><i class="fa fa-print"></i> Export to csv</button>
        <a href="<?php echo base_url()."index.php/SearchArchivedScannedDekadalFormDataReportCopy/"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>
    <?php }elseif(is_array($displayArchivedScannedDekadalFormReportDetails) &&
    count($displayArchivedScannedDekadalFormReportDetails) &&
    is_array($archivedscanneddekadalformreportdataForAGivenRangeInAMonth) &&
    empty($archivedscanneddekadalformreportdataForAGivenRangeInAMonth)
    ){


    $monthAsANumber=0;
    $year=0;
    //$range= $displayDekadalReportHeaderFields['range'];
    $stationName=$displayArchivedScannedDekadalFormReportDetails['stationName'];
    $stationNumber=$displayArchivedScannedDekadalFormReportDetails['stationNumber'];

    $dekadalnumber= $displayArchivedScannedDekadalFormReportDetails['dekadalnumber'];


   // $monthInWords= $displayDekadalReportHeaderFields['monthInWords'];
    $month= $displayArchivedScannedDekadalFormReportDetails['month'];

   $year= $displayArchivedScannedDekadalFormReportDetails['year'];   ?>

        <center>
            <?php echo "No Archived Scanned Dekadal Report  for ".'Month'.' '.$month. ' '.'Year'.$year.'  '.'Dekadal Number'.$dekadalnumber.'  '.'  From the DB'; ?>
        </center>

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
