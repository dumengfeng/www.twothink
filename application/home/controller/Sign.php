<?php

namespace app\home\controller;

use app\common\controller\UcApi;
use think\Db;
use think\Request;
use app\home\model\Document;
use think\Session;

/**
 * 文档模型控制器
 * 文档模型列表和详情
 */
class Sign extends Home
{
    public function create($uid = 1, $sid = 1)
    {
        $Sign = model('Sign');
        $id = \think\Request::instance()->post();
        $Document = new Document();
        $info = $Document->detail($id['sid']);
        $Api = new UcApi();
        $username = $Api->info($id['uid'])[1];
        $post_data['user_id'] = $id['uid'];
        $post_data['title'] = $info['title'];
        $post_data['content'] = $info['content'];
        $post_data['create_time'] = time();
        $post_data['update_time'] = '0';
//        var_dump($post_data);exit();
        //自动验证
        $validate = validate('sign');
        if (!$validate->check($post_data)) {
            return $this->error($validate->getError());
        }
        $data = $Sign->create($post_data);
        if ($data) {
            $this->success('新增成功', url('index'));
            //记录行为
            action_log('update_sign', 'sign', $data->id, UID);
        }
    }
}
