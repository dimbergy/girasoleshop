<?php
/**
 * WooCommerce Section Start Here
*/
if ( ! function_exists( 'buzzstore_is_woocommerce_activated' ) ) {
    function buzzstore_is_woocommerce_activated() {
        if ( class_exists( 'WooCommerce' ) ) { return true; } else { return false; }
    }
}

/**
 * WooCommerce shop/product and single products breadcrumb funciton area
*/
if ( ! function_exists( 'buzzstore_breadcrumb_woocommerce' ) ) {    
    function buzzstore_breadcrumb_woocommerce() {
        $breadcrumb_options  = esc_attr( get_theme_mod('buzzstore_woocommerce_enable_disable_section', 'enable') );
        $breadcrumb_bg_image = esc_url( get_theme_mod('buzzstore_breadcrumbs_woocommerce_background_image') );
        
        if($breadcrumb_bg_image){
            $breadcrumb_bg_image = $breadcrumb_bg_image;
        }else{
          $breadcrumb_bg_image = get_template_directory_uri().'/assets/images/15.jpg';
        }

        if($breadcrumb_options == 'enable') { ?>
            <div class="breadcrumbswrap buzz-paralax" style="background:url('<?php echo esc_url( $breadcrumb_bg_image ); ?>') no-repeat center; background-size: cover; background-attachment:fixed;">
                <div class="buzz-overlay"></div>
                <div class="buzz-container wow zoomIn" data-wow-delay="0.3s">
                    <header class="entry-header">
                        <?php if( is_product() ) {
                              the_title( '<h1 class="entry-title">', '</h1>' ); 
                          }elseif( is_search() ){ ?>
                                <h1 class="entry-title"><?php printf( esc_html__( 'Search Results for : %1$s', 'buzzstore' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                        <?php }else{ ?>
                            <h1 class="entry-title"><?php woocommerce_page_title(); ?></h1>
                        <?php  } ?>         
                    </header><!-- .entry-header -->
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            </div>
        <?php }
    }
}
add_action( 'breadcrumb-woocommerce', 'buzzstore_breadcrumb_woocommerce' );


/**
 * Buzzstore normal page breadcrumb function area
*/
if ( ! function_exists( 'buzzstore_breadcrumb_page' ) ) {    
    function buzzstore_breadcrumb_page() {
        $breadcrumb_options_page = esc_attr( get_theme_mod('buzzstore_normal_page_enable_disable_section', 'enable') );
        $breadcrumb_page_image = esc_url( get_theme_mod('buzzstore_breadcrumbs_normal_page_background_image') );
       
        if($breadcrumb_page_image){
            $breadcrumb_page_image = $breadcrumb_page_image;
        }else{
          $breadcrumb_page_image = get_template_directory_uri().'/assets/images/15.jpg';
        }

        if($breadcrumb_options_page == 'enable') { ?>
            <div class="breadcrumbswrap buzz-paralax" style="background:url('<?php echo esc_url( $breadcrumb_page_image ); ?>')">
                <div class="buzz-overlay"></div>
                <div class="buzz-container wow zoomIn" data-wow-delay="0.3s">
                    <header class="entry-header">
                        <?php if( is_archive() || is_category() ) {
                                the_archive_title( '<h1 class="entry-title">', '</h1>' );
                            }elseif( is_search() ){ ?>
                                <h1 class="entry-title"><?php printf( esc_html__( 'Search Results for : %s', 'buzzstore' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                <h2 class="page-title"><?php echo esc_html__('Nothing Found','buzzstore'); ?></h2>
                            <?php }elseif( is_404() ){ ?>
                                <h1 class="entry-title"><?php echo esc_html__('404','buzzstore'); ?></h1>
                            <?php }else{
                                the_title( '<h1 class="entry-title">', '</h1>' ); 
                            }
                        ?>
                    </header>
                    <?php buzzstore_breadcrumbs(); ?>
                </div>                
            </div>
        <?php }
    }
}
add_action( 'buzzstore-breadcrumb-page', 'buzzstore_breadcrumb_page' );

/**
 * Buzzstore single post and archive breadcrumb function area
*/
if ( ! function_exists( 'buzzstore_breadcrumb_post' ) ) {    
    function buzzstore_breadcrumb_post() {
        $breadcrumb_options_post = esc_attr( get_theme_mod('buzzstore_post_archive_page_enable_disable_section', 'enable') );
        $breadcrumb_post_image = esc_url( get_theme_mod('buzzstore_breadcrumbs_post_archive_background_image') );
  
        if($breadcrumb_post_image){
            $breadcrumb_post_image = $breadcrumb_post_image;
        }else{
          $breadcrumb_post_image = get_template_directory_uri().'/assets/images/15.jpg';
        }

        if($breadcrumb_options_post == 'enable') { ?>
            <div class="breadcrumbswrap buzz-paralax" style="background:url('<?php echo esc_url( $breadcrumb_post_image ); ?>')">
                <div class="buzz-overlay"></div>
                <div class="buzz-container">
                    <header class="entry-header">
                        <?php if( is_single() ) {
                                the_title( '<h1 class="entry-title">', '</h1>' ); 
                            }else{
                                the_archive_title( '<h1 class="entry-title">', '</h1>' );
                            }
                        ?>
                    </header><!-- .entry-header -->
                    <?php buzzstore_breadcrumbs(); ?>
                </div>                
            </div>
        <?php }
    }
}
add_action( 'buzzstore-breadcrumb-post', 'buzzstore_breadcrumb_post' );

/**
 * Buzz Store Service section
*/
if ( ! function_exists( 'buzzstore_service_section' ) ) {
  function buzzstore_service_section() {
        $icon_one = esc_attr( get_theme_mod( 'buzzstore_first_icon_block_area' ) );
        $icon_title_one = esc_html( get_theme_mod( 'buzzstore_first_title_icon_block_area' ) );      
        $icon_two = esc_attr( get_theme_mod( 'buzzstore_second_icon_block_area' ) );
        $icon_title_two = esc_html( get_theme_mod( 'buzzstore_second_title_icon_block_area' ) );      
        $icon_three = esc_attr( get_theme_mod( 'buzzstore_third_icon_block_area' ) );
        $icon_title_three = esc_html( get_theme_mod( 'buzzstore_thired_title_icon_block_area' ) );       
        $icon_area = esc_attr( get_theme_mod( 'buzzstore_icon_block_section','enable' ) );
        if(!empty($icon_area) && $icon_area == 'enable') {
      ?>
        <section class="buzz-servicesarea">
            <div class="buzz-container buzz-clearfix buzz-serviceswrap">                   
                <div class="buzz-services">
                    <?php if(!empty( $icon_title_one )) { ?>                        
                    <div class="buzz-services-item wow fadeInLeft" data-wow-delay="0.3s">
                        <span class="fa <?php echo esc_attr( $icon_one ); ?>"></span>
                        <div class="content">
                            <p><?php echo esc_html( $icon_title_one ); ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="buzz-services">
                    <?php if(!empty( $icon_title_two )) { ?> 
                    <div class="buzz-services-item wow fadeInUp" data-wow-delay="0.3s">
                        <span class="fa <?php echo esc_attr( $icon_two ); ?>"></span>
                        <div class="content">
                            <p><?php echo esc_html( $icon_title_two ); ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="buzz-services">
                    <?php if(!empty( $icon_title_three )) { ?>
                    <div class="buzz-services-item wow fadeInRight" data-wow-delay="0.3s">
                        <span class="fa <?php echo esc_attr( $icon_three ); ?>"></span>
                        <div class="content">
                            <p><?php echo esc_html( $icon_title_three ); ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
<?php  } } }
add_action('buzzstore-services-area','buzzstore_service_section');


/**
 * Comment Callback function
*/
if ( ! function_exists( 'buzzstore_comment' ) ) {
    function buzzstore_comment($comment, $args, $depth) { ?>
        <li <?php comment_class(); ?> id="buzz-li-comment-<?php comment_ID() ?>">
            <div class="buzz-comment-wrapper buzz-media" id="comment-<?php comment_ID(); ?>">
                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="buzz-pull-left">
                  <?php echo get_avatar($comment, $size ='100' ); ?>
                </a>
                <?php if ($comment->comment_approved == '0') : ?>
                     <em><?php esc_html_e('Your comment is awaiting moderation.','buzzstore') ?></em>                
                <?php endif; ?>
                <div class="buzz-media-body">
                    <div>
                        <?php printf(__('<h4 class="buzz-media-heading">%1$s</h4>','buzzstore'), get_comment_author_link() ) ?>
                        <div class="buzz-prorow">
                            <div class="buzz-comment-left">
                                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                      <?php printf( __('%1$s at %2$s','buzzstore'), get_comment_date(),  get_comment_time()); ?>
                    </a>
                    <?php comment_text() ?>
                </div>
            </div>
        </li>
        <?php
    }
}

/************************************************************
** Left Section Start                                      **
*************************************************************/

/**
 * Quick Contact Action Section
*/
if ( ! function_exists( 'buzzstore_quick_contact' ) ) {
	function buzzstore_quick_contact(){
          $buzzstore_map_address = esc_attr( get_theme_mod('buzzstore_quick_map_address') );
		  $buzzstore_quick_email = sanitize_email( get_theme_mod('buzzstore_quick_email') );
		  $buzzstore_quick_phone = esc_attr( get_theme_mod('buzzstore_quick_phone') );
        ?>
    		<ul>
                <?php if( !empty( $buzzstore_map_address ) ) { ?>
                    <li>
                        <span class="icon-location-pin"></span>
                        <a target="_blank" href="https://www.google.com.np/maps/place/<?php echo esc_attr( $buzzstore_map_address ); ?>"><?php echo esc_attr( $buzzstore_map_address ); ?></a>
                    </li>
                <?php } if( !empty( $buzzstore_quick_email ) ) { ?>
                    <li>
        				<span class="icon-envelope-open"></span>
        				<a href="mailto:'<?php echo esc_attr( antispambot( $buzzstore_quick_email ) ); ?>"><?php echo esc_attr( antispambot( $buzzstore_quick_email ) ); ?></a>
        			</li>
                <?php } if( !empty( $buzzstore_quick_phone ) ) { ?>
        			<li>
        				<span class="icon-call-out" aria-hidden="true"></span>
        				<a href="callto:'<?php echo esc_attr( $buzzstore_quick_phone ); ?>"><?php echo esc_attr( $buzzstore_quick_phone ); ?></a>
        			</li>
                <?php } ?>					
    		</ul>
        <?php
	}
}


/**
 * Buzz Store Social Links Options
*/
if ( ! function_exists( 'buzzstore_social_links' ) ) {
    function buzzstore_social_links() { ?>
        <ul class="buzz-socila-link">
            <?php if ( esc_url( get_theme_mod('buzzstore_social_facebook') ) ) : ?>
                <li><a href="<?php echo esc_url( get_theme_mod( 'buzzstore_social_facebook' ) ); ?>" <?php if( esc_attr( get_theme_mod( 'buzzstore_social_facebook_checkbox', 0 ) ) == 1 ): echo "target=_blank"; endif;?>><span class="icon-social-facebook" aria-hidden="true"></span></a> </li>
            <?php endif;?>
            <?php if ( esc_url( get_theme_mod( 'buzzstore_social_twitter' ) ) ) : ?>
                <li><a href="<?php echo esc_url( get_theme_mod( 'buzzstore_social_twitter' ) ); ?>" <?php if( esc_attr( get_theme_mod( 'buzzstore_social_twitter_checkbox', 0 ) ) == 1): echo "target=_blank"; endif;?>><span class="icon-social-twitter" aria-hidden="true"></span></a> </li>
            <?php endif;?>

            <?php if ( esc_url( get_theme_mod( 'buzzstore_social_googleplus') ) ) : ?>
                <li><a href="<?php echo esc_url( get_theme_mod( 'buzzstore_social_googleplus' ) ); ?>" <?php if( esc_attr( get_theme_mod( 'buzzstore_social_googleplus_checkbox', 0 ) ) == 1): echo "target=_blank"; endif;?>><span class="icon-social-google" aria-hidden="true"></span></a> </li>
            <?php endif;?>

            <?php if ( esc_url( get_theme_mod( 'buzzstore_social_instagram' ) ) ) : ?>
                <li><a href="<?php echo esc_url( get_theme_mod( 'buzzstore_social_instagram' ) ) ;?>" <?php if( esc_attr( get_theme_mod( 'buzzstore_social_instagram_checkbox', 0 ) ) == 1): echo "target=_blank"; endif;?>><span class="icon-social-instagram" aria-hidden="true"></span></a> </li>
            <?php endif;?>

            <?php if ( esc_url( get_theme_mod( 'buzzstore_social_pinterest' ) ) ) : ?>
                <li><a href="<?php echo esc_url( get_theme_mod( 'buzzstore_social_pinterest' ) ); ?>" <?php if( esc_attr( get_theme_mod( 'buzzstore_social_pinterest_checkbox', 0 ) ) == 1): echo "target=_blank"; endif;?>><span class="icon-social-pinterest" aria-hidden="true"></span></a> </li>
            <?php endif;?>

            <?php if ( esc_url( get_theme_mod( 'buzzstore_social_youtube' ) ) ) : ?>
                <li><a href="<?php echo esc_url( get_theme_mod( 'buzzstore_social_youtube' ) ); ?>" <?php if( esc_attr( get_theme_mod( 'buzzstore_social_youtube_checkbox', 0 ) ) == 1): echo "target=_blank"; endif;?>><span class="icon-social-youtube" aria-hidden="true"></span></a> </li>
            <?php endif;?>
        </ul>
    <?php 
    }
}

/************************************************************
** End Left Section ** Start Right Section                 **
*************************************************************/


/***************************************************
** Main Header Section                            **
***************************************************/

/**
 * Main logo section 
*/
if ( ! function_exists( 'buzzstore_search_options' ) ){
    function buzzstore_search_options(){
        $buzz_search_options = intval( get_theme_mod( 'buzzstore_search_options', 1 ) );
        $buzzstore_search_type = esc_attr( get_theme_mod( 'buzzstore_search_type', 'no' ) );       
        if(!empty($buzz_search_options) && $buzz_search_options == 1){
            if(!empty($buzzstore_search_type) && $buzzstore_search_type == 'no' ){
               if( buzzstore_is_woocommerce_activated() ) { buzzstore_adc_product_search_form(); }
            } else { 
                get_product_search_form();
            }
        }
    }
}
add_action('buzzstore_search','buzzstore_search_options');



/**
 * Buzz Store Credit section
*/
if ( ! function_exists( 'buzzstore_credit' ) ) {
    function buzzstore_credit() { ?>
            <span class="footer_copyright wow fadeInLeft" data-wow-delay="0.3s">
                <?php $copyright = esc_textarea( get_theme_mod( 'buzzstore_footer_buttom_copyright_setting' ) ); if( !empty( $copyright ) ) { ?>
                    <?php echo apply_filters( 'buzzstore_copyright_text', $copyright . ' - ' . get_bloginfo( 'name' ) ); ?> 
                <?php } else { ?>
                    <?php echo esc_html( apply_filters( 'buzzstore_copyright_text', $content = 'Copyright &copy; ' . date_i18n( 'Y' ) . ' - ' . get_bloginfo( 'name' ) ) ); ?>
                <?php } ?>
                <?php if ( apply_filters( 'buzzstore_credit_link', true ) ) { 
                    printf( __( '%1$s Kids Fashion | Powered by %2$s', 'buzzstore' ), ' ', '<span class="subfooter"><a href=" ' . esc_url('mailto:dimbergy@gmail.com') . ' "  target="_self">Dimitrios Vergados</a></span' ); ?>
                <?php } ?>
            </span><!-- .site-info -->
        <?php
    }
}
add_filter( 'buzzstore_credit', 'buzzstore_credit', 5 );


/**
 * Custom Control for Customizer Page Layout Settings
*/
if( class_exists( 'WP_Customize_control') ) {
    
    class BuzzStore_Image_Radio_Control extends WP_Customize_Control {
        public $type = 'radioimage';
        public function render_content() {
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div id="input_<?php echo esc_attr( $this->id ); ?>" class="buzzimage">
                <?php foreach ( $this->choices as $value => $label ) : ?>                
                        <label for="<?php echo esc_attr( $this->id ) . esc_attr($value); ?>">
                            <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . esc_attr($value); ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                            <img src="<?php echo esc_html( $label ); ?>"/>
                        </label>
                <?php endforeach; ?>
            </div>
            <?php 
        }
    }

    class BuzzStore_Category_Dropdown extends WP_Customize_Control{
        private $cats = false;
        public function __construct($manager, $id, $args = array(), $options = array()){
            $this->cats = get_categories($options);
            parent::__construct( $manager, $id, $args );
        }

        public function render_content(){
            if(!empty($this->cats)){
                ?>
                    <label>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                        <?php
                            foreach ( $this->cats as $cat ){
                                printf('<option value="%1$s" %2$s>%3$s</option>', esc_attr($cat->term_id), selected($this->value(), $cat->term_id, false), esc_attr( $cat->name ));
                            }
                        ?>
                      </select>
                    </label>
                    <?php if($this->description){ ?>
                        <span class="description customize-control-description">
                        <?php echo wp_kses_post($this->description); ?>
                        </span>
                <?php }
            }
       }
    }

    class BuzzStore_theme_Info_Text extends WP_Customize_Control{
        public function render_content(){  ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php }
        }
    }
}

/**
 * Remove Excerpt ... Function
*/
function buzzstore_excerpt($text) {
  return '...';
}
add_filter('excerpt_more', 'buzzstore_excerpt');

/**
 * Buzzstore breadcrumbs function area
*/
if (!function_exists('buzzstore_breadcrumbs')) {
  function buzzstore_breadcrumbs() {
    global $post;
      $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
      $delimiter = '/';    
      $home = esc_html__('Home', 'buzzstore'); // text for the 'Home' link
      $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
      $before = ''; // tag before the current crumb
      $after = ''; // tag after the current crumb
      $homeLink = esc_url( home_url() );

      if (is_home() || is_front_page()) {
        if ($showOnHome == 1)
          echo '<ul><li><a href="' . esc_url($homeLink) . '">' . esc_attr($home) . '</a></ul></li>';
      } else {
          echo '<ul><li><a href="' . esc_url($homeLink) . '">' . esc_attr($home) . '</a> ' . esc_attr($delimiter) . ' ';
        if (is_category()) {
          $thisCat = get_category( get_query_var('cat') , false);
          if ($thisCat->parent != 0)
            echo esc_attr( get_category_parents($thisCat->parent, TRUE, ' ' . esc_attr($delimiter) . ' ') );
          echo esc_html__('Archive by category','buzzstore').' "' . single_cat_title('', false) . '" ';
        } elseif (is_search()) {
          echo esc_html__('Search results for','buzzstore'). '"' . get_search_query() . '"';
        } elseif (is_day()) {
          echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . ' ';
          echo '<a href="' . esc_url(get_month_link(get_the_time('Y')), esc_attr(get_the_time('m'))) . '">' . esc_attr(get_the_time('F')) . '</a> ' . esc_attr($delimiter) . ' ';
          echo esc_attr(get_the_time('d'));
        } elseif (is_month()) {
          echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . ' ';
          echo esc_attr(get_the_time('F'));
        } elseif (is_year()) {
          echo esc_attr(get_the_time('Y'));
        } elseif (is_single() && !is_attachment()) {
          
          if (get_post_type() != 'post') {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_attr($post_type->labels->singular_name) . '</a>';
            if ($showCurrent == 1)
              echo ' ' . esc_attr($delimiter) . ' ' . wp_kses_post($before) . esc_attr(get_the_title()) . wp_kses_post($after);
          } else {
            $cat = get_the_category();
            $cat = $cat[0];
            $cats = get_category_parents( $cat, TRUE, ' ' . esc_html( $delimiter) . ' ');
            if ($showCurrent == 0)
              $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
            echo wp_kses_post( $cats );
            if ($showCurrent == 1)
              echo esc_attr(get_the_title());
          }

        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
          $post_type = get_post_type_object(get_post_type());
          echo esc_attr($post_type->labels->singular_name);
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat    = get_the_category($parent->ID);
            if ( isset($cat) && !empty($cat)) {
                $cat    = $cat[0];
                echo wp_kses_post( get_category_parents( $cat, TRUE, ' ' . esc_html( $delimiter ) . ' ') );
                echo '<li><a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_attr( $parent->post_title ) . '</a></li>';
            }
            if ($showCurrent == 1)
                echo wp_kses_post($before) . esc_attr(get_the_title()) . wp_kses_post($after);
        } elseif (is_page() && !$post->post_parent) {
          if ($showCurrent == 1){
            echo esc_attr(get_the_title());
          }
        } elseif (is_page() && $post->post_parent) {
          $parent_id = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            if(!empty($parent_id)){
              $page = get_post($parent_id);
              $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . esc_attr(get_the_title($page->ID)) . '</a>';
              $parent_id = $page->post_parent;
            }
          }
          $breadcrumbs = array_reverse( $breadcrumbs );
          for ($i = 0; $i < esc_attr( count( $breadcrumbs ) ); $i++ ) {
            echo wp_kses_post( $breadcrumbs[$i] );
            if ($i != count( $breadcrumbs) - 1)
              echo ' ' . esc_attr( $delimiter ) . ' ';
          }
          if ($showCurrent == 1){
            echo ' ' . esc_attr($delimiter) . ' ' . wp_kses_post($before) . esc_attr(get_the_title()) . wp_kses_post($after);
          }
        } elseif (is_tag()) {
          echo esc_html__('Posts tagged','buzzstore').' "' . single_tag_title('', false) . '"';
        } elseif (is_author()) {
          global $author;
          $userdata = get_userdata($author);
          echo esc_html__('Articles posted by ','buzzstore'). esc_attr($userdata->display_name);
        } elseif (is_404()) {
          echo esc_html__('Error 404','buzzstore');
        }

        if (get_query_var('paged')) {
          if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()){
            echo ' (';
            echo esc_html__('Page', 'buzzstore') . ' ' . esc_attr(get_query_var('paged'));
          }
          if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()){
                echo ')';
        }
      }
      echo '</ul></li>';
    }
  }
}

/**
 * Schema type
*/
function buzzstore_html_tag_schema() {
    $schema     = 'http://schema.org/';
    $type       = 'WebPage';
    // Is single post
    if ( is_singular( 'post' ) ) {
        $type   = 'Article';
    }
    // Is author page
    elseif ( is_author() ) {
        $type   = 'ProfilePage';
    }
    // Is search results page
    elseif ( is_search() ) {
        $type   = 'SearchResultsPage';
    }
    echo 'itemscope="itemscope" itemtype="' . esc_attr( $schema ) . esc_attr( $type ) . '"';
}



/**
 * Page and Post Page Display Layout Metabox function
*/
add_action('add_meta_boxes', 'buzzstore_metabox_section');
if ( ! function_exists( 'buzzstore_metabox_section' ) ) {
    function buzzstore_metabox_section(){   
        add_meta_box('buzzstore_display_layout', 
            __( 'Display Layout Options', 'buzzstore' ), 
            'buzzstore_display_layout_callback', 
            array('page','post'), 
            'normal', 
            'high'
        );
    }
}

$buzzstore_page_layouts =array(
    'leftsidebar' => array(
        'value'     => 'leftsidebar',
        'label'     => esc_html__( 'Left Sidebar', 'buzzstore' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
    ),
    'rightsidebar' => array(
        'value'     => 'rightsidebar',
        'label'     => esc_html__( 'Right (Default)', 'buzzstore' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
    ),
     'nosidebar' => array(
        'value'     => 'nosidebar',
        'label'     => esc_html__( 'Full width', 'buzzstore' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
    ),
    'bothsidebar' => array(
        'value'     => 'bothsidebar',
        'label'     => esc_html__( 'Both Sidebar', 'buzzstore' ),
        'thumbnail' => get_template_directory_uri() . '/assets/images/both-sidebar.png',
    )
);

/**
 * Function for Page layout meta box
*/
if ( ! function_exists( 'buzzstore_display_layout_callback' ) ) {
    function buzzstore_display_layout_callback(){
        global $post, $buzzstore_page_layouts;
        wp_nonce_field( basename( __FILE__ ), 'buzzstore_settings_nonce' ); ?>
        <table>
            <tr>
              <td>            
                <?php
                  $i = 0;  
                  foreach ($buzzstore_page_layouts as $field) {  
                  $buzzstore_page_metalayouts = esc_attr( get_post_meta( $post->ID, 'buzzstore_page_layouts', true ) ); 
                ?>            
                  <div class="radio-image-wrapper slidercat" id="slider-<?php echo intval( $i ); ?>" style="float:left; margin-right:30px;">
                    <label class="description">
                        <span>
                          <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </span></br>
                        <input type="radio" name="buzzstore_page_layouts" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( esc_html( $field['value'] ), 
                            $buzzstore_page_metalayouts ); if(empty($buzzstore_page_metalayouts) && esc_html( $field['value'] ) =='rightsidebar'){ echo "checked='checked'";  } ?>/>
                         <?php echo esc_html( $field['label'] ); ?>
                    </label>
                  </div>
                <?php  $i++; }  ?>
              </td>
            </tr>            
        </table>
    <?php
    }
}

/**
 * Save the custom metabox data
*/
if ( ! function_exists( 'buzzstore_save_page_settings' ) ) {
    function buzzstore_save_page_settings( $post_id ) { 
        global $buzzstore_page_layouts, $post;
         if ( !isset( $_POST[ 'buzzstore_settings_nonce' ] ) || !wp_verify_nonce( sanitize_key( $_POST[ 'buzzstore_settings_nonce' ] ) , basename( __FILE__ ) ) ) 
            return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
            return;        
        if (isset( $_POST['post_type'] ) && 'page' == $_POST['post_type']) {  
            if (!current_user_can( 'edit_page', $post_id ) )  
                return $post_id;  
        } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
                return $post_id;  
        }  

        foreach ($buzzstore_page_layouts as $field) {  
            $old = esc_attr( get_post_meta( $post_id, 'buzzstore_page_layouts', true) );
            if ( isset( $_POST['buzzstore_page_layouts']) ) { 
                $new = sanitize_text_field( wp_unslash( $_POST['buzzstore_page_layouts'] ) );
            }
            if ($new && $new != $old) {  
                update_post_meta($post_id, 'buzzstore_page_layouts', $new);  
            } elseif ('' == $new && $old) {  
                delete_post_meta($post_id,'buzzstore_page_layouts', $old);  
            } 
         } 
    }
}
add_action('save_post', 'buzzstore_save_page_settings');