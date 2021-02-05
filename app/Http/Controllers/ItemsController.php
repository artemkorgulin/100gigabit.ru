<?php

namespace App\Http\Controllers;

use App\Items;
use App\Parameters_values;
use App\Parameters;
use Illuminate\Contracts\Auth\Access\Gate as Gate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    public function add()
    {
        return view('items/add');
    }

    public function save(Request $request)
    {
        $root=$_SERVER['DOCUMENT_ROOT']."/images/"; //определяем папку для сохранения картинок

        //Сохраняем картинки
        $url_img=[]; // массив, который будет содержать ссылки на все картинки
        foreach($request->file('preview') as $file) //обрабатываем массив с файлами
        {
            if(empty($file)) continue; // если <input type="file"... есть, но туда ничего не загруженно, то пропускаем
            $f_name=$file->getClientOriginalName(); //получаем имя файла
            $url_img[]='/images/'.$f_name; //добавляем url картинки в массив
            $file->move($root,$f_name); //перемещаем файл в папку
        }

        $preview=implode(';',$url_img); //массив с ссылками переводим в строку, что бы сохранить в базу.
        //Сохраняем каждый параметр
        $item=new Items;
        $item->name=$request->name; //название
        $item->description=$request->description;//описание
        $item->price=$request->price; // цена
        $item->preview=$preview; //ссылки на картинки
        $item->save(); // Сохраняем все в базу.
        //Обратабываем массивы с параметрами и их значениями.
        if(count($request->get("parameter"))>0 && count($request->get("value"))>0) {
            $out=array_combine($request->get("parameter"),$request->get("value")); // массив будет такой ['5'=>'300'], 5 - это id параметра, 300 - значение параметра
        }
        //Сохраняем все параметры и значения в базу
        if(empty($out)) {return back()->with('message','Товар сохранен');} //если нет ни одного параметра то просто редиректим обратно.
        foreach($out as $param=>$value)
        {
            $parameters=new Parameters_values;
            $parameters->parameters_id=$param;
            $parameters->items_id=$item->id;
            $parameters->value=$value;
            $parameters->save();
        }
        return back()->with('message','Товар сохранен');
    }

    public function show($id)
    {

        $items=Items::find($id); // получаем все, что касается товара (название, цена....)
        $parameters=Items::parameters($id);//получаем все параметры
        $images = array();
        if(isset($parameters[0])){
            $images=explode(';',$parameters[0]->preview); //ссылки на картинки передаем отдельным массивом
        }

        return view('items/show',['items'=>$items,'parameters'=>$parameters,'images'=>$images]);
    }


    public function edit($id)
    {
        $item=Items::find($id); //основные параметры
        $parameters=Items::parameters($id); //дополнительные параметры товара
        $parameters_all=Parameters::all(); //все параметры в базе
        if(isset($parameters[0])) //проверяем, есть ли изображения в базе
        {
            $images=[];
            if(strlen($parameters[0]->preview)>0) {
                $images = explode(';', $parameters[0]->preview);//изображения товара
            }
        }
        else
        {
            $images=[];
        }

        return view('items/edit',['item'=>$item,'parameters'=>$parameters,'images'=>$images,'parameters_all'=>$parameters_all]);
    }

    public function del_image(Request $request)
    {
        $src=$request->input("src");
        $item_id=$request->input("item_id");
        $item=Items::find($item_id);
        $images=explode(";",$item->preview);//преобразуем строку в массив
        $root=$_SERVER['DOCUMENT_ROOT']; //путь до картинок
        if(($key=array_search($src,$images))>=0) //находим ключ, значение, которого соответствует ссылке на картинку
        {
            unset($images[$key]); //удалем ссылку из массива
            if(file_exists($root.$src)) //проверяем существование файла
            {
                unlink($root.$src); //удаляем файл
            }
        }

        $url=implode(";",$images); //переделываем массив строку
        $item->preview=$url; //обновляем значение в поле preview
        $item->save(); //сохраняем изменения
        return "OK";
    }

    public function update(Request $request, $id)
    {

        $root=$_SERVER['DOCUMENT_ROOT']."/images/"; //определяем папку для сохранения картинок
        //Сохраняем картинки
        $url_img=[]; // массив, который будет содержать ссылки на все картинки
        foreach($request->file('preview') as $file) //обрабатываем массив с файлами
        {
            if(empty($file)) continue; // если <input type="file"... есть, но туда ничего не загруженно, то пропускаем
            $f_name=$file->getClientOriginalName();
            $url_img[]='/images/'.$f_name; //добавляем url картинки в массив
            $file->move($root,$f_name); //перемещаем файл в папку
        }

// Сохраняем товар
        $item=Items::find($id);
        $item->name=$request->name; //название
        $item->description=$request->description;//описание
        $item->price=$request->price; // цена
        strlen($item->preview) ? $item->preview=explode(';',$item->preview) : $item->preview=[]; // если в базе нет ссылок, то возвращаем пустой массив либо поулчаем массив из строк
        $item->preview=implode(';',array_merge($item->preview,$url_img));//создаем строку с ссылками;  //ссылки на картинки, добавляем ссылки к существующей строке
        $item->save(); // Сохраняем все в базу.

//Обратабываем массивы с параметрами и их значениями.
        if(is_array($request->parameter)   )
        {
            if(count($request->get("parameter"))>0 && count($request->get("value"))>0) {
                $out = array_combine($request->get("parameter"), $request->get("value")); // массив будет такой ['5'=>'300'], 5 - это id параметра, 300 - значение параметра
            }
            //Удаляем все дополнительные параметры товара и их значения
            Items::del($id);
            //Сохраняем все параметры и значения в базу
            foreach($out as $param=>$value)
            {
                $parameters=new Parameters_values;
                $parameters->parameters_id=$param;
                $parameters->items_id=$id;
                $parameters->value=$value;
                $parameters->save();
            }
        }

        return back()->with('message', "Товар изменен" );

    }

    public function showall()
    {
        $items=Items::all();
        return view('items/index',['items'=>$items]);
    }

    public function delete($id){
        $items=Items::find($id);
        $items->delete();
        return redirect('/goods');
    }
}
