<?php
/**
 * Theme functions.
 *
 * @package Meridia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Checks if WooCommerce is activated
 * @return boolean
 */
if ( ! function_exists( 'meridia_is_woocommerce_activated' ) ) {
	function meridia_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}


if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
	function wp_body_open() {
		// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedFunctionFound
		do_action( 'wp_body_open' );
	}
}


/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function meridia_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'meridia' ) . '</a>';
}

add_action( 'wp_body_open', 'meridia_skip_link', 5 );


if ( ! function_exists( 'meridia_is_gutenberg' ) ) {
	/**
	* Gutenberg Check
	*
	* @since 1.0.0
	*/
	function meridia_is_gutenberg() {
		return function_exists( 'register_block_type' ); 
	}
}



// Categories dropdown
function meridia_categories_dropdown() {

	$categories = get_categories( array(
		'orderby' => 'name',
		'parent'  => 0
	) );

	$categories_dropdown = array( '0' => esc_html__( 'All categories', 'meridia' ) );
	if ( ! is_wp_error( $categories ) ) {
		foreach ( $categories as $key => $category ) {
			$categories_dropdown[$category->term_id] = $category->name;
		}
	}

	return $categories_dropdown;
}

if ( ! function_exists( 'meridia_meta_date' ) ) {
	/**
	* Post date meta
	*
	* @since 1.0.0
	*/
	function meridia_meta_date( $echo = true ) {
		$posted_on = get_the_date();
		$output = '';
		$output .= sprintf('<span>%s</span>', $posted_on);

		if ( $echo ) {
			echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $output;
		}
	}
}

if ( ! function_exists( 'meridia_meta_comments' ) ) {
	/**
	* Post comments meta
	*
	* @since 1.0.0
	*/
	function meridia_meta_comments( $echo = true ) {
		$comments_num = get_comments_number();
		$output = '';

		if ( comments_open() ) {
			if( $comments_num == 0 ) {
				$comments = esc_html__( '0 Comments', 'meridia' );
			} elseif ( $comments_num > 1 ) {
				$comments = $comments_num . esc_html__(' Comments', 'meridia');
			} else {
				$comments = esc_html__('1 Comment', 'meridia');
			}
			$comments = sprintf('<a href="%1$s">%2$s</a>', get_comments_link(), $comments );
		} else {
			$comments = esc_html__('Comments are closed', 'meridia');
		}

		$output .= $comments;
		if ( $echo ) {
			echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $output;
		}
		
	}
}

if ( ! function_exists( 'meridia_meta_category' ) ) {
	/**
	* Post category meta
	*
	* @since 1.0.0
	*/

	function meridia_meta_category( $echo = true ) {
		$categories = get_the_category();
		$separator = ', ';
		$categories_output = '';
		$output = '';

		if ( !empty($categories) ):    
			foreach( $categories as $index => $category ):
				if ($index > 0) : $categories_output .= $separator; endif;
				$categories_output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="entry-category">' . esc_html( $category->name ) . '</a>';
			endforeach;
		endif;

		if ( 'post' == get_post_type() ) :
			$output .= '<div class="entry-category-wrap">' . $categories_output . '</div>';
		endif;

		if ( $echo ) {
			echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $output;
		}

	}
}


/**
 * Custom excerpt length
 */
function meridia_custom_excerpt_length( $length ) {
	$excerpt_length = get_theme_mod( 'meridia_posts_excerpt_settings', 55 );
	if ( is_admin() && ! wp_doing_ajax() ) return $length;
	return $excerpt_length;
}
add_filter( 'excerpt_length', 'meridia_custom_excerpt_length', 999 );



// WP Instagram add class to link
function meridia_instagram_class( $classes ) {
	$classes = "instagram-feed__url";
	return $classes;
}
add_filter( 'wpiw_linka_class', 'meridia_instagram_class' );



// Grab URL Post Format
function meridia_grab_url() {
	if (! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/i', get_the_content(), $links ) ) {
		return false;
	}
	return esc_url_raw( $links[1] );
}


