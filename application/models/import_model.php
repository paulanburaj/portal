<?php

class import_model extends CI_Model {



function __construct(){




	}

function import($data)
{

$this->db->insert_batch('attendance_log',$data);

return TRUE;


}


}

?>
