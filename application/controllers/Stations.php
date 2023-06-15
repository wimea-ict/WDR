<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stations extends CI_Controller {

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
    public function index(){
        // $this->unsetflashdatainfo();
        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];
		
        
        //View Station.Load all the previous Stations
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('stations', $data);
    }

    public function Displaystations(){
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];
        $data['regions']= $this->DbHandler->selectStationData("region");
        $data['subregions']= $this->DbHandler->selectStationData("subregion");
        $data['district']= $this->DbHandler->selectStationData("district");
        $data['counties']= $this->DbHandler->selectStationData("county");
        $data['subcounties']= $this->DbHandler->selectStationData("subcounty");
        $data['parish']= $this->DbHandler->selectStationData("parish");
        $data['village']= $this->DbHandler->selectStationData("village");
        $query = $this->DbHandler->selectStationData();  //value,field,table
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $this->load->view('stationreports', $data);
    }

    public function StationPerfomance(){
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];
        $data['regions']= $this->DbHandler->selectStationData("region");
        $data['subregions']= $this->DbHandler->selectStationData("subregion");
        $data['district']= $this->DbHandler->selectStationData("district");
        $data['counties']= $this->DbHandler->selectStationData("county");
        $data['subcounties']= $this->DbHandler->selectStationData("subcounty");
        $data['parish']= $this->DbHandler->selectStationData("parish");
        $data['village']= $this->DbHandler->selectStationData("village");
        
        if($this->input->post('startdate')!=NULL){
           $data['startdate']=$this->input->post('startdate');
        }
        if($this->input->post('enddate')!=NULL){
            $data['enddate']=$this->input->post('enddate');
        }
        $query = $this->DbHandler->StationPerfomance();  //value,field,table
        if ($query) {
            $data['stationsperfomance'] = $query;
        } else {
            $data['stationsperfomance'] = array();
        }

        $this->load->view('stationreports', $data);
    }
	public function stationUsers(){
		  //$this->unsetflashdatainfo();
		 $this->load->helper(array('form', 'url'));

        $stationid  = ($stationid == "") ? $this->input->post('stationid') : $stationid; // URL Segment Three.
		
	
		$query = $this->DbHandler->StationUsers($stationid);  //value,field,table
        //  var_dump($query);
		 //exit($stationid);
		 //exit($stationid."am here");
        if($query){
                echo json_encode($query);
         
            }
            else{

              return false;
	}
	}
       
    
	
    public function DisplayStationsForm(){
        $this->unsetflashdatainfo();
        $name='displaynewstationsform';
        $data['displaynewstationsform'] = array('name' => $name);

        //On Add New Station
        //Load table(stations) with all the station Indicators.
        //ROLE IS MANAGER
        //$session_data = $this->session->userdata('logged_in');
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'StationNumber ','stations');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }

        /////////////////////////////////////////////////////////
         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('stations', $data);

    }

    public function DisplayStationsFormForUpdate(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $data['subregions']=$this->DbHandler->SelectSubregions();
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        ///////////////////////////////////////////////////////////////////////
        //On Add New Station
        //Load table(stations) with all the station Indicators.
        //ROLE IS MANAGER
        //Load table(stations) with all the station Indicators.
        //ROLE IS MANAGER

        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'StationNumber ','stations');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }

        /////////////////////////////////////////////////////////////////////

        $stationid = $this->uri->segment(3);

        $query = $this->DbHandler->selectById($stationid,'station_id','stations');  //$value, $field,$table
        if ($query) {
            $data['stationdataid'] = $query;
        } else {
            $data['stationdataid'] = array();
        }

         $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('stations', $data);
    }
    public function insertStationInformation(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));

        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];

        if($role=="Manager"){


            $stationname = ($this->input->post('namestation'));
            $stationnumber = ($this->input->post('numberstation'));

            $stationregNo = ($this->input->post('registrationnumberstation'));

            $stationlocation = ($this->input->post('locationstation'));

            $indicator = $this->input->post('indicatorstation');
            $country = firstcharuppercase(chgtolowercase($this->input->post('countrystation')));
            $region = firstcharuppercase(chgtolowercase($this->input->post('RegionName')));



            $latitude = $this->input->post('latitudestation');
            $longitude = $this->input->post('longitudestation');
            $altitude=$this->input->post('altitudestation');
            $opened = $this->input->post('openedstation');
            $closed = $this->input->post('closedstation');
            $status=$this->input->post('statusstation');
            $type = $this->input->post('typestation');
            //$creationDate= date('Y-m-d H:i:s');
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
            $SubmittedBy=$name;
		    $height = $this->input->post('height');
            $insertStationData=array(
                'StationName'=> $stationname,'StationNumber'=>$stationnumber,'StationRegNumber'=>$stationregNo,
                'Location'=>$stationlocation,'Country'=>$country,'subregion'=>$subregion,'district'=>$district,'county'=>$county,'subcounty'=>$subcounty,'parish'=>$parish,'village'=>$village,
                'StationRegion'=>$region,'Indicator'=>$indicator,
                'Latitude'=>$latitude,'Longitude'=>$longitude,'Height'=>$height,
                'Altitude'=>$altitude,'Opened'=>$opened,
                'Closed'=>$closed,'StationStatus'=>$status,
                'StationType'=>$type,'SubmittedBy'=>$SubmittedBy);

            //$this->DbHandler->insertStation($insertStationData);
            $insertsuccess= $this->DbHandler->insertData($insertStationData,'stations'); //Array for data to insert then  the Table Name


            //Redirect the user back with  message
            if($insertsuccess){
                //Store User logs.
                //Create user Logs
                $session_data = $this->session->userdata('logged_in');
                $UserRole=$session_data['UserRole'];
                $StationName=$session_data['StationName'];
                $StationNumber=$session_data['StationNumber'];
                //$StationRegion=$session_data['StationRegion'];
                $name=$session_data['FirstName'].' '.$session_data['SurName'];

                $userid =$session_data['Userid'];
                $userlogs = array('Userid' => $userid,
                   'Action' => 'Added New station',
                    'Details' => $name . ' inserted new station'.$stationname.'/'.$StationNumber.'in the system ',
                    
                    'IP' => $this->input->ip_address());
                //  save user logs
                $this->DbHandler->saveUserLogs($userlogs);



                $this->session->set_flashdata('success', 'Station info was added successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
                $this->index();

            }

        }
    }
    public function updateStationInformation(){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $session_data = $this->session->userdata('logged_in');
        $role=$session_data['UserRole'];
        //if($role=="Manager" || $role=="Senior Weather Observer" )
            $stationname = $this->input->post('station_name');
            $stationnumber = $this->input->post('stationNo');

            $stationlocation = $this->input->post('stationlocation');
            $indicator = chgtouppercase($this->input->post('stationindicator'));
            $region = $this->input->post('RegionName');
            $blocknumber = $this->input->post('blocknumber');
            $unitofwindspeed = ($this->input->post('UnitOfWind_Speed'));
            $country = firstcharuppercase(chgtolowercase($this->input->post('stationcountry')));
            $subregion=$this->input->post('subregion');
            $district=$this->input->post('district');
            $county=$this->input->post('county');
            $subcounty=$this->input->post('subcounty');
            $parish=$this->input->post('parish');
            $village=$this->input->post('village');

            $latitude = $this->input->post('stationlatitude');
            $longitude = $this->input->post('stationlongitude');
            $altitude=$this->input->post('stationaltitude');
            $opened = $this->input->post('stationopened');
            $status=$this->input->post('statusstation');
            $closed = $this->input->post('stationclosed');
            $maxtemp=$this->input->post('maxtemp');
            $mintemp = $this->input->post('mintemp');
            $maxrain=$this->input->post('maxrain');
            $minrain = $this->input->post('minrain');
            $maxwindspeed=$this->input->post('maxwindspeed');
            $minwindspeed = $this->input->post('minwindspeed');
            $type = $this->input->post('typestation');

            $id = $this->input->post('id');
             $height = $this->input->post('height');



            $updateStationData=array(
                'StationName'=> $stationname,'StationNumber'=>$stationnumber,
                'Location'=>$stationlocation,'Country'=>$country,'subregion'=>$subregion,'district'=>$district,'county'=>$county,'subcounty'=>$subcounty,'parish'=>$parish,'village'=>$village,
                'StationRegion'=>$region,'Indicator'=>$indicator,'max_expectedwindspeed'=>$maxwindspeed,'min_expectedwindspeed'=>$minwindspeed ,
                'Latitude'=>$latitude,'Longitude'=>$longitude,
                'Altitude'=>$altitude,'Height'=>$height,'Opened'=>$opened,
                'Closed'=>$closed,'StationStatus'=>$status,
                'max_expectedtemp'=>$maxtemp,'min_expectedtemp'=>$mintemp,
                'max_expectedrain'=>$maxrain,'min_expectedrain'=>$minrain,
                'blocknumber'=>$blocknumber,'UnitOfWind_Speed'=>$unitofwindspeed,
                'StationType'=>$type);

            $updatesuccess=$this->DbHandler->updateData($updateStationData,"",'stations',$id);

            //Redirect the user back with  message
            if($updatesuccess){
                //Store User logs.
                //Create user Logs
                $session_data = $this->session->userdata('logged_in');
                $UserRole=$session_data['UserRole'];
                $StationName=$session_data['StationName'];
                $StationNumber=$session_data['StationNumber'];

                $name=$session_data['FirstName'].' '.$session_data['SurName'];

                $userid =$session_data['Userid'];
                $stationId=$this->DbHandler->identifyStationById($stationname, $stationnumber);
                $userlogs = array('Userid' => $userid,
                    'Action' => 'Updated station details','station_id'=>$stationId,
                    'Details' => $name . ' updated station '.$stationname.'/'.$stationnumber.' in the system ',
                   
                    'IP' => $this->input->ip_address());
                //  save user logs
                $this->DbHandler->saveUserLogs($userlogs);


                $this->session->set_flashdata('success', 'Station info was updated successfully!');
                $this->index();

            }
            else{
                $this->session->set_flashdata('error', 'Sorry, we encountered an issue!');
                $this->index();

            }

    }
    public function deleteStation() {
        $this->unsetflashdatainfo();

        $id = $this->uri->segment(3); // URL Segment Three.

        $rowsaffected = $this->DbHandler->deleteData('stations',$id);  //$rowsaffected > 0

        if ($rowsaffected) {

            //Store User logs.
            //Create user Logs
            $session_data = $this->session->userdata('logged_in');
            $UserRole=$session_data['UserRole'];
            $StationName=$session_data['StationName'];
            $StationNumber=$session_data['StationNumber'];
            $StationRegion=$session_data['StationRegion'];
            $name=$session_data['FirstName'].' '.$session_data['SurName'];
            $userid =$session_data['Userid'];
            $userlogs = array('Date'=>date('Y-m-d H:i:s'),'Userid' => $userid,
                'Action' => 'Deleted station details',
                'Details' => $name . ' deleted station details in the system ',
                'StationName' => $StationName,
                'StationNumber' => $StationNumber,
                'StationRegion' => $StationRegion,
                'IP' => $this->input->ip_address());
            //  save user logs
            $this->DbHandler->saveUserLogs($userlogs);

            $this->session->set_flashdata('success', 'Stations info was deleted successfully!');
            $this->index();

            //redirect('/element', 'refresh');
        }
        else {

            $this->session->set_flashdata('error', '"Sorry, we encountered an issue! ');
            $this->index();

        }

    }

    function getZonalRegion($zonalnumber){
        $this->load->helper(array('form', 'url'));
        $zonalnumber = ($zonalnumber == "") ? $this->input->post('zonalnumber') : $zonalnumber;
        if ($zonalnumber  == "") {
            echo '<span style="color:#f00">sorry we encountered an issue. </span>';
        } else {

            $get_result = $this->DbHandler->getResults($zonalnumber, 'Userid', 'systemusers');   // $value, $field, $table

            echo json_encode($get_result);


        }
    }


    function getStationNumber($stationName) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
