<?php
/**
 * Description of options
 *
 * @author jeffclark
 */

require_once( 'class.Options_Fields.php' );
require_once( 'class.Custom_Post_Types.php' );

class Options extends Options_Fields {

    public function __construct(){
        
        // create the options panel
        add_action('admin_menu', array( $this, 'jdev_create_menu' ));
        
        // adding needed javascripts 
        add_action( 'admin_menu', array($this, 'jdev_include_scripts' ));
  
    }
    
    
    
    /**
     * 
     * Include our scripts and styles
     */
    public function jdev_include_scripts() {
        
        if(is_admin()):
	wp_enqueue_style( 'bckspace-theme-options-styles', get_template_directory_uri() . '/includes/theme-options.css', false, '1.0' );
        wp_enqueue_script( 'bckspace-theme-options-image-upload', get_template_directory_uri() . '/includes/js/image.js' );
	//wp_enqueue_script( 'bckspace-theme-options', get_template_directory_uri() . '/includes/theme-options.js', array( 'jquery' ), '1.0' );
        wp_enqueue_script( 'bckspace-options-tab', get_template_directory_uri() . '/includes/js/jquery-1.7.2.min.js', '1.0' );
        wp_enqueue_script( 'bckspace-options-tab-custom', get_template_directory_uri() . '/includes/js/jquery-ui-1.8.21.custom.min.js', array( 'jquery' ), '1.0' );
        
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        endif;
    }


    
    /**
     * 
     * Create the Theme Options
     * Menu Item
     */
    public function jdev_create_menu() {

        add_menu_page(
                'Bckspace', 
                'Options', 
                'administrator', 
                'theme-options', 
                array( $this, 'bckspace_theme_options_content')
        );

        //call register settings function
        add_action( 'admin_init', array($this, 'register_mysettings' ));
       
    }    
    
    
    
    /**
     * 
     * Register the settings for the 
     * options page
     */
    public function register_mysettings() {

        // register general settings
        register_setting( 'jdev-settings-group', 'analytics');
        register_setting( 'jdev-settings-group', 'show_breadcrumbs');
        register_setting( 'jdev-settings-group', 'show_header' );
        register_setting( 'jdev-settings-group', 'show_footer' );
        register_setting( 'jdev-settings-group', 'company_logo' );
        
        

        
        // register social media
        register_setting( 'jdev-settings-group', 'twitter_account' );
        register_setting( 'jdev-settings-group', 'facebook_account' );
        register_setting( 'jdev-settings-group', 'youtube_account');
        register_setting( 'jdev-settings-group', 'pinterest_account');
        register_setting( 'jdev-settings-group', 'google_account');
        
        register_setting( 'jdev-settings-group', 'twitter_username');
        register_setting( 'jdev-settings-group', 'twitter_count');
        
        register_setting( 'jdev-settings-group', 'top_header_field' );
        register_setting( 'jdev-settings-group', 'bottom_header_field' );
        
        // register functions settings
        register_setting( 'jdev-settings-group', 'excpert_length');
        
        // register mobile features
        register_setting( 'jdev-settings-group', 'mobile_url' );
        register_setting( 'jdev-settings-group', 'enable_mobile_detect' );
        
        // register mobile features
        register_setting( 'jdev-settings-group', 'company_banner' );
        register_setting( 'jdev-settings-group', 'top_left_box_title' );
        register_setting( 'jdev-settings-group', 'top_left_box_content' );
        register_setting( 'jdev-settings-group', 'top_right_box_title' );
        register_setting( 'jdev-settings-group', 'top_right_box_content' );
        register_setting( 'jdev-settings-group', 'bottom_left_box_title' );
        register_setting( 'jdev-settings-group', 'bottom_left_box_content' );
        register_setting( 'jdev-settings-group', 'bottom_right_box_title' );
        register_setting( 'jdev-settings-group', 'bottom_right_box_content' );
        register_setting( 'jdev-settings-group', 'left_details' );
        
        //register form settings 
        register_setting( 'jdev-settings-group', 'bck_form_email' );
        register_setting( 'jdev-settings-group', 'bck_form_from' );
        
        
        

        
       // do_action('register_mysettings');

    }
    
    
    /**
     * Allows us to filter the option
     * tabs to add or subtract content for
     * custom development.
     *  
     */
    public function bck_option_tabs() {
        
        $tabs = '<li><a href="#tabs-1">' . __('General Options', 'bckspace') . '</a></li>';
        $tabs .= '<li><a href="#tabs-2">' . __('Social Media', 'bckspace') . '</a></li>';
        $tabs .= '<li><a href="#tabs-3">' . __("Mobile", "bckspace") . '</a></li>';
        $tabs .= '<li><a href="#tabs-4">' . __("Forms", "bckspace") . '</a></li>';
        
        return apply_filters('bck_add_options_tabs', $tabs);
    }
    
    
    
    
    /**
     * Allows us to filter tabbed content
     * that matches the links in the above function
     * bck_option_tabs
     *  
     */
    public function bck_option_tab_content() {
        $content = '';
        
        return apply_filters( 'bck_content_tabs', $content);
    }
    
    
    
