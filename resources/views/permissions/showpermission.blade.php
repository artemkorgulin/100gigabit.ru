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
<script type="text/javascript">


    $(document).ready(function($) {

        if(!$("a.permissions").hasClass("active")) {
            $("a.permissions").addClass("active");
        }

    })

</script>
@endsection