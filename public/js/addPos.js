
    $(function () {
        $('#save_cmt').on('click', function () {
            $('.alert').removeClass('show').addClass('hidden');
            var author = $('#author').val();
            var content = $('#content').val();
            var post_id = $('#post_id').val();
            $.ajax({
                url: '/comment',
                type: "POST",
                data: 'data=' + '&author=' + author + '&content=' + content + '&post_id=' + post_id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    console.log(data);
                    $('#addArticle').modal('hide');
                    $('#articles-wrap').removeClass('hidden').addClass('show');
                    $('.alert').removeClass('show').addClass('hidden');
                    var str = '<div><b>' + data['author'] + '</b> say:' +
                        '<p>' + data['content'] + '</p>' + '<p style="font-size:12px;">' + data['created_at'] + '</p></div>';
                    $('#ct_list').append(str);
                },

                error: function (data) {
                    $('.alert').removeClass('show').addClass('hidden');
                    var errors = $.parseJSON(data.responseText);
                    var firstItem = Object.values(errors)[1];
                    var ErMes = Object.values(firstItem)[0];
                    jQuery('.alert-danger').show();
                    jQuery('.alert-danger').append('<p>' + ErMes + '</p>');
                }
            });

        });

    });

