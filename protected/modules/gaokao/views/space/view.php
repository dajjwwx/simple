<?php
/* @var $this GaokaoController */
/* @var $model Gaokao */

$this->breadcrumbs=array(
	$this->module->t('gaokao','Gaokao')=>array('index'),	
	$model->year.'年'=>array('index','id'=>$model->year),
	Gaokao::model()->getCourseName($model->course)=>array('index','id'=>$model->year,'course'=>$model->course),
	CHtml::encode($model->file->name)
);

$this->menu=array(
	array('label'=>'List Gaokao', 'url'=>array('index')),
	array('label'=>'Create Gaokao', 'url'=>array('create')),
	array('label'=>'Update Gaokao', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Gaokao', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gaokao', 'url'=>array('admin')),
);
?>


<?php 

// echo $targetFile;
?>

<div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">试题简介</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">在线预览</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
    	<div class="view_info">
		<?php $this->renderPartial('view_info',array('model'=>$model)); ?>
		</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">    	
		<?php
			$this->widget('ext.pdfobject.PDFObjectWidget',array(
				'file'=>$targetFile,
			));
		?>
		
    </div>

  </div>

</div>

<script type="text/javascript">
$(function(){
	$(".nav-tabs>li:eq(1)").click(function(){
		if($(".nav-tabs > #fullscreen").length < 1){
			$('<li role="presentation" id="fullscreen"><a href="<?php echo Yii::app()->request->hostInfo.$this->createUrl('viewsingle',array('file'=>$targetFile)); ?>" aria-controls="fullscreen" role="tab"  data-toggle="tab">全屏预览</a></li>')
			.click(function(){
				location.href = $(this).find('a:eq(0)').attr('href');
			})
			.appendTo($(this).parent());
		}
		
	});
});
</script>