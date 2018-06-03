<?php
/**
* Buzz Store Field Functional file
* @package Buzz_Store
*/
function buzzstore_widgets_show_widget_field($instance = '', $widget_field = '', $buzzstore_field_value = '') {
   
    //list category list in array
    $buzzstore_category_list[0] = array(
        'value' => 0,
        'label' => esc_html__('Select Categories','buzzstore')
    );
    $buzzstore_posts = get_categories();
    foreach ($buzzstore_posts as $buzzstore_post) :
        $buzzstore_category_list[$buzzstore_post->term_id] = array(
            'value' => $buzzstore_post->term_id,
            'label' => $buzzstore_post->name
        );
    endforeach;

    extract($widget_field);

    switch ($buzzstore_widgets_field_type) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id($buzzstore_widgets_name) ); ?>"><?php echo esc_attr( $buzzstore_widgets_title ); ?> :</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id($buzzstore_widgets_name) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $buzzstore_widgets_name ) ); ?>" type="text" value="<?php echo esc_attr( $buzzstore_field_value ) ; ?>" />

                <?php if ( isset( $buzzstore_widgets_description ) ) { ?>
                    <br />
                    <small><?php echo esc_html( $buzzstore_widgets_description ); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        //title
        case 'title' :
            ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $buzzstore_widgets_name ) ); ?>"><?php echo esc_attr( $buzzstore_widgets_title ); ?> :</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $buzzstore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $buzzstore_widgets_name ) ); ?>" type="text" value="<?php echo esc_attr( $buzzstore_field_value ); ?>" />
                <?php if (isset( $buzzstore_widgets_description )) { ?>
                    <br />
                    <small><?php echo esc_html( $buzzstore_widgets_description ); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'group_start' :
            ?>
            <div class="buzzstore-main-group" id="ap-font-awesome-list <?php echo esc_attr( $instance->get_field_id( $buzzstore_widgets_name ) ); ?>">
                <div class="buzzstore-main-group-heading" style="font-size: 15px;  font-weight: bold;  padding-top: 12px;"><?php echo esc_attr( $buzzstore_widgets_title ); ?><span class="toogle-arrow"></span></div>
                <div class="buzzstore-main-group-wrap">

            <?php
            break;

            case 'group_end':
            ?></div>
            </div><?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id( $buzzstore_widgets_name ) ); ?>"><?php echo esc_attr( $buzzstore_widgets_title ); ?> :</label>
                <input class="widefat" id="<?php echo esc_attr( $instance->get_field_id( $buzzstore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name($buzzstore_widgets_name)); ?>" type="text" value="<?php echo esc_attr($buzzstore_field_value); ?>" />

                <?php if (isset( $buzzstore_widgets_description )) { ?>
                    <br />
                    <small><?php echo esc_html( $buzzstore_widgets_description ); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo esc_attr( $instance->get_field_id($buzzstore_widgets_name) ); ?>"><?php echo esc_attr( $buzzstore_widgets_title ); ?> :</label>
                <textarea class="widefat" rows="<?php echo absint( $buzzstore_widgets_row ); ?>" id="<?php echo esc_attr( $instance->get_field_id( $buzzstore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $buzzstore_widgets_name ) ); ?>"><?php echo esc_attr( $buzzstore_field_value ); ?></textarea>
            </p>
            <?php
            break;

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr( $instance->get_field_id($buzzstore_widgets_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($buzzstore_widgets_name)); ?>" type="checkbox" value="1" <?php checked('1', $buzzstore_field_value); ?>/>
                <label for="<?php echo esc_attr($instance->get_field_id($buzzstore_widgets_name)); ?>"><?php echo esc_attr($buzzstore_widgets_title); ?></label>

                <?php if (isset($buzzstore_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($buzzstore_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Radio fields
        case 'radio' :
            ?>
            <p>
                <?php
                echo esc_attr( $buzzstore_widgets_title );
                echo '<br />';
                foreach ($buzzstore_widgets_field_options as $buzzstore_option_name => $buzzstore_option_title) {
                    ?>
                    <input id="<?php echo esc_attr($instance->get_field_id($buzzstore_option_name)); ?>" name="<?php echo esc_attr($instance->get_field_name($buzzstore_widgets_name)); ?>" type="radio" value="<?php echo esc_attr($buzzstore_option_name); ?>" <?php checked($buzzstore_option_name, $buzzstore_field_value); ?> />
                    <label for="<?php echo esc_attr($instance->get_field_id($buzzstore_option_name)); ?>"><?php echo esc_attr($buzzstore_option_title); ?></label>
                    <br />
                <?php } ?>

                <?php if (isset($buzzstore_widgets_description)) { ?>
                    <small><?php echo esc_html($buzzstore_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($buzzstore_widgets_name)); ?>"><?php echo esc_attr($buzzstore_widgets_title); ?> :</label>
                <select name="<?php echo esc_attr($instance->get_field_name($buzzstore_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($buzzstore_widgets_name)); ?>" class="widefat">
                    <?php foreach ($buzzstore_widgets_field_options as $buzzstore_option_name => $buzzstore_option_title) { ?>
                        <option value="<?php echo esc_attr($buzzstore_option_name); ?>" id="<?php echo esc_attr($instance->get_field_id($buzzstore_option_name)); ?>" <?php selected($buzzstore_option_name, $buzzstore_field_value); ?>><?php echo esc_attr($buzzstore_option_title); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($buzzstore_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($buzzstore_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($buzzstore_widgets_name)); ?>"><?php echo esc_attr($buzzstore_widgets_title); ?> :</label><br />
                <input name="<?php echo esc_attr($instance->get_field_name($buzzstore_widgets_name)); ?>" type="number" step="4" min="4" id="<?php echo esc_attr($instance->get_field_id($buzzstore_widgets_name)); ?>" value="<?php echo esc_attr($buzzstore_field_value); ?>" class="widefat" />

                <?php if (isset($buzzstore_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($buzzstore_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;        

        // Select category field
        case 'select_category' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($buzzstore_widgets_name)); ?>"><?php echo esc_attr($buzzstore_widgets_title); ?> :</label>
                <select name="<?php echo esc_attr($instance->get_field_name($buzzstore_widgets_name)); ?>" id="<?php echo esc_attr($instance->get_field_id($buzzstore_widgets_name)); ?>" class="widefat">
                    <?php foreach ($buzzstore_category_list as $buzzstore_single_post) { ?>
                        <option value="<?php echo esc_attr($buzzstore_single_post['value']); ?>" id="<?php echo esc_attr($instance->get_field_id($buzzstore_single_post['label'])); ?>" <?php selected($buzzstore_single_post['value'], $buzzstore_field_value); ?>><?php echo esc_attr($buzzstore_single_post['label']); ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($buzzstore_widgets_description)) { ?>
                    <br />
                    <small><?php echo esc_html($buzzstore_widgets_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        //Multi checkboxes
        case 'multicheckboxes' :
            
            if( isset( $buzzstore_mulicheckbox_title ) ) { ?>
                <label><?php echo esc_attr( $buzzstore_mulicheckbox_title ); ?>:</label>
            <?php }
            echo '<div class="buzzstore-multiplecat">';
                foreach ( $buzzstore_widgets_field_options as $buzzstore_option_name => $buzzstore_option_title) {
                    if( isset( $buzzstore_field_value[$buzzstore_option_name] ) ) {
                        $buzzstore_field_value[$buzzstore_option_name] = 1;
                    }else{
                        $buzzstore_field_value[$buzzstore_option_name] = 0;
                    }                
                ?>
                    <p>
                        <input id="<?php echo esc_attr( $instance->get_field_id( $buzzstore_widgets_name ) ); ?>" name="<?php echo esc_attr( $instance->get_field_name( $buzzstore_widgets_name ) ).'['.esc_attr( $buzzstore_option_name ).']'; ?>" type="checkbox" value="1" <?php checked('1', $buzzstore_field_value[$buzzstore_option_name]); ?>/>
                        <label for="<?php echo esc_attr( $instance->get_field_id( $buzzstore_option_name ) ); ?>"><?php echo esc_attr( $buzzstore_option_title ); ?></label>
                    </p>
                <?php
                    }
            echo '</div>';
                if (isset($buzzstore_widgets_description)) {
            ?>
                    <small><em><?php echo esc_html($buzzstore_widgets_description); ?></em></small>
            <?php
                }
            
        break;

        case 'upload' :

            $output = '';
            $id = $instance->get_field_id($buzzstore_widgets_name);
            $class = '';
            $int = '';
            $value = $buzzstore_field_value;
            $name = $instance->get_field_name($buzzstore_widgets_name);

            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div class="sub-option section widget-upload">';
            $output .= '<label for="'.esc_attr($instance->get_field_id($buzzstore_widgets_name)).'">'.esc_attr($buzzstore_widgets_title).'</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_html__('No file chosen', 'buzzstore') . '" />' . "\n";
            
            if ( function_exists('wp_enqueue_media') ) {
                if (( $value == '')) {
                    $output .= '<input id="upload-' . $id . '" class="upload-button-wdgt button" type="button" value="' . esc_html__('Upload', 'buzzstore') . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . esc_html__('Remove', 'buzzstore') . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . esc_html__('Upgrade your version of WordPress for full media support.', 'buzzstore') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";
            if ($value != '') {
                $remove = '<a class="remove-image">'.esc_html__('Remove','buzzstore').'</a>';
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . $value . '" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }
                    $output .= '';
                    $title = esc_html__('View File', 'buzzstore');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;
    }
}

function buzzstore_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    if ($buzzstore_widgets_field_type == 'number') {

        return absint($new_field_value);

    } elseif ($buzzstore_widgets_field_type == 'textarea') {
        
        if (!isset($buzzstore_widgets_allowed_tags)) {
            $buzzstore_widgets_allowed_tags = '<span><br><p><strong><em><a>';
        }

        return wp_kses_data($new_field_value, $buzzstore_widgets_allowed_tags);
    } 
    elseif ($buzzstore_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    }
    elseif ($buzzstore_widgets_field_type == 'title') {
        return wp_kses_post($new_field_value);
    }
    elseif ($buzzstore_widgets_field_type == 'multicheckboxes') {
        return wp_kses_post($new_field_value);
    }
    else {
        return wp_kses_data($new_field_value);
    }
}

/**
 * Load widget fields file.
*/
require buzzstore_file_directory('sparklethemes/buzzwidgets/buzzstore-widget.php');


/**
 * Load Blogs Posts widget area file.
*/
require buzzstore_file_directory('sparklethemes/buzzwidgets/buzzstore-blogs.php');

/**
 * Load About widget area file.
*/
require buzzstore_file_directory('sparklethemes/buzzwidgets/buzzstore-aboutus.php');


/**
 * Load Contact Info widget area file.
*/
require buzzstore_file_directory('sparklethemes/buzzwidgets/buzzstore-contactinfo.php');

/**
 * Load testimonial widget area file.
*/
require buzzstore_file_directory('sparklethemes/buzzwidgets/buzzstore-testimonial.php');

/**
 * Load Full promo widget area file.
*/
require buzzstore_file_directory('sparklethemes/buzzwidgets/buzzstore-fullpromo.php');


