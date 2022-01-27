<?php
if( post_password_required() ){
	return;
}

$comments_open = comments_open();
$comment_count = get_comments_number();
?>

<div id="comments" class="comments-area">

	<header class="heading-wrapper comments-title">
		<h2 class="heading-title">
			<?php
			esc_html_e('Comments', 'miti');
			if( !$comments_open ):
				echo ' (' . esc_html($comment_count) . ')';
			endif;
			?>
		</h2>
		
		<?php if( $comments_open ): ?>
		<div class="add-comment">
			<span class="comments-count"><?php echo sprintf( _n('%d Comment', '%d Comments', $comment_count, 'miti'), $comment_count ); ?></span>
			<a href="#" class="ts-add-comment-button"><?php esc_html_e('Write a comment', 'miti'); ?></a>
		</div>
		<?php endif; ?>
	</header>

	<?php if ( have_comments() ) : ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'miti_list_comments', 'style' => 'ol' ) ); ?>
		</ol>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'miti' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'miti' ) ); ?></div>
		</nav>
		<?php endif; ?>

		<?php
		if ( ! $comments_open && get_comments_number() ) : ?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed.' , 'miti' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>
	
	<?php miti_comment_form(); ?>

</div>