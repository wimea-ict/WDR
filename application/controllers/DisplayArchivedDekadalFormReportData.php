<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayArchivedDekadalFormReportData extends CI_Controller {

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
        $data['regions']=$this->DbHandler->RegionsModel();
        $this->load->view('displayArchivedDekadalFormReportData',$data);

    }
    public function displayArchivedDekadalFormReport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='DataOfficer' || $userrole=='SeniorDataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');
             $regnumber =  $this->DbHandler->getregno($stationNumber);

        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForecaster'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');
             $regnumber =  $this->DbHandler->getregno($stationNumber);

        }

        $year = $this->input->post('year');
        $monthselected = $this->input->post('month');
        $dekadalnumber=$this->input->post('dekadalnumber');
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




        // $name='displayDekadalReportHeaderFields';
        $data['displayArchivedDekadalFormReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,'monthInWords'=>$monthselected,'monthAsANumberselected'=>$monthAsANumberselected,'year'=>$year,'dekadalnumber'=>$dekadalnumber,'regnumber'=>$regnumber
        );





        //Get Archived DEKADAL Report Data
        $query = $this->DbHandler->selectArchivedDekadalFormDataReportForAnyTenDaysOfAMonth($monthAsANumberselected,$year,$stationName,$stationNumber,$dekadalnumber,'archivedekadalformreportdata');  //value,field,table

        if ($query) {
            $data['archivedDekadalFormReportdataforAnyTenDaysOfAMonth'] = $query;
        } else {
            $data['archivedDekadalFormReportdataforAnyTenDaysOfAMonth'] = array();
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

        $data['regions']=$this->DbHandler->RegionsModel();
        $this->load->view('displayArchivedDekadalFormReportData',$data);

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
