<?php

return [

// Configuración en config/auth.php
'providers' => [
    'administradores' => [
        'driver' => 'eloquent',
        'model' => App\Models\Administrador::class,
    ],
    'usuarios' => [
        'driver' => 'eloquent',
        'model' => App\Models\usuario::class,
    ],
],

'guards' => [
    'admin' => [
        'driver' => 'session',
        'provider' => 'administradores',
    ],
    'usuario' => [
        'driver' => 'session',
        'provider' => 'usuarios',
    ],
],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Here you may define the amount of seconds before a password confirmation
    | window expires and users are asked to re-enter their password via the
    | confirmation screen. By default, the timeout lasts for three hours.
    |
    */

 

];
