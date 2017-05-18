$('.edit_translate').on('click',function () {
    var field = $(this).attr('data-id');
    $.ajax({
        'data' : {'field': field},
        'dataType' : 'html',
        'success' : function(data) {
            $("#translate-form").find('.modal-title').html('Редактирование');
            $("#translate-form").find('.modal-body').html(data);
            $('#action').val('update');
            $("#translate-form").modal('show');
        },
        'type' : 'post',
        'url' : '/translate/ajax-response/translate-modal?action=update'
    });
});

$('.save-translate-words').on('click',function () {
    var form = $('.translate-form');
    var disabled = form.find(':input:disabled').removeAttr('disabled');
    $.ajax({
        'data' : form.serializeArray(),
        'dataType' : 'json',
        'async': false,
        'success' : function(data) {
            if (data) {
                var parent_cont = $('.translate_body').find("[data-name='"+data.word+"']");

                if (parent_cont.length > 0) {
                    $.each( data, function( key, value ) {
                        if (key != 'word') {
                            var lang_cont = parent_cont.find("[data-name='"+(parseInt(key))+"']");
                            lang_cont.html(value);
                        }
                    });
                }
                else {
                    var append =
                        '<div class="translate-row" style="height: 45px;">' +
                            '<div class="col-md-3">' +
                                '<div class="form-group">' +
                                    '<a href="javascript://" class="edit_translate" data-id="'+data.word+'">' +
                                        '<i class="fa fa-pencil"></i> ' +
                                    '</a>' +
                                    data.word+
                                '</div>' +
                            '</div>';
                    $.each( data, function( key, value ) {
                        if (key != 'word') {
                            append +=
                                '<div class="col-md-3" data-name="'+data.word+'">' +
                                    '<div class="form-group" data-name="'+key+'">' +
                                        value +
                                    '</div>' +
                                '</div>';
                        }
                    });
                    append += '</div>';
                    $('.translate_body').append(append);
                }
                $("#translate-form").modal('hide');
            }
            else {
                $("#translate-form").find('.modal-body').append('<div class="alert alert-danger"><i class="fa fa-exclamation-circle fa-2x"></i> Поле "ключ" не заполнено, либо такой ключ уже существует</div>');
            }
        },
        'type' : 'post',
        'url' : '/translate/ajax-response/save-translate'
    });
});

$('.add_translate').on('click',function () {
    var field = '';
    $.ajax({
        'data' : {'field': field},
        'dataType' : 'html',
        'success' : function(data) {
            $("#translate-form").find('.modal-title').html('Редактирование');
            $("#translate-form").find('.modal-body').html(data);
            $('#action').val('create');
            $("#translate-form").modal('show');
        },
        'type' : 'post',
        'url' : '/translate/ajax-response/translate-modal?action=create'
    });
});

