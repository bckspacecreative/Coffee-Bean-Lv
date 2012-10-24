<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />  
        

        <link rel="stylesheet" href="<?php echo get_template_directory_uri();  ?>/includes/slider/css/nivo-slider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();  ?>/includes/slider/css/style.css" type="text/css" media="screen" />
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/includes/ie-styles/ie7.css" />
        <![endif]-->

	<?php wp_head(); ?>
</head>
<body>

         <div class="header-wrap">
                <div class="wrapper">
                    <div class="logo"><a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_option('company_logo'); ?>" border="0" alt="logo" /></a></div>
                    
                    <div class="navigation">
                        <?php wp_nav_menu( array( 'menu' => 'primary' )); ?>
                    </div><!-- end navigation -->
                </div> <!-- end wrapper -->
         </div><!-- end header wrap -->
         
         <p>This should be an issue </p>
<div class="">Lets resolve this coming conflict</div>
<div></div>

<p>I will commit both changes, some should be coming down from the upstream repo</p>
         
<!-- END HEADER -->



