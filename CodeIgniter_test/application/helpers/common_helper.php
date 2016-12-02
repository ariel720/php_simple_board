<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * AJAX 함수에서 JSON 결과를 반환
 *
 * @param	
 * @return	
 */
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

/**
 * redirect 개선
 *
 * @param	
 * @return	
 */
function redirect_uri($uri) {
	redirect("http://".$_SERVER['HTTP_HOST'].$uri);
}


/**
 * CDN 주소와 photoURI를 결합해서 반환
 *
 * @param	
 * @return	
 */
function url_photo($photoURI) {						
	if ($photoURI=="") $photoURI ="noimage.png";
	
	return CDN_URL."/".$photoURI;
}

/**
 * 긴 텍스트를 n글자로 줄임 (뒤에 ... 붙임)
 *
 * @param	
 * @return	
 */
function str_fix($str, $n) {						

	return substr($str, 0, $n)."...";
}


/**
 * 몽고Date 포맷 출력
 *
 * @param	
 * @return	
 */
function str_mdate($str) {						

	return date('Y-m-d H:i:s', $str->sec);
}

/**
 * 문자열에 HTML 태그를 제거
 *
 * @param	
 * @return	
 */
function stripHTMLtags($str)
{
    $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
    $t = htmlentities($t, ENT_QUOTES, "UTF-8");
    return $t;
}

/**
 * 몽고Date 포맷 출력
 *
 * @param	
 * @return	
 */
function ymd_mdate($str) {						

	return date('Y-m-d', $str->sec);
}


/**
 * HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꾸어 리턴한다.
 *
 * @param	string	대상이 되는 문자열
 * @return	string[]
 */
function segment_explode($seg) {
	//세크먼트 앞뒤 '/' 제거후 uri를 배열로 반환
	$len = strlen($seg);
	if (substr($seg, 0, 1) == '/') {
		$seg = substr($seg, 1, $len);
	}
	$len = strlen($seg);

	if (substr($seg, -1) == '/') {
		$seg = substr($seg, 0, $len - 1);
	}
	$seg_exp = explode("/", $seg);

	return $seg_exp;
}

/**
 * url중 키값을 구분하여 값을 가져오도록.
 *
 * @param Array $url : segment_explode 한 url값
 * @param String $key : 가져오려는 값의 key
 * @return String $url[$k] : 리턴값
 */
function url_explode($url, $key) {
	$cnt = count($url);
	for ($i = 0; $cnt > $i; $i++) {
		if ($url[$i] == $key) {
			$k = $i + 1;
			return $url[$k];
		}
	}
}

function url_delete($url_arr, $del_param) {
	$arr_s = array_search($del_param, $url_arr);

	if ($arr_s != '') {
		array_splice($url_arr, $arr_s, 2);
	}

	return $url_arr;
}

function match_uri($a, $b) {
	if (strpos($a, $b) !== FALSE) echo 'active';
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

function is_ajax() {
    // search backwards starting from haystack length characters from the end
    return strtolower(filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest';
}
?>