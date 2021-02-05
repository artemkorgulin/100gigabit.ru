@extends('layouts.app')

@push('styles')
@endpush
@push('scripts')

<script type="text/javascript" src="/js/tablesorter/js/jquery-latest.min.js"></script>
<script src="{{asset("js/functions.js")}}"></script>
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <br>
    <div class="container left">
        <h1>Товар: {{$items->name}}</h1>
        <hr>

        <nav class="navbar  navbar-default">
            <div class="container left col s12 m12 l0 valign">
                <style>
                    .navbar-text {
                        line-height: 34px;
                    }

                    .basket-count {
                        display: block;
                    }

                    .basket-count>span {
                        font-size:1.5em;
                    }
                </style>
                <a class="right basket-count" href="/basket"><span class="glyphicon glyphicon-shopping-cart basket"></span><span class="count_order">0</span></a>
                <p class="navbar-text">Магазин</p>
            </div>
        </nav>
        <div class="container left">
            <div class="row">
                <div class="col-md-12">
                    @foreach($images as $image)
                        <img class="img-thumbnail" width=100 src="{{$image}}">
                    @endforeach
                </div>
            </div>
            <h3>{{$items->title}}</h3>
            <div class="panel panel-default">
                <div class="panel-heading">Описание</div>
                <div class="panel-body">
                    <b>{{$items->description}}</b>
                </div>
            </div>
            <h3>Параметры</h3>
            <table class="table table-striped">
                <thead>
                <th>Название</th>
                <th>Значение</th>
                <th>Ед. измерения</th>
                </thead>
                <tbody>

                @foreach($parameters as $parameter)
                    <tr>
                        <td>{{$parameter->title}}</td> <td>{{$parameter->value}}</td><td>{{$parameter->unit}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h2 class="text-success">Цена: {{$items->price}} руб.</h2>
            <hr>
            <button class="btn btn-primary btn-lg">Купить</button>
            <a href="/goods/edit/{{$items->id}}/"><button class="btn btn-primary btn-lg">Отредактировать</button></a>
        </div>
    </div>
    <script type="text/javascript">


        $(document).ready(function($) {

            if(!$("a.goods").hasClass("active")) {
                $("a.goods").addClass("active");
            }

        })

    </script>
@endsection