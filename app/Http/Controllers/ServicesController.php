<?php

namespace App\Http\Controllers;

use App\User;
use App\Services;
use App\Models\Permission;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(Request $request){

        $article = Services::all();

        return view('services/services',['users'=>$article]);
    }

    public function show(Request $request,$id){
        $this->authorize('show');
        $article=Services::find($id);

        return view('services/showservice',['user'=>$article]);
    }

    public function create(Request $request,Gate $gate){
        if($gate->denies('create')){
            abort(403);
        }
        return view('services/createservice');
    }

    public function store(Request $request){
        Services::create($request->all());
        return redirect('/services');
    }

    public function edit($id){
        $this->authorize('show');
        $article=Services::find($id);
        return view('services/editservice',['user'=>$article]);
    }

    public function update(Request $request,$id){

        $article=Services::find($id);
        $article->name=$request->name;
        $article->email=$request->email;
        $article->save();

        return redirect('/services');
    }

    public function delete($id){
        $article=Services::find($id);
        $article->delete();
        return redirect('/services');
    }

    public function createuser(Request $request){
        Services::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        return redirect('/services');
    }
}
