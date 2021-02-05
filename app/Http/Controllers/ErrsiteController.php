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

class ErrsiteController extends Controller
{
    public function index(Request $request){

        header("HTTP/1.0 404 Not Found");
        return view('404');
    }

}
