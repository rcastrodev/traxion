<?php

use App\Client;
if (! function_exists('date_custom')) {
    function date_custom($date)
    {
        return date_format(new \DateTime($date), 'd/m/Y');
    }
}

if (! function_exists('client')) {
    function client()
    {
        return Client::find(session('user_id'));
    }
}