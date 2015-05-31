				</div>
			<?php if($this->input->cookie('general-menueffect') == 'disable') : ?>
			<div id="core-footer" class="effect-disabled">
				Powered by <a href="https://github.com/mAKEkr/toez2dj-net-mobile">toez2dj-net-mobile</a><br />
				Execute time : <?php echo $this->benchmark->elapsed_time();?>sec
			</div>
			<?php endif; ?>

			</div>
		</div>
	</body>
<?php
		if(isset($end_scripts))
			foreach($end_scripts as $var){
				echo "\t".'<script type="text/javascript" src="' . $var . '"></script>';
			}
	?>
</html>