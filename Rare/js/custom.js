jQuery(function($){

    /* Expand Room Description in Detail Page */
    $(document).on('click', '.go-open-room-desc', function (e) {
        e.preventDefault();
        var t = $(this);
        t.closest('.read-more-wrap').toggle();
        t.closest('.need-readmore').toggleClass('active');
    });

    /* Readmore for the blocks need-readmore */
    $('.need-readmore').append('<div class="text-center read-more-wrap position-absolute w-100"><a href="#" class="go-open-room-desc text-underline" >Read More</a></div>');

});