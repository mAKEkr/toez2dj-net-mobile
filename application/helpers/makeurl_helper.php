<?php

	function makeurl_fromuri($uri_string, $get_request_array = false){
		if($get_request_array != false) {
			foreach($get_request_array as $key => $val) {
				$get_string .= '&' . $key . '=' . $val;
			}
			$get_string = substr($get_string, 1);
			return urlencode($uri_string . '/?' . $get_string);
		} else {
			return urlencode($uri_string . '/');
		}
	}