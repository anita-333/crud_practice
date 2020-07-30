<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/**
 * use 表引用其他類別
 * use  引用對象的 namespace '左斜線'  引用對象的類別名稱
 */
use app\Model\User;

class UserController extends Controller
{
    //
//    public function getUsers()
//    {
//        $data = [
//            'id' => 1,
//            'name' => 'Leon',
//            'email' => 'jfsdjfdsj@gmail.com',
//            'password' => '1234',
//        ];
//
//        return $data;
//    }
//
//    public function addUser()
//    {
//        dd('新增會員');
//    }

    public function index(Request $request)
    {

    }

    public function store(Request $request)
    {

    }

//    public function create()
//    {
//
//    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy(Request $request, $id)
    {

    }

//    public function edit()
//    {
//
//    }
}
