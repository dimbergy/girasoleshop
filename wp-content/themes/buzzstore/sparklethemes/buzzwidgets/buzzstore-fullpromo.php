<?php
/**
 * Adds buzzstore_full_promo widget.
*/
add_action('widgets_init', 'buzzstore_full_promo');
function buzzstore_full_promo() {
    register_widget('buzzstore_full_promo_area');
}

class buzzstore_full_promo_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    **/
    public function __construct() {
        parent::__construct(
            'buzzstore_full_promo_area', esc_html__('Buzz: Full Promo Widget','buzzstore'), array(
            'description' => esc_html__('A widget that promote you busincess', 'buzzstore')
        ));
    }
    
    private function widget_fields() {
      
        $fields = array( 

            'buzzstore_full_promo_image' => array(
                'buzzstore_widgets_name' => 'buzzstore_full_promo_image',
                'buzzstore_widgets_title' => esc_html__('Uplaod Promo Image', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'upload',
            ),
            
            'buzzstore_full_promo_title' => array(
                'buzzstore_widgets_name' => 'buzzstore_full_promo_title',
                'buzzstore_widgets_title' => esc_html__('Title', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'title',
            ),

            'buzzstore_full_promo_desc' => array(
                'buzzstore_widgets_name' => 'buzzstore_full_promo_desc',
                'buzzstore_widgets_title' => esc_html__('Short Description', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'text'
            ),

            'buzzstore_full_promo_button_link' => array(
                'buzzstore_widgets_name' => 'buzzstore_full_promo_button_link',
                'buzzstore_widgets_title' => esc_html__('Promo Button Link', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'url',
            ),

            'buzzstore_full_promo_button_text' => array(
                'buzzstore_widgets_name' => 'buzzstore_full_promo_button_text',
                'buzzstore_widgets_title' => esc_html__('Promo Button Text', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'text',
            ),
        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        
        $promo_image     = empty( $instance['buzzstore_full_promo_image'] ) ? '' : $instance['buzzstore_full_promo_image'];
        $title           = empty( $instance['buzzstore_full_promo_title'] ) ? '' : $instance['buzzstore_full_promo_title'];
        $short_desc      = empty( $instance['buzzstore_full_promo_desc'] ) ? '' : $instance['buzzstore_full_promo_desc'];
        $button_link     = empty( $instance['buzzstore_full_promo_button_link'] ) ? '' : $instance['buzzstore_full_promo_button_link'];
        $button_text     = empty( $instance['buzzstore_full_promo_button_text'] ) ? '' : $instance['buzzstore_full_promo_button_text'];
        echo $before_widget; 
    ?>
        <div class="promosection">            
            <div class="promoarea-div">
                <div class="promoarea">
                    <a class="promosection_overlay" href="#">
                        <figure class="promoimage" <?php if(!empty($promo_image)){ ?>style="background-image:url(<?php echo esc_url( $promo_image); ?>);"<?php } ?>>
                            <!-- <img src="<?php echo esc_url( $promo_image); ?>" alt="banner"> -->
                        </figure>
                    </a>
                    <a href="#" class="buzz-container textwrap">
                        <span>
                            <p><?php echo esc_html( $title ); ?></p>
                        </span>
                        <h2><?php echo wp_kses_post( $short_desc ); ?></h2>
                        <p class="line-text line-text_white">
                            <?php echo esc_attr( $button_text ); ?>
                        </p>
                    </a>
                </div>                         
            </div>
        </div>     
    <?php echo $after_widget;
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