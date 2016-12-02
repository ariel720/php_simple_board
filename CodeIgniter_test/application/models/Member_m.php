<?php

class Member_m extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}

	function fetch_list() {
		
		$this->db->select('*');
		$this->db->from('tb_board');
		$this->db->order_by("CREATE_DT", "desc"); 

		
		$query = $this->db->get();
		
		$results = array();
		foreach ($query->result() as $row) {
			$results[] = $row;
		}		
		return $results;
	}

	function fetch_content($seq) {

		$this->db->select('*');
		$this->db->where('SEQ', $seq);
		$this->db->from('tb_board');
	
		$query = $this->db->get();
					
		$result = $query->result();
		
		return $result;
	}

	function create_content($param) {
		
		$data = array(
               'WRITER' => $param['writer'],
               'TITLE' => $param['title'],
               'CONTENTS' => $param['content']
               );
		$this->db->set('CREATE_DT', 'now()', FALSE);
		$this->db->insert('tb_board', $data); 
	}


	function remove_content($seq) {

		$this->db->where("SEQ", $seq);
		$this->db->delete('tb_board');
	}

	function update_content($param) {

		$data = array(
              'WRITER' => $param['writer'],
               'TITLE' => $param['title'],
               'CONTENTS' => $param['content']
            );

		$this->db->where('SEQ', $param['seq']);
		$this->db->update('tb_board', $data); 
	}


	

}
?>