<?php

    return array(
        'username' => array(
            'not_empty' => 'A felhasználónév nem lehet üres!',
            'unique' => 'Ilyen felhasználónév már létezik!',
            'min_length' => 'A felhasználónév minimum :param2 hosszúnak kell lennie!',
            'max_length' => 'A felhasználónév maximum :param2 hosszúnak kell lennie!',
        ),
        'email' => array(
            'not_empty' => 'A e-mail mező nem lehet üres!',
            'email'=>'Nem megfelelő email formátum',
            'unique' => 'Ilyen emaillel már regisztráltak!'
        )
    );