@extends('layouts.app')

@section('content')
<br>
<div class="container left">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Домашняя страница</div>

                <div class="panel-body">
                    Вы авторизовались как <b>{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
