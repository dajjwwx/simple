<?php 
class BootListView extends CWidget
{
	public $data = array();	
	
	private $cssFile;
	
	
	public function init()
	{
		$this->cssFile = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('application.components.bootstrap.assets')).'/gridview/styles.css';
		
	}
	
	public function initData()
	{
		$data = array(
				'template'=>"{items}\n{pager}",
				'itemsCssClass'=>'table table-hover table-condensed',		
				'pagerCssClass'=>'pull-right',
				'cssFile'=>$this->cssFile,				
				'pager'=>array(
					'selectedPageCssClass'=>'active',
					'maxButtonCount'=>10,
					'header'=>'',
					'htmlOptions'=>array(						
						'class'=>'pagination',								
					)		
				)
		);
		
		return CMap::mergeArray($data, $this->data);	
		
	}
	
	public function run()
	{
		$this->widget('zii.widgets.grid.CListView', $this->initData());
	}
}
?>