<?php

define( 'ATTACHMENTS_SETTINGS_SCREEN', false ); // disable the Settings screen in wp admin bar
add_filter( 'attachments_default_instance', '__return_false' ); // disable the default instance in the post page of wp admin bar

// For creating a slider
function alpha2_attachments($attachments){
    $fields = array(
        array(
            'name'      => 'title',
            'type'      => 'text',
            'label'     => __('Title', 'alpha2'),
        ),
    );

    // register for a post
    $args = array(
        'label'        => 'Featured Slider',
        'post_type'    => array('post'),
        'filetype'     => array('image'),
        'note'         => 'Add Slider Images',
        'button_text'  => __('Attach Files', 'alpha2'),
        'fields'       => $fields,
    );

    $attachments->register('slider',$args);
}
add_action( 'attachments_register', 'alpha2_attachments' );

// For creating testimonial section
function alpha2_testimonial_attachments($attachments){
    $fields = array(
        array(
            'name'      => 'title',
            'type'      => 'text',
            'label'     => __('Name', 'alpha2'),
        ),
        array(
            'name'      => 'position',
            'type'      => 'text',
            'label'     => __('Position', 'alpha2'),
        ),
        array(
            'name'      => 'company',
            'type'      => 'text',
            'label'     => __('Company', 'alpha2'),
        ),
        array(
            'name'      => 'testimonials',
            'type'      => 'textarea',
            'label'     => __('Testimonials', 'alpha2'),
        ),
    );

    // register for a page
    $args = array(
        'label'        => 'Testimonials',
        'post_type'    => array('page'),
        'filetype'     => array('image'),
        'note'         => 'Add testimonials',
        'button_text'  => __('Attach Files', 'alpha2'),
        'fields'       => $fields,
    );

    $attachments->register('testimonials',$args);
}
add_action( 'attachments_register', 'alpha2_testimonial_attachments' );
