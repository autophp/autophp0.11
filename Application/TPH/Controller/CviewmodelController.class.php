<?php
/**
 * Created by codegenerator.
 * User: xiaofeng
 * Date: 16/3/13
 * Time: 下午1:20
 */

namespace TPH\Controller;


use Think\Controller;

class CviewmodelController extends Controller
{
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
        else//执行视图模型生成器
        {
            $code = self::createViewModel(I('moduleName'), ucfirst(removeTablePrefix(I('tablename_a'))));
            //生成文件
            echo createViewModelFile(I('moduleName'), ucfirst(removeTablePrefix(I('tablename_a'))), $code, 'Model');
            die;
        }
    }

    public function get_table_column()
    {
        if(IS_POST)
        {
            $tablename = I('tablename');
            $result = M(removeTablePrefix($tablename))->getDbFields();
            $this->ajaxReturn($result);
        }
    }

    /**
     * 创建viewmodel的文本代码
     * @param $moduleName
     * @param $tableName
     * @return string
     */
    protected function createViewModel($moduleName, $tableName)
    {
        //获取表名
        $tablename_a = ucfirst(removeTablePrefix(I('tablename_a')));
        $tablename_b = ucfirst(removeTablePrefix(I('tablename_b')));

        //获取关联的字段:表a
        $tablename_a_fields = I('tablename_a_fields');
        $tablename_b_fields = I('tablename_b_fields');

        //获取关联的字段的alias:
        $tablename_a_fields_alias = I('tablename_a_fields_alias');
        $tablename_b_fields_alias = I('tablename_b_fields_alias');

        //后去关联的两个字段
        $tablename_a_relation_column = I('tablename_a_relation');
        $tablename_b_relation_column = I('tablename_b_relation');

        dump($tablename_a_fields);
        dump($tablename_b_fields);
        dump($tablename_a_fields_alias);
        dump($tablename_b_fields_alias);
        dump($tablename_a_relation_column);
        dump($tablename_b_relation_column);

        //获取关联的字段:表b

        $code = $this->get_namespace_code($moduleName);
        $code .= $this->get_use_code();
        $code .= $this->get_class_code($tableName);
        $content = $this->get_table_view_str($tablename_a, $tablename_b,
            $tablename_a_fields, $tablename_a_fields_alias,
            $tablename_b_fields, $tablename_b_fields_alias,
            $tablename_a_relation_column, $tablename_b_relation_column);

        $code .= $this->get_view_fields_code($content);
        $code .= $this->get_file_end_code();

        return $code;
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
        return '<?php' . "\r\n" . 'namespace ' . $moduleName . '\Model;' . "\r\n";
    }

    //获取use的code
    protected function get_use_code()
    {
        return 'use Think\Model\ViewModel;' . "\r\n";
    }

    //获取class的code
    protected function get_class_code($tableNameWithoutPrefix)
    {
        return 'class ' . $tableNameWithoutPrefix . 'ViewModel extends ViewModel{
        ' . "\r\n";
    }

    protected function get_view_fields_code($content)
    {
        return 'public $viewFields = array(' . $content . ');';
    }

    //获取数据库表名常量
    protected function get_const_code($tableName)
    {
        return 'const table_' . strtolower($tableName) . ' = ' . "'" . $tableName . "';\r\n";
    }

    //获取插入的字段名
    protected function get_viewfield_code($fieldStr)
    {
        if(is_array($fieldStr))
        {
            return "\r\n" . 'protected $insertFields =' . "'" . insertFieldsStr($fieldStr) . "';";
        }
        else
        {
            return "\r\n" . 'protected $insertFields =' . "'" . $fieldStr . "';";
        }
    }

    //获取文件的结束code
    protected function get_file_end_code()
    {
        return "\r\n" . '}' . "\r\n";
    }

    //获取表的关联字段字符串
    protected function get_table_view_str($tablename_a_name, $tablename_b_name,
                                          $tablename_a_fields, $tablename_a_fields_alias,
                                          $tablename_b_fields, $tablename_b_fields_alias,
                                          $table_a_realation_column_name, $table_b_relation_column_name)
    {
        $str_a = $this->get_viewmodel_alias_str($tablename_a_fields, $tablename_a_fields_alias);
        $str_b = $this->get_viewmodel_alias_str($tablename_b_fields, $tablename_b_fields_alias) . ',' .
            $this->get_viewmodel_on_str($tablename_a_name, $table_a_realation_column_name, $tablename_b_name, $table_b_relation_column_name);
        return "\r\n" . "'$tablename_a_name'=>array($str_a)," . "\r\n"
        . "'$tablename_b_name'=>array($str_b";
    }

    //获取视图模型关联的字符串
    protected function get_viewmodel_on_str($table_a, $table_a_realation_column_name, $table_b, $table_b_relation_column_name)
    {
        return "'_on'=>'$table_a.$table_a_realation_column_name=$table_b.$table_b_relation_column_name')" . ',' . "\r\n";
    }

    protected function get_viewmodel_alias_str($column_arr, $column_alias_arr)
    {
        $result = "";
        for ($i = 0; $i < count($column_alias_arr); $i++)
        {
            if($i + 1 < count($column_alias_arr))//不是数组中最后1个字段,+逗号
            {
                if(empty($column_alias_arr[$i]))
                {
                    $result .= "'" . $column_arr[$i] . "'" . ',';
                }
                else
                {
                    $result .= "'" . $column_arr[$i] . "'=>" . "'$column_alias_arr[$i]'" . ',';
                }
            }
            else//不是数组中最后1个字段,不+逗号
            {
                if(empty($column_alias_arr[$i]))
                {
                    $result .= "'" . $column_arr[$i] . "'";
                }
                else
                {
                    $result .= "'" . $column_arr[$i] . "'=>" . "'$column_alias_arr[$i]'";
                }
            }
        }
        return $result;
    }
}