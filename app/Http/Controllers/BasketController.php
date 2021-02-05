<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Items;
use App\Parameters_values;
use App\Parameters;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class BasketController extends Controller
{
    public function orders()
    {
        $orders=Orders::allorders();
        return view('/basket/orders',['orders'=>$orders]);
    }

    public function checkout(Request $request)
    {
        if(isset($_COOKIE['basket'])) // проверяем, есть ли заказы
        {
            $orders = $_COOKIE['basket'];
            $orders=json_decode($orders); //перекодируем строку из куки в массив с объектами
        }
        else
        {
            return redirect('/'); //если заказ пустой, то редиректим на главную страницу
        }
        $ids=[]; //все идентификаторы товаров
        $amount=[];//количество товаров
        $total_cost=0; //общая цена заказа
        $order_id=Orders::latest()->first();//получаем последний заказ
        empty($order_id)? $order_id=1:$order_id=$order_id->order_id+1; //определяемся с новым заказом, увеличивая номер последнего заказа на 1

        foreach($orders as $order)
        {
            $ids[]=$order->item_id;//создаем массив из id заказанных товаров
            $amount[$order->item_id]=$order->amount; //создаем массив с количеством каждого товара ['id товара'=>'количество товара']
        }

        $items=Items::whereIn('id',$ids)->get(); //выбираем все заказанные товары из базы
        foreach($items as $item)
        {
            $orders=Orders::create(['item_id'=>$item->id,'price'=>$item->price,'order_id'=>$order_id,'amount'=>$amount[$item->id],'name'=>$request->name,'address'=>$request->address,'phone'=>$request->phone, 'type'=>'type', 'user_id'=>$request->user_id, 'state'=>1]);//сохраняем заказ в базу
            $total_cost=$total_cost+$item->price*$amount[$item->id]; //считаем общую сумму заказа
        }

        setcookie('basket',''); //удаляем куки
        $orders=Orders::where('order_id',$orders->order_id)->get();//получаем только, что добавленный заказ
        return view('/basket/finish_order',['orders'=>$orders,'total'=>$total_cost]);
    }

    public function show()
    {

        if(isset($_COOKIE['basket'])) // проверяем, есть ли заказы
        {
            $orders = $_COOKIE['basket'];
            $orders=json_decode($orders); //перекодируем строку из куки в массив с объектами
        }
        else
        {
            $orders=[];
        }
        
        return view('/basket/basket',['orders'=>$orders]);
    }

    public function showorder(Request $request,$id)
    {

        if(isset($_COOKIE['basket'])) // проверяем, есть ли заказы
        {
            $orders = $_COOKIE['basket'];
            $orders=json_decode($orders); //перекодируем строку из куки в массив с объектами
            $orders[0]->id = $orders[0]->item_id;
            $orders=Orders::find($orders[0]->item_id);
        }
        else
        {
            $orders=[];
            $orders=Orders::find($id);
        }
        //print_r($orders); exit;
        return view('/orders/showorder',['orders'=>$orders]);
    }
}
