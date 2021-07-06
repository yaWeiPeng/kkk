<?php

Route::controller('login','admin/login');					//登录

Route::controller('caption','admin/caption');				//模型管理

Route::controller('field','admin/field');					//字段管理

Route::controller('column','admin/column');					//栏目管理

Route::controller('user','admin/user');						//后台管理用户

Route::controller('permissions','admin/permissions');		//管理员等级

Route::controller('article','admin/article');				//文章管理

Route::controller('article_type','admin/articleType');		//文章类型

Route::controller('novel','admin/novel');					//小说

Route::controller('novelcategory','admin/novelcategory');	//小说分类

Route::controller('novelurl','admin/novelurl');				//小说网站

Route::controller('set','admin/set');						//设置

Route::controller('image','admin/image');						//图片选择器

//图片选择器
//Route::rule('image-plugin','admin/Image/index','GET|POST');
//Route::rule('images-uploads','admin/Image/imagesUploads','GET|POST');
//Route::rule('image-plugin-cate','admin/Image/imageCate','GET|POST');
//Route::rule('image-plugin-del','admin/Image/del','GET|POST');
//图片分类
//Route::rule('image-category-edit/:id','admin/ImageCategory/edit','GET|POST');

//Route::get('login','admin/login/login');
Route::rule('dologin','admin/Base/dologin','POST');
Route::rule('outlogin','admin/Base/outlogin','POST');
//校验token
Route::rule('checktoken','admin/Base/checktoken','POST');
//访问权限
Route::rule('visit-list','admin/visit/list','GET|POST');
Route::rule('visit-list-edit/:id','admin/visit/edit','GET|POST');
Route::rule('visit-category','admin/visit_category/list','GET|POST');
Route::rule('visit-category-edit/:id','admin/visit_category/edit','GET|POST');
//会员管理
Route::get('wuser','admin/Wuser/index');
Route::rule('wuser-edit/:id','admin/Wuser/edit','GET|POST');
//意见列表
Route::get('idea','admin/Idea/index');
Route::rule('idea-edit/:id','admin/Idea/edit','GET|POST');

//快递配置
Route::rule('kuaidi-config','admin/Kuaidi/config','GET|POST');
Route::rule('kuaidi-logistics','admin/Kuaidi/logistics','GET|POST');
Route::rule('kuaidi-list','admin/Kuaidi/clist','GET|POST');
Route::rule('kuaidi-list-detailed/:id','admin/Kuaidi/clist_detailed','GET|POST');
Route::rule('kuaidi-edit/:id','admin/Kuaidi/edit','GET|POST');
Route::rule('kuaidi-state','admin/Kuaidi/state','GET|POST');
//文档下载
Route::rule('kuaidi-f','admin/Kuaidi/f','GET|POST');


//手机验证码配置
Route::rule('yzm-config','admin/Yzm/config','GET|POST');
//文章管理
//Route::get('article','admin/Article/index');
Route::rule('article-edit/:id','admin/Article/edit','GET|POST');
Route::rule('article-state','admin/Article/state','GET|POST');
Route::get('article-type','admin/Article/type');
Route::rule('article-type-edit/:id','admin/Article/type_edit','GET|POST');
Route::rule('article-type-state','admin/Article/type_state','GET|POST');
//图片删除
Route::post('delfiles','admin/Base/delfiles');
//动态管理
Route::get('dynamic','admin/Dynamic/index');
Route::rule('dynamic-edit/:id','admin/Dynamic/edit','GET|POST');
Route::rule('dynamic-state','admin/Dynamic/state','GET|POST');
//动态举报信息管理

//小说管理
Route::rule('novel','admin/Novel/index','GET|POST');
Route::rule('novel-edit/:id','admin/Novel/edit','GET|POST');
Route::rule('novel-content/:id','admin/Novel/content','GET|POST');
Route::rule('novel-state','admin/Novel/state','GET|POST');
Route::rule('novel-cate','admin/Novel/cate','GET|POST');
Route::rule('get-novel-edit/:id','admin/Novel/novel_edit','GET|POST');
//小说分类
Route::rule('novel-category','admin/NovelCategory/index','GET|POST');
Route::rule('novel-category-state','admin/NovelCategory/state','GET|POST');
Route::rule('novel-category-edit/:id','admin/NovelCategory/edit','GET|POST');
Route::rule('novel-category-update/:id','admin/NovelCategory/update','GET|POST');
//城市
Route::get('region','admin/Region/list');
//音乐
Route::rule('music','admin/Music/index','GET|POST');
Route::rule('music-edit/:id','admin/Music/edit','GET|POST');
//百度语音合成
Route::rule('speech-config','admin/Speech/config','GET|POST');
//二维码
Route::rule('qrcode-config','admin/Qrcode/config','GET|POST');




//下面是模板
Route::get('admin','admin/admin/index');
Route::get('welcome','admin/admin/welcome');
Route::get('welcome1','admin/admin/welcome1');
Route::get('member-list','admin/admin/member_list');
Route::get('member-list1','admin/admin/member_list1');
Route::get('member-del','admin/admin/member_del');
Route::get('order-list','admin/admin/order_list');
Route::get('order-list1','admin/admin/order_list1');
Route::get('cate','admin/admin/cate');
Route::get('admin-list','admin/admin/admin_list');
Route::get('admin-role','admin/admin/admin_role');
Route::get('admin-cate','admin/admin/admin_cate');
Route::get('admin-rule','admin/admin/admin_rule');
Route::get('echarts1','admin/admin/echarts1');
Route::get('echarts2','admin/admin/echarts2');
Route::get('echarts3','admin/admin/echarts3');
Route::get('echarts4','admin/admin/echarts4');
Route::get('echarts5','admin/admin/echarts5');
Route::get('echarts6','admin/admin/echarts6');
Route::get('echarts7','admin/admin/echarts7');
Route::get('echarts8','admin/admin/echarts8');
Route::get('unicode','admin/admin/unicode');
//Route::get('login','admin/admin/login');
Route::get('error1','admin/admin/error1');
Route::get('demo','admin/admin/demo');
Route::get('log','admin/admin/log');
