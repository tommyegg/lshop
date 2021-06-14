<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function humanReadPrice(int|float $amount)
{
    return number_format($amount, 0);
}
