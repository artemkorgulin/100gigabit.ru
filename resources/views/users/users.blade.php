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
@endpush

@section('content')

<br>
<div class="container left full-width">
    {{ csrf_field() }}
    {{--{{ $users->links() }}--}}



    <ul class="collection with-header">
        <li class="collection-header"><h4>Пользователи</h4></li>
        <li >
        <table class="users"> <!-- add materialize classes, as desired -->
            <thead>
                <tr class="collection-item">
                    <th>Идентификатор</th>
                    <th>Имя</th>
                    <th class="filter-select filter-exact" data-placeholder="Укажите email">E-mail</th>
                    <th>Когда создано</th>
                    <th>Операции</th>
                    <th>Права</th>
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
                        <div class="row right valign-wrapper add-user-button"><a class="col s12 m12 left-align" href="/users/create">Добавить пользователя</a></div>
                    @endcan
                </th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($users as $user)
                <tr class="collection-item">
                    <td><div class="col s12 m6 l1"><a href="/showuser/{{$user->id}}">({{$user->id}})</a></div></td>
                    <td><div class="col s12 m6 l3"><a href="/showuser/{{$user->id}}">{{$user->name}}</a></div></td>
                    <td><div class="col s12 m6 l3"><a href="/showuser/{{$user->id}}">{{$user->email}}</a></div></td>
                    <td><div class="col s12 m6 l3"><a href="/showuser/{{$user->id}}">{{$user->created_at}}</a></div></td>
                    <td><div class="col s12 m6 l2"><a href="/deleteuser/{{$user->id}}/"><i class="material-icons">delete</i></a></div></td>
                    <td><div class="permissions" id="{{$user->id}}" data-id="{{$user->id}}"></div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </li>
    </ul>


    <script type="text/javascript">


        function updatePermissions(id, li) {
            var items = [];
            /* Формирует массив прав к отправке */
            for (var i = 0; i < li.length; i++) {
                items.push(parseInt(li[i].id));
            }

            if (items.length) {
                $.ajax({
                    type: 'post',
                    url: '{{ url('permissions/set') }}',
                    data: {
                        user: id,
                        data: items
                    },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                    }
                });
            }
        }

        $(document).ready(function($) {

            if(!$("a.users").hasClass("active")) {
                $("a.users").addClass("active");
            }

            //console.log($.jstree);
            /**
             * Получение прав пользователя, проходит по всем элементам с классом permissions
             **/
            $('.permissions').each(function (ind, el) {
                var id = $(el).data('id'); // получение id пользователя
                $.post('{{ url('permissions/get') }}', {user: id, '_token': $('meta[name="csrf-token"]').attr('content') }, function (data) { // запрос на получение прав
 
                    /!* Построение дерева прав *!/
                    $('div#'+id).jstree({
                        'plugins': [
                            "wholerow",
                            "checkbox"
                        ],
                        "checkbox": {
                            "real_checkboxes": false,
                            "three_state": true
                        },
                        'core': {
                            "themes": {
                                "icons": false
                            },
                            'data': data
                        }
                    })
                        .on('deselect_node.jstree', function (e, data) {
                            updatePermissions(id, data.instance.get_selected(true));
                        })
                        .on('select_node.jstree', function (e, data) {
                            updatePermissions(id, data.instance.get_selected(true));
                        })
                        .on('ready.jstree', function () {
                            $(this).jstree("close_all");
                        });

                });
            });

            $("table.users").tablesorter({
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
                container: $("table.users .ts-pager"),

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