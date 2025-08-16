@component('layouts.app', compact('title'))
    <h1>Modifier la déclaration</h1>
    <form action="/loss-declaration/edit" method="POST" style="margin-top: 48px; gap: 16px">
        <fieldset>
            <input type="hidden" name="id" value="{{ $loss->id }}">
            <div class="field" style="justify-content: start; border: 1px solid black">
                <label for="archive">Archiver la déclaration</label>
                <input type="checkbox" name="archive" id="archive"
                       @if($loss->archive)
                           checked
                        @endif
                >
            </div>
        </fieldset>
        <button type="submit">Modifier le statut</button>
    </form>
@endcomponent
