@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
@endpush

@section('content')<br>
     <div class="container left">
          <form class="form-horizontal" method="POST" action='/updatestatus/{{$user->id}}'>
                <label class="control-label">Название статуса</label>
                <input type="text" class="form-control"  name="name" value="{{$user->name}}">
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input class="btn btn-primary" type="submit" value="Отредактировать"><a href="/statuses/">
                          <button class="btn waves-effect waves-light" type="button" name="action">в список
                              <i class="material-icons right">send</i>
                          </button>
                      </a>
           </form>
       </div>
<script type="text/javascript">


    $(document).ready(function($) {

        if(!$("a.statuses").hasClass("active")) {
            $("a.statuses").addClass("active");
        }

    })

</script>
@endsection