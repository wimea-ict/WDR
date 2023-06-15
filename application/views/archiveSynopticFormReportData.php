<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
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
            Archive Synoptic Form
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Synoptic Form</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewsynopticForm) && count($displaynewsynopticForm)) {
        ?>
        <div class="row">
        <form action="<?php echo base_url(); ?>index.php/ArchiveSynopticFormReportData/insertSynopticData/" name="regForm"  id="regForm" method="post" enctype="multipart/form-data">


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

			<!-- Section1 -->
		   <div class = "tab">
				<table id="example1" class="table table-bordered table-striped">
					<tr>
            <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
         
         	<td >
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
               	</td>
						<td >
							<div class="input-group">

                            <span class="input-group-addon">Station Name</span>
                            <select  name="station_archivesynopticformreportdata" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select>
                        </div>

						</td>
					</tr>
					<tr>
         <td >

           <div class="input-group">
             <span class="input-group-addon"> Station Number</span>
              <input type="text" name="stationNo_archivesynopticformreportdata"  class="form-control" id="stationNoManager" readonly class="form-control" value="" readonly="readonly" >
           </div>

         </td>
       <?php } else{ ?>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Station</span>
								<input type="text" name="station_archivesynopticformreportdata" id="station_archivesynopticformreportdata" required class="form-control" required value="<?php echo $userstation;?>"  readonly class="form-control" >

							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								<input type="text" name="stationNo_archivesynopticformreportdata" required class="form-control" id="stationNo_archivesynopticformreportdata" readonly class="form-control" required value="<?php echo $userstationNo;?>" readonly="readonly" >
							</div>
						</td>
          <?php }?>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Select Date</span>
								<input type="text" name="date_archivesynopticformreportdata"  class="form-control compulsory"  placeholder="Enter select date" id="date">


							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME</span>
								<select name="time_archivesynopticformreportdata" id="time_archivesynopticformreportdata"  class="form-control compulsory">
									<option value="">--Select Time Options</option>
									<option value="0000Z">0000Z</option>
									<option value="0300Z">0300Z</option>
									<option value="0600Z">0600Z</option>
									<option value="0900Z">0900Z</option>
									<option value="1200Z">1200Z</option>
									<option value="1500Z">1500Z</option>
									<option value="1800Z">1800Z</option>
									<option value="2100Z">2100Z</option>
								</select>

							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Unit of wind speed</span>
								<input type="text" name="unitows_archivesynopticformreportdata"  id="unitows_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"   placeholder="Enter unit of wind speed" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Block Number</span>
								<input type="text" name="blockNo_archivesynopticformreportdata" value="63" id="blockNo_archivesynopticformreportdata" readonly class="form-control" required class="form-control" required placeholder="Enter block number" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Ind. or ommission of precipitation</span>
								<input type="text" name="precipitation_archivesynopticformreportdata" id="precipitation_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Ind. or ommission of precipitation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Type of station/present & past weather</span>
								<input type="text" name="typeofstation_archivesynopticformreportdata" id="typeofstation_archivesynopticformreportdata"  onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Type of station/present & past weather" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of lowest cloud</span>
								<input type="text" name="hlowestcloud_archivesynopticformreportdata" id="hlowestcloud_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Height of lowest cloud" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Horizontal Visibility</span>
								<input type="text" name="hvisibility_archivesynopticformreportdata" id="hvisibility_archivesynopticformreportdata"  class="form-control" placeholder="Horizontal Visibility" onkeyup="allowIntegerInputOnly(this)" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Total cloud cover</span>
								<input type="text" name="tcloudcover_archivesynopticformreportdata" id="tcloudcover_archivesynopticformreportdata"  onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Total cloud cover" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Wind Direction</span>
								<input type="text" name="winddirection_archivesynopticformreportdata" id="winddirection_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Wind Direction" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Wind Speed</span>
								<input type="text" name="windspeed_archivesynopticformreportdata" id="windspeed_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" onchange=""  class="form-control" placeholder="Wind Speed" >
							</div>
                            <span id="errorwindspeedtwo"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator</span>
								<input type="text" name="groupindicator1_archivesynopticformreportdata"  id="groupindicator1_archivesynopticformreportdata" value="1" readonly class="form-control" required class="form-control" required placeholder="Group Indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signofdata1_archivesynopticformreportdata"  id="signofdata1_archivesynopticformreportdata" value="0" readonly class="form-control" required class="form-control" placeholder="Sign of the data" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Air temperature</span>
								<input type="text" name="airtemperature_archivesynopticformreportdata" id="airtemperature_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Air Temperature " >
							</div>
						</td>
					</tr>
				</table>
			</div>

			<!--section 2 -->
			<div class = "tab"><h2>More Data Input:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Group Indicator 2</span>
								<input type="text" name="groupindicator2_archivesynopticformreportdata" id="groupindicator2_archivesynopticformreportdata" value="2" readonly class="form-control" required class="form-control" placeholder="Group Indicator 2" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sign of the data </span>
								<input type="text" name="signofdata2_archivesynopticformreportdata" id="signofdata2_archivesynopticformreportdata" value="0" readonly class="form-control" required class="form-control" placeholder="Sign of the data" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Dew point temperature</span>
								<input type="text" name="dewpointtemp_archivesynopticformreportdata" id="dewpointtemp_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Dew point temperature" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 3</span>
								<input type="text" name="groupindicator3_archivesynopticformreportdata" id="groupindicator3_archivesynopticformreportdata" value="3" readonly class="form-control" required class="form-control" required placeholder="Group Indicator 3" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Pressure station level</span>
								<input type="text" name="pressureatstationlevel_archivesynopticformreportdata" id="pressureatstationlevel_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Pressure at station level" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 4</span>
								<input type="text" name="groupindicator4_archivesynopticformreportdata" id="groupindicator4_archivesynopticformreportdata" value="4" readonly class="form-control" required class="form-control" placeholder="Group Indicator 4" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Standard isobaric surface</span>
								<input type="text" name="sisobaricsurface_archivesynopticformreportdata" id="sisobaricsurface_archivesynopticformreportdata" value="8" readonly class="form-control" required class="form-control" placeholder="Standard isobaric surface" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Geopotential of SIS</span>
								<input type="text" name="geopotential_archivesynopticformreportdata" id="geopotential_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Geopotential of isobaric surface" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 6</span>
								<input type="text" name="groupindicator6_archivesynopticformreportdata" id="groupindicator6_archivesynopticformreportdata" value="6" readonly class="form-control" required class="form-control" placeholder="Group Indicator 6" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of precipitation</span>
								<input type="text" name="amtofprecipitation_archivesynopticformreportdata" id="amtofprecipitation_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Amount of precipitation" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Duration period of precipitation</span>
								<input type="text" name="durationofprecipitation_archivesynopticformreportdata" id="durationofprecipitation_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Duration period of precipitation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 7</span>
								<input type="text" name="groupindicator7_archivesynopticformreportdata" id="groupindicator7_archivesynopticformreportdata"  value="7"  readonly class="form-control" required class="form-control" placeholder="Group Indicator 7" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Present weather</span>
								<input type="text" name="presentweather_archivesynopticformreportdata" id="presentweather_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Present weather" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Past weather</span>
								<input type="text" name="pastweather_archivesynopticformreportdata" id="pastweather_archivesynopticformreportdata" onkeyup="" class="form-control"  placeholder="Past weather" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="groupindicator8_archivesynopticformreportdata" id="groupindicator8_archivesynopticformreportdata" value="8" readonly class="form-control" required class="form-control" placeholder="Group Indicator 8" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of clouds</span>
								<input type="text" name="amountofclouds_archivesynopticformreportdata" id="amountofclouds_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Amount of clouds" >
							</div>
						</td>
					</tr>
				</table>
			</div>

			<!--section 3 -->
			<div class = "tab"><h2>Weather Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Clouds of the Genera  Sc. St. Cu. Cb</span>
								<input type="text" name="cloudsgenera1_archivesynopticformreportdata" id="cloudsgenera1_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Clouds of the general Sc. St. Cu, Cb" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Clouds of the Genera Ac. As. Ns</span>
								<input type="text" name="cloudsgenera2_archivesynopticformreportdata" id="cloudsgenera2_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Clouds of the general Ac As Ns" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Clouds of the Genera Cl Cc Cs</span>
								<input type="text" name="cloudsgenera3_archivesynopticformreportdata" id="cloudsgenera3_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Clouds of the general C Cc Cs" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Section Indicator</span>
								<input type="text" name="sectionindicator333_archivesynopticformreportdata" id="sectionindicator333_archivesynopticformreportdata" value="333" readonly class="form-control" required class="form-control" required placeholder="Section Indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 0</span>
								<input type="text" name="groupindicator0_archivesynopticformreportdata" id="groupindicator0_archivesynopticformreportdata"  value="0"  readonly class="form-control" required class="form-control" required placeholder="General Indicator" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Grass minimum temperature</span>
								<input type="text" name="gmtemperature_archivesynopticformreportdata" id="gmtemperature_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Grass minimum temperature" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Character & intensity of precipitation</span>
								<input type="text" name="characterintensity_archivesynopticformreportdata" id="characterintensity_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Character & Intensity of precipitation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Beginning or end of precipitation</span>
								<input type="text" name="begendofprecipitation_archivesynopticformreportdata" id="begendofprecipitation_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="beginning or end of precipitation" >
							</div>
						</td>
					</tr>
					<tr>
						<td colspan = "2" align = "center">
							<div class="form-group">
								<label><span>Did we have: </span></label><br>
								<label><input type="checkbox" name="thunderstorm_archivesynopticformreportdata" class="form-control" value="true"> Thunderstorm (Ts)</label>
								<label><input type="checkbox" name="hailstorm_archivesynopticformreportdata" class="form-control" value="true"> Hailstorm (Hs)</label>
								<label><input type="checkbox" name="fog_archivesynopticformreportdata" class="form-control" value="true"> Fog (Fg)</label>
								<label><input type="checkbox" name="earthquake_archivesynopticformreportdata" class="form-control" value="true"> EarthQuake</label>
								<label><input type="checkbox" name="anemometerReading_archivesynopticformreportdata" class="form-control" value="true"> Anemometer Reading(KM)</label>
								<label><input type="checkbox" name="actualrainfall_archivesynopticformreportdata" class="form-control" value="true"> Actual Rainfall</label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 1</span>
								<input type="text" name="groupindicator1_2_archivesynopticformreportdata" id="groupindicator1_2_archivesynopticformreportdata" value="1" readonly class="form-control" required class="form-control" placeholder="Group Indicator 2" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signofdata3_archivesynopticformreportdata" id="signofdata3_archivesynopticformreportdata" value="0" readonly class="form-control" class="form-control" required placeholder="Sign of the data" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Minimum temperature</span>
								<input type="text" name="maxtemperaturetx_archivesynopticformreportdata" id="maxtemperaturetx_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Minimum temperature" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 2</span>
								<input type="text" name="groupindicator2_2_archivesynopticformreportdata" id="groupindicator2_2_archivesynopticformreportdata" value="2" readonly class="form-control" required class="form-control" placeholder="Group Indicator 2" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signofdata4_archivesynopticformreportdata" id="signofdata4_archivesynopticformreportdata" value="0" readonly class="form-control" class="form-control" required placeholder="Sign of the data" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Maximum temperature</span>
								<input type="text" name="maxtemperaturetn_archivesynopticformreportdata" id="maxtemperaturetn_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Maximum temperature" >
							</div>
						</td>
					</tr>
				</table>
			</div>

			<!--section 4 -->
			<div class = "tab"><h2>More Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 5</span>
								<input type="text" name="groupindicator5_archivesynopticformreportdata" id="groupindicator5_archivesynopticformreportdata" value="5" readonly class="form-control" required class="form-control" required placeholder="Group Indicator" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of evapouration</span>
								<input type="text" name="amtofevapouration_archivesynopticformreportdata" id="amtofevapouration_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Amount of evapouration" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Indicator of type of instrumentation</span>
								<input type="text" name="indtypeofin_archivesynopticformreportdata" id="indtypeofin_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Indicator of type of instrumentation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 55</span>
								<input type="text" name="groupindicator55_archivesynopticformreportdata" id="groupindicator55_archivesynopticformreportdata" value="55" readonly class="form-control" required class="form-control" placeholder="Group Indicator 10" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Duration of sunshine</span>
								<input type="text" name="durationofsunshine_archivesynopticformreportdata" id="durationofsunshine_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Duration of sunshine" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 5</span>
								<input type="text" name="groupindicator5_2_archivesynopticformreportdata" id="groupindicator5_2_archivesynopticformreportdata" value="5" readonly class="form-control" class="form-control" required placeholder="General Indicator 11" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of pressure change</span>
								<input type="text" name="signofpressurechg_archivesynopticformreportdata" id="signofpressurechg_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Sign of pressure change" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Pressure change in 24</span>
								<input type="text" name="pressurechange24_archivesynopticformreportdata" id="pressurechange24_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Pressure change in 24 hrs" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 6</span>
								<input type="text" name="groupindicator6_2_archivesynopticformreportdata" id="groupindicator6_2_archivesynopticformreportdata" value="6" readonly class="form-control"  class="form-control" required placeholder="Group Indicator" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of precipitation</span>
								<input type="text" name="amtofprecipitation2_archivesynopticformreportdata" id="amtofprecipitation2_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Amount of precipitation" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Duration of period of precipitation</span>
								<input type="text" name="durationofprecipitation2_archivesynopticformreportdata" id="durationofprecipitation2_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Duration of period of precipitation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="groupindicator8_2_archivesynopticformreportdata" id="groupindicator8_2_archivesynopticformreportdata" value="8" readonly class="form-control"  required class="form-control" required placeholder="General Indicator 13" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer</span>
								<input type="text" name="amtofcloudlayer_archivesynopticformreportdata" id="amtofcloudlayer_archivesynopticformreportdata"  onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Amount of individual cloud layer" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud</span>
								<input type="text" name="genuscloud_archivesynopticformreportdata" id="genuscloud_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Genus of cloud" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Height of base cloud layer or mass</span>
								<input type="text" name="hofbasecloud_archivesynopticformreportdata" id="hofbasecloud_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Height of base cloud layer or mass" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="groupindicator8_3_archivesynopticformreportdata" id="groupindicator8_3_archivesynopticformreportdata"  value="8" readonly class="form-control" required class="form-control" placeholder="Group Indicator 14" >
							</div>
						</td>
					</tr>

				</table>
			</div>

			<!--section 5 -->
			<div class = "tab"><h2>Cloud Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer</span>
								<input type="text" name="amtofcloudlayer2_archivesynopticformreportdata" id="amtofcloudlayer2_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Amount of individual cloud layer" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud</span>
								<input type="text" name="genuscloud2_archivesynopticformreportdata" id="genuscloud2_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Genus of cloud" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of cloud base layer or mass</span>
								<input type="text" name="hofbasecloud2_archivesynopticformreportdata" id="hofbasecloud2_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Height of cloud base layer or mass" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="groupindicator8_4_archivesynopticformreportdata" id="groupindicator8_4_archivesynopticformreportdata"  value="8" readonly class="form-control" required class="form-control" placeholder="Group Indicator 8" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer 3</span>
								<input type="text" name="amtofcloudlayer3_archivesynopticformreportdata" id="amtofcloudlayer3_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Amount of individual cloud layer 3" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud 3</span>
								<input type="text" name="genuscloud3_archivesynopticformreportdata" id="genuscloud3_archivesynopticformreportdata" onkeyup="allowCharactersInputOnly(this)" class="form-control"  placeholder="Genus of cloud 3" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of cloud base layer or mass 3</span>
								<input type="text" name="hofbasecloud3_archivesynopticformreportdata" id="hofbasecloud3_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Height of cloud base layer or mass 3" >
							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Group Indicator 8</span>
							<input type="text" name="groupindicator8_5_archivesynopticformreportdata" id="groupindicator8_5_archivesynopticformreportdata"  value="8" readonly class="form-control" required class="form-control" placeholder="Group Indicator 16" >
						</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer 4</span>
								<input type="text" name="amtofcloudlayer4_archivesynopticformreportdata" id="amtofcloudlayer4_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Amount of individual cloud layer 4" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud 4</span>
								<input type="text" name="genuscloud4_archivesynopticformreportdata" id="genuscloud4_archivesynopticformreportdata" onkeyup="allowCharactersInputOnly(this)" class="form-control"  placeholder="Genus of cloud 4" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Height of cloud base layer or mass 4</span>
							<input type="text" name="hofbasecloud4_archivesynopticformreportdata" id="hofbasecloud4_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Height of cloud base layer or mass 4" >
						</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Group Indicator 9</span>
								<input type="text" name="groupindicator9_archivesynopticformreportdata" id="groupindicator9_archivesynopticformreportdata" value="9" readonly class="form-control" required class="form-control" required placeholder="Group Indicator 17" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Suplementary information</span>
								<input type="text" name="supplementaryinfo_archivesynopticformreportdata" id="supplementaryinfo_archivesynopticformreportdata" onkeyup="allowCharactersInputOnly(this)" class="form-control"  placeholder="Suplementary information" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Section Indicator 555</span>
								<input type="text" name="sectionindicator555_archivesynopticformreportdata" id="sectionindicator555_archivesynopticformreportdata" value="555" readonly class="form-control" required class="form-control" required placeholder="Section indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 1</span>
								<input type="text" name="groupindicator1_3_archivesynopticformreportdata" id="groupindicator1_3_archivesynopticformreportdata" value="1" readonly class="form-control"  required class="form-control" required placeholder="Group Indicator 18" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of data 5</span>
								<input type="text" name="signofdata5_archivesynopticformreportdata" id="signofdata5_archivesynopticformreportdata"  value="0" readonly class="form-control" required class="form-control" required placeholder="Sign of data 3" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Wet bulb temperature</span>
								<input type="text" name="wetbulbtemp_archivesynopticformreportdata"  id="wetbulbtemp_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)" class="form-control"  placeholder="Wetbulb temperature" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Relative humidity</span>
								<input type="text" name="relativehumidity_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Relative humidity" >
							</div>
						</td>

					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Vapour pressure</span>
								<input type="text" name="vapourpressure_archivesynopticformreportdata" id="vapourpressure_archivesynopticformreportdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control"  placeholder="Vapour Pressure" >
							</div>
						</td>
						<td>
						</td>
					</tr>
          <tr>
						<td colspan="2">
								<span style="text-align:centre;">Comment section</span>
						</td>
					</tr>
          <tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Remarks</span>
								<input type="text" name="remarks"  id="remarks" class="form-control"  placeholder=" remarks" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Time</span>
								<input type="time" name="time_"   class="form-control"  placeholder="" >
							</div>
						</td>

					</tr>
          <tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Observer on duty</span>
								<input type="text" name="ObserverOnDuty"  id="ObserverOnDuty"  class="form-control"  placeholder="observer on duty" >
							</div>
						</td>
						<td>

						</td>

					</tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">To</span>
                <input type="text" name="to"  id="to"  class="form-control"  placeholder="" >
              </div>
            </td>
            <td>
              <div class="input-group">
               <span class="input-group-addon">From</span>
               <input type="text" name="from"  id="from"  class="form-control"  placeholder="" >
             </div>
            </td>

          </tr>
				</table>
			</div>

