<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $id
 * @property string $name
 * @property integer $weight
 * @property integer $type
 * @property string $description
 * @property integer $pid
 * @property integer $uid
 *
 * The followings are the available model relations:
 * @property User $u
 */
class Category extends CActiveRecord
{
	
	//特别说明：如果需要在添加同类型的分类，分类编号修改后面的编号，如再添加一个娱乐视频分类，则分类编号为31
	const CATEGORY_BLOG = 10;				//博客系统分类
	const CATEGORY_GALLERY = 20;		//相册系统分类
	const CATEGORY_VIDEO_EDU = 30;	//教学视频分类
	const CATEGORY_LAB = 40;				//实验项目分类
	const CATEGORY_BRAINSTROMING = 50;		//头脑风暴分类
	const CATEGORY_BOOKS = 60;		//图书分类
	
	
	const TREE_VIEW_CHECK = 'check';		//带checkbox显示分类
	const TREE_VIEW_LINK = 'link';			//以链接形式显示分类
	
	public $deep;
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, weight, type, description, pid', 'required'),
			array('weight, type, pid, uid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			array('description', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, weight, type, description, pid, uid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'owner' => array(self::BELONGS_TO, 'User', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('basic','Category ID'),
			'name' => Yii::t('basic','Category Name'),
			'weight' => Yii::t('basic','Category Weight'),
			'type' => Yii::t('basic','Category Type'),
			'description' => Yii::t('basic','Category Description'),
			'pid' => Yii::t('basic','Category Parent'),
			'uid' => Yii::t('basic','Owner'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('type',$this->type);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('uid',$this->uid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * ***************************************************************
	 * @todo 根据分类类型编号获取分类类型名称
	 * *************************************************************
	 * @param integer $id
	 * @return string
	 */
	public function getCategoryTypeName($id)
	{
		switch ($id)
		{
			case self::CATEGORY_BLOG:
				return Yii::t('basic','Blog');
				break;
			case self::CATEGORY_BRAINSTROMING:
				return Yii::t('basic','Brain Stroming');
				break;
			case self::CATEGORY_GALLERY:
				return Yii::t('basic','Gallery');
				break;
			case self::CATEGORY_LAB:
				return Yii::t('basic','Lab');
				break;
			case self::CATEGORY_VIDEO_EDU:
				return Yii::t('basic','Education Video');
				break;
			case self::CATEGORY_BOOKS:
				return Yii::t('basic','Books');
		}
	}
	
	/**
	 ******************************************************************
	 *@todo 生成分类类型列表
	 ****************************************************************** 
	 * @return array
	 */
	public function generateCategoryTypeList()
	{
		return array(
			self::CATEGORY_BLOG=>self::getCategoryTypeName(self::CATEGORY_BLOG),
			self::CATEGORY_GALLERY=>self::getCategoryTypeName(self::CATEGORY_GALLERY),
			self::CATEGORY_LAB=>self::getCategoryTypeName(self::CATEGORY_LAB),
			self::CATEGORY_VIDEO_EDU=>self::getCategoryTypeName(self::CATEGORY_VIDEO_EDU),
			self::CATEGORY_BRAINSTROMING=>self::getCategoryTypeName(self::CATEGORY_BRAINSTROMING),
			self::CATEGORY_BOOKS=>self::getCategoryTypeName(self::CATEGORY_BOOKS)
				
		);
	}
	
	public function getCategoryModelByType($type=null)
	{
		
		$criteria = new CDbCriteria(array(
				'order'=>'type ASC,pid DESC,id ASC'
		));
		
		if (is_null($type)) {
			$type=self::CATEGORY_BLOG;
		}
		$criteria->addCondition('type = '.intval($type));
		$models = Category::model()->findAll($criteria);
		
		return $models;
	}
	
	/**
	 * *******************************************************************
	 * @todo 递归显示所有分类
	 * *******************************************************************
	 * @param array $array
	 * @param  $pid
	 * @param  $y
	 * @param array $tdata
	 * @return array
	 */
	public static function getChildrenObject($array,$pid=0,$y=0,&$tdata=array())
	{
		foreach ($array as $value)
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
				self::getChildrenObject($array,$value->id,$n,$tdata);//这里递归调用，不明白递归的朋友，去找几个简单的递归例子熟悉下	
			}
		}
		return $tdata;
	}
	
	/**
	 * ***********************************************************************************
	 * @todo 根据分类Model获取分类列表
	 * ************************************************************************************
	 * @param Category $model
	 * @return array
	 */	
	public function generateCategoryDropdownList(Category $model)
	{
		$dropdownlist = array();
		if ($model->isNewRecord)
		 {
			$dropdownlist = Category::model()->getCategoryDropdownList(Category::CATEGORY_BLOG);
		}
		elseif ($model->pid == 0)
		{
			$dropdownlist = array(0=>'无');
		}
		else
		{
			$dropdownlist = Category::model()->getCategoryDropdownList($model->type);
		}
		
		return $dropdownlist;
	}
	
	/**
	 * *************************************************************************
	 * @todo 根据分类类型获取分类列表
	 * *************************************************************************
	 * @param int $type
	 * @return array
	 */
	public function getCategoryDropdownList($type)
	{
		$list = array();		
	
		$models = self::getCategoryModelByType($type);
	
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
	
	public static function generateCheckTreeByType($type,$options=array('treeview'=>self::TREE_VIEW_CHECK,'name'=>'checkItem'),$htmlOptions=array('class'=>'categories checkCategories'))
	{
		$list = Category::model()->getCategoryModelByType($type);
	
		$list = Category::model()->generateCheckTree($list,  0, $options, $htmlOptions );
	
		return $list;
	}
	
	/**
	 * ***************************************************************************
	 * @uses	见方法self::generateCheckTreeByType($type);
	 * *****************************************************************************
	 * 根据Category显示
	 * @param array $arr
	 * @param int $pid
	 * @param string $name
	 * @param array $htmlOptions
	 * @param boolean $check //是否生成带checkbox的列表
	 * @param string $html
	 * @return string
	 */
	public static function generateCheckTree($arr , $pid = 0,  $options = array('treeview'=>self::TREE_VIEW_CHECK,'name'=>'checkItem'), $htmlOptions=array() ,  &$html = "") {
	
		return self::model()->generateTree($arr,$pid,$options,$htmlOptions,$html);
	
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
	private function generateTree($arr , $pid = 0,  $options = array('treeview'=>self::TREE_VIEW_CHECK,'name'=>"checkItem"), $htmlOptions=array() ,  &$html = "")
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
					$html .= CHtml::checkBox($options['name'], false, array('value'=>$val['id'], 'id'=>$options['name'].'_'.$val->id,'title'=>$val->name));
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
					$html .= self::generateCheckTree($arr, $val->id,$options, $htmlOptions);
				}
				$html .= "</li>";
			}
		}
			