    /**
     *
     * The content to be displayed on our 
     * options page 
     */
    public function bckspace_theme_options_content() {
        settings_errors();
    ?>
    
    <script type="text/javascript">
        $(function(){
            $('#tabs').tabs();             
        });
    </script>
    <form method="post" action="options.php">
        <?php settings_fields('jdev-settings-group'); ?>
        <?php do_settings_sections('jdev-settings-group'); ?>
                            
                <!-- Tabs -->
                <div class="tabs">
                    <div class="header"><h2>Theme Options</h2></div>
                    <div class="options">
                        <div id="tabs">
                            <div class="nav">
                                <ul>
                                    <?php echo $this->bck_option_tabs(); ?>
                                </ul>
                            </div><!-- end nav -->
                                    
                            <div id="tabs-1">                       
                                <?php parent::jdev_image_upload('Company Logo', 'company_logo'); ?>
                                        
                                <hr>
                                <?php echo parent::jdev_input_text('analytics', 'Analytics Account Number'); ?>
                                <?php parent::jdev_checkbox('show_breadcrumbs', 'Show Breadcrumbs'); ?>
                                        
                            </div> <!-- end tab 1 -->
                                    
                                    
                                    
                            <div id="tabs-2">
                                <?php echo parent::jdev_input_text('facebook_account', 'Facebook Url: '); ?>
                                <?php echo parent::jdev_input_text('twitter_account', 'Twitter Url: '); ?>
                                <?php echo parent::jdev_input_text('youtube_account', 'Youtube Url: '); ?>
                                <?php echo parent::jdev_input_text('pinterest_account', 'Pinterest Url: '); ?>
                                <?php echo parent::jdev_input_text('google_account', 'Google+ Url: '); ?>
                                <hr>
                                        
                                <h3>Twitter Feed</h3>
                                <?php echo parent::jdev_input_text('twitter_username', 'Twitter Username: '); ?>
                                <?php echo parent::jdev_input_text('twitter_count', 'How Many Tweets to show: '); ?>
                                        
                            </div> <!-- end tab 2 -->
                                    
                            <div id="tabs-3">
                                <?php echo parent::jdev_input_text('mobile_url', 'Mobile Url'); ?>
                                <?php parent::jdev_checkbox('enable_mobile_detect', 'Enable Mobile Detection'); ?>    
                            </div> <!-- end tab 3 -->  
                                    
                                    
                            <div id="tabs-4">
                                <?php echo parent::jdev_input_text('bck_form_email', 'Email Address: '); ?>
                                <?php echo parent::jdev_input_text('bck_form_from', 'From: '); ?>
                            </div>
                                    
                            <?php echo $this->bck_option_tab_content(); ?>
                                    
                                    
                        </div> <!-- end tabs -->
                        <div class="save-changes"><?php submit_button(); ?></div>
                    </div><!-- end options -->
                </div><!-- end tabs -->
    </form>

    <?php    
    }
    
}// end our options 


    /**
     * Initiate our Options Class
     */
    $options = new options();