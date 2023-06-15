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
           New Sub Region
            <small> Page</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">New Sub-Region</li>
        </ol>
    </section>

    <section class="content">
    <?php if(isset($subregiontoedit)){  ?>
        <div class="row">
          <a style="margin:20px;" href="<?php echo base_url('index.php/NewStations/DisplaySubRegionsForm/') ?>" class="bt btn-info btn-sm"> << Go Back</a>
            <form action="<?php echo base_url(); ?>index.php/NewStations/updateSubRegionInformation/" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                <h3 class="box-title">Update Sub-Regions</h3>
                    <div id="output"></div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Region Name</span>
                                <select name="region" id="" class="form-control" required>
                                <option value="">--Select region--</option>
                                <?php if($regions->num_rows()>0){
                                foreach($regions->result() as $row){
                            ?>
                            
                                <option value="<?php echo $row->id ?>"><?php echo $row->region ?></option>
                                 
                
                            <?php  } } ?> 
                            </select>

                            </div>
                        </div>
                    </div>
                    <?php foreach($subregiontoedit as $row){ ?>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="input-group">
                               <input type="hidden" name="subregionid" value="<?php echo $row->id ?>">
                                
                                <span class="input-group-addon"> Sub-Region Name</span>
                                <input type="text" name="subregionname" value="<?php echo $row->subregion ?>" id="namestation" onkeyup="allowCharactersInputOnly(this)"  required class="form-control" required>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group">
                                <button type="submit" class="btn btn-info btn-sm">Create Sub-Region</button>
                            </div>
                        </div>

                    </div>
                    </form>



       </div>

<?php } else{ ?>
    <div class="row">
            <form action="<?php echo base_url(); ?>index.php/NewStations/insertSubRegionInformation/" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                <h3 class="box-title">Create New Sub-Regions</h3>
                    <div id="output"></div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Region Name</span>
                                <select name="region" id="" class="form-control" required>
                                <option value="">--Select region--</option>
                                <?php if($regions->num_rows()>0){
                                foreach($regions->result() as $row){
                            ?>
                            
                                <option value="<?php echo $row->id ?>"><?php echo $row->region ?></option>
                                 
                
                            <?php  } } ?> 
                            </select>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"> Sub-Region Name</span>
                                <input type="text" name="subregionname" id="namestation" onkeyup="allowCharactersInputOnly(this)"  required class="form-control" required placeholder="New region Name" >

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <div class="input-group">
                                <button type="submit" class="btn btn-info btn-sm">Create Sub-Region</button>
                            </div>
                        </div>

                    </div>
                    </form>



       </div> <br><br><br><br>
       <?php require_once(APPPATH . 'views/error.php'); ?>
       <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Sub Regions</h3>
                    </div><!-- /.box-header -->
                    
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Region Name</th>
                                <th>Sub-region Name</th>
                                <th>Date Created</th>
                                <th>Time Created</th>
                                <th>Created by</th>
                                <th>Action</th>
                                <?php if( $userrole=="Senior Weather Observer" || $userrole=="Manager"){ ?><th class="no-print">Action</th><?php }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 1;

                            if($subregions->num_rows()>0){
                                foreach($subregions->result() as $row){
                            ?>
                             <tr>
                                 <td><?php echo $count ?></td>
                                 <td><?php echo $row->region ?></td>
                                 <td><?php echo $row->subregion ?></td>
                                 <td><?php echo $row->Date_created ?></td>
                                 <td><?php echo $row->Time_created ?></td>
                                 <td><?php echo $row->Created_by ?></td>
                                 <td><a href="<?php echo base_url('index.php/NewStations/EditSubRegion/'.$row->id) ?>" class="btn btn-info btn-xs pull-right">Edit Sub-Region</a></td>
                             </tr>
                            <?php 
                               $count++;
                                    }
                                }
                            ?> 
                            </tbody>
                        </table>
                        <br><br>
                        <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT </button>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
      <?php } ?>
    </section><!-- /.content -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->

<?php require_once(APPPATH . 'views/footer.php'); ?>
