<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>


<!-- <link href="<?php echo base_url(); ?>js/datetimepicker-master/build/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css" /> -->
<?php echo json_encode(value); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="<?php echo base_url(); ?>js/datetimepicker/js/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>js/datetimepicker/css/jquery.datetimepicker.min.css"/>
<script src="<?php echo base_url(); ?>js/datetimepicker/js/jquery.datetimepicker.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#date').datetimepicker();
  });
</script>

<aside class="right-side">
  <!-- Content Header (Page header) -->

  <section class="content-header">
    <h4>
      Customized Temperature Report
      <small>Preview Page</small>
    </h4>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Customized Temperature Report</li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content report">
    <div id="output"></div>
    <div class="no-print">
      <div class="row">
       <!--  -->
       <form autocomplete ="off" action="<?php echo base_url(); ?>index.php/DisplayCustomRainfallReport/DisplayCustomTemperatureReport/ " method="post" enctype="multipart/form-data">


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
                                <select name="region" id="regions"  required class="form-control" placeholder="Select Region">
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
                                <input type="text" name="stationNo" id="stationNoOC" class="form-control" value="<?php echo $userstationNo;?>" placeholder="Please select station Number" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php }elseif($userrole=='ManagerData' || $userrole== 'ZonalOfficer' || $userrole== 'SeniorZonalOfficer' || $userrole=='ManagerStationNetworks' || $userrole=='Director' || $userrole == 'WeatherAnalyst'){?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value="monthly_rainfall_report" >

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNo"  id="stationNoManager" required class="form-control" value=""  readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }?>






                  <div class="col-xs-3">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">From </span>
                        <input type="date" name="from"  id="date1" class="form-control" placeholder="" autocomplete ="off" required             
                        value="<?= set_value('date1') ?>"

                        >
                      </div>
                    </div>
                  </div>




                  <div class="col-xs-3">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">To </span>
                        <input type="date" name="to" id="date2" class="form-control" placeholder="" autocomplete ="off" required
                        value="<?= set_value('date2') ?>"

                        >
                      </div>
                    </div>
                  </div>


                  <div class="col-xs-3">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">Start Time </span>
                        <input type="text" class="form-control" name="StartTime"  id="timeA" />
                        <span class="input-group-addon clock-rm1"><i class="glyphicon glyphicon-time"></i></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-3">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon">End Time</span>
                        <input type="text" name="EndTime" class="form-control" id="timeB" placeholder="" autocomplete ="off">
                        <span class="input-group-addon clock-rm2"><i class="glyphicon glyphicon-time"></i></span>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-2">
                    <input type="submit"  class="btn btn-primary" id="GeneratedReport" value="Generate report" >
                  </div>


                </form>
              </div>

              <hr>
            </div>

            <?php
            if(is_array($tempdata) && count($tempdata) && is_array($noTempData) && is_array($stationsdata)){

              $year=  $noTempData['year'];
              $stationName= $noTempData['station'];
              $stationNumber= $noTempData['stationNumber'];
              $from =$noTempData['from'];
              $to = $noTempData['to'];

              ?>
              <span>
                <span><strong>Temperature Observation At Station</strong></span>
                <span class="dotted-line"><?php echo $stationName;?></span>
              </span>



              <span>
               <span><strong>Station Number</strong></span>
               <span class="dotted-line"><?php echo $stationNumber;?></span>
             </span>


             <span>
              <span><strong>Between</strong></span> 
              <span class="dotted-line"><?php echo $from;?></span>
            </span>

            <span>
              <span><strong>To</strong></span>
              <span class="dotted-line"><?php echo $to;?></span>
            </span>

            <div class="clearfix"></div>
            <br>
            <table class="report-table" id="table2excel">

              <tr>
                <td class="main">Date </td>
                <td class="main">Time</td>
                <td class="main">Minimum Temperature</td>
                <td class="main">Maximum Temperature</td>


              </tr>
              <?php foreach($tempdata as $data){
          // $count=0;
          // if(empty($data->Max_temp)){
          //     $count++;
          // }
          // else
          //   {
                ?>

                <tr> 
                  <td> <?php echo $data->Date;?></td>
                  <td> <?php echo $data->TIME;?></td>
                  <td>  <?php
                  if($data->Min_Read){
                   echo $data->Min_Read;
                 } else{
                  echo "Missing record";
                }

                ?></td>
                <td>  <?php
                if($data->Max_Read){
                 echo $data->Max_Read;
               } else{
                echo "Missing record";
              }

              ?></td>
            </tr>
          <?php }  ?>

        </table>

        <br><br>
      </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
        <span><strong>Report Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>
        <br><br><br><br>
        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
        <button id="export" class="btn btn-primary no-print"><i class="fa fa-print"></i> Export to excel</button>
        <button id="exportcsv" class="btn btn-primary no-print" data-export="export"> <i class="fa fa-print"></i> Export to csv</button>
        <button id="reportIssue" type="submit" class="btn btn-primary no-print" style="margin-left:150px;"  ><i class="fa fa-envelope-o"></i> Report Issues to OC</button>
        <a href="<?php echo base_url()."index.php/ReportsController/initializeTemperatureCustomReport"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close report</a>
        <div class="clearfix"></div>
        <br><br>

      <?php }
      elseif(is_array($noTempData) && count($noTempData) && empty($tempdata)) {

       $stationName=$noTempData['station'];
       $region = $noTempData['region'];
       $stationNumber=$noTempData['stationNumber'];
       $from =$noTempData['from'];
       $to = $noTempData['to'];

       echo "<p class='text-dangered text-center'>No temperature data Yet for ".$stationName." from ".$region." region Between ".$from. " to  ".$to." from the database</p>"; 
       ?>

     <?php } ?>

   </section><!-- /.content -->
 </aside><!-- /.right-side -->
</div>

    <!-- jQuery 2.0.2
     <script src="js/jquery.min.js"></script>-->
     <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
     <!--  <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script> -->
     <!--      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
     <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     
       <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script> -->

       <!-- <script src="<?php echo base_url(); ?>js/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script> -->




<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> -->

<script>
  $(document).ready(function(){
   $('#timeA').timepicker();
   $('#timeB').timepicker();
   $('.clock-rm1').click(function(){
    $('#timeA').val('');
  });
   $('.clock-rm2').click(function(){
    $('#timeB').val('');
  });


 });

</script>


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


   $('#GeneratedReport').click(function(event) {

    var station = $('#stations-list').find(":selected").text();

    var stationNo = $('#stationNo').val();
    var start_date = $('#date1').val();
    var end_date = $('#date2').val();

                // alert(station);
                // switch(true){
                //     case (station == ""  || station =="Select station"):
                //         alert("Please select region and then station to generate report");
                //         $('#stations-list').focus();
                //         return false;

                //     case stationNo == "": 
                //         alert("Please select station number");
                //         stationNo.focus();
                //         return false;

                //    case start_date == "": 
                //     alert("Please select start date");
                //     start_date.focus();
                //     return false;

                //  case end_date == "":
                //     alert("Please select End date");
                //     end_date.focus();
                //     return false;
                //  default:
                    // $.ajax({
                    //     type:"post",
                    //     url: "<?php echo base_url(); ?>index.php/DisplayCustomRainfallReport/displaycustomrainfallreport",
                    //     data:{ 
                    //         station_name:station 
                    //     },
                    //     success:function(data){
                    //     console.log(data);
                    // },

                    //  error: function() {
                    //     console.log('Data not sent');
                    // },
                    // });



                  });

 });
</script>

<?php require_once(APPPATH . 'views/footer.php'); ?>