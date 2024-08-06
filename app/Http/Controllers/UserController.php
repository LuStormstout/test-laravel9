<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 处理显示用户信息的逻辑
    public function show($id): string
    {
        return "显示用户信息：".$id;
    }

    public function login()
    {
        $account = request('account');
        $password = request('password');

        $user = new User();

        if ($user->login($account, $password)) {
            return '登录成功';
        } else {
            return '登录失败';
        }
    }
}
