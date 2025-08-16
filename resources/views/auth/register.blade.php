@component('layouts.app', compact('title'))
    <h1>Identifiez-vous&nbsp;!</h1>
    <p>Le faire vous donnera accès à votre dashboard pour administrer les déclarations de perte&nbsp;!</p>
    <form action="/register" method="post" novalidate>
        {!! csrf_token(); !!}
        <fieldset>
            {{--Email--}}
            @component('components.form.inputText', ['name'=> 'email', 'id' => 'email', 'placeholder' => 'jean@valjean.be', 'label' => 'Email', 'input_type' => 'email', 'required' => true])
            @endcomponent

            {{--Confirmation email--}}
            @component('components.form.inputText', ['name'=> 'email_same', 'id' => 'email_same', 'placeholder' => 'jean@valjean.be', 'label' => 'Vérification de l’email', 'input_type' => 'email', 'required' => true])
            @endcomponent

            @php $current_language = CURRENT_LANG; @endphp
            <div class="field">
                <label for="lang" aria-hidden="true"><abbr title="requis">*</abbr> Langue par défaut</label>
                <select
                        required
                        name="language"
                        id="lang">
                    @foreach (AVAILABLE_LANGUAGES as $code => $lang)
                        <option
                                value="{!! $code !!}"
                                {!! $current_language === $code ? ' selected' : '' !!}>
                            {!! $lang; !!}
                        </option>
                    @endforeach
                </select>
            </div>

            {{--Mot de passe--}}
            @component('components.form.inputText', ['name'=> 'password', 'id' => 'password', 'label' => 'Mot de passe', 'input_type' => 'password', 'required' => true])
            @endcomponent
        </fieldset>
        <button type="submit">Créer mon compte&nbsp;</button>
    </form>
    <a href="/login">Se connecter</a>
@endcomponent
<?php
