<?php
/**
 * Buzz Store Theme Customizer.
 *
 * @package Buzz_Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function buzzstore_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  $wp_customize->add_panel('buzzstore_general_settings', array(
    'capabitity' => 'edit_theme_options',
    'priority' => 4,
    'title' => esc_html__('General Settings', 'buzzstore')
  ));

  $wp_customize->get_section('title_tagline' )->panel = 'buzzstore_general_settings';
  $wp_customize->get_section('title_tagline' )->priority = 1;


/**
 * Important Link
*/
$wp_customize->add_section( 'buzzstore_implink_section', array(
  'title'       => esc_html__( 'Important Links', 'buzzstore' ),
  'priority'      => 1
) );

    $wp_customize->add_setting( 'buzzstore_imp_links', array(
      'sanitize_callback' => 'buzzstore_text_sanitize'
    ));

    $wp_customize->add_control( new BuzzStore_theme_Info_Text( $wp_customize,'buzzstore_imp_links', array(
        'settings'    => 'buzzstore_imp_links',
        'section'   => 'buzzstore_implink_section',
        'description' => '<a class="pro-implink" href="http://docs.sparklewpthemes.com/buzzstore/" target="_blank">'.esc_html__('Documentation', 'buzzstore').'</a><a class="pro-implink" href="http://demo.sparklewpthemes.com/buzzstore/demos/" target="_blank">'.esc_html__('Live Demo', 'buzzstore').'</a><a class="pro-implink" href="http://sparklewpthemes.com/support/" target="_blank">'.esc_html__('Support Forum', 'buzzstore').'</a><a class="pro-implink" href="https://www.facebook.com/sparklewpthemes/" target="_blank">'.esc_html__('Like Us in Facebook', 'buzzstore').'</a>',
      )
    ));


    $wp_customize->add_setting( 'buzzstore_rate_us', array(
      'sanitize_callback' => 'buzzstore_text_sanitize'
    ));

    $wp_customize->add_control( new BuzzStore_theme_Info_Text( $wp_customize, 'buzzstore_rate_us', array(
          'settings'    => 'buzzstore_rate_us',
          'section'   => 'buzzstore_implink_section',
          'description' => sprintf(__( 'Please do rate our theme if you liked it %1$s', 'buzzstore'), '<a class="pro-implink" href="https://wordpress.org/support/theme/buzzstore/reviews/?filter=5" target="_blank">'.esc_html__('Rate/Review','buzzstore').'</a>' ),
        )
    ));

    $wp_customize->add_setting( 'buzzstore_setup_instruction', array(
      'sanitize_callback' => 'buzzstore_text_sanitize'
    ));

    $wp_customize->add_control( new BuzzStore_theme_Info_Text( $wp_customize, 'buzzstore_setup_instruction', array(
        'settings'    => 'buzzstore_setup_instruction',
        'section'   => 'buzzstore_implink_section',
        'description' => __( '<span class="customize-text_editor_desc">
            <h2 class="customize-title">'.esc_html__('Buzzstore Pro Features','buzzstore').'</h2>                
                  <ul class="admin-pro-feature-list">   
                      <li><span>'.esc_html__('Next generation WooCommerce theme','buzzstore').'</span></li>
                      <li><span>'.esc_html__('WordPress Live Customizer','buzzstore').'</span></li>
                      <li><span>'.esc_html__('One Click Demo Import','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Unlimited theme colors ( Primary Colors)','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Unlimited sliders Inbuilt sliders or Slider Revolution','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Configure product page/ shop unlimited','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Advanced product search','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Smart header with 4 different layout','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Background configuration','buzzstore').'</span></li>
                      <li><span>'.esc_html__('13+ Inbuilt custom widgets','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Highly configurable home page','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Special offers/ deals sections','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Product list to display popular products','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Product lists in column','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Full width Promo Widget','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Breadcrumbs Settings','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Custom CSS Section','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Our team member section','buzzstore').'</span></li>                        
                      <li><span>'.esc_html__('Testimonial section','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Multiple preloader options','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Responsive retina ready theme','buzzstore').'</span></li>
                      <li><span>'.esc_html__('3 Page layouts (right sidebar, left sidebar, full width)','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Fully SEO optimized (schema)','buzzstore').'</span></li>
                      <li><span>'.esc_html__('Fast loading','buzzstore').'</span></li>
                      <li><span>'.esc_html__('A perfect theme to start your eCommerce store of any kind !!!','buzzstore').'</span></li>
                  </ul>                    
                  <a href="'.esc_url('https://www.sparklewpthemes.com/wordpress-themes/buzzstorepro').'" class="button button-primary buynow" target="_blank">'.esc_html__('Buy Now','buzzstore').'</a>
              </span>', 'buzzstore'),
      )
    ));

  /**
    * Web Page Layout Section
  */
  $wp_customize->add_section( 'buzzstore_web_page_layout', array(
    'title'    => esc_html__('WebLayout Options', 'buzzstore'),
    'priority' => 2,
    'panel'    => 'buzzstore_general_settings'
  ));

    $wp_customize->add_setting('buzzstore_webpage_layout_options', array(
      'default' => 'fullwidth',
      'sanitize_callback' => 'buzzstore_weblayout_sanitize',
    ));

    $wp_customize->add_control('buzzstore_webpage_layout_options', array(
      'type' => 'radio',
      'label' => esc_html__('Web Layout Options', 'buzzstore'),
      'section' => 'buzzstore_web_page_layout',
      'settings' => 'buzzstore_webpage_layout_options',
        'choices' => array(
          'boxed' => esc_html__('Boxed Layout', 'buzzstore'),
          'fullwidth' => esc_html__('Full Width Layout', 'buzzstore')
        )
    ));

  $wp_customize->get_section('colors' )->panel = 'buzzstore_general_settings';
  $wp_customize->get_section('colors')->title = esc_html__( 'Themes Colors', 'buzzstore' );
  $wp_customize->get_section('colors' )->priority = 3;

  $wp_customize->get_section('header_image' )->panel = 'buzzstore_general_settings';
  $wp_customize->get_section('background_image' )->panel = 'buzzstore_general_settings';
  $wp_customize->get_section('background_image' )->priority = 4;

  $buzz_imagepath =  get_template_directory_uri() . '/assets/images/';

/************************************************************************************
** Top Header Settings Options
*************************************************************************************/
    $wp_customize->add_panel('buzzstore_top_header_section', array(
      'capabitity' => 'edit_theme_options',
      'description' => esc_html__('Change the top header settings here as you want', 'buzzstore'),
      'priority' => 5,
      'title' => esc_html__('Top Header Settings', 'buzzstore')
    ));

        /**
         * Top Header General Settings Section
        */
        $wp_customize->add_section('buzzstore_top_header_general_settings', array(
          'title' => esc_html__('Top Header General Settings', 'buzzstore'),
          'panel' => 'buzzstore_top_header_section',
          'priority' => 1,
        ));

          $wp_customize->add_setting('buzzstore_top_header_display_options', array(
             'default' => 'yes',
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'buzzstore_radio_sanitize' // done
          ));

          $wp_customize->add_control('buzzstore_top_header_display_options', array(
             'type'         => 'radio',
             'label'        => esc_html__('Enable/Disable Top Header Section','buzzstore'),
             'description'  => esc_html__('Choose the option as you want', 'buzzstore'),
             'section'      => 'buzzstore_top_header_general_settings',
             'choices' => array(
                'yes' => esc_html__('Enable', 'buzzstore'),
                'no' => esc_html__('Disable', 'buzzstore'),        
             )
          ));

          $wp_customize->add_setting('buzzstore_top_header_background_color', array(
             'default' => '#333333',
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'sanitize_hex_color',
          ));

          $wp_customize->add_control('buzzstore_top_header_background_color', array(
             'type'         => 'color',
             'label'        => esc_html__('Top Header Background Colors','buzzstore'),
             'description'  => esc_html__('Select top header background color as you want', 'buzzstore'),
             'section'      => 'buzzstore_top_header_general_settings',
          ));


      /**
       * Top Header Left Side Settings Section
      */
      $wp_customize->add_section('buzzstore_top_header_leftside_settings', array(
        'title' => esc_html__('Top Header LeftSide Settings', 'buzzstore'),
        'panel' => 'buzzstore_top_header_section',
        'priority' => 2,
      ));

        $wp_customize->add_setting('buzzstore_header_leftside_options', array(
          'default' => 'topnavmenu',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'buzzstore_header_leftside_style_sanitize'  // done
        ));

        $wp_customize->add_control('buzzstore_header_leftside_options', array(
            'type' => 'radio',
            'label' => esc_html__('Choose options as you want', 'buzzstore'),
            'description' => esc_html__('Choose any one options as you want and enter related Information', 'buzzstore'),
            'section' => 'buzzstore_top_header_leftside_settings',
            'settings' => 'buzzstore_header_leftside_options',
            'choices' => array(
              'socialicon' => esc_html__('Social Icons','buzzstore'),
              'topnavmenu' => esc_html__('Ton Nav Menu','buzzstore'),
              'quickinfo' => esc_html__('Quick Information','buzzstore')
            )
        ));


        /**
         * Active Callback function for quick information
        */
        $wp_customize->add_setting('buzzstore_quick_map_address', array(     
           'default' => '',
           'capability' => 'edit_theme_options',
           'sanitize_callback' => 'buzzstore_text_sanitize' //done
        ));

        $wp_customize->add_control('buzzstore_quick_map_address', array(
           'type' => 'text',
           'label' => esc_html__('Enter Map Address :', 'buzzstore'),
           'section' => 'buzzstore_top_header_leftside_settings',
           'settings' => 'buzzstore_quick_map_address',
           'active_callback' => 'buzzstore_quickinfo_email_address'
        ));

        $wp_customize->add_setting('buzzstore_quick_email', array(     
           'default' => '',
           'capability' => 'edit_theme_options',
           'sanitize_callback' => 'sanitize_email' //done
        ));

        $wp_customize->add_control('buzzstore_quick_email', array(
           'type' => 'text',
           'label' => esc_html__('Enter Email Address :', 'buzzstore'),
           'section' => 'buzzstore_top_header_leftside_settings',
           'settings' => 'buzzstore_quick_email',
           'active_callback' => 'buzzstore_quickinfo_email_address'
        ));

        $wp_customize->add_setting('buzzstore_quick_phone', array(     
           'default' => '',
           'capability' => 'edit_theme_options',
           'sanitize_callback' => 'buzzstore_text_sanitize' //done
        ));

        $wp_customize->add_control('buzzstore_quick_phone', array(
           'type' => 'text',
           'label' => esc_html__('Enter Phone Number :', 'buzzstore'),
           'section' => 'buzzstore_top_header_leftside_settings',
           'settings' => 'buzzstore_quick_phone',
           'active_callback' => 'buzzstore_quickinfo_email_address'
        ));


      /**
       * Top Header Right Side Settings Section
      */
      $wp_customize->add_section('buzzstore_top_header_rightside_settings', array(
        'title' => esc_html__('Top Header RightSide Settings', 'buzzstore'),
        'panel' => 'buzzstore_top_header_section',
        'priority' => 3,
      ));

        $wp_customize->add_setting('buzzstore_display_wishlist', array(
           'default' => 1,
           'capability' => 'edit_theme_options',
           'sanitize_callback' => 'buzzstore_checkbox_sanitize'  //done
        ));

        $wp_customize->add_control('buzzstore_display_wishlist', array(
           'type' => 'checkbox',
           'label' => esc_html__('Check to show the wishlist', 'buzzstore'),
           'description' => esc_html__('Check to show the wishlist  (Requires WooCommerce Wishlist Plugins)', 'buzzstore'),
           'section' => 'buzzstore_top_header_rightside_settings',
           'settings' => 'buzzstore_display_wishlist'
        ));

        $wp_customize->add_setting('buzzstore_display_myaccount_login', array(
           'default' => 1,
           'capability' => 'edit_theme_options',
           'sanitize_callback' => 'buzzstore_checkbox_sanitize'  //done
        ));

        $wp_customize->add_control('buzzstore_display_myaccount_login', array(
           'type' => 'checkbox',
           'label' => esc_html__('Check to show the my account', 'buzzstore'),
           'description' => esc_html__('Check to show the my account or login/register menu (Requires WooCommerce)', 'buzzstore'),
           'section' => 'buzzstore_top_header_rightside_settings',
           'settings' => 'buzzstore_display_myaccount_login'
        ));


  /**
   * Start of the Social Link Options
  */
    $wp_customize->add_section('buzzstore_social_link_activate_settings', array(
      'priority' => 6,
      'title' => esc_html__('Social Media settings', 'buzzstore'),
      'description' => esc_html__('Social Media Settings Display Social Media Link in Header & Footer', 'buzzstore'),
      'panel' => 'buzzstore_top_header_section',
    ));

          $buzzstore_social_links = array(
            'buzzstore_social_facebook' => array(
            'id' => 'buzzstore_social_facebook',
            'title' => esc_html__('Facebook', 'buzzstore'),
            'default' => ''
          ),
            'buzzstore_social_twitter' => array(
            'id' => 'buzzstore_social_twitter',
            'title' => esc_html__('Twitter', 'buzzstore'),
            'default' => ''
          ),
            'buzzstore_social_googleplus' => array(
            'id' => 'buzzstore_social_googleplus',
            'title' => esc_html__('Google-Plus', 'buzzstore'),
            'default' => ''
          ),
            'buzzstore_social_instagram' => array(
            'id' => 'buzzstore_social_instagram',
            'title' => esc_html__('Instagram', 'buzzstore'),
            'default' => ''
          ),
            'buzzstore_social_pinterest' => array(
            'id' => 'buzzstore_social_pinterest',
            'title' => esc_html__('Pinterest', 'buzzstore'),
            'default' => ''
          ),
            'buzzstore_social_youtube' => array(
            'id' => 'buzzstore_social_youtube',
            'title' => esc_html__('YouTube', 'buzzstore'),
            'default' => ''
          ),
        );

        $i = 20;

        foreach($buzzstore_social_links as $buzzstore_social_link) {

          $wp_customize->add_setting($buzzstore_social_link['id'], array(
            'default' => $buzzstore_social_link['default'],
               'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_url_raw'  // done
          ));

          $wp_customize->add_control($buzzstore_social_link['id'], array(
            'label' => $buzzstore_social_link['title'],
            'section'=> 'buzzstore_social_link_activate_settings',
            'settings'=> $buzzstore_social_link['id'],
            'priority' => $i
          ));

          $wp_customize->add_setting($buzzstore_social_link['id'].'_checkbox', array(
            'default' => 0,
               'capability' => 'edit_theme_options',
            'sanitize_callback' => 'buzzstore_checkbox_sanitize'  // done
          ));

          $wp_customize->add_control($buzzstore_social_link['id'].'_checkbox', array(
            'type' => 'checkbox',
            'label' => esc_html__('Check to show in new tab', 'buzzstore'),
            'section'=> 'buzzstore_social_link_activate_settings',
            'settings'=> $buzzstore_social_link['id'].'_checkbox',
            'priority' => $i
          ));

          $i++;

        }

      /**
       * Main Header Section
      */
      $wp_customize->add_section('buzzstore_main_header_settings', array(
        'title' => esc_html__('Main Header Settings', 'buzzstore'),
        'priority' => 6,
      ));
      
      $wp_customize->add_setting('buzzstore_search_options', array(
        'default' => 1,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'buzzstore_checkbox_sanitize' //done
      ));

      $wp_customize->add_control('buzzstore_search_options', array(
        'type' => 'checkbox',
        'label' => esc_html__('Check to enable the Search', 'buzzstore'),
        'section' => 'buzzstore_main_header_settings',
        'settings' => 'buzzstore_search_options'
      ));


      $wp_customize->add_setting('buzzstore_search_type', array(
        'default' => 'no',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'buzzstore_radio_sanitize' // done
      ));

      $wp_customize->add_control('buzzstore_search_type', array(
        'type' => 'radio',
        'label' => esc_html__('Choose the search option per as you want', 'buzzstore'),
        'section' => 'buzzstore_main_header_settings',
        'choices' => array(
           'yes' => esc_html__('Normal Search', 'buzzstore'),
           'no' => esc_html__('Advance Search With Category', 'buzzstore'),        
          )
      ));


      $wp_customize->add_setting('buzzstore_search_options_placeholder', array(
        'default' => 'Product Search...',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'buzzstore_text_sanitize' //done
      ));

      $wp_customize->add_control('buzzstore_search_options_placeholder', array(
        'type' => 'text',
        'label' => esc_html__('Enter the search box Placeholder text', 'buzzstore'),
        'section' => 'buzzstore_main_header_settings',
        'settings' => 'buzzstore_search_options_placeholder'
      ));


    /**
     * Banner/Slider Settings Panel
    */
    $wp_customize->add_section('buzzstore_main_banner_area', array(
      'title' => esc_html__('Home Slider Settings', 'buzzstore'),
      'priority' => 7,
    ));

    $wp_customize->add_setting('buzzstore_slider_section', array(
       'default' => 'enable',
       'sanitize_callback' => 'buzzstore_radio_enable_sanitize', // done
    ));

    $wp_customize->add_control('buzzstore_slider_section', array(
       'type' => 'radio',
       'label' => esc_html__('Enable/Disable Slider Section', 'buzzstore'),
       'description' => esc_html__('Choose the option as you want', 'buzzstore'),
       'section' => 'buzzstore_main_banner_area',
       'setting' => 'buzzstore_slider_section',
       'choices' => array(
          'enable' => esc_html__('Enable', 'buzzstore'),
          'disable' => esc_html__('Disable', 'buzzstore'),
    )));

    /* Main Slider Category */
    $wp_customize->add_setting( 'buzzstore_slider_team_id', array(
        'default' => '',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new BuzzStore_Category_Dropdown( $wp_customize, 'buzzstore_slider_team_id', array(
        'label' => esc_html__( 'Select Slide Category', 'buzzstore' ),
        'description' => esc_html__('Select Category for Slider ( Note :- Slider only wroking when you are create a new page & select PageTemplate: Front Page & set In Front Page, that you created ) ', 'buzzstore'),
        'section' => 'buzzstore_main_banner_area'        
    ) ) );

    /**
     * HomePage Icon Text Block Section
    */     
    $wp_customize->add_section('buzzstore_icon_block', array(
        'priority' => 7,
        'title' => esc_html__('Icon Text Block Settings', 'buzzstore'),
        'description' => esc_html__('Icon Text Block Settings are show your service area, it show in above the footer ( Note :- Icon Text Block only wroking when you are create a new page & select PageTemplate: Front Page & set In Front Page that you created )"', 'buzzstore'),
    ));
     
      $wp_customize->add_setting('buzzstore_icon_block_section', array(
         'default' => 'enable',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'buzzstore_radio_enable_sanitize', // done
      ));

      $wp_customize->add_control('buzzstore_icon_block_section', array(
         'type' => 'radio',
         'label' => esc_html__('Enable/Disable Icon Text Block Section', 'buzzstore'),
         'description' => esc_html__('Choose any options as you want','buzzstore'),
         'section' => 'buzzstore_icon_block',
         'setting' => 'buzzstore_icon_block_section',
         'choices' => array(
            'enable' => esc_html__('Enable', 'buzzstore'),
            'disable' => esc_html__('Disable', 'buzzstore'),
      )));

      $wp_customize->add_setting('buzzstore_first_icon_block_area', array(
         'default' => 'fa-user',
         'sanitize_callback' => 'buzzstore_text_sanitize', // done
      ));
     
      $wp_customize->add_control('buzzstore_first_icon_block_area',array(
         'type' => 'text',
         'description' => sprintf( esc_html__( 'Use font awesome icon: Eg: %1$s. %2$s See more here %3$s', 'buzzstore' ), 'fa-user','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' ),        
         'label' => esc_html__('First Text Block Area Icon', 'buzzstore'),
         'section' => 'buzzstore_icon_block',
         'setting' => 'buzzstore_first_icon_block_area',
      ));

      $wp_customize->add_setting('buzzstore_first_title_icon_block_area', array(
         'default' => '',
         'sanitize_callback' => 'buzzstore_text_sanitize', // done
      ));
     
      $wp_customize->add_control('buzzstore_first_title_icon_block_area',array(
         'type' => 'text',
         'label' => esc_html__('First Icon Block Title Text', 'buzzstore'),
         'section' => 'buzzstore_icon_block',
         'setting' => 'buzzstore_first_title_icon_block_area',
      ));


      $wp_customize->add_setting('buzzstore_second_icon_block_area', array(
         'default' => 'fa-university',
         'sanitize_callback' => 'buzzstore_text_sanitize', // done
      ));
     
      $wp_customize->add_control('buzzstore_second_icon_block_area',array(
         'type' => 'text',
         'description' => sprintf( esc_html__( 'Use font awesome icon: Eg: %1$s. %2$s See more here %3$s', 'buzzstore' ), 'fa-university','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' ),
         'label' => esc_html__('Second Text Block Area Icon', 'buzzstore'),
         'section' => 'buzzstore_icon_block',
         'setting' => 'buzzstore_second_icon_block_area',
      ));

      $wp_customize->add_setting('buzzstore_second_title_icon_block_area', array(
         'default' => '',
         'sanitize_callback' => 'buzzstore_text_sanitize', // done
      ));
     
      $wp_customize->add_control('buzzstore_second_title_icon_block_area',array(
         'type' => 'text',
         'label' => esc_html__('Second Icon Block Title Text', 'buzzstore'),
         'section' => 'buzzstore_icon_block',
         'setting' => 'buzzstore_second_title_icon_block_area',
      ));

      $wp_customize->add_setting('buzzstore_third_icon_block_area', array(
         'default' => 'fa-futbol-o',
         'sanitize_callback' => 'buzzstore_text_sanitize', // done
      ));
     
      $wp_customize->add_control('buzzstore_third_icon_block_area',array(
         'type' => 'text',
         'description' => sprintf( esc_html__( 'Use font awesome icon: Eg: %1$s. %2$s See more here %3$s', 'buzzstore' ), 'fa-futbol-o','<a href="'.esc_url('http://fontawesome.io/icons/').'" target="_blank">','</a>' ),
         'label' => esc_html__('Thired Text Block Area Icon', 'buzzstore'),
         'section' => 'buzzstore_icon_block',
         'setting' => 'buzzstore_third_icon_block_area',
      ));

      $wp_customize->add_setting('buzzstore_thired_title_icon_block_area', array(
         'default' => '',
         'sanitize_callback' => 'buzzstore_text_sanitize', // done
      ));
     
      $wp_customize->add_control('buzzstore_thired_title_icon_block_area',array(
         'type' => 'text',
         'label' => esc_html__('Thired Icon Block Title Text', 'buzzstore'),
         'section' => 'buzzstore_icon_block',
         'setting' => 'buzzstore_thired_title_icon_block_area',
      ));


    /**
     * Breadcrumbs Settings
    */
    $wp_customize->add_panel('buzzstore_breadcrumbs_settings', array(
       'capability' => 'edit_theme_options',
       'description'=> esc_html__('Manage breadcrumbs settings here as you want', 'buzzstore'),
       'priority' => 8,
       'title' => esc_html__('Breadcrumbs Settings', 'buzzstore')
    ));

        $wp_customize->add_section('buzzstore_woocommerce_breadcrumbs_settings', array(
          'priority' => 2,
          'title' => esc_html__('WooCommerce Breadcrumbs', 'buzzstore'),
          'panel' => 'buzzstore_breadcrumbs_settings'
        ));           

            $wp_customize->add_setting('buzzstore_woocommerce_enable_disable_section', array(
               'default' => 'enable',
               'capability' => 'edit_theme_options',
               'sanitize_callback' => 'buzzstore_radio_enable_sanitize', // done
            ));

            $wp_customize->add_control('buzzstore_woocommerce_enable_disable_section', array(
               'type' => 'radio',
               'label' => esc_html__('Enable/Disable Breadcrumbs Section', 'buzzstore'),
               'description' => esc_html__('Choose any options as you want','buzzstore'),
               'section' => 'buzzstore_woocommerce_breadcrumbs_settings',
               'setting' => 'buzzstore_woocommerce_enable_disable_section',
               'choices' => array(
                  'enable' => esc_html__('Enable', 'buzzstore'),
                  'disable' => esc_html__('Disable', 'buzzstore'),
            )));

            $wp_customize->add_setting('buzzstore_breadcrumbs_woocommerce_background_image', array(
               'default' => '',
               'capability' => 'edit_theme_options',
               'sanitize_callback' => 'esc_url_raw'
            ));

            $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'buzzstore_breadcrumbs_woocommerce_background_image', array(
               'label' => esc_html__('Upload Breadcrumbs Background Image', 'buzzstore'),
               'section' => 'buzzstore_woocommerce_breadcrumbs_settings',
               'setting' => 'buzzstore_breadcrumbs_woocommerce_background_image'
            )));      


      $wp_customize->add_section('buzzstore_breadcrumbs_normal_page_section', array(
          'priority' => 4,
          'title' => esc_html__('Normal Page Settings', 'buzzstore'),
          'panel' => 'buzzstore_breadcrumbs_settings'
       ));

          $wp_customize->add_setting('buzzstore_normal_page_enable_disable_section', array(
             'default' => 'enable',
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'buzzstore_radio_enable_sanitize', // done
          ));

          $wp_customize->add_control('buzzstore_normal_page_enable_disable_section', array(
             'type' => 'radio',
             'label' => esc_html__('Enable or Disable Breadcrumbs Section', 'buzzstore'),
             'description' => esc_html__('Choose any options as you want','buzzstore'),
             'section' => 'buzzstore_breadcrumbs_normal_page_section',
             'setting' => 'buzzstore_normal_page_enable_disable_section',
             'choices' => array(
                'enable' => esc_html__('Enable', 'buzzstore'),
                'disable' => esc_html__('Disable', 'buzzstore'),
          )));

          $wp_customize->add_setting('buzzstore_breadcrumbs_normal_page_background_image', array(
             'default' => '',
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'esc_url_raw'
          ));

          $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'buzzstore_breadcrumbs_normal_page_background_image', array(
             'label' => esc_html__('Upload Breadcrumbs Background Image', 'buzzstore'),
             'section' => 'buzzstore_breadcrumbs_normal_page_section',
             'setting' => 'buzzstore_breadcrumbs_normal_page_background_image'
          )));

      $wp_customize->add_section('buzzstore_breadcrumbs_post_archive_page_section', array(
          'priority' => 5,
          'title' => esc_html__('Posts/Archive Page Settings', 'buzzstore'),
          'panel' => 'buzzstore_breadcrumbs_settings'
       ));

          $wp_customize->add_setting('buzzstore_post_archive_page_enable_disable_section', array(
             'default' => 'enable',
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'buzzstore_radio_enable_sanitize', // done
          ));

          $wp_customize->add_control('buzzstore_post_archive_page_enable_disable_section', array(
             'type' => 'radio',
             'label' => esc_html__('Enable or Disable Breadcrumbs Section', 'buzzstore'),
             'description' => esc_html__('Choose any options as you want','buzzstore'),
             'section' => 'buzzstore_breadcrumbs_post_archive_page_section',
             'setting' => 'buzzstore_post_archive_page_enable_disable_section',
             'choices' => array(
                'enable' => esc_html__('Enable', 'buzzstore'),
                'disable' => esc_html__('Disable', 'buzzstore'),
          )));

          $wp_customize->add_setting('buzzstore_breadcrumbs_post_archive_background_image', array(
             'default' => '',
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'esc_url_raw'
          ));

          $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'buzzstore_breadcrumbs_post_archive_background_image', array(
             'label' => esc_html__('Upload Breadcrumbs Background Image', 'buzzstore'),
             'section' => 'buzzstore_breadcrumbs_post_archive_page_section',
             'setting' => 'buzzstore_breadcrumbs_post_archive_background_image'
          )));

