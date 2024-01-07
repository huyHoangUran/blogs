import './bootstrap';
import './config';


$(document).ready(function() {
    $('#error').hide();

    function attachEditEvent(comment) {
        comment.find('.edit-comment-btn').on('click', function() {
            const commentContent = $(this).closest('.comment-content');
            const editInput = commentContent.find('.edit-input');
            const submitBtn = commentContent.find('.submit-comment-btn');
            const commentText = commentContent.find('.comment-text');
            const editBtn = $(this);
            const deleteBtn = commentContent.find('.delete-comment-btn');
            const cancelBtn = commentContent.find('.cancel-edit-btn');

            editInput.val(commentText.text()).toggle();
            commentText.toggle();
            editBtn.toggle();
            submitBtn.toggle();
            cancelBtn.toggle(editInput.is(':visible'));
            deleteBtn.toggle();

            cancelBtn.off('click').on('click', function() {
                editInput.toggle();
                commentText.toggle();
                editBtn.toggle();
                submitBtn.toggle();
                cancelBtn.toggle();
                deleteBtn.toggle();
            });
        });

        comment.find('.submit-comment-btn').on('click', function() {
            const commentContent = $(this).closest('.comment-content');
            const editedText = commentContent.find('.edit-input').val();
            const updateUrl = `/comments/update/${comment.data('comment-id')}`;
            
            $.ajax({
                url: updateUrl,
                type: 'PUT',
                data: { content: editedText },
                success: function() {
                    commentContent.find('.comment-text').html(editedText).toggle();
                    commentContent.find('.edit-input, .submit-comment-btn').toggle();
                    commentContent.find('.edit-comment-btn, .delete-comment-btn, .cancel-edit-btn').toggle();
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                }
            });
        });

        comment.find('.delete-comment-btn').on('click', function() {
            const commentId = comment.data('comment-id');
            const deleteUrl = `/comments/delete/${commentId}`;
        
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                success: function() {
                    comment.remove();
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });
    }

    $('#commentForm').on('click', function(ev) {
        ev.preventDefault();
        const contentComment = $('#contentComment').val();
        const commentUrl = data.getAttribute('comment-create-route');

        $.ajax({
            url: commentUrl,
            type: 'POST',
            data: { content: contentComment },
            success: function(response) {
                const newCommentId = response.data.id;
                const newItemHTML = `
                    <div class="list" data-comment-id="${newCommentId}">
                        <div class="avatar">
                            <img src="${data.getAttribute('image-user')}" alt="">
                        </div>
                        <div class="name">
                            <h5>${response.user.name}</h5>
                            <div class="comment-content">
                            <p class="comment-text">${response.data.content}</p>
                            <textarea class="edit-input" style="display: none;"></textarea>
                            <button class="edit-comment-btn"><i class="bi bi-pen"></i></button>
                            <button class="delete-comment-btn"><i class="bi bi-trash"></i></button>
                            <button class="submit-comment-btn" style="display: none;"><i class="bi bi-send"></i></button>
                            <button class="cancel-edit-btn" style="display: none;"><i class="bi bi-x-circle-fill"></i></button>
                            </div>
                            <p class="time">${response.data.time_elapsed}</p>
                        </div>
                    </div>`;
                $('#commentSection').prepend(newItemHTML);
                attachEditEvent($('#commentSection').children().first());
                $('#contentComment').val('');
                $('#error').hide();
            },
            error: function(xhr) {
                const errorMessage = JSON.parse(xhr.responseText).message;
                $('#error').html(errorMessage).show();
            }
        });
    });

    $('.list').each(function() {
        attachEditEvent($(this));
    });
});

