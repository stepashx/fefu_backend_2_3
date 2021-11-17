<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getList()
    {
        $news = News::query()->
            where('is_published', '=', true)->
                where('published_at', '<=', now())->
                    orderByDesc('published_at')->
                        orderByDesc('id')->paginate(5);

        return view('news_list', ['news' => $news]);
    }

    public function getDetails(string $slug)
    {
        $news = News::query()->
            where('slug', '=', $slug)->
                where('is_published', '=', true)->
                    where('published_at', '<=', now())->
                        first();

        if ($news === null) {
            abort(404);
        }

        return view('news_view', ['news' => $news]);
    }
}
