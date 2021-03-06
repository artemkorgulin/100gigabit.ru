<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate as Gate;

class ArticleController extends Controller
{
    public function index(){
	$articles=Article::all();
	return view('articles',['articles'=>$articles]);
    }

    public function show($id){
         $this->authorize('show');
         $article=Article::find($id);
         return view('show',['article'=>$article]);
    }

    public function create(Gate $gate){
        if($gate->denies('create')){
             abort(403);
         }
         return view('create');
    }

    public function store(Request $request){
        Article::create($request->all());
        return redirect('/articles');
    }

    public function edit($id){
        $article=Article::find($id);
        return view('edit',['article'=>$article]);
    }

    public function update(Request $request,$id){
        $article=Article::find($id);
        $article->title=$request->title;
        $article->content=$request->content;
        $article->save();
	return redirect('/articles');
    }

    public function delete($id){
	$article=Article::find($id);
	$article->delete();
	return redirect('/articles');
    }

}