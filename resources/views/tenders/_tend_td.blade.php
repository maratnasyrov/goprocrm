<td id="tend-{{ $elem }}-form-{{ $tender->id }}" style="{{ $style }}">
    <form class="form-horizontal" action="{{route('tender.update', $tender)}}" method="post" style=" {{ $style_form }} ">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <div class="input-group">
            <input name="{{$elem}}" type="text" class="form-control custom-input" aria-describedby="basic-addon1" value="{{ old($elem, $tender->$elem) }}" required>
            <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
            <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
        </div>
    </form>
</td>
