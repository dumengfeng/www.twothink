<?php

use think\migration\Migrator;
use think\migration\db\Column;

class SignUp extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('sign_up',array('engine'=>'InnoDb'));
        $table->addColumn('username', 'string',array('limit' => 15,'default'=>'','comment'=>'姓名，必填'))
            ->addColumn('phone', 'string',array('limit' => 32,'default'=>'','comment'=>'电话,必填'))
            ->addColumn('address', 'string',array('limit' => 50,'default'=>'','comment'=>'地址'))
            ->addColumn('title', 'string',array('limit' => 32,'default'=>'','comment'=>'标题'))
            ->addColumn('content', 'string',array('limit' => 100,'default'=>'','comment'=>'内容'))
            ->addColumn('create_time', 'date',array('limit' => 100,'default'=>'00-00-00 00:00:00','comment'=>'创建时间'))
            ->addColumn('update_time', 'date',array('limit' => 100,'default'=>'00-00-00 00:00:00','comment'=>'更新时间'))
            ->addIndex(array('username'), array('unique' => true))
            ->create();
    }
}
