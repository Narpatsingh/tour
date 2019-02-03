<?php
function getLogo($logoName = null, $thumb = false)
{
    return "/img/logo.png";
    //return "/img/" . NO_IMAGE;
}

function getPhoto($id = null, $photo = null, $dirpath = PROFILE_IMAGE, $dir = false, $thumb = false)
{
    if (!empty($thumb)) {
        $thumb = 'thumb_';
    }
    if ($dir) {
        $path = $dirpath . $id . DS;
        if (!is_dir($path)) {
            $data = createFolder($path);
        }
        return $path;
    } else {
        if ((!empty($id) && !empty($photo)) && !is_array($photo) && file_exists(WWW_ROOT . $dirpath . $id . DS . $photo)) {
            if (!empty($thumb) && file_exists(WWW_ROOT . $dirpath . $id . '/' . $thumb . $photo)) {
                return $dirpath . $id . '/' . $thumb . $photo;
            }
            return $dirpath . $id . '/' . $photo;
        }
    }


    return "/img/" . NO_IMAGE;
}

function getUserPhoto($id = null, $photo = null, $dir = false, $thumb = true, $type = 'user')
{
    if ($type == 'user') {
        $dirpath = USER_IMAGE;
    }
    if ($thumb) {
        $thumb = 'thumb_';
    }
    if ($dir) {
        $path = $dirpath . $id . DS;
        if (!is_dir($path)) {
            $data = createFolder($path);
        }
        return $path;
    } else {
        $fullPath = WWW_ROOT . $dirpath . $id . DS . $photo;
        if (!is_dir($fullPath) && file_exists($fullPath)) {
            if (in_array($thumb, array('thumb90_', 'thumb200_'))) {
                return $dirpath . $id . '/' . $thumb . $photo;
            }
            return $dirpath . $id . '/' . $photo;
        }
    }
    return "/img/" . NO_IMAGE;
}


function getFileProcessPath($fileName = null, $isFullPath = false)
{
    $fullPath = WWW_ROOT . FILE_PROCESS_PATH . $fileName . '.pdf';
    if (!is_dir($fullPath)) {
        if (!empty($isFullPath)) {
            return $fullPath;
        }
        return FILE_PROCESS_PATH . $fileName . '.pdf';
    }
    return "";
}


function showdate($date, $na = '', $requireTooltip = false, $format = DATE_DEF_FORMAT)
{
    $isValid = (!is_numeric($date) ? strtotime($date) : $date) > 0 ? true : false;
    return $isValid ? getDateTimeInTimezone($date, $format, $requireTooltip) : $na;
}

function showtime($date, $na = '', $requireTooltip = false)
{
    $isValid = (!is_numeric($date) ? strtotime($date) : $date) > 0 ? true : false;
    return $isValid ? getDateTimeInTimezone($date, 'h:i a', $requireTooltip) : $na;
}

function showdatetime($datetime, $na = '', $format = '', $requireTooltip = false)
{
    $format = empty($format) ? DATE_DEF_FORMAT . ' h:i a' : $format;
    $formats = explode(' ', $format);
    $isValid = (!is_numeric($datetime) ? strtotime($datetime) : $datetime) > 0 ? true : false;
    if ($isValid) {
        if (count($formats) > 1) {
            return showdate($datetime, $na, $requireTooltip, $formats[0]) . '  ' . showtime($datetime, $na, $requireTooltip);
        } else {
            return getDateTimeInTimezone($datetime, $format, $requireTooltip);
        }
    }
    return $na;
}

function getDateTimeInTimezone($datetime, $format = '', $requireTooltip = false)
{
    $format = empty($format) ? DATE_DEF_FORMAT . ' H:i:s' : $format;
    if ($requireTooltip) {
        return "<span title='" . $datetime . "\n" . date_default_timezone_get() . "'>" . serverToSiteTimezone($datetime, $format) . "</span>";
    } else {
        return serverToSiteTimezone($datetime, $format);
    }
}

function serverToSiteTimezone($datetime, $format = '')
{
    $format = empty($format) ? DATE_DEF_FORMAT . ' H:i:s' : $format;
    return convertToTimezone($datetime, date_default_timezone_get(), date_default_timezone_get(), $format);
}

function siteToServerTimezone($datsetime, $format = '')
{
    $format = empty($format) ? DATE_DEF_FORMAT . ' H:i:s' : $format;
    return convertToTimezone($datetime, date_default_timezone_get(), date_default_timezone_get(), $format);
}

