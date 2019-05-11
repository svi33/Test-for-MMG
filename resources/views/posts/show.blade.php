@extends('layouts/app')

@section('content')
    <div class="container">
        <div style="font-size:2em;">

            <p>name:{{$post->name}}</p>
            <p>category_id:{{$post->category_id}}</p>
            <p>content:{{$post->content}}</p>
            <p>file name:{{$post->file}}</p>

        </div>
        <h5>Comments</h5>
        <div class='row @if(count($comments)!= 0) show @else hidden @endif' id='articles-wrap'>
            <div id="ct_list">
                @foreach($comments as $comment)
                    <div>
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
                    <h4 class="modal-title" id="addArticleLabel">Add Comment</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" id="author">
                    </div>
                </div>
                <input type="hidden" id="post_id" value="{{$post->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" id="save_cmt" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


    <script  type="text/javascript">
        $(function () {
            $('#save_cmt').on('click', function () {
                $('.alert').removeClass('show').addClass('hidden');
                var author = $('#author').val();
                var content = $('#content').val();
                var post_id = $('#post_id').val();
                $.ajax({
                    url: '{{ route('comment.store') }}',
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
                        //console.log(data);
                        var errors = $.parseJSON(data.responseText);
                        var firstItem = Object.values(errors)[1];
                        var ErMes = Object.values(firstItem)[0];
                        //console.log(firstItem);
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<p>' + ErMes + '</p>');
                    }
                });

            });

        });

    </script>

@endsection