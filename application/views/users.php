<link href="<?php echo base_url(); ?>css/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>css/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <?php require_once(APPPATH . 'views/header.php'); ?>
    <?php
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];
    $userstationNo=$session_data['StationNumber'];
    $userstationId=$session_data['StationId'];
    $name=$session_data['FirstName'].' '.$session_data['SurName'];
    ?>

    <aside class="right-side">
        <section class="content-header">
            <h1>
                Users
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Users</li>


            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            <?php require_once(APPPATH . 'views/error.php'); ?>


            <?php

            if(is_array($displaynewstationuserform) && count($displaynewstationuserform)) {
                ?>
                <div class="row">
                    <form action="<?= site_url('register-user') ?>" method="post" enctype="multipart/form-data">
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
                                var charsOnly =/[^A-Za-z\s]/gi;  // integers and decimals // /[^0-9\.]/gi;
                                if(charsOnly.test(inputvalue.value)) {
                                    inputvalue.value = inputvalue.value.replace(charsOnly,"");
                                }
                            }
                        </script>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">First Name</span>
                                    <input type="text" name="user_firstname" id="user_firstname" onkeyup="allowCharactersInputOnly(this)"   required class="form-control"  required placeholder="Enter user's name">
                                    <input type="hidden" name="checkduplicateEntryOnAddUserStationInformation_hiddentextfield" id="checkduplicateEntryOnAddUserStationInformation_hiddentextfield" required class="form-control" >

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">SurName</span>
                                    <input type="text" name="user_surname"  id="user_surname" onkeyup="allowCharactersInputOnly(this)"  required class="form-control"   required placeholder="Enter user's surname">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"> User Email</span>
                                    <input type="email" name="user_email" id="user_email" required class="form-control" required placeholder="Enter user's email">
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">User Phone</span>
                                    <input maxlength='10' type="text" name="user_phone" id="user_phone" onkeyup="allowIntegerInputOnly(this)" required class="form-control" required placeholder="Enter user's contact ">

                                </div>
                            </div>

                        </div>


                        <div class="col-lg-6">






                            <?php if($userrole=='Manager' || $userrole=='ManagerData' ||$userrole =="ManagerStationNetworks"||$userrole =="ZonalOfficer"||$userrole=="SeniorZonalOfficer"){ ?>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> User Role</span>
                                        <select name="role"  id="role"  required class="form-control" placeholder="Select Role" onchange="displayregion()">
                                            <option value="">--Select User Roles--</option>
                                            <option value="Observer">Observer</option>
                                            <option value="Senior Weather Observer">Senior Weather Observer</option>
                                            <option value="ZonalOfficer">ZonalOfficer</option>
                                            
                                            <?php if($userrole !="ZonalOfficer"&&$userrole!="SeniorZonalOfficer"){ ?>
                                            <option value="QC">Quality Control Officer</option>
                                            <option value="WeatherForecaster">WeatherForecaster</option>
                                            <option value="WeatherAnalyst">WeatherAnalyst</option>
                                            <option value="Communications">Communications</option> 
                                            <option value="SeniorZonalOfficer">SeniorZonalOfficer</option>                                     
                                            <option value="DataOfficer">DataOfficer</option>
                                            <option value="SeniorDataOfficer">SeniorDataOfficer</option>
                                            <option value="ManagerStationNetworks">ManagerStationNetworks</option>
                                            <option value="ManagerData">Manager</option>
                                            <?php } ?>

                                             <?php if($userrole=="SeniorZonalOfficer"){ ?>
                                             	 <option value="SeniorZonalOfficer">SeniorZonalOfficer</option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <script>
                                        function displayregion(){
                                            var value =  document.getElementById('role').value;
                                            if(value.localeCompare("SeniorZonalOfficer")==0){
                                            document.getElementById('regionoc').style.display='none';
                                            document.getElementById('regionszo').style.display='block';
                                            }else if(value.localeCompare("ZonalOfficer")==0){
                                            document.getElementById('regionszo').style.display='none';
                                            document.getElementById('regionoc').style.display='block';
                                            document.getElementById('subregion').style.display='block';
                                            }else  if((value.localeCompare("Senior Weather Observer")==0 ) || (value.localeCompare("Observer")==0 )|| (value.localeCompare("WeatherForecaster")==0 ) || (value.localeCompare("ZonalOfficer")==0 ) ){
                                                document.getElementById('regionszo').style.display='none';
                                            document.getElementById('regionoc').style.display='block';
                                            }else{
                                                 document.getElementById('regionszo').style.display='none';
                                            document.getElementById('regionoc').style.display='none';

                                            }
                                        }
                                    </script>

 

                                  <div class="form-group regionoc" id="regionoc" style="display:none;">
                                    <div class="input-group">
                                    
                                        <span class="input-group-addon">Region</span>
                                        <select style="width:100%;" name="RegionName"   id="regions" class="form-control" placeholder="Select Region">
                                            <option value="">Select Region</option>
                                            <?php if($userrole=="ZonalOfficer"||$userrole=="SeniorZonalOfficer"){
                                            	    for($i=0; $i <sizeof($userregions) ; $i++) { 
                                            	  ?>
                                            	<option value="<?php echo $userregions[$i]; ?>"><?php echo $userregions[$i] ?></option>  
                                            <?php
                                                } }else{
                                                if($regions->num_rows()>0){
                                                    foreach($regions->result() as $row){
                                                ?>
                                                <option value="<?php echo $row->region; ?>"><?php echo $row->region; ?></option>
                                                <?php 
                                                        }
                                                  }  }
                                                ?> 

                                            </select> 
                                        </div>
                                    </div>

                                    <div class="form-group regionszo" id="regionszo" style="display:none;">
                                    <div class="input-group">
                                    
                                        <span class="input-group-addon">Regions</span>
                                        <select style="width:100%;" name="RegionNames[]"   id="region" class="form-control select2 border-form-control" placeholder="Select Region" multiple="true">
                                            <option value="">SELECT REGION ( S )</option> 
                                               <?php if($userrole=="ZonalOfficer"||$userrole=="SeniorZonalOfficer"){
                                            	    for($i=0; $i <sizeof($userregions) ; $i++) { 
                                            	  ?>
                                            	<option value="<?php echo $userregions[$i]; ?>"><?php echo $userregions[$i] ?></option>  
                                            <?php
                                                } }else{
                                                if($regions->num_rows()>0){
                                                    foreach($regions->result() as $row){
                                                ?>
                                                <option value="<?php echo $row->region; ?>"><?php echo $row->region; ?></option>
                                                <?php 
                                                        }
                                                  }  }
                                                ?> 
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="form-group subregion" id="subregion" style="display:none;">
                                        <div class="input-group">
                                            <span class="input-group-addon">Sub region</span>
                                            <select  name="subregion" class="form-control"  id="subregions-list"
                                            selected="selected">
                                            <option value="">-- Select Sub region--</option>
                                           
                                            <option id="subregions-list" > </option>
                                                
                                            </select>
                                        </div>
                                     </div>
                                   
                                    <div class="form-group station">
                                        <div class="input-group">

                                            <span class="input-group-addon">Station</span>
                                            <select  name="station" class="form-control"  id="stations-list"
                                            selected="selected" style="width:100%;">
                                            <option value="">-- Select Station--</option>
                                            <option id="stations-list" > </option>

                                        </select>
                                    </div>
                                </div>





                                <div class="form-group stationno">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station Number</span>
                                        <input type="text" name="stationNo" id="stationNoManager"  class="form-control text-danger" readonly
                                        value="<?= set_value('stationNo') ?>"  placeholder="Station Number">
                                    </div>
                                </div>



                            <?php } ?>



                            <?php if($userrole=='Senior Weather Observer'){ 

                                ?>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> User Role</span>
                                        <select name="role"  id="role"  required class="form-control" placeholder="Select Role">
                                            <option value="">--Select User Roles--</option>
                                            <option value="Observer">Observer</option>
                                            <option value="Senior Weather Observer">Senior Weather Observer</option>
                                        </select>
                                    </div>
                                </div>




                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Region</span>
                                        <input type="text" name="RegionName" id="stationNoManager"  class="form-control text-danger"
                                        value="<?php echo $userRegion ;?>" readonly required>

                                    </div>
                                </div>
                                
                                

                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <input type="" name="station" class="form-control" value="<?php echo $userstation;?>" readonly required>
                                    </div>
                                </div>





                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station Number</span>
                                        <input type="text" name="stationNo" id="stationNoManager"  class="form-control text-danger" value="<?php echo $userstationNo?>" readonly required>
                                    </div>
                                </div>



                            <?php  }  ?>


                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer clearfix">
                     <button type="submit" name="register" id="register-btn" class="btn btn-primary add-user"><i class="fa fa-plus"></i> Add User</button>

                     <a href="<?= site_url('registered-users') ?>" class="btn btn-danger pull-left clear-btn"><i class="fa fa-times"></i> Cancel</a>  
                 </div>
                 <div class="text-center">
                    <?php
                    if($this->session->flashdata()){
                        $error = $this->session->flashdata();
                        $err = $error['missingErr'];
                        ?>
                        <div class='alert alert-danger alert-dismissible' role='alert'>
                           <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span></button>
                            <span class="text-center"><strong>Oops!</strong> <?php echo $err ?></span>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
        <?php
    } elseif((is_array($stationuserdataid) && count($stationuserdataid))) {
        foreach($stationuserdataid as $userdetails){

            $userdetailsformid = $userdetails->id;
            ?>
            <div class="row">
                <form action="<?=site_url('update-user')?>" method="post" enctype="multipart/form-data">
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
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">FirstName</span>
                                        <input type="text" name="firstname" id="firstname" onkeyup="allowCharactersInputOnly(this)" class="form-control" required value="<?php echo $userdetails->FirstName;?>" placeholder="Enter staff's name"  class="form-control">
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon">User ID</span>
                                      <input name="Userid" id="Userid" value="<?php echo $userdetails->Userid;?>" class="text-success form-control" readonly>
                                  </div>
                              </div>

                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">SurName</span>
                                    <input type="text" name="surname" id="surname" onkeyup="allowCharactersInputOnly(this)" required class="form-control" value="<?php echo $userdetails->SurName;?>" placeholder="Enter staff's email"  class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Email</span>
                                    <input type="email" name="email" id="email" required class="form-control" value="<?php echo $userdetails->UserEmail;?>" placeholder="Enter user's email "  class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Phone</span>
                                    <input type="text" name="contact" id="contact" required class="form-control" value="<?php echo $userdetails->UserPhone;?>" placeholder="Enter Phone "  class="form-control">
                                </div>

                                <!--  hidden fields -->
                                <input type="hidden" name="stationid" id="stationid" required class="form-control"  value="<?php echo $userdetails->station;?>" readonly class="form-control" value="" >



                                <input type="hidden" name="pin" id="stationrole" required class="form-control"  value="<?php echo $userdetails->UserPassword;?>" readonly class="form-control" value="" >

                                <input type="hidden" name="active" id="stationrole" required class="form-control"  value="<?php echo $userdetails->Active;?>" readonly class="form-control" value="" >

                                <input type="hidden" name="reset" id="stationrole" required class="form-control"  value="<?php echo $userdetails->Reset;?>" readonly class="form-control" value="" >

                                <input type="hidden" name="LastLoggedIn" id="stationrole" required class="form-control"  value="<?php echo $userdetails->LastLoggedIn;?>" readonly class="form-control" value="" >


                                <input type="hidden" name="LastPasswdChange" id="stationrole" required class="form-control"  value="<?php echo $userdetails->LastPasswdChange;?>" readonly class="form-control" value="" >

                                <input type="hidden" name="CreatedBy" id="stationrole" required class="form-control"  value="<?php echo $userdetails->CreatedBy;?>" readonly class="form-control" value="" >
                            </div>

                        </div>
                        <?php if($userrole=='Manager' || $userrole=='ManagerData' ||$userrole == "ManagerStationNetworks"||$userrole =="ZonalOfficer"||$userrole=="SeniorZonalOfficer"){
                            ?>
                            <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> User Role</span>
                                        <select name="role"  id="role"  required class="form-control" placeholder="Select Role" onchange="displayregion()">
                                            <option value="">--Select User Roles--</option>
                                            <option value="Observer">Observer</option>
                                            <option value="Senior Weather Observer">Senior Weather Observer</option>
                                            <option value="ZonalOfficer">ZonalOfficer</option>
                                            
                                            <?php if($userrole !="ZonalOfficer"&&$userrole!="SeniorZonalOfficer"){ ?>
                                            <option value="QC">Quality Control Officer</option>
                                            <option value="SeniorZonalOfficer">SeniorZonalOfficer</option>
                                            <option value="WeatherForecaster">WeatherForecaster</option>
                                            <option value="WeatherAnalyst">WeatherAnalyst</option>
                                            <option value="Communications">Communications</option>
                                            <option value="DataOfficer">DataOfficer</option>
                                            <option value="SeniorDataOfficer">SeniorDataOfficer</option>
                                            <option value="ManagerStationNetworks">ManagerStationNetworks</option>
                                            <option value="ManagerData">Manager</option>
                                            <?php } ?>
                                            <?php if($userrole=="SeniorZonalOfficer"){ ?>
                                             	 <option value="SeniorZonalOfficer">SeniorZonalOfficer</option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <script>
                                        function displayregion(){
                                            var value =  document.getElementById('role').value;
                                            if(value.localeCompare("SeniorZonalOfficer")==0){
                                            document.getElementById('regionoc').style.display='none';
                                            document.getElementById('regionszo').style.display='block';
                                            }else if(value.localeCompare("ZonalOfficer")==0){
                                            document.getElementById('regionszo').style.display='none';
                                            document.getElementById('regionoc').style.display='block';
                                            document.getElementById('subregion').style.display='block';
                                            }else  if((value.localeCompare("Senior Weather Observer")==0 ) || (value.localeCompare("Observer")==0 )|| (value.localeCompare("WeatherForecaster")==0 ) || (value.localeCompare("ZonalOfficer")==0 ) ){
                                                document.getElementById('regionszo').style.display='none';
                                            document.getElementById('regionoc').style.display='block';
                                            }else{
                                                 document.getElementById('regionszo').style.display='none';
                                            document.getElementById('regionoc').style.display='none';

                                            }
                                        }
                                    </script>

 

                                  <div class="form-group regionoc" id="regionoc" style="display:none;">
                                    <div class="input-group">
                                    
                                        <span class="input-group-addon">Region</span>
                                        <select style="width:100%;" name="RegionName"   id="regions" class="form-control" placeholder="Select Region">
                                            <option value="">Select Region</option>
                                            <?php if($userrole=="ZonalOfficer"||$userrole=="SeniorZonalOfficer"){
                                                    for ($i=0; $i <sizeof($userregions) ; $i++) { 
                                                  ?>
                                                <option value="<?php echo $userregions[$i]; ?>"><?php echo $userregions[$i]; ?></option>  
                                            <?php
                                               } }else{
                                                if($regions->num_rows()>0){
                                                    foreach($regions->result() as $row){
                                                ?>
                                                <option value="<?php echo $row->region; ?>"><?php echo $row->region; ?></option>
                                                <?php 
                                                        }
                                                  }  }
                                                ?> 

                                              <!-- <?php
                                                if($regions->num_rows()>0){
                                                    foreach($regions->result() as $row){
                                                ?>
                                                <option value="<?php echo $row->region; ?>"><?php echo $row->region; ?></option>
                                                <?php 
                                                        }
                                                    }
                                                ?>  -->

                                            </select> 
                                        </div>
                                    </div>

                                    <div class="form-group regionszo" id="regionszo" style="display:none;">
                                    <div class="input-group">
                                    
                                        <span class="input-group-addon">Regions</span>
                                        <select style="width:100%;" name="RegionNames[]"   id="region" class="form-control select2 border-form-control" placeholder="Select Region" multiple="true">
                                            <option value="">SELECT REGION ( S )</option> 
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
                                    <div class="form-group subregion" id="subregion" style="display:none;">
                                        <div class="input-group">
                                            <span class="input-group-addon">Sub region</span>
                                            <select  name="subregion" class="form-control"  id="subregions-list"
                                            selected="selected">
                                            <option value="">-- Select Sub region--</option>
                                           
                                            <option id="subregions-list" > </option>
                                                
                                            </select>
                                        </div>
                                     </div>
                                   
                                    <div class="form-group station">
                                        <div class="input-group">

                                            <span class="input-group-addon">Station</span>
                                            <select  name="station" class="form-control"  id="stations-list"
                                            selected="selected" style="width:100%;">
                                            <option value="">-- Select Station--</option>
                                            <option id="stations-list" > </option>

                                        </select>
                                    </div>
                                </div>





                                <div class="form-group stationno">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station Number</span>
                                        <input type="text" name="stationNo" id="stationNoManager"  class="form-control text-danger" readonly
                                        value="<?= set_value('stationNo') ?>"  placeholder="Station Number">
                                    </div>
                                </div>
                            <!-- <div class="col-xs-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"> Users Role</span>
                                        <select name="role"  id="role"  required class="form-control" placeholder="Select Role">
                                            <option value="<?php echo $userdetails->UserRole;?>"><?php echo $userdetails->UserRole;?></option>
                                            <?php 
                                            if($userrole == 'Senior Weather Observer'){
                                                ?>
                                                <option value="Observer">Observer</option>
                                                <option value="Senior Weather Observer">Senior Weather Observer</option>
                                            <?php } 
                                            else {
                                                ?> 
                                                <option value="Observer">Observer</option>
                                                <option value="Senior Weather Observer">Senior Weather Observer</option>
                                                <option value="WeatherForecaster">WeatherForecaster</option>
                                                <option value="WeatherAnalyst">WeatherAnalyst</option>

                                                <option value="ZonalOfficer">ZonalOfficer</option>
                                                <option value="SeniorZonalOfficer">SeniorZonalOfficer</option>
                                                <option value="DataOfficer">DataOfficer</option>
                                                <option value="SeniorDataOfficer">SeniorDataOfficer</option>
                                                <option value="ManagerStationNetworks">ManagerStationNetworks</option>
                                                <option value="ManagerData">Manager</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        <div class="form-group region">
                            <div class="input-group">
                                <span class="input-group-addon">Region</span>
                                <select name="RegionName" id="regions" class="form-control">

                                    <option value="<?php echo $userdetails->StationRegion ?>" selected>
                                        <?php echo $userdetails->StationRegion ?>
                                    </option>
                                    <?php
                                    if (is_array($regions) && count($regions)) {
                                        foreach($regions as $region){?>
                                            <option value="<?php echo $region->StationRegion ?> ">
                                                <?php echo $region->StationRegion;?></option>

                                            <?php }
                                        } ?>  

                                    </select> 
                                </div>
                            </div>
                            

                            <div class="form-group subregion" id="subregion">
                                        <div class="input-group">
                                            <span class="input-group-addon">Sub region</span>
                                            <select  name="subregion" class="form-control"  id="subregions-list"
                                            selected="selected">
                                            <option value="">-- Select Sub region--</option>
                                                <option id="subregions-list" > </option>
                                                
                                            </select>
                                        </div>
                            </div>

                            <div class="form-group station">
                                <div class="input-group">

                                    <span class="input-group-addon">Station</span>
                                    <select  name="station" class="form-control"  id="stations-list" selected="selected">
                                    <option value="<?php echo $userdetails->StationName;?>">
                                      <?php echo $userdetails->StationName;?>
                                  </option>
                                  <option id="stations-list" > </option>

                              </select>
                          </div>
                      </div>

                      <div class="col-xs-6">
                        <div class="form-group stationno">
                            <div class="input-group">
                                <span class="input-group-addon"> Station Number</span>
                                <input type="text" name="stationNo" id="stationNoManager" class="form-control"   readonly value="<?php echo $userdetails->StationNumber;?>">


                            </div>
                        </div>
                    </div> -->
                <?php } ?>


                <?php if($userrole=='Senior Weather Observer'){ 

                    ?>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"> User Role</span>
                            <select name="role"  id="role"  required class="form-control" placeholder="Select Role">
                                <option value="">--Select User Roles--</option>
                                <option value="Observer">Observer</option>
                                <option value="Senior Weather Observer">Senior Weather Observer</option>
                            </select>
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Region</span>
                            <input type="text" name="RegionName" id="stationNoManager"  class="form-control text-danger"
                            value="<?php echo $userRegion ;?>" readonly>

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">

                            <span class="input-group-addon">Station</span>
                            <input type="" name="station" class="form-control" value="<?php echo $userstation;?>" readonly>
                        </div>
                    </div>





                    <div class="form-group">
                        <div class="input-group">

                            <span class="input-group-addon">Station Number</span>
                            <input type="text" name="stationNo" id="stationNoManager"  class="form-control text-danger" value="<?php echo $userstationNo?>" readonly>
                        </div>
                    </div>



                <?php  }  ?>





                <!-- <?php } ?> -->

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer clearfix">



            <button type="submit" name="updateStationUserDetails_button" id="updateStationUserDetails_button" class="btn btn-primary"><i class="fa fa-plus"></i> Update User</button>
            <a  href="<?php echo base_url(); ?>index.php/Users/" class="btn btn-danger pull-left"><i class="fa fa-times"></i> Cancel</a>
        </div>
    </form>
</div>
<?php
}
else{
    ?>



    <div class="row">
        <div class="col-xs-12">
            <a class="btn btn-primary no-print"
            href="<?php echo base_url(); ?>index.php/Users/DisplayStationUsersForm/">
            <i class="fa fa-plus"></i> Add new User</a>
            <?php if($userrole=="Manager" || $userrole=="ManagerData"){
               if($send_mail=='True'){ ?>
                <a class="btn btn-danger no-print pull-right"
                href="<?php echo base_url(); ?>index.php/Users/control_mail/">
                <i class="fa fa-envelope"> </i> Disable email notifications
            </a>
        <?php }else{ ?>
            <a class="btn btn-primary no-print pull-right"
            href="<?php echo base_url(); ?>index.php/Users/control_mail/">
            <i class="fa fa-envelope"> </i> Enable email notifications
        </a>
    <?php } }?>

</div>

<?php require_once(APPPATH . 'views/error.php'); ?>


</div>  

<br>
<div class="row">
    <div class="col-xs-12">

        <div class="box">
           <?php
           if(isset($message)){
            echo $message;
        }

        ?>
        <?php require_once(APPPATH . 'views/error.php'); ?>
        <div class="box-body table-responsive" style="overflow:auto;">
            <table id="example1" class="table table-bordered table-fixed table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>First Name</th>
                        <th>SurName</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Station</th>
                        <th>Station Number</th>
                        <th> Region</th>
                        <th>Sub region</th>
                        <th>Role</th>
                        <th>CreatedBy</th>
                        <th class="no-print">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;

                    if (is_array($allusers) && count($allusers)) {
                        foreach($allusers as $userdetails){
                            $count++;
                            $userdetailsid = $userdetails->Userid;



                            ?>
                            <tr>
                                <td ><?php echo $count;?></td>
                                <td ><?php echo $userdetails->FirstName;?></td>
                                <td ><?php echo $userdetails->SurName;?></td>
                                <td ><?php echo $userdetails->UserPhone;?></td>
                                <td ><?php echo $userdetails->UserEmail;?></td>
                                <td ><?php echo $userdetails->StationName;?></td>
                                <td ><?php echo $userdetails->StationNumber;?></td>
                                <td ><?php echo $userdetails->station==0? $userdetails->region_zone: $userdetails->StationRegion;?></td>
                                <td ><?php echo $userdetails->UserSubRegion;?></td>
                                <td><?php echo $userdetails->UserRole;?></td>
                                <td><?php echo $userdetails->CreatedBy;?></td>
                                <td class="no-print">
                                    <?php if($userrole=='Manager' || $userrole=='ManagerData'||$userrole == "ManagerStationNetworks"||$userrole == "ZonalOfficer"||$userrole=="SeniorZonalOfficer"){ ?>

                                     
                                           <table>
                                            <tr>
                                               
                                               <?php if(strcasecmp($userdetails->CreatedBy, $userrole) == 0){
                                                ?>
                                                 <td>
                                                    <a class="btn btn-primary" href="<?php echo base_url() . "index.php/Users/DisplayStationUsersFormForUpdate/" .$userdetailsid ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li>Edit</a></td>
                                                <?php }
                                                else{
                                                    ?>

                                                        <td class="td-inline">
                                                         <a class="btn btn-primary blocked" ><li class="fa fa-edit"></li> Edit</a>

                                                     </td>

                                                <?php }  ?>


                                                    <?php $fname =$userdetails->FirstName;$lname=$userdetails->SurName;

                                                    if(($userrole=='ManagerData' || $userrole=='Manager'||$userrole=='Senior Weather Observer'||$userrole=='ManagerStationNetworks'||$userrole=='ZonalOfficer'||$userrole=="SeniorZonalOfficer") && $userdetails->Active == 1){ ?><td> 
                                                        <a class="btn btn-danger" href="<?php echo base_url() . "index.php/Users/deleteUser/" .$userdetailsid ;?>"
                                                          onClick="return confirm('Are you sure you want to deactivate <?php echo $fname.' '.$lname;?>');">
                                                          <li class="fa fa-times"></li> Deactivate</a>
                                                      </td>
                                                  <?php }
                                                  else if(($userrole=='ManagerData'||$userrole=='ManagerStationNetworks'||$userrole=='ZonalOfficer'||$userrole=="SeniorZonalOfficer") && $userdetails->Active == 0){ ?>
                                                      <td> 
                                                          <a class="btn btn-success" href="<?php echo base_url() . "index.php/Users/activateUser/" .$userdetailsid ;?>"
                                                            onClick="return confirm('Are you sure you want to Activate <?php echo $fname.' '.$lname;?>');"><li class="fa fa-check"></li>&nbsp;&nbsp;Activate&nbsp;&nbsp;&nbsp;</a>
                                                        </td>
                                                    <?php }
                                                    ?>
                                                </tr></table>
                                     <?php }?>

                              <?php if($userrole=='Senior Weather Observer'){ ?>

                                            <?php

                                       if(strcasecmp($userdetails->CreatedBy, $userrole) == 0){
                               
                                           ?>
                                           <table>
                                            <tr>
                                                <td>
                                                    <a class="btn btn-primary" href="<?php echo base_url() . "index.php/Users/DisplayStationUsersFormForUpdate/" .$userdetailsid ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li>Edit</a></td>


                                                    <?php $fname =$userdetails->FirstName;$lname=$userdetails->SurName;

                                                    if(($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='Senior Weather Observer') && $userdetails->Active == 1){ ?><td> 
                                                        <a class="btn btn-danger" href="<?php echo base_url() . "index.php/Users/deleteUser/" .$userdetailsid ;?>"
                                                          onClick="return confirm('Are you sure you want to deactivate <?php echo $fname.' '.$lname;?>');">
                                                          <li class="fa fa-times"></li> Deactivate</a>
                                                      </td>
                                                  <?php }
                                                  else if($userrole=='ManagerData' && $userdetails->Active == 0){ ?>
                                                      <td> 
                                                          <a class="btn btn-success" href="<?php echo base_url() . "index.php/Users/activateUser/" .$userdetailsid ;?>"
                                                            onClick="return confirm('Are you sure you want to Activate <?php echo $fname.' '.$lname;?>');"><li class="fa fa-check"></li>&nbsp;&nbsp;Activate&nbsp;&nbsp;&nbsp;</a>
                                                        </td>
                                                    <?php }
                                                    ?>
                                                </tr></table>
                                                  <?php 
                                            }
                                            else{

                                                ?>
                                                <table>
                                                    <tr>

                                                        <td class="td-inline">
                                                         <a class="btn btn-primary blocked" ><li class="fa fa-edit"></li> Edit</a>

                                                     </td>

                                                     <?php
                                                     if($userdetails->Active == 0){
                                                        ?>
                                                        <td>
                                                         <a  class="btn btn-success blocked">   
                                                            <li class="fa fa-check"></li>
                                                            Activate
                                                        </a></td>

                                                    <?php }
                                                    else if($userdetails->Active == 1){
                                                     ?> 
                                                     <td>
                                                         <a  class="btn btn-danger blocked"> 
                                                             <li class="fa fa-times"></li>Deactivate  
                                                         </a></td>
                                                     <?php } ?>

                                                 </tr>
                                             </table>
                                         <?php } ?>

                                     <?php } ?>






                                 </td>
                             </tr>
                             <?php
                         }
                     }
                     ?>
                 </tbody>
             </table>
             <br><br>
             <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
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

             getStationID();
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
        alert("press ok");
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
              var a = new Option("option text", "");
              $(a).html("All Sub regions");
              $('#subregions-list').append(a);

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
        alert("press ok");
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
                alert("press ok");
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
            alert("press ok");
        },
        dataType: 'text'
    });
       }


   }



});
</script>

