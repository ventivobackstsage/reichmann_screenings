<?php

/* custom routes generated by CRUD */


Route::group(array('prefix' => 'admin/', 'middleware' => 'admin','as'=>'admin.'), function () {

Route::get('companies', ['as'=> 'companies.index', 'uses' => 'CompanyController@index']);
Route::post('companies', ['as'=> 'companies.store', 'uses' => 'CompanyController@store']);
Route::get('companies/create', ['as'=> 'companies.create', 'uses' => 'CompanyController@create']);
Route::put('companies/{companies}', ['as'=> 'companies.update', 'uses' => 'CompanyController@update']);
Route::patch('companies/{companies}', ['as'=> 'companies.update', 'uses' => 'CompanyController@update']);
Route::get('companies/{id}/delete', array('as' => 'companies.delete', 'uses' => 'CompanyController@getDelete'));
Route::get('companies/{id}/confirm-delete', array('as' => 'companies.confirm-delete', 'uses' => 'CompanyController@getModalDelete'));
Route::get('companies/{companies}', ['as'=> 'companies.show', 'uses' => 'CompanyController@show']);
Route::get('companies/{companies}/edit', ['as'=> 'companies.edit', 'uses' => 'CompanyController@edit']);

});


Route::group(array('prefix' => 'admin/', 'middleware' => 'admin','as'=>'admin.'), function () {

Route::get('candidates', ['as'=> 'candidates.index', 'uses' => 'CandidateController@index']);
Route::post('candidates', ['as'=> 'candidates.store', 'uses' => 'CandidateController@store']);
Route::get('candidates/create', ['as'=> 'candidates.create', 'uses' => 'CandidateController@create']);
Route::put('candidates/{candidates}', ['as'=> 'candidates.update', 'uses' => 'CandidateController@update']);
Route::patch('candidates/{candidates}', ['as'=> 'candidates.update', 'uses' => 'CandidateController@update']);
Route::get('candidates/{id}/delete', array('as' => 'candidates.delete', 'uses' => 'CandidateController@getDelete'));
Route::get('candidates/{id}/confirm-delete', array('as' => 'candidates.confirm-delete', 'uses' => 'CandidateController@getModalDelete'));
Route::get('candidates/{candidates}', ['as'=> 'candidates.show', 'uses' => 'CandidateController@show']);
Route::get('candidates/{candidates}/edit', ['as'=> 'candidates.edit', 'uses' => 'CandidateController@edit']);

});


Route::group(array('prefix' => 'admin/', 'middleware' => 'admin','as'=>'admin.'), function () {

Route::get('orders', ['as'=> 'orders.index', 'uses' => 'OrderController@index']);
Route::post('orders', ['as'=> 'orders.store', 'uses' => 'OrderController@store']);
Route::get('orders/create', ['as'=> 'orders.create', 'uses' => 'OrderController@create']);
Route::put('orders/{orders}', ['as'=> 'orders.update', 'uses' => 'OrderController@update']);
Route::patch('orders/{orders}', ['as'=> 'orders.update', 'uses' => 'OrderController@update']);
Route::get('orders/{id}/delete', array('as' => 'orders.delete', 'uses' => 'OrderController@getDelete'));
Route::get('orders/{id}/confirm-delete', array('as' => 'orders.confirm-delete', 'uses' => 'OrderController@getModalDelete'));
	Route::get('orders/{orders}', ['as'=> 'orders.show', 'uses' => 'OrderController@show']);
	Route::get('orders/{orders}/print', ['as'=> 'orders.print', 'uses' => 'OrderController@print']);
	Route::get('orders/{orders}/invoice', ['as'=> 'orders.invoice', 'uses' => 'OrderController@invoice']);
Route::get('orders/{orders}/edit', ['as'=> 'orders.edit', 'uses' => 'OrderController@edit']);

});


