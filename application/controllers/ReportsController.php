<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportsController extends CI_Controller {

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

///////////////////////////////////////////
//Dekadal Report methods
public function initializeheightoflowestcloud1(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('heightoflowestcloud1',$data);

}
public function displayheightoflowestcloud1(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectheightoflowestcloud1($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('heightoflowestcloud1',$data);

}

////////////////////////////////////////
///////////////////////////////////////////
//Dekadal Report methods
public function initializeheightofmediumcloud1(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('heightofmediumcloud1',$data);

}
public function displayheightofmediumcloud1(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectheightofmediumcloud1($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('heightofmediumcloud1',$data);

}

////////////////////////////////////////

///////////////////////////////////////////
//Dekadal Report methods
public function initializeheightofhighcloud1(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('heightofhighcloud1',$data);

}
public function displayheightofhighcloud1(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectheightofhighcloud1($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('heightofhighcloud1',$data);

}

////////////////////////////////////////


///////////////////////////////////////////
//Dekadal Report methods
public function initializevisibility(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('visibility',$data);

}
public function displayvisibility(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectvisibility($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('visibility',$data);

}


///////////////////////////////////////
///////////////////////////////////////////
//Dekadal Report methods
public function initializemaxread(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('Maxread',$data);

}
public function displaymaxread(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectmaxread($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('Maxread',$data);

}


///////////////////////////////////////

///////////////////////////////////////////
//Dekadal Report methods
public function initializeminread(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('Minread',$data);

}
public function displayminread(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectminread($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('Minread',$data);

}


///////////////////////////////////////


///////////////////////////////////////////
//Dekadal Report methods
public function initializerainfall(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('rainfall',$data);

}
public function displayrainfall(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectrainfall($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('rainfall',$data);

}

////////////////////////////////////////




///////////////////////////////////////////
//Dekadal Report methods
public function initializedrybulb(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('Drybulb',$data);

}
public function displaydrybulb(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectdrybulb($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('Drybulb',$data);

}

////////////////////////////////////////



///////////////////////////////////////////
//Dekadal Report methods
public function initializewetbulb(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }


    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('Wetbulb',$data);

}
public function displaywetbulb(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));



    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'year'=>$year
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectwetbulb($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
    if ($sqlquery1) {
        $data['view'] = json_encode(array_column($sqlquery1,'height'),JSON_NUMERIC_CHECK);
    } 

   

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('Wetbulb',$data);

}

////////////////////////////////////////

////////////////////////////////////////
    public function initializeRainfallYearlyReport(){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];


        //Get all Stations.
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        // $data['regions']=$this->DbHandler->selectStations();
        $data['regions'] = $this->DbHandler->RegionsModel();
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

       
        //View the dekadal form.
        $data['allstations']=$this->DbHandler->Allstations();
        $data['subregions']=$this->DbHandler->SelectSubregions();
        $this->load->view('yearlyRainfallReport',$data);

    }
	public function initializeRainfallCustomReport(){
      
        $session_data = $this->session->userdata('logged_in');
        // $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        $data['regions'] = $this->DbHandler->RegionsModel();
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $data['allstations']=$this->DbHandler->Allstations();
        $data['subregions']=$this->DbHandler->SelectSubregions();
        $this->load->view('CustomRainfallReport',$data);

    }


    public function initializeTemperatureCustomReport(){
       
         $session_data = $this->session->userdata('logged_in');
        // $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        $data['regions'] = $this->DbHandler->RegionsModel();
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }
        $data['allstations']=$this->DbHandler->Allstations();
        $data['subregions']=$this->DbHandler->SelectSubregions();
        $this->load->view('CustomTemperatureReport',$data);

}

    public function Regions(){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Regions.
          //value,field,table
        $query = $this->DbHandler->RegionsModel();
        $this->load->view('CustomTemperatureReport',$regions_data);

    }

    public function getStationsforRegion($region){

               // $region = $this->input->post('region');
               // $this->load->view('CustomTemperatureReport');
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Stations.
        $query = $this->DbHandler->getStationsHandler($region);
        if ($query) {
            return $query['StationName'];
        } 

    }   

    public function ajaxRegionRequest(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userregion= $session_data['UserRegion'];
        $usersubregion= $session_data['UserSubRegion'];
        
        $region = $this->input->post('region');
        $this->db->select("*");
        $this->db->from("stations");
        $this->db->where("StationRegion", $region);
        if(($userrole== "ZonalOfficer")&&($usersubregion!=NULL)){
        $this->db->where("subregion", "$usersubregion");
        $this->db->where("StationRegion", "$userregion");
        }
        if(($userrole== "ZonalOfficer")&&($usersubregion==NULL)){
         $this->db->where("StationRegion", "$userregion");
        }
        $query = $this->db->get();
        $stations = $query->result_array();
         echo json_encode($stations);
        
       } 
   
       public function ajaxSubRegionRequest(){
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userregion= $session_data['UserRegion'];
            $usersubregion= $session_data['UserSubRegion'];

           $region = $this->input->post('region');
           $this->db->select("*");
           $this->db->from("subregions as subregion");
           $this->db->join("regions as region",'subregion.region=region.id');
           if(($userrole== "ZonalOfficer")){
            $this->db->where("region.region", "$userregion");
            }else{
                $this->db->where("region.region", $region);
            }
            
           $query = $this->db->get();
           $stations = $query->result_array();
            echo json_encode($stations);
          }
          
       public function ajaxStationRequest(){
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $userregion= $session_data['UserRegion'];
            $usersubregion= $session_data['UserSubRegion'];

           $region = $this->input->post('region');
           $subregion = $this->input->post('subregion');
           $this->db->select("*");
           $this->db->from("stations");
            // if(($userrole== "ZonalOfficer")||($userrole== "SeniorZonalOfficer")){
            //  $this->db->where("StationRegion", "$userregion");
            // }else{
            // $this->db->where("StationRegion", $region);
            // }
            // if(($userrole== "ZonalOfficer")&&($usersubregion!=NULL)){
            //     $this->db->where("subregion", "$usersubregion");
            // }
           if($region!=NULL){
            $this->db->where("StationRegion", "$region"); 
           }
           $this->db->where("subregion", $subregion);
           
           $query = $this->db->get();
           $stations = $query->result_array();
            echo json_encode($stations);
       }

//  public function ajaxStationRequest(){

//     $stationnumber = $this->input->post('stationnumber');

//     $this->db->select("");
//     $this->db->from("stations");
//     $this->db->where("StationNumber", $stationnumber);
//     $query = $this->db->get();
//     $station = $query->result_array();
//      echo json_encode($station);
//  } 

  public function ajaxStationIdRequest(){

     $station = $this->input->post('station');
 
     $this->db->select("stationNumber,station_id,max_expectedwindspeed,min_expectedwindspeed,max_expectedrain,min_expectedrain,max_expectedtemp,min_expectedtemp,UnitOfWind_Speed");
     $this->db->from("stations");
     $this->db->where("StationName", $station);
     //$station_id = $this->db->get()->row()->stationNumber;
     $query = $this->db->get();
     $station_id = $query->result_array();
     echo json_encode($station_id);

 } 
    public function displayyearlyrainfallreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
         $region = $this->input->post('RegionName');

        //$month = $this->input->post('month');

        if($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole == 'WeatherAnalyst' ){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');
             $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

        }elseif($userrole=='Senior Weather Observer' || $userrole=="WeatherForecaster" ){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');
             $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

        }
        $station_id= $this->DbHandler->identifyStationById($stationName,$stationNumber);
        $session_data = $this->session->userdata('logged_in');
        $user=$session_data['Userid'];
         
        if($this->input->post('forward')!=NULL){
            $record_id=$this->input->post('record_id');
            $reportexists=$this->DbHandler->updatesubmittedreports(
                "update submitted_reports set forwardtomanager='True',forwardedby='$user' where id='$record_id'");
            $data['exists']=1;
        }
        
        $reportexists=$this->DbHandler->checkduplicatereports(
            "Select * from submitted_reports where report_type='annualrainfall' 
            and  year='$year' and station='$station_id'");
        if($reportexists->num_rows()>=1){
            $data['exists']=1;
            $data['reportrecord']=$reportexists;
        }else{
           if($this->input->post('reporttype')!=NULL){
            $this->unsetflashdatainfo();
            $this->load->helper(array('form', 'url'));
           
            $year= $this->input->post('year');
            $reporttype=$this->input->post('reporttype');
            
            $insertObservationSlipFormData=array(
            'station'=>$station_id,'year'=>$year,'report_type'=>$reporttype,
            'submitedby'=>$user);
            $this->inserSubmitedReports($insertObservationSlipFormData);
    
            $data['exists']=1;
         }
        } 

        $data['displayYearlyRainfallReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year,'blocknumber'=>$blocknumber);


        //Get Monthly Report Data for all the Months in a Given Year
        //Get for January    //$monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary
        $query1 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('01',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query1) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary'] = $query1;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJanuary'] = array();
        }



        //Get Monthly Report Data for all the Months in a Given Year
        //Get for Month of February
        $query2 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('02',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query2) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfFebruary'] = $query2;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfFebruary'] = array();
        }

        //Get for Month of March
        $query3 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('03',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query3) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMarch'] = $query3;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMarch'] = array();
        }

        //Get for Month of April
        $query4 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('04',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query4) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfApril'] = $query4;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfApril'] = array();
        }

        //Get for Month of May
        $query5 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('05',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query5) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMay'] = $query5;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfMay'] = array();
        }

        //Get for Month of June   //$monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune
        $query6 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('06',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query6) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune'] = $query6;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJune'] = array();
        }

        //Get for Month of July
        $query7 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('07',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query7) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJuly'] = $query7;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfJuly'] = array();
        }


        //Get for Month of August
        $query8 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('08',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query8) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfAugust'] = $query8;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfAugust'] = array();
        }


        //Get for Month of September
        $query9 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('09',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query9) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfSeptember'] = $query9;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfSeptember'] = array();
        }


        //Get for Month of October
        $query10 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('10',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query10) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfOctober'] = $query10;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfOctober'] = array();
        }


        //Get for Month of November
        $query11 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('11',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query11) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfNovember'] = $query11;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfNovember'] = array();
        }


        //Get for Month of December
        $query12 = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable('12',$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

        if ($query12) {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfDecember'] = $query12;
        } else {
            $data['monthlyrainfallreportdatafromObservationSlipTableForMonthOfDecember'] = array();
        }




        //Nid to load the stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }



        if(isset($_POST['reportonly'])||isset($_POST['sendreporttomanager'])){
            $data['reportonly']="true";
            }
            $data['regions'] = $this->DbHandler->RegionsModel();
            $data['allstations']=$this->DbHandler->Allstations();
            $data['subregions']=$this->DbHandler->SelectSubregions();
        $this->load->view('yearlyRainfallReport',$data);

    }


