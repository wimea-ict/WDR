<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArchiveScannedObservationSlipFormDataCopy extends CI_Controller {

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

        $query = $this->DbHandler->selectAllscanDaily($userstation,'StationName','scans_daily',"observationslip",$userid,$id);  //value,field,table

        if ($query) {
            $data['archivedscannedobservationslipformcopydetails'] = $query;
        } else {
            $data['archivedscannedobservationslipformcopydetails'] = array();
        }


        //Load the view.
        $data['uploaded_files'] = $this->DbHandler->archievescanned_files();
        if($id!=NULL){
         $data['observationslipcomments'] = $this->DbHandler->selectRecordComments($id,'scans_daily');
        }
        $this->load->view('archiveScannedObservationSlipFormDataCopy', $data);
    }
     public function submitObservationslipComment(){
        $comment= $this->input->post('comment');
        $recordid = $this->input->post('recordid');
        $session_data = $this->session->userdata('logged_in');
        //$userstation=$session_data['UserStation'];
        $userrole=$session_data['UserRole'];
        $name=$session_data['SurName'].' '.$session_data['FirstName'];
        $form_type="scans_daily";
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
    public function DisplayFormToArchiveScannedObservationSlipFormDetails($id=NULL){
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

        $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveScannedObservationSlipFormDataCopy', $data);

    }
    public function DisplayFormToArchiveScannedObservationSlipFormFiles($id=NULL){
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
       $data['form_type']="observationslip";

        $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archievefiles', $data);

    }

    public function DisplayFormToArchiveScannedObservationSlipFormForUpdate(){
        $this->unsetflashdatainfo();
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




        $scannedobservationslipformid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($scannedobservationslipformid,'id','scans_daily');  //$value, $field,$table
        if ($query) {
            $data['scannedobservationslipformcopyidDetails'] = $query;
        } else {
            $data['scannedobservationslipformcopyidDetails'] = array();
        }
        $record_id= $query[0]->record_id;
        $data['record_id']=$record_id;
        $data['already_uploaded'] = $this->DbHandler->archievescanned_files($record_id);

       // echo $query[0]->record_id;
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('archiveScannedObservationSlipFormDataCopy', $data);
    }


    public function insertInformationForArchiveScannedObservationSlipFormDetails(){
        $this->unsetflashdatainfo();

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        // $file_element_name = 'archievescannedcopy_observationslipform';   //name of the input text field

        // $total = count($_FILES[$file_element_name]['name']);
        // $single_filename="";
    //    for($i=0;$i<$total;$i++){
    //        $file[$i]=$_FILES[$file_element_name]['name'][$i];
    //        if($file[$i]!=NULL){
    //            $imageonearray=explode('.',$file[$i]);
    //            $imgext=explode('.',$file[$i]);
    //            $imgext=end($imgext);
    //           $file[$i]='scannedObservationslip'.date("Y-m-d").$i.'.'.$imgext;
    //           if($i==0){
    //            $single_filename=$single_filename.$file[$i]; 
    //           }else{
    //            $single_filename=$single_filename.','.$file[$i];  
    //           }
    //           move_uploaded_file($_FILES[$file_element_name]['tmp_name'][$i],"archive/$file[$i]");
    //       }
    //    }

       






                $formname = firstcharuppercase(chgtolowercase($this->input->post('formname_observationslipform')));




                    $station = $this->input->post('station_ArchiveScannedObservationSlipForm');
                    $stationNumber = $this->input->post('stationNo_ArchiveScannedObservationSlipForm');
                    $station_id= $this->DbHandler->identifyStationById($station,$stationNumber);
                    $record_identity=$stationNumber."ObservationSlip_".date("Ymdhisa");



                $dateOnScannedObservationSlipForm = $this->input->post('dateOnScannedObservationSlipForm_observationslipform');


               // $description = $this->input->post('description_observationslipform');
                $time=$this->input->post('time_ArchiveScannedObservationSlipForm');


               // $creationDate= date('Y-m-d H:i:s');
                $Approved="FALSE";
                $firstname=$session_data['FirstName'];
                $surname=$session_data['SurName'];
                $SubmittedBy=$firstname.' '.$surname;
                $userid=$session_data['Userid'];
                 $stationId=$this->DbHandler->identifyStationById($station, $stationNumber);//station name and station number

                $insertScannedObservationSlipFormDataCopyDetails=array(
                    'Form_scanned' => $formname, 'station' => $stationId,
                     'TIME'=>$time,
                     'record_id'=>$record_identity,
                    'form_date' => $dateOnScannedObservationSlipForm,'Approved'=> $Approved,'SD_SubmittedBy'=>$SubmittedBy,'submitedBy_Id'=>$userid
                    );

                $duplicate=$this->DbHandler->checkforDuplicatearchivescanned("Select * from scans_daily where form_date = '$dateOnScannedObservationSlipForm' and TIME='$time' and station = '$stationId' and numfiles>0");
                    if( $duplicate>0){
                        $this->session->set_flashdata('error', ' Archive Scanned observation slip record of '.$dateOnScannedObservationSlipForm.' at '.$time.' for the station '.$station. ' already exists!');
                        redirect("ArchiveScannedObservationSlipFormDataCopy");
                    }else{
                //$this->DbHandler->insertInstrument($insertInstrumentData);
                $insertsuccess= $this->DbHandler->insertData($insertScannedObservationSlipFormDataCopyDetails,'scans_daily'); //Array for data to insert then  the Table Name

                //Redirect the user back with  message
                if($insertsuccess){
                   // $insertScannedObservationfiles=array('file' => $single_filename, 'description' => $description,'record_id' => $record_identity);
                    //$insertsuccess2= $this->DbHandler->insertData($insertScannedObservationfiles,'archivescannnedfiles'); //Array for data to insert then  the Table Name
                    //Store User logs.
                    //Create user Logs
                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];
                    $userstation=$session_data['UserStation'];
                    $userstationNo=$session_data['StationNumber'];
                    $name=$session_data['FirstName'].' '.$session_data['SurName'];
                   
                   $userid =$session_data['Userid'];
                    $userlogs = array('Userid' => $userid,
                       'Action' => 'Added Archive Scanned Observation Slip',
                        'Details' => $name . ' added new Scanned Observation Slip Form details into the system ',
                        
                        'IP' => $this->input->ip_address());
                    //  save user logs
                     $this->DbHandler->saveUserLogs($userlogs);


                    $this->session->set_flashdata('success', 'New Scanned Observation Form details info was added successfully!');
                    //$this->index();
                  // $this->DisplayFormToArchiveScannedObservationSlipFormFIles($record_identity);
                   redirect("ArchiveScannedObservationSlipFormDataCopy/DisplayFormToArchiveScannedObservationSlipFormFIles/".$record_identity);

                }
                else{
                    $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                    $this->index();

                }

            }
        }

        public function insertInformationForArchiveScannedObservationSlipFormFiles(){
            $this->unsetflashdatainfo();
    
            $session_data = $this->session->userdata('logged_in');
            $role=$session_data['UserRole'];
    
            $file_element_name = 'archievescannedcopy_observationslipform';   //name of the input text field
            $record = $this->input->post('record');
            $description = $this->input->post('description');
            $file_type = $this->input->post('file_type');
            if(strcmp($file_type,"scannedobservationslip")==0){
              $string_name="scannedObservationslip";
              $table_toupdate="scans_daily";
            }elseif(strcmp($file_type,"metar")==0){
                $string_name="scannedmetar";
                $table_toupdate="scans_daily";
            }elseif(strcmp($file_type,"scannedmonthlyrainfall")==0){
                $string_name="scannedmonthlyrainfall";
                $table_toupdate="scans_monthly";
            }elseif(strcmp($file_type,"scannedweathersummary")==0){
                $string_name="scannedweathersummary";
                $table_toupdate="scans_monthly";
            }elseif(strcmp($file_type,"scanneddekadal")==0){
                $string_name="scanneddekadal";
                $table_toupdate="scans_dekadals";
            }elseif(strcmp($file_type,"scannedyearlyrainfall")==0){
                $string_name="scannedyearlyrainfall";
                $table_toupdate="scans_yearly";
            }elseif(strcmp($file_type,"scannedsynoptic")==0){
                $string_name="scannedsynoptic";
                $table_toupdate="scans_daily";
            }else{
                $string_name="scannedObservationslip";  
                $table_toupdate="scans_daily";
            }
            $single_filename="";
          
            $temp = explode(".", $_FILES[$file_element_name]["name"]);
            $single_filename = $string_name.date("Y-m-d") . '.' . end($temp);
            move_uploaded_file($_FILES[$file_element_name]["tmp_name"], "archive/" . $single_filename);
            $insertScannedObservationfiles=array('file' => $single_filename, 'description' => $description,'record_id' => $record);
             $insertsuccess= $this->DbHandler->insertData($insertScannedObservationfiles,'archivescannnedfiles'); //Array for data to insert then  the Table Name
             $q="Update $table_toupdate set numfiles=numfiles+1 where record_id='$record'";
             $insertsuccess= $this->DbHandler->updatesubmittedreports($q);
                //redirect("ArchiveScannedObservationSlipFormDataCopy/DisplayFormToArchiveScannedObservationSlipFormFIles/".$record);  
                header('location:'.$_SERVER['HTTP_REFERER']);
            }
    

    function removearchievescannedfile(){
                $id = $this->input->post('record_id');
                $record_id = $this->input->post('record_identity');
                $updated = $this->DbHandler->deletearchievescannedfile($id);
                $q="Update scans_daily set numfiles=numfiles-1 where record_id='$record_id'";
                $insertsuccess= $this->DbHandler->updatesubmittedreports($q);
                $q="Update scans_monthly set numfiles=numfiles-1 where record_id='$record_id'";
                $insertsuccess= $this->DbHandler->updatesubmittedreports($q); 
                $q="Update scans_dekadals set numfiles=numfiles-1 where record_id='$record_id'";
                $insertsuccess= $this->DbHandler->updatesubmittedreports($q); 
                $q="Update scans_yearly set numfiles=numfiles-1 where record_id='$record_id'";
                $insertsuccess= $this->DbHandler->updatesubmittedreports($q);
                header('location:'.$_SERVER['HTTP_REFERER']);  
    }
    public function updateInformationForArchiveScannedObservationSlipFormDetails(){
        $this->unsetflashdatainfo();

        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];



                $formname = firstcharuppercase(chgtolowercase($this->input->post('formname')));

                    $stationId = $this->input->post('stationId');
                    $stationNo = $this->input->post('stationNo');
                    $time=$this->input->post('timeRecorded');
                    $comment=$this->input->post('comment');

            $dateOnScannedObservationSlipForm = $this->input->post('dateOnScannedObservationSlipForm');


            $id = $this->input->post('id');

        $approved=$this->input->post('approval');



                $updateScannedObservationFormDataDetails=array(
                    'station' => $stationId,'TIME'=>$time,'comment'=>$comment,'Approved'=>$approved,
                    'form_date' => $dateOnScannedObservationSlipForm);

                //$this->DbHandler->insertInstrument($insertInstrumentData);
                $updatesuccess=$this->DbHandler->updateData($updateScannedObservationFormDataDetails,'','scans_daily',$id);

                //Redirect the user back with  message
                if($updatesuccess){
                    //Store User logs.
                    //Create user Logs
                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];
                    $userstation=$session_data['UserStation'];
                    $userstationId=$session_data['StationId'];
                    $name=$session_data['FirstName'].' '.$session_data['SurName'];

                   $userid =$session_data['Userid'];
                    $userlogs = array('Userid' => $userid,
                        'Action' => 'Updated Archive Scanned Observation Slip',
                        'Details' => $name . ' updated  Scanned Observation Slip Form details into the system ',
                     
                        'IP' => $this->input->ip_address());
                    //  save user logs
                    $this->DbHandler->saveUserLogs($userlogs);


                    $this->session->set_flashdata('success', 'Updated Scanned Observation Slip Form details info was updated successfully!');
                    $this->index();

                }
                else{
                    $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                    $this->index();

                }

            }
      //  }
          public    function update_approval() {
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
    public function deleteInformationForArchiveScannedObservationSlipFormDetails() {
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
                'UserRole' => $userrole,'Action' => 'Deleted Observation Slip Form details',
                'Details' => $name . ' deleted Observation Slip Form details into the system ',
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
    function checkInDBIfArchiveScannedObservationSlipFormDataCopyRecordExistsAlready($date,$time,$stationName,$stationNumber) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
        $date = ($date == "") ? $this->input->post('date') : $date;
        $time = ($time == "") ? $this->input->post('time') : $time;
        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        //check($value,$field,$table)
        if ($this->input->post('stationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfArchiveScannedObservationSlipFormDataCopyRecordExistsAlready($date,$time,$stationName,$stationNumber,'scans_daily');   // $value, $field, $table

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
    redirect(base_url('index.php/ArchiveScannedObservationSlipFormDataCopy'));
 } 

}

?>
