<?php if (!defined('THINK_PATH')) exit();?>'<?php echo ($className); ?>'  =>  array(
			'mapping_type'      =>  self::<?php echo ($mappingType); ?>,
			'class_name'        =>  '<?php echo ($className); ?>',
<?php if($mappingName != '' ): ?>　　　　　　　'mapping_name'      =>  '<?php echo ($mappingName); ?>',<?php endif; ?>

			'foreign_key'       =>  '<?php echo ($foreignKey); ?>',
<?php if($relationForeignKey != '' ): ?>　　　　　　　'relation_foreign_key'  =>  '<?php echo ($relationForeignKey); ?>',
			'relation_table'    =>  '<?php echo ($relationTable); ?>' //此处应显式定义中间表名称，且不能使用C函数读取表前缀<?php endif; ?>		
		),
		//@more