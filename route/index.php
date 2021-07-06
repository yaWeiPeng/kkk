<?php

//小说列表
Route::get('chapter/:id', 'index/Index/chapter');
Route::get('chapter_content/:id/:nid', 'index/Index/content');
Route::get('content', 'index/Index/content');

//
Route::get('i-login', 'index/Login/login');
Route::get('i-reg', 'index/Login/reg');
Route::rule('i-sms', 'index/Login/seed','post|get');
Route::rule('i-doreg', 'index/Login/do_reg','post|get');
Route::rule('i-dologin', 'index/Login/do_login','post|get');
Route::rule('i-exit', 'index/Login/do_exit','post|get');

//收藏记录
//历史记录
Route::rule('i-history', 'index/IndexUser/history','post|get');



//测试
Route::post('v-novel-test','index/Base/novel');