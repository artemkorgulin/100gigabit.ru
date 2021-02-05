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
<div class="container left">
     <h1>ID:{{$user->id}}</h1>
     <b>Название статуса:</b>&nbsp;{{$user->name}}<br>
    <b>Дата создания:</b>&nbsp;{{$user->created_at}}<br>
    <a href="/statuses/deletestatus/{{$user->id}}/"><br><br>
    <button class="btn waves-effect waves-light" type="submit" name="action">Удалить статус
        <i class="material-icons right">send</i>
    </button>
    </a>
    <a href="/statuses/editstatus/{{$user->id}}/">
        <button class="btn waves-effect waves-light" type="submit" name="action">Редактировать статус
            <i class="material-icons right">send</i>
        </button>
    </a>
</div>
<script type="text/javascript">


    $(document).ready(function($) {

        if(!$("a.statuses").hasClass("active")) {
            $("a.statuses").addClass("active");
        }

    })

</script>
@endsection