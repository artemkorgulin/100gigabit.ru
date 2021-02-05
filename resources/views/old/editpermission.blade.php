@extends('layouts.app')

@section('content')<br>
     <div class="container left">
          <form class="form-horizontal" method="POST" action='/update/{{$user->id}}'>
                <label class="control-label">Название роли</label>
                <input type="text" class="form-control"  name="title" value="{{$user->name}}">
                <label class="control-label">Показываемое имя</label>
              <input type="text" class="form-control"  name="title" value="{{$user->display_name}}">
              <label class="control-label">Описание</label>
              <textarea name="content" class="form-control" >{{$user->description}}</textarea>

                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input class="btn btn-primary" type="submit" value="Отредактировать"><a href="/permissions/">
                  <button class="btn waves-effect waves-light" type="button" name="action">в список
                      <i class="material-icons right">send</i>
                  </button>
              </a>
           </form>

       </div>
@endsection