@extends('layouts.app')

@section('content')
</di class="container left">
     <h1>ID:{{$user->id}}</h1>
     <b>ID родителя:</b>&nbsp;{{$user->parent}}<br>
     <b>Имя на латинице:</b>&nbsp;{{$user->name}}<br>
     <b>Показываемое имя:</b>&nbsp;{{$user->display_name}}<br>
     <b>Описание:</b>&nbsp;{{$user->description}}<br><br>
    <a href="/permissions/delete/{{$user->id}}/">
    <button class="btn waves-effect waves-light" type="submit" name="action">Удалить право
        <i class="material-icons right">send</i>
    </button>
    </a>
   <a href="/permissions/edit/{{$user->id}}/">
    <button class="btn waves-effect waves-light" type="submit" name="action">Редактировать право
        <i class="material-icons right">send</i>
    </button>
    </a>
</div>
@endsection