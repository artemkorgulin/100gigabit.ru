@extends('layouts.app')

@section('content')
<div class="container left">
     <h1>ID:{{$user->id}}</h1>
     <b>Login:</b>&nbsp;{{$user->name}}<br>
    <b>EMail:</b>&nbsp;{{$user->email}}<br>
    <b>Дата создания:</b>&nbsp;{{$user->created_at}}<br>
    @if ($userpermissions)
    <b>ID Группы пользователя:</b><a href="/permissions/show/{{$userpermissions[0]["id"]}}/">{{$userpermissions[0]["id"]}}</a><br><br>
    @else
        <br>
    @endif
    <a href="/deleteuser/{{$user->id}}/">
    <button class="btn waves-effect waves-light" type="submit" name="action">Удалить пользователя
        <i class="material-icons right">send</i>
    </button>
    </a>
    <a href="/edituser/{{$user->id}}/">
        <button class="btn waves-effect waves-light" type="submit" name="action">Редактировать пользователя
            <i class="material-icons right">send</i>
        </button>
    </a>
</div>
<script type="text/javascript">

    $(document).ready(function($) {

        if(!$("a.services").hasClass("active")) {
            $("a.services").addClass("active");
        }
    })

</script>
@endsection