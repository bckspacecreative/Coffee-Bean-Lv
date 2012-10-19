<?php
/**
 * Theme's Functions and Definitions
 *
 *
 * @file           functions.php
 * @package        bckspace
 * @author         Jeff Clark
 * @copyright      2012
 * @license        license.txt
 * @version        Release: 1.0
 * @filesource     wp-content/themes/bskspace/includes/functions.php
 * @since          available since Release 1.0
 */


    /**
    * Its Go Time!!!!
    */

    
    /* Redirect users to Theme Options after 
     * the Bckspace theme has been activated
     */
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	wp_redirect( 'themes.php?page=theme-options' );
    }
    
    if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions 
        add_image_size( 'post-thumbnail', 245, 186, true ); //(cropped)  
    }

    /**
    * Register Our Menues for our theme, We can also add more
    * by creating a new menu uption in our array
    */

    add_action( 'init', 'jdev_theme_menues');

    function jdev_theme_menues() {

        register_nav_menu( 'primary', __( 'Primary Menu', 'bckspace' ) );
        register_nav_menu( 'footer', __( 'Footer Menu', 'bckspace' ) );
        register_nav_menu( 'sub_menu', __( 'Sub Menu', 'bckspace' ) );

    }



    /**
    * Replaces "[...]" for our excerpt used in frontpage.php
    */
    function jdev_excerpt_more( $more ) {

            return ' &hellip;' . jdev_continue_reading_link();

    }

    add_filter( 'excerpt_more', 'jdev_excerpt_more' );



    /**
    * Creates our link for read more.
    *  
    */
    function jdev_continue_reading_link() {

            return ' <a href="'. esc_url( get_permalink() ) . '">' . __( '<span class="read-more">Read More</span>', 'bckspace' ) . '</a>';

    }
    
    
    
    
    function bck_threaded_links(){
        if ( is_singular() ) :
            wp_enqueue_script( 'comment-reply' );
        endif;
    }
    
    add_action( 'wp_head', 'bck_threaded_links' );
    
    
    
    
    /**
     * Include our contact form stuff,
     * Allows for a shortcode form creation
     * that excepts parameters to create whatever
     * form you would like.
     *  
     */
    require_once 'classes/class.Contact_Form.php';
    $contactForms = new Contact_Form();




    /**
    * We need to shorten up our excerpt length here, its way to long,
    * we will do this by hooking into excerpt lenth and returning our new
    * length of 40
    */

    function jdev_custom_excerpt_length( $length ){
        return 40;
    }

    add_filter( 'excerpt_length', 'jdev_custom_excerpt_length' );





    /**
    * Setup for our Widgets Area. This must be included
    * to have the ability to use the widgets area. 
    */

    if (function_exists('register_sidebar') ) {

        register_sidebar(array(
                    'name' => 'sidebar',  
                    'before_widget' => '<div class="sidebar-box">',  
                    'after_widget' => '</div>',  
                    'before_title' => '<span class="sidebar-title">',  
                    'after_title' => '</span><div class="dots"></div>',     
                )
        );

    }
    
    
    
    
    /** 
     * Create the list of custom user meta data for the 
     * blog section
     *  
     */
    function bck_get_post_meta() {
        printf( __( '<span class="sep">Posted on </span><time class="entry-date" datetime="%3$s" pubdate>%4$s</time><span class="by-author"> <span class="sep"> by </span> <span class="author vcard">%7$s</span></span>', 'bckspace' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'bckspace' ), get_the_author() ) ),
		get_the_author()
	);
        
    }    
   
    
    
    /**
     * Create a custom post type if the user has chosen to do so.
     * This can be created in the options panel for the bckspac theme
     * 
     * You can create as many Custom Post Types as need by just
     * calling the custom post types class and passing it the 
     * needed parameters listed below
     * 
     * @param type $bckPostKey
     * @param type $bckPostName
     * @param type $bckPostSingleName
     * @param type $bckPostSlug
     *  
     */
    require_once('classes/class.Custom_Post_Types.php' );
    
    // get our variables from the options page and use the
    // to create our CPT
    
    $bckPostKey = get_option( 'bckPostKey' );
    $bckPostName = get_option( 'bckPostName' );
    $bckPostSingleName = get_option( 'bckPostSingleName' );
    $bckPostSlug = get_option( 'bckPostSlug' );
    
    //new custom_post_types($jdevPostKey, $jdevPostName, $jdevPostSingleName, $jdevPostSlug)
                    
    if( $bckPostKey ) {
        
        $cpt = new custom_post_types( $bckPostKey, $bckPostName, $bckPostSingleName, $bckPostSlug );
    
    }
    
    
    
    
    /**
     * Create breadcumbs to display if checked in the options page.
     *  
     */
    function bck_breadcrumbs() {

    $bckDelimiter = '&raquo;';
    $bckHome = 'Home'; // text for the 'Home' link
    $bckBefore = '<span class="current">'; // tag before the current crumb
    $bckAfter = '</span>'; // tag after the current crumb

    if ( !is_home() && !is_front_page() || is_paged() ) {

        echo '<div id="crumbs">';

        global $post;
        $homeLink = get_bloginfo('url');
        echo '<a href="' . $homeLink . '">' . $bckHome . '</a> ' . $bckDelimiter . ' ';

        if ( is_category() ) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
        if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $bckDelimiter . ' '));
        echo $bckBefore . 'Archive by category "' . single_cat_title('', false) . '"' . $bckAfter;

        } elseif ( is_day() ) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $bckDelimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $bckDelimiter . ' ';
        echo $bckBefore . get_the_time('d') . $bckAfter;

        } elseif ( is_month() ) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $bckDelimiter . ' ';
        echo $bckBefore . get_the_time('F') . $bckAfter;

        } elseif ( is_year() ) {
        echo $bckBefore . get_the_time('Y') . $bckAfter;

        } elseif ( is_single() && !is_attachment() ) {
        if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $bckDelimiter . ' ';
            echo $bckBefore . get_the_title() . $bckAfter;
        } else {
            $cat = get_the_category(); $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $bckDelimiter . ' ');
            echo $bckBefore . get_the_title() . $bckAfter;
        }

        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        $post_type = get_post_type_object(get_post_type());
        echo $bckBefore . $post_type->labels->singular_name . $bckAfter;

        } elseif ( is_attachment() ) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $bckDelimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $bckDelimiter . ' ';
        echo $bckBefore . get_the_title() . $bckAfter;

        } elseif ( is_page() && !$post->post_parent ) {
        echo $bckBefore . get_the_title() . $bckAfter;

        } elseif ( is_page() && $post->post_parent ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $bckDelimiter . ' ';
        echo $bckBefore . get_the_title() . $bckAfter;

        } elseif ( is_search() ) {
        echo $bckBefore . 'Search results for "' . get_search_query() . '"' . $bckAfter;

        } elseif ( is_tag() ) {
        echo $bckBefore . 'Posts tagged "' . single_tag_title('', false) . '"' . $bckAfter;

        } elseif ( is_author() ) {
        global $author;
        $userdata = get_userdata($author);
        echo $bckBefore . 'Articles posted by ' . $userdata->display_name . $bckAfter;

        } elseif ( is_404() ) {
        echo $bckBefore . 'Error 404' . $bckAfter;
        }

        if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
        echo __('Page') . ' ' . get_query_var('paged');
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</div>';

    }
    } // end dimox_breadcrumbs()



 
    
    
    /* Mobile Detection using the Mobile Detect Class
     * we then just see if the methode isMobile is returned
     * true.  If that is the case we us wp_redirect 
     * to send us to the mobile url specified in general options
     * page. 
     * 
     * We then run the action hook to fire at the beginning of
     * get_header
     */
    function bck_mobile_detect() {
        require_once( 'classes/class.Mobile_Detect.php' );
        $isMobile = new Mobile_Detect();
        $bckMobileUrl = get_option('mobile_url');
        $bckEnableMobileDetect = get_option( 'enable_mobile_detect' );
        
        if( $isMobile->isMobile() === true && $bckEnableMobileDetect == 1 ) :
            //Its Mobile
            wp_redirect( $bckMobileUrl );
            exit();
        endif;

        }
    
    add_action('get_header', 'bck_mobile_detect', 1);
    
    
    
    
    /**
     * Google Analytics Code.
     * Inject your Google Analytics code in the footer by adding
     * your Analytics Account Number in the Options Panel
     * 
     * View in Bck Options page in the General Tab
     */
    
    function bck_google_analytics_code() {
        
        $bckGoogleAccountNumber = get_option( 'analytics' );
    ?>
        <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', '<?php echo $bckGoogleAccountNumber; ?>']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

        </script>
    <?php        
    }
    
    add_action( 'wp_head', 'bck_google_analytics_code', 10);
    
    
    
    
