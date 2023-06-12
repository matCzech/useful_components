<?php

$image_attachment_ids = get_post_meta(get_the_ID(), 'image_attachment_ids', true);
$image_attachment_array = explode(',', $image_attachment_ids);

?>

<div class="row pd-bottom pd-top">
        <?php
            echo '<div class="grid-gallery-portfolio">';
            foreach ($image_attachment_array as $id) {
                $image = wp_get_attachment_image_src($id, 'full');
                echo '<a href="'.$image[0].'" data-fancybox="gallery"><img src="'.$image[0].'" /></a>';
            }
            echo '</div>';          
        ?>
    </div>


<?php

//Save that in enqueue - register fancybox library
wp_enqueue_script('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js', array('jquery'), '3.5.7', true);
wp_enqueue_style('fancybox', 'https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css', array(), '3.5.7');

?>