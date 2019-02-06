<?php
add_action( 'wp_enqueue_scripts', function(){

    wp_enqueue_script('vendor-js', get_template_directory_uri() . '/assets/js/vendors.js');
    wp_enqueue_script('app', get_template_directory_uri() . '/app.js');
    wp_enqueue_style('css', get_template_directory_uri() . '/assets/css/application.css');
});

register_nav_menus(array(
    'top' => 'Верхнее меню'
));

function search_form_modify( $html ) {
    return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'search_form_modify' );

add_theme_support('widgets');
add_theme_support( 'post-thumbnails' );
add_theme_support( 'gallery' );

add_filter( 'excerpt_length', function(){
	return 35;
} );
add_filter('excerpt_more', function($more) {
	return '...';
});

function wp_sidebars() {

    register_sidebars(1,
        array('id' => 'products-sidebar',
            'name' => __('Боковая панель на странице товаров'),
            'description' => __( 'The first (primary) sidebar.'),
            'before_title' => '<h1>',
		    'after_title' => '</h1>'
        ));

}

add_action( 'widgets_init', 'wp_sidebars' );

remove_filter( 'the_content', 'wpautop' );

function dez_schema_breadcrumb() {
    global $post;
//schema link
    $schema_link = 'http://data-vocabulary.org/Breadcrumb';
    $home = 'Home';
    $delimiter = ' / ';
    $homeLink = get_bloginfo('url');
    if (is_home() || is_front_page()) {
// no need for breadcrumbs in homepage
    }
    else {
        echo '<div id="mpbreadcrumbs">';
// main breadcrumbs lead to homepage
        /*if (!is_single()) {
            echo 'You are here: ';
        }*/
        echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $homeLink . '">' . '<span itemprop="title">' . $home . '</span>' . '</a></span>' . $delimiter . ' ';
// if blog page exists
        if (get_page_by_path('blog')) {
            if (!is_page('blog')) {
                echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink(get_page_by_path('blog')) . '">' . '<span itemprop="title">Blog</span></a></span>' . $delimiter . ' ';
            }
        }
        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $category_link = get_category_link($thisCat->parent);
                echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $category_link . '">' . '<span itemprop="title">' . get_cat_name($thisCat->parent) . '</span>' . '</a></span>' . $delimiter . ' ';
            }
            $category_id = get_cat_ID(single_cat_title('', false));
            $category_link = get_category_link($category_id);
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $category_link . '">' . '<span itemprop="title">' . single_cat_title('', false) . '</span>' . '</a></span>';
        }
        elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $homeLink . '/' . $slug['slug'] . '">' . '<span itemprop="title">' . $post_type->labels->singular_name . '</span>' . '</a></span>';
                echo ' ' . $delimiter . ' ' . get_the_title();
            }
            else {
                $category = get_the_category();
                if ($category) {
                    foreach ($category as $cat) {
                        echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_category_link($cat->term_id) . '">' . '<span itemprop="title">' . $cat->name . '</span>' . '</a></span>' . $delimiter . ' ';
                    }
                }
                echo get_the_title();
            }
        }
        elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            echo $post_type->labels->singular_name;
        }
        elseif (is_attachment()) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            $cat = $cat[0];
            echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink($parent) . '">' . '<span itemprop="title">' . $parent->post_title . '</span>' . '</a></span>';
            echo ' ' . $delimiter . ' ' . get_the_title();
        }
        elseif (is_page() && !$post->post_parent) {
            $get_post_slug = $post->post_name;
            $post_slug = str_replace('-', ' ', $get_post_slug);
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink() . '">' . '<span itemprop="title">' . ucfirst($post_slug) . '</span>' . '</a></span>';
        }
        elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink($page->ID) . '">' . '<span itemprop="title">' . get_the_title($page->ID) . '</span>' . '</a></span>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . $delimiter . ' ';
            }
            echo $delimiter . '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_permalink() . '">' . '<span itemprop="title">' . the_title_attribute('echo=0') . '</span>' . '</a></span>';
        }
        elseif (is_tag()) {
            $tag_id = get_term_by('name', single_cat_title('', false), 'post_tag');
            if ($tag_id) {
                $tag_link = get_tag_link($tag_id->term_id);
            }
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . $tag_link . '">' . '<span itemprop="title">' . single_cat_title('', false) . '</span>' . '</a></span>';
        }
        elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_author_posts_url($userdata->ID) . '">' . '<span itemprop="title">' . $userdata->display_name . '</span>' . '</a></span>';
        }
        elseif (is_404()) {
            echo 'Error 404';
        }
        elseif (is_search()) {
            echo 'Search results for "' . get_search_query() . '"';
        }
        elseif (is_day()) {
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_year_link(get_the_time('Y')) . '">' . '<span itemprop="title">' . get_the_time('Y') . '</span>' . '</a></span>' . $delimiter . ' ';
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . '<span itemprop="title">' . get_the_time('F') . '</span>' . '</a></span>' . $delimiter . ' ';
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')) . '">' . '<span itemprop="title">' . get_the_time('d') . '</span>' . '</a></span>';
        }
        elseif (is_month()) {
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_year_link(get_the_time('Y')) . '">' . '<span itemprop="title">' . get_the_time('Y') . '</span>' . '</a></span>' . $delimiter . ' ';
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . '<span itemprop="title">' . get_the_time('F') . '</span>' . '</a></span>';
        }
        elseif (is_year()) {
            echo '<span itemscope itemtype="' . $schema_link . '"><a itemprop="url" href="' . get_year_link(get_the_time('Y')) . '">' . '<span itemprop="title">' . get_the_time('Y') . '</span>' . '</a></span>';
        }
        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }
        echo '</div>';
    }
}

