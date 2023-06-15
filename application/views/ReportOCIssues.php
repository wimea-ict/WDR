<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <small>
                <b>Name: <?php echo $name ; ?> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Role: <?php echo $userrole  ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Station: <?php echo $userstation  ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                    Station Number: <?php echo $userstationNo ; ?>  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                </b>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">OC Report Issues</li>

        </ol>
    </section>
    <?php require_once(APPPATH . 'views/error.php'); ?>

    <!-- Main content -->
    <section class="content report">
 <div class="no-print">
        <div id="output"></div>
        <div class="row">
            <form autocomplete="off" action="<?php echo base_url(); ?>index.php/ReportOCIssues/reportOCIssues/" method="post" enctype="multipart/form-data">
            <?php
        if(is_array($OCdata) &&
    count($OCdata) &&
    is_array($OCdata) &&
    !empty($OCdata)){
            $date = $OCdata['date'];
            $time = $OCdata['time'];
            $year = $OCdata['year'];
            $datefrom = $OCdata['datefrom'];
            $dateto = $OCdata['dateto'];
            $month = $OCdata['month'];
            $reporttype= $OCdata['reporttype'];
            $stationName = $OCdata['stationName'];
            $StationNumber = $OCdata['stationNumber'];
            $Stationid = $OCdata['stationId'];

?>    
                <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="hidden" name="reporttype"  value="<?php echo  $reporttype;?>" >
                                <input type="text" name="stationOC" id="stationOC" class="form-control" value="<?php echo $stationName;?>" placeholder="Please select station" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                

                
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value=" <?php echo $Stationid;?>" >

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNoOC"  class="form-control" value="<?php echo $StationNumber;?>" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php if($reporttype=='metaReport'|| $reporttype=='synopticReport'){ ?>
                    <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Select Date</span>
                            <input type="text" name="date" id="date" class="form-control summonth" value="<?php echo $date;?>" readonly autocomplete="off" >
                        </div>
                    </div>
                </div>
                <?php }else if($reporttype=='observationslip'){?>
                <div class="col-xs-3">

            <div class="input-group">
            <span class="input-group-addon" >Select Time</span>
            <div class="input-group timepicker">
             <input id="timepicker2" type="text" readonly name="Time" value="<?php echo $time;?>"  class="form-control" autocomplete="off">

            </div>
           <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            </div>
            </div>
            <div class="col-xs-3">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Select Date</span>
                            <input type="text" name="date" id="date" class="form-control summonth" value="<?php echo $date;?>" readonly autocomplete="off" >
                        </div>
                    </div>
                </div>
                <?php }else if($reporttype=='weathersummaryreport' || $reporttype=='monthlyrainfallreport'){ ?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                               
                                <span class="input-group-addon">Month</span>
                                <input type="text" name="month"  class="form-control" value="<?php echo $month;?>" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value=" <?php echo $Stationid;?>" >

                                <span class="input-group-addon">Year</span>
                                <input type="text" name="year"  class="form-control" value="<?php echo $year;?>" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }else if($reporttype=='dekadalReport'){ ?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                               
                                <span class="input-group-addon">Date From</span>
                                <input type="text" name="datefrom"  class="form-control" value="<?php echo $datefrom;?>" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value=" <?php echo $Stationid;?>" >

                                <span class="input-group-addon">Date To</span>
                                <input type="text" name="dateto"  class="form-control" value="<?php echo $dateto;?>" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php }else if($reporttype=='anualrainfallreport'){ ?>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="hidden" name="page" value=" <?php echo $Stationid;?>" >

                                <span class="input-group-addon">Year</span>
                                <input type="text" name="year"  class="form-control" value="<?php echo $year;?>" readonly class="form-control"  >
                            </div>
                        </div>
                    </div>

                <?php } ?>
                

                <div class= "col-xs-5">
                   <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Report Issue Description</span>
                            <!-- <textarea rows="5" cols="50" name="issue"  placeholder="Enter issue to Report"></textarea> -->
                            <!-- <input type="text" name="issue" id="date" class="form-control summonth" placeholder="Please select the date" autocomplete="off" > -->
                            <textarea  name="issue"  class="form-control" style="height:40px;" textarea>
                        </div>
                    </div> 
                </div>
                <?php }else{?>

    <center>
        <?php echo "No  Report Data sent of ".$stationName.' '.'Date'.' '.$date. ' '.'And Time   '.$time.' '.'From the DB'; ?>
    </center>

<?php

                }?>
                <div class="col-xs-2">
                    <input type="submit" style="margin-top: 140px;" name="generateobservationslipreport_button" id="generateobservationslipreport_button" class="btn btn-primary" value="Send Issue" >
                </div>

            </form>



    </div>

 


    <script>
        $(document).ready(function() {
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#generateobservationslipreport_button').click(function(event) {


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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
        <!-- Bootstrap -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>js/form.js"></script>
