<?php
	class Loginmodel extends CI_Model{
		function __constrcut(){
			parent::__constrcut();
		}

		function Login($post_field){
			$this->load->helper('curl');

			if($this->checkCookieFileExists($this->input->cookie('PHPSESSID')) === true){
				unlink($this->config->item('cookie_dir') . $session_id . '.dat');
			}

			$curl_file_location = $this->config->item('cookie_dir') . $this->input->cookie('PHPSESSID') . '.dat';

			$content = curl_advance($this->config->item('parse_url') . 'zeroboard/login_check.php', 1, $post_field, true, true, false, 10);
			//$content_result = curl_advance($this->config->item('parse_url'), 0, null, 1, $this->config->item('cookie_dir') . $this->input->cookie('PHPSESSID') . '.dat');
			
			return $content;
		}

		function checkCookieFileExists($session_id){
			if(file_exists($this->config->item('cookie_dir') . $session_id . '.dat')){
				return true;
			} else {
				return false;
			}
		}

		function checkUserGroupbyString($string){
			switch($string) {
				case '준회원':
					return 'default';
				break;

				case '정회원':
					return 'member';
				break;

				case '우수회원':
					return 'member1';
				break;

				case '포럼운영자':
					return 'forum-admin';
				break;

				case '사이트관리자':
					return 'admin';
				break;

				case '최고운영자':
					return 'master';
				break;
			}
		}
	}