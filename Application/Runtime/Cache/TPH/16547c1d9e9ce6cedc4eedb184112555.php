<?php if (!defined('THINK_PATH')) exit();?><!--视图关联数据表-->
<div class="form-group ">
<form id="viewColum">
<div class="col-md-11">
	<label class="control-label col-lg-3"><?php echo ($label); ?></label><br>
	<div class="col-lg-7" style="padding-left:30px;">                               
		<?php if(is_array($tableInfoList)): $i = 0; $__LIST__ = $tableInfoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><p>
			<input type="checkbox" name="<?php echo ($table[$columnNameKey]); ?>" value="<?php echo ($table[$columnNameKey]); ?>"><?php echo ($table[$columnNameKey]); ?></input>
			别名：<input align="right" id="as_<?php echo ($table[$columnNameKey]); ?>" type="text" />
			</p><?php endforeach; endif; else: echo "" ;endif; ?> 
	</div>
	
</div>
</form>
</div>