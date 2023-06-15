<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayArchivedWeatherSummaryFormReportData extends CI_Controller {

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
        $session_data = $this->session->userdata('logged_in');
        // $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];

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
        $this->load->view('displayArchivedWeatherSummaryFormReportData',$data);
    }
    public function displayarchivedweathersummaryformreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        $month = $this->input->post('month');

        if($userrole=='Manager' ||  $userrole=='ManagerData' || $userrole=='DataOfficer' || $userrole=='SeniorDataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');
            $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
            $stationregnumber=  $this->DbHandler->getStationRegnumber($stationNumber);
        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForecaster'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');
            $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
            $stationregnumber=  $this->DbHandler->getStationRegnumber($stationNumber);

        }


        //Get the Month Selected As A Number.
        $monthAsANumberselected=$this->DbHandler->getMonthNumber($month);


        $data['displayArchivedWeatherSummaryFormReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,'year'=>$year,'monthInWords'=>$month,'monthAsANumberselected'=>$monthAsANumberselected,'blocknumber'=>$blocknumber,'stationregnumber'=>$stationregnumber);


        ////////////////////////



        //Get Archived Weather Summary Report Data
         $query = $this->DbHandler->selectArchivedWeatherSummaryFormDataReportForAMonth($monthAsANumberselected,$year,$stationName,$stationNumber,'archiveweathersummaryformreportdata');  //value,field,table

        if ($query) {
            $data['archivedweathersummaryformreportdataforAMonth'] = $query;
        } else {
           $data['archivedweathersummaryformreportdataforAMonth'] = array();
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
        $this->load->view('displayArchivedWeatherSummaryFormReportData',$data);

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
