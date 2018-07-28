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
    <div class="tender-part tender-show border border-white">
        <div class="row">
            <div class="col-4 align-self-center tender-number" style="text-align: center;">
                {{ $tender->number }}
            </div>
            <div class="col-2 align-self-center courier-info">
                {{ $tender->courier() }}
            </div>
            @if (isset($tender->customer_id))
                <div class="col-2 align-self-center customer-info">
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#customerInfo" aria-expanded="false" aria-controls="customerInfo">
                      {{ $tender->customer() }}
                    </button>
                </div>
            @else
                <div id="add-customers" class="col-1">
                    <button id="add-customers-p" type="button" class="btn btn-info far fa-list-alt" data-toggle="popover" title="Добавить заказчика" data-content="" data-container="#add-customers" data-placement="bottom" style="float: right;"></button>
                </div>
                <div id="new-customer" class="col-1">
                    <button id="new-customer-p" type="button" class="btn btn-success far fa-plus-square" data-toggle="popover" title="Новый заказчик" data-content="" data-container="#new-customer" data-placement="bottom"></button>
                </div>
            @endif
            <div class="col-2 align-self-center manager-info">
                {{ $tender->manager() }}
            </div>
            <div class="col-2 align-self-center">
                <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('tender.destroy', $tender)}}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger far fa-trash-alt" style="float: right;"></button>
                </form>

                <a href="{{ route('tender.edit', $tender) }}" class="btn btn-secondary fas fa-edit edit" style="float: right;"></a>
            </div>
        </div>
    </div>

    @if ($customer != null)
        <div class="collapse" id="customerInfo">
          <div class="card card-body customer-info-label">
            @include('customers._show_customers_info')
          </div>
        </div>
    @endif

    <div class="merchandises-table border border-white">
        <h5>Товары</h5>
        @include('merchandises._merchandises')

        <div class="row">
            <div class="merchandise-form col-7">
                <h5>Информация по закупке</h5>
                    <table class="table col-6 table-sm">
                        <tbody>
                            <tr>
                                <th>МЦК</th>
                                <td>{{ $tender->contract_price }}</td>
                                <th>Прибыль</th>
                                <td>{{ $tender->all_total_payment($tender->merchandises) - $tender->purchase_price($tender->merchandises)}}</td>
                            </tr>
                            <tr>
                                <th>Закупочная</th>
                                <td>{{ $tender->purchase_price($tender->merchandises) }}</td>
                                <th>Снижение</th>
                                <td>{{ $tender->difference($tender->merchandises) . "%" }}</td>
                            </tr>
                            <tr>
                                <th>Разница</th>
                                <td>{{ $tender->contract_price - $tender->purchase_price($tender->merchandises) }}</td>
                                <th>Супер %</th>
                                <td>{{ $tender->super_procent($tender->merchandises) . "%"}}</td>
                            </tr>
                            <tr>
                                <th>Заявка</th>
                                <td>{{ $tender->all_total_payment($tender->merchandises) }}</td>
                                <th> Статус </td>
                                <td class="{{ $tender->supple_status($tender->merchandises)[1] }}">{{ $tender->supple_status($tender->merchandises)[0] }}</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="merchandise-form col-5">
                <h5>Добавить новый товар в таблицу</h5>
                @include('merchandises._form')
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
