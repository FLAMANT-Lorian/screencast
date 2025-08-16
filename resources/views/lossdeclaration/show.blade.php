@component('layouts.app', compact('title'))
    <h1>Récapitulatif des données soumises</h1>
    <dl>
        <div>
            <dt>Nom du propriétaire&nbsp;:</dt>
            <dd>{!!  $loss->pet_owner->name !!}</dd>
            <dt>Email&nbsp;:</dt>
            <dd>{!!  $loss->pet_owner->email !!}</dd>
            <dt>Nom de l'animal&nbsp;:</dt>
            <dd>{!!  $loss->pet->name !!}</dd>
        </div>
    </dl>
    <a href="/loss-declaration/edit?id={!! $loss->id !!}">Modifier la déclaration</a>
@endcomponent