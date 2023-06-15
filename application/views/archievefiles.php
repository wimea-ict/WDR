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
                    <?php if(strcmp($form_type,"observationslip")==0){ ?>
                    <h1>Archive Scanned Observation Slip Form<small></small> </h1>
                    <?php } ?>
                    <?php if(strcmp($form_type,"metar")==0){ ?>
                        <h1>Archive Scanned metar  Form <small> </small> </h1>
                    <?php } ?>
                    <?php if(strcmp($form_type,"weathersummary")==0){ ?>
                        <h1>Archive Scanned Weather summary Form<small> </small> </h1>
                    <?php } ?>
                    <?php if(strcmp($form_type,"synoptic")==0){ ?>
                        <h1>Archive Scanned Synoptic Form<small></small> </h1>
                    <?php } ?>
                    <?php if(strcmp($form_type,"dekadal")==0){ ?>
                        <h1>Archive Scanned Dekadal Form<small></small> </h1>
                    <?php } ?>
                    <?php if(strcmp($form_type,"monthlyrainfall")==0){ ?>
                        <h1>Archive Scanned Monthly Rainfall Form<small></small> </h1>
                    <?php } ?>
                    <?php if(strcmp($form_type,"yearlyrainfall")==0){ ?>
                        <h1>Archive Scanned Annual Rainfall Form<small></small> </h1>
                    <?php } ?>
       
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Scanned Observation Slip Form Copy</li>

        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewFormToArchiveScannedObservationSlipFormDetails) && count($displaynewFormToArchiveScannedObservationSlipFormDetails)) {
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
                    
                    <div class="col-lg-12">
                    <div class="row" style="margin-top:30px;">
                    <?php if($already_uploaded->num_rows()>0){
                    echo "<h3 class='text-center'>ALREADY UPLOADED FILES</h3><table  class='table table-striped'>";
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
                        <button type="submit"  name="postScannedObservationSlipFormCopy_button" class="btn btn-danger btn-xs pull-right"><i class="fa fa-times"> </i> Remove</button>
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
                    <?php if(strcmp($form_type,"observationslip")==0){ ?>
                    <form action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/insertInformationForArchiveScannedObservationSlipFormFiles/"  method="post" enctype="multipart/form-data">
                    <?php } ?>
                    <?php if(strcmp($form_type,"metar")==0){ ?>
                    <form action="<?php echo base_url(); ?>index.php/ArchiveScannedMetarFormDataCopy/insertInformationForArchiveScannedMetarFormFiles/"  method="post" enctype="multipart/form-data">
                    <?php } ?>
                    <?php if(strcmp($form_type,"weathersummary")==0){ ?>
                    <form action="<?php echo base_url(); ?>index.php/ArchiveScannedWeatherSummaryFormDataReportCopy/insertInformationForArchiveScannedWeatherSummaryFormFiles/"  method="post" enctype="multipart/form-data">
                    <?php } ?>
                    <?php if(strcmp($form_type,"synoptic")==0){ ?>
                    <form action="<?php echo base_url(); ?>index.php/ArchiveScannedSynopticFormDataReportCopy/insertInformationForArchiveScannedSynopticFormFiles/"  method="post" enctype="multipart/form-data">
                    <?php } ?>
                    <?php if(strcmp($form_type,"dekadal")==0){ ?>
                    <form action="<?php echo base_url(); ?>index.php/ArchiveScannedDekadalFormDataReportCopy/insertInformationForArchiveScannedDekadalFormFiles/"  method="post" enctype="multipart/form-data">
                    <?php } ?>
                    <?php if(strcmp($form_type,"monthlyrainfall")==0){ ?>
                    <form action="<?php echo base_url(); ?>index.php/ArchiveScannedMonthlyRainfallFormDataReportCopy/insertInformationForArchiveScannedMonthlyRainfallFormFiles/"  method="post" enctype="multipart/form-data">
                    <?php } ?>
                    <?php if(strcmp($form_type,"yearlyrainfall")==0){ ?>
                    <form action="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/insertInformationForArchiveScannedYearlyRainfallFormFiles/"  method="post" enctype="multipart/form-data">
                    <?php } ?>
                    <div class="row" style="margin-top:30px;">
                    
                     
                        <div class="form-group">
                                <span ><h4>Select file to upload: </h4> </span>
                                <input type="hidden"  name="record" value="<?php echo $record_id ?>">
                                <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls" name="archievescannedcopy_observationslipform" id="archievescannedcopy_observationslipform" required class="form-control"  style="width:100%">
                                <p class="help-block">Lighter file is better</p>
                        </div>

                        
                       
                  
                      <div class="form-group">
                            <span ><h4>File description</h4></span>
                            <textarea name="description" class="form-control" onkeyup=""  rows="4" id="description_observationslipform"></textarea>
                        </div>
                        </div>
                    
                      <center>
                        <button type="submit" id="filename"  name="postScannedObservationSlipFormCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT FILE </button>
                    </center> <br>
                        </div>
                       
                       
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
        
        </form>
        <center> 
        <?php if(strcmp($form_type,"observationslip")==0 && !empty('record') && ($already_uploaded->num_rows()>0)){ ?>
            <a href="<?php echo base_url('index.php/ArchiveScannedObservationSlipFormDataCopy/confirmSubmission/'.$record_id); ?>" class="btn btn-danger"><i class="fa fa-check"></i> FINISH  </a>
        <?php } ?>
        <?php if(strcmp($form_type,"metar")==0 && !empty('record') && ($already_uploaded->num_rows()>0)){ ?>
            <a href="<?php echo base_url('index.php/ArchiveScannedMetarFormDataCopy/confirmSubmission/'.$record_id); ?>" class="btn btn-danger"><i class="fa fa-check"></i> FINISH  </a>
        <?php } ?>    
        <?php if(strcmp($form_type,"weathersummary")==0 && !empty('record') && ($already_uploaded->num_rows()>0)){ ?>
            <a href="<?php echo base_url('index.php/ArchiveScannedWeatherSummaryFormDataReportCopy/confirmSubmission/'.$record_id); ?>" class="btn btn-danger"><i class="fa fa-check"></i> FINISH  </a>
        <?php } ?>
        <?php if(strcmp($form_type,"synoptic")==0 && !empty('record') && ($already_uploaded->num_rows()>0)){ ?>
            <a href="<?php echo base_url('index.php/ArchiveScannedSynopticFormDataReportCopy/confirmSubmission/'.$record_id); ?>" class="btn btn-danger"><i class="fa fa-check"></i> FINISH  </a>
        <?php } ?>
        <?php if(strcmp($form_type,"dekadal")==0 && !empty('record') && ($already_uploaded->num_rows()>0)){ ?>
            <a href="<?php echo base_url('index.php/ArchiveScannedDekadalFormDataReportCopy/confirmSubmission/'.$record_id); ?>" class="btn btn-danger"><i class="fa fa-check"></i> FINISH  </a>
        <?php } ?> 
        <?php if(strcmp($form_type,"monthlyrainfall")==0 && !empty('record') && ($already_uploaded->num_rows()>0)){ ?>
            <a href="<?php echo base_url('index.php/ArchiveScannedMonthlyRainfallFormDataReportCopy/confirmSubmission/'.$record_id); ?>" class="btn btn-danger"><i class="fa fa-check"></i> FINISH  </a>
        <?php } ?> 
        <?php if(strcmp($form_type,"yearlyrainfall")==0 && !empty('record') && ($already_uploaded->num_rows()>0)){ ?>
            <a href="<?php echo base_url('index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/confirmSubmission/'.$record_id); ?>" class="btn btn-danger"><i class="fa fa-check"></i> FINISH  </a>
        <?php } ?>   
        </center><br><br>
        </div>
    <?php
    }elseif((is_array($scannedobservationslipformcopyidDetails) && count($scannedobservationslipformcopyidDetails))) {
        foreach($scannedobservationslipformcopyidDetails as $idDetails){

            $scannedformid = $idDetails->id;
            ?>
            <div class="row">
                <form action="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/updateInformationForArchiveScannedObservationSlipFormDetails" method="post" enctype="multipart/form-data">
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
                        <div class="col-lg-8">


                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Station Name</span>
                                        <input type="text" name="station" id="station" required class="form-control" value="<?php echo $idDetails->StationName;?>"  readonly class="form-control" >
                                        <input type="hidden" name="id" id="id" required class="form-control" value="<?php echo $idDetails->id;?>"  readonly class="form-control" >

                                    </div>
                                </div>




                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Station Number</span>
                                        <input type="hidden" name="stationId" required class="form-control" id="stationId" readonly class="form-control" value="<?php echo $idDetails->station;?>" readonly="readonly" >
                                        <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $idDetails->StationNumber;?>" readonly="readonly" >
                                    </div>
                                </div>


                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> TIME</span>
                                    <input type="text" name="timeRecorded" required class="form-control" id="timeRecorded" readonly class="form-control" value="<?php echo $idDetails->TIME;?>" readonly="readonly" >

                                </div>
                            </div>






                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Date</span>
                                    <input type="text" name="dateOnScannedObservationSlipForm" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->form_date;?>" id="expdate" readonly="readonly" readonly class="form-control">
                                </div>
                            </div>



                            <div class="form-group">
                                <span class="input-group-addon">Description</span>
                                <textarea name="description" onkeyup="" class="form-control" style="height:40px;" id="description">  <?php echo $idDetails->Description;?>    </textarea>

                            </div>



                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">  Select file to upload:</span>
                                    
                                    <input type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls"  value="<?php echo $idDetails->Description;?>" name="updatearchievescannedcopy_observationslipform[]" id="updatearchievescannedcopy_observationslipform"  class="form-control" size = "40" multple="true">
                                    <!-- gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx-->
                                </div>

                                <p class="help-block">Lighter file is better</p>
                            </div>
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

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class = 'pull-left'>Previously Uploaded File</i>

									<a href="<?php echo base_url(); ?>index.php/SearchArchivedScannedObservationSlipFormDataCopy/ViewImageFromBrowser/<?php echo $idDetails->FileRef;?>" target = "blank"><?php echo $idDetails->FileRef;?></a>
									</span>
                                    
                                     <input type="hidden" name="PreviouslyUploadedFileName_observationSlipForm" id="PreviouslyUploadedFileName_observationSlipForm" required class="form-control"  value="<?php echo $idDetails->FileRef;?>"  readonly="readonly" readonly class="form-control">

								</div>
                            </div>

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
								   <select name="approval" id="approval"  class="form-control" >
									<option value="<?php echo $idDetails->Approved;?>"><?php echo $idDetails->Approved;?></option>
									<option value="TRUE">TRUE</option>
									<option value="FALSE">FALSE</option>
								</select>
								<?php }?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer clearfix"></div>
                    <div class="clearfix"></div>
            </div>
            <center>

                <a  href="<?php echo base_url(); ?>index.php/ArchiveScannedObservationSlipFormDataCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                <button type="submit" name="updateScannedObservationSlipFormCopy_button" id="updateScannedObservationSlipFormCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE </button>
            </center>
            </form>
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
								<th>File Name</th>
                                <th>Description</th>
                                <th>Approved</th>
                                <th>Submitted By</th>
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
									 if($userrole =='DataOfficer' && $data->Approved =='TRUE' ){
									   $count++;
									   }else{
										   $count++;

                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $data->StationName;?></td>
                                        <td ><?php echo $data->StationNumber;?></td>
                                        <td ><?php echo $data->form_date;?></td>
                                        <td ><?php echo $data->TIME;?></td>
										<td class="no-print">
                                        <?php 
                                          $files=explode(",",$data->FileRef);
                                          $total=count($files);
                                          
                                          for($i=0;$i<$total;$i++){
                        
                                        ?>
                                        
                                           <a  style="line-height:40px;" title="click to view file" href="<?php echo base_url(); ?>index.php/SearchArchivedScannedObservationSlipFormDataCopy/ViewImageFromBrowser/<?php echo $files[$i]; ?>"><?php echo $files[$i];?></a><br> 
                                           <!--  <?php echo $data->FileRef;?>-->

                                        
                                        <?php } ?>
                                        </td>
                                        <td><?php echo $data->Description;?></td>
                                        <td ><?php echo $data->Approved;?></td>
                                        <td><?php echo $data->SD_SubmittedBy;?></td>
                                   <?php if($userrole=="DataOfficer"||$userrole=="Senior Weather Observer"|| $userrole=="Observer"||$userrole=='SeniorDataOfficer' ){ ?>
                                     <td class="no-print">

								   <table>
                                         <tr><td>
                                           <a class="btn btn-primary" href="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/DisplayFormToArchiveScannedObservationSlipFormForUpdate/" .$data->id ;?>" style="cursor:pointer;"> <li class="fa fa-edit"></li>Edit</a>
                                   </td>

<?php if($userrole=='Senior Weather Observer'  && $data->Approved=="TRUE" || $userrole== 'SeniorDataOfficer' && $data->Approved=="TRUE" ){?>
                                <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/update_approval/"  .$data->id;?>"> <input type="hidden" name="id" value="<?php echo $data->id; ?>" ><input type="hidden" name="approve" value="FALSE" ><button class="btn btn-danger"  type="submit"  ><li class='fa fa-times'></li> Disapprove</button></form>
                                    </td> <?php }elseif($userrole=='Senior Weather Observer' && $data->Approved=="FALSE" || $userrole =='SeniorDataOfficer' && $data->Approved=="FALSE"){?>
                                        <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedObservationSlipFormDataCopy/update_approval/";?>"> <input type="hidden" name="id" value="<?php echo $data->id;; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success"  type="submit"  ><li class='fa fa-check'></li> Approve &nbsp;&nbsp;&nbsp;&nbsp;</button></form>
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
                        <br><br>
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

                 var filename=$('#archievescannedcopy_observationslipform').val();
                if(filename==""){  // returns true if the variable does NOT contain a valid number
                    alert("File not picked, please choose file");
                    $('#archievescannedcopy_observationslipform').val("");  //Clear the field.
                    $("#archievescannedcopy_observationslipform").focus();
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

<?php require_once(APPPATH . 'views/footer.php'); ?>
