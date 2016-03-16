<?php if (!defined('THINK_PATH')) exit();?>//由ThinkphpHelper自动生成,请根据需要修改
namespace <?php echo ($moduleName); ?>\Model;
use Think\Model\ViewModel;

class <?php echo ($modelName); ?>ViewModel extends ViewModel {
   public $viewFields = array(
	   '<?php echo ($modelName); ?>'=>array(<?php echo ($table1Field); ?>),
	   '<?php echo ($tableName); ?>'=>array(<?php echo ($table2Field); ?>, '_on'=>'<?php echo ($modelName); ?>.<?php echo ($viewModuleOn1); ?> = <?php echo ($tableName); ?>.<?php echo ($viewModuleOn2); ?>'<?php if($joinType != 'JOIN' ): ?>, '_type'=>'<?php echo ($joinType); ?>'<?php endif; ?>),
	   //@more
   ); 
}