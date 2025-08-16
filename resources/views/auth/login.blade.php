@component('layouts.app', ['title' => 'Déclaration de perte d’animal'])
    <h1>Identifiez-vous&nbsp;!</h1>
    <p>Le faire vous donnera accès à votre dashboard pour administrer les déclarations de perte&nbsp;!</p>
    <form action="/login" method="post">
        {!! csrf_token(); !!}
        <fieldset>
            @component('components.form.inputText', ['name'=> 'email', 'id' => 'email', 'placeholder' => 'jean@valjean.be', 'label' => 'Email', 'input_type' => 'email', 'required' => true])
            @endcomponent

            @component('components.form.inputText', ['name'=> 'password', 'id' => 'password', 'label' => 'Mot de passe', 'input_type' => 'password', 'required' => true])
            @endcomponent
        </fieldset>
        <button type="submit">Identifiez-vous&nbsp;!</button>
    </form>
    <a href="/register">S'inscrire</a>
@endcomponent
