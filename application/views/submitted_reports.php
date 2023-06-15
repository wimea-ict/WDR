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

<?php if(isset($allsubmittedobservationreports) && count($allsubmittedobservationreports)) { ?>


    <div class="row">
       

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
        <div class="box-body table-responsive">
          <h3>OBSERVATION SLIP REPORTS FROM STATIONS</h3>
            <table id="example1" class="table table-bordered table-fixed table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Station</th>
                        <th>Station Number</th>
                        <th> Region</th>
                        <th>Submitted By</th>
                        <th>Role</th>
                        <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                        <th>Sent to manager</th>
                        <?php } ?>
                        <th class="no-print">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;

                   
                        foreach($allsubmittedobservationreports->result() as $row){
                            $count++;
                            $userdetailsid = $userdetails->Userid;



                            ?>
                            <tr>
                                <td ><?php echo $count;?></td>
                                <td ><?php echo $row->date;?></td>
                                <td ><?php echo $row->time;?></td>
                                <td ><?php echo $row->StationName;?></td>
                                <td ><?php echo $row->StationNumber;?></td>
                                <td ><?php echo $row->StationRegion;?></td>
                                
                                <td><?php echo $row->SurName.' '.$row->FirstName;?></td>
                                <td><?php echo $row->UserRole;?></td>
                                <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                                    <td><?php echo ($row->forwardtomanager=="True")? '<i class="fa fa-check"> Already sent </i>':'<i class="fa fa-remove"> Pending </i>' ; ?></td>
                                <?php } ?>
                                <td class="no-print">
                                    <?php if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='Senior Weather Observer'|| $userrole=='SeniorZonalOfficer'|| $userrole=='ZonalOfficer' || $userrole == 'ManagerStationNetworks' || $userrole == 'WeatherAnalyst'){ ?>

                                     
                                                        <form  class="pull-right" action="<?php echo base_url(); ?>index.php/ReportsController/displayobservationslipreport/" method="post">
                                                        <input type="hidden"  name="RegionName" value="Central"/>
                                                        <input type="hidden"  name="station" value="<?php echo $row->StationName;?>"/>
                                                        <input type="hidden"  name="stationNoManager" value="<?php echo $row->StationNumber;?>"/>
                                                        <input type="hidden"  name="date" value="<?php echo $row->date;?>"/>
                                                        <input type="hidden" name="showreportonly" value="true">
                                                        <input type="hidden"  name="ObservationSlipTime" value="<?php echo $row->time;?>"/>

                                                        <button type="submit" name="reportonly" class="btn btn-primary blocked btn-xs pull-right" ><i class="fa fa-print"></i> Open Report</button>
                                                        </form>

                                                   
                                     <?php }?>


                                 </td>
                             </tr>
                             <?php
                         }
                     }
                     ?>
            

