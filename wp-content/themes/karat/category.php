<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<?php if(single_term_title('', false) == 'Blog'){ ?>
<section>
    <div class="visible-xs-block col-xs-12 blog__sort-block">
        <div class="blog__sort-log-container">
            <span>Blog</span>
            <div>
                <img src="<?php echo get_template_directory_uri();?>/images/icon/search-w.png" class="seacher-icon" alt="">
                <a href="#" class="user-icon">
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/users-w.png" alt="">
                </a>
                <a href="#" class="popup-btn sign-up-btn__mobile" data-mfp-src="#sign-up-popup">Sign up</a>
            </div>
        </div>
    </div>
    <div class="visible-xs-block col-xs-12">
        <div class="custom-select">
            <select class="chosen-select" name="select-custom-1" id="select-custom-1" data-native-menu="false">
                <option value="/blog/" selected>All Posts</option>
<!--                <option value="">Your Community</option>-->
<!--                <option value="">Getting Started</option>-->
            </select>
        </div>
    </div>
    <div class="container blog__container">
        <div class="blog__sort-log-container hidden-xs">
            <div class="blog__sorting hidden-xs">
                <a href="/blog/" class="active">All Posts</a>
<!--                <a href="#">Your Community</a>-->
<!--                <a href="#">Getting Started</a>-->
            </div>
            <div class="blog__search-login">
                <div class="search-wrp">
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/search.png" class="seacher-icon" alt="">
                    <div class="search">
                        <input type="search" class="search-input" placeholder="Search"  >
                        <img src="<?php echo get_template_directory_uri();?>/images/icon/delete.png" class="close-search-icon" alt="">
                    </div>
                </div>
                <a href="#" class="user-icon">
                    <img src="<?php echo get_template_directory_uri();?>/images/icon/users.png" alt="">
                </a>
                <a href="" class="sign-up-btn popup-btn" data-mfp-src="#sign-up-popup">Login / Sign up</a>
            </div>
        </div>
        <?php if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                ?>

                <div class="blog__item">
                    <?php the_post_thumbnail(array(469, 362), array('class' => 'blog__item-img')); ?>
                    <div class="blog__item-text">
                        <div class="blog__item-author-date">
                            <a href="<?php the_permalink(); ?>" class="blog__item-author"> The Karat Shop</a>
                            <img src="<?php echo get_template_directory_uri();?>/images/icon/crown.png" class="post-author">
                            <div class="post-author-hover">Admin</div>
                            <div class="blog__item-post-date">
                                <span class="blog__item-little-text">Jun 20</span>
                                <span>•</span>
                                <span class="blog__item-little-text">2 min</span>
                            </div>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="blog__item-link-wrp">
                            <span class="blog__item-title"><?php the_title(); ?></span>
                            <span><?php the_excerpt(); ?></span>
                        </a>
                        <div class="blog__item-info">
                            <div>
                                <span class="blog__item-little-text">7 views</span>
                                <a href="<?php the_permalink(); ?>" class="blog__item-little-text">Write a comment</a>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="blog__item-info-like"><img src="<?php echo get_template_directory_uri();?>/images/icon/heart.png" alt=""></a>
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

            <?php
            endwhile;

        else :

        endif;
        ?>
    </div>
</section>
<?php }else{ ?>
<?php
    $term = get_queried_object();
    $posts = get_posts(array(
        'numberposts' => 20,
        'category'    => $term->term_id,
        'orderby'     => 'ID',
        'order'       => 'DESC',
        'post_type'   => 'product',
        'suppress_filters' => true
    ));
?>
    <section>
        <div class="container products-grid">
            <div class="breadcrumbs">
				<?php dez_schema_breadcrumb(); ?>
            </div>
            <div class="row" id="products_wrap">
                <?php if ( have_posts() ) :
					while ( have_posts() ) :
						the_post();
						?>
						<div class="col-md-3 col-sm-4 col-xs-12">
							<div class="products-grid__item">
								<a href="<?php the_permalink(); ?>" class="products-grid__img">
									<?php the_post_thumbnail(array(469, 362), array()); ?>
								</a>
								<a href="#" data-mfp-src="/wp-admin/admin-ajax.php?action=quick_view&id=<?php the_ID(); ?>" data-type="ajax" class="view popup-btn">Quick view</a>
							</div>
						</div>
					<?php
					endwhile;
				endif;
				?>
                <div class="col-xs-12">
                    <!-- <button class="button load-more" aria-hidden="false" data-id="<?php echo $term->term_id; ?>" data-page="2"><span data-hook="user-free-text" class="user-free-text">LOAD MORE</span></button> -->
					<?php echo str_replace('page-numbers', 'button load-more', get_the_posts_pagination(array(
                        'prev_next'    => false,
                    ))); ?>
                    <!-- <div class="pagination">
                        <button class="button load-more" aria-hidden="false" data-id="1" data-page="1"><span data-hook="user-free-text" class="user-free-text">1</span></button>
                        <button class="button load-more" aria-hidden="false" data-id="9" data-page="2"><span data-hook="user-free-text" class="user-free-text">2</span></button>
                        <button class="button load-more" aria-hidden="false" data-id="18" data-page="3"><span data-hook="user-free-text" class="user-free-text">3</span></button>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="category-description">
                        <?php echo category_description(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!--    <script>-->
<!--        jQuery(document).ready(function($){-->
<!--            $('body').on('click', '.load-more', function(){-->
<!--                var $this = $(this);-->
<!--                $.post('/wp-admin/admin-ajax.php', {'action':'load_products', 'id':$this.data('id'), 'page':$this.data('page')}, function(response){-->
<!--                    $('#products_wrap').append($(response));-->
<!--                    $this.parent().remove();-->
<!--                });-->
<!--            });-->
<!--        });-->
<!--    </script>-->
<?php } ?>

<?php get_footer(); ?>
