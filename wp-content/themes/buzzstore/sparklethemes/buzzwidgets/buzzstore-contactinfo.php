<?php
/**
 * Adds buzzstore_contact_info widget.
*/
add_action('widgets_init', 'buzzstore_contact_info');
function buzzstore_contact_info() {
    register_widget('buzzstore_contact_info_area');
}

class buzzstore_contact_info_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'buzzstore_contact_info_area', esc_html__('Buzz: Quick Contact Info','buzzstore'), array(
            'description' => esc_html__('A widget that shows quick contact information', 'buzzstore')
        ));
    }
    
    private function widget_fields() {        
        
        $fields = array( 
            
            'buzzstore_quick_contact_title' => array(
                'buzzstore_widgets_name' => 'buzzstore_quick_contact_title',
                'buzzstore_widgets_title' => esc_html__('Title', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'title',
            ),
            'buzzstore_quick_address' => array(
                'buzzstore_widgets_name' => 'buzzstore_quick_address',
                'buzzstore_widgets_title' => esc_html__('Contact Address', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'textarea',
                'buzzstore_widgets_row'    => 2,
            ),
            'buzzstore_quick_phone' => array(
                'buzzstore_widgets_name' => 'buzzstore_quick_phone',
                'buzzstore_widgets_title' => esc_html__('Contact Number', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'text',
            ),
            'buzzstore_quick_email' => array(
                'buzzstore_widgets_name' => 'buzzstore_quick_email',
                'buzzstore_widgets_title' => esc_html__('Contact Email Address', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'text',
            ),
            'buzzstore_opening_time' => array(
                'buzzstore_widgets_name' => 'buzzstore_opening_time',
                'buzzstore_widgets_title' => esc_html__('Store Opening Time', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'textarea',
                'buzzstore_widgets_row'    => 2,
            ),                   
        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);

        $title           = empty( $instance['buzzstore_quick_contact_title'] ) ? '' : $instance['buzzstore_quick_contact_title'];
        $contact_address = empty( $instance['buzzstore_quick_address'] ) ? '' : $instance['buzzstore_quick_address'];
        $contact_number  = empty( $instance['buzzstore_quick_phone'] ) ? '' : $instance['buzzstore_quick_phone'];
        $contact_email   = empty( $instance['buzzstore_quick_email'] ) ? '' : $instance['buzzstore_quick_email'];
        $opening_time    = empty( $instance['buzzstore_opening_time'] ) ? '' : $instance['buzzstore_opening_time'];
        
        echo $before_widget; 
        
        if(!empty($title)) {
          echo '<h2 class="widget-title">'.esc_html( $title ).'</h2>';
        }
    ?>
        <div class="buzz-contactinfo buzz-clearfix">
            <ul class="buzz-contactwrap">
                <?php if(!empty( $contact_address )) { ?>
                <li class="contact-address">
                    <span class="icon-location-pin"></span>
                    <?php echo wp_kses_data( $contact_address ); ?>
                </li>
                <?php }  if(!empty( $contact_number )) { ?>
                <li class="contact-number">
                    <span class="icon-call-in"></span>
                    <?php echo wp_kses_data( $contact_number ); ?>
                </li>
                <?php }  if(!empty( $contact_email )) { ?>
                <li class="contact-email">
                    <span class="icon-envelope-open"></span>
                    <a href="mailto:<?php echo esc_attr( antispambot( $contact_email ) ); ?>"><?php echo esc_attr( antispambot( $contact_email ) ); ?></a>
                </li>
                <?php }  if(!empty( $opening_time )) { ?>
                <li class="contact-time">
                    <span class="icon-clock"></span>
                    <?php echo wp_kses_data( $opening_time ); ?>
                </li> 
                <?php } ?>                                      
            </ul>
        </div>
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
            $buzzstore_widgets_field_value = !empty($instance[$buzzstore_widgets_name]) ? esc_attr($instance[$buzzstore_widgets_name]) : '';
            buzzstore_widgets_show_widget_field($this, $widget_field, $buzzstore_widgets_field_value);
        }
    }
}