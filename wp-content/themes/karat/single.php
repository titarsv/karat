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

<section>
    <div class="visible-xs-block col-xs-12 blog__sort-block">
        <div class="blog__sort-log-container">
            <span>Blog</span>
            <div>
                <img src="<?php echo get_template_directory_uri();?>/images/icon/search-w.png" class="seacher-icon" alt="">
                <a href="./become-a-member.html" class="user-icon">
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/users-w.png" alt="">
                </a>
                <a href="" class="popup-btn sign-up-btn__mobile" data-mfp-src="#sign-up-popup">Sign up</a>
            </div>
        </div>
    </div>
    <div class="visible-xs-block col-xs-12">
        <div class="custom-select">
            <select class="chosen-select" name="select-custom-1" id="select-custom-1" data-native-menu="false">
                <option value="" selected>All Posts</option>
                <option value="">Your Community</option>
                <option value="">Getting Started</option>
            </select>
        </div>
    </div>
    <div class="container blog__container">
        <div class="blog__sort-log-container hidden-xs">
            <div class="blog__sorting hidden-xs">
                <a href="#" class="active">All Posts</a>
                <a href="#">Your Community</a>
                <a href="#">Getting Started</a>
            </div>
            <div class="blog__search-login">
                <div class="search-wrp">
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/search.png" class="seacher-icon" alt="">
                    <div class="search">
                        <input type="search" class="search-input" placeholder="Search"  >
                        <img src="<?php echo get_template_directory_uri();?>/images/icon/delete.png" class="close-search-icon" alt="">
                    </div>
                </div>
                <a href="./become-a-member.html" class="user-icon">
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/users.png" alt="">
                </a>
                <a href="" class="sign-up-btn popup-btn" data-mfp-src="#sign-up-popup">Login / Sign up</a>
            </div>
        </div>
        <div class="article__item">
            <div class="blog__item-text">
                <div class="blog__item-author-date">
                    <a href="/" class="blog__item-author"> The Karat Shop</a>
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/crown.png" class="post-author" alt="">
                    <div class="blog__item-post-date">
                        <span>•</span>
                        <span class="blog__item-little-text"><?php the_date('M d', '', ''); ?></span>
                        <span>•</span>
                        <span class="blog__item-little-text">2 min</span>
                    </div>
                </div>
                <span class="blog__item-title"><?php the_title() ?></span>
                <div class="article__img">
                    <?php the_post_thumbnail('full', array()); ?>
                </div>
                <?php the_content(); ?>
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
                <div class="blog__item-info">
                    <div>
<!--                        <span class="blog__item-little-text">7 views</span>-->
                    </div>

                    <?php wpfp_link() ?>

<!--                    <a href="#" class="blog__item-info-like"><img src="--><?php //echo get_template_directory_uri();?><!--/images/icon/heart.png" alt=""></a>-->
                </div>
                <div class="share-icon">
                    <span>•</span>
                    <span>•</span>
                    <span>•</span>
                </div>
                <div class="share-post popup-btn" data-mfp-src="#share-popup">
                    <a href="">
                        <img src="<?php echo get_template_directory_uri();?>/images/icon/share.png" alt="">
                        <span>Share Post</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="recent-post">
            <div class="row">
                <div class="title__wrp">
                    <p>Recen Posts</p>
                    <a href="/category/blog/">See All</a>
                </div>

                <?php
                    $args = array(
                    'numberposts' => 3,
                    'offset' => 0,
                    'category' => 0,
                    'exclude' => get_the_ID(),
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'suppress_filters' => true );

                    $recent = wp_get_recent_posts( $args, OBJECT );
                ?>

                <?php foreach($recent as $p){ ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="recent__item">
                            <?php echo get_the_post_thumbnail($p, array(469, 362), array('class' => 'main-img')); ?>
                            <div class="text__wrp">
                                <a href="<?php echo get_the_permalink($p); ?>" class="title"><?php echo get_the_title($p); ?></a>
                                <?php if(!has_post_thumbnail( $p->ID )){ ?>
                                <div class="text"><?php echo get_the_excerpt($p); ?></div>
                                <?php } ?>
                                <div class="blog__item-info">
                                    <div>
                                        <span class="blog__item-little-text"> <img src="<?php echo get_template_directory_uri();?>/images/icon/eye.png" alt=""> 7</span>
                                        <a href="<?php echo get_the_permalink($p); ?>" class="blog__item-little-text">Write a comment</a>
                                    </div>
                                    <a href="<?php echo get_the_permalink($p); ?>" class="blog__item-info-like"><img src="<?php echo get_template_directory_uri();?>/images/icon/heart.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="article__login">
            <a href="" class="popup-btn" data-mfp-src="#login-popup">Log in </a> <p> to leave a comment!</p>
        </div>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>

