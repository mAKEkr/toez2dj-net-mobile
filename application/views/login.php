<div id="member-login">
	<form method="POST" action="/login/" role="form">
		<input type="hidden" name="success_return_url" value="<?php echo $return_url; ?>" />
		<h1>로그인</h1>
		<div class="wrap">
			<input type="text" class="form-control" name="user_id" placeholder="아이디" />
		</div>
		<div class="wrap">
			<input type="password" class="form-control" name="user_pw" placeholder="비밀번호" />
		</div>
		<input type="submit" value="로그인" />
	</form>
</div>