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

    {{ csrf_field() }}
    <ul class="collection with-header">
        <li class="collection-header">
            <div class="row">
                <div class="col">
                    <h4>Добавить товар:</h4>
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

            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <input type="file" name="preview[]"/><br>
                    </div>
                    <div class="col-md-8">
                        <i class="glyphicon glyphicon-arrow-left"></i> Выберите миниатюру для товара. <p class="help-block">Размер изображения 150x150px, не более 200Кб</p>
                    </div>
                    <hr>
                    <h3>Дополнительные изображения</h3>
                    <button class="btn btn-primary add_images" type="button"><i class="glyphicon glyphicon-plus">+</i></button>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <label class="control-label" for="name">Название товара</label>
                        <input class="form-control" type="text" name="name"/>
                        <label for="description" class="control-label">Описание товара</label>
                        <textarea class="form-control" name="description" rows="4"></textarea>
                        <label class="control-label" for="price">Цена</label>
                        <input class="form-control" type="text" name="price"/>
                    </div>
                </div>
                <h2>Параметры товара</h2>
                <hr>
                <button class="btn btn-primary btn-lg add_button" type="button">Добавить</button>
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <br><br>
                <hr>
                 <button class="btn btn-default btn-lg" type="submit">Сохранить товар</button>
            </form>


            <script type="text/javascript">


                $(document).ready(function($) {

                    if(!$("a.goods").hasClass("active")) {
                        $("a.goods").addClass("active");
                    }

                })

            </script>
        </li>
    </ul>
</div>
@endsection