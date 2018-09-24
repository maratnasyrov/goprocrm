<td id="merch-{{ $elem }}-form-{{ $merchandise->id }}" style="{{ $style }}">
    <form class="form-horizontal" action="{{route('merchandise.update', $merchandise)}}" method="post" style=" {{ $style_form }} ">
        <input type="hidden" name="_method" value="put">
        {{ csrf_field() }}
        <div class="input-group">
            <select class="custom-select" name="{{ $elem }}" onchange="this.form.submit()">
                @if ($tender->count())
                    <option value=""></option>
                    @foreach ($included_array as $included_elem)
                        <option value="{{ $included_elem }}" {{ old($elem, $merchandise->$elem) == $included_elem ? 'selected' : '' }}> {{ $included_elem }} </option>
                    @endforeach
                @endif
            </select>
            <input name="tender_id" type="text"  value="{{ $tender->id }}"required hidden>
            <input name="target" type="text"  value="{{ $table }}" required hidden>
            <button class="btn btn-light far fa-check-circle" type="submit" hidden></button>
        </div>
    </form>
</td>
