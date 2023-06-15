<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$user_station_region;
if($userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer"){
    $user_station_region=$session_data['UserRegion'];
}else{
    $user_station_region=$session_data['UserRegion'];
}
$userstation=$session_data['UserStation'];
$userstationid=$session_data['StationId'];

$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
?>
    <aside class="right-side" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Userlogs
            <small> Page</small>
        </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">User logs</li>
           
            </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <?php require_once(APPPATH . 'views/error.php'); ?>
            
            
            <br>
            <div class="row">        


                <form id="getuserlogs" action="<?php echo base_url(); ?>index.php/Users/GetUserLogs" method="post" enctype="multipart/form-data">
                <div class="col-xs-4">
                <div class="form-group">
                     <div class="input-group">
						<span class="input-group-addon">Action</span>
						<select name="action"  id="action"  onkeyup=""  class="form-control"  
                        placeholder=" Enter Action" required>
						<option value="">--Select Action-- </option>
						<option value="Added">Add data</option>
                        <option value="Updated">Edit data</option>
						<option value="Quality control">Quality control</option>
                        <option value="station">Add station / Edit station</option>
						
						<option value="login/logout">Login/Logout</option>
					</select>
				    </div>
                </div>
            </div>
               
                <?php if($userrole=='Senior Weather Observer' || $userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer"){ ?>
                <div class="col-xs-4">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Region</span>
                                <input type="text" name="region" id="region" class="form-control" value="<?php echo $user_station_region;?>"  readonly class="form-control"  >
                            </div>
                        </div>
                    </div>
                <?php }elseif( $userrole=="ManagerData" || $userrole=='Manager'){?>
            <div class="col-xs-4">
                <div class="form-group">
                     <div class="input-group">
						<span class="input-group-addon">Region</span>
						<select name="region"  id="region"  onkeyup=""  class="form-control"  
                        placeholder="Enter Region">
						<option value="">--Select Region-- </option>
						<!-- <option value="Central">Central</option>
						<option value="Eastern">Eastern</option>
                        <option value="Northern">Northern</option>
                        <option value="Northern">Southern</option>
						<option value="Western">Western</option> -->
                        <?php
                          if(isset($regions)){
                          if($regions->num_rows()>0){
                            foreach($regions->result() as $row){
                         ?>
                        <option value="<?php echo $row->region; ?>"><?php echo $row->region; ?></option>
                        <?php 
                            }
                            } 
                           }
                        ?>
						
					</select>
				    </div>
                </div>
                </div><?php } ?>
                <?php  if($userrole=='Senior Weather Observer'){?>
                    <div class="col-xs-4">
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">Station</span>
                                <input type="text" name="" id="" class="form-control" value="<?php echo $userstation;?>"  placeholder="Please select station" readonly class="form-control"  >
                                <input type="hidden" name="station" id="station" value="<?php echo $userstationid;?>" >
                            </div>
                        </div>
                    </div>
                <?php }elseif($userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer" || $userrole=="ManagerData" || $userrole=='Manager'){?>
                    <div class="col-xs-4">
                                <div class="form-group">
                                    <div class="input-group">

                                        <span class="input-group-addon">Station</span>
                                        <select name="station" id="station1"   class="form-control" placeholder="Select Station">
                                            <option value="">--Select Stations--</option>
                                            <?php
                                            if (is_array($zonalstations) && count($zonalstations) && ($userrole== "ZonalOfficer" || $userrole== "SeniorZonalOfficer")) {
                                                foreach($zonalstations as $station){?>
                                                    <option value="<?php echo $station->station_id;?>"><?php echo $station->StationName;?></option>

                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div><?php } ?>
            
            
            <div class="col-xs-4">
                <div class="form-group">
                     <div class="input-group">
						<span class="input-group-addon">Type Of Record</span>
						<select name="typeofform"  id="typeofform"  onkeyup=""  class="form-control"  
                        placeholder=" Enter Type" required>
						<option value=" ">--Select Type Of Record-- </option>
                        <optgroup label="Select data form type">
						<option value="Observation Slip">Observation Slip Form</option>

                        <option value="Archive Observation Slip">Archive Observation Slip Form</option>
                        <option value="Archive Metar">Archive Metar Form</option>
                        <option value="Archive Weather Summary">Archive Weather Summary Form</option>
                        <option value="Archive Synoptic">Archive Synoptic Form</option>
                        <option value="Archive Dekadal">Archive Dekadal Form</option>
                        <option value="Archive Monthly Rainfall">Archive Rainfall Form</option>
                    
                        <option value="Archive Scanned Observation Slip">Archive Scanned Observation Slip Form</option>
                        <option value="Archive Scanned Metar">Archive Scanned Metar Form</option>
                        <option value="Archive Scanned Weather Summary">Archive Scanned Weather Summary Form</option>
                        <option value="Archive Scanned Synoptic">Archive Scanned Synoptic Form</option>
                        <option value="Archive Scanned Dekadal">Archive Scanned Dekadal Form</option>
                        <option value="Archive Scanned Monthly Rainfall">Archive Scanned Monthly Rainfall Form</option>
                        <option value="Archive Scanned Annual Rainfall">Archive Scanned Annual Rainfall Form</option>

						<option value="User Details">System User Details</option>
                        </optgroup>
						<optgroup label="Select archive form">
                        <option value="Archive Observation Slip">Archived ObservationSlip Form</option>
                        <option value="Archive Metar">Archive Metar Form</option>
                        <option value="Archive Weather Summary">Archive Weather Summary Form</option>
                        <option value="Archive Synoptic">Archive Synoptic Form</option>
                        <option value="Archive Dekadal">Archive Dekadal Form</option>
                        <option value="Archive Monthly Rainfall">Archive Rainfall Form</option>
                        </optgroup>
					</select>
				    </div>
                </div>
            </div>

               <div class="col-xs-4">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Date</span>
                            <input value="" autocomplete="false" type="text" name="daterange" id="reportrange" class="form-control metaryear" >
                            <input type="hidden" name="startdate" id="startdate">
                            <input type="hidden" name="enddate" id="enddate" >
                            <!--<input type="text" value="hello"name="birthday" class="form-control metaryear">-->
                           
                            
                        </div>
                        
                    </div>
                </div>
				
				
				<div align="center" class="col-md-2">
                    <input type="submit"  id="submitjs" name="submitjs" class="btn btn-primary" value="Generate Report" >
                    </div>
				
                </div>
           </form>
          
           <?php if(is_array($userlogsdata)) {?>
            <div class="col-xs-12">

                <div class="box" style="margin-top:100px;">
                    <div class="box-header">
                        <?php 
                            echo '<center>Showing Records From <b>'.$datedisplay1.'</b> To <b>'.$datedisplay2.'</b></center>';
                        ?>
                    </div>
                    <div class="box-body table-responsive">
                    <table id="example4" class="table table-bordered table-fixed table-striped">
                            <thead>
                            <tr style="height: 90px;">
                                <th>No.</th>
                                <th>Date</th>
                                <th>User Name</th>
                                <th>User Role</th>
                                <th>Action Taken</th>
                                <th>Details</th>
                                <th>Station Name</th>
                                <th>Station Number</th>
                                <th>IP Address</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1;
                                foreach($userlogsdata as $logs){ ?>
                                    <tr style="height: 60px;">
                                    <td ><?php echo $counter++;?></td>
                                      <td ><?php echo $logs->logdate;?></td>
                                      <td ><?php echo $logs->FirstName.' '.$logs->SurName;?></td>
                                      <td ><?php echo $logs->UserRole;?></td>
                                      <td ><?php echo $action=$logs->Action;?></td>
                                      <td><?php if($action =='Updated Observation Slip'){
                                          echo 'Changed<b> '.$logs->field.'</b> from <b>'.$logs->old_value.
                                          '</b> to <b>'.$logs->new_value.'</b>';
                                      }else{
                                        echo $logs->Details;
                                      }
                                      ?></td>
                                      <td><?php echo ($logs->StationName)==NULL?"N/A":$logs->StationName;?></td>
                                      <td><?php echo ($logs->StationNumber)==NULL?"N/A":$logs->StationNumber;?></td>
                                      <td><?php echo $logs->IP;?></td>
                                    </tr>

                                <?php } 
                                ?>
                            </tbody>
                    </table>
                    <br><br>
                        <a href="<?php echo base_url();?>index.php/Users/userlogs" class="btn btn-primary no-print"><i class="fa fa-success"></i>Back</a>
                        <button style="float:right" onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> Print info on this page</button>
                    </div><!-- /.box-body -->
                </div><!-- box-->
            </div>


        <?php } ?>
         
         
       
              
         </div>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
    <script>
                    var starter=null;
                        var ender=null;
                        var nowstart=null;
                        var nowend=null;

                        $(function() {
                        
                        $('input[name="daterange"]').daterangepicker({
                          timePicker: true,
                          showDropdowns: true,
                          required:true,
                          maxDate:moment().startOf('day').add(23, 'hour').add(59,'minute'),
                          startDate: moment().startOf('day'),
                          endDate: moment().startOf('day').add(23, 'hour').add(59,'minute'),
                          locale: {
                            format: 'YYYY-MM-DD HH:mm '
                          }
                        }, function(start, end, label) {
                            starter=start.format('YYYY-MM-DD HH:mm');
                            ender=end.format('YYYY-MM-DD HH:mm');
                            $('#startdate').val(starter);
                              $('#enddate').val(ender);
                        });
                      });
                      $(function() {
                        $('input[name="daterange"]').click(function() {
                              nowstart=moment().startOf('day').format('YYYY-MM-DD HH:mm');
                              nowend=moment().startOf('day').add(23, 'hour').add(59,'minute').format('YYYY-MM-DD HH:mm');
                              $('#startdate').val(nowstart);
                              $('#enddate').val(nowend);
                        });
                      });
         
$(function() {
    $( '#action').change(function() {
        if( $('#action').val() == "login/logout" || $('#action').val() == ""){
            $('#typeofform').val(" ");
            $( "#typeofform" ).prop( "disabled", true );
        }else if( $('#action').val() == "Quality control"){
            $('#station1').val(" ");
            $( "#station1" ).prop( "disabled", true );
            $('#region').val(" ");
            $( "#region" ).prop( "disabled", true );
            $( "#typeofform" ).prop( "disabled", false );
            $('#typeofform').children('optgroup:not([label="Select archive form"])').hide();
            $('#typeofform').children('optgroup[label="Select archive form"]').show();
        }else if( $('#action').val() == "Added"||$('#action').val() == "Updated"){
            $( "#typeofform" ).prop( "disabled", false );
            $( "#region" ).prop( "disabled", false );
            $( "#station1" ).prop( "disabled", false );
            $('#typeofform').children('optgroup:not([label="Select data form type"])').hide();
            $('#typeofform').children('optgroup[label="Select data form type"]').show();
        }else if( $('#action').val() == "station"){
            $('#station1').val(" ");
            $( "#station1" ).prop( "disabled", true );
            $('#region').val(" ");
            $( "#region" ).prop( "disabled", true );
            $( "#typeofform" ).prop( "disabled", true );
            
        }else{
            
            $( "#typeofform" ).prop( "disabled", false );
            $('#typeofform').children('optgroup[label="ARCHIVE"]').show();
        }
        
});
$( '#region').change(function() {
        if( $('#region').val() == ""){
            $('#station1').val(" ");
            $( "#station1" ).prop( "disabled", true );
        }else{
            $( "#station1" ).prop( "disabled", false );
        }
        
});
});

   
$(function() {
    $( '#region').change(function() {
        $('#station1').children('option:not(:first)').remove();
        var region = $('#region').val();
        if(region != ''){
            $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>"+"index.php/Users/SelectManagerStations",
                        data: {'region': region},
                        cache: false,          
                success: function(data)
                    {
                        var jsondata = JSON.parse(data);
                        var myOptions = [];var myid = [];
                        for ( var i = 0; i < jsondata.length; i++){
                            myOptions.push(jsondata[i].StationName);
                            myid.push(jsondata[i].station_id);
                        }
                       
                
                $.each(myOptions, function(val, text) {
                    $('#station1').append(
                        $('<option></option>').val(myid[val]).html(text)
                    );
                });
                    }           
        });
        }
        
        
});
});



$(function() {
    $('#typeofform').val(" ");
    $( "#typeofform" ).prop( "disabled", true );
    var region = $('#region').val();
    if(region == ''){
    $('#station1').val(" ");
    $( "#station1" ).prop( "disabled", true );}
});

$(function() {
  $('#submitjs').click(function(e) {
    if ((nowstart==null && nowend==null)  && (starter==null && ender==null)) {
        alert("you Must Pick a Range or Single Date first");
        e.preventDefault();
    }else{
       
    }
  });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
        <!-- Bootstrap -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>

<?php require_once(APPPATH . 'views/footer.php'); ?>
