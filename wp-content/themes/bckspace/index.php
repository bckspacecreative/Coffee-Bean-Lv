<?php get_header(); ?>

<div class="wrapper">
<div class="main-content">
                
                <div class="post-wrap">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

		<div class="post" id="<?php the_ID(); ?>">
                        <div class="post-wrapper">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="post-meta">
                                <?php bck_get_post_meta(); ?> | <a href="<?php comments_link(); ?>"><?php comments_number('0 Comments','1 Comment','% Comments'); ?></a>
                            </div><!-- end post meta -->
                            <div class="entry">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('post-thumbnail', array('class' => 'alignleft')); ?>
                                </a>
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
			<div class="left"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="right"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
		
                </div><!-- end post wrap -->
		
<?php get_sidebar(); ?>
                
</div> <!-- end main content -->
</div><!-- end wrapper -->

<?php get_footer(); ?>