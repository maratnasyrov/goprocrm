@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{route('tender.create')}}" class="btn btn-primary pull-right">
        <i class="fafa-plus-square-o">Добавить новый тендер</i>
    </a>

    <table class="table table-striped">
        <thead>
            <th>Номер</th>
        </thead>
        <tbody>
            @forelse ($tenders as $tender)
                <tr>
                    <td>{{$tender->number}}</td>
                    <td>
                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('tender.destroy', $tender)}}" method="post">
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