public function displaySpeciReport(){
     $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

         $region = $this->input->post('RegionName');
         //$station = "Kampala";
          if($userrole=='Manager' ||$userrole=='ManagerData' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" || $userrole == 'Communications'){
        
        $stationNumber =  $this->input->post('stationNoManager');
         $station = $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);


    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){
               $stationNumber = $this->input->post('stationNoOC');
                $station = $this->DbHandler->getStationName($stationNumber);
                 $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);


    }

          
        
         $date1 = $this->input->post('Start-Date');
         $date2 = $this->input->post('End-Date');

         $timeX = $this->input->post('StartTime');
         $timeY = $this->input->post('EndTime');


         $time1 = preg_replace('/\s+/', '', $timeX);
         $time2 = preg_replace('/\s+/', '', $timeY);
          

         //$timeX =  rtrim($time1,'Z');
         //$time_final1 = preg_replace('/\s+/', '', $timeY);
         //$time_actual1 = strtotime($time_final1);
         //$available_time1 = date("h:i",$time_actual1)."Z";
        $available_time1 = $time1;


        // $timeY =  rtrim($time2,'Z');
        //  $time_final2 = preg_replace('/\s+/', '', $timeY);
        // $time_actual2 = strtotime($time_final2);
        // $available_time2 = date("h:i",$time_actual2)."Z";

        $available_time2 = $time2;
        $submitted_data = array('region' => $region, 'stationName' => $station,'stationNumber'=>$stationNumber,'date'=>$date, 'time' => $available_time, 'date1'=>$date1, 'date2' => $date2,
        'time1' => $available_time1, 'time2' => $available_time2,'blocknumber'=>$blocknumber);

        $data['displayspeciReportHeaderFields'] =  $submitted_data;



        if(($time1 !="" && $time2 !="") && ($time1!="00:00" && $time2!="00:00")){
            $start_time = "".$time1."Z";
            $end_time = "".$time2."Z";
            $query = $this->DbHandler->getSpeciDataWithTimeSpecified($region, $station, $stationNumber, $date1, $date2, $start_time, $end_time);
        }
        else{
            $query = $this->DbHandler->getSpeciData($region, $station, $stationNumber,$date1,$date2);
        }
        $station_id= $this->DbHandler->identifyStationById($station,$stationNumber);
    $session_data = $this->session->userdata('logged_in');
    $user=$session_data['Userid'];
     
    if($this->input->post('forward')!=NULL){
        $record_id=$this->input->post('record_id');
        $reportexists=$this->DbHandler->updatesubmittedreports(
            "update submitted_reports set forwardtomanager='True',forwardedby='$user' where id='$record_id'");
        $data['exists']=1;
    }
    echo $available_time1;
    $reportexists=$this->DbHandler->checkduplicatereports(
        "Select * from submitted_reports where report_type='speci' 
        and startdate='$date1' and enddate='$date2' and starttime='$available_time1' and endtime='$available_time2' and station='$station_id'");
    if($reportexists->num_rows()>=1){
        $data['exists']=1;
        $data['reportrecord']=$reportexists;
    }else{
       if($this->input->post('reporttype')!=NULL){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));

        $month=$this->input->post('month');
        $year= $this->input->post('year');
        $reporttype=$this->input->post('reporttype');
        
        $insertObservationSlipFormData=array(
        'startdate'=>$date1,'enddate'=>$date2,'starttime'=>$time1,'endtime'=>$time2,'station'=>$station_id,'year'=>$year,'month'=>$month,'report_type'=>$reporttype,
        'submitedby'=>$user,'time' => $time);
        $this->inserSubmitedReports($insertObservationSlipFormData);

        $data['exists']=1;
       }
       } 
            

      if ($query) {
            
            $data['specireportdataforADayFromObservationSlipTable'] = $query;
                    }
                     else {
            $data['specireportdataforADayFromObservationSlipTable'] = array();
            

        }

         $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }
        $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,tablename
        if ($station_indicators_query) {
            $data['stationIndicatorData'] = $station_indicators_query;
        } else {
            $data['stationIndicatorData'] = array();
        }
        $this->session->set_flashdata($data);
        //redirect('/initialize-speci-report');
        if(isset($_POST['reportonly'])||isset($_POST['sendreporttomanager'])){
          $data['reportonly']="true";
        }
        $data['regions'] = $this->DbHandler->RegionsModel();
        $data['allstations']=$this->DbHandler->Allstations();
        $data['subregions']=$this->DbHandler->SelectSubregions();
        $this->load->view('speciReport', $data);

}


    //weather summary report methods
    public function initializeWeatherSummnaryReport(){
        //$this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        // $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Stations.
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        $data['regions'] = $this->DbHandler->RegionsModel();
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }
        $data['allstations']=$this->DbHandler->Allstations();
        $data['subregions']=$this->DbHandler->SelectSubregions();
        $this->load->view('weatherSummaryReport',$data);
    }
    public function displayweathersummaryreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        $month = $this->input->post('month');

        if($userrole=='Manager' || $userrole=='ManagerData'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' ){
                       $stationNumber =  $this->input->post('stationNoManager');
                        $stationName =  $this->DbHandler->getStationName($stationNumber);


        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){
            
            $stationNumber = $this->input->post('stationNoOC');
            $stationName =  $this->DbHandler->getStationName($stationNumber);

        }


        //Get the Month Selected As A Number.
        $monthAsANumberselected="";
        if($month=='January'){
            $monthAsANumberselected=1;

        }elseif($month=='February'){
            $monthAsANumberselected=2;

        }elseif($month=='March'){
            $monthAsANumberselected=3;

        }elseif($month=='April'){
            $monthAsANumberselected=4;

        }elseif($month=='May'){
            $monthAsANumberselected=5;

        }elseif($month=='June'){
            $monthAsANumberselected=6;

        }elseif($month=='July'){
            $monthAsANumberselected=7;

        }elseif($month=='August'){
            $monthAsANumberselected=8;

        }elseif($month=='September'){
            $monthAsANumberselected=9;

        }elseif($month=='October'){
            $monthAsANumberselected=10;

        }
        elseif($month=='November'){
            $monthAsANumberselected=11;

        }
        elseif($month=='December'){
            $monthAsANumberselected=12;

        }

        

        $data['displayWeatherSummaryReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year,'monthInWords'=>$month,'monthAsANumberselected'=>$monthAsANumberselected);




        /////Get Data From the OS TABLE,METAR TABLE,MORE FORM FIELDS FORM TABLE TO DISPLAY THE WEATHER SUMMARY FORM.
        //FROM OS TABLE NID DATA FOR 0600Z AND 1200Z.
        //FOR 0600Z
        $sqlquery1=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"0600Z");  //value,field,table
        if ($sqlquery1) {
            $data['observationslipdataforAMonthAndTime0600Z'] = $sqlquery1;
        } else {
            $data['observationslipdataforAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query1=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"1200Z");  //value,field,table
        if ($query1) {
            $data['observationslipdataforAMonthAndTime1200Z'] = $query1;
        } else {
            $data['observationslipdataforAMonthAndTime1200Z'] = array();
        }

         //FROM MORE FORM FIELDS TABLE NID DATA FOR 0600Z AND 1200Z.
        //FOR 0600Z
        $sqlquery2=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"0600Z");  //value,field,table
        if ($sqlquery2) {
            $data['moreformfieldsdatatable_forAMonthAndTime0600Z'] = $sqlquery2;
        } else {
            $data['moreformfieldsdatatable_forAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query2=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"1200Z");  //value,field,table
        if ($query2) {
            $data['moreformfieldsdatatable_forAMonthAndTime1200Z'] = $query2;
        } else {
            $data['moreformfieldsdatatable_forAMonthAndTime1200Z'] = array();
        }


         $query3=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTableforpresentweather($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
        if ($query3) {
            $data['moreformfieldsdatatable_forAMonth'] = $query3;
        } else {
            $data['moreformfieldsdatatable_forAMonth'] = array();
        }
        //nid to load the stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $data['regions'] = $this->DbHandler->RegionsModel();
        $this->load->view('weatherSummaryReport',$data);

    }
    //Synoptic Report methods
    public function initializeSynopticReport(){
       // $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

        //Get all Stations.
        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        $data['regions'] = $this->DbHandler->RegionsModel();
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        //View the dekadal form.
        $data['allstations']=$this->DbHandler->Allstations();
        $data['subregions']=$this->DbHandler->SelectSubregions();
        $this->load->view('synopticReport',$data);

    }
     public function displaysynopticreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $date = $this->input->post('date');
        $datebefore=date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date) ) ));
        $region = $this->input->post('RegionName');

        if($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=='ManagerStationNetworks' || $userrole == 'Communications'){
            
        $stationNumber =  $this->input->post('stationNoManager');
        $stationName =  $this->DbHandler->getStationName($stationNumber);
         $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
         $unitofwindspeed =  $this->DbHandler->getUnitOfWindSpeed($stationNumber);
        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){
            
        $stationNumber = $this->input->post('stationNoOC');
        $stationName =  $this->DbHandler->getStationName($stationNumber);
        $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
        $unitofwindspeed =  $this->DbHandler->getUnitOfWindSpeed($stationNumber);

        }

        $station_id= $this->DbHandler->identifyStationById($stationName,$stationNumber);
        $session_data = $this->session->userdata('logged_in');
        $user=$session_data['Userid'];
         
        if($this->input->post('forward')!=NULL){
            $record_id=$this->input->post('record_id');
            $reportexists=$this->DbHandler->updatesubmittedreports(
                "update submitted_reports set forwardtomanager='True',forwardedby='$user' where id='$record_id'");
            $data['exists']=1;
        }
        
        $reportexists=$this->DbHandler->checkduplicatereports(
            "Select * from submitted_reports where report_type='synoptic' 
            and date='$date' and station='$station_id'");
        if($reportexists->num_rows()>=1){
            $data['exists']=1;
            $data['reportrecord']=$reportexists;
        }else{
           if($this->input->post('reporttype')!=NULL){
            $this->unsetflashdatainfo();
            $this->load->helper(array('form', 'url'));
            $date=$this->input->post('date');
           
            $reporttype=$this->input->post('reporttype');
            
            $insertObservationSlipFormData=array(
            'station'=>$station_id,'date'=>$date,'report_type'=>$reporttype,
            'submitedby'=>$user);
            $this->inserSubmitedReports($insertObservationSlipFormData);
    
            $data['exists']=1;
         }
        } 

        $data['displaySynopticReportHeaderFields'] = array('region'=>$region,'stationName'=>$stationName,'stationNumber'=>$stationNumber,'blocknumber'=>$blocknumber,'unitofwindspeed'=>$unitofwindspeed,

            'date'=>$date);

        //FROM THE OBSERVATION SLIP KIP DATA FROM DIFFERENT TIMES.
        //FOR 0000Z
        $query1= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0000Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query1) {
            $data['synopticreportdataforADayFromObservationSlip0000Z'] = $query1;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0000Z'] = array();
        }
        //DATA FOR 0000Z OF PREVIOUS DATE
         $data['synopticreportdataforAPreviousDayFromObservationSlip0000Z']= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0000Z($datebefore,$stationName,$stationNumber,'observationslip');
       
       
         //FOR 0600Z
        $query2= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0300Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query2) {
            $data['synopticreportdataforADayFromObservationSlip0300Z'] = $query2;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0300Z'] = array();
        }
        //DATA FOR 0300Z OF PREVIOUS DATE
        $data['synopticreportdataforAPreviousDayFromObservationSlip0300Z']= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0300Z($datebefore,$stationName,$stationNumber,'observationslip');
        //FOR 0600Z
        $query3= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0600Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query3) {
            $data['synopticreportdataforADayFromObservationSlip0600Z'] = $query3;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0600Z'] = array();
        }
         //DATA FOR 0600Z OF PREVIOUS DATE
        $data['synopticreportdataforAPreviousDayFromObservationSlip0600Z']= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0600Z($datebefore,$stationName,$stationNumber,'observationslip');
       
       
        //FOR 0900Z
        $query4= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0900Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query4) {
            $data['synopticreportdataforADayFromObservationSlip0900Z'] = $query4;
        } else {
            $data['synopticreportdataforADayFromObservationSlip0900Z'] = array();
        }
        //DATA FOR 0900Z OF PREVIOUS DATE
        $data['synopticreportdataforAPreviousDayFromObservationSlip0900Z']= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime0900Z($datebefore,$stationName,$stationNumber,'observationslip');
       
       
        //FOR 1200Z
        $query5= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1200Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query5) {
            $data['synopticreportdataforADayFromObservationSlip1200Z'] = $query5;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1200Z'] = array();
        }
        //DATA FOR 1200Z OF PREVIOUS DATE
        $data['synopticreportdataforAPreviousDayFromObservationSlip1200Z']= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1200Z($datebefore,$stationName,$stationNumber,'observationslip');
       
       
        //FOR 1500Z
        $query6= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1500Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query6) {
            $data['synopticreportdataforADayFromObservationSlip1500Z'] = $query6;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1500Z'] = array();
        }
         //DATA FOR 1500Z OF PREVIOUS DATE
        $data['synopticreportdataforAPreviousDayFromObservationSlip1500Z']= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1500Z($datebefore,$stationName,$stationNumber,'observationslip');
        
        
        //FOR 1800Z
        $query7= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1800Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query7) {
            $data['synopticreportdataforADayFromObservationSlip1800Z'] = $query7;
        } else {
            $data['synopticreportdataforADayFromObservationSlip1800Z'] = array();
        }
        //DATA FOR 1800Z OF PREVIOUS DATE
        $data['synopticreportdataforAPreviousDayFromObservationSlip1800Z']= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime1800Z($datebefore,$stationName,$stationNumber,'observationslip');
        
        
        //FOR 2100Z
        $query8= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime2100Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($query8) {
            $data['synopticreportdataforADayFromObservationSlip2100Z'] = $query8;
        } else {
            $data['synopticreportdataforADayFromObservationSlip2100Z'] = array();
        }
        //DATA FOR 2100Z OF PREVIOUS DATE
        $data['synopticreportdataforAPreviousDayFromObservationSlip2100Z']= $this->DbHandler->selectSynopticReportForSpecificDayFromObservationSlipTime2100Z($datebefore,$stationName,$stationNumber,'observationslip');




        //FROM THE MORE FORM FIELDS TABLE KIP DATA FROM DIFFERENT TIMES.
        //FOR 0000Z
        $more_form_fields_table_query1= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0000Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query1) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0000Z'] = $more_form_fields_table_query1;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0000Z'] = array();
        }
       $date0=date('Y-m-d',(strtotime ( '-1 day' , strtotime ($date) ) ));
       // $times=array("18:00Z","19:30Z","19:00Z","19:30Z","20:00Z","20:30Z","21:00Z","21:30Z","22:00Z","22:30Z","23:00Z");
        //$data['TypeOfStationPresent_Past_Weather_Time_0000Z'] =$this->DbHandler->TypeOfStation_Present_Past_Weather($date0,"observationslip",$times);
        $data['TypeOfStationPresent_Past_Weather_Time_0000Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date0,"observationslip","18:00Z","23:30Z");
         if($data['TypeOfStationPresent_Past_Weather_Time_0000Z']==0){
            $data['TypeOfStationPresent_Past_Weather_Time_0000Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date,"observationslip","00:00Z","00:30Z");
         }           
        //FOR 0300Z
        $more_form_fields_table_query2= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0300Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query2) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0300Z'] = $more_form_fields_table_query2;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0300Z'] = array();
        }
       // $times=array("03:00Z","03:30Z","02:00Z","02:30Z","01:00Z","01:30Z","00:00Z");
        //$data['TypeOfStationPresent_Past_Weather_Time_0300Z'] =$this->DbHandler->TypeOfStation_Present_Past_Weather($date,"observationslip",$times);
        $data['TypeOfStationPresent_Past_Weather_Time_0300Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date,"observationslip","00:00Z","03:00Z");
        //FOR 0600Z
        $more_form_fields_table_query3= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0600Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query3) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0600Z'] = $more_form_fields_table_query3;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0600Z'] = array();
        }
       // $times=array("06:00Z","05:00Z","05:30Z","04:00Z","04:30Z","03:00Z","03:30Z","02:00Z","02:30Z","01:00Z","01:30Z","00:00Z","00:30Z");
        $data['TypeOfStationPresent_Past_Weather_Time_0600Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date,"observationslip","00:00Z","06:00Z");

        //FOR 0900Z
        $more_form_fields_table_query4= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0900Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query4) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0900Z'] = $more_form_fields_table_query4;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable0900Z'] = array();
        }
        //$times=array("09:00Z","08:00Z","08:30Z","07:00Z","07:30Z","06:00Z");
        $data['TypeOfStationPresent_Past_Weather_Time_0900Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date,"observationslip","06:00Z","09:00Z");
        //FOR 1200Z
        $more_form_fields_table_query5= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1200Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query5) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1200Z'] = $more_form_fields_table_query5;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1200Z'] = array();
        }
        //$times=array("12:00Z","11:00Z","10:00Z","09:00Z","08:00Z","07:00Z");
        $data['TypeOfStationPresent_Past_Weather_Time_1200Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date,"observationslip","06:00Z","12:00Z");
        //FOR 1500Z
        $more_form_fields_table_query6= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1500Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query6) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1500Z'] = $more_form_fields_table_query6;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1500Z'] = array();
        }
        $times=array("15:00Z","14:00Z","13:00Z");
        $data['TypeOfStationPresent_Past_Weather_Time_1500Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date,"observationslip","12:00Z","15:00Z");
        //FOR 1800Z
        $more_form_fields_table_query7= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1800Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query7) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1800Z'] = $more_form_fields_table_query7;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable1800Z'] = array();
        }
        $times=array("18:00Z","17:00Z","16:00Z","15:00Z","14:00Z","13:00Z");
        $data['TypeOfStationPresent_Past_Weather_Time_1800Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date,"observationslip","12:00Z","18:00Z");
        //FOR 2100Z
        $more_form_fields_table_query8= $this->DbHandler->selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable2100Z($date,$stationName,$stationNumber,'observationslip');  //value,field,table

        if ($more_form_fields_table_query8) {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable2100Z'] = $more_form_fields_table_query8;
        } else {
            $data['synopticreportdataforADayFrom_MoreFormFieldsTable2100Z'] = array();
        }
        $times=array("21:00Z","20:00Z","20:00Z");
        $data['TypeOfStationPresent_Past_Weather_Time_2100Z'] =$this->DbHandler->TypeOfStation_PresentPast_Weather($date,"observationslip","18:00Z","21:00Z");
        //FOR 1800Z

        //nid to load stations again
        $userstation=$session_data['UserStation'];

        $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        if(isset($_POST['reportonly'])||isset($_POST['sendreporttomanager'])){
            $data['reportonly']="true";
            }
            $data['regions'] = $this->DbHandler->RegionsModel();
            $data['allstations']=$this->DbHandler->Allstations();
            $data['subregions']=$this->DbHandler->SelectSubregions();
       $this->load->view('synopticReport',$data);

    }
  //sepci Report methods

      public function initializeSpeciReport(){
          $session_data = $this->session->userdata('logged_in');
          $userrole=$session_data['UserRole'];
          // $range = $this->input->post('range');



          if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst'){
              $stationNumber = $this->input->post('stationNoManager');
              $stationName =  $this->DbHandler->getStationName($stationNumber);

          }elseif($userrole=='Senior Weather Observer'  || $userrole=='WeatherForecaster'){
               $stationNumber = $this->input->post('stationNoOC');
              $stationName =  $this->DbHandler->getStationName($stationNumber);

          }


          $data['displaySpeciReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
              'date'=>$date);

          //NID TO GET THE MONTH AND


          $userstation=$session_data['UserStation'];
  //////////////////////////////////////////////////////////////////////////////////
          //pick data from Observation slip for the Speci Report.
           $query = $this->DbHandler->selectSpeciReportForSpecificDayFromObservationSlipTable($date,$stationName,$stationNumber,'observationslip'); 
            //value,field,table
           $data['regions'] = $this->DbHandler->RegionsModel();

           if ($query) {
             $data['observationslipformdata'] = $query;
            } else {
              $data['observationslipformdata'] = array();
            }


            $data['allstations']=$this->DbHandler->Allstations();
            $data['subregions']=$this->DbHandler->SelectSubregions();

          $this->load->view('speciReport',$data);
      }

