<?php
/* @var $this SpaceController */
/* @var $data Preparation */
?>

<div class="view_info">
	<?php //echo Gaokao::model()->getPaperLink($province,$model->course,$model->year); ?>				
	<h5><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <?php echo CHtml::link($data->file->name,array('space/view','id'=>$data->id));?></h5>
	<span class="item">
		科目：<?php echo Catalog::model()->getCourseName($data->catalog->course);?>
	</span>
	<span class="item">
		上传时间：<?php echo date('Y-m-d',$data->file->created);?>
	</span>
	<span class="item">
		<?php if(UtilAuth::isLogin($data->file->owner)):?>
			<a href="<?php echo $this->createUrl('space/view',array('id'=>$data->id));?>">查看</a> / 
			<a href="<?php echo $this->createUrl('space/delete',array('id'=>$data->id,'fid'=>$data->fid));?>" onclick="deletePaper($(this));return false;">删除</a>
		<?php endif;?>
	</span>
	<br />
	<span class="item">
		章节：<?php $breadcrumbs = Catalog::model()->generateBreadcrumbs($data->cid,$data->catalog->course); $category = new CategoryModel(); echo $category->generatePageTitle($breadcrumbs,true,' / ');?>
	</span>
	<hr />
</div>