if( buzzstore_is_woocommerce_activated() ) {

  /**
   * Start of the WooCommerce Design Options
  */
  $wp_customize->add_panel('buzzstore_woocommerce_design_options', array(
      'capabitity' => 'edit_theme_options',
      'description' => esc_html__('Change the Design Settings and Options Settings of WooCommerce here as you want', 'buzzstore'),
      'priority' => 9,
      'title' => esc_html__('WooCommerce Settings', 'buzzstore')
  ));
     
    $wp_customize->add_section('buzzstore_woocommerce_category_page_settings', array(
      'priority' => 1,
      'title' => esc_html__('Category Pages Settings', 'buzzstore'),
      'panel' => 'buzzstore_woocommerce_design_options'
    ));

        $wp_customize->add_setting('buzzstore_woocommerce_category_page_layout', array(
          'default' => 'rightsidebar',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'buzzstore_layout_sanitize'  //done
        ));

        $wp_customize->add_control(new BuzzStore_Image_Radio_Control($wp_customize, 'buzzstore_woocommerce_category_page_layout', array(
          'type' => 'radio',
          'label' => esc_html__('Select WooCommerce Category Layout', 'buzzstore'),
          'section' => 'buzzstore_woocommerce_category_page_settings',
          'settings' => 'buzzstore_woocommerce_category_page_layout',
          'choices' => array( 
                  'leftsidebar'  => $buzz_imagepath.'left-sidebar.png',  
                  'rightsidebar' => $buzz_imagepath.'right-sidebar.png',
                  'nosidebar'    => $buzz_imagepath.'no-sidebar.png',
                )
        )));
       

        $wp_customize->add_setting('buzzstore_woocommerce_category_product_per_page', array(
          'default' => 3,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'buzzstore_product_per_page_sanitize'  //done
        ));

        $wp_customize->add_control('buzzstore_woocommerce_category_product_per_page', array(
          'type' => 'select',
          'label' => esc_html__('Display Number Row', 'buzzstore'),
          'section' => 'buzzstore_woocommerce_category_page_settings',
          'settings' => 'buzzstore_woocommerce_category_product_per_page',
          'choices' => array( 
                  '2' => '2',  
                  '3' => '3', 
                  '4' => '4',
        )));

        $wp_customize->add_setting('buzzstore_woocommerce_category_per_page_product_number', array(
          'default' => 12,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'buzzstore_sanitize_number'  // done
        ));

        $wp_customize->add_control('buzzstore_woocommerce_category_per_page_product_number', array(
          'type' => 'number',
          'label' => esc_html__('Enter Display Number Products Per Page', 'buzzstore'),
          'section' => 'buzzstore_woocommerce_category_page_settings',
          'settings' => 'buzzstore_woocommerce_category_per_page_product_number'
        ));

    /**
     * WooCommerce Product Single Page Settings
    */  
    $wp_customize->add_section('buzzstore_woocommerce_product_page_settings', array(
      'priority' => 2,
      'title' => esc_html__('Single Product Page Settings', 'buzzstore'),
      'panel' => 'buzzstore_woocommerce_design_options'
    ));

        $wp_customize->add_setting('buzzstore_woocommerce_product_page_layout', array(
          'default' => 'rightsidebar',
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'buzzstore_layout_sanitize'  //done
        ));

        $wp_customize->add_control(new BuzzStore_Image_Radio_Control($wp_customize, 'buzzstore_woocommerce_product_page_layout', array(
          'type' => 'radio',
          'label' => esc_html__('Select WooCommerce Single Layout', 'buzzstore'),
          'section' => 'buzzstore_woocommerce_product_page_settings',
          'settings' => 'buzzstore_woocommerce_product_page_layout',
          'choices' => array( 
                  'leftsidebar'  => $buzz_imagepath.'left-sidebar.png',  
                  'rightsidebar' => $buzz_imagepath.'right-sidebar.png',
                  'nosidebar'    => $buzz_imagepath.'no-sidebar.png',
                )
        )));

        $wp_customize->add_setting('buzzstore_woocommerce_product_page_upsells_product_number', array(
          'default' => 3,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'buzzstore_sanitize_number'  // done
        ));

        $wp_customize->add_control('buzzstore_woocommerce_product_page_upsells_product_number', array(
          'type' => 'number',
          'label' => esc_html__('Enter Display Number of Upsells products', 'buzzstore'),
          'section' => 'buzzstore_woocommerce_product_page_settings',
          'settings' => 'buzzstore_woocommerce_product_page_upsells_product_number'
        ));

        $wp_customize->add_setting('buzzstore_woocommerce_product_page_related_product_number', array(
          'default' => 3,
          'capability' => 'edit_theme_options',
          'sanitize_callback' => 'buzzstore_sanitize_number'  // done
        ));

        $wp_customize->add_control('buzzstore_woocommerce_product_page_related_product_number', array(
          'type' => 'number',
          'label' => esc_html__('Enter Display Number of related products', 'buzzstore'),
          'section' => 'buzzstore_woocommerce_product_page_settings',
          'settings' => 'buzzstore_woocommerce_product_page_related_product_number'
        ));
}
 
    /**
     * Start Footer Section here      
    */
    $wp_customize->add_panel('buzzstore_footer_settings', array(
      'priority' => 115,
      'title' => esc_html__('Footer Settings', 'buzzstore'),
      'capability' => 'edit_theme_options',
    ));

      /**
       * Footer Area Two Settings
      */
      $wp_customize->add_section('buzzstore_footer_area_two_settings', array(
         'priority' => 2,
         'title' => esc_html__('Footer Area Settings', 'buzzstore'),
         'panel'=> 'buzzstore_footer_settings'
      ));

          $wp_customize->add_setting('buzzstore_footer_area_two_enable_disable_section', array(
             'default' => 'enable',
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'buzzstore_radio_enable_sanitize', // done
          ));

          $wp_customize->add_control('buzzstore_footer_area_two_enable_disable_section', array(
             'type' => 'radio',
             'label' => esc_html__('Enable or Disable Footer Area Two Section', 'buzzstore'),
             'description' => esc_html__('Choose any options as you want','buzzstore'),
             'section' => 'buzzstore_footer_area_two_settings',
             'setting' => 'buzzstore_footer_area_two_enable_disable_section',
             'choices' => array(
                'enable' => esc_html__('Enable', 'buzzstore'),
                'disable' => esc_html__('Disable', 'buzzstore'),
          )));

          $wp_customize->add_setting('buzzstore_footer_area_two_background_color', array(
             'default' => '#222222',
             'priority' => 2,     
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'sanitize_hex_color'
          ));

          $wp_customize->add_control('buzzstore_footer_area_two_background_color', array(
             'type'         => 'color',
             'label'        => esc_html__('Footer Area Two Background Colors','buzzstore'),
             'description'  => esc_html__('Select default footer area two background color as you want', 'buzzstore'),
             'section'      => 'buzzstore_footer_area_two_settings',
          ));      

      /**
       * Footer Area One Settings
      */
      $wp_customize->add_section('buzzstore_footer_buttom_area_settings', array(
         'priority' => 3,
         'title' => esc_html__('Sub Footer Area Settings', 'buzzstore'),
         'panel'=> 'buzzstore_footer_settings'
      ));
     

          $wp_customize->add_setting('buzzstore_footer_buttom_area_background_color', array(
             'default' => '#333333',
             'priority' => 2,     
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'sanitize_hex_color',
          ));

          $wp_customize->add_control('buzzstore_footer_buttom_area_background_color', array(
             'type'         => 'color',
             'label'        => esc_html__('Footer Buttom Area Background Colors','buzzstore'),
             'description'  => esc_html__('Select default footer buttom area background color as you want', 'buzzstore'),
             'section'      => 'buzzstore_footer_buttom_area_settings',
          ));      

          $wp_customize->add_setting('buzzstore_footer_buttom_copyright_setting', array(
             'default' => '',
             'capability' => 'edit_theme_options',
             'sanitize_callback' => 'buzzstore_text_sanitize'  //done
          ));

          $wp_customize->add_control('buzzstore_footer_buttom_copyright_setting', array(
             'type' => 'textarea',
             'label' => esc_html__('Footer Bottom Left Content (Copyright Text)', 'buzzstore'),
             'section' => 'buzzstore_footer_buttom_area_settings',
             'settings' => 'buzzstore_footer_buttom_copyright_setting'
          ));  

    /**
     * Web layout sanitization
    */
    function buzzstore_web_layout_sanitize($input) {
      $valid_keys = array(
         'boxed' => esc_html__('Boxed', 'buzzstore'),
         'fullwidth' => esc_html__('Full Width', 'buzzstore')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
    }
   
    /**
     * Text fields sanitization
    */
    function buzzstore_text_sanitize( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

    /**
     * Number fields sanitization
    */
    function buzzstore_sanitize_number( $input ) {
      $output = intval($input);
        return $output;
    }

    /**
     * Display Layout Sanitization
    */
    function buzzstore_layout_sanitize($input) {
        $buzz_imagepath =  get_template_directory_uri() . '/assets/images/';
        $valid_keys = array( 
              'leftsidebar' => $buzz_imagepath.'left-sidebar.png',  
              'rightsidebar' => $buzz_imagepath.'right-sidebar.png',
              'nosidebar' => $buzz_imagepath.'no-sidebar.png',
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
           return $input;
        } else {
           return '';
        }
    }

    /**
     * Header Left Sidebar Options  Sanitization
    */
    function buzzstore_header_leftside_style_sanitize($input) {
      $valid_keys = array( 
               'socialicon' => esc_html__('Social Icons','buzzstore'),
                'topnavmenu' => esc_html__('Ton Nav Menu','buzzstore'),
                'quickinfo' => esc_html__('Quick Information','buzzstore')
      );

      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
    }

  
    /**
     * Product Display Column Sanitization
    */ 
    function buzzstore_product_per_page_sanitize($input) {
        $valid_keys = array( 
                '2' => '2',  
                '3' => '3', 
                '4' => '4',
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
           return $input;
        } else {
           return '';
        }
    }

    /**
     * Display Related Products Sanitization
    */
    function buzzstore_product_per_page_related_sanitize($input) {
      $valid_keys = array( 
              '2' => '2',  
              '3' => '3', 
              '4' => '4',
              '5' => '5',
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
    }  

    /**
     * Checkbox Sanitization
    */
    function buzzstore_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return 0;
      }
    }

    /**
     * Radio Button yes/no Sanitization
    */
    function buzzstore_radio_sanitize($input) {
       $valid_keys = array(
         'yes'=>esc_html__('Yes', 'buzzstore'),
         'no'=>esc_html__('No', 'buzzstore')
       );
       if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
       } else {
          return '';
       }
    }

    /**
     * Radio Button Enable/Disable Sanitization
    */
    function buzzstore_weblayout_sanitize($input) {
       $valid_keys = array(
          'boxed' => esc_html__('Boxed Layout', 'buzzstore'),
          'fullwidth' => esc_html__('Full Width Layout', 'buzzstore')
       );
       if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
       } else {
          return '';
       }
    }

    

    /**
     * Single Product tab display style Sanitization
    */
    function buzzstore_product_page_tab_sanitize($input) {
        $valid_keys = array(
          'normaltabs' => 'Normal Tabs',  
          'verticaltabs' => 'Vertical Tabs',
        );
       
        if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
        } else {
          return '';
        }
    }

    /**
     * Display Related Product Style Types Sanitization
    */
    function buzzstore_page_related_product_sanitize($input) {
        $valid_keys = array(
            'none' => 'none',  
            'slider' => 'Slider', 
            'grid' => 'Grid'
        );

        if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
        } else {
          return '';
        }
    }


    /**
     * Enable/Disable Sanitization
    */
    function buzzstore_radio_enable_sanitize($input) {
        $valid_keys = array(
         'enable' => esc_html__('Enable', 'buzzstore'),
         'disable' => esc_html__('Disable', 'buzzstore'),
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
        } else {
          return '';
        }
    }
      

   /**
    * Top LeftSide Active CallBack Function Process
   */
    if ( ! function_exists( 'buzzstore_quickinfo_email_address' ) ) {
        function buzzstore_quickinfo_email_address(){
          if(esc_attr(get_theme_mod('buzzstore_header_leftside_options','quickinfo')) =='quickinfo'){
           return true;
          }else{
            return false;
          }
        }
   }

  if ( ! function_exists( 'buzzstore_social_icon_callback' ) ) {
      function buzzstore_social_icon_callback(){
        if(esc_attr(get_theme_mod('buzzstore_header_leftside_options')) == 'socialicon'){
          return true;
        }else{
          return false;
        }
      }
  }  

}
add_action( 'customize_register', 'buzzstore_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
*/
function buzzstore_customize_preview_js() {
  wp_enqueue_script( 'buzzstore_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'buzzstore_customize_preview_js' );
