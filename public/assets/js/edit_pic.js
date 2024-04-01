$("#profilePicForm").submit(function (e) {
    e.preventDefault();
    let formData = new FormData(this) // this is for profilePicForm
    console.log(formData);
    $.ajax({
        url: 'http://localhost/account/update-profile-pic',
        data: formData,
        type: 'PUT',
        dataType: 'json',
        contentType: false,
        processData: false, // Correct option name
        success: function (response) {
            console.log(response);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    })
});