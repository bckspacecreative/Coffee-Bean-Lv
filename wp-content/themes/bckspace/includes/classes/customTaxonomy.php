<?php

/**
 * Description of customTaxonomy is to create the taxonomy for our post type
 *
 * @author Jeff Clark 1010 Collective
 */


class customTaxonomy {
    
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
