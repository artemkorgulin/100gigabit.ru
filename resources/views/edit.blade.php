@extends('layouts.app')

@section('content')
     <div class="container">
          <form class="form-horizontal" method="POST" action='/update/{{$article->id}}'>
                <label class="control-label">�������� ������</label>
                <input type="text" class="form-control"  name="title" value="{{$article->title}}">
                <label class="control-label">������</label>
                <textarea name="content" class="form-control" >{{$article->content}}</textarea>
                      <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input class="btn btn-primary" type="submit" value="��������">
           </form>
       </div>
@endsection