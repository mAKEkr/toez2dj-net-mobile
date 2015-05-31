<?php
	class Submit extends CI_Controller {

		function __construct(){
			parent::__construct();
		}

		function article($boardID){
			if($this->session->userdata('username') == NULL ){
				show_404();
			} else if( ! $this->input->post() ){
				$_VIEW = Array(
					'CurrentBoardID' => $boardID
				);

				$_MODEL['return_url'] = $url;

				$this->load->view('templates/header.php', $_VIEW);
				$this->load->view('write', $_VIEW);
				$this->load->view('templates/footer.php');
			} else {
				$this->load->library(array('upload', 'image_lib'));

				//multiple upload. only using original upload library

				//주의점 : 1. $_FILES 뒤로 오는 변수명은

				$uploaded_files = $_FILES;
				$uploaded_file_count = count($_FILES['document-file']['name']);
				$uploaded_file_list = array();

				for($i=0; $i<$uploaded_file_count; $i++) {
					if($uploaded_files['document-file']['name'][$i] == null) continue;

					unset($_FILES);
					unset($image_config);

					$_FILES['document-file']['name']	 = $uploaded_files['document-file']['name'][$i];
					$_FILES['document-file']['type']	 = $uploaded_files['document-file']['type'][$i];
					$_FILES['document-file']['tmp_name'] = $uploaded_files['document-file']['tmp_name'][$i];
					$_FILES['document-file']['error']	 = $uploaded_files['document-file']['error'][$i];
					$_FILES['document-file']['size']	 = $uploaded_files['document-file']['size'][$i];

					$upload_config = Array(
						'upload_path' 	=> './attachment/temporary/',
						'allowed_types' => 'gif|jpg|jpeg|png',
						'max_size' 		=> '10240'
					);

					$this->upload->initialize($upload_config);
					if( ! $this->upload->do_upload('document-file')) {
						echo $this->upload->display_errors();
					} else {
						$upload_data = $this->upload->data();

						$file_md5	= md5_file('./attachment/temporary/' . $upload_data['file_name']);
						switch($upload_data['file_type']){
							case 'image/jpeg':
							case 'image/pjpeg':		
								$file_ext = 'jpg';
							break;

							case 'image/png':
							case 'image/x-png':
								$file_ext = 'png';
							break;

							case 'image/gif':
								$file_ext = 'gif';
							break;
						}

						$exif_data = exif_read_data('./attachment/temporary/' . $upload_data['file_name']);

						// image auto rotation from exif infomation.
						// based on XE tips.
						// http://www.xpressengine.com/tip/22381343
						if( ! empty($exif_data['Orientation']) && $exif_data['Orientation'] != '1' ) {
							$rotation_image_config = array(
								'image_library' => 'gd2',
								'source_image'	=> '/srv/http/toez2dj/attachment/temporary/' . $upload_data['file_name'],
								'quality' => 100
							);

							switch($exif_data['Orientation']) {
								case 8:
									var_dump($exif_data['Orientation']);
									$rotation_image_config['rotation_angle'] = '270';
									break;

								case 3:
									var_dump($exif_data['Orientation']);
									$rotation_image_config['rotation_angle'] = '180';
									break;

								case 6:
									var_dump($exif_data['Orientation']);
									$rotation_image_config['rotation_angle'] = '90';
									break;

								default:
								break;
							}

							$this->image_lib->initialize($rotation_image_config);

							if ( ! $this->image_lib->rotate() ){
								echo '<h1>Rotation Error!</h1>';
								echo $this->image_lib->display_errors();
							}

							$this->image_lib->clear();
						}

						if($upload_data['image_width'] > 1024) {
							$resize_image_config = array(
								'image_library' => 'gd2',
								'source_image'	=> '/srv/http/toez2dj/attachment/temporary/' . $upload_data['file_name'],
								'quality' => 100,
								'maintain_ratio' => true,
								'master_dim' => width,
								'width' => 1024,
								'height' => 1024
							);

							$this->image_lib->initialize($resize_image_config);

							if ( ! $this->image_lib->resize() ) {
								echo '<h1>Resize Error!</h1>';
								echo $this->image_lib->display_errors();
							}
							$this->image_lib->clear();
						}

						rename('./attachment/temporary/' . $upload_data['file_name'], './attachment/temporary/' . $file_md5 . '.' . $file_ext);
						array_push($uploaded_file_list, $upload_data['file_path'] . $file_md5 . '.' . $file_ext);
					}
				}

				//본격적인 curl 전송
				$this->load->helper('htmlpurifier');

				$document_content = $this->input->post('document-content');
				if($this->input->cookie('general-sign_disable') != 'disable') {
					$document_content .= ( $this->input->cookie('document-sign') != NULL ) ? '<br />' . $this->input->cookie('document-sign') : $this->config->item('signature-document');
				}

				$post_data = Array(
					'id' => $boardID,
					'subject' => $this->input->post('document-title'),
					'use_html' => '1',
					'memo' => html_purify($document_content, 'document'),
					'file1' => $uploaded_file_list['0'] ? '@' . $uploaded_file_list['0'] : '',
					'file2' => $uploaded_file_list['1'] ? '@' . $uploaded_file_list['1'] : ''
				);

				//curl send
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, $this->config->item('parse_url') . 'zeroboard/write_ok.php');
				curl_setopt ($ch, CURLOPT_HEADER, 0);
				curl_setopt ($ch, CURLOPT_POST, 1);
				curl_setopt ($ch, CURLOPT_COOKIEFILE, $this->config->item('cookie_dir') . $this->session->userdata('uniqsessid') . '.dat');
				curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_data);
				curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 0);
				$result = curl_exec($ch);
				curl_close($ch);

				foreach($uploaded_file_list as $var){
					unlink($var);
				}

				redirect(site_url('/lists/' . $boardID));
			}
		}

		function comment($boardID, $documentNo){
			if($this->session->userdata('username') == NULL || ! $this->input->post() ){
				show_404();
			}

			$this->load->config('toez2dj', false, true);
			$this->load->helper('curl');

			$comment_content = $this->input->post('comment-content');
			if($this->input->cookie('general-sign_disable') != 'disable') {
				$comment_content .= ( $this->input->cookie('comment-sign') != NULL ) ? $this->input->cookie('comment-sign') : $this->config->item('signature-comment');
			}

			$post_data = array(
				'id' => $boardID,
				'no' => $documentNo,
				'memo' => $comment_content
			);

			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $this->config->item('parse_url') . 'zeroboard/comment_ok.php');
			curl_setopt ($ch, CURLOPT_HEADER, 1);
			curl_setopt ($ch, CURLOPT_POST, 1);
			curl_setopt ($ch, CURLOPT_COOKIEFILE, $this->config->item('cookie_dir') . $this->session->userdata('uniqsessid') . '.dat');
			curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_data);
			curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 0);
			$result = curl_exec($ch);
			curl_close($ch);

			redirect(site_url('/' . $this->input->post('success_return_url')));
		}
	}