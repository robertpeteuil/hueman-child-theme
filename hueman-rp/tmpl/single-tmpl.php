<?php while ( have_posts() ): the_post(); ?>
  <article <?php post_class(); ?>>
    <div class="post-inner group">

      <?php hu_get_template_part('parts/single-heading'); ?>

      <?php if( get_post_format() ) { get_template_part('parts/post-formats'); } ?>

      <div class="clear"></div>

      <div class="<?php echo implode( ' ', apply_filters( 'hu_single_entry_class', array('entry','themeform') ) ) ?>">
        <div class="entry-inner">
          <?php the_content(); ?>
          <nav class="pagination group">
            <?php
              //Checks for and uses wp_pagenavi to display page navigation for multi-page posts.
              if ( function_exists('wp_pagenavi') )
                wp_pagenavi( array( 'type' => 'multipart' ) );
              else
                wp_link_pages(array('before'=>'<div class="post-pages">'.__('Pages:','hueman'),'after'=>'</div>'));
            ?>
          </nav><!--/.pagination-->

        </div>

        <?php do_action( 'hu_after_single_entry_inner' ); ?>

        <div class="clear"></div>
      </div><!--/.entry-->

    </div><!--/.post-inner-->
  </article><!--/.post-->
<?php endwhile; ?>

<div class="clear"></div>

<?php if ( ( hu_is_checked( 'author-bio' ) ) && get_the_author_meta( 'description' ) ): ?>
  <div class="author-bio">
    <?php $user_name = get_the_author_meta('display_name'); ?>
    <?php $user_twitter = get_the_author_meta('twitter'); ?>
    <?php $user_linkedin = get_the_author_meta('linkedin'); ?>
    <?php $user_gplus = get_the_author_meta('googleplus'); ?>

    <div class="bio-avatar"><?php echo get_avatar(get_the_author_meta('user_email'),'128'); ?></div>
    <!-- Link AuthorName to G+ profile (if meta exists) with rel="author" attribute -->
    <?php if ($user_gplus !== ''): ?>
      <p class="bio-name"><a target="_blank" href="<?php echo $user_gplus; ?>?rel=author"><?php echo $user_name; ?></a></p>
    <?php else: ?>
      <p class="bio-name"><?php the_author_meta('display_name'); ?></p>
    <?php endif ?>
    <p class="bio-desc"><?php the_author_meta('description'); ?></p>
    <div>
      <?php if ($user_twitter !== ''): ?>
        <span class="bio-twitter">Twitter <a target="_blank" href="https://twitter.com/<?php echo $user_twitter; ?>">&#64<?php echo $user_twitter; ?></a></span>
      <?php endif ?>
      <?php if ($user_linkedin !== ''): ?>
        <span class="bio-linkedin">LinkedIn <a target="_blank" href="<?php echo $user_linkedin; ?>" >Profile</a></span>
      <?php endif ?>
    </div>

    <div class="clear"></div>
  </div>
<?php endif; ?>

<!-- Display Jetpack Social Sharing Here  -->
<div class="share-heading">SHARE THIS <?php if ( function_exists( 'sharing_display' ) ) { sharing_display( '', true ); } ?></div>

<!-- Hide the display of tags  -->
<!-- <?php the_tags('<p class="post-tags"><span>'.__('Tags:','hueman').'</span> ','','</p>'); ?> -->

<?php if ( 'content' == hu_get_option( 'post-nav' ) ) { get_template_part('parts/post-nav'); } ?>

<?php if ( '1' != hu_get_option( 'related-posts' ) ) { get_template_part('parts/related-posts'); } ?>

<?php if ( hu_is_checked('post-comments') ) { comments_template('/comments.php',true); } ?>
