@extends('layouts.app')

@push('styles')
@endpush
@push('scripts')

<script type="text/javascript" src="/js/tablesorter/js/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<script src="{{asset("js/functions.js")}}"></script>
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
<div class="container left">
     <h1>ID:{{$orders->id}}</h1>
     <b>Название:</b>&nbsp;{{$orders->name}}<br>
    <b>Статус:</b>&nbsp;{{$orders->state}}<br>
    <b>Тип:</b>&nbsp;{{$orders->type}}<br>
    <b>Кто оформил:</b>&nbsp;{{$orders->usser_id}}<br>
    <b>Колличество товаров в заказе:</b>&nbsp;{{$orders->amount}}<br>
    <b>Сумма:</b>&nbsp;{{$orders->price}}<br>
    <b>Адресс:</b>&nbsp;{{$orders->address}}<br>
    <b>Телефон:</b>&nbsp;{{$orders->phone}}<br>
    <b>Дата создания:</b>&nbsp;{{$orders->created_at}}<br>
    <b>Дата обновления:</b>&nbsp;{{$orders->updated_at}}<br>
</div>
<script type="text/javascript">


    $(document).ready(function($) {

        if(!$("a.orders").hasClass("active")) {
            $("a.orders").addClass("active");
        }

    })

</script>
@endsection