<?php if(isset($allsubmittedmetar) && count($allsubmittedmetar)) { ?>


<div class="row">
   

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
    <div class="box-body table-responsive">
    <h3>METAR REPORTS FROM STATIONS</h3>
        <table id="example1" class="table table-bordered table-fixed table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Station</th>
                    <th>Station Number</th>
                    <th> Region</th>
                    <th>Submitted By</th>
                    <th>Role</th>
                    <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                        <th>Sent to manager</th>
                        <?php } ?>
                    <th class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

               
                    foreach($allsubmittedmetar->result() as $row){
                        $count++;
                        $userdetailsid = $userdetails->Userid;



                        ?>
                        <tr>
                            <td ><?php echo $count;?></td>
                            <td ><?php echo $row->date;?></td>
                            <td ><?php echo $row->time;?></td>
                            <td ><?php echo $row->StationName;?></td>
                            <td ><?php echo $row->StationNumber;?></td>
                            <td ><?php echo $row->StationRegion;?></td>
                            
                            <td><?php echo $row->SurName.' '.$row->FirstName;?></td>
                            <td><?php echo $row->UserRole;?></td>
                            <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                                    <td><?php echo ($row->forwardtomanager=="True")? '<i class="fa fa-check"> Already sent </i>':'<i class="fa fa-remove"> Pending </i>' ; ?></td>
                                <?php } ?>
                            <td class="no-print">
                                 <?php if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='Senior Weather Observer'|| $userrole=='SeniorZonalOfficer'|| $userrole=='ZonalOfficer' || $userrole == 'ManagerStationNetworks' || $userrole == 'WeatherAnalyst' || $userrole == 'Communications'){ ?>

                                 
                                                     <!-- <a class="btn btn-primary blocked btn-sm pull-right" ><li class="fa fa-open"></li> Open Report</a> -->

                                                    <form  class="pull-right" action="<?php echo base_url(); ?>index.php/ReportsController/displaymetarreport/" method="post">
                                                    <input type="hidden"  name="forward" value="True"/>
                                                    <input type="hidden"  name="RegionName" value="<?php echo $row->StationRegion;?>"/>
                                                    <input type="hidden"  name="station" value="<?php echo $row->StationName;?>"/>
                                                    <input type="hidden"  name="stationNoManager" value="<?php echo $row->StationNumber;?>"/>
                                                    <input type="hidden"  name="date" value="<?php echo $row->date;?>"/>
                                                    <input type="hidden"  name="metarTime" value="<?php echo $row->time;?>"/>
                                                    <input type="hidden"  name="record_id" value="<?php echo $row->id; ?>"/>

                                                    <button type="submit" name="reportonly" class="btn btn-primary blocked btn-xs pull-right" ><i class="fa fa-print"></i> Open Metar Report</button>
                                                    </form>

                                               
                                 <?php }?>


                             </td>
                         </tr>
                         <?php
                     }
                 }
                 ?> 
    

               
    <?php if(isset($allsubmittedweathersummary) && count($allsubmittedweathersummary)) { ?>


<div class="row">
   

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
    <div class="box-body table-responsive">
    <h3>WEATHER SUMMARY REPORTS FROM STATIONS</h3>
        <table id="example1" class="table table-bordered table-fixed table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Station</th>
                    <th>Station Number</th>
                    <th> Region</th>
                    <th>Submitted By</th>
                    <th>Role</th>
                    <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                        <th>Sent to manager</th>
                        <?php } ?>
                    <th class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

               
                    foreach($allsubmittedweathersummary->result() as $row){
                        $count++;
                        $userdetailsid = $userdetails->Userid;



                        ?>
                        <tr>
                            <td ><?php echo $count;?></td>
                            <td ><?php echo $row->month;?></td>
                            <td ><?php echo $row->year;?></td>
                            <td ><?php echo $row->StationName;?></td>
                            <td ><?php echo $row->StationNumber;?></td>
                            <td ><?php echo $row->StationRegion;?></td>
                            
                            <td><?php echo $row->SurName.' '.$row->FirstName;?></td>
                            <td><?php echo $row->UserRole;?></td>
                            <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                                    <td><?php echo ($row->forwardtomanager=="True")? '<i class="fa fa-check"> Already sent </i>':'<i class="fa fa-remove"> Pending </i>' ; ?></td>
                                <?php } ?>
                            <td class="no-print">
                            <?php if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='Senior Weather Observer'|| $userrole=='SeniorZonalOfficer'|| $userrole=='ZonalOfficer' || $userrole == 'ManagerStationNetworks' || $userrole == 'WeatherAnalyst'){ ?>

                                 
                                                     <!-- <a class="btn btn-primary blocked btn-sm pull-right" ><li class="fa fa-open"></li> Open Report</a> -->

                                                    <form  class="pull-right" action="<?php echo base_url(); ?>index.php/WeatherSummaryReport/displayweathersummaryreport/" method="post">
                                                    <input type="hidden"  name="RegionName" value="<?php echo $row->StationRegion;?>"/>
                                                    <input type="hidden"  name="station" value="<?php echo $row->StationName;?>"/>
                                                    <input type="hidden"  name="stationNoManager" value="<?php echo $row->StationNumber;?>"/>
                                                    <input type="hidden"  name="month" value="<?php echo $row->month;?>"/>
                                                    <input type="hidden"  name="year" value="<?php echo $row->year;?>"/>
                                                    <input type="hidden"  name="record_id" value="<?php echo $row->id; ?>"/>
                                                    <button type="submit" name="reportonly" class="btn btn-primary blocked btn-xs pull-right" ><i class="fa fa-print"></i> Open Report</button>
                                                    </form>

                                               
                                 <?php }?>


                             </td>
                         </tr>
                         <?php
                     }
                 }
                 ?> 

