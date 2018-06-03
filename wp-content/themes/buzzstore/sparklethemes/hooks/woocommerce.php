<?php
/**
 *  Add the Link to Quick View Function
*/
if( defined( 'YITH_WCQV' ) ){
  function buzzstore_quickview(){
    global $product;
    $quick_view = YITH_WCQV_Frontend();
    remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
    $label = esc_html( get_option( 'yith-wcqv-button-label' ) ); ?>
    <a href="javascript:void(0)">
        <span aria-hidden="true" class="icon-eye"></span>
        <div class="link-quickview yith-wcqv-button product-item_tip transition" data-product_id="<?php echo esc_attr( $product->get_id() ) ?>">
            <?php echo esc_attr( $label ); ?>
        </div>
    </a>
    <?php
  }
}

/**
 *  Add the Link to Compare Function
*/
if( defined( 'YITH_WOOCOMPARE' ) ){  
  function buzzstore_add_compare_link( $product_id = false, $args = array() ) {
      extract( $args );

      if ( ! $product_id ) {
          global $product;
          $productid = $product->get_id();
          $product_id = intval(isset( $productid ) ? $productid : 0 );
      }
      
      $is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

      if ( ! isset( $button_text ) || $button_text == 'default' ) {
          $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'buzzstore' ) );
          yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
          $button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
      }

      printf( '<a href="%1$s" class="%2$s" data-product_id="%3$d" rel="nofollow"><span aria-hidden="true" class="icon-compass"></span>
        <div class="product-item_tip transition" data-product_id="' . intval( $product->get_id() ) . '">%4$s</div></a>', 'javascript:void(0)', 'compare link-compare' . ( $is_button == 'button' ? ' button' : '' ), intval( $product_id ), esc_attr( $button_text ) );
  }
  remove_action( 'woocommerce_after_shop_loop_item',  array( 'YITH_Woocompare_Frontend', 'add_compare_link' ), 20 );
}

/**
 * Product Wishlist Button Function
*/
if (defined( 'YITH_WCWL' )) {  
  function buzzstore_wishlist_products() {      
        global $product;
        $url = add_query_arg( 'add_to_wishlist', $product->get_id() );
        $id = $product->get_id();
        $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>     

        <div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">
            
            <div class="yith-wcwl-add-button show" style="display:block">
              <a href="<?php echo esc_url( $url ); ?>" data-toggle="tooltip" data-placement="top" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" title="<?php esc_html_e( 'Add to Wishlist', 'buzzstore' ); ?>" class="add_to_wishlist link-wishlist">
                <span aria-hidden="true" class="icon-heart"></span>
                <div class="product-item_tip transition">
                  <?php esc_html_e( 'Add Wishlist', 'buzzstore' ); ?>
                </div>
              </a>
              <img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/loading.gif'; ?>" class="ajax-loading" alt="loading" width="16" height="16">
            </div>

            <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">              
              <a class="link-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>">
                <span aria-hidden="true" class="icon-heart"></span>                
                <div class="product-item_tip transition">
                  <?php esc_html_e( 'View Wishlist', 'buzzstore' ); ?>
                </div>
              </a>
            </div>

            <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">              
              <a class="link-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>">
                <span aria-hidden="true" class="icon-heart"></span>
                <div class="product-item_tip transition">
                  <?php esc_html_e( 'Browse Wishlist', 'buzzstore' ); ?>
                </div>
              </a>
            </div>

            <div class="clear"></div>
            <div class="yith-wcwl-wishlistaddresponse"></div>

        </div>

       <?php
  }

  /**
   * Wishlist Header Count Ajax Function
  **/
  if ( ! function_exists( 'buzzstore_products_wishlist' ) ) {
      function buzzstore_products_wishlist() {
        if ( function_exists( 'YITH_WCWL' ) ) { 
              $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
              <div class="top-wishlist text-right">                
                <a href="<?php echo esc_url( $wishlist_url ); ?>" title="Wishlist" data-toggle="tooltip">
                  <div class="count">
                    <div class="bigcounter">
                        <span class="icon-heart"></span>
                        <?php esc_html_e('Wishlist','buzzstore'); ?><?php echo " (" . intval(yith_wcwl_count_products()) . ") "; ?>
                      </div>
                  </div>
                </a>
              </div>
          <?php
          }
      }
  }
  add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'buzzstore_products_wishlist' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_single_product_list', 'buzzstore_products_wishlist' );
}

