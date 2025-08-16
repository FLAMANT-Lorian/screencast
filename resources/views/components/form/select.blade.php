<div class="field">
    <label for="{!! $id !!}">{!! $label !!}</label>
    <select name="{!! $name !!}"
            id="{!! $id !!}">
        @foreach ($collection as $item)
            <option value="{!! $item->$identifier !!}"
                    @if(@isset($_SESSION['old'][$name]) && $item->$identifier === $_SESSION['old'][$name])
                        selected
                    @endif
            >{!! $item->translated_full_name !!}</option>
        @endforeach
    </select>
    @isset($_SESSION['errors'][$name])
        <div class="error">
            <p>
                {!! $_SESSION['errors'][$name] !!}
            </p>
        </div>
    @endisset
</div>