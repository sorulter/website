<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Articles;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the artilces.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = new Articles;
        return view('admin.articles.index')->withArticles($articles->paginate(env('PERPAGE')));
    }
}
