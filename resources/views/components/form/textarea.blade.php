<div class="field">
    <label for="{!! $name !!}">{!! $label !!}</label>
    <textarea name="{!! $name !!}"
              id="{!! $id !!}"
              rows="10"
              placeholder="{!! $placeholder !!}">{!! $_SESSION['old'][$name] ?? '' !!}</textarea>

    @isset($_SESSION['errors'][$name])
        <div class="error">
            <p>
                {!! $_SESSION['errors'][$name] !!}
            </p>
        </div>
    @endisset
</div>