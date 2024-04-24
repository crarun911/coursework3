$(document).ready(function() {
    $('.like-btn').click(function() {
        var postId = $(this).data('post-id');
        var likeBtn = $(this);

        $.ajax({
            type: 'POST',
            url: '/posts/' + postId + '/like',
            success: function(response) {
                // Update the like count in the UI
                var likeCount = response.likes;
                likeBtn.text('Like (' + likeCount + ')');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});