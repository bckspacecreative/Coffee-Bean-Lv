<?php

/**
 * Description of Custom_Term_Meta is to create
 * custom meta data for our Taxonomy Terms.
 *
 * @author Jeff Clark
 */
class Custom_Term_Meta {
    
    var $bckTaxonomyName;
    var $bckTermLabel;
    var $bckTermName;
    
    public function __construct( $bckTaxonomyName, $bckTermLabel, $bckTermName) {
        
        global $post;
        
        $this->bckTaxonomyName = $bckTaxonomyName;
        $this->bckTermLabel = $bckTermLabel;
        $this->bckTermName = $bckTermName;
        
        add_action( $this->bckTaxonomyName.'_add_form_fields', array( $this, 'bck_term_meta_box_add' ), 10, 1);
        add_action( $this->bckTaxonomyName.'_edit_form_fields', array( $this, 'bck_term_meta_box_edit' ), 10, 1);
        
        add_action( 'created_'.$this->bckTaxonomyName, array( $this, 'save_bck_term_meta'), 10, 1);
        add_action( 'edited_'.$this->bckTaxonomyName, array( $this, 'save_bck_term_meta'), 10, 1);
        
    }
 
        /*
     * lets give this custom field to our terms
     * 
     */
    function bck_term_meta_box_add() {
            // this will add the custom meta field to the add new term page
            global $post;
            ?>
            <div class="form-field">

                    <label for="term_meta[<?php echo $this->bckTermLabel; ?>]"><?php _e( $this->bckTermLabel, 'bckspace' ); ?></label>
                    <input type="text" name="term_meta[<?php echo $this->bckTermName; ?>]" id="term_meta[<?php echo $this->bckTermName; ?>]" value="">

            </div>
                    


                    
    <?php
    }




    // Edit term page
    function bck_term_meta_box_edit($term) {

            // put the term ID into a variable
            $t_id = $term->term_id; ?>
            
            <?php $term_meta = get_option("taxonomy_$t_id"); ?>

            <tr class="form-field">
            <th scope="row" valign="top"><label for="term_meta[<?php echo $this->bckTermName; ?>]"><?php _e( $this->bckTermLabel, 'bckspace' ); ?></label></th>
            <td><input type="text" name="term_meta[<?php echo $this->bckTermName; ?>]" id="term_meta[<?php echo $this->bckTermName; ?>]" value="<?php echo $term_meta[$this->bckTermName]; ?>"></td>
            </tr> 
            
          <?php  
    }

    
    
    
    
    // Save extra taxonomy fields callback function.
    function save_bck_term_meta( $term_id ) {
        
            if ( isset( $_POST['term_meta'] ) ) {
                    $t_id = $term_id;
                    $term_meta = get_option( "taxonomy_$t_id" );
                    $cat_keys = array_keys( $_POST['term_meta'] );
                    foreach ( $cat_keys as $key ) {
                            if ( isset ( $_POST['term_meta'][$key] ) ) {
                                    $term_meta[$key] = $_POST['term_meta'][$key];
                            }
                    }
                    // Save the option array.
                    update_option( "taxonomy_$t_id", $term_meta );
            }
            
            if ( isset( $_POST[$this->bckTermName] ) ) {
                    $t_id = $term_id;
                    $term_meta = get_option( "taxonomy_$t_id" );
                    $cat_keys = array_keys( $_POST[$this->bckTermName] );
                    foreach ( $cat_keys as $key ) {
                            if ( isset ( $_POST[$this->bckTermName][$key] ) ) {
                                    $term_meta[$key] = $_POST[$this->bckTermName][$key];
                            }
                    }
                    // Save the option array.
                    update_option( "taxonomy_$t_id", $term_meta );
            }
    }  
    
    
    
}