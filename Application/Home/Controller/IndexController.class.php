<?php
namespace Home\Controller;

use Home\Model\Part_sole_configModel;
use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $Part_sole_config = new Part_sole_configModel();
//        $Part_sole_config->get_part_sole_config_list();
        dump($Part_sole_config->get_part_sole_config_list());
    }
}