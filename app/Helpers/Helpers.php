<?php 

if (!function_exists('user')) {
    function user()
    {
        return auth("sanctum")->user();
    }
}


if(!function_exists("userId")){
    function userId()
    {
        return auth("sanctum")->id();
    }
}

if(!function_exists("isHrManager")){
    function isHrManager()
    {
        $user = user();
        return $user && $user->role === 'hr_manager';
    }
}

if(!function_exists("isAdmin")){
    function isAdmin()
    {
        $user = user();
        return $user && $user->role === 'admin';
    }
}

if(!function_exists("isDirector")){
    function isDirector()
    {
        $user = user();
        return $user && $user->role === 'director';
    }
}

if(!function_exists("isFinance")){
    function isFinance()
    {
        $user = user();
        return $user && $user->role === 'finance';
    }
}

if(!function_exists("isCfo")){
    function isCfo()
    {
        $user = user();
        return $user && $user->role === 'cfo';
    }
}


if(!function_exists("isCeo")){
    function isCeo()
    {
        $user = user();
        return $user && $user->role === 'ceo';
    }
}