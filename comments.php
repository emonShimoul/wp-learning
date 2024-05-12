<div class="comments">
	<h2 class="comments-title">
		<?php
		$alpha_cn = get_comments_number();
		if(1 == $alpha_cn){
			_e("1 Comments", "alpha2");
		} else{
			echo $alpha_cn." ".__("Comments", "alpha2");
		}
		?>
	</h2>
	<div class="comments-list">
		<?php
		wp_list_comments();
		?>
		<div class="comments-pagination">
			<!-- <p>Pagination:</p> -->
			<?php
			the_comments_pagination(array(
				'screen_reader_text'=>__('', 'alpha2'),
				'prev_text'=>'<'.__('Previous Comments', 'alpha2'),
				'next_text'=>'<'.__('Next Comments', 'alpha2'),
			));
			?>
		</div>
		<?php
		if(!comments_open()){
			_e("Comments are closed", "alpha2");
		}
		?>
	</div>
	
	<div class="comments-form">
		<?php
		comment_form();
		?>
	</div>
</div>