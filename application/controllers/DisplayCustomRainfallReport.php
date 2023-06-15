<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayCustomRainfallReport extends CI_Controller {

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
        $data['regions']=$this->DbHandler->RegionsModel();
        $this->load->view('CustomRainfallReport',$data);

    }
   public function DisplayCustomTemperatureReport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
         if( $userrole=="ManagerData" || $userrole=='Manager' || $userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer" || $userrole == 'WeatherAnalyst' ){
            $stationNumber =  $this->input->post('stationNo');
            $station = $this->DbHandler->getStationName($stationNumber);
            $region = $this->input->post('region');

        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster' ){
            $station = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }
         
         //$station = $this->input->post('station');
         // $region = $this->input->post('region');
         // $stationNumber =  $this->input->post('stationNo');
         // $station = $this->DbHandler->getStationName($stationNumber);
         $dateFrom = $this->input->post('from');
         $dateTo = $this->input->post('to');
          
         $time1 = $this->input->post('StartTime');
         $time2 = $this->input->post('EndTime');

         $timeX =  rtrim($time1,'Z');
         $time_final1 = preg_replace('/\s+/', '', $timeY);
        $time_actual1 = strtotime($time_final1);
        $available_time1 = date("h:i",$time_actual1)."Z";


        $timeY =  rtrim($time2,'Z');
         $time_final2 = preg_replace('/\s+/', '', $timeY);
        $time_actual2 = strtotime($time_final2);
        $available_time2 = date("h:i",$time_actual2)."Z";
          
      
         $data['noTempData'] = array('region' => $region, 'station' => $station,'stationNumber'=>$stationNumber,
            'to'=>$dateTo,'from'=>$dateFrom,'time1' => $available_time1,'time2' => $available_time2);

          if(($time1 !="" && $time2 !="") && ($time1!="00:00" && $time2!="00:00")){
           $start_time = "".$time1."Z";
           $end_time = "".$time2."Z";

           $query = $this->DbHandler->selectCustomisedTemperatureWithTime($region, $station, $stationNumber, $dateFrom, $dateTo, $time1, $time2);
                    }
       else{
        $query = $this->DbHandler->selectCustomisedTemperature($region, $station, $stationNumber, $dateFrom, $dateTo);

           

       }
               
          //value,field,table
        //  var_dump($query);
        //exit("am here".$stationNumber);
        if ($query) {
            
            $data['tempdata'] = $query;
        } else {
            $data['tempdata'] = array();
            
        }
        $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }

        $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('CustomTemperatureReport',$data);

    }





    public function displaycustomrainfallreport(){
        $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
         if( $userrole=="ManagerData" || $userrole=='Manager' || $userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer" || $userrole == 'WeatherAnalyst' ){
            $stationNumber =  $this->input->post('stationNo');
            $station = $this->DbHandler->getStationName($stationNumber);
            $region = $this->input->post('RegionName');

        }elseif($userrole=='Senior Weather Observer' || $userrole=='WeatherForecaster' ){
            $station = $this->input->post('stationOC');
            $stationNumber = $this->input->post('stationNoOC');

        }
        
         //$station =  $this->input->post('station');
        
        // $station = $this->DbHandler->getStationName($stationNumber);
         $dateFrom = $this->input->post('from');
         $dateTo = $this->input->post('to');
         $time1 = $this->input->post('StartTime');
         $time2 = $this->input->post('EndTime');

         $timeX =  rtrim($time1,'Z');
         $time_final1 = preg_replace('/\s+/', '', $timeY);
        $time_actual1 = strtotime($time_final1);
        $available_time1 = date("h:i",$time_actual1)."Z";


        $timeY =  rtrim($time2,'Z');
         $time_final2 = preg_replace('/\s+/', '', $timeY);
        $time_actual2 = strtotime($time_final2);
        $available_time2 = date("h:i",$time_actual2)."Z";
          
      
         $data['noRainfallData'] = array('region' => $region, 'station' => $station,'stationNumber'=>$stationNumber,
            'to'=>$dateTo,'from'=>$dateFrom,'time1' => $available_time1,'time2' =>$available_time2);

          if(($time1 !="" && $time2 !="") && ($time1!="00:00" && $time2!="00:00")){
           $start_time = "".$time1."Z";
           $end_time = "".$time2."Z";
            $query = $this->DbHandler->selectCustomisedRainfallWithTime($region, $station, $stationNumber, $dateFrom, $dateTo, $time1, $time2); 
        }
       else{
            $query = $this->DbHandler->selectCustomisedRainfall($region, $station, $stationNumber, $dateFrom, $dateTo); 

       }
            
        //value,field,table
        //  var_dump($query);
        //exit("am here".$stationNumber);
        if ($query) {
            
            $data['Rainfalldata'] = $query;
        } else {
            $data['Rainfalldata'] = array();
            
            //exit("am not");
        }
         //$userstation=$session_data['UserStation'];

        //Get all Stations.
         $this->DbHandler->selectAllFromSystemData($userstation,'StationName','stations');  //
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }
        $data['regions']=$this->DbHandler->selectStations();
        $this->load->view('CustomRainfallReport',$data);

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
