<?php
/* @var $this SpaceController */
/* @var $data Books */
?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img data-src="http://v3.bootcss.com/components/holder.js/300x300" alt="...">
      <div class="caption">
        <h3>Thumbnail label</h3>
		<p>
			<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
			<?php echo CHtml::link(CHtml::encode($data->name),array('home','id'=>$data->id)); ?>	
			<br />	
			
			<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
			<?php echo CHtml::encode($data->address); ?>
			<br />
		</p>
        <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
</div>