function convertToTimezone($datetime, $currentTimezone, $newTimezone, $format = '')
{
    $format = empty($format) ? DATE_DEF_FORMAT . ' H:i:s' : $format;
    if (empty($datetime)) {
        return "";
    }
    if (is_numeric($datetime)) {
        $datetime = date('Y-m-d H:i:s', $datetime);
    }
    $date = new DateTime($datetime, new DateTimeZone($currentTimezone)); //Set Current timezone
    $date->setTimezone(new DateTimeZone($newTimezone)); //Set New Timezone
    return $date->format($format);
}

function createFolder($path = '', $permission = 0777)
{
    if (empty($path)) {
        return false;
    }
    if (!file_exists($path) && !is_dir($path)) {
        mkdir($path, $permission, true);
        return true;
    }
}

function generateCode($field1, $field2 = null)
{
    $hash = $field1 . $field2;
    return Security::hash($hash, 'sha256', true);
}

function clean_url($string, $replaceWith = "-")
{
    $string = preg_replace('/&+/', 'and', $string);
    $string = preg_replace('/[^A-Za-z0-9\.]/', '-', $string); // Removes special chars.
    $string = str_replace(' ', '-', trim($string, '-'));
    return strtolower(preg_replace('/[\-]+/', $replaceWith, $string));
}

function encrypt($sData)
{
    $id = (double)$sData * 525325.24;
    return base64_encode($id);
}

function decrypt($sData)
{
    $url_id = base64_decode($sData);
    $id = (double)$url_id / 525325.24;
    return $id;
}

function getrandompassword($len = 6)
{
    $str = '';
    for ($i = 1; $i <= $len; $i++) {
        $ord = rand(48, 90);
        if ((($ord >= 48) && ($ord <= 57)) || (($ord >= 65) && ($ord <= 90)))
            $str .= chr($ord);
        else
            $str .= getrandompassword(1);
    }
    return $str;
}

function getPercentage($totalAmount = 1, $amount = 0)
{
    if (empty($totalAmount)) {
        return 0;
    }
    return round((($amount / $totalAmount) * 100), 0);
}

function isLive()
{
    if (isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'dynalitics.local')) {
        return false;
    }
    return true;
}


function getNamedParameter($named = array(), $wantArr = false)
{
    $return = '';
    $i = 0;
    $retArr = array();
    foreach ($named as $key => $value) {
        if (in_array($key, array(ADMIN, DEALER, COMPANY))) {
            $retArr['type'] = $key;
            $retArr['value'] = decrypt($value);
            $return .= (empty($i) ? '' : '/') . $key . ':' . $value;
            $i++;
        }
    }
    if ($wantArr) {
        return $retArr;
    }
    return $return;
}

function getMySessionData($userType = 'User', $field = '')
{
    if (CakeSession::check('Auth.' . $userType)) {
        return !empty($field) ? CakeSession::read('Auth.' . $userType . '.' . $field) : CakeSession::read('Auth.' . $userType);
    }
    return false;
}

function getUserRole()
{
    $sessionData = getMySessionData();
//    $uRole = CakeSession::read('Auth.User.role');
//    $uType = CakeSession::read('Auth.User.user_type');
    $uRole = $sessionData['role'];
    $uType = $sessionData['user_type'];

    if (!empty($uRole) && !empty($uType)) {
        return $uRole . ' ' . $uType;
    }
    return '';
}


function cropDetail($string = null, $character = 100, $appendText = '...')
{
    $string = strip_tags($string);
    if (strlen($string) > ($character - 1)) {
        $string = substr($string, 0, ($character - 1)) . $appendText;
        return $string;
    }
    return $string;
}

function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
{
//    date_default_timezone_set('America/Los_Angeles');
    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);
    while ($current <= $last) {
        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }
    return $dates;
}

function showPhoneNo($phone = '(000)00-0000')
{
    return $phone;
}

function getMemberShipType($memberShip = null, $idDisplay = 0)
{
    $memArr = array(
        'gold' => 'Gold',
        'silver' => 'Silver',
        'platinum' => 'Platinum'
    );
    if (!empty($idDisplay)) {
        return isset($memArr[$memberShip]) ? $memArr[$memberShip] : '-';
    }
    return $memArr;
}

