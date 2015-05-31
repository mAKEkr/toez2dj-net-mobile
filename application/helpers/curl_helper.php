<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

	function curl_advance($url, $post = false, $post_field = null, $return = 1, $header = 0, $cookie_jar_location = false, $timeout = 10){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		if($post !== false){
			curl_setopt($ch, CURLOPT_POST, 1);
		}

		//return http-header.
		curl_setopt($ch, CURLOPT_HEADER, $header);
		if($cookie_jar_location !== false)
		{
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar_location);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar_location);
		}

		curl_setopt($ch, CURLOPT_POSTFIELD, $post_field);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

		$return = curl_exec($ch);
		curl_close($ch);

		return $return;
	}

	function curl_download($url, $file_path){
		$file_pointer = fopen($file_path, 'w');

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FILE, $file_pointer);

		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
	}