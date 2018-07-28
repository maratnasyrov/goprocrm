<tr id="merch-{{ $merchandise->id }}">
    <td></td>
    <td id="merch-name-form-{{ $merchandise->id }}" style="width:100%;">
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div class="input-group">
                <input name="name" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old('name', $merchandise->name) }}" required>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>
    <td id="merch-price-form-{{ $merchandise->id }}">
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post"  style="width:6rem;">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div id="name-input" class="input-group">
                <input name="price" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old('price', $merchandise->price) }}" required>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>
    <td id="merch-number-form-{{ $merchandise->id }}" style="width:100%;">
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div id="name-input" class="input-group">
                <input name="number" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old('price', $merchandise->number) }}" required>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>
    <td class="no-change">{{ $merchandise->price * $merchandise->number }}</td>
    <td class="no-change">{{ $merchandise->set_order_payment($tender, $tender->merchandises) }}</td>
    <td class="no-change">{{ $merchandise->set_total_order_payment($tender, $tender->merchandises) }}</td>
    <td id="merch-order-link-{{ $merchandise->id }}">
        <div class="input-group merch-link-tbl" style="width: 5.2rem;">
            <button type="button" name="button" class="btn btn-light fas fa-edit" style="border: none; font-size: 1rem;" onclick="showEditLabel({{$merchandise->id}}, 'order-link-')"></button>
            <a href="{{ $merchandise->order_link }}" target="_blank" class="btn btn-light far fa-arrow-alt-circle-right" style="border: none; font-size: 1rem;"></a>
        </div>
    </td>
    <td id="merch-order-link-form-{{ $merchandise->id }}" style="width:100%;" hidden>
        <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{ csrf_field() }}
            <div class="input-group">
                <input name="order_link" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old('price', $merchandise->order_link) }}" required>
                <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
                <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
            </div>
        </form>
    </td>
</tr>
