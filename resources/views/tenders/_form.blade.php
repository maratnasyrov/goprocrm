<form class="form-horizontal" action="{{route('tender.store')}}" method="post">
    {{ csrf_field() }}
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1" for="number">№</span>
      </div>
      <input name="number" type="text" class="form-control" placeholder="Введите номер извещения" aria-label="Username" aria-describedby="basic-addon1" required>
    </div>
    <div class="mb-3">
        <select class="custom-select" name="manager_id">
          <option selected value="">Выбрать менеджера (не обязательно)</option>
          @if ($managers->count())
              @foreach ($managers as $manager)
                  <option value="{{ $manager->id }}">{{ $manager->full_name() }}</option>
              @endforeach
          @endif
        </select>
    </div>

    <button class="btn btn-success" type="submit" value="Сохранить">Сохранить</button>
</form>
