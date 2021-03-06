<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Articles;
use App\Model\Category;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create')->withCategories(Category::all());
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'content' => 'required',
        ]);
        $article = new Articles;
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->author_id = $request->user()->id;
        $article->status = $request->status;
        $article->content = $request->content;
        $id = $article->save();
        return redirect()->back()->withMsg('Store the article success, ID: ' . $article->id);
    }

    /**
     * Display the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Articles::find($id);
        return view('admin.articles.edit')
            ->withCategories(Category::all())
            ->withArticle($article);
    }

    /**
     * Update the specified article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required',
            'content' => 'required',
        ]);
        $article = Articles::find($id);
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->author_id = $request->user()->id;
        $article->status = $request->status;
        $article->content = $request->content;
        $id = $article->save();
        return redirect()->back()->withMsg('Update the article success, ID: ' . $article->id);

    }

    /**
     * Remove the specified article from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
