<?php
/**
 * Created by autophp.
 * User: xiaofeng
 * Date: 16/3/13
 * Time: 下午2:57
 */

use Think\Model;

//获取模块名
function getModuleNameList()
{
    $ignoreList = Array("Common", "Runtime", "TPH");
    $allFileList = getDirList(APP_PATH);
    return array_diff($allFileList, $ignoreList);
}

//获取数据库的表名
function getTableNameList()
{
    $dbType = C('DB_TYPE');
    $Model = new Model(); // 实例化一个model对象 没有对应任何数据表
    if($dbType == 'mysql')
    {
        $dbName = C('DB_NAME');
        $result = Array();
        $tempArray = $Model->query("select table_name from information_schema.tables where table_schema='" . $dbName . "' and table_type='base table'");
        foreach ($tempArray as $temp)
        {
            $result[] = $temp['table_name'];
        }
        return $result;
    }
}


//去掉表名中的表头
function removeTablePrefix($tableNameWithPrefix)
{
    $DB_PREFIX = C('DB_PREFIX');
    $count = strlen($DB_PREFIX);
    return substr($tableNameWithPrefix, $count);
}

function getTableNameListWithoutPrefix()
{
    $dbType = C('DB_TYPE');
    $Model = new Model(); // 实例化一个model对象 没有对应任何数据表
    if($dbType == 'mysql')
    {
        $dbName = C('DB_NAME');
        $result = Array();
        $tempArray = $Model->query("select table_name from information_schema.tables where table_schema='" . $dbName . "' and table_type='base table'");
        foreach ($tempArray as $temp)
        {
            $result[] = $temp['table_name'];
        }
        return $result;
    }
}

//仅获取目录列表
function getDirList($directory)
{
    $files = array();
    try
    {
        $dir = new \DirectoryIterator($directory);
    } catch (Exception $e)
    {
        throw new Exception($directory . ' is not readable');
    }
    foreach ($dir as $file)
    {
        if($file->isDot())
        {
            continue;
        }
        if($file->isFile())
        {
            continue;
        }
        $files[] = $file->getFileName();
    }
    return $files;
}

/**
 * 获取指定表的所有信息,包括字段和类型等
 * @param $tableName
 * @return mixed
 */
function getTableInfoArray($tableName)
{
    $dbType = C('DB_TYPE');
    $Model = new Model(); // 实例化一个model对象 没有对应任何数据表
    if($dbType == 'mysql')
    {
        $dbName = C('DB_NAME');
        $result = $Model->query("select * from information_schema.columns where table_schema='" . $dbName . "' and table_name='" . $tableName . "'");
        return $result;
    }
}

/**
 * 生成文件
 * @param   string  | $moduleName
 * @param   string    $path
 * @param   string    $content
 * @param   string    $type | Model\ViewModel\
 */
function createFile($moduleName, $tableName, $content, $type = 'Model')
{
    $modelPath = APP_PATH . $moduleName . '/' . $type . '/';
    $code = htmlspecialchars_decode($content);
    file_put_contents($modelPath . ucfirst($tableName) . "Model.class.php", $code);
    return '生成成功，生成路径为：' . $modelPath . ucfirst($tableName) . "Model.class.php";
}

/**
 * 生成视图模型
 * @param        $moduleName
 * @param        $tableName
 * @param        $content
 * @param string $type
 * @return string
 */
function createViewModelFile($moduleName, $tableName, $content, $type = 'Model')
{
    $modelPath = APP_PATH . $moduleName . '/' . $type . '/';
    $code = htmlspecialchars_decode($content);
    file_put_contents($modelPath . ucfirst($tableName) . "ViewModel.class.php", $code);
    return '生成成功，生成路径为：' . $modelPath . ucfirst($tableName) . "ViewModel.class.php";
}

function createControllerFile($moduleName, $controller_name, $content)
{
    $modelPath = APP_PATH . $moduleName . '/' . 'Controller' . '/';
    $code = htmlspecialchars_decode($content);
    file_put_contents($modelPath . ucfirst(strtolower($controller_name)) . "Controller.class.php", $code);
    return '生成成功，生成路径为：' . $modelPath . ucfirst(strtolower($controller_name)) . "Controller.class.php";
}

//创建目录
function createDir()
{

}

//777加权限
function chmod_quanxian()
{

}

//是否已经存在文件了
function is_has_file()
{

}


/********
 *
 */
function insertFieldsStr($arr)
{
    $result = '';
    for ($i = 0; $i < count($arr); $i++)
    {
        if($i + 1 != count($arr))
        {
            $result .= $arr[$i] . ',';
        }
        else
        {
            $result .= $arr[$i];
        }
    }
    return $result;
}

function updateFieldsStr($arr)
{
    $result = '';
    for ($i = 0; $i < count($arr); $i++)
    {
        if($i + 1 != count($arr))
        {
            $result .= $arr[$i] . ',';
        }
        else
        {
            $result .= $arr[$i];
        }
    }
    return $result;
}

//数组转化成字符串[非json]
function arrToStr($arr)
{
    $str = 'array(';
    foreach ($arr as $key => $val)
    {
        if(is_int($val) || is_float($val))
        {
            $str .= "'" . $key . "'=>" . $val;
        }
        else
        {
            $str .= "'" . $key . "'=>" . "'" . $val . "'";
        }
    }
    return $str . ');';
}

//数组字段拼接成,格式字符串
function arrToStrWithComma()
{


}