function getReportFilter($value = null)
{
    $arr = array(
//        'today' => __('Today'),
        'last_7days' => __('Last 7 days'),
        'last_15days' => __('Last 15 days'),
        'last_months' => __('Last Month'),
        'last_3months' => __('Last 3 Month'),
        'last_6months' => __('Last 6 Month'),
    );
    if (empty($value)) {
        return $arr;
    }
    return isset($arr[$value['from']]) ? $arr[$value['from']] : __('Custom Range:') . $value['start_date'] . ' to ' . $value['end_date'];
}

function getCommunicationType($comm_type = null, $idDisplay = 0)
{
    $memArr = array(
        'email' => 'Email',
        'sms' => 'Sms'
    );
    if (!empty($idDisplay)) {
        return isset($memArr[$comm_type]) ? $memArr[$comm_type] : '-';
    }
    return $memArr;
}

function getBranchFtpDetail($isGetFtpPath = false, $isSortPath = false)
{
    $responseArr = array(
        'ftp_username' => strtolower(substr(str_shuffle('abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 5)),
        'ftp_password' => substr(str_shuffle('abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 10)
    );
    if ($isGetFtpPath) {
        $responseArr['ftp_path'] = addBranchDirectory($responseArr['ftp_username'], $isSortPath);
    }
    return $responseArr;
}

function getRandomEmailId($email = 'test.user@gmail.com')
{
    return $email;
    $email = explode('@', $email);
    $email[0] = $email[0] . '+' . rand(10, 100);
    return implode('@', $email);
}

function isTestMode()
{
    if ($_SERVER['REMOTE_ADDR'] == '116.74.122.170' && isset($_GET['test']) && $_GET['test'] == 1) {
        return true;
    }
    return false;
}

function isDisplayFields()
{
    $sesData = getMySessionData();
    if (empty($sesData['parent_id'])) {
        return true;
    }
    return false;
}

function checkImageAvailable($imageUrl = '')
{
    if (!empty($imageUrl)) {
        return getimagesize($imageUrl);
    }
}

function getWorkedMinutes($startDate = '')
{
    if (empty($startDate)) {
        return 0;
    }
    $startTime = strtotime($startDate);
    $todayDate = date('Y-m-d H:i:s');
    $endTime = strtotime($todayDate);
    return round(abs($endTime - $startTime) / 60, 2);
}

function getWorkedHours($minutes = 0)
{
    return round($minutes / 60, 2);
}

function getFileName($name = 'Report')
{
    return $name . '_' . date('mdYHm');
}

function encode($id)
{
    return base64_encode($id);
}

function decode($id)
{
    return base64_decode($id);
}

function getFilePath($id, $folder, $file, $thumb = false)
{
    if ($thumb)
        $file = 'thumb_' . $file;

    $fullPath = WWW_ROOT . 'files' . DS . $folder . DS . $id . DS . $file;
    if (file_exists($fullPath)) {
        return $fullPath;
    } else {
        return false;
    }
}

function call_url($url = null)
{
	if (empty($url))
		return false;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	if ($data = curl_exec($ch)) {

	} else {
		$err = curl_errno($ch);
		$data = curl_error($ch);
	}
	return $data;
}


function setAllChartMonth($start_date = null, $end_date = null, $data = null, $type = null)
{
    $start = new DateTime($start_date);
    $start->modify('first day of this month');
    $end = new DateTime($end_date);
    $end->modify('first day of next month');
    $interval = DateInterval::createFromDateString('1 month');
    $period = new DatePeriod($start, $interval, $end);
    foreach ($period as $dt) {
        $all_months[] = strtotime($dt->format("Y-m"));
    }

    foreach ($data as $value) {
        $allDataDate[] = strtotime(date('Y-m',strtotime($value[$type]['date'])));
    }
    foreach($all_months as $month){
        if(!in_array($month, $allDataDate) ){
            if($type != 'SocialMediaDetail'){
                $newData[] = array(
                    0 => array(
                        'Total' => 0,
                    ),
                    $type => array(
                        'date' => date('Y-m-d', $month)
                    )
                );
            }else{
                $newData[] = array(
                    0 => array(
                        'twitter' => 0,
                        'instagram' => 0,
                        'other' => 0
                    ),
                    $type => array(
                        'date' => date('Y-m-d', $month)
                    )
                );
            }
        }
    }
    if(isset($newData) && !empty($newData)){
        $data = array_merge($data,$newData);
    }
    if($type == 'SocialMediaDetail'){
        usort($data, "sortFunction_social");
    }else if($type == 'DomainsDiscovered'){
        usort($data, "sortFunction_domain");
    }else if($type == 'OffendingDomain'){
        usort($data, "sortFunction_offending");
    }
    return $data;
}
function sortFunction_social( $a, $b) {
    return strtotime($a['SocialMediaDetail']["date"]) - strtotime($b['SocialMediaDetail']["date"]);
}

function sortFunction_domain( $a, $b) {
    return strtotime($a['DomainsDiscovered']["date"]) - strtotime($b['DomainsDiscovered']["date"]);
}

function sortFunction_offending( $a, $b) {
    return strtotime($a['OffendingDomain']["date"]) - strtotime($b['OffendingDomain']["date"]);
}

function getCondition ($start_date = null,$end_date = null){
    $condition['to_date'] = array('DATE_FORMAT(date,"%Y") =' => date('Y',strtotime($start_date)));
    $condition['month_to_date'] = array('DATE_FORMAT(date,"%m") =' => date('m',strtotime($end_date)));
    return $condition;
}

function getSpanPercentage($max = null,$value = null){
    if($value != null && $max != null){
        return round(($value*100)/$max);
    }
}

function getAddMoreLabel($type,$options){
	$html="";
	foreach($options as $field=>$value){
		if(!in_array($field,array('id'))){
			$html.="<label class='".$value['class']."'>".$value['label']."</label>";			
		}
	}
	return $html;
}
function addMore($type,$options,$values = array(),$params = array()){
	$html = "<div class = 'addmore-item-$type col-md-12 addmore_item'>";	
	$id=0;
	foreach($options as $field=>$value){		
		$val = isset($values[$field])?$values[$field]:"";
		if(!empty($value['option'])){
			$html.="<select class='form-control ".$value['class']."' name='Monitoring[$type][".$field."][]'>";
			foreach($value['option'] as $opt=>$optLabel){
				$selected = $val==$opt?"selected":"";
				$html.="<option value='".$opt."' ".$selected.">".$optLabel."</option>";
			}
			$html.="</select>";
		}elseif(in_array($field,array('id'))){
			$html.="<input type='hidden' name='Monitoring[$type][".$field."][]' value='".$val."'>";
			$id=$val;
		}else{
			$html.="<input type='text' name='Monitoring[$type][".$field."][]' value='".$val."' class='form-control ".$value['class']."'>";
		}
	}
	if(!empty($id)){
		$html.='<a href="'.Router::url(array('action' => 'deleteMonitoring', $id)).'" icon="fa fa-remove removebtn" title="Click here to delete this record" onclick="confirm(\'Are you sure you want to delete this record?\')"><i class="fa fa fa-remove removebtn">&nbsp;</i></a>';		
	}else{		
		$html.="<a href='javascript:' class='removebtn' onclick='removeItem(this)'><i class='fa fa-remove'></i></a>";
	}
	$html.="</div>";
	return $html;
}

function addMoreKeywords($type,$edit=null)
{
    if($edit == null)
    {   
        if($type=='domain_discovered'){

            return "<div class = 'addmore-item-$type col-md-12 addmore_item add_domain'><input type='text' name='Monitoring[$type][field1][]' value='' class='form-control col-md-7'><a href='javascript:' onclick='removeItem(this)'><i class='fa fa-remove'></i></a></div>";

        }else{
			return "<div class = 'addmore-item-$type addmore_item addmore-item-post'><input type='text' name='Monitoring[$type][field1][]' value='' class='form-control col-md-8 margin-right10'><select name='Monitoring[$type][field2][]' class='form-control col-md-3 margin-right10 offending-domains-status'><option value='reported'>Reported</option><option value='blocked'>Blocked</option></select><a href='javascript:' onclick='removeItem(this)' class='removebtn'><i class='fa fa-remove'></i></a><div class='clearfix'></div></div>";
        }
    }
    
}
function getSaveHelp(){
	return '<span class="savehelp">Click on save button after making any change.</span>';
}

function get_invoice_no()
{
    return 'INC'.time().'SILSHINE'.substr(md5(getrandompassword()),0,5).'AKNZ';
}

function get_gst_amount($amount,$gst_percent)
{
    $payment_with_gst = ($amount * $gst_percent) / 100;
    return $payment_with_gst + $amount;
}