<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DekadalReport extends CI_Controller {

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
        $this->load->view('dekadalReport',$data);

    }
    public function displaydekadalreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' ){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');
             $regnumber =  $this->DbHandler->getregno($stationNumber);

        }elseif($userrole=='Senior Weather Observer'  || $userrole=='WeatherForecaster'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');
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





        // $name='displayDekadalReportHeaderFields';
        $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'year'=>$year,'regnumber'=>$regnumber
        );

        //GET DATA FROM THE OBSERVATION SLIP TABLE.
        //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
        //FOR 0600Z
        $sqlquery1=$this->DbHandler->selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTable($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"0600Z");  //value,field,table
        if ($sqlquery1) {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = $sqlquery1;
        } else {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query1=$this->DbHandler->selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTable($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"1200Z");  //value,field,table
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
 
        $data['regions'] = $this->DbHandler->RegionsModel();
        $this->load->view('dekadalReport',$data);

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
