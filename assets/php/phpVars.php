<?php
$www = "http://dashboard.spyre-media.com/assets/AssuranceX/";
$emailAdmin = "gareth@spyre-media.com";
$emailPassword = "S{)b-pM67}:<c?5X";

$thisyear = "".date('Y')."";
$todaysdate = "".date('Y')."-".date('m')."-".date('d')."";
$lastYeardate = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d"), date("y")-1)); 
$tomorrowsdate = date('Y-m-d',mktime(0, 0, 0, date("m"), date("d")+1, date("y"))); 

$titleStatus['1'] = "Miss";
$titleStatus['2'] = "Ms";
$titleStatus['3'] = "Mrs";
$titleStatus['4'] = "Mr";
$titleStatus['5'] = "Dr";
$titleStatus['6'] = "Sir";
$titleStatus['7'] = "Lord";
$titleStatus['8'] = "Prof";
$titleStatus['9'] = "Rev";
$titleStatus['10'] = "Fr";
$titleStatus['11'] = "Sr";
$titleStatus['12'] = "Bro";
$titleStatus['13'] = "Lady";

$bikeManufacture['1'] = "Raleigh";
$bikeManufacture['2'] = "Orange";
$bikeManufacture['3'] = "Trek";

$bikeManufactureType['1']['1'] = "blue";
$bikeManufactureType['1']['2'] = "red";
$bikeManufactureType['1']['3'] = "green";
$bikeManufactureType['2']['1'] = "pink";
$bikeManufactureType['2']['2'] = "yellow";
$bikeManufactureType['3']['1'] = "white";
$bikeManufactureType['3']['2'] = "black";
?>