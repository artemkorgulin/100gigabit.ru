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
                <div class="panel-heading">Добавить услугу:</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/registerservice/') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('services_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Название услуги</label>

                            <div class="col-md-6">
                                <input id="services_name" type="text" class="form-control" name="services_name" value="{{ old('services_name') }}" required autofocus>

                                @if ($errors->has('services_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('services_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('services_price') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Цена услуги</label>

                            <div class="col-md-6">
                                <input id="services_price" type="email" class="form-control" name="services_price" value="{{ old('services_price') }}" required>

                                @if ($errors->has('services_price'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('services_price') }}</strong>
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

        if(!$("a.services").hasClass("active")) {
            $("a.services").addClass("active");
        }
    })

</script>
@endsection