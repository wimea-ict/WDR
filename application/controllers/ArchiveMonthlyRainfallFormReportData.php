<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveMonthlyRainfallFormReportData extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('encrypt');
	    if(!$this->session->userdata('logged_in')){
	    $this->session->set_flashdata('warning', 'Sorry, your session has expired.Please login again.');
       redirect('/Welcome');
	  }

    }
    public function index($id=NULL){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];
        $userid=$session_data['Userid'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','archivemonthlyrainfallformreportdata','','',$id,$userid);  //value,field,table
        // $query = $this->DbHandler->selectAll('dailyperiodicrainfall');  //dailyperiodicrainfall is the Table Name.
        //  var_dump($query);
        if ($query) {
            $data['archivedrainfalldata'] = $query;
		
        } else {
            $data['archivedrainfalldata'] = array();
			
        }

        //Get all Stations.
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }
          if($id!=NULL){
         $data['observationslipcomments'] = $this->DbHandler->selectRecordComments($id,'archivemonthlyrainfallformreportdata');
        }
        $this->load->view('archiveMonthlyRainfallFormReportData', $data);

    }
    public function submitObservationslipComment(){
        $comment= $this->input->post('comment');
        $recordid = $this->input->post('recordid');
        $session_data = $this->session->userdata('logged_in');
        //$userstation=$session_data['UserStation'];
        $userrole=$session_data['UserRole'];
        $name=$session_data['SurName'].' '.$session_data['FirstName'];
        $form_type="archivemonthlyrainfallformreportdata";
        $insertObservationSlipComment=array(
            'comment'=>$comment,'record_id'=>$recordid,'form_type'=>$form_type,'comment_by'=>$name,'userrole'=>$userrole);
        $insertsuccess= $this->DbHandler->insertData($insertObservationSlipComment,'raw_datacomments'); //Array for data to insert then  the Table Name   
        if($insertsuccess){
            $this->session->set_flashdata('success', 'Comment added successfully!');
            $q= "update archivemonthlyrainfallformreportdata set numberofcomments=numberofcomments+1 where id='$recordid'";
            $updatesuccess= $this->DbHandler->updatesubmittedreports($q);
        }else{
            $this->session->set_flashdata('error', 'Comment not added!');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
    public function DisplayNewArchiveMonthlyRaifallForm(){
        $this->unsetflashdatainfo();
        $name='displaynewarchivemonthlyrainfallForm';
        $data['displaynewarchivemonthlyrainfallForm'] = array('name' => $name);

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveMonthlyRainfallFormReportData', $data);

    }
     public function DisplayArchivedMonthlyRainfallFormForUpdate(){
        $this->unsetflashdatainfo();
        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        $month = $this->uri->segment(3);
        $year = $this->uri->segment(4);
        $query = $this->DbHandler->selectBymonthAndyear($month, $year, 'archivemonthlyrainfallformreportdata');  //$value, $field,$table
        // $query = $this->DbHandler->selectById('daily','id',$dailyformid);
        if ($query) {
            $data['updatearchivedmonthlyrainfallformreportdata'] = $query;
        } else {
            $data['updatearchivedmonthlyrainfallformreportdata'] = array();
        }
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveMonthlyRainfallFormReportData', $data);
    }
      public function DisplayArchivedMonthlyRainfallFormForValidation(){
        $this->unsetflashdatainfo();
        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        $monthlyrainfallformdataidforupdate = $this->uri->segment(3);
        $query = $this->DbHandler->selectById($monthlyrainfallformdataidforupdate,'id','archivemonthlyrainfallformreportdata');  //$value, $field,$table
        // $query = $this->DbHandler->selectById('daily','id',$dailyformid);
        if ($query) {
            $data['validatearchivedmonthlyrainfallformreportdata'] = $query;
        } else {
            $data['validatearchivedmonthlyrainfallformreportdata'] = array();
        }
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveMonthlyRainfallFormReportData', $data);
    }
    public function insertMonthlyRainfallFormReportData(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $userid=$session_data['Userid'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date_archivedailymonthlyrainfalldata');
        $date2 = $this->input->post('date_archivedailymonthlyrainfalldata2');
        $date3 = $this->input->post('date_archivedailymonthlyrainfalldata3');
        $date4 = $this->input->post('date_archivedailymonthlyrainfalldata4');
        $date5 = $this->input->post('date_archivedailymonthlyrainfalldata5');
        $date6 = $this->input->post('date_archivedailymonthlyrainfalldata6');
        $date7 = $this->input->post('date_archivedailymonthlyrainfalldata7');
        $date8 = $this->input->post('date_archivedailymonthlyrainfalldata8');
        $date9 = $this->input->post('date_archivedailymonthlyrainfalldata9');
        $date10 = $this->input->post('date_archivedailymonthlyrainfalldata10');
        $date11 = $this->input->post('date_archivedailymonthlyrainfalldata11');
        $date12 = $this->input->post('date_archivedailymonthlyrainfalldata12');
        $date13 = $this->input->post('date_archivedailymonthlyrainfalldata13');
        $date14 = $this->input->post('date_archivedailymonthlyrainfalldata14');
        $date15 = $this->input->post('date_archivedailymonthlyrainfalldata15');
        $date16 = $this->input->post('date_archivedailymonthlyrainfalldata16');
        $date17 = $this->input->post('date_archivedailymonthlyrainfalldata17');
        $date18 = $this->input->post('date_archivedailymonthlyrainfalldata18');
        $date19 = $this->input->post('date_archivedailymonthlyrainfalldata19');
        $date20 = $this->input->post('date_archivedailymonthlyrainfalldata20');
        $date21 = $this->input->post('date_archivedailymonthlyrainfalldata21');
        $date22 = $this->input->post('date_archivedailymonthlyrainfalldata22');
        $date23 = $this->input->post('date_archivedailymonthlyrainfalldata23');
        $date24 = $this->input->post('date_archivedailymonthlyrainfalldata24');
        $date25 = $this->input->post('date_archivedailymonthlyrainfalldata25');
        $date26 = $this->input->post('date_archivedailymonthlyrainfalldata26');
        $date27 = $this->input->post('date_archivedailymonthlyrainfalldata27');
        $date28 = $this->input->post('date_archivedailymonthlyrainfalldata28');
        $date29 = $this->input->post('date_archivedailymonthlyrainfalldata29');
        $date20 = $this->input->post('date_archivedailymonthlyrainfalldata30');
        $date31 = $this->input->post('date_archivedailymonthlyrainfalldata31');

        $station = firstcharuppercase(chgtolowercase($this->input->post('station_archivedailymonthlyrainfalldata')));

        $stationNumber = $this->input->post('stationNo_archivedailymonthlyrainfalldata');
        $station_id= $this->DbHandler->identifyStationById($station,$stationNumber);

        $rainfall = $this->input->post('rainfall_archivedailymonthlyrainfalldata');
        $rainfall2 = $this->input->post('rainfall_archivedailymonthlyrainfalldata2');
        $rainfall3 = $this->input->post('rainfall_archivedailymonthlyrainfalldata3');
        $rainfall4 = $this->input->post('rainfall_archivedailymonthlyrainfalldata4');
        $rainfall5 = $this->input->post('rainfall_archivedailymonthlyrainfalldata5');
        $rainfall6 = $this->input->post('rainfall_archivedailymonthlyrainfalldata6');
        $rainfall7 = $this->input->post('rainfall_archivedailymonthlyrainfalldata7');
        $rainfall8 = $this->input->post('rainfall_archivedailymonthlyrainfalldata8');
        $rainfall9 = $this->input->post('rainfall_archivedailymonthlyrainfalldata9');
        $rainfall10 = $this->input->post('rainfall_archivedailymonthlyrainfalldata10');
        $rainfall11 = $this->input->post('rainfall_archivedailymonthlyrainfalldata11');
        $rainfall12 = $this->input->post('rainfall_archivedailymonthlyrainfalldata12');
        $rainfall13 = $this->input->post('rainfall_archivedailymonthlyrainfalldata13');
        $rainfall14 = $this->input->post('rainfall_archivedailymonthlyrainfalldata14');
        $rainfall15 = $this->input->post('rainfall_archivedailymonthlyrainfalldata15');
        $rainfall16 = $this->input->post('rainfall_archivedailymonthlyrainfalldata16');
        $rainfall17 = $this->input->post('rainfall_archivedailymonthlyrainfalldata17');
        $rainfall18 = $this->input->post('rainfall_archivedailymonthlyrainfalldata18');
        $rainfall19 = $this->input->post('rainfall_archivedailymonthlyrainfalldata19');
        $rainfall20 = $this->input->post('rainfall_archivedailymonthlyrainfalldata20');
        $rainfall21 = $this->input->post('rainfall_archivedailymonthlyrainfalldata21');
        $rainfall22 = $this->input->post('rainfall_archivedailymonthlyrainfalldata22');
        $rainfall23 = $this->input->post('rainfall_archivedailymonthlyrainfalldata23');
        $rainfall24 = $this->input->post('rainfall_archivedailymonthlyrainfalldata24');
        $rainfall25 = $this->input->post('rainfall_archivedailymonthlyrainfalldata25');
        $rainfall26 = $this->input->post('rainfall_archivedailymonthlyrainfalldata26');
        $rainfall27 = $this->input->post('rainfall_archivedailymonthlyrainfalldata27');
        $rainfall28 = $this->input->post('rainfall_archivedailymonthlyrainfalldata28');
        $rainfall29 = $this->input->post('rainfall_archivedailymonthlyrainfalldata29');
        $rainfall30 = $this->input->post('rainfall_archivedailymonthlyrainfalldata30');
        $rainfall31 = $this->input->post('rainfall_archivedailymonthlyrainfalldata31');

        $month = $this->input->post('month');
        $year = $this->input->post('year');

        $approved="FALSE";
        $session_data = $this->session->userdata('logged_in');
        $name=$session_data['FirstName'].' '.$session_data['SurName'];
        $insertDailyPeriodicRainfallData=array(
        array('Date'=> $date,'Rainfall'=>$rainfall,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date2,'Rainfall'=>$rainfall2,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date3,'Rainfall'=>$rainfall3,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date4,'Rainfall'=>$rainfall4,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date5,'Rainfall'=>$rainfall5,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date6,'Rainfall'=>$rainfall6,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date7,'Rainfall'=>$rainfall7,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date8,'Rainfall'=>$rainfall8,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date9,'Rainfall'=>$rainfall9,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date10,'Rainfall'=>$rainfall10,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date11,'Rainfall'=>$rainfall11,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date12,'Rainfall'=>$rainfall12,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date13,'Rainfall'=>$rainfall13,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date14,'Rainfall'=>$rainfall14,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date15,'Rainfall'=>$rainfall15,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date16,'Rainfall'=>$rainfall16,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date17,'Rainfall'=>$rainfall17,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date18,'Rainfall'=>$rainfall18,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date19,'Rainfall'=>$rainfall19,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date20,'Rainfall'=>$rainfall20,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date21,'Rainfall'=>$rainfall21,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date22,'Rainfall'=>$rainfall22,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date23,'Rainfall'=>$rainfall23,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date24,'Rainfall'=>$rainfall24,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date25,'Rainfall'=>$rainfall25,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date26,'Rainfall'=>$rainfall26,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date27,'Rainfall'=>$rainfall27,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date28,'Rainfall'=>$rainfall28,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date29,'Rainfall'=>$rainfall29,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date30,'Rainfall'=>$rainfall30,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid),
        array('Date'=> $date31,'Rainfall'=>$rainfall31,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'AR_SubmittedBy' => $name,'submitedBy_Id'=>$userid)
        );
        // $this->DbHandler->insertData($insertDailyPeriodicRainfallData,'dailyperiodicrainfall'); //Array for data to insert then  the Table Name

         $checkduplicateform = $this->DbHandler->checkforduplicatearchivemonthly($date,$station_id);
            

            if($checkduplicateform){
                $this->session->set_flashdata('error', 'Sorry, A Record for this date and month Already Exists');
                redirect("ArchiveMonthlyRainfallFormReportData/");
            }
            else{

        foreach($insertDailyPeriodicRainfallData as $x)
        if($x['Date']!=NULL&&$x['Rainfall']){
        $insertsuccess= $this->DbHandler->insertData($x,'archivemonthlyrainfallformreportdata'); //Array for data to insert then  the Table Name
         }
        //Redirect the user back with  message
        if($insertsuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
           // $userstationNo=$session_data['station'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
             $userid =$session_data['Userid'];
            $userlogs = array('Userid' => $userid,
                'Action' => 'Added Archive Monthly Rainfall',
                'Details' => $name . ' added archived daily periodic rainfall info into the system',
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'Archived New Rainfall info was added successfully!');
            redirect("ArchiveMonthlyRainfallFormReportData/");

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }

    }
   public function UpdateMonthlyRainfallFormReportData(){
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $this->load->helper(array('form', 'url'));

        //$date = $this->input->post('date');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station')));
            $stationNumber = $this->input->post('stationNo');
            $stationId = $this->DbHandler->identifyStationById($station,$stationNumber);
            $station_id=$this->input->post('station_id');
        //$rainfall = $this->input->post('rainfall');
        $date1 = $this->input->post('date_archivedailymonthlyrainfalldata1');
        $date2 = $this->input->post('date_archivedailymonthlyrainfalldata2');
        $date3 = $this->input->post('date_archivedailymonthlyrainfalldata3');
        $date4 = $this->input->post('date_archivedailymonthlyrainfalldata4');
        $date5 = $this->input->post('date_archivedailymonthlyrainfalldata5');
        $date6 = $this->input->post('date_archivedailymonthlyrainfalldata6');
        $date7 = $this->input->post('date_archivedailymonthlyrainfalldata7');
        $date8 = $this->input->post('date_archivedailymonthlyrainfalldata8');
        $date9 = $this->input->post('date_archivedailymonthlyrainfalldata9');
        $date10 = $this->input->post('date_archivedailymonthlyrainfalldata10');
        $date11 = $this->input->post('date_archivedailymonthlyrainfalldata11');
        $date12 = $this->input->post('date_archivedailymonthlyrainfalldata12');
        $date13 = $this->input->post('date_archivedailymonthlyrainfalldata13');
        $date14 = $this->input->post('date_archivedailymonthlyrainfalldata14');
        $date15 = $this->input->post('date_archivedailymonthlyrainfalldata15');
        $date16 = $this->input->post('date_archivedailymonthlyrainfalldata16');
        $date17 = $this->input->post('date_archivedailymonthlyrainfalldata17');
        $date18 = $this->input->post('date_archivedailymonthlyrainfalldata18');
        $date19 = $this->input->post('date_archivedailymonthlyrainfalldata19');
        $date20 = $this->input->post('date_archivedailymonthlyrainfalldata20');
        $date21 = $this->input->post('date_archivedailymonthlyrainfalldata21');
        $date22 = $this->input->post('date_archivedailymonthlyrainfalldata22');
        $date23 = $this->input->post('date_archivedailymonthlyrainfalldata23');
        $date24 = $this->input->post('date_archivedailymonthlyrainfalldata24');
        $date25 = $this->input->post('date_archivedailymonthlyrainfalldata25');
        $date26 = $this->input->post('date_archivedailymonthlyrainfalldata26');
        $date27 = $this->input->post('date_archivedailymonthlyrainfalldata27');
        $date28 = $this->input->post('date_archivedailymonthlyrainfalldata28');
        $date29 = $this->input->post('date_archivedailymonthlyrainfalldata29');
        $date20 = $this->input->post('date_archivedailymonthlyrainfalldata30');
        $date31 = $this->input->post('date_archivedailymonthlyrainfalldata31');

        $month = $this->input->post('month');
        $year = $this->input->post('year');

        $rainfall1 = $this->input->post('rainfall_archivedailymonthlyrainfalldata1');
        $rainfall2 = $this->input->post('rainfall_archivedailymonthlyrainfalldata2');
        $rainfall3 = $this->input->post('rainfall_archivedailymonthlyrainfalldata3');
        $rainfall4 = $this->input->post('rainfall_archivedailymonthlyrainfalldata4');
        $rainfall5 = $this->input->post('rainfall_archivedailymonthlyrainfalldata5');
        $rainfall6 = $this->input->post('rainfall_archivedailymonthlyrainfalldata6');
        $rainfall7 = $this->input->post('rainfall_archivedailymonthlyrainfalldata7');
        $rainfall8 = $this->input->post('rainfall_archivedailymonthlyrainfalldata8');
        $rainfall9 = $this->input->post('rainfall_archivedailymonthlyrainfalldata9');
        $rainfall10 = $this->input->post('rainfall_archivedailymonthlyrainfalldata10');
        $rainfall11 = $this->input->post('rainfall_archivedailymonthlyrainfalldata11');
        $rainfall12 = $this->input->post('rainfall_archivedailymonthlyrainfalldata12');
        $rainfall13 = $this->input->post('rainfall_archivedailymonthlyrainfalldata13');
        $rainfall14 = $this->input->post('rainfall_archivedailymonthlyrainfalldata14');
        $rainfall15 = $this->input->post('rainfall_archivedailymonthlyrainfalldata15');
        $rainfall16 = $this->input->post('rainfall_archivedailymonthlyrainfalldata16');
        $rainfall17 = $this->input->post('rainfall_archivedailymonthlyrainfalldata17');
        $rainfall18 = $this->input->post('rainfall_archivedailymonthlyrainfalldata18');
        $rainfall19 = $this->input->post('rainfall_archivedailymonthlyrainfalldata19');
        $rainfall20 = $this->input->post('rainfall_archivedailymonthlyrainfalldata20');
        $rainfall21 = $this->input->post('rainfall_archivedailymonthlyrainfalldata21');
        $rainfall22 = $this->input->post('rainfall_archivedailymonthlyrainfalldata22');
        $rainfall23 = $this->input->post('rainfall_archivedailymonthlyrainfalldata23');
        $rainfall24 = $this->input->post('rainfall_archivedailymonthlyrainfalldata24');
        $rainfall25 = $this->input->post('rainfall_archivedailymonthlyrainfalldata25');
        $rainfall26 = $this->input->post('rainfall_archivedailymonthlyrainfalldata26');
        $rainfall27 = $this->input->post('rainfall_archivedailymonthlyrainfalldata27');
        $rainfall28 = $this->input->post('rainfall_archivedailymonthlyrainfalldata28');
        $rainfall29 = $this->input->post('rainfall_archivedailymonthlyrainfalldata29');
        $rainfall30 = $this->input->post('rainfall_archivedailymonthlyrainfalldata30');
        $rainfall31 = $this->input->post('rainfall_archivedailymonthlyrainfalldata31');
        $approved=$this->input->post('approval');;




        // $id1 = $this->input->post('id1');
        // $id2 = $this->input->post('id2');
        // $id3 = $this->input->post('id3');
        // $id4 = $this->input->post('id4');
        // $id5 = $this->input->post('id5');
        // $id6 = $this->input->post('id6');
        // $id7 = $this->input->post('id7');
        // $id8 = $this->input->post('id8');
        // $id9 = $this->input->post('id9');
        // $id10 = $this->input->post('id10');
        // $id11 = $this->input->post('id11');
        // $id12 = $this->input->post('id12');
        // $id13 = $this->input->post('id13');
        // $id14 = $this->input->post('id14');
        // $id15 = $this->input->post('id15');
        // $id16 = $this->input->post('id16');
        // $id17 = $this->input->post('id17');
        // $id18 = $this->input->post('id18');
        // $id19 = $this->input->post('id19');
        // $id20 = $this->input->post('id20');
        // $id21 = $this->input->post('id21');
        // $id22 = $this->input->post('id22');
        // $id23 = $this->input->post('id23');
        // $id24 = $this->input->post('id24');
        // $id25 = $this->input->post('id25');
        // $id26 = $this->input->post('id26');
        // $id27 = $this->input->post('id27');
        // $id28 = $this->input->post('id28');
        // $id29 = $this->input->post('id29');
        // $id30 = $this->input->post('id30');
        // $id31 = $this->input->post('id31');
        $ids=[
            $id1 = $this->input->post('id1'),
        $id2 = $this->input->post('id2'),
        $id3 = $this->input->post('id3'),
        $id4 = $this->input->post('id4'),
        $id5 = $this->input->post('id5'),
        $id6 = $this->input->post('id6'),
        $id7 = $this->input->post('id7'),
        $id8 = $this->input->post('id8'),
        $id9 = $this->input->post('id9'),
        $id10 = $this->input->post('id10'),
        $id11 = $this->input->post('id11'),
        $id12 = $this->input->post('id12'),
        $id13 = $this->input->post('id13'),
        $id14 = $this->input->post('id14'),
        $id15 = $this->input->post('id15'),
        $id16 = $this->input->post('id16'),
        $id17 = $this->input->post('id17'),
        $id18 = $this->input->post('id18'),
        $id19 = $this->input->post('id19'),
        $id20 = $this->input->post('id20'),
        $id21 = $this->input->post('id21'),
        $id22 = $this->input->post('id22'),
        $id23 = $this->input->post('id23'),
        $id24 = $this->input->post('id24'),
        $id25 = $this->input->post('id25'),
        $id26 = $this->input->post('id26'),
        $id27 = $this->input->post('id27'),
        $id28 = $this->input->post('id28'),
        $id29 = $this->input->post('id29'),
        $id30 = $this->input->post('id30'),
        $id31 = $this->input->post('id31')
        ];
        $doqa=$this->input->post('qualitycontrolled');
         if($doqa=="qa"){
            $session_data = $this->session->userdata('logged_in');
            $qao=$session_data['FirstName'].' '.$session_data['SurName'];
          }else{
             $qao=NULL;
         }

    //    / $updateDailyPeriodicRainfallData=array('Date'=> $date,
    //         'station' => $stationId,
    //         'Rainfall'=>$rainfall,'Approved'=>$approved,'qaBy'=>$qao
    //     );
        $updateDailyPeriodicRainfallData=array(
            array('Date'=> $date1,'Rainfall'=>$rainfall1,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date2,'Rainfall'=>$rainfall2,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date3,'Rainfall'=>$rainfall3,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date4,'Rainfall'=>$rainfall4,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date5,'Rainfall'=>$rainfall5,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date6,'Rainfall'=>$rainfall6,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date7,'Rainfall'=>$rainfall7,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date8,'Rainfall'=>$rainfall8,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date9,'Rainfall'=>$rainfall9,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date10,'Rainfall'=>$rainfall10,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date11,'Rainfall'=>$rainfall11,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date12,'Rainfall'=>$rainfall12,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date13,'Rainfall'=>$rainfall13,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date14,'Rainfall'=>$rainfall14,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date15,'Rainfall'=>$rainfall15,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date16,'Rainfall'=>$rainfall16,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date17,'Rainfall'=>$rainfall17,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date18,'Rainfall'=>$rainfall18,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date19,'Rainfall'=>$rainfall19,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date20,'Rainfall'=>$rainfall20,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date21,'Rainfall'=>$rainfall21,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date22,'Rainfall'=>$rainfall22,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date23,'Rainfall'=>$rainfall23,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date24,'Rainfall'=>$rainfall24,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date25,'Rainfall'=>$rainfall25,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date26,'Rainfall'=>$rainfall26,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date27,'Rainfall'=>$rainfall27,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date28,'Rainfall'=>$rainfall28,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date29,'Rainfall'=>$rainfall29,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date30,'Rainfall'=>$rainfall30,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao),
            array('Date'=> $date31,'Rainfall'=>$rainfall31,'station' => $station_id,'month'=>$month,'year'=>$year,'Approved'=>$approved,'qaBy'=>$qao)
            );
            $i=0;
            foreach($updateDailyPeriodicRainfallData as $x)
            {
            if($x['Date']!=NULL&&$x['Rainfall']!=NULL){
                
                $updatesuccess=$this->DbHandler->updateData($x,"",'archivemonthlyrainfallformreportdata',$ids[$i]);
             }
         // $updatesuccess=$this->DbHandler->updateData($updateDailyPeriodicRainfallData,"",'archivemonthlyrainfallformreportdata',$ids[$i]);
         $i++;}

        //Redirect the user back with  message
        if($updatesuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
           // $userstation=$session_data['station'];
            $userstationNo=$session_data['station'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userid =$session_data['Userid'];
            if($doqa=="qa"){
                $userlogs = array('Userid' => $userid,'station_id'=>$stationId,
                'Action' => 'Quality control Archive Monthly Rainfall',
                'Details' => $name . ' did quality assurance checks on Archive Monthly Rainfall Form info into the system',
                'IP' => $this->input->ip_address());
               
              }else{
                $userlogs = array('Userid' => $userid,
                'Action' => 'Updated Archive Monthly Rainfall',
                'Details' => $name . 'updated archived periodic rainfall info into the system',
                'IP' => $this->input->ip_address());
             }
           
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'Archived Periodic Rainfall info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('success', 'Archived Periodic Rainfall info was updated successfully!');
            $this->index();

        }



    }
	public 	function update_approval() {
		$session_data = $this->session->userdata('logged_in');
      $userstation=$session_data['UserStation'];
	  $user_id=$session_data['Userid'];
      $name=$session_data['FirstName'].' '.$session_data['SurName'];
		$id= $this->input->post('id');
		$data = array(
		'Approved' => $this->input->post('approve'), 'ApprovedBy'=>(($this->input->post('approve')=="FALSE")? "":$name));
		$query=$this->DbHandler->updateApproval1($id,$data,"archivemonthlyrainfallformreportdata");
		if ($query) {
		$this->session->set_flashdata('success', 'Data was updated successfully!');
		$this->index();
		}else{
		$this->session->set_flashdata('error', 'Sorry, Data was not updated, Please try again!');
		$this->index();	
		}
		}
    public function DeleteRainfallData() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        //$query = $this->DbHandler->DeleteDailyPeriodicRainfallData($id);

        $rowsaffected = $this->DbHandler->deleteData('archivemonthlyrainfallformreportdata',$id);  //$table and $id

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
            $userid =$session_data['Userid'];
            $userlogs = array('User' => $name,
                'Userid' => $userid,'Action' => 'Deleted Archive Monthly Rainfall',
                'Details' => $name . ' deleted periodic rainfall from the system',
                
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'dailyperiodicrainfall info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    ///Check DB against the DATE,STATIONName,StationNumber.
    function checkInDBIfArchiveMonthlyRainfallFormReportRecordExistsAlready($date,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkIfArchiveMonthlyRainfallFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');   // $value, $field, $table

            if( $get_result){
                echo json_encode($get_result);

            }
            else{

                echo json_encode($get_result);
            }
        }


    }
    public function unsetflashdatainfo(){

        if(isset($_SESSION['error'])){
            unset($_SESSION['error']);
        }

        elseif(isset($_SESSION['success'])){
            unset($_SESSION['success']);
        }
        elseif(isset($_SESSION['warning'])){
            unset($_SESSION['warning']);
        }
        elseif(isset($_SESSION['info'])){
            unset($_SESSION['info']);
        }

    }



}
