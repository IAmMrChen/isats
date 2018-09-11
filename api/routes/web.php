<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
	$api->post('/import/importgroup', 'App\Http\Controllers\ImportSubjectController@ImportGroup');
	$api->post('/import/importsubject', 'App\Http\Controllers\ImportSubjectController@ImportSubject');

	/* examination start */
	$api->post('/examination/getexaminationsubjects', 'App\Http\Controllers\ExaminationController@GetExaminationSubjects');
	$api->post('/examination/adduserexaminationanswer', 'App\Http\Controllers\ExaminationController@AddUserExaminationAnswer');
	$api->post('/examination/getexaminationanswer', 'App\Http\Controllers\ExaminationController@GetUserExaminationAnswer');
	$api->post('/examination/getexaminationname', 'App\Http\Controllers\ExaminationController@GetExaminationName');
	// 测试
	$api->post('/examination/getallexaminationsubjects', 'App\Http\Controllers\ExaminationController@GetAllExaminationSubjects');
	/* examination end */
});
