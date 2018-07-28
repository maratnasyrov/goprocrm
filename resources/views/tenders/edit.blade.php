@extends('layouts.app')

@section('content')

<form class="form-horizontal" action="{{route('tender.update', $tender)}}" method="post">
    <input type="hidden" name="_method" value="put">
    {{ csrf_field() }}
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1" for="number">№</span>
      </div>
      <input name="number" type="text" class="form-control" placeholder="Введите номер извещения" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('number', $tender->number) }}" required>
    </div>
    <div class="mb-3">
        <select class="custom-select" name="manager_id">
            @if ($managers->count())
                @if ($tender->manager_id == null)
                    <option selected value="">Выбрать менеджера (не обязательно)</option>
                @else
                    <option value="">Выбрать менеджера (не обязательно)</option>
                @endif

                @foreach ($managers as $manager)
                    @if ($tender->manager_id == $manager->id)
                        <option selected value="{{ old('manager_id', $manager->id) }}">{{ $manager->full_name() }}</option>
                    @elseif ($tender->manager_id != $manager->id)
                        <option value="{{ $manager->id }}">{{ $manager->full_name() }}</option>
                    @endif
                @endforeach
            @endif
        </select>
    </div>

    <div class="mb-3">
      <select class="custom-select" name="customer_id">
          @if ($customers->count())
              @if ($tender->customer_id == null)
                  <option selected value="">Выбрать заказчика</option>
              @else
                  <option value="">Выбрать заказчика</option>
              @endif
              @foreach ($customers as $customer)
                  @if ($tender->customer_id == $customer->id)
                      <option selected value="{{ old('customer_id', $customer->id) }}">{{ $customer->name_full }}</option>
                  @elseif ($tender->customer_id != $customer->id)
                      <option value="{{ $customer->id }}">{{ $customer->name_full }}</option>
                  @endif
              @endforeach
          @endif
      </select>
    </div>

    <input name="contract_price" type="text" class="form-control" placeholder="Введите сумму контракта" aria-describedby="basic-addon1" value="{{ old('contract_price', $tender->contract_price) }}" required>

    <button class="btn btn-success" type="submit" value="Сохранить">Сохранить</button>
</form>

@endsection
