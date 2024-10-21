<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('back.dashboard.index', [
            'total_articles' => Article::count(),
            'total_categories' => Category::count(),
            'latest_article' => Article::with('Category')->whereStatus(1)->latest()->take(10)->get(),
            'popular_article' => Article::with('Category')->whereStatus(1)->orderBy('views', 'desc')->take(5)->get()
        ]);
    }
}
