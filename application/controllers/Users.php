<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI
class Users extends CI_Controller {

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

  public function control_mail(){
    
        $data['updated'] = $this->DbHandler->control_mail();
        redirect(base_url('index.php/Users'));
        }
    
 public function index(){
        //$this->unsetflashdatainfo();
  $this->session->sess_expire_on_close = TRUE;
  $session_data = $this->session->userdata('logged_in');
  $userrole=$session_data['UserRole'];
  $userstation=$session_data['StationId'];



        $query = $this->DbHandler->selectAllSystemUsers($userstation,'station','systemusers',$userrole);  //value,field,table
        //  var_dump($query);
        if ($query) {
          $data['allusers'] = $query;
        } else {
          $data['allusers'] = array();
        }

        //All Stations
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');
        //  var_dump($query);
        if ($query) {
          $data['stationsdata'] = $query;
        } else {
          $data['stationsdata'] = array();
        }

        $this->load->view('users', $data);
      }

      public function DisplayStationUsersForm(){
        $this->unsetflashdatainfo();
        $name='displaynewstationuserform';
        $data['displaynewstationuserform'] = array('name' => $name);

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $data['userRegion'] = $this->DbHandler->getRegionName($userstation);

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');
        $data['regions']=$this->DbHandler->selectStations();
        //  var_dump($query);
        if ($query) {
          $data['stationsdata'] = $query;
         // $data['regions'] = $regions;
        } else {
          $data['stationsdata'] = array();
        }
        $StationRegion=$session_data['UsersRegion'];
        $UserSubRegion=$session_data['UserSubRegion'];
        $data['userregions']=explode(",",$StationRegion);
        $data['usersubregions']=explode(",",$UserSubRegion);
  
         $this->load->view('users', $data);

      }
      public function DisplayStationUsersFormForUpdate(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];
        $data['userRegion'] = $this->DbHandler->getRegionName($userstation);
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations'); 
        //$data['regions'] = $this->DbHandler->RegionsModel();
         $data['regions']=$this->DbHandler->selectStations();
        if ($query) {
          $data['stationsdata'] = $query;
        } else {
          $data['stationsdata'] = array();
        }

      
        $userid = $this->uri->segment(3);
        $query = $this->DbHandler->selectUserById($userid,'Userid','systemusers');  //$value, $field,$table
        if ($query) {
          $data['stationuserdataid'] = $query;
        } else {
          $data['stationuserdataid'] = array();
        }

