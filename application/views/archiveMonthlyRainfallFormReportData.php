<?php require_once(APPPATH . 'views/header.php'); ?>
<?php  $session_data = $this->session->userdata('logged_in');
$userrole=$session_data['UserRole'];
$userstation=$session_data['UserStation'];
$userstationNo=$session_data['StationNumber'];
//$userstationNo=$session_data['StationNumber'];
$name=$session_data['FirstName'].' '.$session_data['SurName'];
//'StationNumber' => $row->StationNumber,
?>
<script>
 function validation(expectedmin,expectedmax,value,id){
    // var compwithmin=expectedmin.localeCompare(value);
    // var compwithmax=expectedmax.localeCompare(value);
    if(parseInt(value,10)< parseInt(expectedmin,10)){
        document.getElementById(id).innerHTML="<i style='color:red;'>Value less than minimum expected. The expected min is <b>"+expectedmin+"</b></i>";
    }else if(parseInt(value,10)  >parseInt(expectedmax,10)){
        document.getElementById(id).innerHTML="<i style='color:red;'>Value greater than maximum expected. The expected max is <b>"+expectedmax+"</b></i>";
    }else{
        document.getElementById(id).innerHTML=" ";
    }
        
return false;
}
</script>
 <script language="javascript">
                                function allowIntegerInputOnly(inputvalue) {
                                    //var invalidChars = /[^0-9]/gi
                                    var integerOnly =/[^0-9\.]/gi;  // integers and decimals //
                                    if(integerOnly.test(inputvalue.value)) {
                                        inputvalue.value = inputvalue.value.replace(integerOnly,"");
                                    }
                                }

                                function allowCharactersInputOnly(inputvalue) {
                                    //var invalidChars = /[^0-9]/gi
                                    var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                                    if(charsOnly.test(inputvalue.value)) {
                                        inputvalue.value = inputvalue.value.replace(charsOnly,"");
                                    }
                                }
                            </script>
