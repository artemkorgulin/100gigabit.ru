@extends('layouts.app')

@push('styles')
@endpush
@push('scripts')

<script type="text/javascript" src="/js/tablesorter/js/jquery-latest.min.js"></script>
<script src="{{asset("js/functions.js")}}"></script>
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
@endpush


@section('content')
    <div class="container left">

        {{ csrf_field() }}
        <ul class="collection with-header">
            <li class="collection-header">
                <div class="row">
                    <div class="col">
                        <h4>Редактировать товар: {{$item->name}} </h4>
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
                    
                        <hr>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                @foreach($images as $image)
                                    <img width=100 src="{{$image}}">
                                @endforeach
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="file" name="preview[]"/><br>
                                </div>
                                <div class="col-md-8">
                                    <i class="glyphicon glyphicon-arrow-left"></i> Выберите миниатюру для товара. <p class="help-block">Размер изображения 150x150px, не более 200Кб</p>
                                </div>
                            </div>
                            <hr>
                            <h3>Дополнительные изображения</h3><button class="btn btn-primary add_images" type="button"><i class="glyphicon glyphicon-plus">+</i></button>
                            <hr>
                            @if(!empty($images)) <!-- проверяем если картинки -->
                            @foreach($images as $image)
                                <div class="img-thumbnail">
                                    <img width=100 src="{{$image}}">
                                    <button type="button" title="Удалить" class="btn btn-danger del_image btn-xs"><i class="glyphicon glyphicon-minus">-</i></button>
                                </div>
                            @endforeach
                            @endif
                            <hr>
                            <div class="row">
                                <div class="col-md-8">
                                    <label class="control-label" for="name">Название товара</label>
                                    <input class="form-control" type="text" name="name" value="{{$item->name}}"/>
                                    <label for="description" class="control-label">Описание товара</label>
                                    <textarea class="form-control" rows="4" name="description">{{$item->description}}</textarea>
                                    <label class="control-label" for="price">Цена</label>
                                    <input class="form-control" type="text" name="price" value="{{$item->price}}"/>
                                </div>
                            </div>
                            <h3>Параметры товара</h3>
                            <hr>
                            <button class="btn btn-primary btn-lg add_button" type="button">Добавить</button>
                            @foreach($parameters as $param)
                                <script src="/js/tablesorter/js/materialize.min.js"></script>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label for="parameter" class="sr-only">Параметр</label>
                                        <div class="input-group">
                                             <span class="input-group-btn">
                                                 <a href="#MyModal" class="modal-trigger"><a class="btn btn-default add_parameter" type="button"><button class="btn btn-default  add_parameter" type="button"><i class="glyphicon glyphicon-plus">+</i></button></a>
                                             </span>
                                            <style>
                                                .form-group .browser-default {
                                                    width: 200px;
                                                }
                                            </style>
                                            <select class="form-control browser-default left" name="parameter[]">
                                                @foreach($parameters_all as $parameter)
                                                    @if($param->id==$parameter->id)
                                                        <option value="{{$parameter->id}}" selected>{{$parameter->title}} ({{$parameter->unit}})</option>
                                                    @else
                                                        <option value="{{$parameter->id}}">{{$parameter->title}} ({{$parameter->unit}})</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group left">
                                            <input class="form-control" name="value[]" value="{{$param->value}}"/>
                                        </div>
                                        <div class="form-group left">
                                             <span class="input-group-btn">
                                                <button class="btn btn-default remove_button" type="button"><i class="glyphicon glyphicon-minus">-</i></button>
                                             </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <button type="submit" class="btn btn-default btn-lg save_item">Сохранить товар</button>
                            <input type="hidden" id="item_id" value="{{$item->id}}"/>
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