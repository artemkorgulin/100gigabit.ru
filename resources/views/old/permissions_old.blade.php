@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
@endpush

@section('content')
<br>
<div class="container left full-width">

    {{ $permissions->links() }}
    <ul class="collection with-header">
        <li class="collection-header"><h4>Права</h4></li>



        <li class="collection-item">
            <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Сортировать</a>

            <!-- Dropdown Structure -->
            <ul id='dropdown1' class='dropdown-content'>
                <li><a href="?orderby=id">Id</a></li>
                <li><a href="?orderby=parent">parent</a></li>
                <li class="divider"></li>
                <li><a href="/users?orderby=display_name">display_name</a></li>
            </ul>

            &nbsp;&nbsp;&nbsp;&nbsp;
            <a class='dropdown-button btn' href='#' data-activates='dropdown2'>Направление сортировки</a>

            <!-- Dropdown Structure -->
            <ul id='dropdown2' class='dropdown-content'>
                <li><a href="<?=$_SERVER["REQUEST_URI"]?>&sort=desc">desc</a></li>
                <li><a href="<?=$_SERVER["REQUEST_URI"]?>&sort=asc">asc</a></li>
            </ul>

            <script type="text/javascript">
                $('input.autocomplete').autocomplete({
                    data: {
                        "Apple": null,
                        "Microsoft": null,
                        "Google": 'http://placehold.it/250x250'
                    },
                    limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
                });
            </script>
        </li>
          @foreach($permissions as $user)
                <li class="collection-item">
                    <div class="row">
                        <div class="col s12 m6 l3"><a href="/permissions/show/{{$user->id}}">({{$user->id}})</a></div>
                        <div class="col s12 m6 l3"><a href="/permissions/show/{{$user->id}}">{{$user->parent}}</a></div>
                        <div class="col s12 m6 l3"><a href="/permissions/show/{{$user->id}}">{{$user->display_name}}</a></div>
                        <div class="col s12 m6 l3"><a href="/permissions/show/{{$user->id}}">{{$user->description}}</a><a href="/permissions/delete/({{$user->id}})/"><i class="material-icons">delete</i></a></div>
                    </div>
                </li>
          @endforeach
     </ul>
    <div class="row">
        <div class="left">
    {{ $permissions->links() }}
        </div>

    @can('create') <!-- РТПЧЕТСЕН РТБЧБ -->
        <div class="right"><br><a href="/permissions/create">Добавить право</a></div>
    @endcan
    </div>



</div>
@endsection