		$html .= "</ul>";
		return $html;
	}
	
	/**
	 *
	 * Generate the breadcrumbs
	 * @method generateBreadcrumbs();
	 * @param int $id
	 * @param string $action
	 * @param unknown_type $catename
	 */
	public function generateBreadcrumbs($id,$action='list',&$catename=array(),&$model=null){
		if(isset($id))
		{
			$model=Category::model()->findbyPk($id);
			if(count($model)){
	
				$data = Category::model()->findByPk($model->pid);
				$catename[$model->name] = array($action, 'id'=>$model->id, 'c'=>urlencode($model->name));
	
				if($model->pid == 0 && $model->type == Category::CATEGORY_BLOG)
					$catename[$model->name] = array('/blog');//,'id'=>$model->cate_id,'c'=>urlencode($model->cate_name), 'm'=>urlencode(self::model()->getCategoryType(self::CONTENT_STORY)));
	
				self::generateBreadcrumbs($model->pid,$action,$catename);
	
				return $catename;
			}
			return $catename;
	
		}
	}
	
	/**
	 *
	 * Generate the page title, base the breadcrumb
	 * @param array $breadcrumb
	 */
	public function generatePageTitle($breadcrumb,$connectStr='-')
	{
		$pagetitle = "";
		foreach ($breadcrumb as $key => $value) {
			$pagetitle.=$key.$connectStr;
		}
	
		//$breadcrumb[0]为文章标题，对于列表页面则没有文章标题，则会报错，因此在这里判断一下
		if (isset($breadcrumb[0])) {
			$pagetitle = str_replace(strval('0'), $breadcrumb[0], $pagetitle);
		}
	
		return $pagetitle;
	}
	
	/**
	 * *****************************************************
	 * 获取所有分类，此方法用于生成图书分类浏览
	 * @link books/space/bookcategory
	 * ****************************************************
	 * @param int $pid
	 * @created 2015/5/31
	 * @return multitype:NULL
	 */
	public function generateCategories($pid,$type=Category::CATEGORY_BOOKS)
	{		
		
		$result = array();
	
		$categories = Category::model()->findAll(array(
				'condition'=>'pid = :pid AND type = :type',
				'params'=>array(
					':pid'=>$pid,
					':type'=>60
				)
		));
	
		foreach ($categories as $data)
		{
			$result[$data->id] = $data->name;
		}
	
		return $result;
	}
	
	/**
	 * *********************************************************************
	 * 生成分类连接,此方法用于生成图书分类浏览
	 * @link books/space/bookcategory
	 * *******************************************************
	 * @param int $id
	 * @param string $link
	 * @param array $htmlOptions
	 * @param string $addMore
	 * @return string
	 */
	public function generateCategoryLinks($pid, $type=Category::CATEGORY_BOOKS, $link=null,$htmlOptions=array(),$addMore=true)
	{
		$links = '';
	
		$result = array();
	
		$result = self::generateCategories($pid,$type);
	
		foreach ($result as $key=>$value)
		{
			$htmlOptions['id'] = $key;
			$links .= CHtml::link($value,array($link,'id'=>$key), $htmlOptions);
		}
	
		//		UtilHelper::writeToFile($links);
		if ($addMore)
			$links .= '<br />如果这里没有你需要的分类，点这里'.CHtml::link('添加','javascript:void();',array('style'=>'border:none;','onclick'=>'addRegion();return false;') );
			
		return $links;
	
	
	}
	
	
	public function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->uid = Yii::app()->user->id;
			}
			return true;
		}
		else
			return false;
	}
}
