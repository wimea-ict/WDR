<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AWSDekadalReport extends CI_Controller {

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
        $query = $this->DbHandler->selectAllFromSystemData2($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        $data['regions'] = $this->DbHandler->RegionsModel();
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        //View the dekadal form.
        $this->load->view('AWSdekadalReport',$data);

    }
    public function displaydekadalreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='Manager'|| $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            $stationName =  $this->input->post('stationManager');
            $stationNumber =  $this->input->post('stationNoManager');

        }elseif($userrole=='Senior Weather Observer'){
            $stationName = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

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
		$format='Y-m-d';
	   $arrayt = array();
		$interval = new DateInterval('P1D');
		$realEnd = new DateTime($todate);
		$realEnd->add($interval);
		$period = new DatePeriod(new DateTime($fromdate),$interval,$realEnd);
		foreach($period as $date){
			$arrayt[] = $date->format($format);
			//echo "".$date->format($format);
		}
		

		//var_dump($arrayt);
		//exit(0);

        // $name='displayDekadalReportHeaderFields';
        $data['displayDekadalReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'FromDate'=>$fromdate,'ToDate'=>$todate,'monthAsANumberselected'=>$monthAsANumberselected,'year'=>$year
        );

        //GET DATA FROM THE OBSERVATION SLIP TABLE.
        //FIRST FOR 0600Z(9.00 AM) THEN 1200Z(3.00PM)
        //FOR 0600Z
		foreach($arrayt as $fromdat){
        $sqlquery1=$this->DbHandler->selectAWSDekadalDataReport($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'TwoMeterNode',"09:00");  //value,field,table
        $sqlquery2=$this->DbHandler->selectAWSDekadalDataReport($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'TenMeterNode',"09:00");  //value,field,table
		$sqlquery3=$this->DbHandler->selectAWSDekadalDataReport($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'GroundNode',"09:00");  //value,field,table
		
		$sqlquery4=$this->DbHandler->selectAWSDekadalDataReport($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'TwoMeterNode',"03:00");  //value,field,table
        $sqlquery5=$this->DbHandler->selectAWSDekadalDataReport($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'TenMeterNode',"03:00");  //value,field,table
		$sqlquery6=$this->DbHandler->selectAWSDekadalDataReport($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'GroundNode',"03:00");  //value,field,table
		
		
		}
		//var_dump($sqlquery1); 
//print_r(  $sqlquery1);
//print_r(  $sqlquery2);
//exit(0);    
	   if ($sqlquery1) {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = $sqlquery1;
        } else {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query1=$this->DbHandler->selectAWSDekadalDataReport($fromdate,$todate,$monthAsANumberselected,$year,$stationName,$stationNumber,'GroundNode',"1200Z");  //value,field,table
        if ($query1) {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z'] = $query1;
        } else {
            $data['DekadalReportDataFromobservationslipTableforAGivenRangeInAMonthAndTime1200Z'] = array();
        }

        //Nid to load the stations again
        $userstation=$session_data['UserStation'];
        $query = $this->DbHandler->selectAllFromSystemData2($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }


        $this->load->view('AWSdekadalReport',$data);

    }
	public function getDateRange($start,$end,$format='Y-m-d'){
		$array = array();
		$interval = new DateInterval('P1D');
		$realEnd = new DateTime($end);
		$realEnd->add($interval);
		$period = new DatePeriod(new DateTime($start),$interval,$realEnd);
		foreach($period as $date){
			$array[] = $date->format($format);
		}
		return $array;
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
