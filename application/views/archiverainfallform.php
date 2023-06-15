<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//'StationNumber' => $row->StationNumber,
?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Archive Rainfall Form
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Rainfall Form</li>

        </ol>
    </section>

    
<script type ="text/javascript">

function low(){

    var lo = document.getElementById("low").style;
     lo.display="block";
      
     var pa = document.getElementById("medium").style;
      pa.display ="none";
     var se = document.getElementById("high").style;
       se.display ="none";

}

function med(){

var lo = document.getElementById("low").style;
 lo.display="none";
  
 var pa = document.getElementById("medium").style;
  pa.display ="block";
 var se = document.getElementById("high").style;
   se.display ="none";

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
                        

function hig(){

var lo = document.getElementById("low").style;
 lo.display="none";
  
 var pa = document.getElementById("medium").style;
  pa.display ="none";
 var se = document.getElementById("high").style;
   se.display ="block";

}

</script>


    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
      <?php if(is_array($archivedobservationslipformdataidvalidate) && count($archivedobservationslipformdataidvalidate)) { 
     foreach($archivedobservationslipformdataidvalidate as $observationslipformidvalidate){

        $observationslipformid = $observationslipformidvalidate->id;   
    ?>
     
    <div class="row">
    <!-- <h5>QUALITY ASSURANCE / VALIDATION</h5> -->
    <form action='<?php echo base_url(); ?>index.php/ArchiveObservationSlipFormData/UpdateArchiveObservationSlipFormData' id="regForm" method="post" enctype="multipart/form-data">
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

		<!-- Section 1 -->
			  <div class="tab"><h4>Station & CLouds Info:</h4>
			   <table id="example1" class="table table-bordered table-striped">
               <tr>
              <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
           <td colspan = "4">

             <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                    <select name="station_archiveobservationslipformdata" id="stationManager"   class="form-control" placeholder="Select Station">
                                    <option value="">Select Station</option>
                                    <?php
                                    if (is_array($stationsdata) && count($stationsdata)) {
                                        foreach($stationsdata as $station){?>
                                            <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                        <?php }
                                    } ?>
                                </select>
                                </div>
                            </div>

           </td>
            
           <td colspan = "4">

             <div class="input-group">
               <span class="input-group-addon"> Station Number</span>
			   
                <input type="text" name="stationNo"  class="form-control" id="stationNoManager" readonly class="form-control" value="<?php echo $observationslipformidvalidate->StationNumber;?>" readonly="readonly" >
            
			</div>

           </td>
         <?php } else{ ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Station Name</span>
									<input type="text" name="station" id="station"  class="form-control" value="<?php echo $observationslipformidvalidate->StationName;?>"  readonly class="form-control" >

								</div>

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo"  class="form-control" id="stationNo_archiveobservationslipformdata" readonly class="form-control" value="<?php echo $observationslipformidvalidate->StationNumber;?>" readonly="readonly" >
							</div>

						</td>
          <?php } ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Select Date</span>
									<input type="text" name="date" class="form-control" value="<?php echo $observationslipformidvalidate->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
									<input type="hidden" name="id" value="<?php echo $observationslipformidvalidate->id;?>">
								</div>

						</td>
					</tr>
					<tr>
						<td colspan = "12">
							 <div class="input-group">
								<span class="input-group-addon">TIME</span>
								 <input type="text" name="timeRecorded"  class="form-control" id="timeRecorded" readonly class="form-control" value="<?php echo $observationslipformidvalidate->TIME;?>" readonly="readonly" >
							</div>
						</td>

					</tr>
                 </table>
           




                    <table  class="table table-bordered table-striped">
					<tr>
						<td colspan="12" >
							<div class="input-group">
							<span class="input-group-addon">Rainfall(mm)</span>
							<input type="text" name="rainfall" onkeyup="validation('<?php echo $observationslipformidvalidate->Rainfall;?>',this.value,'errorrainfall');allowIntegerInputOnly(this)"  id="rainfall_archiveobservationslipformdata"   class="form-control" placeholder="Enter Rainfall(mm)" >
						</div>
                        <span id="errorrainfall"></span>
						</td>
					</tr>
				</table>

				</div>
              </div>

        </div>
	<div style="overflow:auto;">
    <div style="float:right;">

      <button type="submit"  name="postarchiveobservationslipformdata_button">Next</button>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
    </div>
    </form>
    </div>
    <?php }

    }elseif(is_array($displaynewarchiveobervationslipform) && count($displaynewarchiveobervationslipform)) {
        ?>
        <div class="row">
        <form action='<?php echo base_url(); ?>index.php/ArchiveObservationSlipFormData/insertArchiveObservationSlipFormData/' id ="regForm" method="post" enctype="multipart/form-data">
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

		<!-- Section 1 -->
			  <div class="tab"><h4>Station & CLouds Info:</h4>
			   <table id="example1" class="table table-bordered table-striped">
			   		<tr>
               <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
               	<td colspan="4">
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
						<td colspan = "4">
							<div class="input-group">

                            <span class="input-group-addon">Station Name</span>
                            <select  name="station_archiveobservationslipformdata" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select>
                        </div>

								<!-- <div class="input-group">
									<span class="input-group-addon">Station Name</span>
								<select name="station_archiveobservationslipformdata" id="stationManager"   class="form-control" placeholder="Select Station">
                      <option value="">Select Stations</option>
                      <?php
                      if (is_array($stationsdata) && count($stationsdata)) {
                          foreach($stationsdata as $station){?>
                              <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                          <?php }
                      } ?>
                  </select>
								</div> -->

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo_archiveobservationslipformdata"  class="form-control" id="stationNoManager" readonly class="form-control" value="" readonly="readonly" >
							</div>

						</td>
          <?php } else{ ?>
            <td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Station Name</span>
									<input type="text" name="station_archiveobservationslipformdata" id="stations-list"  class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

								</div>

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo_archiveobservationslipformdata"  class="form-control" id="stationNoManager" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
							</div>

						</td>
          <?php } ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Select Date</span>
									<input type="text" name="date_archiveobservationslipformdata"  class="form-control compulsory" placeholder="Enter select date" id="date">
								</div>

						</td>
					</tr>
					<tr>
						<td colspan = "4">
							 <div class="input-group">
								<span class="input-group-addon">TIME</span>
								<select name="time_archiveobservationslipformdata" id="time_archiveobservationslipformdata"  class="form-control compulsory">
									<option value="">--Select TIME Options--</option>
                                <option value="0000Z">0000Z</option>
				<option value="0030Z">0030Z</option>
                                <option value="01:00Z">0100Z</option>
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
						</td>
						
					</tr>
                    <tr>
						
						<td colspan="12">
							<div class="input-group">
							<span class="input-group-addon">Rainfall(mm)</span>
                            <input type="hidden" name="rainonly" value="true">
							<input type="text" name="rainfall_archiveobservationslipformdata" id="rainfall_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" placeholder="Enter Rainfall(mm)" >
						</div>
						</td>
					</tr>
                 </table>

                 <div style="text-align:center;">
                      <br><br><br>
                    <button type="submit"  name="postarchiveobservationslipformdata_button">Submit Form</button>
                </div>
				</div>
              </div>

        </div>
        </form>
        </div>
    <?php
    }elseif((is_array($archivedobservationslipformdataidupdate) && count($archivedobservationslipformdataidupdate))) {
        foreach($archivedobservationslipformdataidupdate as $observationslipformidupdate){

            $observationslipformid = $obervationslipformidupdate->id;
            ?>
            <div class="row">
            <form action='<?php echo base_url(); ?>index.php/ArchiveObservationSlipFormData/UpdateArchiveObservationSlipFormData' id="regForm" method="post" enctype="multipart/form-data">
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

			<!-- Section 1 -->
			  <div class="tab"><h4>Station & CLouds Info:</h4>
			   <table id="example1" class="table table-bordered table-striped">
			   		<tr>
              <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
           <td colspan = "4">

               <div class="input-group">
                 <span class="input-group-addon">Station Name</span>
               <select name="station" id="stationManager"   class="form-control" placeholder="Select Station">
                     <option value="<?php echo $observationslipformidupdate->StationName;?>"><?php echo $observationslipformidupdate->StationName;?></option>
                     <?php
                     if (is_array($stationsdata) && count($stationsdata)) {
                         foreach($stationsdata as $station){?>
                             <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                         <?php }
                     } ?>
                 </select>
               </div>

           </td>
           <td colspan = "4">

             <div class="input-group">
               <span class="input-group-addon"> Station Number</span>
                <input type="text" name="stationNo"  class="form-control" id="stationNoManager" readonly class="form-control" value="<?php echo $observationslipformidupdate->StationNumber;?>" readonly="readonly" >
            
			</div>

           </td>
         <?php } else{ ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Station Name</span>
									<input type="text" name="station" id="station"  class="form-control" value="<?php echo $observationslipformidupdate->StationName;?>"  readonly class="form-control" >

								</div>

						</td>
						<td colspan = "4">

							<div class="input-group">
								<span class="input-group-addon"> Station Number</span>
								 <input type="text" name="stationNo"  class="form-control" id="stationNo_archiveobservationslipformdata" readonly class="form-control" value="<?php echo $observationslipformidupdate->StationNumber;?>" readonly="readonly" >
							</div>

						</td>
          <?php } ?>
						<td colspan = "4">

								<div class="input-group">
									<span class="input-group-addon">Select Date</span>
									<input type="text" name="date" class="form-control" value="<?php echo $observationslipformidupdate->Date;?>" placeholder="Enter select date" id="expdate" readonly class="form-control">
									<input type="hidden" name="id" value="<?php echo $observationslipformidupdate->id;?>">
								</div>

						</td>
					</tr>
					<tr>
						<td colspan = "12">
							 <div class="input-group">
								<span class="input-group-addon">TIME</span>
								 <input type="text" name="timeRecorded"  class="form-control" id="timeRecorded" readonly class="form-control" value="<?php echo $observationslipformidupdate->TIME;?>" readonly="readonly" >
							</div>
						</td>
						
					</tr>
                    <tr>
						
						<td colspan="6">
							<div class="input-group">
							<span class="input-group-addon">Rainfall(mm)</span>
                            <input type="hidden" name="rainonly" value="true">
							<input type="text" name="rainfall" id="rainfall_archiveobservationslipformdata" onkeyup="allowIntegerInputOnly(this)"  class="form-control" value="<?php echo $observationslipformidupdate->Rainfall;?>" >
						</div>
						</td>
                        <td colspan = "6" align = "center">
							<div class="input-group">
								<span class="input-group-addon">Approved</span>
								<?php if($userrole=="DataOfficer" || $observationslipformidupdate->Approved=='TRUE'){?>
								<select name="approval" id="approval"   class="form-control" disabled>
									<option value="<?php echo $observationslipformidupdate->Approved;?>"><?php echo $observationslipformidupdate->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<input type="hidden" name="approval" value="<?php echo $observationslipformidupdate->Approved;?>">
								<?php }else{?>
								   <select name="approval" id="approval"  class="form-control" disabled>
									<option value="<?php echo $observationslipformidupdate->Approved;?>"><?php echo $observationslipformidupdate->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
                                <input type="hidden" name="approval" value="<?php echo $observationslipformidupdate->Approved;?>">
								<?php }?>
							</div>
						</td>
					</tr>
					<tr>
						
					</tr>
					
				</table>
                 
				</div>
                <div style="text-align:center;">
                <br><br>
                  <button type="Submit" name="updatearchiveobservationslipformdata_button">Submit</button>
                </div>
			  </div>
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
                                     href="<?php echo base_url()."index.php/ArchiveObservationSlipFormData/DisplayNewArchiveRainfallForm/";?>"
                    <i class="fa fa-plus"></i> Add Archive Rainfall Slip</a>



            </div>

        </div>
		<?php } ?>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> Archive Rainfall  Forms</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive" style="overflow:auto">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Station</th>
                                <th>Station No</th>
                                <th>TIME</th>
                                

                                <th>Rainfall (mm)</th>
                                
                                <th>Quality assurance</th>
                            <?php if( $userrole=='SeniorDataOfficer'  || $userrole=='DataOfficer' || $userrole=='Observer'  || $userrole=='Senior Weather Observer' || $userrole=='QC'){ ?>
                                    <th>Approved</th>
                                    <th>Submitted By</th>
                                    <th class="no-print">Action</th>
                                <?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            if (is_array($archivedobservationslipformdata) && count($archivedobservationslipformdata)) {
                                foreach($archivedobservationslipformdata as $archiveobservationslipdata){
                                    
                                    $archiveobservationslipdataid = $archiveobservationslipdata->id;
									
                                       if($userrole =='DataOfficer'&& $archivedobservationslipformdata[$count]->Approved =='TRUE' || $userrole =='Senior Weather Observer'&& $archivedobservationslipformdata[$count]->Approved =='TRUE' || $userrole =='Observer'&& $archivedobservationslipformdata[$count]->Approved =='TRUE'){
									   $count++;
									   }else{
										   $count++;
                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $archiveobservationslipdata->Date;?></td>
                                        <td ><?php echo $archiveobservationslipdata->StationName;?></td>
                                        <td ><?php echo $archiveobservationslipdata->StationNumber;?></td>
                                        <td ><?php echo $archiveobservationslipdata->TIME;?></td>
                                        
                                        <td><?php echo $archiveobservationslipdata->Rainfall;?></td>

                                        <td><?php echo ($archiveobservationslipdata->qaBy==NULL)?"Pending":$archiveobservationslipdata->qaBy; ?></td>
								   <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer' || $userrole=='Observer' || $userrole=='Senior Weather Observer'|| $userrole=='QC' ){ ?>
                                     <td><?php echo $archiveobservationslipdata->Approved;?></td>

                                     <td><?php echo $archiveobservationslipdata->AO_SubmittedBy;?></td>
                                     <td class="no-print">
									    <table>
                                         <tr><td>
                                            <?php  if($userrole=='QC'){?>
												<?php if($archiveobservationslipdata->qaBy==NULL){?>
                                                    <a class="btn btn-primary btn-xs" href="<?php echo base_url()."index.php/ArchiveObservationSlipFormData/DisplayArchiveObservationSlipFormForValidation/" .$archiveobservationslipdataid; ?>" style="cursor:pointer;"><li class="fa fa-edit"></li> Verify</a>
												<?php }else{ ?>
                                                    <!-- <a class="btn btn-danger btn-xs" href="<?php // echo base_url()."index.php/ReportsController/ReverseVerification/1/" .$archiveobservationslipdataid; ?>" style="cursor:pointer;"><li class="fa fa-undo"></li> Reverse Verification</a> -->

													<a class="btn btn-success btn-xs" href="" disabled><li class="fa fa-check"></li> Verified </a>
												<?php } ?>
											
										 <?php }else{ ?>
                                            <a class="btn btn-primary btn-xs" href="<?php echo base_url()."index.php/ArchiveObservationSlipFormData/DisplayArchiveRainfallFormForUpdate/" .$archiveobservationslipdataid; ?>" style="cursor:pointer;"><li class="fa fa-edit"></li> Edit</a>
										 <?php } ?>
                                            </td>
                                            <?php if( $userrole=='Senior Weather Observer' && $archiveobservationslipdata->Approved=="TRUE" || $userrole== 'SeniorDataOfficer' && $archiveobservationslipdata->Approved=="TRUE" ){?>
                                        							<td><form method="post" action="<?php echo base_url() . "index.php/ArchiveObservationSlipFormData/update_approval/"  .$archiveobservationslipdataid;?>"> <input type="hidden" name="id" value="<?php echo $archiveobservationslipdataid; ?>" ><input type="hidden" name="approve" value="FALSE" ><button class="btn btn-danger"  type="submit"  ><li class='fa fa-times'></li> Disapprove</button></form>
                                        								</td> <?php }elseif( $userrole=='Senior Weather Observer' && $archiveobservationslipdata->Approved=="FALSE" || $userrole =='SeniorDataOfficer' && $archiveobservationslipdata->Approved=="FALSE"){?>
                                        									<td><form method="post" action="<?php echo base_url() . "index.php/ArchiveObservationSlipFormData/update_approval/" .$archiveobservationslipdataid;?>"> <input type="hidden" name="id" value="<?php echo $archiveobservationslipdataid; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success btn-xs"  type="submit"  ><li class='fa fa-check'></li> Approve &nbsp;&nbsp;&nbsp;&nbsp;</button></form>
                                        									</td>

                                        									<?php
                                        								}else{ }?> 
											<!-- <?php if($userrole=='SeniorDataOfficer' || $userrole== "Senior Weather Observer"){?>
											<td>
											
											<form method="post" action="<?php echo base_url() . "index.php/ArchiveObservationSlipFormData/update_approval/" .$archiveobservationslipdataid;?>"> <input type="hidden" name="id" value="<?php echo $archiveobservationslipdataid; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($archiveobservationslipdata->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
											</td><?php }?> --> 
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
                        <br><br>
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
            $('#postarchiveobservationslipformdata_button').click(function(event) {
                //Check for duplicate Entry Data when adding new archive metar form.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveObservationSlipFormData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("An Archived Observation Slip Record With the date,station,station Number and Time exists already in the db");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number not picked");
                    return false;
                }


                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield").focus();
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
                var station=$('#station_archiveobservationslipformdata').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#station_archiveobservationslipformdata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_archiveobservationslipformdata').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#stationNo_archiveobservationslipformdata").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////////////////
                //Check that the TIME is selected from the list of TIME for the METAR
                var time_archiveobservationslipform=$('#time_archiveobservationslipformdata').val();
                if(time_archiveobservationslipform==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Observation Slip not picked");
                    $('#time_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#time_archiveobservationslipformdata").focus();
                    return false;

                }


///////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////////////////////////////////////////////
                var maxRead_archiveobservationslipformdata=$('#maxRead_archiveobservationslipformdata').val();
                if(maxRead_archiveobservationslipformdata > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxRead Temperature can't go beyond 42 degrees");
                    $('#maxRead_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#maxRead_archiveobservationslipformdata").focus();
                    return false;

                }
                var maxReset_archiveobservationslipformdata=$('#maxReset_archiveobservationslipformdata').val();
                if(maxReset_archiveobservationslipformdata > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxReset Temperature can't go beyond 42 degrees");
                    $('#maxReset_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#maxReset_archiveobservationslipformdata").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var minRead_archiveobservationslipformdata=$('#minRead_archiveobservationslipformdata').val();
                if(minRead_archiveobservationslipformdata > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinRead Temperature can't go beyond 42 degrees");
                    $('#minRead_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#minRead_archiveobservationslipformdata").focus();
                    return false;

                }
                var minReset_archiveobservationslipformdata=$('#minReset_archiveobservationslipformdata').val();
                if(minReset_archiveobservationslipformdata > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinReset Temperature can't go beyond 42 degrees");
                    $('#minReset_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#minReset_archiveobservationslipformdata").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var winddirection_archiveobservationslipformdata=$('#winddirection_archiveobservationslipformdata').val();
                if((winddirection_archiveobservationslipformdata > 360) || (winddirection_archiveobservationslipformdata < 000) ){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Direction should be between 000 to 360");
                    $('#winddirection_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#winddirection_archiveobservationslipformdata").focus();
                    return false;

                }
                var windspeed_archiveobservationslipformdata=$('#windspeed_archiveobservationslipformdata').val();
                if(windspeed_archiveobservationslipformdata < 000){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Speed can't go beyond 000");
                    $('#windspeed_archiveobservationslipformdata').val("");  //Clear the field.
                    $("#windspeed_archiveobservationslipformdata").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE METAR ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveObservationSlipFormData(){

            //Check against the dManagertationName,StatioManagerer,Time
            var date= $('#date').val();
            var stationName = $('#stations-list').val();
            var stationNumber = $('#stationNoManager').val();
            var time_OfObservationSlipForm = $('#time_archiveobservationslipformdata').val();


            $('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').val("");

            if ((date != undefined) && (time_OfObservationSlipForm != undefined) && (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveObservationSlipFormData/checkInDBIfArchiveObservationSlipFormDataRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'time_OfObservationSlipForm':time_OfObservationSlipForm,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchiveObservationSlipFormData_hiddentextfield").val();

            }//end of if

            else if((date == undefined)  ||(time_OfObservationSlipForm == undefined)|| (stationName == undefined) || (stationNumber == undefined)  ){

                var truthvalue="Missing";
            }




            return truthvalue;


        }//end of check duplicate values in the DB


    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive metar form data into the DB When the fields are not picked frm the DB
            //Validate each field before inserting into the DB
            $('#updatearchiveobservationslipformdata_button').click(function(event) {
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
                var timeRecorded=$('#timeRecorded').val();
                if(timeRecorded==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Observation Slip not picked");
                    $('#timeRecorded').val("");  //Clear the field.
                    $("#timeRecorded").focus();
                    return false;

                }


///////////////////////////////////////////////////////////////////////////////////
                //Check that REWIW1 IS PICKED FROM A LIST
                var approval=$('#approval').val();
                if(approval==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select approval from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
                    return false;

                }
///////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////////////////////////////////////////////
                var maxRead=$('#maxRead').val();
                if(maxRead > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxRead Temperature can't go beyond 42 degrees");
                    $('#maxRead').val("");  //Clear the field.
                    $("#maxRead").focus();
                    return false;

                }
                var maxReset=$('#maxReset').val();
                if(maxReset > 42){  // returns true if the variable does NOT contain a valid number
                    alert("Please MaxReset Temperature can't go beyond 42 degrees");
                    $('#maxReset').val("");  //Clear the field.
                    $("#maxReset").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var minRead=$('#minRead').val();
                if(minRead > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinRead Temperature can't go beyond 42 degrees");
                    $('#minRead').val("");  //Clear the field.
                    $("#minRead").focus();
                    return false;

                }
                var minReset=$('#minReset').val();
                if(minReset > 23){  // returns true if the variable does NOT contain a valid number
                    alert("Please MinReset Temperature can't go beyond 42 degrees");
                    $('#minReset').val("");  //Clear the field.
                    $("#minReset").focus();
                    return false;

                }
//////////////////////////////////////////////////////////////////////
                var winddirection=$('#winddirection').val();
                if((winddirection > 360) || (winddirection < 000) ){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Direction should be between 000 to 360");
                    $('#winddirection').val("");  //Clear the field.
                    $("#winddirection").focus();
                    return false;

                }
                var windspeed=$('#windspeed').val();
                if(minReset < 000){  // returns true if the variable does NOT contain a valid number
                    alert("Please Wind Speed can't go beyond 000");
                    $('#windspeed').val("");  //Clear the field.
                    $("#windspeed").focus();
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
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_totalamountofallclouds;
            var oldValue_totalamountofallclouds=$('#totalamountofallclouds').val();

            $('#totalamountofallclouds').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_totalamountofallclouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#totalamountofallclouds').val(newValue_totalamountofallclouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#totalamountofallclouds').val(oldValue_totalamountofallclouds);
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
            var newValue_totalamountoflowclouds;
            var oldValue_totalamountoflowclouds=$('#totalamountoflowclouds').val();

            $('#totalamountoflowclouds').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_totalamountoflowclouds = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#totalamountoflowclouds').val(newValue_totalamountoflowclouds);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#totalamountoflowclouds').val(oldValue_totalamountoflowclouds);
                    return false;
                }

            });
        });
    </script>


    <script>
        $(document).ready(function(){
            var newValue_HeightOfLowClouds1 ;
            var oldValue_HeightOfLowClouds1= $('#HeightOfLowClouds1').val();

            $('#HeightOfLowClouds1').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfLowClouds1 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfLowClouds1').val(newValue_HeightOfLowClouds1);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfLowClouds1').val(oldValue_HeightOfLowClouds1);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_HeightOfLowClouds2 ;
            var oldValue_HeightOfLowClouds2= $('#HeightOfLowClouds2').val();

            $('#HeightOfLowClouds2').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfLowClouds2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfLowClouds2').val(newValue_HeightOfLowClouds2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfLowClouds2').val(oldValue_HeightOfLowClouds2);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_HeightOfLowClouds3 ;
            var oldValue_HeightOfLowClouds3= $('#HeightOfLowClouds3').val();

            $('#HeightOfLowClouds3').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfLowClouds3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfLowClouds3').val(newValue_HeightOfLowClouds3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfLowClouds3').val(oldValue_HeightOfLowClouds3);
                    return false;
                }
            });
        });
    </script>


    <script>
        $(document).ready(function(){
            var newValue_HeightOfMeduimClouds1 ;
            var oldValue_HeightOfMeduimClouds1= $('#HeightOfMeduimClouds1').val();

            $('#HeightOfMeduimClouds1').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfMeduimClouds1 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfMeduimClouds1').val(newValue_HeightOfMeduimClouds1);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfMeduimClouds1').val(oldValue_HeightOfMeduimClouds1);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_HeightOfMeduimClouds2 ;
            var oldValue_HeightOfMeduimClouds2= $('#HeightOfMeduimClouds2').val();

            $('#HeightOfMeduimClouds2').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfMeduimClouds2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfMeduimClouds2').val(newValue_HeightOfMeduimClouds2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfMeduimClouds2').val(oldValue_HeightOfMeduimClouds2);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_HeightOfMeduimClouds3 ;
            var oldValue_HeightOfMeduimClouds3= $('#HeightOfMeduimClouds3').val();

            $('#HeightOfMeduimClouds3').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfMeduimClouds3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfMeduimClouds3').val(newValue_HeightOfMeduimClouds3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfMeduimClouds3').val(oldValue_HeightOfMeduimClouds3);
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            var newValue_HeightOfHighClouds1 ;
            var oldValue_HeightOfHighClouds1= $('#HeightOfHighClouds1').val();

            $('#HeightOfHighClouds1').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfHighClouds1 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfHighClouds1').val(newValue_HeightOfHighClouds1);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfHighClouds1').val(oldValue_HeightOfHighClouds1);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_HeightOfHighClouds2 ;
            var oldValue_HeightOfHighClouds2= $('#HeightOfHighClouds2').val();

            $('#HeightOfHighClouds2').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfHighClouds2 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfHighClouds2').val(newValue_HeightOfHighClouds2);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfHighClouds2').val(oldValue_HeightOfHighClouds2);
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var newValue_HeightOfHighClouds3 ;
            var oldValue_HeightOfHighClouds3= $('#HeightOfHighClouds3').val();

            $('#HeightOfHighClouds3').live('change paste', function(){
                //oldValue_dddfffmfm = newValue_dddfffmfm;
                newValue_HeightOfHighClouds3 = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#HeightOfHighClouds3').val(newValue_HeightOfHighClouds3);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#HeightOfHighClouds3').val(oldValue_HeightOfHighClouds3);
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
            var newValue_cloudsearchlight;
            var oldValue_cloudsearchlight= $('#cloudsearchlight').val();

            $('#cloudsearchlight').live('change paste', function(){
                // oldValue_wwcovak = newValue_dddfffmfm;
                newValue_cloudsearchlight = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#cloudsearchlight').val(newValue_cloudsearchlight);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#cloudsearchlight').val(oldValue_cloudsearchlight);
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
            var newValue_rainfall;
            var oldValue_rainfall= $('#rainfall').val();

            $('#rainfall').live('change paste', function(){
                //oldValue_ncc = newValue_ncc;
                newValue_rainfall = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rainfall').val(newValue_rainfall);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#rainfall').val(oldValue_rainfall);
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
            var newValue_drybulb;
            var oldValue_drybulb= $('#drybulb').val();

            $('#drybulb').live('change paste', function(){
                //oldValue_airtemperature = newValue_airtemperature;
                newValue_drybulb = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#drybulb').val(newValue_drybulb);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#drybulb').val(oldValue_drybulb);
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
            var newValue_wetbulb;
            var oldValue_wetbulb= $('#wetbulb').val();

            $('#wetbulb').live('change paste', function(){
                oldValue_wetbulb = newValue_wetbulb;
                newValue_wetbulb = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#wetbulb').val(newValue_wetbulb);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#wetbulb').val(oldValue_wetbulb);
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
            var newValue_maxRead;
            var oldValue_maxRead= $('#maxRead').val();

            $('#maxRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_maxRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxRead').val(newValue_maxRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxRead').val(oldValue_maxRead);
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
            var newValue_maxReset;
            var oldValue_maxReset= $('#maxReset').val();

            $('#maxReser').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_maxReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#maxReset').val(newValue_maxReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#maxReset').val(oldValue_maxReset);
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
            var newValue_minRead;
            var oldValue_minRead= $('#minRead').val();

            $('#minRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_minRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#minRead').val(newValue_minRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#minRead').val(oldValue_minRead);
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
            var newValue_minReset;
            var oldValue_minReset= $('#minReset').val();

            $('#minReset').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_minReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#minReset').val(newValue_minReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#minReset').val(oldValue_minReset);
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
            var newValue_picheRead;
            var oldValue_picheRead= $('#picheRead').val();

            $('#picheRead').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_picheRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#picheRead').val(newValue_picheRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#picheRead').val(oldValue_picheRead);
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
            var newValue_picheReset;
            var oldValue_picheReset= $('#picheReset').val();

            $('#picheReset').live('change paste', function(){
                //oldValue_qnhhpa = newValue_qnhhpa;
                newValue_picheReset = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#picheReset').val(newValue_picheReset);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#picheReset').val(oldValue_picheReset);
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
            var newValue_timemarksThermo;
            var oldValue_timemarksThermo= $('#timemarksThermo').val();

            $('#timemarksThermo').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksThermo = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksThermo').val(newValue_timemarksThermo);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksThermo').val(oldValue_timemarksThermo);
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
            var newValue_timemarksHygro;
            var oldValue_timemarksHygro= $('#timemarksHygro').val();

            $('#timemarksHygro').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksHygro = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksHygro').val(newValue_timemarksHygro);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksHygro').val(oldValue_timemarksHygro);
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
            var newValue_timemarksRainRec;
            var oldValue_timemarksRainRec= $('#timemarksRainRec').val();

            $('#timemarksRainRec').live('change paste', function(){
                // oldValue_qfehpa = newValue_qfehpa;
                newValue_timemarksRainRec = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timemarksRainRec').val(newValue_timemarksRainRec);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timemarksRainRec').val(oldValue_timemarksRainRec);
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
            var newValue_visibility;
            var oldValue_visibility= $('#visibility').val();

            $('#visibility').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_visibility = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#visibility').val(newValue_visibility);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#visibility').val(oldValue_visibility);
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
            var newValue_winddirection;
            var oldValue_winddirection= $('#winddirection').val();

            $('#winddirection').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_winddirection = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#winddirection').val(newValue_winddirection);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#winddirection').val(oldValue_winddirection);
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
            var newValue_windspeed;
            var oldValue_windspeed= $('#windspeed').val();

            $('#windspeed').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_windspeed = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#windspeed').val(newValue_windspeed);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#windspeed').val(oldValue_windspeed);
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
            var newValue_gusting;
            var oldValue_gusting= $('#gusting').val();

            $('#gusting').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_gusting = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#gusting').val(newValue_gusting);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#gusting').val(oldValue_gusting);
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
            var newValue_attdThermo;
            var oldValue_attdThermo= $('#attdThermo').val();

            $('#attdThermo').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_attdThermo = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#attdThermo').val(newValue_attdThermo);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#attdThermo').val(oldValue_attdThermo);
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
            var newValue_prAsRead;
            var oldValue_prAsRead= $('#prAsRead').val();

            $('#prAsRead').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_prAsRead = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#prAsRead').val(newValue_prAsRead);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#prAsRead').val(oldValue_prAsRead);
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
            var newValue_correction;
            var oldValue_correction= $('#correction').val();

            $('#correction').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_correction = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#correction').val(newValue_correction);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#correction').val(oldValue_correction);
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
            var newValue_CLP;
            var oldValue_CLP= $('#CLP').val();

            $('#CLP').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_CLP = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#CLP').val(newValue_CLP);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#CLP').val(oldValue_CLP);
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
            var newValue_MSLPR;
            var oldValue_MSLPR= $('#MSLPR').val();

            $('#MSLPR').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_MSLPR = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#MSLPR').val(newValue_MSLPR);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#MSLPR').val(oldValue_MSLPR);
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
            var newValue_timeMarksBarograph;
            var oldValue_timeMarksBarograph= $('#timeMarksBarograph').val();

            $('#timeMarksBarograph').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_timeMarksBarograph = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timeMarksBarograph').val(newValue_timeMarksBarograph);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timeMarksBarograph').val(oldValue_timeMarksBarograph);
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
            var newValue_timeMarksAnemograph;
            var oldValue_timeMarksAnemograph= $('#timeMarksAnemograph').val();

            $('#timeMarksAnemograph').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_timeMarksAnemograph = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#timeMarksAnemograph').val(newValue_timeMarksAnemograph);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#timeMarksAnemograph').val(oldValue_timeMarksAnemograph);
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
            var newValue_otherTMarks;
            var oldValue_otherTMarks= $('#otherTMarks').val();

            $('#otherTMarks').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_otherTMarks = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#otherTMarks').val(newValue_otherTMarks);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#otherTMarks').val(oldValue_otherTMarks);
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
            var newValue_remarks;
            var oldValue_remarks= $('#remarks').val();

            $('#remarks').live('change paste', function(){
                //oldValue_qfein = newValue_qfein;
                newValue_remarks = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#remarks').val(newValue_remarks);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#remarks').val(oldValue_remarks);
                    return false;
                }
            });
            );
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

              var o = new Option("option text",stn);
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

            success:function(data){
                var id = JSON.parse(data);
                $('#station-id').val(id.toString());
                 $('#stationNoManager').val(id.toString());
                  $('#stationNoOC').val(id.toString());
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

        success:function(data){
            var id = JSON.parse(data);
            if(id){
               $('#station-id').val(id.toString()); 
                $('#stationNoManager').val(id.toString());
                  $('#stationNoOC').val(id.toString());
            }
            
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
