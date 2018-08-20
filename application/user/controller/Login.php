<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2017 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 艺品网络 <http://www.twothink.cn>
// +----------------------------------------------------------------------

namespace app\user\controller;
use app\common\controller\UcApi;
use app\home\controller\Wechat;
use EasyWeChat\Factory;
use think\Controller;
use think\Cookie;
use think\Session;

/**
 * 用户登入
 * 包括用户登录及注册
 */
class Login extends Controller {
    public function __construct(){
        /* 读取站点配置 */
        $config = api('Config/lists');
        config($config); //添加配置
        parent::__construct();
    }
    /* 登录页面 */
    public function index($username = '', $password = '', $verify = '',$type = 1){
        if($this->request->isPost()){ //登录验证
            /* 检测验证码 */
            if(!captcha_check($verify)){
                $this->error('验证码输入错误！');
            }

            /* 调用UC登录接口登录 */
            $user = new UcApi;
            $uid = $user->login($username, $password, $type);

            if(0 < $uid){ //UC登录成功
                /* 登录用户 */
                $Member = model('Member');
                if($Member->login($uid)){ //登录用户
                    //TODO:跳转到登录前页面
                    if(!$cookie_url = Cookie::get('__forward__')){
                        $cookie_url = url('Home/Index/index');
                    }
                    $this->success('登录成功！',$cookie_url);
                } else {
                    $this->error($Member->getError());
                }

            } else { //登录失败
                switch($uid) {
                    case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
                    case -2: $error = '密码错误！'; break;
                    default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
                }
                $this->error($error);
            }

        } else { //显示登录表单
            return $this->fetch();
        }
    }

	/* 注册页面 */
	public function register($username = '', $password = '', $repassword = '', $email = '', $verify = ''){
        if(!config('user_allow_register')){
            $this->error('注册已关闭');
        }
		if($this->request->isPost()){ //注册用户
			/* 检测验证码 */
		   if(!captcha_check($verify)){
                $this->error('验证码输入错误！');
            }

			/* 检测密码 */
			if($password != $repassword){
				$this->error('密码和重复密码不一致！');
			}
            //取出微信号openID值
            $open = new Wechat();
            $open->openid();
            $openId = $this->openid();
			/* 调用注册接口注册用户 */
            $User = new UcApi;
			$uid = $User->register($username, $password, $email,$openId);
			if(0 < $uid){ //注册成功
				//TODO: 发送验证邮件
                $this->msg($openId,$username);
				$this->success('注册成功！',url('login/index'));
			} else { //注册失败，显示错误信息
				$this->error($uid);
			}

		} else { //显示注册表单
			return $this->fetch();
		}
	}

    //查找openId
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
                'callback' => url('user/login/callback','',true,true),
            ],
        ];
        return $config;
    }
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
    //消息推送
    public function msg($openId,$name)
    {
        $app = Factory::officialAccount($this->getConfig());
        $app->template_message->send([
            'touser' => $openId,
            'template_id' => '	2CUFoTISKlkRscw93zPqAJUf8lrvmuT23vKlLm-67bU',
            'url' => 'http://twothink.dumf.vip',
            'data' => [
                'name' => $name,
        ],
    ]);
    }
	/* 退出登录 */
	public function logout(){
		if(is_login()){
			model('Member')->logout();
			$this->success('退出成功！', url('User/login'));
		} else {
			$this->redirect('User/login');
		}
	}

}
