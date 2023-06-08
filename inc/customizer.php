<?php

/**
 * Add all panels, sections, settings and controls to the Customizer
 */
function register_customize_sections ( $wp_customize ) {

    /****************************************
     * Home Page
     ***************************************/
    $wp_customize->add_panel('panel_st', array(
        'title'         => __('Savvy Theme'),
        'description'   => esc_html__('Configurations for the Savvy Theme')
    ));

    /********************
     * Featured Section
     ********************/
    $wp_customize->add_section('section_st_featured', array(
        'title'		    => __('Featured'),
        'description'   => esc_html__('The featured post and video for the Home Page'),
        'panel'		    => 'panel_st'
    ));

    // Featured Post
    $wp_customize->add_setting('setting_st_featured_post', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new Dropdown_Post_Control( $wp_customize, 'control_st_featured_post', array(
        'label'		    => __('Select Post'),
        'description'   => esc_html__('This will show up to the left of the featured video'),
        'type' 		    => 'dropdown-posts',
        'settings'	    => 'setting_st_featured_post',
        'section'	    => 'section_st_featured',
    )));

    // Featured Video
    $wp_customize->add_setting('setting_st_featured_video', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_featured_video', array(
        'label'		    => __('Video Embed'),
        'description'   => esc_html__('Add the YouTube embed here'),
        'type' 		    => 'textarea',
        'settings'	    => 'setting_st_featured_video',
        'section'	    => 'section_st_featured',
    )));

    // Has Featured Video
    $wp_customize->add_setting('setting_st_featured_hasvideo', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_featured_hasvideo', array(
        'label'		    => __('Show Featured Video instead of text'),
        'description'   => esc_html__('A video embed will replace Home Page Call-To-Action'),
        'type' 		    => 'checkbox',
        'settings'	    => 'setting_st_featured_hasvideo',
        'section'	    => 'section_st_featured',
    )));

    // Home Page Title
    $wp_customize->add_setting('setting_st_featured_title', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_featured_title', array(
        'label'		    => __('Home Page Title'),
        'description'   => esc_html__('The title text for the Home Page text'),
        'type' 		    => 'text',
        'settings'	    => 'setting_st_featured_title',
        'section'	    => 'section_st_featured',
    )));

    // Home Page Lead
    $wp_customize->add_setting('setting_st_featured_lead', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_featured_lead', array(
        'label'		    => __('Home Page Lead Text'),
        'description'   => esc_html__('The leading text below the title'),
        'type' 		    => 'text',
        'settings'	    => 'setting_st_featured_lead',
        'section'	    => 'section_st_featured',
    )));

    // Home Page Body
    $wp_customize->add_setting('setting_st_featured_body', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_featured_body', array(
        'label'		    => __('Home Page Body Text'),
        'description'   => esc_html__('The body of the Home Page text'),
        'type' 		    => 'textarea',
        'settings'	    => 'setting_st_featured_body',
        'section'	    => 'section_st_featured',
    )));

    // Home Page Button Location
    $wp_customize->add_setting('setting_st_featured_buttonlink', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_featured_buttonlink', array(
        'label'		    => __('Home Page Button Target'),
        'description'   => esc_html__('The page that the call-to-action button will go to'),
        'type' 		    => 'dropdown-pages',
        'settings'	    => 'setting_st_featured_buttonlink',
        'section'	    => 'section_st_featured',
    )));

    // Home Page Button Value
    $wp_customize->add_setting('setting_st_featured_buttonvalue', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_featured_buttonvalue', array(
        'label'		    => __('Home Page Button Text'),
        'description'   => esc_html__('The text that will display on the call-to-action button'),
        'type' 		    => 'text',
        'settings'	    => 'setting_st_featured_buttonvalue',
        'section'	    => 'section_st_featured',
    )));

    // Has Savvy Cat
    $wp_customize->add_setting('setting_st_featured_hascat', array(
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_featured_hascat', array(
        'label'		    => __('Show a Savvy Cat in the background'),
        'type' 		    => 'checkbox',
        'settings'	    => 'setting_st_featured_hascat',
        'section'	    => 'section_st_featured',
    )));

    /********************
     * Top Picks Section
     ********************/
    $wp_customize->add_section('section_st_tpicks', array(
        'title'		    => __('Top Picks'),
        'description'   => esc_html__('The scrub-able section of posts below the featured content'),
        'panel'		    => 'panel_st'
    ));

    // Header
    $wp_customize->add_setting('setting_st_tpicks_header', array(
        'transport' 	=> 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_tpicks_header', array(
        'label'		    => 	__('Top Picks Section Header'),
        'description'   => esc_html__('The header of the section'),
        'type' 		    => 'text',
        'settings'	    => 'setting_st_tpicks_header',
        'section'	    => 'section_st_tpicks',
    )));

    // Maximum Number of Posts
    $wp_customize->add_setting('setting_st_tpicks_postnumber', array(
        'transport'	=> 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Control( $wp_customize, 'control_st_tpicks_postnumber', array(
        'label'		    => 	__('Number of Posts'),
        'description'   => esc_html__('The maximum number of posts that should be allowed in this section'),
        'type' 		    => 'number',
        'input_attrs'   => array(
            'type' => 'number',
            'min' => '0',
            'step' => '1',
            'pattern' => '\d*'
        ),
        'settings'	    => 'setting_st_tpicks_postnumber',
        'section'	    => 'section_st_tpicks',
    )));

}

add_action( 'customize_register' , 'register_customize_sections' );