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
            Archive Scanned Yearly Rainfall Form Report
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Archive Scanned Yearly Rainfall Form Report</li>

        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
    <?php

    if(is_array($displaynewFormToArchiveScannedYearlyRainfallFormReport) && count($displaynewFormToArchiveScannedYearlyRainfallFormReport)) {
        ?>
        <div class="row">
            <form action="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/insertInformationForArchiveScannedYearlyRainfallFormReport/"  method="post" enctype="multipart/form-data">
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
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Form</span>
                                <input type="text" name="formname_yearlyrainfallformreport" id="formname_yearlyrainfallformreport" required class="form-control" value="<?php echo 'Annual Rainfall Form';?>"  readonly class="form-control" >
                                <input type="hidden" name="checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield" id="checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield">

                            </div>
                        </div>

                           <div class="form-group">
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

                             <div class="form-group">
                                  <div class="form-group">
                            <div class="input-group">

                            <span class="input-group-addon">Station Name</span>
                            <select  name="station_ArchiveScannedYearlyRainfallFormReport" class="form-control"  id="stations-list"
                              required selected="selected">
                              <option value="">-- Select Station--</option>
                                <option id="stations-list" > </option>
                                
                            </select>
                        </div>
                        </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> Station Number</span>

                                     <input type="text" name="stationNo_ArchiveScannedYearlyRainfallFormReport"  id="stationNoManager" required class="form-control" value=""  readonly   >
                                </div>
                            </div>





                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Year</span>
                                <input type="text" name="yearOfScannedYearlyRainfallFormReport_yearlyrainfallformreport" id="year" required class="form-control"  placeholder="Enter the year">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer clearfix"></div>
                <div class="clearfix"></div>
        </div>
        <center>

                    <a href="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK </a>

                    <button type="submit" id="postScannedArchiveYearlyRainfallFormReportDataCopy_button" name="postScannedArchiveYearlyRainfallFormReportDataCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> NEXT </button>
                </center>
            </form>
        </div>
    <?php
    }elseif((is_array($scannedyearlyrainfallformreportidDetails) && count($scannedyearlyrainfallformreportidDetails))) {
        foreach($scannedyearlyrainfallformreportidDetails as $idDetails){

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
                        <br><br>
                        <form action="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/updateInformationForArchiveScannedYearlyRainfallFormReport" method="post" enctype="multipart/form-data">
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
                                    <span class="input-group-addon">Year</span>
                                    <input type="text" <?php if($userrole=="SeniorDataOfficer") echo 'readonly'; ?> name="yearOfScannedYearlyRainfallFormReport" required class="form-control" placeholder="Enter date on the scanned form " value="<?php echo $idDetails->year;?>" id="year">
                                </div>
                            </div>
                            <br>
                            <?php if ($userrole == 'SeniorDataOfficer'){ ?>
                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Add Comment</span>
                                            <textarea name="comment"  class="form-control" style="height:40px;" placeholder="Enter comment to send to data officer">  </textarea>
                                        </div>
                                        <!-- <span id="errorrainfall"></span> -->
                                    </div>
                                <?php }?>
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

                           <a  href="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                        <button type="submit" name="updateScannedArchiveYearlyRainfallFormReportDataCopy_button" id="updateScannedArchiveYearlyRainfallFormReportDataCopy_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE </button>
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
                        <button type="submit"  <?php if($userrole=="SeniorDataOfficer") echo 'disabled'; ?> name="postScannedObservationSlipFormCopy_button" class="btn btn-danger btn-xs pull-right"><i class="fa fa-times"> </i> Remove</button>
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
             <form action="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/insertInformationForArchiveScannedYearlyRainfallFormFiles/"  method="post" enctype="multipart/form-data">
                    <div class="row" >
                    
                      
                      <div class="form-group">
                           
                                <h4 class="text-center">ADD MORE FILES:</h4>
                                <input type="hidden"  name="record" value="<?php echo $record_id ?>"/>
                                <input type="hidden"  name="file_type" value="scannedyearlyrainfall"/>
                                <input style="width:100%;" <?php if($userrole=="SeniorDataOfficer") echo 'disabled'; ?> type="file" accept="image/gif,image/jpg,image/png,image/jpeg,.pdf,.doc,.docx,.xlsx,.ppt,.pptx,.xls" name="archievescannedcopy_observationslipform" id="archievescannedcopy_observationslipform" required class="form-control">
                          
                        </div>
                       
                      <div class="form-group">
                            <span ><h4>File description</h4></span>
                            <textarea name="description" <?php if($userrole=="SeniorDataOfficer") echo 'disabled'; ?> class="form-control" onkeyup=""  rows="2" id="description_observationslipform"></textarea>
                        </div>
                       
                     
                      <center>
                        <button type="submit" <?php if($userrole=="SeniorDataOfficer") echo 'disabled'; ?> name="postScannedObservationSlipFormCopy_button" class="btn btn-primary btn-xs pull-right"><i class="fa fa-plus"></i> SUBMIT FILE </button>
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
                                     href="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/DisplayFormToArchiveScannedYearlyRainfallFormReport/">
                    <i class="fa fa-plus"></i> Add new Scanned Yearly Rainfall Form Report</a>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Scanned Yearly Rainfall Form Report Details</h3>
                    </div><!-- /.box-header -->
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Station Name</th>
                                <th>Station Number</th>
                                <th>Year</th>
                                <th>File Name & Description</th>
                                <th>Approved</th>
                                <th>Submitted By</th>
                                <!-- <th>The Comment</th> -->
                                <th>Comments</th>
                             <?php if($userrole=="Senior Weather Observer"|| $userrole=="ObserverArchive"||$userrole=="DataOfficer"||$userrole=="SeniorDataOfficer"){  ?>
                                    <th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($archivedscannedyearlyrainfallformreportdetails) && count($archivedscannedyearlyrainfallformreportdetails)) {
                                foreach($archivedscannedyearlyrainfallformreportdetails as $data){
                                    $count++;

                                    $scannedweathersummaryformreportdetails = $data->id;
                                      if($userrole =='DataOfficer' && $data->Approved =='TRUE' ){
                                       $count++;
                                       }else{
                                           $count++;

                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $data->StationName;?></td>
                                        <td ><?php echo $data->StationNumber;?></td>
                                        <td ><?php echo $data->year;?></td>
                                        <td class="no-print"  style="padding:0px;">
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
                                 
                                        </td>
                                        <td ><?php echo $data->Approved;?></td>
                                        <td><?php echo $data->SY_SubmittedBy;?></td>
                                       <!--  <td><?php echo $data->comment?></td> -->
                                         <td class="no-print"> 

                                                <?php if($data->Approved=="FALSE" || $userrole!='DataOfficer'){ ?>
                                                  <h6><?php echo $data->numberofcomments; ?> comments on this record</h6>
                                                  <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/index/<?php echo $data->id ?>/">View/ Add Comments</a> <br><br>
                                                <?php }else{ ?> 
                                                <h6 style="color:green;"> <li class='fa fa-check'></li> Record approved</h6>
                                                <?php }?>
                                                </td>
                                   <?php if($userrole=="Senior Weather Observer"|| $userrole=="ObserverArchive"||$userrole=="DataOfficer"||$userrole=="SeniorDataOfficer"){ ?>
                                     <td class="no-print">
                                          
                                      <table>
                                                <tr>
                                            <?php if($userrole=='DataOfficer') {?>
                                                    <td>
                                           <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/DisplayFormToArchiveScannedYearlyRainfallFormReportForUpdate/" .$data->id ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li> Edit</a>
                                       <?php } else{?>
                                       <!--  <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/DisplayFormToArchiveScannedYearlyRainfallFormReportForUpdate/" .$data->id ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li>Add Comment</a> -->
                                       <?php }?>
                                        </td>
                 <?php if($userrole== 'SeniorDataOfficer' && $data->Approved=="TRUE" ){?>
                        <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/update_approval/" .$data->id;?>"> <input type="hidden" name="id" value="<?php echo $data->id;?>" ><input type="hidden" name="approve" value="FALSE" ><button class="btn btn-danger btn-xs"  type="submit"  ><li class='fa fa-times'></li> Disapprove</button></form>
                            </td> <?php }elseif( $userrole=='Senior Weather Observer' && $data->Approved=="FALSE" || $userrole =='SeniorDataOfficer' && $data->Approved=="FALSE"){?>
                                <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/update_approval/" .$data->id;?>"> <input type="hidden" name="id" value="<?php echo $data->id;?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success btn-xs"  type="submit"  ><li class='fa fa-check'></li> Approve &nbsp;&nbsp;&nbsp;&nbsp;</button></form>
                                </td>

                                <?php
                            }else{ }?>
                                                <!-- <?php if($userrole=='SeniorDataOfficer'){?>
                                                <td>
                                            
                                            <form method="post" action="<?php echo base_url() . "index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/update_approval/" .$data->id;?>"> <input type="hidden" name="id" value="<?php echo $data->id; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($data->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
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
                           <a style="margin-left:10px;" href="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/" class='btn btn-info btn-xs'><< Back to all records</a>
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
                                <form method="post" action="<?php echo base_url(); ?>index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/submitObservationslipComment/">
                                <input type="hidden" name="recordid" value="<?php echo $scannedweathersummaryformreportdetails ?>" id="">
                                <textarea name="comment" id="" cols="20" rows="6" class="form-control" placeholder="type your comment here">
                                
                                </textarea>
                                <br>
                                <button class="btn tn-info btn-sm" type="submit">Submit comment</button>
                                </form>
                                </div>
                              </div>
                             <?php } ?>
                        <br>
                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT </button>
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
            //Post Add New  Archive Scanned Copy of  Metar  form  data into the DB
            //Validate each select field before inserting into the DB
            $('#postScannedArchiveYearlyRainfallFormReportDataCopy_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveScannedYearlyRainfallFormDataReportCopy();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Scanned Yearly Rainfall Record with the Same year,Station Name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name , Number  ,year not picked");
                    return false;
                }


                //Check value of the hidden text field.That stores whether a row is duplicate
               /* var hiddenvalue=$('#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield").focus();
                    return false;

                }*/

                //Check that Form name  is picked
                var formname=$('#formname_yearlyrainfallformreport').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname_yearlyrainfallformreport').val("");  //Clear the field.
                    $("#formname_yearlyrainfallformreport").focus();
                    return false;

                }


                //Check that Date selected
                var year=$('#year').val();
                if(year==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the Year");
                    $('#year').val("");  //Clear the field.
                    $("#year").focus();
                    return false;

                }



                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station_ArchiveScannedYearlyRainfallFormReport').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_ArchiveScannedYearlyRainfallFormReport').val("");  //Clear the field.
                    $("#station_ArchiveScannedYearlyRainfallFormReport").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo_ArchiveScannedYearlyRainfallFormReport').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_ArchiveScannedYearlyRainfallFormReport').val("");  //Clear the field.
                    $("#stationNo_ArchiveScannedYearlyRainfallFormReport").focus();
                    return false;

                }

                //Check that the a file has been uploaded
                var filenameselected=$('#archievescannedcopy_yearlyrainfallformdatareport').val();
                if(filenameselected==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#archievescannedcopy_yearlyrainfallformdatareport').val("");  //Clear the field.
                    $("#archievescannedcopy_yearlyrainfallformdatareport").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE ARCHIVE SCANNED METAR FORM RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveScannedYearlyRainfallFormDataReportCopy(){

            //Check against the date,stationName,StManagerNumber,Time and Metar Option.

            var year= $('#year').val();

            var stationName = $('#stations-list').val();
            var stationNumber = $('#stationNoManager').val();


            $('#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield').val("");

            if ((year != undefined)&&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveScannedYearlyRainfallFormDataReportCopy/checkInDBIfArchiveScannedYearlyRainfallFormDataReportCopyRecordExistsAlready",
                    type: "POST",
                    data:{'year':year,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveScannedYearlyRainfallFormDataReportCopy_hiddentextfield").val();

            }//end of if
            else if((year == undefined) || (stationName == undefined) || (stationNumber == undefined)){

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
            $('#updateScannedArchiveYearlyRainfallFormReportDataCopy_button').click(function(event) {

                //Check that Form name  is picked
                var formname=$('#formname').val();
                if(formname==""){  // returns true if the variable does NOT contain a valid number
                    alert("Form Name not picked");
                    $('#formname').val("");  //Clear the field.
                    $("#formname").focus();
                    return false;

                }

                //Check that Date selected
                var year=$('#year').val();
                if(year==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select the Year");
                    $('#year').val("");  //Clear the field.
                    $("#year").focus();

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
                var updatefilenameselected=$('#updatearchievescannedcopy_yearlyrainfallformdatareportcopy').val();
                var previouslyuploadedfileName=$('#PreviouslyUploadedFileName_yearlyrainfallformdatareportcopy').val();
                if((updatefilenameselected=="") && (previouslyuploadedfileName=="")){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select A file to Upload");
                    $('#updatearchievescannedcopy_yearlyrainfallformdatareportcopy').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_yearlyrainfallformdatareportcopy").focus();
                    return false;
                }

                //Check that the a file has been uploaded and also the previously Uploaded file
               /* var updatefilenameselected=$('#updatearchievescannedcopy_yearlyrainfallformdatareportcopy').val();
                var previouslyuploadedfileName=$('#PreviouslyUploadedFileName_yearlyrainfallformdatareportcopy').val();
                if((updatefilenameselected!="") && (previouslyuploadedfileName!="")){  // returns true if the variable does NOT contain a valid number
                    alert(" A file has been  Uploaded and also previously uploaded file");
                    $('#updatearchievescannedcopy_yearlyrainfallformdatareportcopy').val("");  //Clear the field.
                    $("#updatearchievescannedcopy_yearlyrainfallformdatareportcopy").focus();
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


    <script type="text/javascript">
        //Once the Admin selects the Station the Station Managerr should be picked from the DB Automatically.
        // For Insert/Add ArcManager Dekadal ManagerData
        $(document.body).on('change','#stationNoArchiveScannedYearlyRainfallFormReportManager',function(){
            $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");  //CleManagere field.
            var stationName = this.value;


            if (stationName != "") {
                //alert(station);
                $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");
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

                            $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");

                            // alert(data);
                            $("#stationNoArchiveScannedYearlyRainfallFormReportManager").val(json[0].StationNumber);
                        }
                        else{

                            $('#stationNoArchiveScannedYearlyRainfallFormReportManager').empty();
                            $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");

                        }
                    }

                });



            else {

                    $('#stationNoArchiveScannedYearlyRainfallFormReportManager').empty();
                    $('#stationNoArchiveScannedYearlyRainfallFormReportManager').val("");
                }    

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
