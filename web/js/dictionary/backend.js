$('.delete-meaning').parent().on('click',function () {
    var del = $(this).children().attr('data-id');
    $('.delete-meaning-modal').attr('data-id',del);
    $("#deleteBox").modal('show');
});

$('.delete-meaning-modal').on('click',function () {
    var del = $(this).attr('data-id');
    $("#deleteBox").modal('show');
    $.ajax({
        'data' : {'meaning_id': del},
        'dataType' : 'json',
        'success' : function(data) {
            $("#deleteBox").modal('hide');
            location.reload();
        },
        'type' : 'post',
        'url' : '/backend/ajax/delete-meaning'
    });
});

$('.add_meaning').on('click',function () {
    var meaning_count = parseInt($(this).attr('data-id'));
    $(this).attr('data-id',meaning_count+1);
    $.ajax({
        'data' : {'seq': meaning_count},
        'dataType' : 'html',
        'success' : function(data) {
            $('.meanings').append(data);
            $("#addmeanings").collapse('show');
        },
        'type' : 'post',
        'url' : '/backend/ajax/generate-meaning'
    });
});

$('.add_example').on('click',function () {
    var example_count = parseInt($(this).attr('data-id'));
    var word = parseInt($(this).attr('data-word'));
    if (word) {
        $(this).attr('data-id',example_count+1);
        $.ajax({
            'data' : {'seq': example_count,'word': word},
            'dataType' : 'html',
            'success' : function(data) {
                $('.examples').append(data);
            },
            'type' : 'post',
            'url' : '/backend/ajax/generate-example'
        });
    }

});