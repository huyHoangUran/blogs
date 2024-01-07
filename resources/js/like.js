$(document).ready(function() {
    $('.like-btn').on('click', function() {
        const clickedButton = $(this);
        const likeUrl = $('.like').data('like-route');
        $.ajax({
            url: likeUrl,
            type: 'POST',
            success: function(response) {
                $('.count-like').text(response.liked);
                clickedButton.find('i').toggleClass('bi-heart bi-heart-fill');
            },
            error: function(xhr) {
                console.error(xhr);
            }
        });
    });
});
