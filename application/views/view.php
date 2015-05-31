<div id="document-view">
	<div class="document-header">
		<?php if($document['document']['author_emblem'] != null): ?>
			<img class="toe-emblem <?php echo $document['document']['author_usergroup']; ?>" src="/emblem/<?php echo substr($document['document']['author_emblem'], 0, strrpos($document['document']['author_emblem'], '_')) . '/' . substr($document['document']['author_emblem'], strrpos($document['document']['author_emblem'], '_') + 1); ?>" alt="" />
		<?php endif; ?>

		<?php if($document['document']['vote_count'] != 0): ?>
			<i class="vote-count"><?php echo $document['document']['vote_count']; ?></i>
		<?php endif; ?>
		<div class="wrap">
			<h1>
				<?php echo $document['document']['title']; ?>
			</h1>
		</div>
		<div class="wrap">
			<span class="author"><?php echo $document['document']['author']; ?></span>(<?php echo $document['document']['author_point']; ?>&nbsp;포인트)<br /><span class="date"><?php echo $document['document']['time']; ?></span>
		</div>
		<?php if($document['document']['link1'] != null) : ?>
		<div class="extra-var link">
			<div class="description">
				링크 1
			</div>
			<div class="wrap">
				<a href="<?php echo $document['document']['link1']; ?>"><?php echo $document['document']['link1']; ?></a>
			</div>
		</div>
		<?php endif; ?>
		<?php if($document['document']['link2'] != null) : ?>
		<div class="extra-var link">
			<div class="description">
				링크 2
			</div>
			<div class="wrap">
				<a href="<?php echo $document['document']['link2']; ?>"><?php echo $document['document']['link2']; ?></a>
			</div>
		</div>
		<?php endif; ?>
	</div>

	<div class="document-body">
		<div class="wrap">
			<?php foreach($document['attachment_list'] as $var): ?>
				<div class="img-wrap">
					<img src="/image/<?php echo $CurrentBoardID; ?>/<?php echo $var['id']; ?>/<?php echo $var['extension']; ?>" alt="" />
				</div>
			<?php endforeach; ?>
			<?php echo $document['content']; ?>
		</div>
	</div>
	<div class="core-contentmenu">
		<a href="<?php echo site_url('/lists/' . $CurrentBoardID); ?>" class="core-left"><i class="fa fa-list"></i>&nbsp;목록으로</a>
	</div>
	<div class="comment-list">
		<?php foreach($document['comment_list'] as $key => $val): ?>
		<div class="items">
			<i class="comment-number"><?php echo $key + 1; ?></i>
			<?php if($val['author_emblem'] != null): ?>
				<img class="toe-emblem <?php echo $val['author_usergroup']; ?>" src="/emblem/<?php echo substr($val['author_emblem'], 0, strrpos($val['author_emblem'], '_')) . '/' . substr($val['author_emblem'], strrpos($val['author_emblem'], '_') + 1); ?>" alt="" />
			<?php endif; ?>
			<div class="wrap">
				<h2><?php echo $val['author']; ?></h2>
				<span class="date"><?php echo $val['time']; ?></span>
			</div>
			<div class="wrap">
				<?php echo $val['content']; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<?php if($this->session->userdata('username') != null): ?>
	<div class="comment-write">
		<h1>댓글 작성하기</h1>
		<form method="POST" action="/submit/comment/<?php echo $CurrentBoardID; ?>/<?php echo $CurrentDocumentNo; ?>">
			<input type="hidden" name="success_return_url" value="<?php echo uri_string(); ?>" />
			<div class="wrap">
				<textarea name="comment-content" rows="3"></textarea>
			</div>
			<input type="submit" value="작성" />
		</form>
	</div>
	<?php endif; ?>
</div>