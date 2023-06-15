<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class YearlyRainfallReport extends CI_Controller {

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
        $this->load->view('yearlyRainfallReport',$data);

    }
    public function displayyearlyrainfallreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $year = $this->input->post('year');
        $region = $this->input->post('RegionName');
        //$month = $this->input->post('month');
        //$region = $this->input->post('RegionName');

        if($userrole=='Manager' ||$userrole=='ManagerData' || $userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer' || $userrole=="ManagerStationNetworks" || $userrole=="Director" || $userrole == 'WeatherAnalyst'){
                        $stationNumber =  $this->input->post('stationNoManager');
                        $stationName =  $this->DbHandler->getStationName($stationNumber);
                         $blocknumber =  $this->DbHandler->getBlocknumber($stationNumber);


        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster'){
            
            $stationNumber = $this->input->post('stationNoOC');
            $stationName =  $this->DbHandler->getStationName($stationNumber);
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
            'year'=>$year, 'region' => $region,'blocknumber'=>$blocknumber);


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

            $data['rainforfirstoffeb']=$this->DbHandler->RainfallOfFirstNextMonth('02',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofmarch']=$this->DbHandler->RainfallOfFirstNextMonth('03',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofapril']=$this->DbHandler->RainfallOfFirstNextMonth('04',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofmay']=$this->DbHandler->RainfallOfFirstNextMonth('05',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofjune']=$this->DbHandler->RainfallOfFirstNextMonth('06',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofjuly']=$this->DbHandler->RainfallOfFirstNextMonth('07',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofaugust']=$this->DbHandler->RainfallOfFirstNextMonth('08',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofseptember']=$this->DbHandler->RainfallOfFirstNextMonth('09',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofoctober']=$this->DbHandler->RainfallOfFirstNextMonth('10',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofnovember']=$this->DbHandler->RainfallOfFirstNextMonth('11',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofdecember']=$this->DbHandler->RainfallOfFirstNextMonth('12',$year,$stationName,$stationNumber,'observationslip',"06:00Z");
            $data['rainforfirstofjanuary']=$this->DbHandler->RainfallOfFirstNextMonth('01',($year+1),$stationName,$stationNumber,'observationslip',"06:00Z");
       
            $data['regions'] = $this->DbHandler->RegionsModel();
            $this->load->view('yearlyRainfallReport',$data);

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
}
