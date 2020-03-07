<?php
/**
 * Plugin Name: List Missing Featured Images
 * Plugin URI: https://solverhood.com/
 * Description: This plugin will List all the missing featured images for the post
 * Version: 1.0
 * Author: Aman Khanakia
 * Author URI: https://khanakia.com/
 */


include 'vendor/autoload.php';

add_action( 'admin_menu', 'lmfi_wpse_91693_register' );

function lmfi_wpse_91693_register()
{
    add_menu_page(
        'List Post Missing Images',     // page title
        'List Post Missing Images',     // menu title
        'manage_options',   // capability
        'list-missing-featured-images',     // menu slug
        'lmfi_wpse_91693_render' // callback function
    );
}
function lmfi_wpse_91693_render()
{
    
    $args = array(
        'posts_per_page'   => -1,
        'post_type'        => 'post',
    );

    $posts = get_posts( $args );

    $data = [];

    foreach ($posts as $key => $post) {
        if(has_post_thumbnail($post)) continue;
        $data[] = array(
            'ID' => $post->ID,
            'post_title' => $post->post_title,
            'edit_post_link' => get_edit_post_link($post->ID),
            'categories' => get_the_category_list(',', '', $post->ID)
        );

    }
    // var_dump($data);
    
    $template = new \ListMissingFeaturedImage\Template();
    $args = array(
        // "id" => "widget_".uniqid(),
        // "content" => do_shortcode($content)
        "posts" => $data
    );
    echo $template->twig->render('list-posts.twig', $args);  
}