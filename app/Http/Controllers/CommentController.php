<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CommentRequest;
use App\Post;
use Illuminate\Http\Request;
use App\Rules\Author_Rule;



class CommentController extends Controller
{
    public function index ()
    {
        $comments = Comment::all(['id', 'author','content','created_at']);
        return view('comments.index', ['comments' => $comments]);
    }

    public function store (CommentRequest $request)
    {
        $this->validate($request, [
            'author' => ['required' ,'string', new Author_Rule],
            'content'=>'required',
        ]);

        $comment = new Comment();
        if($request->post_id){
            $comment->post_id = $request->post_id;
            $comment->category_id = 0;
        }else{
            $comment->post_id = 0;
            $comment->category_id = $request->category_id;
        }

        $comment->author = $request->author;
        $comment->content = $request->content;

        $comment->save();

        $data = ['id' => $comment->id, 'author' => $request->author, 'content' => $request->content, 'created_at'=>(date('M d, Y h:i A', strtotime($comment->created_at)))];
        return $data;
    }

    public function show ($id)
    {
        $comment = Comment::find($id);
        return view('comments.show', ['comment' => $comment]);
    }

    public function destroy ($id)
    {
        Comment::find($id)->delete();
        return 'ok';
    }

}
