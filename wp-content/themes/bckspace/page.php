<?php get_header(); ?>

        <?php
            if ( checked( 1, get_option( 'show_breadcrumbs' ), false ) ) :
                if( function_exists( 'bck_breadcrumbs' ) ) : 
                    bck_breadcrumbs(); 
                endif;
            endif;
        ?>
        <div class="wrapper">
                <div class="main-content">

                    <div id="post-<?php the_ID() ?>" class="sub-content">
                        <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                        <?php endwhile; endif; ?>
                    </div><!-- end sub content -->
                    <?php get_sidebar(); ?>
                </div>
        </div><!-- end wrapper -->
<!-- END MAIN CONTENT ----------------------------------------------------->



<?php get_footer(); ?>