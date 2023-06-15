<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AWS2mDataController extends CI_Controller {

    function __construct() {

        parent::__construct();
        error_reporting(0);
        $this->load->model('DbHandler');
        $this->load->library('session');
        $this->load->library('pagination');
		$this->load->helper('url');
        $this->load->library('user_agent');
		 
      
      if(!$this->session->userdata('logged_in')){
	  $this->session->set_flashdata('warning', 'Sorry, your session has expired.Please login again.');
       redirect('/Welcome');
	  }
    }
   public function index(){
				  $session_data = $this->session->userdata('logged_in');
				  $userstation=$session_data['UserStation'];
                  //exit($userstation);
				  $from= $this->input->post('datefrom');
				  $to=$this->input->post('dateto');
				  $week=$this->input->post('week');
				  $data['recentFormdateDate'] = array('to' => $to,'from' => $from,'week' => $week);

			//if($from=="" || $from==NULL || $to=="" || $to==NULL){

			 // $to=  date("Y-m-d");
			  //$date=date_create($to);
			  //$intermideateDate=date_sub($date,date_interval_create_from_date_string("7 days"));
			  //$from=date_format($intermideateDate,"Y-m-d");

			//}

			$data['dateform_action'] = base_url()."index.php/AWS2mDataController/";
			/*if($this->uri->segment(3)){
			$page = ($this->uri->segment(3)) ;
			}
			else{
			$page = 1;
			}*/

		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );

        
        
        $query = $this->DbHandler->selectAllAWSData('TwoMeterNode',$from,$to);
          //var_dump($query);
        if ($query) {
            $data['observationslipformdata'] = $query;
			
        } else {
            $data['observationslipformdata'] = array();
			
        }

        $this->load->view('display2mData', $data);
    }
    public function showAws10mData(){
       // $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];
           
				   if($this->uri->segment(3)){
		$page = ($this->uri->segment(3)) ;
		}
		else{
		$page = 1;
		}
      $from= $this->input->post('datefrom');
        $to=$this->input->post('dateto');
        $week=$this->input->post('week');
        $data['recentFormdateDate'] = array('to' => $to,'from' => $from,'week' => $week);

       // if($from=="" || $from==NULL || $to=="" || $to==NULL){

          //$to=  date("Y-m-d");
          //$date=date_create($to);
          //$intermideateDate=date_sub($date,date_interval_create_from_date_string("7 days"));
          //$from=date_format($intermideateDate,"Y-m-d");

        //}

        $data['dateform_action'] = base_url()."index.php/AWSDataController/showAws10mData/";

       $query = $this->DbHandler->selectAll2conditions($userstation,'StationName','observationslip',"AWS","DeviceType",$from,$to);

        //  var_dump($query);
        if ($query) {
            $data['observationslipformdata'] = $query;
        } else {
			
            $data['observationslipformdata'] = array();
        }

        $this->load->view('observationSlipForm', $data);
    }
	  public function showAwsGndData(){
       // $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];
           
				   if($this->uri->segment(3)){
		$page = ($this->uri->segment(3)) ;
		}
		else{
		$page = 1;
		}
      $from= $this->input->post('datefrom');
        $to=$this->input->post('dateto');
        $week=$this->input->post('week');
        $data['recentFormdateDate'] = array('to' => $to,'from' => $from,'week' => $week);

       // if($from=="" || $from==NULL || $to=="" || $to==NULL){

          //$to=  date("Y-m-d");
          //$date=date_create($to);
          //$intermideateDate=date_sub($date,date_interval_create_from_date_string("7 days"));
          //$from=date_format($intermideateDate,"Y-m-d");

        //}

        $data['dateform_action'] = base_url()."index.php/AWSDataController/showAwsGndData/";

       $query = $this->DbHandler->selectAll2conditions($userstation,'StationName','observationslip',"AWS","DeviceType",$from,$to);

        //  var_dump($query);
        if ($query) {
            $data['observationslipformdata'] = $query;
        } else {
			
            $data['observationslipformdata'] = array();
        }

        $this->load->view('observationSlipForm', $data);
    }
	  public function showAws2mData(){
       // $this->unsetflashdatainfo();
        $session_data = $this->session->userdata('logged_in');
        $userstation=$session_data['UserStation'];
           
				   if($this->uri->segment(3)){
		$page = ($this->uri->segment(3)) ;
		}
		else{
		$page = 1;
		}
      $from= $this->input->post('datefrom');
        $to=$this->input->post('dateto');
        $week=$this->input->post('week');
        $data['recentFormdateDate'] = array('to' => $to,'from' => $from,'week' => $week);

       // if($from=="" || $from==NULL || $to=="" || $to==NULL){

          //$to=  date("Y-m-d");
          //$date=date_create($to);
          //$intermideateDate=date_sub($date,date_interval_create_from_date_string("7 days"));
          //$from=date_format($intermideateDate,"Y-m-d");

        //}

        $data['dateform_action'] = base_url()."index.php/AWSDataController/showAws2mData/";

       $query = $this->DbHandler->selectAll2conditions($userstation,'StationName','observationslip',"AWS","DeviceType",$from,$to);

        //  var_dump($query);
        if ($query) {
            $data['observationslipformdata'] = $query;
        } else {
			
            $data['observationslipformdata'] = array();
        }

        $this->load->view('observationSlipForm', $data);
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

?>
