<?php

//add multiple images for custom post type 'realizacje' - own custom field
function add_custom_multiple_gallery() {
    add_meta_box('multiple_images', 'Dodatkowa galeria', 'render_multiple_images_metabox', 'realizacje', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_custom_multiple_gallery');


function render_multiple_images_metabox($post) {
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
    <div>
        <button type="button" class="upload_image_button button">Upload Images</button>
        <input type="hidden" name="image_attachment_ids" id="image_attachment_ids" value="">
        <div id="uploaded_images"></div>
    </div>
    <script>
        jQuery(document).ready(function($){
            var file_frame;
            $('.upload_image_button').on('click', function(event){
                event.preventDefault();

                if(file_frame){
                    file_frame.open();
                    return;
                }

                file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Select Images',
                    button: {
                        text: 'Select Images'
                    },
                    multiple: true
                });

                file_frame.on('select', function(){
                    var attachment_ids = '';
                    var attachments = file_frame.state().get('selection').map(function(attachment){
                        attachment.toJSON();
                        if(attachment.id){
                            attachment_ids += ','+attachment.id;
                            var image_url = attachment.attributes.url;
                            $('#uploaded_images').append('<img src="'+image_url+'" style="max-width:200px;max-height:200px;" />');
                        }
                    });
                    if(attachment_ids){
                        attachment_ids = attachment_ids.substring(1);
                        $('#image_attachment_ids').val(attachment_ids);
                    }
                });
                file_frame.open();
            });
        });
    </script>
    <?php
}


//custom save for multiple images
function save_custom_meta_box($post_id, $post, $update) {
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $image_attachment_ids = "";

    if(isset($_POST["image_attachment_ids"]))
    {
        $image_attachment_ids = $_POST["image_attachment_ids"];
    }   
    update_post_meta($post_id, "image_attachment_ids", $image_attachment_ids);
}

add_action("save_post", "save_custom_meta_box", 10, 3);