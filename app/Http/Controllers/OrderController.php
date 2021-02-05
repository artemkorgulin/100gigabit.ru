<?php

namespace App\Http\Controllers;


use App\User;
use App\Orders;
use App\Models\Permission;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request){

        $article = Orders::all();

        return view('orders/orders',['users'=>$article]);
    }

    public function show(Request $request,$id){
        $this->authorize('show');
        $article=Orders::find($id);
        $UserPermissions = $article->permissions()->get();
        $arPermissionUser = $UserPermissions->toArray();
        return view('orders/showorder',['user'=>$article,'userpermissions'=>$arPermissionUser]);
    }

    public function create(Request $request,Gate $gate){
        if($gate->denies('create')){
            abort(403);
        }
        return view('orders/createorder');
    }

    public function store(Request $request){
        Orders::create($request->all());
        return redirect('/orders');
    }

    public function edit($id){
        $this->authorize('show');
        $article=Orders::find($id);
        return view('orders/editorder',['user'=>$article]);
    }

    public function update(Request $request,$id){

        $article=Orders::find($id);
        $article->name=$request->name;
        $article->email=$request->email;
        $article->save();

        $user = Orders::find($id);
        $permissions = $request->get('permission_id');

        $user->permissions()->detach();
        $user->permissions()->attach($permissions);
        return redirect('/orders');
    }

    public function delete($id){
        $article=Orders::find($id);
        $article->delete();
        return redirect('/orders');
    }

    public function createuser(Request $request){
        $user = Orders::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $aruser = $user->toArray();
        $id = $aruser["id"];
        $usern = Orders::find($id);
        $permissions = $request->get('permission_id');

        $usern->permissions()->detach();
        $usern->permissions()->attach($permissions);
        return redirect('/orders');
    }
}
