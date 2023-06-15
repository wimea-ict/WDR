<?php
class DbHandler extends CI_Model {

    function __construct() {
        parent::__construct();
         $this->db2 = $this->load->database('second', TRUE);

    }
    function getmanager(){
        $this->db->select('*');
        $this->db->where('UserRole', 'Manager'); 
        $this->db->or_where('UserRole', 'ManagerData');
        $q = $this->db->get('systemusers');
        return $q;
      }

  //////////////////////////
      public function selectAllAWSData($tablename,$lowerLimit,$upperLimit,$field){ //$stationame ,field StationName
                    $this->db2->select('*');
                    $this->db2->from($tablename.' as slip');
                    $this->db2->join('stations as stationsdata', 'slip.stationID= stationsdata.station_id');

                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];
                     //$this->db2->where('stationsdata.'.$field);
                    //$lowerLimit=$total_row-($NoOfRecords*$pageNo);
                    //$upperLimit=$lowerLimit+$NoOfRecords;
                    //$this->db->where('stationsdata.StationName', $stationName);
                      if($lowerLimit!=NULL || $upperLimit!=NULL){
                    $this->db2->where("slip.RTC_T >", $lowerLimit);
                    $this->db2->where("slip.RTC_T <=", $upperLimit);
            }
                    /*if($userrole=='Manager' || $userrole=='ManagerData'){

                    }elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){

                     }elseif($userrole=='Senior Weather Observer' ){
                        $this->db->where('stationsdata.'.$field, $value); //field is StationName
                        //$this->db->where('stationsdata.'.$field, $value);
                    }elseif( $userrole=='Observer' || $userrole=='ObserverDataEntrant' || $userrole=='ObserverArchive'){
                        $this->db->where('stationsdata.'.$field, $value);

                    }*/
                     
             $this->db2->order_by("slip.id", "desc"); 
          
                   $NoOfRecords = 500;
                    $this->db2->limit($NoOfRecords);
                    // Run the query
                    $query = $this->db2->get();
                    if($query -> num_rows() > 0)
                    {
                        $result = $query->result();
            //$query -> result_array();
                        return $result;
                    }
                    else
                    {
                        //$results = $query->result();
            
                        return false;
                    }
                }

    ////////////////////////////
      public function selectAWSMetarReport($stationName,$tablename,$time,$day){
       $time2 = date("H:i",strtotime($time)+(5*60));
       $time = date("H:i",strtotime($time));
       if($tablename ="GroundNode"){
       $sql ="SELECT DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) as Date,TIME(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) as Time  FROM $tablename WHERE  DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) = '".$day."'   order by RTC_T desc";
       }elseif($tablename ="TwoMeterNode"){
      $sql ="SELECT DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) as Date,TIME(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) as Time ,T_SHT2X  ,RH_SHT2X FROM $tablename WHERE  DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) = '".$day."'   order by RTC_T desc";
       }elseif($tablename ="TenMeterNode"){
     $sql ="SELECT DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) as Date,TIME(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) as Time ,V_A1,V_A2 ,P0_LST60 as speed FROM $tablename WHERE  DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) = '".$day."'  order by RTC_T desc";
       }
     
     //$query = $this->db->query("SELECT * FROM groundnode WHERE TIME(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) > '"+ $time+"' AND TIME(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) < '" + date("H:i",strtotime($time)+(5*60))+ "' and DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) = '2018-09-19'");
          $query = $this->db2->query($sql);
    
        if($query -> num_rows() > 0)
        {
            $result = $query->result(); 
      //print_r($result);
      //$query -> result_array();
            return $result;
            //return $query->result();
      
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }
    ///////////////////////////
    public function selectAWSDekadalDataReport($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename,$time){
       
    if($tablename=="GroundNode"){
    $sql="SELECT SUM(P0_LST60) AS Rainfall FROM $tablename WHERE DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) = '".$fromdate."' ";
      // $this->db2->select('SUM(P0_LST60) AS Rainfall',FALSE);
      // $this->db2->from($tablename.' as report');
      // $this->db2->join('stations as stationsdata', 'report.station = stationsdata.station_id');
      // $this->db2->where('report.DATE(STR_TO_DATE(RTC_T,%Y-%m-%d,%H:%i))', $fromdate);
      // $this->db2->where('stationsdata.StationName', $stationName);
      // $this->db2->where('stationsdata.StationNumber', $stationNumber);
      // $this->db2->order_by('repot.RTC_T','desc');

          
    }else{
    $sql="SELECT * FROM $tablename WHERE DATE(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i')) = '".$fromdate."' and TIME(STR_TO_DATE(RTC_T,'%Y-%m-%d,%H:%i'))<=  '".$time."' order by RTC_T desc limit 1";
      // $this->db2->select('*');
      // $this->db2->from($tablename.' as report');
      // $this->db2->join('stations as stationsdata', 'report.station = stationsdata.station_id');
      // $this->db2->where('report.DATE(STR_TO_DATE(RTC_T,%Y-%m-%d,%H:%i))', $fromdate);
      //  $this->db2->where('report.TIME(STR_TO_DATE(RTC_T,%Y-%m-%d,%H:%i)) <=', $time);
      // $this->db2->where('stationsdata.StationName', $stationName);
      // $this->db2->where('stationsdata.StationNumber', $stationNumber);
      // $this->db2->order_by('repot.RTC_T','desc');   
    }
    $query = $this->db2->query($sql);
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //var_dump($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    //////////////////////////
      //////////////////////////
     public function selectAllFromSystemData2($value, $field,$tablename,$id_to_use){ //$stationame ,field StationName
      $session_data = $this->session->userdata('logged_in');
      $userrole=$session_data['UserRole'];
      $userid=$session_data['Userid'];
      $region =$this->SelectZonal($userid);
      if($tablename=="stations"){

        $this->db2->select('*');
        $this->db2->from($tablename );
         //$this->db->join('systemusers as data', 'stations.station_id = data.station','left');
    //$this->db->where('Active','1');
        
        if($userrole=='ManagerData' || $userrole=='Manager'){
            $this->db2->where('StationStatus','on');
            $this->db2->where_not_in('station_id','0');
        }elseif($userrole=="ManagerStationNetworks"){
            $this->db2->where_not_in('station_id','0');

        }
        elseif($userrole=='ZonalOfficer' || $userrole=="SeniorZonalOfficer"  || $userrole=="Director" ){
          $this->db2->where('StationStatus','on');
          $this->db2->where('StationRegion', $region);

      }elseif($userrole=='Senior Weather Observer' ){
        $this->db2->where('StationStatus','on');
        $this->db2->where_not_in('station_id','0');
    }

    $this->db2->order_by("station_id", "desc");
}else{
    $this->db2->select('*');
    $this->db2->from($tablename.' as tab');//select from userlogs
    $this->db2->join('stations as stationsdata', 'tab.stationID= stationsdata.station_id');
    $this->db2->where_not_in('tab.stationID','0');
    if($tablename=='stations' ){
        $this->db2->where('tab.'.$field, $value);
    }else{
        $this->db2->where('stationsdata.'.$field, $value);
    }
   
    //$this->db->join('data_tracking as tracking','tracking.modified = tab.Date');
    //$this->db->where('tracking.modifiedBy','tab.Userid');
    
    $this->db2->order_by("tab.id", "desc");
}
              // Run the query
$query = $this->db2->get();
if($query -> num_rows() > 0)
{

                    $result = $query->result();  //$query -> result_array();
                    return $result;
                    //return $query->result();
                }
                else
                {
                    //$results = $query->result();
                    return false;
                }
            }
            //jovRi
      //////////////////////////

      public function selectheightoflowestcloud1 ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            HeightOfLowClouds1 as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }


    /////////////////////////////

    //////////////////////////

      public function selectheightofmediumcloud1 ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            HeightOfMediumClouds1 as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }


    /////////////////////////////

    //////////////////////////

      public function selectheightofHighcloud1 ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            HeightOfHighClouds1 as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }


    /////////////////////////////

    //////////////////////////

      public function selectmaxread ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            Max_Read as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }


    /////////////////////////////

    //////////////////////////

      public function selectminread ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            Min_Read as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }


    /////////////////////////////

     //////////////////////////

      public function selectvisibility ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            Visibility as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
