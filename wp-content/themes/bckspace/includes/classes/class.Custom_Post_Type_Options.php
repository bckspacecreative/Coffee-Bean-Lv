<?php

require_once( 'class.Options_Fields.php' );

class Custom_Post_Type_Options extends Options_Fields {
    
    var $bck_cpt;
    var $bck_option_title;
    
    
    public function __construct() {
        
        add_action('admin_menu', array( $this, 'bck_cpt_options' ) );
        
        add_action('admin_menu', array($this, 'bck_inlcude_styles') );
       
    }
    
    
    
    
    public function bck_inlcude_styles() {
        if(is_admin()) :
            wp_enqueue_style( 'bckspace-theme-options-styles', get_template_directory_uri() . '/includes/theme-options.css', false, '1.0' );
        endif;
    }
    
    
    
    
    public function bck_cpt_options() {
        
        add_submenu_page('edit.php?post_type='.$this->bck_cpt, 'Custom Post Type Admin', $this->bck_option_title, 'edit_posts', 'slider-settings', array($this, 'bck_custom_function'));
        //call register settings function
        $this->register_mysettings();
    }
    
    
    /**
     * 
     * Register the settings for the 
     * options page
     */
    public function register_mysettings() {

        // register general settings
        register_setting(  'bck-slider-settings',  'bck_slider_effect' );
        register_setting(  'bck-slider-settings',  'anima_speed' );
        register_setting(  'bck-slider-settings',  'pause_time' );
        register_setting(  'bck-slider-settings',  'direction_nav' );
        register_setting(  'bck-slider-settings',  'control_nav' );
        register_setting(  'bck-slider-settings',  'bck_slider_width' );
        register_setting(  'bck-slider-settings',  'bck_slider_height' );
           

    }
    
    
    
    
    public function bck_custom_function() {
        
        echo '<div class="wrap slider-settings"><div id="icon-options-general" class="icon32"><br></div><h2>'.$this->bck_option_title.'</h2>'; 
        echo '<form method="post" action="options.php">';
        
        settings_fields( 'bck-slider-settings' ); 
        do_settings_sections( 'bck-slider-settings' );
        
        parent::bck_select_option('Slider Effect:', 'bck_slider_effect', 'sliceDown,sliceDownLeft,sliceUp,sliceUpLeft,sliceUpDown,sliceUpDownLeft,fold,fade,random,slideInRight,slideInLeft,boxRandom,boxRain,boxRainReverse,boxRainGrow,boxRainGrowReverse');
        
        echo parent::jdev_input_text( 'bck_slider_width', 'Slider Width: ' );
        
        echo parent::jdev_input_text( 'bck_slider_height', 'Slider Height: ' );
        
        echo parent::jdev_input_text( 'anima_speed', 'Animation Speed: ' );
        
        echo parent::jdev_input_text( 'pause_time', 'Pause Time: ' );
        
        parent::jdev_checkbox( 'direction_nav', 'Directional Navigation: ' );
        
        parent::jdev_checkbox( 'control_nav', 'Control Navigation: ' );
        
        
        
        submit_button();
        echo ' </form></div>';
    }
    
}