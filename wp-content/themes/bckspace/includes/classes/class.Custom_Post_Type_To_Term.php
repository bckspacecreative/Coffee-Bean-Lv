<?php

     /**
      * We need to add a new term dynamaically to another 
      * CPT as a term. 
      * 
      * $bckTaxonomy = the taxonomy key you are adding a new term for.
      * $bckPostType = the post type key you are turning into a term.
      * 
      * Add the lines below to your functions.php file * make sure your path
      * is correct.
      * require_once('classes/class.Custom_Post_Type_To_Term.php');
      * $customPostTypeToTerm = new Custom_Post_Type_To_Term($bckTaxonomy, $bckPostType);
      * 
      * @author Jeff Clark
      * 
      */

class Custom_Post_Type_To_Term {
    
    // set some variables
    var $bckTaxonomy;
    var $bckPostType;
    var $term_id;
    
    var $bckTermDescription;
    var $bckTermName;
    
    
    
    
    
    public function __construct( $bckTaxonomy, $bckPostType) {
        $this->bckTaxonomy = $bckTaxonomy;
        $this->bckPostType = $bckPostType;
        
        if(isset($_POST['post_title'])):
            add_filter( 'wp_insert_post_data' , array($this, 'bck_add_new_term'), 99);
        endif;
    }
    
    
    
    
    
    /** 
     * This will run at wp_insert_post_data to create the new 
     * term for our assigned Taxonomy.
     * 
     * @param type $data
     */
    public function bck_add_new_term( $data ){
        $this->bckTermName = $data['post_name'];
        
        if(isset($_POST['excerpt'])){
            $this->bckTermDescription = $_POST['excerpt'];
        } else {
            $this->bckTermDescription = '';
        }
        
        $args = array(
            'description' => $this->bckTermDescription, 
            'parent' => "cat_id"
        );
            
        if ($data['post_type'] == $this->bckPostType && !term_exists($this->bckTermName, $this->bckTaxonomy)) {
            wp_insert_term($data['post_title'], $this->bckTaxonomy, $args);
        } else {
            $this->bck_update_current_term( $data );
        }

        return $data;
    }
    
    
    
    
    
    /** 
     * This will run at wp_insert_post_data to update existing 
     * term if the term already exsists for our assigned Taxonomy.
     * 
     * @param type $data
     */
    public function bck_update_current_term($data){
        global $wpdb;
        $args2 = array(
            'description' => $this->bckTermDescription,  
            'name' => $_POST['post_title']
         );
        
        if( $data['post_type'] == $this->bckPostType ){
            $bckTermId = $wpdb->get_row("SELECT * FROM $wpdb->terms WHERE slug = '$this->bckTermName'");
            $terms = $bckTermId->term_id;

            wp_update_term($terms, $this->bckTaxonomy, $args2);
        }
        
    }
    
}