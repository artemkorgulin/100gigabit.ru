<?php

namespace App\Http\Controllers;


use App\User;
use App\Models\Permission;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request){
        /*$orderby = $request->get("orderby");
        $sort = $request->get("sort");
        if(!$orderby){
            $orderby="id";
        }
        if(!$sort){
            $sort="desc";
        }*/
        //$users = User::orderBy($orderby,$sort)->paginate(10);
        $article = User::all();

        /*$perpage = $users->perPage();
        $total = $users->total();*/

        /*return view('users',compact('users'))->with('i', ($request->input('page', 1) - 1) * 5);*/
        return view('users/users',['users'=>$article]);
    }

    public function show(Request $request,$id){
        $this->authorize('show');
        $article=User::find($id);
        $UserPermissions = $article->permissions()->get();
        $arPermissionUser = $UserPermissions->toArray();
        return view('users/showuser',['user'=>$article,'userpermissions'=>$arPermissionUser]);
    }

    public function create(Request $request,Gate $gate){
        if($gate->denies('create')){
            abort(403);
        }
        return view('users/createuser');
    }

    public function store(Request $request){
        User::create($request->all());
        return redirect('/users');
    }

    public function edit($id){
        $this->authorize('show');
        $article=User::find($id);
        return view('users/edituser',['user'=>$article]);
    }

    public function update(Request $request,$id){

        $article=User::find($id);
        $article->name=$request->name;
        $article->email=$request->email;
        $article->save();

        $user = User::find($id);
        $permissions = $request->get('permission_id');

        $user->permissions()->detach();
        $user->permissions()->attach($permissions);
        return redirect('/users');
    }

    public function delete($id){
        $article=User::find($id);
        $article->delete();
        return redirect('/users');
    }

    public function createuser(Request $request){
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $aruser = $user->toArray();
        $id = $aruser["id"];
        $usern = User::find($id);
        $permissions = $request->get('permission_id');

        $usern->permissions()->detach();
        $usern->permissions()->attach($permissions);
        return redirect('/users');
    }
}
