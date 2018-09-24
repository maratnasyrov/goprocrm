@extends('layouts.app')

@section('content')

<div class="container">
    <button id="new-tender-p" type="button" class="btn btn-primary" data-toggle="popover" title="Новый тендер" data-content="" data-placement="bottom">Новый тендер</button>

    <div class="container">
        @forelse ($tenders as $tender)
            <div style="margin-bottom: 1.5rem;">
                <div class="row tender-part">
                    <div class="col-3">
                        <div style="padding: 0.4rem;">
                            <h5 style="font-weight: bold; color: #41484e;">Запрос котировок</h5>
                            <div class="end-date">
                                25.06.2017 / 44-ФЗ
                            </div>
                            <h5 class="h5-start-price">Начальная цена</h5>
                            <div class="start-price">
                                {{ $tender->contract_price }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h5 class="tender-number"><a href="{{route('tender.show', $tender)}}">{{"№ " . $tender->number}}</a></h5>
                        <div class="h5-customer">Заказчик:</div>
                        <div class="tender-customer">
                            {{ (new TenderHelper($tender))->customer() }}
                        </div>
                        <div class="tender-name">
                            {{ $tender->name }}
                        </div>
                    </div>
                    <div class="col-3" style="padding: 0.4rem; text-align: right;">
                        <div class="date-created">
                            <b style="color: #b4b4b4;">Добавлено:</b> {{  $tender->created_at->format('d-m-Y') }}
                        </div>
                        <div class="date-updated">
                            <b style="color: #b4b4b4;">Обновлено:</b> {{ $tender->created_at->format('d-m-Y') }}
                        </div>
                    </div>
                </div>
                <div class="row tender-part-footer">
                    <div class="col-2 tender-manager">
                        {{(new TenderHelper($tender))->manager()}}
                    </div>
                    <div class="col-2">
                        {{ $tender->purchase_price($tender->merchandises) }}
                    </div>
                </div>
            </div>
        @empty
            <div class="">
                Нет тендеров
            </div>
        @endforelse
    </div>
</div>

<div id="new-tender-label" class="container popover-customer" style="display: none">
    @include('tenders._form')
</div>

@endsection