<script> 
                                    function fixmonth(){
                                         var month = document.getElementById('month').value;
                                         var year = document.getElementById('year').value;
                                         var months={"January":'01',
                                                     "February":"02",
                                                     "March":"03",
                                                     "April":"04",
                                                     "May":"05",
                                                     "June":"06",
                                                     "July":"07",
                                                     "August":"08",
                                                     "September":"09",
                                                     "October":"10",
                                                     "November":"11",
                                                     "December":"12",
                                                    }
                                                    

                                         var nodes=document.querySelectorAll("input[type=date]");
                                         for(var i=0;i<nodes.length;i++){
                                             //nodes[i].setAttribute('disabled',true);
                                             
                                             if(i>31){
                                                nodes[i].setAttribute('value',year+"/"+months[month]+"/"+i);
                                                nodes[i].setAttribute('disabled',true);
                                             }else{
                                                nodes[i].setAttribute('min',year+"-"+months[month]+"-01");
                                                nodes[i].setAttribute('max',year+"-"+months[month]+"-"+daysInMonth(months[month],year));
                                             }
                                         }
                                         
                                    }
                                   function daysInMonth(imonth,iyear){
                                       return  new Date(iyear,imonth,0).getDate();
                                   }

                                </script>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Archive Monthly Rainfall Report Data
                <small> Page</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"> Archive Monthly Rainfall Report Data</li>

            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <?php require_once(APPPATH . 'views/error.php'); ?>
            <?php

            if(is_array($displaynewarchivemonthlyrainfallForm) && count($displaynewarchivemonthlyrainfallForm)) {
                ?>
                <div class="row">
                    <form action="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/insertMonthlyRainfallFormReportData/" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div id="output"></div>
                           
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                 <div class="input-group">
                                    <span class="input-group-addon">Region</span>
                                    <select name="RegionName" id="regions"  required class="form-control" placeholder="Select Region">
                                    <option value="">--Select REGION--</option>
                                        <?php
                                        if($regions->num_rows()>0){
                                            foreach($regions->result() as $row){
                                        ?>
                                         <option value="<?php echo $row->region; ?>"><?php echo $row->region; ?></option>
                                        <?php 
                                                }
                                            }
                                        ?> 
                                     </select> 
                                    </div>
                                 </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">

                                    <span class="input-group-addon">Station Name</span>
                                    <select  name="station_archivedailymonthlyrainfalldata" class="form-control"  id="stations-list"
                                      required selected="selected">
                                      <option value="">-- Select Station--</option>
                                        <option id="stations-list" > </option>
                                        
                                    </select>
                                   </div>
                                   </div>

                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Sub region</span>
                                        <select  name="subregion" class="form-control"  id="subregions-list"
                                          required selected="selected" required>
                                          <option value="">-- Select Sub region--</option>
                                            <option id="subregions-list" > </option>
                                            
                                        </select>
                                    </div>
                                  </div>
                                 </div>
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"> Station Number</span>
                                           
                                             <input type="text" name="stationNo_archivedailymonthlyrainfalldata"  id="stationNoManager"  class="form-control compulsory" value=""  readonly class="form-control"  >
                                        </div>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Month</span>
                                        <input type="text" onchange="fixmonth()" name="month"  class="form-control compulsory" placeholder="Enter select month" id="month">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select year</span>
                                        <input type="text" onchange="fixmonth()" name="year"  class="form-control compulsory" placeholder="Enter select year" id="year">
                                        
                                    </div>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" min="" name="date_archivedailymonthlyrainfalldata"  class="form-control compulsory" placeholder="Enter select date" id="dateone">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata" id="rainfall_archivedailymonthlyrainfalldata"  onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                      <span id="errorrainnew" style="min-height: 2px;"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date"  name="date_archivedailymonthlyrainfalldata2"  class="form-control compulsory" placeholder="Enter select date" id="date2">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata2" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew2')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew2"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata3"  class="form-control compulsory" placeholder="Enter select date" id="date3">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata3" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew3')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew3"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata4"  class="form-control compulsory" placeholder="Enter select date" id="date4">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata4" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew4')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                      <span id="errorrainnew4"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata5"  class="form-control compulsory" placeholder="Enter select date" id="date5">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata5" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew5')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                      <span id="errorrainnew5"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata6"  class="form-control compulsory" placeholder="Enter select date" id="date6">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata6" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew6')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                      <span id="errorrainnew6"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6"><div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata7"  class="form-control compulsory" placeholder="Enter select date" id="date7">
                                        
                                    </div>
                                </div></div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata7" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew7')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                      <span id="errorrainnew7"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata8"  class="form-control compulsory" placeholder="Enter select date" id="date8">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata8" id="rainfall_archivedailymonthlyrainfalldata"  onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew8')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew8"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6"><div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata9"  class="form-control compulsory" placeholder="Enter select date" id="date9">
                                        
                                    </div>
                                </div></div>
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata9" id="rainfall_archivedailymonthlyrainfalldata"  onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew9')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew9"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata10"  class="form-control compulsory" placeholder="Enter select date" id="date10">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata10" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew10')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew10"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6"> <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata11"  class="form-control compulsory" placeholder="Enter select date" id="date11">
                                        
                                    </div>
                                </div></div>
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata11" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew11')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew11"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata12"  class="form-control compulsory" placeholder="Enter select date" id="date12">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata12" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew12')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew12"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata13"  class="form-control compulsory" placeholder="Enter select date" id="date13">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata13" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew13')"  class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew13"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata14"  class="form-control compulsory" placeholder="Enter select date" id="date14">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata14" id="rainfall_archivedailymonthlyrainfalldata"  onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew14')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew14"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata15"  class="form-control compulsory" placeholder="Enter select date" id="date15">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata15" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew15')"  class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew15"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata16"  class="form-control compulsory" placeholder="Enter select date" id="date16">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata16" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew16')"  class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew16"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata17"  class="form-control compulsory" placeholder="Enter select date" id="date17">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata17" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew17')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew17"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata18"  class="form-control compulsory" placeholder="Enter select date" id="date18">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata18" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew18')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew18"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata19"  class="form-control compulsory" placeholder="Enter select date" id="date19">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata19" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew19')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew19"></span>
                                    </div>
                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata20"  class="form-control compulsory" placeholder="Enter select date" id="date20">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata20" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew20')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew20"></span>
                                    </div>
                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata21"  class="form-control compulsory" placeholder="Enter select date" id="date21">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata21" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew21')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew21"></span>
                                    </div>
                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata22"  class="form-control compulsory" placeholder="Enter select date" id="date22">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata22" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew22')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew22"></span>
                                    </div>
                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata23"  class="form-control compulsory" placeholder="Enter select date" id="date23">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata23" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew23')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew23"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata24"  class="form-control compulsory" placeholder="Enter select date" id="date24">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata24" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew24')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew24"></span>
                                    </div>
                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata25"  class="form-control compulsory" placeholder="Enter select date" id="date25">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata25" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew25')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew25"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata26"  class="form-control compulsory" placeholder="Enter select date" id="date26">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata26" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew26')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew26"></span>
                                    </div>
                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata27"  class="form-control compulsory" placeholder="Enter select date" id="date27">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata27" id="rainfall_archivedailymonthlyrainfalldata"  onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew27')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew27"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6"> <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata28"  class="form-control compulsory" placeholder="Enter select date" id="date28">
                                        
                                    </div>
                                </div></div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata28" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew28')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew28"></span>
                                    </div>
                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata29"  class="form-control compulsory" placeholder="Enter select date" id="date29">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata29" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew29')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew29"></span>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata30"  class="form-control compulsory" placeholder="Enter select date" id="date30">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata30" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew30')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew30"></span>
                                    </div>
                                 </div>
                             </div>
                              <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" name="date_archivedailymonthlyrainfalldata31"  class="form-control compulsory" placeholder="Enter select date" id="date31">
                                        </div> 
                                    </div>
                                </div>
                                
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata31" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'errorrainnew31')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                       <span id="errorrainnew31"></span>
                                    </div>
                                    
                                 </div>
                             </div>
                             
                              
                            <div class="clearfix"></div>
                        </div>

                        <center>

                            <a href="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                            <button type="submit" id="postarchiveMonthlyRainfallFormReportdata_button" name="postarchiveMonthlyRainfallFormReportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT</button>
                        </center>
                    </form>
                </div>
                <?php
            }elseif((is_array($updatearchivedmonthlyrainfallformreportdata) && count($updatearchivedmonthlyrainfallformreportdata))) {
                //foreach($updatearchivedmonthlyrainfallformreportdata as $rainfalldata){

                    $rainfalldataid = $rainfalldata->id;
                    ?>
                    <div class="row">
                        <!-- <form action="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/UpdateMonthlyRainfallFormReportData" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div id="output"></div>
                                <script language="javascript">
                                    function allowIntegerInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var integerOnly =/[^0-9\.'NIL''TR' ]/gi;  // integers and decimals //
                                        if(integerOnly.test(inputvalue.value)) {
                                            inputvalue.value = inputvalue.value.replace(integerOnly,"");
                                        }
                                    }

                                    function allowCharactersInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                                        if(charsOnly.test(inputvalue.value)) {
                                            inputvalue.value = inputvalue.value.replace(charsOnly,"");
                                        }
                                    }
                                </script>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Select Date</span>
                                            <input type="text" name="date" class="form-control" value="<?php echo $rainfalldata->Date;?>" placeholder="Enter select date" id="expdate">
                                            <input type="hidden" name="checkduplicateEntryOnUpdateArchieveMonthlyRainfallFormReportData" id="checkduplicateEntryOnUpdateArchieveMetarFormData">
                                            <input type="hidden" name="id" value="<?php echo $rainfalldata->id;?>">
                                        </div>
                                    </div>


                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Station</span>
                                                <input type="text" name="station" id="station" required class="form-control" value="<?php echo $rainfalldata->StationName;?>"  readonly class="form-control" >

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"> Station Number</span>
                                                <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $rainfalldata->StationNumber;?>" readonly="readonly" >
                                            </div>
                                        </div>



                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RAINFALL</span>
                                            <input type="text" name="rainfall" id="rainfall" value="<?php echo $rainfalldata->Rainfall;?>"  required class="form-control" required placeholder="Enter RAINFALL" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Approved</span>
                                           <?php if($userrole=="DataOfficer" || $rainfalldata->Approved=='TRUE'){?>
                                    <select name="approval" id="approval" readonly  class="form-control" >
                                        <option value="<?php echo $rainfalldata->Approved;?>"><?php echo $rainfalldata->Approved;?></option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                    <input type="hidden" readonly name="approval" value="<?php echo $rainfalldata->Approved;?>">
                                    <?php }else{?>
                                       <select name="approval" id="approval"  class="form-control" >
                                        <option value="<?php echo $rainfalldata->Approved;?>"><?php echo $rainfalldata->Approved;?></option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                    <?php }?>
                                        </div>
                                    </div>



                                </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <center>

                                <a href="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                                <button type="submit" name="updatearchiveMonthlyRainfallformreportdata_button" id="updatearchiveMonthlyRainfallformreportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE</button>
                            </center>
                        </form> -->
                        
                        <form action="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/UpdateMonthlyRainfallFormReportData" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div id="output"></div>
                            <script language="javascript">
                                function allowIntegerInputOnly(inputvalue) {
                                    //var invalidChars = /[^0-9]/gi
                                    var integerOnly =/[^0-9\.]/gi;  // integers and decimals //
                                    if(integerOnly.test(inputvalue.value)) {
                                        inputvalue.value = inputvalue.value.replace(integerOnly,"");
                                    }
                                }

                                function allowCharactersInputOnly(inputvalue) {
                                    //var invalidChars = /[^0-9]/gi
                                    var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                                    if(charsOnly.test(inputvalue.value)) {
                                        inputvalue.value = inputvalue.value.replace(charsOnly,"");
                                    }
                                }
                            </script>

                            <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                             <div class="input-group">
                                <span class="input-group-addon">Region</span>
                                <select name="RegionName" id="regions"  required class="form-control" placeholder="Select Region">
                                <option value="">--Select REGION--</option>
                                    <?php
                                    if($regions->num_rows()>0){
                                        foreach($regions->result() as $row){
                                    ?>
                                     <option value="<?php echo $row->region; ?>"><?php echo $row->region; ?></option>
                                    <?php 
                                            }
                                        }
                                    ?> 
                                 </select> 
                                </div>
                             </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">

                                    <span class="input-group-addon">Station Name</span>
                                    <select  name="station" class="form-control"  id="stations-list"
                                      required selected="selected">
                                      
                                      <option value="<?php echo $updatearchivedmonthlyrainfallformreportdata[0]->StationName;?>"><?php echo $updatearchivedmonthlyrainfallformreportdata[0]->StationName;?></option>
                                        <option id="stations-list" > </option>
                                        
                                    </select>
                                    </div>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Sub region</span>
                                    <select  name="subregion" class="form-control"  id="subregions-list"
                                      required selected="selected" required>
                                      <option value="">-- Select Sub region--</option>
                                        <option id="subregions-list" > </option>
                                        
                                    </select>
                                </div>
                              </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"> Station Number</span>
                                           
                                             <input type="text" name="stationNo"  id="stationNoManager"  class="form-control compulsory" value=""  readonly class="form-control"  >
                                        </div>
                                    </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Month</span>
                                        <input type="text" onchange="fixmonth()" name="month"  class="form-control compulsory" value="<?php echo $updatearchivedmonthlyrainfallformreportdata[0]->month;?>" id="month">
                                        
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                      <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select year</span>
                                        <input type="text" onchange="fixmonth()" name="year" value="<?php echo $updatearchivedmonthlyrainfallformreportdata[0]->year;?>" class="form-control compulsory"  id="year">
                                        
                                    </div>
                                </div>
                                 </div>
                             </div>
                              <?php $i=1;  foreach($updatearchivedmonthlyrainfallformreportdata as $rainfalldata){ ?>
                                <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date" min="" name="date_archivedailymonthlyrainfalldata<?php echo $i ?>" value="<?php echo $rainfalldata->Date;?>"  class="form-control compulsory" id="dateone">
                                        <input type="hidden" name="id<?php echo $i ?>" value="<?php echo $rainfalldata->id;?>">
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata<?php echo $i ?>" value="<?php echo $rainfalldata->Rainfall ?>" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'error<?php echo $i ?>rainnew')" class="form-control"   >
                                      </div>
                                       <span id="error<?php echo $i ?>rainnew"></span>
                                    </div>
                                 </div>
                             </div>
                               
                            <?php $i++;} ?>
                            <?php  for($j=0;$j<(31-count($updatearchivedmonthlyrainfallformreportdata));$j++){ ?> 
                                <div class="row">
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">Select Date</span>
                                        <input type="date"  name="date_archivedailymonthlyrainfalldata<?php echo $i ?>"  class="form-control compulsory" value="" id="date2">
                                        <input type="hidden" name="id<?php echo $i ?>" value="<?php echo $rainfalldata->id;?>"> 
                                        <input type="hidden" name="station_id" value="<?php echo $updatearchivedmonthlyrainfallformreportdata[0]->station;?>">
                                    </div>
                                </div>
                                 </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                      <div class="input-group">
                                        <span class="input-group-addon">RAINFALL VALUE</span>
                                        <input type="text" name="rainfall_archivedailymonthlyrainfalldata<?php echo $i ?>" id="rainfall_archivedailymonthlyrainfalldata" onchange="validation(window.min_rain,window.max_rain,this.value,'error<?php echo $i ?>rainnew')" class="form-control"  placeholder="Enter MAX" >
                                      </div>
                                        <span id="error<?php echo $i ?>rainnew"></span>
                                    </div>
                                 </div>
                             </div>   
                                
                                <?php $i++; } ?>
                            
                             
                             <div class="row">
                                 <div class="col-lg-6"></div>
                                 <div class="col-lg-6"></div>
                             </div>


                            
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Approved</span>
                                           <?php if($userrole=="DataOfficer" || $rainfalldata->Approved=='TRUE'){?>
                                    <select name="approval" id="approval" readonly  class="form-control" >
                                        <option value="<?php echo $rainfalldata->Approved;?>"><?php echo $rainfalldata->Approved;?></option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                    <input type="hidden" readonly name="approval" value="<?php echo $rainfalldata->Approved;?>">
                                    <?php }else{?>
                                       <select name="approval" id="approval"  class="form-control" >
                                        <option value="<?php echo $rainfalldata->Approved;?>"><?php echo $rainfalldata->Approved;?></option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                    <?php }?>
                                        </div>
                                    </div>
                            <div class="clearfix"></div>
                        </div>

                        <center>

                            <a href="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                            <button type="submit" id="postarchiveMonthlyRainfallFormReportdata_button" name="postarchiveMonthlyRainfallFormReportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> SUBMIT</button>
                        </center>
                    </form>
                    </div>
                                        <?php
                     }elseif((is_array($validatearchivedmonthlyrainfallformreportdata) && count($validatearchivedmonthlyrainfallformreportdata))) {
                foreach($validatearchivedmonthlyrainfallformreportdata as $rainfalldata){

                    $rainfalldataid = $rainfalldata->id;
                    ?>
                    <div class="row">
                        <form action="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/UpdateMonthlyRainfallFormReportData" method="post" enctype="multipart/form-data">
                           <input type="hidden" name="qualitycontrolled" value="qa">
                            <div class="modal-body">
                                <div id="output"></div>
                                <script language="javascript">
                                    function allowIntegerInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var integerOnly =/[^0-9\.'NIL''TR' ]/gi;  // integers and decimals //
                                        if(integerOnly.test(inputvalue.value)) {
                                            inputvalue.value = inputvalue.value.replace(integerOnly,"");
                                        }
                                    }

                                    function allowCharactersInputOnly(inputvalue) {
                                        //var invalidChars = /[^0-9]/gi
                                        var charsOnly =/[^A-Za-z]/gi;  // integers and decimals // /[^0-9\.]/gi;
                                        if(charsOnly.test(inputvalue.value)) {
                                            inputvalue.value = inputvalue.value.replace(charsOnly,"");
                                        }
                                    }
                                </script>
                                <script>
                                   function validation(oldvalue,newvalue,id){
                                     if((oldvalue!=newvalue)&&(oldvalue!="")){
                                       document.getElementById(id).innerHTML="<i style='color:red;'>Value mismatch. The value <b>"+oldvalue+"</b> was previously captured</i>";
                                        }else if((oldvalue=="")){
                                       document.getElementById(id).innerHTML="<i style='color:orange;'>No value was filled in this field previously</i>";             
                                         }else{
                                                    document.getElementById(id).innerHTML="<i style='color:green;' class='fa fa-check'> values match</i>";
                                                        
                                                    }
                                    }
                                </script>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <div class="input-group">
                                        <input type="hidden" name="stationarchive"  required class="form-control" value="<?php echo $rainfalldata->station;?>"  readonly class="form-control" >
                                            <span class="input-group-addon">Select Date</span>
                                            <input type="text" name="date_archivedailymonthlyrainfalldata1" class="form-control" value="<?php echo $rainfalldata->Date;?>" placeholder="Enter select date" id="expdate">
                                            <input type="hidden" name="checkduplicateEntryOnUpdateArchieveMonthlyRainfallFormReportData" id="checkduplicateEntryOnUpdateArchieveMetarFormData">
                                            <input type="hidden" name="id1" value="<?php echo $rainfalldata->id;?>">
                                            <input type="hidden" name="station_id" value="<?php echo $rainfalldata->station;?>">
                                        </div>
                                    </div>


                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">Station</span>
                                                <input type="text" name="station" id="station" required class="form-control" value="<?php echo $rainfalldata->StationName;?>"  readonly class="form-control" >

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"> Station Number</span>
                                                <input type="text" name="stationNo" required class="form-control" id="stationNo" readonly class="form-control" value="<?php echo $rainfalldata->StationNumber;?>" readonly="readonly" >
                                            </div>
                                        </div>



                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">RAINFALL</span>
                                            <input type="text" name="rainfall_archivedailymonthlyrainfalldata1"  value="" onkeyup="allowIntegerInputOnly(this);validation('<?php echo $rainfalldata->Rainfall;?>',this.value,'errorrainfall');"  required class="form-control" required placeholder="Enter RAINFALL" >
                                        </div>
                                        <span id="errorrainfall"></span>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">Approved</span>
                                           <?php if($userrole=="DataOfficer" || $rainfalldata->Approved=='TRUE'){?>
                                    <select name="approval" id="approval" readonly  class="form-control">
                                        <option value="<?php echo $rainfalldata->Approved;?>"><?php echo $rainfalldata->Approved;?></option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                    <input type="hidden" readonly name="approval" value="<?php echo $rainfalldata->Approved;?>">
                                    <?php }else{?>
                                       <select name="approval" id="approval"  class="form-control" readonly >
                                        <option value="<?php echo $rainfalldata->Approved;?>"><?php echo $rainfalldata->Approved;?></option>
                                        <option value="TRUE">TRUE</option>
                                        <option value="FALSE">FALSE</option>
                                    </select>
                                    <?php }?>
                                        </div>
                                    </div>



                                </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <center>

                                <a href="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/" class="btn btn-danger"><i class="fa fa-arrow-left"></i> BACK</a>

                                <button type="submit" name="updatearchiveMonthlyRainfallformreportdata_button" id="updatearchiveMonthlyRainfallformreportdata_button" class="btn btn-primary"><i class="fa fa-plus"></i> UPDATE</button>
                            </center>
                        </form>
                    </div>
                    <?php
                }
               }else{
                if($userrole!="QC"){
                ?>
                <div class="row">
                    <div class="col-xs-3"><a class="btn btn-primary no-print"
                                             href="<?php echo base_url()."index.php/ArchiveMonthlyRainfallFormReportData/DisplayNewArchiveMonthlyRaifallForm/";?>"
                        <i class="fa fa-plus"></i> Add Archive Monthly Rainfall</a>



                    </div>

                </div>
                <?php } ?>
                <br>
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"> Archive Monthly Rainfall Report</h3>
                            </div><!-- /.box-header -->
                            <?php require_once(APPPATH . 'views/error.php'); ?>
                            <div class="box-body table-responsive" style="overflow:auto">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Date</th>
                                        <th>Station</th>
                                        <th>Station No</th>

                                        <th>RAINFALL</th>
                                        <th>Quality Control</th>
                                            <th>Approved</th>
                                             <th>Comments</th>
                                            <th>Submitted By</th>
                                            
                                            <th class="no-print">Action</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 0;
                                    if (is_array($archivedrainfalldata) && count($archivedrainfalldata)) {
                                        foreach($archivedrainfalldata as $data){
                                         
                                            $id = $data->id;
                                             if($userrole =='DataOfficer'&& $data->Approved =='TRUE' ){
                                           $count++;
                                           }else{
                                               $count++;

                                            ?>
                                            <tr>
                                                <td ><?php echo $count;?></td>
                                                <td ><?php echo $data->Date;?></td>
                                                <td ><?php echo $data->StationName;?></td>
                                                <td ><?php echo $data->StationNumber;?></td>
                                                <td ><?php echo $data->Rainfall;?></td>
                                                <td><?php echo ($data->qaBy==NULL)?"Pending":$data->qaBy; ?></td>
                                             <td><?php echo $data->Approved;?></td>
                                              <td class="no-print"> 

                                                <?php if($data->Approved=="FALSE" || $userrole!='DataOfficer'){ ?>
                                                  <h6><?php echo $data->numberofcomments; ?> comments on this record</h6>
                                                  <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/index/<?php echo $data->id ?>/">View/ Add Comments</a> <br><br>
                                                <?php }else{ ?> 
                                                <h6 style="color:green;"> <li class='fa fa-check'></li> Record approved</h6>
                                                <?php }?>
                                                </td>

                                             <td><?php echo $data->AR_SubmittedBy;?></td>
                                             <td class="no-print">
                                          <table>
                                         <tr><td>
                                             <?php  if($userrole=='QC'){?>
                                                <?php if($data->qaBy==NULL){?>
                                                    <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "index.php/ArchiveMonthlyRainfallFormReportData/DisplayArchivedMonthlyRainfallFormForValidation/" .$id ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li>Verify</a>
                                                <?php }else{ ?>
                                                    <a class="btn btn-success btn-xs" href="" disabled><li class="fa fa-check"></li> Verified </a>
                                                <?php } ?>
                                            
                                         <?php }else{ ?>
                                            <a class="btn btn-primary" href="<?php echo base_url() . "index.php/ArchiveMonthlyRainfallFormReportData/DisplayArchivedMonthlyRainfallFormForUpdate/" .$data->month."/".$data->year ;?>" style="cursor:pointer;"><li class="fa fa-edit"></li>Edit</a>
                                         <?php } ?>
                                           </td>
                     <?php if($userrole== 'SeniorDataOfficer' && $data->Approved=="TRUE" ){?>
                        <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveMonthlyRainfallFormReportData/update_approval/" .$id ;?>"> <input type="hidden" name="id" value="<?php echo $id?>" ><input type="hidden" name="approve" value="FALSE" ><button class="btn btn-danger"  type="submit"  ><li class='fa fa-times'></li> Disapprove</button></form>
                            </td> <?php }elseif( $userrole=='Senior Weather Observer' && $data->Approved=="FALSE" || $userrole =='SeniorDataOfficer' && $data->Approved=="FALSE"){?>
                                <td><form method="post" action="<?php echo base_url() . "index.php/ArchiveMonthlyRainfallFormReportData/update_approval/" .$id ;?>"> <input type="hidden" name="id" value="<?php echo $id ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success"  type="submit"  ><li class='fa fa-check'></li> Approve &nbsp;&nbsp;&nbsp;&nbsp;</button></form>
                                </td>

                                <?php
                            }else{ }?>
                                            <!-- <?php if($userrole=='SeniorDataOfficer'){?>
                                            <td>
                                            <form method="post" action="<?php echo base_url() . "index.php/ArchiveMonthlyRainfallFormReportData/update_approval/" .$id ;?>"> <input type="hidden" name="id" value="<?php echo $id; ?>" ><input type="hidden" name="approve" value="TRUE" ><button class="btn btn-success" <?php if($data->Approved=='TRUE'){ echo "disabled";}?> type="submit"  ><li class='fa fa-check'></li>Approve</button></form>
                                            </td><?php }?>  -->
                                         </tr>
                                         </table>
                                              </td>
                                              </tr>

                                            <?php
                                           }}
                                    
                                  }
                                    ?>
                                    </tbody>
                                </table>
                                <br>
                                  <?php if(isset($observationslipcomments)){ ?>
              
                          <div class="row no-print" style="padding:10px;">
                            
                            <div class="col-md-6">
                            <h4 >Comments</h4>
                             
                              <ul>
                               <?php if(count($observationslipcomments)){
                                foreach($observationslipcomments as $row){ ?>
                                <li><?php echo $row->comment ?>
                                <br>
                                <b><?php echo $row->comment_by.' [ '.$row->userrole.' ] ' ?></b>
                                <?php if($row->solved!="TRUE"){
                                      if($userrole=="SeniorDataOfficer"){ ?>
                                     <a style="margin-left:10px;" href="<?php echo base_url(); ?>index.php/ArchiveObservationSlipFormData/markcommentAsResolved/<?php echo $row->id; ?>" class='btn btn-info btn-xs'>Mark as resolverd</a>
                                     <?php }else{ ?>
                                        
                                     <?php } }else{ ?>
                                       <span style="color:green;margin-left:30px;"><i class="fa fa-check"></i> Resolved</span>
                                     <?php } ?>
                                </li>
                                <?php } }else{ ?>
                                 <h5>No Comments on this record</h5>
                                <?php } ?>
                              </ul>
                            </div>
                            <div class="col-md-6">
                            <h4 >Add a comment</h4>
                            <form method="post" action="<?php echo base_url(); ?>index.php/ArchiveMonthlyRainfallFormReportData/submitObservationslipComment/">
                            <input type="hidden" name="recordid" value="<?php echo $id ?>" id="">
                            <textarea name="comment" id="" cols="20" rows="6" class="form-control" placeholder="type your comment here">
                            
                            </textarea>
                            <br>
                            <button class="btn tn-info btn-sm" type="submit">Submit comment</button>
                            </form>
                            </div>
                          </div>
                         <?php } ?>
                                <br>
                                <button onClick="print();" class="btn btn-primary no-print"><i class="fa fa-print"></i> PRINT</button>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </div>
                <?php
            }
            ?>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
    <!-- jQuery 2.0.2
 <script src="js/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(documenwwt).ready(function() {
            //Post Add New  Archive Dekadal  form Report data into the DB
            //Validate each select field before inserting into the DB
            $('#postarchiveMonthlyRainfallFormReportdata_button').click(function(event) {
                //Check for duplicate Entry Data.
                var returntruthvalue=checkDuplicateEntryData_OnAddArchiveMonthlyRainfallFormReportData();
                //if true there is already an entry
                if(returntruthvalue=="true"){

                    alert("Archived Rainfall Record with the Same date ,station name and Station Number Already Exists");
                    return false;
                }else if(returntruthvalue=="Missing"){

                    alert("Station Name or Number or date not picked");
                    return false;
                }



                //Check value of the hidden text field.That stores whether a row is duplicate
                var hiddenvalue=$('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').val();
                if(hiddenvalue==""){  // returns true if the variable does NOT contain a valid number
                    alert("Value not picked");
                    $('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').val("");  //Clear the field.
                    $("#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield").focus();
                    return false;

                }

                //Check that Date selected
                var date=$('#date').val();
                if(date==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#date').val("");  //Clear the field.
                    $("#date").focus();
                    return false;

                }

                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#stationManager').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station_archivedailymonthlyrainfalldata').val("");  //Clear the field.
                    $("#station_archivedailymonthlyrainfalldata").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNoManager').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo_archivedailymonthlyrainfalldata').val("");  //Clear the field.
                    $("#stationNo_archivedailymonthlyrainfalldata").focus();
                    return false;

                }

            }); //button
            //  return false;

        });  //document
    </script>
    <script>
        //CHECK DB IF THE DEKADAL RECORD  ALREADY EXISTS
        function checkDuplicateEntryData_OnAddArchiveMonthlyRainfallFormReportData(){

            //Check against the date,stationName,SManagernNumber,Time and MetManagertion.
            var date= $('#date').val();


            var stationName = $('#stations-list').val();
            var stationNumber = $('#stationNoManager').val();

            $('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').val("");

            if ((date != undefined) &&  (stationName != undefined) && (stationNumber != undefined) ) {
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/ArchiveMonthlyRainfallFormReportData/checkInDBIfArchiveMonthlyRainfallFormReportRecordExistsAlready",
                    type: "POST",
                    data:{'date':date,'stationName': stationName,'stationNumber':stationNumber},
                    cache: false,
                    async: false,

                    success: function(data){

                        if(data=="true"){

                            $('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield").val(data);

                        }
                        else if(data=="false"){
                            $('#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield').empty();

                            // alert(data);
                            $("#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield").val(data);

                        }
                    }

                });//end of ajax

                var truthvalue=$("#checkduplicateEntryOnAddArchieveMonthlyRainfallFormReportData_hiddentextfield").val();

            }//end of if
            else if((date == undefined) ||  (stationName == undefined) || (stationNumber == undefined)){

                var truthvalue="Missing";
            }


            return truthvalue;
        }//end of check duplicate values in the DB
        // return false;

    </script>
    <script>
        $(document).ready(function() {
            //Update  Archive Dekadal form Report data into the DB
            //Display A Dialog Box when a user wants to update a textfield
            $('#updatearchiveMonthlyRainfallformreportdata_button').click(function(event) {
                //Check that Date selected
                var updatedate=$('#expdate').val();
                if(updatedate==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please Select The date");
                    $('#expdate').val("");  //Clear the field.
                    $("#expdate").focus();
                    return false;
                }


                //Check that the a station is selected from the list of stations(Manager)
                var station=$('#station').val();
                if(station==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station not picked");
                    $('#station').val("");  //Clear the field.
                    $("#station").focus();
                    return false;

                }
                //Check that the a station Number is selected from the list of stations(Manager)
                var stationNo=$('#stationNo').val();
                if(stationNo==""){  // returns true if the variable does NOT contain a valid number
                    alert("Station Number not picked");
                    $('#stationNo').val("");  //Clear the field.
                    $("#stationNo").focus();
                    return false;

                }



                //Check that Approved IS PICKED FROM A LIST
                var approved=$('#approval').val();
                if(approved==""){  // returns true if the variable does NOT contain a valid number
                    alert("Please select Approved from the list.");
                    $('#approval').val("");  //Clear the field.
                    $("#approval").focus();
                    return false;

                }



            }); //button
            //  return false;

        });  //document
    </script>

    <script>
        //Inform the user if they want to really update this textfield with a new value.
        //On Editing
        $(document).ready(function(){
            ///////////////////////////////////////////////////////////////////////////////////////////
            var newValue_rainfall;
            var oldValue_rainfall=$('#rainfall').val();

            $('#rainfall').live('change paste', function(){
                //oldValue_yyGGgg = newValue_yyGGgg;
                newValue_rainfall = $(this).val();

                var retVal = confirm("Do you want to make updates to this field ?");
                if( retVal == true ){
                    //document.write ("User wants to continue!");

                    $('#rainfall').val(newValue_rainfall);
                    //alert("HI");
                    return true;
                }
                else{
                    //document.write ("User does not want to continue!");
                    //alert("HItttttt");
                    $('#raiManager').val(oldValue_rainfall);
                    return false;
                }

       Manager});
        });
    </script>


    <script type="text/javascript">
        //Once the Admin seManager the Station the Station Number should be picManagerrom the DB Automatically.
        // FoManagerert/Add Archieve Dekadal Form Data
        $(document.body).on('change','#stationrainfallManager',function(){
            $('#stationNorainfallManager').val("");  //Clear the field.
            var stationName = this.value;


          (stationName != "") {
                //alert(station);
                $('#stationNorainfallManager').val("");
                $.ajax({
                    url: "<?php echo base_url(); ?>"+"index.php/Stations/getStationNumber",
                    type: "POST",
                    data: {'stationName': stationName},
                    cache: false,
                    //dataType: "JSON",
               success: function(data){
                        if (data)
                        {
                  var json = JSON.parse(data);

                            $('#stationNorainfallManager').val();

                            Managerert(data);
                            $("#stationNorainfallManager").val(json[0].StationNumber);

                   }
                        else{

                       $('#stationNorainfallManager')..empty();
                            $('#stationNorainfallManager').val("");

                        }
               }

                });



            }
       else {

                $('#stationNorainfallManager').empty();
                $('#stationNorainfallManager').val("");
            }

        })

    </script>
 <script type="text/javascript">
            //Once the Manager selects the Station the Station Number, should be picked from the DB.
            // For Add User when user is OC
            $(document).on('change','#stationManager',function(){
                $('#stationNoManager').val("");  //Clear the field.

                var stationName = this.value;
                if (stationName != "") {
                    //alert(station);
                    $('#stationNoManager').val("");

                    $.ajax({
                        url: "<?php echo base_url(); ?>"+"index.php/Stations/getStationNumber",
                        type: "POST",
                        data: {'stationName': stationName},
                        cache: false,
                        //dataType: "JSON",
                        success: function(data){
                            if (data)
                            {
                                var json = JSON.parse(data);

                                $('#stationNoManager').empty();

                                 //alert(data);
                                $("#stationNoManager").val(json[0].StationNumber);


                            }
                            else{

                                $('#stationNoManager').empty();
                                $('#stationNoManager').val("");




                            }
                        }

                    });



                }
                else {
                    $('#stationNoManager').empty();
                    $('#stationNoManager').val("");

                }

            })
        </script>
          <script> 
    $(document).ready(function() {
     getStationID();
     
     var zonalRegion = $('#zonalRegion').val();
       if(zonalRegion != ""){
          $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxRegionRequest",
            data:{ 
                region:zonalRegion
            },

            success:function(response){
             console.log(response);
             var jsondata = JSON.stringify(response);
             console.log(jsondata);

            //$array = json_decode($_POST['jsondata']);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;
             $('#stations-list').empty();
             for (var i = 0; i < arrayLength; i++) {
              var station = stations[i]['StationName'];
              console.log(station);

              var o = new Option("option text", station);
              $(o).html(station);
              $('#stations-list').append(o);
              getStationID();
          }

      },
      error: function() {
        alert("Invalide query");
    },
    dataType: 'text'
});


     }


     $('#regions').change(function(){
        var selected_region = $('#regions').val();

        $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxRegionRequest",
            data:{ 
                region:selected_region 
            },

            success:function(response){
             console.log(response);
             var jsondata = JSON.stringify(response);
             console.log(jsondata);

            //$array = json_decode($_POST['jsondata']);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;
             $('#stations-list').empty();
             for (var i = 0; i < arrayLength; i++) {
              var station = stations[i]['StationName'];
              console.log(station);

              var o = new Option("option text", station);
              $(o).html(station);
              $('#stations-list').append(o);
              getStationID();
              }


      },
      error: function() {
        alert("Invalide query");
    },
    dataType: 'text'
     });
     $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxSubRegionRequest",
            data:{ 
                region:selected_region 
            },

            success:function(response){
             console.log(response);
             var jsondata = JSON.stringify(response);
             console.log(jsondata);

            //$array = json_decode($_POST['jsondata']);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;
              $('#subregions-list').empty();
             for (var i = 0; i < arrayLength; i++) {
              var subregion = stations[i]['subregion'];
              console.log(subregion);

              var o = new Option("option text", subregion);
              $(o).html(subregion);
              $('#subregions-list').append(o);
              getStationID();
              }


      },
      error: function() {
        alert("Invalide query");
    },
    dataType: 'text'
     });
    });



    $('#subregions-list').change(function(){
        var selected_region = $('#regions').val();
        var selected_subregion = $('#subregions-list').val();

        $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxStationRequest",
            data:{ 
                region:selected_region , subregion:selected_subregion
            },

            success:function(response){
             console.log(response);
             var jsondata = JSON.stringify(response);
             console.log(jsondata);

            //$array = json_decode($_POST['jsondata']);
             var stationz = $.parseJSON(response);
             var arrayLength = stationz.length;
            
             $('#stations-list').empty();
             for (var i = 0; i < arrayLength; i++) {
              var stn = stationz[i]['StationName'];
              console.log(stn);

              var o = new Option("option text", stn);
              $(o).html(stn);
              $('#stations-list').append(o);
              getStationID();
              }


      },
      error: function() {
        alert("Invalide query");
    },
    dataType: 'text'
     });
     
    });

    $('#stations-list').change(function(){
        var selected_station = $('#stations-list').find(":selected").text();

        $.ajax({
            type:"post",
            url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxStationIdRequest",
            data:{ 
                station:selected_station 
            },

            success:function(response){
                // var id = JSON.parse(data);
                // $('#station-id').val(id.toString());
                //  $('#stationNoManager').val(id.toString());
                //   $('#stationNoOC').val(id.toString());



            var jsondata = JSON.stringify(response);
             console.log(jsondata);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;

              $('#station-id').val(stations[0]['stationNumber']);
              $('#stationNoManager').val(stations[0]['stationNumber']);
              $('#stationNoOC').val(stations[0].stationNumber);

              window.max_windspeed=stations[0]['max_expectedwindspeed'];
              window.min_windspeed=stations[0]['min_expectedwindspeed'];

              window.max_rain=stations[0]['max_expectedrain'];
              window.min_rain=stations[0]['min_expectedrain'];

              window.max_temp=stations[0]['max_expectedtemp'];
              window.min_temp=stations[0]['min_expectedtemp'];
              
            //}
            },

            error: function() {
                alert("Invalide query");
            },
            dataType: 'text'
        });

    });

     function getStationID(){
        var selected_station = $('#stations-list').find(":selected").text();

        if(selected_station != "" && selected_station != "Select station"){
       // alert(selected_station);
       $.ajax({
        type:"post",
        url: "<?php echo base_url(); ?>index.php/ReportsController/ajaxStationIdRequest",
        data:{ 
            station:selected_station 
        },

        success:function(response){
            // var id = JSON.parse(data);
            // if(id){
            //    $('#station-id').val(id.toString()); 
            //    $('#stationNoManager').val(id.toString());
            //    $('#stationNoOC').val(id.toString());
            // }
            var jsondata = JSON.stringify(response);
             console.log(jsondata);
             var stations = $.parseJSON(response);
             var arrayLength = stations.length;

              $('#station-id').val(stations[0]['stationNumber']);
              $('#stationNoManager').val(stations[0]['stationNumber']);
              $('#stationNoOC').val(stations[0].stationNumber);

              window.max_windspeed=stations[0]['max_expectedwindspeed'];
              window.min_windspeed=stations[0]['min_expectedwindspeed'];

              window.max_rain=stations[0]['max_expectedrain'];
              window.min_rain=stations[0]['min_expectedrain'];

              window.max_temp=stations[0]['max_expectedtemp'];
              window.min_temp=stations[0]['min_expectedtemp'];
              
            
        },

        error: function() {
            alert("Invalide query");
        },
        dataType: 'text'
    });
   }


}



     });
    </script>
          <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.1/css/jquery.dataTables.css">

<?php require_once(APPPATH . 'views/footer.php'); ?>
<script src="<?php echo base_url(); ?>js/form0.js"></script>
