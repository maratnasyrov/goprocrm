@extends('layouts.app')

@section('content')

<div class="container">
    <table class="table table-striped">
        <thead>
            <th>Имя</th>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{$customer->name . " " . $customer->surname}}</td>
                    <td>
                        <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('customer.destroy', $customer)}}" method="post">
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