//check($value,$field,$table)
        if ($stationName  == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        } else {

            $get_result = $this->DbHandler->getResults($stationName, 'StationName', 'stations');   // $value, $field, $table

            echo json_encode($get_result);


        }
    }

     function getStationNumber2($stationName) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;
//check($value,$field,$table)
        if ($stationName  == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        } else {

            $get_result = $this->DbHandler->getResults2($stationName, 'StationName', 'stations');   // $value, $field, $table

            echo json_encode($get_result);


        }
    }

    function getStationDetails($StationName) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));
        //stationLocation
        $StationName = ($StationName == "") ? $this->input->post('StationName') : $StationName;
//check($value,$field,$table)
        if ($this->input->post('StationName') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        } else {


            $get_result = $this->DbHandler->getResults($StationName, 'StationNumber ', 'stations');   // $value, $field, $table

            if( $get_result){
                echo json_encode($get_result);

            }
            else{

                echo json_encode($get_result);
            }

        }
    }
    ///Check DB against the DATE,STATIONName,StationNumber,TIME,METAR/SPECI OPTION
    function checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber,$stationLocation,$stationIndicator) {  //Pass the StationName to get the Station Number.
        $this->load->helper(array('form', 'url'));

        $stationName = ($stationName == "") ? $this->input->post('stationName') : $stationName;

        $stationNumber = ($stationNumber == "") ? $this->input->post('stationNumber') : $stationNumber;

        $stationLocation = ($stationLocation == "") ? $this->input->post('stationLocation') : $stationLocation;

        $stationIndicator = ($stationIndicator == "") ? $this->input->post('stationIndicator') : $stationIndicator;

        if ($this->input->post('stationName') == "") {
            //echo '<span style="color:#f00">Please Input Name. </span>';
        }
        else {


            $get_result = $this->DbHandler->checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber,$stationLocation,$stationIndicator,'stations');   // $value, $table

            if( $get_result){
                echo json_encode($get_result);

            }
            else{

                echo json_encode($get_result);
            }
        }


    }
    public function check($user) {
        $this->load->helper(array('form', 'url'));

        $station = $this->input->post('name');

        $user = ($user == "") ? $this->input->post('name') : $user;
//check($value,$field,$table)
        if ($this->input->post('name') == "") {
            echo '<span style="color:#f00">Please Input Name. </span>';
        }else {
//check($value,$field,$table)
            $get_result = $this->DbHandler->check($station, 'StationName', 'systemusers');   //$value, $field, $table

            if (!$get_result)
                echo '<span style="color:#f00">email already in use. </span>';
            else
                echo '<span style="color:#0c0">email not in use</span>';
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
