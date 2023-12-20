$('#editpwd').validate({
    ignore: '.ignore',
    errorClass: 'invalid',
    validClass: 'success',
    rules: {
        old_password: {
            required: true,
        },
        new_password: {
            required: true,
        },
        confirm_password: {
            required: true,
            equalTo: '#new_password'
        },
    },
    messages: {
        old_password: {
            required: 'Please enter old password',
        },
        new_password: {
            required: 'Please enter new password',
        },
        confirm_password: {
            required: 'Need to confirm your new password',
        }
    },
    submitHandler: function (form) {
        $.LoadingOverlay("show");
        form.submit();
    }
});