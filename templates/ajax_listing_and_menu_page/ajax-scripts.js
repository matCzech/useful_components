jQuery(document).ready(function($) {
    var page = 2;
    var loadButton = $('#loadmore');

    loadButton.on('click', function(e) {
        e.preventDefault();

        // Show the loader
        $('.load-wrapper').show();

        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': ajax_params.ajaxnonce
        };

        $.post(ajax_params.ajaxurl, data, function(response) {
            // Hide the loader
            $('.load-wrapper').hide();

            if (response != '') {
                $('.project-tiles').append(response);
                page++;
                
                if (page > max_num_pages) {
                    loadButton.hide();
                }
            } else {
                loadButton.hide();
            }
        })
        .fail(function() {
            // If the request fails, hide the loader
            $('.load-wrapper').hide();
        });
    });


    //existing filter code
    $('.cat-list_item').on('click', function() {
        $('.cat-list_item').parent().removeClass('active');
        $(this).parent().addClass('active');
        var slug = $(this).data('slug');
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'filter_projects',
                category: slug,
            },
            success: function(res) {
                $('.project-tiles').html(res);
                page = 2; //reset page number
            }
        })
    });
});