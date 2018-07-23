<h5>Информация о заказчике</h5>

<div class="row">
    <div class="col-6">
        @for ($i = 0; $i < count($customer->getData())/2; $i++)
            <div class="info-part">
                <div class="reg-data-name">
                    {{ $customer->reg_data_names[$i] }}
                </div>
                <div class="reg-data">
                    {{ $customer->getData()[$i] }}
                </div>
            </div>
        @endfor
    </div>
    <div class="col-6">
        @for ($i = count($customer->getData())/2 + 1; $i < count($customer->getData()); $i++)
            <div class="info-part">
                <div class="reg-data-name">
                    {{ $customer->reg_data_names[$i] }}
                </div>
                <div class="reg-data">
                    {{ $customer->getData()[$i] }}
                </div>
            </div>
        @endfor
    </div>
</div>
