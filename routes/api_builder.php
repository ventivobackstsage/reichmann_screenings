<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where all API routes are defined.
|
*/





Route::get('admin/orders', 'OrderAPIController@index');
Route::post('admin/orders', 'OrderAPIController@store');
Route::get('admin/orders/{orders}', 'OrderAPIController@show');
Route::put('admin/orders/{orders}', 'OrderAPIController@update');
Route::patch('admin/orders/{orders}', 'OrderAPIController@update');
Route::delete('admin/orders{orders}', 'OrderAPIController@destroy');

Route::get('admin/education', 'EducationAPIController@index');
Route::post('admin/education', 'EducationAPIController@store');
Route::get('admin/education/{education}', 'EducationAPIController@show');
Route::put('admin/education/{education}', 'EducationAPIController@update');
Route::patch('admin/education/{education}', 'EducationAPIController@update');
Route::delete('admin/education{education}', 'EducationAPIController@destroy');

Route::get('admin/certificates', 'CertificateAPIController@index');
Route::post('admin/certificates', 'CertificateAPIController@store');
Route::get('admin/certificates/{certificates}', 'CertificateAPIController@show');
Route::put('admin/certificates/{certificates}', 'CertificateAPIController@update');
Route::patch('admin/certificates/{certificates}', 'CertificateAPIController@update');
Route::delete('admin/certificates{certificates}', 'CertificateAPIController@destroy');

Route::get('admin/experiences', 'ExperienceAPIController@index');
Route::post('admin/experiences', 'ExperienceAPIController@store');
Route::get('admin/experiences/{experiences}', 'ExperienceAPIController@show');
Route::put('admin/experiences/{experiences}', 'ExperienceAPIController@update');
Route::patch('admin/experiences/{experiences}', 'ExperienceAPIController@update');
Route::delete('admin/experiences{experiences}', 'ExperienceAPIController@destroy');

Route::get('admin/updates', 'UpdateAPIController@index');
Route::post('admin/updates', 'UpdateAPIController@store');
Route::get('admin/updates/{updates}', 'UpdateAPIController@show');
Route::put('admin/updates/{updates}', 'UpdateAPIController@update');
Route::patch('admin/updates/{updates}', 'UpdateAPIController@update');
Route::delete('admin/updates{updates}', 'UpdateAPIController@destroy');