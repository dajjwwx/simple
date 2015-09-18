<?php
/* @var $this SpaceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('blog','Blogs')=>array('/blog'),
	Yii::t('blog','Tags').':'.urldecode($_GET['tag'])
);

$this->menu=array(
	array('label'=>'Create Blog', 'url'=>array('create')),
	array('label'=>'Manage Blog', 'url'=>array('admin')),
);

?>
<script type="text/javascript">
$(function(){
	
	var count = <?php echo $pages->getItemCount();?>;

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
		
		<?php $this->widget('CLinkPager', array(
		    'pages' => $pages,
			'selectedPageCssClass'=>'active',
			'maxButtonCount'=>10,
			'header'=>'',
			'htmlOptions'=>array(
				'class'=>'pagination pull-right',
				)
		)); ?>
</ul>

