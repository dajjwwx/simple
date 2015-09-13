<?php
/**
 * @copyright (c) 2014 Blue Jobs <zclandxy@gmail.com>
 * @link http://www.yuekegu.com
 * @version 1.0
 * @date 2014/3/18
 * @license http://www.yuekegu.com/lisence
 * @description Define the CategoryModel fields
 * 
 *****************************************************************
 *Functions List：
 *    
 *
 *
 *
 *
 *
 *
 *
 *********************************************************************
 * 
 * History：
 *
 */
class CategoryModel
{
	public $id;				//主键ID
	
	//基本字段
	public $name;			//分类名称
	public $pid;			//父类ID
	
	//附加字段
	public $type;			//分类类型，每一个分类的父ID都设为0
	public $owner;			//分类所有者
	public $weight;			//分类权重
	public $description;	//分类描述
	
	//额外字段
	public $deep;			//分类深度

	const TREE_VIEW_CHECK = 'check';		//带checkbox显示分类
	const TREE_VIEW_LINK = 'link';			//以链接形式显示分类
	
	/**
	 *
	 * 
	 * 
	 ******************************************************************************************** 
	 * @param array $array	//
	 * @param int $pid		//父ID
	 * @param int $y		//初始深度
	 * @param array $tdata
	 * 
	 * @return CategoryModel
	 */
	public function getChildrenArray($array,$pid=0,$y=0,&$tdata=array())
	{
		//然后递归的取出各个子分类，这里默认的$pid=0是因为数据库中的pid为0的表示是第一级分类
		foreach ($array as $value)
		{
			if($value['pid']==$pid){
				$n = $y + 1;
				$value['deep'] = $n;
				if($n > 1)
				{
					$value['name']=$value['name'];
				}
				$tdata[]=$value;
				$this->getChildrenArray($array,$value['id'],$n,$tdata);//这里递归调用，不明白递归的朋友，去找几个简单的递归例子熟悉下
			}
		}
		return $tdata;
	}
	
	
	/**
	 * 将传入的分类数据按PID进行递归
	 ********************************************************************************************* 
	 * 
	 * @method self::getChildrenObject()
	 * 
	 * 
	 *****************************************************************************************
	 *Usage：
	 *		$result = array();
	 *		$categories = Category::model()->findAll();
	 *		foreach ($categories as $category)
	 *		{
	 *			$model = new CategoryModel();
	 *			$model->id = $category->id;
	 *			$model->name = $category->name;
	 *			$model->pid = $category->pid;
	 *			$result[] = $model;
	 *		}
	 *	
	 *		UtilHelper::dump(CategoryModel::getChildrenObject($result,0,0)); 
	 * 
	 ******************************************************************************************** 
	 * 
	 * @param CategoryModel[] $objects	//传入的是Category的对象List
	 * @param int $pid
	 * @param int $y
	 * @param array $tdata
	 */
	public static function getChildrenObject($objects,$pid=0,$y=0,&$tdata=array())
	{
		foreach ($objects as $value)
		{
			if($value->pid == $pid)
			{
				$n = $y + 1;
				$value->deep = $n;
				if($n > 1)
				{
					$value->name = $value->name;					
				}
				$tdata[]=$value;
				self::getChildrenObject($objects,$value->id,$n,$tdata);//这里递归调用，不明白递归的朋友，去找几个简单的递归例子熟悉下
				
			}
		}
		return $tdata;
	}

	//获取分类所有子目录
	public static function getChildrenIds($model, &$result=array())
	{		

		if($model->children)
		{
			foreach ($model->children as $child) {
				$result[] = $child->id;

				self::getChildrenIds($child, $result);

			}
		}

		return $result;
	}



	
	/**
	 * *************************************************************************
	 * @todo 根据分类类型获取分类列表
	 * *************************************************************************
	 * @param object $models
	 * @return array
	 */
	public function getCategoryDropdownList($models)
	{
		$list = array();		
	
		// $models = self::getCategoryModelByType($type);
	
		if($models == null)
		{
			$list = array(0=>'无');
		}
		else
		{
			$items = self::getChildrenObject($models);
			foreach ($items as $item)
			{
				$nbsp = "";
				for($i=1;$i<$item->deep;$i++){
					$nbsp .= "--";
				}
				$list[$item->id]=$nbsp.$item->name;
			}
				
		}
	
		return $list;
	
	}


	/**
	 * ***********************************************************************************
	 * 生成分类Tree显示
	 * **********************************************************************************
	 * options参数使用说明：
	 * 1. 'treeview' == self::TREE_VIEW_CHECK即返回带checkbox的分类显示;
	 * 使用：$options = array('treeview'=>self::TREE_VIEW_CHECK)
	 * 2.'treeview' == self::TREE_VIEW_LINK即返回以链接形式显示分类;
	 * 		若treeview == self::TREE_VIEW_LINK则还需要添加一个参数link
	 * 使用：$options = array('treeview'=>self::TREE_VIEW_LINK,'link'=>'blog/list') *
	 *
	 * *************************************************************************************
	 * @param array $arr
	 * @param number $pid
	 * @param string $name
	 * @param array $options //使用说明见options使用说明
	 * @param array $htmlOptions
	 * @param string $html
	 * @return string
	 */
	public static function generateTree($arr, $pid = 0,  $options = array('treeview'=>self::TREE_VIEW_CHECK,'name'=>"checkItem"), $htmlOptions=array() ,  &$html = "")
	{
		$result = self::getChildrenObject($arr , $pid);

	
		$html = "<ul ";
		foreach($htmlOptions as $key => $value){
			$html .= $key . '="'. $value. '"';
		}
		$html .= ">";
	
		foreach($result as $val){
			if ($val->pid == $pid) {
				$html .= "<li>";
				//生成带checkbox的列表
				if($options['treeview'] == self::TREE_VIEW_CHECK){
					$html .= CHtml::checkBox($options['name'], false, array('value'=>$val->id, 'id'=>$options['name'].'_'.$val->id,'title'=>$val->name));
				}
				$html .= '&nbsp;&nbsp;';
				//生成带link的列表
				if ($options['treeview'] == self::TREE_VIEW_LINK) {
					$html .= CHtml::link($val->name.'('.$val->id.')',array($options['link'],'id'=>$val->id));
				} else {
					$html .= $val->name.'('.$val->id.')';
				}
	
				$result2 = self::getChildrenObject($arr, $val->id);
					
				//var_dump($result);
					
				if($result2){
					$html .= '<i></i>';
					$html .= self::generateTree($arr, $val->id,$options, $htmlOptions);
				}
				$html .= "</li>";
			}
		}
			
		$html .= "</ul>";
		echo $html;
		return $html;
	}

	/**
	 *
	 * Generate the page title, base the breadcrumb
	 * @param array $breadcrumb
	 */
	public function generatePageTitle($breadcrumb, $reverse=false, $connectStr='-')
	{
		
		$pagetitle = "";

		if($reverse){
			$breadcrumb = array_reverse($breadcrumb);
		}


		foreach ($breadcrumb as $key => $value) {
			$pagetitle.=$key.$connectStr;
		}
	
		//$breadcrumb[0]为文章标题，对于列表页面则没有文章标题，则会报错，因此在这里判断一下
		if (isset($breadcrumb[0])) {
			$pagetitle = str_replace(strval('0'), $breadcrumb[0], $pagetitle);
		}

		$size = strlen($pagetitle);
	
		return substr($pagetitle,0,-2);
	}
	
	
}
?>