//Observationslip Report methods

public function initialiseObservationSlipReport(){
   // $this->unsetflashdatainfo();
    //Get all Stations.
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    $data['regions']=$this->DbHandler->selectStations();  
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('observationSlipReport',$data);
}
public function reportIssues(){
  $date=$this->input->post('date');

  $time=$this->input->post('time');
  $stationName=$this->input->post('stationName');
  $stationNumber=$this->input->post('stationNumber');
  $stationId=$this->DbHandler->identifyStationById($stationName,$stationNumber);
  //fetch data of oc of  the station
 $htmlmessage = 'Hello Sir/madam, '.'<br></br><br></br>'.
       '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
       'that Issues have been identified on observationSlip report of  '.
       $date.', time '.$time.'  '.
       'form </p><br></br>'.
       '<a href="http://www.wimea.mak.ac.ug/weather/">Click here to login!</a>'.
       'Thank You'.'<b></br><b></br>'.'WIMEA-ICT';

     $this->sendMail($htmlmessage,"mutesasirajovan@gmail.com");
     die($htmlmessage);
  $ocData= $this->DbHandler->selectByIdOC($stationId,"station","systemusers");

  foreach ($ocData as $row ) {

    $htmlmessage = 'Hello Sir/madam, '.''.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
         '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
         'that Issues have been identified on observationSlip report of  '.
         $date.', time '.$time.'  '.
         'form </p><br></br>'.
         '<a href="http://www.wimea.mak.ac.ug/weather/">Click here to login!</a>'.
         'Thank You'.'<b></br><b></br>'.'WIMEA-ICT';

       $this->sendMail($htmlmessage,$row->UserEmail);
      // $tester.=" ".$row->UserEmail;
  }

  $this->session->set_flashdata('success', 'Issue report Email sent to OC!');
  $this->index();
}
public function  sendMail($htmlmsgbody,$msgreceiver)
{
    $this->unsetflashdatainfo();
    $this->load->library('email');

    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com';
    $config['smtp_port'] = '465';
    $config['smtp_user'] = 'wimeaictwdr@gmail.com';  //change it
    $config['smtp_pass'] = '1wimeawdr2'; //change it
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['mailtype'] = 'html';


    $config['wordwrap'] = TRUE;
    $this->email->initialize($config);

    $this->email->from('wimeaictwdr@gmail.com','WIMEA-ICT');   //change it
    $this->email->to($msgreceiver);       //change it
    $this->email->subject("WIMEA-ICT Web Interface Credentials");
    $this->email->message($htmlmsgbody);

    if($this->email->send()) {
        return true;
    } else {
        return false;
    }


}
public function displayobservationslipreport(){
	
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    

     //$ObservationslipTimeInZoo = $this->input->post('ObservationSlipTime');


     $time = $this->input->post('ObservationSlipTime');
  
    if(!empty($time)){
    // $timeX =  rtrim($time,'Z');
    // $time_final = preg_replace('/\s+/', '', $timeX);
    // $time_actual = strtotime($time_final);
    $ObservationslipTimeInZoo  = preg_replace('/\s+/', '', $time);
   }

    $date = $this->input->post('date');
    



    if($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
         $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){
       
        $stationNumber = $this->input->post('stationNoOC');
        $stationName = $this->DbHandler->getStationName($stationNumber);
        $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

    }
    $station_id= $this->DbHandler->identifyStationById($stationName,$stationNumber);
    $session_data = $this->session->userdata('logged_in');
    $user=$session_data['Userid'];
     
    if($this->input->post('forward')!=NULL){
        $record_id=$this->input->post('record_id');
        $reportexists=$this->DbHandler->updatesubmittedreports(
            "update submitted_reports set forwardtomanager='True',forwardedby='$user' where id='$record_id'");
        $data['exists']=1;
    }
    
    $reportexists=$this->DbHandler->checkduplicatereports(
        "Select * from submitted_reports where report_type='observationslip' 
        and date='$date' and time='$ObservationslipTimeInZoo' and station='$station_id'");
    if($reportexists->num_rows()>=1){
        $data['exists']=1;
        $data['reportrecord']=$reportexists;
    }else{
       if($this->input->post('reporttype')!=NULL){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));

        $month=$this->input->post('month');
        $year= $this->input->post('year');
        $reporttype=$this->input->post('reporttype');
        
        $insertObservationSlipFormData=array(
        'date'=>$date,'station'=>$station_id,'year'=>$year,'month'=>$month,'report_type'=>$reporttype,
        'submitedby'=>$user,'time' => $time);
        $this->inserSubmitedReports($insertObservationSlipFormData);

        $data['exists']=1;
     }
    } 

    $data['displayObservationSlipReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'TimeInZoo'=>$ObservationslipTimeInZoo,'date'=>$date,'blocknumber'=>$blocknumber);
   
    //$query = $this->DbHandler->selectAll($stationName,'StationName','observationslip');  //value,field,table
    if($time != ""){
       
        $query = $this->DbHandler->selectObservationSlipReportForSpecificTimeOfADay($ObservationslipTimeInZoo,$date,$stationName,$stationNumber,'observationslip');  //value,field,table
    }
    else{
        $query = $this->DbHandler->selectObservationSlipReportForSpecificDay($date,$stationName,$stationNumber,'observationslip');  //value,field,table
    }
    
    
    if ($query) {
        $data['observationslipdataforspecifictimeofaday'] = $query;
		 
    } else {
        $data['observationslipdataforspecifictimeofaday'] = array();
    }

    //load all stations again
    $userstation=$session_data['UserStation'];

    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }
    if(isset($_POST['reportonly'])||isset($_POST['sendreporttomanager'])){
    $data['reportonly']="true";
    }
    $data['regions']=$this->DbHandler->selectStations();
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('observationSlipReport',$data);
   

}


