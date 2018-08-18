$(function () {
    $(document).on('submit', 'form[name=encodeLink]', function (e) {
        e.preventDefault();
        if ($(this).closest('form').find('input[type=text]').val().length > 0) {
            var elem = $(this);
            var url = elem.closest('form').attr('action');
            var link = elem.closest('form').find('input[type=text]').val();

            if ($('.alert.alert-danger') && $('.alert.alert-danger').length > 0) {
                $('.alert.alert-danger').remove();
            }

            $.ajax({
                method: "POST",
                url: url,
                data: {
                    url: link
                },
                dataType: 'json',
                success: function (result) {
                    if (typeof result.newLink != 'undefined' && result.newLink.length > 0) {
                        if ($('.new_link') && $('.new_link').length > 0) {
                            $('.new_link').text('Ваша новая ссылка: ' + result.newLink);
                        }
                        else {
                            elem.closest('form').after('<p class="new_link">Ваша новая ссылка: ' + result.newLink + '</p>');
                        }
                    }
                    else {
                        if ($('.alert.alert-danger').length == 0) {
                            elem.closest('form').after('<div class="alert alert-danger" role="alert">\n' +
                                'Не верный адресс сылки' +
                                '</div>');
                        }

                        if ($('.new_link') && $('.new_link').length > 0) {
                            $('.new_link').remove();
                        }
                    }
                },
                error: function () {
                    if ($('.alert.alert-danger').length == 0) {
                        elem.closest('form').after('<div class="alert alert-danger" role="alert">\n' +
                            'Не верный адресс сылки' +
                            '</div>');
                    }

                    if ($('.new_link') && $('.new_link').length > 0) {
                        $('.new_link').remove();
                    }
                }
            });
        }
    });
});