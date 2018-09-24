<tr id="merch-{{ $merchandise->id }}">
    <td></td>
    <td class="no-change" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $merchandise->name }}</td>

    @include('merchandises._merch_td', ["elem" => "delivery_tracker", "table" => "delivery", "style" => "width:7rem;;", "style_form" => ""])
    @include('merchandises._merch_td_with_select', ["elem" => "delivery_company", "included_array" => $delivery_companies, "table" => "delivery", "style" => "width:7rem;;", "style_form" => ""])

    <td id="merch-order-provider-{{ $merchandise->id }}">
        <div class="input-group merch-link-tbl" style="width: 5.2rem;">
            <button type="button" name="button" class="btn btn-light fas fa-edit" style="border: none; font-size: 1rem;" onclick="showEditLabel({{$merchandise->id}}, 'order-provider-')"></button>
            <a href="{{ $merchandise->order_provider }}" target="_blank" class="btn btn-light far fa-arrow-alt-circle-right" style="border: none; font-size: 1rem;"></a>
        </div>
    </td>

    <td id="merch-delivery-date-form-{{ $merchandise->id }}" style="width:100%;" hidden>
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div class="input-group">
                <input name="delivery_date" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old('delivery_date', $merchandise->delivery_date) }}" required>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <input name="target" type="text"  value="delivery" required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>

    @include('merchandises._merch_td_with_select', ["elem" => "delivery_place", "included_array" => $merch_delivery_places, "table" => "delivery", "style" => "width:10rem;", "style_form" => ""])
    @include('merchandises._merch_td_with_select', ["elem" => "delivery_status", "included_array" => $order_delivery_statuses, "table" => "delivery", "style" => "width:10rem;", "style_form" => ""])
    @include('merchandises._merch_td', ["elem" => "delivery_payment", "table" => "delivery", "style" => "width:7rem;;", "style_form" => ""])
    @include('merchandises._merch_td', ["elem" => "delivery_comment", "table" => "delivery", "style" => "width:7rem;;", "style_form" => ""])
</tr>
