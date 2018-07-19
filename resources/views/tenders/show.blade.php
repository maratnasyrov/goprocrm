@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container">
        <div class="row tender-part">
            <div class="col-4 tender-number">
                {{$tender->number}}
            </div>
            <div class="col-2 courier-info">
                {{$tender->courier()}}
            </div>
            @if (isset($tender->customer_id))
                <div class="col-2 customer-info">
                    {{$tender->customer_id}}
                </div>
            @else
                {{-- <div id="add-customers" class="col-1">
                    <button id="add-customers-p" type="button" class="btn btn-primary btn-light add-customers" data-toggle="popover" title="Добавить заказчика" data-content="" data-container="#add-customers" data-placement="bottom">Добавить</button>
                </div>
                <div id="new-customer" class="col-1">
                    <button id="new-customer-p" type="button" class="btn btn-primary btn-light new-customer" data-toggle="popover" title="Новый заказчик" data-content="" data-container="#new-customer" data-placement="bottom">Новый</button>
                </div> --}}
            @endif
            <div class="col-2 tender-manager-info">
                {{$tender->manager()}}
            </div>
            <div class="col-1">
                <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('tender.destroy', $tender)}}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger" style="float: right;">X</button>
                </form>
            </div>
            <div class="col-1">
                <a href="{{route('tender.edit', $tender)}}">Ред.</a>
            </div>
        </div>
    </div>
</div>

<div id="add-customers-label" class="container" style="display: none">
    @include('tenders._select_customers_form')
</div>

<div id="new-customer-label" class="container" style="display: none">
    @include('customers._form')
</div>

@endsection
