<?php

namespace App\Http\Controllers;
use App\Category;
use App\Comment;
use App\Post;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CommentRequest;
use App\Rules\Author_Rule;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = DB::table('categories')->select('id','name')->get();;
        return view('posts.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'file'=> 'max:2048'
        ]);

        $form_data=array(
            'name'=>$request->name,
            'content'=>$request->content,
            'category_id' => $request->category_id,
        );
        Post::create($form_data);

        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post=Post::find($id);
        $comments=Comment::where('post_id',$id)->get();
        return view('posts.show', compact('post','comments'));
    }

    public function edit(Post $post)
    {
        $entity = $post;
        $categories = Category::all();
        return view('posts.form', compact('categories', 'entity'));
    }

    public function update(Request $request, Post $post)
    {
        if (isset($request->hidden_file)){$file_name=$request->hidden_file;}
        $file=$request->file('file');
        if ($file!='') {
            $this->validate($request, [
                'name' => 'required',
                'content' => 'required',
                'category_id' => 'required|integer',
                'file'=> 'max:2048'
            ]);
            $path='images/'.$post->id.'/';
            $file_name=rand().'.'.$file->getClientOriginalExtension();
            $file->move(public_path($path),$file_name);

        } else {
            $this->validate($request, [
                'name' => 'required',
                'content' => 'required',
                'category_id' => 'required|integer',
            ]);
        }
        if (isset($file_name)) {
            $form_data = array(
                'name' => $request->name,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'file' => $file_name,
            );
        }else {
            $form_data = array(
                'name' => $request->name,
                'content' => $request->content,
                'category_id' => $request->category_id,
            );
        }
        $post->update($form_data);
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if(isset($post->file)){
            $path='images/'.$post->id.'/';
            File::deleteDirectory(public_path($path));
        }
        $post->delete();
        return redirect()->route('posts.index');
    }

}
