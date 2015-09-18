
<?php 

// 	$list = require_once Yii::getPathOfAlias('administrator.config.menu').'.php';	
// 	$modules = Yii::app()->modules;	
// 	unset($modules['gii']);
// 	unset($modules['administrator']);
// 	foreach ($modules as $name=>$module)
// 	{
// 		$config =  Yii::getPathOfAlias($name.'.config.menu').'.php';		
// 		if (file_exists($config))
// 		 {
// 			$menu = require_once $config;			
// 			$list = CMap::mergeArray($list, $menu);
// 		}
// 	}
	
	$list = Config::mergeConfig('menu');

?>

<div class="panel-group" id="accordion">
<?php foreach ($list as $index=>$menu):?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $index;?>">
        	<?php echo $menu['menu'];?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $index; ?>" class="panel-collapse collapse <?php echo $this->id == $menu['id']?'in':'';?>">
      	<ul class="list-group">
	   <?php foreach ($menu['items'] as $item):?>
	   	  <?php if (is_string($item['link'])):?>
		  <li class="list-group-item"><?php echo CHtml::link($item['name'],array($item['link']));?></li>
		  <?php elseif (is_array($item['link'])):?>
		  <li class="list-group-item"><?php echo CHtml::link($item['name'],$item['link']);?></li>
		  <?php endif;?>
		<?php endforeach;?>
		</ul>
    </div>
  </div>
<?php endforeach;?>
</div>