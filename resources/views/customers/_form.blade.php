<form class="form-horizontal" action="{{ route('customer.store') }}" method="post">
    {{ csrf_field() }}
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="name_full">Наименование</label>
          <input name="name_full" type="text" class="form-control" placeholder="Введите полное название организации" required>
        </div>
        <div class="form-group col-md-6">
          <label for="name_short">Короткое имя</label>
          <input name="name_short" type="text" class="form-control" placeholder="Введите короткое имя">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="contact_name">Контактное лицо</label>
            <input name="contact_name" type="text" class="form-control" placeholder="Введите ФИО контакного лица" required>
        </div>
        <div class="form-group col-md-6">
            <label for="contact_phone">Телефон</label>
            <input name="contact_phone" type="text" class="form-control" placeholder="Введите телефон" required>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input name="email" type="text" class="form-control" placeholder="Введите электронный адрес">
        </div>
        <div class="form-group col-md-6">
          <label for="site">Сайт</label>
          <input name="site" type="text" class="form-control" placeholder="Введите адрес сайта">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inn">ИНН</label>
          <input name="inn" type="text" class="form-control" placeholder="Введите ИНН">
        </div>
        <div class="form-group col-md-6">
          <label for="kpp">КПП</label>
          <input name="kpp" type="text" class="form-control" placeholder="Введите КПП">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
          <label for="okpo">ОКПО</label>
          <input name="okpo" type="text" class="form-control" placeholder="Введите ОКПО">
        </div>
        <div class="form-group col-md-6">
          <label for="ogrn">ОГРН</label>
          <input name="ogrn" type="text" class="form-control" placeholder="Введите ОГРН">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
          <label for="time_zone">Временная зона</label>
          <select class="custom-select" name="time_zone">
              <option selected>Выберете временную зону</option>
              @for ($i = 1; $i < 13; $i++)
                  <option value="UTC+{{$i}}">UTC+{{$i}}</option>
              @endfor
          </select>
        </div>
    </div>
    <input name="tender_id" type="text" class="form-control" value="{{ $tender->id }}" hidden>
    <button type="submit" class="btn btn-success">Сохранить</button>
</form>
