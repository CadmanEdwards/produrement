<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});


Route::get('/users', function () {
    return \App\User::all();
});


// Route::middleware('throttle:3,100')->group(function () {
//     Route::get('/users', function () {
//         return \App\User::all();
//     });
// });