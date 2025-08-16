<div class="field">
    <label for="{!! $id !!}">
        @if($required)
            <abbr title="requis">*</abbr>
        @endif
        {!! $label !!}
    </label>
    <input type="{!! $input_type !!}"
           value="{!! $value ?? $_SESSION['old'][$name] ?? '' !!}"
           name="{!! $name !!}"
           id="{!! $id !!}"
           @isset($placeholder)
               placeholder="{!! $placeholder !!}"
           @endisset
           @if($required)
               required
            @endif
    >

    @isset($_SESSION['errors'][$name])
        <div class="error">
            <p>{!! $_SESSION['errors'][$name]!!}
            </p>
        </div>
    @endisset
</div>