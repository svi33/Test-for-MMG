@extends('layouts/app')

@section('content')

    <div class="container">
        <div  style="font-size:2em;">
            <p><b>Name:</b> {{$category->name}}</p>
            <p><b>Description:</b> {{$category->description}}</p>
        </div>
        <h5>Coments</h5>
        <div class='row @if(count($comments)!= 0) show @else hidden @endif' id='articles-wrap'>
            <div id="ct_list">
                @foreach($comments as $comment)
                    <div >
                        <b>{{ $comment->author }}</b> say:
                        <p>{{ $comment->content }}</p>
                        <p style="font-size:12px;">{{ date('M d, Y h:i A', strtotime($comment->created_at)) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class='row'>
            <button type="button" class="btn btn-primary btn-lg pull-right" data-toggle="modal"
                    data-target="#addArticle">
                Add comment
            </button>
        </div>
        <br/>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addArticle" tabindex="-1" role="dialog" aria-labelledby="addArticleLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addArticleLabel">Add comment</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" id="author">
                    </div>
                </div>
                    <input type="hidden" id="category_id" value="{{$category->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="save" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function () {
            $('#save').on('click', function () {
                $('.alert').removeClass('show').addClass('hidden');
                var author = $('#author').val();
                var content = $('#content').val();
                var category_id= $('#category_id').val();
                $.ajax({
                    url: '{{ route('comment.store') }}',
                    type: "POST",
                    data: 'data=' + '&author=' + author + '&content='+content+'&category_id=' +category_id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        $('#addArticle').modal('hide');
                        $('#articles-wrap').removeClass('hidden').addClass('show');
                        $('.alert').removeClass('show').addClass('hidden');
                        var str = '<div><b>' + data['author'] + '</b> say:'+
                            '<p>' + data['content'] + '</p>' + '<p style="font-size:12px;">'+ data['created_at'] +'</p></div>';
                        $('#ct_list').append(str);
                    },

                    error: function (data) {
                        $('.alert').removeClass('show').addClass('hidden');
                        var errors = $.parseJSON(data.responseText);
                        var firstItem = Object.values(errors)[1];
                        var ErMes=Object.values(firstItem)[0];
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<p>'+ErMes+'</p>');
                    }
                });
            });
        });

    </script>

@endsection