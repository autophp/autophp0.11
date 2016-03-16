<?php
/**
 * Created by autophp.
 * User: xiaofeng
 * Date: 16/3/15
 * Time: 下午2:24
 */

namespace TPH\Controller;


use Think\Controller;

class CcontrollerController extends Controller
{
    //创建model文件入口
    public function index()
    {
        if(IS_GET)
        {
            //获取模块名
            $this->assign('moduleName', getModuleNameList());
            //获取所有表的名字
            $tableNameList = getTableNameList();
            $this->assign('modelName', $tableNameList);
            //获取默认表的字段名和其他参数
            $default_model = I('model') ? I('model') : $tableNameList[0];

            $this->assign('models', getTableInfoArray($default_model));

            $this->display();
        }
        else
        {
            $moduleName = I('moduleName');
            $controller_name = I('controller_name');
            $tablename = I('tablename');
            $initialize = I('initialize');
            $tablename = I('tablename');


            self::createController($moduleName, $controller_name, $tablename);
        }
    }

    //执行创建model文件
    protected function createController($moduleName, $controller_name, $tableName)
    {
        $moduleName = ucfirst($moduleName);

        $tableName = strtolower($tableName);
        $className = ucfirst($tableName);

        $table_belong_module = I('table_belong_module');

        $code = $this->get_namespace_code($moduleName);
        $code .= $this->get_use_code($moduleName, $tableName);
        $code .= $this->get_class_code(ucfirst($controller_name));
        $code .= $this->get_list_code($tableName);
        $code .= $this->get_add_code($tableName);
        $code .= $this->get_update_code($tableName);
        $code .= $this->get_del_code($tableName);


        $code = $code . "\r\n" . '}';

//        dump($code);
//        die;

        echo createControllerFile($moduleName, $controller_name, $code);
    }

    protected function get_divider($tableName = '', $description = '')
    {
        if(!empty($tableName))
        {
            return "\r\n" . "/***************************" . "\r\n" . '*操作表:' . $tableName . ":$description" . "\r\n" . "***************************/";
        }
        else
        {
            return "\r\n" . "/***************************" . "\r\n" . '*' . $description . "\r\n" . "***************************/";
        }
    }

    //获取namespace的code
    protected function get_namespace_code($moduleName)
    {
        return '<?php' . "\r\n" . 'namespace ' . ucfirst(strtolower($moduleName)) . '\Controller;' . "\r\n";
    }

    //获取use的code
    protected function get_use_code($moduleName, $modelName)
    {
        $modelName = removeTablePrefix($modelName);
        $str = ucfirst(strtolower($moduleName));
        $str = $str . "\ " . 'Model';
        $str = str_replace(' ', '', $str);
        $str = $str . "\ " . ucfirst(strtolower($modelName)) . 'Model';
        $str = str_replace(' ', '', $str);

        return 'use Think\Controller;' . "\r\n"
        . "use " . $str . ';' . "\r\n";

    }

    //获取class的code
    protected function get_class_code($controller_name)
    {
        return 'class ' . ucfirst(strtolower($controller_name)) . 'Controller extends Controller{
        ' . "\r\n";
    }

    protected function get_private_database_code()
    {
        return "\r\n" . 'private $model;';
    }

    protected function get_initialize_code($tableName)
    {
        return "\r\n" . 'public function _initialize()
        {
            $this->model = new ' . $tableName . '();  }';
    }

    protected function get_add_code($tableName)
    {
        $tmp = strtolower(removeTablePrefix($tableName));
        $tableName = ucfirst(strtolower(removeTablePrefix($tableName))) . 'Model';

        return "\r\n" . 'public function add()
        {
            '
        . "\r\n" . 'if(IS_GET)
        {
            ' . '$this->display();' . '}
        else
        {
            '
        . "\r\n" .
        '$model = new ' . "$tableName();" .
        'return $model->create_' . $tmp . '();' . "\r\n" . '}'
        . "\r\n" . '}' . "\r\n";
    }

    protected function get_del_code($tableName)
    {
        $tmp = strtolower(removeTablePrefix($tableName));
        $tableName = ucfirst(strtolower(removeTablePrefix($tableName))) . 'Model';
        return "\r\n" . 'public function del()
        {
            '
        . "\r\n" . 'if(IS_POST | IS_AJAX)
        {' . '$model = new ' . "$tableName();" . '$con=array();' . "\r\n" . 'return $model->' . 'delete_' . "$tmp" . '($con);' . "\r\n" .
        '}' . "\r\n" . '}';
    }

    protected function get_update_code($tableName)
    {
        $tmp = strtolower(removeTablePrefix($tableName));
        $tableName = ucfirst(strtolower(removeTablePrefix($tableName))) . 'Model';
        return "\r\n" . 'public function update()
        {
            '
        . "\r\n" . 'if(IS_GET)
        {
            ' . '$this->display();' . '}
        else
        {
            '
        . "\r\n" .
        '$model = new ' . "$tableName();" .
        'return $model->update_' . $tmp . '();' . "\r\n" . '}'
        . "\r\n" . '}' . "\r\n";
    }

    protected function get_list_code($tableName)
    {
        $tmp = strtolower(removeTablePrefix($tableName));
        $tableName = ucfirst(strtolower(removeTablePrefix($tableName))) . 'Model';

        return "\r\n" . 'public function index(){ $model = new ' . $tableName . '();' .
        '$order_field = "";' . "\r\n" . '$this->assign("lists", $model->get_users_list($order_field));' .
        "\r\n" . '$this->display();' . '}';
    }

    protected function get_detail_code()
    {

    }
}