<br>
		 <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="postarchivesynopticformreportdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
	<span class="step"></span>
  </div>

        </form>
        <br><br>
        </div>
    <?php
    }elseif((is_array($synopticformdata) && count($synopticformdata))) {
        foreach($synopticformdata as $synoptic){

            $synopticid = $synoptic->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveSynopticFormReportData/updateSynopticFormData" id="regForm" method="post" enctype="multipart/form-data">


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

							<!-- Section1 -->
				<table id="example1" class="table table-bordered table-striped">
					<tr>
            <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
         <td >

             <div class="input-group">
               <span class="input-group-addon">Station Name</span>
             <select name="station" id="stationManager"   class="form-control" placeholder="Select Station">
                   <option value="<?php echo $synoptic->StationName;?>"><?php echo $synoptic->StationName;?></option>
                   <?php
                   if (is_array($stationsdata) && count($stationsdata)) {
                       foreach($stationsdata as $station){?>
                           <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                       <?php }
                   } ?>
               </select>
             </div>

         </td>
         <td >

           <div class="input-group">
             <span class="input-group-addon"> Station Number</span>
              <input type="text" name="stationNo"  class="form-control" id="stationNoManager" readonly class="form-control" value="<?php echo $synoptic->StationNumber;?>" readonly="readonly" >
           </div>

         </td>
       <?php } else{ ?>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Station</span>
								 <input type="text" name="station" id="station" required class="form-control" required value="<?php echo $synoptic->StationName;?>"  readonly class="form-control" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $synoptic->StationNumber;?>" readonly="readonly" >
							</div>
						</td>
          <?php }?>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Select Date</span>
								 <input type="text" name="date" required class="form-control" value="<?php echo $synoptic->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
								<input type="hidden" name="id" value="<?php echo $synoptic->id;?>">
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME</span>
								 <input type="text" name="timeRecorded" id="timeRecorded"  class="form-control" value="<?php echo $synoptic->TIME;?>" placeholder="Enter time" readonly class="form-control">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Unit of wind speed</span>
								 <input type="text" name="unitofwindspeed" id="unitofwindspeed" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->UWS;?>"  placeholder="Enter unit of wind speed" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Block Number</span>
								<input type="text" name="blockNumber" id="blockNumber"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->BN;?>"   placeholder="Enter block number" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Ind. or ommission of precipitation</span>
								<input type="text" name="ioprecipitation" id="ioprecipitation"  onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->IOOP;?>"  placeholder="Ind. or ommission of precipitation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Type of station/present & past weather</span>
								<input type="text" name="typeofstat" id="typeofstat" onkeyup="allowCharactersInputOnly(this)" class="form-control" value="<?php echo $synoptic->TSPPW;?>"  placeholder="Type of station/present & past weather" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of lowest cloud</span>
								 <input type="text" name="lowestcloudheight" id="lowestcloudheight" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->HLC;?>" placeholder="Height of west cloud" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Horizontal Visibility</span>
								<input type="text" name="horizontalvisibility" id="horizontalvisibility" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->HV;?>" placeholder="Horizontal Visibility" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Total cloud cover</span>
								<input type="text" name="cloudcovertotal" id="cloudcovertotal" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->TCC;?>" placeholder="Total cloud cover" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Wind Direction</span>
								<input type="text" name="wdirection" id="wdirection" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->WD;?>" placeholder="Wind Direction" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Wind Speed</span>
								<input type="text" name="wspeed" id="wspeed" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->WS;?>" placeholder="Wind Speed" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator</span>
								 <input type="text" name="gindicator1" id="gindicator1"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI1_1;?>" placeholder="Group Indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signdata1" id="signdata1" readonly class="form-control"    class="form-control" value="<?php echo $synoptic->SignOfData_1;?>" placeholder="Sign of the data" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Air temperature</span>
								<input type="text" name="airtemp" id="airtemp" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->Air_temperature;?>" placeholder="Air Temperature " >
							</div>
						</td>
					</tr>
				</table>
			</div>

			<!--section 2 -->
			<div class = "tab"><h2>More Data Input:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Group Indicator 2</span>
								<input type="text" name="gindicator2" id="gindicator2" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI2_1;?>" placeholder="Group Indicator 2" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sign of the data </span>
								<input type="text" name="signdata2" id="signdata2" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->SignOfData_2;?>" placeholder="Sign of the data" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Dew point temperature</span>
								 <input type="text" name="dewpointtemperature" id="dewpointtemperature" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->Dewpoint_temperature;?>" placeholder="Dew point temperature" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 3</span>
								<input type="text" name="gindicator3" id="gindicator3" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI3_1;?>" placeholder="Group Indicator 3" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Pressure station level</span>
								<input type="text" name="pressurestationlevel" id="pressurestationlevel" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->PASL;?>"  placeholder="Pressure station level" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 4</span>
								<input type="text" name="gindicator4" id="gindicator4" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI4_1;?>" placeholder="Group Indicator 4" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Standard isobaric surface</span>
								<input type="text" name="isobaric" id="isobaric" onkeyup="allowIntegerInputOnly(this)" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->SIS;?>" placeholder="Standard isobaric surface" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Geopotential of SIS</span>
								<input type="text" name="geopotentialsis" id="geopotentialsis" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->GSIS;?>"  placeholder="Geopotential of isobaric surface" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 6</span>
								<input type="text" name="gindicator6" id="gindicator6"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI6_1;?>" placeholder="Group Indicator 6" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of precipitation</span>
								 <input type="text" name="amountofprecipitation"  id="amountofprecipitation" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->AOP;?>"  placeholder="Amount of precipitation" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Duration period of precipitation</span>
								<input type="text" name="precipitationduration" id="precipitationduration" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->DPOP;?>"  placeholder="Duration period of precipitation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 7</span>
								<input type="text" name="gindicator7" id="gindicator7"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI7_1;?>" placeholder="Group Indicator 7" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Present weather</span>
								<input type="text" name="presentweather" id="presentweather" onkeyup=""  class="form-control" value="<?php echo $synoptic->Present_Weather;?>"  placeholder="Present weather" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Past weather</span>
								<input type="text" name="pastweather" id="pastweather" onkeyup=""  class="form-control" value="<?php echo $synoptic->Past_Weather;?>"  placeholder="Past weather" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="gindicator8" id="gindicator8" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_1;?>" placeholder="Group Indicator 8" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of clouds</span>
								<input type="text" name="amountclouds" id="amountclouds" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->AOC;?>"  placeholder="Amount of clouds" >
							</div>
						</td>
					</tr>
				</table>
			</div>

			<!--section 3 -->
			<div class = "tab"><h2>Weather Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Clouds of the Genera  Sc. St. Cu. Cb</span>
								<input type="text" name="cloudsgene1" id="cloudsgene1" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->CLOG;?>"  placeholder="Clouds of the general Sc. St. Cu, Cb" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Clouds of the Genera Ac. As. Ns</span>
								<input type="text" name="cloudsgene2" id="cloudsgene2" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->CGOG;?>"  placeholder="Clouds of the general Ac As Ns" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Clouds of the Genera Cl Cc Cs</span>
								 <input type="text" name="cloudsgene3" id="cloudsgene3" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->CHOG;?>"  placeholder="Clouds of the general C Cc Cs" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Section Indicator</span>
								<input type="text" name="sindicator333" id="sindicator333"   readonly class="form-control"   class="form-control" value="<?php echo $synoptic->Section_Indicator333;?>"   placeholder="Section Indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 0</span>
								 <input type="text" name="gindicator0" id="gindicator0" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI0_1;?>"   placeholder="General Indicator" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Grass minimum temperature</span>
								<input type="text" name="grassmintemp" id="grassmintemp"  onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->GMT;?>"  placeholder="Grass minimum temperature" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Character & intensity of precipitation</span>
								 <input type="text" name="characterinten" id="characterinten" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->CIOP;?>"  placeholder="Character & Intensity of precipitation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Beginning or end of precipitation</span>
								 <input type="text" name="begendprecipitation" id="begendprecipitation" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->BEOP;?>"  placeholder="beginning or end of precipitation" >
							</div>
						</td>
					</tr>
					<tr>
						<td colspan = "2" align = "center">
							<div class="form-group">
								 <label><span>Did we have: </span></label><br>

								<input type="checkbox" <?php if($synoptic->ThunderStorm == "true") echo "checked"; ?> name="thunderstorm" class="form-control" value="true"> Thunder storm (Ts)
								<input type="checkbox" name="hailstorm" <?php if($synoptic->HailStorm == "true") echo "checked"; ?> class="form-control" value="true"> Hail storm (Hs)

								<input type="checkbox" name="fog" <?php if($synoptic->Fog == "true") echo "checked"; ?> class="form-control" value="true"> Fog (Fg)
								<input type="checkbox" name="earthquake" <?php if($synoptic->EarthQuake == "true") echo "checked"; ?> class="form-control"> Earth Quake

								<input type="checkbox" name="anemometerreading" <?php if($synoptic->Anemometer_Reading == "true") echo "checked"; ?> class="form-control" value="true"> Anemometer Reading


								<input type="checkbox" <?php if($synoptic->Actual_Rainfall == "true") echo "checked"; ?> name="actualrainfall" class="form-control" value="true"> Actual Rain

							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 1</span>
								 <input type="text" name="gindicator1_2" id="gindicator1_2"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI1_2;?>" placeholder="Group Indicator" ">
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signdata3"  id="signdata3" readonly class="form-control"    class="form-control" value="<?php echo $synoptic->SignOfData_3;?>" placeholder="Sign of the data" ">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Minimum temperature</span>
								<input type="text" name="maxtemptx" id="maxtemptx" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->Max_TempTx;?>"  placeholder="Minimum temperature" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 2</span>
								<input type="text" name="gindicator2_2" id="gindicator2_2" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI2_2;?>" placeholder="Group Indicator 9" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signdata4" id="signdata4" readonly class="form-control" require class="form-control" value="<?php echo $synoptic->SignOfData_4;?>"   placeholder="Sign of the data" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Maximum temperature</span>
								<input type="text" name="maxtemptn" id="maxtemptn" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->Max_TempTn;?>"  placeholder="Maximum temperature" >
							</div>
						</td>
					</tr>
				</table>
			</div>

			<!--section 4 -->
			<div class = "tab"><h2>More Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 5</span>
								 <input type="text" name="gindicator5" id="gindicator5" readonly class="form-control"    class="form-control" value="<?php echo $synoptic->GI5_1;?>"   placeholder="Group Indicator" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of evapouration</span>
								<input type="text" name="amtofevap" id="amtofevap" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->AOE;?>"  placeholder="Amount of evapouration" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Indicator of type of instrumentation</span>
								<input type="text" name="indtype" id="indtype" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->ITI;?>"  placeholder="Indicator of type of instrumentation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 55</span>
								<input type="text" name="gindicator55" id="gindicator55" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI55;?>" placeholder="Group Indicator 10" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Duration of sunshine</span>
								<input type="text" name="durationsunshine" id="durationsunshine" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->DOS;?>"  placeholder="Duration of sunshine" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 5</span>
								 <input type="text" name="gindicator5_2" id="gindicator5_2"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI5_2;?>"   placeholder="General Indicator 11" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of pressure change</span>
								<input type="text" name="pressurechgsign" id="pressurechgsign" onkeyup="allowCharactersInputOnly(this)" class="form-control" value="<?php echo $synoptic->SPC;?>"  placeholder="Sign of pressure change" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Pressure change in 24</span>
								<input type="text" name="pressurechgin24hrs" id="pressurechgin24hrs" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->PCI24Hrs;?>"  placeholder="Pressure change in 24 hrs" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 6</span>
								<input type="text" name="gindicator6_2" id="gindicator6_2" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI6_2;?>"   placeholder="Group Indicator 12" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of precipitation</span>
								 <input type="text" name="amountofprecipitation2" id="amountofprecipitation2" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $synoptic->AOP_2;?>" placeholder="Amount of precipitation" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Duration of period of precipitation</span>
								<input type="text" name="precipitationduration2" id="precipitationduration2" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->DPOP_2;?>"  placeholder="Duration of period of precipitation" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="gindicator8_2"  id="gindicator8_2"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_2;?>"   placeholder="General Indicator 13" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer</span>
								<input type="text" name="cloudlayeramount" id="cloudlayeramount" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->AICL;?>"  placeholder="Amount of individual cloud layer" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud</span>
								<input type="text" name="cloudgenus" id="cloudgenus" onkeyup="allowCharactersInputOnly(this)" class="form-control" value="<?php echo $synoptic->GOC;?>"  placeholder="Genus of cloud" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Height of base cloud layer or mass</span>
								<input type="text" name="basecloudheight" id="basecloudheight" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->HBCLOM;?>"  placeholder="Height of base cloud layer or mass" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="gindicator8_3"  id="gindicator8_3"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_3;?>"   placeholder="General Indicator 13" >
							</div>
						</td>
					</tr>

				</table>
			</div>

			<!--section 5 -->
			<div class = "tab"><h2>Cloud Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer</span>
								<input type="text" name="cloudlayeramount2" id="cloudlayeramount2" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->AICL_2;?>"  placeholder="Amount of individual cloud layer" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud</span>
								<input type="text" name="cloudgenus2" id="cloudgenus2" onkeyup="allowCharactersInputOnly(this)" class="form-control" value="<?php echo $synoptic->GOC_2;?>"  placeholder="Genus of cloud" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of cloud base layer or mass</span>
								<input type="text" name="basecloudheight2" id="basecloudheight2" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->HBCLOM_2;?>"  placeholder="Height of base cloud layer or mass" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="gindicator8_4" id="gindicator8_4"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_4;?>"   placeholder="General Indicator 13" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer 3</span>
								<input type="text" name="cloudlayeramount3" id="cloudlayeramount3" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->AICL_3;?>"  placeholder="Amount of individual cloud layer" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud 3</span>
								<input type="text" name="cloudgenus3" id="cloudgenus3" onkeyup="allowCharactersInputOnly(this)" class="form-control" value="<?php echo $synoptic->GOC_3;?>"  placeholder="Genus of cloud" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of cloud base layer or mass 3</span>
								<input type="text" name="basecloudheight3" id="basecloudheight3" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->HBCLOM_3;?>"  placeholder="Height of base cloud layer or mass" >
							</div>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Group Indicator 8</span>
							<input type="text" name="gindicator8_5"  id="gindicator8_5"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_5;?>"   placeholder="General Indicator 13" >
						</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer 4</span>
								<input type="text" name="cloudlayeramount4" id="cloudlayeramount4" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->AICL_4;?>"  placeholder="Amount of individual cloud layer" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud 4</span>
								<input type="text" name="cloudgenus4" id="cloudgenus4" onkeyup="allowCharactersInputOnly(this)" class="form-control" value="<?php echo $synoptic->GOC_4;?>"  placeholder="Genus of cloud" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Height of cloud base layer or mass 4</span>
							<input type="text" name="basecloudheight4" id="basecloudheight4" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->HBCLOM_4;?>"  placeholder="Height of base cloud layer or mass" >
						</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Group Indicator 9</span>
								<input type="text" name="gindicator9" id="gindicator9" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI9;?>" placeholder="Group Indicator 14" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Suplementary information</span>
								<input type="text" name="supplementary_info"  id="supplementary_info"  onkeyup="allowCharactersInputOnly(this)" value="<?php echo $synoptic->Supp_Info;?>" class="form-control"  placeholder="Suplementary information" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Section Indicator 555</span>
								<input type="text" name="sindicator555" id="sindicator555" readonly class="form-control" value="<?php echo $synoptic->Section_Indicator555;?>" class="form-control"   placeholder="Section indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 1</span>
								<input type="text" name="gindicator1_3" id="gindicator1_3" readonly class="form-control" class="form-control" value="<?php echo $synoptic->GI1_3;?>"   placeholder="Group Indicator 18" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of data 5</span>
								<input type="text" name="signdata5" id="signdata5"  readonly class="form-control" value="<?php echo $synoptic->SignOfData_5;?>" class="form-control"  placeholder="Sign of data 3" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Wet bulb temperature</span>
								 <input type="text" name="wetbulbtemperature" id="wetbulbtemperature" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->Wetbulb_Temp;?>"  placeholder="Wetbulb temperature" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Relative humidity</span>
								<input type="text" name="rhumidity" id="rhumidity" onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->R_Humidity;?>"  placeholder="Relative humidity" >
							</div>
						</td>

					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Vapour pressure</span>
								<input type="text" name="vpressure" id="vpressure"  onkeyup="allowIntegerInputOnly(this)" class="form-control" value="<?php echo $synoptic->V_Pressure;?>"  placeholder="Vapour Pressure" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Approved</span>
								<?php if($userrole=="DataOfficer" || $synoptic->Approved=='TRUE'){?>
								<select name="approval" id="approval" readonly  class="form-control" >
									<option value="<?php echo $synoptic->Approved;?>"><?php echo $synoptic->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<input type="hidden" name="approval" value="<?php echo $synoptic->Approved;?>">
								<?php }else{?>
								   <select name="approval" id="approval"  class="form-control" >
									<option value="<?php echo $synoptic->Approved;?>"><?php echo $synoptic->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<?php }?>
							</div>
						</td>
					</tr>
          <tr>
            <td colspan="2">
                <span style="text-align:centre;">Comment section</span>
            </td>
          </tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Remarks</span>
                <input type="text" name="remarks" value="<?php echo $synoptic->remarks;?>"  id="remarks" class="form-control"  placeholder=" remarks" >
              </div>
            </td>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Time</span>
                <input type="time" name="time_"    value="<?php echo $synoptic->time_;?>"  class="form-control"  placeholder="" >
              </div>
            </td>

          </tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Observer on duty</span>
                <input type="text" name="ObserverOnDuty"  id="ObserverOnDuty" value="<?php echo $synoptic->ObserverOnDuty;?>"  class="form-control"  placeholder="observer on duty" >
              </div>
            </td>
            <td>

            </td>

          </tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">To</span>
                <input type="text" name="to" value="<?php echo $synoptic->to_;?>"   id="to"  class="form-control"  placeholder="" >
              </div>
            </td>
            <td>
              <div class="input-group">
               <span class="input-group-addon">From</span>
               <input type="text" name="from"  value="<?php echo $synoptic->from_;?>" id="from"  class="form-control"  placeholder="" >
             </div>
            </td>

          </tr>
				</table>
			</div>

		 <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="updatearchivesynopticformreportdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
	<span class="step"></span>
  </div>

            </form>
            <br><br>
            </center>
     <?php
             } }elseif((is_array($synopticformdatavalidate) && count($synopticformdatavalidate))) {
        foreach($synopticformdatavalidate as $synoptic){

            $synopticid = $synoptic->id;
            ?>
            <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveSynopticFormReportData/updateSynopticFormData" id="regForm" method="post" enctype="multipart/form-data">
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

							<!-- Section1 -->
			<div class = "tab">
				<table id="example1" class="table table-bordered table-striped">
					<tr>
            <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
         <td >

             <div class="input-group">
               <span class="input-group-addon">Station Name</span>
             <select name="station" id="stationManager"   class="form-control" placeholder="Select Station">
                   <option value="<?php echo $synoptic->StationName;?>"><?php echo $synoptic->StationName;?></option>
                   <?php
                   if (is_array($stationsdata) && count($stationsdata)) {
                       foreach($stationsdata as $station){?>
                           <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                       <?php }
                   } ?>
               </select>
             </div>

         </td>
         <td >

           <div class="input-group">
             <span class="input-group-addon"> Station Number</span>
              <input type="text" name="stationNo"  class="form-control" id="stationNoManager" readonly class="form-control" value="<?php echo $synoptic->StationNumber;?>" readonly="readonly" >
           </div>

         </td>
       <?php } else{ ?>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Station</span>
								 <input type="text" name="station" id="station" required class="form-control" required value="<?php echo $synoptic->StationName;?>"  readonly class="form-control" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $synoptic->StationNumber;?>" readonly="readonly" >
							</div>
						</td>
          <?php }?>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Select Date</span>
								 <input type="text" name="date" required class="form-control" value="<?php echo $synoptic->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
								<input type="hidden" name="id" value="<?php echo $synoptic->id;?>">
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">TIME</span>
								 <input type="text" name="timeRecorded" id="timeRecorded"  class="form-control" value="<?php echo $synoptic->TIME;?>" placeholder="Enter time" readonly class="form-control">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Unit of wind speed</span>
								 <input type="text" name="unitofwindspeed" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->UWS;?>',this.value,'errorunitofwindspeed');" class="form-control" value=""  placeholder="Enter unit of wind speed" >
							</div>
                            <span id="errorunitofwindspeed"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Block Number</span>
								<input type="text" name="blockNumber" id="blockNumber"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->BN;?>"   placeholder="Enter block number" >
							</div>
                            
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Ind. or ommission of precipitation</span>
								<input type="text" name="ioprecipitation"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->IOOP;?>',this.value,'errorioprecipitation');" class="form-control" value=""  placeholder="Ind. or ommission of precipitation" >
							</div>
                            <span id="errorioprecipitation"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Type of station/present & past weather</span>
								<input type="text" name="typeofstat"  onkeyup="allowCharactersInputOnly(this);validation('<?php echo $synoptic->TSPPW;?>',this.value,'errortypeofstat');" class="form-control" value=""  placeholder="Type of station/present & past weather" >
							</div>
                            <span id="errortypeofstat"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of lowest cloud</span>
								 <input type="text" name="lowestcloudheight" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->HLC;?>',this.value,'errorlowestcloudheight');"  class="form-control" value="" placeholder="Height of west cloud" >
							</div>
                            <span id="errorlowestcloudheight"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Horizontal Visibility</span>
								<input type="text" name="horizontalvisibility"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->HV;?>',this.value,'errorhorizontalvisibility');"  class="form-control" value="" placeholder="Horizontal Visibility" >
							</div>
                            <span id="errorhorizontalvisibility"></span>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Total cloud cover</span>
								<input type="text" name="cloudcovertotal"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->TCC;?>',this.value,'errorcloudcovertotal');"  class="form-control" value="" placeholder="Total cloud cover" >
							</div>
                            <span id="errorcloudcovertotal"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Wind Direction</span>
								<input type="text" name="wdirection"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->WD;?>',this.value,'errorwdirection');"  class="form-control" value="" placeholder="Wind Direction" >
							</div>
                            <span id="errorwdirection"></span>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Wind Speed</span>
								<input type="text" name="wspeed"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->WS;?>',this.value,'errorwspeed');"  class="form-control" value="" placeholder="Wind Speed" >
							</div>
                            <span id="errorwspeed"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator</span>
								 <input type="text" name="gindicator1" id="gindicator1"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI1_1;?>" placeholder="Group Indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signdata1" id="signdata1" readonly class="form-control"    class="form-control" value="<?php echo $synoptic->SignOfData_1;?>" placeholder="Sign of the data" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Air temperature</span>
								<input type="text" name="airtemp"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->Air_temperature;?>',this.value,'errorairtemp');"  class="form-control" value="" placeholder="Air Temperature " >
							</div>
                            <span id="errorairtemp"></span>
						</td>
					</tr>
				</table>
			</div>

			<!--section 2 -->
			<div class = "tab"><h2>More Data Input:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Group Indicator 2</span>
								<input type="text" name="gindicator2" id="gindicator2" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI2_1;?>" placeholder="Group Indicator 2" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Sign of the data </span>
								<input type="text" name="signdata2" id="signdata2" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->SignOfData_2;?>" placeholder="Sign of the data" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Dew point temperature</span>
								 <input type="text" name="dewpointtemperature" id="dewpointtemperature" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->Dewpoint_temperature;?>',this.value,'errordewpointtemperature');"  class="form-control" value="" placeholder="Dew point temperature" >
							</div>
                            <span id="errordewpointtemperature"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 3</span>
								<input type="text" name="gindicator3" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI3_1;?>" placeholder="Group Indicator 3" >
							</div>
                            
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Pressure station level</span>
								<input type="text" name="pressurestationlevel" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->PASL;?>',this.value,'errorpressurestationlevel');" class="form-control" value=""  placeholder="Pressure station level" >
							</div>
                            <span id="errorpressurestationlevel"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 4</span>
								<input type="text" name="gindicator4" id="gindicator4" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI4_1;?>" placeholder="Group Indicator 4" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Standard isobaric surface</span>
								<input type="text" name="isobaric" id="isobaric" onkeyup="allowIntegerInputOnly(this)" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->SIS;?>" placeholder="Standard isobaric surface" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Geopotential of SIS</span>
								<input type="text" name="geopotentialsis" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->GSIS;?>',this.value,'errorgeopotentialsis');" class="form-control" value=""  placeholder="Geopotential of isobaric surface" >
							</div>
                            <span id="errorgeopotentialsis"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 6</span>
								<input type="text" name="gindicator6" id="gindicator6"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI6_1;?>" placeholder="Group Indicator 6" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of precipitation</span>
								 <input type="text" name="amountofprecipitation" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->AOP;?>',this.value,'erroramountofprecipitation');"  class="form-control" value=""  placeholder="Amount of precipitation" >
							</div>
                            <span id="erroramountofprecipitation"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Duration period of precipitation</span>
								<input type="text" name="precipitationduration" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->DPOP;?>',this.value,'errorprecipitationduration');" class="form-control" value=""  placeholder="Duration period of precipitation" >
							</div>
                            <span id="errorprecipitationduration"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 7</span>
								<input type="text" name="gindicator7" id="gindicator7"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI7_1;?>" placeholder="Group Indicator 7" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Present weather</span>
								<input type="text" name="presentweather" onkeyup="validation('<?php echo $synoptic->Present_Weather;?>',this.value,'errorpresentweather');" onkeyup=""  class="form-control" value=""  placeholder="Present weather" >
							</div>
                            <span id="errorpresentweather"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Past weather</span>
								<input type="text" name="pastweather" onkeyup="validation('<?php echo $synoptic->Past_Weather;?>',this.value,'errorpastweather');" onkeyup=""  class="form-control" value=""  placeholder="Past weather" >
							</div>
                            <span id="errorpastweather"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="gindicator8" id="gindicator8" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_1;?>" placeholder="Group Indicator 8" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of clouds</span>
								<input type="text" name="amountclouds" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->AOC;?>',this.value,'erroramountclouds');" class="form-control" value=""  placeholder="Amount of clouds" >
							</div>
                            <span id="erroramountclouds"></span>
						</td>
					</tr>
				</table>
			</div>

			<!--section 3 -->
			<div class = "tab"><h2>Weather Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Clouds of the Genera  Sc. St. Cu. Cb</span>
								<input type="text" name="cloudsgene1" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->CLOG;?>',this.value,'errorcloudsgene1');" class="form-control" value=""  placeholder="Clouds of the general Sc. St. Cu, Cb" >
							</div>
                            <span id="errorcloudsgene1"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Clouds of the Genera Ac. As. Ns</span>
								<input type="text" name="cloudsgene2" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->CGOG;?>',this.value,'errorcloudsgene2');" class="form-control" value=""  placeholder="Clouds of the general Ac As Ns" >
							</div>
                            <span id="errorcloudsgene2"></span>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Clouds of the Genera Cl Cc Cs</span>
								 <input type="text" name="cloudsgene3" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->CHOG;?>',this.value,'errorcloudsgene3');" class="form-control" value=""  placeholder="Clouds of the general C Cc Cs" >
							</div>
                            <span id="errorcloudsgene3"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Section Indicator</span>
								<input type="text" name="sindicator333" id="sindicator333"   readonly class="form-control"   class="form-control" value="<?php echo $synoptic->Section_Indicator333;?>"   placeholder="Section Indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 0</span>
								 <input type="text" name="gindicator0" id="gindicator0" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI0_1;?>"   placeholder="General Indicator" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Grass minimum temperature</span>
								<input type="text" name="grassmintemp"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->CHOG;?>',this.value,'errorgrassmintemp');" class="form-control" value=""  placeholder="Grass minimum temperature" >
							</div>
                            <span id="errorgrassmintemp"></span>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Character & intensity of precipitation</span>
								 <input type="text" name="characterinten" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->CIOP;?>',this.value,'errorcharacterinten');" class="form-control" value=""  placeholder="Character & Intensity of precipitation" >
							</div>
                            <span id="errorcharacterinten"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Beginning or end of precipitation</span>
								 <input type="text" name="begendprecipitation" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->BEOP;?>',this.value,'errorbegendprecipitation');"  class="form-control" value=""  placeholder="beginning or end of precipitation" >
							</div>
                            <span id="errorbegendprecipitation"></span>
						</td>
					</tr>
					<tr>
						<td colspan = "2" align = "center">
							<div class="form-group">
								 <label><span>Did we have: </span></label><br>

								<input type="checkbox" <?php if($synoptic->ThunderStorm == "true") echo "checked"; ?> name="thunderstorm" class="form-control" value="true"> Thunder storm (Ts)
								<input type="checkbox" name="hailstorm" <?php if($synoptic->HailStorm == "true") echo "checked"; ?> class="form-control" value="true"> Hail storm (Hs)

								<input type="checkbox" name="fog" <?php if($synoptic->Fog == "true") echo "checked"; ?> class="form-control" value="true"> Fog (Fg)
								<input type="checkbox" name="earthquake" <?php if($synoptic->EarthQuake == "true") echo "checked"; ?> class="form-control"> Earth Quake

								<input type="checkbox" name="anemometerreading" <?php if($synoptic->Anemometer_Reading == "true") echo "checked"; ?> class="form-control" value="true"> Anemometer Reading


								<input type="checkbox" <?php if($synoptic->Actual_Rainfall == "true") echo "checked"; ?> name="actualrainfall" class="form-control" value="true"> Actual Rain

							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 1</span>
								 <input type="text" name="gindicator1_2" id="gindicator1_2"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI1_2;?>" placeholder="Group Indicator" ">
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signdata3"  id="signdata3" readonly class="form-control"    class="form-control" value="<?php echo $synoptic->SignOfData_3;?>" placeholder="Sign of the data" ">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Minimum temperature</span>
								<input type="text" name="maxtemptx" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->Max_TempTx;?>',this.value,'errormaxtemptx');" class="form-control" value=""  placeholder="Minimum temperature" >
							</div>
                            <span id="errormaxtemptx"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 2</span>
								<input type="text" name="gindicator2_2" id="gindicator2_2" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI2_2;?>" placeholder="Group Indicator 9" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of the data</span>
								<input type="text" name="signdata4" id="signdata4" readonly class="form-control" require class="form-control" value="<?php echo $synoptic->SignOfData_4;?>"   placeholder="Sign of the data" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Maximum temperature</span>
								<input type="text" name="maxtemptn"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->Max_TempTn;?>',this.value,'errormaxtemptn');" class="form-control" value=""  placeholder="Maximum temperature" >
							</div>
                            <span id="errormaxtemptn"></span>
						</td>
					</tr>
				</table>
			</div>

			<!--section 4 -->
			<div class = "tab"><h2>More Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 5</span>
								 <input type="text" name="gindicator5" id="gindicator5" readonly class="form-control"    class="form-control" value="<?php echo $synoptic->GI5_1;?>"   placeholder="Group Indicator" >
							</div>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of evapouration</span>
								<input type="text" name="amtofevap"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->AOE;?>',this.value,'erroramtofevap');" class="form-control" value=""  placeholder="Amount of evapouration" >
							</div>
                            <span id="erroramtofevap"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Indicator of type of instrumentation</span>
								<input type="text" name="indtype" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->ITI;?>',this.value,'errorindtype');" class="form-control" value=""  placeholder="Indicator of type of instrumentation" >
							</div>
                            <span id="errorindtype"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 55</span>
								<input type="text" name="gindicator55" id="gindicator55" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI55;?>" placeholder="Group Indicator 10" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Duration of sunshine</span>
								<input type="text" name="durationsunshine" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->DOS;?>',this.value,'errordurationsunshine');" class="form-control" value=""  placeholder="Duration of sunshine" >
							</div>
                            <span id="errordurationsunshine"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 5</span>
								 <input type="text" name="gindicator5_2" id="gindicator5_2"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI5_2;?>"   placeholder="General Indicator 11" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of pressure change</span>
								<input type="text" name="pressurechgsign" onkeyup="allowCharactersInputOnly(this);validation('<?php echo $synoptic->SPC;?>',this.value,'errorpressurechgsign');" class="form-control" value=""  placeholder="Sign of pressure change" >
							</div>
                            <span id="errorpressurechgsign"></span>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Pressure change in 24</span>
								<input type="text" name="pressurechgin24hrs" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->PCI24Hrs;?>',this.value,'errorpressurechgin24hrs');"  class="form-control" value=""  placeholder="Pressure change in 24 hrs" >
							</div>
                            <span id="errorpressurechgin24hrs"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 6</span>
								<input type="text" name="gindicator6_2" id="gindicator6_2" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI6_2;?>"   placeholder="Group Indicator 12" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of precipitation</span>
								 <input type="text" name="amountofprecipitation2" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->AOP_2;?>',this.value,'erroramountofprecipitation2');"  class="form-control" value="" placeholder="Amount of precipitation" >
							</div>
                            <span id="erroramountofprecipitation2"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Duration of period of precipitation</span>
								<input type="text" name="precipitationduration2"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->DPOP_2;?>',this.value,'errorprecipitationduration2');" class="form-control" value=""  placeholder="Duration of period of precipitation" >
							</div>
                            <span id="errorprecipitationduration2"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="gindicator8_2"  id="gindicator8_2"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_2;?>"   placeholder="General Indicator 13" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer</span>
								<input type="text" name="cloudlayeramount" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->AICL;?>',this.value,'errorcloudlayeramount');" class="form-control" value=""  placeholder="Amount of individual cloud layer" >
							</div>
                            <span id="errorcloudlayeramount"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud</span>
								<input type="text" name="cloudgenus" onkeyup="allowCharactersInputOnly(this);validation('<?php echo $synoptic->GOC;?>',this.value,'errorcloudgenus');" class="form-control" value=""  placeholder="Genus of cloud" >
							</div>
                            <span id="errorcloudgenus"></span>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Height of base cloud layer or mass</span>
								<input type="text" name="basecloudheight" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->HBCLOM;?>',this.value,'errorbasecloudheight');" class="form-control" value=""  placeholder="Height of base cloud layer or mass" >
							</div>
                            <span id="errorbasecloudheight"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="gindicator8_3"  id="gindicator8_3"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_3;?>"   placeholder="General Indicator 13" >
							</div>
						</td>
					</tr>

				</table>
			</div>

			<!--section 5 -->
			<div class = "tab"><h2>Cloud Info:</h2>
				<table id="example1" class="table table-bordered table-striped">
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer</span>
								<input type="text" name="cloudlayeramount2" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->AICL_2;?>',this.value,'errorcloudlayeramount2');" class="form-control" value=""  placeholder="Amount of individual cloud layer" >
							</div>
                            <span id="errorcloudlayeramount2"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud</span>
								<input type="text" name="cloudgenus2" onkeyup="allowCharactersInputOnly(this);validation('<?php echo $synoptic->GOC_2;?>',this.value,'errorcloudgenus2');" class="form-control" value=""  placeholder="Genus of cloud" >
							</div>
                            <span id="errorcloudgenus2"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of cloud base layer or mass</span>
								<input type="text" name="basecloudheight2" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->HBCLOM_2;?>',this.value,'errorbasecloudheight2');" class="form-control" value=""  placeholder="Height of base cloud layer or mass" >
							</div>
                            <span id="errorbasecloudheight2"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 8</span>
								<input type="text" name="gindicator8_4" id="gindicator8_4"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_4;?>"   placeholder="General Indicator 13" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer 3</span>
								<input type="text" name="cloudlayeramount3"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->AICL_3;?>',this.value,'errorcloudlayeramount3');" class="form-control" value=""  placeholder="Amount of individual cloud layer" >
							</div>
                            <span id="errorcloudlayeramount3"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud 3</span>
								<input type="text" name="cloudgenus3" onkeyup="allowCharactersInputOnly(this);validation('<?php echo $synoptic->GOC_3;?>',this.value,'errorcloudgenus3');" class="form-control" value=""  placeholder="Genus of cloud" >
							</div>
                            <span id="errorcloudgenus3"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Height of cloud base layer or mass 3</span>
								<input type="text" name="basecloudheight3" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->HBCLOM_3;?>',this.value,'errorbasecloudheight3');" class="form-control" value=""  placeholder="Height of base cloud layer or mass" >
							</div>
                            <span id="errorbasecloudheight3"></span>
						</td>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Group Indicator 8</span>
							<input type="text" name="gindicator8_5"  id="gindicator8_5"  readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI8_5;?>"   placeholder="General Indicator 13" >
						</div>
                        
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Amount of individual cloud layer 4</span>
								<input type="text" name="cloudlayeramount4" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->AICL_4;?>',this.value,'errorcloudlayeramount4');" class="form-control" value=""  placeholder="Amount of individual cloud layer" >
							</div>
                            <span id="errorcloudlayeramount4"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Genus of cloud 4</span>
								<input type="text" name="cloudgenus4" onkeyup="allowCharactersInputOnly(this);validation('<?php echo $synoptic->GOC_4;?>',this.value,'errorcloudgenus4');" class="form-control" value=""  placeholder="Genus of cloud" >
							</div>
                            <span id="errorcloudgenus4"></span>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
							<span class="input-group-addon">Height of cloud base layer or mass 4</span>
							<input type="text" name="basecloudheight4" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->HBCLOM_4;?>',this.value,'errorbasecloudheight4');" class="form-control" value=""  placeholder="Height of base cloud layer or mass" >
						</div>
                        <span id="errorbasecloudheight4"></span>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Group Indicator 9</span>
								<input type="text" name="gindicator9" id="gindicator9" readonly class="form-control"   class="form-control" value="<?php echo $synoptic->GI9;?>" placeholder="Group Indicator 14" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Suplementary information</span>
								<input type="text" name="supplementary_info"   onkeyup="allowCharactersInputOnly(this);validation('<?php echo $synoptic->Supp_Info;?>',this.value,'errorsupplementary_info');" value="" class="form-control"  placeholder="Suplementary information" >
							</div>
                            <span id="errorsupplementary_info"></span>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Section Indicator 555</span>
								<input type="text" name="sindicator555" id="sindicator555" readonly class="form-control" value="<?php echo $synoptic->Section_Indicator555;?>" class="form-control"   placeholder="Section indicator" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Group Indicator 1</span>
								<input type="text" name="gindicator1_3" id="gindicator1_3" readonly class="form-control" class="form-control" value="<?php echo $synoptic->GI1_3;?>"   placeholder="Group Indicator 18" >
							</div>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Sign of data 5</span>
								<input type="text" name="signdata5" id="signdata5"  readonly class="form-control" value="<?php echo $synoptic->SignOfData_5;?>" class="form-control"  placeholder="Sign of data 3" >
							</div>
						</td>
					</tr>
					<tr>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Wet bulb temperature</span>
								 <input type="text" name="wetbulbtemperature" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->Wetbulb_Temp;?>',this.value,'errorwetbulbtemperature');" class="form-control" value=""  placeholder="Wetbulb temperature" >
							</div>
                            <span id="errorwetbulbtemperature"></span>
						</td>
						<td>
							 <div class="input-group">
								<span class="input-group-addon">Relative humidity</span>
								<input type="text" name="rhumidity"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->R_Humidity;?>',this.value,'errorrhumidity');" class="form-control" value=""  placeholder="Relative humidity" >
							</div>
                            <span id="errorrhumidity"></span>
						</td>

					</tr>
					<tr>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Vapour pressure</span>
								<input type="text" name="vpressure"  onkeyup="allowIntegerInputOnly(this);validation('<?php echo $synoptic->V_Pressure;?>',this.value,'errorvpressure');" class="form-control" value=""  placeholder="Vapour Pressure" >
							</div>
                            <span id="errorvpressure"></span>
						</td>
						<td>
							<div class="input-group">
								<span class="input-group-addon">Approved</span>
								<?php if($userrole=="DataOfficer" || $synoptic->Approved=='TRUE'){?>
								<select name="approval" id="approval" readonly  class="form-control">
									<option value="<?php echo $synoptic->Approved;?>"><?php echo $synoptic->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<input type="hidden" name="approval" value="<?php echo $synoptic->Approved;?>">
								<?php }else{?>
								   <select name="approval" id="approval"  class="form-control" readonly>
									<option value="<?php echo $synoptic->Approved;?>"><?php echo $synoptic->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<?php }?>
							</div>
						</td>
					</tr>
          <tr>
            <td colspan="2">
                <span style="text-align:centre;">Comment section</span>
            </td>
          </tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Remarks</span>
                <input type="text" name="remarks" onkeyup="validation('<?php echo $synoptic->remarks;?>',this.value,'errorremarks');" value=""  id="remarks" class="form-control"  placeholder=" remarks" >
              </div>
              <span id="errorremarks"></span>
            </td>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Time</span>
                <input type="time" name="time_"   onkeyup="validation('<?php echo $synoptic->time_;?>',this.value,'errortime_');"  value=""  class="form-control"  placeholder="" >
              </div>
              <span id="errortime_"></span>
            </td>

          </tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">Observer on duty</span>
                <input type="text" name="ObserverOnDuty"  onkeyup="validation('<?php echo $synoptic->ObserverOnDuty;?>',this.value,'errorObserverOnDuty');" value=""  class="form-control"  placeholder="observer on duty" >
              </div>
              <span id="errorObserverOnDuty"></span>
            </td>
            <td>

            </td>

          </tr>
          <tr>
            <td>
               <div class="input-group">
                <span class="input-group-addon">To</span>
                <input type="text" name="to" onkeyup="validation('<?php echo $synoptic->to_;?>',this.value,'errorto');" value=""   id="to"  class="form-control"  placeholder="" >
              </div>
              <span id="errorto"></span>
            </td>
            <td>
              <div class="input-group">
               <span class="input-group-addon">From</span>
               <input type="text" name="from"  onkeyup="validation('<?php echo $synoptic->from_;?>',this.value,'errorfrom');" value="" id="from"  class="form-control"  placeholder="" >
             </div>
             <span id="errorfrom"></span>
            </td>

          </tr>
				</table>
			</div>
<br>
		 <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)" name="updatearchivesynopticformreportdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
	<span class="step"></span>
  </div>

            </form>
            <br><br>
            </center>



        <?php
        }
        }else{
        if($userrole!="QC"){
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
	      href="<?php echo base_url(); ?>index.php/ArchiveSynopticFormReportData/DisplaySynopticForm/"><i class="fa fa-plus"></i> Add synoptic info</a>
            </div>

        </div>
        <?php } ?>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">

                    <div class="box-body table-responsive" style="overflow:auto">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Record No</th>
                                <th>Day </th>
                                <th>Time</th>
                                <th>Unit of wind speed</th>
                                <th>Block number</th>
                                <th>Station Name</th>
                                <th>Station No </th>


                                <th>Ommission of precipitation </th>
                                <!--<th>Maxi</th>-->
                                <th>Type of station</th>
                                <th>Height of lowest cloud</th>
                                <th>Horizontal Visibity</th>
                                <th>Wind Direction</th>
                                <th>Wind Speed</th>
                                <th>Quality Control</th>
                                <!--<th>Approved</th>
                                <th>Rain </th>
                                <th>Thunder</th>
                                <th>Fog</th>
                                <th>Haze</th>
                                <th>Storm</th>-->
                            <?php if(  $userrole=='SeniorDataOfficer'  || $userrole=='DataOfficer' || $userrole=='ObserverArchive'  || $userrole=='Senior Weather Observer'|| $userrole=='QC' ){ ?>
                              <th>Approved</th>
                              <th>Submitted By</th>
                              <th>Comments</th>
                              <th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            foreach($archivedsynopticformreportdata as $data){
                                
                                $id = $data->id;
                                if($userrole =='DataOfficer'&& $data->Approved =='TRUE' ){
									   $count++;
									   }else{
										   $count++;

                                ?>
                                <tr>
                                    <td ><?php echo $count;?><br><h6 style="color:red;font-size:8px;font-weight:bold;"><?php echo $data->numberofcomments>0 ? "( ".$data->numberofcomments." Comments )":"" ?> </h6></td>
                                    <td ><?php echo $data->Date;?></td>
                                    <td ><?php echo $data->TIME;?></td>
                                    <td ><?php echo $data->UWS;?></td>
                                    <td ><?php echo $data->BN;?></td>
                                    <td ><?php echo $data->StationName;?></td>
                                    <td ><?php echo $data->StationNumber;?></td>
                                    <td ><?php echo $data->IOOP;?></td>
                                    <td ><?php echo $data->TSPPW;?></td>
                                    <td><?php echo $data->HWC;?></td>
                                    <td ><?php echo $data->HV;?></td>
                                    <td ><?php echo $data->WD;?></td>
                                    <td ><?php echo $data->WS;?></td>

                                    <!--<td></td>
                                        <td><?php echo $data->thunder;?></td>
                                        <td ><?php echo $data->fog;?></td>
                                        <td ><?php echo $data->haze;?></td>
                                        <td><?php echo $data->storm;?></td>-->
                                        <td><?php echo ($data->qaBy==NULL)?"Pending":$data->qaBy; ?></td>
                               <?php if( $userrole=='SeniorDataOfficer'  || $userrole=='DataOfficer' || $userrole=='ObserverArchive'  || $userrole=='Senior Weather Observer' || $userrole=='QC'){ ?>

                                 <td ><?php echo $data->Approved;?></td>
                                 <td ><?php echo $data->AS_SubmittedBy;?></td>
                                 <td class="no-print"> 

                                                <?php if($data->Approved=="FALSE"|| $userrole!='DataOfficer'){ ?>
                                                  <h6><?php echo $data->numberofcomments; ?> comments on this record</h6>
                                                  <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>index.php/ArchiveSynopticFormReportData/index/<?php echo $data->id ?>/">View/ Add Comments</a> <br><br>
                                                <?php }else{ ?> 
                                                <h6 style="color:green;"> <li class='fa fa-check'></li> Record approved</h6>
                                                <?php }?>
                                                </td>
                                 <td class="no-print">
                                        
										     <table>
                                         <tr><td>
                                            <?php  if($userrole=='QC'){?>
                                                <?php if($data->qaBy==NULL){?>
                                                    <a class="btn btn-primary btn-xs" href="<?php echo base_url()."index.php/ArchiveSynopticFormReportData/DisplaySynopticFormForValidation/" .$data->id ;?>"
                                                     style="cursor:pointer;"><i class="fa fa-edit"></i> Verify</a>
												<?php }else{ ?>
                                                    <a class="btn btn-success btn-xs" href="" disabled><li class="fa fa-check"></li> Verified </a>
												<?php } ?>
											
										 <?php }else{ ?>
                                            <a class="btn btn-primary" href="<?php echo base_url()."index.php/ArchiveSynopticFormReportData/DisplaySynopticFormForUpdate/" .$data->id ;?>"
                                           style="cursor:pointer;"><i class="fa fa-edit"></i> Edit</a>
										 <?php } ?>
										   </td>
					 <?php if($userrole== 'SeniorDataOfficer' && $data->Approved=="TRUE" ){?>
						<td><form method="post" action="<?php echo base_url() . "index.php/ArchiveSynopticFormReportData/update_approval/" .$data->id ;?>"> <input type="hidden" name="id" value="<?php echo $data->id ?>" ><input type="hidden" name="approve" value="FALSE" ><button class="btn btn-danger"  type="submit"  ><li class='fa fa-times'></li> Disapprove</button></form>
							</td> <?php }elseif( $userrole=='Senior Weather Observer' && $data->Approved=="FALSE" || $userrole =='SeniorDataOfficer' && $data->Approved=="FALSE"){?>
								<td><form method="post" action="<?php echo base_url() . "index.php/ArchiveSynopticFormReportData/update_approval/" .$data->id ;?>"> <input type="hidden" name="id" value="<?php echo $data->id ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success"  type="submit"  ><li class='fa fa-check'></li> Approve &nbsp;&nbsp;&nbsp;&nbsp;</button></form>
								</td>

								<?php
							}else{ }?>
											<!-- <?php if($userrole=='SeniorDataOfficer'){?>
											<td>
											
											<form method="post" action="<?php echo base_url() . "index.php/ArchiveSynopticFormReportData/update_approval/" .$data->id ;?>"> <input type="hidden" name="id" value="<?php echo $data->id ; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($data->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
											</td><?php }?>  -->
									     </tr>
										 </table>
								 </td>		   

                                </tr>

                            <?php
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
                            <form method="post" action="<?php echo base_url(); ?>index.php/ArchiveSynopticFormReportData/submitObservationslipComment/">
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
            //Post metar form data into the DB
            //Validate each field before inserting into the DB
            $('#postarchivesynopticformreportdata_button').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveSynopticFormReportData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Archive Synoptic Record With the date,station,station Number and Time exists already in the db");
                    $('#date').val("");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }


                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield").focus();
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



                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_archivesynopticformreportdata').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archivesynopticformreportdata').val("");  //Clear the field.
                    $("#station_archivesynopticformreportdata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_archivesynopticformreportdata').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archivesynopticformreportdata').val("");  //Clear the field.
                    $("#stationNo_archivesynopticformreportdata").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var time_synoptic=$('#time_archivesynopticformreportdata').val();
                if(time_synoptic==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Synoptic not picked");
                    $('#time_archivesynopticformreportdata').val("");  //Clear the field.
                    $("#time_archivesynopticformreportdata").focus();
                    return false;

                }

////////////////////////////////////////////////////////////////////////////////////////////


            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveSynopticFormReportData(){

            //Check against the date,stationName,SManagernNumber,TimeManagerMetar Option.

            var date = $('#date').val();
            var stationName=$('#station_archivesynopticformreportdata').val();
            var stationNumber=$('#stationNo_archivesynopticformreportdata').val();
            var time_OnSynopticFormRecorded=$('#time_archivesynopticformreportdata').val();

           //alert(time_OnSynopticFormRecorded);
            $('#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationNumber != undefined) && (time_OnSynopticFormRecorded != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveSynopticFormReportData/checkInDBIfArchiveSynopticFormReportRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber,'time_OnSynopticFormRecorded':time_OnSynopticFormRecorded},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield').empty();

                            //alert(data);
                            $("#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveSynopticFormReportData_hiddentextfield").val();

            }//end of if
            else if((date == undefined) ||  (stationName == undefined) || (stationNumber == undefined)){

                var truthvalue="Missing";
            }


            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB
            //Validate each field before inserting into the DB
            $('#updatearchivesynopticformreportdata_button').click(function(event) {
                //Check that Date selected
                var date=$('#expdate').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
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
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var time=$('#timeRecorded').val();
                if(time==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Synoptic not picked");
                    $('#timeRecorded').val("");  //Clear the field.
                    $("#timeRecorded").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////
                //Check that Approved IS PICKED FROM A LIST
                var approval=$('#approval').val();
                if(approval==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select approval from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////



            }); //button
            //  return false;

        });  //document
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_unitofwindspeed;
            var oldValue_unitofwindspeed=$('#unitofwindspeed').val();

            $('#unitofwindspeed').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_unitofwindspeed = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#unitofwindspeed').val(newValue_unitofwindspeed);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#unitofwindspeed').val(oldValue_unitofwindspeed);
                    return false;
                }

            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_blockNumber ;
            var oldValue_blockNumber= $('#blockNumber').val()

            $('#blockNumber').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_blockNumber = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#blockNumber').val(newValue_blockNumber);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#blockNumber').val(oldValue_blockNumber);
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
            var newValue_ioprecipitation;
            var oldValue_ioprecipitation= $('#ioprecipitation').val()

            $('#ioprecipitation').live('change paste', function(){
                // oldValue_wwcovak = newValue_dddfffmfm;
                newValue_ioprecipitation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#ioprecipitation').val(newValue_ioprecipitation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#ioprecipitation').val(oldValue_ioprecipitation);
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
            var newValue_typeofstat;
            var oldValue_typeofstat= $('#typeofstat').val();

            $('#typeofstat').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_typeofstat = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#typeofstat').val(newValue_typeofstat);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#typeofstat').val(oldValue_typeofstat);
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
            var newValue_lowestcloudheight;
            var oldValue_lowestcloudheight= $('#lowestcloudheight').val();

            $('#lowestcloudheight').live('change paste', function(){
                //oldValue_airtemperature = newValue_airtemperature;
                newValue_lowestcloudheight = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#lowestcloudheight').val(newValue_lowestcloudheight);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#lowestcloudheight').val(oldValue_lowestcloudheight);
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
            var newValue_horizontalvisibility;
            var oldValue_horizontalvisibility= $('#horizontalvisibility').val();

            $('#horizontalvisibility').live('change paste', function(){
               // oldValue_wetbulb = newValue_wetbulb;
                newValue_horizontalvisibility = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#horizontalvisibility').val(newValue_horizontalvisibility);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#horizontalvisibility').val(oldValue_horizontalvisibility);
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
            var newValue_cloudcovertotal;
            var oldValue_cloudcovertotal= $('#cloudcovertotal').val()

            $('#cloudcovertotal').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_cloudcovertotal = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudcovertotal').val(newValue_cloudcovertotal);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudcovertotal').val(oldValue_cloudcovertotal);
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
            var newValue_wdirection;
            var oldValue_wdirection= $('#wdirection').val();

            $('#wdirection').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_wdirection = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wdirection').val(newValue_wdirection);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wdirection').val(oldValue_wdirection);
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
            var newValue_wspeed;
            var oldValue_wspeed= $('#wspeed').val();

            $('#wspeed').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_wspeed = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wspeed').val(newValue_wspeed);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wspeed').val(oldValue_wspeed);
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
            var newValue_airtemp;
            var oldValue_airtemp= $('#airtemp').val();

            $('#airtemp').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_airtemp = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#airtemp').val(newValue_airtemp);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#airtemp').val(oldValue_airtemp);
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
            var newValue_dewpointtemperature;
            var oldValue_dewpointtemperature= $('#dewpointtemperature').val();

            $('#dewpointtemperature').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_dewpointtemperature = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#dewpointtemperature').val(newValue_dewpointtemperature);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#dewpointtemperature').val(oldValue_dewpointtemperature);
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
            var newValue_pressurestationlevel;
            var oldValue_pressurestationlevel= $('#pressurestationlevel').val();

            $('#pressurestationlevel').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_pressurestationlevel = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#pressurestationlevel').val(newValue_pressurestationlevel);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#pressurestationlevel').val(oldValue_pressurestationlevel);
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
            var newValue_isobaric;
            var oldValue_isobaric= $('#isobaric').val();

            $('#isobaric').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_isobaric = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#isobaric').val(newValue_isobaric);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#isobaric').val(oldValue_isobaric);
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
            var newValue_geopotentialsis;
            var oldValue_geopotentialsis= $('#geopotentialsis').val();

            $('#geopotentialsis').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_geopotentialsis = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#geopotentialsis').val(newValue_geopotentialsis);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#geopotentialsis').val(oldValue_geopotentialsis);
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
            var newValue_amountofprecipitation;
            var oldValue_amountofprecipitation= $('#amountofprecipitation').val();

            $('#amountofprecipitation').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_amountofprecipitation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#amountofprecipitation').val(newValue_amountofprecipitation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#amountofprecipitation').val(oldValue_amountofprecipitation);
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
            var newValue_precipitationduration;
            var oldValue_precipitationduration= $('#precipitationduration').val();

            $('#precipitationduration').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_precipitationduration = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#precipitationduration').val(newValue_precipitationduration);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#precipitationduration').val(oldValue_precipitationduration);
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
            var newValue_presentweather;
            var oldValue_presentweather= $('#presentweather').val();

            $('#presentweather').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_presentweather = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#presentweather').val(newValue_presentweather);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#presentweather').val(oldValue_presentweather);
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
            var newValue_pastweather;
            var oldValue_pastweather= $('#pastweather').val();

            $('#pastweather').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_pastweather = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#pastweather').val(newValue_pastweather);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#pastweather').val(oldValue_pastweather);
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
            var newValue_amountclouds;
            var oldValue_amountclouds= $('#amountclouds').val();

            $('#amountclouds').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_amountclouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#amountclouds').val(newValue_amountclouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#amountclouds').val(oldValue_amountclouds);
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
            var newValue_cloudsgene1;
            var oldValue_cloudsgene1= $('#cloudsgene1').val();

            $('#cloudsgene1').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudsgene1 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudsgene1').val(newValue_cloudsgene1);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudsgene1').val(oldValue_cloudsgene1);
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
            var newValue_cloudsgene2;
            var oldValue_cloudsgene2= $('#cloudsgene2').val();

            $('#cloudsgene2').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudsgene2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudsgene2').val(newValue_cloudsgene2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudsgene2').val(oldValue_cloudsgene2);
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
            var newValue_cloudsgene3;
            var oldValue_cloudsgene3= $('#cloudsgene3').val();

            $('#cloudsgene3').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudsgene3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudsgene3').val(newValue_cloudsgene3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudsgene3').val(oldValue_cloudsgene3);
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
            var newValue_grassmintemp;
            var oldValue_grassmintemp= $('#grassmintemp').val();

            $('#grassmintemp').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_grassmintemp = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#grassmintemp').val(newValue_grassmintemp);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#grassmintemp').val(oldValue_grassmintemp);
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
            var newValue_characterint;
            var oldValue_characterint= $('#characterint').val();

            $('#characterint').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_characterint = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#characterint').val(newValue_characterint);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#characterint').val(oldValue_characterint);
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
            var newValue_begendprecipitation;
            var oldValue_begendprecipitation= $('#begendprecipitation').val();

            $('#begendprecipitation').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_begendprecipitation = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#begendprecipitation').val(newValue_begendprecipitation);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#begendprecipitation').val(oldValue_begendprecipitation);
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
            var newValue_maxtemptx;
            var oldValue_maxtemptx= $('#maxtemptx').val();

            $('#maxtemptx').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_maxtemptx = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxtemptx').val(newValue_maxtemptx);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxtemptx').val(oldValue_maxtemptx);
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
            var newValue_maxtemptn;
            var oldValue_maxtemptn= $('#maxtemptn').val();

            $('#maxtemptn').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_maxtemptn = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxtemptn').val(newValue_maxtemptn);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxtemptn').val(oldValue_maxtemptn);
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
            var newValue_amtofevap;
            var oldValue_amtofevap= $('#amtofevap').val();

            $('#amtofevap').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_amtofevap = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#amtofevap').val(newValue_amtofevap);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#amtofevap').val(oldValue_amtofevap);
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
            var newValue_indtype;
            var oldValue_indtype= $('#indtype').val();

            $('#indtype').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_indtype = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#indtype').val(newValue_indtype);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#indtype').val(oldValue_indtype);
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
            var newValue_durationsunshine;
            var oldValue_durationsunshine= $('#durationsunshine').val();

            $('#durationsunshine').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_durationsunshine = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#durationsunshine').val(newValue_durationsunshine);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#durationsunshine').val(oldValue_durationsunshine);
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
            var newValue_pressurechgsign;
            var oldValue_pressurechgsign= $('#pressurechgsign').val();

            $('#pressurechgsign').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_pressurechgsign = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#pressurechgsign').val(newValue_pressurechgsign);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#pressurechgsign').val(oldValue_pressurechgsign);
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
            var newValue_pressurechgin24hrs;
            var oldValue_pressurechgin24hrs= $('#pressurechgin24hrs').val();

            $('#pressurechgin24hrs').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_pressurechgin24hrs = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#pressurechgin24hrs').val(newValue_pressurechgin24hrs);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#pressurechgin24hrs').val(oldValue_pressurechgin24hrs);
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
            var newValue_amountofprecipitation2;
            var oldValue_amountofprecipitation2= $('#amountofprecipitation2').val();

            $('#amountofprecipitation2').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_amountofprecipitation2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#amountofprecipitation2').val(newValue_amountofprecipitation2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#amountofprecipitation2').val(oldValue_amountofprecipitation2);
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
            var newValue_precipitationduration2;
            var oldValue_precipitationduration2= $('#precipitationduration2').val();

            $('#precipitationduration2').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_precipitationduration2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#precipitationduration2').val(newValue_precipitationduration2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#precipitationduration2').val(oldValue_precipitationduration2);
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
            var newValue_cloudlayeramount;
            var oldValue_cloudlayeramount= $('#cloudlayeramount').val();

            $('#cloudlayeramount').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudlayeramount = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudlayeramount').val(newValue_cloudlayeramount);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudlayeramount').val(oldValue_cloudlayeramount);
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
            var newValue_cloudgenus;
            var oldValue_cloudgenus= $('#cloudgenus').val();

            $('#cloudgenus').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudgenus = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudgenus').val(newValue_cloudgenus);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudgenus').val(oldValue_cloudgenus);
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
            var newValue_basecloudheight;
            var oldValue_basecloudheight= $('#basecloudheight').val();

            $('#basecloudheight').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_basecloudheight = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#basecloudheight').val(newValue_basecloudheight);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#basecloudheight').val(oldValue_basecloudheight);
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
            var newValue_cloudlayeramount2;
            var oldValue_cloudlayeramount2= $('#cloudlayeramount2').val();

            $('#cloudlayeramount2').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudlayeramount2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudlayeramount2').val(newValue_cloudlayeramount2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudlayeramount2').val(oldValue_cloudlayeramount2);
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
            var newValue_cloudgenus2;
            var oldValue_cloudgenus2= $('#cloudgenus2').val();

            $('#cloudgenus2').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudgenus2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudgenus2').val(newValue_cloudgenus2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudgenus2').val(oldValue_cloudgenus2);
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
            var newValue_basecloudheight2;
            var oldValue_basecloudheight2= $('#basecloudheight2').val();

            $('#basecloudheight2').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_basecloudheight2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#basecloudheight2').val(newValue_basecloudheight2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#basecloudheight2').val(oldValue_basecloudheight2);
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
            var newValue_cloudlayeramount3;
            var oldValue_cloudlayeramount3= $('#cloudlayeramount3').val();

            $('#cloudlayeramount3').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudlayeramount3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudlayeramount3').val(newValue_cloudlayeramount3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudlayeramount3').val(oldValue_cloudlayeramount3);
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
            var newValue_cloudgenus3;
            var oldValue_cloudgenus3= $('#cloudgenus3').val();

            $('#cloudgenus3').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudgenus3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudgenus3').val(newValue_cloudgenus3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudgenus3').val(oldValue_cloudgenus3);
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
            var newValue_basecloudheight3;
            var oldValue_basecloudheight3= $('#basecloudheight3').val();

            $('#basecloudheight3').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_basecloudheight3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#basecloudheight3').val(newValue_basecloudheight3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#basecloudheight3').val(oldValue_basecloudheight3);
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
            var newValue_cloudlayeramount4;
            var oldValue_cloudlayeramount4= $('#cloudlayeramount4').val();

            $('#cloudlayeramount4').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudlayeramount4 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudlayeramount4').val(newValue_cloudlayeramount4);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudlayeramount4').val(oldValue_cloudlayeramount4);
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
            var newValue_cloudgenus4;
            var oldValue_cloudgenus4= $('#cloudgenus4').val();

            $('#cloudgenus4').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_cloudgenus4 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudgenus4').val(newValue_cloudgenus4);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudgenus4').val(oldValue_cloudgenus4);
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
            var newValue_basecloudheight4;
            var oldValue_basecloudheight4= $('#basecloudheight4').val();

            $('#basecloudheight4').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_basecloudheight4 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#basecloudheight4').val(newValue_basecloudheight4);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#basecloudheight4').val(oldValue_basecloudheight4);
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
            var newValue_supplementary_info;
            var oldValue_supplementary_info= $('#supplementary_info').val();

            $('#supplementary_info').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_supplementary_info = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#supplementary_info').val(newValue_supplementary_info);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#supplementary_info').val(oldValue_supplementary_info);
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
            var newValue_wetbulbtemperature;
            var oldValue_wetbulbtemperature= $('#wetbulbtemperature').val();

            $('#wetbulbtemperature').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_wetbulbtemperature = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wetbulbtemperature').val(newValue_wetbulbtemperature);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wetbulbtemperature').val(oldValue_wetbulbtemperature);
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
            var newValue_rhumidity;
            var oldValue_rhumidity= $('#rhumidity').val();

            $('#rhumidity').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_rhumidity = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rhumidity').val(newValue_rhumidity);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#rhumidity').val(oldValue_rhumidity);
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
            var newValue_vpressure;
            var oldValue_vpressure= $('#vpressure').val();

            $('#vpressure').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_vpressure = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#vpressure').val(newValue_vpressure);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#vpressure').val(oldValue_vpressure);
                    return false;
                }
       });
        });
    </script>

    <script type="text/javascript">
        //Once the Admin selects the Station the StationManagerer should be pickManagerom the DB.
        // For Insert/Add metar

        (document.body).on('change','#stationManager_archivesynopticformreportdata',function(){
            $('#stationNoManager_archivesynopticformreportdata').val("");  //Clear the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoManager_archivesynopticformreportdata').val("");
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

                            $('#stationNoManager_archivesynopticformreportdata').val("");

                            // alert(data);
                            $("#stationNoManager_archivesynopticformreportdata").val(json[0].StationNumber);
                        }
                        else{

                            $('#stationNoManager_archivesynopticformreportdata').empty();
                            $('#stationNoManager_archivesynopticformreportdata').val("");

                        }
                    }

                });



            else {

                    $('#stationNoManager_archivesynopticformreportdata').empty();
                    $('#stationNoManager_archivesynopticformreportdata').val("");
                }     })

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
