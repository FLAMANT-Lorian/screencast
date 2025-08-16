<div class="navigation" role="navigation">
    <div class="nav__left">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="_x32_"
             width="800px" height="800px" viewBox="0 0 512 512" xml:space="preserve">
                <g>
                    <path class="st0"
                          d="M484.992,106.555c-42.188-21.672-96.219-40.547-145.484-61.734c-1.609-0.703-2.734-1.188-3.359-1.109   c-22.75-8.75-47.375-13.469-73.016-13.453c-13.047,0-25.375,0.688-37.063,2.016c-27.563,3.141-51.578,10.016-72.219,20.375   C109.93,70.773,63.93,87.586,27.008,106.555C1.086,119.867-1.305,144.742,0.445,155.32c4.688,28.438,24.125,103,28.125,117.844   c3.406,12.672,17.453,22.172,34.406,24.422c9.625,51.516,34.172,96.906,68.703,129.875l0,0   c17.641,16.813,37.906,30.391,60.094,39.766c22.172,9.375,46.281,14.531,71.359,14.516c28.563,0.016,55.859-6.688,80.5-18.672   c36.984-18,68.016-47.797,89.797-84.875c14.859-25.281,25.438-54.016,30.672-84.844c9.75-4.406,17.016-11.563,19.328-20.188   c4-14.844,23.438-89.406,28.125-117.844C513.305,144.742,510.914,119.867,484.992,106.555z M382.742,390.117   c-15.547,17.875-33.938,32.203-54.156,42.031c-20.219,9.844-42.234,15.219-65.453,15.219c-20.375,0-39.844-4.156-57.984-11.813   c-18.125-7.656-34.922-18.844-49.75-32.969h0.016c-4.25-4.031-8.297-8.344-12.188-12.859c0.094,0.094,0.203,0.203,0.313,0.297   c87.156-44.844,163.188-130.953,157.688-228.172c-2.688-47.172-23.656-77.516-48.672-97.031c3.469-0.109,6.969-0.188,10.578-0.188   c23.609,0.016,45.938,4.688,66.219,13.359c8.125,3.469,15.906,7.594,23.328,12.313c6.313,17.219,14.438,40.453,24.5,71.781   c-14.188,90.688,18.406,127.297,51.266,134.578C420.758,332.82,404.602,364.992,382.742,390.117z"/>
                    <path class="st0"
                          d="M266.852,338.086c-25.453,0-46.094,16.781-46.094,37.5s20.641,37.5,46.094,37.5s46.094-16.781,46.094-37.5   S292.305,338.086,266.852,338.086z"/>
                </g>
</svg>
        <a class="logo" href="/">
            PetAlert+</a>
    </div>
    @auth
        <div class="nav__right">
            <a href="/dashboard">Aller au dashboard</a>
            <form action="/logout" method="post">
                {!! csrf_token(); !!}
                <button class="button--logout" type="submit">Me déconnecter</button>
            </form>
            <a href="/profile/edit">
                <svg xmlns="http://www.w3.org/2000/svg" width="800px" height="800px" viewBox="0 0 24 24" fill="none">
                    <circle cx="12" cy="6" r="4" stroke="#1C274C" stroke-width="1.5"/>
                    <path d="M15 20.6151C14.0907 20.8619 13.0736 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C15.866 13 19 14.7909 19 17C19 17.3453 18.9234 17.6804 18.7795 18"
                          stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </a>
            @php $current_language = CURRENT_LANG; @endphp
            <form action="/lang" method="post" class="lang">
                {!! csrf_token() !!}
                <select
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
                <label for="lang" aria-hidden="true">Choix de langue</label>
                <button type="submit">Choisir cette langue</button>
            </form>
        </div>
    @endauth

    @guest
        <div class="nav__right">
            <a class="login" href="/login">Me connecter</a>
        </div>
    @endguest
</div>