function mayak_nav_menu_no_link($no_link){
	$gg_mk = '!<li(.*?)class="(.*?)current-menu-item(.*?)"><a(.*?)>(.*?)</a>!si';
	$dd_mk = '<li$1class="\\2current-menu-item\\3">$5';
	return preg_replace($gg_mk, $dd_mk, $no_link );

}
add_filter('wp_nav_menu', 'mayak_nav_menu_no_link');

add_action('wp_ajax_load_products', 'load_products_callback');
add_action('wp_ajax_nopriv_load_products', 'load_products_callback');
function load_products_callback(){
    if(!empty($_POST['id'])){
        $the_query = new WP_Query(array(
            'posts_per_page' => 20,
            'paged'=> $_POST['page'],
            'cat'    => $_POST['id'],
            'orderby'     => 'ID',
            'order'       => 'DESC',
            'post_type'   => 'product'
        ));
        while ( $the_query->have_posts() ) {
            $the_query->the_post(); ?>
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="products-grid__item">
                    <a href="<?php the_permalink(); ?>" class="products-grid__img">
                        <?php echo the_post_thumbnail(array(469, 362), array()); ?>
                    </a>
                    <a href="#" class="view popup-btn" data-mfp-src="#quick-view-popup">Quick view</a>
                </div>
            </div>
        <?php }
        wp_reset_postdata();

        if($the_query->max_num_pages > $_POST['page']) {
            ?>
            <div class="col-xs-12">
                <button class="button load-more" aria-hidden="false" data-id="<?php echo $_POST['id']; ?>"
                        data-page="<?php echo $_POST['page'] + 1; ?>"><span data-hook="user-free-text"
                                                                            class="user-free-text">LOAD MORE</span>
                </button>
            </div>
            <?php
        }
    }

    wp_die();
}

add_action('wp_ajax_quick_view', 'quick_view_callback');
add_action('wp_ajax_nopriv_quick_view', 'quick_view_callback');
function quick_view_callback(){
	if(!empty($_GET['id'])){
		$post = get_post($_GET['id']);
		?>
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-xs-12 quick-view-popup">
                    <div class="product-container">
                        <div class="product-container__img">
	                        <?php echo get_the_post_thumbnail($post, array(500, 500), array('data-zoom-image' => get_the_post_thumbnail_url( $post, 'full' ))); ?>
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                        <div class="product-container__descr">
                            <p class="articul">R01188</p>
                            <a class="button-learn-more" href="<?php echo get_the_permalink($post); ?>">View Full Details</a>
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
                            <button type="button" class="contact-to-purchase popup-btn" data-type="inline" data-mfp-src=".appointment-popup">Contact Us To Purchase</button>
                        </div>
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
                    </div>
                    <button title="Close (Esc)" type="button" class="mfp-close"></button>
                </div>
            </div>
        </div>
        <?php
	}

	wp_die();
}

