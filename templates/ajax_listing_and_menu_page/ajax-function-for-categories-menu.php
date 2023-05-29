<?php

function filter_projects() {
    $catSlug = $_POST['category'];
  
    $ajaxposts = new WP_Query([
      'post_type' => 'Realizacje',
      'posts_per_page' => 10,
      'category_name' => $catSlug,
      'orderby' => 'menu_order', 
      'order' => 'desc',
    ]);
    $response = '';
  
    if($ajaxposts->have_posts()) {
      while($ajaxposts->have_posts()) : $ajaxposts->the_post();
        $response .= get_template_part('simple-item-listing');
      endwhile;
    } else {
      $response = 'empty';
    }
  
    echo $response;
    exit;
  }
  add_action('wp_ajax_filter_projects', 'filter_projects');
  add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');