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
                @foreach ($managers as $manager)
                    @if ($tender->manager_id == $manager->id)
                        <option selected value="{{ old('manager_id', $manager->id) }}">{{ $manager->full_name() }}</option>
                    @elseif ($tender->manager_id != $manager->id)
                        <option value="{{ $manager->id }}">{{ $manager->full_name() }}</option>
                    @endif
                @endforeach

                @if ($tender->manager_id == null)
                    <option selected value="">Выбрать менеджера (не обязательно)</option>
                @else
                    <option value="">Выбрать менеджера (не обязательно)</option>
                @endif
            @endif
        </select>
    </div>

    <button class="btn btn-success" type="submit" value="Сохранить">Сохранить</button>
</form>

@endsection
