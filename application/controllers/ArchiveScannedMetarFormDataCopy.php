<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveScannedMetarFormDataCopy extends CI_Controller {

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
        // $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];
        $userid=$session_data['Userid'];
        $query = $this->DbHandler->selectAllscanDaily($userstation,'StationName','scans_daily',"metarreport",$userid,$id);  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['archivedscannedmetarformdetails'] = $query;
        } else {
            $data['archivedscannedmetarformdetails'] = array();
        }


        //Load the view.
        $data['uploaded_files'] = $this->DbHandler->archievescanned_files();
        if($id!=NULL){
         $data['observationslipcomments'] = $this->DbHandler->selectRecordComments($id,'scannedmetar');
        }
        $this->load->view('archiveScannedMetarFormDataCopy', $data);
    }
    public function submitObservationslipComment(){
        $comment= $this->input->post('comment');
        $recordid = $this->input->post('recordid');
        $session_data = $this->session->userdata('logged_in');
        //$userstation=$session_data['UserStation'];
        $userrole=$session_data['UserRole'];
        $name=$session_data['SurName'].' '.$session_data['FirstName'];
        $form_type="scannedmetar";
        $insertObservationSlipComment=array(
            'comment'=>$comment,'record_id'=>$recordid,'form_type'=>$form_type,'comment_by'=>$name,'userrole'=>$userrole);
        $insertsuccess= $this->DbHandler->insertData($insertObservationSlipComment,'raw_datacomments'); //Array for data to insert then  the Table Name   
        if($insertsuccess){
            $this->session->set_flashdata('success', 'Comment added successfully!');
            $q= "update scans_daily set numberofcomments=numberofcomments+1 where id='$recordid'";
            $updatesuccess= $this->DbHandler->updatesubmittedreports($q);
        }else{
            $this->session->set_flashdata('error', 'Comment not added!');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
    public function DisplayFormToArchiveScannedMetarForm(){
        $this->unsetflashdatainfo();
        $name='displaynewFormToArchiveScannedMetarForm';
        $data['displaynewFormToArchiveScannedMetarForm'] = array('name' => $name);

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        /////////////////////////////////////////////////////////

         $data['regions']=$this->DbHandler->selectStations();

        $this->load->view('archiveScannedMetarFormDataCopy', $data);

    }
    public function DisplayFormToArchiveScannedMetarFormForUpdate(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }




        $scannedmetarformid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($scannedmetarformid,'id','scans_daily','');  //$value, $field,$table
        if ($query) {
            $data['scannedmetarformidDetails'] = $query;
        } else {
            $data['scannedmetarformidDetails'] = array();
        }

        $record_id= $query[0]->record_id;
        $data['record_id']=$record_id;
        $data['already_uploaded'] = $this->DbHandler->archievescanned_files($record_id);
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveScannedMetarFormDataCopy', $data);
    }


    public function insertInformationForArchiveScannedMetarForm(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_metarform';   //name of the input text field
        $total = count($_FILES[$file_element_name]['name']);
         $single_filename="";






            $formname = firstcharuppercase(chgtolowercase($this->input->post('formname_metar')));



            $station = $this->input->post('station_ArchiveScannedMetarForm');
            $stationNumber = $this->input->post('stationNo_ArchiveScannedMetarForm');
            $station_id= $this->DbHandler->identifyStationById($station,$stationNumber);
            $record_identity=$stationNumber."metar_".date("Ymdhisa");



        $dateOnScannedMetarForm = $this->input->post('dateOnScannedMetarForm_metar');


        $description = $this->input->post('description_metar');
        //$creationDate= date('Y-m-d H:i:s');
        $Approved="FALSE";
        $firstname=$session_data['FirstName'];
        $surname=$session_data['SurName'];
        $SubmittedBy=$firstname.' '.$surname;
          $userid=$session_data['Userid'];
        $insertScannedMetarFormDataDetails=array(
            'Form_scanned' => $formname, 'station' => $station_id,
            'record_id'=>$record_identity,
            'form_date' => $dateOnScannedMetarForm,'Approved'=> $Approved,'SD_SubmittedBy'=>$SubmittedBy,'submitedBy_Id'=>$userid);

            $duplicate=$this->DbHandler->checkforDuplicatearchivescanned("Select * from scans_daily where form_date = '$dateOnScannedMetarForm' and station = '$station_id' and numfiles>0");
            if( $duplicate>0){
                $this->session->set_flashdata('error', ' Archive Scanned metar record of '.$dateOnScannedMetarForm.' for the station '.$station. ' already exists!');
                redirect("ArchiveScannedMetarFormDataCopy");
            }else{
        //$this->DbHandler->insertInstrument($insertInstrumentData);
        $insertsuccess= $this->DbHandler->insertData($insertScannedMetarFormDataDetails,'scans_daily'); //Array for data to insert then  the Table Name

        //Redirect the user back with  message
        if($insertsuccess){
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userid =$session_data['Userid'];
            $userlogs = array('Userid' => $userid,
                'Action' => 'Added Archive Scanned Metar',
                'Details' => $name . ' added new Scanned Metar Form details into the system ',
                
                'IP' => $this->input->ip_address());
            //  save user logs
            $this->DbHandler->saveUserLogs($userlogs);


            $this->session->set_flashdata('success', 'New Scanned Metar Form details info was added successfully!');
            //$this->index();
            redirect("ArchiveScannedMetarFormDataCopy/DisplayFormToArchiveScannedMetarFormFIles/".$record_identity);

        }
        else{
            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }
      }
    }
    public function insertInformationForArchiveScannedMetarFormFiles(){
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_observationslipform';   //name of the input text field
        $record = $this->input->post('record');
        $description = $this->input->post('description');

       $single_filename="";
       $imgone = $_FILES[$file_element_name]['name'];
      

         $temp = explode(".", $_FILES[$file_element_name]["name"]);
         $single_filename = 'scannedmetar'.date("Y-m-d") . '.' . end($temp);
         move_uploaded_file($_FILES[$file_element_name]["tmp_name"], "archive/" . $single_filename);
    
        $insertScannedObservationfiles=array('file' => $single_filename, 'description' => $description,'record_id' => $record);
         $insertsuccess= $this->DbHandler->insertData($insertScannedObservationfiles,'archivescannnedfiles'); //Array for data to insert then  the Table Name
         $q="Update scans_daily set numfiles=numfiles+1 where record_id='$record'";
         $insertsuccess= $this->DbHandler->updatesubmittedreports($q);
            header('location:'.$_SERVER['HTTP_REFERER']);
        }


    public function DisplayFormToArchiveScannedMetarFormFIles($id=NULL){
        $this->unsetflashdatainfo();
        $name='displaynewFormToArchiveScannedObservationSlipFormDetails';
        $data['displaynewFormToArchiveScannedObservationSlipFormDetails'] = array('name' => $name);

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
         $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        /////////////////////////////////////////////////////////
       if($id!=NULL){
           $data['record_id']=$id;
       }

       $data['already_uploaded'] = $this->DbHandler->archievescanned_files($id);
       $data['form_type']="metar";
        $this->load->view('archievefiles', $data);

    }

    public function updateInformationForArchiveScannedMetarForm(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];



            $formname = firstcharuppercase(chgtolowercase($this->input->post('formname')));

                $stationId = $this->input->post('stationId');
                $stationNo = $this->input->post('stationNo');
                $comment = $this->input->post('comment');


            $dateOnScannedMetarForm = $this->input->post('dateOnScannedMetarForm');
            $description = $this->input->post('description');
            $id = $this->input->post('id');
            $approved=$this->input->post('approval');



            $updateScannedMetarFormDataDetails=array(
                'Approved'=>$approved,
                'station' => $stationId,'comment' => $comment, 'form_date' => $dateOnScannedMetarForm);

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $updatesuccess=$this->DbHandler->updateData($updateScannedMetarFormDataDetails,"",'scans_daily',$id);

            //Redirect the user back with  message
            if($updatesuccess){
                $session_data = $this->session->userdata('logged_in');
                $userrole=$session_data['UserRole'];
                $userstation=$session_data['UserStation'];
                $userstationId=$session_data['StationId'];
                $name=$session_data['FirstName'].' '.$session_data['SurName'];

              $userid =$session_data['Userid'];
              $userlogs = array('Userid' => $userid,
                   'Action' => 'Updated Archive Scanned Metar',
                    'Details' => $name . ' updated archive scanned metar into the system ',
                    
                    'IP' => $this->input->ip_address());
                //  save user logs
               $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'New Scanned Metar Form details info was added successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

       // }

    }
    public  function update_approval() {
        $session_data = $this->session->userdata('logged_in');
      $userstation=$session_data['UserStation'];
      $user_id=$session_data['Userid'];
      $name=$session_data['FirstName'].' '.$session_data['SurName'];
        $id= $this->input->post('id');
        $data = array(
        'Approved' => $this->input->post('approve'), 'ApprovedBy'=>(($this->input->post('approve')=="FALSE")? "":$name));
        $query=$this->DbHandler->updateApproval1($id,$data,"scans_daily");
        if ($query) {
        $this->session->set_flashdata('success', 'Data was updated successfully!');
        $this->index();
        }else{
        $this->session->set_flashdata('error', 'Sorry, Data was not updated, Please try again!');
        $this->index(); 
        }
        }
    public function deleteInformationForArchiveScannedMetarForm() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('scans_daily',$id);  //$rowsaffected > 0

        if ($rowsaffected) {
            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userstation=$session_data['UserStation'];
            $userstationNo=$session_data['StationNumber'];
            $userstationId=$session_data['StationId'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted Archive Scanned Metar',
                'Details' => $name . ' deleted instrument details into the system ',
                'station' => $userstationId,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Instrument info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }
    function getInstruments($stationName) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
//check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        } else {


            //$get_result = $this->DbHandler->getResults($stationName, 'StationName', 'instruments');   // $value, $field, $table
            $data['results'] = $this->DbHandler->getResults($stationName, 'StationName', 'instruments');
            if($data['results']){   // we got a result, output json
                echo json_encode( $data['results'] );
            } else {
                echo json_encode( array('error' => true) );
            }



        }


    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfArchiveScannedMetarFormDataCopyRecordExistsAlready($date,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveScannedMetarFormDataCopyRecordExistsAlready($date,$stationName,$stationNumber,'scans_daily');   // $value, $field, $table

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
    function confirmSubmission($record){
        $query="update scans_daily set submissionstatus='Completed' where record_id='$record'";
        $result=$this->DbHandler->updatesubmittedreports($query);
        redirect(base_url('index.php/ArchiveScannedMetarFormDataCopy'));
     } 

}

?>
