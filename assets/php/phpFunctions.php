<?php
function runSQL($rsql) {
$connect = mysql_connect('localhost','test','Bncw~654') or die ("Error: could not connect to database");
$db = mysql_select_db('spyremedia_tes');
mysql_query("SET NAMES 'utf8'");
$result = mysql_query($rsql) or die ("Error in query: $query. " . mysql_error());
return $result;
mysql_close($connect);
}

function tableInfo($parentID,$table,$match,$show) {
$rsql = "SELECT $show FROM $table WHERE $match='$parentID'";
$result = runSQL($rsql);
$row = mysql_fetch_array($result);
return $row[$show];
}

///random
function VerifyEmailAddress($address) 
{
  return filter_var($address, FILTER_VALIDATE_EMAIL);
}

function CheckPassword($password) {
if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password)){
    return true;
} else {
    return false;
}
}

function checkEmailExists($address) {
$rsql = "SELECT * FROM user WHERE email='$address'";
$result = runSQL($rsql);
if(mysql_num_rows($result)>0){
	return true;
} else {
	 return false;
	}
}

function genRandomString() {
    $length = 15;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';    
    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}

function postcodeFormat($postcode)
{
    //trim and remove spaces
    $cleanPostcode = str_replace(" ","",trim($postcode));
 
    //make uppercase
    $cleanPostcode = strtoupper($cleanPostcode);
 
    //if 5 charcters, insert space after the 2nd character
    if(strlen($cleanPostcode) == 5)
    {
        $postcodtopImagee = substr($cleanPostcode,0,2) . " " . substr($cleanPostcode,2,3);
    }
 
    //if 6 charcters, insert space after the 3rd character
    elseif(strlen($cleanPostcode) == 6)
    {
        $postcode = substr($cleanPostcode,0,3) . " " . substr($cleanPostcode,3,3);
    }
 
 
    //if 7 charcters, insert space after the 4th character
    elseif(strlen($cleanPostcode) == 7)
    {
        $postcode = substr($cleanPostcode,0,4) . " " . substr($cleanPostcode,4,3);
    }
 
    return $postcode;
}

function IsPostcode($postcode)
{
    $postcode = strtoupper(str_replace(' ','',$postcode));
    if(preg_match("/^[A-Z]{1,2}[0-9]{2,3}[A-Z]{2}$/",$postcode) || preg_match("/^[A-Z]{1,2}[0-9]{1}[A-Z]{1}[0-9]{1}[A-Z]{2}$/",$postcode) || preg_match("/^GIR0[A-Z]{2}$/",$postcode))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function postcodetype($postcode,$type){
	$varr = explode(" ", $postcode);
	if($type=="district") {
		return $varr[0];
		} elseif($type=="area") { 
			return preg_replace('/[0-9]+/', '', $varr[0]);
			}
	}
	
function get_numeric($val) { 
  if (is_numeric($val)) { 
    return $val + 0; 
  } 
  return 0; 
} 

///date formats
function formatDate($val)
{
    $arr = explode('-', $val);
    return date('d M Y', mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}

function cleanstring($string) {
	$ret = strip_tags ($string);
    $ret = htmlentities($ret,ENT_QUOTES);
    return $ret;
    }

?>