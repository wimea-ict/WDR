<?php require_once(APPPATH . 'views/header.php');

$session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//'StationNumber' => $row->StationNumber,
?>
<script>
 function validation(expectedmin,expectedmax,value,id){
    // var compwithmin=expectedmin.localeCompare(value);
	// var compwithmax=expectedmax.localeCompare(value);
	if(parseInt(value,10)< parseInt(expectedmin,10)){
		document.getElementById(id).innerHTML="<i style='color:red;'>Value less than minimum expected. The expected min is <b>"+expectedmin+"</b></i>";
	}else if(parseInt(value,10)  >parseInt(expectedmax,10)){
		document.getElementById(id).innerHTML="<i style='color:red;'>Value greater than maximum expected. The expected max is <b>"+expectedmax+"</b></i>";
	}else{
		document.getElementById(id).innerHTML=" ";
	}
    	
return false;
}
</script>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Archive Dekadal Form Report Data
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Archive Dekadal Form Report Data</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php require_once(APPPATH . 'views/error.php'); ?>
            <?php

            if(is_array($displaynewarchivedekadalForm) && count($displaynewarchivedekadalForm)) {
                ?>
                <div class="row">
                    <form action='<?= base_url(); ?>index.php/ArchiveDekadalFormReportData/insertArchiveDekadalFormReportData/' method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div id="output"></div>
                            <script language="javascript">
                                function allowIntegerInputOnly(inputvalue) {
                                    //var invalidChars = /[^0-9]/gi
                                    var integerOnly =/[^0-9\.]/gi;  // integers and decimals //
                                    if(integerOnly.test(inputvalue.value)) {
                                        inputvalue.value = inputvalue.value.replace(integerOnly,"");
                                    }
                                }

                                function allowCharactersInputOnly(inputvalue) {
                                    //var invalidChars = /[^0-9]/gi
                                    var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                                    if(charsOnly.test(inputvalue.value)) {
                                        inputvalue.value = inputvalue.value.replace(charsOnly,"");
                                    }
                                }
                            </script>

                            <div class="col-lg-6">
                            
                            <!-- <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="text" name="date_archivedekadalformreportdata" required class="form-control" placeholder="Enter select date" id="date">
                                        <input type="hidden" name="checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield" id="checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield">
                                    </div>
                            </div> -->


                              <?php if(  $userrole== "ObserverDataEntrant"  ||  $userrole== "Senior Weather Observer" ){ ?>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Station Name</span>
                                            <input type="text" name="station_archivedekadalformreportdata" id="station_archivedekadalformreportdata" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"> Station Number</span>
                                            <input type="text" name="stationNo_archivedekadalformreportdata"  id="stationNo_archivedekadalformreportdata" required class="form-control" readonly  value="<?php echo $userstationNo;?>" readonly="readonly" >
                                        </div>
                                    </div>
<?php } elseif($userrole== "DataOfficer" || $userrole=="SeniorDataOfficer" ) {?>
 <!--  <div class="form-group">
      <div class="input-group">

          <span class="input-group-addon">Station</span>
          <select name="station_archivedekadalformreportdata" id="stationManager"   class="form-control" placeholder="Select Station">
              <option value="">Select Stations</option>
              <?php
              if (is_array($stationsdata) && count($stationsdata)) {
                  foreach($stationsdata as $station){?>
                      <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                  <?php }
              } ?>
          </select>
      </div>
  </div> -->
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
                       
                       <div class="form-group">
                            <div class="input-group">

                            <span class="input-group-addon">Station Name</span>
                            <select  name="station_archivedekadalformreportdata" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select>
                        </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station Number</span>
                                <input type="text" name="stationNo_archivedekadalformreportdata"  id="stationNoManager" required class="form-control" value=""  readonly class="form-control"  >
                            </div>
                        </div>
                        <?php }?>
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
                        <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="text" name="date_archivedekadalformreportdata" required class="form-control" placeholder="Enter select date" id="date">
                                        <input type="hidden" name="checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield" id="checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">DRY BULB TIME 9:00 AM</span>
                                        <input type="text" name="dryBulb0600Z_archivedekadalformreportdata" id="dryBulb0600Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter DRY BULB 9:00 AM" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">WET BULB TIME 9:00 AM</span>
                                        <input type="text" name="wetBulb0600Z_archivedekadalformreportdata" id="wetBulb0600Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter WET BULB 9:00 AM" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">DEW POINT TIME 9:00 AM</span>
                                        <input type="text" name="dewPoint0600Z_archivedekadalformreportdata" id="dewPoint0600Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter DEW POINT 9:00 AM" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">RELATIVE HUMIDITY 9:00 AM</span>
                                        <input type="text" name="relativeHumidity0600Z_archivedekadalformreportdata" id="relativeHumidity0600Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter RELATIVE HUMIDITY 9:00 AM" >

                                    </div>
                                </div>

                                 <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">WIND DIRECTION 9:00 AM</span>
                                        <input type="text" name="windDirection0600Z_archivedekadalformreportdata" id="windDirection0600Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter WIND DIRECTION 9:00 AM" >

                                    </div>
                                </div>

                                



                            </div>
                            <div class="col-lg-6">


                                 <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">MAX TEMPERATURE</span>
                                        <input type="text" name="maxTemp_archivedekadalformreportdata" onchange="validation(window.min_temp,window.max_temp,this.value,'errormaxtemptwo')" id="maxTemp_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MAX" >
                                    </div>
                                    <span id="errormaxtemptwo"></span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">WIND SPEED 9:00 AM</span>
                                        <input type="text" onchange="validation(window.min_windspeed,window.max_windspeed,this.value,'errorwindspeedone')" name="windSpeed0600Z_archivedekadalformreportdata" id="windSpeed0600Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter WIND SPEED 9:00 AM" >

                                    </div>
                                    <span id="errorwindspeedone"></span>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">MIN TEMPERATURE</span>
                                        <input type="text" name="minTemp_archivedekadalformreportdata" onchange="validation(window.min_temp,window.max_temp,this.value,'errormintemptwo')" id="minTemp_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                    </div>
                                    <span id="errormintemptwo"></span>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">RAINFALL</span>
                                        <input type="text" onchange="validation(window.min_rain,window.max_rain,this.value,'errorraintwo')" name="rainfall0600Z_archivedekadalformreportdata" id="rainfall0600Z_archivedekadalformreportdata"  required class="form-control" required placeholder="Enter RAINFALL 9:00 AM" >

                                    </div>
                                    <span id="errorraintwo"></span>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">DRY BULB 3:00 PM</span>
                                        <input type="text" name="dryBulb1200Z_archivedekadalformreportdata" id="dryBulb1200Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter DRY BULB 3:00 PM" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">WET BULB 3:00 PM</span>
                                        <input type="text" name="wetBulb1200Z_archivedekadalformreportdata" id="wetBulb1200Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter WET BULB 3:00 PM" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">DEW POINT 3:00 PM</span>
                                        <input type="text" name="dewPoint1200Z_archivedekadalformreportdata" id="dewPoint1200Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter DEW POINT 3:00 PM" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">RELATIVE HUMIDITY 3:00 PM</span>
                                        <input type="text" name="relativeHumidity1200Z_archivedekadalformreportdata" id="relativeHumidity1200Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter RELATIVE HUMIDITY 3:00 PM" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">WIND DIRECTION 3:00 PM</span>
                                        <input type="text" name="windDirection1200Z_archivedekadalformreportdata" id="windDirection1200Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter WIND DIRECTION 3:00 PM" >

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">WIND SPEED 3:00 PM</span>
                                        <input type="text" onchange="validation(window.min_windspeed,window.max_windspeed,this.value,'errorwindspeedtwo')" name="windSpeed1200Z_archivedekadalformreportdata" id="windSpeed1200Z_archivedekadalformreportdata" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter WIND SPEED 3:00 PM" >

                                    </div>
                                    <span id="errorwindspeedtwo"></span>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <center>

                            <a href="<?= base_url(); ?>index.php/ArchiveDekadalFormReportData/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                            <button type="submit"  name="postarchiveDekadalFormReportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT</button>
                        </center>
                    </form>
                </div>
                <?php
            }elseif((is_array($updatearchiveddekadalformreportdata) && count($updatearchiveddekadalformreportdata))) {
                foreach($updatearchiveddekadalformreportdata as $archiveddekadalformreportdata){

                    $archiveddekadalformreportdataid = $archiveddekadalformreportdata->id;
                    ?>
                    <div class="row">
                        <form action='<?= base_url(); ?>index.php/ArchiveDekadalFormReportData/updateArchiveDekadalFormReportData' method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $archiveddekadalformreportdataid ?>">
                            <div class="modal-body">
                                <div id="output"></div>
                                <script language="javascript">
                                    function allowIntegerInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var integerOnly =/[^0-9\.]/gi;  // integers and decimals //
                                        if(integerOnly.test(inputvalue.value)) {
                                            inputvalue.value = inputvalue.value.replace(integerOnly,"");
                                        }
                                    }

                                    function allowCharactersInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                                        if(charsOnly.test(inputvalue.value)) {
                                            inputvalue.value = inputvalue.value.replace(charsOnly,"");
                                        }
                                    }
                                </script>
                                <div class="col-lg-6">

                            

                            <?php        if($userrole== "DataOfficer" || $userrole=="SeniorDataOfficer" ) {?>
                                      <div class="form-group">
                                          <div class="input-group">

                                              <span class="input-group-addon">Station</span>
                                              <select name="station" id="stationManager"   class="form-control" placeholder="Select Station">
                                                  <option value="<?php echo $archiveddekadalformreportdata->StationName;?>"><?php echo $archiveddekadalformreportdata->StationName;?></option>
                                                  <?php
                                                  if (is_array($stationsdata) && count($stationsdata)) {
                                                      foreach($stationsdata as $station){?>
                                                          <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                                      <?php }
                                                  } ?>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="input-group">

                                              <span class="input-group-addon">Station Number</span>
                                              <input type="text" name="stationNo"  id="stationNoManager" required class="form-control" value="<?php echo $archiveddekadalformreportdata->StationNumber;?>"  readonly class="form-control"  >
                                          </div>
                                      </div>
                                    <?php } else {?>
                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon">Station</span>
                              <input type="text" name="station" id="station" required class="form-control" value="<?php echo $archiveddekadalformreportdata->StationName;?>"  readonly class="form-control" >

                          </div>
                      </div>

                      <div class="form-group">
                          <div class="input-group">
                              <span class="input-group-addon"> Station Number</span>
                              <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $archiveddekadalformreportdata->StationNumber;?>" readonly="readonly" >
                          </div>
                      </div>
                    <?php }?>

                             <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Dekadal Number</span>
                                <select name="dekadalnumber" id="dekadalnumber"  class="form-control"   value="<?php echo $archiveddekadalformreportdata->Dekadalnumber;?>">
                                        <option value="<?php echo $archiveddekadalformreportdata->Dekadalnumber;?>"><?php echo $archiveddekadalformreportdata->Dekadalnumber;?></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="text" name="date_archivedekadalformreportdata" value="<?php echo $archiveddekadalformreportdata->Date;?>" required class="form-control" placeholder="Enter select date" id="date">                                        
                                    </div>
                                  </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">DRY BULB TIME 9:00 AM</span>
                                            <input type="text" name="dryBulb0600Z" id="dryBulb0600Z" value="<?php echo $archiveddekadalformreportdata->DRY_BULB_0600Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WET BULB TIME 9:00 AM</span>
                                            <input type="text" name="wetBulb0600Z" id="wetBulb0600Z" value="<?php echo $archiveddekadalformreportdata->WET_BULB_0600Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">DEW POINT TIME 9:00 AM</span>
                                            <input type="text" name="dewPoint0600Z" value="<?php echo $archiveddekadalformreportdata->DEW_POINT_0600Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter DEW POINT 9:00 AM" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RELATIVE HUMIDITY TIME 9:00 AM</span>
                                            <input type="text" name="relativeHumidity0600Z" id="relativeHumidity0600Z" value="<?php echo $archiveddekadalformreportdata->RELATIVE_HUMIDITY_0600Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WIND DIRECTION 9:00 AM</span>
                                            <input type="text" name="windDirection0600Z" id="windDirection0600Z" value="<?php echo $archiveddekadalformreportdata->WIND_DIRECTION_0600Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WIND SPEED 9:00 AM</span>
                                            <input type="text" name="windSpeed0600Z" id="windSpeed0600Z" value="<?php echo $archiveddekadalformreportdata->WIND_SPEED_0600Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6">

                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">MAX</span>
                                            <input type="text" name="maxTemp" id="maxTemp" value="<?php echo $archiveddekadalformreportdata->MAX_TEMP;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MAX" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">MIN</span>
                                            <input type="text" name="minTemp" id="minTemp" value="<?php echo $archiveddekadalformreportdata->MIN_TEMP;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RAINFALL</span>
                                            <input type="text" name="rainfall0600Z" id="rainfall0600Z" value="<?php echo $archiveddekadalformreportdata->RAINFALL_0600Z;?>"  required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">DRY BULB 3:00 PM</span>
                                            <input type="text" name="dryBulb1200Z" id="dryBulb1200Z" value="<?php echo $archiveddekadalformreportdata->DRY_BULB_1200Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WET BULB 3:00 PM</span>
                                            <input type="text" name="wetBulb1200Z" id="wetBulb1200Z" value="<?php echo $archiveddekadalformreportdata->WET_BULB_1200Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">DEW POINT 3:00 PM</span>
                                            <input type="text" name="dewPoint1200Z" id="dewPoint1200Z" value="<?php echo $archiveddekadalformreportdata->DEW_POINT_1200Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RELATIVE HUMIDITY 3:00 PM</span>
                                            <input type="text" name="relativeHumidity1200Z" id="relativeHumidity1200Z" value="<?php echo $archiveddekadalformreportdata->RELATIVE_HUMIDITY_1200Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WIND DIRECTION 3:00 PM</span>
                                            <input type="text" name="windDirection1200Z" id="windDirection1200Z" value="<?php echo $archiveddekadalformreportdata->WIND_DIRECTION_1200Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WIND SPEED 3:00 PM</span>
                                            <input type="text" name="windSpeed1200Z" id="windSpeed1200Z" value="<?php echo $archiveddekadalformreportdata->WIND_SPEED_1200Z;?>" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Approved</span>
                                            
											<?php if($userrole=="DataOfficer" || $archiveddekadalformreportdata->Approved=='TRUE'){?>
									<select name="approval" id="approval" readonly  class="form-control" >
										<option value="<?php echo $archiveddekadalformreportdata->Approved;?>"><?php echo $archiveddekadalformreportdata->Approved;?></option>
										<option value="TRUE">TRUE</option>
										<option value="FALSE">FALSE</option>
									</select>
									<input type="hidden" name="approval" value="<?php echo $archiveddekadalformreportdata->Approved;?>">
									<?php }else{?>
									   <select name="approval" id="approval"  class="form-control" >
										<option value="<?php echo $archiveddekadalformreportdata->Approved;?>"><?php echo $archiveddekadalformreportdata->Approved;?></option>
										<option value="TRUE">TRUE</option>
										<option value="FALSE">FALSE</option>
									</select>
									<?php }?>
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <center>

                                <a href="<?php echo base_url()."index.php/ArchiveDekadalFormReportData/"; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                                <button type="submit" name="updatearchiveDekadalformreportdata_button" id="updatearchiveDekadalformreportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE</button>
                            </center>
                        </form>
                    </div>
                                <?php }
            }elseif((is_array($validatearchiveddekadalformreportdata) && count($validatearchiveddekadalformreportdata))) {
                foreach($validatearchiveddekadalformreportdata as $archiveddekadalformreportdata){

                    $archiveddekadalformreportdataid = $archiveddekadalformreportdata->id;
                    ?>
                    <div class="row">
                        <form action='<?= base_url(); ?>index.php/ArchiveDekadalFormReportData/updateArchiveDekadalFormReportData' method="post" enctype="multipart/form-data">
                          <input type="hidden" name="qualitycontrolled" value="qa">
                          <input type="hidden" name="id" value="<?php echo $archiveddekadalformreportdataid;?>">
                            <div class="modal-body">
                                <div id="output"></div>
                                <script language="javascript">
                                    function allowIntegerInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var integerOnly =/[^0-9\.]/gi;  // integers and decimals //
                                        if(integerOnly.test(inputvalue.value)) {
                                            inputvalue.value = inputvalue.value.replace(integerOnly,"");
                                        }
                                    }

                                    function allowCharactersInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                                        if(charsOnly.test(inputvalue.value)) {
                                            inputvalue.value = inputvalue.value.replace(charsOnly,"");
                                        }
                                    }
                                </script>
                                <script>
                                   function validation(oldvalue,newvalue,id){
                                     if((oldvalue!=newvalue)&&(oldvalue!="")){
                                       document.getElementById(id).innerHTML="<i style='color:red;'>Value mismatch. The value <b>"+oldvalue+"</b> was previously captured</i>";
                                        }else if((oldvalue=="")){
                                       document.getElementById(id).innerHTML="<i style='color:orange;'>No value was filled in this field previously</i>";             
                                         }else{
                                                    document.getElementById(id).innerHTML="<i style='color:green;' class='fa fa-check'> values match</i>";
                                                        
                                                    }
                                    }    
                                </script>
                                <div class="col-lg-6">

                                <?php  if($userrole== "DataOfficer" || $userrole=="SeniorDataOfficer" ) {?>
                                      <div class="form-group">
                                          <div class="input-group">

                                              <span class="input-group-addon">Station</span>
                                              <select name="station" id="stationManager"   class="form-control" placeholder="Select Station">
                                                  <option value="<?php echo $archiveddekadalformreportdata->StationName;?>"><?php echo $archiveddekadalformreportdata->StationName;?></option>
                                                  <?php
                                                  if (is_array($stationsdata) && count($stationsdata)) {
                                                      foreach($stationsdata as $station){?>
                                                          <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                                      <?php }
                                                  } ?>
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="input-group">

                                              <span class="input-group-addon">Station Number</span>
                                              
                                              <input type="text" name="stationNo"  id="stationNoManager" required class="form-control" value="<?php echo $archiveddekadalformreportdata->StationNumber;?>"  readonly class="form-control"  >
                                          </div>
                                      </div>
                                    <?php } else {?>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Station</span>
                                            <input type="text" name="station" id="station" required class="form-control" value="<?php echo $archiveddekadalformreportdata->StationName;?>"  readonly class="form-control" >

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"> Station Number</span>
                                            <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $archiveddekadalformreportdata->StationNumber;?>" readonly="readonly" >
                                        </div>
                                    </div>
                                        <?php }?>
                                        <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Select Date</span>
                                            <input type="text" name="date_archivedekadalformreportdata" value="<?php echo $archiveddekadalformreportdata->Date;?>" readonly class="form-control" placeholder="Enter select date" id="date">
                                            
                                            <span id="errordate"></span>   
                                        </div>
                                    </div>
                                        <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Dekadal Number</span>
                
                                            <select name="dekadalnumber" id="dekadalnumber"  class="form-control">
                                                    <option value="<?php echo $archiveddekadalformreportdata->Dekadalnumber;?>"><?php echo $archiveddekadalformreportdata->Dekadalnumber;?></option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">MAX</span>
                                            <input type="text" name="maxTemp"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->MAX_TEMP;?>',this.value,'errormaxTemp');" required class="form-control" required placeholder="Enter MAX" >
                                        </div>
                                        <span id="errormaxTemp"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">MIN</span>
                                            <input type="text" name="minTemp"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->MIN_TEMP;?>',this.value,'errorminTemp');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorminTemp"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">DEW POINT TIME 9:00 AM</span>
                                            <input type="text" name="dewPoint0600Z"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->DEW_POINT_0600Z;?>',this.value,'errordewPoint0600Z');" required class="form-control" required placeholder="Enter DEW POINT 9:00 AM" >

                                        </div>
                                        <span id="errordewPoint0600Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RELATIVE HUMIDITY TIME 9:00 AM</span>
                                            <input type="text" name="relativeHumidity0600Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->RELATIVE_HUMIDITY_0600Z;?>',this.value,'errorrelativeHumidity0600Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorrelativeHumidity0600Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WIND DIRECTION 9:00 AM</span>
                                            <input type="text" name="windDirection0600Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->WIND_DIRECTION_0600Z;?>',this.value,'errorwindDirection0600Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorwindDirection0600Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WIND SPEED 9:00 AM</span>
                                            <input type="text" name="windSpeed0600Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->WIND_SPEED_0600Z;?>',this.value,'errorwindSpeed0600Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorwindSpeed0600Z"></span>
                                    </div>

                                </div>
                                <div class="col-lg-6">

                                <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">DRY BULB TIME 9:00 AM</span>
                                            <input type="text" name="dryBulb0600Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->DRY_BULB_0600Z;?>',this.value,'errordryBulb0600Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errordryBulb0600Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WET BULB TIME 9:00 AM</span>
                                            <input type="text" name="wetBulb0600Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->WET_BULB_0600Z;?>',this.value,'errorwetBulb0600Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorwetBulb0600Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RAINFALL</span>
                                            <input type="text" name="rainfall0600Z"  value=""  onkeyup="validation('<?php echo $archiveddekadalformreportdata->RAINFALL_0600Z;?>',this.value,'errorrainfall0600Z');allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter Rainfall" >

                                        </div>
                                        <span id="errorrainfall0600Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">DRY BULB 3:00 PM</span>
                                            <input type="text" name="dryBulb1200Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->DRY_BULB_1200Z;?>',this.value,'errordryBulb1200Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errordryBulb1200Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WET BULB 3:00 PM</span>
                                            <input type="text" name="wetBulb1200Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->WET_BULB_1200Z;?>',this.value,'errorwetBulb1200Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorwetBulb1200Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">DEW POINT 3:00 PM</span>
                                            <input type="text" name="dewPoint1200Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->DEW_POINT_1200Z;?>',this.value,'errordewPoint1200Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errordewPoint1200Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RELATIVE HUMIDITY 3:00 PM</span>
                                            <input type="text" name="relativeHumidity1200Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->RELATIVE_HUMIDITY_1200Z;?>',this.value,'errorrelativeHumidity1200Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorrelativeHumidity1200Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WIND DIRECTION 3:00 PM</span>
                                            <input type="text" name="windDirection1200Z"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->WIND_DIRECTION_1200Z;?>',this.value,'errorwindDirection1200Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorwindDirection1200Z"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">WIND SPEED 3:00 PM</span>
                                            <input type="text" name="windSpeed1200Z" value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $archiveddekadalformreportdata->WIND_SPEED_1200Z;?>',this.value,'errorwindSpeed1200Z');" required class="form-control" required placeholder="Enter MIN" >

                                        </div>
                                        <span id="errorwindSpeed1200Z"></span>
                                    </div>


                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Approved</span>
                                            
                                            <?php if($userrole=="DataOfficer" || $archiveddekadalformreportdata->Approved=='TRUE'){?>
                                    <select name="approval" id="approval" readonly  class="form-control" >
                                        <option value="<?php echo $archiveddekadalformreportdata->Approved;?>"><?php echo $archiveddekadalformreportdata->Approved;?></option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                    <input type="hidden" name="approval" value="<?php echo $archiveddekadalformreportdata->Approved;?>">
                                    <?php }else{?>
                                       <select name="approval" id="approval"  class="form-control" readonly>
                                        <option value="<?php echo $archiveddekadalformreportdata->Approved;?>"><?php echo $archiveddekadalformreportdata->Approved;?></option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                    <?php }?>
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <center>

                                <a href="<?php echo base_url()."index.php/ArchiveDekadalFormReportData/"; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                                <button type="submit" name="updatearchiveDekadalformreportdata_button" id="updatearchiveDekadalformreportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE</button>
                            </center>
                        </form>
                    </div>
                <?php
                    }
                }else{
                if($userrole!="QC"){
                ?>
                <div class="row">
                    <div class="col-xs-3"><a class="btn btn-primary no-print"
                                             href="<?php echo base_url()."index.php/ArchiveDekadalFormReportData/DisplayNewArchiveDekadalForm/";?>"
                        <i class="fa fa-plus"></i> Add Archive Dekadal</a>



                    </div>

                </div>
                <?php } ?>
                <br>
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <?php require_once(APPPATH . 'views/error.php'); ?>
                            <div class="box-body table-responsive" style="overflow:auto">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Record No</th>
                                        <th>DATE</th>
                                        <th>Station</th>
                                        <th>Station No</th>
                                        <th>DEKADAL NUMBER</th>
                                        <th>MAX</th>
                                        <th>MIN</th>
                                        <th>DRY BULB</th>
                                        <th>WET BULB</th>
                                        <th>DEW POINT</th>
                                        <th>RELATIVE HUMIDITY</th>
                                        <th>DIRECTION</th>

                                        <th>SPEED</th>
                                        <th>RAINFALL</th>
                                        <th>DRY BULB</th>
                                        <th>WET BULB</th>
                                        <th>DEW POINT</th>
                                        <th>RELATIVE HUMIDITY</th>
                                        <th>QUALITY CONTROL</th>
                                        <?php if( $userrole=='SeniorDataOfficer' || $userrole=='DataOfficer' || $userrole=='ObserverArchive'  || $userrole=='Senior Weather Observer'||$userrole=="QC"){ ?>
                                            <th>Approved</th>
                                            <th>Submitted By</th>
                                            <th>Comments</th>
                                            <th class="no-print">Action</th>
                                        <?php

                                     }?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 0;
                                    if (is_array($archivedDekadalformreportdata) && count($archivedDekadalformreportdata)) {
                                        foreach($archivedDekadalformreportdata as $data){
                                           
                                            $id = $data->id;
											 if($userrole =='DataOfficer'&& $data->Approved =='TRUE' ){
									   $count++;
									   }else{
										   $count++;

                                            ?>
                                            <tr>
                                                <td ><?php echo $count;?><br><h6 style="color:red;font-size:8px;font-weight:bold;"><?php echo $data->numberofcomments>0 ? "( ".$data->numberofcomments." Comments )":"" ?> </h6></td>
                                                <td ><?php echo $data->Date;?></td>
                                                <td ><?php echo $data->StationName;?></td>
                                                <td ><?php echo $data->StationNumber;?></td>
                                                <td ><?php echo $data->Dekadalnumber;?></td>
                                                <td ><?php echo $data->MAX_TEMP;?></td>
                                                <td ><?php echo $data->MIN_TEMP;?></td>
                                                <td ><?php echo $data->DRY_BULB_0600Z;?></td>
                                                <td ><?php echo $data->WET_BULB_0600Z;?></td>
                                                <td ><?php echo $data->DEW_POINT_0600Z;?></td>
                                                <td><?php echo $data->RELATIVE_HUMIDITY_0600Z;?></td>
                                                <td><?php echo $data->WIND_DIRECTION_0600Z;?></td>
                                                <td ><?php echo $data->WIND_SPEED_0600Z;?></td>
                                                <td ><?php echo $data->RAINFALL_0600Z;?></td>
                                                <td><?php echo $data->DRY_BULB_1200Z;?></td>
                                                <td><?php echo $data->WET_BULB_1200Z;?></td>
                                                <td><?php echo $data->DEW_POINT_1200Z;?></td>
                                                <td><?php echo $data->RELATIVE_HUMIDITY_1200Z;?></td>
                                                <td><?php echo ($data->qaBy==NULL)?"Pending":$data->qaBy; ?></td>
                                                <?php if( $userrole=='SeniorDataOfficer' || $userrole=='DataOfficer' || $userrole=='ObserverArchive'  || $userrole=='Senior Weather Observer'||$userrole=="QC"){ ?>
                                                  <td><?php echo $data->Approved;?></td>

                                                  <td><?php echo $data->AD_SubmittedBy;?></td>
                                                   <td class="no-print"> 

                                                <?php if($data->Approved=="FALSE" || $userrole!='DataOfficer'){ ?>
                                                  <h6><?php echo $data->numberofcomments; ?> comments on this record</h6>
                                                  <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>index.php/ArchiveDekadalFormReportData/index/<?php echo $data->id ?>/">View/ Add Comments</a> <br><br>
                                                <?php }else{ ?> 
                                                <h6 style="color:green;"> <li class='fa fa-check'></li> Record approved</h6>
                                                <?php }?>
                                                </td>
                                                  <td class="no-print">

                                                    
													  <table>
                                         <tr><td>
                                            <?php  if($userrole=='QC'){?>
                                                <?php if($data->qaBy==NULL){?>
                                                    <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "index.php/ArchiveDekadalFormReportData/DisplayArchivedDekadalFormForValidation/" .$id ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li> Verify</a>
												<?php }else{ ?>
                                                    <a class="btn btn-success btn-xs" href="" disabled><li class="fa fa-check"></li> Verified </a>
												<?php } ?>
                                            
                                         <?php }else{ ?>
                                            <a class="btn btn-primary" href="<?php echo base_url() . "index.php/ArchiveDekadalFormReportData/DisplayArchivedDekadalFormForUpdate/" .$id ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li> Edit</a>
                                         <?php } ?>
													
										   </td>
                    <?php if($userrole== 'SeniorDataOfficer' && $data->Approved=="TRUE" ){?>
                        <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveDekadalFormReportData/update_approval/" .$id ;?>"> <input type="hidden" name="id" value="<?php echo $id?>" ><input type="hidden" name="approve" value="FALSE" ><button class="btn btn-danger"  type="submit"  ><li class='fa fa-times'></li> Disapprove</button></form>
                            </td> <?php }elseif( $userrole=='Senior Weather Observer' && $data->Approved=="FALSE" || $userrole =='SeniorDataOfficer' && $data->Approved=="FALSE"){?>
                                <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveDekadalFormReportData/update_approval/" .$id ;?>"> <input type="hidden" name="id" value="<?php echo $id ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success"  type="submit"  ><li class='fa fa-check'></li> Approve &nbsp;&nbsp;&nbsp;&nbsp;</button></form>
                                </td>

                                <?php
                            }else{ }?>
											<!-- <?php if($userrole=='SeniorDataOfficer'){?>
											<td>
											
											<form method="post" action="<?php echo base_url() . "index.php/ArchiveDekadalFormReportData/update_approval/" .$id ;?>"> <input type="hidden" name="id" value="<?php echo $id; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($data->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
											</td><?php }?>  -->
									     </tr>
										 </table>
                                            </td>
											</tr>

                                            <?php
									   }}
                                    }
                                  }
                                    ?>
                                    </tbody>
                                </table>
                                <br>
                                 <?php if(isset($observationslipcomments)){ ?>
              
                          <div class="row no-print" style="padding:10px;">
                            
                            <div class="col-md-6">
                            <h4 >Comments</h4>
                             
                              <ul>
                               <?php if(count($observationslipcomments)){
                                foreach($observationslipcomments as $row){ ?>
                                <li><?php echo $row->comment ?>
                                <br>
                                <b><?php echo $row->comment_by.' [ '.$row->userrole.' ] ' ?></b>
                                <?php if($row->solved!="TRUE"){
                                      if($userrole=="SeniorDataOfficer"){ ?>
                                     <a style="margin-left:10px;" href="<?php echo base_url(); ?>index.php/ArchiveObservationSlipFormData/markcommentAsResolved/<?php echo $row->id; ?>" class='btn btn-info btn-xs'>Mark as resolverd</a>
                                     <?php }else{ ?>
                                        
                                     <?php } }else{ ?>
                                       <span style="color:green;margin-left:30px;"><i class="fa fa-check"></i> Resolved</span>
                                     <?php } ?>
                                </li>
                                <?php } }else{ ?>
                                 <h5>No Comments on this record</h5>
                                <?php } ?>
                              </ul>
                            </div>
                            <div class="col-md-6">
                            <h4 >Add a comment</h4>
                            <form method="post" action="<?php echo base_url(); ?>index.php/ArchiveDekadalFormReportData/submitObservationslipComment/">
                            <input type="hidden" name="recordid" value="<?php echo $id ?>" id="">
                            <textarea name="comment" id="" cols="20" rows="6" class="form-control" placeholder="type your comment here">
                            
                            </textarea>
                            <br>
                            <button class="btn tn-info btn-sm" type="submit">Submit comment</button>
                            </form>
                            </div>
                          </div>
                         <?php } ?>
                                <br>
                                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT</button>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
                <?php
            }
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
            //Post Add New  Archive Dekadal  form Report data into the DB
            //Validate each select field before inserting into the DB
            $('#postarchiveDekadalFormReportdata_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveDekadalFormReportData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Dekadal Record with the Same date ,station name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number or date not picked");
                    return false;
                }



                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield").focus();
                    return false;

                }


                //Check that Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }


                //Check that the a station is selected from the list of stations(OC)
                var station=$('#stationManager').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archivedekadalformreportdata').val("");  //Clear the field.
                    $("#station_archivedekadalformreportdata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(OC)
                var stationNo=$('#stationNoManager').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archivedekadalformreportdata').val("");  //Clear the field.
                    $("#stationNo_archivedekadalformreportdata").focus();
                    return false;

                }






            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE DEKADAL RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveDekadalFormReportData(){

            //Check against the date,stationName,StationNumber,Time and Metar Option.
            var date = $('#date').val();

                var stationName=$('#stations-list').val();
                var stationNumber=$('#stationNoManager').val();

            $('#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationNumber != undefined) ) {

                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveDekadalFormReportData/checkInDBIfArchiveDekadalFormReportRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,
                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield').empty();

                            //alert(data);
                            $("#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield').empty();

                             //alert(data);
                            $("#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield").val(data);

                        }
                    },
                    error:function(data){
                        alert();
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveDekadalFormReportData_hiddentextfield").val();

            }//end of if
            else if((date == undefined) ||  (stationName == undefined) || (stationNumber == undefined)){

                var truthvalue="Missing";
            }


            return truthvalue;
        }//end of check duplicate values in the DB
        // return false;

    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive Dekadal form Report data into the DB
            //Display A Dialog Box when a user wants to update a textfield
            $('#updatearchiveDekadalformreportdata_button').click(function(event) {
                //Check that Date selected
                var updatedate=$('#expdate').val();
                if(updatedate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;

                }


                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station').val("");  //Clear the field.
                    $("#station").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo').val("");  //Clear the field.
                    $("#stationNo").focus();
                    return false;

                }



                //Check that Approved IS PICKED FROM A LIST
                var approved=$('#approval').val();
                if(approved==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select Approved from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
                    return false;

                }



            }); //button
            //  return false;

        });  //document
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){

            var newValue_maxTemp;
            var oldValue_maxTemp=$('#maxTemp').val();

            $('#maxTemp').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_maxTemp = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxTemp').val(newValue_maxTemp);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxTemp').val(oldValue_maxTemp);
                    return false;
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_minTemp ;
            var oldValue_minTemp= $('#minTemp').val()

            $('#minTemp').live('change paste', function(){
                //oldValue_minTemp = newValue_minTemp;
                newValue_minTemp = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#minTemp').val(newValue_minTemp);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#minTemp').val(oldValue_minTemp);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_dryBulb0600Z;
            var oldValue_dryBulb0600Z= $('#dryBulb0600Z').val()

            $('#dryBulb0600Z').live('change paste', function(){
                // oldValue_dryBulb0600Z = newValue_dryBulb0600Z;
                newValue_dryBulb0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dryBulb0600Z').val(newValue_dryBulb0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dryBulb0600Z').val(oldValue_dryBulb0600Z);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_wetBulb0600Z;
            var oldValue_wetBulb0600Z= $('#wetBulb0600Z').val();

            $('#wetBulb0600Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_wetBulb0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wetBulb0600Z').val(newValue_wetBulb0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wetBulb0600Z').val(oldValue_wetBulb0600Z);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_dewPoint0600Z;
            var oldValue_dewPoint0600Z= $('#dewPoint0600Z').val();

            $('#dewPoint0600Z').live('change paste', function(){
                //oldValue_dewPoint0600Z = newValue_dewPoint0600Z;
                newValue_dewPoint0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dewPoint0600Z').val(newValue_dewPoint0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dewPoint0600Z').val(oldValue_dewPoint0600Z);
                    return false;
                }

            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_relativeHumidity0600Z;
            var oldValue_relativeHumidity0600Z= $('#relativeHumidity0600Z').val()

            $('#relativeHumidity0600Z').live('change paste', function(){
                //oldValue_relativeHumidity0600Z = newValue_relativeHumidity0600Z;
                newValue_relativeHumidity0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#relativeHumidity0600Z').val(newValue_relativeHumidity0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#relativeHumidity0600Z').val(oldValue_relativeHumidity0600Z);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_windDirection0600Z;
            var oldValue_windDirection0600Z= $('#windDirection0600Z').val()

            $('#windDirection0600Z').live('change paste', function(){
                //oldValue_qnhin = newValue_qnhin;
                newValue_windDirection0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windDirection0600Z').val(newValue_windDirection0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windDirection0600Z').val(oldValue_windDirection0600Z);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_windSpeed0600Z;
            var oldValue_windSpeed0600Z= $('#windSpeed0600Z').val();

            $('#windSpeed0600Z').live('change paste', function(){
                // oldValue_windSpeed0600Z = newValue_windSpeed0600Z;
                newValue_windSpeed0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windSpeed0600Z').val(newValue_windSpeed0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windSpeed0600Z').val(oldValue_windSpeed0600Z);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_rainfall0600Z;
            var oldValue_rainfall0600Z= $('#rainfall0600Z').val();

            $('#rainfall0600Z').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_rainfall0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rainfall0600Z').val(newValue_rainfall0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#rainfall0600Z').val(oldValue_rainfall0600Z);
                    return false;
                }
            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_dryBulb1200Z;
            var oldValue_dryBulb1200Z= $('#dryBulb1200Z').val()

            $('#dryBulb1200Z').live('change paste', function(){
                // oldValue_dryBulb1200Z = newValue_dryBulb1200Z;
                newValue_dryBulb1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dryBulb1200Z').val(newValue_dryBulb1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dryBulb1200Z').val(oldValue_dryBulb1200Z);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_wetBulb1200Z;
            var oldValue_wetBulb1200Z= $('#wetBulb1200Z').val();

            $('#wetBulb1200Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_wetBulb1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wetBulb1200Z').val(newValue_wetBulb1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wetBulb1200Z').val(oldValue_wetBulb1200Z);
                    return false;
                }

            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_dewPoint1200Z;
            var oldValue_dewPoint1200Z= $('#dewPoint1200Z').val();

            $('#dewPoint1200Z').live('change paste', function(){
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
                newValue_dewPoint1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dewPoint1200Z').val(newValue_dewPoint1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dewPoint1200Z').val(oldValue_dewPoint1200Z);
                    return false;
                }

            });
        });
    </script>
    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_relativeHumidity1200Z;
            var oldValue_relativeHumidity1200Z= $('#relativeHumidity1200Z').val()

            $('#relativeHumidity1200Z').live('change paste', function(){
                //oldValue_relativeHumidity0600Z = newValue_relativeHumidity0600Z;
                newValue_relativeHumidity1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#relativeHumidity1200Z').val(newValue_relativeHumidity1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#relativeHumidity1200Z').val(oldValue_relativeHumidity1200Z);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_windDirection1200Z;
            var oldValue_windDirection1200Z= $('#windDirection1200Z').val()

            $('#windDirection1200Z').live('change paste', function(){
                //oldValue_qnhin = newValue_qnhin;
                newValue_windDirection1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windDirection1200Z').val(newValue_windDirection1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windDirection1200Z').val(oldValue_windDirection1200Z);
                    return false;
                }
            });
        });
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_windSpeed1200Z;
            var oldValue_windSpeed1200Z= $('#windSpeed1200Z').val();

            $('#windSpeed1200Z').live('change paste', function(){
                // oldValue_windSpeed0600Z = newValue_windSpeed0600Z;
                newValue_windSpeed1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windSpeed1200Z').val(newValue_windSpeed1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windSpeed1200Z').val(oldValue_windSpeed1200Z);
                    return false;
                }
            });
        });
    </script>




    <script type="text/javascript">
        //Once the Manager selects the Station the Station Number should be picked from the DB Automatically.
        // For Insert/Add Archieve Dekadal Form Data
        $(document.body).on('change','#stationarchivedekadalformreportdataManager',function(){
            $('#stationNoarchivedekadalformreportdataManager').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoarchivedekadalformreportdataManager').val("");
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

                            $('#stationNoarchivedekadalformreportdataManager').empty();

                            // alert(data);
                            $("#stationNoarchivedekadalformreportdataManager").val(json[0].StationNumber);

                        }
                        else{

                            $('#stationNoarchivedekadalformreportdataManager').empty();
                            $('#stationNoarchivedekadalformreportdataManager').val("");

                        }
                    }

                });



            }
            else {

                $('#stationNoarchivedekadalformreportdataManager').empty();
                $('#stationNoarchivedekadalformreportdataManager').val("");
            }

        })

    </script>

    <script type="text/javascript">

        //Once the Manager selects the Station the Station Number should be picked from the DB.
        // For Update Archive
        $(document.body).on('change','#stationManager',function(){
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
        //Once the Manager loads the Update page the value of Selected Station is displayed.
        // So Get the StationNumber from the DB immediately before he can select wat he wants.
        //On Update Dekadal Form
        var stationName = $("#stationManager").val();
        $('#stationNoManager').val("");  //Clear the field.

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



     });
    </script>
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.1/css/jquery.dataTables.css">
<?php require_once(APPPATH . 'views/footer.php'); ?>
<script src="<?php echo base_url(); ?>js/form0.js"></script>
