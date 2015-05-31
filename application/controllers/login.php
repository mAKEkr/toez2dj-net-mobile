<?php
	class Login extends CI_Controller{
		function index(){
			if($this->input->post()){
				$this->load->model(array('loginmodel', 'parsemodel'));

				$post_field = 'user_id=' . $this->input->post('user_id') . '&password=' . $this->input->post('user_pw');
				$microtime = explode(' ', microtime());
				$uniqsessid = MD5(uniqid() . '|' . mt_rand(0,9999999) . '|' . $microtime['0'] . '|' . $microtime['1']);
				$cookie_location = $this->config->item('cookie_dir') . $uniqsessid . '.dat';

				if(file_exists($cookie_location)) unlink($cookie_location);

				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_URL, 'http://toez2dj.net/zeroboard/login_check.php');
				curl_setopt ($ch, CURLOPT_HEADER, 1);
				curl_setopt ($ch, CURLOPT_POST, 1);
				curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie_location);
				curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_location);
				curl_setopt ($ch, CURLOPT_POSTFIELDS, 'user_id=' . $this->input->post('user_id') . '&password=' . $this->input->post('user_pw'));
				curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($ch);

				curl_setopt ($ch, CURLOPT_URL,'http://toez2dj.net');
				curl_setopt ($ch, CURLOPT_HEADER, 1);
				curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_location);
				$result = curl_exec($ch);
				curl_close($ch);

				$username = strip_tags(substr($result, strpos($result, '<td nowrap><b>') + 14, strpos($result, '</b>', strpos($result, '<td nowrap><b>')) - strpos($result, '<td nowrap><b>') - 14));
				$usergroup = substr($result, strpos($result, '(<font color=#') + 21, strpos($result, '</font>', strpos($result, '(<font color=#') + 21) - strpos($result, '(<font color=#') - 21);

				$this->session->set_userdata('uniqsessid', $uniqsessid);
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('usergroup', $this->loginmodel->checkUserGroupbyString($usergroup));

				if($username != NULL){
					$ch = curl_init();
					curl_setopt ($ch, CURLOPT_URL, 'http://toez2dj.net/zeroboard/member_modify.php?group_no=4');
					curl_setopt ($ch, CURLOPT_HEADER, 1);
					curl_setopt ($ch, CURLOPT_POST, 1);
					curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie_location);
					curl_setopt ($ch, CURLOPT_POSTFIELDS, 'password=' . $this->input->post('user_pw') . '&referer=http://toez2dj.net/&act=ok');
					curl_setopt ($ch, CURLOPT_TIMEOUT, 30);
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
					$result = curl_exec($ch);
					curl_close($ch);

					if( strpos($result, '.thumb') != NULL ) {
						$emblem_data = str_replace('_', '/', substr($result, strrpos($result, 'icon/emblem/') + 12, strrpos($result, '_120.thumb', strrpos($result, 'icon/emblem/') + 12) - strrpos($result, 'icon/emblem/') - 12));
						$this->session->set_userdata('useremblem', $emblem_data);
					}
				}
				redirect(site_url('/' . $this->input->post('success_return_url')));
			} else if ($this->session->userdata('username') != NULL) {
				show_404();
			} else {
				$url = urldecode($_GET['return_url']);
				$url_splice = explode('/', $url);

				$_VIEW = Array(
					'CurrentController' => $url_splice['0'],
					'CurrentBoardID' => $url_splice['1']
				);

				$_MODEL['login_data'] = $this->input->cookie('TOE-autologin_data', TRUE);
				$_MODEL['return_url'] = $url;

				$this->load->view('templates/header.php', $_VIEW);
				$this->load->view('login.php', $_MODEL);
				$this->load->view('templates/footer.php');
			}
		}

		function logout(){
			if( ! $this->session->userdata('username')) {
				show_404();
			} else {
				$this->session->sess_destroy();
				redirect(site_url(urldecode($_GET['return_url'])));
			}
		}

		function test(){
			var_dump($this->session->all_userdata());
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL,'http://toez2dj.net');
			curl_setopt ($ch, CURLOPT_HEADER, 1);
			curl_setopt ($ch, CURLOPT_COOKIEFILE, $this->config->item('cookie_dir') . $this->session->userdata('uniqsessid') . '.dat');
			$result = curl_exec($ch);
			curl_close($ch);
		}
	}