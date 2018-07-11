@extends('layouts.app')

@section('content')

<div class="container">
    <form class="form-horizontal" action="{{route('tender.store')}}" method="post">
        <label for="number">Введите номер тендера</label>
        {{ csrf_field() }}
        <input type="text" name="number" class="form-control" required>
        <input type="text" name="manager_id" class="form-control" value="0" required>
        <input type="text" name="courier_id" class="form-control" value="0" required>
        <input class="btn btn-primary" type="submit" value="Сохранить">
    </form>
</div>

@endsection
