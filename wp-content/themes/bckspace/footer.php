
        <div class="footer-wrap">
            
        </div> <!-- end footer wrap -->
        
        <?php if( function_exists('bck_slider') ) : bck_slider(); endif; ?>

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/includes/slider/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        $('#slider').nivoSlider({
            effect: '<?php if(get_option('bck_slider_effect')) : echo get_option('bck_slider_effect'); endif; ?>',
            pauseTime: <?php if(get_option('pause_time')) : echo get_option('pause_time'); endif; ?>,
            directionNav: <?php if(get_option('direction_nav') == true ) : echo 'true'; else : echo 'false'; endif; ?>, // Next & Prev navigation
            controlNav: <?php if(get_option('control_nav') == true ) : echo 'true'; else : echo 'false'; endif; ?>,
            prevText: '', // Prev directionNav text
            nextText: '' // Next directionNav text
        });

    
    </script>
    
        
<?php wp_footer(); ?>

</body>
</html>