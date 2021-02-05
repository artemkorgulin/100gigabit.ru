<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use App\User;
use phpDocumentor\Reflection\Types\Object_;
use Illuminate\Contracts\Auth\Access\Gate as Gate;

class PermissionsController extends Controller
{
    public function index(Request $request){


       /* $orderby = $request->get("orderby");
        $sort = $request->get("sort");
        if(!$orderby){
            $orderby="id";
        }
        if(!$sort){
            $sort="desc";
        }
        $permissions =  Permission::select('id', 'parent', 'name', 'display_name', 'description')->orderBy($orderby,$sort)->paginate(15);;

        $perpage = $permissions->perPage();
        $total = $permissions->total();

        return view('permissions',compact('permissions'))->with('i', ($request->input('page', 1) - 1) * 5);*/
        $article = Permission::all();
        return view('permissions/permissions',['permissions'=>$article]);

    }

    /**
     * Получение списка прав пользователя.
     * @param Request $request
     * @return array
     */
    public function getPermissions(Request $request)
    {
        $permissions = Permission::select('id', 'parent', 'name', 'display_name', 'description')->get(); // надо бы вынести в модель
        $data = [];
        $items = [];
        $i = 0;

        if ($request->get('user')) {
            $id = $request->get('user');
            $user = User::find($id);

            foreach ($user->permissions as $permission) {
                $items[] = $permission->id;
            }

            foreach ($permissions as $permission) {
                $state = new Object_(); // испольщование объектов
                $state->selected = false; // выбран ли пункт
//                $state->opened = false;

                $id = $permission->id;
                if ($permission->parent == 0) $permission->parent = '#'; // проверка на родителя
                if (in_array($id, $items)) $state->selected = true;

                $data[$i]['id'] = $id;
                $data[$i]['parent'] = $permission->parent;
                $data[$i]['text'] = $permission->display_name;
                $data[$i]['state'] = $state;
                $i++;
            }
        }


        return $data;
    }

    /**
     * Присваивание прав пользователю.
     * @param Request $request
     * @return int
     */
    public function setPermissions(Request $request)
    {
        $user = User::find($request->get('user'));
        $permissions = $request->get('data');

        $user->permissions()->detach();
        $user->permissions()->attach($permissions);

        return 1;
    }


    public function show($id){
        $this->authorize('show');
        $article=Permission::find($id);
        return view('permissions/showpermission',['user'=>$article]);
    }

    public function create(Gate $gate){
        if($gate->denies('create')){
            abort(403);
        }
        return view('permissions/createermission');
    }

    public function edit($id){
        $article=Permission::find($id);
        return view('permissions/editpermission',['user'=>$article]);
    }

    public function update(Request $request,$id){
        $article=Permission::find($id);
        $article->title=$request->title;
        $article->content=$request->content;
        $article->save();
        return redirect('/permissions');
    }

    public function delete($id){
        $article=Permission::find($id);
        $article->delete();
        return redirect('/permissions');
    }

    public function createperm(Request $request){
        $user = Permission::create([
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => bcrypt($request->get('description')),
        ]);

        return redirect('/permissions');
    }
}