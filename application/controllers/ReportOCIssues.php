<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportOCIssues extends CI_Controller {

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

        $this->load->view('ReportOCIssues',$data);
    }
    public function sendData(){
        $date=$this->input->post('date');

        $time=$this->input->post('time');
        $month=$this->input->post('month');
        $year=$this->input->post('year');
        $datefrom=$this->input->post('datefrom');
      $dateto=$this->input->post('dateto');
        $stationName=$this->input->post('stationName');
        $stationNumber=$this->input->post('stationNumber');
        $reporttype=$this->input->post('reporttype');
        $stationId=$this->DbHandler->identifyStationById($stationName,$stationNumber);
        $data['OCdata'] = array(
            'date' => $date,
            'time' => $time,
            'datefrom' => $datefrom,
            'dateto' => $dateto,
            'month' => $month,
            'year' => $year,
            'stationNumber' => $stationNumber,
            'stationName' => $stationName,
            'stationId' => $stationId,
            'reporttype' => $reporttype

        );
        $this->load->view('ReportOCIssues',$data);

    }
public function reportOCIssues(){
      $date=$this->input->post('date');
      $time=$this->input->post('Time');
      $datefrom=$this->input->post('datefrom');
      $dateto=$this->input->post('dateto');
      $year=$this->input->post('year');
      $month= $this->input->post('month');
      $stationName=$this->input->post('stationOC');
      $stationNumber=$this->input->post('stationNoOC');
      $reporttype=$this->input->post('reporttype');
      $issue =    $this ->input->post('issue');
      //$stationId =    $this ->input->post('page');
      $stationId=$this->DbHandler->identifyStationById($stationName,$stationNumber);
      //fetch data of oc of  the station
      $ocData= $this->DbHandler->selectByIdOC($stationId,"station","systemusers");
       if($reporttype=='metaReport'){
           $report='Metar report';
       }else if($reporttype=='observationslip'){
        $report='observationSlip report';
        }else if($reporttype=='weathersummaryreport'){
        $report='Weather summary report';
       }else if($reporttype=='dekadalReport'){
        $report='Dekadal report';
       }else if($reporttype=='synopticReport'){
        $report='Synoptic report';
       }else if($reporttype=='monthlyrainfallreport'){
        $report='Monthly rainfall report';
       }else if($reporttype=='anualrainfallreport'){
        $report='Annual rainfall report';
       }
      
    if($ocData!=NULL){
        $issue_footer='<a href="http://www.wimea.mak.ac.ug/wdr/">Click here to login!</a>'.
        ' Thank You '.'<b></br><b></br>'.'WIMEA-ICT';
      foreach ($ocData as $row ) {
        if($reporttype=='metaReport'||$reporttype=='synopticReport'){
         $issue_note='Hello'.' '.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
         '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
         'that'.' '. $report .' which was recorded on '.$date.' has the following issue(s):</p><p>'. $issue.'</p><p>  '.
 
         ' </p><br></br>';

        $htmlmessage = $issue_note.$issue_footer;
        
        }else if($reporttype=='observationslip'){
            
            $issue_note= 'Hello'.' '.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
        '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
        'that'.' '. $report .' '.'which was recorded on '.$date.' at '.$time.' has the following issue(s):</p><p>'. $issue.'</p><p>  '.

        ' </p><br></br>';
        $htmlmessage = $issue_note.$issue_footer;
        }else if($reporttype=='weathersummaryreport' || $reporttype=='monthlyrainfallreport'){
            $issue_note = 'Hello'.' '.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
        '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
        'that'.' '. $report .' '.'which was recorded in '.$month.' '.'of the year '.$year.' has the following issue(s):</p><p>'. $issue.'</p><p>  '.

        ' </p><br></br>';
        $htmlmessage = $issue_note.$issue_footer;
        }else if($reporttype=='dekadalReport'){
            $issue_note= 'Hello'.' '.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
            '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
            'that'.' '. $report .' '.'which was recorded from '.$datefrom.' '.'to '.$dateto.' has the following issue(s):</p><p>'. $issue.'</p><p>  '.
    
            ' </p><br></br>';   
            $htmlmessage = $issue_note.$issue_footer;
        }else if($reporttype=='anualrainfallreport'){
            $issue_note= 'Hello'.' '.$row->SurName.' '.$row->FirstName.'<br></br><br></br>'.
            '<p>Your  kindly informed as the OC of station '.$stationName.'('.$stationNumber.') '.
            'that'.' '. $report .' '. 'of the year '.$year.' has the following issue(s):</p><p>'. $issue.'</p><p>  ';
    
            ' </p><br></br>';  
            $htmlmessage = $issue_note.$issue_footer;
        }
        $session_data = $this->session->userdata('logged_in');
        $uid=$session_data['Userid'];
        $dataid= strtoupper(date("ymdhisa").$stationId.$row->Userid.$uid);
        $insert_speci=array(
            'note_id'=>$dataid,
            'station_id'=>$stationId,
            'note_type'=>'issue',
            'issue'=> $issue_note,
            'issue_to'=>$row->Userid
          );
          $insertspecinotificat=$this->DbHandler->insertData($insert_speci,'speci_notification');

        $session_data = $this->session->userdata('logged_in');
        $send_mail=$session_data['send_mail'];
        if($send_mail=="True"){
            $result = $this->sendMail($htmlmessage,$row->UserEmail);
            if($result == 1){
                $continue;
            }
            else{
                $result = $this->sendMail($htmlmessage,$row->UserEmail);
            }
       } 
 
     }
     $session_data = $this->session->userdata('logged_in');
     $userrole=$session_data['UserRole'];
     $userstation=$session_data['UserStation'];
     $userstationNo=$session_data['StationNumber'];
     $name=$session_data['FirstName'].' '.$session_data['SurName'];
     $this->session->set_flashdata('issuesent',"Issue reported sucessfully");
     $this->index();
     $notify='Issue reported sucessfully';
     if($reporttype=='metaReport'){
        redirect(base_url()."index.php/ReportsController/initializeMetarReport");
    }else if($reporttype=='observationslip'){
        redirect(base_url()."index.php/ReportsController/initialiseObservationSlipReport");
     }else if($reporttype=='weathersummaryreport'){
        redirect(base_url()."index.php/ReportsController/initializeWeatherSummnaryReport",'refresh');

    }else if($reporttype=='dekadalReport'){
        redirect(base_url()."index.php/ReportsController/initializeDekadalReport");
    }else if($reporttype=='synopticReport'){
        redirect(base_url()."index.php/ReportsController/initializeSynopticReport");
    }else if($reporttype=='monthlyrainfallreport'){
        redirect(base_url()."index.php/ReportsController/initializeMonthlyRainfallReport");
    }else if($reporttype=='anualrainfallreport'){
        redirect(base_url()."index.php/ReportsController/initializeRainfallYearlyReport");
    }
    }


}

        // $data=$this->session->set_flashdata('success', 'Issue report Email sent to OC!');
        //   $this->load->view('observationSlipReport' );


