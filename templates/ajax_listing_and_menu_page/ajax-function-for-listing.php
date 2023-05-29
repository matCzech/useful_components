<?php

function load_posts_by_ajax() {
    check_ajax_referer('load_more_posts', 'security');

    $paged = $_POST['page'];
    $posts_per_page = 7;
    $category = $_POST['category'];

    $args = array(
        'post_type' => 'realizacje',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'order_by' => 'date',
        'order' => 'desc',
    );
    if ($category != '') {
        $args['category_name'] = $category;
    }

    $projects = new WP_Query($args);
    if ($projects->have_posts()) :
        while($projects->have_posts()) : $projects->the_post();
            get_template_part('simple-item-listing');
        endwhile;
    endif;
    wp_die();
}
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax');
