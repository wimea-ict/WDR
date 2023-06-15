<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveScannedMonthlyRainfallFormDataReportCopy extends CI_Controller {

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

        $query = $this->DbHandler->selectAllScansmonthly($userstation,'StationName','scans_monthly','MonthlyRainfallReport',$userid,$id);  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['archivedscannedmonthlyrainfallformreportdetails'] = $query;
        } else {
            $data['archivedscannedmonthlyrainfallformreportdetails'] = array();
        }


        //Load the view.
        $data['uploaded_files'] = $this->DbHandler->archievescanned_files();
        if($id!=NULL){
         $data['observationslipcomments'] = $this->DbHandler->selectRecordComments($id,'scannedmonthly');
        }
        $this->load->view('archiveScannedMonthlyRainfallFormDataReportCopy', $data);
    }
     public function submitObservationslipComment(){
        $comment= $this->input->post('comment');
        $recordid = $this->input->post('recordid');
        $session_data = $this->session->userdata('logged_in');
        //$userstation=$session_data['UserStation'];
        $userrole=$session_data['UserRole'];
        $name=$session_data['SurName'].' '.$session_data['FirstName'];
        $form_type="scannedmonthly";
        $insertObservationSlipComment=array(
            'comment'=>$comment,'record_id'=>$recordid,'form_type'=>$form_type,'comment_by'=>$name,'userrole'=>$userrole);
        $insertsuccess= $this->DbHandler->insertData($insertObservationSlipComment,'raw_datacomments'); //Array for data to insert then  the Table Name   
        if($insertsuccess){
            $this->session->set_flashdata('success', 'Comment added successfully!');
            $q= "update scans_monthly set numberofcomments=numberofcomments+1 where id='$recordid'";
            $updatesuccess= $this->DbHandler->updatesubmittedreports($q);
        }else{
            $this->session->set_flashdata('error', 'Comment not added!');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }
    public function DisplayFormToArchiveScannedMonthlyRainfallFormReport(){
        $this->unsetflashdatainfo();
        $name='displaynewFormToArchiveScannedMonthlyRainfallFormReport';
        $data['displaynewFormToArchiveScannedMonthlyRainfallFormReport'] = array('name' => $name);

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
        $this->load->view('archiveScannedMonthlyRainfallFormDataReportCopy', $data);

    }
    public function insertInformationForArchiveScannedMonthlyRainfallFormFiles(){
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_observationslipform';   //name of the input text field
        $record = $this->input->post('record');
        $description = $this->input->post('description');

        $single_filename="";
        $imgone = $_FILES[$file_element_name]['name'];
        

          $temp = explode(".", $_FILES[$file_element_name]["name"]);
          $single_filename = 'scannedmonthlyrainfall'.date("Y-m-d") . '.' . end($temp);
          move_uploaded_file($_FILES[$file_element_name]["tmp_name"], "archive/" . $single_filename);
    
        $insertScannedObservationfiles=array('file' => $single_filename, 'description' => $description,'record_id' => $record);
         $insertsuccess= $this->DbHandler->insertData($insertScannedObservationfiles,'archivescannnedfiles'); //Array for data to insert then  the Table Name

         $q="Update scans_monthly set numfiles=numfiles+1 where record_id='$record'";
         $insertsuccess= $this->DbHandler->updatesubmittedreports($q);    
            header('location:'.$_SERVER['HTTP_REFERER']);
        }


    public function DisplayFormToArchiveScannedMonthlyRainfallFormFIles($id=NULL){
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
       $data['form_type']="monthlyrainfall";
        $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archievefiles', $data);

    }
    public function DisplayFormToArchiveScannedMonthlyRainfallFormReportForUpdate(){
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




        $scannedmonthlyrainfallformreportid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($scannedmonthlyrainfallformreportid,'id','scans_monthly');  //$value, $field,$table
        if ($query) {
            $data['scannedmonthlyrainfallformreportidDetails'] = $query;
        } else {
            $data['scannedmonthlyrainfallformreportidDetails'] = array();
        }

        $record_id= $query[0]->record_id;
        $data['record_id']=$record_id;
        $data['already_uploaded'] = $this->DbHandler->archievescanned_files($record_id);
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveScannedMonthlyRainfallFormDataReportCopy', $data);
    }


    public function insertInformationForArchiveScannedMonthlyRainfallFormReport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_monthlyrainfallformdatareport';


            $formname = $this->input->post('formname_monthlyrainfallformreport');


                $station = $this->input->post('station_ArchiveScannedMonthlyRainfallFormReport');
                $stationNo = $this->input->post('stationNo_ArchiveScannedMonthlyRainfallFormReport');



            $monthOFScannedMonthlyRainfallFormReport = $this->input->post('monthOfScannedMonthlyRainfallFormReport_monthlyrainfallformreport');
            $yearOFScannedMonthlyRainfallFormReport = $this->input->post('yearOfScannedMonthlyRainfallFormReport_monthlyrainfallformreport');


            $description = $this->input->post('description_monthlyrainfallformreport');
           // $creationDate= date('Y-m-d H:i:s');
            $Approved="FALSE";
            $firstname=$session_data['FirstName'];
            $surname=$session_data['SurName'];
            $SubmittedBy=$user=$firstname.' '.$surname;
            $userid=$session_data['Userid'];
            $stationId=$this->DbHandler->identifyStationById($station, $stationNo);//station name and station number
            $record_identity=$stationNumber."monthlyrainfall_".date("Ymdhisa");

            $insertScannedMonthlyRainfallFormReportDataDetails=array(
                'Form_scanned' => $formname, 'station' => $stationId,
                'Month' => $monthOFScannedMonthlyRainfallFormReport,'Year' => $yearOFScannedMonthlyRainfallFormReport,
                'record_id'=>$record_identity,
                'Approved'=> $Approved,'SM_SubmittedBy'=>$SubmittedBy,'submitedBy_Id'=>$userid
               );

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $duplicate=$this->DbHandler->checkforDuplicatearchivescanned("Select * from scans_monthly where Year = $yearOFScannedMonthlyRainfallFormReport and Month = '$monthOFScannedMonthlyRainfallFormReport' and station = $stationId and numfiles>0");
            if( $duplicate>0){
                $this->session->set_flashdata('error', ' Archive Scanned monthly rainfall record of '.$monthOFScannedMonthlyRainfallFormReport.', '.$yearOFScannedMonthlyRainfallFormReport.' for the station '.$station. ' already exists!');
                redirect("ArchiveScannedMonthlyRainfallFormDataReportCopy");
            }else{
            $insertsuccess= $this->DbHandler->insertData($insertScannedMonthlyRainfallFormReportDataDetails,'scans_monthly'); //Array for data to insert then  the Table Name

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
                   'Action' => 'Added Archive Scanned Monthly Rainfall',
                    'Details' => $name . ' added new Scanned Metar Form details into the system ',
            
                    'IP' => $this->input->ip_address());
                //  save user logs
               $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'New Scanned Metar Form details info was added successfully!');
                redirect("ArchiveScannedMonthlyRainfallFormDataReportCopy/DisplayFormToArchiveScannedMonthlyRainfallFormFIles/".$record_identity);
            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }
        }
    }



    public function updateInformationForArchiveScannedMonthlyRainfallFormReport(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'updatearchievescannedcopy_monthlyrainfallformdatareportcopy';

        if (isset($_FILES[$file_element_name]) && is_uploaded_file($_FILES[$file_element_name]['tmp_name'])) { //file has been uploaded

        $config['upload_path'] = 'archive/';
        // $config['upload_path'] = '/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx';
        $config['encrypt_name'] = FALSE;
        // $config['max_size'] = '2GB';
        //IMB=1024KB  2MB=2048KB   1GB=1024MB   2GB=2048MB
        //1MB=1024KB  THEN 2048MB=2097152KB
        $config['max_size'] = '2097152';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
        $config['max_height'] = '768';
        $config['max_width'] = '1024';
        $config['remove_spaces'] = TRUE;
         $config['file_name'] ='UpdatedMonthlyRainfallScan' .'-'.date("Y-m-d").'-'.$_FILES['userfile']['name'];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name))
        {
            $status = 'error';
            echo   $msg = $this->upload->display_errors('', '');
        }
        else
        {
            $data = $this->upload->data();
            $filename = $data['file_name'];
        }
        }else {    //no file has been uploaded.

            $filename= $this->input->post('PreviouslyUploadedFileName_monthlyrainfallformdatareportcopy');
        }



            $formname = $this->input->post('formname');
              $station = $this->input->post('stationId');
              $stationNo = $this->input->post('stationNo');
              $comment = $this->input->post('comment');


            $monthOFScannedMonthlyRainfallFormReport = $this->input->post('monthOfScannedMonthlyRainfallFormReport');
            $yearOFScannedMonthlyRainfallFormReport = $this->input->post('yearOfScannedMonthlyRainfallFormReport');


            $description = $this->input->post('description');
            $id = $this->input->post('id');
            $approved=$this->input->post('approval');


            $updateScannedMonthlyRainfallFormReportDataDetails=array(
             'Approved'=>$approved,  'station' => $station, 'month' => $monthOFScannedMonthlyRainfallFormReport,'year'=> $yearOFScannedMonthlyRainfallFormReport,'comment' => $comment,
                'Description'=>$description,'FileRef' => $filename);

            $updatesuccess=$this->DbHandler->updateData($updateScannedMonthlyRainfallFormReportDataDetails,'','scans_monthly',$id);

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

                $userid =$session_data['Userid'];
                $userlogs = array('Userid' => $userid,
                    'Action' => 'Updated Archive Scanned Monthly Rainfall',
                    'Details' => $name . ' Updated Archive Scanned Monthly Rainfall Form details into the system ',
            
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

        //}

    }
    public  function update_approval() {
        $session_data = $this->session->userdata('logged_in');
      $userstation=$session_data['UserStation'];
      $user_id=$session_data['Userid'];
      $name=$session_data['FirstName'].' '.$session_data['SurName'];
        $id= $this->input->post('id');
        $data = array(
        'Approved' => $this->input->post('approve'), 'ApprovedBy'=>(($this->input->post('approve')=="FALSE")? "":$name));
        $query=$this->DbHandler->updateApproval1($id,$data,"scans_monthly");
        if ($query) {
        $this->session->set_flashdata('success', 'Data was updated successfully!');
        $this->index();
        }else{
        $this->session->set_flashdata('error', 'Sorry, Data was not updated, Please try again!');
        $this->index(); 
        }
        }
    public function deleteInformationForArchiveScannedMonthlyRainfallFormReport() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('scans_monthly',$id);  //$rowsaffected > 0

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
                'UserRole' => $userrole,'Action' => 'Deleted instrument details',
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
    function checkInDBIfArchiveScannedMonthlyRainfallFormDataReportCopyRecordExistsAlready($month,$year,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $month = ($month == "") ? $this->input->post('month') : $month;
        $year = ($year == "") ? $this->input->post('year') : $year;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveScannedMonthlyRainfallFormDataReportCopyRecordExistsAlready($month,$year,$stationName,$stationNumber,'scannedarchivemonthlyrainfallformreportcopydetails');   // $value, $field, $table

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
        $query="update scans_monthly set submissionstatus='Completed' where record_id='$record'";
        $result=$this->DbHandler->updatesubmittedreports($query);
        redirect(base_url('index.php/ArchiveScannedMonthlyRainfallFormDataReportCopy'));
     }
}

?>
