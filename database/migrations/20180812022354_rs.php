<?php

use think\migration\Migrator;
use think\migration\db\Column;

class Rs extends Migrator
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
        $table = $this->table('RS', array('engine' => 'MyISAM'));
        $table->addColumn('logo', 'string', array('limit' => 255, 'default' => '', 'comment' => 'logo'))
            ->addColumn('title', 'string', array('limit' => 20, 'default' => '', 'comment' => '标题，必填'))
            ->addColumn('content', 'string', array('limit' => 500, 'default' => '', 'comment' => '描述,必填'))
            ->addColumn('price', 'string', array('limit' => 20, 'default' => '', 'comment' => '价格'))
            ->addColumn('create_time', 'integer', array('limit' => 100, 'default' => '0', 'comment' => '开始时间'))
            ->addColumn('update_time', 'integer', array('limit' => 100, 'default' => '0', 'comment' => '更新时间'))
            ->addColumn('deadline', 'integer', array('limit' => 100, 'default' => '0', 'comment' => '截止时间'))
            ->addColumn('status', 'integer', array('limit' => 1, 'default' => '0', 'comment' => '1是销售,0是出租'))
            ->create();
    }
}
