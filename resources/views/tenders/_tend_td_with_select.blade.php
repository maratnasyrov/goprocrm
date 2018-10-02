<td id="tend-{{ $elem }}-form-{{ $tender->id }}" style="{{ $style }}">
    <form class="form-horizontal" action="{{route('tender.update', $tender)}}" method="post" style=" {{ $style_form }} ">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <div class="input-group">
            <select class="custom-select input-custom-select" name="{{ $elem }}" onchange="this.form.submit()">
                @if ($tender->count())
                    @foreach ($included_array as $included_elem)
                        <option value="{{ $included_elem }}" {{ old($elem, $tender->$elem) == $included_elem ? 'selected' : '' }}> {{ $included_elem }} </option>
                    @endforeach
                @endif
            </select>
            <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
            <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
        </div>
    </form>
</td>
