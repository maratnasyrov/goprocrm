@extends('layouts.app')

@section('content')

<div class="container">
    <div class="container">
        <div class="row">
            <div class="info border border-white col-3 columns" style="text-align: center;">
                {{ $tender->number }}
            </div>
            <div class="info border border-white col-2 columns">
                {{ $tender_helper->courier() }}
            </div>
            @if (isset($tender->customer_id))
                <div class="info border border-white col-3 columns">
                    <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#customerInfo" aria-expanded="false" aria-controls="customerInfo">
                      {{ $tender_helper->customer() }}
                    </button>
                </div>
            @else
                <div class="info border border-white col-3 columns">
                    <center>
                        <nobr id="add-customers">
                            <button id="add-customers-p" type="button" class="btn btn-info far fa-list-alt" data-toggle="popover" title="Добавить заказчика" data-content="" data-container="#add-customers" data-placement="bottom"></button>
                        </nobr>
                        <nobr id="new-customer">
                            <button id="new-customer-p" type="button" class="btn btn-success far fa-plus-square" data-toggle="popover" title="Новый заказчик" data-content="" data-container="#new-customer" data-placement="bottom"></button>
                        </nobr>
                    </center>
                </div>
            @endif
            <div class="info border border-white col-2 columns">
                {{ $tender_helper->manager() }}
            </div>
            <div class="info border border-white col-2 columns">
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

    <div class="container">
        <div class="row">
            <div class="info border border-white col-4 columns">
                <h5>Оплата</h5>
                <table id="tender-info" class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="name"><b>Обработка</b></td>
                            @include('tenders._tend_td_with_select', ["elem" => "processing_payment", "included_array" => [ 'Не оплачено','Оплачено' ], "style" => "width:50%;", "style_form" => ""])
                        </tr>
                        <tr>
                            <td class="name"><b>Курьер</b></td>
                            @include('tenders._tend_td_with_select', ["elem" => "manager_payment", "included_array" => [ 'Не оплачено','Оплачено' ], "style" => "width:50%;", "style_form" => ""])
                        </tr>
                        <tr>
                            <td class="name"><b>Менеджер</b></td>
                            @include('tenders._tend_td_with_select', ["elem" => "courier_payment", "included_array" => [ 'Не оплачено','Оплачено' ], "style" => "width:50%;", "style_form" => ""])
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="info border border-white col-4 columns">
                <h5>Контракт</h5>
                <table id="tender-info" class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="name"><b>Статус</b></td>
                            @include('tenders._tend_td_with_select', ["elem" => "contract_status",
                            "included_array" => [
                                '',
                                'Запросить проект',
                                'Направить скан',
                                'Направить оригинал',
                                'Внести обеспечение 1х',
                                'Внести обеспечение 1,5х',
                                'Подписан',
                                'Исполнен'
                            ], "style" => "width:60%;", "style_form" => ""])
                        </tr>
                        <tr>
                            <td class="name"><b>Номер</b></td>
                            @include('tenders._tend_td', ['elem' => "contract_number", "style" => "width:60%;", "style_form" => ""])
                        </tr>
                        <tr>
                            <td class="name"><b>Дата</b></td>
                            @include('tenders._tend_td', ['elem' => "contract_date", "style" => "width:60%;", "style_form" => ""])
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="info border border-white col-4 columns">
                <h5>Документы и доставка</h5>
                <table id="tender-info" class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="name"><b>Документы</b></td>
                            @include('tenders._tend_td_with_select', ["elem" => "documents_status",
                            "included_array" => [
                                '',
                                'Создать в Эльбе',
                                'Направить сканы',
                                'Жду подтверждения сканов',
                                'Направить Леше',
                                'Направлены '
                            ], "style" => "width:60%;", "style_form" => ""])
                        </tr>
                        <tr>
                            <td class="name"><b>Доставка</b></td>
                            @include('tenders._tend_td_with_select', ["elem" => "delivery_status",
                            "included_array" => [
                                '',
                                'Согласовать дату',
                                'Заказать машину',
                                'Сообщить Леше',
                                'Доставлено'
                            ], "style" => "width:60%;", "style_form" => ""])
                        </tr>
                        <tr>
                            <td class="name"><b>Дедлайн</b></td>
                            @include('tenders._tend_td', ['elem' => "contract_date", "style" => "width:60%;", "style_form" => ""])
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="merchandises-table border border-white">
        <h5 style="{{$tender_helper->status_style()}}">Товары (закуплено {{ $tender_helper->purchase() }}%)</h5>
        @include('merchandises._merchandises', [$t1, $t2, $t3])

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
