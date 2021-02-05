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

        <ul class="collection with-header">
            <li class="collection-header"><h4>Заказы</h4></li>
            <li >
                <table class="orders"> <!-- add materialize classes, as desired -->
                    <thead>
                    <tr class="collection-item">
                        <th>Номер заказа</th>
                        <th>Сумма заказа</th>
                        <th class="filter-select filter-exact" data-placeholder="Укажите email">Название заказа</th>
                        <th>Когда создан</th>
                        <th>Статус</th>
                        <th>Тип</th>
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
                            <div class="row right valign-wrapper add-user-button"><a class="col s12 m12 left-align" href="/goods/basket">Добавить заказ</a></div>
                            @endcan
                        </th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($orders as $order)
                        <tr class="collection-item">
                            <td><div class="col s12 m6 l1"><a href="/orders/show/{{$order->order_id}}">({{$order->order_id}})</a></div></td>
                            <td><div class="col s12 m6 l3"><a href="/orders/show/{{$order->order_id}}">{{$order->summa}}</a></div></td>
                            <td><div class="col s12 m6 l3"><a href="/orders/show/{{$order->order_id}}">{{$order->name}}</a></div></td>
                            <td><div class="col s12 m6 l3"><a href="/orders/show/{{$order->order_id}}">{{$order->user_id}}</a></div></td>
                            <td><div class="col s12 m6 l3"><a href="/orders/show/{{$order->order_id}}">{{$order->state}}</a></div></td>
                            <td><div class="col s12 m6 l3"><a href="/orders/show/{{$order->order_id}}">{{$order->type}}</a></div></td>
                            <td><div class="col s12 m6 l2"><a href="/deleteorder/{{$order->order_id}}/"><i class="material-icons">delete</i></a></div></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </li>
        </ul>


        <script type="text/javascript">

            $(document).ready(function($) {

                if(!$("a.orders").hasClass("active")) {
                    $("a.orders").addClass("active");
                }

                $("table.orders").tablesorter({
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
                        container: $("table.orders .ts-pager"),

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