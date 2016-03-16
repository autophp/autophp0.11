<?php
namespace Home\Model;
use Think\Model;
class Middlemoney_distribute_ratioModel extends Model{
        
const table_middlemoney_distribute_ratio = 'Middlemoney_distribute_ratio';

/***************************
*操作表:middlemoney_distribute_ratio:构造模型的header头
***************************/
protected $insertFields ='shop_id,background_url,default_head_url,qcode_left_margin,qcode_top_margin,qcode_height,qcode_width,head_left_margin,head_top_margin,head_height,head_width,fxb_yz_wechat_token,fxb_yz_wechat_url,my_income,one_grade_name,two_grade_name,virtual_middlemoney_name,scan_code_give,scan_code_middlemoney,scan_code_middlemoney_unit,trade_exchange_switch,fans_default_grade,first_trade_send_poster,one_trade_gain_middlemoney_threshold,trade_middlemony_calculate,middlemoney_exchange_money_days,gain_middlemoney_algorithm,config_update_dt,config_update_user_id';
protected $updateFields ='shop_id,background_url,default_head_url,qcode_left_margin,qcode_top_margin,qcode_height,qcode_width,head_left_margin,head_top_margin,head_height,head_width,fxb_yz_wechat_token,fxb_yz_wechat_url,my_income,one_grade_name,two_grade_name,virtual_middlemoney_name,scan_code_give,scan_code_middlemoney,scan_code_middlemoney_unit,trade_exchange_switch,fans_default_grade,first_trade_send_poster,one_trade_gain_middlemoney_threshold,trade_middlemony_calculate,middlemoney_exchange_money_days,gain_middlemoney_algorithm,config_update_dt,config_update_user_id';
/***************************
*操作表:middlemoney_distribute_ratio:增删改查
***************************/
public function create_middlemoney_distribute_ratio(){
        
 if($this->create())
        {
            return $this->add();
        }
        else
        {
            return false;
        }
}

public function update_middlemoney_distribute_ratio(){
        
 if($this->create())
        {
            return $this->save();
        }
        else
        {
            return false;
        }
}

public function get_middlemoney_distribute_ratio_list($order_fields,$p=1){
        
return $this->order("$order_fields money")->page($p, 15)->select();
}

public function is_has_target_middlemoney_distribute_ratio($con){
    
return $this->where($con)->find();
}
public function delete_middlemoney_distribute_ratio($con){
        
return $this->where($con)->delete();
}

/***************************
*操作表:middlemoney_distribute_ratio:增删改查
***************************/
/***************************
*操作表:middlemoney_distribute_ratio:统计总额,最大,最新,平均,总笔数
***************************/public function get_middlemoney_distribute_ratio_sum_money($con){
    
return $this->where($con)->sum("money");
}
public function get_middlemoney_distribute_ratio_min_money($con){
    
return $this->where($con)->min("money");
}
public function get_middlemoney_distribute_ratio_max_money($con){
    
return $this->where($con)->max("money");
}
public function get_middlemoney_distribute_ratio_avg_money($con){
    
return $this->where($con)->avg("money");
}
public function get_middlemoney_distribute_ratio_count($con){
return $this->where($con)->count();
}

/***************************
*操作表:middlemoney_distribute_ratio:统计总额,最大,最新,平均,总笔数
***************************/
/***************************
*操作表:middlemoney_distribute_ratio:增加/减少
***************************/public function inc_middlemoney_distribute_ratio_money($con,$val){
return $this->where($con)->setInc('money',$val);
}
public function dec_middlemoney_distribute_ratio_money($con,$val){
return $this->where($con)->setDec('money',$val);
}

/***************************
*操作表:middlemoney_distribute_ratio:增加/减少
***************************/
/***************************
*操作表:middlemoney_distribute_ratio:累计数值sum
***************************/
/***************************
*操作表:middlemoney_distribute_ratio:累计数值sum
***************************/
/***************************
*操作表:middlemoney_distribute_ratio:累计笔数count
***************************/
/***************************
*操作表:middlemoney_distribute_ratio:累计笔数count
***************************/
/***************************
*操作表:middlemoney_distribute_ratio:获取制定字段值/更新制定字段值
***************************/public function get_middlemoney_distribute_ratio_sex($con){
return $this->where($con)->getField("sex");
}
public function get_middlemoney_distribute_ratio_sex_change($con,$value){
$data=array("sex"=>$value);
return $this->where($con)->save($data);
}

/***************************
*操作表:middlemoney_distribute_ratio:获取制定字段值/更新制定字段值
***************************/
}