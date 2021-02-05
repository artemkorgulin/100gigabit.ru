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
        {{ csrf_field() }}


        <ul class="collection with-header">
            <li class="collection-header">
                <div class="row">
                    <div class="col">
                        <h4>Ваш заказ:</h4>
                    </div>
                    <div class="col m10 s10 15">
                        <style>
                            .navbar-text {
                                line-height: 34px;
                            }

                            .basket-count {
                                display: block;
                                margin-top: 15px;
                            }
                            .basket-count {
                                display:none;
                            }
                            .basket-count>span {
                                font-size:1.5em;
                            }
                        </style>
                        <a class="right basket-count" href="/goods/basket">В корзине: <span class="glyphicon glyphicon-shopping-cart basket"></span><span class="count_order">0</span></a>
                    </div>
                </div>
            </li>
            <li class="collection-item">

                    <div class="row">
                        @if(count($orders)==0)

                        @else
                            <table width=100% class="table-responsive table-striped">
                                <thead>
                                <tr>
                                    <th>Идентификатор</th>
                                    <th>Изображение</th>
                                    <th>Название</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Итого</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->item_id}}</td>
                                        <td><img height=50 src="{{$order->img}}"></td>
                                        <td>{{$order->title}}</td>
                                        <td>{{$order->price}}</td>
                                        <td><input class="total" type="text" value="{{$order->amount}}"/> <button type="button" class="btn btn-default plus">+</button> <button type="button" class="btn btn-default minus">-</button></td>
                                        <td class="price_order">{{$order->price*$order->amount}}
                                        <td><button type="button" class="btn btn-danger del_order">Удалить</button></td>
                                    </tr>
                                @endforeach
                            </table>
                            <p>Итого к оплате: <span style="font-size: 2em;" class="total_cost">0</span> руб.</p>
                        @endif
                    </div>

                <h2>Информация о доставке</h2>
                <form method="POST" action="/orders/checkout">
                    <label for="name">Ваше имя</label><br>
                    <input class="form-control" type="text" name="name"/><br>
                    <label  for="address">Адрес доставки</label><br>
                    <input class="form-control" type="text" name="address"/><br>
                    <label for="phone">Телефон</label><br>
                    <input class="form-control" type="text" name="phone"/><br>
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <button type="submit" class="btn btn-primary btn-lg">Заказать</button>
                    <input type="hidden" id="user_id" name="user_id" value="{{{ Auth::user()->id }}}"/>
                </form>
            </div>
            <script type="text/javascript">


                $(document).ready(function($) {

                    if(!$("a.goods").hasClass("active")) {
                        $("a.goods").addClass("active");
                    }

                })

            </script>
        </li>
    </ul>
@endsection