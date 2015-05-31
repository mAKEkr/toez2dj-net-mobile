<?php
	class File_handler extends CI_Controller {
		function image($boardID, $fileID, $extension){
			$this->load->helper(array('curl', 'file'));

			$file_path = './attachment/image//' . $boardID . '_' . $fileID . '.' . $extension;
			$file_url = 'http://toez2dj.net/zeroboard/data/' . $boardID . '/toez2dj_' . $fileID . '.' . $extension;

			if( ! file_exists($file_path)){
				curl_download($file_url, $file_path);
			}

			$this->output->set_header('Cache-Control: max-age=315360000', TRUE)->set_content_type(mime_content_type($file_path))->set_output(read_file($file_path));
		}

		function thumbnail($boardID, $fileID){
			$this->load->helper(array('curl', 'file'));

			$file_path = './attachment/thumbnail/' . $boardID . '_' . $fileID . '.jpg';
			$file_url = 'http://toez2dj.net/zeroboard/data/' . $boardID . '/toez2dj_' . $fileID . '.thumb';

			if( ! file_exists($file_path)){
				curl_download($file_url, $file_path);
			}

			$this->output->set_header('Cache-Control: max-age=315360000', TRUE)->set_content_type('image/jpeg')->set_output(read_file($file_path));
		}

		function emblem($userID, $fileID){
			$this->load->helper(array('curl', 'file'));

			$file_path = './attachment/thumbnail/emblem_' . $userID . '_' . $fileID . '.jpg';
			$file_url = 'http://toez2dj.net/zeroboard/icon/emblem/' . $userID . '_' . $fileID . '_120.thumb';

			if( ! file_exists($file_path)){
				curl_download($file_url, $file_path);
			}

			$this->output->set_header('Cache-Control: max-age=315360000', TRUE)->set_content_type('image/jpeg')->set_output(read_file($file_path));
		}
	}