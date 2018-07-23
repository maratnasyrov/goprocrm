<form class="form-horizontal" action="{{route('merchandise.store')}}" method="post">
    {{ csrf_field() }}
    <div class="input-group mb-3">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Наименование</span>
            </div>
            <textarea class="form-control" aria-label="With textarea" name="name"></textarea>
        </div>
        <input name="price" type="text" class="form-control" placeholder="Введите цену" aria-describedby="basic-addon1" required>
        <input name="number" type="text" class="form-control" placeholder="Введите количество" aria-describedby="basic-addon1" required>
        <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
        <button class="btn btn-success" type="submit" value="Сохранить">Добавить</button>
    </div>
</form>
