<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/testapi', "Controller@doPost");
Route::get('/demo/index', "DemoController@index");
Route::get('/import/importsubject', "ImportSubjectController@ImportSubject");

// 清除所有缓存
Route::get('/cache/clear', "CacheController@ClearCache");
// 清除对应key缓存
Route::get('/cache/clearkey/{key}', "CacheController@ClearKeyCache");

Route::get('/', "ExaminationController@ChooseExamination");

Route::get('/examination/examinationquestions', "ExaminationController@QuestionDetail");
Route::get('/examination/startexami', "ExaminationController@StartExami");
Route::get('/examination/videointerview', "ExaminationController@VideoInterView");
Route::get('/examination/userexaminationanswer', "ExaminationController@UserExaminationUnswer");
// 列表页
Route::get('/examination/chooseexamination', "ExaminationController@ChooseExamination");
Route::post('/examination/getexaminationsubjects', "ExaminationController@GetExaminationSubjects");
Route::post('/examination/adduserexaminationanswer', "ExaminationController@AddUserExaminationAnswer");
Route::post('/examination/getexaminationanswer', "ExaminationController@GetUserExaminationAnswer");
Route::post('/examination/getexaminationname', "ExaminationController@GetExaminationName");
// 测试查看所有题目
Route::get('/examination/allexaminationquestions', "ExaminationController@AllQuestionDetail");
// 测试页列表
Route::get('/examination/testchooseexamination', "ExaminationController@TestChooseExamination");
Route::post('/examination/getallexaminationsubjects', "ExaminationController@GetAllExaminationSubjects");
