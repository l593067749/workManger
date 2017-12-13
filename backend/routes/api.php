<?php

use Illuminate\Http\Request;
use \Illuminate\Http\Response;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @api {get} /api/user 获取当前登陆的用户信息
 * @apiGroup login
 *
 *
 * @apiSuccessExample 信息获取成功
 * HTTP/1.1 200 OK
 *{
 * "data": {
 *    "id": 1,
 *    "name": "xxx",
 *    "email": "xxx@qq.com",
 *    "roles": "xxx", //角色: admin或者editor
 *    "avatar": ""
 *  },
 *  "status": "success",
 *  "status_code": 200
 *}
 */

Route::middleware('auth:api')->get('/user', function (Request $request)
{
    $user = $request->user();
    $roles = $user['role'];
    $data = [
        'id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'role' => array($user['role']),
        'avatar' => $user['avatar']
    ];
    return response()->json([
        'data' => $data,
        'status' => 'success',
        'status_code' => 200,
    ],200);
});
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');
Route::post('/token/refresh', 'Auth\LoginController@refresh');
Route::middleware('auth:api')->group(function() {

});
