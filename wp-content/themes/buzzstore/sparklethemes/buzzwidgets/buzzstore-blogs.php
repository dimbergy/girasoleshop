<?php
/**
 * Adds buzzstore_blog_widget widget.
 */
add_action('widgets_init', 'buzzstore_blog_widget');

function buzzstore_blog_widget() {
    register_widget('buzzstore_blog_widget_area');
}

class buzzstore_blog_widget_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
                'buzzstore_blog_widget_area', esc_html__('Buzz: Blogs Widget','buzzstore'), array(
            'description' => esc_html__('A widget that display latest three posts', 'buzzstore')
        ));
    }

    private function widget_fields() {

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => 1,
            'taxonomy' => 'category',
        );
        $categories = get_categories($args);
        $cat_lists = array();
        foreach ($categories as $category) {
            $cat_lists[$category->term_id] = $category->name;
        }

        $fields = array(
            'buzzstore_blogs_title' => array(
                'buzzstore_widgets_name' => 'buzzstore_blogs_title',
                'buzzstore_widgets_title' => esc_html__('Blogs Title', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'title',
            ),
            'blogs_category_list' => array(
                'buzzstore_widgets_name' => 'blogs_category_list',
                'buzzstore_mulicheckbox_title' => esc_html__('Select Blogs Category', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'multicheckboxes',
                'buzzstore_widgets_field_options' => $cat_lists
            ),
            'blogs_posts_display_order' => array(
                'buzzstore_widgets_name' => 'blogs_posts_display_order',
                'buzzstore_widgets_title' => esc_html__('Display Posts Order', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'select',
                'buzzstore_widgets_field_options' => array(
                    'ASC' => esc_html__('Accessing Order','buzzstore'),
                    'DESC' => esc_html__('Deaccessing Order', 'buzzstore')
                )
            )
        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        
        /**
         * wp query for first block
        */
        $blog_post_title           = empty( $instance['buzzstore_blogs_title'] ) ? '' : $instance['buzzstore_blogs_title'];
        $blogs_category_list       = empty( $instance['blogs_category_list'] ) ? '' : $instance['blogs_category_list'];
        $blogs_posts_display_order = empty( $instance['blogs_posts_display_order'] ) ? '' : $instance['blogs_posts_display_order'];

        $blogs_cat_id = array();
        if (!empty($blogs_category_list)) {
            $blogs_cat_id = array_keys($blogs_category_list);
        }

        $blogs_posts = new WP_Query(array(
            'posts_per_page' => 3,
            'post_type' => 'post',
            'cat' => $blogs_cat_id,
            'order' => $blogs_posts_display_order
        ));

        echo $before_widget; ?>

        <section id="fromBlog" class="buzz-container home-section buzz-clearfix">
            
            <div class="buzz-titlewrap">
              <?php if(!empty( $blog_post_title )) { ?>
                  <h2 class="buzz-title wow zoomIn" data-wow-delay="0.3s">
                      <?php echo esc_html( $blog_post_title ); ?>
                  </h2>
              <?php } ?>
            </div>

            <div class="blog-container starSeparatorBox">

                <div class="starSeparator wow zoomIn" data-wow-delay="0.3s">
                    <span class="icon-star" aria-hidden="true"></span>
                </div>

                <ul class="buzzstore-blogwrap">
                    <?php if ( $blogs_posts->have_posts()) : while ($blogs_posts->have_posts()) : $blogs_posts->the_post(); ?>
                        <li>
                            <div class="blog-preview wow fadeInUp" data-wow-delay="0.3s">
                                <?php 
                                    if (has_post_thumbnail()) { 
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'buzzstore-news-image', true);
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url( $image[0] ); ?>" />
                                    </a>
                                <?php } ?>                    
                                <div class="header-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </div>
                                <p><?php echo wp_kses_post( wp_trim_words( get_the_content(), 30 ) ); ?></p>
                                <a class="btn-readmore" href="<?php the_permalink(); ?>">
                                    <?php esc_html_e('Continue Reading', 'buzzstore'); ?>
                                </a>
                            </div>
                        </li>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                </ul>
            </div>
        </section>

        <?php
        echo $after_widget;
    }

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
