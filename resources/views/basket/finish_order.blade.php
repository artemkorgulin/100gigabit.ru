@extends('layouts.app')

@push('styles')
@endpush
@push('scripts')

<script type="text/javascript" src="/js/tablesorter/js/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="{{asset("js/functions.js")}}"></script>
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <br>
    <div class="container left">
        <h1>Заказ принят</h1>
        <hr>


        <table width=90%  align="center" border>
            <thead>
            <tr>
                <th>Идентификатор</th>
                <th>Изображение</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Итого</th>
            </tr>
            </thead>
            @foreach($orders as $order)
                <tr>
                    <td align="center">{{$order->item_id}}</td>
                    <td align="center" ><img height=50 src="{{$order->items->preview}}"></td>
                    <td align="center">{{$order->items->title}}</td>
                    <td align="center">{{$order->price}}</td>
                    <td align="center">{{$order->amount}}</td>
                    <td align="center">{{$order->price*$order->amount}}
                </tr>
            @endforeach
        </table>
        <h2>Общая сумма заказа: {{$total}}    </h2>
        <hr>
        <h2>Информация о доставке</h2>
        Адресс:{{$orders[0]->address}}<br>
        Имя: {{$orders[0]->name}}<br>
        Телефон: {{$orders[0]->phone}}<br>
    </div>
    <script type="text/javascript">


        $(document).ready(function($) {

            if(!$("a.orders").hasClass("active")) {
                $("a.orders").addClass("active");
            }

        })

    </script>
@endsection