/**
* Sub Navigation for all internal pages.
* This will get back the children and or a parent page.
* If on the child page it list list all other children
*
*/
function bck_get_sidebar_nav( $post ) {     
 
    if($post->post_parent) {
        //$children = wp_list_pages('sort_column=menu_order&title_li=&child_of='.$post->ID.'&echo=0&depth=1');
        $children = '';
        $child = wp_list_pages("sort_column=ID&title_li=&child_of=".$post->post_parent."&echo=0&depth=2");
    } else {
        $children = wp_list_pages("sort_column=ID&title_li=&child_of=".$post->ID."&echo=0&depth=1");
        $child = '';
    }
 
    if ($children) {
        $parent_title = get_the_title($post->post_parent);
        echo '<h3><a href="'.get_permalink($post->post_parent).'">'.$parent_title.'</a></h3>'; 
        echo '<ul>';         
        echo $children;
        echo '</ul>';
    }  if($child) {
        $parent_title = get_the_title($post->post_parent);
        echo '<h3><a href="'.get_permalink($post->post_parent).'">'.$parent_title.'</a></h3>';
        echo '<ul>';           
        echo $child;
        echo '</ul>';
    }
}
    
    
    
    
    /**
     * Setup a twitter feed that we can inject
     * anywhere we like
     *  
     */    
    function bck_twitter_feed() {
        
        ?>
        <script type="text/javascript">
            JQTWEET = {

            // Set twitter username, number of tweets & id/class to append tweets
            user: '<?php echo get_option('twitter_username'); ?>',
            numTweets: '<?php echo get_option('twitter_count'); ?>',
            appendTo: '.twitter',

            // core function of jqtweet
            loadTweets: function() {
                $.ajax({
                    url: 'http://api.twitter.com/1/statuses/user_timeline.json/',
                    type: 'GET',
                    dataType: 'jsonp',
                    data: {
                        screen_name: JQTWEET.user,
                        include_rts: true,
                        count: JQTWEET.numTweets,
                        include_entities: true
                    },
                    success: function(data, textStatus, xhr) {

                        var html = '<div class="tweet-wrap" id="tweet-wrap"><div class="twitter-quote"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter-quote.png" border="0" alt="" /></div><div class="tweet"><p>TWEET_TEXT</p><div class="time">AGO</div></div>';

                        // append tweets into page
                        for (var i = 0; i < data.length; i++) {
                            $(JQTWEET.appendTo).append(
                                html.replace('TWEET_TEXT', JQTWEET.ify.clean(data[i].text) )
                                    .replace(/USER/g, data[i].user.screen_name)
                                    .replace('AGO', JQTWEET.timeAgo(data[i].created_at) )
                                    .replace(/ID/g, data[i].id_str)
                            );
                        }                 
                    }  

                });

            },


            /**
            * relative time calculator FROM TWITTER
            * @param {string} twitter date string returned from Twitter API
            * @return {string} relative time like "2 minutes ago"
            */
            timeAgo: function(dateString) {
                var rightNow = new Date();
                var then = new Date(dateString);

                if ($.browser.msie) {
                    // IE can't parse these crazy Ruby dates
                    then = Date.parse(dateString.replace(/( \+)/, ' UTC$1'));
                }

                var diff = rightNow - then;

                var second = 1000,
                minute = second * 60,
                hour = minute * 60,
                day = hour * 24,
                week = day * 7;

                if (isNaN(diff) || diff < 0) {
                    return ""; // return blank string if unknown
                }

                if (diff < second * 2) {
                    // within 2 seconds
                    return "right now";
                }

                if (diff < minute) {
                    return Math.floor(diff / second) + " seconds ago";
                }

                if (diff < minute * 2) {
                    return "about 1 minute ago";
                }

                if (diff < hour) {
                    return Math.floor(diff / minute) + " minutes ago";
                }

                if (diff < hour * 2) {
                    return "about 1 hour ago";
                }

                if (diff < day) {
                    return  Math.floor(diff / hour) + " hours ago";
                }

                if (diff > day && diff < day * 2) {
                    return "yesterday";
                }

                if (diff < day * 365) {
                    return Math.floor(diff / day) + " days ago";
                }

                else {
                    return "over a year ago";
                }
            }, // timeAgo()


            /**
            * The Twitalinkahashifyer!
            * http://www.dustindiaz.com/basement/ify.html
            * Eg:
            * ify.clean('your tweet text');
            */
            ify:  {
            link: function(tweet) {
                return tweet.replace(/\b(((https*\:\/\/)|www\.)[^\"\']+?)(([!?,.\)]+)?(\s|$))/g, function(link, m1, m2, m3, m4) {
                var http = m2.match(/w/) ? 'http://' : '';
                return '<a class="twtr-hyperlink" target="_blank" href="' + http + m1 + '">' + ((m1.length > 25) ? m1.substr(0, 24) + '...' : m1) + '</a>' + m4;
                });
            },

            at: function(tweet) {
                return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20})/g, function(m, username) {
                return '<a target="_blank" class="twtr-atreply" href="http://twitter.com/intent/user?screen_name=' + username + '">@' + username + '</a>';
                });
            },

            list: function(tweet) {
                return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20}\/\w+)/g, function(m, userlist) {
                return '<a target="_blank" class="twtr-atreply" href="http://twitter.com/' + userlist + '">@' + userlist + '</a>';
                });
            },

            hash: function(tweet) {
                return tweet.replace(/(^|\s+)#(\w+)/gi, function(m, before, hash) {
                return before + '<a target="_blank" class="twtr-hashtag" href="http://twitter.com/search?q=%23' + hash + '">#' + hash + '</a>';
                });
            },

            clean: function(tweet) {
                return this.hash(this.at(this.list(this.link(tweet))));
            }
            } // ify


        };



        $(document).ready(function () {
            // start jqtweet!
            JQTWEET.loadTweets();
        });
        </script>
