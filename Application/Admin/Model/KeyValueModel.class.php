<?php

namespace Admin\Model;

use Think\Model;

/**
 * 键值对
 * @author Administrator
 *
 */
class KeyValueModel extends Model {
    protected $tableName = 'cms_key_value';
    /*
     *网站信息->sitesInfo 
     */
    
    /**
     * 保存
     * @param string $key 键
     * @param string $value 值
     * @return boolean 失败false
     */
    function saveM($key,$value){
        $where['key']=$key;
        if(!$this->where($where)->find()){
            //不存在则添加
            $data['key']=$key;
            $data['value']=$value;
            return $this->add($data);
        }
        else{
            //存在则修改
            return $this->where($where)->setField('value',$value);
        }
    }
    
    /**
     * 根据键获取值
     * @param string $key 键
     */
    function getValue($key){
        $where['key']=$key;
        return $this->where($where)->getField('value');
    }
}
