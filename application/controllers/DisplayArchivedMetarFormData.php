<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayArchivedMetarFormData extends CI_Controller {

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
        //$this->unsetflashdatainfo();


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
        $this->load->view('displayArchivedMetarFormData',$data);
    }
    public function displayachivedmetarFormreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        // $range = $this->input->post('range');

        $date = $this->input->post('date');



        if($userrole=='ManagerData' || $userrole=='Manager' || $userrole=='DataOfficer' || $userrole=='SeniorDataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');
             $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForecaster'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');
             $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
        }


        $data['displayArchivedMetarFormReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,'date'=>$date, 'blocknumber'=>$blocknumber);

        //NID TO GET THE MONTH AND


        $userstation=$session_data['UserStation'];

        //Get Daily Data
        //$query = $this->DbHandler->selectAll($stationName,'StationName','observationslip');  //value,field,table
        $query = $this->DbHandler->selectArchivedMetarFormReportForSpecificDay($date,$stationName,$stationNumber,'archivemetarformdata');  //value,field,table

        if ($query) {
            $data['archivedmetarformreportdataforADay'] = $query;
        } else {
            $data['archivedmetarformreportdataforADay'] = array();
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


        $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('displayArchivedMetarFormData',$data);
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
