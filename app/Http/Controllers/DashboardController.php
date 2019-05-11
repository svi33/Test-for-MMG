<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('dashboard', [
            'categories' => Category::all(),
            'posts' => Post::all(),
            'count_categories' => Category::count(),
            'count_posts' => Post::count(),
            'comments'=>Comment::all(),
            'count_comments'=>Comment::count(),
        ]);
    }
}
