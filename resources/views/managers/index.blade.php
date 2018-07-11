@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{route('manager.create')}}" class="btn btn-primary pull-right">
        <i class="fafa-plus-square-o">Добавить нового менеджера</i>
    </a>

    <table class="table table-striped">
        <thead>
            <th>Имя</th>
        </thead>
        <tbody>
            @forelse ($managers as $manager)
                <tr>
                    <td>{{$manager->name . " " . $manager->surname}}</td>
                    <td>
                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('manager.destroy', $manager)}}" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            {{ csrf_field() }}
                            <button type="submit" class="btn"><i>X</i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
