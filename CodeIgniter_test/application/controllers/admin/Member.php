<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->user_data = $this->session->all_userdata();
	}
	
	function index() {
		
	}

	function lists() {
		
		// 현재 위치 정보
		$info = array("user_data"=> $this->user_data, "title"=> "회원 관리", "location"=> "회원 목록");
				
		// 필터링할 키워드
		$data['search_keyword'] = $this->input->get("search_keyword", true);
		
		// 총 게시물 갯수
		$data['list_count'] = $this->member_m->count_members($data['search_keyword'] );
				
		// 페이지네이션 html 생성 및 정의된 변수 가져옴
		$paging = build_pagination($this->uri->uri_string(), $data['list_count']);
		
		$data['pagination_links'] = $paging['pagination_links'];
		
		// 게시물 목록
		$data['list'] = $this->member_m->fetch_members($paging['per_page'], $paging['start'],  $data['search_keyword'] );
		
		$this -> load -> view('admin/common/top_v', $info);
		$this -> load -> view('member/list_v', $data);
		$this -> load -> view('admin/common/bottom_v');
	}

	function view() {
		$seq = $this->uri->segment(4);
		
		// 현재 위치 정보
		$info = array("user_data"=> $this->user_data, "title"=> "회원 관리", "location"=> "회원 정보");
		
		//회원정보
		$user = $this->member_m->fetch_member_by_seq($seq);
		
		//비밀번호제거
		unset($user->USER_PASSWORD);
		
		$data['user'] = $user;
								
		$this -> load -> view('admin/common/top_v', $info);
		$this -> load -> view('member/view_v', $data);
		$this -> load -> view('admin/common/bottom_v');
	}
	
	function create_member() {		
		$info = array("user_data"=> $this->user_data, "title"=> "회원 관리", "location"=> "회원 등록");
		
		$this -> load -> view('admin/common/top_v', $info);
		$this -> load -> view('member/create_v');
		$this -> load -> view('admin/common/bottom_v');
	}
	
	//회원 추가
	function ajax_create_member() {
		$param = $this->input->post(null, true);
		
		//공백 제거
		$param['USER_EMAIL'] = str_replace(" ", "", $param['USER_EMAIL']);
		$param['USER_NAME'] = str_replace(" ", "", $param['USER_NAME']);
		$param['USER_PHONE'] = str_replace(" ", "", $param['USER_PHONE']);
		$param['USER_TYPE'] = str_replace(" ", "", $param['USER_TYPE']);
		$param['USER_PASSWORD'] = str_replace(" ", "", $param['USER_PASSWORD']);
		$param['CHECK_PASSWORD'] = str_replace(" ", "", $param['CHECK_PASSWORD']);
		
		if(empty($param['USER_EMAIL'])) return_json(false, 1, "이메일을 입력해주세요", null);
		
		//이메일 형식 확인
		if (valid_email($param['USER_EMAIL'])==false){ return_json(false, 2, "이메일 형식이 올바르지 않습니다.", null);}
		
		//이메일 확인
		$check_email = $this->member_m->fetch_user($param);
		
		if ($check_email > 0) { return_json(false, 3, "이미 존재하는 사용자입니다.", null); }		
		
		if(empty($param['USER_NAME'])) return_json(false, 4, "이름을 입력해주세요", null);
		if(empty($param['USER_PHONE'])) return_json(false, 5, "연락처를 입력해주세요", null);
		
		//숫자만 (-제거)
		$param['USER_PHONE'] = preg_replace("/[^0-9]*/s", "", $param['USER_PHONE']);
		
		if(empty($param['USER_TYPE'])) return_json(false, 6, "권한을 선택해주세요", null);
		if(empty($param['USER_PASSWORD'])) return_json(false, 7, "비밀번호를 입력해주세요", null);
		
		//비밀번호 재입력 확인
		if($param['USER_PASSWORD'] != $param['CHECK_PASSWORD']) return_json(false, 8, "비밀번호가 일치하지 않습니다. 다시입력해주세요", null);
		
		//비밀번호 암호화
		$param['USER_PASSWORD'] = password_hash($param['USER_PASSWORD'], PASSWORD_DEFAULT);
		
		//사진
		if(!empty($_FILES['member_img'])) {
			$upload_result = $this->util_file->upload($_FILES['member_img']);			
			if ($upload_result["put"] =="ok") $param['USER_PHOTO_URI'] = $upload_result['fileuri'];	
		}
		
		$this -> member_m -> create_user($param);
		
		return return_json(true, 0, "ok", $param['USER_NAME']);
	}
	
	//회원정보 수정
	function ajax_update_member() {
		$param = $this->input->post(null, true);
		
		//공백 제거
		$param['USER_EMAIL'] = str_replace(" ", "", $param['USER_EMAIL']);
		$param['USER_NAME'] = str_replace(" ", "", $param['USER_NAME']);
		$param['USER_PHONE'] = str_replace(" ", "", $param['USER_PHONE']);
		$param['USER_TYPE'] = str_replace(" ", "", $param['USER_TYPE']);
		
		if(empty($param['USER_EMAIL'])) return_json(false, 1, "이메일을 입력해주세요", null);
		
		//이메일 형식 확인
		if (valid_email($param['USER_EMAIL'])==false){ return_json(false, 2, "이메일 형식이 올바르지 않습니다.", null);}
		
		//이메일 확인
		if($param['USER_EMAIL'] != $param['USER_ORI_EMAIL']) {
			$check_email = $this->member_m->fetch_user($param);		
			if ($check_email > 0) { return_json(false, 3, "이미 존재하는 사용자입니다.", null); }	
		}
		
		if(empty($param['USER_NAME'])) return_json(false, 4, "이름을 입력해주세요", null);
		if(empty($param['USER_PHONE'])) return_json(false, 5, "연락처를 입력해주세요", null);
		if(empty($param['USER_TYPE'])) return_json(false, 6, "권한을 선택해주세요", null);
		
		//사진
		if(!empty($_FILES['member_img'])) {
			$upload_result = $this->util_file->upload($_FILES['member_img']);			
			if ($upload_result["put"] =="ok") $param['USER_PHOTO_URI'] = $upload_result['fileuri'];	
		}
		
		$this -> member_m -> update_user($param);
		
		return_json(true, 0, 'ok', null);
	}
	
	function ajax_remove_member() {
		$param = $this->input->post(null, true);
		
		//공백 제거
		$param['USER_EMAIL'] = str_replace(" ", "", $param['seq']);
		
		$this -> member_m -> remove_user($param);
		
		return_json(true, 0, 'ok', null);
	}
}