<?php if(isset($allsubmittedmonthlyrainfall) && count($allsubmittedmonthlyrainfall)) { ?>


<div class="row">
   

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
    <div class="box-body table-responsive">
    <h3>MONTHLY RAINFALL REPORTS FROM STATIONS</h3>
        <table id="example1" class="table table-bordered table-fixed table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Station</th>
                    <th>Station Number</th>
                    <th> Region</th>
                    <th>Submitted By</th>
                    <th>Role</th>
                    <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                        <th>Sent to manager</th>
                        <?php } ?>
                    <th class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

               
                    foreach($allsubmittedmonthlyrainfall->result() as $row){
                        $count++;
                        $userdetailsid = $userdetails->Userid;



                        ?>
                        <tr>
                            <td ><?php echo $count;?></td>
                            <td ><?php echo $row->month;?></td>
                            <td ><?php echo $row->year;?></td>
                            <td ><?php echo $row->StationName;?></td>
                            <td ><?php echo $row->StationNumber;?></td>
                            <td ><?php echo $row->StationRegion;?></td>
                            
                            <td><?php echo $row->SurName.' '.$row->FirstName;?></td>
                            <td><?php echo $row->UserRole;?></td>
                            <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                                    <td><?php echo ($row->forwardtomanager=="True")? '<i class="fa fa-check"> Already sent </i>':'<i class="fa fa-remove"> Pending </i>' ; ?></td>
                                <?php } ?>
                            <td class="no-print">
                            <?php if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='Senior Weather Observer'|| $userrole=='SeniorZonalOfficer'|| $userrole=='ZonalOfficer'|| $userrole == 'ManagerStationNetworks' || $userrole == 'WeatherAnalyst'){ ?>

                                 
                                                     <!-- <a class="btn btn-primary blocked btn-sm pull-right" ><li class="fa fa-open"></li> Open Report</a> -->

                                                    <form  class="pull-right" action="<?php echo base_url(); ?>index.php/ReportsController/displaymonthlyrainfallreport/" method="post">
                                                    <input type="hidden"  name="RegionName" value="<?php echo $row->StationRegion;?>"/>
                                                    <input type="hidden"  name="station" value="<?php echo $row->StationName;?>"/>
                                                    <input type="hidden"  name="stationNoManager" value="<?php echo $row->StationNumber;?>"/>
                                                    <input type="hidden"  name="month" value="<?php echo $row->month;?>"/>
                                                    <input type="hidden"  name="year" value="<?php echo $row->year;?>"/>
                                                    <input type="hidden"  name="record_id" value="<?php echo $row->id; ?>"/>
                                                    <button type="submit" name="reportonly" class="btn btn-primary blocked btn-xs pull-right" ><i class="fa fa-print"></i> Open Report</button>
                                                    </form>

                                               
                                 <?php }?>


                             </td>
                         </tr>
                         <?php
                     }
                 }
                 ?> 

