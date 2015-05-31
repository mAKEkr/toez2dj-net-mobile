<div id="core-config">
	<h1>설정</h1>

	<h2>일반</h2>
	<form action="/config" method="post">
		<input type="hidden" name="redirect" value="<?php echo site_url(urldecode($_GET['return_url'])); ?>" />

		<h3>블랙모드 설정(개발중)</h3>
		<p>블랙모드는 어두운 야간, 혹은 디스플레이의 전기 사용 감소효과를 위하여 사용합니다. 본문을 읽기 힘들 수 있습니다.</p>
		<div class="item">
			<input type="radio" name="general-blackmod" value="default" <?php if($this->input->cookie('general-blackmod') == null) echo 'checked="checked" '; ?>id="blackmod-1" />
			<label for="blackmod-1">사용 안함(기본)</label>
			<input type="radio" name="general-blackmod" value="enable" <?php if($this->input->cookie('general-blackmod') == 'enable') echo 'checked="checked" '; ?>id="blackmod-2" />
			<label for="blackmod-2">사용</label>
		</div>

		<h3>나눔고딕 해제</h3>
		<p>사이트에 적용된 나눔고딕 서체의 사용을 해제합니다. 인터넷 사용량 절감 및 페이지 로딩시간 감소의 효과를 불러올 수 있습니다.</p>
		<div class="item">
			<input type="radio" name="general-cdnfont" value="default" <?php if($this->input->cookie('general-cdnfont') == null) echo 'checked="checked" '; ?>id="cdnfont-1" />
			<label for="cdnfont-1">나눔고딕 사용(기본)</label>
			<input type="radio" name="general-cdnfont" value="disable" <?php if($this->input->cookie('general-cdnfont') == 'disable') echo 'checked="checked" '; ?>id="cdnfont-2" />
			<label for="cdnfont-2">나눔고딕 사용안함</label>
		</div>

		<h3>메뉴 효과 및 스타일 간소화</h3>
		<p>푸터의 위치를 변경하여 메뉴에 들어가있는 기능들을 최대한 끕니다. 메뉴가 보이지않을경우에 사용할경우 효과가 있을듯 합니다?</p>
		<div class="item">
			<input type="radio" name="general-menueffect" value="default" <?php if($this->input->cookie('general-menueffect') == null) echo 'checked="checked" '; ?>id="menueffect-1" />
			<label for="menueffect-1">스타일 간소화 사용안함(기본)</label>
			<input type="radio" name="general-menueffect" value="disable" <?php if($this->input->cookie('general-menueffect') == 'disable') echo 'checked="checked" '; ?>id="menueffect-2" />
			<label for="menueffect-2">스타일 간소화 사용함</label>
		</div>

		<input class="btn btn-info" type="submit" value="적용하기" />
	</form>

	<h2>서명 설정</h2>
	<form action="/config" method="post">
		<input type="hidden" name="redirect" value="<?php echo site_url(urldecode($_GET['return_url'])); ?>" />

		<h3>서명 사용 설정</h3>
		<p>모바일로 작성되었다는 서명을 사용할것인지 설정합니다.</p>
		<div class="item">
			<input type="radio" name="general-sign_disable" value="default" <?php if($this->input->cookie('general-sign_disable') == null) echo 'checked="checked" '; ?>id="general-sign_disable-1" />
			<label for="general-sign_disable-1">사용(기본)</label>
			<input type="radio" name="general-sign_disable" value="disable" <?php if($this->input->cookie('general-sign_disable') == 'disable') echo 'checked="checked" '; ?>id="general-sign_disable-2" />
			<label for="general-sign_disable-2">사용 안함</label>
		</div>

		<h3>게시물 작성시 서명 문구 설정</h3>
		<p>게시물 맨 뒤에 들어갈 서명 문구를 설정합니다. 빈칸으로 채워둘 경우, 기본서명이 사용됩니다.</p>
		<div class="item">
			<textarea name="document-sign" rows="3"><?php echo $this->input->cookie('document-sign'); ?></textarea>
		</div>

		<h3>댓글 작성시 서명 문구 설정</h3>
		<p>댓글 맨 뒤에 들어갈 서명 문구를 설정합니다. 빈칸으로 채워둘 경우, 기본서명이 사용됩니다.</p>
		<div class="item">
			<textarea name="comment-sign" rows="3"><?php echo $this->input->cookie('comment-sign'); ?></textarea>
		</div>

		<input class="btn btn-info" type="submit" value="적용하기" />
	</form>
</div>