/**
 * Shopping cart button function area
*/
if ( ! function_exists( 'buzzstore_cart_link' ) ) {
  function buzzstore_cart_link() { ?>
      <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'buzzstore' ); ?>">
          <span class="count">
            <?php echo wp_kses_data( sprintf( _n( '%d item -', '%d item(s) -', WC()->cart->get_cart_contents_count(), 'buzzstore' ), WC()->cart->get_cart_contents_count() ) ); ?>
          </span>
          <span class="amount">
            <?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
          </span> 
      </a>
      <?php
  }
}

/**
 * Shopping cart button Ajax function area
*/
if ( ! function_exists( 'buzzstore_cart_link_fragment' ) ) {
  function buzzstore_cart_link_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    buzzstore_cart_link();
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
  }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'buzzstore_cart_link_fragment' );

/**
 * WooCommerce advance search function area here
*/
if(!function_exists ('buzzstore_adc_product_search_form')){
    function buzzstore_adc_product_search_form(){   
        $bs_search_placeholder = esc_html( get_theme_mod('buzzstore_search_options_placeholder','Product Search...'));   
        $args = array(
            'number'     => '',
            'orderby'    => 'name',
            'order'      => 'ASC',
            'hide_empty' => true,
        );
        $product_categories = get_terms( 'product_cat', $args ); 
        $categories_show = '<option value="">'.esc_html__('All Categories','buzzstore').'</option>';
        $check = '';
        if(is_search()){
            if(isset($_GET['term']) && $_GET['term']!=''){
                $check = sanitize_text_field( wp_unslash( $_GET['term'] ) ); 
            }
        }
        $checked = '';
        foreach($product_categories as $category){
            if(isset( $category->slug )){
                if(trim($category->slug) == trim($check)){
                    $checked = 'selected="selected"';
                }
                $categories_show  .= '<option '.$checked.' data-tokens="'.esc_html( $category->slug ).'"  value="'.esc_html( $category->slug ).'">'.esc_html( $category->name ).'</option>';
                $checked = '';
            }
        }      

        $form = '<div class="header-search buzzstore_adc_search">
                    <div class="header-search_form">
                        <form class="product-search form-inline" role="search" method="get" id="searchform" action="' . esc_url( home_url( '/'  ) ) . '">
                            <div class="header-search_filter">
                                <select class="formDropdown" name="term">'.$categories_show.'</select>
                                <i class="fa fa-angle-down customColor"></i>
                            </div>
                            <div class="form-group">
                                <input class="product-search-field" type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' .$bs_search_placeholder. '" />
                            </div>
                            <button type="submit" class="product-search">
                                <i class="fa fa-search"></i>
                            </button>
                            <input type="hidden" name="post_type" value="product" />
                            <input type="hidden" name="taxonomy" value="product_cat" />
                        </form>
                    </div>
                </div>';  
        echo $form;       
    }
}

/**
 * Load buzzstore woocommerce Action and Filter.
*/
function buzzstore_woocommerce_breadcrumb(){
  do_action( 'breadcrumb-woocommerce' );
}
add_action( 'woocommerce_before_main_content','buzzstore_woocommerce_breadcrumb', 9 );

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

