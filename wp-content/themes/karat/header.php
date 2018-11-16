<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--    <link rel="shortcut icon" href="--><?php //echo get_template_directory_uri();?><!--/images/favicon.png" type="image/png">-->
<!--    <link href="//db.onlinewebfonts.com/c/7e0a3cd758938b211aa2fba1ba2984cc?family=ArianLT-Light" rel="stylesheet">-->
    <style>
        @font-face {font-family: "ArianLT-Light";
            src: url("http://db.onlinewebfonts.com/t/7e0a3cd758938b211aa2fba1ba2984cc.eot"); /* IE9*/
            src: url("http://db.onlinewebfonts.com/t/7e0a3cd758938b211aa2fba1ba2984cc.eot?#iefix") format("embedded-opentype"), /* IE6-IE8 */
            url("http://db.onlinewebfonts.com/t/7e0a3cd758938b211aa2fba1ba2984cc.woff2") format("woff2"), /* chrome firefox */
            url("http://db.onlinewebfonts.com/t/7e0a3cd758938b211aa2fba1ba2984cc.woff") format("woff"), /* chrome firefox */
            url("http://db.onlinewebfonts.com/t/7e0a3cd758938b211aa2fba1ba2984cc.ttf") format("truetype"), /* chrome firefox opera Safari, Android, iOS 4.2+*/
            url("http://db.onlinewebfonts.com/t/7e0a3cd758938b211aa2fba1ba2984cc.svg#ArianLT-Light") format("svg"); /* iOS 4.1- */
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Overlock" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Spinnaker" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body id='body' <?php body_class(); ?>>
    <div class="main-wrapper">
    <div class="siteBackground-container">
        <div class="siteBackground"></div>
    </div>
    <?php //echo do_shortcode('[yo-login id="803" title="Login"]'); ?>
    <?php //echo do_shortcode('[yo-register id="834" title="Register"]'); ?>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="visible-xs-block col-xs-12">
                    <div class="social-links">
                        <a href="https://www.facebook.com/TheKaratShop/"><img src="<?php echo get_template_directory_uri();?>/images/icon/fb.jpg" alt=""></a>
                        <a href="https://www.instagram.com/thekaratshop/"><img src="<?php echo get_template_directory_uri();?>/images/icon/inst.jpg" alt=""></a>
                        <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/icon/yt.jpg" alt=""></a>
                        <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/icon/g.jpg" alt=""></a>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-9">
                    <a href="/">
                        <img  class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.jpg" alt="">
                    </a>
                </div>
                <div class="visible-xs block col-xs-3">
                    <div class="burger-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-2 col-sm-12 col-sm-offset-0 hidden-xs nav-soc-wrp">
	            <?php wp_nav_menu(array(
		            'menu' => 'Menu',
		            'menu_class' => 'navigation',
		            'container' => false,
		            'items_wrap' => '<nav id="%1$s" class="nav %2$s">%3$s</nav>',
		            'depth' => 2
	            )); ?>
                <div class="social-links">
                    <a href="ttps://www.facebook.com/TheKaratShop/"><img src="<?php echo get_template_directory_uri();?>/images/icon/fb.jpg" alt=""></a>
                    <a href="https://www.instagram.com/thekaratshop/"><img src="<?php echo get_template_directory_uri();?>/images/icon/inst.jpg" alt=""></a>
                    <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/icon/yt.jpg" alt=""></a>
                    <a href="#"><img src="<?php echo get_template_directory_uri();?>/images/icon/g.jpg" alt=""></a>
                </div>
            </div>
        </div>
        <div class="mobile-menu">
	        <?php wp_nav_menu(array(
		        'menu' => 'Menu',
		        'menu_class' => 'navigation',
		        'container' => false,
		        'items_wrap' => '<nav id="%1$s" class="nav %2$s">%3$s</nav>',
		        'depth' => 2
	        )); ?>
        </div>
    </header>
