<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WeatherSummaryReport extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(E_PARSE);
        $this->load->model('DbHandler');
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

        $this->load->view('weatherSummaryReport',$data);
    }
    public function displayweathersummaryreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $region = $this->input->post('RegionName');

        if($userrole=='Manager' || $userrole=='ManagerData' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole == 'WeatherAnalyst' || $userrole=="ManagerStationNetworks"){
            $stationNumber =  $this->input->post('stationNoManager');
        $stationName =  $this->DbHandler->getStationName($stationNumber);
          $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);


        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster' ){
            $stationNumber = $this->input->post('stationNoOC');
            $stationName =  $this->DbHandler->getStationName($stationNumber);
              $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);

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
            "Select * from submitted_reports where report_type='weathersummary' 
            and month='$month' and year='$year' and station='$station_id'");
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
        $data['displayWeatherSummaryReportHeaderFields'] = array('stationName'=>$stationName,'blocknumber'=>$blocknumber,'stationNumber'=>$stationNumber,
            'year'=>$year,'monthInWords'=>$month,'monthAsANumberselected'=>$monthAsANumberselected, 'region' => $region);




        /////Get Data From the OS TABLE,METAR TABLE,MORE FORM FIELDS FORM TABLE TO DISPLAY THE WEATHER SUMMARY FORM.
        //FROM OS TABLE NID DATA FOR 0600Z AND 1200Z.
        //FOR 0600Z
        $sqlquery1=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip','06:00Z');  //value,field,table
        if ($sqlquery1) {
            $data['observationslipdataforAMonthAndTime0600Z'] = $sqlquery1;
        } else {
            $data['observationslipdataforAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query1=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFromObservationSlipTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"12:00Z");  //value,field,table
        if ($query1) {
            $data['observationslipdataforAMonthAndTime1200Z'] = $query1;
        } else {
            $data['observationslipdataforAMonthAndTime1200Z'] = array();
        }

         //FROM MORE FORM FIELDS TABLE NID DATA FOR 0600Z AND 1200Z.
        //FOR 0600Z
        $sqlquery2=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"06:00Z");  //value,field,table
        if ($sqlquery2) {
            $data['moreformfieldsdatatable_forAMonthAndTime0600Z'] = $sqlquery2;
        } else {
            $data['moreformfieldsdatatable_forAMonthAndTime0600Z'] = array();
        }

        /////FOR 1200Z
        $query2=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTable($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip',"12:00Z");  //value,field,table
        if ($query2) {
            $data['moreformfieldsdatatable_forAMonthAndTime1200Z'] = $query2;
        } else {
            $data['moreformfieldsdatatable_forAMonthAndTime1200Z'] = array();
        }

        //////////////////////////

        //   $query3=$this->DbHandler->selectWeatherSummaryDataReportForAMonthFrom_MoreForm($monthAsANumberselected,$year,$stationName,$stationNumber,'observationslip');  //value,field,table
        // if ($query3) {
        //     $data['formfieldsdatatable_forAMonthAndTime'] = $query3;
        // } else {
        //     $data['formfieldsdatatable_forAMonthAndTime'] = array();
        // }
//////////////////////////////////////////////



        //nid to load the stations again
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
        $this->load->view('weatherSummaryReport',$data);

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
                    $this->session->set_flashdata('success', 'Report sent to Data manager successfully!');
                    
                }
                else{
                    $this->session->set_flashdata('error', '"Sorry, we encountered an issue sending the report! ');
                    
                }


}

public function submitted_reports($id=NULL)
{
    if(strcmp($id,"metar")==0){
        $data['allsubmittedmetar']=$this->DbHandler->allsubmittedreports($id);
    }else{
        $data['allsubmittedobservationreports']=$this->DbHandler->allsubmittedreports($id);
    }
    $this->load->view('submitted_reports',$data);
}
}