<script>
    $(document).ready(function() {
     hideAll();

     $('.blocked').click(function(){
       alert("You cannot do any action on this user since you didnt create this user's account");
   });


     var tied_users = new Array('Observer','Senior Weather Observer','WeatherForecaster');
     var nontied_users = new Array('SeniorDataOfficer',
        'DataOfficer','WeatherAnalyst','SeniorDataOfficer','ManagerStationNetworks','ManagerData');
     var tiedToRegion = new Array('ZonalOfficer','SeniorZonalOfficer');

     function hideAll(){
        $('.region').hide();
        $('.subregion').hide();
        $('.station').hide();
        $('.stationno').hide();
    }

    function showAll(){
        $('.region').show();
        $('.station').show();
        $('.stationno').show();
    } 

    function showOnlyRegion(){
        $('.region').show();
        //$('.subregion').show();
        $('.station').hide();
        $('.stationno').hide();
    }


    $('#role').change(function(){
        docheckEmptyFields();
    });


    function docheckEmptyFields(){
        var role = $('#role').val();
        if(role=='ZonalOfficer'){
          $('.subregion').show();
        }else{
            $('.subregion').hide(); 
        }
        if(role){
            if(tied_users.includes(role)){
              showAll();               
                  }
                  else if(nontied_users.includes(role)){
                     hideAll();
                 }
                  else if(tiedToRegion.includes(role)){
                    
                     showOnlyRegion();
                 }
                //  else{
                //     hideAll();
                //     alert('Ask your administrator, something is wrong');
                // }
            }else{
                alert('probs');
                hideAll();
            }
        }


                //Post metar form data into the DB
                //Validate each field before inserting into the DB
                $('#saveStationUserDetails_button').click(function(event) {


                    var returntruthvalue=checkDuplicateEntryData_OnSaveNewUserDetails();
                    //if true there is already an entry
                    if(returntruthvalue=="true"){

                        alert("USER Record With the (station,station Number) or Station Region and First Name,SurName AND ROLE exists already in the db");
                        return false;
                    }else if(returntruthvalue=="Missing"){

                        alert("Station Name or Number not picked");
                        return false;
                    }


                    //Check value of the hidden text field.That stores whether a row is duplicate for OC.
                   //  var hiddenvalue=$('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').val();
                   // if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                   //      alert("Value not picked");
                   //      $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').val("");  //Clear the field.
                   //     $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").focus();
                   //      return false;

                   // }



                    //FOR MANAGER SELECT EITHER OC OR ZONAL OFFICER OR SENIOR ZONAL OFFICER
                    var user_Role_AssignedBy_Manager=$('#user_Role_AssignedBy_Manager').val();
                    if(user_Role_AssignedBy_Manager==""){  // returns true if the variable does NOT contain a valid number
                        alert("Station Role not picked");
                        $('#user_Role_AssignedBy_Manager').val("");  //Clear the field.
                        $("#user_Role_AssignedBy_Manager").focus();
                        return false;
                    }
    ////////////////////////////////////////////////////////////////////////////////////////
    if(user_Role_AssignedBy_Manager=="Senior Weather Observer"){
                    //IF USER ROLE ASSIGNED BY MANAGER IS (OC)
                    //Check that the a station Name is selected from the list.
                    var user_station_Manager=$('#user_station_Manager').val();
                    if(user_station_Manager==""){
                        alert("Please Select A Station from the list");
                        $('#user_station_Manager').val("");  //Clear the field.
                        $("#user_station_Manager").focus();
                        return false;

                    }
                    //Check that the a station Number is autofilled
                    var user_stationNo_Manager=$('#user_stationNo_Manager').val();
                    if(user_stationNo_Manager==""){
                        alert("Station Number not picked");
                        $('#user_stationNo_Manager').val("");  //Clear the field.
                        $("#user_stationNo_Manager").focus();
                        return false;

                    }

                    //HIDDEN TEXT FIELD
                    //Check that the a station Region is autofilled
                   // var user_stationRegion_Manager=$('#user_stationRegion_Manager').val();
                   // if(user_stationRegion_Manager==""){
                    //    alert("Station Region not picked");
                    //    $('#user_stationRegion_Manager').val("");  //Clear the field.
                    //    $("#user_stationRegion_Manager").focus();
                     //   return false;

                   // }
               }else{
    //////////////////////////////////////////////////////////////////////////////

                    //IF USER ROLE ASSIGNED BY MANAGER IS (ZONAL  OFFICER AND SENIOR ZONAL OFFICER)
                    var user_stationRegion_AssignedBy_Manager=$('#user_stationRegion_AssignedBy_Manager').val();
                    if(user_stationRegion_AssignedBy_Manager=="" && user_Role_AssignedBy_Manager != 'SeniorDataOfficer' && user_Role_AssignedBy_Manager != 'DataOfficer' && user_Role_AssignedBy_Manager != 'ManagerData'&& user_Role_AssignedBy_Manager != 'ManagerStationNetworks'){  // returns true if the variable does NOT contain a valid number
                        alert("Station Region not picked");
                        $('#user_stationRegion_AssignedBy_Manager').val("");  //Clear the field.
                        $("#user_stationRegion_AssignedBy_Manager").focus();
                        return false;

                    }

                }
    //////////////////////////////////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////////////////////////////////////
                    //FOR OC SELECT EITHER Observer,ObserverDataEntrant
                    //Check that the a station Number is selected from the list of stations(Manager)
                    var user_Role_AssignedBy_OC=$('#user_Role_AssignedBy_OC').val();
                    if(user_Role_AssignedBy_OC==""){  // returns true if the variable does NOT contain a valid number
                        alert("Please Select User Roles");
                        $('#user_Role_AssignedBy_OC').val("");  //Clear the field.
                        $("#user_Role_AssignedBy_OC").focus();
                        return false;

                    }
                    if(user_Role_AssignedBy_OC=="Observer" || user_Role_AssignedBy_OC=="ObserverArchive" || user_Role_AssignedBy_OC=="ObserverDataEntrant"){
                    //Check that the a station is autofilled
                    var user_station_OC=$('#user_station_OC').val(); //ReadOnly
                    if(user_station_OC==""){
                        alert("Station not picked");
                        $('#user_station_OC').val("");  //Clear the field.
                        $("#user_station_OC").focus();
                        return false;

                    }
                    //Check that the a station Number is autofilled
                    var user_stationNo_OC=$('#user_stationNo_OC').val(); //ReadOnly
                    if(user_stationNo_OC==""){
                        alert("Station Number not picked");
                        $('#user_stationNo_OC').val("");  //Clear the field.
                        $("#user_stationNo_OC").focus();
                        return false;

                    }
                    //Check that the a station Region is autofilled
                   // var user_stationRegion_OC=$('#user_stationRegion_OC').val(); //ReadOnly
                   // if(user_stationRegion_OC==""){
                     //   alert("Station Region not picked");
                     //   $('#user_stationRegion_OC').val("");  //Clear the field.
                     //   $("#user_stationRegion_OC").focus();
                     //   return false;

                 //   }
             }

         });
});
</script>
<script>
            //CHECK DB IF THE METAR ALREADY EXISTS
            function checkDuplicateEntryData_OnSaveNewUserDetails(){

                //Check against the date,stationName,StationNumber,Time and Metar Option.
                var firstname = $('#user_firstname').val();
                //alert(firstname);
                //return false;
                var surname = $('#user_surname').val();
               // var username=firstname
               var email = $('#user_email').val();


               var user_Role_AssignedBy_Manager=$('#user_Role_AssignedBy_Manager').val();
               var user_Role_AssignedBy_OC=$('#user_Role_AssignedBy_OC').val();


               if(user_Role_AssignedBy_Manager=="Senior Weather Observer"){

                var stationName_Manager = $('#user_station_Manager').val();
                var stationNumber_Manager = $('#user_stationNo_Manager').val();
            }

            if(user_Role_AssignedBy_OC=="Observer" || user_Role_AssignedBy_OC=="ObserverArchive" || user_Role_AssignedBy_OC=="ObserverDataEntrant" ){
                var stationName_OC = $('#user_station_OC').val();
                var stationNumber_OC = $('#user_stationNo_OC').val();
            }

                // stationName;
                // stationNumber;


                if((stationName_Manager!=undefined)&&(stationNumber_Manager!=undefined)){

                   var  stationName=stationName_Manager;
                   var  stationNumber=  stationNumber_Manager;

               }else if((stationName_OC!=undefined)&&(stationNumber_OC!=undefined)){


                   var  stationName=stationName_OC;
                   var  stationNumber=  stationNumber_OC;
               }

               if((stationName==undefined)&& (stationNumber==undefined) ){

                 stationName="null";
                 stationNumber="null";
             }

               // var user_Role_AssignedBy_Manager=$('#user_Role_AssignedBy_Manager').val();

               if(user_Role_AssignedBy_Manager=="ZonalOfficer" || user_Role_AssignedBy_Manager=="SeniorZonalOfficer" ){

                var user_stationRegion_AssignedBy_Manager=$('#user_stationRegion_AssignedBy_Manager').val();
                var stationRegion=user_stationRegion_AssignedBy_Manager;
            }

            if(stationRegion==undefined){

             stationRegion="null";

         }

         if(user_Role_AssignedBy_Manager!=undefined){

            var userRole=user_Role_AssignedBy_Manager;
        }else if(user_Role_AssignedBy_OC!=undefined){

            var userRole=user_Role_AssignedBy_OC;
        }

              // alert(stationName);
               // return false;

               $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').val("");

               if ((firstname != undefined) && (surname != undefined) && (email != undefined) && (userRole!=undefined)) {
                    //alert("StationName  "+stationName+ "StationNumber "+stationNumber+"  StationRegion"+stationRegion);
                    //alert(firstname+surname+email);
                    // return false;
                  // if((stationName=="") || (stationName != undefined) ||   (stationNumber=="") || (stationNumber!=undefined) ||(stationRegion=="")  ||(stationRegion!=undefined)){
                    $.ajax({
                        url: "<?php echo base_url(); ?>"+"index.php/Users/checkInDBIfUserDetailsRecordExistsAlready",
                        type: "POST",
                        data:{'firstname':firstname,'surname':surname,'email':email,'stationName': stationName,'stationNumber':stationNumber,'stationRegion':stationRegion,'userRole':userRole},
                        cache: false,
                        async: false,

                        success: function(data){

                            if(data=="true"){

                                $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').empty();

                               //  alert(data);
                               // return false;
                               $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val(data);

                           }
                           else if(data=="false"){
                            $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield').empty();

                                //alert(data);
                               // return false;
                               $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val(data);

                           }
                       }

                    });//end of ajax

                    var truthvalue=$("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield").val();
                 //  }
                }//end of if

                else if((firstname == undefined) || (surname == undefined) ||  (email == undefined)  ){

                    var truthvalue="Missing";
                }

                return truthvalue;


            }//end of check duplicate values in the DB


        </script>
        <script>
            //CHECK DB IF THE METAR ALREADY EXISTS
            function checkDuplicateEntryData_OnSaveNewUserDetails2(){

                //Check against the date,stationName,StationNumber,Time and Metar Option.
                var firstname = $('#user_firstname').val();
                //alert(firstname);
                //return false;
                var surname = $('#user_surname').val();
                // var username=firstname
                var email = $('#user_email').val();

                var user_Role_AssignedBy_Manager=$('#user_Role_AssignedBy_Manager').val();

                if(user_Role_AssignedBy_Manager=="ZonalOfficer" || user_Role_AssignedBy_Manager=="SeniorZonalOfficer" ){

                    var user_stationRegion_AssignedBy_Manager=$('#user_stationRegion_AssignedBy_Manager').val();
                    var stationRegion=user_stationRegion_AssignedBy_Manager;
                }


                $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2').val("");

                if ((firstname != undefined) && (surname != undefined)  && (stationRegion != undefined) && (email != undefined)  ) {
                    $.ajax({
                        url: "<?php echo base_url(); ?>"+"index.php/Users/checkInDBIfUserDetailsRecordExistsAlreadyWithSameStationRegion",
                        type: "POST",
                        data:{'firstname':firstname,'surname':surname,'email':email,'stationRegion': stationRegion},
                        cache: false,
                        async: false,

                        success: function(data){

                            if(data=="true"){

                                $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2').empty();

                                //alert(data);
                                //return false;
                                $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2").val(data);

                            }
                            else if(data=="false"){
                                $('#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2').empty();

                                //alert(data);
                                $("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2").val(data);

                            }
                        }

                    });//end of ajax

                    var truthvalue=$("#checkduplicateEntryOnAddUserStationInformation_hiddentextfield2").val();

                }//end of if

                else if((firstname == undefined) || (surname == undefined) || (stationRegion == undefined)  || (email == undefined) ){

                    var truthvalue="Missing";
                }

                return truthvalue;
                //alert(truthvalue);
                // return false;

            }//end of check duplicate values in the DB


        </script>


        <script>
            $(document).ready(function() {
                //Update  Archive metar form data into the DB
                //Validate each field before inserting into the DB
                $('#updateStationUserDetails_button').click(function(event) {




                    //Check that id of the row is picked
                    var rowid=$('#id').val();
                    if(rowid==""){  // returns true if the variable does NOT contain a valid number
                        alert("Row id not picked");
                        $('#id').val("");  //Clear the field.
                        $("#id").focus();
                        return false;

                    }


                    //Check that Email is filled
                    //Check that Email is filled
                    var email=$('#email').val();
                    var filter= /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    if (!filter.test(email)) {
                        alert('Please provide a valid email address');
                        $('#email').val("");  //Clear the field.
                        $("#email").focus();
                        return false;

                    }


                    //FOR MANAGER SELECT EITHER OC OR ZONAL OFFICER OR SENIOR ZONAL OFFICER
                    var Role_AssignedBy_Manager=$('#Role_AssignedBy_Manager').val();
                    if(Role_AssignedBy_Manager==""){  // returns true if the variable does NOT contain a valid number
                        alert("Station Role not picked");
                        $('#Role_AssignedBy_Manager').val("");  //Clear the field.
                        $("#Role_AssignedBy_Manager").focus();
                        return false;

                    }

                }); //button
                //  return false;

            });  //document
        </script>



        <script type="text/javascript">
            //Once the Manager selects the Station the Station Number, should be picked from the DB.
            // For Add User when user is OC
            $(document).on('change','#user_station_Manager',function(){
                $('#user_stationNo_Manager').val("");  //Clear the field.
                

                var stationName = this.value;
                if (stationName != "") {
                    //alert(station);
                    $('#user_stationNo_Manager').val("");

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

                                $('#user_stationNo_Manager').empty();
                                $('#user_stationId_Manager').empty();

                                 //alert(data);
                                 $("#user_stationNo_Manager").val(json[0].StationNumber);
                                 $("#user_stationId_Manager").val(json[0].station_id);
                                 $("#user_stationRegion_AssignedBy_Manager").val(json[0].StationRegion);



                             }
                             else{

                                $('#user_stationNo_Manager').empty();
                                $('#user_stationNo_Manager').val("");
                                $('#user_stationRegion_AssignedBy_Manager').empty();
                                $('#user_stationRegion_AssignedBy_Manager').val("");
                                



                            }
                        }

                    });



                }
                else {
                    $('#user_stationNo_Manager').empty();
                    $('#user_stationNo_Manager').val("");

                }

            })
        </script>
        <script type="text/javascript">
            //Once the Manager selects the Station the Station Number, should be picked from the DB.
            // For Update User when user is OC
            $(document).on('change','#station_Manager',function(){
                $('#stationNo_Manager').val("");  //Clear the field.

                var stationName = this.value;


                if (stationName != "") {
                    //alert(station);
                    $('#stationNo_Manager').val("");

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

                                $('#stationNo_Manager').empty();


                                // alert(data);
                                $("#stationNo_Manager").val(json[0].StationNumber);
                                $("#stationid").val(json[0].station_id);
                                $("#stationRegion_AssignedBy_Manager").val(json[0].StationRegion);


                            }
                            else{

                                $('#stationNo_Manager').empty();
                                $('#stationNo_Manager').val("");



                            }
                        }

                    });



                }
                else {
                    $('#stationNo_Manager').empty();
                    $('#stationNo_Manager').val("");

                }

            })
        </script>

        <script type="text/javascript">
            //The Manager  Station is autopopulated on Update User(OC).The Station Number  shd be picked frm DB
            //Update User for OC
            var stationName =  $('#station_Manager').val();
            var roleName =  $('#Role_AssignedBy_Manager').val();
          //  $('#stationNo_Manager').html('');//Clear the field.

          if (stationName != "" && roleName != 'ZonalOfficer' && roleName != 'SeniorZonalOfficer') {
                //alert(station);
                $('#stationNo_Manager').val("");

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

                            $('#stationNo_Manager').empty();


                            // alert(data);
                            $("#stationNo_Manager").val(json[0].StationNumber);
                            $("#stationid").val(json[0].station_id);
                            $("#stationRegion_AssignedBy_Manager").val(json[0].StationRegion);



                        }
                        else{

                            $('#stationNo_Manager').empty();
                            $('#stationNo_Manager').val("");
                            $('#stationRegion_AssignedBy_Manager').empty();
                            $('#stationRegion_AssignedBy_Manager').val("");


                        }
                    }

                });



            }
            else if(roleName == 'ZonalOfficer' || roleName == 'SeniorZonalOfficer'){
                var zonalnumber = <?php echo $this->uri->segment(3);?>;
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Stations/getZonalRegion",
                    type: "POST",
                    data: {'zonalnumber': zonalnumber},
                    cache: false,
                    //dataType: "JSON",
                    success: function(data){
                        if (data)
                        {
                            var json = JSON.parse(data);

                           // $('#stationNo_Manager').empty();


                            // alert(data);
                            //$("#stationNo_Manager").val(json[0].StationNumber);
                              //$("#stationid").val(json[0].station_id);
                              $("#stationRegion_AssignedBy_Manager").val(json[0].region_zone);



                          }
                          else{

                            //$('#stationNo_Manager').empty();
                            //$('#stationNo_Manager').val("");
                            $('#stationRegion_AssignedBy_Manager').empty();
                            $('#stationRegion_AssignedBy_Manager').val("");


                        }
                    }

                });
            }

            else if(roleName == 'ManagerStationNetworks'||roleName == 'DataOfficer' || roleName == 'SeniorDataOfficer'){
                //alert('hey');
                $('#stationRegion_AssignedBy_Manager').empty();
                $('#stationRegion_AssignedBy_Manager').val("");
                $('#station_Manager').attr('readonly', true);  //Enforce the readOnly Attribute

                $('#station_Manager').empty();
                $('#station_Manager').val("");
                
            }
            
            else {

               // $('#stationNo_Manager').empty();
               // $('#stationNo_Manager').val("");
               // $('#stationRegion_AssignedBy_Manager').empty();
               // $('#stationRegion_AssignedBy_Manager').val("");


           }
       </script>
       <script type="text/javascript">
            //The OC  Station is autopopulated on Update User.The Station Number and Station Region shd be picked frm DB
            //Add User
            var stationName =  $('#user_station_OC').val();
            $('#user_stationNo_OC').html('');//Clear the field.


            if (stationName != "") {
                //alert(station);
                $('#user_stationNo_OC').val("");

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

                            $('#user_stationNo_OC').empty();
                            $('#user_stationRegion_AssignedBy_Manager').empty();

                            //alert(data);
                            $("#user_stationNo_OC").val(json[0].StationNumber);
                            $("#user_stationRegion_AssignedBy_Manager").val(json[0].StationRegion);
                            



                        }
                        else{

                            $('#user_stationNo_OC').empty();
                            $('#user_stationNo_OC').val("");



                        }
                    }

                });



            }
            else {

                $('#user_stationNo_OC').empty();
                $('#user_stationNo_OC').val("");


            }


        </script>

        <script type="text/javascript">
            //The OC  Station is autopopulated on Update User.The Station Number and Station Region shd be picked frm DB
            //Update User
            var stationName =  $('#station_OC').val();
            $('#stationNo_OC').html('');//Clear the field.
            if (stationName != "") {
                //alert(station);
                $('#stationNo_OC').val("");

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

                            $('#stationNo_OC').empty();


                            // alert(data);
                            $("#stationNo_OC").val(json[0].StationNumber);


                        }
                        else{

                            $('#stationNo_OC').empty();
                            $('#stationNo_OC').val("");



                        }
                    }

                });



            }
            else {

                $('#stationNo_OC').empty();
                $('#stationNo_OC').val("");


            }


        </script>
          <!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.1/css/jquery.dataTables.css"> -->
         <script src="<?php echo base_url(); ?>js/custom.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>css/select2/js/select2.min.js" type="text/javascript"></script>
        <?php require_once(APPPATH . 'views/footer.php'); ?>
