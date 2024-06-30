<?php

namespace app\controller;

use app\model\RemoveLog;
use app\model\Suan;
use support\Db;
use support\Request;

class IndexController
{
    public function index(Request $request)
    {
        static $readme;
        if (!$readme) {
            $readme = file_get_contents(base_path('README.md'));
        }
        return $readme;
    }
    public function view(Request $request)
    {
        return view('index/view', ['name' => 'webman']);
    }

    public function json(Request $request)
    {
        // 随机去除一条数据
        $info = Suan::inRandomOrder()->first();
        return json($info);
    }
    // 统计数据
    public function check()
    {
        // 取出最后10w条数据
        $logs = RemoveLog::orderBy('id', 'desc')->where([['url','=','']])->limit(10000)->pluck('result');
        $result = [];
        foreach ($logs as $log) {
            $n=json_decode($log,true);
            if(empty($n)) continue;
            if(empty($n['pics'])) continue;
            $log=$n['pics'][0];
            $domain = explode('/', $log);
            if(count($domain) < 3) continue;
            $domain = $domain[2];
            if (isset($result[$domain])) {
                $result[$domain]++;
            }else{
                $result[$domain] = 1;
            }
        }
        return json($result);
    }

}
