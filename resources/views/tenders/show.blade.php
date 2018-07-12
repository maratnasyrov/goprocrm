@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container">
        <div class="row tender-part">
            <div class="col-7 tender-number">
                {{$tender->number}}
            </div>
            <div id="customer" class="col-2">
                <button id="new-customer-p" type="button" class="btn btn-primary" data-toggle="popover" title="Новый заказчик" data-content="" data-container="#customer" data-placement="bottom">Добавить заказчика</button>
            </div>
            <div class="col-2 tender-manager">
                {{$tender->manager()}}
            </div>
            <div class="col-1">
                <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('tender.destroy', $tender)}}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger" style="float: right;">X</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="new-customer-label" class="container" style="display: none">
    @include('customers._form')
</div>

@endsection
