<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'group', 'post-standard' , 'grid-item') ); ?>>
	<div class="post-inner post-hover">

		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php hu_the_post_thumbnail('thumb-standard'); ?>
				<?php if ( has_post_format('video') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-play"></i></span>'; ?>
				<?php if ( has_post_format('audio') && !is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-volume-up"></i></span>'; ?>
				<?php if ( is_sticky() ) echo'<span class="thumb-icon"><i class="fa fa-star"></i></span>'; ?>
			</a>
			<?php if ( comments_open() && ( hu_is_checked( 'comment-count' ) ) ): ?>
				<a class="post-comments" href="<?php comments_link(); ?>"><span><i class="fa fa-comments-o"></i><?php comments_number( '0', '1', '%' ); ?></span></a>
			<?php endif; ?>
		</div><!--/.post-thumbnail-->

		<div class="post-content">

			<h2 class="post-title entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2><!--/.post-title-->

			<div class="post-meta group">
				<!-- <p class="post-category"><?php the_category(' / '); ?></p> -->
				<?php get_template_part('parts/post-list-author-date'); ?>
			</div><!--/.post-meta-->

			<?php if (hu_get_option('excerpt-length') != '0'): ?>
			<div class="entry excerpt entry-summary">
				<?php the_excerpt(); ?>
			</div><!--/.entry-->
			<?php endif; ?>

		</div><!--/.post-content-->

	</div><!--/.post-inner-->
</article><!--/.post-->
