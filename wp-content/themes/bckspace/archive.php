<?php get_header(); ?>
                
<div class="wrapper">
<div class="main-content">
                
                <div class="post-wrap">
		<?php if(have_posts()) : ?>
	
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h4 class="pagetitle">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h4>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h4 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h4>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h4 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h4>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h4 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h4>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h4 class="pagetitle">Archive for <?php the_time('Y'); ?></h4>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h4 class="pagetitle">Author Archive</h4>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h4 class="pagetitle">Blog Archives</h4>
		<?php } ?>
			
		<?php while(have_posts()) : the_post(); ?>

		<div class="post" id="<?php the_ID(); ?>">
                        <?php the_post_thumbnail('thumbnail', array('class' => 'alignleft')); ?>
                        <div class="post-wrapper">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="post-meta">
                                <?php bck_get_post_meta(); ?>
                            </div><!-- end post meta -->
                            <div class="entry">
                                    <?php //the_content(); ?>
                                    <?php the_excerpt(); ?>
                            </div> <!-- end entry -->
                        </div><!-- end post wrap -->
		
		</div> <!-- .post -->

		<?php endwhile; else : ?>

		<div class="post">
		
			<h2>Page Not Found</h2>
			
			<p>Looks like the page you're looking for isn't here anymore. Try browsing the <a href="">categories</a>, <a href="">archives</a>, or using the search box below.</p>
			
			<?php include(TEMPLATEPATH.'/searhform.php'); ?>
		
		</div> <!-- .post -->

		<?php endif; ?>
	
		<div class="navigation clear">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
                </div>



<?php get_sidebar(); ?>
                
</div> <!-- end main content -->
</div><!-- end wrapper -->

<?php get_footer(); ?>