Route::group(array('prefix' => 'admin/', 'middleware' => 'admin','as'=>'admin.'), function () {

Route::get('education', ['as'=> 'education.index', 'uses' => 'EducationController@index']);
Route::post('education', ['as'=> 'education.store', 'uses' => 'EducationController@store']);
Route::get('education/create', ['as'=> 'education.create', 'uses' => 'EducationController@create']);
Route::put('education/{education}', ['as'=> 'education.update', 'uses' => 'EducationController@update']);
Route::patch('education/{education}', ['as'=> 'education.update', 'uses' => 'EducationController@update']);
Route::get('education/{id}/delete', array('as' => 'education.delete', 'uses' => 'EducationController@getDelete'));
Route::get('education/{id}/confirm-delete', array('as' => 'education.confirm-delete', 'uses' => 'EducationController@getModalDelete'));
Route::get('education/{education}', ['as'=> 'education.show', 'uses' => 'EducationController@show']);
Route::get('education/{education}/edit', ['as'=> 'education.edit', 'uses' => 'EducationController@edit']);

});


Route::group(array('prefix' => 'admin/', 'middleware' => 'admin','as'=>'admin.'), function () {

Route::get('certificates', ['as'=> 'certificates.index', 'uses' => 'CertificateController@index']);
Route::post('certificates', ['as'=> 'certificates.store', 'uses' => 'CertificateController@store']);
Route::get('certificates/create', ['as'=> 'certificates.create', 'uses' => 'CertificateController@create']);
Route::put('certificates/{certificates}', ['as'=> 'certificates.update', 'uses' => 'CertificateController@update']);
Route::patch('certificates/{certificates}', ['as'=> 'certificates.update', 'uses' => 'CertificateController@update']);
Route::get('certificates/{id}/delete', array('as' => 'certificates.delete', 'uses' => 'CertificateController@getDelete'));
Route::get('certificates/{id}/confirm-delete', array('as' => 'certificates.confirm-delete', 'uses' => 'CertificateController@getModalDelete'));
Route::get('certificates/{certificates}', ['as'=> 'certificates.show', 'uses' => 'CertificateController@show']);
Route::get('certificates/{certificates}/edit', ['as'=> 'certificates.edit', 'uses' => 'CertificateController@edit']);

});


Route::group(array('prefix' => 'admin/', 'middleware' => 'admin','as'=>'admin.'), function () {

Route::get('experiences', ['as'=> 'experiences.index', 'uses' => 'ExperienceController@index']);
Route::post('experiences', ['as'=> 'experiences.store', 'uses' => 'ExperienceController@store']);
Route::get('experiences/create', ['as'=> 'experiences.create', 'uses' => 'ExperienceController@create']);
Route::put('experiences/{experiences}', ['as'=> 'experiences.update', 'uses' => 'ExperienceController@update']);
Route::patch('experiences/{experiences}', ['as'=> 'experiences.update', 'uses' => 'ExperienceController@update']);
Route::get('experiences/{id}/delete', array('as' => 'experiences.delete', 'uses' => 'ExperienceController@getDelete'));
Route::get('experiences/{id}/confirm-delete', array('as' => 'experiences.confirm-delete', 'uses' => 'ExperienceController@getModalDelete'));
Route::get('experiences/{experiences}', ['as'=> 'experiences.show', 'uses' => 'ExperienceController@show']);
Route::get('experiences/{experiences}/edit', ['as'=> 'experiences.edit', 'uses' => 'ExperienceController@edit']);

});


	Route::group(array('prefix' => 'admin/', 'middleware' => 'admin','as'=>'admin.'), function () {

		Route::get('updates', ['as'=> 'updates.index', 'uses' => 'UpdateController@index']);
		Route::post('updates', ['as'=> 'updates.store', 'uses' => 'UpdateController@store']);
		Route::get('updates/create', ['as'=> 'updates.create', 'uses' => 'UpdateController@create']);
		Route::put('updates/{updates}', ['as'=> 'updates.update', 'uses' => 'UpdateController@update']);
		Route::patch('updates/{updates}', ['as'=> 'updates.update', 'uses' => 'UpdateController@update']);
		Route::get('updates/{id}/delete', array('as' => 'updates.delete', 'uses' => 'UpdateController@getDelete'));
		Route::get('updates/{id}/confirm-delete', array('as' => 'updates.confirm-delete', 'uses' => 'UpdateController@getModalDelete'));
		Route::get('updates/{updates}', ['as'=> 'updates.show', 'uses' => 'UpdateController@show']);
		Route::get('updates/{updates}/edit', ['as'=> 'updates.edit', 'uses' => 'UpdateController@edit']);

	});

	Route::group(array('prefix' => 'admin/', 'middleware' => 'admin','as'=>'admin.'), function () {

		Route::get('resume', ['as'=> 'resume.index', 'uses' => 'ResumeController@index']);

	});