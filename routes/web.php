<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

// Route pour l'affichage initiale des cotes boursière

Route::get('cotes_graphiques', 'GraphiquesController@index');
Route::get('home', 'GraphiquesController@index');
Route::post('recherche', 'GraphiquesController@recherche');

Auth::routes();

Route::get('login',function () {
    return view('auth.login');
});

Route::get('/password/request',function () {
    return view('auth.login');
});

Route::get('users/serverSide', [
    'as'   => 'users.serverSide',
    'uses' => function () {
        $anomalies = DB::table('bourse_stats.anomalies')
            ->select("jour","cote","type_anomalie","valeur")
            ->orderBy("jour","cote");
        return Datatables::of($anomalies)->make();
    }
]);

/*
Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'AutoCompleteController@index'));
Route::get('searchajax',array('as'=>'searchajax','uses'=>'AutoCompleteController@autoComplete'));
*/

