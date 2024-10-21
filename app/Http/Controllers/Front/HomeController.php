<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        return view('front.home.index', [
            'latest_post' => Article::latest()->first(),
            'articles' => Article::with('Category')->whereStatus(1)->latest()->paginate(6),
            'categories' => Category::latest()->get()
        ]);
    }
}