/**
* Comments Pagination
**/
function meridia_comments_pagination() {

	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

		<nav class="comment-navigation clearfix" role="navigation">
			<h6 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'meridia' ); ?></h6>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'meridia' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'meridia' ) ); ?></div>
		</nav><!-- #comment-nav-above -->

	<?php endif;
}


/**
* Archives Author Page Title
**/
function meridia_archive_title( $title ) {

	if ( is_author() ) {
		/* translators: Author archive title. %s: Author name. */
		$title = sprintf( __( 'All Posts By: %s', 'meridia' ), '<span class="vcard">' . get_the_author() . '</span>' );
	}

	return $title;
}
 
add_filter( 'get_the_archive_title', 'meridia_archive_title' );


/**
* AJAX Load More
**/
function meridia_loadmore_ajax_handler() {

	check_ajax_referer( 'meridia_ajax_loadmore_nonce', 'security' );

	$args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
	$layout = $_POST['layout'];
	$sidebar_on = $_POST['sidebar_on'];
	$class = '';

	if ( MERIDIA_PRODUCTION ) {
		$class = ( 'fullwidth' !== $sidebar_on ) ? 'col-lg-4' : 'col-lg-6' ;
	} else {
		$class = ( 'on' == $sidebar_on ) ? 'col-lg-6' : 'col-lg-4'  ;
	}

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :
		while ( $query->have_posts() ): $query->the_post(); ?>
			<?php if ( $layout == 'grid' ) : ?>
				<div class="<?php echo esc_attr( $class ); ?> col-sm-6">
					<?php get_template_part( 'template-parts/posts/grid-post-small', get_post_format() ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $layout == 'list' ) : ?>
				<?php get_template_part( 'template-parts/posts/list-post', get_post_format() ); ?>
			<?php endif; ?>

		<?php endwhile;

	endif;
	die;
}

add_action('wp_ajax_loadmore', 'meridia_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'meridia_loadmore_ajax_handler'); // wp_ajax_nopriv_{action} 


if ( ! function_exists( 'meridia_post_pagination' ) ) {
	/**
	* Post pagination
	*
	* @since 1.0.0
	*/
	function meridia_post_pagination() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}		

		if ( is_home() && 'button' == get_theme_mod( 'meridia_pagination_settings', 'button' ) ) : ?>
			<nav class="text-center mb-40">
				<button class="btn btn-md btn-color deo-loadmore">
					<span>
						<?php echo esc_html__('Load More', 'meridia'); ?>
					</span>
				</button>
			</nav>
		<?php endif; ?>		


		<?php if ( 'numbers' == get_theme_mod( 'meridia_pagination_settings', 'button' ) || is_search() ) : ?>
			
			<?php $args = array(
				'prev_next' => true,
				'prev_text' => wp_kses( '<i class="ui-arrow-left"></i>', array( 'i' => array( 'class' => array() ) ) ),
				'next_text' => wp_kses( '<i class="ui-arrow-right"></i>', array( 'i' => array( 'class' => array() ) ) ),
			); ?>

			<?php the_posts_pagination( $args ); ?>

		<?php endif;
	}
}


if ( ! function_exists( 'meridia_multi_page_pagination' ) ) {
	/**
	* Multi-page pagination
	*
	* @since 1.0.0
	*/
	function meridia_multi_page_pagination() {
		$defaults = array(
			'before'           => '<div class="entry-pages">' . esc_html__( 'Pages:', 'meridia' ),
			'after'            => '</div>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => esc_html__( 'Next page', 'meridia' ),
			'previouspagelink' => esc_html__( 'Previous page', 'meridia' ),
			'pagelink'         => '%',
			'echo'             => 1
		);

		wp_link_pages( $defaults );
	}
}



