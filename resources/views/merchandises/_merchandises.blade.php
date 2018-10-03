<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link {{ $t1 }}" id="nav-main-tab" data-toggle="tab" href="#nav-main" role="tab" aria-controls="nav-main" aria-selected="true">Обработка</a>
        @if ($tender_helper->check_win_status() == true)
            <a class="nav-item nav-link {{ $t2 }}" id="nav-order-tab" data-toggle="tab" href="#nav-order" role="tab" aria-controls="nav-order" aria-selected="false">Закупка</a>
            <a class="nav-item nav-link {{ $t3 }}" id="nav-delivery-tab" data-toggle="tab" href="#nav-delivery" role="tab" aria-controls="nav-delivery" aria-selected="false">Доставка</a>
        @endif
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade {{ ($t1 == "active") ? 'show' : '' }} {{ $t1 }}" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
        <table id="merchandises" class="table table-bordered">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th>Наличие</th>
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
                  @include('merchandises._merch_main_tr', [
                      "availabilities" => [
                          "В наличии",
                          "Нет в наличии"
                      ]
                  ])
              @endforeach
          </tbody>
        </table>
    </div>
    @if ($tender_helper->check_win_status() == true)
        <div class="tab-pane fade {{ ($t2 == "active") ? 'show' : '' }} {{ $t2 }}" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab">
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
                              "Уточнить наличие",
                              "Сделать заказ",
                              "Жду подтверждения",
                              "Заказ оформлен"
                          ],

                          "order_payment_types" => [
                              "Карта",
                              "Наличные",
                              "Оплата по счету"
                          ],

                          "order_payment_statuses" => [
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
        <div class="tab-pane fade {{ ($t3 == "active") ? 'show' : '' }} {{ $t3 }}" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">
            <table id="merchandises" class="table table-bordered">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Трекер</th>
                        <th>ТК</th>
                        <th>Дата доставки</th>
                        <th>Место доставки</th>
                        <th>Статус доставки</th>
                        <th>Стоимость доставки</th>
                        <th>Комментарий</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tender->merchandises as $merchandise)
                        @include('merchandises._merch_delivery_tr', [
                            "merch_delivery_places" => [
                                "Склад",
                                "Алексей дом",
                                "Натан дом",
                                "Заказчик"
                            ],

                            "delivery_companies" => [
                                "Поставщик",
                                "СДЭК",
                                "Boxberry",
                                "ПЭК",
                                "Деловые Л."
                            ],

                            "order_delivery_statuses" => [
                                "На складе",
                                "У Алексея дома",
                                "У Натана дома",
                                "У заказчика"
                            ]
                        ])
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
