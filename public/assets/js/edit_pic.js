$("#profilePicForm").submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: '{{ route("account.updateProfilePic") }}',
        type: 'post',
        data: formData,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.status == false) {
                let errors = response.errors;
                if (errors.image) {
                    $("#image-error").html(errors.image)
                }
            } else {
                window.location.href = '{{ url()->current() }}';
            }
        }
    });
});