//Monthly Rainfall report


public function initializeMonthlyRainfallReport(){
  //  $this->unsetflashdatainfo();
    //Get all Stations.
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('monthlyRainfallReport',$data);
}
public function displaymonthlyrainfallreport(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];


    $year = $this->input->post('year');
    $monthselected = $this->input->post('month');
    $region = $this->input->post('RegionName');



    if($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){

         $stationNumber =  $this->input->post('stationNoManager');
        $stationName =  $this->DbHandler->getStationName($stationNumber);
         $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
       
    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){
        $stationNumber = $this->input->post('stationNoOC');
        $stationName =  $this->DbHandler->getStationName($stationNumber);
         $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);


    }
    //Get the Month Selected As A Number.
    $monthAsANumberselected="";
    if($monthselected=='January'){
        $monthAsANumberselected=1;

    }elseif($monthselected=='February'){
        $monthAsANumberselected=2;

    }elseif($monthselected=='March'){
        $monthAsANumberselected=3;

    }elseif($monthselected=='April'){
        $monthAsANumberselected=4;

    }elseif($monthselected=='May'){
        $monthAsANumberselected=5;

    }elseif($monthselected=='June'){
        $monthAsANumberselected=6;

    }elseif($monthselected=='July'){
        $monthAsANumberselected=7;

    }elseif($monthselected=='August'){
        $monthAsANumberselected=8;

    }elseif($monthselected=='September'){
        $monthAsANumberselected=9;

    }elseif($monthselected=='October'){
        $monthAsANumberselected=10;

    }
    elseif($monthselected=='November'){
        $monthAsANumberselected=11;

    }
    elseif($monthselected=='December'){
        $monthAsANumberselected=12;

    }
    if($monthAsANumberselected==12){
        $nextyear=$year+1;
        $nextmonthnumber=1;
    }else{
        $nextyear=$year;
        $nextmonthnumber=$monthAsANumberselected+1;
    }
  
    $station_id= $this->DbHandler->identifyStationById($stationName,$stationNumber);
    $session_data = $this->session->userdata('logged_in');
    $user=$session_data['Userid'];
     
    if($this->input->post('forward')!=NULL){
        $record_id=$this->input->post('record_id');
        $reportexists=$this->DbHandler->updatesubmittedreports(
            "update submitted_reports set forwardtomanager='True',forwardedby='$user' where id='$record_id'");
        $data['exists']=1;
    }
    
    $reportexists=$this->DbHandler->checkduplicatereports(
        "Select * from submitted_reports where report_type='monthlyrainfall' 
        and month='$monthselected' and year='$year' and station='$station_id'");
    if($reportexists->num_rows()>=1){
        $data['exists']=1;
        $data['reportrecord']=$reportexists;
    }else{
       if($this->input->post('reporttype')!=NULL){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $month=$this->input->post('month');
        $year= $this->input->post('year');
        $reporttype=$this->input->post('reporttype');
        
        $insertObservationSlipFormData=array(
        'station'=>$station_id,'year'=>$year,'month'=>$month,'report_type'=>$reporttype,
        'submitedby'=>$user);
        $this->inserSubmitedReports($insertObservationSlipFormData);

        $data['exists']=1;
     }
    } 

    $data['displayMonthlyRainfallReportHeaderFields'] = array('stationName'=>$stationName,
        'stationNumber'=>$stationNumber,'region' => $region,
        'year'=>$year,'monthInWords'=>$monthselected,'monthAsANumberselected'=>$monthAsANumberselected, 'blocknumber'=>$blocknumber);




    //Get Monthly Report Data
    //$query = $this->DbHandler->selectMonthlyRainfallReportForAMonth($monthselected,$year,$stationName,$stationNumber,'dailyperiodicrainfall');  //value,field,table

    // if ($query) {
    //    $data['monthlyrainfallreportdata'] = $query;
    //} else {
    //    $data['monthlyrainfallreportdata'] = array();
    //}


    //Get Monthly Report Data
    $sqlquery = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

    if ($sqlquery) {
        $data['monthlyrainfallreportdatafromObservationSlipTable'] = $sqlquery;
    } else {
        $data['monthlyrainfallreportdatafromObservationSlipTable'] = array();
    }


 $sqlquerynextmonth = $this->DbHandler->selectMonthlyRainfallReportForAMonthFromObservationSlipTable($nextmonthnumber,$nextyear,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table

    if ( $sqlquerynextmonth) {
        $data['monthlyrainfallreportdatafromObservationSlipTablenextmonth'] =  $sqlquerynextmonth;
    } else {
        $data['monthlyrainfallreportdatafromObservationSlipTablenextmonth'] = array();
    }


    //Nid to load the stations again

    $userstation=$session_data['UserStation'];

    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    if(isset($_POST['reportonly'])||isset($_POST['sendreporttomanager'])){
        $data['reportonly']="true";
        }
        $data['allstations']=$this->DbHandler->Allstations();
        $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('monthlyRainfallReport',$data);

}
//Metar Report
public function initializeMetarReport(){
    //$this->unsetflashdatainfo();
    //Get all Stations.
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('metarReport',$data);
}
public function displaymetarreport(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    $time = $this->input->post('metarTime');
    $region = $this->input->post('RegionName');
    $date = $this->input->post('date');

    if($userrole=='Manager' ||$userrole=='ManagerData' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" || $userrole == 'Communications' ){
        
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName = $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);


    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){
            $stationNumber = $this->input->post('stationNoOC');
            $stationName =  $this->DbHandler->getStationName($stationNumber);
             $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
    }


    $station_id= $this->DbHandler->identifyStationById($stationName,$stationNumber);
    $session_data = $this->session->userdata('logged_in');
    $user=$session_data['Userid'];
    
    if(isset($_POST['sendreporttomanager'])){
    if($this->input->post('forward')!=NULL){
        $record_id=$this->input->post('record_id');
        $reportexists=$this->DbHandler->updatesubmittedreports(
            "update submitted_reports set forwardtomanager='True',forwardedby='$user' where id='$record_id'");
        $data['exists']=1;
    }
   }

    // $timeX =  rtrim($time,'Z');
    // $time_final = preg_replace('/\s+/', '', $timeX);
    // $time_actual = strtotime($time_final);
    $metarTimeInZoo  = preg_replace('/\s+/', '', $time);
    if(strcmp($time,"")==0){
        $metarTimeInZoo=""; 
    }

    $reportexists=$this->DbHandler->checkduplicatereports(
        "Select * from submitted_reports where report_type='metar' 
        and date='$date' and time='$metarTimeInZoo' and station='$station_id'");
    if($reportexists->num_rows()>=1){
        $data['exists']=1;
        $data['reportrecord']=$reportexists;
    }else{
       if($this->input->post('reporttype')!=NULL){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $month=$this->input->post('month');
        $year= $this->input->post('year');
        $reporttype=$this->input->post('reporttype');
        
        $insertObservationSlipFormData=array(
        'date'=>$date,'station'=>$station_id,'year'=>$year,'month'=>$month,'report_type'=>$reporttype,
        'submitedby'=>$user,'time' =>$metarTimeInZoo);
        $this->inserSubmitedReports($insertObservationSlipFormData);

        $data['exists']=1;
     }
    } 



   


    $data['displayMetarReportHeaderFields'] = array('region' => $region,
        'stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'date'=>$date, 'time' => $metarTimeInZoo,'blocknumber'=>$blocknumber);

    //NID TO GET THE MONTH AND


    $userstation=$session_data['UserStation'];
//////////////////////////////////////////////////////////////////////////////////
    //pick data from Observation slip for the Metar Report.

    if($time != ""){
    
      $query = $this->DbHandler->selectMetarReportForSpecificDayFromObservationSlipTableWithTime($region,$stationName,$stationNumber,$date,$time,'observationslip');  //value,field,table
    }else{
       $query = $this->DbHandler->selectMetarReportForSpecificDayFromObservationSlipTable($region,$stationName,$stationNumber,$date,'observationslip');  //value,field,table 
    }
     

     if ($query) {
       $data['metarreportdataforADayFromObservationSlipTable'] = $query;
      } else {
        $data['metarreportdataforADayFromObservationSlipTable'] = array();
      }



/////////////////////////////////////////////////////////////////////////////////////////////////////
    $userstation=$session_data['UserStation'];

    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }
/////////////////////////////////////////////
   // NID TO LOAD STATION INDICATORS
    $station_indicators_query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,tablename
    if ($station_indicators_query) {
        $data['stationIndicatorData'] = $station_indicators_query;
    } else {
        $data['stationIndicatorData'] = array();
    }

    $this->session->set_flashdata($data);
    // redirect('/generate-metar-report');

    if(isset($_POST['reportonly'])||isset($_POST['sendreporttomanager'])){
        $data['reportonly']="true";
    }
    $data['regions'] = $this->DbHandler->RegionsModel();
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
   $this->load->view('metarReport',$data);
}




//Dekadal Report methods
public function initializeDekadalReport(){
   // $this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];

    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    $data['regions'] = $this->DbHandler->RegionsModel();
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    //View the dekadal form.
    $this->load->view('dekadalReport',$data);

}
public function displaydekadalreport(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];

    if($userrole=='ManagerData' || $userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks" ){
       
        $stationNumber =  $this->input->post('stationNoManager');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
          $regnumber =  $this->DbHandler->getregno($stationNumber);

    }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){

        $stationNumber = $this->input->post('stationNoOC');
         $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
          $regnumber =  $this->DbHandler->getregno($stationNumber);

    }


    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');

    // Get the Month From the date selected.
    //$month = date('m', strtotime($loop->date));
    $monthAsANumberselected = date('m', strtotime($fromdate));
    //$range = $this->input->post('range');
    $monthselected2 = date('m', strtotime($todate));

    // Get the Year From the date selected.
    $year = date('Y', strtotime($todate));


    $station_id= $this->DbHandler->identifyStationById($stationName,$stationNumber);
    $session_data = $this->session->userdata('logged_in');
    $user=$session_data['Userid'];
     
    if($this->input->post('forward')!=NULL){
        $record_id=$this->input->post('record_id');
        $reportexists=$this->DbHandler->updatesubmittedreports(
            "update submitted_reports set forwardtomanager='True',forwardedby='$user' where id='$record_id'");
        $data['exists']=1;
    }
    
    $reportexists=$this->DbHandler->checkduplicatereports(
        "Select * from submitted_reports where report_type='dekadal' 
        and startdate='$fromdate' and enddate='$todate' and station='$station_id'");
    if($reportexists->num_rows()>=1){
        $data['exists']=1;
        $data['reportrecord']=$reportexists;
    }else{
       if($this->input->post('reporttype')!=NULL){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));
        $datefrom=$this->input->post('fromdate');
        $dateto= $this->input->post('todate');
        $reporttype=$this->input->post('reporttype');
        
        $insertObservationSlipFormData=array(
        'station'=>$station_id,'startdate'=>$datefrom,'enddate'=>$dateto,'report_type'=>$reporttype,
        'submitedby'=>$user);
        $this->inserSubmitedReports($insertObservationSlipFormData);

        $data['exists']=1;
     }
    } 


    // $name='displayDekadalReportHeaderFields';
    $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
        'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'year'=>$year,'blocknumber'=>$blocknumber,'regnumber'=>$regnumber
    );

    //GET DATA FROM THE OBSERVATION SLIP TABLE.
    //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
    //FOR 0600Z
    $sqlquery1=$this->DbHandler->selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTable($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table
    if ($sqlquery1) {
        $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = $sqlquery1;
    } else {
        $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = array();
    }

    /////FOR 1200Z
    $query1=$this->DbHandler->selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTable($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"12:00Z");  //value,field,table
    if ($query1) {
        $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z'] = $query1;
    } else {
        $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z'] = array();
    }

    //Nid to load the stations again
    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

    if(isset($_POST['reportonly'])||isset($_POST['sendreporttomanager'])){
        $data['reportonly']="true";
        }
        $data['allstations']=$this->DbHandler->Allstations();
        $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('dekadalReport',$data);

}
//Rainfall temperature Report methods