<?php if(isset($allsubmitteddekadal) && count($allsubmitteddekadal)) { ?>


<div class="row">
   

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
    <div class="box-body table-responsive">
    <h3>DEKADAL REPORTS FROM STATIONS</h3>
        <table id="example1" class="table table-bordered table-fixed table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Start date</th>
                    <th>End Date</th>
                    <th>Station</th>
                    <th>Station Number</th>
                    <th> Region</th>
                    <th>Submitted By</th>
                    <th>Role</th>
                    <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                        <th>Sent to manager</th>
                        <?php } ?>
                    <th class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

               
                    foreach($allsubmitteddekadal->result() as $row){
                        $count++;
                        $userdetailsid = $userdetails->Userid;



                        ?>
                        <tr>
                            <td ><?php echo $count;?></td>
                            <td ><?php echo $row->startdate;?></td>
                            <td ><?php echo $row->enddate;?></td>
                            <td ><?php echo $row->StationName;?></td>
                            <td ><?php echo $row->StationNumber;?></td>
                            <td ><?php echo $row->StationRegion;?></td>
                            
                            <td><?php echo $row->SurName.' '.$row->FirstName;?></td>
                            <td><?php echo $row->UserRole;?></td>
                            <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                                    <td><?php echo ($row->forwardtomanager=="True")? '<i class="fa fa-check"> Already sent </i>':'<i class="fa fa-remove"> Pending </i>' ; ?></td>
                                <?php } ?>
                            <td class="no-print">
                            <?php if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='Senior Weather Observer'|| $userrole=='SeniorZonalOfficer'|| $userrole=='ZonalOfficer'){ ?>

                                 
                                                     <!-- <a class="btn btn-primary blocked btn-sm pull-right" ><li class="fa fa-open"></li> Open Report</a> -->

                                                    <form  class="pull-right" action="<?php echo base_url(); ?>index.php/ReportsController/displaydekadalreport/" method="post">
                                                    <input type="hidden"  name="RegionName" value="<?php echo $row->StationRegion;?>"/>
                                                    <input type="hidden"  name="station" value="<?php echo $row->StationName;?>"/>
                                                    <input type="hidden"  name="stationNoManager" value="<?php echo $row->StationNumber;?>"/>
                                                    <input type="hidden"  name="fromdate" value="<?php echo $row->startdate;?>"/>
                                                    <input type="hidden"  name="todate" value="<?php echo $row->enddate;?>"/>
                                                    <input type="hidden"  name="record_id" value="<?php echo $row->id; ?>"/>
                                                    <button type="submit" name="reportonly" class="btn btn-primary blocked btn-xs pull-right" ><i class="fa fa-print"></i> Open Report</button>
                                                    </form>

                                               
                                 <?php }?>


                             </td>
                         </tr>
                         <?php
                     }
                 }
                 ?> 