function buzzstore_woocommerce_template_loop_product_thumbnail(){ ?>
    <div class="product-item">
        <div class="product-item-body">

            <a href="<?php the_permalink(); ?>" class="product-item-link">
              <?php echo woocommerce_get_product_thumbnail(); ?>
            </a>

            <?php global $post, $product; if ( $product->is_on_sale() ) : 
              echo apply_filters( 'woocommerce_sale_flash', '<div class="buzz-sale-label buzz-top-right">' . esc_html__( 'Sale!', 'buzzstore' ) . '</div>', $post, $product ); ?>
            <?php endif; ?>

            <?php
               global $product_label_custom;
               if ($product_label_custom != ''){
                echo '<div class="buzz-sale-label buzz-top-left">'.esc_html__('New','buzzstore').'</div>';
               }
            ?>
            <?php if( function_exists( 'buzzstore_quickview' ) || function_exists( 'buzzstore_add_compare_link' ) || function_exists( 'buzzstore_wishlist_products' ) ){ ?>
              <ul class="product-item-info transition">
                  <?php if(function_exists( 'buzzstore_quickview' )) { ?>
                      <li>
                          <?php  buzzstore_quickview(); ?>
                      </li>
                  <?php } ?>

                  <?php if(function_exists( 'buzzstore_add_compare_link' )) { ?>
                      <li>
                          <?php  buzzstore_add_compare_link(); ?>
                      </li>
                  <?php } ?>

                  <?php if(function_exists( 'buzzstore_wishlist_products' )) { ?>
                      <li>
                          <?php  buzzstore_wishlist_products(); ?>
                      </li>
                  <?php } ?>
              </ul>
            <?php } ?>
        </div>
    </div>    
  <?php 
}
add_action( 'woocommerce_before_shop_loop_item_title', 'buzzstore_woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

if (!function_exists('buzzstore_woocommerce_shop_loop_item_title')) {
    function buzzstore_woocommerce_shop_loop_item_title(){ ?>      
        <div class="product-item-details">
          <a class="product-title" href="<?php the_permalink(); ?>">
              <?php the_title( ); ?>
          </a>
      <?php 
    }
}
add_action( 'woocommerce_shop_loop_item_title', 'buzzstore_woocommerce_shop_loop_item_title', 10 );


remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
function buzzstore_woocommerce_after_shop_loop_item_title() { ?>
    <div class="price-rating-wrap buzz-clearfix">        
        <?php woocommerce_template_loop_price(); ?>
        <?php woocommerce_template_loop_rating(); ?>
    </div>
<?php }
add_action('woocommerce_after_shop_loop_item_title', 'buzzstore_woocommerce_after_shop_loop_item_title');



if (!function_exists('buzzstore_woocommerce_product_item_details_close')) {
    function buzzstore_woocommerce_product_item_details_close(){ ?>
      </div>
      <?php 
    }
}
add_action( 'woocommerce_template_loop_price', 'buzzstore_woocommerce_product_item_details_close', 9 );


/**
 * WooCommerce add content primary div function
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('buzzstore_woocommerce_output_content_wrapper')) {
    function buzzstore_woocommerce_output_content_wrapper(){ ?>
      <div class="buzz-container buzz-clearfix">
        <div class="buzz-row buzz-clearfix">
            <div id="primary" class="content-area">
              <main id="main" class="site-main" role="main">
    <?php }
}
add_action( 'woocommerce_before_main_content', 'buzzstore_woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
if (!function_exists('buzzstore_woocommerce_output_content_wrapper_end')) {
    function buzzstore_woocommerce_output_content_wrapper_end(){ ?>
              </main><!-- #main -->
            </div><!-- #primary -->
            <?php get_sidebar('woocommerce'); ?>
        </div>
      </div>
    <?php }
}
add_action( 'woocommerce_after_main_content', 'buzzstore_woocommerce_output_content_wrapper_end', 10 );
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Woo Commerce Number of row filter Function
*/
add_filter('loop_shop_columns', 'buzzstore_loop_columns');
if (!function_exists('buzzstore_loop_columns')) {
    function buzzstore_loop_columns() {
        $product_num = intval( get_theme_mod('buzzstore_woocommerce_category_product_per_page','3') );
        if( $product_num ){
            $number = $product_num;
        } else {
            $number = 3;
        }
        return $number;
    }
}

add_action( 'body_class', 'buzzstore_woo_body_class');
if (!function_exists('buzzstore_woo_body_class')) {
    function buzzstore_woo_body_class( $class ) {
           $class[] = 'columns-'.buzzstore_loop_columns();
           return $class;
    }
}

/**
 * WooCommerce display related product.
*/
if (!function_exists('buzzstore_related_products_args')) {
  function buzzstore_related_products_args( $args ) {
      $args['posts_per_page']   = intval( get_theme_mod('buzzstore_woocommerce_product_page_related_product_number', 6 ) );
      $args['columns']          = intval( get_theme_mod('buzzstore_woocommerce_category_product_per_page','3') );
      return $args;
  }
}
add_filter( 'woocommerce_output_related_products_args', 'buzzstore_related_products_args' );

/**
 * WooCommerce display upsell product.
*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
if ( ! function_exists( 'buzzstore_woocommerce_upsell_display' ) ) {
  function buzzstore_woocommerce_upsell_display() {
      $display_number_product   = intval( get_theme_mod('buzzstore_woocommerce_product_page_upsells_product_number', 6) );
      $display_col_product      = intval( get_theme_mod('buzzstore_woocommerce_category_product_per_page','3') );
      woocommerce_upsell_display( $display_number_product, $display_col_product ); 
  }
}
add_action( 'woocommerce_after_single_product_summary', 'buzzstore_woocommerce_upsell_display', 15 );


/**
 * Woo Commerce Number of Columns filter Function
*/
$display_number_product_per_page = intval( get_theme_mod('buzzstore_woocommerce_category_per_page_product_number', '12') );
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$display_number_product_per_page.';' ), 20 );