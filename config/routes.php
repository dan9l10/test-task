<?php
return [
    '' => 'home/index',
    'login' => 'auth/pageLogin',
    'login/attempt' => 'auth/login',
    'register' => 'auth/pageRegister',
    'register/attempt' => 'auth/register',
    'profile/([a-z0-9-_]+)' => 'profile/show/$1',
];