if ( ! function_exists( 'meridia_post_nav' ) ) :
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function meridia_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );
		$get_next_post = get_next_post();
		$get_previous_post = get_previous_post();

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="entry-navigation">
			<h5 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'meridia' ); ?></h5>
			<div class="clearfix">

				<?php if ( !empty( $get_next_post ) ) : ?>
					<div class="entry-navigation--left">
						<?php
							printf( '<i class="ui-arrow-left"></i><span>%s</span>', esc_html__('Previous Post', 'meridia') );
							next_post_link( '<div class="entry-navigation__link">%link</div>', esc_html_x( '%title', 'Next post link', 'meridia' ) );
						?>
					</div>
				<?php endif; ?>
				<?php if ( !empty( $get_previous_post ) ) : ?>
					<div class="entry-navigation--right">
						<?php
							printf( '<span>%s</span><i class="ui-arrow-right"></i>', esc_html__('Next Post', 'meridia') );
							previous_post_link( '<div class="entry-navigation__link">%link</div>', esc_html_x( '%title', 'Previous post link', 'meridia' ) );  
						?>        
					</div>
				<?php endif; ?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;


if ( ! function_exists( 'meridia_sidebar' ) ) {
	/**
	* Get sidebar
	*
	* @since 1.0.0
	*/
	function meridia_sidebar( $sidebar = '' ) {
		?>
			<aside class="col-lg-3 sidebar">
				<?php get_sidebar( $sidebar ); ?>
			</aside>
		<?php		
	}
}


if ( ! function_exists( 'meridia_author_box' ) ) {
	/**
	* Author Box
	*/
	function meridia_author_box() {

		$socials = [
			'facebook'  => get_the_author_meta( 'facebook' ),
			'twitter'   => get_the_author_meta( 'twitter' ),
			'pinterest' => get_the_author_meta( 'pinterest' ),
			'instagram' => get_the_author_meta( 'instagram' ),
			'snapchat'  => get_the_author_meta( 'snapchat' ),
			'bloglovin' => get_the_author_meta( 'bloglovin' ),
			'blogger'   => get_the_author_meta( 'blogger' ),
			'youtube'   => get_the_author_meta( 'youtube' ),
			'vimeo'     => get_the_author_meta( 'vimeo' ),
			'linkedin'  => get_the_author_meta( 'linkedin' ),
		];

		if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="entry-author entry-author--box clearfix">
				<span itemscope itemprop="image">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 64, null, null, array( 'class' => array( 'entry-author__img' ) ) ); ?>
					</a>                
				</span>
				<div class="entry-author__info">
					<h6 class="entry-author__name" itemprop="url" rel="author">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>" itemprop="name">
							<span itemprop="author" itemscope itemtype="http://schema.org/Person" class="entry-author__name">
								<?php the_author_meta( 'display_name' ); ?>
							</span>
						</a>
					</h6>
					<p class="mb-0"><?php the_author_meta( 'description' ); ?></p>

					<!-- Socials -->
					<?php if ( ! empty( $socials ) ) : ?>
						<div class="entry-author__socials socials socials--nobase">
							<?php foreach ( $socials as $key => $value ) {
								if ( $value ) : ?>
									<a href="<?php echo esc_url( the_author_meta( $key ) ); ?>" class="social" title="<?php echo esc_attr( $key ); ?>" rel="noopener nofollow" target="_blank">
										<i class="ui-<?php echo esc_attr( $key ); ?>"></i>
									</a>
								<?php endif;
							} ?>
						</div>
					<?php endif; ?>

				</div>
			</div>
		<?php endif;
	}
}


