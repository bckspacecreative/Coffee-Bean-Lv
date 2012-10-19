<?php

     /*
     * Create our Taxonomies
     * Create a new instance of our customTaxonomy Class and pass it the parameters needed to create
     * a new Taxonomy. It takes 4 parameters. Must be using the jdev plugin
     * 
     * Custom_Taxonomy($tentenTaxKey, $tentenPostType, $tentenTaxTitle, $tentenTaxSlug)
     * 
     * require_once('classes/class.Custom_Taxonomy.php'); 
     * $customTaxonomy = new Custom_Taxonomy( 'zoo_event_types', 'tenten_events', 'Event Types', 'zoo-event-types', 'post');
     * 
     * @author Jeff Clark
     *  
     */
     


class Custom_Taxonomy {
    
    //establish some variables
    var $tentenTaxKey;
    var $tentenPostType;
    var $tentenTaxTitle;
    var $tentenTaxSlug;
    
    
    
    //create our construct function to run our hooks and filters
    public function __construct($tentenTaxKey, $tentenPostType, $tentenTaxTitle, $tentenTaxSlug) {
        
        $this->tentenTaxKey = $tentenTaxKey;
        $this->tentenPostType = $tentenPostType;
        $this->tentenTaxTitle = $tentenTaxTitle;
        $this->tentenTaxSlug = $tentenTaxSlug;
                
        add_action( 'init', array( $this, 'tenten_create_taxonomy') );
        
    }
    
    
    
    //create our taxonomy
    public function tenten_create_taxonomy() {
        
        register_taxonomy( 
                $this->tentenTaxKey, 
                $this->tentenPostType,
                array(
                    'hierarchical' => true,
                    'label' => $this->tentenTaxTitle,
                    'query_var' => true,
                    'rewrite' => array( 'slug' => $this->tentenTaxSlug )
                )
         );
        
    }
    
    
}

?>
