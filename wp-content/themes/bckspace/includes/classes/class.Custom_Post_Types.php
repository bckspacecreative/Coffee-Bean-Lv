<?php

     /**
      * Create our custom post types here.
      * This will reference our Custmo Post Types Class
      * classes/class.Custom_Post_Types.php
      * 
      *     $jdevPostKey :  your CPT's unique key ex: my_post_name_key
      * 
      *     $jdevPostName : The name of your CPT, ex: My Post Name
      * 
      *     $jdevPostSingleName : The singular name, ex: My Post Name
      * 
      *     $jdevPostSlug : The url extension for you post, ex: my-post-name
      *     
      * 
      * 
      * EXAMPLE USAGE --------------------------------------------------------------
      * 
      * Custom_Post_Type($jdevPostKey, $jdevPostName, $jdevPostSingleName, $jdevPostSlug)
      * 
      * Add the lines below to your functions.php file,
      * make sure you path is correct
      * 
      *     require_once('classes/class.Custom_Post_Types.php');
      *     $customPostType = new Custom_Post_Types('jdev_events', 'Events', 'Event', 'jdev-event', 'post icon url');
      * 
      * Setting these variables in your functions.php file will
      * allow you to make your CPT have a Hierarchical structure, default is false
      *
      *     $customPostType->jdevHierarchical = true;
      * 
      * Settings for what your CPT supports, must be an array!!!
      * 
      *     $customPostType->jdevSupports = array( 'title', 'editor', 'thumbnail', 'page-attributes' );
      * 
      * @author Jeff Clark
      * 
      */


class Custom_Post_Types {
   
    // Variables passed to the contructor
    var $jdevPostKey;
    var $jdevPostName;
    var $jdevPostSingleName;
    var $jdevPostSlug;
    var $jdevPostIcon;
    var $jdevPostIconStr;
    
    // More Variables
    var $jdevHierarchical = false;
    var $jdevSupports = array();
    
    
    
    
    /*
     * Constructor to run everything
     */
    public function __construct( $jdevPostKey, $jdevPostName, $jdevPostSingleName, $jdevPostSlug, $jdevPostIcon = '' ) {
                
        $this->jdevPostKey = $jdevPostKey;
        $this->jdevPostName = $jdevPostName;
        $this->jdevPostSingleName = $jdevPostSingleName;
        $this->jdevPostSlug = $jdevPostSlug;
        $this->jdevPostIcon = $jdevPostIcon;

        $this->jdev_test_icon();
        
        add_action( 'init', array($this, 'jdev_create_post_type'));
        
    }
    
    
    
    /*
     *  Test if the Post Icon variable is empty or not
     */
    public function jdev_test_icon() {
        
        if( $this->jdevPostIcon == '' ) {
            $this->jdevPostIconStr = false;
        } else {
            $this->jdevPostIconStr = get_template_directory_uri() . '/images/' . $this->jdevPostIcon;
        }
    }
    
    
    
    /*
     * Lets go ahead and create our portfolio post type
     */
    public function jdev_create_post_type() {
       
        register_post_type( $this->jdevPostKey,
                
                array(
                    
                    'labels' => array(
                        'name' => __( $this->jdevPostName ),
                        'singular_name' => __( $this->jdevPostSingleName ),
                        
                    ),
                    
                'public' => true,
                'show_ui' => true,    
                'show_in_menu' => true,
                'hierarchical' => $this->jdevHierarchical,
                'rewrite' => array( 'slug' => $this->jdevPostSlug ),
                'supports' => $this->jdevSupports,
                'menu_icon' => $this->jdevPostIconStr
                )
            
        );
           
    }
    
}