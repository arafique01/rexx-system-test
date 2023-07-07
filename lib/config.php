<?php

class db{
	public $host = "localhost";
	public $user = "root";
	public $password = '';
	public $database = "rexx_system";
	public $connect;

	function __construct() {
		$this->connect = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		mysqli_set_charset($this->connect , 'utf8');
		mysqli_query($this->connect,'SET NAMES utf-8');

   }

	function insert_into_db($participation_id,$employee_name, $employee_mail,$event_id, $event_name, $participation_fee, $event_date)
    {
		$query = "insert into employee SET id = '$participation_id', name = '$employee_name', email = '$employee_mail', event_id = '$event_id' , event_name= '$event_name' , participation_fee ='$participation_fee', event_date ='$event_date'";
		
        if(mysqli_query($this->connect, $query)){
			print(mysqli_error($this->connect));
			return true;
		}else{
			return false;
		}	
	}

    function getData()
	{
		$query = "SELECT *, (SELECT SUM(participation_fee) FROM employee) AS total_sum FROM employee";
		$result      = mysqli_query($this->connect, $query) or die(mysqli_error($this->connect));
		$rowsCounter = mysqli_num_rows($result);
		
		if ($rowsCounter > 0) {
            $result_data = $result->fetch_all(MYSQLI_ASSOC);
			$sum = $result_data[0]['total_sum'];
			$result_array['result'] = $result_data; 
			$result_array['sum'] = $sum; 
            return $result_array;
		}else{
			return false;
		}
	}

	function filterData($emp_name, $event_name,$date)
	{
        $where = "";
        $conditions = array();

        if (!empty($emp_name)) {
            $conditions[] = "name like '%$emp_name%'";
        }

        if (!empty($event_name)) {
            $conditions[] = "event_name = '$event_name'";
        }

        if (!empty($date)) {
            $conditions[] = "event_date = '$date'";
        }

        if (!empty($conditions)) {
            $where = "WHERE " . implode(" AND ", $conditions);
        }

		$query = "SELECT *, (SELECT SUM(participation_fee) FROM employee $where) AS total_sum FROM employee $where";

        $result      = mysqli_query($this->connect, $query) or die(mysqli_error($this->connect));
		$rowsCounter = mysqli_num_rows($result);
		
		if ($rowsCounter > 0) {
            $result_data = $result->fetch_all(MYSQLI_ASSOC);
			$sum = $result_data[0]['total_sum'];
			$result_array['result'] = $result_data; 
			$result_array['sum'] = $sum; 
            return $result_array;
		}else{
			return false;
		}
	}

}
$db = new db();
?>