<?php if(isset($allsubmittedsynoptic) && count($allsubmittedsynoptic)) { ?>
<div class="row">
   
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
    <div class="box-body table-responsive">
    <h3>SYNOPTIC REPORTS FROM STATIONS</h3>
        <table id="example1" class="table table-bordered table-fixed table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Start date</th>
                    <th>Date</th>
                    
                    <th>Station Number</th>
                    <th> Region</th>
                    <th>Submitted By</th>
                    <th>Role</th>
                    <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                        <th>Sent to manager</th>
                        <?php } ?>
                    <th class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

               
                    foreach($allsubmittedsynoptic->result() as $row){
                        $count++;
                        $userdetailsid = $userdetails->Userid;



                        ?>
                        <tr>
                            <td ><?php echo $count;?></td>
                            <td ><?php echo $row->date;?></td>
                           
                            <td ><?php echo $row->StationName;?></td>
                            <td ><?php echo $row->StationNumber;?></td>
                            <td ><?php echo $row->StationRegion;?></td>
                            
                            <td><?php echo $row->SurName.' '.$row->FirstName;?></td>
                            <td><?php echo $row->UserRole;?></td>
                            <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                                    <td><?php echo ($row->forwardtomanager=="True")? '<i class="fa fa-check"> Already sent </i>':'<i class="fa fa-remove"> Pending </i>' ; ?></td>
                                <?php } ?>
                            <td class="no-print">
                            <?php if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='Senior Weather Observer'|| $userrole=='SeniorZonalOfficer'|| $userrole=='ZonalOfficer' || $userrole == 'Communications'){ ?>

                                 
                                                     <!-- <a class="btn btn-primary blocked btn-sm pull-right" ><li class="fa fa-open"></li> Open Report</a> -->

                                                    <form  class="pull-right" action="<?php echo base_url(); ?>index.php/ReportsController/displaysynopticreport/" method="post">
                                                    <input type="hidden"  name="RegionName" value="<?php echo $row->StationRegion;?>"/>
                                                    <input type="hidden"  name="station" value="<?php echo $row->StationName;?>"/>
                                                    <input type="hidden"  name="stationNoManager" value="<?php echo $row->StationNumber;?>"/>
                                                    <input type="hidden"  name="date" value="<?php echo $row->date;?>"/>
                                                   
                                                    <input type="hidden"  name="record_id" value="<?php echo $row->id; ?>"/>
                                                    <button type="submit" name="reportonly" class="btn btn-primary blocked btn-xs pull-right" ><i class="fa fa-print"></i> Open Report</button>
                                                    </form>

                                               
                                 <?php }?>


                             </td>
                         </tr>
                         <?php
                     }
                 }
                 ?> 

<?php if(isset($allsubmittedannualrainfall) && count($allsubmittedannualrainfall)) { ?>
<div class="row">
   
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
    <div class="box-body table-responsive">
    <h3>YEARLY RAINFALL REPORTS FROM STATIONS</h3>
        <table id="example1" class="table table-bordered table-fixed table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Start date</th>
                    <th>Year</th>
                    
                    <th>Station Number</th>
                    <th> Region</th>
                    <th>Submitted By</th>
                    <th>Role</th>
                    <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                        <th>Sent to manager</th>
                        <?php } ?>
                    <th class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

               
                    foreach($allsubmittedannualrainfall->result() as $row){
                        $count++;
                        $userdetailsid = $userdetails->Userid;



                        ?>
                        <tr>
                            <td ><?php echo $count;?></td>
                            <td ><?php echo $row->year;?></td>
                           
                            <td ><?php echo $row->StationName;?></td>
                            <td ><?php echo $row->StationNumber;?></td>
                            <td ><?php echo $row->StationRegion;?></td>
                            
                            <td><?php echo $row->SurName.' '.$row->FirstName;?></td>
                            <td><?php echo $row->UserRole;?></td>
                            <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                                    <td><?php echo ($row->forwardtomanager=="True")? '<i class="fa fa-check"> Already sent </i>':'<i class="fa fa-remove"> Pending </i>' ; ?></td>
                                <?php } ?>
                            <td class="no-print">
                            <?php if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='Senior Weather Observer'|| $userrole=='SeniorZonalOfficer'|| $userrole=='ZonalOfficer'){ ?>

                                 
                                                     <!-- <a class="btn btn-primary blocked btn-sm pull-right" ><li class="fa fa-open"></li> Open Report</a> -->

                                                    <form  class="pull-right" action="<?php echo base_url(); ?>index.php/YearlyRainfallReport/displayyearlyrainfallreport/" method="post">
                                                    <input type="hidden"  name="RegionName" value="<?php echo $row->StationRegion;?>"/>
                                                    <input type="hidden"  name="station" value="<?php echo $row->StationName;?>"/>
                                                    <input type="hidden"  name="stationNoManager" value="<?php echo $row->StationNumber;?>"/>
                                                    <input type="hidden"  name="year" value="<?php echo $row->year;?>"/>
                                                   
                                                    <input type="hidden"  name="record_id" value="<?php echo $row->id; ?>"/>
                                                    <button type="submit" name="reportonly" class="btn btn-primary blocked btn-xs pull-right" ><i class="fa fa-print"></i> Open Report</button>
                                                    </form>

                                               
                                 <?php }?>


                             </td>
                         </tr>
                         <?php
                     }
                 }
                 ?> 

