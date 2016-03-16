<?php
namespace Home\Controller;

use Think\Controller;
use Home\Model\UsersModel;

class UsersController extends Controller
{


    public function index()
    {
        $model = new UsersModel();
        $order_field = "ctime";
        $this->assign("lists", $model->get_users_list($order_field));

        $this->display();
    }

    public function add()
    {

        if(IS_GET)
        {
            $this->display();
        }
        else
        {

            $model = new UsersModel();
            return $model->create_users();
        }
    }

    public function update()
    {

        if(IS_GET)
        {
            $this->display();
        }
        else
        {

            $model = new UsersModel();
            return $model->update_users();
        }
    }

    public function del()
    {

        if(IS_POST | IS_AJAX)
        {
            $model = new UsersModel();
            $con = array();
            return $model->delete_users($con);
        }
    }
}