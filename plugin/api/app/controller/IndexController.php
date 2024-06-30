<?php

namespace plugin\api\app\controller;

use app\model\Suan;
use support\Request;

/**
 * 
 */
class IndexController
{
    private $noNeedLogin = ['index'];

    public function index(Request $request)
    {
        // 随机取出一个跳
        $info = Suan::inRandomOrder()->first();
        return json($info);
    }
    // 获取全部的数据
    public function all(Request $request)
    {
        $info = Suan::all();
        return json($info);
    }
}
