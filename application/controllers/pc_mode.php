<?php
	class Pc_mode extends CI_Controller {
		function __construct(){
			parent::__construct();
		}

		function index(){
			echo $this->input->get('redirect');
			$explode_url = explode('/', $this->input->get('redirect'));
			$get_list = substr($this->input->get('redirect'), strpos($this->input->get('redirect'), '?') + 1);

			var_dump($get_list);
			switch($explode_url['1']){
				case 'main':
					redirect('http://toez2dj.net/');
					break;

				case 'board':
					if($explode_url['2'] == 'lists'){
						redirect('http://toez2dj.net/zeroboard/zboard.php?id=' . $explode_url['3'] . '&page=' . $explode_url['4'] . '&select_arrange=headnum&desc=asc');
					} else if($explode_url['2'] == 'view'){
						$page_num = substr($get_list, strpos($get_list, 'page=') + 5);
						if(strpos($page_num, '&') !== false) {
							$page_num = substr($page_num, 0, strpos($page_num, '&'));
						}
						redirect('http://toez2dj.net/zeroboard/zboard.php?id=' . $explode_url['3'] . '&no=' . $explode_url['4'] . '&page=' . $page_num);
					}
					break;

				case 'submit':
					if($explode_url['2'] == 'article'){
						redirect('http://toez2dj.net/zeroboard/write.php?id=' . $explode_url['3'] . '&page=1&mode=write');
					}
					break;

				default:
					redirect(site_url('/'));
					break;
			}

			exit();
		}
	}