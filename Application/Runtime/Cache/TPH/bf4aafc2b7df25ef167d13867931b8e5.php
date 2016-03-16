<?php if (!defined('THINK_PATH')) exit();?><!--关联模型表字段信息-->
<div class="form-group">
<form>
<div class="col-md-6">
	<label class="control-label col-lg-3"><?php echo ($label); ?></label><br>
	<div class="col-lg-7" style="padding-left:30px;">                               
		<?php if(is_array($tableInfoList)): $i = 0; $__LIST__ = $tableInfoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><input type="radio" name="foreignKey" value="<?php echo ($table[$columnNameKey]); ?>"><?php echo ($table[$columnNameKey]); ?></input><br><?php endforeach; endif; else: echo "" ;endif; ?> 
	</div>
</div>
</form>
</div>