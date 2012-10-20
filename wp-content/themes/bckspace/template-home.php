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
        <div class="main-content">
            <div class="nivo">
                <?php if( function_exists('bck_slider_build') ) : bck_slider_build(); endif; ?>
            </div>
            <div class="sub-section">
                
            </div>
        </div> <!-- end wrapper -->
<!-- END MAIN CONTENT -->

<?php //get_sidebar(); ?>

<?php get_footer(); ?>