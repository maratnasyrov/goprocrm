@extends('layouts.app')

@section('content')

<div class="container">
    <form class="form-horizontal" action="{{route('manager.store')}}" method="post">
        {{ csrf_field() }}
        <label for="name">Введите имя</label>
        <input type="text" name="name" class="form-control" required>
        <label for="surname">Введите фамилию</label>
        <input type="text" name="surname" class="form-control" required>
        <label for="phone">Введите Телефон</label>
        <input type="text" name="phone" class="form-control" required>
        <input class="btn btn-primary" type="submit" value="Добавить">
    </form>
</div>

@endsection
