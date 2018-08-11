<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Repair extends Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $list = \think\Db::name('online_repair')->order('id asc')->paginate(2);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {//post
            $repair = model('repair');
            $post_data = \think\Request::instance()->post();
            //自动验证
            $validate = validate('repair');
            if (!$validate->check($post_data)) {
                return $this->error($validate->getError());
            }

            $data = $repair->create($post_data);
            if ($data) {
                $this->success('新增成功', url('index'));
                //记录行为
                action_log('update_channel', 'channel', $data->id, UID);
            } else {
                $this->error($repair->getError());
            }
        }
        $this->assign('info', null);
        return $this->fetch('edit');
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit($id = 0)
    {
        if ($this->request->isPost()) {
            $postdata = \think\Request::instance()->post();
            $repair = \think\Db::name("online_repair");
            $data = $repair->update($postdata);
            if ($data !== false) {
                $this->success('编辑成功', url('index'));
            } else {
                $this->error('编辑失败');
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = \think\Db::name('online_repair')->find($id);
            if (false === $info) {
                $this->error('获取配置信息错误');
            }
            $this->assign('info', $info);
            return $this->fetch();
        }
    }
    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function del()
    {
        $id = array_unique((array)input('id/a',0));
        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('id' => array('in', $id) );
        if(\think\Db::name('online_repair')->where($map)->delete()){
            //记录行为
            action_log('update_repair', 'repair', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}
