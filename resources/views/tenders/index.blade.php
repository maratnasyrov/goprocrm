@extends('layouts.app')

@section('content')

<div class="container">
    <button id="new-tender-p" type="button" class="btn btn-primary" data-toggle="popover" title="Новый тендер" data-content="" data-placement="bottom">Новый тендер</button>

    <div class="container">
        @forelse ($tenders as $tender)
            <div class="row tender-part">
                <div class="col-7 tender-number">
                    <a href="{{route('tender.show', $tender)}}">{{$tender->number}}</a>
                </div>
                <div class="col-2">

                </div>
                <div class="col-2 tender-manager">
                    {{$tender->manager()}}
                </div>
                <div class="col-1">
                    <form onsubmit="if(confirm('Удалить?')){ return true }else{ return false }" action="{{route('tender.destroy', $tender)}}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger" style="float: right;">X</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div id="new-tender-label" class="container popover-customer" style="display: none">
    @include('tenders._form')
</div>

@endsection
