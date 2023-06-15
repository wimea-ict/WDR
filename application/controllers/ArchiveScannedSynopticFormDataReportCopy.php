<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveScannedSynopticFormDataReportCopy extends CI_Controller {

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

        $query = $this->DbHandler->selectAllscanDaily($userstation,'StationName','scans_daily',"synopticform",$userid,$id);  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['archivedscannedsynopticformreportcopydetails'] = $query;
        } else {
            $data['archivedscannedsynopticformreportcopydetails'] = array();
        }


        //Load the view.
        $data['uploaded_files'] = $this->DbHandler->archievescanned_files();
         if($id!=NULL){
         $data['observationslipcomments'] = $this->DbHandler->selectRecordComments($id,'scannedsynop');
        }
        $this->load->view('archiveScannedSynopticFormDataReportCopy', $data);
    }
      public function submitObservationslipComment(){
        $comment= $this->input->post('comment');
        $recordid = $this->input->post('recordid');
        $session_data = $this->session->userdata('logged_in');
        //$userstation=$session_data['UserStation'];
        $userrole=$session_data['UserRole'];
        $name=$session_data['SurName'].' '.$session_data['FirstName'];
        $form_type="scannedsynop";
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
    public function DisplayFormToArchiveScannedSynopticFormReportDetails(){
        $this->unsetflashdatainfo();
        $name='displaynewFormToArchiveScannedSynopticFormReportDetails';
        $data['displaynewFormToArchiveScannedSynopticFormReportDetails'] = array('name' => $name);

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

        $this->load->view('archiveScannedSynopticFormDataReportCopy', $data);

    }
    public function DisplayFormToArchiveScannedSynopticFormFIles($id=NULL){
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
       $data['form_type']="synoptic";
        $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archievefiles', $data);


    }
    public function DisplayFormToArchiveScannedSynopticFormReportForUpdate(){
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




        $scannedsynopticformid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($scannedsynopticformid,'id','scans_daily');  //$value, $field,$table
        if ($query) {
            $data['scannedsynopticformreportcopyidDetails'] = $query;
        } else {
            $data['scannedsynopticformreportcopyidDetails'] = array();
        }

        $record_id= $query[0]->record_id;
        $data['record_id']=$record_id;
        $data['already_uploaded'] = $this->DbHandler->archievescanned_files($record_id);
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveScannedSynopticFormDataReportCopy', $data);
    }
       public   function update_approval() {
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

    public function insertInformationForArchiveScannedSynopticFormReport(){
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

                $formname = firstcharuppercase(chgtolowercase($this->input->post('formname_synoptic')));

                $station = $this->input->post('station_ArchiveScannedSynopticFormReport');
                $stationNo = $this->input->post('stationNo_ArchiveScannedSynopticFormReport');
                $stationId=$this->DbHandler->identifyStationById($station, $stationNo);//station name and station number

            $dateOnScannedSynopticFormReport = $this->input->post('dateOnScannedSynopticFormReport_synoptic');


            $description = $this->input->post('description_synoptic');


           // $creationDate= date('Y-m-d H:i:s');
            $Approved="FALSE";
            $firstname=$session_data['FirstName'];
            $surname=$session_data['SurName'];
            $SubmittedBy=$firstname.' '.$surname;
             $userid=$session_data['Userid'];

            $record_identity=$stationNumber."synoptic_".date("Ymdhisa");
            $insertScannedSynopticFormReportDataCopyDetails=array(
                'Form_scanned' => $formname, 
                'record_id'=>$record_identity,
                'station' => $stationId, 'form_date' => $dateOnScannedSynopticFormReport,'Approved'=> $Approved,'SD_SubmittedBy'=>$SubmittedBy,'submitedBy_Id'=>$userid
                );

                $duplicate=$this->DbHandler->checkforDuplicatearchivescanned("Select * from scans_daily where form_date = '$dateOnScannedSynopticFormReport' and station = '$stationId' and numfiles>0");
                if( $duplicate>0){
                    $this->session->set_flashdata('error', ' Archive Scanned synoptic record of '.$dateOnScannedSynopticFormReport.' for the station '.$station. ' already exists!');
                    redirect("ArchiveScannedSynopticFormDataReportCopy");
                }else{
            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $insertsuccess= $this->DbHandler->insertData($insertScannedSynopticFormReportDataCopyDetails,'scans_daily'); //Array for data to insert then  the Table Name

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
                'Action' => 'Added Archive Scanned Synoptic',
                    'Details' => $name . ' added new Scanned Synoptic Form details into the system ',
                    
                    'IP' => $this->input->ip_address());
                //  save user logs
                 $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'New Scanned synoptic Form details info was added successfully!');
                redirect("ArchiveScannedSynopticFormDataReportCopy/DisplayFormToArchiveScannedSynopticFormFIles/".$record_identity);

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }
         }
    }

    public function insertInformationForArchiveScannedSynopticFormFiles(){
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name = 'archievescannedcopy_observationslipform';   //name of the input text field
        $record = $this->input->post('record');
        $description = $this->input->post('description');

        $single_filename="";
        

              $temp = explode(".", $_FILES[$file_element_name]["name"]);
              $single_filename = 'scannedsynoptic'.date("Y-m-d") . '.' . end($temp);
              move_uploaded_file($_FILES[$file_element_name]["tmp_name"], "archive/" . $single_filename);
    
        $insertScannedObservationfiles=array('file' => $single_filename, 'description' => $description,'record_id' => $record);
         $insertsuccess= $this->DbHandler->insertData($insertScannedObservationfiles,'archivescannnedfiles'); //Array for data to insert then  the Table Name

         $q="Update scans_daily set numfiles=numfiles+1 where record_id='$record'";
         $insertsuccess= $this->DbHandler->updatesubmittedreports($q); 
         header('location:'.$_SERVER['HTTP_REFERER']);
        }


    public function updateInformationForArchiveScannedSynopticFormReport(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        $file_element_name1 = 'updatearchievescannedcopy_synopticformreport_firstpage';

        if (isset($_FILES[$file_element_name1]) && is_uploaded_file($_FILES[$file_element_name1]['tmp_name'])) { //file has been uploaded

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
        $config['file_name'] ='UpdatedSynoptic_form' .'-'.date("Y-m-d").'-'.$_FILES['userfile']['name'];
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_element_name1))
        {
            $status = 'error';
            echo   $msg = $this->upload->display_errors('', '');
        }
        else
        {
            $data = $this->upload->data();
            $filename_firstpage = $data['file_name'];
        }
        } else {    //no file has been uploaded.

            $filename_firstpage= $this->input->post('PreviouslyUploadedFileName_synopticformreport_firstpage');
        }

    ///////////////////////////////////////////////////////////////////////
            $file_element_name2 = 'updatearchievescannedcopy_synopticformreport_secondpage';

        if (isset($_FILES[$file_element_name2]) && is_uploaded_file($_FILES[$file_element_name2]['tmp_name'])) { //file has been uploaded

            $config['upload_path'] = 'archive/';
            // $config['upload_path'] = '/uploads/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['encrypt_name'] = FALSE;
            // $config['max_size'] = '2GB';
            //IMB=1024KB  2MB=2048KB   1GB=1024MB   2GB=2048MB
            //1MB=1024KB  THEN 2048MB=2097152KB
            $config['max_size'] = '2097152';  // Can be set to particular file size , here it is 2 MB(2048 Kb)
            $config['max_height'] = '768';
            $config['max_width'] = '1024';

            $config['remove_spaces'] = TRUE;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload($file_element_name2))
            {
                $status = 'error';
                echo   $msg = $this->upload->display_errors('', '');
            }
            else
            {
                $data = $this->upload->data();
                $filename_secondpage = $data['file_name'];
            }
        } else {    //no file has been uploaded.

                $filename_secondpage = $this->input->post('PreviouslyUploadedFileName_synopticformreport_secondpage');
        }



            $formname = firstcharuppercase(chgtolowercase($this->input->post('formname')));
           
                $stationId = $this->input->post('stationId');
                $stationNo = $this->input->post('stationNo');
                $comment = $this->input->post('comment');
                $dateOnScannedSynopticFormReport = $this->input->post('dateOnScannedSynopticFormReport');


            $description = $this->input->post('description');

            $id = $this->input->post('id');
                $approved=$this->input->post('approval');

