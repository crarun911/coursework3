var postId = 0;
var postBodyElement = null;
var userPic=null;

$('.post').find('.interaction').find('.edit').on('click', function (event) {
    
    event.preventDefault();
    
    var postContainer = $(this).closest('.post');
    var postBody = postContainer.data('postbody'); 
    
     postId = postContainer.data('postid');
     userPic= postContainer.data('postimg');

    $('#post-body').val(postBody);
    $('#edit-modal').modal();
    $('#post-body').val(postBody);
    $('#edit-modal').modal();
});

$('#modal-save').on('click', function () {
    $.ajax({
            method: 'POST',
            url: urlEdit,
            data: {body: $('#post-body').val(), postId: postId, postImg: userPic, _token: token}
        })
        .done(function (msg) {
            $('article[data-postid="' + postId + '"] h4').text(msg['new_body']);
            $('#edit-modal').modal('hide');
        });
});

$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token}
    })
        .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            if (isLike) {
                
            } else {
                event.target.previousElementSibling.innerText = 'Like';
            }
        });
});

$('.comment-form').submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    var formData = form.serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        success: function(response) {
            var commentHtml = '<div>';
            commentHtml += '<img src= /images/' + response.comment.pic + ' alt="User Image" width="20" height="20">'+ response.comment.content;
            commentHtml += '</div>';

            form.closest('.post').find('.comments').append(commentHtml);

            form.find('input[name=body]').val('');
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});


