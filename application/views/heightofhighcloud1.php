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
            Dynamic charts
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">charts</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content report">
    <div id="output"></div>
    <div class="no-print">
        <div class="row">
            <form autocomplete="off" action="<?php echo base_url(); ?>index.php/ReportsController/displayheightofhighcloud1" method="post" enctype="multipart/form-data">
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
                    <input type="submit" name="generateDekadalReport_button" id="generateDekadalReport_button" class="btn btn-primary" value="Generate chart" >
                </div>
            </form>
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


        //$monthInWords= $displayDekadalReportHeaderFields['monthInWords'];
        $monthAsANumber= $displayDekadalReportHeaderFields['monthAsANumberselected'];

        $year= $displayDekadalReportHeaderFields['year'];


        $FromDatemonthDay =date('j',strtotime($FromDate)); //get the day num from the date.e.g 6th
        $ToDatemonthDay = date('j',strtotime($ToDate));


        ?>

    
            <h3>UGANDA NATIONAL METEOROLOGICAL AUTHORITY</h3>
           <h3>CHART ANALYSIS FOR WEATHER DATA</h3>
        
         <div class="col-lg-2"  style="float: right; margin-top: -10%; width: 145px;">
                <img src="<?php echo base_url(); ?>img/logo.fw.png" class="img-responsive">
        </div>

        <span><strong>Weather Station</strong></span>
        <span class="dotted-line"><?php echo $stationName;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <span><strong>Registered Number</strong></span> <span class="dotted-line"><?php echo "".$blocknumber."".$stationNumber."";?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span><strong>Date Range</strong></span><span class="dotted-line"><?php echo  $FromDate.'/'. $ToDate;?></span>
        <span class="dotted-line"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <!-- <span><strong>Month/Year</strong></span> <span class="dotted-line"><?php echo $monthAsANumber. '/'.$year;?></span> -->


        <div class="clearfix"></div>
        <br>
        <!-- <p><strong>Reading of selected parameters</strong></p> -->
            <div class="container">
            <br>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6 ">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">Dashboard - ItSolutionStuff.com</div> -->
                        <div class="panel-body">
                            <div id="container"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="panel panel-default">
                        <!-- <div class="panel-heading">Dashboard - ItSolutionStuff.com</div> -->
                        <div class="panel-body">
                            <div id="bar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
    <br/>
    <!-- <h2 class="text-center">Codeigniter 3 - Highcharts mysql json example</h2> -->
    <div class="row">
        <div class="clearfix"></div>
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Dashboard - ItSolutionStuff.com</div> -->
                <div class="panel-body">
                    <div id="column"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="panel panel-default">
                <!-- <div class="panel-heading">Dashboard - ItSolutionStuff.com</div> -->
                <div class="panel-body">
                    <div id="pie"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

    </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>
    <span><strong>Charts Generated BY:</strong></span> <span class="dotted-line"><?php echo $name;?></span>

        <br><br>


      <button onClick="print();return false;" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
         
        <a href="<?php echo base_url()."index.php/ReportsController/initializeheightofhighcloud1"; ?>" class="btn btn-warning pull-right no-print"><i class="fa fa-times"></i> Close Charts</a>
        <div class="clearfix"></div>
        <br><br>
    <?php }?>
    </section><!-- /. -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>


    <script type="text/javascript">

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

                // if(getyearFromThe_fromDate!=getyearFromThe_toDate){
                //     //var getmonthFromThe_fromDate=fromdate_forDekadalreport.getMonth() + 1;
                //     //var getmonthFromThe_toDate=todate_forDekadalreport.getMonth() + 1;
                //     alert("Please Select A range within the same year");
                //     $('#date').val("");  //Clear the field.
                //     $('#expdate').val("");  //Clear the field.
                //     return false;
                // }

////////////////////////////////////////////////////////////////////////////////////////////
                ////NID TO CHECK THAT THE FROM DATE AND TO DATE HAVE THE SAME MONTH
                var getmonthFromThe_fromDate=fromdate_forDekadalreport.getMonth() + 1;
                var getmonthFromThe_toDate=todate_forDekadalreport.getMonth() + 1;


                // if(getmonthFromThe_fromDate!=getmonthFromThe_toDate){
                //    // alert(getmonthFromThe_toDate+"|"+getmonthFromThe_fromDate);
                //     alert("Please Select A range within the same month");
                //     //AirTemporDryBulbTemp+"|"+DewPoint
                //     $('#date').val("");  //Clear the field.
                //     $('#expdate').val("");  //Clear the field.
                //     return false;
                // }
//////////////////////////////////////////////////////////////////////////////////////////////////
                ///NID TO GET THE TEN DAY COUNT OF A MONTH.
                var getdayFrom_ThefromDate=parseInt(fromdate_forDekadalreport.getDate());  //get the date like 12 of the month
                var getdayFrom_ThetoDate=parseInt(todate_forDekadalreport.getDate());


                //FROM DATE RANGE(1,11,21)
                
////////////////////////////////////////////////////////////////////////////////////////////////
         
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

    <script type="text/javascript">
    $(function () { 
  
    var data_click = <?php echo $view; ?>;
    var data_viewer = <?php echo $view; ?>;
  
    $('#container').highcharts({
        chart: {
            type: 'line'
        },
        title: {
            text: 'Height of High clouds 1 '
        },
        xAxis: {
             title: {
                text: 'count'
            },
            categories: ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
        },
        yAxis: {
            title: {
                text: 'Height in feet'
            }
        },
        series: [{
            name: 'Height of High clouds 1',
            data: data_click
        }]
    });


});

$(function () { 
  
    var data_click = <?php echo $view; ?>;
    var data_viewer = <?php echo $view; ?>;
  
    $('#column').highcharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Height of High clouds 1 '
        },
        xAxis: {
             title: {
                text: 'count'
            },
            categories: ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
        },
        yAxis: {
            title: {
                text: 'Height in feet'
            }
        },
        series: [{
            name: 'Height of High clouds 1',
            data: data_click
        }]
    });


});
$(function () { 
  
    var data_click = <?php echo $view; ?>;
    var data_viewer = <?php echo $view; ?>;
  
    $('#pie').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Height of High clouds 1 '
        },
        xAxis: {
             title: {
                text: 'count'
            },
            categories: ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
        },
        yAxis: {
            title: {
                text: 'Height in feet'
            }
        },
        series: [{
            name: 'Height of High clouds 1',
            data: data_click
        }]
    });


});
$(function () { 
  
    var data_click = <?php echo $view; ?>;
    var data_viewer = <?php echo $view; ?>;
  
    $('#bar').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Height of High clouds 1 '
        },
        xAxis: {
             title: {
                text: 'count'
            },
            categories: ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
        },
        yAxis: {
            title: {
                text: 'Height in feet'
            }
        },
        series: [{
            name: 'Height of High clouds 1',
            data: data_click
        }]
    });


});
  
</script>

<?php require_once(APPPATH . 'views/footer.php'); ?>
