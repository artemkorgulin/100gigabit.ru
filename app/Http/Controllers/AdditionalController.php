<?php

namespace App\Http\Controllers;

use App\User;
use App\Services;
use App\Additional;
use App\Models\Permission;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AdditionalController extends Controller
{
    public function index(Request $request){

        $article = Additional::all();

        return view('additional/additional',['users'=>$article]);
    }

    public function show(Request $request,$id){
        $this->authorize('show');
        $article=Additional::find($id);

        return view('additional/showadditional',['user'=>$article]);
    }

    public function create(Request $request,Gate $gate){
        if($gate->denies('create')){
            abort(403);
        }
        return view('additional/createadditional');
    }

    public function store(Request $request){
        Services::create($request->all());
        return redirect('/additional');
    }

    public function edit($id){
        $this->authorize('show');
        $article=Additional::find($id);
        return view('additional/editadditional',['user'=>$article]);
    }

    public function update(Request $request,$id){

        $article=Additional::find($id);
        $article->name=$request->name;
        $article->email=$request->email;
        $article->save();

        return redirect('/additional');
    }

    public function delete($id){
        $article=Additional::find($id);
        $article->delete();
        return redirect('/additional');
    }

    public function createuser(Request $request){
        Additional::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        return redirect('/additional');
    }
}
