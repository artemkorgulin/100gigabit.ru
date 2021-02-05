<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    protected $fillable=['item_id','order_id','price','amount','name','address','phone','type','user_id','state'];

    public function items() //этот метод нам понадобится чуть позже
    {
        return $this->belongsTo('App\Items', 'item_id', 'id');   //связь один к одному
    }

    public static function allorders()
    {
       // return DB::table('orders')->groupBy('order_id')->select('order_id',DB::raw('sum(price) as summa'))->get();
       return DB::table('orders')->select(
           'order_id',
           DB::raw('price as summa'),
           DB::raw('user_id as user_id'),
           DB::raw('type as type'),
           DB::raw('state as state'),
           DB::raw('amount as amount'),
           DB::raw('item_id as item_id'),
           DB::raw('name as name')
       )->get();
    }
}
