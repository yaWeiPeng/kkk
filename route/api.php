<?php
//二维码
Route::rule('qrcode','api/QrCode/getQrCode','GET|POST');
//百度语音合成
Route::rule('speech','api/Speech/getSpeech','GET|POST');
//拼音转换
Route::rule('pinyin','api/Pinyin/index','GET|POST');



//小程序api

//短信登录
Route::post('seed', 'api/v1.Seed/message');

//登录
Route::get('v-login', 'api/v1.Login/index');
//文章
Route::post('v-article', 'api/v1.Article/getone');
//快递
Route::post('v-kuaidi','api/v1.Kuaidi/alist');
Route::post('v-swuliu','api/v1.Kuaidi/swuliu');
//意见反馈
Route::post('v-idea','api/v1.Index/idea');
//动态
Route::post('v-dynamic','api/v1.Dynamic/alist');
Route::rule('v-dynamic-edit/:id','api/v1.Dynamic/edit','GET|POST');
Route::post('v-dynamic-dianzan','api/v1.Dynamic/dianzan');
//评论
Route::post('v-dynamic-pinglun','api/v1.Dynamic/pinglun');
//小说更新
Route::post('v-novel-novelupdate','api/v1.Novel/NovelUpdate');





