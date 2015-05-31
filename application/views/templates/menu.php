<?php
	$menu_list = array(
		'home' => array(
			'name' => '메인',
			'controller' => '',
			'boardid' => '',
			'extend' => 'link',
			'extra_vars' => '',
			'parent' => '',
			'depth' => '1'
		),
		'h_notice' => array(
			'name' => '공지사항',
			'controller' => 'lists',
			'boardid' => 'h_notice',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'home',
			'depth' => '2'
		),
		'h_event' => array(
			'name' => '이벤트',
			'controller' => 'lists',
			'boardid' => 'h_event',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'home',
			'depth' => '2'
		),
		'h_mt' => array(
			'name' => '모임일정',
			'controller' => 'lists',
			'boardid' => 'h_mt',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'home',
			'depth' => '2'
		),
		'h_news' => array(
			'name' => '뉴스와정보',
			'controller' => 'lists',
			'boardid' => 'h_news',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'home',
			'depth' => '2'
		),
		'h_opinion' => array(
			'name' => '운영참여란',
			'controller' => 'lists',
			'boardid' => 'h_opinion',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'home',
			'depth' => '2'
		),
		'community' => array(
			'name' => '커뮤니티',
			'controller' => '',
			'boardid' => '',
			'extend' => 'link',
			'extra_vars' => '#',
			'parent' => '',
			'depth' => '1'
		),
		'c_ez2dj2' => array(
			'name' => '자유게시판',
			'controller' => 'lists',
			'boardid' => 'c_ez2dj2',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'community',
			'depth' => '2'
		),
		'c_qna' => array(
			'name' => '질문과답변',
			'controller' => 'lists',
			'boardid' => 'c_qna',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'community',
			'depth' => '2'
		),
		'c_market' => array(
			'name' => '물품거래소',
			'controller' => 'lists',
			'boardid' => 'c_market',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'community',
			'depth' => '2'
		),
		'c_result' => array(
			'name' => '플레이성과',
			'controller' => 'lists',
			'boardid' => 'c_result',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'community',
			'depth' => '2'
		),
		'entertainment' => array(
			'name' => '엔터테인먼트',
			'controller' => 'recent',
			'boardid' => 'entertainment',
			'extend' => '',
			'extra_vars' => '',
			'parent' => '',
			'depth' => '1'
		),
		'e_freegallery' => array(
			'name' => '자유갤러리',
			'controller' => 'lists',
			'boardid' => 'e_freegallery',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'entertainment',
			'depth' => '2'
		),
		'e_mtgallery' => array(
			'name' => '모임갤러리',
			'controller' => 'lists',
			'boardid' => 'e_mtgallery',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'entertainment',
			'depth' => '2'
		),
		'e_mtafter' => array(
			'name' => '모임후기',
			'controller' => 'lists',
			'boardid' => 'e_mtafter',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'entertainment',
			'depth' => '2'
		),
		'e_vote' => array(
			'name' => '설문조사',
			'controller' => 'lists',
			'boardid' => 'e_vote',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'entertainment',
			'depth' => '2'
		),
		'e_humor' => array(
			'name' => '재미있는글',
			'controller' => 'lists',
			'boardid' => 'e_humor',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'entertainment',
			'depth' => '2'
		),
		'database' => array(
			'name' => '데이터베이스',
			'controller' => 'recent',
			'boardid' => 'database',
			'extend' => '',
			'extra_vars' => '',
			'parent' => '',
			'depth' => '1'
		),
		'd_clearguide' => array(
			'name' => '리듬게임공략',
			'controller' => 'lists',
			'boardid' => 'd_clearguide',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'database',
			'depth' => '2'
		),
		'd_review' => array(
			'name' => '리듬게임리뷰',
			'controller' => 'lists',
			'boardid' => 'd_review',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'database',
			'depth' => '2'
		),
		'd_hcommand' => array(
			'name' => '히든커맨드정보',
			'controller' => 'lists',
			'boardid' => 'd_hcommand',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'database',
			'depth' => '2'
		),
		'd_centerinfo' => array(
			'name' => '게임센터정보',
			'controller' => 'lists',
			'boardid' => 'd_centerinfo',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'database',
			'depth' => '2'
		),
		'd_pds' => array(
			'name' => '리듬게임자료',
			'controller' => 'lists',
			'boardid' => 'd_pds',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'database',
			'depth' => '2'
		),
		'd_playmovie' => array(
			'name' => '플레이동영상',
			'controller' => 'lists',
			'boardid' => 'd_playmovie',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'database',
			'depth' => '2'
		),
		'd_otherpds' => array(
			'name' => '기타자료',
			'controller' => 'lists',
			'boardid' => 'd_otherpds',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'database',
			'depth' => '2'
		),
		'forum' => array(
			'name' => '포럼',
			'controller' => 'recent',
			'boardid' => 'forum',
			'extend' => '',
			'extra_vars' => '',
			'parent' => '',
			'depth' => '1'
		),
		'f_multikey' => array(
			'name' => '다 키 포럼',
			'controller' => 'lists',
			'boardid' => 'f_multikey',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_djtab' => array(
			'name' => '디탭광장',
			'controller' => 'lists',
			'boardid' => 'f_djtab',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_majak' => array(
			'name' => '마작',
			'controller' => 'lists',
			'boardid' => 'f_majak',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_mila' => array(
			'name' => '밀리언아서',
			'controller' => 'lists',
			'boardid' => 'f_mila',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		/*
		'f_ez2on' => array(
			'name' => '이지투온',
			'controller' => 'lists',
			'boardid' => 'f_ez2on',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),*/
		'f_starbattle' => array(
			'name' => '블리자드',
			'controller' => 'lists',
			'boardid' => 'f_starbattle',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_swo' => array(
			'name' => 'Steam /w Origin',
			'controller' => 'lists',
			'boardid' => 'f_swo',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_anime' => array(
			'name' => 'ANIME',
			'controller' => 'lists',
			'boardid' => 'f_anime',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_bemania' => array(
			'name' => 'BEMANIA',
			'controller' => 'lists',
			'boardid' => 'f_bemania',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_bc' => array(
			'name' => 'Beatcraft Cyclon',
			'controller' => 'lists',
			'boardid' => 'f_bc',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_bms' => array(
			'name' => 'BMS',
			'controller' => 'lists',
			'boardid' => 'f_bms',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_cat' => array(
			'name' => 'CAT',
			'controller' => 'lists',
			'boardid' => 'f_cat',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_cg' => array(
			'name' => 'C.G',
			'controller' => 'lists',
			'boardid' => 'f_cg',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_itb' => array(
			'name' => 'IT balance',
			'controller' => 'lists',
			'boardid' => 'f_itb',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_lol' => array(
			'name' => 'LOL',
			'controller' => 'lists',
			'boardid' => 'f_lol',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_pet' => array(
			'name' => 'Lovely pet',
			'controller' => 'lists',
			'boardid' => 'f_pet',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_mabinogi' => array(
			'name' => 'Mabinogi',
			'controller' => 'lists',
			'boardid' => 'f_mabinogi',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_MCC' => array(
			'name' => 'MCC',
			'controller' => 'lists',
			'boardid' => 'f_mcc',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_pumpitup' => array(
			'name' => 'Pump it up',
			'controller' => 'lists',
			'boardid' => 'f_pumpitup',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_tam' => array(
			'name' => 'TAM',
			'controller' => 'lists',
			'boardid' => 'f_tam',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_touhou' => array(
			'name' => 'Touhou Agora',
			'controller' => 'lists',
			'boardid' => 'f_touhou',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
		'f_tndf' => array(
			'name' => 'TNDF',
			'controller' => 'lists',
			'boardid' => 'f_tndf',
			'extend' => 'board',
			'extra_vars' => '',
			'parent' => 'forum',
			'depth' => '2'
		),
	);