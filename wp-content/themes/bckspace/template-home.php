<?php
/**
 * Template Name: Home Page Template
 * Description: A Page Template for the home page
 *
 *
 * @package bckspace
 * @subpackage bckspace
 * @since bckspace 1.0
 */

get_header(); ?>
    <div class="wrapper">
        <hr>
        <div class="main-content">
            <div class="nivo">
                <?php if( function_exists('bck_slider_build') ) : bck_slider_build(); endif; ?>
            </div>
            
            <hr>
            
            <div class="sub-section">
                <?php 
                global $post;
                $args = array(
                    'showposts' => 3, 
                    'post_type' => 'page',
                    'post__in' => array(18, 20, 90)
                );
                $query = new WP_Query($args); 
                while($query->have_posts() ) : $query->the_post();
                    echo '<div class="cta-home">';
                    echo '<h2 class="entry-title">';
                    the_title();
                    echo '</h2>';
                    echo '<a href="';
                    the_permalink();
                    echo '">';
                    the_post_thumbnail('cta-home');
                    echo "</a>";
                    the_excerpt();
                    
                    if($post->ID == 90 ) {
                        echo do_shortcode('[contact-form-7 id="785" title="Email Signup"]');
                        echo '<div class="social">';
                        echo '<a href="' . get_option('facebook_account') . '"><img src="'.get_template_directory_uri().'/images/VegasCoffeeBean.jpeg" border="0"/></a>';
                        echo '<a href="' . get_option('twitter_account') . '"><img src="'.get_template_directory_uri().'/images/vegascoffeebean-1.jpeg" border="0"/></a>';
                        echo '</div>';
                    }
                    echo '</div>';
                endwhile;
                ?>
            </div>
        </div> <!-- end wrapper -->
<!-- END MAIN CONTENT -->

<?php //get_sidebar(); ?>

<?php get_footer(); ?>