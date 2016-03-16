<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>模型生成器</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<form action="<?php echo U('Cmodel/index');?>" method="post">
    <div class="col-xs-12">
        <label for="moduleName">选择模块</label>
        <select name="moduleName" id="moduleName">
            <?php if(is_array($moduleName)): foreach($moduleName as $key=>$vo): ?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
        </select>
        <br/>
        <label for="tablename">选择数据表</label>
        <select name="tablename" id="tablename">
            <?php if(is_array($modelName)): foreach($modelName as $key=>$vo): ?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
        </select>
        <br/>
        <div class="xs-col-6">
            <label for="sum_column">统计字段sum(多个用|分隔)</label>
            <br/>
            <select name="sum_column[]" id="sum_column" multiple=”multiple”>
                <option value="">不统计</option>
                <?php if(is_array($models)): foreach($models as $key=>$vo): ?><option value="<?php echo ($vo["column_name"]); ?>"><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <div class="xs-col-6">
            <label for="sum_date_column">统计字段sum的时间字段</label>
            <select name="sum_date_column" id="sum_date_column">
                <option value="">不统计</option>
                <?php if(is_array($models)): foreach($models as $key=>$vo): ?><option value="<?php echo ($vo["column_name"]); ?>"><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <div class="xs-col-6">
            <label for="count_column">统计字段count(多个用|分隔)</label>
            <Br/>
            <select name="count_column[]" id="count_column" multiple=”multiple”>
                <option value="">不统计</option>
                <?php if(is_array($models)): foreach($models as $key=>$vo): ?><option value="<?php echo ($vo["column_name"]); ?>"><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <label for="count_date_column">统计字段count的时间字段</label>
        <select name="count_date_column" id="count_date_column">
            <option value="">不统计</option>
            <?php if(is_array($models)): foreach($models as $key=>$vo): ?><option value="<?php echo ($vo["column_name"]); ?>"><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; ?>
        </select>
        <br/>
        <label for="status_column">状态字段值</label>
        <select name="status_column" id="status_column">
            <option value="">不统计</option>
            <?php if(is_array($models)): foreach($models as $key=>$vo): ?><option value="<?php echo ($vo["column_name"]); ?>"><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; ?>
        </select>
        <div class="xs-col-6">
            <label for="target_field_column">获取和设置指定字段</label>
            <br/>
            <select name="target_field_column" id="target_field_column" multiple>
                <option value="">不统计</option>
                <?php if(is_array($models)): foreach($models as $key=>$vo): ?><option value="<?php echo ($vo["column_name"]); ?>"><?php echo ($vo["column_name"]); ?></option><?php endforeach; endif; ?>
            </select>
        </div>
        <button type="button" onclick="getColume();">获取表字段</button>
    </div>
    <hr/>
    <div class="col-xs-6">
        <h4>允许插入的字段</h4>
        <table class="table">
            <thead>
            <tr>
                <th>字段名</th>
                <th>注释</th>
                <th>是否主键</th>
                <th>允许为空</th>
                <th>默认值</th>
                <th>类型</th>

                <th>选择</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($models)): foreach($models as $key=>$vo): ?><tr>
                    <td><?php echo ($vo["column_name"]); ?></td>
                    <td><?php echo ($vo["column_comment"]); ?></td>
                    <td><?php echo ($vo["column_key"]); ?></td>
                    <td><?php echo ($vo["is_nullable"]); ?></td>
                    <td><?php echo ($vo["column_default"]); ?></td>
                    <td><?php echo ($vo["column_type"]); ?></td>

                    <td>
                        <?php if($vo["column_key"] == PRI): ?><input type="checkbox" name="insert_fields[]" value="<?php echo ($vo["column_name"]); ?>"/>
                            <?php else: ?>
                            <input type="checkbox" name="insert_fields[]" value="<?php echo ($vo["column_name"]); ?>" checked/><?php endif; ?>
                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
    <div class="col-xs-6">
        <h4>允许更新的字段</h4>

        <table class="table">
            <thead>
            <tr>
                <th>字段名</th>
                <th>注释</th>
                <th>是否主键</th>
                <th>允许为空</th>
                <th>默认值</th>
                <th>类型</th>

                <th>选择</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($models)): foreach($models as $key=>$vo): ?><tr>
                    <td><?php echo ($vo["column_name"]); ?></td>
                    <td><?php echo ($vo["column_comment"]); ?></td>
                    <td><?php echo ($vo["column_key"]); ?></td>
                    <td><?php echo ($vo["is_nullable"]); ?></td>
                    <td><?php echo ($vo["column_default"]); ?></td>
                    <td><?php echo ($vo["column_type"]); ?></td>
                    <td>
                        <?php if($vo["column_key"] == PRI): ?><input type="checkbox" name="update_fields[]" value="<?php echo ($vo["column_name"]); ?>"/>
                            <?php else: ?>
                            <input type="checkbox" name="update_fields[]" value="<?php echo ($vo["column_name"]); ?>" checked/><?php endif; ?>

                    </td>
                </tr><?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>

    <h4>字段验证规则</h4>
    <h4>要生成的方法</h4>

    <select name="createFile">
        <option value="no">仅仅生成字符串</option>
        <option value="yes">生成文件</option>
    </select>
    <button type="submit" class="btn btn-danger">生成</button>
</form>

</body>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
    function getColume() {
        window.location.href = "<?php echo U('Cmodel/index');?>/model/" + document.getElementById('tablename').value;
    }
</script>
</html>