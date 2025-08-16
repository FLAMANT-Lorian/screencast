@component('layouts.app', compact('title'))
    <h1>Informations sur {!! $pet_owner->name !!}</h1>
    <div class="info__wrapper">
        <article class="left">
            <h2>Vos informations</h2>
            <form action="/pet-owner/edit" method="POST">
                {!! csrf_token() !!}
                <input type="hidden" name="id" value="{!! $pet_owner->id !!}">
                <fieldset>
                    <div class="fields">

                        @component('components.form.inputText', ['name'=> 'first_name', 'value' => $pet_owner->first_name, 'placeholder' => $pet_owner->first_name, 'id' => 'first_name', 'label' => 'Prénom', 'input_type' => 'text', 'required' => true])
                        @endcomponent
                        @component('components.form.inputText', ['name'=> 'last_name', 'value' => $pet_owner->last_name, 'placeholder' => $pet_owner->last_name, 'id' => 'last_name', 'label' => 'Nom', 'input_type' => 'text', 'required' => true])
                        @endcomponent

                    </div>
                </fieldset>
                @component('components.form.button')
                    Enregistrer
                @endcomponent
            </form>
        </article>
        <article class="right">
            <h2>Statistiques de {!! $pet_owner->name !!}</h2>
            <ul class="stat">
                <li class="stat--item">
                    <span>Total des pertes déclarées&nbsp;:</span>
                    <strong>{!! $pet_owner->losses->count() !!}</strong>
                </li>
                <li class="stat--item">
                    <span>Nom des animaux déclarés:</span>
                    @foreach($losses as $loss)
                    <strong>{!! $loss->pet->name !!},</strong>
                    @endforeach
                </li>
            </ul>
        </article>
    </div>
@endcomponent