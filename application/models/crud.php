<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Model
{
	public function __construct(){
		parent::__construct();
	}
	
	public function insert($table,$array_data){
		$insert 	=	$this->db->insert($table, $array_data);
			if($insert){
				$result='1';
			}
			else{
				$result='2';
			}
			return $result;
	}
	
	public function update($table,$array_data,$array_where,$field_where){
		$this->db->where($field_where,$array_where);
		$update 	=	$this->db->update($table, $array_data);
			if($update){
				$result='1';
			}
			else{
				$result='2';
			}
			return $result;
	}
	
	public function delete($table,$array_where){
		$delete 	=	$this->db->delete($table,$array_where); 
			if($delete){
				$result='1';
			}
			else{
				$result='2';
			}
			return $result;
	}
}
?>