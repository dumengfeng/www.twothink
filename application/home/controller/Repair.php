<?php
namespace app\home\controller;


class Repair extends Home {
    //报修
    public function create()
    {
//        var_dump(request()->isPost());exit();
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
}
