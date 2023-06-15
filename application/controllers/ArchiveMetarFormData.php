<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveMetarFormData extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
        $this->load->library('session');
        //$this->load->library('encrypt');
         
     if(!$this->session->userdata('logged_in')){
	  $this->session->set_flashdata('warning', 'Sorry, your session has expired.Please login again.');
       redirect('/Welcome');
	  }
    }
    public function index($id=NULL){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userid=$session_data['Userid'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAll($userstation,'StationName','archivemetarformdata','','',$id,$userid);


        //  var_dump($query);
        if ($query) {
            $data['archivedmetarformdata'] = $query;
        } else {
            $data['archivedmetarformdata'] = array();
        }
        if($id!=NULL){
         $data['observationslipcomments'] = $this->DbHandler->selectRecordComments($id,'archivemetarformdata');
        }
        $this->load->view('archiveMetarFormData', $data);
    }

    public function submitObservationslipComment(){
        $comment= $this->input->post('comment');
        $recordid = $this->input->post('recordid');
        $session_data = $this->session->userdata('logged_in');
        //$userstation=$session_data['UserStation'];
        $userrole=$session_data['UserRole'];
        $name=$session_data['SurName'].' '.$session_data['FirstName'];
        $form_type="archivemetarformdata";
        $insertObservationSlipComment=array(
            'comment'=>$comment,'record_id'=>$recordid,'form_type'=>$form_type,'comment_by'=>$name,'userrole'=>$userrole);
        $insertsuccess= $this->DbHandler->insertData($insertObservationSlipComment,'raw_datacomments'); //Array for data to insert then  the Table Name   
        if($insertsuccess){
            $this->session->set_flashdata('success', 'Comment added successfully!');
            $q= "update archivemetarformdata set numberofcomments=numberofcomments+1 where id='$recordid'";
            $updatesuccess= $this->DbHandler->updatesubmittedreports($q);
        }else{
            $this->session->set_flashdata('error', 'Comment not added!');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
    public function DisplayArchivedMetarForm(){
        $this->unsetflashdatainfo();
        $name='displaynewarchivemetarform';
        $data['displaynewarchivemetarform'] = array('name' => $name);

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

        /////////////////////////////////////////////////////////
        // NID TO LOAD STATION INDICATORS
        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }
        ///////////////////////////////////////////////////////
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveMetarFormData', $data);

    }
    public function DisplayArchivedMetarFormForUpdate(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        ///////////////////////////////////////////////////////////////////////
        // NID TO LOAD STATION INDICATORS
        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'LocationStationName','stations');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }
        ////////////////////////////////////////////

        $metarid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($metarid,'id','archivemetarformdata');  //$value, $field,$table
        if ($query) {
            $data['archivemetarformdataid'] = $query;
        } else {
            $data['archivemetarformdataid'] = array();
        }

         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveMetarFormData', $data);
    }
        public function DisplayArchivedMetarFormForValidation(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        ///////////////////////////////////////////////////////////////////////
        // NID TO LOAD STATION INDICATORS
        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'LocationStationName','stations');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }
        ////////////////////////////////////////////

        $metarid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($metarid,'id','archivemetarformdata');  //$value, $field,$table
        if ($query) {
            $data['archivemetarformdatavalidate'] = $query;
        } else {
            $data['archivemetarformdatavalidate'] = array();
        }

         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveMetarFormData', $data);
    }
    public function insertAchiveMetarForm(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        $firstname=$session_data['FirstName'];
        $surname=$session_data['SurName'];
         $userid=$session_data['Userid'];


        $date = $this->input->post('date_archivemetarformdata');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station_archivemetarformdata')));

            $stationNumber = $this->input->post('stationNo_archivemetarformdata');



        $metarspeci = $this->input->post('metarspeci_archivemetarformdata');
        $cccc = $this->input->post('cccc_archivemetarformdata');
        $yyGGgg = $this->input->post('yyGGgg_archivemetarformdata');
        $timeWhenMetarIsTaken=$this->input->post('time_archivemetarformdata');
        $Dddfffmfm = $this->input->post('dddfffmfm_archivemetarformdata');
        $wwcovak = $this->input->post('wwcavok_archivemetarformdata');
        $w1w1 = $this->input->post('w1w1_archivemetarformdata');
        $n1cch1 = $this->input->post('ncc_archivemetarformdata');



        $tttdtd = $this->input->post('tttdtd_archivemetarformdata');
        $qnhhpa = $this->input->post('qnhhpa_archivemetarformdata');
        $qnhin = $this->input->post('qnhin_archivemetarformdata');
        $qfehpa = $this->input->post('qfehpa_archivemetarformdata');
        $qfein = $this->input->post('qfein_archivemetarformdata');
        $rew1w1 = $this->input->post('rew1w1_archivemetarformdata');

        $approved="FALSE";
       // $creationDate= date('Y-m-d H:i:s');
        $user=$firstname.' '.$surname;
        //$approved='false';
        $stationId=$this->DbHandler->identifyStationById($station, $stationNumber);
        $insertArchiveMetarFormData=array(
            'Date'=>$date,'station'=>$stationId,
            'METARSPECI'=> $metarspeci, 'CCCC'=>$cccc,
            'YYGGgg'=> $yyGGgg,'TIME'=>$timeWhenMetarIsTaken,
            'Dddfffmfm'=> $Dddfffmfm, 'WWorCAVOK'=> $wwcovak,
            'W1W1'=>$w1w1, 'NlCCNmCCNhCC'=> $n1cch1, 'TTTdTd'=> $tttdtd, 'Qnhhpa'=>$qnhhpa, 'Qnhin'=>$qnhin,
            'Qfehpa'=>$qfehpa, 'Qfein'=>$qfein,'REW1W1'=>$rew1w1,'Approved'=>$approved,
             'AM_SubmittedBy'=>$user,
             'submitedBy_Id'=>$userid);


        //Insert New Metar Infor into the Database.
        // $insertsuccess= $this->DbHandler->insertMetarFormData($insertMetarFormData);

        $insertsuccess= $this->DbHandler->insertData($insertArchiveMetarFormData,'archivemetarformdata'); //Array for data to insert then  the Table Name


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
            $userid =$session_data['Userid'];
            $userlogs = array('Userid' => $userid,
                'Action' => 'Added Archive Metar',
                'Details' => $name . ' added archive metar book info into the system',
                'IP' => $this->input->ip_address());
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'New Archive metar info was added successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }



    }

    public function updateArchiveMetarFormData(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        //$firstname=$session_data['FirstName'];
        //$surname=$session_data['SurName'];



        $date = $this->input->post('date');




            $station = firstcharuppercase(chgtolowercase($this->input->post('station')));
            $stationNumber = $this->input->post('stationNo');
            $stationId = $this->DbHandler->identifyStationById($station,$stationNumber);

        $metarspeci = $this->input->post('metarspeci');
        $cccc = $this->input->post('cccc');
        $yyGGgg = $this->input->post('yyGGgg');
        $timeWhenMetarIsTaken=$this->input->post('timeRecorded');
        $Dddfffmfm = $this->input->post('dddfffmfm');
        $wwcovak = $this->input->post('wwcavok');
        $w1w1 = $this->input->post('w1w1');
        $n1cch1 = $this->input->post('ncc');


        $tttdtd = $this->input->post('tttdtd');
        $qnhhpa = $this->input->post('qnhhpa');
        $qnhin = $this->input->post('qnhin');
        $qfehpa = $this->input->post('qfehpa');
        $qfein = $this->input->post('qfein');
        $rew1w1 = $this->input->post('rew1w1');

        $approved=$this->input->post('approval');

        $id = $this->input->post('id');
        $doqa=$this->input->post('qualitycontrolled');
         if($doqa=="qa"){
            $session_data = $this->session->userdata('logged_in');
            $qao=$session_data['FirstName'].' '.$session_data['SurName'];
          }else{
             $qao=NULL;
         }

        $updateArchiveMetarFormData=array(
            'Date'=>$date,'station'=>$stationId,
            'METARSPECI'=> $metarspeci, 'CCCC'=>$cccc,
            'YYGGgg'=> $yyGGgg,'TIME'=>$timeWhenMetarIsTaken,
            'Dddfffmfm'=> $Dddfffmfm, 'WWorCAVOK'=> $wwcovak,
            'W1W1'=>$w1w1, 'NlCCNmCCNhCC'=> $n1cch1,'TTTdTd'=> $tttdtd, 'Qnhhpa'=>$qnhhpa, 'Qnhin'=>$qnhin,
            'Qfehpa'=>$qfehpa, 'Qfein'=>$qfein,'REW1W1'=>$rew1w1,'Approved'=>$approved, 'qaBy'=>$qao);



        $updatesuccess=$this->DbHandler->updateData($updateArchiveMetarFormData,"",'archivemetarformdata',$id);




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
            $userid =  $session_data['Userid'];
            if($doqa=="qa"){
                $userlogs = array('Userid' => $userid,'station_id'=>$stationId,
                'Action' => 'Quality control Archive Metar',
                'Details' => $name . ' did quality assurance checks on Archive Metar Form info into the system',
                'IP' => $this->input->ip_address());
               
              }else{
                $userlogs = array('Userid' => $userid,
                'Action' => 'Updated Archive Metar',
                'Details' => $name . ' Updated  archive metar  info into the system',
                'IP' => $this->input->ip_address());
             }
           
            //  save user logs
             $this->DbHandler->saveUserLogs($userlogs);



            $this->session->set_flashdata('success', 'Archived Metar  info was updated successfully!');
            $this->index();

        }
        else{
            $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
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
		$query=$this->DbHandler->updateApproval1($id,$data,"archivemetarformdata");
		if ($query) {
		$this->session->set_flashdata('success', 'Data was updated successfully!');
		$this->index();
		}else{
		$this->session->set_flashdata('error', 'Sorry, Data was not updated, Please try again!');
		$this->index();	
		}
		}

    public function deleteArchiveMetarFormData() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('archivemetarformdata',$id);  //$rowsaffected > 0

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
            $userid =$session_data['Userid'];
            $userlogs = array('User' => $name,
                'Userid' => $userid,'Action' => 'Deleted Archive Metar',
                'Details' => $name . ' deleted metar book info into the system',
                'IP' => $this->input->ip_address());
            //  save user logs
              $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Archive Metar book info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }
    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfArchiveMetarFormRecordExistsAlready($date,$stationName,$stationNumber,$timeOfMetarRecorded,$metarOption) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
        $timeOfMetarRecorded = ($timeOfMetarRecorded == "") ? $this->input->post('timeOfMetarRecorded') : $timeOfMetarRecorded;
        $metarOption = ($metarOption == "") ? $this->input->post('metarOption') : $metarOption;
        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveMetarFormRecordExistsAlready($date,$stationName,$stationNumber,$timeOfMetarRecorded,$metarOption,'archivemetarformdata');   // $value, $field, $table

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
