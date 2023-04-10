<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function list(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = News::where('title', $cond_title)->orderBy('updated_at', 'desc')->get();
        } else {
            $posts = News::all()->sortByDesc('updated_at');
        }
        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('news.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }
}
