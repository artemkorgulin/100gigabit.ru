@extends('layouts.app')


@push('styles')
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
<link rel="stylesheet" href="/js/tablesorter/css/jquery.tablesorter.pager.css">
<link rel="stylesheet" href="css/jstree/dist/themes/default/style.min.css" />
<link rel="stylesheet" href="/js/tablesorter/css/theme.materialize.css">
@endpush
@push('scripts')

{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js"></script>--}}
{{--<script
        src="http://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>--}}
<script type="text/javascript" src="/js/tablesorter/js/jquery-latest.min.js"></script>

<script type="text/javascript" src="/js/tablesorter/js/materialize.min.js"></script>
<script type="text/javascript" src="/js/tablesorter/js/jquery.tablesorter.js"></script>
<script type="text/javascript" src="/js/tablesorter/js/widget-filter.js"></script>
<script type="text/javascript" src="/js/tablesorter/js/jquery.tablesorter.pager.js"></script>
<script type="text/javascript" src="js/jstree/dist/jstree.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="{{asset("js/functions.js")}}"></script>
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <br>
    <div class="container left">
        {{ csrf_field() }}

        {{--<div class="row">
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
        </div>
        <div class="container left">
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img height=100 src="{{explode(';',$item->preview)[0]}}" alt="">     <!-- первая картинка в поле preview в базе -->
                            <div class="caption">
                                <h3>{{$item->title}}</h3>
                                <p>Цена:<span class="price">{{$item->price}}</span> руб.</p>
                                <p><a href="#" class="btn btn-primary buy-btn" id="{{$item->id}}" role="button">Купить</a> <a href="/show/{{$item->id}}" class="btn btn-default" role="button">Подробнее</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>--}}




        {{ csrf_field() }}

        <ul class="collection with-header">
            <li class="collection-header">
                <div class="row">
                    <div class="col">
                        <h4>Товары</h4>
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

                            .basket-count>span {
                                font-size:1.5em;
                            }
                        </style>
                        <a class="right basket-count" href="/goods/basket">В корзине: <span class="glyphicon glyphicon-shopping-cart basket"></span><span class="count_order">0</span></a>
                    </div>
                </div>
            </li>
            <li >
                <table class="items"> <!-- add materialize classes, as desired -->
                    <thead>
                    <tr class="collection-item">
                        <th>Идентификатор</th>
                        <th>Картинка</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Когда создано</th>
                        <th>Операции</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <!-- include "tablesorter-ignoreRow" class for pager rows in thead -->
                    <tr class="tablesorter-ignoreRow collection-item">
                        <th colspan="7" class="ts-pager form-horizontal">
                            <button type="button" class="btn first"><i class="small material-icons">first_page</i></button>
                            <button type="button" class="btn prev"><i class="small material-icons">navigate_before</i></button>
                            <span class="pagedisplay"></span>
                            <!-- this can be any element, including an input -->
                            <button type="button" class="btn next"><i class="small material-icons">navigate_next</i></button>
                            <button type="button" class="btn last"><i class="small material-icons">last_page</i></button>
                            <select class="pagesize browser-default" title="Select page size">
                                <option selected="selected" value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                            </select>
                            <select class="pagenum browser-default" title="Select page number"></select>
                        @can('create') <!-- РТПЧЕТСЕН РТБЧБ -->
                            <style>
                                .add-user-button {
                                    padding-top:15px;
                                    padding-right: 15px;
                                }
                            </style>
                            <div class="row right valign-wrapper add-user-button"><a class="col s12 m12 left-align" href="/goods/additem">Добавить товар</a></div>
                            @endcan
                        </th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="collection-item" id="{{$item->id}}">
                            <td><div class="col s12 m6 l1 title"><a href="/goods/show/{{$item->id}}">({{$item->id}})</a></div></td>
                            <td><div class="col s12 m6 l3 thumbnail"><a href="/goods/show/{{$item->id}}"><img height=100 src="{{explode(';',$item->preview)[0]}}" alt=""> </a></div></td>
                            <td><div class="col s12 m6 l3"><a href="/goods/show/{{$item->id}}">{{$item->name}}</a></div></td>
                            <td><div class="col s12 m6 l3"><a href="/goods/show/{{$item->id}}"><span class="price">{{$item->price}}</span> руб.</a></div></td>
                            <td><div class="col s12 m6 l3"><a href="/goods/show/{{$item->id}}">{{$item->created_at}}</a></div></td>
                            <td><div class="col s12 m6 l2">
                                    <a href="/goods/deleteitem/{{$item->id}}/"><i class="material-icons">delete</i></a>
                                    <a href="#" class="btn btn-primary buy-btn" id="{{$item->id}}" role="button">Купить</a><br><br>
                                    <a href="/goods/edit/{{$item->id}}/"><button class="btn btn-primary btn-lg">Редактировать</button></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </li>
        </ul>


        <script type="text/javascript">


            $(document).ready(function($) {


                if(!$("a.goods").hasClass("active")) {
                    $("a.goods").addClass("active");
                }

                $("table.items").tablesorter({
                    theme : "materialize",

                    widthFixed: true,
                    // widget code contained in the jquery.tablesorter.widgets.js file
                    // use the zebra stripe widget if you plan on hiding any rows (filter widget)
                    widgets : [ "filter", "zebra" ],

                    widgetOptions : {
                        // using the default zebra striping class name, so it actually isn't included in the theme variable above
                        // this is ONLY needed for materialize theming if you are using the filter widget, because rows are hidden
                        zebra : ["even", "odd"],

                        // reset filters button
                        filter_reset : ".reset",

                        // extra css class name (string or array) added to the filter element (input or select)
                        // select needs a "browser-default" class or it gets hidden
                        filter_cssFilter: ["", "", "browser-default"]
                    }
                })
                    .tablesorterPager({

                        // target the pager markup - see the HTML block below
                        container: $("table.items .ts-pager"),

                        // target the pager page select dropdown - choose a page
                        cssGoto  : ".pagenum",

                        // remove rows from the table to speed up the sort of large tables.
                        // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
                        removeRows: false,

                        // output string - default is '{page}/{totalPages}';
                        // possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
                        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

                    });
            })

        </script>

        
    </div>
@endsection