         $StationRegion=$session_data['UserRegion'];
        $UserSubRegion=$session_data['UserRegion'];
        $data['userregions']=explode(",",$StationRegion);
        $data['usersubregions']=explode(",",$UserSubRegion);
        $this->load->view('users', $data);
      }

 public function insertUser(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');

        $UserRole=$session_data['UserRole'];
        $Userid=$session_data['Userid'];
        $firstname =firstcharuppercase(chgtolowercase($this->input->post('user_firstname')));
        $surname = firstcharuppercase(chgtolowercase($this->input->post('user_surname')));
        $useremail = chgtolowercase($this->input->post('user_email'));
        $userphone = $this->input->post('user_phone');
        $userRoleAssigned = $this->input->post('role');
        if(isset($_POST['RegionNames'])){
        $region='';
        foreach ($_POST['RegionNames'] as $row)
        { 
          if($region==''){
            $region=$region.$row;
          }else{
            $region=$region.','.$row;
          }
          
        }
      }else{
        $region = $this->input->post('RegionName');
      }




        $station_num = $this->input->post('stationNo');
        $station_name = $this->DbHandler->getStationName($station_num);



         $tied_users = array('Observer','Senior Weather Observer','WeatherForecaster');

         $nontied_users = array('DataOfficer','SeniorDataOfficer','ManagerStationNetworks','WeatherAnalyst','ManagerData','QC','Communications');

         $tiedToRegion = array('ZonalOfficer','SeniorZonalOfficer');

         if(in_array($userRoleAssigned, $tied_users)){
            if(empty($region) || empty($station_name) || empty($station_num)){
              $dataErr = array();
              $error = "Please endevor to select region and station when registering users who are tied to a station";
              $dataErr = array('missingErr' => $error);

              $this->session->set_flashdata($dataErr);
              redirect('/user-registration-form');
              exit();
            }
            else{
            $stationRegion = $region;
            $station = $station_name;
            $stationNo = $station_num;
            $stationId= $this->DbHandler->identifyStationById($station,$stationNo);
            }

         }

         else if(in_array($userRoleAssigned, $nontied_users)){
            $stationRegion = "";
            $station = "";
            $stationNo = "";
            $stationId = 0; //0 indicates that user is not tied to any station
         }

         else if(in_array($userRoleAssigned, $tiedToRegion)){
            $stationRegion = $region;
            $station = "";
            $stationNo = "";
            $stationId = 0; //0 indicates that user is not tied to any station
         }





       $createdBy=$UserRole;
       $active = 0;
       $reset=1;


        //Before you insert check for Duplicate User.
        //Send User Credentials to the Email Address
      $result=$this->DbHandler->checkforDuplicateUserDetails($firstname,$surname,$useremail,$station,$stationNo,$stationRegion,$userRoleAssigned);


        //print_r($result); exit('hey...');
      if(!$result){
       $username=explode(' ',$surname);
        $username=end($username);
       $generatedusername = firstcharlowercase(firstletter($firstname)).'.'.firstcharlowercase($username);
            //Check if username to be generated Exists in the DB Already
            //$usernameExists=$this->DbHandler->checkIfUserNameExistsAlreadyInDB($username);
       $counter =-1;
       $username = $this->DbHandler->generateUniqueUsername($generatedusername,$surname,$counter);


       if($username != false){

        $randompassword = $this->generatePasswdString();

        if($randompassword){
          $encryptpassword=md5($randompassword);

          $this->load->helper("myphpstringfunctions_helper");


                      //Send the User Credentials.
          $htmlmessage = 'Hello '.''.$firstname.' '.$surname.'<br></br><br></br>'.
          'You have been assigned as '.$userRoleAssigned.'<br></br><br></br>'.
          'Your  New WIMEA-ICT Web Interface  Credentials are'.'<br></br><br></br>'.
          'UserName:'.''.'<b><em>'.$username.'</b></em><br></br><br></br>'.
          'Password:'.''.'<b><em>'.$randompassword.'</b></em><br></br><br></br>'.
          '<a href="http://wimea.mak.ac.ug/wdr/">Click here to login!</a>'.
          'Thank You'.'<br></br><b></br><b></br>'.'WIMEA-ICT';

                      //If true an Email has been sent Else
          $results=$this->sendMail($htmlmessage,$useremail);
            $res=1;
          if($results){ 

            $session_data = $this->session->userdata('logged_in');
            $uid=$session_data['Userid'];
            $dataid= strtoupper(date("ymdhisa").$stationId.$row->Userid.$uid);
            $insertUserData=array(
              'FirstName' => $firstname, 'SurName' => $surname,
              'UserPassword' => $encryptpassword,'UserName' => $username,
              'UserEmail' => $useremail, 'UserPhone' => $userphone,
              'UserRole' => $userRoleAssigned, 'station' => $stationId,
              "region_zone" => $stationRegion,
              'LastPasswdChange'=> date('Y-m-d H:i:s'),
              'LastLoggedIn'=>date('Y-m-d H:i:s'),
              'Active'=>$active,
              'note_id'=>$dataid,
              'Reset'=>$reset,'CreatedBy'=>$createdBy,'createby_ByID'=>$Userid);
            $insertsuccess= $this->DbHandler->insertData($insertUserData,'systemusers');

            if($insertsuccess){
              $issue_note="New user created pending verification";
              $insert_speci=array(
                  'note_id'=>$dataid,
                  'station_id'=>$stationId,
                  'note_type'=>'new_user',
                  'issue'=> $issue_note,
                  'viewedby_datamanager	'=>'False',
                  'station_id'=>1,
                  'viewedby_oc'=>'True',
                  'viewedby_zoneofficer'=>'True',
                );
                $insertspecinotificat=$this->DbHandler->insertData($insert_speci,'speci_notification');
                $managers = $this->DbHandler->getmanager();
                if($managers->num_rows()>0){
                  $recievers=array();
                  $manger_notification = 'Hello<br></br><br></br>
                  This is to inform your that a new user has been created
                  and is pending activation.<br><br>
                  <a href="http://wimea.mak.ac.ug/wdr/">Click here to login!</a>
                  Thank You <br></br><b></br><b></br>WIMEA-ICT';
                  foreach($managers->result() as $row){
                 array_push($recievers,$row->UserEmail);
                }
                $managernotified=$this->sendMail($manger_notification,$recievers);
              } 

              $session_data = $this->session->userdata('logged_in');
              $userrole=$session_data['UserRole'];
              $userstationId=$session_data['StationId'];
              $id=$session_data['Userid'];
              $name=$session_data['FirstName'].' '.$session_data['SurName'];

              $data_id = $this->DbHandler->getdataid($insertUserData,'systemusers','Userid');
              $userlogoutlogs = array('Userid' => $id,'Action' => 'Added User Details','data_id'=>$data_id,
                'Details' => $name . ' Inserted '.$userRoleAssigned.' '.$firstname.' '.$surname. ' in the system ',
                'IP' => $this->input->ip_address());
                        //  save user logs
              $this->DbHandler->saveUserLogs($userlogoutlogs);

              $this->session->set_flashdata('success', 'New User info was added successfully and User Password has been sent to their email!');
              $this->index();

                  }//end of if failed to insert
                  //Failed to insert the user
                  else{
                    $this->session->set_flashdata('error', '"Sorry, we encountered an issue User has not been inserted! ');
                    $this->index();
                  }
                }
                        else{ //User Email has not been sent
                          $this->session->set_flashdata('error', ' Email not sent and user has not been inserted');
                          $this->index();

                        }

        }//end of if random password
        else{
          $this->session->set_flashdata('error','Failed to generate random password');
          $this->index();

        } //end of else
               }//end of if username exists already


               else{
                 $retd = 'Account Names'.' '. $firstname .' '. $surname.''.' already has a username in the System';
                 $this->session->set_flashdata('error', $retd);
                 $this->index();
               }
        }  //Duplicate Results in the DB already
        //When user to be inserted has the same info in the db
        else{


          $ret = 'Account with email '.' '. $useremail.' and user role '.chgtouppercase($userRoleAssigned).''.' is already in the System';
          $this->session->set_flashdata('error', $ret);
          $this->index();

        }



      }

      public function SelectManagerStations(){

        $this->load->helper(array('form', 'url'));

        $region = ($stationName == "") ? $this->input->post('region') : $region;
        $result = $this->DbHandler->SelectZonalStations($region);   // $value, $field, $table
        echo json_encode($result);
      }

      public function generatePasswdString(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('string'));

        return random_string('alnum', 8);
      }



      public function  sendMail($htmlmsgbody,$msgreceiver)
      {
        $this->unsetflashdatainfo();
        $this->load->library('email');

       // $config['protocol'] = 'smtp';
       // $config['smtp_host'] = 'ssl://smtp.gmail.com';
       // $config['smtp_port'] = '25';
       // $config['smtp_user'] = 'wimeaictwdr@gmail.com';  //change it
       // $config['smtp_pass'] = '1c7wimearepo.'; //change it
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $this->email->from('wimeaictwdr@gmail.com');   //change it
        $this->email->to($msgreceiver);       //change it
        $this->email->subject("WIMEA-ICT Web Interface Credentials");
        $this->email->message($htmlmsgbody);

        if($this->email->send()) {
          return true;
        } else {
            return false;
          }
        // if ($this->email->send()) {
        //return  'success';
        //    $data['success'] = 1;
        // return true;
        // } else {
        //   $data['success'] = 0;
        //   $data['error']= $this->email->print_debugger(array('headers'));
        //return false;
        //}
        //   echo "<pre>";
        //   print_r($data);
        //  echo "</pre>";

        }

        public function updateUser(){
         $this->unsetflashdatainfo();

         $this->load->helper(array('form', 'url'));
          
          $session_data = $this->session->userdata('logged_in');
          $UserRole=$session_data['UserRole'];
          $Userideditor=$session_data['Userid'];
          $firstname = strtolower($this->input->post('firstname'));
          $surname = strtolower($this->input->post('surname'));
          $useremail = chgtolowercase($this->input->post('email'));
          $fname=substr($firstname,0,1);

          $username = "".$fname.".".$surname."";
          $userid = intval($this->input->post('Userid'));
          
          $userphone = $this->input->post('contact');
         
          $user_role = preg_replace('/\s+/', '', $this->input->post('role'));
          $region = $this->input->post('RegionName');
          $active = $this->input->post('active');
          $resett = $this->input->post('reset');
          $reset = hex2bin(preg_replace('/\s+/', '', $resett));
          $status = hex2bin(preg_replace('/\s+/', '', $active));
          $pin = $this->input->post('pin');

           $userRoleAssigned = $this->input->post('role');
        if(isset($_POST['RegionNames'])){
        $region='';
        foreach ($_POST['RegionNames'] as $row)
        { 
          if($region==''){
            $region=$region.$row;
          }else{
            $region=$region.','.$row;
          }
          
        }
      }else{
        $region = $this->input->post('RegionName');
      }
          
          $LastPasswdChange = $this->input->post('LastPasswdChange');
          $LastLoggedIn = $this->input->post('LastLoggedIn');
          $CreatedBy = $this->input->post('CreatedBy');
          
        
        $station_num = $this->input->post('stationNo');
        $station_name = $this->DbHandler->getStationName($station_num);
        
           
         $tied_users = array('Observer','Senior Weather Observer','WeatherForecaster');

         $nontied_users = array('DataOfficer','SeniorDataOfficer','ManagerStationNetworks','WeatherAnalyst','ManagerData','QC','Communications');

         $tiedToRegion = array('ZonalOfficer','SeniorZonalOfficer');

         if(in_array($userRoleAssigned, $tied_users)){
            if(empty($region) || empty($station_name) || empty($station_num)){
              $dataErr = array();
              $error = "Please endevor to select region and station when registering users who are tied to a station";
              $dataErr = array('missingErr' => $error);

              $this->session->set_flashdata($dataErr);
              redirect('/user-registration-form');
              exit();
            }
            else{
            $stationRegion = $region;
            $station = $station_name;
            $stationNo = $station_num;
            $stationId= $this->DbHandler->identifyStationById($station,$stationNo);
            }

         }

         else if(in_array($userRoleAssigned, $nontied_users)){
            $stationRegion = "";
            $station = "";
            $stationNo = "";
            $stationId = 0; //0 indicates that user is not tied to any station
         }

         else if(in_array($userRoleAssigned, $tiedToRegion)){
            $stationRegion = $region;
            $station = "";
            $stationNo = "";
            $stationId = 0; //0 indicates that user is not tied to any station
         }


         
           

       $data = array('Userid'=>$userid,'station' => $stationId,
          'region_zone' => $stationRegion,
          'FirstName' => ''.$firstname.'', 'SurName' => ''.$surname.'',
          'UserName' => ''.$username.'','UserRole' => ''.$userRoleAssigned.'', 
          'UserEmail' => ''.$useremail.'', 'UserPhone' => ''.$userphone.'',
          'UserPassword' =>$pin,'Active'=>$status, 'Reset'=>$reset,
          'LastPasswdChange'=>$LastPasswdChange,'LastLoggedIn'=>$LastLoggedIn,
          'CreatedBy'=>$CreatedBy,'createby_ByID'=>$Userideditor
          );  
            $updatesuccess=$this->DbHandler->updateUserDetails($userid, $data);

        //Redirect the user back with  message
        if($updatesuccess){

          $this->session->set_flashdata('success', 'User Information has been updated successfully!');
          $this->index();

        }
        else{
          echo "errors just";
         $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
         $this->index();

        }


         }



      public function deleteUser() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.
        //$id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteUser('systemusers',$id);  //$rowsaffected > 0  //$tablename,id of the row

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
            'UserRole' => $userrole,'Action' => 'Deleted user details',
            'Details' => $name . ' deleted user details in the system ',
            'station' => $userstationId ,
            'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

          $this->session->set_flashdata('success', 'User info was deactivated successfully!');
          $this->index();

            //redirect('/element', 'refresh');
        }
        else {

          $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
          $this->index();

        }

      }

      function getPopuplogs(){
        $date = rawurldecode($this->uri->segment(4));
        $userid = rawurldecode($this->uri->segment(3));
        $result=$this->DbHandler->getPopuplogs($date,$userid);

        if($result){
          $data = array(
            'result' => $result
          );
        }else{
          $data = array(
            'result' => 'none'
          );
        }

        echo json_encode($data);
      }

      public function activateUser() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.
        //$id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->activateUser('systemusers',$id);  //$rowsaffected > 0  //$tablename,id of the row

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
            'UserRole' => $userrole,'Action' => 'Updated User Details',
            'Details' => $name . ' Activated user details in the system ',
            'station' => $userstationId ,
            'IP' => $this->input->ip_address());
            //  save user logs
            // $this->DbHandler->saveUserLogs($userlogs);

          $this->session->set_flashdata('success', 'User info was activated successfully!');
          $this->index();

            //redirect('/element', 'refresh');
        }
        else {

          $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
          $this->index();

        }

      }

      public function GetUserLogs(){
        $region=$this->input->post('region');
        $station=$this->input->post('station');
        $action=$this->input->post('action');
        $typeofform=$this->input->post('typeofform');
        $startdate=$this->input->post('startdate');
        $enddate=$this->input->post('enddate');
        $data['datedisplay1'] = $startdate;
        $data['datedisplay2'] = $enddate;
      
        $result=$this->DbHandler->GetUserLogs($station,$action,$typeofform,$startdate,$enddate);
        if ($result) {

          $data['userlogsdata'] = $result;

        } else {
          $data['userlogsdata'] = array();
        }
        $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('userlogs', $data);
       // print_r($result);
        //exit($startdate.' - '.$enddate);
      }

      public function userlogs() {
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];
        $userregion=$session_data['ZonalRegion'];
        //exit('hey...'.$userregion);


        $query1 = $this->DbHandler->SelectZonalStations($userregion);
        //  var_dump($query);
        if ($query1) {
          $data['zonalstations'] = $query1;
        } else {
          $data['zonalstations'] = array();
        }
        $data['regions']=$this->DbHandler->selectStations(); 
        $this->load->view('userlogs', $data);

      }

      public function deleteUserLogs() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $query = $this->DbHandler->deleteUserLogs($id);

        if ($this->db->affected_rows() > 0) {
          $StationElementlogs = array('user' => $this->session->userdata('username'),
            'userid' => $this->session->userdata('id'), 'action' => 'Deleted User Logs info',
            'details' => $this->session->userdata('username') . ' Deleted User Logs info into the system ',
            'ip' => $this->input->ip_address());
            //  save user logs
          $this->DbHandler->saveUserLogs($StationElementlogs);

          redirect('/element', 'refresh');
        } else {

          redirect('/element', 'refresh');
        }

      }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfUserDetailsRecordExistsAlready($firstname,$surname,$email,$stationName,$stationNumber,$stationRegion,$userRole) {  //Pass the StationName to get the Station Number.
      $this->load->helper(array('form', 'url'));

      $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
      $firstname = ($firstname == "") ? $this->input->post('firstname') : $firstname;
      $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
      $stationRegion = ($stationRegion == "") ? $this->input->post('stationRegion') : $stationRegion;
      $userRole = ($userRole == "") ? $this->input->post('userRole') : $userRole;
      $surname = ($surname == "") ? $this->input->post('surname') : $surname;
        //$phone = ($phone == "") ? $this->input->post('phone') : $phone;
      $email = ($email == "") ? $this->input->post('email') : $email;
        //check($value,$field,$table)
      if ($this->input->post('stationName') == "") {
        echo '<span style="color:#f00">Please Input Name. </span>';
      }
      else {
        $stationId= $this->DbHandler->identifyStationById($stationName, $stationNumber);
            $get_result = $this->DbHandler->checkInDBIfUserDetailsRecordExistsAlready($firstname,$surname,$email,$stationId,$userRole,'systemusers');   // $value, $field, $table

            if( $get_result){
              echo json_encode($get_result);

            }
            else{

              echo json_encode($get_result);
            }
          }


        }

    function checkInDBIfUserDetailsRecordExistsAlreadyWithSameStationRegion($firstname,$surname,$email,$stationRegion) {  //Pass the StationName to get the Station Number.
      $this->load->helper(array('form', 'url'));

      $stationRegion = ($stationRegion == "") ? $this->input->post('stationRegion') : $stationRegion;
      $firstname = ($firstname == "") ? $this->input->post('firstname') : $firstname;
       // $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;
      $surname = ($surname == "") ? $this->input->post('surname') : $surname;
        //$phone = ($phone == "") ? $this->input->post('phone') : $phone;
      $email = ($email == "") ? $this->input->post('email') : $email;
        //check($value,$field,$table)
      if ($this->input->post('stationRegion') == "") {
        echo '<span style="color:#f00">Please Input Name. </span>';
      }
      else {


            $get_result = $this->DbHandler->checkInDBIfUserDetailsRecordExistsAlreadyWithSameStationRegion($firstname,$surname,$email,$stationRegion,'systemusers');   // $value, $field, $table

            if( $get_result){
              echo json_encode($get_result);

            }
            else{

              echo json_encode($get_result);
            }
          }


        }
        public function checkifemailexistsInDB() {
          $this->load->helper(array('form', 'url'));

          $email = $this->input->post('useremail');
          if ($email == "") {
            echo '<span style="color:#f00">Please Input E-mail Address. </span>';
          } else {
                    //check($value,$field,$table)
            $get_result = $this->DbHandler->check($email, 'UserEmail', 'systemusers');    // $value, $field, $table

            if ($get_result)
              echo '<span style="color:#f00">Email already in use. </span>';
            else
              echo '<span style="color:#0c0">Email not in use</span>';
          }
        }

        public function base64url_encode($data) {
          return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
        }
        public function base64url_decode($data) {
          return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
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
