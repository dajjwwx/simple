<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
This is the view content for action "<?php echo $this->action->id; ?>".
The action belongs to the controller "<?php echo get_class($this); ?>"
in the "<?php echo $this->module->id; ?>" module.
</p>
<?php
/* @var $this BooksController */

$this->breadcrumbs=array(
	'Books',
);
?>

<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>


<div>
	<h1><?php echo $bookinfo->title;?></h1>
	
	<img src="<?php echo $bookinfo->images->large;?>" />
	<p>价格：<?php echo $bookinfo->price;?></p>
	<p>出版社：<?php echo $bookinfo->publisher;?></p>
	<p>
		作者简介：<?php echo $bookinfo->author_intro;?>
	</p>
	<p>
		简介：<?php echo $bookinfo->summary;?>
	</p>
	
	<p>标签：
		<?php foreach ($bookinfo->tags as $k=>$tag):?>
			<?php echo CHtml::link($tag->title,'#');?> -
		<?php endforeach;?>
	</p>
	<hr />
	<h3>目录：</h3>
	<?php echo nl2br($bookinfo->catalog);?>
</div>

<?php 
	UtilHelper::dump($bookinfo);
?>
