<?php

function opencharity_preprocess_html(&$vars)
{
    global $user;
    $viewport = array(
        '#tag' => 'meta',
        '#attributes' => array(
            'name' => 'viewport',
            'content' => 'width=device-width, initial-scale=1, maximum-scale=1',
        ),
    );
    drupal_add_html_head($viewport, 'viewport');
    drupal_add_js(drupal_get_path('theme', 'opencharity') . '/javascript/ocSlider.js');
    drupal_add_js(drupal_get_path('theme', 'opencharity') . '/javascript/menu.js', array('currentUser' => $user->uid));
}

?>