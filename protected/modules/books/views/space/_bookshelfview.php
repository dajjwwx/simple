<?php
/* @var $this SpaceController */
/* @var $data Books */
?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      	<?php $album = BookShelfInfo::model()->getBookShelfFolder($data->id);?>		
		<?php echo CHtml::image($album, '单击上传图片',array('onclick'=>'$(".caption").show();'));?>
				
      <div class="caption">
        <h3 style="text-align:center;"><?php echo CHtml::link(CHtml::encode($data->name),array('space/home','id'=>$data->id)); ?>	</h3>
        <hr />        
        <?php if ($data->info):?>        
        <p>
        	<b><?php echo CHtml::encode(Yii::t('books','Introduce'));?>:</b>
        	<?php echo $data->info->introduce;?>
        </p>
		<p>

			<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
			<?php echo CHtml::encode($data->address); ?>
			<br />
		</p>
		<?php else:?>
			<p>
				此书架还没装修哦~~
			</p>
		<?php endif;?>
      </div>
    </div>
</div>