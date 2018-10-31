@extends('layouts.app')

@section('content')

<div class="container">
    <h3>Обновление данных</h3>

    <div id="info-label" class="information" hidden>
        <div class="">
            <h6 id="download" class="bold">Скачивание архивов с FTP...</h6>
            <h6 id="unzip" class="disabled">Распаковка архивов...</h6>
            <h6 class="disabled">Чтение данных из архивов и добавление в базу данных...</h6>
            <h6 class="disabled">Готово</h6>
            <div class="progress">
                <div id="ftp_progressbar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="0">0%</div>
            </div>
        </div>
    </div>

    <div class="dropdown-divider"></div>

    <form id="downloadFromFTP" class="form-horizontal" method="post">
        <h5>Выберите Регионы для обновления</h2>
        {{ csrf_field() }}
        <div class="custom-control custom-checkbox my-1 mr-sm-2">
            <input name="code[]" type="checkbox" class="custom-control-input" id="all_check" value="{{"all"}}">
            <label class="custom-control-label" for="all_check">Выбрать все</label>
        </div>
        @foreach ($regions as $region_code => $region_value)
            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                <input name="code[]" type="checkbox" class="custom-control-input" id="customControlInline" value="{{$region_code}}">
                <label class="custom-control-label" for="customControlInline">{{ $region_value }}</label>
            </div>
        @endforeach
        <button class="btn btn-primary" type="submit">Обновить данные</button>
    </form>
</div>

@endsection
