jQuery.fn.isInViewport = function() {
    var elementTop = jQuery(this).offset().top;
    var elementBottom = elementTop + jQuery(this).outerHeight();
    var viewportTop = jQuery(window).scrollTop();
    var viewportBottom = viewportTop + jQuery(window).height();
    return elementBottom > viewportTop && elementTop < viewportBottom;
};

jQuery(window).on('scroll', function() {
    if (jQuery('#counters').isInViewport()) {
        countIt();
    }
});

function countIt() {
    jQuery('.count').each(function() {
        var $this = jQuery(this),
            countTo = $this.attr('data-count');
        
        jQuery({ countNum: $this.text()}).animate({
            countNum: countTo
        },
        {
            duration: 2000,
            easing:'linear',
            step: function() {
                $this.text(Math.floor(this.countNum));
            },
            complete: function() {
                $this.text(this.countNum);
            }
        });   
    });
}

/*To using code that is above is needed html tag (it has to be in div with id 'counter')*/
<p class="text-center count
text-white" data-count="5">0</p>


/*
    Trick for wordpress shortcode - here to display the number of posts of specific id categories

    function display_total_designs() {
    $args = array(
        'post_type' => 'realizacje',
        'post_status' => 'publish',
        'category__in' => array(6, 12, 11, 10)
    );
    $query = new WP_Query($args);

    $total_posts = $query->found_posts;
    
    return '<p class="text-center count text-white" data-count="' . $total_posts . '">0</p>';
}
add_shortcode('total_designs', 'display_total_designs');
*/