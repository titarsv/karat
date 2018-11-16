<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php
    $post_categories = get_the_category(get_the_ID());
    if(!empty($post_categories)){
        $cat = end($post_categories);
    }
?>

    <section>
        <div class="container product__container">
            <div class="visible-xs-block">
                <a href="" class="back-to__link">Back to Rings</a>
            </div>
            <div class="brearcrumbs-nav__wrp hidden-xs">
                <div class="breadcrumbs">
                    <a href="/">Home</a>
                    <?php if(!empty($cat)){ ?>
                    <span>/</span>
                    <a href="<?php echo get_category_link($cat); ?>"><?php echo $cat->name; ?></a>
                    <?php } ?>
                    <span>/</span>
                    <a href="#" class="active"><?php the_title(); ?></a>
                </div>
                <div class="product-navigation">
	                <?php echo str_replace('<a', '<a class="prev"', get_previous_post_link('%link', 'Prev', true)); ?>
                    <span>|</span>
	                <?php echo str_replace('<a', '<a class="next"',get_next_post_link('%link', 'Next', true)); ?>
                </div>
            </div>
            <div class="product-container">
                <div class="product-container__img">
                    <?php the_post_thumbnail(array(500, 500), array('data-zoom-image' => get_the_post_thumbnail_url( $post, 'full' ))); ?>
                    <i class="glyphicon glyphicon-search"></i>
                </div>
                <div class="product-container__descr">
                    <p class="articul"><?php the_title(); ?></p>
                    <div class="quont">
                        <label for="quont" class="custom-label">Quantity</label>
                        <div class="quont-wrp">
                            <input type="text" id="quont" value="1" size="5"/>
                            <div class="plus-minus-wrp">
                                <span class="plus"></span>
                                <span class="minus"></span>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="contact-to-purchase popup-btn" data-mfp-src=".appointment-popup">Contact Us To Purchase</button>
                    <div class="socials-links">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
                            <img src="<?php echo get_template_directory_uri();?>/images/icon/1.svg" alt="facebook">
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>&via=TWITTER-HANDLE">
                            <img src="<?php echo get_template_directory_uri();?>/images/icon/2.jpg" alt="twitter">
                        </a>
                        <a href="https://plus.google.com/share?url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
                            <img src="<?php echo get_template_directory_uri();?>/images/icon/3.png" alt="google">
                        </a>
                        <a href="https://pinterest.com/pin/create/button/?url=<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>&description=<?php the_title(); ?>&media=<?php echo get_the_post_thumbnail_url( $post, 'full' ); ?>">
                            <img src="<?php echo get_template_directory_uri();?>/images/icon/4.svg" alt="pinterest">
                        </a>
                        <a href="javascript:void(0)">
                            <img src="<?php echo get_template_directory_uri();?>/images/icon/5.png" alt="fancyit">
                            <script type="text/javascript" src="//fancy.com/fancyit/v2/fancyit.js" id="fancyit" async="async" data-title="Karat" data-item="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" data-image="<?php echo get_template_directory_uri();?>/images/icon/5.png" data-caetgory="Other" data-count="right"></script>
                        </a>
                    </div>
                </div>
            </div>
            <div class="product__charact">
                <?php the_content() ?>
            </div>
            <div class="visible-xs-block">
                <div class="product-navigation">
		            <?php echo str_replace('<a', '<a class="prev"', get_previous_post_link('%link', 'Prev', true)); ?>
                    <span>|</span>
		            <?php echo str_replace('<a', '<a class="next"',get_next_post_link('%link', 'Next', true)); ?>
                </div>
            </div>
        </div>
    </section>

    <div class="mfp-hide">
        <div class="popup appointment-popup">
            <span class="popup-title">Enter your contact details</span>
            <form class="popup-form pbz_form clear-styles" data-error-title="Error sending!" data-error-message="Try to send the application after a while." data-success-title="Thank you!" data-success-message="Our manager will contact you soon.">
                <input type="hidden" name="product" data-title="Product" value="<?php the_title(); ?>">
                <div class="popup-form__input-wrapper">
                    <input class="popup-form__input" type="text" name="name" placeholder="Name" data-title="Name" data-validate-required="Required field">
                </div>
                <div class="popup-form__input-wrapper">
                    <input class="popup-form__input" type="text" name="email" placeholder="E-mail" data-title="E-mail" data-validate-required="Required field" data-validate-email="Not valid email">
                </div>
                <div class="popup-form__input-wrapper">
                    <input class="popup-form__input" type="text" name="phone" placeholder="Phone" data-title="Phone" data-validate-required="Required field" data-validate-phone="Not valid phone">
                </div>
                <button class="popup-form__btn btn" type="submit">Send</button>
            </form>
        </div>
    </div>

<?php endwhile; ?>

<?php get_footer(); ?>

