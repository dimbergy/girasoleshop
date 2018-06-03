<?php

if ( buzzstore_is_woocommerce_activated() ) {

    /**
     * Adds buzzstore_category_product_widget widget.
    */
    add_action('widgets_init', 'buzzstore_category_product_widget');
    function buzzstore_category_product_widget() {
      register_widget('buzzstore_category_product_widget_area');
    }

    class buzzstore_category_product_widget_area extends WP_Widget {

      /**
       * Register widget with WordPress.
      */
      public function __construct() {
          parent::__construct(
              'buzzstore_category_product_widget_area', esc_html__('Buzz: Woo Category Product Area','buzzstore'), array(
              'description' => esc_html__('A widget that shows woocommerce related category products.', 'buzzstore')
          ));
      }
      
      private function widget_fields() {
          

          $taxonomy     = 'product_cat';
          $empty        = 1;
          $orderby      = 'name';  
          $show_count   = 0;      // 1 for yes, 0 for no
          $pad_counts   = 0;      // 1 for yes, 0 for no
          $hierarchical = 1;      // 1 for yes, 0 for no  
          $title        = '';  
          $empty        = 0;
          $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
          );

          $woocommerce_categories = array();
          $woocommerce_categories_obj = get_categories($args);
          foreach ($woocommerce_categories_obj as $category) {
            $woocommerce_categories[$category->term_id] = $category->name;
          }

          $fields = array( 
              
              'buzzstore_product_title' => array(
                  'buzzstore_widgets_name' => 'buzzstore_product_title',
                  'buzzstore_widgets_title' => esc_html__('Title', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'title',
              ),

              'buzzstore_product_short_desc' => array(
                  'buzzstore_widgets_name' => 'buzzstore_product_short_desc',
                  'buzzstore_widgets_title' => esc_html__('Very Short Description', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'text'
              ),

              'buzzstore_category_product_type' => array(
                  'buzzstore_widgets_name' => 'buzzstore_category_product_type',
                  'buzzstore_mulicheckbox_title' => esc_html__('Select Products Categorys', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'multicheckboxes',
                  'buzzstore_widgets_field_options' => $woocommerce_categories
              ),
              
              'buzzstore_product_number' => array(
                  'buzzstore_widgets_name' => 'buzzstore_product_number',
                  'buzzstore_widgets_title' => esc_html__('Enter Number of Products Show', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'number',
              ),                                 
          );

          return $fields;
      }

      public function widget($args, $instance) {
          extract($args);
          extract($instance);
          
          /**
           * wp query for first block
          */  
          $title          = empty( $instance['buzzstore_product_title'] ) ? '' : $instance['buzzstore_product_title']; 
          $shot_desc      = empty( $instance['buzzstore_product_short_desc'] ) ? '' : $instance['buzzstore_product_short_desc'];
          $categories     = empty( $instance['buzzstore_category_product_type'] ) ? '' : $instance['buzzstore_category_product_type'];
          $product_number = intval( empty( $instance['buzzstore_product_number'] ) ? '' : $instance['buzzstore_product_number'] );

          $product_args       =   '';
          global $product_label_custom;
         
          echo $before_widget; 
      ?>      
        <section id="collection" class="buzzSeparator home-section">            
          <div class="buzz-container buzz-clearfix relative">                    
              
              <div class="buzz-titlewrap">
                <?php if(!empty( $title )) { ?>
                    <h2 class="buzz-title wow zoomIn">
                        <?php echo esc_html($title); ?>
                    </h2>
                <?php }  if(!empty( $shot_desc )) { ?>
                    <p class="buzz-subTitle wow zoomIn">
                        <?php echo esc_html($shot_desc); ?>
                    </p>
                <?php } ?>
              </div>

              <div class="starSeparatorBox"> 

                  <div class="starSeparator">
                      <span class="icon-star" aria-hidden="true"></span>
                  </div>

                  <?php
                    if (!empty($categories) && !is_wp_error($categories)) {

                        echo "<ul id='filter' class='product-filter'>";
                            echo '<li><a href="#" class="btn current" data-filter="*">' . esc_html__('All', 'buzzstore') . '</a></li>';
                            foreach ($categories as $key => $category) { 
                                $term = get_term_by( 'id', $key, 'product_cat');
                                echo '<li><a href="#" class="btn" data-filter=.' . esc_attr( $term->slug ) . '>' . esc_attr( $term->name ) . '</a></li>';
                            }
                        echo "</ul>";
                    }
                  ?>
                  <div class="isotope-frame wow fadeInUp" data-wow-delay="0.3s">
                      <div class="isotope-filter">
                          <?php                                      
                              foreach ($categories as $term_key => $term_list) {                                      
                                $term = get_term_by( 'id', $term_key, 'product_cat');
                                $term_id = $term->term_id;                                    
                                $product_args = array(
                                    'post_type' => 'product',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy'  => 'product_cat',
                                            'field'     => 'id', 
                                            'terms'     => $term_id                                                                 
                                        )),
                                    'posts_per_page' => $product_number
                                );
                                $query = new WP_Query($product_args);
                                if($query->have_posts()) { while($query->have_posts()) { $query->the_post();

                                $buzzterms = wp_get_post_terms(get_the_ID(),'product_cat', array("fields" => "all"));
                                $term_slugs = array();
                                foreach ($buzzterms as $buzzterm) {
                                    $term_slugs[] = $buzzterm->slug;
                                }
                                $term_slugs = join(' ', $term_slugs);
                          ?>
                          
                          <div class="isotope-item <?php echo esc_html( $term_slugs ); ?>">
                              
                              <?php wc_get_template_part( 'content', 'product' ); ?>

                          </div>

                          <?php } }  } wp_reset_postdata(); ?>

                      </div>
                  </div>

              </div>
          </div>
        </section>
          

      <?php  echo $after_widget;    }
     
      public function update($new_instance, $old_instance) {
          $instance = $old_instance;
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $instance[$buzzstore_widgets_name] = buzzstore_widgets_updated_field_value($widget_field, $new_instance[$buzzstore_widgets_name]);
          }
          return $instance;
      }

      public function form($instance) {
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $buzzstore_widgets_field_value = !empty($instance[$buzzstore_widgets_name]) ? $instance[$buzzstore_widgets_name] : '';
              buzzstore_widgets_show_widget_field($this, $widget_field, $buzzstore_widgets_field_value);
          }
      }
    }

    /**
     * Adds buzzstore_product_widget widget.
    */
    add_action('widgets_init', 'buzzstore_product_widget');
    function buzzstore_product_widget() {
      register_widget('buzzstore_product_widget_area');
    }

    class buzzstore_product_widget_area extends WP_Widget {

      /**
       * Register widget with WordPress.
      **/
      public function __construct() {
          parent::__construct(
              'buzzstore_product_widget_area', esc_html__('Buzz: Woo Product Area','buzzstore'), array(
              'description' => esc_html__('A widget that shows woocommerce all type product (Latest, Feature, On Sale, Up Sale) and selected category products', 'buzzstore')
          ));
      }
      
      private function widget_fields() {          

          $prod_type = array(
            'category'        => esc_html__('Category', 'buzzstore'),
            'latest_product'  => esc_html__('Latest Product', 'buzzstore'),
            'upsell_product'  => esc_html__('UpSell Product', 'buzzstore'),
            'feature_product' => esc_html__('Feature Product', 'buzzstore'),
            'on_sale'         => esc_html__('On Sale Product', 'buzzstore'),
          );

            $taxonomy     = 'product_cat';
            $empty        = 1;
            $orderby      = 'name';  
            $show_count   = 0;      // 1 for yes, 0 for no
            $pad_counts   = 0;      // 1 for yes, 0 for no
            $hierarchical = 1;      // 1 for yes, 0 for no  
            $title        = '';  
            $empty        = 0;
            $args = array(
              'taxonomy'     => $taxonomy,
              'orderby'      => $orderby,
              'show_count'   => $show_count,
              'pad_counts'   => $pad_counts,
              'hierarchical' => $hierarchical,
              'title_li'     => $title,
              'hide_empty'   => $empty
            );

            $woocommerce_categories = array();
            $woocommerce_categories_obj = get_categories($args);
            $woocommerce_categories[''] = esc_html__('Select Product Category','buzzstore');
            foreach ($woocommerce_categories_obj as $category) {
              $woocommerce_categories[$category->term_id] = $category->name;
            }

          $fields = array( 
              
              'buzzstore_product_title' => array(
                  'buzzstore_widgets_name' => 'buzzstore_product_title',
                  'buzzstore_widgets_title' => esc_html__('Title', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'title',
              ),

              'buzzstore_product_short_desc' => array(
                  'buzzstore_widgets_name' => 'buzzstore_product_short_desc',
                  'buzzstore_widgets_title' => esc_html__('Very Short Description', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'text'
              ),

              'buzzstore_product_type' => array(
                  'buzzstore_widgets_name' => 'buzzstore_product_type',
                  'buzzstore_widgets_title' => esc_html__('Select Product Type', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'select',
                  'buzzstore_widgets_field_options' => $prod_type
              ),

              'buzzstore_woo_category' => array(
                  'buzzstore_widgets_name' => 'buzzstore_woo_category',
                  'buzzstore_widgets_title' => esc_html__('Select Category', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'select',
                  'buzzstore_widgets_field_options' => $woocommerce_categories
              ),

              'buzzstore_product_number' => array(
                  'buzzstore_widgets_name' => 'buzzstore_product_number',
                  'buzzstore_widgets_title' => esc_html__('Enter Number of Products Show', 'buzzstore'),
                  'buzzstore_widgets_field_type' => 'number',
              ),                                 
          );

          return $fields;
      }

      public function widget($args, $instance) {
          extract($args);
          extract($instance);
          
          /**
           * wp query for first block
          */  
          $title        = empty( $instance['buzzstore_product_title'] ) ? '' : $instance['buzzstore_product_title']; 
          $shot_desc    = empty( $instance['buzzstore_product_short_desc'] ) ? '' : $instance['buzzstore_product_short_desc'];
          $product_type = empty( $instance['buzzstore_product_type'] ) ? '' : $instance['buzzstore_product_type'];
          $product_category = intval( empty( $instance['buzzstore_woo_category'] ) ? '' : $instance['buzzstore_woo_category'] );
          $product_number   = intval( empty( $instance['buzzstore_product_number'] ) ? '' : $instance['buzzstore_product_number'] );

          $product_args       =   '';
          global $product_label_custom;
          
          if($product_type == 'category'){
              $product_args = array(
                  'post_type' => 'product',
                  'tax_query' => array(
                      array('taxonomy'  => 'product_cat',
                       'field'     => 'id', 
                       'terms'     => $product_category                                                                 
                      )
                  ),
                  'posts_per_page' => $product_number
              );
          }
          elseif($product_type == 'latest_product'){
              $product_label_custom = esc_html__('New', 'buzzstore');
              $product_args = array(
                  'post_type' => 'product',
                  'tax_query' => array(
                      array('taxonomy'  => 'product_cat',
                       'field'     => 'id', 
                       'terms'     => $product_category                                                                 
                      )
                  ),
                  'posts_per_page' => $product_number
              );
          }
          elseif($product_type == 'upsell_product'){
              $product_args = array(
                  'post_type'         => 'product',
                  'posts_per_page'    => 10,
                  'meta_key'          => 'total_sales',
                  'orderby'           => 'meta_value_num',
                  'posts_per_page'    => $product_number
              );
          }
          elseif($product_type == 'feature_product'){
              $product_args = array(
                  'post_type'        => 'product',  
                  'tax_query' => array(
                        'relation' => 'AND',      
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                        'operator' => 'IN'
                    ),
                    array(
                      'taxonomy'  => 'product_cat',
                      'field'     => 'term_id', 
                      'terms'     => $product_category                                                                 
                    )
                  ), 
                  'posts_per_page'   => $product_number   
              );
          }
          elseif($product_type == 'on_sale'){
              $product_args = array(
              'post_type'      => 'product',
              'posts_per_page'   => $product_number,
              'meta_query'     => array(
                  'relation' => 'OR',
                  array( // Simple products type
                      'key'           => '_sale_price',
                      'value'         => 0,
                      'compare'       => '>',
                      'type'          => 'numeric'
                  ),
                  array( // Variable products type
                      'key'           => '_min_variation_sale_price',
                      'value'         => 0,
                      'compare'       => '>',
                      'type'          => 'numeric'
                  )
              ));
          }
          
          echo $before_widget; 
      ?>      
      <section id="slider" class="slider-container home-section">            
        <div class="buzz-container buzz-clearfix relative">                    
              
          <div class="buzz-titlewrap">
            <?php if(!empty( $title )) { ?>
                <h2 class="buzz-title wow zoomIn" data-wow-delay="0.3s">
                    <?php echo esc_html($title); ?>
                </h2>
            <?php }  if(!empty( $shot_desc )) { ?>
                <p class="buzz-subTitle wow zoomIn" data-wow-delay="0.3s">
                    <?php echo esc_html($shot_desc); ?>
                </p>
            <?php } ?>
          </div>

          <div class="starSeparatorBox">                
            
            <div class="starSeparator wow zoomIn" data-wow-delay="0.3s">
              <span aria-hidden="true" class="icon-star"></span>
            </div>

            <div id="owl-product-slider" class="enable-owl-carousel owl-product-slider wow fadeInUp" data-wow-delay="0.7s" data-navigation="true" data-pagination="false" data-single-item="false" data-auto-play="false" data-transition-style="false" data-main-text-animation="false" data-min600="2" data-min800="3" data-min1200="4">
              
                <?php                         
                  $query = new WP_Query($product_args);
                  if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                ?>
                  <?php wc_get_template_part( 'content', 'product' ); ?>
                  
                <?php } } wp_reset_postdata(); unset( $GLOBALS['product_label_custom'] ); ?>
            </div>
          </div>
        </div>
      </section>

      <?php  echo $after_widget; }
     
      public function update($new_instance, $old_instance) {
          $instance = $old_instance;
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $instance[$buzzstore_widgets_name] = buzzstore_widgets_updated_field_value($widget_field, $new_instance[$buzzstore_widgets_name]);
          }
          return $instance;
      }

      public function form($instance) {
          $widget_fields = $this->widget_fields();
          foreach ($widget_fields as $widget_field) {
              extract($widget_field);
              $buzzstore_widgets_field_value = !empty($instance[$buzzstore_widgets_name]) ? $instance[$buzzstore_widgets_name] : '';
              buzzstore_widgets_show_widget_field($this, $widget_field, $buzzstore_widgets_field_value);
          }
      }
    }


    /**
     * Adds buzzstore_cat_widget widget.
    */
    add_action('widgets_init', 'buzzstore_cat_widget');
    function buzzstore_cat_widget() {
        register_widget('buzzstore_cat_widget_area');
    }
    
    class buzzstore_cat_widget_area extends WP_Widget {
    
        /**
         * Register widget with WordPress.
        */
        public function __construct() {
            parent::__construct(
                'buzzstore_cat_widget_area', esc_html__('Buzz: Woo Category Collection','buzzstore'), array(
                'description' => esc_html__('A widget that shows woocommerce category', 'buzzstore')
            ));
        }
        
        private function widget_fields() {
    
              $taxonomy     = 'product_cat';
              $empty        = 1;
              $orderby      = 'name';  
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no  
              $title        = '';  
              $empty        = 0;
              $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title,
                'hide_empty'   => $empty
              );
    
              $woocommerce_categories = array();
              $woocommerce_categories_obj = get_categories($args);
              foreach ($woocommerce_categories_obj as $category) {
                $woocommerce_categories[$category->term_id] = $category->name;
              }   
    
            $fields = array( 
              
                'buzzstore_main_cat_title' => array(
                    'buzzstore_widgets_name' => 'buzzstore_main_cat_title',
                    'buzzstore_widgets_title' => esc_html__('Title', 'buzzstore'),
                    'buzzstore_widgets_field_type' => 'title',
                ),

                'buzzstore_cat_short_desc' => array(
                    'buzzstore_widgets_name' => 'buzzstore_cat_short_desc',
                    'buzzstore_widgets_title' => esc_html__('Very Short Description', 'buzzstore'),
                    'buzzstore_widgets_field_type' => 'text'
                ),
                
                'buzzstore_select_category' => array(
                    'buzzstore_widgets_name' => 'buzzstore_select_category',
                    'buzzstore_mulicheckbox_title' => esc_html__('Select Category', 'buzzstore'),
                    'buzzstore_widgets_field_type' => 'multicheckboxes',
                    'buzzstore_widgets_field_options' => $woocommerce_categories
                ),
                
            );
    
            return $fields;
        }
    
        public function widget($args, $instance) {
            extract($args);
            extract($instance);
            
            /**
             * wp query for first block
            */  
            $title     = empty( $instance['buzzstore_main_cat_title'] ) ? '' : $instance['buzzstore_main_cat_title']; 
            $shot_desc = empty( $instance['buzzstore_cat_short_desc'] ) ? '' : $instance['buzzstore_cat_short_desc'];
            $buzz_store_cat_id = empty( $instance['buzzstore_select_category'] ) ? '' : $instance['buzzstore_select_category'];
           
            echo $before_widget; 
        ?>
        <section id="slider" class="slider-container home-section">
          <div class="buzz-container buzz-clearfix relative">                    
              
            <div class="buzz-titlewrap">
              <?php if(!empty( $title )) { ?>
                  <h2 class="buzz-title wow zoomIn" data-wow-delay="0.3s">
                      <?php echo esc_html($title); ?>
                  </h2>
              <?php }  if(!empty( $shot_desc )) { ?>
                  <p class="buzz-subTitle wow zoomIn" data-wow-delay="0.3s">
                      <?php echo esc_html($shot_desc); ?>
                  </p>
              <?php } ?>
            </div>
            
            <div class="starSeparatorBox">                  
              <div class="starSeparator wow zoomIn" data-wow-delay="0.3s">
                <span aria-hidden="true" class="icon-star"></span>
              </div>
              
              <div id="owl-product-slider" class="enable-owl-carousel owl-product-slider wow fadeInUp" data-wow-delay="0.7s" data-navigation="true" data-pagination="false" data-single-item="false" data-auto-play="false" data-transition-style="false" data-main-text-animation="false" data-min600="2" data-min800="3" data-min1200="4">
                <?php
                    $count = 0; 
                      if(!empty($buzz_store_cat_id)){                            
                        foreach ($buzz_store_cat_id as $key => $store_cat_id) {          
                            $thumbnail_id = get_woocommerce_term_meta( $key, 'thumbnail_id', true );
                            $images = wp_get_attachment_url( $thumbnail_id );
                            $image = wp_get_attachment_image_src($thumbnail_id, 'buzzstore-cat-image', true);
                            $term = get_term_by( 'id', $key, 'product_cat');
                        if ( $term && ! is_wp_error( $term ) ) {
                            $term_link = get_term_link($term);
                            $term_name = $term->name;
                        if ( $term->count > 0 ) 
                            $sub_count =  apply_filters( 'woocommerce_subcategory_count_html', ' ' . $term->count . ' '.esc_html__('Products','buzzstore').'', $term);
                        }else{
                            $term_link = '#';
                            $term_name = esc_html__('Category','buzzstore');
                            $sub_count = '0 '.esc_html__('Product','buzzstore');
                        }
                      $no_img = esc_url( get_template_directory_uri().'/assets/images/noimage.png' );
                ?>
                <div class="item">                      
                    <div class="product-item">                        
                        <a href="<?php echo esc_url( $term_link ); ?>">
                            <?php  
                                if ( $images ) {
                                    echo '<img class="buzz-categoryimage" src="' . esc_url( $image[0] ) . '" alt="" />';
                                } else{
                                    echo '<img class="buzz-categoryimage" src="' . esc_url( $no_img ) . '" alt="" />';
                                }
                            ?>                            
                            <ul class="buzz-categorycount transition">
                                <h3 class="buzz-categoryname"><?php echo esc_html($term_name); ?></h3>
                                <p class="buzz-productcount"><?php echo esc_attr( $sub_count );  ?></p>                    
                            </ul>
                        </a>
                    </div>
                </div>
                <?php } }  ?>                    
              </div>
            </div>
          </div>

        </section>

        <?php  echo $after_widget; }
       
        public function update($new_instance, $old_instance) {
            $instance = $old_instance;
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $instance[$buzzstore_widgets_name] = buzzstore_widgets_updated_field_value($widget_field, $new_instance[$buzzstore_widgets_name]);
            }
            return $instance;
        }
    
        public function form($instance) {
            $widget_fields = $this->widget_fields();
            foreach ($widget_fields as $widget_field) {
                extract($widget_field);
                $buzzstore_widgets_field_value = !empty($instance[$buzzstore_widgets_name]) ? $instance[$buzzstore_widgets_name] : '';
                buzzstore_widgets_show_widget_field($this, $widget_field, $buzzstore_widgets_field_value);
            }
        }
    }

}