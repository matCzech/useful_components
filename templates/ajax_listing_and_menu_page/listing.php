<?php

/*

Template Name: Category page

*/
get_header();
?>

<?php 
$args = array('exclude' => array(1));
$categories = get_categories($args); ?>
<div class="container">
<ul class="cat-list pd-top pd-bottom">
  <li class="active"><a class="cat-list_item" href="#!" data-slug="">Wszystkie realizacje</a></li>

  <?php foreach($categories as $category) : ?>
    <li>
      <a class="cat-list_item" href="#!" data-slug="<?= $category->slug; ?>">
        <?= $category->name; ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>
</div>

<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$projects = new WP_Query([
    'post_type' => 'realizacje',
    'posts_per_page' => 10,
    'paged' => $paged,
    'order_by' => 'date',
    'order' => 'desc',
]);
?>

<?php if($projects->have_posts()): ?>
  <div class="project-tiles masonry pd-bottom container">

    <?php
        while($projects->have_posts()) : $projects->the_post(); 
          get_template_part('simple-item-listing');
      endwhile;
    ?>
    
  </div>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php if ($projects->max_num_pages > 1) : ?>
  <div class="d-flex container text-center pd-bottom">
    <div class="wp-block-button normal-button-blue">
        <a id="loadmore" class="loadmore wp-block-button__link wp-element-button">Zobacz więcej</a>
    </div>
  </div>
<?php endif; ?>

<?php get_template_part('template-parts/ui-elements/loader'); ?>



<?php get_footer(); ?>                                      