add_action('init', 'my_custom_init');
function my_custom_init(){
    register_post_type('request', array(
        'labels'             => array(
            'name'               => 'Request',
            'singular_name'      => 'Requests',
            'add_new'            => 'Add new',
            'add_new_item'       => 'Add new request',
            'edit_item'          => 'Edit request',
            'new_item'           => 'New request',
            'view_item'          => 'View request',
            'search_items'       => 'Search request',
            'not_found'          => 'Not found',
            'not_found_in_trash' => 'Not found in trash',
            'parent_item_colon'  => '',
            'menu_name'          => 'Requests'

        ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'			 => 'dashicons-email-alt',
        'supports'           => array('title','editor')
    ) );
}

function product_gallery_output( $post ) {
    $attachments = get_post_meta($post->ID, '_product_image_gallery', 'true');
    if(!is_array($attachments))
        $attachments = explode(',', $attachments);
    wp_nonce_field( 'woocommerce_save_data', 'woocommerce_meta_nonce' );
    ?>
    <div id="product_images_container">
        <ul class="product_images">
            <?php
            $update_meta         = false;
            $updated_gallery_ids = array();

            if ( ! empty( $attachments ) ) {
                foreach ( $attachments as $attachment_id ) {
                    $attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );

                    // if attachment is empty skip.
                    if ( empty( $attachment ) ) {
                        $update_meta = true;
                        continue;
                    }

                    echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '">
								' . $attachment . '
								<ul class="actions">
									<li><a href="#" class="delete tips" data-tip="Delete image">Delete</a></li>
								</ul>
							</li>';

                    // rebuild ids to be saved.
                    $updated_gallery_ids[] = $attachment_id;
                }

                // need to update product meta to set new gallery ids
                if ( $update_meta ) {
                    update_post_meta( $post->ID, '_product_image_gallery', implode( ',', $updated_gallery_ids ) );
                }
            }
            ?>
        </ul>

        <input type="hidden" id="product_image_gallery" name="product_image_gallery" value="<?php echo esc_attr( implode( ',', $updated_gallery_ids ) ); ?>" />

    </div>
    <p class="add_product_images hide-if-no-js">
        <a href="#" data-choose="<?php esc_attr_e( 'Add images to product gallery', 'woocommerce' ); ?>" data-update="<?php esc_attr_e( 'Add to gallery', 'woocommerce' ); ?>" data-delete="<?php esc_attr_e( 'Delete image', 'woocommerce' ); ?>" data-text="<?php esc_attr_e( 'Delete', 'woocommerce' ); ?>"><?php _e( 'Add product gallery images', 'woocommerce' ); ?></a>
    </p>
    <style>
        #product-images .inside #product_images_container {
            padding: 0 0 0 9px;
            float: left;
            width: 100%;
        }
        #product-images .inside #product_images_container ul {
            margin: 0;
            padding: 0;
        }
        #product-images .inside #product_images_container ul::after, #product-images .inside #product_images_container ul::before {
            content: ' ';
            display: table;
        }
        #product-images .inside #product_images_container ul li.add, #product-images .inside #product_images_container ul li.image, #product-images .inside #product_images_container ul li.wc-metabox-sortable-placeholder {
            width: 75px;
            float: left;
            border: 1px solid #d5d5d5;
            margin: 9px 9px 0 0;
            background: #f7f7f7;
            border-radius: 2px;
            position: relative;
            box-sizing: border-box;
        }
        #product-images .inside #product_images_container ul li.add img, #product-images .inside #product_images_container ul li.image img, #product-images .inside #product_images_container ul li.wc-metabox-sortable-placeholder img {
            width: 100%;
            height: auto;
            display: block;
        }
        #product-images .inside #product_images_container ul ul.actions {
            position: absolute;
            top: -8px;
            right: -8px;
            padding: 2px;
            display: none;
        }
        #product-images .inside #product_images_container ul ul.actions li {
            float: right;
            margin: 0 0 0 2px;
        }
        #product-images .inside #product_images_container ul ul.actions li a.delete {
            display: block;
            text-indent: -9999px;
            position: relative;
            height: 1em;
            width: 1em;
            font-size: 1.4em;
        }
        #product-images .inside .add_product_images {
            padding: 0 12px 12px;
        }
        #product-images .inside #product_images_container ul li:hover ul.actions {
            display: block;
        }
        #product-images .inside #product_images_container ul ul.actions li a.delete::before {
            font-family: Dashicons;
            speak: none;
            font-weight: 400;
            font-variant: normal;
            text-transform: none;
            -webkit-font-smoothing: antialiased;
            margin: 0;
            text-indent: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            text-align: center;
            content: "";
            color: #999;
            background: #fff;
            border-radius: 50%;
            height: 1em;
            width: 1em;
            line-height: 1em;
        }
    </style>
    <script>
        jQuery(document).ready(function($){
            jQuery(document).on('click', '#product-images .inside #product_images_container ul ul.actions li a.delete', function(e){
                e.preventDefault();
                $(this).parents('.image').remove();
            });
            // Product gallery file uploads.
            var product_gallery_frame;
            var $image_gallery_ids = $( '#product_image_gallery' );
            var $product_images    = $( '#product_images_container' ).find( 'ul.product_images' );

            $( '.add_product_images' ).on( 'click', 'a', function( event ) {
                var $el = $( this );

                event.preventDefault();

                // If the media frame already exists, reopen it.
                if ( product_gallery_frame ) {
                    product_gallery_frame.open();
                    return;
                }

                // Create the media frame.
                product_gallery_frame = wp.media.frames.product_gallery = wp.media({
                    // Set the title of the modal.
                    title: $el.data( 'choose' ),
                    button: {
                        text: $el.data( 'update' )
                    },
                    states: [
                        new wp.media.controller.Library({
                            title: $el.data( 'choose' ),
                            filterable: 'all',
                            multiple: true
                        })
                    ]
                });

                // When an image is selected, run a callback.
                product_gallery_frame.on( 'select', function() {
                    var selection = product_gallery_frame.state().get( 'selection' );
                    var attachment_ids = $image_gallery_ids.val();

                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();

                        if ( attachment.id ) {
                            attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
                            var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

                            $product_images.append( '<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="#" class="delete" title="' + $el.data('delete') + '">' + $el.data('text') + '</a></li></ul></li>' );
                        }
                    });

                    $image_gallery_ids.val( attachment_ids );
                });

                // Finally, open the modal.
                product_gallery_frame.open();
            });

            // Image ordering.
            $product_images.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity: 40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'wc-metabox-sortable-placeholder',
                start: function( event, ui ) {
                    ui.item.css( 'background-color', '#f6f6f6' );
                },
                stop: function( event, ui ) {
                    ui.item.removeAttr( 'style' );
                },
                update: function() {
                    var attachment_ids = '';

                    $( '#product_images_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
                        var attachment_id = $( this ).attr( 'data-attachment_id' );
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $image_gallery_ids.val( attachment_ids );
                }
            });

            // Remove images.
            $( '#product_images_container' ).on( 'click', 'a.delete', function() {
                $( this ).closest( 'li.image' ).remove();

                var attachment_ids = '';

                $( '#product_images_container' ).find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
                    var attachment_id = $( this ).attr( 'data-attachment_id' );
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $image_gallery_ids.val( attachment_ids );

                // Remove any lingering tooltips.
                $( '#tiptip_holder' ).removeAttr( 'style' );
                $( '#tiptip_arrow' ).removeAttr( 'style' );

                return false;
            });
        });
    </script>
    <?php
}
add_action('add_meta_boxes', 'myplugin_add_custom_box');
function myplugin_add_custom_box(){
    add_meta_box( 'product-images', 'Product gallery', 'product_gallery_output', 'product', 'side', 'low' );
}

function product_gallery_save( $post_id, $post ) {
    if(!empty($_POST['product_image_gallery'])) {
        $attachment_ids = isset($_POST['product_image_gallery']) ? explode(',', $_POST['product_image_gallery']) : array();
        update_post_meta($post_id, '_product_image_gallery', $attachment_ids);
    }
}
add_action( 'save_post', 'product_gallery_save', 20, 2 );

function change_posttype($query) {
    if(!empty($query->query['category_name']) && $query->query['category_name'] !== 'blog'){
        set_query_var( 'post_type', 'product' );
        set_query_var( 'posts_per_page', 20 );
    }
}
add_action('pre_get_posts', 'change_posttype', 1 );
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    return '
	<nav class="navigation %1$s" role="navigation">
		<div class="pagination">%3$s</div>
	</nav>    
	';
}