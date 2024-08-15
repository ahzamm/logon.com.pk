<?php


use Illuminate\Support\Facades\Route;












Route::get('/site-components', 'Api\SiteComponentController@index');
Route::get('/home', 'Api\HomeController@index');
Route::get('/front-page/{slug}', 'Api\FrontPageController@index');
Route::get('/job-posts', 'Api\JobPostController@index');
Route::post('/job-application/{id}', 'Api\JobApplicationController@index');
Route::get('/contact', 'Api\ContactController@index');
Route::post('/contact', 'Api\ContactController@store');
Route::get('/faqs', 'Api\FaqController@index');


