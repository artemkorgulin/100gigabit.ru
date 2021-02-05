<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Permission;
use App\Statuses;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function index(Request $request){

        $article = Statuses::all();

        return view('statuses/statuses',['users'=>$article]);
    }

    public function show(Request $request,$id){
        $this->authorize('show');
        $article=Statuses::find($id);

        return view('statuses/showstatus',['user'=>$article]);
    }

    public function create(Request $request,Gate $gate){
        if($gate->denies('create')){
            abort(403);
        }
        return view('statuses/createstatus');
    }

    public function store(Request $request){
        Statuses::create($request->all());
        return redirect('/statuses');
    }

    public function edit($id){
        $this->authorize('show');
        $article=Statuses::find($id);
        return view('statuses/editstatus',['user'=>$article]);
    }

    public function update(Request $request,$id){

        $article=Statuses::find($id);
        $article->name=$request->name;
        $article->save();

        return redirect('/statuses');
    }

    public function delete($id){
        $article=Statuses::find($id);
        $article->delete();
        return redirect('/statuses');
    }

    public function createstatus(Request $request){
        Statuses::create([
            'name' => $request->get('name'),
        ]);

        return redirect('/statuses');
    }
}
