<tr id="merch-{{ $merchandise->id }}">
    <td></td>
    <td class="no-change" style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $merchandise->name }}</td>

    @include('merchandises._merch_td', ["elem" => "order_number", "table" => "order", "style" => "width:7rem;;", "style_form" => ""])

    <td id="merch-order-provider-{{ $merchandise->id }}">
        <div class="input-group merch-link-tbl" style="width: 5.2rem;">
            <button type="button" name="button" class="btn btn-light fas fa-edit" style="border: none; font-size: 1rem;" onclick="showEditLabel({{$merchandise->id}}, 'order-provider-')"></button>
            <a href="{{ $merchandise->order_provider }}" target="_blank" class="btn btn-light far fa-arrow-alt-circle-right" style="border: none; font-size: 1rem;"></a>
        </div>
    </td>
    <td id="merch-order-provider-form-{{ $merchandise->id }}" style="width:100%;" hidden>
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div class="input-group">
                <input name="order_provider" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old('price', $merchandise->order_provider) }}" required>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <input name="target" type="text"  value="order" required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>

    @include('merchandises._merch_td_with_select', ["elem" => "order_status", "included_array" => $merch_order_statuses, "table" => "order", "style" => "width:10rem;", "style_form" => ""])
    @include('merchandises._merch_td_with_select', ["elem" => "order_payment_type", "included_array" => $order_payment_types, "table" => "order", "style" => "width:10rem;", "style_form" => ""])
    @include('merchandises._merch_td_with_select', ["elem" => "order_payment_status", "included_array" => $order_payment_statuses, "table" => "order", "style" => "width:10rem;", "style_form" => ""])
    @include('merchandises._merch_td', ["elem" => "order_comment", "table" => "order", "style" => "width:7rem;;", "style_form" => ""])
</tr>
