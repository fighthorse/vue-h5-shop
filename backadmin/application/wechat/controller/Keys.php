<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/ThinkAdmin
// +----------------------------------------------------------------------

namespace app\wechat\controller;

use controller\BasicAdmin;
use service\DataService;
use service\WechatService;
use think\Db;

/**
 * 微信文章管理
 * Class Keys
 * @package app\wechat\controller
 * @author Anyon <zoujingli@qq.com>
 * @date 2017/03/27 14:43
 */
class Keys extends BasicAdmin
{

    /**
     * 指定当前数据表
     * @var string
     */
    public $table = 'WechatKeys';

    /**
     * 显示关键字列表
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function index()
    {
        $this->assign('title', '微信关键字');
        $db = Db::name($this->table)->whereNotIn('keys', ['subscribe', 'default']);
        return $this->_list($db->order('sort asc,id desc'));
    }

    /**
     * 列表数据处理
     * @param array $data
     */
    protected function _index_data_filter(&$data)
    {
        $types = [
            'keys'  => '关键字', 'image' => '图片', 'news' => '图文',
            'music' => '音乐', 'text' => '文字', 'video' => '视频', 'voice' => '语音',
        ];
        try {
            $wechat = WechatService::qrcode();
            foreach ($data as &$vo) {
                $result = $wechat->create($vo['keys']);
                $vo['qrc'] = $wechat->url($result['ticket']);
                $vo['type'] = isset($types[$vo['type']]) ? $types[$vo['type']] : $vo['type'];
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * 添加关键字
     * @return string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function add()
    {
        $this->title = '添加关键字规则';
        return $this->_form($this->table, 'form');
    }

    /**
     * 编辑关键字
     * @return string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function edit()
    {
        $this->title = '编辑关键字规则';
        return $this->_form($this->table, 'form');
    }


    /**
     * 删除关键字
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("关键字删除成功！", '');
        }
        $this->error("关键字删除失败，请稍候再试！");
    }

    /**
     * 关键字禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("关键字禁用成功！", '');
        }
        $this->error("关键字禁用失败，请稍候再试！");
    }

    /**
     * 关键字禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume()
    {
        if (DataService::update($this->table)) {
            $this->success("关键字启用成功！", '');
        }
        $this->error("关键字启用失败，请稍候再试！");
    }

    /**
     * 关注默认回复
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function subscribe()
    {
        $this->assign('title', '编辑默认回复');
        $extend = ['keys' => 'subscribe'];
        return $this->_form($this->table, 'form', 'keys', $extend, $extend);
    }


    /**
     * 无配置默认回复
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function defaults()
    {
        $this->assign('title', '编辑无配置默认回复');
        $extend = ['keys' => 'default'];
        return $this->_form($this->table, 'form', 'keys', $extend, $extend);
    }

    /**
     * 添加数据处理
     * @param array $data
     */
    protected function _form_filter(array &$data)
    {
        if ($this->request->isPost() && isset($data['keys'])) {
            $db = Db::name($this->table)->where('keys', $data['keys']);
            !empty($data['id']) && $db->where('id', 'neq', $data['id']);
            $db->count() > 0 && $this->error('关键字已经存在，请使用其它关键字！');
        }
    }

    /**
     * 编辑结果处理
     * @param $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            list($url, $keys) = ['', $this->request->post('keys')];
            if (!in_array($keys, ['subscribe', 'default'])) {
                $url = url('@admin') . '#' . url('wechat/keys/index') . '?spm=' . $this->request->get('spm');
            }
            $this->success('恭喜, 关键字保存成功!', $url);
        }
        $this->error('关键字保存失败, 请稍候再试!');
    }

}