<?php if(isset($allsubmittedspeci) && count($allsubmittedspeci)) { ?>
<div class="row">
   
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
    <div class="box-body table-responsive">
    <h3>SPECI REPORTS FROM STATIONS</h3>
        <table id="example1" class="table table-bordered table-fixed table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Start time</th>
                    <th>End time</th>
                    <th>Station Name</th>
                    <th>Station Number</th>
                    <th> Region</th>
                    <th>Submitted By</th>
                    <th>Role</th>
                    <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                        <th>Sent to manager</th>
                        <?php } ?>
                    <th class="no-print">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 0;

               
                    foreach($allsubmittedspeci->result() as $row){
                        $count++;
                        $userdetailsid = $userdetails->Userid;



                        ?>
                        <tr>
                            <td ><?php echo $count;?></td>
                            <td ><?php echo $row->startdate;?></td>
                            <td ><?php echo $row->enddate;?></td>
                            <td ><?php echo $row->starttime;?></td>
                            <td ><?php echo $row->endtime;?></td>
                            <td ><?php echo $row->StationName;?></td>
                            <td ><?php echo $row->StationNumber;?></td>
                            <td ><?php echo $row->StationRegion;?></td>
                            
                            <td><?php echo $row->SurName.' '.$row->FirstName;?></td>
                            <td><?php echo $row->UserRole;?></td>
                            <?php if(strcmp($userrole,'ZonalOfficer')==0 ||strcmp($userrole,'SeniorZonalOfficer')==0){ ?>
                                    <td><?php echo ($row->forwardtomanager=="True")? '<i class="fa fa-check"> Already sent </i>':'<i class="fa fa-remove"> Pending </i>' ; ?></td>
                                <?php } ?>
                            <td class="no-print">
                            <?php if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='Senior Weather Observer'|| $userrole=='SeniorZonalOfficer'|| $userrole=='ZonalOfficer' || $userrole == 'Communications'){ ?>

                                 
                                                     <!-- <a class="btn btn-primary blocked btn-sm pull-right" ><li class="fa fa-open"></li> Open Report</a> -->

                                                    <form  class="pull-right" action="<?= site_url('generate-speci-report')?>" method="post">
                                                    <input type="hidden"  name="RegionName" value="<?php echo $row->StationRegion;?>"/>
                                                    <input type="hidden"  name="station" value="<?php echo $row->StationName;?>"/>
                                                    <input type="hidden"  name="stationNoManager" value="<?php echo $row->StationNumber;?>"/>
                                                    <input type="hidden"  name="Start-Date" value="<?php echo $row->startdate;?>"/>
                                                    <input type="hidden"  name="End-Date" value="<?php echo $row->enddate;?>"/>
                                                    <input type="hidden"  name="StartTime" value="<?php echo $row->starttime;?>"/>
                                                    <input type="hidden"  name="EndTime" value="<?php echo $row->endtime;?>"/>
                                                   
                                                    <input type="hidden"  name="record_id" value="<?php echo $row->id; ?>"/>
                                                    <button type="submit" name="reportonly" class="btn btn-primary blocked btn-xs pull-right" ><i class="fa fa-print"></i> Open Report</button>
                                                    </form>

                                               
                                 <?php }?>


                             </td>
                         </tr>
                         <?php
                     }
                 }
                 ?>
                 </tbody>
             </table>
             <br><br>
         </div><!-- /.box-body -->
     </div><!-- /.box -->
 </div>
</div>
</section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->
       
        <?php require_once(APPPATH . 'views/footer.php'); ?>