public function initializerainfallTempReport(){
    //$this->unsetflashdatainfo();
    $session_data = $this->session->userdata('logged_in');
    //$userrole=$session_data['UserRole'];
    $userstation=$session_data['UserStation'];
    //Get all Stations.
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }
    //View the dekadal form.
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('rainfalltempReport',$data);

}

public function displayrainfallTempeReport(){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    // $range = $this->input->post('range');

    $date = $this->input->post('fromdate');
    $todate = $this->input->post('todate');
  /*  if($userrole=='Manager' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
        $stationName =  $this->input->post('stationManager');
        $stationNumber =  $this->input->post('stationNoManager');

    }elseif($userrole=='Senior Weather Observer'){
        $stationName = $this->input->post('stationOC');
        $stationNumber = $this->input->post('stationNoOC');

    }*/




    $userstation=$session_data['UserStation'];
//////////////////////////////////////////////////////////////////////////////////
    //pick data from Observation slip for the Metar Report.
     $query = $this->DbHandler->selectRainfallTemperatureForAdateRange($date,$todate);  //value,field,table

     if ($query) {
       $data['rainfalltempReportDate'] = $query;
      } else {
        $data['rainfalltempReportDate'] = array();
      }

    $userstation=$session_data['UserStation'];
    $query = $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //value,field,table
    //  var_dump($query);
    if ($query) {
        $data['stationsdata'] = $query;
    } else {
        $data['stationsdata'] = array();
    }

//die(JSON_encode($data));
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $data['allstations']=$this->DbHandler->Allstations();
    $data['subregions']=$this->DbHandler->SelectSubregions();
    $this->load->view('rainfalltempReport',$data);
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

    public function inserSubmitedReports($query){
        $this->unsetflashdatainfo();
        $this->load->helper(array('form', 'url'));

        

        $insertObservationSlipFormData=array(
            'date'=>$date,'station'=>$station_id,'year'=>$year,'month'=>$month,'report_type'=>$reporttype,
            'submitedby'=>$user,'time' => $time);
 
                $insertsuccess= $this->DbHandler->insertData($query,'submitted_reports'); //Array for data to insert then  the Table Name
                if($insertsuccess){
                    //$this->session->set_flashdata('success', 'Report sent to Data manager successfully!');
                    
                }
                else{
                    //$this->session->set_flashdata('error', '"Sorry, we encountered an issue sending the report! ');
                    
                }


}

public function submitted_reports($id=NULL)
{
    if(strcmp($id,"metar")==0){
        $data['allsubmittedmetar']=$this->DbHandler->allsubmittedreports($id);
    }else if(strcmp($id,"observationslip")==0){
        $data['allsubmittedobservationreports']=$this->DbHandler->allsubmittedreports($id);
    }else if(strcmp($id,"weathersummary")==0){
        $data['allsubmittedweathersummary']=$this->DbHandler->allsubmittedreports($id);
    }else if(strcmp($id,"dekadal")==0){
        $data['allsubmitteddekadal']=$this->DbHandler->allsubmittedreports($id);
    }else if(strcmp($id,"synoptic")==0){
        $data['allsubmittedsynoptic']=$this->DbHandler->allsubmittedreports($id);
    }else if(strcmp($id,"monthlyrainfall")==0){
        $data['allsubmittedmonthlyrainfall']=$this->DbHandler->allsubmittedreports($id);
    }else if(strcmp($id,"annualrainfall")==0){
        $data['allsubmittedannualrainfall']=$this->DbHandler->allsubmittedreports($id);
    }else if(strcmp($id,"speci")==0){
        $data['allsubmittedspeci']=$this->DbHandler->allsubmittedreports($id);
    }

    $this->load->view('submitted_reports',$data);
}

}
