<?php
	class Validationmodel extends CI_Model{
		function __construct(){
			parent::__construct();
		}

		function checkedIsError($content){
			if( ! strpos($content, '<table border="0" width="300" cellpadding="0" cellspacing="0" align="center">')) {
				return false;
			} else {
				return true;				
			}
		}

		function getErrorCode($content){
			$error_content = substr($content, strpos($content, '<td align="center" height="') + 27, strpos($content, '</td>', strpos($content, '<td align="center" height="') + 27) - strpos($content, '<td align="center" height="') - 27);

			echo $error_content;

			switch($error_content){
				case '비밀글은 본인과 운영자급 레벨 회원만<br>열람 가능합니다':
					return '206';
				break;

				case '':
				break;
			}
		}
	}