<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

function build_pagination($uri, $list_total) {
	$CI = &get_instance();
	
	$result = array();
	
	$uri_array = segment_explode($uri);
	$url = BASE_ROOT . '/' . implode('/', url_delete($uri_array, 'page'));
	if (in_array('page', $uri_array)) {
		
		$index = array_search('page', $uri_array);
		//페이지 넘버가 없는 경우 1(처음)
		$page = (empty($uri_array[$index+1]))?1:$uri_array[$index+1];
	}
	if (!isset($page) || empty($page) || !is_numeric($page) ) $page = 1;
	
	//검색시 get 적용
	if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
	
	$config['base_url'] = $url.'/page/';
	$config['total_rows'] = $list_total;
	$config['per_page'] = 20; 
	
	$config['num_links'] = 5;
	$config['uri_segment'] = 5;
	$config['use_page_numbers'] = TRUE;
	
	$config['full_tag_open'] = '<ul class="pagination">';
	$config['full_tag_close'] = '</ul>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a>';
	$config['cur_tag_close'] = '</a></li>';
	$config['first_link'] = '처음';
	$config['last_link'] = '마지막';
	$config['prev_link'] = '« 이전';
	$config['next_link'] = '다음 »';
	
	$CI->pagination->initialize($config); 
	
	$result['per_page'] = $config['per_page'];
	$result['start'] = (($page - 1) * $config['per_page']);
	$result['pagination_links'] = $CI->pagination->create_links();
	
	return $result;
}


function build_options($arr, $current_key) {
	$html_string = "";
	
	foreach($arr as $one) {
        $sel = ($one['key'] == $current_key) ? 'selected' : '';
        $html_string .= "<option value=".$one['key']." ".$sel.">".$one['value']."</option>"; 
    }
    
    return $html_string;
}

function build_options_for_years($current_year) {
	$arr = array();
	for($i=date("Y")-50;$i<=date("Y");$i++) {
		$year = date("Y", mktime(0,0,0,0,1,$i+1));
		$arr[] = array("key"=>"".$year,"value"=>"".$year); 
    }
    return build_options($arr, $current_year);
}

?>