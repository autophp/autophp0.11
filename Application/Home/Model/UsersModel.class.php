<?php
namespace Home\Model;

use Think\Model;

class UsersModel extends Model
{

    const table_users = 'Users';

    /***************************
     *操作表:users:构造模型的header头
     ***************************/
    protected $insertFields = 'username,password,ip,age,sex,money,ctime,address,description,headimgurl';
    protected $updateFields = 'username,password,ip,age,sex,money,ctime,address,description,headimgurl';

    /***************************
     *操作表:users:增删改查
     ***************************/
    public function create_users()
    {

        if($this->create())
        {
            return $this->add();
        }
        else
        {
            return false;
        }
    }

    public function update_users()
    {

        if($this->create())
        {
            return $this->save();
        }
        else
        {
            return false;
        }
    }

    public function get_users_list($order_fields, $p = 1)
    {

        return $this->order($order_fields . " DESC")->page($p, 15)->select();
    }

    public function is_has_target_users($con)
    {

        return $this->where($con)->find();
    }

    public function delete_users($con)
    {

        return $this->where($con)->delete();
    }

    /***************************
     *操作表:users:增删改查
     ***************************/
    /***************************
     *操作表:users:统计总额,最大,最新,平均,总笔数
     ***************************/
    public function get_users_sum_money($con)
    {

        return $this->where($con)->sum("money");
    }

    public function get_users_min_money($con)
    {

        return $this->where($con)->min("money");
    }

    public function get_users_max_money($con)
    {

        return $this->where($con)->max("money");
    }

    public function get_users_avg_money($con)
    {

        return $this->where($con)->avg("money");
    }

    public function get_users_count($con)
    {
        return $this->where($con)->count();
    }

    /***************************
     *操作表:users:统计总额,最大,最新,平均,总笔数
     ***************************/
    /***************************
     *操作表:users:增加/减少
     ***************************/
    public function inc_users_money($con, $val)
    {
        return $this->where($con)->setInc('money', $val);
    }

    public function dec_users_money($con, $val)
    {
        return $this->where($con)->setDec('money', $val);
    }

    /***************************
     *操作表:users:增加/减少
     ***************************/
    /***************************
     *操作表:users:累计数值sum
     ***************************/
    /***************************
     *操作表:users:累计数值sum
     ***************************/
    /***************************
     *操作表:users:累计笔数count
     ***************************/
    /***************************
     *操作表:users:累计笔数count
     ***************************/
    /***************************
     *操作表:users:获取制定字段值/更新制定字段值
     ***************************/
    public function get_users_sex($con)
    {
        return $this->where($con)->getField("sex");
    }

    public function get_users_sex_change($con, $value)
    {
        $data = array("sex" => $value);
        return $this->where($con)->save($data);
    }

    /***************************
     *操作表:users:获取制定字段值/更新制定字段值
     ***************************/
}