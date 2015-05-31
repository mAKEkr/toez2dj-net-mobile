<?php
	include_once('./application/views/templates/menu.php');
?>
<!doctype html>
<html lang="ko">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<!-- Stylesheets -->
		<link rel="Stylesheet" type="text/css" href="/static/css/bootstrap.custom.css" />
		<link rel="Stylesheet" type="text/css" href="/static/css/font-awesome.min.css" />
		<link rel="Stylesheet" type="text/css" href="/static/css/core.css?20140624183801" />
		<?php if($this->input->cookie('general-cdnfont') != 'disable') : ?>
		<link rel="Stylesheet" type="text/css" href="/static/css/font.css?20131204164501" />
		<?php endif; ?>
		<?php if($this->input->cookie('general-blackmod') == 'disable') : ?>
		<link rel="Stylesheet" type="text/css" href="/static/css/black.css" />
		<?php endif; ?>
		<!-- Javascript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script src="/static/js/jquery.cookie.js"></script>
		<script src="/static/js/core.js"></script>
		<title>toez2dj-net-mobile</title>
	</head>
	<body>
		<div id="core-container">
			<div class="core-sidebar">
				<ul class="core-menu">
					<li class="myinfo">
						<?php if($this->session->userdata('username') != null): ?>
						<a href="#"><img class="toe-emblem <?php echo $this->session->userdata('usergroup'); ?>" src="<?php echo ($this->session->userdata('useremblem') != NULL) ? '/emblem/' . $this->session->userdata('useremblem') : 'http://placehold.it/120x120'; ?>" alt="" /><strong><?php echo $this->session->userdata('username'); ?></strong></a>
						<?php else: ?>
						<a href="<?php echo site_url('/login/?return_url=' . urlencode(uri_string())); ?>">로그인 해주세요.</a>
						<?php endif; ?>
					</li>
					<?php foreach($menu_list as $var): $active = null; ?>
					<?php if($var['boardid'] == $CurrentBoardID) $active = 'on'; ?>
					<li class="depth-<?php echo $var['depth']; ?><?php if($active == 'on') echo ' active'; ?>">
					<?php if($var['extend'] == 'link'): ?>
						<a href="/<?php echo $var['extra_vars']; ?>"><?php echo $var['name']; ?></a>
					<?php elseif($var['extend'] == 'board'): ?>
						<a href="/<?php echo $var['controller'] . '/' . $var['boardid']; ?>"><?php echo $var['name']; ?></a>
					<?php else: ?>
						<a href="/<?php echo $var['controller'] . '/' . $var['boardid']; ?>"><?php echo $var['name']; ?></a>
					<?php endif; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php if($this->input->cookie('general-menueffect') != 'disable') : ?>
				<div id="core-footer">
					Powered by <a href="https://github.com/mAKEkr/toez2dj-net-mobile">toez2dj-net-mobile</a><br />
					Execute time : <?php echo $this->benchmark->elapsed_time();?>sec
				</div>
				<?php endif; ?>
			</div>
			<div class="core-content <?php echo $CurrentController; ?>">
				<!--
				<div id="notice" style="background-color:#ff2603;text-align:center;">
					<a href="http://ake.kr/blog/1724" style="word-break:break-all;font-size:14px;font-weight:bold;color:#fff;padding:8px;display:inline-block;">테오이의 공용IP 차단 관련 공지에 대한 테오이 모바일의 입장입니다.</a>
				</div>
				-->
				<div id="core-header" style="position:relative;">
					<a id="sidebar_toggle" class="left" href="#">
						<span class="bar"></span>
						<span class="bar"></span>
						<span class="bar"></span>
					</a>
					<div class="wrap">
						<h1><a href="<?php echo ($CurrentController != 'recent') ? '/lists/' . $CurrentBoardID : '/recent/' . $CurrentBoardID; ?>"><?php echo $menu_list[$CurrentBoardID]['name'] != NULL ? $menu_list[$CurrentBoardID]['name'] : '메인'; ?></a></h1>
					</div>
					<a id="submenu_toggle" class="right" href="#">
						<img src="/static/img/arrow.svg" alt="보조메뉴 열기" />
					</a>
				</div>
				<div id="submenu">
					<div class="items">
						<?php if( ! $this->session->userdata('username')): ?>
						<a href="<?php echo site_url('/login/?return_url=' . urlencode(uri_string())); ?>">
							<i class="ss-icon ss-login"></i>
							<span class="description">로그인</span>
						</a>
						<?php else: ?>
						<a href="<?php echo site_url('/logout/?return_url=' . urlencode(uri_string())); ?>">
							<i class="ss-icon ss-logout"></i>
							<span class="description">로그아웃</span>
						</a>
						<?php endif; ?>
					</div>
					<div class="items">
						<a href="<?php echo site_url('/config/?return_url=' . urlencode(uri_string())); ?>">
							<i class="fa fa-cog"></i>
							<span class="description">설정</span>
						</a>
					</div>
					<div class="items">
						<a href="#">
							<i class="ss-icon ss-share"></i>
							<span class="description">공유하기</span>
						</a>
					</div>
					<div class="items">
						<a href="/pc_mode/?redirect=<?php echo makeurl_fromuri($this->uri->ruri_string(), $this->input->get()); ?>">
							<i class="ss-icon ss-desktop"></i>
							<span class="description">PC버젼</span>
						</a>
					</div>
				</div>
				<div id="core-article">