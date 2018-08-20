<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 艺品网络
// +----------------------------------------------------------------------
namespace app\admin\controller;
use app\admin\model\AuthGroup;

/**
 * 后台内容控制器
 * @author 艺品网络  <twothink.cn>
 */
class Rs extends Admin {

    /* 保存允许访问的公共方法 */
    static protected $allow = array( 'draftbox','mydocument');

    private $cate_id        =   null; //文档分类id

    public function index()
    {
        $list = \think\Db::name('rs')->order('id asc')->paginate(2);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {//post
            $repair = model('Rs');
            $post_data = \think\Request::instance()->post();
            //自动验证
            $validate = validate('rs');
            if (!$validate->check($post_data)) {
                return $this->error($validate->getError());
            }

            $data = $repair->create($post_data);
            if ($data) {
                $this->success('新增成功', url('index'));
                //记录行为
                action_log('update_sign', 'rs', $data->id, UID);
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
            $repair = \think\Db::name("rs");
            $data = $repair->update($postdata);
            if ($data !== false) {
                $this->success('编辑成功', url('index'));
            } else {
                $this->error('编辑失败');
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = \think\Db::name('rs')->find($id);
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
        if(\think\Db::name('rs')->where($map)->delete()){
            //记录行为
            action_log('update_rs', 'rs', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }


    /**
     * 文档编辑页面初始化
     * @author 艺品网络  <twothink.cn>
     */
    public function edit2(){
        //获取左边菜单
        $this->getMenu();

        $id     =   input('id','');
        if(empty($id)){
            $this->error('参数不能为空！');
        }
        $model_id = input('param.model',0);
        $cate_id =   input('param.cate_id',0);
        //获取模型信息
        if(empty($model_id) && !empty($cate_id)){
        	$model_id =   \think\Db::name('Category')->getFieldById($cate_id,'model');   // 当前分类支持的文档模型
        }
        $model = \think\Db::name('Model')->getById($model_id);

        //继承模型先实例化基础模型数据
        if($model['extend'] != 0){
        	$model_id = $model['extend'];
        }

        //获取基础模型数据
        if(!$jc_data       = logic($model_id)->detail($id)){
            $this->error('数据不存在');
        }
        //获取扩展模型数据
        if($jc_data['model_id']){
            $kz_data  = logic($jc_data['model_id'])->detail($id);
            $kz_data || $this->error('扩展数据不存在');
        }
        if($kz_data){
            $data = array_merge($jc_data, $kz_data);
        }else{
            $data = $jc_data;
        }
        if($data['pid']){
            // 获取上级文档
            $article        =   \think\Db::name(get_table_name($model_id))->field('id,,titletype')->find($data['pid']);
            $this->assign('article',$article);
        }

        // 获取当前的模型信息
        $model    =   get_document_model($data['model_id']);

        $this->assign('data', $data);
        $this->assign('model_id', $data['model_id']);
        $this->assign('model',      $model);

        //获取表单字段排序
        $fields = get_model_attribute($model['id']);
        $this->assign('fields',     $fields);
        //获取当前分类的文档类型
        $this->assign('type_list', get_type_bycate($data['category_id']));

        $this->assign('meta_title', '编辑文档');
        return $this->fetch();
    }

    /**
     * 更新一条数据
     * @author 艺品网络  <twothink.cn>
     */
    public function update(){
    	/* 获取数据对象 */
    	$model_id = input('param.model_id',0);
    	$data = input();
    	if(!$model_id)
    		$this->error('模型id不能为空');
    	//获取模型信息
    	$model = \think\Db::name('Model')->getById($model_id);
        if($model['extend']){
            //更新基础模型
            $logic = logic($model['extend']);
            $res_id = $logic->updates();
            $res_id || $this->error($logic->getError());
        }
        $update_id = '';
        if(empty($data['id']) && $model['extend'] != 0){
            $update_id = $res_id;
        }
        //更新当前模型
        $logic = logic($model['id']);
        $res = $logic->updates($update_id);
        $res || $this->error($logic->getError());
        $this->success(!empty($data['id'])?'更新成功':'新增成功', Cookie('__forward__'));
    }
}
