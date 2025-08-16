@component('layouts.app', compact('title'))
    <h1>Dashboard</h1>
    <a href="/pet-type/create">Déclarer un nouveau type d'animal</a>
    <h2>Déclaration enregistrée</h2>
    @if($not_archive_losses->count() !== 0)
        <table>
            <tr>
                <th>{!! __trad('dashboard-date') !!}</th>
                <th>{!! __trad('dashboard-owner') !!}</th>
                <th>{!! __trad('dashboard-pet') !!}</th>
            </tr>
            @foreach($not_archive_losses as $not_archive_loss)
                <tr>
                    <td>
                        <a href="/loss-declaration/show?id={!! $not_archive_loss->id !!}">
                            {!! $not_archive_loss->lost_at->locale('fr')->isoFormat('Do MMMM YYYY') !!}
                        </a>
                    </td>
                    <td>
                        <a href="/pet-owner/edit?id={!! $not_archive_loss->pet_owner->id !!}">{!! $not_archive_loss->pet_owner->name !!}</a>
                    </td>
                    <td>
                        <a href="/pet/edit?id={!! $not_archive_loss->pet->id !!}">{!! $not_archive_loss->pet->name !!}</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Il n'y a pas encore de déclaration archivée !</p>
    @endif

    <h2>Déclaration archivée</h2>
    @if($archive_losses->count() !== 0)
        <table>
            <tr>
                <th>{!! __trad('dashboard-date') !!}</th>
                <th>{!! __trad('dashboard-owner') !!}</th>
                <th>{!! __trad('dashboard-pet') !!}</th>
            </tr>
            @foreach($archive_losses as $archive_loss)
                <tr>
                    <td>
                        <a href="/loss-declaration/show?id={!! $archive_loss->id !!}">
                            {!! $archive_loss->lost_at->locale('fr')->isoFormat('Do MMMM YYYY') !!}
                        </a>
                    </td>
                    <td>
                        <a href="/pet-owner/edit?id={!! $archive_loss->pet_owner->id !!}">{!! $archive_loss->pet_owner->name !!}</a>
                    </td>
                    <td><a href="/pet/edit?id={!! $archive_loss->pet->id !!}">{!! $archive_loss->pet->name !!}</a></td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Il n'y a pas encore de déclaration archivée !</p>
    @endif
@endcomponent