<?php
/**
 * 后台菜单配置
 *    'home' => [
 *       'name' => '首页',                // 菜单名称
 *       'icon' => 'icon-home',          // 图标 (class)
 *       'url' => 'index/index',         // 链接
 * 	 	 'submenu' => [] 			//下级栏目
 *		 'uris'=>[]//权限
 *     ],
 */
namespace app\admin\extra;

class menus{
	public static function menu(){
		return [
			'x_user' => [
				'name' => '会员管理',
				'icon' => 'xe6b8;',
				'submenu' => [
					[
						'name' => '统计页面',
						'icon' => 'xe6a7;',
						'url' => '/welcome1',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '会员列表(静态表格)',
						'icon' => 'xe6a7;',
						'url' => '/member-list',
						'refresh'=> true
					],
					[
						'name' => '会员列表(动态表格)',
						'icon' => 'xe6a7;',
						'url' => '/member-list1',
						'refresh'=> true
					],
					[
						'name' => '会员删除',
						'icon' => 'xe6a7;',
						'url' => '/member-del',
						'refresh'=> true
					],
					[
						'name' => '会员管理',
						'icon' => 'xe70b;',
						'submenu' => [
							[
								'name' => '会员删除',
								'icon' => 'xe6a7;',
								'url' => '/member-del',
								'refresh'=> true
							],
							[
								'name' => '等级管理',
								'icon' => 'xe6a7;',
								'url' => '/member-list1',
								'refresh'=> true
							],
						],
					],
				],
			],
			'x_order' => [
				'name' => '订单管理',
				'icon' => 'xe723;',
				'submenu' => [
					[
						'name' => '订单列表',
						'icon' => 'xe6a7;',
						'url' => '/order-list',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '订单列表1',
						'icon' => 'xe6a7;',
						'url' => '/order-list1',
						'refresh'=> true
					],
				],
			],
			'x_category' => [
				'name' => '分类管理',
				'icon' => 'xe723;',
				'submenu' => [
					[
						'name' => '多级分类',
						'icon' => 'xe6a7;',
						'url' => '/cate',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'x_administrator' => [
				'name' => '管理员管理',
				'icon' => 'xe726;',
				'submenu' => [
					[
						'name' => '管理员列表',
						'icon' => 'xe6a7;',
						'url' => '/admin-list',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '角色管理',
						'icon' => 'xe6a7;',
						'url' => '/admin-role',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '权限分类',
						'icon' => 'xe6a7;',
						'url' => '/admin-cate',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'x_system' => [
				'name' => '系统统计',
				'icon' => 'xe6ce;',
				'submenu' => [
					[
						'name' => '拆线图',
						'icon' => 'xe6a7;',
						'url' => '/echarts1',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '交错正负',
						'icon' => 'xe6a7;',
						'url' => '/echarts2',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '地图',
						'icon' => 'xe6a7;',
						'url' => '/echarts3',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '饼图',
						'icon' => 'xe6a7;',
						'url' => '/echarts4',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '雷达图',
						'icon' => 'xe6a7;',
						'url' => '/echarts5',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => 'k线图',
						'icon' => 'xe6a7;',
						'url' => '/echarts6',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '热力图',
						'icon' => 'xe6a7;',
						'url' => '/echarts7',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '仪表图',
						'icon' => 'xe6a7;',
						'url' => '/echarts8',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'x_icon' => [
				'name' => '图标字体',
				'icon' => 'xe6b4;',
				'submenu' => [
					[
						'name' => '图标对应字体',
						'icon' => 'xe6a7;',
						'url' => '/unicode',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'x_page' => [
				'name' => '其它页面',
				'icon' => 'xe6b4;',
				'submenu' => [
					[
						'name' => '登录页面',
						'icon' => 'xe6a7;',
						'url' => '/login',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '错误页面',
						'icon' => 'xe6a7;',
						'url' => '/error1',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '示例页面',
						'icon' => 'xe6a7;',
						'url' => '/demo',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '更新日志',
						'icon' => 'xe6a7;',
						'url' => '/log',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'x_plugin' => [
				'name' => 'layui第三方组件',
				'icon' => 'xe6b4;',
				'submenu' => [
					[
						'name' => '滑块验证',
						'icon' => 'xe6a7;',
						'url' => 'https://fly.layui.com/extend/sliderVerify/',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '富文本编辑器',
						'icon' => 'xe6a7;',
						'url' => 'https://fly.layui.com/extend/layedit/',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => 'eleTree 树组件',
						'icon' => 'xe6a7;',
						'url' => 'https://fly.layui.com/extend/eleTree/',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '图片截取',
						'icon' => 'xe6a7;',
						'url' => 'https://fly.layui.com/extend/croppers/',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => 'formSelects 4.x 多选框',
						'icon' => 'xe6a7;',
						'url' => 'https://fly.layui.com/extend/formSelects/',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => 'Magnifier 放大镜',
						'icon' => 'xe6a7;',
						'url' => 'https://fly.layui.com/extend/Magnifier/',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => 'notice 通知控件',
						'icon' => 'xe6a7;',
						'url' => 'https://fly.layui.com/extend/notice/',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'admin_user' => [
				'name' => '管理员管理',
				'icon' => 'xe6b8;',
				'submenu' => [
					[
						'name' => '管理员列表',
						'icon' => 'xe6a7;',
						'url' => '/user',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'visit' => [
				'name' => '访问管理',
				'icon' => 'xe6b8;',
				'submenu' => [
					[
						'name' => '角色列表',
						'icon' => 'xe6a7;',
						'url' => '/permissions',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '控制列表',
						'icon' => 'xe6a7;',
						'url' => '/visit-list',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '分类',
						'icon' => 'xe6a7;',
						'url' => '/visit-category',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'user' => [
				'name' => '会员管理',
				'icon' => 'xe6b8;',
				'submenu' => [
					[
						'name' => '会员列表',
						'icon' => 'xe6a7;',
						'url' => '/wuser',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '意见列表',
						'icon' => 'xe6a7;',
						'url' => '/idea',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'region' => [
				'name' => '城市联动',
				'icon' => 'xe723;',
				'submenu' => [
					[
						'name' => '三级地区联动',
						'icon' => 'xe6a7;',
						'url' => '/region',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'article' => [
				'name' => '文章管理',
				'icon' => 'xe6fc;',
				'submenu' => [
					[
						'name' => '文章列表',
						'icon' => 'xe6a7;',
						'url' => '/article',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '文章类型',
						'icon' => 'xe6a7;',
						'url' => '/article-type',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'dynamic' => [
				'name' => '动态管理',
				'icon' => 'xe6fc;',
				'submenu' => [
					[
						'name' => '动态列表',
						'icon' => 'xe6a7;',
						'url' => '/dynamic',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '举报列表',
						'icon' => 'xe6a7;',
						'url' => '/dynamic-report',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'novel' => [
				'name' => '小说管理',
				'icon' => 'xe6fc;',
				'submenu' => [
					[
						'name' => '小说列表',
						'icon' => 'xe6a7;',
						'url' => '/novel',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '小说分类',
						'icon' => 'xe6a7;',
						'url' => '/novel-category',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'music' => [
				'name' => '音乐管理',
				'icon' => 'xe6fc;',
				'submenu' => [
					[
						'name' => '音乐列表',
						'icon' => 'xe6a7;',
						'url' => '/music',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '音乐分类',
						'icon' => 'xe6a7;',
						'url' => '/music-category',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'plugins' => [
				'name' => '插件',
				'icon' => 'xe760;',
				'submenu' => [
					[
						'name' => '二维码',
						'icon' => 'xe6a7;',
						'url' => '/qrcode-config',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '短信验证码',
						'icon' => 'xe6a7;',
						'url' => '/yzm-config',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
					[
						'name' => '百度语音合成',
						'icon' => 'xe6a7;',
						'url' => '/speech-config',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
			'setting' => [
				'name' => '设置',
				'icon' => 'xe6ae;',
				'submenu' => [
					[
						'name' => '快递鸟',
						'icon' => 'xe698;',
						'submenu' => [
							[
								'name' => '快递鸟配置',
								'icon' => 'xe6a7;',
								'url' => '/kuaidi-config',
								'refresh'=> true  //点击刷新 true为刷新，false不刷新
							],
							[
								'name' => '物流服务商',
								'icon' => 'xe6a7;',
								'url' => '/kuaidi-logistics',
								'refresh'=> true  //点击刷新 true为刷新，false不刷新
							],
							[
								'name' => '用户查询记录',
								'icon' => 'xe6a7;',
								'url' => '/kuaidi-list',
								'refresh'=> true  //点击刷新 true为刷新，false不刷新
							],
						],
					],
					[
						'name' => '全局设置',
						'icon' => 'xe6ae;',
						'url' => '/set/index',
						'refresh'=> true  //点击刷新 true为刷新，false不刷新
					],
				],
			],
		];
	}
	
	//最多3级分类.位置
	public static function position($url=''){
	    $menu = static::menu();
	    dump($menu);
	}
}
