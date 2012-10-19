<?php

/**
 * Description of Contact_Form
 *
 * @author Jeff Clark
 */
class Contact_Form {
    
    /**
     * Stores all the form element 
     * names and will be used on 
     * form submission.
     *
     */
    var $form_elements_validate = array();
    var $form_elements = array();
    
    
    
    
    public function __construct() {

        add_shortcode( 'bck_text_field', array( $this, 'bck_form_text_field' ) );
        add_shortcode( 'bck_textarea_field', array( $this, 'bck_form_textarea_field' ) );
        add_shortcode( 'bck_select_field', array( $this, 'bck_form_select_field' ) );
        add_shortcode( 'bck_radio_field', array( $this, 'bck_form_radio_field' ) );
        add_shortcode( 'bck_form', array( $this, 'bck_form_start' ) );
        add_shortcode( 'bck_form_end', array( $this, 'bck_form_end' ) );
        
        add_shortcode( 'bck_form_submission', array( $this, 'bck_form_submission' ) );
        
        add_action( 'wp_footer', array( $this, 'bck_form_ajax_validation'));
    }
    
    
    
    
    /**
     * Form Submission
     *  
     */
    public function bck_form_submission() {      
       
       if(get_option('successMessage') ) {
            $successMessage = get_option('successMessage');
       } else {
            $successMessage = 'Your form has been submitted, Thank you.';
       }
       
       if( isset( $_POST['submitted'] ) ) {       
           
            if(get_option('bck_form_email') ) {
                $emailTo = get_option('bck_form_email');
            } else {
                $emailTo = get_option('admin_email');
            }
            
            $subject = get_option('bck_form_subject');
            
            /**
             * set our body with all form fields created 
             * by all our shortcodes 
             */
            $body = 'Contact Form Fields' . "\r\n";
            
            foreach( $this->form_elements as $key => $form ){  
                
                $body .= $key . ": " . trim($_POST[$form]) . "\r\n";
            }
            
            $headers = 'From: '.get_option('bck_form_from'). "\r\n" . 'Reply-To: ';

            wp_mail($emailTo, $subject, $body, $headers);
            
            ?>

            <script type="text/javascript"> $('.success').append('<?php echo stripslashes($successMessage); ?>'); </script>
            
            <?php 
            
        }
        
        
        
    }
    
 
    
    
    /**
     * We need to wrap the form
     * so lets just create the
     * start of the form wrapper
     *  
     */
    public function bck_form_start( $atts ) {

       extract( shortcode_atts( array(
           'form_name' => 'form_name',
       ), $atts ) );
       
       echo '<div class="success"></div>';
       $html .= '<form action="" method="post" name="'.$form_name.'">';
       return $html;
        
    }
    
    
    
    
    /**
     * The text field that takes creates
     * a shortcode bck_texfield and 
     * displays a textfield with a label
     * 
     * Ex:  [bck_textfield label="First Name" name="fname"]
     *  
     */
    public function bck_form_text_field( $atts ) {
        
       extract( shortcode_atts( array(
           'label' => 'Label Name',
           'name' => '',
           'required' => 'false'
       ), $atts ) );
       
       
       
       
       /*
        * If the required field is set
        * we need to store this in our
        * form_elements_validate array to test
        * using the ajax validation when the
        * form is trying to be submitted
        * 
        */
       if( $required == 'true' ){
           $this->form_elements_validate[] = $name;
       }
       
       
       
       /**
        * add each name to the form_elements 
        * array variable, so all stored values
        * can be run when the mail form is sent 
        */       
       $this->form_elements[$label] = $name;
       
    
       
       
       /**
        * The output of our form element
        */
       $html = '<div class="field">';
       $html .= '<label for="'.$name.'">'.$label.'</label>';
       $html .= '<input type="text" class="text-input" name="'.$name.'" id="'.$name.'" value="" />';
       $html .= '<label class="error" for="'.$name.'" id="'.$name.'">This field is required.</label>';
       $html .='</div>'; 
       
       return $html;
   
    }
    
    
    
    
    /**
     * The text field that takes creates
     * a shortcode bck_text_field and 
     * displays a textfield with a label
     * 
     * Ex:  [bck_textfield label="First Name" name="fname"]
     *  
     */
    public function bck_form_textarea_field( $atts ) {
        
       extract( shortcode_atts( array(
           'label' => 'Label Name',
           'name' => '',
           'required' => 'false'
       ), $atts ) );
       

       /**
        * add each name to the form_elements 
        * array variable, so all stored values
        * can be run when the mail form is sent 
        */       
       $this->form_elements[$label] = $name;
       
       
       /**
        * The output of our form element
        */
       $html ='<div class="field">';
       $html .= '<label for="'.$name.'">'.$label.'</label>';
       $html .= '<textarea name="'.$name.'" class="text-input" id="'.$name.'" value="" /></textarea>';
       $html .='</div>';
       
       return $html;
   
    }
    
    
  
    
    /**
     * Select field that creats a shortcode
     * bck_select_field to display any selection
     * option desired
     * 
     * Ex:  
     *  
     */
    public function bck_form_select_field( $atts ) {
        
       extract( shortcode_atts( array(
           'label' => 'Label Name',
           'name' => '',
           'required' => 'false',
           'option' => '',
       ), $atts ) );
       
       
       
       /*
        * If the required field is set
        * we need to store this in our
        * form_elements_validate array to test
        * using the ajax validation when the
        * form is trying to be submitted
        * 
        */
       if( $required == 'true' ){
           $this->form_elements_validate[] = $name;
       }
       
       
       
       /**
        * add each name to the form_elements 
        * array variable, so all stored values
        * can be run when the mail form is sent 
        */
       $this->form_elements[$label] = $name;
       
       
       
       /**
        * get the option string and 
        * explode it to form an array 
        */
       $option = explode(",", $option);
       
       
       /**
        * The output of our form element
        */
       $html ='<div class="field">';
       $html .= '<label for="'.$name.'">'.$label.'</label>';
       $html .= '<select class="text-input" id="'.$name.'" name="'.$name.'">';
       $html .= '<option value="">Select</option>';
       foreach( $option as $newOption ) {
           $html .= '<option value="'.$newOption.'">' . $newOption . '</option>';
       }
       
       $html .= '</select>';
       $html .= '<label class="error" for="'.$name.'" id="'.$name.'">This field is required.</label>';
       $html .='</div>';
       
       return $html;
   
    }
    
    
    
    
    /**
     * Radio field that creats a shortcode
     * bck_radio_field to display a checkbox
     * option in one group, or single
     * 
     * Ex:  
     *  
     */
    public function bck_form_radio_field( $atts ) {
        
       extract( shortcode_atts( array(
           'label' => 'Label Name',
           'name' => '',
           'required' => 'false',
           'option' => '',
       ), $atts ) );
       
       
       
       /*
        * If the required field is set
        * we need to store this in our
        * form_elements_validate array to test
        * using the ajax validation when the
        * form is trying to be submitted
        * 
        */
       if( $required == 'true' ){
           $this->form_elements_validate[] = $name;
       }
       
       
       
       /**
        * add each name to the form_elements 
        * array variable, so all stored values
        * can be run when the mail form is sent 
        */
       $this->form_elements[$label] = $name;
       
       
       
       /**
        * get the option string and 
        * explode it to form an array 
        */
       $option = explode(",", $option);
       
       
       /**
        * The output of our form element
        */
       $html ='<div class="field">';
       $html .= '<label for="'.$name.'">'.$label.'</label>';
       foreach( $option as $newOption ) {
           $html .= '<div class="radio-btn"><span class="radio-label">'.$newOption.'</span><input type="radio" class="text-input" id="'.$newOption.'" name="'.$name.'" value="'.$newOption.'" ></div>';
       }
       
       $html .= '<label class="error" for="'.$name.'" id="'.$name.'">This field is required.</label>';
       $html .='</div>';
       
       return $html;
   
    }    
    
    
    
    
    /**
     * We need to wrap the form
     * so lets just create the
     * start of the form wrapper
     *  
     */
    public function bck_form_end( $atts ) {

       extract( shortcode_atts( array(
           'submit' => 'submit',
       ), $atts ) );
       
       $html = '<input type="hidden" name="submitted" id="submitted" value="true" />';
       $html .= '<input type="submit" id="submit" value="'.$submit.'" >';
       $html .= '</form>';
       
       $this->bck_form_submission();
       
       return $html;
        
    } 
    
    
    
    
    
      
    /**
     * Form Validation using Ajax
     *  
     */
    public function bck_form_ajax_validation() {
        
        ?>
        <script type="text/javascript">
            $(function() {
                $('.error').hide();
                $('input.text-input').css({backgroundColor:"#FFFFFF"});
                $('input.text-input').focus(function(){
                    $(this).css({backgroundColor:"#FDFDFD"});
                });
                $('input.text-input').blur(function(){
                    $(this).css({backgroundColor:"#FFFFFF"});
                });

                $("#submit").click(function() {
                                // validate and process form
                                // first hide any error messages
                    $('.error').hide();
                    var fields = <?php echo json_encode($this->form_elements_validate); ?>;
                    for(x in fields) {
                    var name = $("#"+fields[x]).val();
                    if (name == "") {
                    $("label#"+fields[x]).show();
                    $("#"+fields[x]).focus();

                    return false;
                    }   
                    
            }
		
		//var dataString = 'name='+ name + '&phone=' + option;
		//alert (dataString);return false;
		
            $.ajax({
                type: "POST",
                url: "bin/process.php",
                data: dataString,
                success: function() {
                    $('#contact_form').html("<div id='message'></div>");
                    $('#message').html("<h2>Contact Form Submitted!</h2>")
                    .append("<p>We will be in touch soon.</p>")
                    .hide()
                    .fadeIn(1500, function() {
                    $('#message').append("<img id='checkmark' src='images/check.png' />");
                    });
                }
                });
                return false;
                });
            });

            runOnLoad(function(){
            $("input#submitted").select().focus();
            });
            
        </script>
        <?php
    }
    
}