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
