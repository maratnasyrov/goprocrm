@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-4 tender-number-head">
            Номер извещения
        </div>
        <div class="col-2 tender-courier-info">
            Курьер
        </div>
        <div class="col-2 tender-customer-info">
            Заказчик
        </div>
        <div class="col-2 tender-manager-info">
            Менеджер
        </div>
    </div>
    <div class="row tender-part tender-show">
        <div class="col-4 tender-number">
            {{ $tender->number }}
        </div>
        <div class="col-2 courier-info">
            {{ $tender->courier() }}
        </div>
        @if (isset($tender->customer_id))
            <div class="col-2 customer-info">
                <button id="show-customer-info-btn" type="button" name="button" class="btn btn-info">{{ $tender->customer() }}</button>
            </div>
        @else
            <div id="add-customers" class="col-1">
                <button id="add-customers-p" type="button" class="btn btn-info far fa-list-alt" data-toggle="popover" title="Добавить заказчика" data-content="" data-container="#add-customers" data-placement="bottom" style="float: right;"></button>
            </div>
            <div id="new-customer" class="col-1">
                <button id="new-customer-p" type="button" class="btn btn-success far fa-plus-square" data-toggle="popover" title="Новый заказчик" data-content="" data-container="#new-customer" data-placement="bottom"></button>
            </div>
        @endif
        <div class="col-2 manager-info">
            {{ $tender->manager() }}
        </div>
        <div class="col-2">
            <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('tender.destroy', $tender)}}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger far fa-trash-alt" style="float: right;"></button>
            </form>

            <a href="{{ route('tender.edit', $tender) }}" class="btn btn-secondary fas fa-edit edit" style="float: right;"></a>
        </div>
    </div>

    @if ($customer != null)
        <div id="show-customer-info" hidden>
            @include('customers._show_customers_info')
        </div>
    @endif
</div>

<div id="add-customers-label" class="container" style="display: none">
    @include('tenders._select_customers_form')
</div>

<div id="new-customer-label" class="container" style="display: none">
    @include('customers._form')
</div>

@endsection
