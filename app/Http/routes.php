<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * 路有种输出视图
 */
Route::get('/', function () {
    return view('welcome');
});

/**
 * 基础路由
 */
Route::get('base',function(){
    return 'hello word!';
});
Route::post('base',function(){
    return 'hello word!';
});

/**
 * 多请求路由
 */
Route::match(['get','post'],'multy1',function(){
    return '多请求路由';
});

Route::any('multy2',function(){
    return '所有类型路由';
});

//路由参数
Route::get('user/{id}',function($id){
    return 'user-' . $id;
});

/**
 * 如果$name 不设默认值，那么访问缺少参数时会报错,有默认值时如果缺少参数会直接使用默认值
 */

Route::get('user/{name?}',function($name = null){
    return 'user-' . $name;
});

/**
 * 参数条件过滤，当ID的值为数字时通过。
 */
Route::get('user/{id}',function($id = null){
    return 'userid = ' . $id;
})->where('id','[0-9]+');

/**
 * 多参数条件过滤。
 */

Route::get('user/{id}/{name?}',function($id = null,$name = null){
    return 'userid = ' . $id . ' -name- ' . $name;
})->where(['id'=>'[0-9]+','name'=>'[A-Za-z]+']);

/**
 * 路由别名
 */
Route::get('user/center',['as' => 'center',function(){
    return route('center');
}]);

/**
 * 路由群组,'prefix' 前缀，比如访问下面的地址为：/member/user/center,/member/user/{id}
 */
//Route::group(['prefix' => 'member'],function(){
//
//    Route::get('user/center',['as' => 'center',function(){
//        return route('center');
//    }]);
//
//    Route::get('user/{id}',function($id){
//        return 'member-user-' . $id;
//    });
//});

//路由绑定控制器

Route::get('member/info',['uses' => 'MemberController@info']);
Route::get('member/query1',['uses' => 'MemberController@query1']);
Route::get('member/query2',['uses' => 'MemberController@query2']);
Route::get('member/muban',['uses' => 'MemberController@muban']);
Route::get('member/test',['uses' => 'MemberController@test']);
Route::get('member/reponse',['uses' => 'MemberController@reponse']);

Route::get('member/huodong',['uses' => 'MemberController@huodong']);

Route::group(['middleware' => ['huodong']],function(){
    Route::get('member/huodong1',['uses' => 'MemberController@huodong1']);
});


//添加中间件启动session
Route::group(['middleware' => ['web']], function () {

    Route::get('member/session1',['uses' => 'MemberController@session1']);

});







/**
 * 给绑定控制器的路由设定别名
 */
//Route::get('member/info',[
//    'uses'  =>  'MemberController@info',
//    'as'    =>  'memberinfo'
//]);
/**
 * 带参数
 */
//Route::get('member/{id}',['uses' => 'MemberController@info']);