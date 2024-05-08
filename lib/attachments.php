<?php

define( 'ATTACHMENTS_SETTINGS_SCREEN', false ); // disable the Settings screen
add_filter( 'attachments_default_instance', '__return_false' ); // disable the default instance

function alpha2_attachments($attachments){
    $fields = array(
        array(
            'name'      => 'title',
            'type'      => 'text',
            'label'     => __('Title', 'alpha2'),
        ),
    );

    $args = array(
        'label'        => 'Featured Slider',
        'post_type'    => array('post'),
        'filetype'     => array('image'),
        'note'         => 'Add Slider Images',
        'button_text'  => __('Attach Files', 'alpha'),
        'fields'       => $fields,
    );

    $attachments->register('slider',$args);
}
add_action( 'attachments_register', 'alpha2_attachments' );
