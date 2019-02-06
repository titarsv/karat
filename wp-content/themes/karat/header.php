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
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri();?>/images/favicon.png" type="image/png">
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

    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129603342-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-129603342-1');
        </script>

    <!-- Global site tag (gtag.js) - Google Ads: 777258363 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=AW-777258363"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'AW-777258363');
        </script>

        <script>
        gtag('event', 'page_view', {
        'send_to': 'AW-777258363',
        'user_id': 'replace with value'
        });
        </script>
    <style>
        .header{padding-top: 50px;}
        .logo-descr{color: #fff; font-size: 14px; font-family: Overlock,cursive; text-align:center}
        .header-address{text-align:right; font-size:16px; color:#fff; font-family: Overlock,cursive; font-weight:bold; list-style:none;}
        .header-address a{text-decoration:none; color: #fff;}
        .call-back-btn{font-size: 16px; transition: color .4s ease 0s; color: #fff; white-space: nowrap; font-family: Overlock,sans-serif; background-color: #53c073; border: 2px solid #16582c; cursor: pointer; padding: 9px 55px; float:right;}
        .call-back-btn:hover{color:#fff; text-decoration:none;background-color: #43a35f;}
        .collection-btn{padding: 7px 17px; font-size: 16px;}
        .left .slick-arrow{ position: absolute; width: 30px; height: 30px; background: no-repeat; font-size: 0; color: transparent; text-align: center; padding: 0; z-index: 1; border: none; outline:none;}
        .left .slick-arrow::before{
        content: "";
        display: inline-block;
        border-top: 3px solid rgba(128,62,101,.77);
        border-left: 3px solid rgba(128,62,101,.77);
        width: 20px;
        height: 20px;
        }
        .left .slick-prev{
            top: 50%;
            margin-top: -10px;
            left: 0;
            transform: rotate(-46deg);
        }
        .left .slick-next{
            top: 50%;
            margin-top: -10px;
            right: 6px;
            transform: rotate(-223deg);
        }
        .collection_row .left img{margin: 0 auto; width: 100%; height: 100%;}
        @media screen and (max-width: 991px){.collection_row .left img{margin: 0 auto;}}
        @media screen and (max-width: 768px) { 
            .logo-descr{text-align: left; font-size: 12px;}
            .header{ padding-top: 10px;}
            .header-address{font-size:12px; text-align: left;}
            .header-address-btn-wrp{display:flex; align-items:flex-start; justify-content: space-between;}
            .call-back-btn{float:none; padding:9px 35px;}
            .header-address{padding:0;}
            .mobile-menu .nav li, .mobile-menu .nav li>a{text-align:center;}
        }
        @media screen and (max-width: 480px){.collection_row .left img{width: 70px; height: 70px;}}
        .contant-form.popup-form{width: 100%}
        .bridal-collection__coming-soon-container div:first-child{
            position: relative;
            z-index: 1;
        }
        .bridal-collection__coming-soon-container div:first-child a{
            color: #803e65;
        }
        .bridal-collection__coming-soon-container div:first-child a:hover{
            color: #e3d9b1;
            text-decoration: none;
        }
        .contacts__list li a{
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
        }
        .seo-h2 {
            font-size: 30px;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #000;
            font-weight: bold;
            text-align: center;
            font-family: Overlock,sans-serif;
        }

        .seo-h3 {
            font-size: 25px;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #000;
            font-weight: bold;
            font-family: Overlock,sans-serif;
        }

        .blue {
            color: #000;
        }

        .seo-p {
            font-size: 14px;
            line-height: 18px;
            margin-bottom: 15px;
            color: #000;
        }

        .seo-list {
            padding-right: 15px;
            font-size: 14px;
            line-height: 18px;
            margin-bottom: 15px;
            list-style: none;
        }

        .seo-list li {
            margin-bottom: 10px;
        }

        .disc {
            list-style: disc;
        }
        .category-description{
            background: #fff;
        }
        .breadcrumbs a{
            font-size: 15px;
        }
        .breadcrumbs a.active{
            opacity: 1;
            font-weight: bold;
        }
        .breadcrumbs.about{
            padding: 10px 25px;
            background-color: rgba(47,46,46,.81);
        }
        .breadcrumbs.white a, .breadcrumbs.white span{
            color: #fff;
        }
    </style>
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
                <div class="col-md-5 col-sm-7 col-xs-9">
                    <a href="/">
                        <img  class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.jpg" alt="">
                    </a>
                    <p class="logo-descr"><span>Diamond Jewelry Store.</span><br>Engagement & Wedding Rings Shop in Huntington Station, Long Island NY 11746</p>
                </div>
                <div class="col-md-7 col-sm-5 hidden-xs">
                    <ul class="header-address">
                        <li> <a href="tel:+1 (631) 271-5151">+1 (631) 271-5151</a> </li>
                        <li>102 W. Jericho Tpke</li>
                        <li>Huntington Station, NY 11746</li>
                    </ul>
                    <a href="#callback-popup" class="call-back-btn popup-btn">CALL BACK</a>
                </div>
                <div class="visible-xs block col-xs-3">
                    <div class="burger-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div class="visible-xs block col-xs-12">
                    <div class="header-address-btn-wrp">
                        <ul class="header-address">
                            <li> <a href="tel:+1 (631) 271-5151">+1 (631) 271-5151</a> </li>
                            <li>102 W. Jericho Tpke</li>
                            <li>Huntington Station, NY 11746</li>
                        </ul>
                        <a href="/contact-us/" class="call-back-btn">CALL BACK</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-sm-offset-0 hidden-xs nav-soc-wrp">
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
