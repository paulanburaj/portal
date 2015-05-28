<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


 class MY_Form_validation extends CI_Form_validation
{

function __construct()
{

}

public	function run($module = '', $group = ''){
    (is_object($module)) AND $this->CI = &$module;
        return parent::run($group);
}
	

public	function select_validate($abcd)
{

$CI =& get_instance();
// 'none' is the first option that is default "-------Choose City-------"
if($abcd=="none" || $abcd=="0"){

$CI->form_validation->set_message('select_validate', 'Please Select %s.');
return FALSE;
} else{

// User picked something.
return TRUE;
}
}





}

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */
