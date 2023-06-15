<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveDekadalFormReportData extends CI_Controller {

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
        //  $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];
         $userid=$session_data['Userid'];
        $query = $this->DbHandler->selectAll($userstation,'StationName','archivedekadalformreportdata','','',$id,$userid);  //value,field,table

        if ($query) {
            $data['archivedDekadalformreportdata'] = $query;
        } else {
            $data['archivedDekadalformreportdata'] = array();
        }
         if($id!=NULL){
         $data['observationslipcomments'] = $this->DbHandler->selectRecordComments($id,'archivedekadalformreportdata');
        }
        $this->load->view('archiveDekadalFormReportData', $data);
    }
    public function submitObservationslipComment(){
        $comment= $this->input->post('comment');
        $recordid = $this->input->post('recordid');
        $session_data = $this->session->userdata('logged_in');
        //$userstation=$session_data['UserStation'];
        $userrole=$session_data['UserRole'];
        $name=$session_data['SurName'].' '.$session_data['FirstName'];
        $form_type="archivedekadalformreportdata";
        $insertObservationSlipComment=array(
            'comment'=>$comment,'record_id'=>$recordid,'form_type'=>$form_type,'comment_by'=>$name,'userrole'=>$userrole);
        $insertsuccess= $this->DbHandler->insertData($insertObservationSlipComment,'raw_datacomments'); //Array for data to insert then  the Table Name   
        if($insertsuccess){
            $this->session->set_flashdata('success', 'Comment added successfully!');
            $q= "update archivedekadalformreportdata set numberofcomments=numberofcomments+1 where id='$recordid'";
            $updatesuccess= $this->DbHandler->updatesubmittedreports($q);
        }else{
            $this->session->set_flashdata('error', 'Comment not added!');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
    public function DisplayNewArchiveDekadalForm(){
        $this->unsetflashdatainfo();
        $name='displaynewarchivedekadalForm';
        $data['displaynewarchivedekadalForm'] = array('name' => $name);

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
        $this->load->view('archiveDekadalFormReportData', $data);

    }
    public function DisplayArchivedDekadalFormForUpdate(){
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


        $dekadalformidforupdate = $this->uri->segment(3);
        $query = $this->DbHandler->selectById($dekadalformidforupdate,'id','archivedekadalformreportdata');  //$value, $field,$table
        // $query = $this->DbHandler->selectById('daily','id',$dailyformid);
        if ($query) {
            $data['updatearchiveddekadalformreportdata'] = $query;
        } else {
            $data['updatearchiveddekadalformreportdata'] = array();
        }
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveDekadalFormReportData', $data);
    }
        public function DisplayArchivedDekadalFormForValidation(){
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


        $dekadalformidforupdate = $this->uri->segment(3);
        $query = $this->DbHandler->selectById($dekadalformidforupdate,'id','archivedekadalformreportdata');  //$value, $field,$table
        // $query = $this->DbHandler->selectById('daily','id',$dailyformid);
        if ($query) {
            $data['validatearchiveddekadalformreportdata'] = $query;
        } else {
            $data['validatearchiveddekadalformreportdata'] = array();
        }
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveDekadalFormReportData', $data);
    }

    public function insertArchiveDekadalFormReportData(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $name=$session_data['FirstName'].' '.$session_data['SurName'];
         $userid=$session_data['Userid'];
        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date_archivedekadalformreportdata');

            


            $station = firstcharuppercase(chgtolowercase($this->input->post('station_archivedekadalformreportdata')));

            $stationNumber = $this->input->post('stationNo_archivedekadalformreportdata');






        $maxTemp = $this->input->post('maxTemp_archivedekadalformreportdata');
        $minTemp = $this->input->post('minTemp_archivedekadalformreportdata');


        $dryBulb0600Z = $this->input->post('dryBulb0600Z_archivedekadalformreportdata');
        $wetBulb0600Z = $this->input->post('wetBulb0600Z_archivedekadalformreportdata');
        $dewPoint0600Z = $this->input->post('dewPoint0600Z_archivedekadalformreportdata');

        $relativeHumidity0600Z = $this->input->post('relativeHumidity0600Z_archivedekadalformreportdata');
        $windDirection0600Z = $this->input->post('windDirection0600Z_archivedekadalformreportdata');
        $windSpeed0600Z = $this->input->post('windSpeed0600Z_archivedekadalformreportdata');
        $rainfall0600Z = $this->input->post('rainfall0600Z_archivedekadalformreportdata');

        /////////////////////////////////////////
        $dryBulb1200Z = $this->input->post('dryBulb1200Z_archivedekadalformreportdata');
        $wetBulb1200Z = $this->input->post('wetBulb1200Z_archivedekadalformreportdata');
        $dewPoint1200Z = $this->input->post('dewPoint1200Z_archivedekadalformreportdata');

        $relativeHumidity1200Z = $this->input->post('relativeHumidity1200Z_archivedekadalformreportdata');
        $windDirection1200Z = $this->input->post('windDirection1200Z_archivedekadalformreportdata');
        $windSpeed1200Z = $this->input->post('windSpeed1200Z_archivedekadalformreportdata');
         $dekadalnumber = $this->input->post('dekadalnumber');



        $Approved = "FALSE";
       // $creationDate= date('Y-m-d H:i:s');
        $SubmittedBy=$name;


$stationId=$this->DbHandler->identifyStationById($station, $stationNumber);
        $insertArchiveDekadalFormDataIntoDB=array(
            'Date'=>$date,'station'=>$stationId,
            'AD_SubmittedBy' => $SubmittedBy ,'Approved'=>$Approved,
            'MAX_TEMP'=> $maxTemp, 'MIN_TEMP'=>$minTemp,

            'DRY_BULB_0600Z'=>$dryBulb0600Z,'WET_BULB_0600Z'=>$wetBulb0600Z,
            'DEW_POINT_0600Z'=>$dewPoint0600Z,'RELATIVE_HUMIDITY_0600Z'=>$relativeHumidity0600Z,
            'WIND_DIRECTION_0600Z'=>$windDirection0600Z,'WIND_SPEED_0600Z'=>$windSpeed0600Z,
            'RAINFALL_0600Z'=>$rainfall0600Z,

            'DRY_BULB_1200Z'=>$dryBulb1200Z,'WET_BULB_1200Z'=>$wetBulb1200Z,
            'DEW_POINT_1200Z'=>$dewPoint1200Z,'RELATIVE_HUMIDITY_1200Z'=>$relativeHumidity1200Z,
            'WIND_DIRECTION_1200Z'=>$windDirection1200Z,'WIND_SPEED_1200Z'=>$windSpeed1200Z,'Dekadalnumber'=>$dekadalnumber, 'submitedBy_Id'=>$userid
        );

         $checkduplicateform = $this->DbHandler->checkforduplicatearchivedekadal($date,$stationId,$dekadalnumber);
            

            if($checkduplicateform){
                $this->session->set_flashdata('error', 'Sorry, A Record for this time and date and dekadalnumber Already Exists');
                $this->index();
            }
            else{

        $insertsuccess= $this->DbHandler->insertData($insertArchiveDekadalFormDataIntoDB,'archivedekadalformreportdata'); //Array for data to insert then  the Table Name



        //Redirect the user back with  message
        if($insertsuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
            $userid = $session_data['Userid'];
            $userlogs = array('Userid' => $userid,
                'Action' => 'Added Archive Dekadal',
                'Details' => $name . ' added  Archive Dekadal Form info into the system',
                'IP' => $this->input->ip_address());
            // save user logs
             $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'New Archive Dekadal Form info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! Archive Dekadal Form info Form not inserted ');
            $this->index();

        }
       } 

    }
	 public 	function update_approval() {
		$session_data = $this->session->userdata('logged_in');
      $userstation=$session_data['UserStation'];
	  $user_id=$session_data['Userid'];
      $name=$session_data['FirstName'].' '.$session_data['SurName'];
		$id= $this->input->post('id');
		$data = array(
		'Approved' => $this->input->post('approve'),'ApprovedBy'=>(($this->input->post('approve')=="FALSE")? "":$name));
		$query=$this->DbHandler->updateApproval1($id,$data,"archivedekadalformreportdata");
		if ($query) {
		$this->session->set_flashdata('success', 'Data was updated successfully!');
		$this->index();
		}else{
		$this->session->set_flashdata('error', 'Sorry, Data was not updated, Please try again!');
		$this->index();	
		}
		}
    public function updateArchiveDekadalFormReportData(){
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        //$name=$session_data['FirstName'].' '.$session_data['SurName'];

        $this->load->helper(array('form', 'url'));

        $date = $this->input->post('date_archivedekadalformreportdata');

        $station = firstcharuppercase(chgtolowercase($this->input->post('station')));
        $stationNumber = $this->input->post('stationNo');
        $stationId = $this->DbHandler->identifyStationById($station,$stationNumber);
        $maxTemp = $this->input->post('maxTemp');
        $minTemp = $this->input->post('minTemp');
        $dekadalnumber = $this->input->post('dekadalnumber');

        $dryBulb0600Z = $this->input->post('dryBulb0600Z');
        $wetBulb0600Z = $this->input->post('wetBulb0600Z');
        $dewPoint0600Z = $this->input->post('dewPoint0600Z');

        $relativeHumidity0600Z = $this->input->post('relativeHumidity0600Z');
        $windDirection0600Z = $this->input->post('windDirection0600Z');
        $windSpeed0600Z = $this->input->post('windSpeed0600Z');
        $rainfall0600Z = $this->input->post('rainfall0600Z');

        /////////////////////////////////////////
        $dryBulb1200Z = $this->input->post('dryBulb1200Z');
        $wetBulb1200Z = $this->input->post('wetBulb1200Z');
        $dewPoint1200Z = $this->input->post('dewPoint1200Z');

        $relativeHumidity1200Z = $this->input->post('relativeHumidity1200Z');
        $windDirection1200Z = $this->input->post('windDirection1200Z');
        $windSpeed1200Z = $this->input->post('windSpeed1200Z');

        $Approved = $this->input->post('approval');

        $id = $this->input->post('id');
        $doqa=$this->input->post('qualitycontrolled');
         if($doqa=="qa"){
            $session_data = $this->session->userdata('logged_in');
            $qao=$session_data['FirstName'].' '.$session_data['SurName'];
          }else{
             $qao=NULL;
         }

        $updateArchiveDekadalFormDataInDB=array(
            'Date'=>$date,'station'=>$stationId,
            'Approved'=>$Approved,
            'MAX_TEMP'=> $maxTemp, 'MIN_TEMP'=>$minTemp,

            'DRY_BULB_0600Z'=>$dryBulb0600Z,'WET_BULB_0600Z'=>$wetBulb0600Z,
            'DEW_POINT_0600Z'=>$dewPoint0600Z,'RELATIVE_HUMIDITY_0600Z'=>$relativeHumidity0600Z,
            'WIND_DIRECTION_0600Z'=>$windDirection0600Z,'WIND_SPEED_0600Z'=>$windSpeed0600Z,
            'RAINFALL_0600Z'=>$rainfall0600Z,

            'DRY_BULB_1200Z'=>$dryBulb1200Z,'WET_BULB_1200Z'=>$wetBulb1200Z,
            'DEW_POINT_1200Z'=>$dewPoint1200Z,'RELATIVE_HUMIDITY_1200Z'=>$relativeHumidity1200Z,
            'WIND_DIRECTION_1200Z'=>$windDirection1200Z,'WIND_SPEED_1200Z'=>$windSpeed1200Z,'Dekadalnumber'=>$dekadalnumber, 'qaBy'=>$qao);
       
        $updatesuccess=$this->DbHandler->updateData($updateArchiveDekadalFormDataInDB,"",'archivedekadalformreportdata',$id);


        //Redirect the user back with  message
        if($updatesuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
             $userid = $session_data['Userid'];
            
            //  save user logs

            if($doqa=="qa"){
                $userlogs = array('Userid' => $userid,'station_id'=>$stationId,
                'Action' => 'Quality control Archive Dekadal',
                'Details' => $name . ' did quality assurance checks on Archived Dekadal Form info into the system',
                'IP' => $this->input->ip_address());
               
              }else{
                $userlogs = array('Userid' => $userid,'station_id'=>$stationId,
                'Action' => 'Updated Archive Dekadal',
                'Details' => $name . ' updated Archived Dekadal Form info into the system',
                'IP' => $this->input->ip_address());
             }
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'Archive Dekadal Form info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue! Dekadal Form info not updated');
            $this->index();

        }

    }

    public function deleteArchivedDekadalFormData()
    {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        //$query = $this->DbHandler->DeleteDailyPeriodicRainfallData($id);

        $rowsaffected = $this->DbHandler->deleteData('archivedekadalformreportdata',$id);  //$rowsaffected > 0 $tablename,id of the row

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
            $userid = $session_data['Userid'];
            $userlogs = array('User' => $name,
                'Userid' => $userid,'Action' => 'Deleted Archive Dekadal',
                'Details' => $name . ' deleted Archived Dekadal from the system',
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', ' Archived Dekadal info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfArchiveDekadalFormReportRecordExistsAlready($date,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkIfArchiveDekadalFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber,'archivedekadalformreportdata');   // $value, $field, $table

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

?>
