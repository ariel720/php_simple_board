<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function return_json ($is_ok, $code, $msg, $data) {
	
	if (!is_bool($is_ok)) {
		show_error("return_json() error param is_ok ");
		return ;
	}
    if (!is_int($code)) {
		show_error("return_json() error param code ");
		return ;
	}
	
	header("Content-Type:application/json");
	echo json_encode(array("r"=>($is_ok)?"ok":"err", "c"=>$code, "m"=>$msg, "d"=>$data));
	exit();
}
//============================================================================
	function board()
	{
		
		$info = array("title"=> "게시판", "location"=> "게시판 목록");

		$data['list'] = $this->member_m->fetch_list();
		
		$this -> load -> view('admin/common/top_v', $info);
		$this -> load -> view('admin/admin/list_v',$data);
		$this -> load -> view('admin/common/bottom_v');
	}

	function view()
	{
		$info = array("title"=> "게시판", "location"=> "글보기");

		$param = $this->uri->segment(3);

		$data['content'] = $this->member_m->fetch_content($param);

		$this -> load -> view('admin/common/top_v', $info);
		$this -> load -> view('admin/admin/view_v',$data);
		$this -> load -> view('admin/common/bottom_v');
	}

	function create()
	{
		
		$info = array("title"=> "게시판", "location"=> "글쓰기");

		$this -> load -> view('admin/common/top_v', $info);
		$this -> load -> view('admin/admin/create_v');
		$this -> load -> view('admin/common/bottom_v');
	}

	function update()
	{
		
		$info = array("title"=> "게시판", "location"=> "수정하기");

		$param = $this->uri->segment(3);

		$data['content'] = $this->member_m->fetch_content($param);

		$this -> load -> view('admin/common/top_v', $info);
		$this -> load -> view('admin/admin/update_v',$data);
		$this -> load -> view('admin/common/bottom_v');
	}

	
	function ajax_create()
	{
		$param = $this->input->post(null, true);

		if (empty($param['writer'])) { $this->return_json(false, 1, "작성자를 입력해주세요", null); }	
		if (empty($param['title'])) { $this->return_json(false, 1, "제목을 입력해주세요", null); }	
		if (empty($param['content'])) { $this->return_json(false, 1, "내용을 입력해주세요", null); }	

		$this->member_m->create_content($param);

		$this->return_json(true, 1, "작성 완료", null);
				
	}

	function ajax_remove()
	{
		$param = $this->input->post(null, true);
		if (empty($param['seq'])) { $this->return_json(false, 1, "삭제 불가", null); }	

		$this->member_m->remove_content($param['seq']);

		$this->return_json(true, 1, "삭제성공", null);
				
	}

	function ajax_update()
	{
		
		$param = $this->input->post(null, true);

		if (empty($param['seq'])) { $this->return_json(false, 1, "삭제 불가", null); }

		if (empty($param['writer'])) { $this->return_json(false, 1, "작성자를 입력해주세요", null); }	
		if (empty($param['title'])) { $this->return_json(false, 1, "제목을 입력해주세요", null); }	
		if (empty($param['content'])) { $this->return_json(false, 1, "내용을 입력해주세요", null); }	
	

		$this->member_m->update_content($param);

		$this->return_json(true, 1, "수정완료", null);
				
	}



	
}
