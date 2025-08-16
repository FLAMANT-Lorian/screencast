@component('layouts.app', [compact('title')])
    <h1>Bonjour&nbsp;,</h1>
    <h2>Vos coordonnées&nbsp;</h2>
    <div class="coordinate__wrapper">

        <ul class="stat">
            <li class="stat--item">
                <span>Votre adresse-mail&nbsp;:</span>
                <strong>{!! $user->email !!}</strong>
            </li>
            <li class="stat--item">
                <form action="/profile/edit" method="POST" novalidate>
                    {!! csrf_token() !!}
                    <input type="hidden" name="id" value="{!! $user->id !!}">
                    <fieldset>
                        <div class="fields">
                            @component('components.form.inputText', ['name'=> 'password', 'id' => 'password', 'label' => 'Votre nouveau mot de passe', 'input_type' => 'password', 'required' => true])
                            @endcomponent
                            @component('components.form.inputText', ['name'=> 'password_old', 'id' => 'password_old', 'label' => 'Votre ancien mot de passe', 'input_type' => 'text', 'required' => true])
                            @endcomponent
                        </div>
                    </fieldset>
                    @component('components.form.button')
                        Changer mon mot de passe
                    @endcomponent
                </form>
            </li>
        </ul>

    </div>
@endcomponent