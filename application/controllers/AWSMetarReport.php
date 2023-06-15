<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AWSMetarReport extends CI_Controller {

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

        $query = $this->DbHandler->selectAllFromSystemData2($userstation,'StationName','stations');  //value,field,table
        //  var_dump($query);
        $data['regions'] = $this->DbHandler->RegionsModel();
        if ($query) {
            $data['stationsdata'] = $query;
        } else {
            $data['stationsdata'] = array();
        }
        $this->load->view('AWSmetarReport',$data);
    }
    public function displaymetarreport(){
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        // $range = $this->input->post('range');

        $date = $this->input->post('date');
       $stationName = $this->input->post('stationManager');
        $stationNumber = $this->input->post('stationNoManager');

        $data['displayMetarReportHeaderFields'] = array('stationName'=>$stationName,'stationNumber'=>$stationNumber,
            'date'=>$date);

        //NID TO GET THE MONTH AND
       // $date ="2018-09-19";
		//$time ="14:00";
		$timearray = array('00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30',
                            '05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30',
                            '10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30',
                            '15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30',
                            '20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30');
							$queryData = array();
							//foreach($timearray as $time){
      
         $groundnodequery = $this->DbHandler->selectAWSMetarReport($stationName,"groundnode",$time,$date);
		 $tenmeternodequery = $this->DbHandler->selectAWSMetarReport($stationName,"tenmeternode",$time,$date);
		 $twometernodequery = $this->DbHandler->selectAWSMetarReport($stationName,"twometernode",$time,$date);  //value,field,table
		 $count = 0;
         $array_MetarReportData=array();	
				//var_dump($queryData);			
							//}
		
		if(!empty($groundnodequery) && !empty($tenmeternodequery) && !empty($twometernodequery)){
		foreach($timearray as $time){
		$time2 = date("H:i",strtotime($time)+(15*60));
		$time = date("H:i",strtotime($time));
		$array_MetarReportData[$count]["DTIME"] = $time;
		$array_MetarReportData[$count]["Date"] = $date;
		foreach($groundnodequery as $gndData)
		{ 
		
			if(date("H:i",strtotime($gndData->Time)-(3*60*60)) >= $time && date("H:i",strtotime($gndData->Time)-(3*60*60)) <= $time2){
		      $array_MetarReportData[$count]["Pressure"] = "";
			 // $array_MetarReportData[$count]["Pressure"] = "";
			 goto nextloop;
			 
			}
		}
		nextloop:
		foreach($tenmeternodequery as $tenData)
		{ 
		
			if(date("H:i",strtotime($tenData->Time)-(3*60*60)) >= $time && date("H:i",strtotime($tenData->Time)-(3*60*60))<= $time2){
			  $array_MetarReportData[$count]["V_A1"] = $tenData->V_A1;
			  $array_MetarReportData[$count]["V_A2"] = $tenData->V_A2;
			  $array_MetarReportData[$count]["P0_LST60"] = $tenData->P0_LST60;
			 // $array_MetarReportData[$count]["Pressure"] = "";
			 goto nextloop1;
			 
			}
		}
		nextloop1:
		foreach($twometernodequery as $twoData)
		{ 
		
			if(date("H:i",strtotime($twoData->Time)-(3*60*60)) >= $time && date("H:i",strtotime($twoData->Time)-(3*60*60)) <= $time2){
			  $array_MetarReportData[$count]["T_SHT2X"] = $twoData->T_SHT2X;
			  $array_MetarReportData[$count]["RH_SHT2X"] = $twoData->RH_SHT2X;
			 // $array_MetarReportData[$count]["P0_LST60"] = $twoData->P0_LST60;
			 // $array_MetarReportData[$count]["Pressure"] = "";
			 goto nextloop2;
			 
			}
		}
		nextloop2:
		$count++;
			}
		}
							//print_r($array_MetarReportData);
							//exit();
			

         if ($array_MetarReportData) {
           $data['metarreportdataforADayFromObservationSlipTable'] = $array_MetarReportData;
          } else {
            $data['metarreportdataforADayFromObservationSlipTable'] = array();
          }

         $data['regions']=$this->DbHandler->selectStations();

        $this->load->view('AWSmetarReport',$data);
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
