<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category::all();
        return view('categories.index', compact(['categories']));
    }

    public function create ()
    {
        $categories = Category::all();
        return view('categories.form', compact(['categories']));
    }

    public function store (Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('category.index');
    }

    public function show ($id)
    {
        $category = Category::find($id);
        $comments = Comment::where('category_id', $id)->get();
        return view('categories.show', compact('category', 'comments'));
    }


    public function edit ($id)
    {
        $entity = Category::find($id);
        return view('categories.form', compact(['entity']));
    }


    public function update (Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category->update($request->all());
        return redirect()->route('category.index');
    }

    public function destroy ($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index');
    }

    public function getComment ($id){
        $comments = DB::table('comments')
            ->select(['id', 'author','content','created_at'])
            ->where('category_id', '=', $id)
            ->get();

        return view('comments.index', compact('comments'));

    }


}
