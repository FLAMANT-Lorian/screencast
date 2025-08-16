@php use Animal\Models\PetType; @endphp
@component('layouts.app', compact('title'))
    @php
        $available_pet_types = PetType::All('code');
    @endphp
    <h2>Types d'animaux disponibles</h2>
        <p>
            @foreach($available_pet_types as $pet_type)
                {!! $pet_type['code'] !!},
            @endforeach
        </p>
    <form action="/pet-type" method="POST" class="new__pet-type">
        {!! csrf_token() !!}
        <fieldset>
            <legend>Ajouter un nouveau type d’animal</legend>
            <!-- New pet-type field -->
            @component('components.form.inputText', ['name'=> 'pet-type', 'id' => 'pet-type', 'serpent' => 'Jean', 'label' => 'Type de l\'animal', 'input_type' => 'text', 'required' => true])
            @endcomponent
        </fieldset>
        <button type="submit">
            Ajouter
        </button>
    </form>
@endcomponent