<?php 
    }
    
    
    
    
    
    /**
     * We need to add some JS for our Twitter Feed
     *  
     */
    function bck_inject_twitter_js() {
        wp_enqueue_script('twitter-feed', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    }
    
    add_action('wp_enqueue_scripts', 'bck_inject_twitter_js');
    
    
    
   
    
    

    /** -----------------------------------------------------
     * Hooks $ Filters for our options page
     * ------------------------------------------------------
     */    
    function bck_add_tab( $tabs, $tab = null ) {
        //if a tab is added make sure to add a content section with the correct id
        //$tab = '<li><a href="#tabs-7">' . __("TEST ME", "bckspace") . '</a></li>';
        return $tabs . $tab;
    }
    
    add_filter( 'bck_add_options_tabs', 'bck_add_tab' );
    
    
    
    
    /**
     * Add tabed content section, this ties
     * into the above function bck_add_tab.  This
     * will hold the content for each tab.
     *  
     */
    function bck_tabbed_content() {
        
    }
    
    add_filter( '', 'bck_tabbed_content' );
    
    

    /** -----------------------------------------------------
     * bckspace creative theme functions
     * ------------------------------------------------------
     */    
    
    function bck_daily_tip() {
        $args = array('post_type' => 'bck-daily-tip', 'posts_per_page' => 1);
        $loop = new WP_Query($args);

        while ($loop->have_posts()) : $loop->the_post();
            echo '<div class="function-of-the-day">';
            echo '<h3>Function of the day</h3>';
                 the_excerpt();
            echo '<a href="';
                 the_permalink();
            echo '"><span class="read-more">Read More</span></a>';
            echo '</div><!-- end function of the day -->';
            
        endwhile;
    }
    
    
    
    
    /*
     * Create Custom Excerpt Length
     * We need to have two different excerpt pages on one page.  We will pass
     * a boolean value to a function then run our excerpt command to limit 
     * our length.
     * 
     */
     
     
     function bck_get_excerpt_length( $length ) {  
         global $bck_excerpt_length;
         
         if ( $bck_excerpt_length ) {      
             return $bck_excerpt_length;            
         } else {           
             return 40;
         }        
     }
      
     add_filter( 'excerpt_length', 'bck_get_excerpt_length' );
    
    
     
     
     /*
      * Home page important topics
      * 
      */
     function bck_four_points( $bckPointTitle, $bckPointContent, $bckClass ) {
        
        echo '<div class="reason-wrap">'; 
        echo '<div class="reasons-why-icon '. " " . $bckClass . '"></div>';
        echo '<div class="reason-content">';
        echo '<h4>';
        echo get_option( $bckPointTitle );
        echo '</h4>';
        echo '<p>';
        echo get_option( $bckPointContent );
        echo '</p>';
        echo '</div> <!-- end reason content -->';
        echo '</div><!-- end reason wrap -->';
         
     }
     
     
     
     
     /**
      * Slider / Static Image integration
      * If the static image does not return false
      * the static image is displayed else 
      * the slider will show.
      * 
      */
     function bck_slider_build() {
            $args = array('post_type' => 'bck-slider', 'posts_per_page' => -1, 'order' => 'ASC');
            $loop = new WP_Query($args);

            echo '<div id="slider" class="nivoSlider">';

            while ($loop->have_posts()) : $loop->the_post();
                $page_title = get_the_ID();
                the_post_thumbnail('full', array('title' => '#' . $page_title,));
            endwhile;
            wp_reset_query();

            echo '</div>';

            $args = array('post_type' => 'bck-slider', 'posts_per_page' => -1, 'order' => 'ASC');
            $loop = new WP_Query($args);

            while ($loop->have_posts()) : $loop->the_post();
                $page_title = get_the_ID();
                echo '<div id="' . $page_title . '" class="nivo-html-caption">';
                the_content();
                echo '</div>';
            endwhile;
            wp_reset_query();       
     }
     
     
     
     
    /**
     * Add custom posty type for slider along
     * with the settings page. 
     */
    $bckSlider = new Custom_Post_Types('bck-slider', 'Slider', 'Slide', 'bck-slider');
    $bckSlider->jdevSupports = array('title', 'editor', 'thumbnail' );
    $bckSlider->jdevHierarchical = true;
    
    
    require_once 'classes/class.Custom_Post_Type_Options.php';
    $bckSliderOptions = new Custom_Post_Type_Options();
    $bckSliderOptions->bck_cpt = 'bck-slider';
    $bckSliderOptions->bck_option_title = 'Slider Settings';
     
     
     
     
     
     
    /**
     * Using the Mail Chimp API to create an
     * email signup form.  We use a shortcode
     * that lets us place it anywhere we want
     * in our site. 
     * 
     * @param type $atts 
     */ 
    function mailChimps( $atts ) {
        
        if(isset($_POST['email'])):  

        /**
        This Example shows how to Subscribe a New Member to a List using the MCAPI.php 
        class and do some basic error checking.
        **/
        require_once 'mail_chimp/examples/inc/MCAPI.class.php';
        require_once 'mail_chimp/examples/inc/config.inc.php'; //contains apikey
        $api = new MCAPI($apikey);

        $merge_vars = array('FNAME'=>'Test', 'LNAME'=>'Account', 
                        'GROUPINGS'=>array(
                                array('name'=>'', 'groups'=>''),
                                array('id'=>'', 'groups'=>''),
                            )
        );

        // By default this sends a confirmation email - you will not see new members
        // until the link contained in it is clicked!
        $retval = $api->listSubscribe( $listId, $my_email, $merge_vars );

        if ($api->errorCode){
                echo "Unable to load listSubscribe()!\n";
                echo "\tCode=".$api->errorCode."\n";
                echo "\tMsg=".$api->errorMessage."\n";
        } else {
            echo "Subscribed - look for the confirmation email!\n";
        }

        else :
            $html = '<form action="" method="post">';
            $html .= '<input type="text" placeholder="enter your email address..." name="email" />';
            $html .= '<input type="submit" value="Subscribe" />';
            $html .= '</form>';

            echo $html;

        endif;
        }

        add_shortcode('mailChimp', 'mailChimps');
        
        
        