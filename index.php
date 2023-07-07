<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('max_execution_time', 900); 
date_default_timezone_set("UTC");
require_once(__DIR__."/lib/config.php");// db configuration class

error_reporting(E_ALL);
ini_set('display_errors', 1);

$file = file_get_contents(__DIR__.'/Code Challenge (Events).json');
$json = json_decode($file,true);
foreach($json as $value){
    $participation_id = $value['participation_id'];
    $employee_name = $value['employee_name'];
    $employee_mail = $value['employee_mail'];
    $event_id = $value['event_id'];
    $event_name = $value['event_name'];
    $participation_fee = $value['participation_fee'];
    $event_date = $value['event_date'];

    if($db->insert_into_db($participation_id,$employee_name, $employee_mail,$event_id, $event_name, $participation_fee, $event_date)){
        echo "Data inserted Successfully";
    }
	
}

$employee_name = (isset($_POST['employeeName']))? $_POST['employeeName']:"";
$event_name = (isset($_POST['eventName']))? $_POST['eventName']:"";
$date = (isset($_POST['date']))? $_POST['date']:"";

if($employee_name != "" || $event_name != "" || $date != ""){
    if($result = $db->filterData($employee_name, $event_name, $date)){
        include(__DIR__."/view/form.php"); // form template
    }

}else{
    if($result = $db->getData()){
        include(__DIR__."/view/form.php"); // form template
    }
}
