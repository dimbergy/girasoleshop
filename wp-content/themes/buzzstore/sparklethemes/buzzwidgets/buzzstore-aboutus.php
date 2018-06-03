<?php
/**
 * Adds buzzstore_aboutus_info widget.
*/
add_action('widgets_init', 'buzzstore_aboutus_info');
function buzzstore_aboutus_info() {
    register_widget('buzzstore_aboutus_info_area');
}

class buzzstore_aboutus_info_area extends WP_Widget {

    /**
     * Register widget with WordPress.
    */
    public function __construct() {
        parent::__construct(
            'buzzstore_aboutus_info_area', esc_html__('Buzz: About Us Information', 'buzzstore'), array(
            'description' => esc_html__('A widget that shows about us information', 'buzzstore')
        ));
    }
    
    private function widget_fields() {        
        
        $fields = array( 
            
            'buzzstore_about_logo' => array(
                'buzzstore_widgets_name' => 'buzzstore_about_logo',
                'buzzstore_widgets_title' => esc_html__('Upload Logo Image', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'upload',
            ),
            
            'buzzstore_about_short_desc' => array(
                'buzzstore_widgets_name' => 'buzzstore_about_short_desc',
                'buzzstore_widgets_title' => esc_html__('Short Description', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'textarea',
                'buzzstore_widgets_row' => '3'
            ),
            
            'buzzstore_facebook_url' => array(
                'buzzstore_widgets_name' => 'buzzstore_facebook_url',
                'buzzstore_widgets_title' => esc_html__('Facebook Url', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'url',
            ),
            
            'buzzstore_twitter_url' => array(
                'buzzstore_widgets_name' => 'buzzstore_twitter_url',
                'buzzstore_widgets_title' => esc_html__('Twitter Url', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'url',
            ),
            
            'buzzstore_googleplus_url' => array(
                'buzzstore_widgets_name' => 'buzzstore_googleplus_url',
                'buzzstore_widgets_title' => esc_html__('Google Plus Url', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'url',
            ),
            
            'buzzstore_youtube_url' => array(
                'buzzstore_widgets_name' => 'buzzstore_youtube_url',
                'buzzstore_widgets_title' => esc_html__('Youtube Url', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'url',
            ),
            
            'buzzstore_instagram_url' => array(
                'buzzstore_widgets_name' => 'buzzstore_instagram_url',
                'buzzstore_widgets_title' => esc_html__('Instagram Url', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'url',
            ),
            
            'buzzstore_pinterest_url' => array(
                'buzzstore_widgets_name' => 'buzzstore_pinterest_url',
                'buzzstore_widgets_title' => esc_html__('Pinterest Url', 'buzzstore'),
                'buzzstore_widgets_field_type' => 'url',
            ),
                            
        );

        return $fields;
    }

    public function widget($args, $instance) {
        extract($args);
        extract($instance);
        
        $logo         = empty( $instance['buzzstore_about_logo'] ) ? '' : $instance['buzzstore_about_logo'];
        $shor_desc    = empty( $instance['buzzstore_about_short_desc'] ) ? '' : $instance['buzzstore_about_short_desc'];
        $facebook     = empty( $instance['buzzstore_facebook_url'] ) ? '' : $instance['buzzstore_facebook_url'];
        $twitter      = empty( $instance['buzzstore_twitter_url'] ) ? '' : $instance['buzzstore_twitter_url'];
        $googleplus   = empty( $instance['buzzstore_googleplus_url'] ) ? '' : $instance['buzzstore_googleplus_url'];
        $youtube      = empty( $instance['buzzstore_youtube_url'] ) ? '' : $instance['buzzstore_youtube_url'];
        $instagram    = empty( $instance['buzzstore_instagram_url'] ) ? '' : $instance['buzzstore_instagram_url'];
        $pinterest    = empty( $instance['buzzstore_pinterest_url'] ) ? '' : $instance['buzzstore_pinterest_url'];   
        
       echo $before_widget; 
    ?>
      <div class="about-container buzz-clearfix">            
        
            <?php if(!empty( $logo )) { ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="aboutlogo">
                  <img src="<?php echo esc_url( $logo ); ?>" alt="" />
                </a>
            <?php }  if(!empty( $shor_desc )) { ?>
                <span class="about-small-text">
                    <?php echo wp_kses_data( $shor_desc ); ?>
                </span>
            <?php } ?>       
        
            <ul class="buzz-social-list">
                <?php if(!empty( $facebook )) { ?>
                    <li>
                      <a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><span class="fa fa-facebook"></span></a>
                    </li>
                <?php }  if(!empty( $twitter )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><span class="fa fa-twitter"></span></a>
                  </li>
                 <?php }  if(!empty( $googleplus )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $googleplus ); ?>" target="_blank"><span class="fa fa-google-plus"></span></a>
                  </li>
                 <?php }  if(!empty( $youtube )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $youtube ); ?>" target="_blank"><span class="fa fa-youtube"></span></a>
                  </li>
                 <?php }  if(!empty( $instagram )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><span class="fa fa-instagram"></span></a>
                  </li>
                 <?php }  if(!empty( $pinterest )) { ?>
                  <li>
                      <a href="<?php echo esc_url( $pinterest ); ?>" target="_blank"><span class="fa fa-pinterest"></span></a>
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