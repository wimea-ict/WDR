<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchArchivedScannedYearlyRainfallFormDataReportCopy extends CI_Controller {

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
        $this->load->view('searchArchivedScannedYearlyRainfallFormDataReportCopy',$data);
    }
    public function displayarchivedscannedyearlyrainfallformreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        //$month = $this->input->post('month');

        if($userrole=='Manager' ||  $userrole=='ManagerData' || $userrole=='SeniorDataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForecaster'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        //Get the Month Selected As A Number.




        $data['displayArchivedScannedYearlyRainfallFormReportDetails'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'year'=>$year);


        ////////////////////////

        $sqlquery1=$this->DbHandler->selectArchivedScannedYearlyRainfallFormReportDataDetailsForAYear($year,$stationName,$stationNumber,'scannedarchiveyearlyrainfallformreportcopydetails');  //value,field,table
        if ($sqlquery1) {
            $data['archivedscannedyearlyrainfallformreportdataForAYear'] = $sqlquery1;
        } else {
            $data['archivedscannedyearlyrainfallformreportdataForAYear'] = array();
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
        $data['uploaded_files'] = $this->DbHandler->archievescanned_files(); 
        $this->load->view('searchArchivedScannedYearlyRainfallFormDataReportCopy',$data);

    }
    public  function DownloadArchivedYearlyRainfallFormReport($filename = NULL){
        // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents(base_url('/archive/'.$filename));
        force_download($filename, $data);


    }
    public  function ViewImageFromBrowser($filename = NULL){

        //'gif|jpg|png|jpeg|pdf|doc|docx|xlsx|ppt|pptx';


        header('Content-Type: image/gif');
        header('Content-Type: image/jpg');
        header('Content-Type: image/png');

        header('Content-Type: image/jpeg');
        header('Content-Type: application/pdf');
        header('Content-Type: application/doc');

        header('Content-Type: application/docx');
        header('Content-Type: application/xlsx');
        header('Content-Type: application/ppt');

        header('Content-Type: application/pptx');

        $image = file_get_contents(base_url('/archive/'.$filename));
        echo $image;
        $data['regions']=$this->DbHandler->selectStations(); 
        $this->load->view('searchArchivedScannedYearlyRainfallFormDataReportCopy');
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