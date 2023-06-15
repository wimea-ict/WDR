<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchArchivedScannedObservationSlipFormDataCopy extends CI_Controller {

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
        $this->load->view('searchArchivedScannedObservationSlipFormDataCopy',$data);
    }
    public function displayarchivedscannedobservationslipform(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        // $range = $this->input->post('range');

        $date = $this->input->post('date');
        $ObservationslipTimeInZoo = $this->input->post('ArchivedObservationSlipFormReportTime');



        if($userrole=='Manager' ||  $userrole=='ManagerData' || $userrole=='SeniorDataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForecaster'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }


        $data['displayArchivedScannedObservationSlipFormDataDetails'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'TimeInZoo'=>$ObservationslipTimeInZoo,'date'=>$date);

        //NID TO GET THE MONTH AND


        $userstation=$session_data['UserStation'];

        //Get Daily Data
        //$query = $this->DbHandler->selectAll($stationName,'StationName','observationslip');  //value,field,table
        $query = $this->DbHandler->selectArchivedScannedObservationSlipFormDetailsForSpecificDay($ObservationslipTimeInZoo,$date,$stationName,$stationNumber,'scannedarchiveobservationslipformcopydetails');  //value,field,table

        if ($query) {
            $data['archivedscannedobservationslipformdatacopyforADay'] = $query;
        } else {
            $data['archivedscannedobservationslipformdatacopyforADay'] = array();
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
        $this->load->view('searchArchivedScannedObservationSlipFormDataCopy',$data);
    }
    public  function DownloadArchivedScannedObservationSlipForm($filename = NULL){
        // load download helder
        $this->load->helper('download');
        // read file contents
        $data = base_url('/archive/'.$filename);
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

        $image = base_url('/archive/'.$filename);
        //echo $image;

       // header("Content-disposition: inline; filename=".basename($image));
       // header("Content-Length: ".filesize($image));

        header('Content-Disposition: inline; filename="' . $image . '"');
        header('Content-Transfer-Encoding: binary');
        //header("Content-Length: ".filesize($image));
        header('Accept-Ranges: bytes');

        @readfile($image);

        // Send the file to the browser.
        //echo $image;

          // readfile($image);


          $data['regions']=$this->DbHandler->selectStations(); 
        $this->load->view('searchArchivedScannedObservationSlipFormDataCopy',$data);
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