<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests\ArticleRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class ArticleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.all',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //test upload for ajax
        /*$file = $request->imageUrl;
        foreach ($file as $item)
        {
            $fileName = $item->getClientOriginalName();

            $path = "images/";
            $item->move($path,$fileName);
        }
        return response(['success'=>"عکس ها با موفقیت آپلود شدن!!!"]);*/
        /*return User::create([
            'level'     => 'admin',
            'name'      => "Jafar",
            'email'     => "abbassmortazavi@gmail.com",
            "password"  => bcrypt("123456")
        ]);*/
       // auth()->loginUsingId(1);
        //19:18
        $file = $request->file('images');

        $imageUrl = $this->uploadImage($file);
        auth()->user()->articles()->create(array_merge($request->all() , ['images'=>$imageUrl]));

        return redirect(route('articles.index'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.articles.edit' , compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest|Request $request
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $file = $request->file('images');
        $inputs = $request->all();
        if ($file)
        {
            $inputs['images'] = $this->uploadImage($file);
        }else
        {
            $inputs['images'] = $article->images;
            $inputs['images']['thumb'] = $inputs['thumb'];
        }

        unset($inputs['thumb']);
        $article->update($inputs);

        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return back();
    }
}
