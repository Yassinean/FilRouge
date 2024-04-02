$("#profilePicForm").submit(function (e) {
    e.preventDefault();
    if (image.files && image.files[0]) {
        $("#profilePicForm").submit();
    } else {
        $('#image-error').html('The image field is required')
    }
});