//'FileName_SecondPage' => $filename2
            $updateScannedSynopticFormDataReportDetails=array(
                'Approved'=>$approved,'station' => $stationId, 'comment' => $comment, 'form_date' => $dateOnScannedSynopticFormReport,
                'Description'=>$description,'FileName_FirstPage' => $filename_firstpage,'FileName_SecondPage' => $filename_secondpage);

            //$this->DbHandler->insertInstrument($insertInstrumentData);
            $updatesuccess=$this->DbHandler->updateData($updateScannedSynopticFormDataReportDetails,"",'scans_daily',$id);

            //Redirect the user back with  message
            if($updatesuccess){
                //Store User logs.
                //Create user Logs
                $session_data = $this->session->userdata('logged_in');
                $userrole=$session_data['UserRole'];
                $userstation=$session_data['UserStation'];
                $userstationNo=$session_data['StationNumber'];
                $name=$session_data['FirstName'].' '.$session_data['SurName'];

               $userid =$session_data['Userid'];
               $userlogs = array('Userid' => $userid,
                    'Action' => 'Updated Archive Scanned Synoptic',
                    'Details' => $name . 'Updated archive Scanned Synoptic Form details into the system ',
                   
                    'IP' => $this->input->ip_address());
                //  save user logs
                 $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'Updated Scanned Synoptic Form details info was updated successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

      //  }
     //   }

    }
    public function deleteInformationForArchiveScannedSynopticFormReport() {
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
            $name=$session_data['FirstName'].' '.$session_data['SurName'];

            $userlogs = array('User' => $name,
                'UserRole' => $userrole,'Action' => 'Deleted Synoptic details',
                'Details' => $name . ' deleted Synoptic details into the system ',
                'StationName' => $userstation,
                'StationNumber' => $userstationNo ,
                'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Synoptic info was deleted successfully!');
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
    function checkInDBIfArchiveScannedSynopticFormDataReportCopyRecordExistsAlready($date,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveScannedSynopticFormDataReportCopyRecordExistsAlready($date,$stationName,$stationNumber,'scans_daily');   // $value, $field, $table

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
        redirect(base_url('index.php/ArchiveScannedSynopticFormDataReportCopy'));
     }
}

?>
