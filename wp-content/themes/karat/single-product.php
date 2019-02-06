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
    $form_type = 0;
    foreach($post_categories as $category){
        if($category->name == 'Engagement Rings'){
            $form_type = 1;
            break;
        }elseif($category->name == 'Bracelets'){
            $form_type = 2;
            break;
        }elseif($category->name == 'Necklaces'){
            $form_type = 3;
            break;
        }elseif($category->name == 'Earrings'){
            $form_type = 4;
            break;
        }elseif($category->name == 'Wedding Rings'){
            $form_type = 5;
            break;
        }
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
                <div style="width: 500px;height: auto;position: relative;">
                    <?php
                    $attachments = get_post_meta($post->ID, '_product_image_gallery', 'true');
                    if(!is_array($attachments))
                        $attachments = explode(',', $attachments);
                    ?>
                    <?php if ( ! empty( $attachments ) && ! empty( $attachments[0] ) ) { ?>
                    <div class="productContainer-img product-slider">
                        <?php foreach ( $attachments as $i => $attachment_id ) {
                            $full = wp_get_attachment_image_src($attachment_id, 'full', false);
                            $attachment = wp_get_attachment_image( $attachment_id, array(500, 500), false, array('data-zoom-image' => $full[0], 'id' => "image-$i", 'class' => "gallery-image") );
                            ?>
                            <div class="product-container__img">
                                <?php echo $attachment; ?>
                                <i class="glyphicon glyphicon-search"></i>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="product-nav">
                        <?php
                            foreach ( $attachments as $attachment_id ) {
                                $attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );
                                echo '<div class="image" style="cursor:pointer;" data-attachment_id="' . esc_attr( $attachment_id ) . '">
                                ' . $attachment . '
                                </div>';
                            }
                        ?>
                    </div>
                    <?php }else{ ?>
                        <div class="product-container__img">
                            <?php the_post_thumbnail(array(500, 500), array('data-zoom-image' => get_the_post_thumbnail_url( $post, 'full' ))); ?>
                            <i class="glyphicon glyphicon-search"></i>
                        </div>
                    <?php } ?>
                </div>
                <div class="product-container__descr" style="max-width: calc(100% - 500px);width: 450px;">
                    <p class="articul"><?php the_title(); ?></p>
                    <form action="">
                        <?php
                            if($form_type == 0){ ?>
                                <div class="quont">
                                    <label for="quont" class="custom-label">Quantity</label>
                                    <div class="quont-wrp">
                                        <input name="quantity" data-title="Quantity" type="text" id="quont" value="1" size="5"/>
                                        <div class="plus-minus-wrp">
                                            <span class="plus"></span>
                                            <span class="minus"></span>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="contact-to-purchase popup-btn" data-mfp-src=".appointment-popup">Contact Us To Purchase</button>
                            <?php }elseif($form_type == 1){ ?>
                                <div id="base" class="">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p><span>Ring Size</span></p>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="ring_size" data-title="Ring Size">
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <p><span>Sizing Detail</span></p>
                                        </div>
                                        <div class="col-sm-3">
                                            <select name="sizing_detail" data-title="Sizing Detail">
                                                <option value="1/2">1/2</option>
                                                <option value="1/4">1/4</option>
                                                <option value="3/4">3/4</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p><span>Metal Type</span></p>
                                        </div>
                                        <div class="col-xs-8">
                                            <select name="metal_type" data-title="Metal Type">
                                                <option value="10 kt">10 kt</option>
                                                <option value="14 kt">14 kt</option>
                                                <option value="18 kt">18 kt</option>
                                                <option value="Silver">Silver</option>
                                                <option value="Platinum">Platinum</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p><span>Metal Color</span></p>
                                        </div>
                                        <div class="col-xs-8">
                                            <select name="metal_color" data-title="Metal Color">
                                                <option value="White">White</option>
                                                <option value="Yellow">Yellow</option>
                                                <option value="Pink">Pink</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p><span>Diamond Quality</span></p>
                                        </div>
                                        <div class="col-xs-8">
                                            <select name="diamond_quality" data-title="Diamond Quality">
                                                <option value="VS-1VS2. F-G">VS-1VS2. F-G</option>
                                                <option value="Sl1, G">Sl1, G</option>
                                                <option value="Sl1-sl2, G-H">Sl1-sl2, G-H</option>
                                                <option value="Sl2, H-I">Sl2, H-I</option>
                                                <option value="L1, H-I">L1, H-I</option>
                                                <option value="L2, H-I">L2, H-I</option>
                                                <option value="CHAMPAGNE">CHAMPAGNE</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-4">
                                            <p><span>Quality</span></p>
                                        </div>
                                        <div class="col-xs-8">
                                            <select name="quality" data-title="Quality">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p><span>Comments</span></p>
                                        </div>
                                        <div class="col-xs-12">
                                            <textarea name="comments" data-title="Comments" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button type="button" class="contact-to-purchase popup-btn" data-mfp-src=".appointment-popup">Contact Us To Purchase</button>
                                        </div>
                                    </div>
                                </div>
                            <?php }elseif($form_type == 2){ ?>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Availabily</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="availabily" data-title="Availabily">
                                            <option value="11 cttw (4.1 mm)">11 cttw (4.1 mm)</option>
                                            <option value="11.5 cttw (4.2 mm)">11.5 cttw (4.2 mm)</option>
                                            <option value="13.5 cttw (4.5 mm)">13.5 cttw (4.5 mm)</option>
                                            <option value="2.5 cttw (2.0 mm)">2.5 cttw (2.0 mm)</option>
                                            <option value="3 cttw (2.2 mm)">3 cttw (2.2 mm)</option>
                                            <option value="4 cttw (2.5 mm)">4 cttw (2.5 mm)</option>
                                            <option value="4.5 cttw (2.8 mm)">4.5 cttw (2.8 mm)</option>
                                            <option value="6 cttw (3.1 mm)">6 cttw (3.1 mm)</option>
                                            <option value="6.25 cttw (3.2 mm)">6.25 cttw (3.2 mm)</option>
                                            <option value="8 cttw (3.5 mm)">8 cttw (3.5 mm)</option>
                                            <option value="9 cttw (3.8 mm)">9 cttw (3.8 mm)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Metal Type</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="metal_type" data-title="Metal Type">
                                            <option value="10 kt">10 kt</option>
                                            <option value="14 kt">14 kt</option>
                                            <option value="18 kt">18 kt</option>
                                            <option value="Silver">Silver</option>
                                            <option value="Platinum">Platinum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Metal Color</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="metal_color" data-title="Metal Color">
                                            <option value="White">White</option>
                                            <option value="Yellow">Yellow</option>
                                            <option value="Pink">Pink</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Diamond Quality</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="diamond_quality" data-title="Diamond Quality">
                                            <option value="VS-1VS2. F-G">VS-1VS2. F-G</option>
                                            <option value="Sl1, G">Sl1, G</option>
                                            <option value="Sl1-sl2, G-H">Sl1-sl2, G-H</option>
                                            <option value="Sl2, H-I">Sl2, H-I</option>
                                            <option value="L1, H-I">L1, H-I</option>
                                            <option value="L2, H-I">L2, H-I</option>
                                            <option value="CHAMPAGNE">CHAMPAGNE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Quality</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="quality" data-title="Quality">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p><span>Comments</span></p>
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea name="comments" data-title="Comments" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" class="contact-to-purchase popup-btn" data-mfp-src=".appointment-popup">Contact Us To Purchase</button>
                                    </div>
                                </div>
                            <?php }elseif($form_type == 3){ ?>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Variation</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="variation" data-title="Variation">
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="2">2</option>
                                            <option value="20">20</option>
                                            <option value="25">25</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Metal Type</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="metal_type" data-title="Metal Type">
                                            <option value="10 kt">10 kt</option>
                                            <option value="14 kt">14 kt</option>
                                            <option value="18 kt">18 kt</option>
                                            <option value="Silver">Silver</option>
                                            <option value="Platinum">Platinum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Metal Color</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="metal_color" data-title="Metal Color">
                                            <option value="White">White</option>
                                            <option value="Yellow">Yellow</option>
                                            <option value="Pink">Pink</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Diamond Quality</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="diamond_quality" data-title="Diamond Quality">
                                            <option value="VS-1VS2. F-G">VS-1VS2. F-G</option>
                                            <option value="Sl1, G">Sl1, G</option>
                                            <option value="Sl1-sl2, G-H">Sl1-sl2, G-H</option>
                                            <option value="Sl2, H-I">Sl2, H-I</option>
                                            <option value="L1, H-I">L1, H-I</option>
                                            <option value="L2, H-I">L2, H-I</option>
                                            <option value="CHAMPAGNE">CHAMPAGNE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Quality</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="quality" data-title="Quality">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p><span>Comments</span></p>
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea name="comments" data-title="Comments" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" class="contact-to-purchase popup-btn" data-mfp-src=".appointment-popup">Contact Us To Purchase</button>
                                    </div>
                                </div>
                            <?php }elseif($form_type == 4){ ?>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Metal Type</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="metal_type" data-title="Metal Type">
                                            <option value="10 kt">10 kt</option>
                                            <option value="14 kt">14 kt</option>
                                            <option value="18 kt">18 kt</option>
                                            <option value="Silver">Silver</option>
                                            <option value="Platinum">Platinum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Metal Color</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="metal_color" data-title="Metal Color">
                                            <option value="White">White</option>
                                            <option value="Yellow">Yellow</option>
                                            <option value="Pink">Pink</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Diamond Quality</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="diamond_quality" data-title="Diamond Quality">
                                            <option value="VS-1VS2. F-G">VS-1VS2. F-G</option>
                                            <option value="Sl1, G">Sl1, G</option>
                                            <option value="Sl1-sl2, G-H">Sl1-sl2, G-H</option>
                                            <option value="Sl2, H-I">Sl2, H-I</option>
                                            <option value="L1, H-I">L1, H-I</option>
                                            <option value="L2, H-I">L2, H-I</option>
                                            <option value="CHAMPAGNE">CHAMPAGNE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Quality</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="quality" data-title="Quality">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p><span>Comments</span></p>
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea name="comments" data-title="Comments" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" class="contact-to-purchase popup-btn" data-mfp-src=".appointment-popup">Contact Us To Purchase</button>
                                    </div>
                                </div>
                            <?php }elseif($form_type == 5){ ?>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Metal Type</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="metal_type" data-title="Metal Type">
                                            <option value="10 kt">10 kt</option>
                                            <option value="14 kt">14 kt</option>
                                            <option value="18 kt">18 kt</option>
                                            <option value="Silver">Silver</option>
                                            <option value="Platinum">Platinum</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Metal Color</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="metal_color" data-title="Metal Color">
                                            <option value="White">White</option>
                                            <option value="Yellow">Yellow</option>
                                            <option value="Pink">Pink</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Diamond Quality</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="diamond_quality" data-title="Diamond Quality">
                                            <option value="VS-1VS2. F-G">VS-1VS2. F-G</option>
                                            <option value="Sl1, G">Sl1, G</option>
                                            <option value="Sl1-sl2, G-H">Sl1-sl2, G-H</option>
                                            <option value="Sl2, H-I">Sl2, H-I</option>
                                            <option value="L1, H-I">L1, H-I</option>
                                            <option value="L2, H-I">L2, H-I</option>
                                            <option value="CHAMPAGNE">CHAMPAGNE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <p><span>Quality</span></p>
                                    </div>
                                    <div class="col-xs-8">
                                        <select name="quality" data-title="Quality">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <p><span>Comments</span></p>
                                    </div>
                                    <div class="col-xs-12">
                                        <textarea name="comments" data-title="Comments" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="button" class="contact-to-purchase popup-btn" data-mfp-src=".appointment-popup">Contact Us To Purchase</button>
                                    </div>
                                </div>
                            <?php }
                        ?>
                    </form>

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
                <div class="hidden"></div>
                <div class="popup-form__input-wrapper">
                    <input class="popup-form__input" type="text" name="color" placeholder="Choose color" data-title="Color" data-validate-required="Required field">
                </div>
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

    <script>
        jQuery(document).ready(function($){
            $('.contact-to-purchase').click(function(){
                console.log($(this).parents('form').find('input, select, textarea'));
                var container = $('.appointment-popup .hidden');
                container.html('');
                $(this).parents('form').find('input, select, textarea').each(function(){
                    var $this = $(this);
                    container.append('<input name="'+$this.attr('name')+'" data-title="'+$this.data('title')+'" value="'+$this.val()+'">');
                });
            });
        });
    </script>

<?php endwhile; ?>

<?php get_footer(); ?>

