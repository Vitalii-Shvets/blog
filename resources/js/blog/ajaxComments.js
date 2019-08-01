class AjaxComment {
    constructor(formId) {
        $(formId).submit(function (e) {

            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    $(formId)[0].reset();
                    $('#errors').remove();
                    $('#block-comment').append(response.comment);

                },
                error: function (response) {
                    if (response.status === 422) {
                        let errors='<span id=\"errors\"><p class=\"text-danger\">';
                        $.each(response.responseJSON.errors, function( key, value ) {
                            $('#block-comment').append(response.comment);
                                errors += value[0]+'<br>' ;
                        });
                        errors +='</p></span> ';
                        $('#errors').remove();
                       $('#msg-errors').append(errors);
                    }
                }
            });
        });
    }
}

export default AjaxComment;
