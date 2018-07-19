<form class="form-horizontal" action="{{route('tender.update', $tender)}}" method="post">
    {{ csrf_field() }}
    <div class="mb-3">
        <select class="custom-select" name="customer_id">
          <option selected value="">Выбрать заказчика</option>
          @if ($customers->count())
              @foreach ($customers as $customer)
                  <option value="{{ $customer->id }}">{{ $customer->name_full }}</option>
              @endforeach
          @endif
        </select>
    </div>

    <button class="btn btn-success" type="submit" value="Сохранить">Сохранить</button>
</form>