if ( ! function_exists( 'meridia_related_posts' ) ) {
  /**
   * Related Posts
   */
	function meridia_related_posts() {

		global $post;
		$tags = wp_get_post_tags( $post->ID );
		$author_id = get_the_author_meta( 'ID' );
		$related_by = get_theme_mod( 'meridia_related_posts_relation', 'category' );

		$args = array(
			'post_type'=>'post',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'post__not_in' => array(get_the_ID()),
			'ignore_sticky_posts' => true,
			'meta_query' => array( 
				array(
					'key' => '_thumbnail_id'
				) 
			),
		);

		if ( $tags && 'tag' === $related_by ) {
			$tag_ids = array();
			foreach ( $tags as $tag ) {
				$tag_ids[] = $tag->term_id;
			}

			$args['tag__in'] = $tag_ids;

		} elseif ( 'category' === $related_by ) {
			$args['category__in'] = wp_get_post_categories( get_the_ID() );
		} elseif ( 'author' === $related_by ) {        
			$args['author'] = $author_id;
		}

		$query = new WP_Query( $args ); ?>

		<?php if ( $query->have_posts() ) : ?>

			<div class="related-posts mt-60">
				<div class="heading-lines mb-20">
					<h5 class="related-posts__title widget-title"><?php echo esc_html__('You may also like', 'meridia'); ?></h5>
				</div>
				
				<div class="row">
					
					<?php while( $query->have_posts() ) : $query->the_post(); ?>				
						
						<div class="col-sm-4">
							<article class="entry-item">
								<!-- Post thumb -->
								<?php if ( has_post_thumbnail() ) : ?>
									<figure class="entry-img">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'meridia_large' ); ?>
										</a>
									</figure>
								<?php endif; ?>

								<!-- Title -->
								<?php the_title( sprintf( '<h4 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>

								<?php if ( get_theme_mod( 'meridia_meta_date_settings', true ) ) : ?>
									<!-- Meta -->
									<div class="entry-meta-wrap">								
										<ul class="entry-meta">
											<li class="entry-date">
												<?php meridia_meta_date(); ?>
											</li>
										</ul>								
									</div>
								<?php endif; ?>
							</article>
						</div> <!-- .col -->
						
					<?php endwhile; ?>

					<?php wp_reset_postdata(); ?>

				</div> <!-- .row -->
			</div> <!-- .related-posts -->

		<?php endif;
	}
}


if ( ! function_exists( 'meridia_layout_type' ) ) {
	/**
	 * Check layout type based on customizer and meta settings
	 * @return string $type Layout type
	 */
	function meridia_layout_type( $type ) {
		$layout = '';

		if ( 'left-sidebar' == get_theme_mod( 'meridia_' . $type . '_layout_type', 'right-sidebar' ) ) {
			$layout = 'left-sidebar';		
		}

		if ( 'right-sidebar' == get_theme_mod( 'meridia_' . $type . '_layout_type', 'right-sidebar' ) ) {
			$layout = 'right-sidebar';
		}

		if ( 'fullwidth' == get_theme_mod( 'meridia_' . $type . '_layout_type', 'right-sidebar' ) ) {			
			$layout = 'fullwidth';
		}	

		return $layout;
	}
}


/**
 * Sanitize HTML input
 */
function meridia_sanitize_html( $input ) {
	return wp_kses( $input, array(
		'a' => array(
			'href' => array(),
			'target' => array(),
		),
		'i' => array(),
		'span' => array(),
		'em' => array(),
		'strong' => array(),
	) );
};


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function meridia_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Page layout class
	if ( is_page() ) {
		$classes[] = meridia_layout_type( 'page' );
	}

	// Blog layout class
	if ( is_single() || is_home() ) {
		if ( meridia_is_woocommerce_activated() && is_product() ) {
			$classes[] = '';
		} else {
			$classes[] = meridia_layout_type( 'blog' );
		}
	}

	// Shop Layout Class
	if ( meridia_is_woocommerce_activated() ) {
		if ( is_woocommerce() || is_shop() ) {
			$classes[] = meridia_layout_type( 'shop' );
		}
	}

	// Archives layout class
	if ( is_archive() ) {
		if ( meridia_is_woocommerce_activated() && is_shop() ) {
			$classes[] = '';
		} else {
			$classes[] = meridia_layout_type( 'archives' );
		}
	}

	// Search layout class
	if ( is_search() ) {
		$classes[] = meridia_layout_type( 'search_results' );
	}

	$classes[] = '';

	return $classes;
}
add_filter( 'body_class', 'meridia_body_classes' );



/**
 * Adds custom admin classes.
 *
 * @param string $classes Classes for the body element.
 * @return string
 */
function meridia_admin_body_classes( $classes ) {

	$screen = get_current_screen();

	// Add blog layout class
	if( $screen->id === "post" ) {
		$classes = meridia_layout_type( 'blog' );
	}

	// Add page layout class
	if( $screen->id === "page" ) {
		$classes = meridia_layout_type( 'page' );
	}
	
	return $classes;
}
add_filter( 'admin_body_class', 'meridia_admin_body_classes' );
