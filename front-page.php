<?php
/**
 * The front page template file
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package thescholarshiphub
 */

$options = get_option('TheScholarshipHub');
get_header(); ?>

<div id="primary" class="content-area">
        <div class="slider_1">

            <div class="owl-carousel owl-theme slide-one">

                <div class="item">
                    <div class="slider-text">
                        <h2 class="slider-text_mod tagline_1"><?php echo !empty($options['1']) ? $options['1'] : ''; ?></h2>
                        <p class="slider-text_mod tagline_2"><?php echo !empty($options['2']) ? $options['2'] : ''; ?></p>
                        <div class="slider-text_mod">
                            <a class="jumpButton jumpButton_mod" href="<?php echo !empty($options['14']) ? $options['14'] : ''; ?>"><i class="fa fa-play" aria-hidden="true"></i>
                                <?php echo !empty($options['3']) ? $options['3'] : ''; ?></a>
                            <?php if ( !is_user_logged_in() ) { ?>
                                <a class="jumpButton" href="<?php echo !empty($options['44']) ? $options['44'] : ''; ?>"><i class="fa fa-play" aria-hidden="true"></i>
                                    <?php echo !empty($options['43']) ? $options['43'] : ''; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <img src="<?php echo !empty($options['4']) ? $options['4'] : ''; ?>" alt="<?php _e('Slider Image', THEME_DOMAIN); ?>">
                </div>
                <div class="item">
                    <div class="slider-text">
                        <h2 class="slider-text_mod tagline_1"><?php echo !empty($options['5']) ? $options['5'] : ''; ?></h2>
                        <p class="slider-text_mod tagline_2"><?php echo !empty($options['6']) ? $options['6'] : ''; ?></p>
                        <div class="slider-text_mod">
                            <a class="jumpButton jumpButton_mod" href="<?php echo !empty($options['15']) ? $options['15'] : ''; ?>"><i class="fa fa-play" aria-hidden="true"></i>
                                <?php echo !empty($options['7']) ? $options['7'] : ''; ?></a>
                            <?php if ( !is_user_logged_in() ) { ?>
                                <a class="jumpButton" href="<?php echo !empty($options['46']) ? $options['46'] : ''; ?>"><i class="fa fa-play" aria-hidden="true"></i>
                                    <?php echo !empty($options['45']) ? $options['45'] : ''; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <img src="<?php echo !empty($options['8']) ? $options['8'] : ''; ?>" alt="<?php _e('Slider Image', THEME_DOMAIN); ?>">
                </div>
                <div class="item">
                    <div class="slider-text">
                        <h2 class="slider-text_mod tagline_1"><?php echo !empty($options['38']) ? $options['38'] : ''; ?></h2>
                        <p class="slider-text_mod tagline_2"><?php echo !empty($options['39']) ? $options['39'] : ''; ?></p>
                        <div class="slider-text_mod">
                            <a class="jumpButton jumpButton_mod" href="<?php echo !empty($options['41']) ? $options['41'] : ''; ?>"><i class="fa fa-play" aria-hidden="true"></i>
                                <?php echo !empty($options['40']) ? $options['40'] : ''; ?></a>
                            <?php if ( !is_user_logged_in() ) { ?>
                                <a class="jumpButton" href="<?php echo !empty($options['48']) ? $options['48'] : ''; ?>"><i class="fa fa-play" aria-hidden="true"></i>
                                    <?php echo !empty($options['47']) ? $options['47'] : ''; ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <img src="<?php echo !empty($options['8']) ? $options['8'] : ''; ?>" alt="<?php _e('Slider Image', THEME_DOMAIN); ?>">
                </div>

            </div> <!-- owl-carousel -->

        </div> <!-- /slider_1 -->
	<main id="main" class="site-main" role="main">

		<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                    <?php thescholarshiphub_post_thumbnail(); ?>

                                    <div class="entry-content">
                                            <?php
                                            the_content();

                                            wp_link_pages( array(
                                                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', THEME_DOMAIN ),
                                                    'after'  => '</div>',
                                            ) );
                                            ?>
                                    </div><!-- .entry-content -->
                            </article><!-- #post -->
                        <?php
			endwhile;
		endif; ?>		

	</main><!-- #main -->
        
        <!-- Some post categories -->
        <section class="user_status">
            <div class="container">
                <div class="row">
                    <?php if(!empty($options['49'])){ ?>
                        <div class="col-md-12">
                            <h1 class="home_h1"><?php echo $options['49']; ?></h1>
                        </div>                    
                    <?php }
                    if(!empty($options['30'])){
                        $term = get_term_by('id', $options['30'], 'category');
                        $thumbnail_id = get_term_meta($term->term_id, '_thumbnail_id', true);
                        if ( $thumbnail_id ){
                                $image = wp_get_attachment_image_url( $thumbnail_id, 'full' );
                        }else{
                                $image = tsh_placeholder_cat_img_src();	
                        }
                        ?>
                        <div class="col-md-4 <?php echo $term->term_id; ?>">
                            <div class="user_status_image tsh_border_mod">
                                <img src="<?php echo $image; ?>">                            
                            </div>
                            <div class="user_status_text user_status_text_Bg1">
                                <a href="<?php echo get_category_link( $term->term_id ); ?>">
                                    <div><?php echo $term->name; ?></div>
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    <?php }
                    
                    if(!empty($options['31'])){
                        $term = get_term_by('id', $options['31'], 'category');
                        $thumbnail_id = get_term_meta($term->term_id, '_thumbnail_id', true);
                        if ( $thumbnail_id ){
                                $image = wp_get_attachment_image_url( $thumbnail_id, 'full' );
                        }else{
                                $image = tsh_placeholder_cat_img_src();	
                        }
                        ?>
                        <div class="col-md-4 <?php echo $term->term_id; ?>">
                            <div class="user_status_image tsh_border_mod">
                                <img src="<?php echo $image; ?>">                            
                            </div>
                            <div class="user_status_text user_status_text_Bg2">
                                <a href="<?php echo get_category_link( $term->term_id ); ?>">
                                    <div><?php echo $term->name; ?></div>
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    <?php }
                    
                    if(!empty($options['32'])){
                        $term = get_term_by('id', $options['32'], 'category');
                        $thumbnail_id = get_term_meta($term->term_id, '_thumbnail_id', true);
                        if ( $thumbnail_id ){
                                $image = wp_get_attachment_image_url( $thumbnail_id, 'full' );
                        }else{
                                $image = tsh_placeholder_cat_img_src();	
                        }
                        ?>
                        <div class="col-md-4 <?php echo $term->term_id; ?>">
                            <div class="user_status_image tsh_border_mod">
                                <img src="<?php echo $image; ?>">                            
                            </div>
                            <div class="user_status_text user_status_text_Bg3">
                                <a href="<?php echo get_category_link( $term->term_id ); ?>">
                                    <div><?php echo $term->name; ?></div>
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section><!-- .user_status -->
        
        <section class="home_content_wrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if(!empty($options['50'])){ ?>
                                        <h1 class="home_h1"><?php echo $options['50']; ?></h1>
                                <?php }
                                
                                $args = array(
                                    'posts_per_page' => 1,
                                    'meta_key' => '_tsh_featured',
                                    'meta_value' => 'yes'
                                );
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()){
                                    while ($the_query->have_posts()){ $the_query->the_post();
                                        if (has_post_thumbnail()) { ?>
                                            <div class="featured_post_image">
                                                <?php the_post_thumbnail('full'); ?> 


                                        <div class="featured_post_text featured_post_text_mod">
                                            <h3><?php the_title(); ?></h3>
                                            <div><?php echo wp_trim_words(get_the_content(), 27, '...'); ?></div>
                                            <div class="read_more">
                                                <a class="jumpButton" href="<?php the_permalink(); ?>"><i class="fa fa-play" aria-hidden="true"></i><?php echo !empty($options['16']) ? $options['16'] : ''; ?></a>                                                
                                            </div>
                                        </div>


                                            </div>
                                        <?php } ?>
                                        
                              
                                        <?php
                                    }    
                                }
                                ?>
                            </div>
                            
                            <div class="col-md-12" id="university_funding">
                                <?php if(!empty($options['9'])){ ?>
                                    <h1 class="home_h_mod"><?php echo $options['9']; ?></h1>
                                <?php
                                }
                                $args = array(
                                    'posts_per_page' => 4,
                                    'meta_key' => '_tsh_university_funding',
                                    'meta_value' => 'yes'
                                );
                                $the_query = new WP_Query($args);
                                if ($the_query->have_posts()){
                                    ?>
                                    <div class="grid">
                                        <?php
                                        while ($the_query->have_posts()){ $the_query->the_post();
                                            $title = '';
                                            $post_id = get_the_ID();
                                            $custom_title = get_post_meta( $post_id, '_tsh_short_title', true );
                                            if( $custom_title != false ){
                                                $title = $custom_title;
                                            }else{                                    
                                                $post_title = get_the_title( $post_id );
                                                $title      = ( ! empty( $post_title ) ) ? wp_trim_words($post_title, 5) : __( '(no title)', THEME_DOMAIN );
                                            }
                                        
                                            ?>
                                            <div class="item">
                                                <div class="row">
                                                    
                                                    <div class="col-md-4 university_funding_thumb">
                                                    <?php
                                                        if (has_post_thumbnail()) { ?>
                                                                <?php the_post_thumbnail('post-thumbnail'); ?>                 

                                                        <?php } ?>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h4 class="university_funding_title clippingText_1"><?php echo $title; ?></h4>
                                                        <div class="university_funding_text"><?php echo get_the_excerpt();//wp_trim_words(get_the_content(), 15 ); ?></div>
                                                        <a class="university_funding_btn" href="<?php the_permalink(); ?>"><i class="fa fa-play" aria-hidden="true"></i><?php echo !empty($options['16']) ? $options['16'] : ''; ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                        if (!empty($options['13'])) {                                            
                                            $post_id = $options['13'];
                                            $post = get_post( $post_id );
                                            if (!empty($options['12'])) { ?>
                                                <div class="featured_post_image featured_post_image_mod tsh_border">
                                                    <img src="<?php echo $options['12']; ?>" alt="<?php _e('Post Image', THEME_DOMAIN); ?>"/>                         
                                                </div>
                                            <?php } ?>
                                            <div class="featured_post_text featured_post_text_2">
                                                <?php if(!empty($options['10'])){ ?>
                                                    <h1 class="home_h1 home_h_mod_2"><?php echo $options['10']; ?></h1>
                                                <?php } ?>
                                                <div><?php echo wp_trim_words($post->post_content, 19); ?></div>
                                                <div class="link_wrap">
                                                    <a class="university_funding_btn university_funding_btn_mod" href="<?php echo get_page_link($post_id); ?>" class='jumpButton learn_more'><i class="fa fa-play" aria-hidden="true"></i><?php echo !empty($options['17']) ? $options['17'] : ''; ?></a>                                                
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <?php
                                        if (!empty($options['19'])) {
                                            if (!empty($options['18'])) { ?>
                                                <div class="featured_post_image featured_post_image_mod tsh_border">
                                                    <img src="<?php echo $options['18']; ?>" alt="<?php _e('Post Image', THEME_DOMAIN); ?>"/>                         
                                                </div>
                                            <?php } ?>
                                            <div class="featured_post_text featured_post_text_2">
                                                <?php if(!empty($options['11'])){ ?>
                                                    <h1 class="home_h1 home_h_mod_2"><?php echo $options['11']; ?></h1>
                                                <?php } ?>
                                                <div><?php echo $options['29']; ?></div>
                                                <div class="link_wrap">
                                                    <a class="university_funding_btn university_funding_btn_mod" href="<?php echo $options['19']; ?>" class='jumpButton learn_more'><i class="fa fa-play" aria-hidden="true"></i><?php echo !empty($options['17']) ? $options['17'] : ''; ?></a>                                                
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>                                
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-3 home_sidebar_wrap">
                        <?php dynamic_sidebar( 'sidebar_home' ); ?>
                    </div>
                    
                </div>
                
            </div>
        </section><!-- .home_content_wrap -->                
        
</div><!-- #primary -->
<?php get_footer();
