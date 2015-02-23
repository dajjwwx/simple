<?php
/* @var $this SpaceController */
/* @var $dataProvider CActiveDataProvider */

// $this->breadcrumbs=array(
// 	Yii::t('blog','Blogs'),
// );

$this->menu=array(
	array('label'=>'Create Blog', 'url'=>array('create')),
	array('label'=>'Manage Blog', 'url'=>array('admin')),
);
?>
<script type="text/javascript">
$(function(){
// 	var count = $(".timeline li.post-item").size();

	var count = <?php echo $pages->getItemCount() - $pages->getCurrentPage()*$pages->getPageSize();?>;

	console.log(count);

	$(".timeline li.post-item").each(function(index){

		var i = count - index;
		$(this).find(".number").text(i);
	});

	$(".blog-delete").click(function(){

//		alert($(this).attr("href"));

		object = $(this);

		$.post(object.attr("href"),{},function(data){
//			console.log(data);
			if(data.success){
				object.parent().parent().parent().fadeOut(2000);
			}
		},'json');

	});
	
});
</script>

		<ul class="timeline">
			<?php foreach($models as $model): ?>
			<?php $this->renderPartial('_view',array('data'=>$model))?>
			<?php endforeach; ?>		
		</ul>	
	
		<?php //echo Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.components.bootstrap.assets')).'/gridview/styles.css';	?>
		
		<?php $this->widget('CLinkPager', array(
		    'pages' => $pages,
			'selectedPageCssClass'=>'active',
			'maxButtonCount'=>10,
			'header'=>'',
			'htmlOptions'=>array(
				'class'=>'pagination pull-right',
				)
		)); ?>
