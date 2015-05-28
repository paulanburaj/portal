<?php

class role extends CI_Controller {

    function __construct()
    	{
        parent::__construct();
	$this->load->model('role_model');
	$this->load->helper('genfunction');
	validate_login();
	}


   function index()
	{

	$this->load->view('includes/header');
	$this->load->view('includes/left_nav');
	$this->load->view('role_view');
	$this->load->view('includes/footer');

	}

function get_role_details()
{



$page = $_GET['page']; 
$limit = $_GET['rows']; 
$sidx = $_GET['sidx']; 
$sord = $_GET['sord']; 



$wh = "";
$searchOn =$_GET['_search'];
if($searchOn=='true') {

	$searchstr = $_GET['filters'];

	$wh.= $this->constructWhere($searchstr,$wh);

	}
//echo $wh;
//exit;




$count=$this->role_model->get_all_role_count();


if( $count > 0 && $limit > 0) { 
$total_pages = ceil($count/$limit); 
} else { 
$total_pages = 0; 
} 
$responce=new stdClass();
$responce->records=$count;
$responce->page=$page;
$responce->total=$total_pages;


if ($page > $total_pages) $page=$total_pages;
$start = $limit*$page - $limit;
if($start <0) $start = 0; 

$sql="select a.id,a.role_name,a.description,b.role_name as parent from roles a left join roles b on a.parent=b.id   $wh ORDER BY $sidx $sord LIMIT $start , $limit";

$SQL=$this->db->query($sql); 
$result =$SQL->result_array();

$i=0;
foreach($result as $row) {


$responce->rows[$i]['id']=$row['id'];
$responce->rows[$i]['cell']=array($row['role_name'],$row['parent'],$row['description']);
$i++;
}
echo json_encode($responce);


}

function edit_role_details(){

$role_id=$id=$this->input->post('id');

$role_data= array(
'role_name'=>$this->input->post('role_name'),
'parent'=>$this->input->post('parent'),
'description'=>$this->input->post('decription')
);


$this->role_model->update_role_details($role_data,$role_id);

}

function get_role_names(){

$SQL=$this->db->query("SELECT * FROM roles"); 
$result =$SQL->result_array();
$options=array();
foreach ($result as $arr) 
{


$options[$arr['id']]=$arr['role_name'];
}

echo json_encode($options);
}

	

function delete_role_details(){


$id=$this->input->post('id');

$this->role_model->delete_role_details($id);
}


function add_role_details(){
$role_data= array(
'role_name'=>$this->input->post('role_name'),
'parent'=>$this->input->post('parent'),
'description'=>$this->input->post('decription')
);

$this->role_model->add_role_details($role_data);

}



public function constructWhere($s,$wh){

     $qwery = $wh;
	//['eq','ne','lt','le','gt','ge','bw','bn','in','ni','ew','en','cn','nc']
    $qopers = array(
				  'eq'=>" = ",
				  'ne'=>" <> ",
				  'lt'=>" < ",
				  'le'=>" <= ",
				  'gt'=>" > ",
				  'ge'=>" >= ",
				  'bw'=>" LIKE ",
				  'bn'=>" NOT LIKE ",
				  'in'=>" IN ",
				  'ni'=>" NOT IN ",
				  'ew'=>" LIKE ",
				  'en'=>" NOT LIKE ",
				  'cn'=>" LIKE " ,
				  'nc'=>" NOT LIKE " );
    if ($s) {
        $jsona = json_decode($s,true);
        if(is_array($jsona)){
			$gopr = $jsona['groupOp'];
			$rules = $jsona['rules'];
            $i =0;
            foreach($rules as $key=>$val) {
                $field = $val['field'];
                $op = $val['op'];
                $v = $val['data'];

				if($v && $op) {

	               		 $i++;
				
				
				switch ($field) {
				
					default :
					{
						// ToSql in this case is absolutley needed
						$v = $this->ToSql($field,$op,$v);

						if ($i == 1) $qwery .= "where ";
						else $qwery .= " " .$gopr." ";
						switch ($op) {
							// in need other thing
						    case 'in' :
						    case 'ni' :
							$qwery .= $field.$qopers[$op]." (".$v.")";
							break;
							default:
							$qwery .= $field.$qopers[$op].$v;
						} // end switch

						break;
					}
				} //end switch
					

				} //end if
            } //end foreach
        }// end json array
    } //end if(s)

    return $qwery;
}
function ToSql ($field, $oper, $val) {
	// we need here more advanced checking using the type of the field - i.e. integer, string, float
	switch ($field) {
		
		default :
			//mysql_real_escape_string is better
			if($oper=='bw' || $oper=='bn') return "'" . addslashes($val) . "%'";
			else if ($oper=='ew' || $oper=='en') return "'%" . addcslashes($val) . "'";
			else if ($oper=='cn' || $oper=='nc') return "'%" . addslashes($val) . "%'";
			else return "'" . addslashes($val) . "'";
	}
}


  


}

?>
