    <div class="sidebar">

<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

        <aside id="archives" class="widget">
            <h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>

            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>

        <aside id="meta" class="widget">
            <h3 class="widget-title"><?php _e( 'Meta', 'twentyeleven' ); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
        
<?php endif; // end sidebar widget area ?>
        <div class="sidebar-box">
            <h3 class="sidebar-title">Twitter</h3>
            <div class="text-widget">
                <div class="twitter">
                    <?php if(function_exists('bck_twitter_feed')) : bck_twitter_feed(); endif; ?>                 
                </div><!-- end twitter -->
            </div>
        </div>
        
        
            </div><!-- end side bar -->