<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- start editing here. -->

<div id="post-comments">
	<?php if ( have_comments() ) { ?>
	<div id="comments">
		<ol class="commentlist">
			<?php wp_list_comments('type=comment&callback=sf_comments'); ?>
		</ol>
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav">
			<div class="nav-previous"><?php previous_comments_link( __( 'Older Comments' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments' ) ); ?></div>
		</nav>
		<?php endif; ?>
	</div>
	<?php }; ?>
	
	<?php if ( comments_open() ) : ?>
	<?php comment_form(
		array(
			'title_reply' => __( 'Use the Form Below to Leave a Comment' ),
			'fields' => array(
				'author' => '<div class="comment-form-author"><p>' . '<label for="author">' . __( 'Your Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" /></p>',
				'email' => '<p><label for="email">' . __( 'Your Email Address' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" /></p>',
				'url' => '<p><label for="url">' . __( 'Your Website' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p></div>',
			),
			'comment_field' => '<div class="comment-form-comment"><p><label for="comment">' . _x( 'Your Comments', 'noun' ) . '</label><textarea id="comment" name="comment" aria-required="true"></textarea></p></div>',
			'comment_notes_after' => '<p>' . sprintf( __( 'You may use these HTML tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'label_submit' => __( 'Post This Comment' ),
			'cancel_reply_link' => __( 'Cancel This Comment' ),
		)
	); ?>	
	<?php endif; ?>
</div>