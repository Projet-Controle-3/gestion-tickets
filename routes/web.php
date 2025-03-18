<?php

use App\Http\Middleware\LocalizationMiddleware;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;





Route::middleware(LocalizationMiddleware::class)->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

});




/* -------------------------------------------------------------------------- */
/*                   Route pour changer la langue via l'URL                   */
/* -------------------------------------------------------------------------- */
Route::get('/locale/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return redirect()->back();
});



/* -------------------------------------------------------------------------- */
/*               Route pour changer la langue via un formulaire               */
/* -------------------------------------------------------------------------- */
Route::get('/locale', function (Request $request) {
    $lang = $request->query('lang');
    session(['lang' => $lang]);
    return redirect()->back();
});