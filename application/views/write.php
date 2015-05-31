<div id="document-write">
	<h1>글 작성하기</h1>
	<form method="POST" action="/submit/article/<?php echo $CurrentBoardID; ?>" enctype="multipart/form-data">
		<div class="group">
			<label for="inputDocumentTitle">제목</label>
			<div class="wrap">
				<input type="text" id="inputDocumentTitle" name="document-title" />
			</div>
		</div>
		<div class="group">
			<label for="documentContent">내용</label>
			<div class="wrap">
				<textarea id="documentContent" name="document-content" rows="12"></textarea>
			</div>
		</div>
		<div class="group">
			<label for="documentAttachment1">첨부파일 #1</label>
			<div class="wrap">
				<input type="file" id="documentAttachment1" name="document-file[]" />
			</div>
		</div>
		<div class="group">
			<label for="documentAttachment2">첨부파일 #2</label>
			<div class="wrap">
				<input type="file" id="documentAttachment2" name="document-file[]" />
			</div>
		</div>
		<div class="core-contentmenu">
			<a href="<?php echo site_url('/lists/' . $CurrentBoardID); ?>" class="core-left"><i class="fa fa-list"></i>&nbsp;목록으로</a>
			<a href="javascript:$('form').submit();" class="core-right"><i class="fa fa-pencil"></i>&nbsp;작성하기</a>
		</div>
	</form>
</div>