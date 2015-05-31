<?php
	class Main extends CI_Controller {
		function index(){
			$this->load->view('templates/header.php');
			$this->load->view('main.php');
			$this->load->view('templates/footer.php');
		}

		function test(){
			echo makeurl_fromuri($this->uri->ruri_string(), $this->input->get());
		}
	}