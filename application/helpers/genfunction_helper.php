<?php 

function admin_login(){

			$ci = get_instance(); // $ci replaces $this
			if(!$ci->session->userdata('is_admin'))
			{
			$url=base_url();
			redirect($url);
			}

}


function validate_login(){

			$ci = get_instance(); // $ci replaces $this
			if(!$ci->session->userdata('is_logged_in'))
			{
			$url=base_url();
			redirect($url);
			}

}


function days_in_month($month, $year)
{
// calculate number of days in a month
return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
} 





function getsundays($month, $year) {
    $base_date = strtotime($year . '-' . $month . '-01');
    $sun = strtotime('first sun of ' . date('F Y', $base_date));

    $sundays = array();

    do {
        $sundays[] = date('Y-m-d', $sun);
        $sun = strtotime('+7 days', $sun);
    } while (date('m', $sun) == $month);

    return $sundays;
}


function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}



?>
