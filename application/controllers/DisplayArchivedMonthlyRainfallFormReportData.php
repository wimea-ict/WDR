<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayArchivedMonthlyRainfallFormReportData extends CI_Controller {

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
        //  $this->unsetflashdatainfo();
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
        $data['regions']=$this->DbHandler->RegionsModel();
        $this->load->view('displayArchivedMonthlyRainfallFormReportData',$data);
    }
    public function displayArchivedmonthlyrainfallFormreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];


        $year = $this->input->post('year');
        $monthselected = $this->input->post('month');
         $region = $this->input->post('RegionName');
       // $dekadalnumber = $this->input->post('dekadalnumber');



        if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='DataOfficer' || $userrole=='SeniorDataOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');
             $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);
              $district =  $this->DbHandler->getdistrict($stationNumber);

        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherAnalyst' || $userrole=='WeatherForecaster'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');
             $district =  $this->DbHandler->getdistrict($stationNumber);

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

        $data['displayArchivedMonthlyRainfallFormReportHeaderFields'] = array('stationName'=>$stationName,
            'stationNumber'=>$stationNumber,'region'=>$region,'blocknumber'=>$blocknumber,'district'=>$district,
            'year'=>$year,'monthInWords'=>$monthselected,'monthAsANumberselected'=>$monthAsANumberselected);


        //Get Monthly Report Data
        $sqlquery = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth($monthAsANumberselected,$year,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

        if ($sqlquery) {
            $data['archivedmonthlyrainfallformreportdata'] = $sqlquery;
        } else {
            $data['archivedmonthlyrainfallformreportdata'] = array();
        }

        $sqlquerynextmonth = $this->DbHandler->selectArchivedMonthlyRainfallReportForTheMonth($nextmonthnumber,$nextyear,$stationName,$stationNumber,'archivemonthlyrainfallformreportdata');  //value,field,table

    if ( $sqlquerynextmonth) {
        $data['archivemonthlyrainfallreportdatanextmonth'] =  $sqlquerynextmonth;
    } else {
        $data['archivemonthlyrainfallreportdatanextmonth'] = array();
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
        $this->load->view('displayArchivedMonthlyRainfallFormReportData',$data);

     //print_r($sqlquerynextmonth);
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
