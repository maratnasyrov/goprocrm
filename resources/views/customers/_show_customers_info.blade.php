<div class="row">
    <div class="col-11 align-self-center customer-info-head">
        Информация о заказчике
    </div>
    <div class="col-1">
        <button id="close-customer-info" type="button" name="button" class="btn btn-light far fa-times-circle" style="float: right;"></button>
    </div>
</div>
<div class="customer-info-label">
    @for ($i = 0; $i < count($customer->getData()); $i++)
        <div class="info-part row">
            <div class="reg-data-name col-6">
                {{ $customer->reg_data_names[$i] }}
            </div>
            <div class="reg-data col-6">
                {{ $customer->getData()[$i] }}
            </div>
        </div>
    @endfor
</div>
