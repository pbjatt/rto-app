(function($) {

    // Send Contact Enquiry
    $(document).on('click', '#contact_form', function(e) {
    	alert('sjdhfdj');
        e.preventDefault();

        let form        = $(this),
            submit_btn  = form.find('[type=submit]'),
            ajax_url    = form.attr('action'),
            is_valid    = form.is_valid();

        form.find('.form-msg').removeClass('alert alert-info alert-success alert-danger').html('');

        if(is_valid) {
            submit_btn.attr('disabled', 'disabled').html('Please wait...');
            form.find('.form-msg').addClass('alert alert-info').html("Please wait, progressing...");
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    submit_btn.removeAttr('disabled').html('SEND MESSAGE');
                    form.find('.form-msg').removeClass('alert-info').addClass('alert-success').html(response.message);

                    form.find('input, textarea').val('');
                },
                error: function(err) {
                    console.log(err);
                    form.find('.form-msg').removeClass('alert-info').addClass('alert-danger').html('Some error occurs, mail not sent.');
                }
            });
        }
    });

});