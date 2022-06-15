<?php

include 'connection-pdo.php';


/**
 * 
 */
class DBHandler extends DBCon
{
	private $insert_query;
	private $select_query;
	private $delete_query;
	private $toggle_query;
	private $update_query;
	private $dropdown_query;
	
	function __construct(){
		parent::__construct();
		$this->insert_query = "";
		$this->select_query = "";
		$this->delete_query = "";
		$this->toggle_query = "";
		$this->update_query = "";
		$this->dropdown_query = "";
	}

	private function is_proper_name($name){
		if (preg_match('/^[a-z?A-Z?0-9?.?\-?,?_?\s?]+$/', strtolower($name))) {
			return true;
		}
		return false;
	}

	private function is_proper_date($date){
		if (preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', strtolower($date))) {
			return true;
		}
		return false;
	}

	private function is_proper_time($time){
		if (preg_match('/\d+\s(Min|Mins|Hour|Hours)/', $time)) {
			return true;
		}
		return false;
	}

	private function set_dropdown_query(){
		$this->dropdown_query = "SELECT * FROM time_dropdown_values;";
	}

	private function set_select_query($id){
		if ($id) {
			$this->select_query = "SELECT * FROM mt_table WHERE id='$id';";
		} else {
			$this->select_query = "SELECT * FROM mt_table ORDER BY id DESC;";
		}
	}

	private function set_insert_query($name, $date, $time){
		$this->insert_query = "INSERT INTO mt_table(name, date, time) VALUES ('$name', '$date', '$time');";
	}

	private function set_delete_query($id){
		$this->delete_query = "DELETE FROM mt_table WHERE id = '$id';";
	}

	private function set_update_query($id, $name, $date, $time){
		$this->update_query = "UPDATE mt_table SET name='$name', date='$date', time='$time' WHERE id = '$id';";
	}

	private function set_toggle_query($id, $toggle_value){
		$this->toggle_query = "UPDATE mt_table SET is_completed = '$toggle_value' WHERE id = '$id';";
	}

	public function dropdown_data() {
		try {
			
			$this->set_dropdown_query();

	        $query  = $this->pdoconn->prepare($this->dropdown_query);
	        $query->execute();
	        $arr = $query->fetchAll(PDO::FETCH_ASSOC);
	        return json_encode($arr);

	    } catch (Exception $e) {
			$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            return json_encode($msgbox);
		}
	}

	private function find_toggle_value($id){
		try {
			$sql = "SELECT is_completed FROM mt_table WHERE id='$id';";
			$query  = $this->pdoconn->prepare($sql);

			if($query->execute()){

				$arr = $query->fetchAll(PDO::FETCH_ASSOC);

				return array('code' => '1', 'val' => $arr[0]['is_completed']);

			} else {
				return array('code' => '0', 'val' => 'Error!');
			}
		} catch (Exception $e) {
			return array('code' => '0', 'val' => 'Error!');
		}
	}

	public function toggle_data($id){
		if (!is_numeric($id)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Parameter!');
            return json_encode($msgbox);
		}

		try {

			if ($this->find_toggle_value($id)['code'] == '1') {

				$value = $this->find_toggle_value($id)['val'];

			} else {

				$msgbox = array('code' => '0', 'msg' => 'No such record exists!');
            	return json_encode($msgbox);
			}

			if ($value == '0') {
				$value = '1';
			} else {
				$value = '0';
			}
			
			$this->set_toggle_query($id, $value);

	        $query  = $this->pdoconn->prepare($this->toggle_query);
	        
	        if ($query->execute()) {

	        	$msgbox = array('code' => '1', 'msg' => 'Record toggled successfully!');
            	return json_encode($msgbox);
	        } else {
	        	$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            	return json_encode($msgbox);
	        }
	        
	    } catch (Exception $e) {
			$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            return json_encode($msgbox);
		}


	}

	public function delete_data($id){
		if (!is_numeric($id)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Parameter!');
            return json_encode($msgbox);
		}

		try {
			
			$this->set_delete_query($id);

	        $query  = $this->pdoconn->prepare($this->delete_query);
	        
	        if ($query->execute()) {
	        	$msgbox = array('code' => '1', 'msg' => 'Record deleted successfully!');
            	return json_encode($msgbox);
	        } else {
	        	$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            	return json_encode($msgbox);
	        }
	        
	    } catch (Exception $e) {
			$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            return json_encode($msgbox);
		}
	}

	public function fetch_data(){

		try {
			
			$this->set_select_query(false);

	        $query  = $this->pdoconn->prepare($this->select_query);
	        $query->execute();
	        $arr = $query->fetchAll(PDO::FETCH_ASSOC);
	        return json_encode($arr);
	    } catch (Exception $e) {
			$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            return json_encode($msgbox);
		}
	}

	public function edit_data($id){
		try {
			
			$this->set_select_query($id);

	        $query  = $this->pdoconn->prepare($this->select_query);
	        $query->execute();
	        $arr = $query->fetchAll(PDO::FETCH_ASSOC);
	        return json_encode($arr);
	    } catch (Exception $e) {
			$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            return json_encode($msgbox);
		}
	}


	public function update_data($id, $name, $date, $time){

		if (!is_numeric($id)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Parameter!');
            return json_encode($msgbox);
		}

		if (!$this->is_proper_name($name)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Name!');
            return json_encode($msgbox);
		}

		if (!$this->is_proper_date($date)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Date!');
            return json_encode($msgbox);
		}

		if (!$this->is_proper_time($time)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Time!');
            return json_encode($msgbox);
		}



		try {
			
			$this->set_select_query($id);

	        $query  = $this->pdoconn->prepare($this->select_query);
	        $query->execute();
	        $arr = $query->fetchAll(PDO::FETCH_ASSOC);
	        if(count($arr) <= 0){
	        	$msgbox = array('code' => '0', 'msg' => 'No such record exists!');
            	return json_encode($msgbox);
	        }

	        $this->set_update_query($id, $name, $date, $time);
	        $query  = $this->pdoconn->prepare($this->update_query);

	        if($query->execute()){
	        	$msgbox = array('code' => '1', 'msg' => 'Record updated successfully!');
            	return json_encode($msgbox);
	        } else {
	        	$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            	return json_encode($msgbox);
	        }

	    } catch (Exception $e) {
			$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            return json_encode($msgbox);
		}
	}

	public function insert_data($name, $date, $time){

		if (!$this->is_proper_name($name)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Name!');
            return json_encode($msgbox);
		}

		if (!$this->is_proper_date($date)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Date!');
            return json_encode($msgbox);
		}

		if (!$this->is_proper_time($time)) {
			$msgbox = array('code' => '0', 'msg' => 'Invalid Time!');
            return json_encode($msgbox);
		}

		try {

	        $this->set_insert_query($name, $date, $time);

	        $query  = $this->pdoconn->prepare($this->insert_query);

	        if($query->execute()){
	        	$msgbox = array('code' => '1', 'msg' => 'Data inserted successfully!');
            	return json_encode($msgbox);
	        } else {
	        	$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            	return json_encode($msgbox);
	        }
	        

	    } catch (Exception $e) {
			$msgbox = array('code' => '0', 'msg' => 'Oops! Something went wrong in the server!');
            return json_encode($msgbox);
		}

	}

	
}

?>