<?php
	class Board Extends CI_Controller {
		function index(){

		}

		function lists($boardID, $pagenum = 1){
			$this->load->helper('url');
			$this->load->model(array('parsemodel', 'boardmodel'));
			$this->load->library('pagination');
			$this->load->config('toez2dj', false, true);

			$_VIEW = Array(
				'CurrentController' => 'lists',
				'CurrentBoardID' => $boardID,
				'CurrentPageNum' => $pagenum
			);

			$boardtype = (array_key_exists($boardID, $boardtype_list = $this->config->item('special_board_list')) !== false) ? $boardtype_list[$boardID] : 'board';
			$_MODEL['list'] = $this->boardmodel->getList($boardID, $pagenum, $boardtype);


			$pgn = Array(
				'first_url' => 'http://toe.rhythmga.me/lists/' . $boardID . '/' . $suffix,
				'base_url' => 'http://toe.rhythmga.me/lists/' . $boardID . '/',
				'uri_segment' => 3,
				'num_links' => 2,
				'cur_page' => 1,
				'suffix' => $suffix,
				'total_rows' => $_MODEL['list']['lastpage'],
			);

			$this->pagination->initialize($pgn);
			$_MODEL['pagination'] = $this->pagination->create_links();

			$this->load->view('templates/header.php', $_VIEW);

			if(!is_array($_MODEL['list'])){
				$this->load->view('errors/' . $_MODEL['list']);
			} else {
				$this->load->view('list.php', $_MODEL);
			}

			$this->load->view('templates/footer.php');
		}

		function view($boardID, $documentNo){
			$this->load->helper(array('url', 'HTMLPurifier'));
			$this->load->model(array('parsemodel', 'boardmodel'));
			$this->load->config('toez2dj', false, true);

			$_VIEW = Array(
				'CurrentController' => 'view',
				'CurrentBoardID' => $boardID,
				'CurrentDocumentNo' => $documentNo
			);

			$_MODEL['document'] = $this->boardmodel->getDocument($boardID, $documentNo);
			$_MODEL['document']['content'] = html_purify($_MODEL['document']['content'], 'document');

			$boardtype = (array_key_exists($boardID, $boardtype_list = $this->config->item('special_board_list')) !== false) ? $boardtype_list[$boardID] : 'board';
			$this->load->view('templates/header.php', $_VIEW);
			$this->load->view('view.php', $_MODEL);
			$this->load->view('templates/footer.php');
		}

		function write(){
			
		}

		function recent($MenuID) {

		}
	}