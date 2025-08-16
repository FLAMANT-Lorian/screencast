@component('layouts.app', compact('title'))
    <h1>Données de {!! $pet->name !!}</h1>
    <form action="/pet/edit" method="POST">
        {!! csrf_token() !!}
        <input type="hidden" name="id" value="{!! $pet->id !!}">
        <fieldset>
            <div class="fields">

                @component('components.form.inputText', ['name'=> 'name', 'value' => $pet->name, 'placeholder' => $pet->name, 'id' => 'name', 'label' => 'Nom', 'input_type' => 'text', 'required' => true])
                @endcomponent

                @component('components.form.inputText', ['name'=> 'chip', 'value' => $pet->chip, 'id' => 'chip', 'placeholder' => $pet->chip, 'label' => 'Puce <br><small>Obligatoire pour les chiens</small>', 'input_type' => 'text', 'required' => false])
                @endcomponent

            </div>
        </fieldset>
        @component('components.form.button')
            Enregistrer
        @endcomponent
    </form>
@endcomponent