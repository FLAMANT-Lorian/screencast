@component('layouts.app')
    <form action="/loss-declaration"
          method="post" novalidate>
        {!! csrf_token(); !!}
        <fieldset>
            <legend>Vos coordonn&eacute;es</legend>
            <!-- first-name field -->
            @component('components.form.inputText', ['name'=> 'first-name', 'id' => 'first-name', 'placeholder' => 'Jean', 'label' => 'Prénom', 'input_type' => 'text', 'required' => false])
            @endcomponent

            <!-- last-name field -->
            @component('components.form.inputText', ['name'=> 'last-name', 'id' => 'last-name', 'placeholder' => 'ValJean', 'label' => 'Nom', 'input_type' => 'text', 'required' => false])
            @endcomponent

            <!-- Email field -->
            @component('components.form.inputText', ['name'=> 'email', 'id' => 'email', 'placeholder' => '', 'label' => 'Email', 'input_type' => 'email', 'required' => true])
            @endcomponent

            <!-- Email verification -->
            @component('components.form.inputText', ['name'=> 'vemail', 'id' => 'vemail', 'placeholder' => '', 'label' => 'Vérification de l’email', 'input_type' => 'email', 'required' => true])
            @endcomponent

            <!-- Phone number -->
            @component('components.form.inputText', ['name'=> 'phone', 'id' => 'phone', 'placeholder' => '+32 (0)4 279 75 01', 'label' => 'Téléphone', 'input_type' => 'tel', 'required' => false])
            @endcomponent

            <!-- Country -->
            @component('components.form.select',
[
    'name'=> 'country',
    'id' => 'country',
    'label' => 'Pays',
    'collection' => $countries,
    'item' => 'country',
    'identifier' => 'code',
    'constant' => COUNTRIES
    ])
            @endcomponent
        </fieldset>

        <fieldset>
            <legend>Description de l&rsquo;animal disparu</legend>

            <!-- Pet Type -->
            <div class="fields">
                <!-- Pet Type -->
                <div class="field">
                    <label for="pet-type">Type d&rsquo;animal</label>
                    <select name="pet-type"
                            id="pet-type">
                        <?php
                        foreach ($pet_types as $type) : ?>
                        <option value="<?= $type->code ?>"
                                <?php
                                if (isset($_SESSION['old']['pet-type']) && $type->code === $_SESSION['old']['pet-type']) : ?>
                                selected
                            <?php
                            endif ?>
                        ><?= PET_TYPES[$type->code] ?></option>
                        <?php
                        endforeach ?>
                    </select>
                    <?php
                    if (isset($_SESSION['errors']['pet-type'])) : ?>
                    <div class="error"><p><?= $_SESSION['errors']['pet-type'] ?></p></div>
                    <?php
                    endif ?>
                </div>
                <!-- Pet Name -->
                @component('components.form.inputText', ['name'=> 'pet-name', 'id' => 'pet-name', 'placeholder' => 'Rex', 'label' => 'Nom de l’animal', 'input_type' => 'text', 'required' => true])
                @endcomponent

                <!-- Pet chip -->
                @component('components.form.inputText', ['name'=> 'pet-chip', 'id' => 'pet-chip', 'placeholder' => '', 'label' => 'Puce <br><small>Obligatoire pour les chiens</small>', 'input_type' => 'text', 'required' => false])
                @endcomponent

                <!-- Pet Gender -->
                <div class="field row-radio">
                    <p>Sexe</p>
                    <input type="radio"
                           name="pet-gender"
                           id="pet-gender-female"
                           value="female"
                           <?php
                           if (isset($_SESSION['old']['pet-gender']) && $_SESSION['old']['pet-gender'] === 'female') : ?>
                           checked
                        <?php
                        endif ?>
                    ><label for="pet-gender-female">Femelle</label>

                    <input type="radio"
                           name="pet-gender"
                           id="pet-gender-male"
                           value="male"
                           <?php
                           if (isset($_SESSION['old']['pet-gender']) && $_SESSION['old']['pet-gender'] === 'male') : ?>
                           checked
                        <?php
                        endif ?>
                    ><label for="pet-gender-male">Male</label>

                    <?php
                    if (isset($_SESSION['errors']['pet-gender'])) : ?>
                    <div class="error"><p><?= $_SESSION['errors']['pet-gender'] ?></p></div>
                    <?php
                    endif ?>
                </div>

                <!-- Pet Age -->
                @component('components.form.inputText', ['name'=> 'pet-age', 'id' => 'pet-age', 'placeholder' => '5', 'label' => 'Âge de l’animal <br><small>Approximativement en ann&eacute;es</small>', 'input_type' => 'number', 'required' => false])
                @endcomponent

                <!-- Pet Race -->
                @component('components.form.inputText', ['name'=> 'pet-race', 'id' => 'pet-race', 'placeholder' => 'Caniche', 'label' => 'Race de l’animal', 'input_type' => 'text', 'required' => false])
                @endcomponent

                <!-- Pet tatoo -->
                <div class="field row-radio">
                    <label for="pet-tatoo-location">Tatouage</label>
                    <select name="pet-tatoo-location"
                            id="pet-tatoo-location"
                    <?php foreach ($tatoos as $code => $tatoo) : ?>
                    <option value="<?= $code ?>"
                            <?php
                            if (isset($_SESSION['old']['pet-tatto-location']) && $code === $_SESSION['old']['pet-tatto-location']) : ?>
                            selected
                        <?php
                        endif ?>
                    ><?= TATOOS[$code] ?></option>
                    <?php
                    endforeach ?>
                    </select>
                    <?php
                    if (isset($_SESSION['errors']['pet-tatoo-location'])) : ?>
                    <div class="error"><p><?= $_SESSION['errors']['pet-tatoo-location'] ?></p></div>
                    <?php
                    endif ?>
                    <label for="pet-tatoo">Code</label>
                    <input type="text"
                           value="<?= $_SESSION['old']['pet-tatoo'] ?? '' ?>"
                           name="pet-tatoo"
                           id="pet-tatoo"
                           placeholder="898HH0">
                    <?php
                    if (isset($_SESSION['errors']['pet-tatoo'])) : ?>
                    <div class="error"><p><?= $_SESSION['errors']['pet-tatoo'] ?></p></div>
                    <?php
                    endif ?>
                </div>

                <!-- Pet Description -->
                @component('components.form.textarea', ['name' => 'pet-description', 'id' => 'pet-description', 'placeholder' => 'C’est un bon gamin', 'label' => 'Description / Signes particuliers'])
                @endcomponent

                <!-- Pet Race -->
                <div class="field">
                    <label for="pet-picture">Photo de l&rsquo;animal</label>
                    <input type="file"
                           name="pet-picture"
                           id="pet-picture">
                    <?php
                    if (isset($_SESSION['errors']['pet-picture'])) : ?>
                    <div class="error">
                        <p><?= $_SESSION['errors']['pet-picture'] ?></p>
                    </div>
                    <?php
                    elseif (!empty($_SESSION['errors'])) : ?>
                    <div class="error">
                        <p>Il faut res&eacute;lectionner l&rsquo;image que vous aviez choisie, sinon, elle sera
                            perdue.</p>
                    </div>
                    <?php
                    endif ?>
                </div>
        </fieldset>

        <fieldset>
            <legend>Date et localit&eacute; de la disparition</legend>
            <div class="fields">
                <!-- Date field -->
                <div class="field">
                    <label for="disparition-date">Date de la disparition
                        <br><small>Ann&eacute;e/mois/jour ou s&eacute;lection dans le calendrier</small></label>
                    <input type="date"
                           value="<?= $_SESSION['old']['disparition-date'] ?? '' ?>"
                           name="disparition-date"
                           id="disparition-date"
                           required>
                    <?php
                    if (isset($_SESSION['errors']['disparition-date'])) : ?>
                    <div class="error"><p><?= $_SESSION['errors']['disparition-date'] ?></p></div>
                    <?php
                    endif ?>
                </div>
                <!-- Disparition time -->
                <div class="field">
                    <label for="disparition-time">Heure
                        <br><small>Heures:minutes ou s&eacute;lection de l&rsquo;heure</small></label>
                    <input type="time"
                           name="disparition-time"
                           id="disparition-time"
                           value="<?= $_SESSION['old']['disparition-time'] ?? '' ?>">
                    <?php
                    if (isset($_SESSION['errors']['disparition-time'])) : ?>
                    <div class="error"><p><?= $_SESSION['errors']['disparition-time'] ?></p></div>
                    <?php
                    endif ?>
                </div>
                <!-- Disparition postal code -->
                <div class="field">
                    <label for="disparition-postal-code">Code postal</label>
                    <input type="number"
                           value="<?= $_SESSION['old']['disparition-postal-code'] ?? '' ?>"
                           minlength="4"
                           maxlength="5"
                           name="disparition-postal-code"
                           id="disparition-postal-code"
                           placeholder="4000"
                           required>
                    <?php
                    if (isset($_SESSION['errors']['disparition-postal-code'])) : ?>
                    <div class="error"><p><?= $_SESSION['errors']['disparition-postal-code'] ?></p></div>
                    <?php
                    endif ?>
                </div>
                <!-- Disparition Country -->
                <div class="field">
                    <label for="disparition-country">Pays</label>
                    <select name="disparition-country"
                            id="disparition-country">
                        <?php
                        foreach ($countries as $country) : ?>
                        <option value="<?= $country->code ?>"
                                <?php
                                if (isset($_SESSION['old']['disparition-country']) && $country->code === $_SESSION['old']['disparition-country']) : ?>
                                selected
                            <?php
                            endif ?>
                        ><?= COUNTRIES[$country->code] ?></option>
                        <?php
                        endforeach; ?>
                    </select>
                    <?php
                    if (isset($_SESSION['errors']['disparition-country'])) : ?>
                    <div class="error"><p><?= $_SESSION['errors']['disparition-country'] ?></p></div>
                    <?php
                    endif ?>
                </div>
            </div>
        </fieldset>
        @component('components.form.button')
            D&eacute;clarer la perte de mon animal
        @endcomponent
    </form>
@endcomponent