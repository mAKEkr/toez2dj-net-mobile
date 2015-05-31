<?php
	class Config Extends CI_Controller {
		function index(){
			if( $this->input->post() ){
				foreach($this->input->post() as $key => $val)
				{
					if($key == 'redirection') continue;
					if($val == 'default' && $this->input->cookie($key) != NULL)
					{
						$this->input->set_cookie($key, '');
						echo $key . 'has removed.';
					} else if($val == 'default') {
						continue;
					} else if($val == null) {
						$this->input->set_cookie($key, '');
					} else {
						$this->input->set_cookie($key, $val, '31536000');
					}
				}
				redirect($this->input->post('redirect'));
			} else {
				$this->load->view('templates/header.php');
				$this->load->view('config.php');
				$this->load->view('templates/footer.php');
			}
		}
	}