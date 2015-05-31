<?php
	class Parsemodel extends CI_Model {
		function __construct(){
			parent::__construct();
		}

		function parse($url, $cookie = false){
			$this->load->helper('curl');
			$this->load->config('toez2dj', false, true);

			//url, post(boolean), field, return, header, cookie_location, timeout

			if($cookie === false){
				$content = curl_advance($url, 0, null, 1, 0, false, 10);
			} else {
				$cookie_location = $this->config->item('cookie_dir') . $this->session->userdata('uniqsessid') . '.dat';
				$content = curl_advance($url, 0, null, 1, 0, $cookie_location, 10);
			}

			if(strpos($content, 'DB 접속시 에러가 발생했습니다')){
				$return_value = false;
				$return_value['error'] = 'db';
			} else {
				$return_value = $content;
			}

			return $return_value;
		}
	}