<?php

namespace app\home\controller;

use app\home\model\Document;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use think\Controller;
use EasyWeChat\Factory;
use think\Db;
use think\Model;
use think\migration\command\Seed;
use think\Session;

class Wechat extends Controller
{
    public function getConfig()
    {
        $config = [
            'app_id' => 'wxeedcd76523a9c7f5',
            'secret' => 'c515e8865e47a23d3e6243bd9d325e1c',
            'token' => 'twothink',
            'response_type' => 'array',

            'log' => [
                'level' => 'debug',
                'file' => '/www/wwwroot/twothink/runtime/log/wechat.log',
            ],
            'oauth' => [
                'scopes' => ['snsapi_base'],
                'callback' => url('home/wechat/callback','',true,true),
            ],
        ];
        return $config;
    }

    public function index()
    {
        $app = Factory::officialAccount($this->getConfig());

        $app->server->push(function ($message) {
            switch ($message['MsgType']) {
                case 'text':
                    if ($message['Content']=="接触绑定"){
                        $openId= $this->openid();
                        $user = \think\Db::name('twothink_ucenter_member')->where('openId',$openId)->field('openId')->find();
                        if ($user){
                            return '没有绑定微信';
                        }
                        $user = \think\Db::name('twothink_ucenter_member')->where('openId',$openId)->update('openId','');
                        return '微信已解除绑定';
                    }else{
                        return $message['Content'];
                    }
                    break;
                case 'image':
                    return '收到图片消息';
                    break;
                case 'event':
                    switch ($message['EventKey']) {
                        case 'V1001_GOOD':
                            /* 获取当前分类列表 */
                            $Document = new Document();
                            $list = $Document->lists(47);
                            $items = [];
                            foreach ($list as $val) {
                                $items[] = new NewsItem([
                                    'title' => $val['title'],
                                    'description' => $val['description'],
                                    'url' => 'http://twothink.dumf.vip/home/article/detail/id/'.$val['id'].'.html',
                                    'image' => 'http://www.twothink.com'.get_cover_path($val['cover_id']),
                                ]);
                            }
                            $news = new News($items);
                            return $news;
                            break;
                    }
                    break;
            }
            return "您好！欢迎使用 EasyWeChat!";
        });


        $response = $app->server->serve();

// 将响应输出
        $response->send(); // Laravel 里请使用：return $response;
    }

    //删除菜单
    public function deleteMenu()
    {
        $app = Factory::officialAccount($this->getConfig());
        $app->menu->delete();
        echo '删除菜单';
    }

    //设置菜单
    public function createMenu()
    {
        $app = Factory::officialAccount($this->getConfig());
        $buttons = [
            [
                "type" => "view",
                "name" => "个人中心",
                "url" => "http://twothink.dumf.vip"
            ],
            [
                "name" => "服务",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "首页",
                        "url" => "http://twothink.dumf.vip"
                    ],
                    [
                        "type" => "click",
                        "name" => "小区活动",
                        "key" => "V1001_GOOD"
                    ],
                    [
                        "type" => "view",
                        "name" => "小区通知",
                        "url" => "http://twothink.dumf.vip/home/article/lists/category/notion.html"
                    ],
                ],
            ],
            [
                "type" => "view",
                "name" => "物业管理系统",
                "url" => "http://twothink.dumf.vip/"
            ],
        ];
        $app->menu->create($buttons);
        echo "设置菜单";
    }

    //查看表单
    public function getMenu()
    {
        $app = Factory::officialAccount($this->getConfig());
        $list = $app->menu->list();


        /* 获取当前分类列表 */
        $Document = new Document();
            $list = $Document->lists(47);
        $items = [];
        foreach ($list as $val) {
            $items[] = new NewsItem([
                'title' => $val['title'],
                'description' => $val['description'],
                'url' => 'http://twothink.dumf.vip/home/article/detail/id/'.$val['id'].'.html',
                'image' => 'http://www.twothink.com'.get_cover_path($val['cover_id']),
            ]);
        }
        $news = new News($items);
//        return $news;
        var_dump($items);
    }
    //查找openId
    public function openid()
    {
        if (!Session::has('openid')){
            $app = Factory::officialAccount($this->getConfig());
            Session::get('return_url',url());
            $response = $app->oauth->scopes(['snsapi_base'])
                ->redirect()->send();
        }
        $openid=Session::get('openid');
        return $openid;
    }

    public function callback()
    {
        $app = Factory::officialAccount($this->getConfig());
        $user = $app->oauth->user();
        Session::set('openid',$user->getId());
        $this->redirect(Session::get('return_url'));
    }
}

