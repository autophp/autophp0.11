<?php if (!defined('THINK_PATH')) exit(); if(is_array($tableInfoList)): $i = 0; $__LIST__ = $tableInfoList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$table): $mod = ($i % 2 );++$i;?><option value="<?php echo ($table[$columnNameKey]); ?>" ><?php echo ($table[$columnNameKey]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>