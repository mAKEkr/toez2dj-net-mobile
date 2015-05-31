<div class="article-list">
	<?php foreach($list['notice_list'] as $key => $val):?>
	<div class="items notice<?php echo $val['is_new'] == true ? ' new' : ''; ?>">
		<a href="<?php echo site_url('/view/' . $val['id'] . '/' . $key . '/?page=' . $CurrentPageNum); ?>">
			<i class="comment-count"><?php echo $val['comment_count']; ?></i>
			<?php if($val['vote'] != 0): ?>
			<i class="vote-count"><?php echo $val['vote']; ?></i>
			<?php endif; ?>
			<?php if($val['thumbnail1'] != null): ?>
				<img class="thumbnails" src="/thumbnail/<?php echo $CurrentBoardID; ?>/<?php echo $val['thumbnail1']; ?>" alt="" />
			<?php endif; ?>
			<div class="wrap">
				<h1><?php echo $val['title']; ?></h1>
			</div>
			<div class="wrap">
				<span class="author"><?php echo $val['author']; ?></span> / <span class="date"><?php echo $val['date']; ?></span>
			</div>
		</a>
	</div>
	<?php endforeach; ?>

	<?php foreach($list['article_list'] as $key => $val):?>
	<div class="items<?php echo $val['is_new'] == true ? ' new' : ''; ?>">
		<a href="<?php echo site_url('/view/' . $val['id'] . '/' . $key . '/?page=' . $CurrentPageNum); ?>">
			<?php if($val['comment_count'] != 0): ?>
			<i class="comment-count"><?php echo $val['comment_count']; ?></i>
			<?php endif; ?>
			<?php if($val['vote'] != 0): ?>
			<i class="vote-count"><?php echo $val['vote']; ?></i>
			<?php endif; ?>
			<?php if($val['thumbnail1'] != null): ?>
				<img class="thumbnails" src="/thumbnail/<?php echo $CurrentBoardID; ?>/<?php echo $val['thumbnail1']; ?>" alt="" />
			<?php endif; ?>

			<div class="wrap">
				<h1>
					<?php if($val['is_secret'] == 1): ?>
						<i class="fa fa-lock"></i>
					<?php endif; ?>
					<?php echo $val['title']; ?>
				</h1>
			</div>
			<div class="wrap">
				<span class="author"><?php echo $val['author']; ?></span> / <span class="date"><?php echo $val['date']; ?></span>
			</div>
		</a>
	</div>
	<?php endforeach; ?>
</div>
<div class="core-contentmenu">
	
	<?php if( $this->session->userdata('username') ): ?>
	<a href="<?php echo site_url('/write/' . $CurrentBoardID . '?page=' . $CurrentPageNum); ?>" class="core-right"><i class="ss-icon ss-write"></i>&nbsp;게시글 쓰기</a>
	<?php endif; ?>
</div>
<div id="pagination">
	<?php echo $pagination; ?>
</div>