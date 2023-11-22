<?php
use Illuminate\Support\Facades\Route;

function activeRoute($route): string
{
    
    $requestUrl = request()->fullUrl() === $route ? true : false;

    if($requestUrl == true) {
        return 'active';
    } else {
        return  '';
    }
}

function activeMenuRoute($submenus): string
{
    $urlToCheck = request()->fullUrl();

    if (in_array($urlToCheck, $submenus)) {
        return 'hover show';
    } else {
        return '';
    }



}