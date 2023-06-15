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
            Archive Scanned Observation Slip Form Copy
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Scanned Observation Slip Form Copy</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewFormToArchiveScannedObservationSlipFormDetails) && count($displaynewFormToArchiveScannedObservationSlipFormDetails)) {
        ?>
        <div class="row col-lg-8">
            <form action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/insertInformationForArchiveScannedObservationSlipFormDetails/"  method="post" enctype="multipart/form-data">
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
                    <?php if(isset($record_id)) echo $record_id; ?>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Form</span>
                                <input type="text" name="formname_observationslipform" id="formname_observationslipform" readonly="readonly" required class="form-control" value="<?php echo 'observationslip';?>"  readonly class="form-control" >
                                <input type="hidden" name="checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield" id="checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield">

                            </div>
                        </div>

<!-- 
                            <div class="form-group">
                                <?php if($userrole =="DataOfficer" || $userrole== "SeniorDataOfficer") {?>
                                <div class="input-group">
                                    <span class="input-group-addon">Station</span>
                                     <select name="station_ArchiveScannedObservationSlipForm" id="stationManager"   class="form-control" placeholder="Select Station">
                                    <option value="">Select Station</option>
                                    <?php
                                    if (is_array($stationsdata) && count($stationsdata)) {
                                        foreach($stationsdata as $station){?>
                                            <option value="<?php echo $station->StationName;?>"><?php echo $station->StationName;?></option>

                                        <?php }
                                    } ?>
                                </select>

                                </div> 
                            <?php } else if($userrole== "Observer") {?>

                                <div class="input-group">
                                    <span class="input-group-addon">Station Name</span>
                                    <input type="text" name="station_observationslipform" id="station_observationslipform" required class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                </div>
                            <?php }?>

                            </div>



                        <div class="form-group">
                            <?php if ($userrole == "DataOfficer" || $userrole == "SeniorDataOfficer") {?>
                            <div class="input-group">
                                <span class="input-group-addon"> Station Number</span>
                                <input type="text" name="stationNo_ArchiveScannedObservationSlipForm"  id="stationNoManager" required class="form-control" value=""  readonly   > -->
<!-- 
                                <input type="text" name="stationNo_ArchiveScannedObservationSlipForm" required class="form-control" id="stationNo_ArchiveScannedObservationSlipForm" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                            </div> 
                        <?php } else if($userrole=="Observer") {?>
                            <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>
                                    <input type="text" name="stationNo_observationslipform" id="stationNo_observationslipform" required class="form-control"  readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                                </div>
                        </div>
                    <?php }?> -->

                     <?php if($userrole=='SeniorDataOfficer' || $userrole=='DataOfficer'){ ?>
                        <td colspan="4">
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
                        <td colspan = "4">

                               <div class="form-group">
                            <div class="input-group">

                            <span class="input-group-addon">Station Name</span>
                            <select  name="station_ArchiveScannedObservationSlipForm" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select>
                        </div>
                        </div>

                        </td> 
                        <td colspan = "4">

                            <div class="input-group">
                                <span class="input-group-addon"> Station Number</span>
                                 <input type="text" name="stationNo_ArchiveScannedObservationSlipForm"  class="form-control" id="stationNoManager" readonly class="form-control" value="" readonly="readonly" >
                            </div>

                        </td>
          <?php } else{ ?>
            <td colspan = "4">

                                <div class="input-group">
                                    <span class="input-group-addon">Station Name</span>
                                    <input type="text" name="station_ArchiveScannedObservationSlipForm" id="station_ArchiveScannedObservationSlipFormdata"  class="form-control" value="<?php echo $userstation;?>"  readonly class="form-control" >

                                </div>

                        </td><br>
                        <td colspan = "4">

                            <div class="input-group">
                                <span class="input-group-addon"> Station Number</span>
                                 <input type="text" name="stationNo_ArchiveScannedObservationSlipForm"  class="form-control" id="stationNo_ArchiveScannedObservationSlipForm" readonly class="form-control" value="<?php echo $userstationNo;?>" readonly="readonly" >
                            </div>

                        </td>
          <?php } ?>
                    <br>

                        <div class="form-group">
                            <!-- <div class="input-group">
                                <span class="input-group-addon"> TIME</span>
                                <input type="text" name="time_ArchiveScannedObservationSlipForm" id="time_ArchiveScannedObservationSlipForm" required class="form-control">
                             </div> -->
                             <div class="input-group" id="metartimeId"  >
                                    <span class="input-group-addon">TIME</span>
                                    <select name="time_ArchiveScannedObservationSlipForm"  id="time_ArchiveScannedObservationSlipForm" required class="form-control compulsory">
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

                    <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Date</span>
                                <input type="text" name="dateOnScannedObservationSlipForm_observationslipform" id="date" required class="form-control"  placeholder="Enter To the Date">

                            </div>
                        </div>
                          <br>
                        <!-- <div class="form-group">
                            <span class="input-group-addon">Description</span>
                            <textarea name="description_observationslipform" class="form-control" onkeyup="" style="height:40px;" id="description_observationslipform"></textarea>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">  Select file to upload:</span>
                                <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls" name="archievescannedcopy_observationslipform[]" id="archievescannedcopy_observationslipform" required class="form-control" size = "40" multiple="true">
                            
                            </div>

                            <p class="help-block">Lighter file is better</p>
                        </div> -->
                        <script type="text/javascript">
                            function readURL(input) {

                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#archievescannedcopy_observationslipform').val(e.target.result);
                                    }

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }

                            $("#archievescannedcopy_observationslipform").change(function(){
                                readURL(this);
                            });
                        </script>


                    </div>
                </div>
                <div class="modal-footer clearfix"></div>
                <div class="clearfix"></div>
          </div>
         <center>
            <a href="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK </a>
            <button type="submit"  name="postScannedObservationSlipFormCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> NEXT</button>
         </center>
        </form>
        </div>
    <?php
    }elseif((is_array($scannedobservationslipformcopyidDetails) && count($scannedobservationslipformcopyidDetails))) {
        foreach($scannedobservationslipformcopyidDetails as $idDetails){

            $scannedformid = $idDetails->id;
            ?>
            <div class="row">
                
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
                        <div class="col-lg-5">
                        <form action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/updateInformationForArchiveScannedObservationSlipFormDetails" method="post" enctype="multipart/form-data">
                        <br><br>
                        <h3 class='text-center'>SCANNED RECORD DETAILS</h3>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station Name</span>
                                        <input type="text" name="station" id="station" required class="form-control" value="<?php echo $idDetails->StationName;?>"  readonly class="form-control" >
                                        <input type="hidden" name="id" id="id" required class="form-control" value="<?php echo $idDetails->id;?>"  readonly class="form-control" >

                                    </div>
                                </div>
                                <br>



                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="hidden" name="stationId" required class="form-control" id="stationId" readonly class="form-control" value="<?php echo $idDetails->station;?>" readonly="readonly" >
                                        <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $idDetails->StationNumber;?>" readonly="readonly" >
                                    </div>
                                </div>
                              <br>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> TIME</span>
                                    <!-- <input type="text" name="timeRecorded" required class="form-control" id="timeRecorded"  class="form-control" value="<?php echo $idDetails->TIME;?>"  > -->
                                     <select name="timeRecorded" <?php if($userrole=="SeniorDataOfficer") echo 'readonly'; ?>  id="timeRecorded" required class="form-control compulsory">
                                 <option  value="<?php echo $idDetails->TIME;?>"><?php echo $idDetails->TIME;?></option>
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

                           <br>




                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Date</span>
                                    <input type="text" <?php if($userrole=="SeniorDataOfficer") echo 'readonly'; ?> name="dateOnScannedObservationSlipForm" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->form_date;?>" id="expdate" class="form-control">
                                </div>
                            </div>

                             <?php if ($userrole == 'SeniorDataOfficer'){ ?>
                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Add Comment</span>
                                            <textarea name="comment"  class="form-control" style="height:40px;" placeholder="Enter comment to send to data officer">  </textarea>
                                        </div>
                                        <!-- <span id="errorrainfall"></span> -->
                                    </div>
                                <?php }?>

<!-- 
                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="description" onkeyup="" class="form-control" style="height:40px;" id="description">  <?php echo $idDetails->Description;?>    </textarea>

                            </div> -->



                            <!-- <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">  Select file to upload:</span>
                                    
                                    <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls"  value="<?php echo $idDetails->Description;?>" name="updatearchievescannedcopy_observationslipform[]" id="updatearchievescannedcopy_observationslipform"  class="form-control" size = "40" multple="true">
                                    
                                </div>

                                <p class="help-block">Lighter file is better</p>
                            </div> -->
                            <script type="text/javascript">

                                function readURL(input) {

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            $('#updatearchievescannedcopy_observationslipform').val(e.target.result);
                                        }

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }

                                $("#updatearchievescannedcopy_observationslipform").change(function(){
                                    readURL(this);
                                });
                            </script>

                            <!-- <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class = 'pull-left'>Previously Uploaded File</i>

                                    <a href="<?php echo base_url(); ?>index.php/SearchArchivedScannedObservationSlipFormDataCopy/ViewImageFromBrowser/<?php echo $idDetails->FileRef;?>" target = "blank"><?php echo $idDetails->FileRef;?></a>
                                    </span>
                                    
                                     <input type="hidden" name="PreviouslyUploadedFileName_observationSlipForm" id="PreviouslyUploadedFileName_observationSlipForm" required class="form-control"  value="<?php echo $idDetails->FileRef;?>"  readonly="readonly" readonly class="form-control">

                                </div>
                            </div> -->
                             <br>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Approved</span>
                                     
                                        <?php if($userrole=="DataOfficer" || $idDetails->Approved=='TRUE'){?>
                                <select name="approval" id="approval" disabled  class="form-control" >
                                    <option value="<?php echo $idDetails->Approved;?>"><?php echo $idDetails->Approved;?></option>
                                    <option value="TRUE">TRUE</option>
                                    <option value="FALSE">FALSE</option>
                                </select>
                                <input type="hidden" name="approval" value="<?php echo $idDetails->Approved;?>">
                                <?php }else{?>
                                   <select name="approval" id="approval" class="form-control" >
                                    <option value="<?php echo $idDetails->Approved;?>"><?php echo $idDetails->Approved;?></option>
                                    <option value="TRUE">TRUE</option>
                                    <option value="FALSE">FALSE</option>
                                </select>
                                <?php }?>
                                </div>
                            </div>
                            <?php if(strcmp($idDetails->Approved,"FALSE")==0){?>
                            <center>

                        <a  href="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                        <button type="submit" name="updateScannedObservationSlipFormCopy_button" id="updateScannedObservationSlipFormCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE </button>
                        </center>
                        <?php } ?>
                        </form>
                        </div>
                        <div class="col-lg-7">
                    
                        <div class="row" style="margin-top:30px;">
                    <?php if($already_uploaded->num_rows()>0){
                    echo "<h3 class='text-center'>UPLOADED FILES</h3><table  class='table table-striped table-bordered'>";
                    echo '<tr>
                      <td>#</td>
                      <td>FILE</td>
                      <td>DESCRIPTION</td>
                      <td>REMOVE</td>
                    </tr>';
                    $i=1;
                    foreach($already_uploaded->result() as $row){ ?>
                    <tr>
                      <td><h5><?php echo $i;?></h5></td>
                      <td>
                      <?php echo $row->file;?>
                      </td>
                          
                       
                      <td> 
                           <?php echo $row->description;?>
                        </td>
                      <td>
                      <form action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/removearchievescannedfile/"  method="post" enctype="multipart/form-data">
                      <center>
                       <input type="hidden" name="record_id" value="<?php echo $row->id;?>">
                       <input type="hidden" name="record_identity" value="<?php echo $record_id;?>">
                       <?php if(strcmp($idDetails->Approved,"FALSE")==0){?>
                        <button type="submit" <?php if($userrole=="SeniorDataOfficer") echo 'disabled'; ?>  name="postScannedObservationSlipFormCopy_button" class="btn btn-danger btn-xs pull-right"><i class="fa fa-times"> </i> Remove</button>
                       <?php } ?>
                        </center>
                      </form>
                    </td>
                    </tr>
                    <?php 
                    $i++;
                    }
                    echo "</table>";
                  } 
                ?>
                   
             </div>
             <?php if(strcmp($idDetails->Approved,"FALSE")==0){?>
             <form action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/insertInformationForArchiveScannedObservationSlipFormFiles/"  method="post" enctype="multipart/form-data">
                    <div class="row" >
                    
                      
                      <div class="form-group">
                           
                                <h4 class="text-center">ADD MORE FILES:</h4>
                                <input type="hidden"  name="record" value="<?php echo $record_id ?>"/>
                                <input type="hidden"  name="file_type" value="scannedObservationslip"/>
                                <input style="width:100%;" <?php if($userrole=="SeniorDataOfficer") echo 'disabled'; ?> type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls" name="archievescannedcopy_observationslipform" id="archievescannedcopy_observationslipform" required class="form-control">
                          
                        </div>
                       
                      <div class="form-group">
                            <span ><h4>File description</h4></span>
                            <textarea name="description" <?php if($userrole=="SeniorDataOfficer") echo 'disabled'; ?> class="form-control" onkeyup=""  rows="2" id="description_observationslipform"></textarea>
                        </div>
                       
                     
                      <center>
                        <button type="submit" <?php if($userrole=="SeniorDataOfficer") echo 'disabled'; ?>  name="postScannedObservationSlipFormCopy_button" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> SUBMIT FILE </button>
                    </center>
                       
                    </div>
                    <?php } ?>




                
                 </div>
                    </div>
                    <div class="modal-footer clearfix"></div>
                    <div class="clearfix"></div>
            </div>
            
            </div>
        <?php
        }
    }else{
        ?>
        <div class="row">
            <div class="col-xs-3"><a class="btn btn-primary no-print"
                                     href="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/DisplayFormToArchiveScannedObservationSlipFormDetails/">
                    <i class="fa fa-plus"></i> Add new Scanned Observation Slip Form</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Scanned Observation Slip Form Details</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Station Name</th>
                                <th>Station Number</th>
                                <th>Date</th>
                                <th>TIME</th>
                                <th  class="text-center">File Name and Description</th>
                                <th>Approved</th>
                                <th>Submitted By</th>
                               <!--  <th>The Comment</th> -->
                                 <th>Comments</th>
                            <?php if($userrole=="DataOfficer" ||$userrole=="Senior Weather Observer"|| $userrole=="Observer"||$userrole=="Observer"||$userrole=='SeniorDataOfficer' ){ ?>
                                    <th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($archivedscannedobservationslipformcopydetails) && count($archivedscannedobservationslipformcopydetails)) {
                                foreach($archivedscannedobservationslipformcopydetails as $data){
                                    
                                    $scannedobservationslipformdatadetails = $data->id;
                                     if($userrole =='DataOfficer' && $data->Approved =='TRUE' || $userrole =='Senior Weather Observer' && $data->Approved =='TRUE' || $userrole =='Observer' && $data->Approved =='TRUE' ){
                                       $count++;
                                       }else{
                                           $count++;

                                    ?>
                                     <?php if($uploaded_files->num_rows()>0){
                                        $no_files=0;
                                        foreach($uploaded_files->result() as $row){ 
                                        if(strcmp($data->record_id,$row->record_id)==0){
                                         $no_files++;
                                        }
                                        }
                                    }   
                                        
                                        ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td><?php echo $data->StationName;?></td>
                                        <td ><?php echo $data->StationNumber;?></td>
                                        <td ><?php echo $data->form_date;?></td>
                                        <td ><?php echo $data->TIME;?></td>
                                        <td class="no-print" style="padding:0px;">
                                        <table class="table table-condensed" style="background-color:<?php echo ($count%2==0)?"white":"whitesmoke"?>;">
                                       
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
                                        <?php 
                                          $files=explode(",",$data->FileRef);
                                          $total=count($files);
                                          
                                          for($i=0;$i<$total;$i++){
                        
                                        ?>
                                        
                                           <!-- <a  style="line-height:40px;" title="click to view file" href="<?php echo base_url(); ?>index.php/SearchArchivedScannedObservationSlipFormDataCopy/ViewImageFromBrowser/<?php echo $files[$i]; ?>"><?php echo $files[$i];?></a><br>  -->
                                           <!--  <?php echo $data->FileRef;?>-->

                                        
                                        <?php } ?>
                                        </td>
                                        
                                        <td ><?php echo $data->Approved;?></td>
                                        <td><?php echo $data->SD_SubmittedBy;?></td>
                                        <!-- <td><?php echo $data->comment?></td> -->
                                         <td class="no-print"> 

                                                <?php if($data->Approved=="FALSE" || $userrole!='DataOfficer'){ ?>
                                                  <h6><?php echo $data->numberofcomments; ?> comments on this record</h6>
                                                  <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/index/<?php echo $data->id ?>/">View/ Add Comments</a> <br><br>
                                                <?php }else{ ?> 
                                                <h6 style="color:green;"> <li class='fa fa-check'></li> Record approved</h6>
                                                <?php }?>
                                                </td>
                                   <?php if($userrole=="DataOfficer"||$userrole=="Senior Weather Observer"|| $userrole=="Observer"||$userrole=='SeniorDataOfficer' ){ ?>
                                     <td class="no-print">

                                   <table>
                                         <tr>
                                            <?php if($userrole=='DataOfficer' || $userrole == 'Senior Weather Observer' || $userrole == 'Observer') {?>
                                            <td>
                                           <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/DisplayFormToArchiveScannedObservationSlipFormForUpdate/" .$data->id ;?>" style="cursor:pointer;margin-right:10px;"> <li class="fa fa-edit"></li>Edit</a>
                                       <?php } else{?>
                                       <!--  <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/DisplayFormToArchiveScannedObservationSlipFormForUpdate/" .$data->id ;?>" style="cursor:pointer;margin-right:10px;"> <li class="fa fa-edit"></li>Add Comment</a> -->
                                    <?php }?>
                                   </td>

                                <?php if($userrole=='Senior Weather Observer'  && $data->Approved=="TRUE" || $userrole== 'SeniorDataOfficer' && $data->Approved=="TRUE" ){?>
                                <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/update_approval/"  .$data->id;?>"> <input type="hidden" name="id" value="<?php echo $data->id; ?>" ><input type="hidden" name="approve" value="FALSE" ><button class="btn btn-danger btn-xs"  type="submit"  ><li class='fa fa-times'></li> Disapprove</button></form>
                                    </td> <?php }elseif($userrole=='Senior Weather Observer' && $data->Approved=="FALSE" || $userrole =='SeniorDataOfficer' && $data->Approved=="FALSE"){?>
                                        <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/update_approval/";?>"> <input type="hidden" name="id" value="<?php echo $data->id;; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success btn-xs"  type="submit"  ><li class='fa fa-check'></li> Approve &nbsp;&nbsp;&nbsp;&nbsp;</button></form>
                                        </td>

                                        <?php
                                    }else{ }?> 

                                            <!-- <?php if($userrole=='SeniorDataOfficer'){?>
                                            <td>
                                            
                                            <form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/update_approval/" .$data->id;?>"> <input type="hidden" name="id" value="<?php echo $data->id; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($data->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
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
                        <a style="margin-left:10px;" href="<?php echo base_url(); ?>index.php/ArchiveObservationSlipFormData/" class='btn btn-info btn-xs'><< Back to all records</a>
                           <hr>
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
                                <form method="post" action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/submitObservationslipComment/">
                                <input type="hidden" name="recordid" value="<?php echo $scannedobservationslipformdatadetails ?>" id="">
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
                    </div>
                </div>
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
            //Post Add New  Archive Scanned Copy of  Metar  form  data into the DB
            //Validate each select field before inserting into the DB
            $('#postScannedObservationSlipFormCopy_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveScannedObservationSlipFormDataCopyDetails();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Scanned Observation Slip Form Record with the Same date ,Station Name and Station Number and TIME Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name , Number or date not picked");
                    return false;
                }

                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield").focus();
                    return false;

                }


                //Check that Form name  is picked
                var formname=$('#formname_observationslipform').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname_observationslipform').val("");  //Clear the field.
                    $("#formname_observationslipform").focus();
                    return false;

                }

                //Check that Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the date");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }




                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_ArchiveScannedObservationSlipForm').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_ArchiveScannedObservationSlipForm').val("");  //Clear the field.
                    $("#station_ArchiveScannedObservationSlipForm").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_ArchiveScannedObservationSlipForm').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_ArchiveScannedObservationSlipForm').val("");  //Clear the field.
                    $("#stationNo_ArchiveScannedObservationSlipForm").focus();
                    return false;

                }
                //Check that the TIME is selected from the list of TIME for the METAR
                var time_archiveobservationslipform=$('#time_ArchiveScannedObservationSlipForm').val();
                if(time_archiveobservationslipform==""){  // returns true if the variable does NOT contain a valid number
                    alert("TIME of  Observation Slip not picked");
                    $('#time_ArchiveScannedObservationSlipForm').val("");  //Clear the field.
                    $("#time_ArchiveScannedObservationSlipForm").focus();
                    return false;

                }
                //Check that the a file has been uploaded
                var filenameselected=$('#archievescannedcopy_observationslipform').val();
                if(filenameselected==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_observationslipform').val("");  //Clear the field.
                    $("#archievescannedcopy_observationslipform").focus();
                    return false;

                }



            }); //button
            //  return false;

        });  //document
    </script>
    <script type="text/javascript">
            //Once the Manager selects the Station the Station Number, should be picked from the DB.
            // For Add User when user is OC
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
        //CHECK DB IF THE ARCHIVE SCANNED METAR FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveScannedObservationSlipFormDataCopyDetails(){

            //Check against the date,stationName,SManagernNumber,Time and Metar Option.
            var date= $('#date').val();



            var stationName = $('#station_ArchiveScannedObservationSlipForm').val();
            var stationNumber = $('#stationNo_ArchiveScannedObservationSlipForm').val();
            var time=$('#time_ArchiveScannedObservationSlipForm').val();



            $('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveScannedObservationSlipFormDataCopy/checkInDBIfArchiveScannedObservationSlipFormDataCopyRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'time': time,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveScannedObservationSlipFormDataCopy_hiddentextfield").val();

            }//end of if
            else if((date == undefined) || (time == undefined) ||  (stationName == undefined) || (stationNumber == undefined)){

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
            $('#updateScannedObservationSlipFormCopy_button').click(function(event) {

                //Check that Form name  is picked
                var formname=$('#formname').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname').val("");  //Clear the field.
                    $("#formname").focus();
                    return false;

                }



                //Check that Date selected
                var updatedate=$('#expdate').val();
                if(updatedate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Date not picked");
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
                //Check that the a file has been uploaded
                var updatefilenameselected=$('#updatearchievescannedcopy_observationslipform').val();
                var previouslyuploadedfileName=$('#PreviouslyUploadedFileName_observationSlipForm').val();
                if((updatefilenameselected=="") && (previouslyuploadedfileName=="")){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#updatearchievescannedcopy_observationslipform').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_observationslipform").focus();
                    return false;
                }

                //Check that the a file has been uploaded and also the previously Uploaded file
              /*  var updatefilenameselected=$('#updatearchievescannedcopy_observationslipform').val();
                var previouslyuploadedfileName=$('#PreviouslyUploadedFileName_observationSlipForm').val();
                if((updatefilenameselected!="") && (previouslyuploadedfileName!="")){  // returns true if the variable does NOT contain a valid number
                    alert(" A file has been  Uploaded and also previously uploaded file");
                    $('#updatearchievescannedcopy_observationslipform').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_observationslipform").focus();
                    return false;
                }*/

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

            var newValue_description;
            var oldValue_description=$('#description').val();

            $('#description').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_description = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#description').val(newValue_description);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#description').val(oldValue_description);
                    return false;
                }

       });
        });
    </script>

    <script type="text/javascript">
        //Once the Admin selects the Station the StaManagerNumber should be picked from the DB Automatically.
        // For InseManagerd Archieve DekManagerForm Data
        $(document.body).on('change','#stationArchiveScannedObservationSlipFormManager',function(){
            $('#stationNoArchiveScannedObservationSlipFormManager').val("");  //Managerar the field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoArchiveScannedObservationSlipFormManager').val("");
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

                            $('#stationNoArchiveScannedObservationSlipFormManager').val("");

                            // alert(data);
                            $("#stationNoArchiveScannedObservationSlipFormManager").val(json[0].StationNumber);
                        }
                        else{

                            $('#stationNoArchiveScannedObservationSlipFormManager').empty();
                            $('#stationNoArchiveScannedObservationSlipFormManager').val("");

                        }
                    }

                });



            else {

                    $('#stationNoArchiveScannedObservationSlipFormManager').empty();
                    $('#stationNoArchiveScannedObservationSlipFormManager').val("");
                }     })

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
