<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
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
            Archive Weather Summary Form Report Data
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"> Archive Weather Summary Form Report Data</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewarchiveweathersummaryFormreportdata) && count($displaynewarchiveweathersummaryFormreportdata)) {
        ?>
        <div class="row">
        <form action="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/insertArchiveWeatherSummaryFormReportData/" id="regForm" method="post" enctype="multipart/form-data">


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

	   <div class = "tab"><h2>Weather Summary Data:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
            <?php        if($userrole== "DataOfficer" || $userrole=="SeniorDataOfficer" ) {?>
            		<td >
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
               	</td>
               	<td>
                        <!--   <div class="input-group">

                            <span class="input-group-addon">Station Name</span>
                            <select  name="station_archiveweathersummaryformreportdata" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select> -->
                        

                              <!-- <span class="input-group-addon">Station</span> -->
                              <!-- <select name="station_archiveweathersummaryformreportdata" id="stationManager"   class="form-control" placeholder="Select Station">
                                  <option value="<?php echo $rainfalldata->StationName;?>"><?php echo $rainfalldata->StationName;?></option>
                                  <?php
                                  if (is_array($stationsdata) && count($stationsdata)) {
                                      foreach($stationsdata as $station){?>
                                          <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                      <?php }
                                  } ?>
                              </select> -->
                            <div class="form-group">
                            <div class="input-group">

                            <span class="input-group-addon">Station Name</span>
                            <select  name="station_archiveweathersummaryformreportdata" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select>
                        </div>
                        </div>
                          
                      </td>
               </tr>
               <tr>
                      
                        <td>
                          <div class="input-group">

                              <span class="input-group-addon">Station Number</span>
                              <input type="text" name="stationNo"  id="stationNoManager" required class="form-control" value=""  readonly class="form-control"  >
                          </div>
                      </td>
                    <?php } else {?>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Station</span>
								<input type="text" name="stationNo_archiveweathersummaryformreportdata" id="station_archiveweathersummaryformreportdata"  class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								<input type="text" name="stationNo_archiveweathersummaryformreportdata"  class="form-control compulsory" id="stationNo_archiveweathersummaryformreportdata" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
							</div>
						</td>
          <?php } ?>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Select Date</span>
								<input type="text" name="date_archiveweathersummaryformreportdata"   class="form-control compulsory" placeholder="Enter select date" id="date">


							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sunshine(Hrs)</span>
								<input type="text" name="sunshine_wsf" id="sunshine_wsf" onkeyup="allowIntegerInputOnly(this)"   class="form-control"  placeholder="Enter the Sunshine (Hrs)" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Max Temp</span>
								<input type="text" name="maxTemp_wsf" id="maxTemp_wsf" onkeyup="allowIntegerInputOnly(this)" onchange="validation(window.min_temp,window.max_temp,this.value,'errormaxread')" class="form-control"  placeholder="Enter max temp" >
							</div>
                            <span id="errormaxread"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Min Temp</span>
								<input type="text" name="minTemp_wsf" id="minTemp_wsf" onchange="errorminread" onkeyup="allowIntegerInputOnly(this),validation(window.min_temp,window.max_temp,this.value,'errorminread')"   class="form-control"  placeholder="Enter min temp" >
							</div>
                            <span id="errorminread"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DB 0600Z</span>
								<input type="text" name="db0600Z_wsf" id="db0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter DB for 0600Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">WB 0600Z</span>
							<input type="text" name="wb0600Z_wsf" id="wb0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"   class="form-control" placeholder="Enter WB for 0600Z" >
						</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DP 0600Z</span>
								<input type="text" name="dp0600Z_wsf" id="dp0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"   class="form-control" placeholder="Enter DP for 0600Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">VP 0600Z</span>
								<input type="text" name="vp0600Z_wsf"  id="vp0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter VP for 0600Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">RH 0600Z</span>
								<input type="text" name="rh0600Z_wsf" id="rh0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"    class="form-control" placeholder="Enter RH for 0600Z" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">CLP 0600Z</span>
								<input type="text" name="clp0600Z_wsf"  id="clp0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter CLP for 0600Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">GPM 0600Z</span>
								<input type="text" name="gpm0600Z_wsf" id="gpm0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter GPM for 0600Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">WIND DIR 0600Z</span>
								<input type="text" name="winddir0600Z_wsf"  id="winddir0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Wind Direction for 0600z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">FF 0600Z</span>
								<input type="text" name="ff0600Z_wsf"  id="ff0600Z_wsf" onkeyup="allowIntegerInputOnly(this)"   class="form-control"  placeholder="Enter FF for 0600Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DB 1200Z</span>
								<input type="text" name="db1200Z_wsf"  id="db1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter DB for 1200Z" >
							</div>
						</td>
					</tr>
				</table>
		</div>

	   <div class = "tab"><h2>More Data:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WB 1200Z</span>
								<input type="text" name="wb1200Z_wsf" id="wb1200Z_wsf"  onkeyup="allowIntegerInputOnly(this)"   class="form-control" placeholder="Enter WB for 1200Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DP 1200Z</span>
								<input type="text" name="dp1200Z_wsf" id="dp1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter DP for 1200Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">VP 1200Z</span>
								<input type="text" name="vp1200Z_wsf" id="vp1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter VP for 1200Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">RH 1200Z</span>
								<input type="text" name="rh1200Z_wsf" id="rh1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"   class="form-control" placeholder="Enter RH for 1200Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">CLP 1200Z</span>
								<input type="text" name="clp1200Z_wsf" id="clp1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter CLP for 1200Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">GPM 1200Z</span>
								<input type="text" name="gpm1200Z_wsf" id="gpm1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter GPM for 1200Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND DIR 1200Z</span>
								<input type="text" name="winddir1200Z_wsf"  id="winddir1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter Wind Direction for 1200z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">FF 1200Z</span>
								<input type="text" name="ff1200Z_wsf" id="ff1200Z_wsf" onkeyup="allowIntegerInputOnly(this)"   class="form-control"  placeholder="Enter FF for 1200Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Wind Run</span>
								<input type="text" name="windrun_wsf" id="windrun_wsf" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder=" Enter Wind Run" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">R/F (mm)</span>
								<input type="text" name="rf_wsf" id="rf_wsf"  onkeyup="allowIntegerInputOnly(this)" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainfall')"  class="form-control"  placeholder=" Enter R/F (mm)" >
							</div>
                            <span id="errorrainfall"></span>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="form-group">
								<label><span>Did we have: </span></label><br>

								<label><input type="checkbox" name="thunderstorm_wsf" class="form-control" value="true"> Thunder storm (Ts)</label>
								<label><input type="checkbox" name="fog_wsf" class="form-control" value="true"> Fog (Fg)</label>
								<label><input type="checkbox" name="haze_wsf" class="form-control" value="true"> Haze (Hz)</label>
								<label><input type="checkbox" name="hailstorm_wsf" class="form-control" value="true"> Hail storm (Hs)</label>
								<label><input type="checkbox" name="earthquake_wsf" class="form-control" value="true"> Earth Quake</label>

							</div>
						</td>
					</tr>
				</table>
		</div>

	    <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="postarchiveweathersummaryformreportdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
  </div>
        </form>
        </div>

    <?php
    }elseif((is_array($updatearchiveweathersummaryformreportdata) && count($updatearchiveweathersummaryformreportdata))) {
        foreach($updatearchiveweathersummaryformreportdata as $data){

            $formdataid = $data->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/updateArchiveWeatherSummaryFormReportData" id="regForm" method="post" enctype="multipart/form-data">

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
					   <div class = "tab"><h2>Weather Summary Data:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
            <?php     if($userrole=="DataOfficer" || $userrole=="SeniorDataOfficer" ) { ?>
                          <td>
                              <div class="input-group">

                                  <span class="input-group-addon">Station</span>
                                  <select name="station" id="stationManager"   class="form-control" placeholder="Select Station">
                                      <option value="<?php echo $data->StationName;?>"><?php echo $data->StationName;?></option>
                                      <?php
                                      if (is_array($stationsdata) && count($stationsdata)) {
                                          foreach($stationsdata as $station){?>
                                              <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                          <?php }
                                      } ?>
                                  </select>
                              </div>
                          </td>

                          <td>
                              <div class="input-group">
                                  <span class="input-group-addon">Station Number</span>
                                  <input type="text" name="stationNo"  id="stationNoManager"  class="form-control compulsory" value="<?php echo $data->StationNumber;?>"  readonly class="form-control"  >
                              </div>
                          </td>
                        <?php } else {?>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Station</span>
								<input type="text" name="station" id="station"  class="form-control" value="<?php echo $data->StationName;?>"  readonly class="form-control" >

							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo"  class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $data->StationNumber;?>" readonly="readonly" >
							</div>
						</td>
          <?php }?>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Select Date</span>
								<input type="text" name="date" class="form-control" value="<?php echo $data->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
								<input type="hidden" name="id" value="<?php echo $data->id;?>">


							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sunshine(Hrs)</span>
								 <input type="text" name="sunshine" id="sunshine" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->SUNSHINE;?>"  placeholder="Sunshine (Hrs)" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Max Temp</span>
								<input type="text" name="maxTemp" id="maxTemp" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->TEMP_MAX;?>"  placeholder="Enter max temp" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Min Temp</span>
								 <input type="text" name="minTemp" id="minTemp" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->TEMP_MIN;?>"  placeholder="Enter min temp" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DB 0600Z</span>
								 <input type="text" name="db0600Z" id="db0600Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->DB_0600Z;?>"  placeholder="Enter DB for 0600Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">WB 0600Z</span>
							<input type="text" name="wb0600Z" id="wb0600Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->WB_0600Z;?>" placeholder="Enter WB for 0600Z " >
						</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DP 0600Z</span>
								<input type="text" name="dp0600Z" id="dp0600Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->DP_0600Z;?>" placeholder="Enter DP for 0600Z " >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">VP 0600Z</span>
								 <input type="text" name="vp0600Z" id="vp0600Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->VP_0600Z;?>" placeholder="Enter VP for 0600Z " >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">RH 0600Z</span>
								<input type="text" name="rh0600Z" id="rh0600Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->RH_0600Z;?>" placeholder="Enter RH for 0600Z" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">CLP 0600Z</span>
								<input type="text" name="clp0600Z" id="clp0600Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter CLP for 0600Z" value="<?php echo $data->CLP_0600Z;?>" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">GPM 0600Z</span>
								 <input type="text" name="gpm0600Z" id="gpm0600Z" onkeyup="allowIntegerInputOnly(this)"   class="form-control" value="<?php echo $data->GPM_0600Z;?>"  placeholder="Enter GPM for 0600Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">WIND DIR 0600Z</span>
								 <input type="text" name="winddir0600Z" id="winddir0600Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->WIND_DIR_0600Z;?>"  placeholder="Enter Wind Direction for 0600Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">FF 0600Z</span>
								<input type="text" name="ff0600Z" id="ff0600Z" onkeyup="allowIntegerInputOnly(this)"   class="form-control" value="<?php echo $data->FF_0600Z;?>"  placeholder="Enter FF for 0600z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DB 1200Z</span>
								<input type="text" name="db1200Z" id="db1200Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->DB_1200Z;?>"  placeholder="Enter DB for 1200Z" >
							</div>
						</td>
					</tr>
				</table>
		</div>

	   <div class = "tab"><h2>More Data:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WB 1200Z</span>
								 <input type="text" name="wb1200Z" id="wb1200Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->WB_1200Z;?>" placeholder="Enter WB for 1200Z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DP 1200Z</span>
								<input type="text" name="dp1200Z" id="dp1200Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->DP_1200Z;?>" placeholder="Enter DP for 1200Z " >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">VP 1200Z</span>
								<input type="text" name="vp1200Z" id="vp1200Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->VP_1200Z;?>" placeholder="Enter VP for 1200Z " >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">RH 1200Z</span>
								<input type="text" name="rh1200Z" id="rh1200Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->RH_1200Z;?>" placeholder="Enter RH for 1200Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">CLP 1200Z</span>
								<input type="text" name="clp1200Z" id="clp1200Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Enter CLP for 1200Z" value="<?php echo $data->CLP_1200Z;?>" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">GPM 1200Z</span>
								<input type="text" name="gpm1200Z" id="gpm1200Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->GPM_1200Z;?>"  placeholder="Enter GPM for 1200Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND DIR 1200Z</span>
								<input type="text" name="winddir1200Z" id="winddir1200Z" onkeyup="allowIntegerInputOnly(this)"   class="form-control" value="<?php echo $data->WIND_DIR_1200Z;?>"  placeholder="Enter Wind Direction for 1200z" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">FF 1200Z</span>
								<input type="text" name="ff1200Z" id="ff1200Z" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->FF_1200Z;?>"  placeholder="Enter FF for 1200Z" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Wind Run</span>
								<input type="text" name="windrun" id="windrun" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $data->WIND_RUN;?>"  placeholder="Wind Run" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">R/F (mm)</span>
								<input type="text" name="rf" id="rf"  onkeyup="allowIntegerInputOnly(this)"   class="form-control"  value="<?php echo $data->R_F;?>"  placeholder="R/Day" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<label><span>Did we have: </span></label><br>

								<input type="checkbox" <?php if($data->ThunderStorm == "true") echo "checked"; ?> name="thunder" class="form-control" value="true"> Thunder storm (Ts)
								<input type="checkbox" name="fog" <?php if($data->Fog == "true") echo "checked"; ?> class="form-control" value="true"> Fog (Fg)
								<input type="checkbox" name="haze" <?php if($data->Haze == "true") echo "checked"; ?> class="form-control" value="true"> Haze (Hz)
								<input type="checkbox" name="hailstorm" <?php if($data->HailStorm == "true") echo "checked"; ?> class="form-control" value="true"> Hail storm (Hs)
								<input type="checkbox" name="quake" <?php if($data->EarhtQuake == "true") echo "checked"; ?> class="form-control"> Earth Quake

							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Approved</span>
								<?php if($userrole=="DataOfficer"||$data->Approved=="TRUE"){?>
								<select name="approval" id="approval" readonly  class="form-control" >
									<option value="<?php echo $data->Approved;?>"><?php echo $data->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<input type="hidden" name="approval" value="<?php echo $data->Approved;?>">
								<?php }else{?>
								   <select name="approval" id="approval" readonly  class="form-control" >
									<option value="<?php echo $data->Approved;?>"><?php echo $data->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
									
								</select>
								
								<?php }?>
							</div>
						</td>
					</tr>
				</table>
		</div>

	    <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="updatearchiveweathersummaryformreportdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
  </div>
            </form>
            </div>
         <?php } }elseif((is_array($validatearchiveweathersummaryformreportdata) && count($validatearchiveweathersummaryformreportdata))) {
        foreach($validatearchiveweathersummaryformreportdata as $data){

            $formdataid = $data->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/updateArchiveWeatherSummaryFormReportData" id="regForm" method="post" enctype="multipart/form-data">
             <input type="hidden" name="qualitycontrolled" value="qa">
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
			<div class = "tab"><h2>Weather Summary Data:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
            <?php     if($userrole=="DataOfficer" || $userrole=="SeniorDataOfficer" ) { ?>
                          <td>
                              <div class="input-group">

                                  <span class="input-group-addon">Station</span>
                                  <select name="station" id="stationManager"   class="form-control" placeholder="Select Station">
                                      <option value="<?php echo $data->StationName;?>"><?php echo $data->StationName;?></option>
                                      <?php
                                      if (is_array($stationsdata) && count($stationsdata)) {
                                          foreach($stationsdata as $station){?>
                                              <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                          <?php }
                                      } ?>
                                  </select>
                              </div>
                          </td>

                          <td>
                              <div class="input-group">
                                  <span class="input-group-addon">Station Number</span>
                                  <input type="text" name="stationNo"  id="stationNoManager"  class="form-control compulsory" value="<?php echo $data->StationNumber;?>"  readonly class="form-control"  >
                              </div>
                          </td>
                        <?php } else {?>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Station</span>
								<input type="text" name="station" id="station"  class="form-control" value="<?php echo $data->StationName;?>"  readonly class="form-control" >

							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo"  class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $data->StationNumber;?>" readonly="readonly" >
							</div>
						</td>
          <?php }?>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Select Date</span>
								<input type="text" name="date" class="form-control" value="<?php echo $data->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
								<input type="hidden" name="id" value="<?php echo $data->id;?>">


							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sunshine(Hrs)</span>
								 <input type="text" name="sunshine"  onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->SUNSHINE;?>',this.value,'errorsunshine');"  class="form-control" value=""  placeholder="Sunshine (Hrs)" >
							</div>
                            <span id="errorsunshine"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Max Temp</span>
								<input type="text" name="maxTemp"  onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->TEMP_MAX;?>',this.value,'errormaxTemp');"  class="form-control" value=""  placeholder="Enter max temp" >
							</div>
                            <span id="errormaxTemp"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Min Temp</span>
								 <input type="text" name="minTemp"  onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->TEMP_MIN;?>',this.value,'errorminTemp');"  class="form-control" value=""  placeholder="Enter min temp" >
							</div>
                            <span id="errorminTemp"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DB 0600Z</span>
								 <input type="text" name="db0600Z"  onchange=""  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->DB_0600Z;?>',this.value,'errordb0600Z');"  class="form-control" value=""  placeholder="Enter DB for 0600Z" >
							</div>
                            <span id="errordb0600Z"></span>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">WB 0600Z</span>
							<input type="text" name="wb0600Z"  onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->WB_0600Z;?>',this.value,'errorwb0600Z');"  class="form-control" value="" placeholder="Enter WB for 0600Z " >
						</div>
                        <span id="errorwb0600Z"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DP 0600Z</span>
								<input type="text" name="dp0600Z"  onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->DP_0600Z;?>',this.value,'errordp0600Z');"  class="form-control" value="" placeholder="Enter DP for 0600Z " >
							</div>
                            <span id="errordp0600Z"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">VP 0600Z</span>
								 <input type="text" name="vp0600Z"  onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->VP_0600Z;?>',this.value,'errorvp0600Z');"  class="form-control" value="" placeholder="Enter VP for 0600Z " >
							</div>
                            <span id="errorvp0600Z"></span>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">RH 0600Z</span>
								<input type="text" name="rh0600Z"  onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->RH_0600Z;?>',this.value,'errorrh0600Z');"  class="form-control" value="" placeholder="Enter RH for 0600Z" >
							</div>
                            <span id="errorrh0600Z"></span>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">CLP 0600Z</span>
								<input type="text" name="clp0600Z"  onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->CLP_0600Z;?>',this.value,'errorclp0600Z');"  class="form-control"  placeholder="Enter CLP for 0600Z" value="" >
							</div>
                            <span id="errorclp0600Z"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">GPM 0600Z</span>
								 <input type="text" name="gpm0600Z" onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->GPM_0600Z;?>',this.value,'errorgpm0600Z');"   class="form-control" value=""  placeholder="Enter GPM for 0600Z" >
							</div>
                            <span id="errorgpm0600Z"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">WIND DIR 0600Z</span>
								 <input type="text" name="winddir0600Z" onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->WIND_DIR_0600Z;?>',this.value,'errorwinddir0600Z');"  class="form-control" value=""  placeholder="Enter Wind Direction for 0600Z" >
							</div>
                            <span id="errorwinddir0600Z"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">FF 0600Z</span>
								<input type="text" name="ff0600Z" onchange="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->FF_0600Z;?>',this.value,'errorff0600Z');"   class="form-control" value=""  placeholder="Enter FF for 0600z" >
							</div>
                            <span id="errorff0600Z"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DB 1200Z</span>
								<input type="text" name="db1200Z"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->DB_1200Z;?>',this.value,'errordb1200Z');"  class="form-control" value=""  placeholder="Enter DB for 1200Z" >
							</div>
                            <span id="errordb1200Z"></span>
						</td>
					</tr>
				</table>
		</div>

	   <div class = "tab"><h2>More Data:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WB 1200Z</span>
								 <input type="text" name="wb1200Z" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->WB_1200Z;?>',this.value,'errorwb1200Z');"  class="form-control" value="" placeholder="Enter WB for 1200Z" >
							</div>
                            <span id="errorwb1200Z"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">DP 1200Z</span>
								<input type="text" name="dp1200Z" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->DP_1200Z;?>',this.value,'errordp1200Z');"  class="form-control" value="" placeholder="Enter DP for 1200Z " >
							</div>
                            <span id="errordp1200Z"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">VP 1200Z</span>
								<input type="text" name="vp1200Z"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->VP_1200Z;?>',this.value,'errorvp1200Z');"  class="form-control" value="" placeholder="Enter VP for 1200Z " >
							</div>
                            <span id="errorvp1200Z"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">RH 1200Z</span>
								<input type="text" name="rh1200Z"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->RH_1200Z;?>',this.value,'errorrh1200Z');"  class="form-control" value="" placeholder="Enter RH for 1200Z" >
							</div>
                            <span id="errorrh1200Z"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">CLP 1200Z</span>
								<input type="text" name="clp1200Z" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->CLP_1200Z;?>',this.value,'errorclp1200Z');"  class="form-control"  placeholder="Enter CLP for 1200Z" value="" >
							</div>
                            <span id="errorclp1200Z"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">GPM 1200Z</span>
								<input type="text" name="gpm1200Z"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->GPM_1200Z;?>',this.value,'errorgpm1200Z');"  class="form-control" value=""  placeholder="Enter GPM for 1200Z" >
							</div>
                            <span id="errorgpm1200Z"></span>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">WIND DIR 1200Z</span>
								<input type="text" name="winddir1200Z"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->WIND_DIR_1200Z;?>',this.value,'errorwinddir1200Z');"   class="form-control" value=""  placeholder="Enter Wind Direction for 1200z" >
							</div>
                            <span id="errorwinddir1200Z"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">FF 1200Z</span>
								<input type="text" name="ff1200Z" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->FF_1200Z;?>',this.value,'errorff1200Z');"  class="form-control" value=""  placeholder="Enter FF for 1200Z" >
							</div>
                            <span id="errorff1200Z"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Wind Run</span>
								<input type="text" name="windrun" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $data->WIND_RUN;?>',this.value,'errorwindrun');"  class="form-control" value=""  placeholder="Wind Run" >
							</div>
                            <span id="errorwindrun"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">R/F (mm)</span>
								<input type="text" name="rf" id="rf"  onkeyup="validation('<?php echo $data->R_F;?>',this.value,'errorrf');" class="form-control"  onkeyup="allowIntegerInputOnly(this)"  value=""  placeholder="R/Day" >
							</div>
                            <span id="errorrf"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
								<label><span>Did we have: </span></label><br>

								<input type="checkbox" <?php if($data->ThunderStorm == "true") echo "checked"; ?> name="thunder" class="form-control" value="true"> Thunder storm (Ts)
								<input type="checkbox" name="fog" <?php if($data->Fog == "true") echo "checked"; ?> class="form-control" value="true"> Fog (Fg)
								<input type="checkbox" name="haze" <?php if($data->Haze == "true") echo "checked"; ?> class="form-control" value="true"> Haze (Hz)
								<input type="checkbox" name="hailstorm" <?php if($data->HailStorm == "true") echo "checked"; ?> class="form-control" value="true"> Hail storm (Hs)
								<input type="checkbox" name="quake" <?php if($data->EarhtQuake == "true") echo "checked"; ?> class="form-control"> Earth Quake

							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Approved</span>
								<?php if($userrole=="DataOfficer"||$data->Approved=="TRUE"){?>
								<select name="approval" id="approval" reeadonly  class="form-control">
									<option value="<?php echo $data->Approved;?>"><?php echo $data->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<input type="hidden" name="approval" value="<?php echo $data->Approved;?>">
								<?php }else{?>
								   <select name="approval" id="approval"  class="form-control" readonly>
									<option value="<?php echo $data->Approved;?>"><?php echo $data->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
									
								</select>
								
								<?php }?>
							</div>
						</td>
					</tr>
				</table>
		</div>

	    <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="updatearchiveweathersummaryformreportdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
  </div>
  </form>
 </div>
        <?php
        }
        }else{
        if($userrole!="QC"){
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/DisplayNewArchiveWeatherSummaryFormReportData/">
                    <i class="fa fa-plus"></i> Add Archive Weather Summary Form</a>


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
                                <th>Record No.</th>
                                <th>Date</th>
                                <th>Station</th>
                                <th>Station No</th>
                                <th>Max</th>
                                <th>Min</th>
                                <th>Sun shine</th>
                                <th>DB</th>
                                <th>WB</th>
                                <th>DP</th>
                                <th>VP </th>
                                <th>RH</th>
                                <th>CLP</th>
                                <th>GPM</th>
                                <th>Wind dir</th>
                                <th>FF</th>
                                <th>Wind Run</th>
                                <th>R_F</th>
                                <th>Quality Control</th>
                                <?php if( $userrole=='SeniorDataOfficer'  || $userrole=='DataOfficer' | $userrole=='ObserverArchive'  || $userrole=='Senior Weather Observer' || $userrole=='QC'){ ?>
                                  <th>Submitted By</th>
                                  <th>Approved</th>
                                  <th>Comments</th>
                                  <th class="no-print">Action</th>
                                <?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            if (is_array($archivedweathersummaryformreportdata) && count($archivedweathersummaryformreportdata)) {
                                foreach($archivedweathersummaryformreportdata as $dailydata){
                                   
                                    $dailyid = $dailydata->id;
									 if($userrole =='DataOfficer' && $dailydata->Approved =='TRUE' ){
									   $count++;
									   }else{
										   $count++;
                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?><br><h6 style="color:red;font-size:8px;font-weight:bold;"><?php echo $dailydata->numberofcomments>0 ? "( ".$dailydata->numberofcomments." Comments )":"" ?> </h6></td>
                                        <td ><?php echo $dailydata->Date;?></td>
                                        <td ><?php echo $dailydata->StationName;?></td>
                                        <td ><?php echo $dailydata->StationNumber;?></td>
                                        <td ><?php echo $dailydata->TEMP_MAX;?></td>
                                        <td ><?php echo $dailydata->TEMP_MIN;?></td>
                                        <td ><?php echo $dailydata->SUNSHINE;?></td>

                                        <td ><?php echo $dailydata->DB_0600Z;?></td>
                                        <td ><?php echo $dailydata->WB_0600Z;?></td>
                                        <td><?php echo $dailydata->DP_0600Z;?></td>
                                        <td><?php echo $dailydata->VP_0600Z;?></td>
                                        <td><?php echo $dailydata->RH_0600Z;?></td>
                                        <td><?php echo $dailydata->CLP_0600Z;?></td>
                                        <td><?php echo $dailydata->GPM_0600Z;?></td>
                                        <td><?php echo $dailydata->WIND_DIR_0600Z;?></td>
                                        <td><?php echo $dailydata->FF_0600Z;?></td>
                                        <td><?php echo $dailydata->WIND_RUN;?></td>
                                        <td><?php echo $dailydata->R_F;?></td>
                                        <td><?php echo ($dailydata->qaBy==NULL)?"Pending":$dailydata->qaBy; ?></td>
                                        <?php if($userrole=='SeniorDataOfficer'  || $userrole=='DataOfficer' || $userrole=='ObserverArchive'  || $userrole=='Senior Weather Observer' || $userrole=='QC' ){ ?>

                                          <td ><?php echo $dailydata->AW_SubmittedBy;?></td>
                                          <td ><?php echo $dailydata->Approved;?></td>
                                          <td class="no-print"> 

												<?php if($dailydata->Approved=="FALSE"|| $userrole!='DataOfficer'){ ?>
												  <h6><?php echo $dailydata->numberofcomments; ?> comments on this record</h6>
												  <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/index/<?php echo $dailydata->id ?>/">View/ Add Comments</a> <br><br>
												<?php }else{ ?> 
												<h6 style="color:green;"> <li class='fa fa-check'></li> Record approved</h6>
												<?php }?>
												</td>
                                          <td class="no-print">

                                            
										 <table>
                                         <tr><td>
                                           <?php  if($userrole=='QC'){?>
                                               <?php if($dailydata->qaBy==NULL){?>
                                                   <a class="btn btn-primary btn-xs" href="<?php echo base_url()."index.php/ArchiveWeatherSummaryFormReportData/DisplayArchiveWeatherSummaryFormReportDataForValidation/" .$dailydata->id ;?>"
                                               style="cursor:pointer;"><li class="fa fa-edit"></li> Verify</a>
												<?php }else{ ?>
                                                    <a class="btn btn-success btn-xs" href="" disabled><li class="fa fa-check"></li> Verified </a>
												<?php } ?>

											
										 <?php }else{ ?>
                                            <a class="btn btn-primary" href="<?php echo base_url()."index.php/ArchiveWeatherSummaryFormReportData/DisplayArchiveWeatherSummaryFormReportDataForUpdate/" .$dailydata->id ;?>"
                                               style="cursor:pointer;"><li class="fa fa-edit"></li> Edit</a>
										 <?php } ?>
                                                    </td>
                                    <?php if($userrole== 'SeniorDataOfficer' && $dailydata->Approved=="TRUE" ){?>
                                    <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveWeatherSummaryFormReportData/update_approval/"  .$dailydata->id;?>"> <input type="hidden" name="id" value="<?php echo $dailydata->id ?>" ><input type="hidden" name="approve" value="FALSE" ><button class="btn btn-danger"  type="submit"  ><li class='fa fa-times'></li> Disapprove</button></form>
                                        </td> <?php }elseif( $userrole=='Senior Weather Observer' && $dailydata->Approved=="FALSE" || $userrole =='SeniorDataOfficer' && $dailydata->Approved=="FALSE"){?>
                                            <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveWeatherSummaryFormReportData/update_approval/" .$dailydata->id;?>"> <input type="hidden" name="id" value="<?php echo $dailydata->id ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success"  type="submit"  ><li class='fa fa-check'></li> Approve &nbsp;&nbsp;&nbsp;&nbsp;</button></form>
                                            </td>

                                            <?php
							}else{ }?>
											<!-- <?php if($userrole=='SeniorDataOfficer'){?>
											<td>
											
											<form method="post" action="<?php echo base_url() . "index.php/ArchiveWeatherSummaryFormReportData/update_approval/" .$dailydata->id;?>"> <input type="hidden" name="id" value="<?php echo $dailydata->id; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($dailydata->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
											</td><?php }?>  -->
									     </tr>
										 </table>
										</td>
										</tr>

                                <?php
                                }
								}}
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
								<form method="post" action="<?php echo base_url(); ?>index.php/ArchiveWeatherSummaryFormReportData/submitObservationslipComment/">
								<input type="hidden" name="recordid" value="<?php echo  $dailyid ?>" id="">
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
    <script>
        $(document).ready(function() {
            //Post Add New  Archive Weather Summary  form Report data into the DB
            //Validate each (select) field before inserting into the DB
            $('#nextBtn').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveWeatherSummaryFormReportData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Weather Summary Record with the Same date ,station name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number or date not picked");
                    return false;
                }


                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield").focus();
                    return false;

                }

                //Check that Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#date').val("");  //Clear the field.
                    $("#date"). focus();
                    return false;
                }


                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_archiveweathersummaryformreportdata').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archiveweathersummaryformreportdata').val("");  //Clear the field.
                    $("#station_archiveweathersummaryformreportdata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_archiveweathersummaryformreportdata').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archiveweathersummaryformreportdata').val("");  //Clear the field.
                    $("#stationNo_archiveweathersummaryformreportdata").focus();
                    return false;

                }





            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE WEATHER SUMMARY FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveWeatherSummaryFormReportData(){

            //Check against the date,stationName,SManagernNumber,Time and Metar Option.
            var date= $('#date').val();

            var stationName= $('#stations-list').val();
            var stationNumber = $('#stationNoManager').val();

            $('#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveWeatherSummaryFormReportData/checkInDBIfArchiveWeatherSummaryFormReportRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveWeatherSummaryFormReportData_hiddentextfield").val();

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
            //Update  Archive Weather Summary form Report data into the DB
            //Display A Dialog Box when a user wants to update a textfield
            $('#updatearchiveweathersummaryformreportdata_button').click(function(event) {
                //Check that Date selected
                var updatedate=$('#expdate').val();
                if(updatedate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate"). focus();
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
            var newValue_sunshine;
            var oldValue_sunshine= $('#sunshine').val()

            $('#sunshine').live('change paste', function(){
                // oldValue_dryBulb0600Z = newValue_dryBulb0600Z;
                newValue_sunshine = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#sunshine').val(newValue_sunshine);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#sunshine').val(oldValue_sunshine);
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
            var newValue_db0600Z;
            var oldValue_db0600Z= $('#db0600Z').val();

            $('#db0600Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_db0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#db0600Z').val(newValue_db0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#db0600Z').val(oldValue_db0600Z);
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
            var newValue_wb0600Z;
            var oldValue_wb0600Z= $('#wb0600Z').val();

            $('#wb0600Z').live('change paste', function(){
                //oldValue_dewPoint0600Z = newValue_dewPoint0600Z;
                newValue_wb0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wb0600Z').val(newValue_wb0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wb0600Z').val(oldValue_wb0600Z);
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
            var newValue_dp0600Z;
            var oldValue_dp0600Z= $('#dp0600Z').val()

            $('#dp0600Z').live('change paste', function(){
                //oldValue_relativeHumidity0600Z = newValue_relativeHumidity0600Z;
                newValue_dp0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dp0600Z').val(newValue_dp0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dp0600Z').val(oldValue_dp0600Z);
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
            var newValue_vp0600Z;
            var oldValue_vp0600Z= $('#vp0600Z').val()

            $('#vp0600Z').live('change paste', function(){
                //oldValue_qnhin = newValue_qnhin;
                newValue_vp0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#vp0600Z').val(newValue_vp0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#vp0600Z').val(oldValue_vp0600Z);
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
            var newValue_rh0600Z;
            var oldValue_rh0600Z= $('#rh0600Z').val();

            $('#rh0600Z').live('change paste', function(){
                // oldValue_windSpeed0600Z = newValue_windSpeed0600Z;
                newValue_rh0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rh0600Z').val(newValue_rh0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#rh0600Z').val(oldValue_rh0600Z);
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
            var newValue_clp0600Z;
            var oldValue_clp0600Z= $('#clp0600Z').val();

            $('#clp0600Z').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_clp0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#clp0600Z').val(newValue_clp0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#clp0600Z').val(oldValue_clp0600Z);
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
            var newValue_gpm0600Z;
            var oldValue_gpm0600Z= $('#gpm0600Z').val()

            $('#gpm0600Z').live('change paste', function(){
                // oldValue_dryBulb1200Z = newValue_dryBulb1200Z;
                newValue_gpm0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gpm0600Z').val(newValue_gpm0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gpm0600Z').val(oldValue_gpm0600Z);
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
            var newValue_winddir0600Z;
            var oldValue_winddir0600Z= $('#winddir0600Z').val();

            $('#winddir0600Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_winddir0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#winddir0600Z').val(newValue_winddir0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#winddir0600Z').val(oldValue_winddir0600Z);
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
            var newValue_ff0600Z;
            var oldValue_ff0600Z= $('#ff0600Z').val();

            $('#ff0600Z').live('change paste', function(){
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
                newValue_ff0600Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#ff0600Z').val(newValue_ff0600Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#ff0600Z').val(oldValue_ff0600Z);
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
            var newValue_db1200Z;
            var oldValue_db1200Z= $('#db1200Z').val();

            $('#db1200Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_db1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#db1200Z').val(newValue_db1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#db1200Z').val(oldValue_db1200Z);
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
            var newValue_wb1200Z;
            var oldValue_wb1200Z= $('#wb1200Z').val();

            $('#wb1200Z').live('change paste', function(){
                //oldValue_dewPoint0600Z = newValue_dewPoint0600Z;
                newValue_wb1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wb1200Z').val(newValue_wb1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wb1200Z').val(oldValue_wb1200Z);
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
            var newValue_dp1200Z;
            var oldValue_dp1200Z= $('#dp1200Z').val()

            $('#dp1200Z').live('change paste', function(){
                //oldValue_relativeHumidity0600Z = newValue_relativeHumidity0600Z;
                newValue_dp1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dp1200Z').val(newValue_dp1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dp1200Z').val(oldValue_dp1200Z);
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
            var newValue_vp1200Z;
            var oldValue_vp1200Z= $('#vp1200Z').val()

            $('#vp1200Z').live('change paste', function(){
                //oldValue_qnhin = newValue_qnhin;
                newValue_vp1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#vp1200Z').val(newValue_vp1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#vp1200Z').val(oldValue_vp1200Z);
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
            var newValue_rh1200Z;
            var oldValue_rh1200Z= $('#rh1200Z').val();

            $('#rh1200Z').live('change paste', function(){
                // oldValue_windSpeed0600Z = newValue_windSpeed0600Z;
                newValue_rh1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rh1200Z').val(newValue_rh1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#rh1200Z').val(oldValue_rh1200Z);
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
            var newValue_clp1200Z;
            var oldValue_clp1200Z= $('#clp1200Z').val();

            $('#clp1200Z').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_clp1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#clp1200Z').val(newValue_clp1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#clp1200Z').val(oldValue_clp1200Z);
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
            var newValue_gpm1200Z;
            var oldValue_gpm1200Z= $('#gpm1200Z').val()

            $('#gpm1200Z').live('change paste', function(){
                // oldValue_dryBulb1200Z = newValue_dryBulb1200Z;
                newValue_gpm1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gpm1200Z').val(newValue_gpm1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gpm1200Z').val(oldValue_gpm1200Z);
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
            var newValue_winddir1200Z;
            var oldValue_winddir1200Z= $('#winddir1200Z').val();

            $('#winddir1200Z').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_winddir1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#winddir1200Z').val(newValue_winddir1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#winddir1200Z').val(oldValue_winddir1200Z);
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
            var newValue_ff1200Z;
            var oldValue_ff1200Z= $('#ff1200Z').val();

            $('#ff1200Z').live('change paste', function(){
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
                newValue_ff1200Z = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#ff1200Z').val(newValue_ff1200Z);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#ff1200Z').val(oldValue_ff1200Z);
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
            var newValue_windrun;
            var oldValue_windrun= $('#windrun').val();

            $('#windrun').live('change paste', function(){
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
                newValue_windrun = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windrun').val(newValue_windrun);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windrun').val(oldValue_windrun);
                    return false;
                }

            });
        });
    </script>
    <!-- <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_rf;
            var oldValue_rf= $('#rf').val();

            $('#rf').live('change paste', function(){
                //oldValue_dewPoint1200Z = newValue_dewPoint1200Z;
                newValue_rf = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rf').val(newValue_rf);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alertManagerttttt");
                    $('#rf').val(oldValue_rf);
                    return false;

                });
            });
    </script> -->
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
