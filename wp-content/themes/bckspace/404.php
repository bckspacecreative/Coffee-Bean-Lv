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
                <div class="sub-content-wrap">                    
                    <div class="sub-content">
                        <h2> Page Not Found </h2>
                    </div><!-- end sub content -->
                </div>
            </div><!-- end main content -->
        </div><!-- end wrapper -->
<!--END MAIN CONTENT ---------------------------> 


<?php //get_sidebar(); ?>

<?php get_footer(); ?>