public function  sendMail($htmlmsgbody,$msgreceiver)
{
       // $this->unsetflashdatainfo();
    $this->load->library('email');

    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.gmail.com';
    $config['smtp_port'] = '465';
        $config['smtp_user'] = 'wimeaictwdr@gmail.com';  //change it
        $config['smtp_pass'] = '1c7wimearepo.'; //change it
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';


        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $this->email->from('wimeaictwdr@gmail.com','WIMEA-ICT');   //change it
        $this->email->to($msgreceiver);       //change it
        $this->email->subject("ALERT REPORT ISSUES");
        $this->email->message($htmlmsgbody);
        //$return = "";
        if($this->email->send()) {  
           return  1;  
          // return $return; 
         // redirect(base_url()."index.php/UserLogin/showdashboardInfo");
      } 
      else {
        return 0;
       // return $return;
    }
        // if ($this->email->send()) {
        //return  'success';
        //    $data['success'] = 1;
        // return true;
        // } else {
        //   $data['success'] = 0;
        //   $data['error']= $this->email->print_debugger(array('headers'));
        //return false;
        //}
        //   echo "<pre>";
        //   print_r($data);
        //  echo "</pre>";

}
function reported_issue($id=NULL){
    $this->load->helper(array('form', 'url'));

     $query = $this->DbHandler->issue_record($id);
     //  var_dump($query);
     if ($query) {
         $data['issue'] = $query;
         $this->load->view('issue', $data);
     } else {
        header('location:'.base_url(''));
     }
}

}