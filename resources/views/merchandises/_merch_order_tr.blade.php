<tr id="merch-{{ $merchandise->id }}">
    <td></td>
    <td class="no-change">{{ $merchandise->name }}</td>

    <td id="merch-order-number-form-{{ $merchandise->id }}" style="width:7rem;">
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div id="name-input" class="input-group">
                <input name="order_number" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old('order_number', $merchandise->order_number) }}" required>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>

    <td id="merch-order-provider-{{ $merchandise->id }}">
        <div class="input-group merch-link-tbl" style="width: 5.2rem;">
            <button type="button" name="button" class="btn btn-light fas fa-edit" style="border: none; font-size: 1rem;" onclick="showEditLabel({{$merchandise->id}}, 'order-link-')"></button>
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
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>

    <td id="merch-order-status-form-{{ $merchandise->id }}" style="width:10rem;">
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div id="name-input" class="input-group">
                <select class="custom-select" name="order_status">
                    @foreach ($merch_order_statuses as $merch_order_status)
                        <option value="{{ $merch_order_status }}">{{ $merch_order_status }}</option>
                    @endforeach
                </select>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>

    <td id="merch-order-payment-type-form-{{ $merchandise->id }}" style="width:10rem;">
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div id="name-input" class="input-group">
                <select class="custom-select" name="order_payment_type">
                    @foreach ($order_payment_types as $order_payment_type)
                        <option value="{{ $order_payment_type }}">{{ $order_payment_type }}</option>
                    @endforeach
                </select>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>

    <td id="merch-order-status-form-{{ $merchandise->id }}" style="width:10rem;">
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div id="name-input" class="input-group">
                <select class="custom-select" name="order_status">
                    @foreach ($order_payment_statuses as $order_payment_status)
                        <option value="{{ $order_payment_status }}">{{ $order_payment_status }}</option>
                    @endforeach
                </select>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>

    <td id="merch-order-comment-form-{{ $merchandise->id }}" style="width:7rem;">
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div id="name-input" class="input-group">
                <input name="order_comment" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old('order_comment', $merchandise->order_comment) }}" required>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>
</tr>
