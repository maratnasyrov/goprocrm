<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-main-tab" data-toggle="tab" href="#nav-main" role="tab" aria-controls="nav-main" aria-selected="true">Основное</a>
        <a class="nav-item nav-link" id="nav-order-tab" data-toggle="tab" href="#nav-order" role="tab" aria-controls="nav-order" aria-selected="false">Заказ</a>
        <a class="nav-item nav-link" id="nav-delivery-tab" data-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">Доставка</a>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
        <table id="merchandises" class="table table-bordered">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th>Кол-тво</th>
                    <th>Сумма</th>
                    <th>Цена заявки</th>
                    <th>Сумма заявки</th>
                    <th>Ссылка</th>
                </tr>
            </thead>

          <tbody id="merch-table-main">
              @foreach ($tender->merchandises as $merchandise)
                  @include('merchandises._merch_main_tr')
              @endforeach
          </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
      <table id="merchandises" class="table table-bordered">
          <thead>
              <tr>
                  <th>№</th>
                  <th>Наименование</th>
                  <th>Номер заказа</th>
                  <th>Поставщик</th>
                  <th>Статус заявки</th>
                  <th>Тип оплаты</th>
                  <th>Статус оплаты</th>
                  <th>Комментарий</th>
              </tr>
          </thead>

          <tbody>
              @foreach ($tender->merchandises as $merchandise)
                  @include('merchandises._merch_order_tr', [
                      "merch_order_statuses" => [
                          "",
                          "Уточнить наличие",
                          "Сделать заказ",
                          "Жду подтверждения",
                          "Заказ оформлен"
                      ],

                      "order_payment_types" => [
                          "",
                          "Карта",
                          "Наличные",
                          "Оплата по счету"
                      ],

                      "order_payment_statuses" => [
                          "",
                          "Перевести Леше",
                          "Деньги у Леши",
                          "Оплатить картой",
                          "Оплачено картой",
                          "Запросить счет",
                          "Оплатить счет",
                          "Счет оплачен"
                      ]
                  ])
              @endforeach
          </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th>Трекер</th>
                    <th>ТК</th>
                    <th>Дата доставки</th>
                    <th>Статус доставки</th>
                    <th>Место доставки</th>
                    <th>Оплата доставки</th>
                    <th>Комментарий</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tender->merchandises as $merchandise)
                  <tr>
                      <th></th>
                      <th>{{ $merchandise->name }}</th>
                      <th>{{ $merchandise->delivery_tracker }}</th>
                      <th>{{ $merchandise->delivery_company }}</th>
                      <th>{{ $merchandise->delivery_date }}</th>
                      <th>{{ $merchandise->delivery_status }}</th>
                      <th>{{ $merchandise->delivery_place }}</th>
                      <th>{{ $merchandise->delivery_payment }}</th>
                      <th>{{ $merchandise->delivery_comment }}</th>
                  </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
