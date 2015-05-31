<?php
	class Boardmodel extends CI_Model {
		function __construct(){
			parent::__construct();
		}

		function getList($boardID, $pagenum, $boardtype) {
			$this->load->helper('curl');
			$this->load->config('toez2dj', false, true);

			$url = $this->config->item('parse_url') . 'zeroboard/zboard.php?id=' . $boardID . '&page=' . $pagenum;

			$content = $this->parsemodel->parse($url, false);

			if($content !== false){
				$a1 = substr(substr($content,strpos($content,'<table width="100%" height="15" border="0" cellspacing="0" cellpadding="0">')),0,strpos(substr($content,strpos($content,'<table width="100%" height="15" border="0" cellspacing="0" cellpadding="0">')),'<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#FAFAFA">'));
				$notice = substr(substr($a1,strpos($a1,"<tr align=\"center\" bgcolor=\"#F2F2F2\"onmouseover=\"this.style.backgroundColor='#E2E2E2'\"\nonmouseout=\"this.style.backgroundColor='#F2F2F2'\">")),0,strpos(substr($a1,strpos($a1,"<tr align=\"center\" bgcolor=\"#F2F2F2\"onmouseover=\"this.style.backgroundColor='#E2E2E2'\"\nonmouseout=\"this.style.backgroundColor='#F2F2F2'\">")),'<tr align="center" bgcolor="#ffffff"'));
				$notice_list = explode('<b>notice</b>',$notice);
				$article = substr(substr($a1,strpos($a1,"<tr align=\"center\" bgcolor=\"#ffffff\" onmouseover=\"this.style.backgroundColor='#F2F2F2'\" onmouseout=\"this.style.backgroundColor='#ffffff'\">")),0,strpos(substr($a1,strpos($a1,"<tr align=\"center\" bgcolor=\"#ffffff\" onmouseover=\"this.style.backgroundColor='#F2F2F2'\" onmouseout=\"this.style.backgroundColor='#ffffff'\">")),'<!-- 마무리 부분입니다 -->'));
				$article_list = explode("<tr align=\"center\" bgcolor=\"#ffffff\" onmouseover=\"this.style.backgroundColor='#F2F2F2'\" onmouseout=\"this.style.backgroundColor='#ffffff'\">",$article);

				array_splice($article_list,0,1);
				array_splice($notice_list,0,1);

				switch($boardtype){
					case 'gallery':
						$notice_list = $this->parseList($notice_list, true);
						$article_list = $this->parseList($article_list, true);
					break;

					case 'notice':
						$notice_list = $this->parseGallery($notice_list);
						$article_list = $this->parseGallery($article_list);
					break;

					default:
						if($this->input->cookie('board-hide_notice') != 'enable') {
							$notice_list = $this->parseList($notice_list);
						}
						$article_list = $this->parseList($article_list);
					break;
				}

				$lastpage = substr(substr(substr(substr($content,0,strpos($content,'</tr></form>')),0,strrpos(substr($content,0,strpos($content,'</tr></form>')),'blur()')),0,strrpos(substr(substr($content,0,strpos($content,'</tr></form>')),0,strrpos(substr($content,0,strpos($content,'</tr></form>')),'blur()')),']')),strrpos(substr(substr(substr($content,0,strpos($content,'</tr></form>')),0,strrpos(substr($content,0,strpos($content,'</tr></form>')),'blur()')),0,strrpos(substr(substr($content,0,strpos($content,'</tr></form>')),0,strrpos(substr($content,0,strpos($content,'</tr></form>')),'blur()')),']')),'[')+1);

				$content_array = array(
					'notice_list' => $notice_list,
					'article_list' => $article_list,
					'lastpage' => $lastpage
				);

				return $content_array;
			} else {
				return $content['error'];
			}
		}

		function parseList($list, $is_gallery = false){
			if( ! is_array($list)){
				return false;
			} else {
				foreach($list as $key => $var){
					$var = trim($var);
					$no = substr($var, strpos($var, '&no=') + 4, strpos($var, '"  >') - strpos($var, '&no=') - 4);
					$document_list[$no]['id'] = trim(substr($var, strpos($var, '?id=') + 4, strpos($var, '&page=') - strpos($var, '?id=') - 4));
					$document_list[$no]['title'] = substr($var, strpos($var, '"  >', strpos($var, 'p><a href="z')) + 4, strpos($var, '</a>', strpos($var, 'p><a href="z')) - strpos($var, '"  >', strpos($var, 'p><a href="z')) - 4);
					$document_list[$no]['author'] = trim(substr($var, strpos($var, 'r;">') + 4, strpos($var, '</span>', strpos($var, 'r;">') + 4) - strpos($var, 'r;">') - 4));
					if($is_gallery !== false){
						$tmp = explode('"  ><img src="', $var);
						$document_list[$no]['thumbnail1'] = substr($tmp['1'], strpos($tmp['1'], 'toez2dj_')+8, strpos($tmp['1'], '.thumb') - strpos($tmp['1'], 'toez2dj_') - 8);
						$document_list[$no]['thumbnail2'] = substr($tmp['2'], strpos($tmp['2'], 'toez2dj_')+8, strpos($tmp['2'], '.thumb') - strpos($tmp['2'], 'toez2dj_') - 8);
					}
					$document_list[$no]['comment_count'] = trim(strpos($var, '<span class="thm7"></span>') !== false ? 0 : substr($var, strpos($var, 'thm7">') + 6 + 1, strpos($var, '</span><') - strpos($var, 'thm7">') - 6 - 1 - 1));
					$document_list[$no]['date'] = trim(substr(substr($var, strpos($var, '<span title=\'') + 13), strpos(substr($var, strpos($var, '<span title=\'') + 13), '\'>') + 2, 10));
					$tmp = explode('<td class="thm8" nowrap align="right"><img src="images/t.gif" width="2" height="2" border="0"><br>', $var);
					$document_list[$no]['read_count'] = trim(substr($tmp['1'], 0, strpos($tmp['1'], '</td>')));
					$document_list[$no]['vote'] = trim(substr($tmp['2'], 0, strpos($tmp['2'], '</td>')));
					$document_list[$no]['is_new'] = strpos($var, 'src=skin/board/new_head.gif') !== false ? 1 : 0;
					$document_list[$no]['is_secret'] = strpos($var, 'src=skin/board/secret_head.gif') !== false ? 1 : 0;
				}

				return $document_list;
			}
		}

		function getDocument($boardID, $documentNo, $secret = false, $suffix = false){
			$this->load->helper('curl');
			$this->load->config('toez2dj', false, true);

			$url = $this->config->item('parse_url') . 'zeroboard/zboard.php?id=' . $boardID . '&no=' . $documentNo . '&page=' . $pagenum;
			if($suffix !== false){
				$url .= '&' . $suffix;
			}

			$content = $this->parsemodel->parse($url, true);

			if($this->validationmodel->checkedIsError($content) !== false) {
				return false;
			} else {
				//$content = curl_advance($url, 0, null, 1, 0, false, 10);
				$a1 = substr(substr($content,strpos($content,'<table border="0" cellspacing="0" cellpadding="0" width="700" style="table-layout:fixed">')),0,strpos(substr($content,strpos($content,'<table border="0" cellspacing="0" cellpadding="0" width="700" style="table-layout:fixed">')),'<!-- '));
				$a2 = substr($content, strpos($content, '<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" style="table-layout:fixed">'), strpos($content, '<table border="0" cellspacing="0" cellpadding="0" width="700" style="table-layout:fixed">', strpos($content, '<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" style="table-layout:fixed">')) - strpos($content, '<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" style="table-layout:fixed">'));

				$explode_content = explode('<td width="30"></td>',$a1);
				array_splice($explode_content,0,1);

				//document_infomation
				$document['title'] = substr(substr($a2,strpos($a2,'<br><b>')+strlen('<br><b>')),0,strpos(substr($a2,strpos($a2,'<br><b>')+strlen('<br><b>')),'</b><br>'));
				$document['time'] = substr(substr($a2,strpos($a2,'<img src="images/t.gif" width="222" height="2" border="0"><br>')+62),0,strpos(substr($a2,strpos($a2,'<img src="images/t.gif" width="222" height="2" border="0"><br>')+62),'&nbsp;&nbsp;|'));
				$document['author'] = substr(substr($a2,strpos($a2,'style="cursor:pointer;">')+24),0,strpos(substr($a2,strpos($a2,'style="cursor:pointer;">')+24),'</span>'));
				$document['author_member_no'] = substr($a2, strpos($a2, '?member_no=') + 11, strpos($a2, '\'', strpos($a2, '?member_no=')) - strpos($a2, '?member_no=') - 11);
				$document['author_emblem'] = strpos($a2, 'icon/emblem/_no_emblem_40.gif') !== false ? '' : substr($a2, strpos($a2, '<img src=icon/emblem/') + 21, strpos($a2, '_40.thumb') - strpos($a2, '<img src=icon/emblem/') - 21);
				$document['author_point'] = substr($a2, strpos($a2, 'height="2" border="0"><br><b>') + 29, strpos($a2, '</b>', strpos($a2, 'height="2" border="0"><br><b>')) - strpos($a2, 'height="2" border="0"><br><b>') - 29);
				$document['author_ip'] = substr($a2, strpos($a2, '&nbsp;IP ') + 9, strpos($a2, '</td>', strpos($a2, '&nbsp;IP ')) - strpos($a2, '&nbsp;IP ') - 9);
				$document['author_usergroup'] = $this->checkUserGroup(substr($a2, strpos($a2, 'style="border:solid 1px ') + 25, strpos($a2, '"', strpos($a2, 'style="border:solid 1px ')) - strpos($a2, 'style="border:solid 1px ')));
				$document['read_count'] = substr($a2, strpos($a2, 'Read <b>') + 8, strpos($a2, '</b>', strpos($a2, 'Read <b>')) - strpos($a2, 'Read <b>') - 8);
				$document['vote_count'] = substr($a2, strpos($a2, '&nbsp;Vote <b>') + 14, strpos($a2, '</b>', strpos($a2, '&nbsp;Vote <b>')) - strpos($a2, '&nbsp;Vote <b>') - 14);

				$tmp = explode('<tr bgcolor="#ffffff" onmouseover="this.style.backgroundColor=\'#F3F3F3\'" onmouseout="this.style.backgroundColor=\'#ffffff\'">', $a2);
				$document['link1'] = strpos($tmp['1'], '<a href=') !== false ? substr($tmp['1'], strpos($tmp['1'], ' target=_blank>') + 15, strpos($tmp['1'], '</a>') - strpos($tmp['1'], ' target=_blank>') - 15) : '';
				$document['link2'] = strpos($tmp['2'], '<a href=') !== false ? substr($tmp['2'], strpos($tmp['2'], ' target=_blank>') + 15, strpos($tmp['2'], '</a>') - strpos($tmp['2'], ' target=_blank>') - 15) : '';

				//images
				preg_match_all('/<img[^>]+src=data\/["\']?([^>"\']+)["\']?[^>]*>/i',$explode_content[0],$matches);

				foreach($matches['1'] as $key => $val){
					$document_image_list[$key]['id'] = substr($val, strpos($val, 'toez2dj_') + 8, strpos($val, '.') - strpos($val, 'toez2dj_') - 8);
					$document_image_list[$key]['extension'] = substr($val, strpos($val, '.') + 1, strpos($val, ' border=0') - strpos($val, '.') - 1);
				}

				//document
				$document_content = substr(substr($explode_content[1],strpos($explode_content[1],'<td valign=top>')+strlen('<td valign=top>')),0,strpos(substr($explode_content[1],strpos($explode_content[1],'<td valign=top>')+strlen('<td valign=top>')),'<!--"<-->'));

				//iframe embed
				preg_match_all('/<embed[^>]+src=["\']?([^>"\']+)["\']?[^>]*?(flashvars=["\']?([^>"\']+)["\'])*>/i', $document_content, $matches, PREG_SET_ORDER);
				$iframe_list = array();

				foreach($matches as $var){
					$iframe_list_array = null;

					if(strpos($var['1'],'serviceapi.nmv.naver.com')){ //naver
						$iframe_list_array['embed_tag'] = $var['0'];
						$iframe_list_array['iframe'] = '<iframe width="560" height="315" src="http://serviceapi.nmv.naver.com/flash/convertIframeTag.nhn?'.substr($var['1'],strpos($var['1'],'NFPlayer.swf?')+13).'" frameborder="no" scrolling="no"></iframe>';
					} else if(strpos($var['1'],'videofarm.daum.net/controller/player/VodPlayer.swf')){ //daum
						$iframe_list_array['embed_tag'] = $var['0'];
						$iframe_list_array['iframe'] = '<iframe width="560" height="315" src="http://videofarm.daum.net/controller/video/viewer/Video.html?'.str_replace('playLoc','play_loc',$var['3']).'" frameborder="0" scrolling="no"></iframe>';
					} else if(strpos($var['1'],'www.youtube.com/v/')){ //youtube
						$iframe_list_array['embed_tag'] = $var['0'];
						$iframe_list_array['iframe'] = '<iframe width="560" height="315" src="http://www.youtube.com/embed/'.substr($var['1'],strpos($var['1'],'/v/')+3).'" frameborder="0" allowfullscreen></iframe>';
						$iframe_list_array['id'] = $var['1'];
					} else if(strpos($var['1'], 'www.youtube.com/embed/')){
						$iframe_list_array['embed_tag'] = $var['0'];
						$iframe_list_array['iframe'] = '<iframe width="560" height="315" src="http://www.youtube.com/embed/'.substr($var['1'],strpos($var['1'],'/embed/')+7).'" frameborder="0" allowfullscreen></iframe>';
						$iframe_list_array['id'] = $var['1'];
					} else if(strpos($var['1'], 'player.soundcloud.com/player.swf')){
						$iframe_list_array['embed_tag'] = $var['0'];
						$iframe_list_array['iframe'] = '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F' . substr(substr($var['0'], strpos($var['0'], '/tracks/') + 8), 0, strpos(substr($var['0'], strpos($var['0'], '/tracks/') + 8), '" type="application/x-shockwave-flash"') . '" type="application/x-shockwave-flash"') . '"></iframe>';
					}

					array_push($iframe_list, $iframe_list_array);
				}

				foreach($iframe_list as $var){ $document_content = str_replace($var['embed_tag'], $var['iframe'], $document_content); }

				//comments
				$comment_list = explode('<table border="0" cellspacing="0" cellpadding="0" width="100%" height="32" style="table-layout:fixed">',substr(substr($content,strpos($content,'<td bgcolor="#4D4D4D"></td>')),0,strpos(substr($content,strpos($content,'<td bgcolor="#4D4D4D"></td>')),'<table border="0" cellspacing="0" cellpadding="0" width="100%">')));
				array_splice($comment_list,0,1);

				$comment_array = array();

				foreach($comment_list as $var){
					$comment = null;
					$comment['author'] = substr(substr($var,strpos($var,'style=cursor:pointer>')+21),0,strpos(substr($var,strpos($var,'style=cursor:pointer>')+21),'</span>'));
					$comment['author_member_no'] = substr($var, strpos($var, '?member_no=') + 11, strpos($var, '\'', strpos($var, '?member_no=')) - strpos($var, '?member_no=') - 11);
					$comment['author_emblem'] = strpos($var, 'icon/emblem/_no_emblem_40.gif') !== false ? '' : substr($var, strpos($var, '<img src=icon/emblem/') + 21, strpos($var, '_40.thumb', strpos($var, '<img src=icon/emblem/')) - strpos($var, '<img src=icon/emblem/') - 21);
					$comment['author_usergroup'] = $this->checkUserGroup(substr($var, strpos($var, 'style="border:solid 1px #') + 25, strpos($var, '"', strpos($var, 'style="border:solid 1px #') + 25) - strpos($var, 'style="border:solid 1px #') - 25));
					$comment['time'] = substr(substr($var,strpos($var,'<font class="thm8" color="#99999">')+34),0,strpos(substr($var,strpos($var,'<font class="thm8" color="#99999">')+34),'</font>'));
					$comment['content'] = substr($var, strpos($var, 'border="0"><br>') + 15, strpos($var, '<br><img src="images/t.gif', strpos($var, 'border="0"><br>')) - strpos($var, 'border="0"><br>') - 15);

					array_push($comment_array, $comment);
				}

				$return_array = Array(
					'document' => $document,
					'attachment_list' => $document_image_list,
					'embed_list' => $iframe_list,
					'content' => $document_content,
					'comment_list' => $comment_array
				);

				return $return_array;
			}
		}

		function checkUserGroup($hex) {
			$hex = strtoupper($hex);
			switch($hex){
				case '999999':
					return 'default';
				break;

				case '000000':
					return 'member';
				break;

				case '33CC33':
					return 'member1';
				break;

				case 'FF9900':
					return 'forum-admin';
				break;

				case '00CCFF':
					return 'admin';
				break;

				case '9933FF':
					return 'master';
				break;
			}
		}
		
		function getEmbedTags($content) {

		}
	}