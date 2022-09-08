<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::get();
        $categories = Category::get();

        return view('pages.article.index', compact('articles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'category' => 'required',
        ]);

        $article = new Article();

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move('images/article', $imageName);

        $article->title = $request->title;
        $article->content = $request->content;
        $article->image = $imageName;
        $article->category_id = $request->category;
        $article->user_id = Auth::user()->id;

        $article->save();
        
        return back()->with('success', 'Article berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);

        return view('pages.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::get();

        if($article->user_id === Auth::user()->id){
            return view('pages.article.edit', compact('article', 'categories'));
        }

        return back()->with('error', 'Tidak dapat mengedit artikel orang lain');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        if($article->user_id === Auth::user()->id){
            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move('images/article', $imageName);

                $article->image = $imageName;
            }

            $article->title = $request->title ? $request->title : $article->title;
            $article->content = $request->content ? $request->content : $article->content;
            $article->category_ID = $request->category ? $request->category : $article->category_id;

            $article->save();

            return back()->with('success', 'Article berhasil diupdate');
        }

        return back()->with('error', 'Tidak dapat mengupdate artikel orang lain');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if($article->user_id === Auth::user()->id){
            $article->delete();
            return back()->with('success', 'Artikel berhasil dihapus');
        }

        return back()->with('error', 'Tidak dapat menghapus artikel orang lain');
    }
}
