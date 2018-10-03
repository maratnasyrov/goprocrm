<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="edit-tender-label">Редактирование тендера</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form class="form-horizontal" action="{{route('tender.update', $tender)}}" method="post" style="font-family: sans-serif;">
            <div class="modal-body">
                <input type="hidden" name="_method" value="put">
                {{ csrf_field() }}

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1" for="number">№</span>
                  </div>
                  <input name="number" type="text" class="form-control" placeholder="Введите номер извещения" aria-label="Username" aria-describedby="basic-addon1" value="{{ old('number', $tender->number) }}" required>
                </div>

                <div class="mb-3">
                    <input name="name" type="text" class="form-control" placeholder="Введите наименование закупки" aria-describedby="basic-addon1" value="{{ old('name', $tender->name) }}" required>
                </div>
                <div class="mb-3">
                    <select class="custom-select" name="manager_id">
                        @if ($managers->count())
                            <option value="">Выбрать менеджера (не обязательно)</option>
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->id }}" {{ old('manager_id', $tender->manager_id) == $manager->id ? 'selected' : '' }}> {{ $manager->full_name() }} </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="mb-3">
                  <select class="custom-select" name="customer_id">
                      @if ($customers->count())
                          <option value="">Выбрать заказчика</option>
                          @foreach ($customers as $customer)
                              <option value="{{ $customer->id }}" {{ old('customer_id', $tender->customer_id) == $customer->id ? 'selected' : '' }}> {{ $customer->name_short }} </option>
                          @endforeach
                      @endif
                  </select>
                </div>

                <div class="mb-3">
                    <input name="contract_price" type="text" class="form-control" placeholder="Введите сумму контракта" aria-describedby="basic-addon1" value="{{ old('contract_price', $tender->contract_price) }}" required>
                </div>

                <div class="mb-3">
                  <select class="custom-select" name="status">
                      @if ($customers->count())
                          <option value="">Укажите текущий статус тендера</option>
                          @foreach ($tender_statuses as $status)
                              <option value="{{ $status }}" {{ old('status', $tender->status) == $status ? 'selected' : '' }}> {{ $status }} </option>
                          @endforeach
                      @endif
                  </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
</div>