///////////////////////////////


    public function selectrainfall ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            Rainfall as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    /////////////////////////////



    ///////////////////////////////


    public function selectdrybulb ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            Dry_Bulb as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    /////////////////////////////

    ///////////////////////////////


    public function selectwetbulb ($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            Wet_Bulb as height',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    /////////////////////////////

    function control_mail(){
        $session_data = $this->session->userdata('logged_in');
            $send_mail=$session_data['send_mail'];
            if($send_mail=='True'){
                $send_mail='False';
            }else{
                $send_mail='True';
            }
            //$detailsData    =   $this->session->userdata('detailsData');
            $session_data['send_mail']= $send_mail;
            $this->session->set_userdata('logged_in', $session_data);
        $updatedata=array('send_mail'=>$send_mail);
        $this->db->update('systemusers',$updatedata);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
     }
     public function selectBymonthAndyear($month, $year, $tablename){  //$value, $field,$table
        $this->db->select('*');
          $this->db->from($tablename.' as tab');
          $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');
          $this->db->where('tab.month', $month);
          $this->db->where('tab.year', $year);
          $this->db->order_by('tab.Date', "asc");
        // Run the query
      $query = $this->db->get();
      if($query -> num_rows() > 0)
      {
            $result = $query->result();  //$query -> result_array();
            return $result;
        }
        else
        {
            return false;
        }
    }
     public function updateUserDetails($id, $data){

    $tablename = 'systemusers';
     $this->db->replace($tablename ,$data);
     if(!$this->db->affected_rows() == 0){
        return 1;
    }else{
        $error = $this->db->error(); 
        return $error;
     }
    
}
     function get_speci_id($date,$station_id,$timeobservationslip){
                    $this->db->select('*');
                    $this->db->from('observationslip');
                    $this->db->where('Date',$date);
                    $this->db->where('Station',$station_id);
                    $this->db->where('TIME',$timeobservationslip);
                    $this->db->where('DeviceType','web');
                    $row = $this->db->get()->row();
                    if (isset($row)) {
                        return $row->id;
                    } else {
                        return false;
                    }
                }
   public function speci_record($value, $field,$tablename,$value2, $field2,$lowerLimit,$upperLimit,$id){ //$stationame ,field StationName
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userid =$session_data['Userid'];
        $region =$this->SelectZonal($userid);
        $this->db->select('*');
        $this->db->from($tablename.' as slip');
        $this->db->where('slip.id', $id);
 
     $query = $this->db->get();
     if($query -> num_rows() > 0)
     { 
         if($userrole=='ManagerData')$column='viewedby_datamanager';
         if($userrole=='Senior Weather Observer')$column='viewedby_oc';
         if($userrole=='ZonalOfficer')$column='viewedby_zoneofficer';
        $q = $this->db->query("update speci_notification set speci_notification.".$column."="."True where speci_notification.note_id='".$this->db->escape_str($id)."'");
               $result = $query->result();  //$query -> result_array();
               return $result;
           }
           else
           {
               //$results = $query->result();
               return false;
           }
       }
    function getStationIdAndRegion($username, $password){

        $this->db->select('station,region_zone');
        $this->db->from('systemusers as user');
        $this->db->where('user.UserName', $username);
        $this->db->where('user.UserPassword', $password);
        $this->db->where('user.Active', 1);
        $this->db->order_by("user.userid", "desc");
        $this->db->limit(1);
        $query = $this->db->get();
        
        
        if($query -> num_rows() == 1)
        {
            foreach ($query->result() as $row){
                $result = $row->station;
               // $row->region_zone;exit();
            }

            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    function StationUsers($stationid){
      $this->db->select('*');
      $this->db->from('systemusers as user');
      $this->db->where('user.station', $stationid);
		//$this->db->where('user.Active', 1);
      $this->db->order_by("user.UserRole", "asc");
      $query = $this->db->get();

      if($query->num_rows() >0)
      {
        $result = $query->result();

        return $result;

    }
    else
    {
			 //exit("hmmmmmmmqewrt");
        return false;

    }
}
function getUserLogInDetails($username, $password,$res,$active) {
    $this->db->select('*');
    $this->db->from('systemusers as user');

    if($res && $res != 0){
        $this->db->join('stations as stationsdata', 'user.station = stationsdata.station_id');
    }else{
        $this->db->join('stations as stationsdata', 'user.region_zone = stationsdata.StationRegion','left');
    }

    $this->db->where('user.UserName', $username);
    $this->db->where('user.UserPassword', $password);
    if($active !=0){
        $this->db->where('user.Active', 1);
    }
    $this->db->order_by("user.userid", "desc");

    $this->db->limit(1);
        //$results = mysqli_query($con,
        //"SELECT systemusers.Userid,systemusers.FirstName,systemusers.SurName,systemusers.UserName, systemusers.UserEmail, systemusers.UserRole, systemusers.Active,systemusers.StationNumber,systemusers.UserStation,stations.Longitude ,stations.Latitude,stations.StationName  FROM systemusers,stations
        //WHERE (systemusers.UserName='".$userName."' ) AND systemusers.UserPassword='".$password."' AND systemusers.StationNumber=stations.StationNumber  LIMIT 1") or die('{"error":"Login error! Code: 003"}');
        // Run the query
    $query = $this->db->get();

    if($query -> num_rows() == 1)
    {
        $result = $query->result();
        return $result;
            //return $query->result();
    }
    else
    {
        return false;
    }

}
public function checkUserDetails($username, $email){
    $this->db->select('*');
    $this->db->from('systemusers');
    $this->db->where('UserName', $username);
    $this->db->where('UserEmail', $email);
    $this->db->order_by("Userid", "desc");
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
        $result = $query->result();
        return $result;
            //return $query->result();
    }
    else
    {
        return false;
    }
}
public function RegionsModel(){

 $this->db->select('StationRegion');
 $this->db->distinct('StationRegion');
 $this->db->from('stations');
 $query = $this->db->get();

 if($query -> num_rows() >0)
 {
    $result = $query->result();
            //exit("am here".$result->Date);
    return $result;
            //return $query->result();
}
else
{
             //exit("hmmmmmmmqewrt");
    return false;

}
}


public function getSpeciData($stationRegion,$station, $stationNo, $date1, $date2){

  $this->db->select('*');
  $this->db->from('observationslip as slip');
  $this->db->join('stations','slip.station= stations.station_id');
  $this->db->where('stations.StationRegion', $stationRegion);
  $this->db->where('stations.StationName', $station);
  $this->db->where('stations.StationNumber', $stationNo);
  $this->db->where('slip.speciormetar =', 'speci');
  $this->db->where('slip.Date >=', $date1);
  $this->db->where('slip.Date <=', $date2);
  $this->db->order_by("slip.Date", "desc");

        // Run the query
  $query = $this->db->get();

  if($query -> num_rows() >0)
  {
    $result = $query->result();
    return $result;
}
else
{
    return false;

}
}

public function getSpeciDataWithTimeSpecified($stationRegion,$station, $stationNo,$date1, $date2, $time1, $time2){


       $timeX1 =  rtrim($time1,'Z');
       $time_final1 = preg_replace('/\s+/', '', $timeX1);
        $time_actual1 = strtotime($time_final1);
        $available_time1 = date("h:i",$time_actual1)."Z"; 


        $timeX2 =  rtrim($time2,'Z');
       $time_final2 = preg_replace('/\s+/', '', $timeX2);
        $time_actual2 = strtotime($time_final2);
        $available_time2 = date("h:i",$time_actual2)."Z";

  $this->db->select('*');
  $this->db->from('observationslip as slip');
  $this->db->join('stations','slip.station= stations.station_id');
  $this->db->where('stations.StationRegion', $stationRegion);
  $this->db->where('stations.StationName', $station);
  $this->db->where('stations.StationNumber', $stationNo);
  $this->db->where('slip.speciormetar =', 'speci');
  $this->db->where('slip.Date >=', $date1);
  $this->db->where('slip.Date <=', $date2);
  $this->db->where('TIME_FORMAT(slip.TIME,"%h:%i") BETWEEN "'.$available_time1.'" AND "'.$available_time2.'"');
  $this->db->order_by("slip.Date", "desc");
        // Run the query
  $query = $this->db->get();

  if($query -> num_rows() >0)
  {
    $result = $query->result();
    return $result;
}
else
{
    return false;
    echo null;

}
}

public function getStationsHandler($region){
 $this->db->select('StationName');
 $this->db->from('stations');
 $this->db->where('StationRegion', $region);
 $query = $this->db->get();
 if($query -> num_rows() >0)
 {
    $result = $query->result();
            //exit("am here".$result->Date);
    return $result;
            //return $query->result();
}
else
{
             //exit("hmmmmmmmqewrt");
    return false;

}
}

public function getStationsId($station){
 $this->db->select('station_id');
 $this->db->from('stations');
 $this->db->where('StationName', $station);
 $query = $this->db->get();
 if($query -> num_rows() >0)
 {
    $result = $query->result();
            //exit("am here".$result->Date);
    return $result;
            //return $query->result();
}
else
{
             //exit("hmmmmmmmqewrt");
    return false;

}
}

public function selectCustomisedRainfall($stationRegion,$station, $stationNo, $dateFro, $dateTo){

  $this->db->select('*');
  $this->db->from('observationslip as slip');
  $this->db->join('stations as stationsdata','slip.station = stationsdata.station_id');
   if($userrole=="ManagerData" || $userrole=='Manager' || $userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer" || $userrole == 'WeatherAnalyst'){

            $this->db->where('stationsdata.StationName', $station);
            $this->db->where('stationsdata.StationNumber', $stationNo);
            $this->db->where('stationsdata.StationRegion', $stationRegion);

        }elseif($userrole=='Senior Weather Observer'){
            $this->db->where('stationsdata.StationName', $station);
            $this->db->where('stationsdata.StationNumber', $stationNo);

        }
 
  $this->db->where('slip.Date >=', $dateFro);
  $this->db->where('slip.Date <=', $dateTo);
  $this->db->order_by("slip.Date", "desc");
        // Run the query
  $query = $this->db->get();

  if($query -> num_rows() >0)
  {
    $result = $query->result();
    return $result;
}
else
{
    return false;

}
}

public function selectCustomisedRainfallWithTime($stationRegion,$station, $stationNo, $dateFro, $dateTo, $starttime, $endtime){

  $timeX1 =  rtrim($starttime,'Z');
       $time_final1 = preg_replace('/\s+/', '', $timeX1);
        $time_actual1 = strtotime($time_final1);
        $available_time1 = date("h:i",$time_actual1)."Z"; 


        $timeX2 =  rtrim($endtime,'Z');
       $time_final2 = preg_replace('/\s+/', '', $timeX2);
        $time_actual2 = strtotime($time_final2);
        $available_time2 = date("h:i",$time_actual2)."Z";


  $this->db->select('*');
  $this->db->from('observationslip as slip');
  $this->db->join('stations as stationsdata','slip.station= stationsdata.station_id');
   if($userrole=="ManagerData" || $userrole=='Manager' || $userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer" || $userrole == 'WeatherAnalyst'){

            $this->db->where('stationsdata.StationName', $station);
            $this->db->where('stationsdata.StationNumber', $stationNo);
            $this->db->where('stationsdata.StationRegion', $stationRegion);

        }elseif($userrole=='Senior Weather Observer'){
            $this->db->where('stationsdata.StationName', $station);
            $this->db->where('stationsdata.StationNumber', $stationNo);

        }
 
  $this->db->where('slip.Date >=', $dateFro);
  $this->db->where('slip.Date <=', $dateTo);
  $this->db->order_by("slip.Date", "desc");
  $this->db->where('TIME_FORMAT(slip.TIME,"%h:%i") BETWEEN "'.$available_time1.'" AND "'.$available_time2.'"');
    
  $query = $this->db->get();

  if($query -> num_rows() >0)
  {
    $result = $query->result();
            //exit("am here".$result->Date);
    return $result;
            //return $query->result();
}
else
{
             //exit("hmmmmmmmqewrt");
    return false;

}
}

public function selectCustomisedTemperature
($stationRegion,$station, $stationNumber, $dateFro, $dateTo){

    $this->db->select('*');
    $this->db->from('observationslip as slip');
    $this->db->join('stations as stationsdata','slip.station = stationsdata.station_id');
    if($userrole=="ManagerData" || $userrole=='Manager' || $userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer" || $userrole == 'WeatherAnalyst'){

            $this->db->where('stationsdata.StationName', $station);
            $this->db->where('stationsdata.StationNumber', $stationNo);
            $this->db->where('stationsdata.StationRegion', $stationRegion);

        }elseif($userrole=='Senior Weather Observer'){
            $this->db->where('stationsdata.StationName', $station);
            $this->db->where('stationsdata.StationNumber', $stationNo);

        }
 
    $this->db->where('slip.Date >=', $dateFro);
    $this->db->where('slip.Date <=', $dateTo);
    $this->db->order_by("slip.Date", "desc");
        // Run the query
    $query = $this->db->get();

    if($query -> num_rows() >0)
    {
        $result = $query->result();
        return $result;
    }
    else
    {
        return false;

    }
}

public function selectCustomisedTemperatureWithTime($stationRegion,$station, $stationNumber, $dateFro, $dateTo, $starttime, $endtime){

      $timeX1 =  rtrim($starttime,'Z');
       $time_final1 = preg_replace('/\s+/', '', $timeX1);
        $time_actual1 = strtotime($time_final1);
        $available_time1 = date("h:i",$time_actual1)."Z"; 


        $timeX2 =  rtrim($endtime,'Z');
       $time_final2 = preg_replace('/\s+/', '', $timeX2);
        $time_actual2 = strtotime($time_final2);
        $available_time2 = date("h:i",$time_actual2)."Z";
        
    $this->db->select('*');
    $this->db->from('observationslip as slip');
    $this->db->join('stations as stationsdata','slip.station = stationsdata.station_id');
     if($userrole=="ManagerData" || $userrole=='Manager' || $userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer" || $userrole == 'WeatherAnalyst'){

            $this->db->where('stationsdata.StationName', $station);
            $this->db->where('stationsdata.StationNumber', $stationNo);
            $this->db->where('stationsdata.StationRegion', $stationRegion);

        }elseif($userrole=='Senior Weather Observer'){
            $this->db->where('stationsdata.StationName', $station);
            $this->db->where('stationsdata.StationNumber', $stationNo);

        }
 
    $this->db->where('slip.Date >=', $dateFro);
    $this->db->where('slip.Date <=', $dateTo);
    $this->db->where('TIME_FORMAT(slip.TIME,"%h:%i") BETWEEN "'.$available_time1.'" AND "'.$available_time2.'"');

    $query = $this->db->get();

    if($query -> num_rows() >0)
    {
        $result = $query->result();
        return $result;
    }
    else
    {
        return false;

    }
}
public  function ResetUserPassword($data,$userid,$email,$username){
    $this->db->set($data);
    $this->db->where("Userid",$userid);

    if($email!= "" && $username!="" ){
        $this->db->where("UserName",$username);
        $this->db->where("UserEmail",$email);
        
    }
    else{

    }

    $this->db->update("systemusers", $data);

    if ($this->db->affected_rows() ==1)
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }

}
public  function  saveUserLogs($userlogsdata){
         $session_data = $this->session->userdata('logged_in');
         $userRegion=$session_data['UserRegion'];
         $UserSubRegion=$session_data['UserRegion'];
         $userstationId=$session_data['StationId'];
         $userlogsdata["users_region"]=$userRegion;
         $userlogsdata["users_subregion"]=$UserSubRegion;
         $userlogsdata["station_id"]=$userstationId;
        $this->db->insert("userlogs", $userlogsdata);  //userlogs is the table
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
// Count all record of table "contact_info" in database.
    public function record_count($field, $value) {
//return $this->db->count_all("observationslip");
        $this->db->select('*');
        $this->db->from('observationslip as slip');
        $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');
        $this->db->where('stationsdata.'.$field, $value);
        return $this->db->count_all_results();
    }
    public function record_count_webmobile($field, $value) {

      $this->db->select('*');
      $this->db->from('observationslip as slip');
      $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');
      $this->db->where('stationsdata.'.$field, $value);
      $this->db->where_not_in('slip.DeviceType', 'AWS');
      return $this->db->count_all_results();
  }
  public function record_count_aws($field, $value) {
      $this->db->select('*');
      $this->db->from('observationslip as slip');
      $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');
      $this->db->where('stationsdata.'.$field, $value);
      $this->db->where('slip.DeviceType', 'AWS');
      return $this->db->count_all_results();
  }

//jovRi
    public function selectAllSystemUsers($value, $field,$tablename,$createdby=NULL){ //field:UserStation value:StationName


     $this->db->select('*');
     $this->db->from($tablename.' as user');
     $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id','left');

     $session_data = $this->session->userdata('logged_in');
     $userrole=$session_data['UserRole'];
     $userid=$session_data['Userid'];
     $StationRegion=$session_data['UserRegion'];
     $UserSubRegion=$session_data['UserRegion'];
     $regions=explode(",",$StationRegion);
     $subregions=explode(",",$UserSubRegion);
     if($userrole=='Manager' || $userrole=='ManagerData'){
      
      }elseif($userrole=='Senior Weather Observer'){
            $this->db->where_not_in('user.UserRole', 'ManagerStationNetworks');
            $this->db->where('user.'.$field, $value);
            $this->db->where('user.Active', 1);
      }
        elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
            // $this->db->where('user.StationRegion', $StationRegion);
          if($userrole=='ZonalOfficer'){
            $this->db->where_in('user.UserRole', ['Observer','Senior Weather Observer']);
            if($subregions!=NULL)
              $this->db->where_in('user.region_zone', $subregions);
          }else{
           $this->db->where_in('user.UserRole', ['Observer','Senior Weather Observer','ZonalOfficer','SeniorZonalOfficer']);
           
          }
          $this->db->where_in('user.region_zone', $regions);
          $this->db->where('user.createby_ByID',$userid);
         // $this->db->where('user.Active', 1);
      }elseif($userrole=='ManagerStationNetworks') {
           $this->db->where('user.createby_ByID',$userid);

      }
        
        //$this->db->where_not_in('user.UserRole', 'ManagerData');
        $this->db->order_by("user.Userid", "desc");
        $query = $this->db->get();

        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }
//Check if something exists alredy in the DB.
    function check($value, $field, $table) {
        $query = $this->db->query('SELECT * FROM ' . $table . ' where ' . $field . '="' . $value . '"');

        if ($query->num_rows() > 0)
            return true;
        else
            return false;

    }

    //Get DB Results when an Manager select StationName the StationNumber should be picked from DB Automatically
    function getResults($value, $field, $table) {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field, $value);
      //  $this->db->order_by("id", "desc");
        //$this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
     //Get DB Results when an Manager select StationName the StationNumber should be picked from DB Automatically
    function getResults2($value, $field, $table) {
        $this->db2->select('*');
        $this->db2->from($table);
        $this->db2->where($field, $value);
      //  $this->db->order_by("id", "desc");
        //$this->db->limit(1);
        // Run the query
        $query = $this->db2->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfStationNameAndStationNumberRecordExistsAlready($stationName,$stationNumber,$stationLocation,$stationIndicator,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);

        $this->db->or_where('StationName', $stationName);
        $this->db->or_where('StationNumber', $stationNumber);
        $this->db->or_where('Location', $stationLocation);
        $this->db->or_where('Indicator', $stationIndicator);

        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }

    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfStationInstrumentCodeInformationRecordExistsAlready($instrumentname,$stationinstrumentcode,$stationName,$stationNumber,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);

        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('InstrumentName', $instrumentname);
        $this->db->where('InstrumentCode', $stationinstrumentcode);


        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfStationElementMeasuredFromAnInstrumentInformationRecordExistsAlready($elementname,$instrumentnameelement,$stationName,$stationNumber,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);

        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->where('ElementName', $elementname);
        $this->db->where('InstrumentName', $instrumentnameelement);


        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfUserDetailsRecordExistsAlready($firstname,$surname,$email,$stationId,$userRole,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('FirstName', $firstname);
        $this->db->where('SurName', $surname);

        $this->db->where('station',$stationId);

        //$this->db->where('UserEmail', $email);
        $this->db->where('UserRole', $userRole);

        $this->db->order_by("Userid", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
//checkInDBIfUserDetailsRecordExistsAlreadyWithSameStationRegion  for ZonalOfficer and SenoirZonalOfficer
    function checkInDBIfUserDetailsRecordExistsAlreadyWithSameStationRegion($firstname,$surname,$email,$stationRegion,$tablename) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where('FirstName', $firstname);
        $this->db->where('SurName', $surname);
        $this->db->where('StationRegion', $stationRegion);
       // $this->db->where('StationNumber', $stationNumber);
        $this->db->where('UserEmail', $email);
        //$this->db->where('UserPhone', $phone);

        $this->db->order_by("Userid", "desc");
        $this->db->limit(1);
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
            return TRUE;
        }
        else
        {
            //$results = $query->result();
            return FALSE;
        }
    }
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
    function checkInDBIfObservationSlipFormRecordExistsAlready($date,$time,$stationName,$stationNumber,$tablename) {
        $this->db->select('station_id');
        $this->db->from('stations');
        
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->limit(1);
        $query = $this->db->get();
        if($query -> num_rows() >0){
          $result= $query->row();

          return $result;
      }else{
          return 0;
      }

      $this->db->select('*');
      $this->db->from($tablename);
      $this->db->where('DATE', $date);
      $this->db->where('StationName', $stationName);
      $this->db->where('StationNumber', $stationNumber);
      $this->db->where('TIME', $time);

      $this->db->order_by("id", "desc");
      $this->db->limit(1);
        // Run the query
      $query = $this->db->get();
      if($query -> num_rows() == 1)
      {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfMoreFormFieldsFormRecordExistsAlready($date,$time,$stationName,$stationNumber,$tablename) {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where('DATE', $date);
    $this->db->where('StationName', $stationName);
    $this->db->where('StationNumber', $stationNumber);
    $this->db->where('TIME', $time);

    $this->db->order_by("id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveMetarFormRecordExistsAlready($date,$stationName,$stationNumber,$time,$metarOption, $tablename) {
    $this->db->select('*');
    $this->db->from($tablename.' as tab');
    $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');

    $this->db->where('tab.DATE', $date);
    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);
    $this->db->where('tab.TIME', $time);
    $this->db->where('tab.METARSPECI', $metarOption);
    $this->db->order_by("tab.id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveSynopticFormReportRecordExistsAlready($date,$time,$stationName,$stationNumber,$tablename) {
    $this->db->select('*');
     $this->db->from($tablename.' as tab');
    $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');
    $this->db->where('tab.DATE', $date);
    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);
    $this->db->where('tab.TIME', $time);

    $this->db->order_by("tab.id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkIfArchiveDekadalFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber, $tablename) {
  $this->db->select('*');
  $this->db->from($tablename.' as tab');
  $this->db->join('stations as stationsdata', 'tab.station = stationsdata.station_id');

  $this->db->where('tab.DATE', $date);
  $this->db->where('stationsdata.StationName', $stationName);
  $this->db->where('stationsdata.StationNumber', $stationNumber);

  $this->db->order_by("tab.id", "desc");
  $this->db->limit(1);
        // Run the query
  $query = $this->db->get();
  if($query -> num_rows() == 1)
  {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
    return TRUE;
}
else
{
            //$results = $query->result();
    return FALSE;
}
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkIfArchiveWeatherSummaryFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber, $tablename) {
    $this->db->select('*');
     $this->db->from($tablename.' as tab');
    $this->db->join('stations as stationsdata', 'tab.station = stationsdata.station_id');
    $this->db->where('tab.DATE', $date);
    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);

    $this->db->order_by("tab.id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkIfArchiveMonthlyRainfallFormReportDetailsAlreadyExistInDB($date,$stationName,$stationNumber, $tablename) {
    $this->db->select('*');
     $this->db->from($tablename.' as tab');
    $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');
    $this->db->where('tab.DATE', $date);
    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);

    $this->db->order_by("tab.id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveScannedMetarFormDataCopyRecordExistsAlready($date,$stationName,$stationNumber, $tablename) {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where('DATE', $date);
    $this->db->where('StationName', $stationName);
    $this->db->where('StationNumber', $stationNumber);

    $this->db->order_by("id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveScannedSynopticFormDataReportCopyRecordExistsAlready($date,$stationName,$stationNumber, $tablename) {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where('DATE', $date);
    $this->db->where('StationName', $stationName);
    $this->db->where('StationNumber', $stationNumber);

    $this->db->order_by("id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveScannedObservationSlipFormDataCopyRecordExistsAlready($date,$time,$stationName,$stationNumber, $tablename) {
    $station = $this->identifyStationById($stationName,$stationNumber);

    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where('DATE', $date);
    $this->db->where('station', $station);

    $this->db->where('TIME', $time);

    $this->db->order_by("id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveScannedDekadalFormDataReportCopyRecordExistsAlready($fromdate,$todate,$stationName,$stationNumber, $tablename) {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where('FromDate', $fromdate);
    $this->db->where('ToDate', $todate);
    $this->db->where('StationName', $stationName);
    $this->db->where('StationNumber', $stationNumber);

    $this->db->order_by("id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveScannedWeatherSummaryFormDataReportCopyRecordExistsAlready($month,$year,$stationName,$stationNumber, $tablename) {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where('Month', $month);
    $this->db->where('Year', $year);
    $this->db->where('StationName', $stationName);
    $this->db->where('StationNumber', $stationNumber);

    $this->db->order_by("id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveScannedMonthlyRainfallFormDataReportCopyRecordExistsAlready($month,$year,$stationName,$stationNumber, $tablename) {
    $this->db->select('*');
    $this->db->from($tablename);
    $this->db->where('Month', $month);
    $this->db->where('Year', $year);
    $this->db->where('StationName', $stationName);
    $this->db->where('StationNumber', $stationNumber);

    $this->db->order_by("id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}
    //Check DB if the form being inserted exists(check against the date,stationName,StationNumber and Time)
function checkInDBIfArchiveScannedYearlyRainfallFormDataReportCopyRecordExistsAlready($year,$stationName,$stationNumber, $tablename) {
    $this->db->select('*');
    $this->db->from($tablename);
        //$this->db->where('Month', $month);
    $this->db->where('Year', $year);
    $this->db->where('StationName', $stationName);
    $this->db->where('StationNumber', $stationNumber);

    $this->db->order_by("id", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() == 1)
    {
            // $result = $query->result();  //$query -> result_array();
            //return $result;
        return TRUE;
    }
    else
    {
            //$results = $query->result();
        return FALSE;
    }
}

    //select field modified by user
public function SelectFieldsForUserUpdate(){
    $this->db->select('*');
    $this->db->from('data_tracking as tracking');
    $this->db->join('systemusers as user', 'tracking.modifiedBy= user.Userid');
    $this->db->order_by("tracking.id", "desc");

    $query = $this->db->get();
    if($query -> num_rows() > 0)
    {
                    $result = $query->result();  //$query -> result_array();
                    return $result;
                    //return $query->result();
                }
                else
                {
                    //$results = $query->result();
                    return false;
                }

            }
            public function SelectZonal($user){
                $this->db->select('region_zone');
                $this->db->from('systemusers');
                $this->db->where('Userid',$user);
                $this->db->limit(1);


                $query = $this->db->get();
                if($query -> num_rows() > 0)
                {
                    $result = $query->row();
                   				//$query -> result_array();
                    return $result->region_zone;
                    //return $query->result();
                }
                else
                {
                    //$results = $query->result();
                    return false;
                }

            }


    //Select all from the tables(Stations,Instruments,Elements,UserLogs) in the DB.
    //jovRi
  public function selectAllFromSystemData($value, $field,$tablename,$id_to_use){ //$stationame ,field StationName
      $session_data = $this->session->userdata('logged_in');
      $userrole=$session_data['UserRole'];
      $userid=$session_data['Userid'];
      $region =$this->SelectZonal($userid);
      if($tablename=="stations"){

        $this->db->select('*');
        $this->db->from($tablename );
         //$this->db->join('systemusers as data', 'stations.station_id = data.station','left');
		//$this->db->where('Active','1');
        
        if($userrole=='ManagerData' || $userrole=='Manager'){
            $this->db->where('StationStatus','on');
            $this->db->where_not_in('station_id','0');
        }elseif($userrole=="ManagerStationNetworks" || $userrole=='ZonalOfficer' || $userrole=="SeniorZonalOfficer" ){
            $this->db->where_not_in('station_id','0');

        }
        elseif($userrole=='ZonalOfficer' || $userrole=="SeniorZonalOfficer"  || $userrole=="Director" ){
          $this->db->where('StationStatus','on');
          $this->db->where('StationRegion', $region);

      }elseif($userrole=='Senior Weather Observer' ){
        $this->db->where('StationStatus','on');
        $this->db->where_not_in('station_id','0');
    }

    $this->db->order_by("station_id", "desc");
}else{
    $this->db->select('*');
    $this->db->from($tablename.' as tab');//select from userlogs
    $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');
    $this->db->where_not_in('tab.station','0');
    if($tablename=='stations' ){
        $this->db->where('tab.'.$field, $value);
    }else{
        $this->db->where('stationsdata.'.$field, $value);
    }
   
    //$this->db->join('data_tracking as tracking','tracking.modified = tab.Date');
    //$this->db->where('tracking.modifiedBy','tab.Userid');
    
    $this->db->order_by("tab.id", "desc");
}
              // Run the query
$query = $this->db->get();
if($query -> num_rows() > 0)
{

                    $result = $query->result();  //$query -> result_array();
                    return $result;
                    //return $query->result();
                }
                else
                {
                    //$results = $query->result();
                    return false;
                }
            }
            //jovRi
                public function selectAllscanDaily($value, $field,$tablename,$form,$userid=NULL,$singlerecord=NULL){ //$stationame ,field StationName
                    $this->db->select('*');
                    $this->db->from($tablename.' as slip');
                    $this->db->join('stations as stationsdata', 'slip.station = stationsdata.station_id');
                    $this->db->where('slip.Form_scanned', $form);
                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];


                    if($userrole=='Manager' || $userrole == 'ManagerData'){

                    }elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){

                    }elseif($userrole=='Senior Weather Observer' ){
                        $this->db->where('stationsdata.'.$field, $value); //field is StationName

                    }elseif( $userrole=='Observer' || $userrole=='ObserverDataEntrant' || $userrole=='ObserverArchive'){
                        $this->db->where('stationsdata.'.$field, $value);

                    }
                    if(($userrole=='DataOfficer')&&($userid!=NULL)){
                     $this->db->where('slip.submitedBy_Id', $userid);
                    }
                     if($singlerecord!=NULL){
                     $this->db->where('slip.id', $singlerecord);
                    }
                    $this->db->where('numfiles >',0);
                    $this->db->order_by("slip.id", "desc");
                    // Run the query
                    $query = $this->db->get();
                    if($query -> num_rows() > 0)
                    {
                        $result = $query->result();  //$query -> result_array();
                        return $result;
                    }
                    else
                    {
                        //$results = $query->result();
                        return false;
                    }
                }


                function updateLogViewstatus($query){
                    $session_data = $this->session->userdata('logged_in');
                    $userrole= $session_data['UserRole'];

                    foreach($query as $row){
                     $logdate=$row->logdate;
                     $logid=$row->logid;
                     $query1=$this->getPopuplogs($logdate,$logid);
                     foreach($query1 as $row){
                        $statusflag = $row->status;break;
                    }
                    if($statusflag=='01'){$setflag='11';}
                    if($statusflag=='10'){$setflag='11';}
                    if($statusflag=='00' && $userrole=='Senior Weather Observer'){$setflag='10';}
                    if($statusflag=='00' && $userrole=='ManagerData'){$setflag='01';}

                    $updatedata=array('status'=>$setflag);
                    $this->db->where('Userid',$logid)
                    ->where('Date',$logdate)
                    ->update('userlogs',$updatedata);
                }
            }

            function getLogViews(){
                $session_data = $this->session->userdata('logged_in');
                $userstationid=$session_data['StationId'];
                $userid= $session_data['Userid'];
                $userrole= $session_data['UserRole'];
                $statusvalues4oc=array('01','00');
                $statusvalues4manager=array('10','00');
                $this->db->select('*,logs.Date as logdate,logs.Userid as logid');
                $this->db->from('userlogs as logs');
                $this->db->join('systemusers as users','logs.Userid=users.Userid');
                $this->db->join('observationslip as slip','logs.data_id=slip.id');
                $this->db->join('stations as stationdata','stationdata.station_id=slip.station');

                if($userrole=='Senior Weather Observer'){
                  $this->db->where_in('logs.status',$statusvalues4oc);
                  $this->db->where('slip.station',$userstationid);
              }
              else if($userrole=='ManagerData'){
                  $this->db->where_in('logs.status',$statusvalues4manager);
                  $this->db->where_in('users.UserRole',array('ZonalOfficer','SeniorZonalOfficer'));
              }


              $this->db->where_not_in('logs.Userid',$userid);
              $this->db->group_by(array("logs.Userid", "logs.Date",));
              $query = $this->db->get();
              if($query -> num_rows() > 0)
              {
                $result = $query->result(); 
                return $result;
            }
            else
            {
                return false;
            }
        }

        public function getPopupRecord($data_id){
            $this->db->select('*');
            $this->db->from('observationslip as slip');
            $this->db->join('systemusers as users', 'slip.Userid= users.Userid');
            $this->db->join('stations as stationsdata', 'users.station = stationsdata.station_id');
            $this->db->where('slip.id',$data_id); 
            $query = $this->db->get();
            if($query -> num_rows() > 0)
            {
                $result = $query->result(); 
                return $result;
            }
            else
            {
                return false;
            }

        }

        function updatePopupRecord($userid,$date){
            $session_data = $this->session->userdata('logged_in');
            $userrole=$session_data['UserRole'];
            $date = rawurldecode($date);
            $query=$this->getPopuplogs($date,$userid);
            foreach($query as $row){
                $statusflag = $row->status;break;
            }
            if($statusflag=='01'){$setflag='11';}
            if($statusflag=='10'){$setflag='11';}
            if($statusflag=='00' && $userrole=='Senior Weather Observer'){$setflag='10';}
            if($statusflag=='00' && $userrole=='ManagerData'){$setflag='01';}
            else{$setflag==null;}
            $updatedata=array('status'=>$setflag);
            $this->db->where('Userid',$userid)
            ->where('Date',$date)
            ->update('userlogs',$updatedata);
            if($this->db->affected_rows() > 0){
                return true;
            }else{
                return false;
            }

        } 

        function getPopuplogs($date,$userid){

            $this->db->select('*');
            $this->db->from('userlogs as logs');
            $this->db->join('systemusers as users','logs.Userid=users.Userid');
            $this->db->where('logs.Date',$date);
            $this->db->where('logs.Userid',$userid);
            $query = $this->db->get();
            if($query -> num_rows() >0)
            {
                $result = $query->result();
                return $result;
            }
            else
            {
                return false;
            }

        }

        function getNotificationData(){
            $session_data = $this->session->userdata('logged_in');
            $userstationid=$session_data['StationId'];
            $userid= $session_data['Userid'];
            $userrole=$session_data['UserRole'];
            $statusvalues4oc=array('01','00');
            $statusvalues4manager=array('10','00');
            $this->db->select('logs.Userid as userid,logs.Date as date,users.FirstName as FirstName,users.SurName as SurName,
                users.UserRole as UserRole,logs.Action as Action');
            $this->db->from('userlogs as logs');
            $this->db->join('systemusers as users','logs.Userid=users.Userid');
            $this->db->join('observationslip as slip','logs.data_id=slip.id');
            if($userrole=='Senior Weather Observer'){
                $this->db->where_in('logs.status',$statusvalues4oc);
                $this->db->where('slip.station',$userstationid);
            }
            else if($userrole=='ManagerData'){
                $this->db->where_in('logs.status',$statusvalues4manager);
                $this->db->where_in('users.UserRole',array('ZonalOfficer','SeniorZonalOfficer'));
            }
            $this->db->where_not_in('logs.Userid',$userid);
            $this->db->group_by(array("logs.Userid", "logs.Date"));
            $this->db->order_by('date','desc');
            $this->db->limit(20);
            $query = $this->db->get();
            if($query -> num_rows() >0){
                        //data-toggle="modal" data-target="#myModal1"

                $result = $query->result(); 
                foreach ($result as $row){
                    $output .= '<li  >
                    <a onclick="getData(this);return false;" href="index.php/Users/getPopuplogs/'.rawurlencode($row->userid).'/'.rawurlencode($row->date).'">
                    <strong>'.$row->FirstName.' '.$row->SurName.', <em>'.$row->UserRole.'</em></strong><br />
                    <small><em>'.$row->Action.'</em></small>
                    </a>
                    </li>
                    <li class="divider"></li>

                    ';
                }
                return $output;

            }else{
              return false;
          }
      }

      public function getNotification(){
        $session_data = $this->session->userdata('logged_in');
        $userstationid=$session_data['StationId'];
        $userid= $session_data['Userid'];
        $userrole= $session_data['UserRole'];
        $counter = 0;$statusvalues4oc=array('01','00');
        $statusvalues4manager=array('10','00');
        $this->db->select('*');
        $this->db->from('userlogs as logs');
        $this->db->join('systemusers as users','logs.Userid=users.Userid');
        $this->db->join('observationslip as slip','logs.data_id=slip.id');
        if($userrole=='Senior Weather Observer'){
          $this->db->where_in('logs.status',$statusvalues4oc);
          $this->db->where('slip.station',$userstationid);
      }
      else if($userrole=='ManagerData'){
          $this->db->where_in('logs.status',$statusvalues4manager);
          $this->db->where_in('users.UserRole',array('ZonalOfficer','SeniorZonalOfficer'));
      }


      $this->db->where_not_in('logs.Userid',$userid);
      $this->db->group_by(array("logs.Userid", "logs.Date"));
      $query = $this->db->get();
      if($query -> num_rows() >0){

        $result = $query->result(); 
        foreach ($result as $row){
            $counter++;
        }
        return $counter;

    }else{
      return 0;
  }
}

public function SelectZonalStations($region){

    $this->db->select('*');
    $this->db->from('stations');
    $this->db->where('StationRegion',$region);
    $this->db->order_by("StationName", "asc");
    $query = $this->db->get();
    if($query -> num_rows() > 0)
    {

                        $result = $query->result();  //$query -> result_array();
                        return $result;
                        //return $query->result();
                    }
                    else
                    {
                        //$results = $query->result();
                        return false;
                    }

                }

                function getdataid($arr,$table,$id){
                    $query = $this->db->get_where($table,$arr,1);
                    if($query -> num_rows() > 0)
                    {

                        $result = $query->result();
                        foreach($result as $row){
                            if($id == 'id'){
                                $data_id = $row->id;
                            }
                            else if($id == 'Userid'){
                                $data_id = $row->Userid;
                            }
                            
                        }
                        return $data_id;
                    }
                    else
                    {
                        //$results = $query->result();
                        return false;
                    }
                }

                function GetUserLogs($station,$action,$typeofform,$startdate,$enddate){
                   // exit($station.'...... '.$typeofform.'....'.$startdate.'...'.$enddate);
                    $this->db->select('*,logs.Date as logdate');
                    $this->db->from('userlogs as logs');
                    $this->db->join('systemusers as users','logs.Userid=users.Userid','left');
                    
                    
                    if($action=='login/logout'){
                      
                        $this->db->join('stations as station','users.station=station.station_id','left');
                        $this->db->where('station.station_id',$station);
                        $this->db->where_in('logs.Action',array('Signed Out','Logged in'));
                    }else if($action=='Quality control'){
                        $this->db->join('stations as station','logs.station_id logs.station_id=station.station_id','left');
                        $this->db->where('logs.Action',$action.' '.$typeofform);
                    }else if($action=='station'){
                        $this->db->join('stations as station','logs.station_id logs.station_id=station.station_id','left');
                        $this->db->where_in('logs.Action',array('Updated station details','Created new station','Deleted station details'));
                    }else{
                        $this->db->join('stations as station','users.station=station.station_id','left');
                        //$this->db->join('observationslip as slip','slip.id=logs.data_id','left');
                        $this->db->where('logs.Action',$action.' '.$typeofform);
                        //$this->db->where('slip.station',$station);
                    }
                     $session_data = $this->session->userdata('logged_in');
                     $userRegion=$session_data['UserRegion'];
                     $UserSubRegion=$session_data['UserRegion'];
                     $userstationId=$session_data['StationId'];
                     $userrole=$session_data['UserRole'];
                    if($userrole=='Manager' || $userrole=='ManagerData'||$userrole=='ManagerStationNetworks'){
      
                      }elseif($userrole=='Senior Weather Observer'){
                            
                            $this->db->where('logs.users_region', $userRegion);
                            $this->db->where('logs.users_subregion', $UserSubRegion);
                             $this->db->where('logs.station_id', $userstationId);
                            
                      }
                        elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){
                          $this->db->where('logs.users_region', $userRegion);
                          $this->db->where('logs.users_subregion', $UserSubRegion);
                      }else{
                           //$this->db->where('user.createby_ByID',$userid);

                      }

                    $this->db->where('logs.Date >= ',$startdate);
                    $this->db->where('logs.Date <= ',$enddate);
                    $query=$this->db->get();
                    if($query -> num_rows() >0){
                        $result = $query->result();
                        return $result;
                    }
                    else
                    {
                        return false;
                    }
                }

                  public function selectRecordComments($id,$table){
                    $this->db->select('*');
                    $this->db->from('raw_datacomments as slip'); 
                    $this->db->where('slip.record_id', $id);
                    $this->db->where('slip.form_type', $table);
                    $this->db->order_by("slip.id", "desc"); 
                    $query = $this->db->get();
                    return $query->result();
                 }

                 public function selectAll($value, $field,$tablename,$lowerLimit,$upperLimit,$singlerecord=NULL,$userid=NULL){ //$stationame ,field StationName
                    $this->db->select('*');
                    $this->db->from($tablename.' as slip');
                    $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');

                    $session_data = $this->session->userdata('logged_in');
                    $userrole=$session_data['UserRole'];

                    //$lowerLimit=$total_row-($NoOfRecords*$pageNo);
                    //$upperLimit=$lowerLimit+$NoOfRecords;
                    if($lowerLimit!=NULL || $upperLimit!=NULL){
                        $this->db->where("slip.O_CreationDate >", $lowerLimit);
                        $this->db->where("slip.O_CreationDate <=", $upperLimit);
                    }
                    if($userrole=='Manager' || $userrole=='ManagerData'){

                    }elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){

                    }elseif($userrole=='Senior Weather Observer' ){
                        $this->db->where('stationsdata.'.$field, $value); //field is StationName
                        //$this->db->where('stationsdata.'.$field, $value);
                    }elseif( $userrole=='Observer' || $userrole=='ObserverDataEntrant' || $userrole=='ObserverArchive'){
                        $this->db->where('stationsdata.'.$field, $value);

                    }
                     if($singlerecord!=NULL){
                     $this->db->where('slip.id', $singlerecord);
                    }
                    if(($userrole=='DataOfficer')&&($userid!=NULL)){
                     $this->db->where('slip.submitedBy_Id', $userid);
                    }

                    if($tablename=='observationslip'){
                     $this->db->order_by("slip.O_CreationDate", "desc"); 
                 }else{
                     $this->db->order_by("slip.CreationDate", "desc"); 
                 }

                 $this->db->limit($NoOfRecords);
                    // Run the query
                 $query = $this->db->get();
                 if($query -> num_rows() > 0)
                 {
                    $result = $query->result();
						//$query -> result_array();
                    return $result;
                }
                else
                {
                        //$results = $query->result();

                    return false;
                }
            }


            public function selectAllScansmonthly($value, $field,$tablename,$type,$userid=NULL,$singlerecord=NULL){ //$stationame ,field StationName
                $this->db->select('*');
                $this->db->from($tablename.' as slip');
                $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');

                $session_data = $this->session->userdata('logged_in');
                $userrole=$session_data['UserRole'];

                
                if($userrole=='Manager' || $userrole=='ManagerData'){

                }elseif($userrole=='ZonalOfficer' || $userrole=='SeniorZonalOfficer'){

                }elseif($userrole=='Senior Weather Observer' ){
                    $this->db->where('stationsdata.'.$field, $value); //field is StationName
                    //$this->db->where('stationsdata.'.$field, $value);
                }elseif( $userrole=='Observer' || $userrole=='ObserverDataEntrant' || $userrole=='ObserverArchive'){
                    $this->db->where('stationsdata.'.$field, $value);

                }
                if(($userrole=='DataOfficer')&&($userid!=NULL)){
                     $this->db->where('slip.submitedBy_Id', $userid);
                    }
                   if($singlerecord!=NULL){
                     $this->db->where('slip.id', $singlerecord);
                    }
                if($tablename=='observationslip'){
                 $this->db->order_by("slip.O_CreationDate", "desc"); 
                }else{
                    $this->db->order_by("slip.CreationDate", "desc"); 
                }
                if($type!=NULL){
                    $this->db->where('Form_scanned',$type);
                }
                

                $this->db->where('numfiles>',0);
                 $this->db->limit($NoOfRecords);
                // Run the query
             $query = $this->db->get();
             if($query -> num_rows() > 0)
             {
                $result = $query->result();
                    //$query -> result_array();
                return $result;
            }
            else
            {
                    //$results = $query->result();

                return false;
            }
        }
      public function selectAll2conditionsOneNegative($value, $field,$tablename,$value2, $field2,$lowerLimit,$upperLimit,$singlerecord=NULL){ //$stationame ,field StationName
       $session_data = $this->session->userdata('logged_in');
       $userrole=$session_data['UserRole'];
       $userid =$session_data['Userid'];
       $region =$this->SelectZonal($userid);
       $this->db->select('*');
       $this->db->from($tablename.' as slip');
       $this->db->join('systemusers as users', 'slip.Userid= users.Userid');
       if($userrole=="ZonalOfficer"||$userrole=="SeniorZonalOfficer"){
        //$this->db->join('stations as stationsdata', 'users.region_zone = stationsdata.StationRegion');
         $this->db->join('stations as stationsdata', 'users.station = stationsdata.station_id');
         $this->db->where('stationsdata.StationRegion', $region);
     }else{
        $this->db->join('stations as stationsdata', 'users.station = stationsdata.station_id');
        $this->db->where('stationsdata.'.$field, $value);
    }
    $NoOfRecords = 336;


    if($lowerLimit!=NULL || $upperLimit!=NULL){
        $this->db->where("slip.O_CreationDate >=", $lowerLimit);
        $this->db->where("slip.O_CreationDate <", $upperLimit);
    }
    $this->db->where_not_in('slip.'.$field2, $value2);
    $this->db->order_by("slip.O_CreationDate","DESC");
    if($singlerecord!=NULL){
     $this->db->where('slip.id', $singlerecord);
    }
    $this->db->limit($NoOfRecords);

    $query = $this->db->get();
    if($query -> num_rows() > 0)
    {
              $result = $query->result();  //$query -> result_array();
              return $result;
          }
          else
          {
              //$results = $query->result();
              return false;
          }
      }//Select all from the tables(ObservationSlip,MoreFormFields,ALL THE ARCHIVE TABLES) in the DB.

   public function selectAll2conditions($value, $field,$tablename,$value2, $field2,$lowerLimit,$upperLimit){//$stationame ,field StationName
       $session_data = $this->session->userdata('logged_in');
       $userrole=$session_data['UserRole'];
       $userid =$session_data['Userid'];
       $region =$this->SelectZonal($userid); 
       $this->db->select('*');
       $this->db->from($tablename.' as slip');
       $this->db->join('stations as stationsdata', 'slip.station= stationsdata.station_id');

       $NoOfRecords= 336;
        //$lowerLimit=$total_row-($NoOfRecords*$pageNo);
        //$upperLimit=$lowerLimit+$NoOfRecords;
       if($lowerLimit!=NULL || $upperLimit!=NULL){
          $this->db->where("slip.O_CreationDate >=", $lowerLimit);
          $this->db->where("slip.O_CreationDate <", $upperLimit);
      }
      if($userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer"){
        $this->db->where('stationsdata.StationRegion', $region);
    }else{
     $this->db->where('stationsdata.'.$field, $value);
 } 

 $this->db->where('slip.'.$field2, $value2);
 $this->db->order_by("slip.O_CreationDate","DESC");
 $this->db->limit($NoOfRecords);

 $query = $this->db->get();
 if($query -> num_rows() > 0)
 {
            $result = $query->result();  //$query -> result_array();
            return $result;
        }
        else
        {
            return false;
        }
    }
    public function selectAll3conditionsOneNegative($value, $field,$tablename,$value2, $field2, $value3, $field3,$lowerLimit,$upperLimit, $singlerecord=NULL){  //$stationame ,field StationName
        $this->db->select('*');
        $this->db->from($tablename.' as slip');
        $this->db->join('systemusers as users', 'slip.Userid= users.Userid');
        $this->db->join('stations as stationsdata', 'users.station= stationsdata.station_id');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        //$userid=$session_data['Userid'];//added
        if($lowerLimit!=NULL || $upperLimit!=NULL){
            $this->db->where("slip.O_CreationDate >=", $lowerLimit);
            $this->db->where("slip.O_CreationDate <", $upperLimit);
        }
        $this->db->where('stationsdata.'.$field, $value);//stationname is user's station
        //$this->db->where('slip.'.$field2, $value2);//where Approved is 0
        $this->db->where_not_in('slip.'.$field3, $value3);//device type not in aws
        $this->db->where_not_in('slip.Approved', 'Approved');
        //$this->db->where("slip.Userid", $userid);//added
        $this->db->order_by("slip.O_CreationDate","DESC");
        if($singlerecord!=NULL){
            $this->db->where("slip.id", $singlerecord);  
        }
        $this->db->limit(336);
        
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();
           		//$query -> result_array();
            return $result;
        }
        else
        {

            //$results = $query->result();
            return false;
        }
    }


    public function checkforduplicate($date,$station_id,$timeobservationslip){
        $this->db->select('*');
        $this->db->from('observationslip');
        $this->db->where('Date',$date);
        $this->db->where('Station',$station_id);
        $this->db->where('TIME',$timeobservationslip);
        $this->db->where('DeviceType','web');
        $this->db->limit(1);

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
           // $result = $query->result();  //$query -> result_array();
            return true;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }

     public function checkforduplicatearchiveweathersummary($date,$station_id){
        $this->db->select('*');
        $this->db->from('archiveweathersummaryformreportdata');
        $this->db->where('Date',$date);
        $this->db->where('station',$station_id);
         $this->db->order_by("Date","DESC");
        $this->db->limit(1);

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
           // $result = $query->result();  //$query -> result_array();
            return true;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }

     public function checkforduplicatearchiveobservationslip($date,$station_id,$timeobservationslip){
        $this->db->select('*');
        $this->db->from('archiveobservationslipformdata');
        $this->db->where('Date',$date);
        $this->db->where('Station',$station_id);
        $this->db->where('TIME',$timeobservationslip);
         $this->db->order_by("Date","DESC");
        $this->db->limit(1);

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
           // $result = $query->result();  //$query -> result_array();
            return true;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }

     public function checkforduplicatearchivesynoptic($date, $stationId,$ztime){
        $this->db->select('*');
        $this->db->from('archivesynopticformreportdata');
        $this->db->where('Date',$date);
        $this->db->where('Station',$stationId);
        $this->db->where('TIME',$ztime);
         $this->db->order_by("Date","DESC");
        $this->db->limit(1);

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
           // $result = $query->result();  //$query -> result_array();
            return true;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }

     public function checkforduplicatearchivedekadal($date, $stationId,$dekadalnumber){
        $this->db->select('*');
        $this->db->from('archivedekadalformreportdata');
        $this->db->where('Date',$date);
       
        $this->db->where('Station',$stationId);
        $this->db->where('dekadalnumber',$dekadalnumber);
         $this->db->order_by("Date","DESC");
        $this->db->limit(1);

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
           // $result = $query->result();  //$query -> result_array();
            return true;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }



     public function checkforduplicatearchivemonthly($date, $stationId){
        $this->db->select('*');
        $this->db->from('archivemonthlyrainfallformreportdata');
        $this->db->where('Date',$date);
        $this->db->where('Station',$stationId);
         $this->db->order_by("Date","DESC");
        $this->db->limit(1);

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
           // $result = $query->result();  //$query -> result_array();
            return true;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }


    ////////////////////////////////////////////////
    //Insertion for all Forms in the DB
    function  insertData($FormDataToInsert,$tablename){


        $this->db->insert($tablename,$FormDataToInsert);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    //Insert User
    function  insertUser($insertUserData){

        $this->db->insert("systemusers",$insertUserData);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    ///////////////////////////////////////////////////
    //Update for ALL Form Data
    //jovRi

    


    public   function  updateData($FormDataToUpdate,$FormDataToUpdate2, $tablename, $id,$userlogs){

    //exit('hey....'.$FormDataToUpdate['TotalAmountOfAllClouds'] );
        $user=$userlogs['User'];
        $UserRole=$userlogs['UserRole'];
        $Action=$userlogs['Action'];
        $Details=$userlogs['Details'];
        $station=$userlogs['station'];
        $IP=$userlogs['IP'];

        $session_data = $this->session->userdata('logged_in');
        $updater_id=$session_data['Userid'];
        //$this->db->query("SET @var1= $name");
        $this->db->query("SET @Userid= '$updater_id'");
        $this->db->query("SET @UserRole= '$UserRole'");
        $this->db->query("SET @Action= '$Action'");
        $this->db->query("SET @Details='$Details'");
        $this->db->query("SET @station= '$station'");
        $this->db->query("SET @IP= '$IP'");


        if($tablename=="stations"){
         $this->db->where('station_id',$id);
     }
     else{
      $this->db->where('id',$id);
  }

       //$this->db->where('id',$id);
  $this->db->update($tablename,$FormDataToUpdate);  



  if ($this->db->affected_rows() ==1)
  {
            //exit('true');
    return TRUE;
}
else
{
            //exit('false');
    return FALSE;
}
}



public function checkifApproved($id){
    $this->db->select('ApprovedBy');
    $this->db->from('observationslip');
    $this->db->where("id",$id);
    $this->db->limit(1); 
    $query= $this->db->get();




    if($query->num_rows()>0){

        $val=$query->row();
        $value=$val->ApprovedBy;
        return $value;

    }
    else
    {
        return "none";
    }
    
}
//archive obersvation slip approval
public function checkif_Approved($id){
    $this->db->select('ApprovedBy');
    $this->db->from('archiveobservationslipformdata');
    $this->db->where("id",$id);
    $this->db->limit(1); 
    $query= $this->db->get();




    if($query->num_rows()>0){

        $val=$query->row();
        $value=$val->ApprovedBy;
        return $value;

    }
    else
    {
        return "none";
    }
    
}

    //Update the User
      //jovRi
public function updateUser($data, $table, $id){

    //$first_name = $updateUserData['FirstName'];
   // $last_name = $updateUserData['SurName'];
   // $username = $updateUserData['username'];
   // $email = $updateUserData['UserEmail'];
   // $phone = $updateUserData['UserPhone'];
    //$role = $updateUserData['UserRole'];
   // $station = $updateUserData['station'];
   // $station_id = $this->getStationID($station);
    //$id = $updateUserData['Userid'];


    //$this->db->dbprefix($tablename);
    $this->db->where("Userid",$id);
    $this->db->update($table, $data);

    if (!$this->db->affected_rows() ==0)
    {
        return TRUE;

    }
    else
    {
        return FALSE;
    }
}

public function getStationID($station){
  
    $this->db->select('station_id');
    $this->db->from('stations');
    $this->db->where("StationName",$station);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $stationID = $val->station_id;
        return $stationID;

    }
    else
    {
        return "none";
    }
}


public function getRegionForStation($station){
  
    $this->db->select('StationRegion');
    $this->db->from('stations');
    $this->db->where("StationName",$station);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $region = $val->StationRegion;
        return $region;

    }
    else
    {
        return "none";
    }
}

public function getRegionName($station){
  
    $this->db->select('StationRegion');
    $this->db->from('stations');
    $this->db->where("StationName",$station);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $region = $val->StationRegion;
        return $region;

    }
    else
    {
        return "none";
    }
}



public function getStationName($stationNo){
  
    $this->db->select('StationName');
    $this->db->from('stations');
    $this->db->where("StationNumber",$stationNo);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $station = $val->StationName;
        return $station;

    }
    else
    {
        return "none";
    }
}

public function getBlocknumber($stationNo){
  
    $this->db->select('blocknumber');
    $this->db->from('stations');
    $this->db->where("StationNumber",$stationNo);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $bn = $val->blocknumber;
        return $bn;

    }
    else
    {
        return "none";
    }
}

public function getStationRegnumber($stationNo){
  
    $this->db->select('StationRegNumber');
    $this->db->from('stations');
    $this->db->where("StationNumber",$stationNo);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $bn = $val->StationRegNumber;
        return $bn;
        

    }
    else
    {
        return "none";
    }
}
public function getdistrict($stationNo){
  
    $this->db->select('district');
    $this->db->from('stations');
    $this->db->where("StationNumber",$stationNo);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $bn = $val->district;
        return $bn;

    }
    else
    {
        return "none";
    }
}

public function getregno($stationNo){
  
    $this->db->select('StationRegNumber');
    $this->db->from('stations');
    $this->db->where("StationNumber",$stationNo);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $bn = $val->StationRegNumber;
        return $bn;

    }
    else
    {
        return "none";
    }
}

public function getUnitOfWindSpeed($stationNo){
  
    $this->db->select('UnitOfWind_Speed');
    $this->db->from('stations');
    $this->db->where("StationNumber",$stationNo);
    $this->db->limit(1); 
    $query= $this->db->get();
    if($query->num_rows()>0){

        $val = $query->row();
        $bn = $val->UnitOfWind_Speed;
        return $bn;

    }
    else
    {
        return "none";
    }
}
    ///////////////////////////////////////////////////////
    //Delete for all Forms
public  function  deleteData($tablename,$deleteFormDataId){ 
        if ($tablename=="stations"){  //$tablename and id of the record
         $deletesql = "DELETE FROM $tablename WHERE station_id =? ";
     }else{
        $deletesql = "DELETE FROM $tablename WHERE id =? ";
    }
        // Run the query
    $this->db->query($deletesql, array($deleteFormDataId));
        //return $this->db->affected_rows();
        // $query = $this->db->get();
    if($this->db->affected_rows() == 1)
    {
            //$result = $query->result();
        return TRUE;
            //return $query->result();
    }
    else
    {
        return FALSE;
    }
}
    //Delete for a user
    function  deleteUser($tablename,$deleteUserId){  //$tablename,id of the row
      $data=array('Active' => 0);

      $this->db->set($data);
      $this->db->where("userid",$deleteUserId);
      $this->db->update($tablename, $data);

      if($this->db->affected_rows() == 1)
      {
        return TRUE;
            //return $query->result();
    }
    else
    {
        return FALSE;
    }
}

    //Activate a user by manager
    function  activateUser($tablename,$activeUserId){  //$tablename,id of the row
        $data=array('Active' => 1);

        $this->db->set($data);
        $this->db->where("userid",$activeUserId);
        $this->db->update($tablename, $data);

        if($this->db->affected_rows() == 1)
        {
            $this->db->select('note_id');
            $this->db->from('systemusers');
            $this->db->where("UserId",$activeUserId); 
            $note = $this->db->get()->row()->note_id;

            $this->db->set('viewedby_datamanager','True');
            $this->db->where('note_id',$note);
            $this->db->update('speci_notification');


          return TRUE;
              //return $query->result();
      }
      else
      {
          return FALSE;
      }
  }

   public function selectRegionSubregionById($id,$table){
      $this->db->select('*');
      $this->db->from($table);
      $this->db->where('id', $id);
      $query = $this->db->get();
      return $query->result();
   }
    public function updateRegionSubregion($id){
        if($id=="Region"){
            $region=$this->input->get_post('regionname');
            $regionid =  $this->input->get_post('regionid');
            $updatedata=array('region'=>$region);
            $this->db->where("id",$regionid);
            $this->db->update("regions",$updatedata);
            if ($this->db->affected_rows() ==1){ return TRUE; } else{return FALSE;}

        }else{
            $region=$this->input->get_post('region');
            $subregion=$this->input->get_post('subregionname');
            $regionid =  $this->input->get_post('subregionid');
            $updatedata=array('region'=>$region,'subregion'=>$subregion);
            $this->db->where("id",$regionid);
            $this->db->update("subregions",$updatedata);
            if ($this->db->affected_rows() ==1){ return TRUE; } else{return FALSE;}
        }

    }
    /////////////////////////////////////////////////////////////
//jov
    public function selectById($value, $field, $tablename){  //$value, $field,$table
        $this->db->select('*');
        if($tablename=="stations"){
          $this->db->from($tablename);
          $this->db->where($field, $value);
          $this->db->order_by($field, "desc");
      }
      else{
          $this->db->from($tablename.' as tab');
          $this->db->join('stations as stationsdata', 'tab.station= stationsdata.station_id');
          $this->db->where('tab.'.$field, $value);
          $this->db->order_by('tab.'.$field, "desc");

      }

        // Run the query
      $query = $this->db->get();
      if($query -> num_rows() == 1)
      {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    public function selectByIdZonalOfficer($value, $field, $tablename){  //$value, $field,$table
        $this->db->select('*');
        $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id');

        $this->db->where('user.'.$field, $value);
        $this->db->where('user.UserRole', "ZonalOfficer");
        $this->db->order_by("user.Userid", "desc");
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() >= 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
       public function selectByIdZonalOfficer_andOC($value, $field, $tablename){  //$value, $field,$table
        $this->db->select('*');
        $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id');

        $this->db->where('user.'.$field, $value);
        $this->db->where('user.UserRole', "ZonalOfficer");
        $this->db->or_where('user.UserRole', "Senior Weather Observer");
        $this->db->or_where('user.UserRole', "Communications");
        $this->db->order_by("user.Userid", "desc");
        // Run the query
        $query = $this->db->get();

        $q = $this->db->query("
        SELECT *
        FROM $tablename      t1
        JOIN stations      t2
            ON t1.station    = t2.station_id
            WHERE t1.$field = $value
            AND   (t1.UserRole = 'ZonalOfficer'
            OR   t1.UserRole='Senior Weather Observer')
        ");

        if($q -> num_rows() >= 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $q->result();
              //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    // send email to OC incase of issues
    public function selectByIdOC($value, $field, $tablename){  //$value, $field,$table
        $this->db->select('*');
        $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id');

        $this->db->where('user.'.$field, $value);
        $this->db->where('user.UserRole', "Senior Weather Observer");

        $this->db->order_by("user.Userid", "desc");
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() >= 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
              //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    //jovRi
    public function selectUserById($value, $field, $tablename){  //$value, $field,$table

        $this->db->select('*');
        $this->db->from($tablename.' as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id','left');
        $this->db->where('user.'.$field, $value);
        $this->db->order_by("user.Userid", "desc");
        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }



    


//jovRi
    function checkforDuplicateUserDetails($firstname, $surname,$email,$stationName,$stationNumber,$stationRegion,$userRoleAssigned) {

        $this->db->select('*');
        $this->db->from('systemusers as user');
        $this->db->join('stations as stationsdata', 'user.station= stationsdata.station_id','left');
        $this->db->where('user.UserRole', $userRoleAssigned);
        $this->db->where('user.UserEmail', $email);

        /*$this->db->where('user.FirstName', $firstname);
        !empty($observationslipdataforspecifictimeofaday)
        $this->db->where('user.SurName', $surname);
        if($stationName=="NULL" && $stationNumber=="NULL" ){

           $this->db->where('user.region_zone', $stationRegion);
        }else if(!empty($stationName) && !empty($stationNumber) && empty($stationRegion)){

           $this->db->where('stationsdata.StationName', $stationName);
           $this->db->where('stationsdata.StationNumber', $stationNumber);
       }*/



       $this->db->order_by("user.Userid", "desc");
       $this->db->limit(1);

        // Run the query
       $query = $this->db->get();


       if($query -> num_rows() ==1)
       {
        $result = $query->result();
        return $result;
            //return $query->result();
    }
    else
    {
        return false;
    }

}



////////////////////////////////////////////////////////////////////////////////


function generateUniqueUsername($username,$surname,$counter){
    $this->db->select('*');
    $this->db->from('systemusers');
    $this->db->where('UserName', $username);

    $this->db->order_by("Userid", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    foreach($query -> row() as $row)
    {
        $alphabet = str_split('abcdefghijklmnopqrstuvwxyz');
                //shuffle($seed);
                //$rand = '';
                //foreach (array_rand($seed, 1) as $k) $rand .= $seed[$k];
        $counter++;
        $newsurname=firstcharlowercase($surname);
        $trialname=$alphabet[$counter].'.'.$newsurname; 
        if($counter<26){
           return $this->generateUniqueUsername($trialname,$newsurname,$counter);
       }
       else{
        return false;
    }

}

return $username;

}




function checkIfUserNameExistsAlreadyInDB($username) {
    $this->db->select('*');
    $this->db->from('systemusers');
    $this->db->where('UserName', $username);

    $this->db->order_by("Userid", "desc");
    $this->db->limit(1);
        // Run the query
    $query = $this->db->get();
    if($query -> num_rows() ==1)
    {
        $result = $query->result();
        return $result;
            //return $query->result();
    }
    else
    {
        return false;
    }

}

///////////////////////////////////////////////////////////////////////////////

function  deleteUserLogs($DeleteUserLogsId){
    $deletesql = "DELETE FROM logs WHERE id =? ";
    $this->db->query($deletesql, array($DeleteUserLogsId));
    return $this->db->affected_rows();
}
function show($table) {

    $query = $this->db->query("SELECT * FROM $table order by id desc " );
    $result = $query->result();
    return $result;
}



    ////////////////////////
    //Select Reports for Certain Forms
    //OBSERVATION SLIP DATA
public function selectObservationSlipReportForSpecificDay($date,$stationName,$stationNumber,$tablename){

    $this->db->select('*');
    $this->db->from($tablename.' as report');
    $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

    if($approve != 0 && $approve != Approved){
     $this->db->join('systemusers as users', 'report.ApprovedBy = users.Userid');
 }
 
 $this->db->where('report.Date', $date);
 $this->db->where('stationsdata.StationName', $stationName);
 $this->db->where('stationsdata.StationNumber', $stationNumber);
 $this->db->limit(1);
        // Run the query
 $query = $this->db->get();

 if($query -> num_rows() >0)
 {
    $result = $query->result();
			//print_r($result);
			//exit($timeInZoo.$date.$stationName.$stationNumber.$tablename.$time_final.$available_time);
    return $result;
            //return $query->result();
}
else
{
    return false;
}
}


public function selectObservationSlipReportForSpecificTimeOfADay(
    $timeInZoo,$date,$stationName,$stationNumber,$tablename){

    $this->db->select('*');
    $this->db->from($tablename.' as report');
    $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

    if($approve != 0 && $approve != Approved){
     $this->db->join('systemusers as users', 'report.ApprovedBy = users.Userid');
 }
 
 $time =  rtrim($timeInZoo,'Z');
 $time_final = preg_replace('/\s+/', '', $time);
 $time_actual = strtotime($time_final);
 $available_time = date("H:i",$time_actual)."Z";


 $this->db->where('report.Date', $date);
 $this->db->where('stationsdata.StationName', $stationName);
 $this->db->where('stationsdata.StationNumber', $stationNumber);
 $this->db->where('report.TIME', $available_time);

 $this->db->limit(1);
        // Run the query
 $query = $this->db->get();

 if($query -> num_rows() >0)
 {
    $result = $query->result();
            //print_r($result);
            //exit($timeInZoo.$date.$stationName.$stationNumber.$tablename.$time_final.$available_time);
    return $result;
            //return $query->result();
}
else
{
    return false;
}
}






    //METAR REPORT FOR A SPECIFIC DAY FROM OBSERVATION SLIP
    //jovRi
public function selectMetarReportForSpecificDayFromObservationSlipTable($region,$stationName,$stationNumber, $date, $tablename){
  $type = "normal";
  $this->db->select('*');
  $this->db->from($tablename.' as report');
  $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');
  $this->db->where('report.speciormetar', $type);
  $this->db->where('stationsdata.StationRegion', $region);
  $this->db->where('stationsdata.StationName', $stationName);
  $this->db->where('stationsdata.StationNumber', $stationNumber);
  $this->db->where('report.Date', $date);
 $this->db->order_by('report.TIME','ASC'); //small to big
          //$this->db->limit(1);

  // Run the query
          $query = $this->db->get();


          if($query -> num_rows() > 0)
          {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }

public function selectMetarReportForSpecificDayFromObservationSlipTableWithTime($region,$station,$stationNumber,$date,$time,$tablename){
    $type = "normal";


    $time1 =  rtrim($time,'Z');

        //$today = date('Y-m-d H:i:s A',time());
    $time_final = preg_replace('/\s+/', '', $time1);
    $time_actual = strtotime($time_final);
    $available_time = date("H:i",$time_actual)."Z";
    
  $this->db->select('*');
  $this->db->from($tablename.' as report');
  $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');
  $this->db->where('stationsdata.StationRegion', $region);
  $this->db->where('stationsdata.StationName', $station);
  $this->db->where('stationsdata.StationNumber', $stationNumber);
  $this->db->where('report.Date', $date);
  $this->db->where('report.speciormetar', $type);
  $this->db->where('report.TIME', $available_time);
  $this->db->order_by('report.TIME','ASC'); 

  // Run the query
          $query = $this->db->get();
          if($query -> num_rows() > 0)
          {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }



    public function selectSpeciReportForSpecificDayFromObservationSlipTable($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

      //  $this->db->where('report.Date', $date);
        $this->db->order_by('report.TIME','ASC'); //small to big
        $this->db->where('report.speciOrMetar', 'speci');

// Run the query
        $query = $this->db->get();


        if($query -> num_rows() > 0)
        {
          $result = $query->result();  //$query -> result_array();
          return $result;
          //return $query->result();
      }
      else
      {
          //$results = $query->result();
          return false;
      }



  }

    /////////////////////////////////////////////////START FOR WEATHER SUMMARY REPORT FROM OBSERVATION SLIP TABLE AND METAR TABLE
    //WEATHER SUMMARY REPORT  NOT DIRECT.
    //FOR 0600Z TIME FROM OBSERVATION SLIP
    //jovRi
  public function selectWeatherSummaryDataReportForAMonthFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename,$time){
    $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        Max_Read,Min_Read,Dry_Bulb,Wet_Bulb,
        Wind_Direction,Wind_Speed,Rainfall,CLP,WindRun,sunduration,Present_Weather',FALSE);

    $time1 =  rtrim($time,'Z');

	    //$today = date('Y-m-d H:i:s A',time());
    $time_final = preg_replace('/\s+/', '', $time1);
    $time_actual = strtotime($time_final);
    $available_time = date("H:i",$time_actual)."Z";
        //$this->db->from('observationslip');
    $this->db->from($tablename.' as report');
    $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];

    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);

    $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
    $this->db->where('YEAR(report.Date)', $year);
    if($available_time=="06:00Z"){
        $this->db->where('report.TIME >=', $available_time);
        $this->db->where('report.TIME < ', "12:00");
    }elseif($available_time=="12:00Z"){
      $this->db->where('report.TIME >=', $available_time);
  }
  $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
  $query = $this->db->get();
  if($query -> num_rows() > 0)
  {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

 public function selectWeatherSummaryDataReportForAMonthFromObservationSlipTableforpresentweather($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
    $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        Max_Read,Min_Read,Dry_Bulb,Wet_Bulb,
        Wind_Direction,Wind_Speed,Rainfall,CLP,WindRun,sunduration,Present_Weather',FALSE);

    $time1 =  rtrim($time,'Z');

      //$today = date('Y-m-d H:i:s A',time());
    $time_final = preg_replace('/\s+/', '', $time1);
    $time_actual = strtotime($time_final);
    $available_time = date("H:i",$time_actual)."Z";
        //$this->db->from('observationslip');
    $this->db->from($tablename.' as report');
    $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];

    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);

    $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
    $this->db->where('YEAR(report.Date)', $year);
  $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
  $query = $this->db->get();
  if($query -> num_rows() > 0)
  {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    //WEATHER SUMMARY REPORT
    //FOR 0600Z TIME FROM MORE FORM FIELDS
    //jovRi
    public function selectWeatherSummaryDataReportForAMonthFrom_MoreFormFieldsTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename,$time){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            StandardIsobaricSurface,VapourPressure',FALSE);


        //$this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('report.TIME', $time);



        $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
///////////////////////////////////////////////////////////////////for the case of max read and min read plus present weather

    //  public function selectWeatherSummaryDataReportForAMonthFrom_MoreForm($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
    //     $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,(Present_Weather) as present, MAX(Max_Read) as max ,MIN(Min_Read) as min',FALSE);


    //     //$this->db->from('observationslip');
    //     $this->db->from($tablename.' as report');
    //     $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

    //     //$session_data = $this->session->userdata('logged_in');
    //     //$userrole=$session_data['UserRole'];
    //     //$userstation=$session_data['UserStation'];
    //     $this->db->where('stationsdata.StationName', $stationName);
    //     $this->db->where('stationsdata.StationNumber', $stationNumber);

    //     $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
    //     $this->db->where('YEAR(report.Date)', $year);
    //    // $this->db->where('report.TIME', $time);



    //     $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

    //     $query = $this->db->get();
    //     if($query -> num_rows() > 0)
    //     {
    //         $result = $query->result();  //$query -> result_array();
    //         return $result;
    //         //return $query->result();
    //     }
    //     else
    //     {
    //         //$results = $query->result();
    //         return false;
    //     }
    // }
    /////////////////////////////////////END OF WEATHER SUMMARY REPORT PICK DATA FROM OBSERVTION SLIP AND METAR.
//////////////////////////////////////////////////////////////START FOR DEKADAL REPORT PICK DATA FROM OBSERVATION SLIP
    //PICK DEKADAL REPORT DATA FROM OBSERVATION SLIP TABLE FOR 0600Z(9.00 AM) AND 1200Z(3.00 PM)
    //START WITH TIME 0600Z.
    //jovRi
   public function selectDekadalDataReportForAGivenRangeInAMonthFromObservationSlipTable($fromdate,$todate,$monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename,$time){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            Max_Read,Min_Read,Dry_Bulb,Wet_Bulb,
            Wind_Direction,Wind_Speed,Rainfall',FALSE);

        // $this->db->from('observationslip');
        $this->db->from($tablename.' as report');
        $this->db->join('stations as stationsdata', 'report.station = stationsdata.station_id');

        //$session_data = $this->session->userdata('logged_in');
        //$userrole=$session_data['UserRole'];
        //$userstation=$session_data['UserStation'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->where('MONTH(report.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(report.Date)', $year);
        $this->db->where('DATE(report.Date) >= ',$fromdate);
        $this->db->where('DATE(report.Date) <= ',$todate);
        $this->db->where('report.TIME ', $time);
       //  if($time=="06:00Z"){
       //      $this->db->where('report.TIME >=', $time);
       //      $this->db->where('report.TIME <', "12:00Z");
       //  }elseif($time=="06:00Z"){
       //     $this->db->where('report.TIME >=', "12:00Z");

       // }
       $this->db->order_by('DAYOFMONTH(report.Date)','ASC');

        // Run the query
       $query = $this->db->get();
       if($query -> num_rows() > 0)
       {
            $result = $query->result();  //$query -> result_array();
      //print_r($result);
      //exit($time);
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    ////////////////////////////////////////////////////////////END OF DEKADAL REPORT PICK DATA FROM DIFFERENT TABLES

//START FOR PICK DATA FROM OBSERVATION SLIP FOR MONTHLY RAINFALL REPORT
    //MONTHLY RAINFALL REPORT.
    public function  selectMonthlyRainfallReportForAMonthFromObservationSlipTable($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename,$time){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth, Rainfall',FALSE);

        $this->db->from('observationslip as data');
        $this->db->join('stations as stationsdata', 'data.station = stationsdata.station_id');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='ManagerData' || $userrole=='Manager' || $userrole=="ZonalOfficer"|| $userrole=="SeniorZonalOfficer" || $userrole == 'WeatherAnalyst'){

            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        }elseif($userrole=='Senior Weather Observer'){
            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        }

        $this->db->where('MONTH(data.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(data.Date)', $year);
        $this->db->where('data.TIME',$time);
        $this->db->order_by('DAYOFMONTH(data.Date)','ASC');

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }


    }
//pick custom rainfall report data i.e rainfall data for a given interval of dates
    public function  selectCustomisedRainfallReportFromObservationSlipTable($dateOne,$dateTwo,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall',FALSE);

        $this->db->from('observationslip as data');
        $this->db->join('stations as stationsdata', 'data.station = stationsdata.station_id');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];

        if($userrole=='ManagerData' || $userrole=='Manager'){

            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        }elseif($userrole=='Senior Weather Observer'){
            $this->db->where('stationsdata.StationName', $stationName);
            $this->db->where('stationsdata.StationNumber', $stationNumber);

        }

        $this->db->where('data.Date >=', $dateOne);
        $this->db->where('data.Date <=', $dateTwo);
        $this->db->where('data.TIME','0600Z');

        $this->db->order_by('DAYOFMONTH(data.Date)','ASC');

    // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
        $result = $query->result();  //$query -> result_array();
        return $result;
        //return $query->result();
    }
    else
    {
        //$results = $query->result();
        return false;
    }


}

//END FOR PICK DATA FROM OBSERVATION SLIP FOR YEARLY RAINFALL REPORT
//////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////START FOR SYNOPTIC REPORT PICK DATA FROM OBSERVATION SLIP AND THE MORE FORM FIELDS TABLE
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0000Z
public function selectSynopticReportForSpecificDayFromObservationSlipTime0000Z($date,$stationName,$stationNumber,$tablename){
    $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TotalAmountOfAllClouds,TotalAmountOfLowClouds,
        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,
        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,
        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
        CloudSearchLightReading,Rainfall,relative_humidity,
        Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
        TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,stationstandardisobaricsurface,
        Present_Weather,Present_WeatherCode,Past_Weather,Past_WeatherCode,Visibility,Wind_Direction,Wind_Speed,Gusting,
        AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration,TIME',FALSE);
        // $this->db->from('observationslip');
    $this->db->from($tablename.' as archived');
    $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');

    $this->db->where('archived.Date', $date);
    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME>=','00:00Z'); //small to big
        $this->db->where('archived.TIME<','03:00Z'); //small to big
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0300Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0300Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TotalAmountOfAllClouds,TotalAmountOfLowClouds,

            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

            CloudSearchLightReading,Rainfall,relative_humidity,

            Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
            TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


            Present_Weather,Present_WeatherCode,Past_Weather,Past_WeatherCode,Visibility,Wind_Direction,Wind_Speed,Gusting,

            AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');

        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME>=','03:00Z'); //small to big
        $this->db->where('archived.TIME<','06:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0600Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0600Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TotalAmountOfAllClouds,TotalAmountOfLowClouds,

            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            CloudSearchLightReading,Rainfall,relative_humidity,
            Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
            TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,
            Present_Weather,Present_WeatherCode,Past_Weather,Past_WeatherCode,Visibility,Wind_Direction,Wind_Speed,Gusting,
            AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME>=','06:00Z'); //small to big
        $this->db->where('archived.TIME<','09:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 0900Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime0900Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TotalAmountOfAllClouds,TotalAmountOfLowClouds,

            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

            CloudSearchLightReading,Rainfall,relative_humidity,

            Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
            TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


            Present_Weather,Present_WeatherCode,Past_Weather,Past_WeatherCode,Visibility,Wind_Direction,Wind_Speed,Gusting,

            AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME>=','09:00Z'); //small to big
        $this->db->where('archived.TIME<','12:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }

    
//update the observation slip data for ms from false to true 
    public  function  updateApproval($id,$data){
        $this->db->where("id",$id);
        $this->db->update("observationslip",$data);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;

        }
        else
        {
            return FALSE;
        }
    }
//update the archive  slips data for ms from false to true 
    public  function  updateApproval1($id,$data,$table){
        $this->db->where("id",$id);
        $this->db->update($table,$data);
        if ($this->db->affected_rows() ==1)
        {
            return TRUE;

        }
        else
        {
            return FALSE;
        }
    }
    //SYNOPTIC REPORT FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 1200Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime1200Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TotalAmountOfAllClouds,TotalAmountOfLowClouds,

            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

            CloudSearchLightReading,Rainfall,relative_humidity,

            Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
            TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


            Present_Weather,Present_WeatherCode,Past_Weather,Past_WeatherCode,Visibility,Wind_Direction,Wind_Speed,Gusting,

            AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME>=','12:00Z'); //small to big
        $this->db->where('archived.TIME<','15:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 1500Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime1500Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TotalAmountOfAllClouds,TotalAmountOfLowClouds,

            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

            CloudSearchLightReading,Rainfall,relative_humidity,

            Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
            TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


            Present_Weather,Present_WeatherCode,Past_Weather,Past_WeatherCode,Visibility,Wind_Direction,Wind_Speed,Gusting,

            AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME>=','15:00Z'); //small to big
        $this->db->where('archived.TIME<','18:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 1800Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime1800Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TotalAmountOfAllClouds,TotalAmountOfLowClouds,

            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

            CloudSearchLightReading,Rainfall,relative_humidity,

            Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
            TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


            Present_Weather,Present_WeatherCode,Past_Weather,Past_WeatherCode,Visibility,Wind_Direction,Wind_Speed,Gusting,

            AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME>=','18:00Z'); //small to big
        $this->db->where('archived.TIME<','21:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY
    //FROM OBSERVATION SLIP TABLE TIME 2100Z
    public function selectSynopticReportForSpecificDayFromObservationSlipTime2100Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TotalAmountOfAllClouds,TotalAmountOfLowClouds,

            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,

            CloudSearchLightReading,Rainfall,,relative_humidity,


            Dry_Bulb,Wet_Bulb,Max_Read,Max_Reset,Min_Read,Min_Reset,Piche_Read,Piche_Reset,
            TimeMarksThermo,TimeMarksHygro,TimeMarksRainRec,


            Present_Weather,Present_WeatherCode,Past_Weather,Past_WeatherCode,Visibility,Wind_Direction,Wind_Speed,Gusting,

            AttdThermo,PrAsRead,Correction,CLP,MSLPr,TimeMarksBarograph,TimeMarksAnemograph,OtherTMarks,Remarks,windrun,sunduration',FALSE);
        // $this->db->from('observationslip');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME >= ','21:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }

//////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 0000Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0000Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
            TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,stationstandardisobaricsurface,
            StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
            Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,Visibility,
            IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
            Supp_Info,VapourPressure,T_H_Graph, TIME, Present_Weather',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','00:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE  TIME 0300Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0300Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
            TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
            StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
            Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,stationstandardisobaricsurface,
            IndicatorOfTypeOfIntrumentation,SignOfPressureChange,Visibility,
            Supp_Info,VapourPressure,T_H_Graph',FALSE);
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','03:00Z'); //small to big
        $this->db->limit(1);

        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 0600Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0600Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
        TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
        TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
        TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

        TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
        TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
        TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

        TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
        TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
        TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
            TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,stationstandardisobaricsurface,
            StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
            Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
            IndicatorOfTypeOfIntrumentation,SignOfPressureChange,Visibility,
            Supp_Info,VapourPressure,T_H_Graph',FALSE);



        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','06:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 0900Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable0900Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
            TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,stationstandardisobaricsurface,
            StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
            Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
            IndicatorOfTypeOfIntrumentation,SignOfPressureChange,Visibility,
            Supp_Info,VapourPressure,T_H_Graph',FALSE);



        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','09:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 1200Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1200Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
            TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,stationstandardisobaricsurface,
            StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
            Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
            IndicatorOfTypeOfIntrumentation,SignOfPressureChange,Visibility,
            Supp_Info,VapourPressure,T_H_Graph',FALSE);


        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','12:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 1500Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1500Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
            TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
            StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,stationstandardisobaricsurface,
            Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,
            IndicatorOfTypeOfIntrumentation,SignOfPressureChange,Visibility,
            Supp_Info,VapourPressure,T_H_Graph',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','15:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 1800Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable1800Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
            TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
            StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
            Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,stationstandardisobaricsurface,
            IndicatorOfTypeOfIntrumentation,SignOfPressureChange,Visibility,
            Supp_Info,VapourPressure,T_H_Graph',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','18:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
    //SYNOPTIC REPORT DATA FOR A SPECIFIC DAY FROM MORE FORM FIELDS TABLE TIME 2100Z
    public function selectSynopticReportForSpecificDayFrom_MoreFormFieldsTable2100Z($date,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TypeOfLowClouds1,OktasOfLowClouds1,HeightOfLowClouds1,CLCODEOfLowClouds1,
            TypeOfLowClouds2,OktasOfLowClouds2,HeightOfLowClouds2,CLCODEOfLowClouds2,
            TypeOfLowClouds3,OktasOfLowClouds3,HeightOfLowClouds3,CLCODEOfLowClouds3,

            TypeOfMediumClouds1,OktasOfMediumClouds1,HeightOfMediumClouds1,CLCODEOfMediumClouds1,
            TypeOfMediumClouds2,OktasOfMediumClouds2,HeightOfMediumClouds2,CLCODEOfMediumClouds2,
            TypeOfMediumClouds3,OktasOfMediumClouds3,HeightOfMediumClouds3,CLCODEOfMediumClouds3,

            TypeOfHighClouds1,OktasOfHighClouds1,HeightOfHighClouds1,CLCODEOfHighClouds1,
            TypeOfHighClouds2,OktasOfHighClouds2,HeightOfHighClouds2,CLCODEOfHighClouds2,
            TypeOfHighClouds3,OktasOfHighClouds3,HeightOfHighClouds3,CLCODEOfHighClouds3,
            UnitOfWindSpeed,IndOrOmissionOfPrecipitation,
            TypeOfStation_Present_Past_Weather,HeightOfLowestCloud,
            StandardIsobaricSurface,GPM,DurationOfPeriodOfPrecipitation,
            Past_Weather,GrassMinTemp,CI_OfPrecipitation,BE_OfPrecipitation,Visibility,stationstandardisobaricsurface,
            IndicatorOfTypeOfIntrumentation,SignOfPressureChange,
            Supp_Info,VapourPressure,T_H_Graph',FALSE);


        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');


        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME','21:00Z'); //small to big
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }
//////////////////////////////////////////////END OF LIVE FORMS INPUT REPORTS

    ///ARCHIVED FORMS REPORT DB QUERIES START HERE. DIRECT FROM THE DB TABLE

    //ARCHIVED OBSERVATION SLIP  DATA FORM.   //FROM THE TABLE IN THE DB
    //jovRi
    public function selectArchivedObservationSlipFormReportForSpecificTimeOfADay($timeInZoo,$date,$stationName,$stationNumber,$tablename){

        $this->db->select('*');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
        $this->db->where('archived.Date', $date);
        $this->db->where('archived.TIME', $timeInZoo);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);

        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }
    }

    ///////////////////////////////////ARCHIVED METAR FORM FROM THE DB. DIRECT FROM THE DB TABLE
    // ARCHIVED METAR REPORT FOR A SPECIFIC DAY
      //jovRi
    public function selectArchivedMetarFormReportForSpecificDay($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');

        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->order_by('archived.TIME','ASC'); //small to big

        // Run the query
        $query = $this->db->get();  //WE GET MORE THAN ONE ROW.SAME DAY BUT AT DIFFERENT TIMES.ORDER BY THE TIME

        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }
    //////////////////////////
    // ARCHIVED WEATHER SUMMARY  FORM REPORT. DIRECT FRM THE DB TABLE.JUST AS IT IS.
    //jovRi
    public function selectArchivedWeatherSummaryFormDataReportForAMonth($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            TEMP_MAX,TEMP_MIN,SUNSHINE,qaBy,
            DB_0600Z,WB_0600Z,DP_0600Z,VP_0600Z,RH_0600Z,CLP_0600Z,GPM_0600Z,WIND_DIR_0600Z,FF_0600Z,
            DB_1200Z,WB_1200Z,DP_1200Z,VP_1200Z,RH_1200Z,CLP_1200Z,GPM_1200Z,WIND_DIR_1200Z,FF_1200Z,
            WIND_RUN,R_F,ThunderStorm,Fog,Haze,HailStorm,EarthQuake,AW_SubmittedBy,Approved,ApprovedBy',FALSE);
        //$this->db->from('archiveweathersummaryformreportdata');
        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $userstation=$session_data['UserStation'];
        if($userrole=='Manager' || $userrole=='SeniorDataOfficer'){
          $this->db->where('stationsdata.StationName', $stationName);
          $this->db->where('stationsdata.StationNumber', $stationNumber);

      }elseif($userrole=='Senior Weather Observer'){
          $this->db->where('stationsdata.StationName', $stationName);
          $this->db->where('stationsdata.StationNumber', $stationNumber);

      }

        $this->db->where('MONTH(archived.Date)', $monthselectedAsANumber);  //Month as a Number eg.1,2
        $this->db->where('YEAR(archived.Date)', $year);

        $this->db->order_by('DAYOFMONTH(archived.Date)','ASC');  //FRM THE SMALLEST DAY(ONE) TO BIGGEST DAY(LAST)

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    /////////////////////////////////////////////////////////
    ////////////////////////
    //ARCHIVED DEKADAL REPORT FOR ANY TEN DAYS OF A SAME MONTH. DIRECT FROM THE DB TABLE.
    //jovRi
    public function selectArchivedDekadalFormDataReportForAnyTenDaysOfAMonth($monthselectedAsANumber,$year,$stationName,$stationNumber,$dekadalnumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,
            MAX_TEMP,MIN_TEMP, Dekadalnumber,
            DRY_BULB_0600Z,WET_BULB_0600Z,DEW_POINT_0600Z,RELATIVE_HUMIDITY_0600Z,WIND_DIRECTION_0600Z,WIND_SPEED_0600Z,
            RAINFALL_0600Z,qaBy,
            DRY_BULB_1200Z,WET_BULB_1200Z,DEW_POINT_1200Z,RELATIVE_HUMIDITY_1200Z,WIND_DIRECTION_1200Z,WIND_SPEED_1200Z,AD_SubmittedBy,ApprovedBy,Approved',FALSE);


        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');

        $session_data = $this->session->userdata('logged_in');
        $userrole=$session_data['UserRole'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.Dekadalnumber', $dekadalnumber);
        $this->db->where('MONTH(archived.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(archived.Date)', $year);
        $this->db->order_by('DAYOFMONTH(archived.Date)','ASC');

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
    //////////////////////////////////ARCHIVED MONTHLY RAINFALL FROM DB
    // GET THE ARCHIVED MONTHLY RAINFALL REPORT. DIRECT FRM THE DB TABLE.
    //jovRi
    public function  selectArchivedMonthlyRainfallFormReportForAMonthFromArchiveMonthlyRainfallFormTable($monthAsANumberselected,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth, Rainfall',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
      //  $session_data = $this->session->userdata('logged_in');
       $userrole=$session_data['UserRole'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);


        $this->db->where('MONTH(archived.Date)', $monthselectedAsANumber); //MONTH NUMBER 1 FOR JAN
        $this->db->where('YEAR(archived.Date)', $year); //YR LIKE 2016,2017


        $this->db->order_by('DAYOFMONTH(archived.Date)','ASC'); //DAY OF MONTH LIKE 1 ,2 3.


        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }


    }
    /////////////////////////////////////////////////////////
    //////ARCHIVED YEARLY RAINFALL REPORT FOR A YEAR(Specific Month). FROM THE ARCHIVED MONTHLY RAINFALL DATA FOR A MONTH
    /// ARCHIVED START WITH JAN.
//jovRi
    public function  selectArchivedMonthlyRainfallReportForTheMonth($monthselectedAsANumber,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('DAYOFMONTH(Date) as DayOfTheMonth,Rainfall,AR_SubmittedBy,ApprovedBy',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
      //  $session_data = $this->session->userdata('logged_in');
      //  $userrole=$session_data['UserRole'];
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);


        $this->db->where('MONTH(archived.Date)', $monthselectedAsANumber);
        $this->db->where('YEAR(archived.Date)', $year);


        $this->db->order_by('DAYOFMONTH(archived.Date)','ASC');


        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() > 0)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }

    //ARCHIVED SYNOPTIC FORM REPORT FOR DIFFERENT TIMES OF A DAY.
      //jovRi

    public function selectArchivedSynopticFormReportDataForTime($date,$stationName,$stationNumber,$tablename,$time){
        $this->db->select('DAYOFMONTH(archived.Date) as DayOfTheMonth,
           archived.Date, archived.Time, archived.UWS, archived.BN,  archived.IOOP, archived.TSPPW, archived.HLC,
           archived.HV, archived.TCC, archived.WD, archived.WS, archived.GI1_1, archived.SignOfData_1, archived.Air_temperature, archived.GI2_1, archived.SignOfData_2,
           archived.Dewpoint_temperature, archived.GI3_1, archived.PASL, archived.GI4_1, archived.SIS, archived.GSIS, archived.GI6_1, archived.AOP, archived.DPOP, archived.GI7_1,
           archived.Present_Weather, archived.Past_Weather, archived.GI8_1, archived.AOC, archived.CLOG, archived.CGOG, archived.CHOG, archived.Section_Indicator333, archived.GI0_1,
           archived.GMT, archived.CIOP, archived.BEOP, archived.ThunderStorm, archived.HailStorm, archived.Fog, archived.EarthQuake, archived.Anemometer_Reading, archived.Actual_Rainfall, archived.GI1_2,
           archived.SignOfData_3, archived.Max_TempTx, archived.GI2_2, archived.SignOfData_4, archived.Max_TempTn, archived.GI5_1, archived.AOE, archived.ITI, archived.GI55, archived.DOS,
           archived.GI5_2, archived.SPC, archived.PCI24Hrs, archived.GI6_2, archived.AOP_2, archived.DPOP_2, archived.GI8_2, archived.AICL, archived.GOC, archived.HBCLOM, archived.GI8_3, archived.AICL_2,
           archived.GOC_2, archived.HBCLOM_2, archived.GI8_4, archived.AICL_3, archived.GOC_3, archived.HBCLOM_3, archived.GI8_5, archived.AICL_4, archived.GOC_4, archived.HBCLOM_4, archived.GI9,
           archived.Supp_Info, archived.Section_Indicator555, archived.GI1_3, archived.SignOfData_5, archived.Wetbulb_Temp, archived.R_Humidity,
           archived.V_Pressure, archived.Approved, archived.AS_SubmittedBy,archived.ApprovedBy, archived.CreationDate',FALSE);

        $this->db->from($tablename.' as archived');
        $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
        $this->db->where('archived.Date', $date);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        $this->db->where('archived.TIME',$time);
        $this->db->limit(1);


        // Run the query
        $query = $this->db->get();


        if($query -> num_rows() == 1)
        {
            $result = $query->result();
            return $result;
            //return $query->result();
        }
        else
        {
            return false;
        }

    }

    public function identifyStationById($stationName,$stationNumber){

        $this->db->select('station_id');
        $this->db->from("stations");
        $this->db->where('StationName', $stationName);
        $this->db->where('StationNumber', $stationNumber);
        $this->db->limit(1);

        $query = $this->db->get();
        $row = $query->row();
        if (isset($row))
        {
            return  $row->station_id;
        //return $query->result();
        }
        else
        {
        //$results = $query->result();
            return false;
        }

    }

    //////////////////////////////////////////////////////////////////////////
    ///// SEARCH FOR ARCHIVED SCANNED DATA STARTS HERE
    ///METAR FORM
    ///////////////////////////////////
    // ARCHIVED SCANNED METAR FORM DETAILS FOR A SPECIFIC DAY
    public function selectArchivedScannedMetarFormForSpecificDay($date,$stationName,$stationNumber,$tablename){
     $station= $this->identifyStationById($stationName,$stationNumber);
     $this->db->select('*');
     $this->db->from($tablename);
     $this->db->join('stations', 'stations.station_id = '.$tablename.'.station');
     $this->db->where( $tablename.'.station',$station);
        $this->db->where($tablename.'.Form_scanned', 'metarreport');////Only metars should be fetched
        $this->db->where($tablename.'.form_date', $date);
        $this->db->limit(1);



        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }
    // ARCHIVED SCANNED SYNOPTIC FORM DETAILS FOR A SPECIFIC DAY
    //jovRi
    public function selectArchivedScannedSynopticFormReportDetailsForSpecificDay($date,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from('scans_daily as archived');
        $this->db->join('stations', 'stations.station_id = archived.station');
        $this->db->where('archived.Form_scanned', 'synopticform');
        $this->db->where('archived.form_date', $date);
        $this->db->where('stations.StationName', $stationName);
        $this->db->where('stations.StationNumber', $stationNumber);
        // $this->db->order_by('TIME','ASC'); //small to big
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }
    // ARCHIVED SCANNED OBSERVATION SLIP FORM DETAILS FOR A SPECIFIC DAY
    public function selectArchivedScannedObservationSlipFormDetailsForSpecificDay($ObservationslipTimeInZoo,$date,$stationName,$stationNumber){
      $this->db->select('*');
      $this->db->from('scans_daily');
      $this->db->join('stations', 'stations.station_id = scans_daily.station');
    // $this->db->where('stations.StationNumber', $stationNumber);
      //$this->db->where('stations.StationName', $stationName);
      $this->db->where('scans_daily.Form_scanned', 'observationslip');
      $this->db->where('scans_daily.form_date', $date);
      $this->db->where('scans_daily.TIME', $ObservationslipTimeInZoo);

      $this->db->limit(1);



        // Run the query
      $query = $this->db->get();
      if($query -> num_rows() ==1)
      {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }

    //ARCHIVED SCANNED DEKADAL FORM REPORT FOR A GIVEN RANGE IN A MONTH
    //jovRi
    public function selectArchivedScannedDekadalFormReportDetailsForAGivenRangeInAMonth($dekadalnumber,$month,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from('scans_dekadals as scanned');
        $this->db->join('stations', 'stations.station_id =  scanned.station');

        $this->db->where('scanned.Dekadalnumber', $dekadalnumber);
        $this->db->where('scanned.month', $month);
        $this->db->where('scanned.year', $year);
        $this->db->where('stations.StationName', $stationName);
        $this->db->where('stations.StationNumber', $stationNumber);
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }

//jovRi
    public function getMonthNumber($monthStr) {
  //e.g, $month='Jan' or 'January' or 'JAN' or 'JANUARY' or 'january' or 'jan'
      $m = ucfirst(strtolower(trim($monthStr)));
      $m0=0;
      switch ($m) {
        case "January":
        case "Jan":
        $m0 = 1;
        break;
        case "Febuary":
        case "Feb":
        $m0 = 2;
        break;
        case "March":
        case "Mar":
        $m0= 3;
        break;
        case "April":
        case "Apr":
        $m0 = 4;
        break;
        case "May":
        $m0 = 5;
        break;
        case "June":
        case "Jun":
        $m0 = 6;
        break;
        case "July":
        case "Jul":
        $m0 = 7;
        break;
        case "August":
        case "Aug":
        $m0 = 8;
        break;
        case "September":
        case "Sep":
        $m0 = 9;
        break;
        case "October":
        case "Oct":
        $m0 = 10;
        break;
        case "November":
        case "Nov":
        $m0 = 11;
        break;
        case "December":
        case "Dec":
        $m0 = 12;
        break;
        default:
        $m0 = 0;
        break;
    }
    return $m0;
}
    //ARCHIVED SCANNED WEATHER SUMMARY FORM REPORT FOR A  A MONTH
    //jovRi
public function selectArchivedScannedWeatherSummaryFormReportDataDetailsForAMonth($month,$year,$stationName,$stationNumber,$tablename){
    $this->db->select('*');
    $this->db->from('scans_monthly as archived');
    $this->db->join('stations as stationsdata', 'archived.station = stationsdata.station_id');
    $this->db->where('archived.month', $month);
    $this->db->where('archived.Year', $year);
    $this->db->where('archived.Form_scanned', "Weather Summary Form");
    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);
        // $this->db->order_by('TIME','ASC'); //small to big
    $this->db->limit(1);
       // Run the query
    $query = $this->db->get();
    if($query -> num_rows() ==1)
    {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }

    }

    //ARCHIVED SCANNED Monthly Rainfall FORM REPORT FOR A  A MONTH
    //jovRi
    public function selectArchivedScannedMonthlyRainfallFormReportDataDetailsForAMonth($month,$year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        $this->db->from('scans_monthly as scanned');
        $this->db->join('stations as stationsdata', 'scanned.station = stationsdata.station_id');

        $this->db->where('scanned.month',$month);
        $this->db->where('scanned.year', $year);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        // $this->db->order_by('TIME','ASC'); //small to big
        $this->db->limit(1);



        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }



    }

    //ARCHIVED SCANNED Monthly Rainfall FORM REPORT FOR A  A MONTH
    //jovRi
    public function selectArchivedScannedYearlyRainfallFormReportDataDetailsForAYear($year,$stationName,$stationNumber,$tablename){
        $this->db->select('*');
        //$this->db->from('metar');
        $this->db->from('scans_yearly as scanned');
        $this->db->join('stations as stationsdata', 'scanned.station = stationsdata.station_id');


        $this->db->where('scanned.Year', $year);
        $this->db->where('stationsdata.StationName', $stationName);
        $this->db->where('stationsdata.StationNumber', $stationNumber);
        // $this->db->order_by('TIME','ASC'); //small to big
        $this->db->limit(1);

        // Run the query
        $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
            $result = $query->result();  //$query -> result_array();
            return $result;
            //return $query->result();
        }
        else
        {
            //$results = $query->result();
            return false;
        }
    }
     public function issue_record($id=NULL){
    $q = $this->db->query("update speci_notification set viewedby_oc='True' where speci_notification.note_id='".$this->db->escape_str($id)."'");
    $this->db->select('*');
    $this->db->from('speci_notification');
    $this->db->where('note_id', $id);
    $query = $this->db->get();
        if($query -> num_rows() ==1)
        {
           // $result = $query->result();  //$query -> result_array();
            return $query;
            //return $query->result();
        }
    }
    public function selectStations(){
        $this->load->database();
        $this->db;
        $q = $this->db->query("SELECT * FROM regions");
        return $q;   
    }
    public function SelectSubregions(){
        $this->db->select('subregion.subregion,region.region,subregion.Date_created,subregion.Time_created, subregion.Created_by,subregion.id');
        $this->db->from('subregions as subregion');
        $this->db->join('regions as region', 'subregion.region = region.id');
        $query = $this->db->get();
        return $query;
  
    }
    function AddRegion($code){
        $region=$this->input->get_post('regionname');

        $date=date("d/m/Y");
        $time=date("h:i:sa");
        $session_data = $this->session->userdata('logged_in');
        $name=$session_data['FirstName'].' '.$session_data['SurName'];
        $exists=$this->find_region($region);
        if($exists==0){
        $q = $this->db->query("insert into regions(region,Date_created,Time_created,Created_by) 
        values('$region','$date','$time','$name')");
        return $q;
        }else{
            $this->session->set_flashdata('error', '"Sorry, the region already exists! ');
            redirect('/NewStations/DisplayRegionsForm/');
        }
    }
    function AddSubRegion($code){
        $region=$this->input->get_post('region');
        $subregion=$this->input->get_post('subregionname');

        $date=date("d/m/Y");
        $time=date("h:i:sa");
        $session_data = $this->session->userdata('logged_in');
        $name=$session_data['FirstName'].' '.$session_data['SurName'];
        $exists=$this->find_region($subregion,'subregions');
        if($exists==0){
        $q = $this->db->query("insert into subregions(subregion,region,Date_created,Time_created,Created_by) 
        values('$subregion','$region','$date','$time','$name')");
        return $q;
        }else{
            $this->session->set_flashdata('error', '"Sorry, the region already exists! ');
            redirect('/NewStations/DisplayRegionsForm/');
        }
    }
    function find_region($name,$type=NULL){
        if($type!=null){
        return $this->db
         ->where('subregion', $name)
         ->count_all_results('subregions');
        }else{
         return $this->db
         ->where('region', $name)
         ->count_all_results('regions'); 
        }
  }
 function RecentWeather_andTemp($query){
        $query = $this->db->query($query);
        return $query->row_array();
        return $query->result()[0];
    }

     function max_Read($query){
        $query = $this->db->query($query);
        return $query->row_array();
    }
    function TypeOfStation_Present_Past_Weather($date,$table,$times){
        $this->db->where('Date', $date);
        $this->db->where_in('TIME', $times);
        $this->db->where('Present_weather!=', NULL);
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    function TypeOfStation_PresentPast_Weather($date,$table,$timelower,$timeupper){
        $this->db->where('Date', $date);
        $this->db->where('TIME>=', $timelower);
        $this->db->where('TIME<=', $timeupper);
        $this->db->where('Present_weather!=', NULL);
        $this->db->from($table);
        return $this->db->count_all_results();
    }
     function archievescanned_files($id=NULL){
        if($id==NULL){
            $q = $this->db->query("SELECT * from archivescannnedfiles");
        }else{
            $q = $this->db->query("SELECT * from archivescannnedfiles where record_id='$id'");  
        }
         
          return $q;
  }
  function deletearchievescannedfile($id){
   
    $q = $this->db->query("DELETE from archivescannnedfiles where id='$id'");
    return $q;
}

function checkforDuplicatearchivescanned($query){

 $q = $this->db->query($query);
  return $q -> num_rows() ;
  
  }
  function checkduplicatereports($query){

    $q = $this->db->query($query);
     return $q;
     }

 function allsubmittedreports($id=NULL){
    $session_data = $this->session->userdata('logged_in');
    $userrole=$session_data['UserRole'];
    $userid =$session_data['Userid'];
    $region =$this->SelectZonal($userid);
    $regionsarray=explode(',',$region);
    $regions="";
    for($i=0;$i<sizeof($regionsarray);$i++){
        if($i==0){
        $regions=$regions."'".$regionsarray[$i]."'";
        }else{
            $regions=$regions.','."'".$regionsarray[$i]."'";
        }
    }
    if(strcmp($userrole,'SeniorZonalOfficer')==0||strcmp($userrole,'ZonalOfficer')==0){
        $q = $this->db->query("
        SELECT *
        FROM submitted_reports    t1
        JOIN stations as t2
        ON t1.station= t2.station_id
        JOIN systemusers     t3
        ON t1.submitedby    = t3.UserId 
        where t2.StationRegion in ($regions) and t1.report_type='$id' order by t1.id desc
        ");
        }else{
        $q = $this->db->query("
        SELECT *
          FROM submitted_reports    t1
          JOIN stations as t2
          ON t1.station= t2.station_id
          JOIN systemusers     t3
          ON t1.submitedby    = t3.UserId 
          where t1.forwardtomanager='True' and report_type='$id'
          order by t1.id desc
        ");
    }
    
    //$q = $this->db->query("SELECT * FROM submitted_reports");
    return $q;
  }

  function updatesubmittedreports($query){

    $q = $this->db->query($query);
     return $q;
  }

  function getstationDetails($id){
    $q = $this->db->query("select * from stations where station_id='$id'");
     return $q->result()['0'];
  }

 function selectStationData($id=NULL){
    if($id=="region"){
        $q = $this->db->query("select * from regions");
    }elseif($id=="subregion"){
        $q = $this->db->query("select distinct($id),StationRegion from stations where $id!=''");
    }elseif($id=="district"){
        $q = $this->db->query("select distinct($id),subregion from stations where $id!=''");
    }elseif($id=="county"){
        $q = $this->db->query("select distinct($id),district from stations where $id!=''");
    }elseif($id=="subcounty"){
        $q = $this->db->query("select distinct($id),county from stations where $id!=''");
    }elseif($id=="parish"){
        $q = $this->db->query("select distinct($id),subcounty from stations where $id!=''");
    }elseif($id=="village"){
        $q = $this->db->query("select distinct($id),parish from stations where $id!=''");
    }else{
        if($id==NULL){

        $this->db->select('*');
        if($this->input->post('region')!=NULL){
         $this->db->where('StationRegion', $this->input->post('region'));
        }
        if($this->input->post('subregion')!=NULL){
        $this->db->where('subregion', $this->input->post('subregion'));
        }
        if($this->input->post('district')!=NULL){
          $this->db->where('district', $this->input->post('district'));
        }
        if($this->input->post('county')!=NULL){
          $this->db->where('county', $this->input->post('county'));
        } 
        if($this->input->post('subcounty')!=NULL){
          $this->db->where('subcounty', $this->input->post('subcounty'));
        }
        if($this->input->post('parish')!=NULL){
          $this->db->where('parish', $this->input->post('parish'));
        }
        if($this->input->post('village')!=NULL){
          $this->db->where('village', $this->input->post('village'));
        }
        $this->db->from("stations");
        $q=$this->db->get();
        }
    }
    return $q->result(); 
  }


  function StationPerfomance($id=NULL){

        if($id==NULL){
        $this->db->distinct()->select('t1.*');
        $this->db->from("stations as t1" );
        $this->db->join("observationslip as t2","t1.station_id=t2.station","inner");
        if($this->input->post('region')!=NULL){
         $this->db->where('t1.StationRegion', $this->input->post('region'));
        }
        if($this->input->post('subregion')!=NULL){
        $this->db->where('t1.subregion', $this->input->post('subregion'));
        }
        if($this->input->post('district')!=NULL){
          $this->db->where('t1.district', $this->input->post('district'));
        }
        if($this->input->post('county')!=NULL){
          $this->db->where('t1.county', $this->input->post('county'));
        } 
        if($this->input->post('subcounty')!=NULL){
          $this->db->where('t1.subcounty', $this->input->post('subcounty'));
        }
        if($this->input->post('parish')!=NULL){
          $this->db->where('t1.parish', $this->input->post('parish'));
        }
        if($this->input->post('village')!=NULL){
          $this->db->where('t1.village', $this->input->post('village'));
        }
        if($this->input->post('startdate')!=NULL){
            $this->db->where('t2.date>=', $this->input->post('startdate'));
        }
        if($this->input->post('enddate')!=NULL){
          $this->db->where('t2.date<=', $this->input->post('enddate'));
        }
        //$this->db->group_by('t1.station_id');
        $q=$this->db->get();
        }
    return $q->result(); 
  }

  function RainfallOfFirstNextMonth($month,$year,$stationName,$stationNumber,$table,$time=NULL){
    $this->db->select_sum('Rainfall');
    $this->db->from($table.' as slip');
    $this->db->join('stations as stationsdata', 'slip.station = stationsdata.station_id');
    $this->db->where('stationsdata.StationName', $stationName);
    $this->db->where('stationsdata.StationNumber', $stationNumber);
     $this->db->where('DAYOFMONTH(slip.Date)=','01');
     $this->db->where('MONTH(slip.Date)=',$month);
    $this->db->where('YEAR(slip.Date)=',$year);
    if($time!=NULL)
    $this->db->where('slip.TIME',$time);
    $result= $this->db->get()->row();
    if($result->Rainfall!=NULL)
    return $result->Rainfall;
    else return 0;
    
  }
  function Allstations(){
     $this->db->select('*') ;
     $this->db->from('stations');
     $result= $this->db->get();
     return $result;

  }
  }



?>
