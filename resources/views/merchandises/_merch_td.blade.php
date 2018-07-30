<td id="merch-{{ $elem }}-form-{{ $merchandise->id }}" style="{{ $style }}">
    <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post" style=" {{ $style_form }} ">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <div class="input-group">
            <input name="{{$elem}}" type="text" class="form-control" aria-describedby="basic-addon1" value="{{ old("$elem", $merchandise->$elem) }}" required>
            <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
            <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
        </div>
    </form>
</td>
