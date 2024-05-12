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
	<?php
	wp_list_comments();
	if(!comments_open()){
		_e("Comments are closed", "alpha2");
	}
	comment_form();
	?>
</div>