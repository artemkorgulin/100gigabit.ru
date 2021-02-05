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
<div class="container left">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Добавить сервис:</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registeradditional/') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('additional_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Название сервиса</label>

                            <div class="col-md-6">
                                <input id="additional_name" type="text" class="form-control" name="additional_name" value="{{ old('additional_name') }}" required autofocus>

                                @if ($errors->has('additional_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('additional_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('additional_price') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Цена</label>

                            <div class="col-md-6">
                                <input id="additional_price" type="text" class="form-control" name="additional_price" value="{{ old('additional_price') }}" required>

                                @if ($errors->has('additional_price'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('additional_price') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Добавить сервис
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    $(document).ready(function($) {

        if(!$("a.additional").hasClass("active")) {
            $("a.additional").addClass("active");
        }

    })

</script>
@endsection