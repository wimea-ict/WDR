<?php require_once(APPPATH . 'views/header.php'); ?>
<?php
$session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Stations
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Stations</li>


        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php require_once(APPPATH . 'views/error.php'); ?>
     
    <?php if(isset($stationsdata)){ ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <?php require_once(APPPATH . 'views/error.php'); ?>
                    <div class="box-body table-responsive" style="overflow:auto;">
                          <div class="row" style="padding:20px;">
                            <form action="<?php echo base_url(); ?>index.php/Stations/Displaystations/" method="post">
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Region</span>
                                            <select name="region" id="region"  onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                                <option value="">--Region--</option>
                                                <?php foreach($regions as $region){ ?>
                                                <option value="<?php echo $region->region ?>"><?php echo $region->region ?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Sub Region</span>
                                            <select name="subregion" id="subregion"  onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                                <option value="">--Sub Region--</option>
                                                <?php foreach($regions as $region){
                                                   foreach($subregions as $subregion){ 
                                                  if($subregion->StationRegion==$region->region){
                                                ?>
                                                <option id="<?php echo $region->region ?>" value="<?php echo $subregion->subregion ?>"><?php echo $subregion->subregion; ?></option>
                                                <?php } }} ?>
                                            </select>
                                         </div>
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">District</span>
                                            <select name="district" id="district" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                                <option value="">--District--</option>
                                                <?php 
                                                   foreach($district as $district){ 
                                                ?>
                                                <option id="<?php echo $district->subregion ?>" value="<?php echo $district->district ?>"><?php echo $district->district ?></option>
                                                <?php  } ?>
                                            </select>
                                         </div>
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">County</span>
                                            <select name="county" id="county" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                                <option value="">--County--</option>
                                                <?php foreach($counties as $counties){ ?>
                                                <option id="<?php echo $counties->district ?>" value="<?php echo $counties->county ?>"><?php echo $counties->county ?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Subcounty</span>
                                            <select name="subcounty" id="subcounty" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                                <option value="">--Subcounty--</option>
                                                <?php foreach($subcounties as $subcounties){ ?>
                                                <option id="<?php echo $subcounties->county ?>" value="<?php echo $subcounties->subcounty ?>"><?php echo $subcounties->subcounty ?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Parish</span>
                                            <select name="parish" id="parish" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                                <option value="">--Parish--</option>
                                                <?php foreach($parish as $parish){ ?>
                                                <option id="<?php echo $parish->subcounty ?>" value="<?php echo $parish->parish ?>"><?php echo $parish->parish ?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Village</span>
                                            <select name="village" id="village" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                                <option value="">--Village--</option>
                                                <?php foreach($village as $village){ ?>
                                                <option id="<?php echo $village->parish ?>" value="<?php echo $village->village ?>"><?php echo $village->village ?></option>
                                                <?php } ?>
                                            </select>
                                         </div>
                                       </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-info  pull-right">Apply Filters</button>
                                       </div>
                                   </div>
                              </form>
                         </div>
                         <div class="box-header">
                        <hr>
                        <h3 class="box-title">Stations</h3>
                    </div><!-- /.box-header -->
                        <table id="example1" class="table table-bordered table-striped "  style="margin-top:30px;">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Station Name</th>
                                <th>Station Number</th>
                                <th>Block Number</th>
                                <th>Station Reg No</th>
                                <th>Location</th>
                                <th>Indicator </th>
                                <th>Country</th>
                                <th>Region</th>
                                <th>Sub Region</th>
                                <th>District</th>
                                <th>County</th>
                                <th>Sub county</th>
                                <th>Parish</th>
                                <th>Village</th>
                                <th>Height</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Altitude</th>
                                <th>Max expected Temp</th>
                                <th>Min expected Temp</th>
                                <th>Max expected Rain</th>
                                <th>Min expected windspeed</th>
                                <th>Max expected Windspeed</th>
                                <th>Unit of wind speed</th>
                                <th>Created by</th>
                                <th>Creation Date</th>
                                <th>Station Category</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;

                            if (is_array($stationsdata) && count($stationsdata)) {
                                foreach($stationsdata as $stationdata){
                                    $count++;
                                    $stationid = $stationdata->id;
                                    ?>
                                    <tr>
                                        <td ><?php echo $count;?></td>
                                        <td ><?php echo $stationdata->StationName;?></td>
                                        <td ><?php echo $stationdata->StationNumber;?></td>
                                        <td ><?php echo $stationdata->blocknumber;?></td>
                                        <td><?php echo $stationdata->StationRegNumber;?></td>
                                        <td ><?php echo $stationdata->Location;?></td>
                                        <td ><?php echo $stationdata->Indicator;?></td>
                                        <td ><?php echo $stationdata->Country;?></td>
                                        <td ><?php echo $stationdata->StationRegion;?></td>
                                        <th><?php echo $stationdata->subregion;?></th>
                                        <th><?php echo $stationdata->district;?></th>
                                        <th><?php echo $stationdata->county;?></th>
                                        <th><?php echo $stationdata->subcounty;?></th>
                                        <th><?php echo $stationdata->parish;?></th>
                                        <th><?php echo $stationdata->village;?></th>
                                        <td ><?php echo $stationdata->Height;?></td>
                                        <td><?php echo $stationdata->Latitude;?></td>
                                        <td ><?php echo $stationdata->Longitude;?></td>
                                        <td ><?php echo $stationdata->Altitude;?></td>
                                        <th><?php echo $stationdata->max_expectedtemp;?></th>
                                        <th><?php echo $stationdata->min_expectedtemp;?></th>
                                        <th><?php echo $stationdata->max_expectedrain;?></th>
                                        <th><?php echo $stationdata->min_expectedwindspeed;?></th>
                                        <th><?php echo $stationdata->max_expectedwindspeed;?></th>
                                        <th><?php echo $stationdata->UnitOfWind_Speed;?></th>
                                        <th><?php echo $stationdata->SubmittedBy;?></th>
                                        <th><?php echo $stationdata->Creation_Date;?></th>
                                        <th><?php echo $stationdata->stationCategory;?></th>
                                    </tr>

                                <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
						         
		              
												<br><br>
                        <!-- <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT </button> -->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
     <?php } ?>





     <?php if(isset($stationsperfomance)){ ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?php require_once(APPPATH . 'views/error.php'); ?>
            <div class="box-body table-responsive" style="overflow:auto;">
                  <div class="row" style="padding:20px;">
                    <form action="<?php echo base_url(); ?>index.php/Stations/StationPerfomance/" method="post">
                           <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Region</span>
                                    <select name="region" id="region"  onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                        <option value="">--Region--</option>
                                        <?php foreach($regions as $region){ ?>
                                        <option value="<?php echo $region->region ?>"><?php echo $region->region ?></option>
                                        <?php } ?>
                                    </select>
                                 </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Sub Region</span>
                                    <select name="subregion" id="subregion"  onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                        <option value="">--Sub Region--</option>
                                        <?php foreach($regions as $region){
                                           foreach($subregions as $subregion){ 
                                          if($subregion->StationRegion==$region->region){
                                        ?>
                                        <option id="<?php echo $region->region ?>" value="<?php echo $subregion->subregion ?>"><?php echo $subregion->subregion; ?></option>
                                        <?php } }} ?>
                                    </select>
                                 </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">District</span>
                                    <select name="district" id="district" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                        <option value="">--District--</option>
                                        <?php 
                                           foreach($district as $district){ 
                                        ?>
                                        <option id="<?php echo $district->subregion ?>" value="<?php echo $district->district ?>"><?php echo $district->district ?></option>
                                        <?php  } ?>
                                    </select>
                                 </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">County</span>
                                    <select name="county" id="county" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                        <option value="">--County--</option>
                                        <?php foreach($counties as $counties){ ?>
                                        <option id="<?php echo $counties->district ?>" value="<?php echo $counties->county ?>"><?php echo $counties->county ?></option>
                                        <?php } ?>
                                    </select>
                                 </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Subcounty</span>
                                    <select name="subcounty" id="subcounty" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                        <option value="">--Subcounty--</option>
                                        <?php foreach($subcounties as $subcounties){ ?>
                                        <option id="<?php echo $subcounties->county ?>" value="<?php echo $subcounties->subcounty ?>"><?php echo $subcounties->subcounty ?></option>
                                        <?php } ?>
                                    </select>
                                 </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Parish</span>
                                    <select name="parish" id="parish" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                        <option value="">--Parish--</option>
                                        <?php foreach($parish as $parish){ ?>
                                        <option id="<?php echo $parish->subcounty ?>" value="<?php echo $parish->parish ?>"><?php echo $parish->parish ?></option>
                                        <?php } ?>
                                    </select>
                                 </div>
                               </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Village</span>
                                    <select name="village" id="village" onchange="Disabled()" onkeyup="allowCharactersInputOnly(this)"  class="form-control"   placeholder="Enter Status" >
                                        <option value="">--Village--</option>
                                        <?php foreach($village as $village){ ?>
                                        <option id="<?php echo $village->parish ?>" value="<?php echo $village->village ?>"><?php echo $village->village ?></option>
                                        <?php } ?>
                                    </select>
                                 </div>
                               </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Start Date</span>
                                    <input type="date" name="startdate" id="" class="form-control">
                                 </div>
                               </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">End date</span>
                                    <input type="date" name="enddate" id="" class="form-control">
                                 </div>
                               </div>
                            </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                <button type="submit" class="btn btn-info  pull-right">Apply Filters</button>
                               </div>
                           </div>
                      </form>
                 </div>
                 <div class="box-header">
                <hr>
                <h2 class="box-title"> STATIONS PERFOMANCE</h2>
            </div><!-- /.box-header -->
                <table id="example1" class="table table-bordered table-striped "  style="margin-top:30px;">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Station Name</th>
                        <th>Station Number</th>
                        <th>Block Number</th>
                        <th>Station Reg No</th>
                        <th>Location</th>
                        <th>Indicator </th>
                        <th>Country</th>
                        <th>Region</th>
                        <th>Sub Region</th>
                        <th>District</th>
                        <th>County</th>
                        <th>Sub county</th>
                        <th>Parish</th>
                        <th>Village</th>
                        <th>Height</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Altitude</th>
                        <th>Max expected Temp</th>
                        <th>Min expected Temp</th>
                        <th>Max expected Rain</th>
                        <th>Min expected windspeed</th>
                        <th>Max expected Windspeed</th>
                        <th>Unit of wind speed</th>
                        <th>Created by</th>
                        <th>Creation Date</th>
                        <th>Station Category</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count = 0;

                    if (is_array($stationsperfomance) && count($stationsperfomance)) {
                        foreach($stationsperfomance as $stationdata){
                            $count++;
                            $stationid = $stationdata->id;
                            ?>
                            <tr>
                                <td ><?php echo $count;?></td>
                                <td ><?php echo $stationdata->StationName;?></td>
                                <td ><?php echo $stationdata->StationNumber;?></td>
                                <td ><?php echo $stationdata->blocknumber;?></td>
                                <td><?php echo $stationdata->StationRegNumber;?></td>
                                <td ><?php echo $stationdata->Location;?></td>
                                <td ><?php echo $stationdata->Indicator;?></td>
                                <td ><?php echo $stationdata->Country;?></td>
                                <td ><?php echo $stationdata->StationRegion;?></td>
                                <th><?php echo $stationdata->subregion;?></th>
                                <th><?php echo $stationdata->district;?></th>
                                <th><?php echo $stationdata->county;?></th>
                                <th><?php echo $stationdata->subcounty;?></th>
                                <th><?php echo $stationdata->parish;?></th>
                                <th><?php echo $stationdata->village;?></th>
                                <td ><?php echo $stationdata->Height;?></td>
                                <td><?php echo $stationdata->Latitude;?></td>
                                <td ><?php echo $stationdata->Longitude;?></td>
                                <td ><?php echo $stationdata->Altitude;?></td>
                                <td><?php echo $stationdata->max_expectedtemp;?></td>
                                <td><?php echo $stationdata->min_expectedtemp;?></td>
                                <td><?php echo $stationdata->max_expectedrain;?></td>
                                <td><?php echo $stationdata->min_expectedwindspeed;?></td>
                                <td><?php echo $stationdata->max_expectedwindspeed;?></td>
                                <td><?php echo $stationdata->UnitOfWind_Speed;?></td>
                                <td><?php echo $stationdata->SubmittedBy;?></td>
                                <td><?php echo $stationdata->Creation_Date;?></td>
                                <td><?php echo $stationdata->stationCategory;?></td>
                            </tr>

                        <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
                         
              
                                        <br><br>
               <!--  <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT </button> -->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
<?php } ?>

    </section><!-- /.content -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
	                           <div  id="user1" class="modal" role="dialog"  aria-labelledby="myModalLabel"  tabindex="-1" style="z-index: 9000;" data-backdrop = "false" >
                      
						<!-- Modal content-->
						<div class="modal-content">
						
						  <div class="modal-header">
							<button type="button"  class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"style="align:center;">Station Users</h4>
							<br/>
						  </div>
						  <div class="modal-body"id="modal-body">
						    
						  </div>
						  <div class="modal-footer">
						  <button style="color:white;float:right;" type="button" id="closex" class="btn btn-primary" data-dismiss="modal" ><li class="glyphicon glyphicon-remove"></li> &nbsp; Close</button>
							 </div>
						</div>

						</div>
   


  <script>

  $( document ).ready(function() {
    $('#subregion').children('option').hide();
    $('#district').children('option').hide();
    $('#county').children('option').hide();
    $('#subcounty').children('option').hide();
    $('#parish').children('option').hide();
    $('#village').children('option').hide();

   });

    $(function() {
    $('#region').change(function() {
        $('#subregion').children('option').show();
        $('#subregion').children('option:not([id="'+$('#region').val() +'"])').hide();
    });
   });

   $(function() {
    $('#subregion').change(function() {
        $('#district').children('option').show();
        $('#district').children('option:not([id="'+$('#subregion').val() +'"])').hide();
    });
   });

   $(function() {
    $('#district').change(function() {
        $('#county').children('option').show();
        $('#county').children('option:not([id="'+$('#district').val() +'"])').hide();
    });
   });

   $(function() {
    $('#county').change(function() {
        $('#subcounty').children('option').show();
        $('#subcounty').children('option:not([id="'+$('#county').val() +'"])').hide();
    });
   });

   $(function() {
    $('#subcounty').change(function() {
        $('#parish').children('option').show();
        $('#parish').children('option:not([id="'+$('#subcounty').val() +'"])').hide();
    });
   });

   $(function() {
    $('#parish').change(function() {
        $('#village').children('option').show();
        $('#village').children('option:not([id="'+$('#parish').val() +'"])').hide();
    });
   });
  </script>  

<?php require_once(APPPATH . 'views/footer.php'); ?>
