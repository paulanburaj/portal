<?php

class import extends CI_Controller {

    function __construct()
    {
        parent::__construct();
	$this->load->model('import_model');
	}

 function index()
    {

$this->load->view('includes/header');
$this->load->view('includes/left_nav');
$this->load->view('import_view');
$this->load->view('includes/footer');
	}


function import_attendance()
    {

if($_FILES['excel']['tmp_name']!=''){

$config['upload_path'] = APPPATH.'../assets/excel';
$config['allowed_types'] = 'xls|xlsx';
$path_info = pathinfo($_FILES["excel"]["name"]);
$fileExtension = $path_info['extension'];
$modifiedFileName = time().'.'.$fileExtension ;   
$config['file_name'] = $modifiedFileName;
  
$this->load->library('upload', $config);
$this->load->library('upload', $config);

if($this->upload->do_upload('excel')){

$excel_file_path=$config['upload_path'].'/'.$modifiedFileName;
chmod($excel_file_path,0777);

/*
include(APPPATH.'libraries/excel/reader.php');

$index_name=array();
$values=array();
 $excel = new Spreadsheet_Excel_Reader();
    $excel->read($excel_file_path);    
   $x=1;
    while($x<=$excel->sheets[0]['numRows']) {
      $y=1;
      while($y<=$excel->sheets[0]['numCols']) {
        $cell = isset($excel->sheets[0]['cells'][$x][$y]) ? $excel->sheets[0]['cells'][$x][$y] : '';
if($x==1 && $cell!=''){
$index_name[$y]=$cell;
}
else if($x!=1 && $cell!=''){
$values[$x-2][$index_name[$y]]=$cell;
}
 
        $y++;
      }  
      $x++;
    }


$table=array();

foreach($values as $key=>$val){


$val['in_hours']='';
$val['logged_in_date']=date('Y-m-d',strtotime($val['sign_in_time']));
$table[]=$val;


}
print_r($table);
*/

set_include_path(APPPATH.'libraries/PHPExcleReader/'. 'Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
$inputFileName = $excel_file_path ;  // File to read
//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}



$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,false);


$all_data=array();

foreach($sheetData as $key=>$val){

$all_data[]=array_filter($val);

}

$index_name=array();
$values=array();

foreach($all_data as $key=>$val){

if($key=='0'){
$index_name[]=$val;
}
else{
$data['user_name']=$val[0];
$data['logged_in_date']=date('Y-m-d',strtotime($val[1]));
$data['sign_in_time']=$data['logged_in_date'].' '.$val[2];
$data['sign_out_time']=$data['logged_in_date'].' '.$val[3];
$time_diff=strtotime($val[2])-strtotime($val[1]);
$in_hours=gmdate('H:i:s',$time_diff);
$data['in_hours']=$in_hours;
$values[]=$data;
}


}


$array1 = array("0" => "user_name", "1" =>"logged_in_date","2" => "sign_in_time","3" =>"sign_out_time");

$result = array_diff($index_name[0], $array1);

if(empty($result)){
$this->import_model->import($values);
$this->session->set_flashdata('msg', 'Attendance Report imported successfully');
redirect('import');
}
else{
$this->session->set_flashdata('msg', 'Uploded excel file not match with our template');
redirect('import');
}

}

else{
$this->load->view('includes/header');
$this->load->view('includes/left_nav');
$error = $this->upload->display_errors();
$this->session->set_flashdata('msg', $error);
$this->load->view('import_view');
$this->load->view('includes/footer');

}
		


}



	}

}

?>
